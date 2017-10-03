<?php

$group_guids = get_input('group_guids');
$add_all_users = get_input('add_all_users');

if (!empty($group_guids)) {
	if (!is_array($group_guids)) {
		$group_guids = [$group_guids];
	}

	$group_guids = array_map(function($value) {
		return (int) $value;
	}, $group_guids);
}

if (empty($group_guids)) {
	elgg_unset_plugin_setting('auto_join', 'group_tools');
} else {
	elgg_set_plugin_setting('auto_join', implode(',', $group_guids), 'group_tools');
}

if (!empty($add_all_users)) {
	$allusers = elgg_get_entities(array('types'=>'user','limit' => false));
	foreach ($allusers as $key => $user) {
		$user->group_tools_check_auto_joins = true;
	}
}

return elgg_ok_response('', elgg_echo('save:success'));
