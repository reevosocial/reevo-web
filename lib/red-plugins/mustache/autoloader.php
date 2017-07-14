<?php

$path = __DIR__;
if (file_exists("$path/vendor/autoload.php")) {
	require_once "$path/vendor/autoload.php";
}

/**
 * Mustache DI
 * @return \Elgg\Mustache
 */
function mustache() {
	return new Mustache_Engine();
}