<?php
require_once "../../civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';

$handle = fopen("lista.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

		$data = array(
		  'contact_id' 		=> $line,
		  'group_id' 		=> '183', // id del grupo del epep
		);

		$new_grupos_agregar = civicrm_api3('group_contact', 'create', $data);
		print_r($new_grupos_agregar);
    }

    fclose($handle);
} else {
    // error opening the file.
} 


?>