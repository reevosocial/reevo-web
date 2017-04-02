<?php
/**
 * ElggIntegrationHooks
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

class ElggIntegrationHooks {

	public static function onPersonalUrls( array &$personal_urls, Title $title ) {

		// Remove talk page
		unset( $personal_urls['mytalk'] );

		// Add link to Elgg
		$personal_urls['elgg'] = array(
			'class'	=> false,
			'href'  => elgg_get_site_url(),
			'text'  => elgg_get_site_entity()->name 
		);

		if ( elgg_is_logged_in() ) {

			$user = elgg_get_logged_in_user_entity();

			// Delegate User preferences to Elgg
			$personal_urls['preferences']['href'] = elgg_get_site_url() . "settings/user/{$user->username}";

			// Only override user's URL if the Elgg profile plugin is active
			if ( !elgg_is_active_plugin('profile') ) {
				return true;
			}

			// Override URL to point to Elgg's user profile
			$personal_urls['userpage']['text'] = $user->name;
			$personal_urls['userpage']['href'] = elgg_get_site_url() . "profile/{$user->username}";

		}

		return true;

	}

    /**
     * Send RecentChanges to the Elgg Activity
     */
    public static function onRecentChange_save( $recentChange ) {

//		error_log("onRecentChange_save: ". print_r($recentChange, true));
        $type       = $recentChange->getAttribute('rc_type');

        if ( $recentChange->getAttribute('rc_minor') == 1
        || $recentChange->getAttribute('rc_bot') == 1) {
            // Do not notify Elgg
//			error_log("onRecentChange_save: log, minor or bot");
            return true;
        }

        $title      = $recentChange->getAttribute('rc_title');
        $namespace  = $recentChange->getAttribute('rc_namespace');

        $page = false;

        // Examine change to decide what to do
        switch($type) {
        case RC_NEW:
            // Create a new page
            $page = new ElggWikiPage();
            $page->title     = $title;
            $page->namespace = $namespace;
			$page->access_id = ACCESS_LOGGED_IN;
            $page->save();
			$action_type     = 'create';
//			error_log("onRecentChange_save: new page '$title'");
            break;

		case RC_LOG:
			if ($recentChange->getAttribute('rc_deleted') == 1) {
				$action_type = 'delete';
			} else {
				$action_type = $recentChange->getAttribute('rc_log_type');
			}
			break;

		case RC_EXTERNAL:
//			error_log("onRecentChange_save: EXTERNAL");
			break;

        default:
			$action_type = 'update';
        }

        if (!elgg_instanceof($page, 'object', 'wiki_page')) {

			$p = elgg_get_config('dbprefix');

            // Get or create the corresponding ElggWikiPage entity
            $options = array(
                'count'     => true,
                'type'      => 'object',
                'subtype'   => 'wiki_page',
                'limit'     => 1,
				'joins'	    => array("JOIN ${p}objects_entity eo ON e.guid = eo.guid"),
                'wheres'    => array(
                    "eo.title = '$title'",
                ),
            );

            if (1 == elgg_get_entities($options)) {
				error_log("onRecentChange_save: page exists");
	            $options['count'] = false;
				$page = elgg_get_entities($options)[0];
            }

			if (false === $page) {
                // Page does not exist yet
				error_log("onRecentChange_save: that's a new page '$title'");
                $page = new ElggWikiPage();
                $page->title     = $title;
                $page->namespace = $namespace;
				$page->access_id = ACCESS_LOGGED_IN;
                $page->save();
            } 
        }

        // If by now we don't have a page, bail out
        if (!elgg_instanceof($page, 'object', 'wiki_page')) {
            error_log('Wiki recent change failed (no wiki page)');
            return true;
        }

        // Create annotation for the change
        $name  = 'wiki_change';
        $user  = get_user_by_username($recentChange->getAttribute('rc_user_text'));
//		error_log("onRecentChange_save: making change... User is $user->guid ($user->name)");
        $performer = elgg_view('output:url', array('text' => $user->name, 'href' => "/profile/{$user->username}", 'is_trusted' => true));
        $value = elgg_get_excerpt($recentChange->getAttribute('rc_comment'));
        $annotation_id = create_annotation($page->guid, $name, $value);

        $options = array(
            'view'  	   => 'river/mediawiki/recent_change',
            'action_type'  => $action_type,
            'subject_guid' => $user->guid,
            'object_guid'  => $page->guid,
            'target_guid'  => 0,
            'posted'       => time($recentChange->getAttribute('rc_timestamp')),
            'annotation_id'=> $annotation_id);
        elgg_create_river_item($options);
//		error_log("onRecentChange_save: sent to river with " . print_r($options, true));
		return true;
    }

    /**
     * Replace tabs
     */
    function onSkinTemplateNavigation( $skin, &$links ) {
        global $wgElggConfig;

        unset( $links['namespaces']['talk'] );
        unset( $links['namespaces']['main'] );

        // Add link to the maps
        /*
          $links['namespaces']['maps'] = array(
          'class' => false,
          'text'  => elgg_echo('maps'),
          'href'  => $wgElggConfig['maps_url']
          );
        */
        // Add link to the Elgg
        $links['namespaces']['nets'] = array(
            'class' => false,
            'text'  => elgg_echo('network'),
            'href'  => elgg_get_site_url()
        );

        // Add link to the wiki home
        $links['namespaces']['main'] = array(
            'class' => 'selected',
            'text'  => elgg_echo('wiki'),
            'href'  => $wgElggConfig['wiki_url']
        );

        return true;
    }

	/**
	 * WikiText extension to display an avatar
	 *
	 * Usage: {{#avatar:[username]|[size]}}
	 * Examples:
	 *   {{#avatar:}}            Display current user's medium avatar
	 *   {{#avatar:foo|large}}   Display user foo's large avatar
	 *
	 * @param Parser $parser
	 * @param String $username
	 * @param String $size      One of: topbar, tiny, small, medium, large, master
	 *                          (See Elgg icon sizes)
	 * @return String
	 */
	public static function parseAvatar( &$parser, $username = null, $size = null ) {

		if ( !$username ) {
			try {
				$username = elgg_get_logged_in_user_entity()->username;
			} catch ( Exception $e ) {
				return false;
			}
		}
		if ( !$size ) {
			$size = 'tiny';
		}

		return $parser->insertStripItem( avatar_link( $username, $size ), $parser->mStripState );
	}

	public static function parseAvatarSetup( &$parser ) {
	    $parser->setFunctionHook( 'avatar', 'ElggIntegrationHooks::parseAvatar' );
		return true;
	}

	public static function parseGroupLink( &$parser, $group_alias ) {

		$group = get_group_from_group_alias( $group_alias );

		if ( elgg_instanceof( $group, 'group' ) ) {
			$link = elgg_view(
				'output/url',
				array(
					'href' => $group->getURL(),
					'text' => $group->name,
					'is_trusted' => true,
				)
			);
			return $parser->insertStripItem( $link, $parser->mStripState );	
		}
		return $group_alias;

	}

	public static function parseGroupLinkSetup( &$parser ) {
		$parser->setFunctionHook( 'group', 'ElggIntegrationHooks::parseGroupLink' );
		return true;
	}

	public static function parseGroupActivity( &$parser, $group_alias, $n_items = 5 ) {

		$html = '';

		if ( !elgg_is_logged_in() ) {
			return $html;
		}

		$user  = elgg_get_logged_in_user_entity();

		$group = get_group_from_group_alias( $group_alias );

		if ( !elgg_instanceof( $group, 'group' ) ) {
			return $html;
		}

		$n = (int) $n_items;
		if ( 1 > $n || $n > 20 ) {
			$n = 5;
		}

		$db_prefix = elgg_get_config('dbprefix');

		$html = elgg_list_river(array(
					'joins' => array(
						"JOIN {$db_prefix}entities e1 ON e1.guid = rv.object_guid",
						"LEFT JOIN {$db_prefix}entities e2 ON e2.guid = rv.target_guid",
					),
					'wheres' => array(
                        "(e1.container_guid = $group->guid OR e2.container_guid = $group->guid)",
					),
					'no_results' => elgg_echo('groups:activity:none'),
		));

		return $parser->insertStripItem( $html, $parser->mStripState );
	}

	public static function parseGroupActivitySetup( &$parser ) {
		$parser->setFunctionHook( 'group_activity', 'ElggIntegrationHooks::parseGroupActivity' );
		return true;
	}

}
