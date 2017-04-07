<?php

/**
 *
 * Group Administrators for Roles plugin
 *
 *
 * @author Andras Szepeshazi
 * @copyright Arck Interactive, LLC 2012
 * @link http://www.arckinteractive.com/
 */

elgg_register_event_handler('init', 'system', 'roles_group_admins_init');

function roles_group_admins_init() {

	elgg_register_plugin_hook_handler('roles:config', 'role', 'roles_group_admins_config', 600);

	$action_base_path = elgg_get_plugins_path() . 'roles_group_admins/actions/roles_group_admins';
	elgg_register_action("roles_group_admins/make_group_admin", "$action_base_path/make_group_admin.php");
	elgg_register_action("roles_group_admins/revoke_group_admin", "$action_base_path/revoke_group_admin.php");
}


function roles_group_admins_config($hook_name, $entity_type, $return_value, $params) {

	$roles = array(

		DEFAULT_ROLE => array(
			'title' => 'roles:role:DEFAULT_ROLE',
			'extends' => array(),
			'permissions' => array(
				'actions' => array(
					'groups/edit' => array('rule' => 'deny')
				),
				'pages' => array(
					'groups/add/{$self_guid}' => array('rule' => 'deny'),
				),
				'menus' => array(
					'title::add' => array(
						'rule' => 'deny',
						'context' => array('groups')
					),
					'page::groups:owned' => array(
						'rule' => 'deny',
						'context' => array('groups')
					)

				),
			),
		),

		'group_admins' => array(
			'title' => 'roles_group_admins:role:title',
			'permissions' => array(
			),
		),

		ADMIN_ROLE => array(
			'title' => 'roles:role:ADMIN_ROLE',
			'extends' => array(),
			'permissions' => array(
				'actions' => array(
				),
				'menus' => array(
				),
				'views' => array(
					'forms/account/settings' => array(
						'rule' => 'extend',
						'view_extension' => array(
							'view' => 'roles/settings/account/role',
							'priority' => 150
						)
					),
				),
				'hooks' => array(
					'usersettings:save::user' => array(
						'rule' => 'extend',
						'hook' => array(
							'handler' => 'roles_user_settings_save',
							'priority' => 500,
						)
					),
					'register::menu:user_hover' => array(
						'rule' => 'extend',
						'hook' => array(
							'handler' => 'group_admins_user_menu_setup',
							'priority' => 500,
						)
					,)
				),
			),
		),
	);

	if (!is_array($return_value)) {
		return $roles;
	} else {
		return array_merge($return_value, $roles);
	}
}



/**
 *
 * Adds a new item to the user hover menu
 * The new item will be "Grant Group Admin priviliges" for members with default role, and "Revoke Group Admin privileges" for
 * members of the Group Administrator role
 *
 * @param string $hook Equals "register" for this hook handler
 * @param string $type Equals "menu:user_hover"
 * @param array $return The already registered menu items for the user hover menu. Contains the user entity whose hover menu is being constructed.
 * @param mixed $params An associative array of parameteres passed by the hook trigger
 *
 * @return array The full user hover menu items array extended with the new item
 */
function group_admins_user_menu_setup($hook, $type, $return, $params) {

	// Make sure we have a logged-in user, who is not an admin
	$user = $params['entity'];
	if (!elgg_instanceof($user, 'user') || $user->isAdmin()) {
		return $return;
	}

	$role = roles_get_role($user);
	if ($role->name == 'group_admins') {
		$action = 'revoke_group_admin';
	} else {
		$action = 'make_group_admin';
	}

	$url = "action/roles_group_admins/$action?guid={$user->guid}";
	$url = elgg_add_action_tokens_to_url($url);
	$item = new ElggMenuItem($action, elgg_echo("roles_group_admins:action:$action"), $url);
	$item->setSection('admin');
	$item->setLinkClass('data-confirm');

	$return[] = $item;

	return $return;
}
