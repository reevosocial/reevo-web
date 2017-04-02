<?php
/**
 * List most recent recext on group profile page
 *
 * @package Bookmarks
 */

$group = elgg_get_page_owner_entity();

if ($group->recext_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "recext/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'recext',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
	'no_results' => elgg_echo('recext:none'),
	'distinct' => false,
);
$content = elgg_list_entities($options);
elgg_pop_context();

$new_link = elgg_view('output/url', array(
	'href' => "recext/add/$group->guid",
	'text' => elgg_echo('recext:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('recext:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
