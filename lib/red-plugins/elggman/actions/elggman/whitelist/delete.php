<?php

elgg_load_library('elggman');

$user = elgg_get_logged_in_user_entity();

$id = (int)get_input('id');
$filter = get_input('filter');

if (in_array($filter, array('whitelist', 'blacklist'))) {
	$annotation = elgg_get_annotation_from_id($id);

	$group = get_entity($annotation->entity_guid);

	if ($group && $group instanceof ElggGroup && $group->canEdit($user->guid) && $annotation->name == $filter) {
		system_message(elgg_echo("elggman:$filter:delete:ok"));
		elgg_delete_annotation_by_id($id);
	}
	else {
		register_error(elgg_echo("elggman:$filter:delete:fail"));
	}
}
else {
	register_error(elgg_echo("elggman:$filter:delete:fail"));
}

forward(REFERRER);
