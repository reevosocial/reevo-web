<?php
/**
 * Add recext page
 *
 * @package Bookmarks
 */

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('reevo_custom:fbevent:add');
elgg_push_breadcrumb($title);

$content = elgg_view_form('reevo_custom/fbevent', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
