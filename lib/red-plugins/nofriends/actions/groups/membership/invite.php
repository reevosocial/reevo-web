<?php
/**
 *	Elgg No Friends
 *	@package nofriends
 *	@author RiverVanRain
 *	@license GNU General Public License version 2
 *	@link http://o.wzm.me/crewz/p/1983/personal-net
 **/
$logged_in_user = elgg_get_logged_in_user_entity();

$user_guids = get_input('members');
if (!is_array($user_guids)) {
	register_error(elgg_echo('nofriends:missingusers'));
	forward(REFERER);
}
$group_guid = get_input('group_guid');
$group = get_entity($group_guid);

if (count($user_guids) > 0 && elgg_instanceof($group, 'group') && $group->canEdit()) {
	foreach ($user_guids as $guid) {
		$user = get_user($guid);
		if (!$user) {
			continue;
		}

		if (check_entity_relationship($group->guid, 'invited', $user->guid)) {
			register_error(elgg_echo("groups:useralreadyinvited"));
			continue;
		}

		if (check_entity_relationship($user->guid, 'member', $group->guid)) {
			continue;
		}

		add_entity_relationship($group->guid, 'invited', $user->guid);

		$url = elgg_normalize_url("groups/invitations/$user->username");
		$result = notify_user($user->getGUID(), $group->owner_guid,
				elgg_echo('groups:invite:subject', array($user->name, $group->name)),
				elgg_echo('groups:invite:body', array(
					$user->name,
					$logged_in_user->name,
					$group->name,
					$url,
				)),
				NULL);
		if ($result) {
			system_message(elgg_echo("groups:userinvited"));
		} else {
			register_error(elgg_echo("groups:usernotinvited"));
		}
	}
}

forward(REFERER);
