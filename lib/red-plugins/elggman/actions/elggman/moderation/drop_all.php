<?php

$user_guid = elgg_get_logged_in_user_guid();

$group_guid = get_input('guid');

// delete all moderated_discussion for this group.
if ($group_guid && can_edit_entity($group_guid, $user_guid)) {
	$options = array(
			'type' => 'object',
			'subtype' => 'moderated_discussion',
			'container_guid' => $group_guid,
			);
	$entities = elgg_get_entities($options);
	foreach($entities as $entity) {
		$entity->delete();
	}
	system_message(elgg_echo('elggman:moderation:drop_all:ok'));
}
else {
	system_message(elgg_echo('elggman:moderation:fail'));
}

forward('elggman/moderate/' . $group_guid);
