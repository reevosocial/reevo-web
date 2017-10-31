<?php
/**
 * Aalborg theme navbar
 *
 */


 $site = elgg_get_site_entity();

 $ia = elgg_set_ignore_access(true);

 $entities = elgg_get_entities_from_metadata([
 	'type' => 'object',
 	'subtype' => StaticPage::SUBTYPE,
 	'metadata_name_value_pairs' => [
 		'parent_guid' => 0,
 	],
		'relationship' => 'subpage_of',
 	'limit' => false,
 	'container_guid' => $site->getGUID(),
 	'joins' => [
 		'JOIN ' . elgg_get_config('dbprefix') . 'objects_entity oe ON e.guid = oe.guid',
 	],
 	'order_by' => 'oe.title asc',
 ]);

 foreach ($entities as $menu_item) {
	 $url = $menu_item->getURL();
	 $title = $menu_item->title;
 }
// print_r($entities);

?>

<span class="icon-bar"></span>
<a class="elgg-button-nav" rel="toggle" href=".elgg-nav-collapse">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
  <span class="icon-bar"></span>
</a>

<!-- <div class="elgg-nav-collapse">
	<ul class="elgg-menu elgg-menu-site elgg-menu-site-default elgg-menu-site-mainmenu clearfix">
		<?php
		foreach ($entities as $menu_item) {
			$url = $menu_item->getURL();
			$title = $menu_item->title;
			echo '<li class="elgg-menu-item-groups"><a href="'.$url.'" class="elgg-menu-content">'.$title.'</a></li>';
		}
		?>
	</ul>
</div> -->

<div class="elgg-nav-collapse">
  <?php
  echo '<ul class="elgg-menu elgg-menu-site elgg-menu-site-default elgg-menu-site-static clearfix">';
    display_static_menu();
    echo '<hr>';
  echo '</ul>';
  echo elgg_view_menu('site');
  ?>
</div>
