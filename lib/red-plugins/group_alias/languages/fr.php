<?php
/**
 * GroupAlias -- Translation strings for French
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
	'groups:alias' => 'Alias du groupe',
	'groups:alias:already_taken' => 'Cet alias est déjà utilisé par un autre groupe',
	'groups:alias:registration:usernametooshort' => "L'alias du groupe doit compter au-moins %u caractères.",
	'groups:alias:registration:usernametoolong' => "L'alias du groupe est trop long. Il ne doit pas dépasser %u caractères.",
	'groups:alias:registration:invalidchars' => "Pardon, l'alias du groupe contient le caractère %s qui est invalide. Les caractères suivants sont invalides : %s",
	'groups:alias:registration:invalidctrlchars' => "Pardon, l'alias du groupe contient des caractères de contrôle ou invisibles.",
	'groups:alias:changeable' => "Permettre le changement de l'alias d'un groupe ?",
	'groups:alias:changeable:may_break_urls' => "Attention : cela peut conduire à des URLs invalides lorsque l'alias d'un groupe est déjà bien établi.",

);

add_translation('fr', $language);
