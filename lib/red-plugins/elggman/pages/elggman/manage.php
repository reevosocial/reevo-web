<?php
$guid = (int)get_input('guid');
$view = get_input('page');
$group = get_entity($guid);

$user_guid = elgg_get_logged_in_user_guid();

if (!$group instanceof ElggGroup || !$group->canEdit($user_guid)) {
	return;
}

elgg_push_breadcrumb(elgg_echo('discussion'));
elgg_push_breadcrumb($group->name, "discussion/owner/$group->guid");
elgg_push_breadcrumb(elgg_echo("elggman:manage"), 'elggman/manage/'.$group->guid);
if ($view != 'manage') {
	elgg_push_breadcrumb(elgg_echo("elggman:$view"));
}

elgg_set_page_owner_guid($guid);

$content = elgg_view("elggman/$view", array('entity' => $group));

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
	'filter' => '',
));

echo elgg_view_page($title, $body);
