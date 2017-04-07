<?php

$user_guid = elgg_get_logged_in_user_guid();

$entity_guid = get_input('guid');
$entity = get_entity($entity_guid);

$group_guid = $entity->container_guid;

if ($entity && can_edit_entity($group_guid, $user_guid)) {
	$entity->delete();
	system_message(elgg_echo('elggman:moderation:drop:ok'));
}
else {
	system_message(elgg_echo('elggman:moderation:fail'));
}

forward('elggman/moderate/' . $group_guid);
