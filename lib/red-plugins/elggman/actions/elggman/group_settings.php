<?php

$user = elgg_get_logged_in_user_entity();
$group_guid = (int)get_input('guid', 0);
$group = get_entity($group_guid);
$moderate = get_input('moderate');

error_log("SAVE $moderate");

if ($user && $group && $group->canEdit($user->guid)) {
	error_log("SAVE $moderate:");
	if ($moderate == 'on') {
		$group->elggman_moderate = true;
	}
	else {
		$group->elggman_moderate = false;
	}
}

forward(REFERRER);
