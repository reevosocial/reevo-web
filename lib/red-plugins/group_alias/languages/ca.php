<?php
/**
 * GroupAlias -- Translation strings for Catalan
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

$language = array (
	'groups:alias' => 'Àlies del grup',
	'groups:alias:already_taken' => 'Aquest àlies de grup ja apunta a un altre grup',
	'groups:alias:registration:usernametooshort' => "L'àlies del grup ha de tenir menys de %u caràcters.",
	'groups:alias:registration:usernametoolong' => "L'àlies del grup és massa llarg. Com a màxim pot tenir %u caràcters.",
	'groups:alias:registration:invalidchars' => "Perdona, l'àlies del grup conté el caràcter %s que és invàlid. Els caràcters sigüents són invàlids: %s",
	'groups:alias:registration:invalidctrlchars' => "Perdona, l'àlies del grup conté caràcteres de control, o invisibles.",
	'groups:alias:changeable' => "Permetre canviar l'àlies d'un grup?",
	'groups:alias:changeable:may_break_urls' => "Atenció: això pot portar a URL trencats quan l'àlies està ben establert.",

);

add_translation('ca', $language);
