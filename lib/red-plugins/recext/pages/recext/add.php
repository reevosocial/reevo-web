<?php
/**
 * Add recext page
 *
 * @package Bookmarks
 */

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('recext:add');
elgg_push_breadcrumb($title);

$vars = recext_prepare_form_vars();
$content = elgg_view_form('recext/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);