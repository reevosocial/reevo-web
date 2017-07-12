<?php

$segments = elgg_extract('segments', $vars);
$section = array_shift($segments);
$page = array_shift($segments);

switch ($page) {
	default :
	case 'templates' :
		echo elgg_view_resource('notifications/editor/templates');
		return;

	case 'edit' :
		echo elgg_view_resource('notifications/editor/edit', array(
			'guid' => $segments[0]
		));
		return;

	case 'view' :
		echo elgg_view_resource('notifications/editor/view', array(
			'guid' => $segments[0]
		));
		return;
}