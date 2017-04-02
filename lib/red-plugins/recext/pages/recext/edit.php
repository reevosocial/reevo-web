<?php
/**
 * Add recext page
 *
 * @package ElggBookmarks
 */

$recext_guid = get_input('guid');
$recext = get_entity($recext_guid);

if (!elgg_instanceof($recext, 'object', 'recext') || !$recext->canEdit()) {
	register_error(elgg_echo('recext:unknown_recext'));
	forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('recext:edit');
elgg_push_breadcrumb($title);

$vars = recext_prepare_form_vars($recext);
$content = elgg_view_form('recext/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);