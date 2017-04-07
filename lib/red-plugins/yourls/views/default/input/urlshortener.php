<?php
/**
 * Display the URL shortener input box
 */

elgg_require_js('yourls/shortener');

$text_input = elgg_view('input/text', array(
	'name' => 'yourls_url',
	'id' => 'yourls-url',
	'data-server' => elgg_get_plugin_setting('server', 'yourls'),
	'data-apikey' => elgg_get_plugin_setting('api_key', 'yourls')
));

echo '<div class="yourls-wrapper">';
echo elgg_view_image_block('', $text_input, array(
	'class' => 'hidden',
	'id' => 'yourls-form',
));
echo '</div>';
