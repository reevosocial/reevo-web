<?php
/**
 * GroupAlias -- Translation strings for Spanish
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
	'groups:alias' => 'Alias del grupo',
	'groups:alias:already_taken' => 'El alias del grupo ya está cogido',
	'groups:alias:registration:usernametooshort' => 'El alias del grupo debe tener menos de %u carácteres.',
	'groups:alias:registration:usernametoolong' => "El alias del grupo es demasiado largo. Como máximo puede tener %u carácteres.",
	'groups:alias:registration:invalidchars' => "Perdona, el alias del grupo contiene el carácter %s que es inválido. Los carácteres siguientes son inválidos: %s",
	'groups:alias:registration:invalidctrlchars' => "Perdona, el alias del grupo contiene carácteres de control, o invisibles.",
	'groups:alias:changeable' => "Permitir cambiar el alias de un grupo",
	'groups:alias:changeable:may_break_urls' => 'Advertencia: esto puede llevar a URLs rotos cuando el alias está bien establecido.',
);

add_translation('es', $language);
