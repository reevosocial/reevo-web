<?php
/**
 * Lorea Elggman -- A mailing-list plugin for Elgg
 *
 * @package       Lorea
 * @subpackage    Elggman
 * @homepage      https://lorea.org/plugin/elggman
 * @copyright     Copyright 2012,2013,2014 Lorea Faeries <federation@lorea.org>
 * @license       COPYING, https://gnu.org/license/agpl
 */

elgg_register_event_handler('init', 'system', 'elggman_init');

/**
 * Elggman plugin initialization functions.
 */
function elggman_init() {

	// register a library of helper functions
	elgg_register_library('elggman', elgg_get_plugins_path() . 'elggman/lib/elggman.php');

	// Extend CSS
	elgg_extend_view('css/elgg', 'elggman/css');
	
	elgg_extend_view('groups/sidebar/members', 'elggman/sidebar/info');
	elgg_extend_view('discussion/sidebar', 'elggman/sidebar/info');

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('elggman', 'elggman_page_handler');

	// Ensure the elggman/receive page is public
	if (elgg_get_config('walled_garden')) {
		elgg_register_plugin_hook_handler('public_pages', 'walled_garden', 'elggman_hook_walled_garden');
	}
	
	elgg_register_event_handler('create', 'object', 'elggman_notifications');
	// threaded topicreply's
	elgg_register_event_handler('create', 'top', 'elggman_notifications');
	
	// Register granular notification for this object type
	//register_notification_object('object', 'groupforumtopic', elgg_echo('elggman:newupload'));

	// Listen to notification events and supply a more useful message
	//elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'file_notify_message');
	elgg_register_plugin_hook_handler('register', 'menu:annotation', 'elggman_annotation_menu_setup', 400);

	// Register actions
	$action_path = elgg_get_plugins_path() . 'elggman/actions/elggman';
	elgg_register_action("elggman/subscribe", "$action_path/subscribe.php");
	elgg_register_action("elggman/unsubscribe", "$action_path/unsubscribe.php");
	elgg_register_action("elggman/group_settings", "$action_path/group_settings.php");
	elgg_register_action("elggman/subscription/edit", "$action_path/subscription/edit.php");
	elgg_register_action("elggman/whitelist/add", "$action_path/whitelist/add.php");
	elgg_register_action("elggman/whitelist/delete", "$action_path/whitelist/delete.php");
	// moderation actions
	foreach(array('accept', 'drop', 'accept_all', 'drop_all') as $action) {
		elgg_register_action("elggman/moderation/$action", "$action_path/moderation/$action.php");
	}

	$current_page = current_page_url();
	if (!strpos($current_page, 'notifications/personal')) {

		if (function_exists('elgg_get_version') &&
		   version_compare(elgg_get_version(true), '1.9', '>')) {
			elgg_register_notification_method('mailshot');
		} else {
			register_notification_handler('mailshot', 'elggman_dummy');
		}
	}
}

/**
 * Dispatches subscription pages.
 * URLs take the form of
 *  User's subscriptions: elggman/owner/<username>
 *  View subscription:    elggman/view/<guid>/
 *  Edit subscription:    elggman/edit/<guid>
 *
 * @param array $page
 * @return bool
 */
function elggman_page_handler($page) {

	$pages_dir = elgg_get_plugins_path() . 'elggman/pages/elggman';

	$page_type = $page[0];
	switch ($page_type) {
		case 'owner':
			include "$pages_dir/owner.php";
			break;
		case 'view':
			set_input('guid', $page[1]);
			include "$pages_dir/view.php";
			break;
		case 'edit':
			set_input('guid', $page[1]);
			include "$pages_dir/edit.php";
			break;
		case 'receive':
			include "$pages_dir/receive.php";
			break;
		case 'moderate':
		case 'manage':
		case 'whitelist':
		case 'blacklist':
			set_input('guid', $page[1]);
			set_input('page', $page_type);
			include "$pages_dir/manage.php";
			break;
		default:
			// deprecated urls
			if ((int) $page[0] && (int) $page[1]) {
				forward('discussion/view/' . $page[1]);
			}

			return false;
	}
	return true;
}

function elggman_send_email($from, $to, $subject, $body, $params) {
    // return TRUE/FALSE to stop elgg_send_email() from sending
    $mail_params = array(
        'to' => $to,
        'from' => $from,
        'subject' => $subject,
        'body' => $body,
        'headers' => $params['headers']
    );

    $result = elgg_trigger_plugin_hook('email', 'system', $mail_params, NULL);
    if ($result !== NULL) {
            return $result;
    }

	$body = preg_replace("/^From/", ">From", $body); // Change lines starting with From to >From

	// Sanitise subject by stripping line endings
    $subject = preg_replace("/(\r\n|\r|\n)/", " ", $subject);
    // this is because Elgg encodes everything and matches what is done with body
    $subject = html_entity_decode($subject, ENT_COMPAT, 'UTF-8'); // Decode any html entities
    if (is_callable('mb_encode_mimeheader')) {
        $subject = mb_encode_mimeheader($subject, "UTF-8", "B");
    }

	return mail($to, $subject, wordwrap($body), $params['headers']);
}

function elggman_notifications($event, $object_type, $object) {
	if ($object_type == 'top') {
		$object = get_entity($object->guid_one);
		$is_reply = true;
	}
	if (elgg_instanceof($object, 'object', 'groupforumtopic')
			|| (elgg_instanceof($object, 'object', 'topicreply') && $object_type == 'top')) {
		$user  = $object->getOwnerEntity();
		$group = $object->getContainerEntity();

		elgg_load_library("elgg:threads");
		$parent = threads_parent($object->guid);
		$top = threads_top($object->guid);

		if (check_entity_relationship($user->guid, 'starred_groupmailshot', $group->guid)) {
			if (!check_entity_relationship($user->guid ,'flags_content', $top->guid)) {
				return;
			}
		}

		if ($object->forwarded_for) {
			$from = $object->forwarded_for;
			$from_header = $object->forwarded_for;
		}
		else {
			$from = elggman_get_user_email($user, $group);
			$from_header = "$user->name <$from>";
		}
		$mailing_list_email = elggman_get_group_mailinglist($group);
		$mailing_list_header = "$group->name <$mailing_list_email>";
		$archive_url = elgg_normalize_url('discussion/owner/'.$group->guid);
		if (!$mailing_list_email) {
			return;
		}

		$subject = "[$group->name] $top->title";

		if ($is_reply) {
			$subject = "Re: $subject";
		}

		elgg_set_viewtype("email");
		$message = elgg_view('page/elements/body', array(
			'value' => $object->description,
			'post_url' => $top->getURL(),
			'mailing_list' => $group,
		));

		$headers = array(
			'From' => $from_header,
			'To' => $mailing_list_header,
			'Reply-To' => $mailing_list_email,
			'List-Id' => '<'.str_replace('@', '.', $mailing_list_email).'>',
			'List-Archive' => "<$archive_url>",
			'List-Post' => "<mailto:{$mailing_list_email}>",
			'Precedence' => "list",
			'Message-ID' => "<{$object->guid}.{$mailing_list_email}>",
			'In-Reply-To' => $is_reply ? "<{$parent->guid}.{$mailing_list_email}>" : false,
		);
		if ($object->tags) {
			$tags = implode(',', $object->tags);
			$headers['Keywords'] = $tags;
		}
		foreach (elggman_get_subscriptors($group->guid) as $subscriptor) {
			$to = $subscriptor->email;
			$headers['Resent-To'] = $to;
			$send_headers = elgg_view('page/elements/header', $headers);
	
			elggman_send_email($from, $to, $subject, $message, array('headers' => $send_headers));
		}
	}
}

function elggman_is_user_subscribed($user_guid, $group_guid) {
	return check_entity_relationship($user_guid, 'notifymailshot', $group_guid);
}

function elggman_get_subscriptors($group_guid) {
	return elgg_get_entities_from_relationship(array(
		'type' => 'user',
		'relationship' => 'notifymailshot',
		'relationship_guid' => $group_guid,
		'inverse_relationship' => TRUE,
		'limit' => 0,
	));
}

function elggman_apikey() {
	return sha1(get_site_secret().'elggman');
}

function elggman_get_user_email($user, $group) {
	if (check_entity_relationship($user->guid, 'obfuscated_groupmailshot', $group->guid)) {
		return $user->username . '@' . parse_url(elgg_get_site_url(), PHP_URL_HOST);
	} else {
		return $user->email;
	}
}

function elggman_get_group_mailinglist($group) {
	if ($group->alias) {
		return $group->alias . '@' . elgg_get_plugin_setting('mailname', 'elggman');
	}
	return false;
}

function elggman_dummy($from, $to, $subject, $topic, $params = array()) {
}

function elggman_annotation_menu_setup($hook, $type, $return, $params) {
	$annotation = $params['annotation'];
	$name = $annotation->name;
	if (in_array($name, array('whitelist', 'blacklist'))) {
		$id = $annotation->id;
		$owner = get_entity($annotation->owner_guid);
		$options = array(
			'name' => 'delete',
			'text' => elgg_echo('delete'),
			'href' => "action/elggman/whitelist/delete?id=$id&filter=$name",
			'is_action' => true,
			'priority' => 1000,
		);
		$return[] = ElggMenuItem::factory($options);
	}
	return $return;
}

/**
 * elggman_hook_walled_garden -- Ensure elggman/receive is a public page
 *
 * @hook Plugin public_pages, walled_garden
 * @param $hook  String Always public_pages
 * @param $type  String Always walled_garden
 * @param $pages Array  List of public pages 
 * @return $pages
 */
function elggman_hook_walled_garden($hook, $type, $pages) {
    $pages[] = 'elggman/receive';
    return $pages;
}


function elggman_set_notifications($event, $object_type, $object){
  global $CONFIG;

  $user = $object['user'];
  $group = $object['group'];

	// Cuando un usuario se suma a un grupo se suscribe automaticamente
  add_entity_relationship($user->guid, 'notifymailshot',
			  $group->guid);
  
  }
elgg_register_event_handler('join','group','elggman_set_notifications');
elgg_register_event_handler('added','group','elggman_set_notifications');