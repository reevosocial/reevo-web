<?php
/**
 * GroupAlias -- Translation strings for English
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

$language = array(

	/**
	 * Menu items and titles
	 */
	'groups:alias' => "Group alias",
	'groups:alias:already_taken' => "This group alias is already pointing to another group",
	'groups:alias:registration:usernametooshort' => 'Group alias must be a minimum of %u characters long.',
	'groups:alias:registration:usernametoolong' => "Group alias is too long. It can have a maximum of %u characters.",
	'groups:alias:registration:invalidchars' => "Sorry, your group alias contains the character %s which is invalid. The following characters are invalid: %s",
	'groups:alias:registration:invalidctrlchars' => "Sorry, your group alias contains control or non-printable characters.",
	'groups:alias:changeable' => "Allow changing a group's alias?",
	'groups:alias:changeable:may_break_urls' => 'Warning: this can lead to broken URLs when the alias is well-established.',
);

add_translation('en', $language);
