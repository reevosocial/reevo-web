<?php

elgg_register_event_handler('init','system','reevo_phpsfp_init');

function reevo_phpsfp_init() {
  $root = dirname(__FILE__);
	$action_path = "$root/actions";

  elgg_register_plugin_hook_handler('register', 'menu:entity', 'reevo_phpsfp_register_menu_item');
  elgg_register_action('phpsfp/redirect',"$action_path/redirect.php", 'admin');

}

function reevo_phpsfp_register_menu_item($hook, $entity_type, $returnvalue, $params) {

	$entity = elgg_extract('entity', $params);

	// if (!($entity->getSubtype() == 'recext')) {
	// 	return;
	// }

	// only published blogs
	if ($entity->status === 'draft') {
		return;
	}

	if (!elgg_in_context('widgets') && elgg_is_admin_logged_in()) {

		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'reevo_phpsfp_share',
			'text' => empty($entity->phpsfp) ? elgg_echo('phpsfp:share') : elgg_echo('phpsfp:shareagain'),
			'href' => "action/phpsfp/redirect?guid={$entity->getGUID()}&metadata=phpsfp",
			// 'item_class' => empty($entity->phpsfp) ? '' : 'hidden',
			'is_action' => true,
			'priority' => 175,
      'target' => '_blank'
		]);
	}
	return $returnvalue;
}

?>
