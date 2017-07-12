<?php

elgg_make_sticky_form('notifications/editor/edit');

$guid = get_input('guid');
if ($guid) {
	$template = get_entity($guid);
} else {
	$site = elgg_get_site_entity();
	$template = new \hypeJunction\Notifications\Template();
	$template->owner_guid = $site->guid;
	$template->container_guid = $site->guid;
}

if (!$template || !$template->canEdit()) {
	register_error(elgg_echo('notifications:editor:noaccess'));
	forward(REFERRER);
}

$template->language = get_input('language');

$template->subject = htmlspecialchars(get_input('subject', $default, false), ENT_QUOTES, 'UTF-8');
$template->summary = get_input('summary', '', false);
$template->body = get_input('body', '', false);

$template->template = get_input('template');
if (!$template->template) {
	$template->event = get_input('event');
	$template->object_type = get_input('object_type');
	$template->object_subtype = get_input('object_subtype');
	$template->template = implode(':', array($template->event, $template->object_type, $template->object_subtype));
} else {
	list($event, $object_type, $object_subtype) = explode(':', $template->template);
	$template->event = $event;
	$template->object_type = $object_type;
	$template->object_subtype = $object_subtype;
}

$template->access_id = ACCESS_PUBLIC;

if ($template->save()) {
	elgg_clear_sticky_form('notifications/editor/edit');
	system_message(elgg_echo('notifications:editor:success'));
	forward($template->getURL());
} else {
	register_error(elgg_echo('notifications:editor:error'));
}