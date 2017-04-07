<?php
/**
 * Group Admin roles plugin language pack
 *
 */

$danish = array(

	'roles_group_admins:role:title' => 'Gruppe administrator',
	'roles_group_admins:action:make_group_admin' => 'Giv administrator rettigheder',
	'roles_group_admins:action:revoke_group_admin' => 'Fjern administrator rettighederne',

	'roles_group_admins:action:make_group_admin:success' => 'Gruppe administrator rettighederne er godkendt for bruger %s',
	'roles_group_admins:action:make_group_admin:failure' => 'Kunne ikke give administrator rettigheder for bruger',
	'roles_group_admins:action:revoke_group_admin:success' => 'Gruppe administrator rettighederne er fjernet for bruger %s',
	'roles_group_admins:action:revoke_group_admin:failure' => 'Kunne ikke fjerne administrator rettigheder fra bruger',
	
);

add_translation("da", $danish);
