<?php
/**
 *	Elgg No Friends
 *	@package nofriends
 *	@author RiverVanRain
 *	@license GNU General Public License version 2
 *	@link http://o.wzm.me/crewz/p/1983/personal-net
 **/

$group = $vars['entity'];
$owner = $group->getOwnerEntity();
$forward_url = $group->getURL();

echo elgg_view('input/userpicker');
echo '<div class="elgg-foot">';
echo elgg_view('input/hidden', array('name' => 'forward_url', 'value' => $forward_url));
echo elgg_view('input/hidden', array('name' => 'group_guid', 'value' => $group->guid));
echo elgg_view('input/submit', array('value' => elgg_echo('invite')));
echo '</div>';