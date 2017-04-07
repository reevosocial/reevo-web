<?php
/**
 * Elgg recext plugin friends page
 *
 * @package ElggBookmarks
 */

$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('', '404');
}

elgg_push_breadcrumb($page_owner->name, "recext/owner/$page_owner->username");
elgg_push_breadcrumb(elgg_echo('friends'));

elgg_register_title_button();

$title = elgg_echo('recext:friends');

$content = elgg_list_entities_from_relationship(array(
	'type' => 'object',
	'subtype' => 'recext',
	'full_view' => false,
	'relationship' => 'friend',
	'relationship_guid' => $page_owner->guid,
	'relationship_join_on' => 'container_guid',
	'no_results' => elgg_echo('recext:none'),
	'preload_owners' => true,
	'preload_containers' => true,
));

$params = array(
	'filter_context' => 'friends',
	'content' => $content,
	'title' => $title,
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
