<?php
/**
 *	Elgg No Friends
 *	@package nofriends
 *	@author RiverVanRain
 *	@license GNU General Public License version 2
 *	@link http://o.wzm.me/crewz/p/1983/personal-net
 **/

elgg_register_event_handler('init','system','nofriends_init');

function nofriends_init() {
    elgg_register_event_handler('pagesetup', 'system', 'nofriends_pagesetup', 1000);
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'nofriends_menu_handler', 999);
    elgg_register_plugin_hook_handler('register', 'menu:topbar', 'nofriends_menu_handler', 999);
	elgg_register_plugin_hook_handler('register', 'menu:page', 'nofriends_menu_handler', 999);
	elgg_register_plugin_hook_handler('register', 'menu:filter', 'nofriends_menu_handler', 999);
	elgg_register_plugin_hook_handler('access:collections:write', 'user', 'nofriends_write_access_handler');
	elgg_register_plugin_hook_handler('route', 'all', 'nofriends_route_handler');
	elgg_register_plugin_hook_handler('tabs', 'profile', 'nofriends_tabbed_profile_handler', 501);
	
	elgg_unregister_action('friends/add');
	elgg_unregister_action('friends/remove');
	elgg_unregister_action('friends/collections/add');
	elgg_unregister_action('friends/collections/delete');
	elgg_unregister_action('friends/collections/edit');
	elgg_unregister_action('groups/invite');
	elgg_unregister_action('invitefriends/invite');
	elgg_unregister_page_handler('friends', '_elgg_friends_page_handler');
	elgg_unregister_page_handler('friendsof', '_elgg_friends_page_handler');
	elgg_unregister_page_handler('collections', '_elgg_collections_page_handler');
	elgg_unregister_page_handler('invite', 'invitefriends_page_handler');
	elgg_unregister_widget_type('friends', elgg_echo('friends'), elgg_echo('friends:widget:description'));
	elgg_unregister_event_handler('pagesetup', 'system', '_elgg_friends_page_setup');
	elgg_unregister_event_handler('pagesetup', 'system', '_elgg_setup_collections_menu');
	elgg_unregister_plugin_hook_handler('register', 'menu:user_hover', '_elgg_friends_setup_user_hover_menu');
	elgg_unregister_plugin_hook_handler('register', 'user', 'invitefriends_add_friends');
	elgg_unregister_event_handler('create', 'friend', '_elgg_send_friend_notification');
	elgg_unregister_js('elgg.friendspicker', 'js/lib/ui.friends_picker.js');
	
	$action_base = elgg_get_plugins_path() . 'nofriends/actions/groups/membership';
	elgg_register_action('groups/invite', "$action_base/invite.php");
}

function nofriends_pagesetup() {
	elgg_unregister_menu_item('topbar', 'friends');
}

function nofriends_menu_handler($hook, $type, $value, $params) {
	$friends_items = array(
		'add_friend',
		'remove_friend',
		'friends',
		'friends:view:collections',
		'friends:of',
		'friend'
	);

	foreach ($value as $idx => $item) {
		if (in_array($item->getName(), $friends_items)) {
			unset($value[$idx]);
		}
	}

	return $value;
}

function nofriends_write_access_handler($hook, $type, $value, $params) {
	unset($value[ACCESS_FRIENDS]);
	return $value;
}

function nofriends_route_handler($hook, $type, $value, $params) {
	if (is_array($value['segments']) && ($value['segments'][0] == 'friends' || $value['segments'][1] == 'friends')) {
		forward('', 404);
	}
	return $value;
}

function nofriends_tabbed_profile_handler($hook, $type, $value, $params) {
	foreach ($value as $idx => $item) {
		if ($item == 'friends') {
			unset($value[$idx]);
		}
	}

	return $value;
}