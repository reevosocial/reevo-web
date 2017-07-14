<?php

elgg_admin_gatekeeper();

elgg_push_breadcrumb(elgg_echo('notifications'), '/notifications');
elgg_push_breadcrumb(elgg_echo('notifications:editor'), '/notifications/editor');
elgg_push_breadcrumb(elgg_echo('notifications:editor:edit'));

$template = get_input('template');
$language = get_input('language');

if (!$template || !$language) {
	forward('', '400');
}

$form = 'notifications/editor/edit';
if (elgg_is_sticky_form($form)) {
	$sticky = elgg_get_sticky_values($form);
	if (is_array($sticky)) {
		$vars = array_merge($vars, $sticky);
	}
	elgg_clear_sticky_form($form);
}

$languages = get_installed_translations();

$vars['template'] = $template;
$vars['language'] = $language;
$vars['entity'] = notifications_editor_get_template_entity($template, $language);

$title = $vars['entity']->getDisplayName();

$form = elgg_view_form($form, array(), $vars);
$content = elgg_view_module('info', $string, $form);

$layout = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'filter' => false,
));

echo elgg_view_page($title, $layout);