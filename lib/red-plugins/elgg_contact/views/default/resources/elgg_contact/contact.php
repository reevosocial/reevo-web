<?php

namespace Beck24\Contact;

elgg_push_breadcrumb(elgg_echo('home'), elgg_get_site_url());
elgg_push_breadcrumb(elgg_echo('contact:contact'));

$title = elgg_echo('contact:contact');

$content = elgg_view_form('contact/email');

$layout_type = 'content';
$shell = 'default';
if (!elgg_is_logged_in() && elgg_get_config('walled_garden')) {
    $layout_type = 'walled_garden';
    $shell = 'walled_garden';
}

$layout = elgg_view_layout($layout_type, array(
    'title' => $title,
    'content' => $content,
    'filter' => false
));

echo elgg_view_page($title, $layout, $shell);
