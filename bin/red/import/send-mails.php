<?php
error_reporting(E_ALL);

include_once('lib/ConsoleHandler.php');
include_once('lib/Mailer.php');

$console = new ConsoleHandler();
$settings = $console->parse();

$startTime = time();

include_once('../engine/start.php');

elgg_set_ignore_access(true);

$mailer = new Mailer();
$mailer->setSettings(parse_ini_file('conf/mailer-settings.ini'));

$files = glob($settings['input_directory'] . '/' . '*.json.imported.log');
foreach($files as $file) {
	echo 'Mailing ' . $file . PHP_EOL;
	$mailer->process($file);
}

elgg_set_ignore_access(false);

echo 'Finished importing in ' . (time() - $startTime) . PHP_EOL;