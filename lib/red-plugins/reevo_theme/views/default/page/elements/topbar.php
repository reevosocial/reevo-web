<?php
/**
 * Elgg topbar
 * The standard elgg top toolbar
 */

// Elgg logo
echo elgg_view_menu('topbar', array('sort_by' => 'priority', array('elgg-menu-hz')));

// elgg tools menu
// need to echo this empty view for backward compatibility.
echo elgg_view_deprecated("navigation/topbar_tools", array(), "Extend the topbar menus or the page/elements/topbar view directly", 1.8);

/**
 * Topbar navigation menu
 *
 * @uses $vars['menu']['default']
 * @uses $vars['menu']['alt']
 */

$default_items = elgg_extract('default', $vars['menu'], array());
$alt_items     = elgg_extract('alt', $vars['menu'], array());

$site          = elgg_get_site_entity();
$site_name     = $site->name;
$site_url      = $site->url;

$wiki_url      = elgg_get_plugin_setting('wiki_url', 'reevo');

$display_form  = false;

if (elgg_is_logged_in()) {

	$user = elgg_get_logged_in_user_entity();
	$avatar      = $user->getIconURL('topbar');
	$username    = $user->name;
	$profile_url = $user->getURL();

} else {
	// drop-down login
	echo elgg_view('core/account/login_dropdown');

	// $avatar       = ''; // @todo: put some login icon
	// $username     = elgg_echo('login');
	// $profile_url  = '/login';
	//
	// $display_form = true;

}
$site = elgg_get_site_entity();

$ia = elgg_set_ignore_access(true);


echo '<ul id="topbar-menu-text">';
display_static_menu();
echo '</ul>';

// elements in the topbar
echo <<<__HTML
		<a title="$site_name" href="$site_url" class="brand navbar-left"></a>


__HTML;

// dropdown contents

if ($display_form) {

	echo '<li class="dropdown" style="padding:10px">';
	echo elgg_view_form('login');
	echo '</li>';

} else {

	foreach ($alt_items as $menu_item) {
		echo elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
	}

	if ($more_items) {
		echo elgg_view('navigation/menu/elements/section', array(
			'class' => 'elgg-menu elgg-menu-site elgg-menu-site-more dropdown-menu',
			'items' => $more_items,
		));
	}

}
echo '</ul>';
echo '</div><!-- /button group -->';
