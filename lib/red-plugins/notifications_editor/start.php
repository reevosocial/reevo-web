<?php

use hypeJunction\Notifications\Template;

/**
 * Notification editor
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 * @copyright Copyright (c) 2015, Ismayil Khayredinov
 */
require_once __DIR__ . '/autoloader.php';

elgg_register_event_handler('init', 'system', 'notifications_editor_init');
elgg_register_event_handler('ready', 'system', 'notifications_editor_ready');

/**
 * Initialize the plugin
 * @return void
 */
function notifications_editor_init() {

	elgg_register_plugin_hook_handler('route', 'notifications', 'notifications_editor_router');

	elgg_register_action('notifications/editor/subtypes', __DIR__ . '/actions/notifications/editor/subtypes.php', 'admin');
	elgg_register_action('notifications/editor/edit', __DIR__ . '/actions/notifications/editor/edit.php', 'admin');

	elgg_register_plugin_hook_handler('entity:url', 'object', 'notifications_editor_url_handler');

	elgg_register_plugin_hook_handler('format', 'notification', 'notifications_editor_format_notification');

	elgg_register_admin_menu_item('configure', 'notification_editor', 'appearance');
}

/**
 * Setup templates based on registered handlers
 * @return void
 */
function notifications_editor_ready() {

	$templates = notification_editor_get_templates();
	foreach ($templates as $template) {
		elgg_register_plugin_hook_handler('prepare', "notification:$template", 'notifications_editor_prepare_notification');
	}
}

/**
 * Route editor pages
 * 
 * @param string $hook   "route"
 * @param string $type   "notifications"
 * @param array  $return Segments and identifier
 * @param array  $params Hook params
 * @return array|false
 */
function notifications_editor_router($hook, $type, $return, $params) {

	$identifier = elgg_extract('identifier', $return);
	$segments = elgg_extract('segments', $return);

	if ($identifier == 'notifications' && $segments[0] == 'editor') {
		echo elgg_view_resource('notifications/editor', $return);
		return false;
	}
}

/**
 * Returns editable templates
 * @return string
 */
function notification_editor_get_templates() {
	$templates = array();
	$notification_events = _elgg_services()->notifications->getEvents();
	foreach ($notification_events as $object_type => $object_subtypes) {
		foreach ($object_subtypes as $object_subtype => $actions) {
			foreach ($actions as $action) {
				$templates[] = "$action:$object_type:$object_subtype";
			}
		}
	}

	return elgg_trigger_plugin_hook('get_templates', 'notifications', null, $templates);
}

/**
 * Returns an entity template
 *
 * @param string $template_name Template name
 * @param string $language Language
 * @return Template|false
 */
function notifications_editor_get_template_entity($template_name, $language = 'en') {

	$templates = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => Template::SUBTYPE,
		'metadata_name_value_pairs' => array(
			array(
				'name' => 'template',
				'value' => $template_name,
			),
			array(
				'name' => 'language',
				'value' => $language,
			)
		),
		'limit' => 1,
	));

	if ($templates) {
		return $templates[0];
	}

	$template_parts = explode(':', $template_name);
	array_unshift($template_parts, 'notifications');

	$template_folder = implode('/', $template_parts);

	$template = new Template();
	$template->subject = elgg_view("$template_folder/subject.$language.html");
	if (!$template->subject && $language != 'en') {
		$template->subject = elgg_view("$template_folder/subject.en.html");
	}
	$template->summary = elgg_view("$template_folder/summary.$language.html");
	if (!$template->summary && $language != 'en') {
		$template->summary = elgg_view("$template_folder/summary.en.html");
	}
	$template->body = elgg_view("$template_folder/body.$language.html");
	if (!$template->body && $language != 'en') {
		$template->body = elgg_view("$template_folder/body.en.html");
	}
	$template->template_folder = $template_folder;
	$template->template = $template_name;
	$template->language = $language;

	return $template;
}

/**
 * Template URL handler
 *
 * @param string $hook   "entity:url"
 * @param string $type   "object"
 * @param string $return URL
 * @param array  $params Hook params
 * @return string
 */
function notifications_editor_url_handler($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params);
	if ($entity instanceof Template) {
		return "notifications/editor/view/$entity->guid";
	}
}

/**
 * Prepare notification
 *
 * @param string       $hook   "prepare"
 * @param string       $type   "all"
 * @param \Elgg\Notifications\Notification $notification Nofication object
 * @param array        $params Hook params
 * @return \Elgg\Notifications\Notification
 */
function notifications_editor_prepare_notification($hook, $type, $notification, $params) {

	list($hook_type, $event_name, $object_type, $object_subtype) = explode(':', $type);

	if ($hook_type !== 'notification') {
		// there is also a prepare hook for menus
		return;
	}

	$language = elgg_extract('language', $params, 'en');
	$template_name = implode(':', array($event_name, $object_type, $object_subtype));

	$template = notifications_editor_get_template_entity($template_name, $language);

	if (!$template) {
		return;
	}

	$event = elgg_extract('event', $params);
	if (!$event instanceof \Elgg\Notifications\Event) {
		return;
	}

	$recipient = $notification->getRecipient();
	$sender = $notification->getSender();

	$action = $event->getAction();
	$actor = $event->getActor();
	$object = $event->getObject();
	if ($object instanceof ElggEntity) {
		$target = $object->getContainerEntity();
	} else if ($object instanceof ElggRelationship) {
		$target = array(
			'subject' => get_entity($object->guid_one),
			'object' => get_entity($object->guid_two),
		);
	} else if ($object instanceof ElggAnnotation) {
		$target = $object->getEntity();
	}

	$template_params = array(
		'action' => $action,
		'actor' => $actor,
		'object' => $object,
		'target' => $target,

		'sender' => $sender,
		'recipient' => $recipient,
		'language' => $language,
		'site' => elgg_get_site_entity(),
		
		'params' => $notification->params,
	);

	elgg_push_context('widgets');
	if ($template->subject) {
		$notification->subject = mustache()->render($template->subject, $template_params);
	}
	if ($template->body) {
		$notification->body = mustache()->render($template->body, $template_params);
	}
	if ($template->summary) {
		$notification->summary = mustache()->render($template->summary, $template_params);
	}
	elgg_pop_context();
	return $notification;
}

/**
 * Formats notifications that have defined template
 * 
 * @param string                           $hook         "format"
 * @param string                           $type         "notification"
 * @param \Elgg\Notifications\Notification $notification Notification
 * @param array                            $params       Hook params
 * @return \Elgg\Notifications\Notification
 */
function notifications_editor_format_notification($hook, $type, $notification, $params) {

	$language = $notification->language;
	if (empty($notification->params['template'])) {
		return;
	}

	$template = notifications_editor_get_template_entity($notification->params['template'], $language);
	if (!$template) {
		return;
	}

	$event = elgg_extract('event', $params);
	if ($event instanceof \Elgg\Notifications\Event) {
		$action = $event->getAction();
		$actor = $event->getActor();
		$object = $event->getObject();
		if ($object instanceof ElggEntity) {
			$target = $object->getContainerEntity();
		} else if ($object instanceof ElggRelationship) {
			$target = array(
				'subject' => get_entity($object->guid_one),
				'object' => get_entity($object->guid_two),
			);
		} else if ($object instanceof ElggAnnotation) {
			$target = $object->getEntity();
		}
	}

	$template_params = array(
		'action' => $action,
		'actor' => $actor,
		'object' => $object,
		'target' => $target,

		'recipient' => $notification->getRecipient(),
		'sender' => $notification->getSender(),
		'language' => $language,
		'site' => elgg_get_site_entity(),

		'params' => $notification->params,
	);

	elgg_push_context('widgets');
	if ($template->subject) {
		$notification->subject = mustache()->render($template->subject, $template_params);
	}
	if ($template->body) {
		$notification->body = mustache()->render($template->body, $template_params);
	}
	if ($template->summary) {
		$notification->summary = mustache()->render($template->summary, $template_params);
	}
	elgg_pop_context();

	return $notification;
}
