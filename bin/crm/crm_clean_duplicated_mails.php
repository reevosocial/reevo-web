<?php
# ----
# Copyright (C) 2013-2015 - Reevo Project (http://reevo.org)
# License: Affero GPL version 3 - http://www.gnu.org/licenses/agpl.html
# ES: Este archivos es parte de: reevo-web (http://git.reevo.org/reevo/reevo-web)
# EN: This file is part of: reevo-web (http://git.reevo.org/reevo/reevo-web)
# ----

require('/srv/reevo-web/etc/global_config.php');

require('/srv/reevo-web/www/blog/wp-blog-header.php');
require_once "/srv/reevo-web/www/crm/civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';

$hostname = "localhost";
$lista_repetidos = array();

function verificador($resultado) {
  if ($resultado['is_error'] != 0) {
    echo "\n Se produjo un error en la última operacion. Este es el array devuelto:\n";
    print_r($resultado);
  }
}

function permiteBorrar($x) {
  // Esta funcion habilita el borrado directo (sin pasar por papelera) por parte de usuarios anonimos. Se habilita y deshabilita solo en caso de ser necesario. Es un workaround para un bug no resuelto  (https://issues.civicrm.org/jira/browse/CRM-15980).
  global $wp_roles;
  if (!isset($wp_roles)) {
    $wp_roles = new WP_Roles();
  }
  $roleObj = $wp_roles->get_role('anonymous_user');
  switch ($x) {
    case 1:
      $roleObj->add_cap('delete_contacts'); //Da permiso
      break;
    case 0:
      $roleObj->remove_cap('delete_contacts'); //Quita permiso
      break;
  }
}

if ($argv[1] == "-i") { permiteBorrar(1); } // Permite borrar contactos en modo interactivo

echo 'Este script busca emails duplicados y huerfanos en la tabla `civicrm_email` e intenta limpiarla

';

// Genera listado desde la tabla de mysql
$salida = shell_exec('mysql -u '.$REEVO_DB_USER.'  -p"'.$REEVO_DB_PASS.'"  -h '.$hostname.'  -e \'SELECT COUNT(*) AS `count`,`id`,`email` FROM civicrm_email  GROUP BY `email`;\' '.$REEVO_DB_CRM.' | grep -v ^1');

$array=explode("\n",$salida);
$cabecera=array_shift($array);


foreach($array as $data) {
  $parts = preg_split('/\s+/', $data);
  $lista_repetidos[] = array('id'=>$parts[1],'email'=>$parts[2],'rep'=>$parts[0]);
}

array_pop($lista_repetidos); //quita el ultimo elemento del array, porque queda en blanco

$total = count($lista_repetidos);
echo 'Encontré '.$total.' correos repetidos
';


foreach($lista_repetidos as $item) {
  $total2++;
  $distintos = array();
  unset($contacto);

  $mails_repetidos = civicrm_api3('email', 'get', array('email' => $item['email']));
  // print_r($mails_repetidos);


  // Verifico si el contacto asociado existe, sino existe borro el mail
  foreach($mails_repetidos['values'] as $caso) {
    // Busco contacto usando su ID
    $result = civicrm_api3('contact', 'get', array('contact_id' => $caso['contact_id']));
    // print_r($result);
    // Borro el contacto asociado si no existe
    if ($result['count'] == 0) {
      echo '
      El contacto con id '.$caso['contact_id'].' no existe, el email '.$caso['id'].' asociado al mismo se elimina
      ';
      $result = civicrm_api3('email', 'delete', array('id' => $caso['id']));
      verificador($result);

    }
  }

  //Verifico si los emails apuntan todos al mismo contacto
  foreach($mails_repetidos['values'] as $caso) {
    if (!$contacto) {
      $contacto = $caso['contact_id'];
      if ($caso['is_primary'] == 0) {
        echo '
        El email con id '.$caso['contact_id'].' no es primario asi que se elimina
        ';
        $result = civicrm_api3('email', 'delete', array('id' => $caso['id']));
        verificador($result);
      }
    } else {
      if ($contacto != $caso['contact_id']) {
        if (!$distintos) {
          $distintos[] = $contacto;
          $distintos[] = $caso['contact_id'];
        } else {
          $distintos[] = $caso['contact_id'];
        }
        if ($caso['is_primary'] == 0) {
          echo '
          El email con id '.$caso['contact_id'].' no es primario asi que se elimina
          ';
          $result = civicrm_api3('email', 'delete', array('id' => $caso['id']));
          verificador($result);
        }
        $iguales = 0;
      } else {
        $iguales = 1;

      }
    }
  }

  if ($iguales == 0) {
    // Hay dos correos iguales que apuntan a contactos diferentes, que posiblemente sean dedistintos tipo (individual o organizacion)
    if ($distintos) {
      if ($argv[1] == "-i") { // Modo interactivo activado
        system('clear');
        $restantes = $total - $total2;
        echo '
Restan procesar '.$restantes.' de '.$total.'.

Los siguientes contactos tienen el mismo email:
        ';
        $opcion = 0;
        $distintos_mails = array();
        foreach($distintos as $caso) {
          $mail = civicrm_api3('email', 'get', array('contact_id' => $caso));
          $contacto = civicrm_api3('contact', 'get', array('contact_id' => $caso));
          foreach($mail['values'] as $caso2) {
            // $mail2 = $mail['values'][*]['email'];
            $opcion++;
            echo '
              OPCION: '.$opcion.'
              -----------
                  id: '.$caso.'
                name: '.$contacto['values'][$caso]['display_name'].'
                type: '.$contacto['values'][$caso]['contact_type'].'
                mail: '.$caso2['email'].'
             id_mail: '.$caso2['id'].'
            primario: '.$caso2['is_primary'].'
  ';
            $distintos_mails[] = $caso2['id'];
          }
          // print_r($contacto);
        }

        echo "\nCual desea conservar? (1 o 2) - ";
        $stdin = fopen('php://stdin', 'r');
        $response = fgetc($stdin);
        switch ($response) {
          case '1':
            echo "Elimino el contacto con ID $distintos[1].\n";
            $result = civicrm_api3('contact', 'delete', array('contact_id' => $distintos[1], 'skip_undelete' => 1, 'check_permission' => 0 ));
            $result = civicrm_api3('email', 'delete', array('id' => $distintos_mails[1]));
            break;
          case '2':
            echo "Elimino el contacto con ID $distintos[0].\n";
            $result = civicrm_api3('contact', 'delete', array('contact_id' => $distintos[0], 'skip_undelete' => 1,  'check_permission' => 0 ));
            $result = civicrm_api3('email', 'delete', array('id' => $distintos_mails[0]));
            break;
          default:
            echo "Abortado!.\n";
            goto fin;
            exit;
            break;
        }
      } else {
        echo '
Los siguientes contactos tienen el mismo email:
';
        $cierre = 'Fin de procesamiento! Para resolver estos correos duplicados ejecuta este script en modo interactivo (paramentro -i)';
        $distintos_mails = array();
        foreach($distintos as $caso) {
          $mail = civicrm_api3('email', 'get', array('contact_id' => $caso));
          $contacto = civicrm_api3('contact', 'get', array('contact_id' => $caso));
          foreach($mail['values'] as $caso2) {
            echo '  > id: '.$caso.' | mail: '.$caso2['email'].' | name: '.$contacto['values'][$caso]['display_name'].' | type: '.$contacto['values'][$caso]['contact_type'].' | id_mail: '.$caso2['id'].' | primario: '.$caso2['is_primary'].'
';
          }
        }
      }
    }
  } else {
  }
}

fin:
if ($cierre) {echo '

'.$cierre.'

';}

if ($argv[1] == "-i") { permiteBorrar(0); } // Deshabilita borrar contactos en modo interactivo

?>
