<?php
/**
 * Reevo Setup Extension for Mediawiki
 *
 * Copyright 2013 Hellekin <hellekin@cepheide.org>
 *
 */

if( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is a Mediawiki extension, not a valid entry point.' );
}

define( 'REEVO_VERSION', '0.2.0' );

/**
 * Credits
 */
$wgExtensionCredits['other'][] = array(
	'path'			 => __FILE__,
	'name'			 => 'Reevo',
	'description'	 => 'Does Mediawiki integration for Reevo.org.',
	'descriptionmsg' => 'reevo-desc',
	'version'		 => REEVO_VERSION,
	'author'		 => 'Hellekin',
	'url'			 => 'http://code.reevo.org/doc/mediawiki-extensions/Reevo',
);

/**
 * Force cookie domain
 */
function wfForceCookieDomain() {
	global $wgCookieDomain;

	$wgCookieDomain = explode( '.', $_SERVER['HTTP_HOST'] );
	array_shift( $wgCookieDomain ); // Drop the left-most label
	$wgCookieDomain = '.' . implode( '.', $wgCookieDomain );

}
wfForceCookieDomain();

/**
 * Use Elgg Integration
 *
 * The ElggIntegration extension provides hooks for Mediawiki
 * to integrate seamlessly with an Elgg instance on the same domain.
 */
require_once("$IP/extensions/ElggIntegration/ElggIntegration.php");

/**
 * Use ReevoSkin when available
 */
if ( is_dir( "$IP/skins/reevo" ) ) {
//	require_once("$IP/skins/reevo/ReevoSkin.php");
//	$wgDefaultSkin = "reevo";
	// Disable some skins
	$wgSkipSkins[] = 'chick';
	$wgSkipSkins[] = 'cologneblue';
	$wgSkipSkins[] = 'modern';
	$wgSkipSkins[] = 'monobook';
	$wgSkipSkins[] = 'myskin';
	$wgSkipSkins[] = 'nostalgia';
	$wgSkipSkins[] = 'simple';
	$wgSkipSkins[] = 'standard';
	$wgSkipSkins[] = 'vector';
} else {

	// Use beta skin
//	require_once( "$IP/skins/wiki-theme/reevo-mediawiki.php" );
//	$wgDefaultSkin = "reevomediawiki";
//	$wgTOCLocation = 'sidebar';

}

/**
 * Development Setup
 *
 * @todo: make it conditional to the environment (dev/prod)
 */

// Debug
$wgShowExceptionDetails     = true;

// Prevent caching
$wgUseFileCache             = false; 

$wgHtml5                    = true;          // Now default
$wgWellFormedXml            = false;         // Cleaner code, not HTML5-compliant
$wgAllowMicrodataAttributes = true;          // Microformats FTW
$wgUseInstantCommons        = true;          // Integrate Wikimedia Commons

// Internationalization
$wgExtensionMessagesFiles['Reevo'] = __DIR__ . '/Reevo.i18n.php';

// Autoload classes
$wgAutoloadClasses['ReevoHooks'] = __DIR__ . '/Reevo.hooks.php';

// Remove Talk pages
// - see server config to remove/redirect Talk URLs
$wgDisableAnonTalk = true;               // - disable anontalk
$wgShowIPinHeader  = false;              // - remove "Talk for this IP"
for ($i = 1;$i < 12; $i += 2) {          // - make Talk pages readonly
	$wgNamespaceProtection[$i] = 'noedit';
}

$wgHooks['SkinTemplateNavigation'][] = 'ReevoHooks::onSkinTemplateNavigation';
//	$wgHooks['PersonalUrls'][]           = 'ReevoHooks::onPersonalUrls';

/**
 * Override preferences mechanisms
 */
$wgHooks['UserLoadOptions'][]       = 'ReevoHooks::onUserLoadOptions';
$wgHooks['UserSaveOptions'][]       = 'ReevoHooks::onUserSaveOptions';
$wgHooks['PreferencesFormSubmit'][] = 'ReevoHooks::onPreferencesFormSubmit';
/* Register this as late as possible!
$wgExtensionFunctions[] = function() {
   global $wgHooks;
   $wgHooks['GetPreferences'][] = 'ReevoHooks::onGetPreferences';
} */
