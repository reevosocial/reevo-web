<?php
/**
 * Reevo Plugin Settings
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

/**
 * String - URL to integrated Mediawiki
 */
$wiki_url       = elgg_get_plugin_setting('wiki_url', 'reevo');
$wiki_url_input = elgg_view('input/text',
	array(
		'name'  => 'params[wiki_url]',
		'value' => $wiki_url,
		'class' => 'wiki-url'
	)
);
$wiki_url_label = elgg_echo('reevo:settings:wiki_url:label');
$wiki_url_tip   = elgg_echo('reevo:settings:wiki_url:tip');

// General settings information
$settings_info = elgg_echo('reevo:settings:info');
$wiki_title    = elgg_echo('reevo:settings:wiki:title');

echo <<<___HTML

<div>
  <p class="tip">$settings_info</p>

  <fieldset>
    <h3>$wiki_title</h3>

    <p><label for="params[wiki_url]">$wiki_url_label</label>
       $wiki_url_input<br/><span class="tip">$wiki_url_tip</span></p>
  </fieldset>

</div>

___HTML;
