<?php

class ReevoHooks {

	public static function onPersonalUrls( array &$personal_urls, Title $title ) {

		// We add the avatar link in the skin
		unset( $personal_urls['userpage'] );

		return true;

	}

	public static function onPreferencesFormSubmit() {}

	public static function onSkinTemplateNavigation( $skin, &$links) {
		unset( $links['namespaces']['talk'] ); // Remove the talk action
		unset( $links['namespaces']['main'] ); // Remove the main action
		return true;

		$maintitle = Title::newFromText( wfMsgForContent( 'mainpage' ) );
		$links['namespaces']['main'] = array(
			'class' => false or 'selected', // if the tab should be highlighted
			'text' => wfMsg( 'sitetitle' ), // what the tab says
			'href' => $maintitle->getFullURL(), // where it links to
			'context' => 'main',
		);
	}

	public static function onUserLoadOptions() {
		return true;
	}

	public static function onUserSaveOptions() {
		return true;
	}

}