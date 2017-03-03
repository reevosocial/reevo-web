<?php
/**
 * Activate Reevo plugin
 *
 * @package     Elgg
 * @subpackage  Reevo
 *
 * Copyright 2013 Redes de Pares <info@redesdepares.org>
 *
 * This file is part of the Reevo plugin for Elgg.
 *
 * Reevo is free software: you can redistribute it and/or modify it
 * under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * Reevo is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

// Set $wiki_url unless it is already set
$wiki_url = elgg_get_plugin_setting('wiki_url', 'reevo', FALSE);
if (!isset($wiki_url)) {
    // Use 'wiki' as the default hostname for Mediawiki
    $wiki_url = str_replace(reevo_elgg_host(), 'wiki', elgg_get_site_url());
    elgg_set_plugin_setting('wiki_url', $wiki_url, 'reevo');
}
