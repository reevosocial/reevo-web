<?php

// Este script se usa para generar los archivos JSON que contienen los estados/provincias de cada país.

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ini_set('display_errors', True);

require_once '/srv/reevo-web/www/crm/civicrm.settings.php';
require_once '/srv/reevo-web/www/blog/wp-blog-header.php';

require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';

// en CiviCRM los codigos de países van de 1001 a 1251
foreach (range(1001, 1251) as $countryId) {
    echo 'Generando JSON de provincidas del pais: '.$countryId;
    echo "\n";
    $json = CRM_Core_BAO_Location::getChainSelectValues($countryId, 'country');
    $output = json_encode($json, JSON_PRETTY_PRINT);
    file_put_contents('json/'.$countryId.'.json', $output);
}

?>
