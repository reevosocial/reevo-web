<?php
/**
 * bit.ly URL shortener plugin
 *
 * @author Cash Costello
 * @license GPL2
 */

elgg_register_event_handler('init', 'system', 'yourls_init');

function yourls_init() {
	elgg_extend_view('css/elgg', 'css/yourls');

	// Agrega icono extra
	elgg_register_menu_item('extras', array(
		'name' => 'yourls',
		'text' => elgg_view_icon('link'),
		'href' => '#yourls-form',
		'title' => elgg_echo('yourls:this'),
		'id' => 'yourls-icon',
		'rel' => 'toggle',
	));
}

// Agrega el input que despliega el icono, en ese input cargamos la URL corta
elgg_register_plugin_hook_handler('register', 'menu:extras', 'modify_extras_menu', 0);

function modify_extras_menu($hook, $type, $value, $params) {
	// Agrega caja para url corta
	echo elgg_view('input/urlshortener');

}


// Genera URL al crear o actualizar cierto tipo de objetos
elgg_register_event_handler('create', 'all', 'generate_yourls');
elgg_register_event_handler('update:after', 'all', 'generate_yourls');

function generate_yourls($event, $type, $entity) {
	// genera enlace corto de recursos externos
	if ($entity && elgg_instanceof($entity, 'object', 'recext')) {
		run_yourls($entity, 'shorturl');
	}
}

function run_yourls($entity, $metadata_field) {
	$url			= $entity->getURL(); // URL to shrink
	$title		= $entity->getDisplayName();
	$format		= 'json';                       // output format: 'json', 'xml' or 'simple'
	$apikey		= elgg_get_plugin_setting('api_key', 'yourls');
	$api_url	= elgg_get_plugin_setting('server', 'yourls');

	// Init the CURL session
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $api_url );
	curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
	curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
	curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
	        'url'      => $url,
	        'title'    => $title,
	        'format'   => $format,
	        'action'   => 'shorturl',
	        'signature' => $apikey
	    ) );

	// Fetch and return content
	$data = curl_exec($ch);
	curl_close($ch);
	// Do something with the result. Here, we just echo it.
	$final = json_decode($data);
	$shorturl = $final->{'shorturl'};
	$entity->shorturl = $shorturl;
	//die($data);

}
