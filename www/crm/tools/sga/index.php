<?php
// Checks if we are logged in our CMS
require('/srv/reevo/blog.reevo.org/wp-blog-header.php');

if (!is_user_logged_in()){
    echo "No estás logueado en el CRM. <a href='/wp-login.php?redirect_to=http%3A%2F%2Fevo.re%2Fsga&reauth=1'>Ingresa ahora</a>";
    exit;
};

require_once "/srv/reevo/crm.reevo.org/civicrm/civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';
	
// Get WP current user id
$user_ID = get_current_user_id(); 
// Get the CRM id of the WP user
$result = civicrm_api3('uf_match', 'get', array('uf_id' => $user_ID,));
$key = array_keys($result['values']);
$current_user = $result['values'][$key[0]]['contact_id'];


function CountsContactsInGroup($group_id) {


	
	$array = civicrm_api('Contact','Get',array('group' => array($group_id => 1), 'version' =>3, 'rowCount' => 0 ));
	foreach($array as $valor) {

		foreach($valor as $valor2) {
				$total++;
		}
	}
	return $total;
}

function ContactsNotesTableByGroup($group_id, $table_title,$grupo_superior,$grupo_inferior) {

	
	$total_members = CountsContactsInGroup($group_id);
	echo "<h2>$table_title ($total_members)</h2>
	<table id='myTable' class='tablesorter'> 
	<thead> 
	<tr> 
	    <th>Apellido</th> 
	    <th>Nombre</th> 
	    <th>Email</th> 
	    <th>País</th> 
	    <th>Ciudad</th> 
	    <th>Fecha de nota</th> 
	    <th>Titulo de última nota</th> 
	    <th>Contenido de última nota</th> 
	    <th>Autor</th> 
	    <th>Acciones</th> 
	</tr> 
	</thead> 
	<tbody>";


	$array = civicrm_api('Contact','Get',array('group' => array($group_id => 1), 'version' =>3, 'rowCount' => 0 ));
	foreach($array as $valor) {

			foreach($valor as $valor2) {
				// print_r ($valor2);
					$notes = civicrm_api('Note', 'Get', array('entity_table' => 'civicrm_contact', 'entity_id' => $valor2['id'], 'version' => 3));
					$max = 0;
					if ($notes['count'] != '0') {
						foreach($notes as $valor3) {
								foreach(array_reverse($valor3) as $valor4) {
									if ($max == 0) {
										$autor_css = $valor4['contact_id'];
										$max = 1;
									}
								}
						} // We can style the row according the author of the note
						echo "\n";
						echo '<tr id="'.$valor2['email'].'" class="row-author-'.$autor_css.'">';
					} else {
						echo "\n";
						echo "<tr class=\"row-author-null\">";
					}
										
					echo '<td>' . $valor2['last_name'] . '</td>';
					echo '<td>' . $valor2['first_name'] . '</td>';
					echo '<td style="min-width: 60px; font-size:80%;"><a href="mailto:' . $valor2['email'] . '">'.$valor2['email'].'</td>';
					echo '<td>' . $valor2['country'] . '</td>';
					echo '<td>' . $valor2['city'] . '</td>';
					
					$max = 0;
					foreach($notes as $valor3) {
							foreach(array_reverse($valor3) as $valor4) {
								if ($max == 0) {
									echo '<td style="min-width: 60px;">' . $valor4['modified_date'] . '</td>';
									echo '<td style="min-width: 150px;">' . $valor4['subject'] . '</td>';
									echo '<td>' . $valor4['note'] . '</td>';
									$autor = civicrm_api('Contact','Get', array('id' => $valor4['contact_id'], 'version' =>3));
										foreach($autor as $valor5) { foreach($valor5 as $valor6) {
												echo '<td>' . $valor6['first_name'] . '</td>';
											}
										}
									$max = 1;
								}
							}
					} // End notes
										
					// Get groups names
					$test = civicrm_api3('group', 'get', array('id' => $grupo_inferior));
					$grupo_inferior_nombre = explode("-", $test['values'][$test[id]]['title']);
					$test = civicrm_api3('group', 'get', array('id' => $grupo_superior));
					$grupo_superior_nombre = explode("-", $test['values'][$test[id]]['title']);
										
					echo '<td style="min-width: 140px;">
	<a class="icono" id="agregar" href="JavaScript:newPopup(\'newnote.php?id='. $valor2['id'] .'\');" title="Agregar nota"></a>
	<a class="icono" id="ver" target="_blank" href="/wp-admin/admin.php?page=CiviCRM&q=civicrm/contact/view/note&action=view&reset=1&cid='.$valor2['id'].'&selectedChild=note&" title="Ver notas"></a>
	<a class="icono" id="editar" target="_blank" href="/wp-admin/admin.php?page=CiviCRM&q=civicrm/contact/add&reset=1&action=update&cid='. $valor2['id'] .'" title="Editar información del contacto"></a>';
					
					if ($grupo_inferior != 0) {
						echo "\n";
						echo '	<a class="icono" id="descender" href="JavaScript:cambiarGrupo(\''. $valor2['email'] .'\',\''. $group_id .'\',\''. $grupo_inferior .'\',\'Descender a '.array_reverse($grupo_inferior_nombre)[0].'\');" title="Bajar contacto al grupo '.array_reverse($grupo_inferior_nombre)[0].'"></a>';
					}
					if ($grupo_superior != 0) {
						echo "\n";
						echo '	<a class="icono" id="ascender" href="JavaScript:cambiarGrupo(\''. $valor2['email'] .'\',\''. $group_id .'\',\''. $grupo_superior .'\',\'Ascender a '.array_reverse($grupo_superior_nombre)[0].'\');" title="Subir contacto al grupo '.array_reverse($grupo_superior_nombre)[0].'"></a>';
					}
				echo '</td></tr>';
// 				/crm/external/?email='. $valor2['email'] .'&sacar='.$group_id.'&agregar='.$grupo_inferior.'

			
		}
	}
	echo "</tbody></table>";

};




?>


<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="es-ES">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="es-ES">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Gestión de activistas</title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="print, projection, screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,700,700italic' rel='stylesheet' type='text/css'>


<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>

<script type="text/javascript" id="js">
	$(document).ready(function() {
		// call the tablesorter plugin
		$("table").tablesorter({
			// sort on the fith column, the date column
			sortList: [[5,1],[0,0]]
		});
	}); 
</script>

<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=460,width=450,left=10,top=10,resizable=yes,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}

function myFunction() {
    
    if (person != null) {
        document.getElementById("demo").innerHTML =
        "Hello " + person + "! How are you today?";
    }
}

function cambiarGrupo(email,sacar,agregar,descripcion) {
	
  var razon = prompt('Vas a cambiar de estado a este contacto: '+descripcion+'. ¿Por qué motivo?','No se especificaron razones');

	if (razon != null) { 
		 window.location = '/crm/external/?email='+email+'&sacar='+sacar+'&agregar='+agregar+'&nota_titulo=Cambio de grupo: '+descripcion+'&nota='+razon+'&yo=<?php echo $current_user; ?>&url=http://reevo.org/crm/sga/#'+email
	}
}

function cambiarGrupo2(email,sacar,agregar,descripcion) {
	if (confirm('Vas a cambiar de estado a este contacto: '+descripcion+'. ¿Realmente quieres hacerlo?')) { 
		 window.location = '/crm/external/?email='+email+'&sacar='+sacar+'&agregar='+agregar+'&nota=Cambio de grupo: '+descripcion+'&yo=<?php echo $current_user; ?>&url=http://reevo.org/crm/sga/#'+email
	}
}
</script>

	
</head>
<body>
	<?php 
	// Here we call the function to show the table of contacts in a group. We specify the group id as first argument.
	ContactsNotesTableByGroup(2,'Activistas','0','4');
	ContactsNotesTableByGroup(4,'Candidatos a activistas','2','41');
	ContactsNotesTableByGroup(41,'Ex-Candidatos a activistas','4','0');
	?>
</body>
</html>
