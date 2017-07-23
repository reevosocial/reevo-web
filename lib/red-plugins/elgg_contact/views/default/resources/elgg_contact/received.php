<?php

namespace Beck24\Contact;

elgg_push_breadcrumb(elgg_echo('home'), elgg_get_site_url());
elgg_push_breadcrumb(elgg_echo('contact:contact'), elgg_get_site_url() . 'contact');
elgg_push_breadcrumb(elgg_echo('contact:received'));

$title = elgg_echo('contact:received');

$content = elgg_get_plugin_setting('received', PLUGIN_ID);

if (!$content) {
    $content = elgg_echo('contact:received:default');
}

$layout_type = 'content';
$shell = 'default';
if (!elgg_is_logged_in() && elgg_get_config('walled_garden')) {
    $layout_type = 'walled_garden';
    $shell = 'walled_garden';
}

$layout = elgg_view_layout($layout_type, [
    'title' => $title,
    'content' => $content,
    'filter' => false
]);

echo elgg_view_page($title, $layout, $shell);
