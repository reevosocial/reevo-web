<?php
/**
 * View a recext
 *
 * @package ElggBookmarks
 */

elgg_register_plugin_hook_handler('header', 'opengraph', function ($hook, $handler, $return, $params){
	$guid = get_input('guid');
	elgg_entity_gatekeeper($guid, 'object', 'recext');
	$recext = get_entity($guid);
	$baseurl = rtrim(elgg_get_site_url(), "/");
	if (preg_match('/'.str_replace('/','\\/',elgg_get_site_url()).'recext/', $params['url'])) {
			$return['og:description'] = strip_tags($recext->description);
			$return['og:image'] = $baseurl . $recext->image;
			return $return;
	}
});

$guid = get_input('guid');

elgg_entity_gatekeeper($guid, 'object', 'recext');

$recext = get_entity($guid);

$page_owner = elgg_get_page_owner_entity();

elgg_group_gatekeeper();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "recext/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "recext/owner/$page_owner->username");
}

$title = $recext->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($recext, array('full_view' => true));
$content .= elgg_view_comments($recext);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => ''
));

echo elgg_view_page($title, $body);
