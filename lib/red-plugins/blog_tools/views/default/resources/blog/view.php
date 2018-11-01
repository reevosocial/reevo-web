<?php

elgg_register_plugin_hook_handler('header', 'opengraph', function ($hook, $handler, $return, $params){
	$guid = get_input('guid');
	elgg_entity_gatekeeper($guid, 'object', 'blog');
	$blog = get_entity($guid);
  $owner = $blog->getOwnerEntity();
	$baseurl = rtrim(elgg_get_site_url(), "/");
  $sitename = elgg_get_config('sitename');
	// <meta property="og:image" content="http://red.reevo.dev/serve-file/e0/l1504615308/di/c1/8JbGZILcXbpFWUFm4ON8FVrCb3VJz_92V4dNJ7CSYgM/25000/26460/icons/icon/master.jpg" />

	if ($blog->hasIcon('master')) {
		$icon = $blog->getIcon('master');
		$iconfinal = elgg_get_inline_url($icon, false);
		$return['og:image'] = $iconfinal;
	}

	if (preg_match('/'.str_replace('/','\\/',elgg_get_site_url()).'blog/', $params['url'])) {
    $return['og:title'] = $blog->title . ' - ' .$owner->name . ' | ' . $sitename;
    $return['og:description'] = strip_tags($blog->excerpt);
		return $return;
	}
});

$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);

elgg_entity_gatekeeper($guid, 'object', 'blog');
elgg_group_gatekeeper();


$blog = get_entity($guid);
$container = $blog->getContainerEntity();

elgg_set_page_owner_guid($blog->container_guid);

// no header or tabs for viewing an individual blog
$params = [
	'filter' => '',
	'title' => $blog->title
];

$crumbs_title = $container->name;

if (elgg_instanceof($container, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "blog/group/$container->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "blog/owner/$container->username");
}

elgg_push_breadcrumb($blog->title);

$params['content'] = elgg_view_entity($blog, array('full_view' => true));

// check to see if we should allow comments
if ($blog->comments_on != 'Off' && $blog->status == 'published') {
	$params['content'] .= elgg_view_comments($blog);
}

$params['sidebar'] = elgg_view('blog/sidebar', array('page' => $page_type));

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);
