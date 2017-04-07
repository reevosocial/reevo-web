<?php
/**
 * ElggIntegration extension to Mediawiki.
 *
 * @file
 * @ingroup Extensions
 *
 * Copyright 2013 Redes de Pares <peervox@redesdepares.org>
 *
 * This program is free software: you can redistribute it and/or
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

if( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is a Mediawiki extension, not a valid entry point.' );
}

define( 'ELGGINTEGRATION_VERSION', '0.1.0' );

/**
 * Add extension information to Special:Version
 */
$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'Elgg Integration Extension',
	'description'    => 'Make Mediawiki work for Elgg',
	'descriptionmsg' => 'elggintegration-desc',
	'version'        => ELGGINTEGRATION_VERSION,
	'author'         => 'Hellekin',
	'url'            => 'http://src.peervox.org/mediawiki-extensions/ElggIntegration',
);

// Ensure cookie is set

if ( !isset($wgCookieDomain) ) {

	error_log(" \$wgCookieDomain is not yet set! ");

}


/**
 * Load the Elgg engine
 */

// FIXME: Esto deberia definirse en la LocalSettings.php
define( 'ELGG_PATH', '/srv/reevo-web/www/red' );
// Be a barbarian: run both apps jointly
require_once ( ELGG_PATH . "/vendor/elgg/elgg/engine/start.php" );

// @todo: get it from Elgg config
// Web server sub-domain for the Elgg
define( 'HOST_ELGG', 'red' );
// Web server sub-domain for the maps
define( 'HOST_MAPS', 'mapa' );
// Web server sub-domain for the wiki
define( 'HOST_WIKI', 'wiki' );

/**
 * Configuration Variables
 *
 */

$wgElggConfig = array();

$wgElggConfig['login_url']  = elgg_get_site_url() . '/login';
$wgElggConfig['logout_url'] = elgg_get_site_url();
$wgElggConfig['maps_url']   =
	str_replace( HOST_ELGG,  HOST_MAPS, elgg_get_site_url() );
$wgElggConfig['wiki_url']   =
	str_replace( HOST_ELGG, HOST_WIKI, elgg_get_site_url() );

/**
 * Extension Files
 */

if (!defined("__DIR__")) {
    define("__DIR__", realpath(dirname(__FILE__)));
}

$wgExtensionMessagesFiles['ElggIntegration'] = __DIR__ . "/ElggIntegration.i18n.php";
$wgAutoloadClasses['ElggIntegrationHooks']   = __DIR__ . "/ElggIntegration.hooks.php";
$wgAutoloadClasses['ElggAuth']               = __DIR__ . "/ElggAuth.php";

// Special functions

/**
 * Display link to ElggUser profile
 *
 * @param $username
 * @param $size
 * @return String
 */
function avatar_link( $username, $size = 'tiny' ) {

	$user   = get_user_by_username( $username );

	if ( !elgg_instanceof($user, 'user') ) {
		return false;
	}

	$icon = elgg_get_site_url() . ( $user->icontime
		? "avatar/view/$user->username/$size/$user->icontime"
		: "_graphics/icons/user/default{$size}.gif" );

	$href   = elgg_get_site_url() . "profile/$user->username";
	$anchor = Html::element( 'img', array( 'src' => $icon, 'alt' => $user->name ) );

	return Html::rawElement( 'a', array( 'href' => $href ), $anchor );

}

// Allow the {{#avatar:}} WikiText extension
$wgHooks['ParserFirstCallInit'][]    = 'ElggIntegrationHooks::parseAvatarSetup';

// Allow the {{#group:}} WikiText extension
$wgHooks['ParserFirstCallInit'][]    = 'ElggIntegrationHooks::parseGroupLinkSetup';

// Allow the {{#group_activity:}} WikiText extension
$wgHooks['ParserFirstCallInit'][]    = 'ElggIntegrationHooks::parseGroupActivitySetup';

// Link to the Elgg profile
$wgHooks['PersonalUrls'][]           = 'ElggIntegrationHooks::onPersonalUrls';

// Send RecentChanges to Elgg
$wgHooks['RecentChange_save'][]      = 'ElggIntegrationHooks::onRecentChange_save';

// Remove Talk pages
$wgDisableAnonTalk = true;
$wgShowIPinHeader  = false;
for ( $i = 1; $i < 12; $i += 2 ) {
	$wgNamespaceProtection[$i] = 'noedit';
}
$wgHooks['SkinTemplateNavigation'][] = 'ElggIntegrationHooks::onSkinTemplateNavigation';

// Allow authentication from Elgg
$wgAuth = new ElggAuth();
