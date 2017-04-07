<?php
/**
 * GroupAlias -- Shared Library
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

/**
 * Simple function which ensures that a group alias contains only valid characters.
 *
 * This should only permit chars that are valid on the file system as well.
 *
 * @param string $alias Group alias
 *
 * @return bool
 * @throws RegistrationException on invalid
 */
function group_alias_validate($alias) {

	// Basic, check length
	$min_length = elgg_get_config('minusername', 4);
	if (strlen($alias) < $min_length) {
		$msg = elgg_echo('groups:alias:registration:usernametooshort', array($min_length));
		throw new RegistrationException($msg);
	}

	// username in the database has a limit of 128 characters
	if (strlen($alias) > 128) {
		$msg = elgg_echo('groups:alias:registration:usernametoolong', array(128));
		throw new RegistrationException($msg);
	}

	// Blacklist for bad characters (partially nicked from mediawiki)
	$blacklist = '/[' .
		'\x{0080}-\x{009f}' . // iso-8859-1 control chars
		'\x{00a0}' .          // non-breaking space
		'\x{2000}-\x{200f}' . // various whitespace
		'\x{2028}-\x{202f}' . // breaks and control chars
		'\x{3000}' .          // ideographic space
		'\x{e000}-\x{f8ff}' . // private use
		']/u';

	if (
		preg_match($blacklist, $alias)
	) {
		throw new RegistrationException(elgg_echo('groups:alias:registration:invalidctrlchars'));
	}

	// Belts and braces
	// @todo Tidy into main unicode
	//$blacklist2 = '\'/\\"*& ?#%^(){}[]~?<>;|¬`@-+=';
	$blacklist2 = '\'/\\"*& ?#%^(){}[]~?<>;|¬`=';

	for ($n = 0; $n < strlen($blacklist2); $n++) {
		if (strpos($alias, $blacklist2[$n]) !== false) {
			$msg = elgg_echo('groups:alias:registration:invalidchars', array($blacklist2[$n], $blacklist2));
			$msg = htmlentities($msg, ENT_COMPAT, 'UTF-8');
			throw new RegistrationException($msg);
		}
	}

	$result = true;
	return elgg_trigger_plugin_hook('group_alias:validate', 'all',
		array('alias' => $alias), $result);
}
