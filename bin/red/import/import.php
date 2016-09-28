<?php
error_reporting(E_ALL);

include_once('lib/ConsoleHandler.php');
include_once('lib/JSONImporter.php');

$console = new ConsoleHandler();
$settings = $console->parse();

$startTime = time();

include_once('../../../www/red/engine/start.php');

elgg_set_ignore_access(true);

$importer = new JSONImporter();
$importer->setSettings($settings);

$files = glob($settings['input_directory'] . '/' . '*.json');
foreach($files as $file) {
	echo 'Importing ' . $file . PHP_EOL;
	$importer->import($file);
}

elgg_set_ignore_access(false);

echo 'Finished importing in ' . (time() - $startTime) . PHP_EOL;
