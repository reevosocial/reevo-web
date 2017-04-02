<?php
/**
 * Recursos Externos plugin
 *
 * @package ElggBookmarks
 */

elgg_register_event_handler('init', 'system', 'recext_init');

/**
 * Bookmark init
 */
function recext_init() {

	$root = dirname(__FILE__);
	elgg_register_library('elgg:recext', "$root/lib/recext.php");

	// actions
	$action_path = "$root/actions/recext";
	elgg_register_action('recext/save', "$action_path/save.php");
	elgg_register_action('recext/delete', "$action_path/delete.php");
	elgg_register_action('recext/share', "$action_path/share.php");

	// menus
	elgg_register_menu_item('site', array(
		'name' => 'recext',
		'text' => elgg_echo('recext'),
		'href' => 'recext/all'
	));

	elgg_register_plugin_hook_handler('register', 'menu:page', 'recext_page_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'recext_owner_block_menu');

	elgg_register_page_handler('recext', 'recext_page_handler');

	elgg_extend_view('css/elgg', 'recext/css');
	elgg_extend_view('js/elgg', 'recext/js');

	elgg_register_widget_type('recext', elgg_echo('recext'), elgg_echo('recext:widget:description'));

	if (elgg_is_logged_in()) {
		$user_guid = elgg_get_logged_in_user_guid();
		$address = urlencode(current_page_url());

		elgg_register_menu_item('extras', array(
			'name' => 'recext',
			'text' => elgg_view_icon('push-pin'),
			'href' => "recext/add/$user_guid?address=$address",
			'title' => elgg_echo('recext:this'),
			'rel' => 'nofollow',
		));
	}

	// Register for notifications
	elgg_register_notification_event('object', 'recext', array('create'));
	elgg_register_plugin_hook_handler('prepare', 'notification:create:object:recext', 'recext_prepare_notification');

	// Register recext view for ecml parsing
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'recext_ecml_views_hook');

	// Register a URL handler for recext
	elgg_register_plugin_hook_handler('entity:url', 'object', 'recext_set_url');

	// Register entity type for search
	elgg_register_entity_type('object', 'recext');

	// Groups
	add_group_tool_option('recext', elgg_echo('recext:enablerecext'), true);
	elgg_extend_view('groups/tool_latest', 'recext/group_module');
}

/**
 * Dispatcher for recext.
 *
 * URLs take the form of
 *  All recext:        recext/all
 *  User's recext:     recext/owner/<username>
 *  Friends' recext:   recext/friends/<username>
 *  View recext:        recext/view/<guid>/<title>
 *  New recext:         recext/add/<guid> (container: user, group, parent)
 *  Edit recext:        recext/edit/<guid>
 *  Group recext:      recext/group/<guid>/all
 *  Bookmarklet:          recext/recextlet/<guid> (user)
 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function recext_page_handler($page) {

	elgg_load_library('elgg:recext');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('recext'), 'recext/all');

	$pages = dirname(__FILE__) . '/pages/recext';

	switch ($page[0]) {
		case "all":
			include "$pages/all.php";
			break;

		case "export":
			include "$pages/export.php";
			break;

		case "owner":
			include "$pages/owner.php";
			break;

		case "friends":
			include "$pages/friends.php";
			break;

		case "view":
			set_input('guid', $page[1]);
			include "$pages/view.php";
			break;

		case "add":
			elgg_gatekeeper();
			include "$pages/add.php";
			break;

		case "edit":
			elgg_gatekeeper();
			set_input('guid', $page[1]);
			include "$pages/edit.php";
			break;

		case 'group':
			elgg_group_gatekeeper();
			include "$pages/owner.php";
			break;

		case "recextlet":
			set_input('container_guid', $page[1]);
			include "$pages/recextlet.php";
			break;

		default:
			return false;
	}

	elgg_pop_context();
	return true;
}

/**
 * Populates the ->getUrl() method for recexted objects
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string recexted item URL
 */
function recext_set_url($hook, $type, $url, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'recext')) {
		$title = elgg_get_friendly_title($entity->title);
		return "recext/view/" . $entity->getGUID() . "/" . $title;
	}
}

/**
 * Add a menu item to an ownerblock
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function recext_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "recext/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('recext', elgg_echo('recext'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->recext_enable != 'no') {
			$url = "recext/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('recext', elgg_echo('recext:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Prepare a notification message about a new recext
 *
 * @param string                          $hook         Hook name
 * @param string                          $type         Hook type
 * @param Elgg\Notifications\Notification $notification The notification to prepare
 * @param array                           $params       Hook parameters
 * @return Elgg\Notifications\Notification
 */
function recext_prepare_notification($hook, $type, $notification, $params) {
	$entity = $params['event']->getObject();
	$owner = $params['event']->getActor();
	$recipient = $params['recipient'];
	$language = $params['language'];
	$method = $params['method'];

	$descr = $entity->description;
	$title = $entity->title;

	$notification->subject = elgg_echo('recext:notify:subject', array($title), $language);
	$notification->body = elgg_echo('recext:notify:body', array(
		$owner->name,
		$title,
		$entity->address,
		$descr,
		$entity->getURL()
	), $language);
	$notification->summary = elgg_echo('recext:notify:summary', array($entity->title), $language);

	return $notification;
}

/**
 * Add a page menu menu.
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function recext_page_menu($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		// only show recextlet in recext pages
		if (elgg_in_context('recext')) {
			$page_owner = elgg_get_page_owner_entity();
			if (!$page_owner) {
				$page_owner = elgg_get_logged_in_user_entity();
			}

			if ($page_owner instanceof ElggGroup) {
				$title = elgg_echo('recext:recextlet:group');
			} else {
				$title = elgg_echo('recext:recextlet');
			}

			$return[] = new ElggMenuItem('recextlet', $title, 'recext/recextlet/' . $page_owner->getGUID());
		}
	}

	return $return;
}

/**
 * Return recext views to parse for ecml
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function recext_ecml_views_hook($hook, $type, $return, $params) {
	$return['object/recext'] = elgg_echo('item:object:recext');
	return $return;
}
