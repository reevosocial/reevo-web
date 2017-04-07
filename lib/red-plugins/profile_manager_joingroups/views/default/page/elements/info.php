<?php
if (!elgg_is_logged_in()) {
  $guid = elgg_get_page_owner_guid();
  $group = get_entity($guid);
  $url = elgg_get_site_url() . "register?g=$guid&goto=/g/{$group->alias}";

  elgg_register_menu_item('title', array(
    'name' => 'register_and_join_button',
    'href' => $url,
    'text' => elgg_echo('profile_manager_joingroups:register_and_join_button'),
    'link_class' => 'elgg-button elgg-button-action',
  ));
  //print_r($params);
  // print_r($vars);
  //elgg_log('algo '.$params['current_url']);
}
