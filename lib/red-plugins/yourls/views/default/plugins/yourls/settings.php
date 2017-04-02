<?php
/**
 * yourls plugin settings
 */

// set default values
if (!isset($vars['entity']->username)) {
	$vars['entity']->username = '';
}
// set default values
if (!isset($vars['entity']->api_key)) {
	$vars['entity']->api_key = '';
}

echo '<p class="mtm">';
echo parse_urls(elgg_echo('yourls:settings:instructs'));
echo '</p>';

echo '<div>';
echo elgg_echo('yourls:settings:server');
echo elgg_view('input/text', array(
	'name' => 'params[server]',
	'value' => $vars['entity']->server,
));
echo '</div>';

echo '<div>';
echo elgg_echo('yourls:settings:api_key');
echo elgg_view('input/text', array(
	'name' => 'params[api_key]',
	'value' => $vars['entity']->api_key,
));
echo '</div>';
