<?php

if (elgg_get_context() == 'profile' && $vars['size'] == 'large') {

	if ($guid = $vars['entity']->badges_badge) {
		$badge = get_entity($guid);

		if (is_object($badge)) {
		
			$html = '<div class="badges_profile mtm"><span>' . elgg_echo('badges:badge:upper');
			if ($badge->badges_url) {
				$html .= '<a href="' . $badge->badges_url . '">';
			}

			$html .= '<img title="' . $badge->title . '" src="' . elgg_add_action_tokens_to_url(elgg_get_site_url() . 'action/badges/view?file_guid=' . $guid) . '">';

			if ($badge->badges_url) {
				$html .= '</a>';
			}

			if ((int)elgg_get_plugin_setting('show_description', 'elggx_badges')) {
				$html .= '<div class="elgg-subtext">' . $badge->description . '</div>';
			}
			$html .= '</span></div>';
			
			echo $html;
		}
	}
}
