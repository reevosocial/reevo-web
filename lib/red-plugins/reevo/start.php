<?php
/**
 * Reevo plugin for Elgg
 *
 * @author      hellekin <hellekin@cepheide.org>
 * @package     Elgg
 * @subpackage  Reevo
 * @homepage    http://code.reevo.org/elgg/reevo
 * @copyright   2013 Redes de Pares <info@redesdepares.org>
 * @license     COPYING, https://gnu.org/licences/agpl
 *
 * This file is part of the Reevo plugin for Elgg.
 *
 * Reevo is free software: you can redistribute it and/or
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

// Reevo Release (http://semver.org/)
define('REEVO_VERSION_MAJOR', 0);
define('REEVO_VERSION_MINOR', 1);
define('REEVO_VERSION_PATCH', 1);
define('REEVO_VERSION_EXTRA', NULL);

elgg_register_event_handler('init','system','reevo_init');

/**
 * reevo_init -- Initialize Reevo plugin
 *
 * @return Void
 */
function reevo_init() {


	// Redirect requests to /w to the wiki
	elgg_register_plugin_hook_handler('route', 'w', 'reevo_hook_route_w');
	// Override ElggWikiPage URL
	elgg_register_plugin_hook_handler('entity:url', 'object', 'reevo_wiki_page_url');

	// Integrate MW preferences to Account Settings
	elgg_register_plugin_hook_handler('usersettings:save', 'user', 'reevo_usersettings_save');


	elgg_register_plugin_hook_handler('output:before', 'page', 'reevo_body_this');

}

function reevo_body_this($hook, $type, $value, $params) {

	$value['body_attrs'] = array('about' => 'this');
	return $value;
}


/**
 * reevo_hook_route_w -- Redirect to the wiki from /w/*
 *
 * @hook Plugin route, w
 *
 * @param String $hook	 always route
 * @param String $type	 always w
 * @param Mixed	 $value	 default forward URL
 * @param Mixed	 $params current URL and forward URL
 * @return Void (redirects)
 */
function reevo_hook_route_w($hook, $type, $return, $params) {

	$wiki_url = elgg_get_plugin_setting('wiki_url', 'reevo');
	$path     = implode('/', $return['segments']);

	forward("$wiki_url$path");

}

function reevo_elgg_host() {

    $host = parse_url(elgg_get_site_url(), PHP_URL_HOST);
    $host = explode('.', $host);

    return $host[0];
}

function reevo_wiki_host() {

    $host = parse_url(elgg_get_plugin_setting('wiki_url'), PHP_URL_HOST);
    $host = explode('.', $host);

    return $host[0];
}

/**
 * Override the wiki page URL
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string
 */
function reevo_wiki_page_url($hook, $type, $url, $params) {
    $entity = $params['entity'];
    if (elgg_instanceof($entity, 'object', 'wiki_page')) {
        return 'w/' . $entity->title;
    }
}

/**
 * reevo_hook_usersettings_save -- Save MW preferences as well
 *
 * See also the form/account/settings view
 *
 * @hook Plugin usersettings:save, user
 *
 * @param String $hook	 always usersettings:save
 * @param String $type	 always user
 * @param Mixed	 $value	 return value
 * @param Mixed	 $params user entity
 * @return $value
 */
function reevo_hook_usersettings_save($hook, $type, $value, $params) {
	 
}
