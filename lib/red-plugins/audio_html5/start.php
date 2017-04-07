<?php
/**
 * Audio HTML5 -- A simple audio file player
 *
 * @package        Lorea
 * @subpackage     AudioHTML5
 * @homepage       http://lorea.org/plugin/audio_html5
 * @copyright      2011-2013 Lorea Faeries <federation@lorea.org>
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

elgg_register_event_handler('init', 'system', 'audio_html5_init');

function audio_html5_init() {

	// File plugin do not get OGG files as audio, because its mime type is application/ogg. This will solve this inconvenience.
	elgg_register_plugin_hook_handler('file:simpletype', 'application/ogg', 'audio_html5_ogg_simpletype');
	elgg_register_plugin_hook_handler('file:icon:url', 'override', 'audio_html5_ogg_icon_url_override');

	elgg_extend_view('css/elgg', 'audio_html5/css');

}

function audio_html5_ogg_simpletype($hook, $type, $return, $params) {
	if ($type == "application/ogg") {
		return "audio";
	}
	return $return;
}

function audio_html5_ogg_icon_url_override($hook, $type, $return, $params) {
	if($params['entity']->mimetype == 'application/ogg') {
		if ($params['size'] == 'large') {
			$ext = '_lrg';
		} else {
			$ext = '';
		}
		$return = "mod/file/graphics/icons/music{$ext}.gif";
	}
	return $return;
}
