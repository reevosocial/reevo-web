<?php
/**
 * Elgg Group Alias
 *
 * @package        Lorea
 * @subpackage     GroupAlias
 * @homepage       http://lorea.org/plugin/group_alias
 * @copyright      2011-2012 Lorea Faeries <federation@lorea.org>
 * @license        COPYING, http://www.gnu.org/licenses/agpl
 *
 * Copyright 2011-2013 Lorea Faeries <federation@lorea.org>
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License
 * as published by the Free Software Foundation, either version 3 of
 * the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

elgg_register_event_handler('init', 'system', 'group_alias_init');

/**
 * Initialize the group alias plugin.
 *
 */
function group_alias_init() {

	// Register group alias library
	$library_path = elgg_get_plugins_path() . 'group_alias/lib/group_alias.php';
	elgg_register_library('elgg:group_alias', $library_path);

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('g', 'group_alias_page_handler');

	// Override URL handlers for groups
	if (function_exists('elgg_get_version') && version_compare(elgg_get_version(true), '1.9', '>')) {
		elgg_register_plugin_hook_handler('entity:url', 'group', 'group_alias_hook_entity_url');
	} else {
		elgg_register_entity_url_handler('group', 'all', 'group_alias_url');
	}

	// Add alias field
	elgg_register_plugin_hook_handler('profile:fields', 'group', 'group_alias_fields_setup');

	// Override groups/edit action
	$action_base = elgg_get_plugins_path() . 'group_alias/actions/groups';
	elgg_register_action("groups/edit", "$action_base/edit.php");

	// Extend the main css view
	elgg_extend_view('css/elgg', 'group_alias/css');
	elgg_extend_view('js/elgg', 'group_alias/js');

	// Register tests
	elgg_register_plugin_hook_handler('unit_test', 'system', 'group_alias_test');
	elgg_register_event_handler('upgrade', 'system', 'group_alias_run_upgrades');

}

function group_alias_run_upgrades() {
	$upgrade_tools = elgg_get_plugins_path() . 'upgrade-tools/lib/upgrade_tools.php';
	if (file_exists($upgrade_tools) && include_once($upgrade_tools)) {
		upgrade_module_run('group_alias');
	}
}


function group_alias_test($hook, $type, $value, $params) {
	$value[] = elgg_get_config('pluginspath') . "group_alias/tests/group_alias_test.php";
	return $value;
}

function get_group_from_group_alias($alias){
	return current(elgg_get_entities_from_metadata(array(
		'type' => 'group',
		'metadata_name' => 'alias',
		'metadata_value' => $alias,
		'limit' => 1,
	)));
}

/**
 * Dispatcher for group alias.
 * URLs take the form of
 *  All groups:       g/
 *  Group profile:    g/<alias>
 *  Group Tools:      g/<alias>/<handler> => <handler>/group/<guid>
 *
 * @param array $page
 * @return bool
 */
function group_alias_page_handler($page) {

	elgg_set_context('groups');

	if (!isset($page[0])) {
		groups_page_handler(array('all'), 'groups');
		return true;
	}

	$group = get_group_from_group_alias(str_replace(' ', '+', urldecode($page[0])));

	if($group && !isset($page[1])){
		groups_page_handler(array('profile', $group->guid));

	} elseif($group && isset($page[1])) {
		forward("$page[1]/group/$group->guid");

	} else {
		return groups_page_handler($page);
	}

	return true;
}

function group_alias_fields_setup($hook, $type, $return, $params) {
	return array_merge($return, array('alias' => 'group_alias'));
}

function group_alias_from_name($group) {

	$alias = elgg_get_friendly_title($group->name);
	$alias = preg_replace("/-/", "_", $alias);
	$alias = urldecode($alias);

	return $alias;
}

/**
 * This is an event hook for create/update group to handle the alias
 * without overriding the groups/edit action.
 */
function group_alias_save_hook($event, $type, $entity) {

	$alias_from_name = group_alias_from_name($entity);
	$aliased_group   = get_group_from_group_alias($alias_from_name);

	// If the alias is already taken by another group, append GUID.
	if (elgg_instanceof($aliased_group, 'group')
		&& $aliased_group->guid != $entity->guid) {
		$entity->set('alias', "$alias_from_name$entity->guid");
		return TRUE;
	}
	// Force keeping default or existing alias if empty or not changeable
	if (empty($entity->alias) || !elgg_get_config('changeable_group_alias')) {
		$entity->set('alias', $alias_from_name);
	}

	return TRUE;
}

/**
 * Override the group url
 *
 * @param ElggObject $group Group object
 * @return string
 */
function group_alias_url($group) {
	if(!$group->alias){
		return groups_url($group);
	}
	return "g/$group->alias";
}

/**
 * group_alias_hook_entity_url -- Override group URL
 *
 * @since 1.9
 * @param String $hook   always entity:url
 * @param String $type   always group
 * @param String $url    return value
 * @param Array  $params contains entity
 */
function group_alias_hook_entity_url($hook, $type, $url, $params) {

	if ($hook != 'entity:url' || $type != 'group') {
		return $url;
	}

	$group = $params['entity'];

	if (!empty($group->alias)) {
		$url = "g/$group->alias";
	}

	return $url;

}

/**
 * Convert a group name to an alias if it does not exist already.
 * Return the newly, or existing group alias.
 *
 * @param ElggGroup $group Group object
 * @return string
 */
function group_alias_update_from_name($group) {
	if (!empty($group->alias)) {
		return $group->alias;
	}
	$alias = group_alias_from_name($group);
	// If alias is taken, append GUID
	$g = get_group_from_group_alias($alias);
	if (elgg_instanceof($g, 'group') && $g->guid != $group->guid) {
		$alias .= $group->guid;
	}
	$group->set('alias', $alias);

	return $alias;
}
