<?php

require_once(dirname(__FILE__) . '/lib/functions.php');

/**
 * Init function for this plugin
 *
 * @return void
 */
 // register default elgg events
elgg_register_event_handler('init', 'system', 'reevo_custom_init');

function reevo_custom_init() {
	elgg_extend_view('css/elgg', 'css/reevo_custom.css');
}
