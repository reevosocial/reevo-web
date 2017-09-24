<?php

function blog_get_page_content_list_custom($container_guid = NULL) {

	$return = array();

	$return['filter_context'] = $container_guid ? 'mine' : 'all';

	$options = array(
		'type' => 'object',
		'subtype' => 'blog',
		'full_view' => false,
		'no_results' => elgg_echo('blog:none'),
		'preload_owners' => true,
		'distinct' => false,
	);

	$current_user = elgg_get_logged_in_user_entity();

	if ($container_guid) {
		// access check for closed groups
		elgg_group_gatekeeper();

		$container = get_entity($container_guid);
		if ($container instanceof ElggGroup) {
		$options['container_guid'] = $container_guid;
		} else {
			$options['owner_guid'] = $container_guid;
		}
		$return['title'] = elgg_echo('blog:title:user_blogs', array($container->name));

		$crumbs_title = $container->name;
		elgg_push_breadcrumb($crumbs_title);

		if ($current_user && ($container_guid == $current_user->guid)) {
			$return['filter_context'] = 'mine';
		} else if (elgg_instanceof($container, 'group')) {
			$return['filter'] = false;
		} else {
			// do not show button or select a tab when viewing someone else's posts
			$return['filter_context'] = 'none';
		}
	} else {
		$options['preload_containers'] = true;
		$return['filter_context'] = 'all';
		$return['title'] = elgg_echo('blog:title:all_blogs');
		elgg_pop_breadcrumb();
		elgg_push_breadcrumb(elgg_echo('blog:blogs'));
	}

  if (group_tools_blogadmin_access($container_guid) == 1) {
    elgg_register_title_button('blog', 'add', 'object', 'blog');
  }


	$return['content'] = elgg_list_entities($options);

	return $return;
}


$subpage = elgg_extract('subpage', $vars);
$page_type = elgg_extract('page_type', $vars);
$group_guid = elgg_extract('group_guid', $vars);
$lower = elgg_extract('lower', $vars);
$upper = elgg_extract('upper', $vars);

$group = get_entity($group_guid);

if (!elgg_instanceof($group, 'group')) {
	forward('', '404');
}

if (!isset($subpage) || $subpage == 'all') {
	$params = blog_get_page_content_list_custom($group_guid);
} else {
	$params = blog_get_page_content_archive($group_guid, $lower, $upper);
}

$params['sidebar'] = elgg_view('blog/sidebar', ['page' => $page_type]);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);

?>
