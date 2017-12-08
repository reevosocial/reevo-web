<?php

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('admin:theme:layout:site_menu_position'),
	'value' => elgg_get_plugin_setting('site_menu_position', 'hypeUI', 'topbar'),
	'name' => 'params[site_menu_position]',
	'options_values' => [
		'topbar' => elgg_echo('admin:theme:layout:site_menu_position:topbar'),
		'navbar' => elgg_echo('admin:theme:layout:site_menu_position:navbar'),
	],
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('admin:theme:layout:breadcrumbs'),
	'value' => elgg_get_plugin_setting('breadcrumbs', 'hypeUI', false),
	'name' => 'params[breadcrumbs]',
	'options_values' => [
		false => elgg_echo('option:no'),
		true => elgg_echo('option:yes'),
	],
]);

echo elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo('admin:theme:layout:site_menu_count'),
	'#help' => elgg_echo('admin:theme:layout:site_menu_count:help'),
	'value' => elgg_get_plugin_setting('site_menu_count', 'hypeUI', 5),
	'name' => 'params[site_menu_count]',
]);


echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('admin:theme:layout:sidebar_width'),
	'value' => elgg_get_plugin_setting('sidebar_width', 'hypeUI', 3),
	'name' => 'params[sidebar_width]',
	'options' => range(1, 4),
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('admin:theme:layout:sidebar_alt_width'),
	'value' => elgg_get_plugin_setting('sidebar_alt_width', 'hypeUI', 3),
	'name' => 'params[sidebar_alt_width]',
	'options' => range(1, 4),
]);

$elements = [
	'topbar' => 'primary',
	'navbar' => 'primary',
	'header' => 'light',
	'landing_hero' => 'primary',
];

$styles = [
	'primary',
	'light',
	'white',
	'dark',
	'danger',
	'warning',
	'info',
	'success',
];

foreach ($elements as $element => $default) {
	echo elgg_view_field([
		'#type' => 'select',
		'#label' => elgg_echo("admin:theme:layout:style:$element"),
		'value' => elgg_get_plugin_setting("style:$element", 'hypeUI', $default),
		'name' => "params[style:$element]",
		'options' => $styles,
	]);
}

$landing_elements = [
	'landing:title' => 'text',
	'landing:subtitle' => 'text',
	'landing:info' => 'longtext',
	'landing:module' => 'longtext',
	'sidebar:before' => 'longtext',
	'sidebar:after' => 'longtext',
	'footer' => 'longtext',
];

foreach ($landing_elements as $element => $type) {
	echo elgg_view_field([
		'#type' => $type,
		'#label' => elgg_echo("admin:theme:layout:$element"),
		'value' => elgg_get_plugin_setting("$element", 'hypeUI'),
		'name' => "params[$element]",
	]);
}

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

elgg_set_form_footer($footer);