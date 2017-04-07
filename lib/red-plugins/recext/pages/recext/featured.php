<?php
/**
 * list featured blogs
 */

// title button
elgg_register_title_button();

// breadcrumb
$title = elgg_echo('status:featured');

elgg_push_breadcrumb(elgg_echo('recext'), 'recext/all');
elgg_push_breadcrumb($title);

// build page elements
$options = [
	'type' => 'object',
	'subtype' => 'recext',
	'full_view' => false,
	'metadata_name_value_pairs' => [
		[
			'name' => 'featured',
			'value' => true,
			'operand' => '=',
		],
	],
	'no_results' => elgg_echo('recext:none'),
];

$content = elgg_list_entities_from_metadata($options);

$sidebar = elgg_view('recext/sidebar', [
	'page' => 'featured',
]);

// build page
$body = elgg_view_layout('content', [
	'title' => $title,
	'content' => $content,
	'sidebar' => $sidebar,
	'filter_context' => 'featured',
]);

// draw page
echo elgg_view_page($title, $body);
