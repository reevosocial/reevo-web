<?php

elgg_register_plugin_hook_handler('header', 'opengraph', function ($hook, $handler, $return, $params){
	$guid = get_input('guid');
	elgg_entity_gatekeeper($guid, 'object', 'event');
	$event = get_entity($guid);
	$baseurl = rtrim(elgg_get_site_url(), "/");
	$event_banner_url = '';
	if ($event->hasIcon('event_banner')) {
		$event_banner_url = $event->getIconURL('event_banner');
	} elseif ($event->hasIcon('master')) {
		$event_banner_url = $event->getIconURL('master');
	}

	// fix feo para obtener una URL directa al archivo y que lo lea FB
	$event_banner_url_array = explode('/',strrev($event_banner_url));
	$event_banner_url = $baseurl . '/files/' . strrev($event_banner_url_array[2]) . '/'. strrev($event_banner_url_array[1]) . '/' . strrev($event_banner_url_array[0]);

	if (preg_match('/'.str_replace('/','\\/',elgg_get_site_url()).'event/', $params['url'])) {
			$return['og:description'] = strip_tags($event->shortdescription);
			$return['og:image'] = $event_banner_url;
			return $return;
	}
});


$event = elgg_extract('entity', $vars);

$body =  elgg_view('event_manager/event/fields', $vars);

if ($event->show_attendees || $event->canEdit()) {
	$body .= elgg_view('event_manager/event/attendees', $vars);
}

if ($event->with_program) {
	$body .= elgg_view('event_manager/program/view', $vars);
}

if ($event->comments_on) {
	$body .= elgg_view_comments($event);
}

$entity_menu = elgg_view_menu('entity', [
	'entity' => $event,
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
	'handler' => 'event',
]);

$params = [
	'entity' => $event,
	'title' => false,
	'tags' => false,
	'metadata' => $entity_menu,
	'subtitle' => elgg_view('page/elements/by_line', $vars),
];
$params = $params + $vars;
$summary = elgg_view('object/elements/summary', $params);

echo elgg_view('object/elements/full', [
	'entity' => $event,
	'summary' => $summary,
	'body' => $body,
]);
