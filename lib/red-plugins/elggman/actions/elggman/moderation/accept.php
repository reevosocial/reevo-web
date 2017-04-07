<?php

elgg_load_library('elggman');

$user_guid = elgg_get_logged_in_user_guid();

$entity_guid = get_input('guid');
$entity = get_entity($entity_guid);

$group_guid = $entity->container_guid;

if ($entity && can_edit_entity($group_guid, $user_guid)) {
	elggman_message_accept($entity);
	system_message(elgg_echo('elggman:moderation:accept:ok'));
}
else {
	system_message(elgg_echo('elggman:moderation:fail'));
}

forward('elggman/moderate/' . $group_guid);
