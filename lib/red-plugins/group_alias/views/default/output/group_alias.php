<?php
/**
 * GroupAlias output
 *
 * - Only show in the Group Profile
 * - If linkup is available, hint about the syntax
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

if ('group_profile' != elgg_get_context()) {

    return false;

}

$alias = htmlspecialchars($vars['value'], ENT_QUOTES, 'UTF-8', false);
$target_url = elgg_get_config('url') . "g/$alias";

if (elgg_is_active_plugin('linkup')) {

    $hint = elgg_echo('linkup:hint:group', array($alias, $target_url));

} else {

    $hint = $target_url;

}

echo "<span title=\"$hint\">$alias </span><span title=\"$hint\" class=\"elgg-icon elgg-icon-info\"></span>";
