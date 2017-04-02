<?php
/**
 * Group Admin roles plugin language pack
 *
 */

$english = array(

	'roles_group_admins:role:title' => 'Group Administrator',
	'roles_group_admins:action:make_group_admin' => 'Grant Group Admin privileges',
	'roles_group_admins:action:revoke_group_admin' => 'Revoke Group Admin privileges',

	'roles_group_admins:action:make_group_admin:success' => 'Group Admin privilege was successfully granted for user %s',
	'roles_group_admins:action:make_group_admin:failure' => 'Could not grant Group Admin privilege to this user',
	'roles_group_admins:action:revoke_group_admin:success' => 'Group Admin privilege was successfully revoked for user %s',
	'roles_group_admins:action:revoke_group_admin:failure' => 'Could not revoke Group Admin privilege from this user',
	
);

add_translation("en", $english);
