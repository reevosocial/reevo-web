<?php

require_once(dirname(__FILE__) . '/lib/functions.php');

/**
 * Init function for this plugin
 *
 * @return void
 */
 // register default elgg events
elgg_register_event_handler('init', 'system', 'reevo_custom_init');
elgg_register_plugin_hook_handler('action', 'event_manager/event/edit', 'event_manager_edit_addgroups');
// elgg_register_plugin_hook_handler('action', 'event_manager/event/edit', 'event_manager_set_fbicon', 0);

elgg_register_event_handler('create', 'object', 'event_manager_set_fbicon');

elgg_register_plugin_hook_handler('action', 'event_manager/event/register', 'event_manager_register_addgroups');

elgg_register_page_handler('tools','reevo_custom_pages');

$action_path = dirname(__FILE__) . '/actions/reevo_custom';
elgg_register_action('reevo_custom/fbevent', "$action_path/fbevent.php");


// notificaciones personalizadas

// elgg_unregister_plugin_hook_handler('prepare', 'notification:publish:object:blog', 'blog_prepare_notification');
// elgg_register_plugin_hook_handler('prepare', 'notification:publish:object:blog', 'blog_prepare_notification_custom', 0);


function reevo_custom_pages($page) {
	$pages = dirname(__FILE__) . '/pages/reevo_custom';

	switch ($page[0]) {
		case "fbevent":
			set_input('container_guid', $page[1]);
			include "$pages/fbevent.php";
			break;

		case "export":
			set_input('container_guid', $page[1]);
			include "$pages/export.php";
			break;

		default:
			return false;
	}

	elgg_pop_context();
	return true;
}

function reevo_custom_init() {
	elgg_extend_view('css/elgg', 'css/reevo_custom.css');
}


function event_manager_set_fbicon($hook, $type, $url) {
	global $event;
	if (!empty($event)) {
		if ($event->getSubtype() == 'event') {
			$fbcover = get_input('fbcover');
			$prefix = "event_image/".$event->guid;
			$filehandler = new ElggFile();
			$filehandler->owner_guid = $event->owner_guid;
			$filehandler->setFilename($prefix . ".jpg");
			$filehandler->open("write");
			$filehandler->write(file_get_contents($fbcover));
			$filehandler->close();
			$event->saveIconFromElggFile($filehandler);
		}
	}
}

function event_manager_edit_addgroups($hook, $type, $url, $params) {
// Suma a todos los inscriptos a los grupos asociados al evento, incluso cuando se actualiza el listado de grupos

	$entity = get_entity(get_input('guid'));
	$addgroups_old = $entity->addgroups;
	$addgroups = get_input('addgroups');

	if ($addgroups != $addgroups_old) { // hay cambios en los grupos asociados al evento
		$entity->addgroups = $addgroups; // actualiza metadatos del evento

		$groups = split(',', $addgroups);
		//for each group ids
		foreach($groups as $groupName) {
			// checks if is group name is not the alias but the id
			if (is_numeric($groupName)) {
				$groupId = $groupName;
				error_log('es numerico');
			} else {
				$group = get_group_from_group_alias($groupName);
				$groupId = $group->guid;
				error_log('no es numerico, es '.$groupName.' su id es '. $groupId);
			};
			$ia = elgg_set_ignore_access(true);
			$groupEnt = get_entity($groupId);
			elgg_set_ignore_access($ia);

			if ($groupEnt) { //if group exist : submit to group

				$event = $entity;
		    $relationships = $event->getRelationships();
		    if (empty($relationships)) {
		    	return;
		    }

		    $ordered_relationships = [
		    	EVENT_MANAGER_RELATION_ATTENDING,
		    	EVENT_MANAGER_RELATION_ATTENDING_WAITINGLIST
		    ];

		    if (elgg_get_plugin_setting('rsvp_interested', 'event_manager') !== 'no') {
		    	$ordered_relationships[] = EVENT_MANAGER_RELATION_INTERESTED;
		    }

		    foreach ($ordered_relationships as $rel) {
		    	if (!array_key_exists($rel, $relationships)) {
		    		continue;
		    	}
		    	if (($rel == EVENT_MANAGER_RELATION_ATTENDING) || ($rel == EVENT_MANAGER_RELATION_ATTENDING_PENDING) || $event->$rel || ($rel == EVENT_MANAGER_RELATION_ATTENDING_WAITINGLIST &&  $event->canEdit() && $event->waiting_list_enabled)) {
		    		$members = $relationships[$rel];

		    		foreach ($members as $member) {
		    			$member_entity = get_entity($member);
							if ($groupEnt->join($member_entity)) { //join group succeed?
								// Remove any invite or join request flags
								elgg_delete_metadata(array('guid' => $object->guid, 'metadata_name' => 'group_invite', 'metadata_value' => $groupEnt->guid, 'limit' => false));
								elgg_delete_metadata(array('guid' => $object->guid, 'metadata_name' => 'group_join_request', 'metadata_value' => $groupEnt->guid, 'limit' => false));

								error_log('Sume al usuario ' . $member_entity->getGUID() . ' al grupo ' . $groupEnt->getGUID());
							}
  					}
		    	}
				}
			}
		} // end foreach
	}
}

function event_manager_register_addgroups($hook, $type, $url, $params) {
	// Suma al usuario a los grupos cuando se inscribe al evento

	$user = elgg_get_logged_in_user_entity();
	$event = (int) get_input('event_guid');
	$entity = get_entity($event);


	 $addgroups = $entity->addgroups;

	$groups = split(',', $addgroups);
	//for each group ids
	foreach($groups as $groupName) {
		// checks if is group name is not the alias but the id
		if (is_numeric($groupName)) {
			$groupId = $groupName;
			error_log('es numerico');
		} else {
			$group = get_group_from_group_alias($groupName);
			$groupId = $group->guid;
			error_log('no es numerico, es '.$groupName.' su id es '. $groupId);
		};
		$ia = elgg_set_ignore_access(true);
		$groupEnt = get_entity($groupId);
		elgg_set_ignore_access($ia);

		if ($groupEnt) { //if group exist : submit to group
			if ($groupEnt->join($user)) { //join group succeed?S
				error_log('Sume al usuario ' . $user->getGUID() . ' al grupo ' . $groupEnt->getGUID());
			}
		}
	} // end foreach
}


function blog_prepare_notification_custom($hook, $type, $notification, $params) {
	$entity = $params['event']->getObject();
	$owner = $params['event']->getActor();
	$recipient = $params['recipient'];
	$language = $params['language'];
	$method = $params['method'];

	$notification->subject = elgg_echo('blog:notify:subject:custom', array($entity->title), $language);
	$notification->body = elgg_echo('blog:notify:body', array(
		$owner->name,
		$entity->title,
		$entity->getExcerpt(),
		$entity->getURL()
	), $language);
	$notification->summary = elgg_echo('blog:notify:summary', array($entity->title), $language);

	return $notification;
}
