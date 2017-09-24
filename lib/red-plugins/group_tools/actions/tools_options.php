<?php

$group_guid = (int) get_input('group_guid');

elgg_entity_gatekeeper($group_guid, 'group');
$group = get_entity($group_guid);

if (!$group->canEdit()) {
	register_error(elgg_echo('actionunauthorized'));
	forward(REFERER);
}

// get input
$blogprivate = get_input('blogprivate');

error_log('### entro!!');

// save settings
$prefix = \ColdTrick\GroupTools\ToolsOptions::SETTING_PREFIX;

$group->setPrivateSetting("{$prefix}blogprivate", $blogprivate);

system_message(elgg_echo('group_tools:actions:tools_options:success'));
forward($group->getURL());
