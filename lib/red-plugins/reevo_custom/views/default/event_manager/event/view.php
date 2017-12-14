<?php
elgg_register_plugin_hook_handler('header', 'opengraph', function ($hook, $handler, $return, $params){
	$guid = get_input('guid');
	elgg_entity_gatekeeper($guid, 'object', 'event');
	$event = get_entity($guid);
	$baseurl = rtrim(elgg_get_site_url(), "/");

	if ($event->hasIcon('master')) {
		$icon = $event->getIcon('master');
		$iconfinal = elgg_get_inline_url($icon, false);
		$return['og:image'] = $iconfinal;
	}

	if (preg_match('/'.str_replace('/','\\/',elgg_get_site_url()).'event/', $params['url'])) {
			$return['og:description'] = strip_tags($event->shortdescription);
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

// if ($event->comments_on) {
// 	$body .= elgg_view_comments($event);
// }

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
