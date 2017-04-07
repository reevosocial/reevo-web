<?php
/**
 * ElggObject default view.
 *
 * @warning This view may be used for other ElggEntity objects
 *
 * @package Elgg
 * @subpackage Core
 */

require_once(elgg_get_plugins_path() . "elggman/vendors/Mail/mimeDecode.php");

$entity = $vars['entity'];

//$icon = elgg_view_entity_icon($vars['entity'], 'small');

$title = $vars['entity']->title;
if (!$title) {
	$title = $vars['entity']->name;
}
if (!$title) {
	$title = get_class($vars['entity']);
}

if (elgg_instanceof($vars['entity'], 'object')) {
	$metadata = elgg_view('navigation/menu/metadata', $vars);
}

$owner_link = '';
$owner = $entity->getOwnerEntity();
$group = $entity->getContainerEntity();
$group_owner = $group->getOwnerEntity();
if ($owner == $group_owner) {
	// decode email and find out
	$params['include_bodies'] = true;
	$params['decode_bodies']  = true;
	$params['decode_headers'] = true;

	$decoder = new Mail_mimeDecode($entity->data);
	$result = $decoder->decode($params);

	// get message parameters
	$from = htmlspecialchars($result->headers['from']);
	
	$owner_link = $from;

	if ($entity->sender) {
		$owner_link = $owner_link . htmlspecialchars(" <$entity->sender>");
	}
}
else {
	$owner_link = elgg_view('output/url', array(
		'href' => $owner->getURL(),
		'text' => $owner->name,
		'is_trusted' => true,
	));
}

$date = elgg_view_friendly_time($vars['entity']->time_created);

$subtitle = "$owner_link $date";

$excerpt = elgg_get_excerpt($entity->description);

$excerpt .= "<br />";
foreach(array('drop', 'accept') as $button) {
	$excerpt .= elgg_view('output/url', array(
		'text' => elgg_echo("elggman:moderation:$button"),
		'href' => "action/elggman/moderation/$button?guid=$entity->guid",
		'class' => 'elgg-button',
		'is_trusted' => true,
		'is_action' => true,
	));
}

$params = array(
	'entity' => $vars['entity'],
	'title' => $title,
	'content' => $excerpt,
	'metadata' => $metadata,
	'subtitle' => $subtitle,
	'tags' => $vars['entity']->tags,
);
$params = $params + $vars;
$body = elgg_view('object/elements/summary', $params);

echo elgg_view_image_block($icon, $body, $vars);
