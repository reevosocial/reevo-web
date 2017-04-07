<?php
/**
 * Group Alias plugin settings
 *
 * @package        Lorea
 * @subpackage     GroupAlias
 *
 * Copyright 2011-2013 Lorea Faeries <federation@lorea.org>
 *
 * This file is part of the GroupAlias plugin for Elgg.
 *
 * GroupAlias is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License
 * as published by the Free Software Foundation, either version 3 of
 * the License, or (at your option) any later version.
 *
 * GroupAlias is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

// set default value
if (!isset($vars['entity']->changeable_group_alias)) {
	$vars['entity']->changeable_group_alias = 'no';
}

echo '<div>';
echo elgg_echo('groups:alias:changeable');
echo ' ';
echo elgg_view('input/select', array(
	'name' => 'params[changeable_group_alias]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->changeable_group_alias,
));
echo '<p class="tip">';
echo elgg_echo('groups:alias:changeable:may_break_urls');
echo '</p>';
echo '</div>';
