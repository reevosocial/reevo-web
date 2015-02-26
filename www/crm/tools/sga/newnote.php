<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="es-ES">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="es-ES">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Nueva nota</title>

<link rel="stylesheet" href="css/style.css" type="text/css" media="print, projection, screen" />

<script type="text/javascript" src="js/jquery-latest.js"></script>
	
</head>
<body>


<form action="newnote_post.php" method="post">
	<select name="contact">
	<?php
	require_once "/srv/reevo/crm.reevo.org/civicrm/civicrm.settings.php";
	require_once 'CRM/Core/Config.php';
	$config = CRM_Core_Config::singleton( );
	require_once 'api/api.php';

	$array = civicrm_api('Contact','Get',array('group' => array(2 => 1), 'version' =>3, 'rowCount' => 0 ));
	$array2 = civicrm_api('Contact','Get',array('group' => array(4 => 1), 'version' =>3, 'rowCount' => 0 ));
	
	$default = $_GET['id'];
	// TODO: call this from a function	
	foreach($array as $valor) {
		foreach($valor as $valor2) {
			// print_r ($valor2);
				if ($valor2['id'] == $default) {
					echo '<option selected="selected" name="'. $valor2['id'] . '" value="' . $valor2['id'] .'">' . $valor2['first_name'] .' '. $valor2['last_name'] .'</option>';
				} else {
					echo '<option name="'. $valor2['id'] . '" value="' . $valor2['id'] .'">' . $valor2['first_name'] .' '. $valor2['last_name'] .'</option>';
				}
		}
	}
	echo "<option disabled role=separator>";
	
	foreach($array2 as $valor) {
		foreach($valor as $valor2) {
			// print_r ($valor2);
				if ($valor2['id'] == $default) {
					echo '<option selected="selected" name="'. $valor2['id'] . '" value="' . $valor2['id'] .'">' . $valor2['first_name'] .' '. $valor2['last_name'] .'</option>';
				} else {
					echo '<option name="'. $valor2['id'] . '" value="' . $valor2['id'] .'">' . $valor2['first_name'] .' '. $valor2['last_name'] .'</option>';
				}
		}
	}

	// print_r ($array);
	?>
	</select><br/>

	<input style="width: 400px;" name="subject" value="" placeholder="Titulo de la nota" /><br/>
	<textarea style="width: 400px; height: 250px;" name="body" value="" placeholder="Contenido de la nota"></textarea>
	<p><input type="submit" /></p>
</form>




</body>
</html>
