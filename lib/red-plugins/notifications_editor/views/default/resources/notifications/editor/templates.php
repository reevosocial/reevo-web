<?php
	
elgg_admin_gatekeeper();

elgg_push_breadcrumb(elgg_echo('notifications'), '/notifications');
elgg_push_breadcrumb(elgg_echo('notifications:editor'), '/notifications/editor');
elgg_push_breadcrumb(elgg_echo('notifications:editor:templates'));

$templates = notification_editor_get_templates();
$languages = get_installed_translations();

$title = elgg_echo('notifications:editor:templates');
$content = '';

foreach ($templates as $template) {

	$mod = '<ul class="elgg-menu-hz">';
	foreach ($languages as $language => $string) {
		$mod .= '<li class="pas">' . elgg_view('output/url', array(
			'href' => "notifications/editor/edit?template=$template&language=$language",
			'text' => elgg_echo($language),
		)) . '</li>';
	}
	$mod .= '</ul>';

	$template_desc = $template;
	if (elgg_language_key_exists("notification:$template")) {
		$template_desc = elgg_echo("notification:$template");
	}
	$content .= elgg_view_module('info', $template_desc, $mod);
}

$layout = elgg_view_layout('content', array(
	'filter' => false,
	'title' => $title,
	'content' => $content,
));

echo elgg_view_page($title, $layout);