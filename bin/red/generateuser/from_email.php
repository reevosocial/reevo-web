#!/usr/bin/env php
<?php
/*
USO: php from_email.php email=<usuario@email.com> name="Nombre Apellido" groups=alias1,alias2 groupsout=alias3,alias4 msg=new_active_member.es.tpl

Este script permite generar y modificar un usuario en red.reevo a partir de un e-mail.
  * se genera sola la contraseña
  * se puede sumar y quitar a grupos
  * se puede marcar como miembro de reevo
  * se pueden indicar nombre de usuario y nombre o se pueden autogenerar a partir de los datos que tenemos en el CRM
*/

include_once('/srv/reevo-web/www/red/vendor/elgg/elgg/engine/start.php');
elgg_set_ignore_access(true);

if($argc>1)
  parse_str(implode('&',array_slice($argv, 1)), $_GET);

$email = $_GET['email'];
$name = $_GET['name'];
$groups = $_GET['groups'];
$groupsout = $_GET['groupsout'];
$message_file = $_GET['msg'];


// verifica si ya existe un usuario con ese email
$user = get_user_by_email($email);

if ($user) {
  # echo "Ya existe un usuario con el email: $email \n";
  $user = $user[0];
  echo $user->getURL();
  // $user->delete();
} else {
  if (!$name) {
    // intentamos obtener el nombre desde el CRM porque no se especifico
    $crm_user_data = getCrmUserData($email);
    if ($crm_user_data) {
      $name = $crm_user_data['first_name'] . ' ' . $crm_user_data['last_name'];
    } else {
      // si el CRM no tiene info, el nombre sera el mismo que el username
      $name = $email;
    }
  }
  $user = createUser($email,$name,$message_file);
  echo $user->getURL();

}

// Agrega al usuario a ciertos grupos
if ($groups) {
  $userguid = $user->getGUID();
  $groups_array = explode(',',$groups);
  foreach ($groups_array as $key => $value) {
    addUserToGroups($userguid,$value);
  }
}

// Quita al usuario de ciertos grupos
if ($groupsout) {
  $userguid = $user->getGUID();
  $groups_array = explode(',',$groupsout);
  foreach ($groups_array as $key => $value) {
    removeUserToGroups($userguid,$value);
  }
}

function createUser($email,$name,$message_file) {
  $username = generateUsernameFromEmail($email);
  $password = generate_random_cleartext_password();
  if ($name == $email) {
    $name = $username;
  }

  if (($guid = register_user($username, $password, $name, $email)) !== false) {
    # echo "Se creo el usuario: $username ($name) <$email> con GUID $guid y password: $password \n";

    $u = get_user($guid);
    // $u->description = $briefdesc;
    $u->enabled = 'yes';

    // Validate user
    elgg_get_user_validation_status($guid, true, 'beta_user');

    // Mark as beta user
    // add_entity_relationship($guid, 'beta_user', $site_guid);

    // Notify user
    if ($message_file) {
      sendEmail($u, $password, $group, $message_file);
    }

    return $u;
  } else {
    # echo "No se pudo crear: $username ($name) <$email> \n";
  }

}

function addUserToGroups($userguid,$groupalias) {
  $group = get_group_from_group_alias($groupalias);

  // Make the user a member of the $group
  add_entity_relationship($userguid, 'member', $group->guid);
  add_user_to_access_collection($userguid, $group->group_acl);

  // Habilita notificaciones para los grupos
  add_entity_relationship($userguid, 'notifyemail', $group->guid);
  # echo "Se unio al usuario con GUID $userguid al grupo $groupalias \n";
}


function removeUserToGroups($userguid,$groupalias) {
  $group = get_group_from_group_alias($groupalias);

  // Make the user a member of the $group
  remove_entity_relationship($userguid, 'member', $group->guid);
  remove_user_from_access_collection($userguid, $group->group_acl);

  // Habilita notificaciones para los grupos
  remove_entity_relationship($userguid, 'notifyemail', $group->guid);
  # echo "Se quitó al usuario con GUID $userguid del grupo $groupalias \n";
}


function generateUsernameFromEmail($email) {
  // Esta funcion viene de ProfileManager

	if (empty($email) || !is_email_address($email)) {
		return false;
	}

	list($username) = explode('@', $email);

	// strip unsupported chars from the usernam
	// using same blacklist as in validate_username() function
	// not using a preg_replace as otherwise the hook can not be used (as the syntax is different)
	$blacklist = '\'/\\"*& ?#%^(){}[]~?<>;|¬`@+=';
	$blacklist = elgg_trigger_plugin_hook('username:character_blacklist', 'user', ['blacklist' => $blacklist], $blacklist);
	$blacklist = str_split($blacklist);

	foreach ($blacklist as $unwanted_character) {
		$username = str_replace($unwanted_character, '', $username);
	}

	// show hidden entities (unvalidated users)
	$hidden = access_show_hidden_entities(true);

	// check if username is unique
	$original_username = $username;

	$i = 1;
	while (get_user_by_username($username)) {
		$username = $original_username . $i;
		$i++;
	}

	// restore hidden entities
	access_show_hidden_entities($hidden);

	return $username;
}

function getCrmUserData($email) {
  // Lo llamamos externamente porque no es posible llamar a las dependencias de Elgg y WP desde el mismo script
  $output = shell_exec("php /srv/reevo-web/bin/red/generateuser/get_crm_data.php {$email}");

  // Tomamos el array en formato de texto que genera el script anterior y lo reconvertimos en un array de php
  $array = print_r_reverse($output);
  // Si hay al menos un contacto en el CRM con ese email, la funcion lo devuelve
  if ($array['count'] != 0) {
    // en caso de que haya mas de un contacto, solo devuelve el primero
    $array1 = array_pop(array_reverse($array['values']));
    return $array1;
  }
}

function print_r_reverse($in) {
  $lines = explode("\n", trim($in));
  if (trim($lines[0]) != 'Array') {
      // bottomed out to something that isn't an array
      return $in;
  } else {
      // this is an array, lets parse it
      if (preg_match("/(\s{5,})\(/", $lines[1], $match)) {
          // this is a tested array/recursive call to this function
          // take a set of spaces off the beginning
          $spaces = $match[1];
          $spaces_length = strlen($spaces);
          $lines_total = count($lines);
          for ($i = 0; $i < $lines_total; $i++) {
              if (substr($lines[$i], 0, $spaces_length) == $spaces) {
                  $lines[$i] = substr($lines[$i], $spaces_length);
              }
          }
      }
      array_shift($lines); // Array
      array_shift($lines); // (
      array_pop($lines); // )
      $in = implode("\n", $lines);
      // make sure we only match stuff with 4 preceding spaces (stuff for this array and not a nested one)
      preg_match_all("/^\s{4}\[(.+?)\] \=\> /m", $in, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
      $pos = array();
      $previous_key = '';
      $in_length = strlen($in);
      // store the following in $pos:
      // array with key = key of the parsed array's item
      // value = array(start position in $in, $end position in $in)
      foreach ($matches as $match) {
          $key = $match[1][0];
          $start = $match[0][1] + strlen($match[0][0]);
          $pos[$key] = array($start, $in_length);
          if ($previous_key != '') $pos[$previous_key][1] = $match[0][1] - 1;
          $previous_key = $key;
      }
      $ret = array();
      foreach ($pos as $key => $where) {
          // recursively see if the parsed out value is an array too
          $ret[$key] = print_r_reverse(substr($in, $where[0], $where[1] - $where[0]));
      }
      return $ret;
  }
}

function sendEmail($user, $pass, $group, $message_file) {
  $site = elgg_get_site_entity();
  $site_url 	= elgg_get_site_url();
  $username 	= $user->username;
  $name 		= $user->name;
  $from    	= $site->email;
  $to      	= $user->name .'<'.$user->email.'>';

  // usamos la primera linea del template del mensaje como asunto
  $subject = file('/srv/reevo-web/bin/red/generateuser/tpl/'.$message_file)[0];

  $lines = file('/srv/reevo-web/bin/red/generateuser/tpl/'.$message_file);
  unset($lines[0]);
  unset($lines[1]);

  $body = implode('', $lines);
  // $body 		= file_get_contents('./tpl/'.$message_file);
  $body 		= str_replace("@NAME@",$name,$body);
  $body 		= str_replace("@USERNAME@",$username,$body);
  $body 		= str_replace("@PASSWORD@",$pass,$body);
  $body 		= str_replace("@URL@",$site_url,$body);

  $params   	= null;

  return elgg_send_email($from, $to, $subject, $body, $params);
}

?>
