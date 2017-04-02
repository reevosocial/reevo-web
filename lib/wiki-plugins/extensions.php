<?php
// ES: Este archivo carga todas las extensiones necesarias
//
// EN: This file loads all necessary extensions


## REEVO : starts Reevo's base plugin
$wgCookieDomain = '.devreevo.org';
require_once("$IP/extensions/Reevo/Reevo.php");


## DYNAMIC PAGE LIST 
require_once("$IP/extensions/Intersection/DynamicPageList.php");
$wgDLPMaxCacheTime = 0;


## LinkAttributes
require_once "$IP/extensions/LinkAttributes/LinkAttributes.php";


require_once( "$IP/extensions/WikiEditor/WikiEditor.php" );

?>
