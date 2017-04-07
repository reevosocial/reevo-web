<?php
/**
 * Elgg recext plugin export page
 *
 * @package ElggBookmarks
 */

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('recext'));

elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'recext',
	'full_view' => false,
	'view_toggle_type' => false,
	'no_results' => elgg_echo('recext:none'),
	'preload_owners' => true,
	'preload_containers' => true,
	'distinct' => false,
	'list_type' => 'list',
	'item_view' => 'object/recext_export',

));

$title = elgg_echo('recext:everyone');

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('recext/sidebar'),
));

echo elgg_view_page($title, $body);
