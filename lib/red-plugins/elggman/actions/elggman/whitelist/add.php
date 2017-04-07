<?php

elgg_load_library('elggman');

$user = elgg_get_logged_in_user_entity();

$entity_guid = (int)get_input('guid');
$filter = get_input('filter');
$entity = get_entity($entity_guid);

$email = get_input('email');


if ($email && $entity instanceof ElggGroup && $entity->canEdit($user->guid)) {
	# from http://www.markussipila.info/pub/emailvalidator.php
	$normal = "^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$";
	$validButRare = "^[a-z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+(\.[a-z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,})$";
	if (eregi($normal, $email)) {
		$valid = true;
	}

	else if (eregi($validButRare, $email)) {
		$valid = true;
	}

	if ($valid) {
		$duplicate = elggman_email_in_filter($entity, $email, $filter);
		if ($duplicate) {
			register_error(elgg_echo("elggman:$filter:add:duplicate"));
		}
		else {
			create_annotation($entity_guid, $filter, $email, '', 0, $entity->group_acl);
			system_message(elgg_echo("elggman:$filter:add:ok"));
		}
	}
		
}

forward(REFERRER);
