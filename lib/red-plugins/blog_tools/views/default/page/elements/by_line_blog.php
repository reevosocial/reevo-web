<?php

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof ElggEntity)) {
	return;
}

$by_line = [];

$owner = $entity->getOwnerEntity();
if ($owner instanceof ElggEntity) {
	$owner_url = elgg_extract('owner_url', $vars, $owner->getURL());

	$owner_link = elgg_view('output/url', [
		'href' => $owner_url,
		'text' => $owner->name,
		'is_trusted' => true,
	]);

	$by_line[] = elgg_echo('byline', array($owner_link));
}

// Muestra el campo last_action, porque podemos definir la fecha de publicacion
$by_line[] = ' - ';
$by_line[] = date('d/m/Y', $entity->last_action);

$container_entity = $entity->getContainerEntity();
if ($container_entity instanceof ElggGroup && ($container_entity->getGUID() !== elgg_get_page_owner_guid())) {
	$group_link = elgg_view('output/url', [
		'href' => $container_entity->getURL(),
		'text' => $container_entity->name,
		'is_trusted' => true,
	]);
	$by_line[] = elgg_echo("byline:ingroup", [$group_link]);
}

if (!empty($by_line)) {
	echo implode(' ', $by_line);
}
