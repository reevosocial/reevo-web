<?php

$entity = elgg_extract('entity', $vars);

if ($entity) {
	$template = $entity->template;
	$language = $entity->language;
} else {
	$template = elgg_extract('template', $vars);
	$language = elgg_extract('language', $vars);
}

if ($language) {
	echo elgg_view_input('hidden', array(
		'name' => 'language',
		'value' => $language,
	));
} else {
	echo elgg_view_input('select', array(
		'name' => 'language',
		'value' => $entity->language ? : 'en',
		'options_values' => get_installed_translations(),
		'label' => elgg_echo('notifications:editor:language'),
	));
}

if ($template) {
	echo elgg_view_input('hidden', array(
		'name' => 'template',
		'value' => $template,
	));
} else {

	elgg_require_js('forms/notifications/editor/edit');

	$events = _elgg_services()->events->getAllHandlers();
	$event_options = array_keys($events);
	sort($event_options);

	echo elgg_view_input('select', array(
		'name' => 'event',
		'value' => $entity->event ? : 'publish',
		'options' => $event_options,
		'label' => elgg_echo('notifications:editor:event'),
	));

	echo elgg_view_input('select', array(
		'name' => 'object_type',
		'value' => $entity->object_type,
		'options' => array(
			'', 'object', 'user', 'group', 'site', 'relationship', 'annotation',
		),
		'id' => 'notifications-editor-type',
		'label' => elgg_echo('notifications:editor:object_type'),
	));

	echo elgg_view_input('select', array(
		'name' => 'object_subtype',
		'value' => $entity->object_subtype,
		'options' => array(
			$entity->object_subtype ? : '',
		),
		'id' => 'notifications-editor-subtype',
		'label' => elgg_echo('notifications:editor:object_subtype'),
	));
}

echo elgg_view_input('text', array(
	'name' => 'subject',
	'value' => $entity->subject,
	'required' => true,
	'label' => elgg_echo('notifications:editor:subject'),
	'help' => elgg_echo('notifications:editor:subject:help'),
));

echo elgg_view_input('plaintext', array(
	'name' => 'summary',
	'value' => $entity->summary,
	'required' => true,
	'label' => elgg_echo('notifications:editor:summary'),
));

echo elgg_view_input('plaintext', array(
	'name' => 'body',
	'value' => $entity->body,
	'required' => true,
	'label' => elgg_echo('notifications:editor:body'),
));

echo elgg_view_input('hidden', array(
	'name' => 'guid',
	'value' => $entity->guid,
));

if ($entity->template_folder) {
	echo elgg_format_element('div', ['class' => 'elgg-text-help'], 'View Folder: ' . $entity->template_folder);
}

echo '<div class="elgg-foot clearfix">';

if ($entity->guid) {
	echo elgg_view('output/url', array(
		'href' => "action/entity/delete?guid=$entity->guid",
		'text' => elgg_echo('delete'),
		'is_action' => true,
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
echo elgg_view_input('submit', array(
	'value' => elgg_echo('save'),
));
echo '</div>';