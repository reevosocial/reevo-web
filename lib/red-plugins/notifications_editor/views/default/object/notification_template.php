<?php

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \hypeJunction\Notifications\Template) {
	return;
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $entity,
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
		));

$title = elgg_view('output/url', array(
	'href' => $entity->getURL(),
	'text' => $entity->getDisplayName(),
		));

$subtitle = array();
foreach (array('language', 'event', 'object_type', 'object_subtype') as $prop) {
	if (!$entity->$prop) {
		continue;
	}
	$subtitle[] = elgg_format_element('strong', [], elgg_echo("notifications:editor:$prop")) . ': ' . $entity->$prop;
}

$params = array(
	'entity' => $entity,
	'title' => $title,
	'subtitle' => implode('<br />', $subtitle),
	'metadata' => $metadata,
);

if (elgg_extract('full_view', $vars, false)) {

	$content = array();
	$content[] = $params['subtitle'];
	unset($params['subtitle']);

	foreach (array('subject', 'summary', 'body') as $prop) {
		if (!$entity->$prop) {
			continue;
		}
		$content[] = elgg_format_element('strong', [], elgg_echo("notifications:editor:$prop")) . ': ' . elgg_format_element('blockquote', ['class' => 'pal'], $entity->$prop);
	}

	$params['content'] .= implode('<br />', $content);
}

echo elgg_view('object/elements/summary', $params);
