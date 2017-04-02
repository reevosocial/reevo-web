<?php
/**
 * ElggIntegration AuthPlugin. Authenticate from an Elgg session.
 *
 * @file
 * @ingroup Extensions
 *
 * Copyright 2013 Redes de Pares <peervox@redesdepares.org>
 *
 * This file is part of the ElggIntegration MediaWiki extension.
 *
 */

class ElggAuth extends AuthPlugin {

	public function __construct() {
		// Disable MW account creation
		global $wgGroupPermissions;
		$wgGroupPermissions['*']['createaccount'] = false;
		// Disable edition unless authorized
		$wgGroupPermissions['*']['edit']          = false;

		// Set hooks
		global $wgHooks;
		$wgHooks['UserLoadFromSession'][] = $this;
		$wgHooks['UserLogout'][]          = $this;

	}

	public function userExists( $username ) {
		return true;
	}

	public function autoCreate() {
		return true;
	}

	public function allowPasswordChange() {
		return false;
	}

	public function allowSetLocalPassword() {
		return false;
	}

	public function strict() {
		return true;
	}

	public function getCanonicalName( $username ) {
		return ucfirst( str_replace( ' ', '_', $username ) );
	}

	public function onUserLoadFromSession( $user, &$result ) {
		global $wgElggConfig, $wgLanguageCode, $wgRequest, $wgOut;
		$lg = Language::factory($wgLanguageCode);
		$ck = elgg_get_config('cookies');

		if ( isset($_REQUEST['title'])
			&& strstr( $_REQUEST['title'], $lg->specialPage('Userlogin') )) {

			// Redirect to Elgg's login page
			$returnto  = $wgRequest->getVal('returnto');
		
	// Don't redirect straight back to the logout page
			if ( strstr( $returnto, $lg->specialPage( 'Userlogout' ) ) ) {
				$returnto = '';
			}
			$_SESSION['last_forward_url'] = $wgElggConfig['wiki_url'] . $returnto;

			$wgOut->redirect( $wgElggConfig['login_url'] );
		}
		else if ( array_key_exists( $ck['session']['name'], $_COOKIE ) ) {

			//		if ( $user->isLoggedIn() ) {
			//			error_log("== onUserLoadFromSession: user already logged in." );
			//			return true;
			//		}

			if ( !elgg_is_logged_in() ) {
//				error_log("== onUserLoadFromSession: Elgg cookie present, but user not logged in." );
				return false;
			}

			$elgg_user = elgg_get_logged_in_user_entity();
			if ( !elgg_instanceof($elgg_user, 'user') ) {
//				error_log("== onUserLoadFromSession: not an ElggUser!");
				return false;
			}

			// Clear Elgg's login system message
			unset($_SESSION['msg']['success']);

//			error_log("== onUserLoadFromSession: Elgg user $elgg_user->username");

			// Try and read local user

			$dbr = wfGetDB(DB_SLAVE);
			$uid = $dbr->selectField(
				'external_user',
				'eu_local_id',
				array( 'eu_external_id' => $elgg_user->guid )
			);

			$local_id = ($uid) ? $uid : 0;
			$username = $this->getCanonicalName( $elgg_user->username );

			if ( !$uid ) {
//				error_log("== onUserLoadFromSession: creating local user for GUID $elgg_user->guid with $username");
				$user = User::newFromName( $username );
				if ( $user->getID() == 0 ) {
					error_log("== onUserLoadFromSession: confirmed that no local user exists with this username.");
					if ( ElggAuth::autoCreate() ) {
						error_log("== onUserLoadFromSession: creating user.");
						$user->setEmail( $elgg_user->email );
						$user->confirmEmail();
						$user->addToDatabase();
						$user->setToken();
					}
				} else {
//					error_log("== onUserLoadFromSession: USERNAME $username IS ALREADY TAKEN!");
				}
				// Update database
				$local_id = $user->getId();
				$dbw      = wfGetDB( DB_MASTER );
				$dbw->insert(
					'external_user',
					array(
						'eu_external_id' => $elgg_user->guid,
						'eu_local_id'    => $local_id
					)
				);
			}
			if ( !isset( $local_id ) ) {
//				error_log("== onUserLoadFromSession: we already know $username...");
				$local_id = $user->getId();
			}
			$user->setID( $local_id );
			$user->loadFromId();
//			error_log("== onUserLoadFromSession: we loaded $username (GUID: $elgg_user->guid) from $local_id.");
//			error_log("== logged-in user: " . print_r( $user, true ) );
			$result = true; // stop authentication here
			$user->setCookies();
			wfSetupSession();

			return $result;

		} else {
//			error_log("== onUserLoadSession: no Elgg session found.");
			
		}

		return true;
	}

	function onUserLogout( &$user ) {
		global $wgElggConfig, $wgOut;
		// Logout from Elgg
		$result = logout();
		if ($result) {
			system_message(elgg_echo('logoutok'));
		} else {
			register_error(elgg_echo('logouterror'));
		}
		// Redirect to Elgg's logout page
		$wgOut->redirect( $wgElggConfig['logout_url'] );
		return true;
	}

}

class ElggAuthPluginUser extends AuthPluginUser {


}