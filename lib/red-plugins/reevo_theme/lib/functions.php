<?php

function display_static_menu() {
  // Agrega paginas estaticas generadas con el plugin static
  $site = elgg_get_site_entity();

  if (elgg_is_active_plugin('static')) {
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

  	foreach ($entities as $menu_item) {
  		$url = $menu_item->getURL();
  		$title = $menu_item->title;
  		echo '<li class="elgg-menu-item-groups"><a href="'.$url.'" class="elgg-menu-content">'.$title.'</a></li>';
  	}
  }

  // Contacto
  if (elgg_is_active_plugin('elgg_contact')) {
  	$url = '/contact';
  	$title = elgg_echo('contact:contact');
  	echo '<li class="elgg-menu-item-groups"><a href="'.$url.'" class="elgg-menu-content">'.$title.'</a></li>';
  }

  // Donar
  $url = 'https://donar.reevo.org';
  $title = elgg_echo('aalborg_theme_reevo:donate');
  echo '<li class="elgg-menu-item-groups"><a href="'.$url.'" class="elgg-menu-content">'.$title.'</a></li>';
}
