<?php
/**
 * This class handles the sidebar tools_options for groups
 */

namespace ColdTrick\GroupTools;

class ToolsOptions {

	const SETTING_PREFIX = 'group_tools:tools_options:';
	/**
	 * Hide the members listing in the sidebar
	 *
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param array  $return_value current return value
	 * @param array  $params       supplied params
	 *
	 * @return void|array
	 */

	public static function blogprivate($hook, $type, $return_value, $params) {

		if (!is_array($params)) {
			return;
		}

		$group = elgg_extract('entity', $params);
		if (!($group instanceof \ElggGroup)) {
			return;
		}

		if ($group->canEdit()) {
			return;
		}

		if ($group->getPrivateSetting(self::SETTING_PREFIX . 'blogprivate') !== 'yes') {
			return;
		}

		return [];
	}
}
