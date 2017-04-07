<?php
/**
 * Aalborg theme plugin - Reevo mods
 *
 * @package AalborgTheme
 */

elgg_register_event_handler('init','system','reevo_theme_init');


elgg_unregister_menu_item('footer', 'powered');

function reevo_theme_init() {

	// theme specific CSS
	elgg_extend_view('css/elgg', 'reevo_theme/css');

	// Load js
	// elgg_register_js('clipboard', 'mod/reevo_theme/vendors/js/clipboard.min.js');
	// elgg_load_js('clipboard');


	elgg_unregister_event_handler('pagesetup', 'system', 'aalborg_theme_pagesetup');
	elgg_register_event_handler('pagesetup', 'system', 'reevo_theme_pagesetup', 900);
}


// adds custom logo
elgg_register_event_handler('init', 'system', 'reevo_theme_addlogo');

function reevo_theme_addlogo() {
	elgg_unregister_menu_item('topbar', 'elgg_logo');

	$logo_url = elgg_get_site_url() . "mod/reevo_theme/graphics/logo.png";

	elgg_register_menu_item('topbar', array(
	    'name' => 'logo',
	    'href' => '/',
	    'text' => "<img src=\"$logo_url\" alt=\"Ir a la portada\" width=\"100\" height=\"24\" />",
	    'priority' => 1,
	    'link_class' => 'elgg-topbar-logo',
	));
}



// Quita los menues de la izquierda al lado del logo
// removes topbar icons
elgg_register_plugin_hook_handler('register', 'menu:topbar', 'reevo_theme_topbar');

function reevo_theme_topbar($hook, $type, $return, $params) {

    $remove = array('profile', 'friends', 'messages');

    foreach($return as $key => $item) {
        if (in_array($item->getName(), $remove)) {
            unset($return[$key]);
        }
    }

    return $return;
}


function reevo_theme_pagesetup() {

	if (elgg_is_logged_in()) {

		$viewer = elgg_get_logged_in_user_entity();
		elgg_register_menu_item('topbar', array(
			'name' => 'account',
			'href' => $viewer->getURL(),
			'text' => elgg_view('output/img', array(
				'src' => $viewer->getIconURL('topbar'),
				'alt' => $viewer->name,
				'title' => elgg_echo('profile'),
				'link_class' => 'elgg-border-plain elgg-transition',
			)).'<span class="profile-text">'.elgg_get_excerpt($viewer->name, 20).'</span>',
			'priority' => 100,
			'section' => 'alt',
			'link_class' => 'elgg-topbar-avatar',
			'item_class' => 'elgg-avatar elgg-avatar-topbar',
			// 'link_class' => 'elgg-topbar-dropdown',
		));

    // Registra menu de mensajes
		$text = elgg_echo("messages");
		$num_messages = (int)messages_count_unread();
		if ($num_messages != 0) {
			$text .= " ($num_messages)";
		}
		$tooltip = $text.': '.elgg_echo("messages:unreadcount", array($num_messages));
		// get unread messages
		elgg_register_menu_item('topbar', array(
			'name' => 'messages2',
			'href' => "messages/inbox/$viewer->name",
			'text' => $text,
			'parent_name' => 'account',
			'priority' => 101,
			'title' => $tooltip,
			'section' => 'alt',
		));

		if (elgg_is_active_plugin('dashboard')) {
			$item = elgg_unregister_menu_item('topbar', 'dashboard');
			if ($item) {
				$item->setText(elgg_echo('dashboard'));
				$item->setSection('default');
				elgg_register_menu_item('site', $item);
			}
		}

		$item = elgg_get_menu_item('topbar', 'usersettings');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('settings'));
			$item->setPriority(103);
		}

		$item = elgg_get_menu_item('topbar', 'logout');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('logout'));
			$item->setPriority(104);
		}

		$item = elgg_get_menu_item('topbar', 'administration');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('admin'));
			$item->setPriority(101);
		}

		if (elgg_is_active_plugin('site_notifications')) {
			$item = elgg_get_menu_item('topbar', 'site_notifications');
			if ($item) {
				$item->setParentName('account');
				$item->setText(elgg_echo('site_notifications:topbar'));
				$item->setPriority(102);
			}
		}

		if (elgg_is_active_plugin('reportedcontent')) {
			$item = elgg_unregister_menu_item('footer', 'report_this');
			if ($item) {
				$item->setText(elgg_view_icon('report-this'));
				$item->setPriority(500);
				$item->setSection('default');
				elgg_register_menu_item('extras', $item);
			}
		}
	} else { //not

	}

	// Agrega caja de busqueda en navbar
	elgg_unextend_view('page/elements/sidebar', 'search/header');
	elgg_extend_view('page/elements/navbar', 'search/header', 0);
	elgg_register_menu_item('navbar', array(
		'name' => 'search',
		'href' => "#",
		'text' => '<i class="sb-toggle-left fa fa-bars fa-lg"></i>',
		'priority' => 101,
		'link_class' => 'navbar-search',
	));


}



// Quita los menues del navbar
elgg_register_plugin_hook_handler('register', 'menu:site', 'reevo_theme_navbar');
function reevo_theme_navbar($hook, $type, $return, $params) {

    $remove = array('file', 'bookmarks', 'activity', 'pages', 'thewire');

    foreach($return as $key => $item) {
        if (in_array($item->getName(), $remove)) {
            unset($return[$key]);
        }
    }

    return $return;
}



elgg_register_plugin_hook_handler('head', 'page', 'reevo_theme_favicon');

function reevo_theme_favicon($hook, $type, $return, $params) {
	$return['links']['apple-touch-icon'] = array(
		'rel' => 'apple-touch-icon',
		'href' => 'http://assets.reevo.org/logo/favicon/favicon.png',
	);
	$return['links']['icon-ico'] = array(
		'rel' => 'icon',
		'href' => 'http://assets.reevo.org/logo/favicon/favicon.ico',
	);
	$return['links']['icon-vector'] = array(
		'rel' => 'icon',
		'sizes' => '16x16 32x32 48x48 64x64 128x128',
		'type' => 'image/png',
		'href' => 'http://assets.reevo.org/logo/favicon/favicon.png',
	);
	$return['links']['icon-16'] = array(
		'rel' => 'icon',
		'sizes' => '16x16',
		'type' => 'image/png',
		'href' => 'http://assets.reevo.org/logo/favicon/favicon.png',
	);
	$return['links']['icon-32'] = array(
		'rel' => 'icon',
		'sizes' => '32x32',
		'type' => 'image/png',
		'href' => 'http://assets.reevo.org/logo/favicon/favicon.png',
	);
	$return['links']['icon-64'] = array(
		'rel' => 'icon',
		'sizes' => '64x64',
		'type' => 'image/png',
		'href' => 'http://assets.reevo.org/logo/favicon/favicon.png',
	);
	$return['links']['icon-128'] = array(
		'rel' => 'icon',
		'sizes' => '128x128',
		'type' => 'image/png',
		'href' => 'http://assets.reevo.org/logo/favicon/favicon.png',
	);
  $return['links'][] = array(
      'rel' => 'stylesheet',
      'type' => 'image/css',
      'href' => 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,700,700italic'
  );
	$return['links'][] = array(
      'rel' => 'stylesheet',
      'type' => 'image/css',
      'href' => 'https://fonts.googleapis.com/css?family=Lato:400,700,900'
  );
  return $return;
}












// ****************************************
// elgg_register_event_handler('pagesetup', 'system', 'time_theme_pagesetup', 1000);
function time_theme_pagesetup() {
	//elgg_unextend_view('page/elements/sidebar', 'search/header');
	elgg_extend_view('page/elements/topbar', 'search/header', 0);
	elgg_register_menu_item('topbar', array(
		'name' => 'sidebar',
		'href' => "#",
		'text' => '<i class="sb-toggle-left fa fa-bars fa-lg"></i>',
		'priority' => 50,
		'link_class' => '',
	));
	elgg_unregister_menu_item('footer','powered');

	if (elgg_is_logged_in()) {
		$user = elgg_get_logged_in_user_entity();
		$username = $user->username;
		elgg_unregister_menu_item('topbar','messages');
		$text = "<i class=\"fa fa-envelope fa-lg\"></i>";
		$tooltip = elgg_echo("messages");
		// get unread messages
		$num_messages = (int)messages_count_unread();
		if ($num_messages != 0) {
			$text .= "<span class=\"elgg-topbar-new\">$num_messages</span>";
			$tooltip .= ": ".elgg_echo("messages:unreadcount", array($num_messages));
		}
		elgg_register_menu_item('topbar', array(
			'name' => 'messages',
			'href' => "messages/inbox/$username",
			'text' => $text,
			'section' => 'alt',
			'priority' => 100,
			'title' => $tooltip,
		));

		elgg_register_menu_item('topbar', array(
			'href' => false,
			'name' => 'search',
			'text' => '<i class="fa fa-search fa-lg"></i>'.elgg_view('search/header'),
			'priority' => 0,
			'section' => 'alt',
		));
		$text = '<i class="fa fa-users fa-lg"></i>';
		$tooltip = elgg_echo("friends");
		$href = "/friends/".$username;
	  if (elgg_is_active_plugin('friend_request')) {
	  	elgg_unregister_menu_item('topbar', 'friend_request');
			$options = array(
				"type" => "user",
				"count" => true,
				"relationship" => "friendrequest",
				"relationship_guid" => $user->getGUID(),
				"inverse_relationship" => true
			);

			$count = elgg_get_entities_from_relationship($options);
			if (!empty($count)) {
				$text .= "<span class=\"elgg-topbar-new\">$count</span>";
				$tooltip = elgg_echo("friend_request:menu").": ".$count;
				$href = "friend_request/" . $username;
			}
	  }
		elgg_unregister_menu_item('topbar', 'friends');
		elgg_register_menu_item('topbar', array(
			'href' => $href,
			'name' => 'friends',
			'text' =>  $text,
			'section' => 'alt',
			'priority' => 200,
			'title' => $tooltip,
		));
		$viewer = elgg_get_logged_in_user_entity();
		elgg_unregister_menu_item('topbar', 'profile');
		elgg_register_menu_item('topbar', array(
			'name' => 'profile',
			'href' => $viewer->getURL(),
			'text' => elgg_view('output/img', array(
				'src' => $viewer->getIconURL('small'),
				'alt' => $viewer->name,
				'title' => elgg_echo('profile'),
				'link_class' => 'elgg-border-plain elgg-transition',
			)).'<span class="profile-text">'.elgg_get_excerpt($viewer->name, 20).'</span>',
			'priority' => 500,
			'link_class' => 'elgg-topbar-avatar',
			'item_class' => 'elgg-avatar elgg-avatar-topbar',
		));
		elgg_register_menu_item('topbar', array(
			'name' => 'home',
			'text' => '<i class="fa fa-home fa-lg"></i> ',
			'href' => "/",
			'priority' => 90,
			'section' => 'alt',
		));
		elgg_register_menu_item('topbar', array(
			'name' => 'account',
			'text' => '<i class="fa fa-cog fa-lg"></i> ',
			'href' => "#",
			'priority' => 300,
			'section' => 'alt',
			'link_class' => 'elgg-topbar-dropdown',
		));
		if (elgg_is_active_plugin('dashboard')) {
			$item = elgg_unregister_menu_item('topbar', 'dashboard');
			if ($item) {
				$item->setText(elgg_echo('dashboard'));
				$item->setSection('default');
				elgg_register_menu_item('site', $item);
			}
		}
		$item = elgg_unregister_menu_item('extras', 'bookmark');
		if ($item) {
			$item->setText('<i class="fa fa-bookmark fa-lg"></i>');
			elgg_register_menu_item('extras', $item);
		}
	  elgg_unregister_menu_item('extras', 'rss');
		/*if ($item) {
			$item->setText('<i class="fa fa-rss fa-lg"></i>');
			elgg_register_menu_item('extras', $item);
		}*/
		$url = elgg_format_url($url);
		elgg_register_menu_item('extras', array(
			'name' => 'rss',
			'text' => '<i class="fa fa-rss fa-lg"></i>',
			'href' => $url,
			'title' => elgg_echo('feed:rss'),
		));

		$item = elgg_get_menu_item('topbar', 'usersettings');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('settings'));
			$item->setPriority(103);
		}
		$item = elgg_get_menu_item('topbar', 'logout');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('logout'));
			$item->setPriority(104);
		}
		$item = elgg_get_menu_item('topbar', 'administration');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('admin'));
			$item->setPriority(101);
		}
		if (elgg_is_active_plugin('site_notifications')) {
			$item = elgg_get_menu_item('topbar', 'site_notifications');
			if ($item) {
				$item->setParentName('account');
				$item->setText(elgg_echo('site_notifications:topbar'));
				$item->setPriority(102);
			}
		}
		if (elgg_is_active_plugin('reportedcontent')) {
			$item = elgg_unregister_menu_item('footer', 'report_this');
			if ($item) {
				$item->setText('<i class="fa fa-flag fa-lg"></i>');
				$item->setPriority(500);
				$item->setSection('default');
				elgg_register_menu_item('extras', $item);
			}
		}

	}
}
