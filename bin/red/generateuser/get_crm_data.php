#!/usr/bin/env php
<?php
// pasar como parametro un email para devolver los datos del contacto

require('/srv/reevo-web/www/blog/wp-blog-header.php');
require_once "/srv/reevo-web/www/crm/civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';

$params = array(
  'email' => $argv[1],
);

$result = civicrm_api3('Contact', 'get', $params);

print_r($result);

?>
