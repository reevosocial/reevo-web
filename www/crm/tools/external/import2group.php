<?php
require_once "../../civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';

$handle = fopen("lista.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
		$email_exists = civicrm_api3('email', 'get', array('email' => $lista));
		if ($email_exists['count'] == 0) {
			echo "No existe un usuario con ese e-mail en la base de datos";
		} else {
			$contact_id = $email_exists['values'][$email_exists[id]]['contact_id'];

			$data = array(
			  'contact_id' 		=> $contact_id,
			  'group_id' 		=> '20',
			);

			$new_grupos_agregar = civicrm_api3('group_contact', 'create', $data);
			print_r($new_grupos_agregar);
		}
    }

    fclose($handle);
} else {
    // error opening the file.
} 


?>