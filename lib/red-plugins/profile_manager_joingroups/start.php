<?php
/**
* Profile Manager Join Groups
*
* @package profile_manager
*/

elgg_extend_view('groups/sidebar/members', 'page/elements/info', 0);

elgg_register_event_handler('init', 'system', 'profile_manager_joingroups_init');
elgg_register_event_handler('init', 'system', 'profile_manager_redirect_init');

//elgg_register_plugin_hook_handler('forward', 'system', 'landing_hook_forward_system');


function profile_manager_joingroups_init() {
	// Listen to user registration
	elgg_register_event_handler('create', 'user', 'profile_manager_joingroups', 502);
}

function profile_manager_redirect_init() {
	// elgg_register_event_handler('login:forward', 'user', 'profile_manager_redirect', 502);
	elgg_register_event_handler('login', 'user', 'profile_manager_redirect');
}


function profile_manager_joingroups($event, $object_type, $object) {
	if (($object instanceof ElggUser) && ($event == 'create') && ($object_type == 'user')) {
		$groups = get_input('groups');
		$groups = split(',', $groups);
		//for each group ids
		foreach($groups as $groupName) {
			// checks if is group name is not the alias but the id
			if (is_numeric($groupName)) {
				$groupId = $groupName;
				error_log('es numerico');
			} else {
				$group = get_group_from_group_alias($groupName);
				$groupId = $group->guid;
				error_log('no es numerico, es '.$groupName.' su id es '. $groupId);
			};
			$ia = elgg_set_ignore_access(true);
			$groupEnt = get_entity($groupId);
			elgg_set_ignore_access($ia);
			//if group exist : submit to group
			if ($groupEnt) {
				//join group succeed?
				if ($groupEnt->join($object)) {
					// Remove any invite or join request flags
					elgg_delete_metadata(array('guid' => $object->guid, 'metadata_name' => 'group_invite', 'metadata_value' => $groupEnt->guid, 'limit' => false));
					elgg_delete_metadata(array('guid' => $object->guid, 'metadata_name' => 'group_join_request', 'metadata_value' => $groupEnt->guid, 'limit' => false));
				}
			}
		}
	}
}

function profile_manager_redirect($event, $object_type, $object) {
	$user = elgg_get_logged_in_user_guid();
	$user = get_user($user);

	$redirect = get_input('goto');
	if ($redirect) { // Si se especifica una URL con el parametro goto en el registro
		forward($redirect);
	} else {
		if($user->last_action == 0 && !elgg_is_admin_logged_in() && !elgg_in_context('profile_edit') && elgg_is_logged_in()) {
			// Si es la primerza vez que el usuario ingresa
			forward("/profile/{$user->username}/edit");
		}	else {
			$login = elgg_get_site_url().'login';
			$link = $_SERVER["HTTP_REFERER"];
			if ($link == $login || $link == elgg_get_site_url()) {
				// Si el usuario ya existe y se loguea desde el form de login o desde la portada, va a su pagina de perfil
				forward("/profile/{$user->username}");

			} else {
				// Si el usuario ya existe y se loguea desde el form tipo popup, vuelve a la pagina donde estaba
				forward($link);
			}
		}
	}


}
