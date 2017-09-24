<?php
/**
 * Set notification settings of group members
 */

$user = elgg_get_logged_in_user_entity();

if (empty($user) || !$user->isAdmin()) {
	// only site admins can do this
	return;
}

$group = elgg_extract('entity', $vars);
if (!($group instanceof ElggGroup)) {
	return;
}

// start building content
$title = elgg_echo('group_tools:tools_options:title');

$prefix = \ColdTrick\GroupTools\ToolsOptions::SETTING_PREFIX;

$form_body = elgg_format_element('div', ['class' => 'elgg-quiet'], elgg_echo('group_tools:tools_options:description'));


// hide group search
$form_body .= elgg_view_field([
	'#type' => 'checkbox',
	'#label' => elgg_echo('group_tools:tools_options:blog'),
	'#help' => elgg_echo('group_tools:tools_options:blog:explain'),
	'name' => 'blogprivate',
	'value' => 'yes',
	'default' => 'no',
	'checked' => ($group->getPrivateSetting("{$prefix}blogprivate") === 'yes'),
]);


// footer buttons
$footer = elgg_view('input/hidden', ['name' => 'group_guid', 'value' => $group->getGUID()]);
$footer .= elgg_view('input/submit', ['value' => elgg_echo('save')]);

$form_body .= elgg_format_element('div', ['class' => 'elgg-foot'], $footer);

// make body
$body = elgg_view('input/form', [
	'action' => 'action/group_tools/tools_options',
	'body' => $form_body,
]);

// show body
echo elgg_view_module('info', $title, $body);
