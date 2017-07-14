<?php

elgg_admin_gatekeeper();

$guid = get_input('guid');
$entity = get_entity($guid);

if (!$entity) {
	forward('', '404');
}

echo elgg_view_entity($entity, array(
	'full_view' => true,
));