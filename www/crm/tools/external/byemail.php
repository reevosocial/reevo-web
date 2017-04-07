<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="es-ES">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="es-ES">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
require_once "../../civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';


if ($_GET['email']) { $email = $_GET['email'];}

if (!empty($email)) {
	$email_exists = civicrm_api3('email', 'get', array('email' => $email));

	if ($email_exists['count'] == 0) {
		echo "No existe un usuario con ese e-mail en la base de datos";
	} else {
		$contact_id = $email_exists['values'][$email_exists[id]]['contact_id'];
		header( 'Location: /wp-admin/admin.php?page=CiviCRM&q=civicrm/contact/view&reset=1&cid='.$contact_id );
	}
} else {
	echo "No he recibido ningun e-mail como parámetro.";
}

?>
