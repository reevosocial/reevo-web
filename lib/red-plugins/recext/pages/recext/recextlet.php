<?php
/**
* Elgg recext plugin recextlet page
*
* @package Bookmarks
*/

elgg_gatekeeper();

$container_guid = get_input('container_guid');
if ($container_guid) {
	$container = get_entity($container_guid);
	$page_owner = $container;

	if (elgg_instanceof($container, 'object')) {
		$page_owner = $container->getContainerEntity();
	}
} else {
	$user = elgg_get_logged_in_user_guid();
	forward('recext/recextlet/'.$user);
}

elgg_set_page_owner_guid($page_owner->getGUID());

$title = elgg_echo('recext:recextlet');

if ($page_owner instanceof ElggGroup) {
	elgg_push_breadcrumb($page_owner->name, $page_owner->getURL());
}

elgg_push_breadcrumb($title);

$content = elgg_view("recext/bookmarklet");

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => false
));

echo elgg_view_page($title, $body);
