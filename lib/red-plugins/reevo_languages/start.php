<?php

/**
 * Init function for this plugin
 *
 * @return void
 */
function reevo_languages_init() {
}

// register default elgg events
elgg_register_event_handler('init', 'system', 'reevo_languages_init');
