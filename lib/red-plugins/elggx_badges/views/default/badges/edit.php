<?php

$badge = get_entity((int)get_input('guid'));

$back_button =  elgg_view("output/url", array(
	'href' => elgg_get_site_url() . "admin/administer_utilities/elggx_badges",
	'text' => elgg_echo('back'),
	'is_trusted' => true,
	'class' => 'elgg-button elgg-button-action'
));

$body = elgg_view("input/hidden",array('name' => 'guid', 'value' => $badge->guid));

$body .= "<div class='mtl mbm'><label>" . elgg_echo("badges:image_replace") . ":</label><br>";
$body .= elgg_view("input/file", array('name' => 'badge'));
$body .= "</div>";

$body .= "<div class='mbm'><label>" . elgg_echo("badges:name") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'name', 'value' => $badge->title));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:name:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbm'><label>" . elgg_echo("badges:description") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'description', 'value' => $badge->description));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:description:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbm'><label>" . elgg_echo("badges:access_id") . ":</label><br>";
$body .= elgg_view("input/select", array(
	'name' => 'access_id',
	'options_values' => array(
		'0'  => elgg_echo('PRIVATE'),
		'1'  => elgg_echo('LOGGED_IN'),
		'2'  => elgg_echo('PUBLIC'),
		'-2' => elgg_echo('access:friends:label')),
		'value' => $badge->access_id
));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:description:access_id"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbm'><label>" . elgg_echo("badges:description:url") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'url', 'value' => $badge->badges_url));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:description:url:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbl'><label>" . elgg_echo("badges:points") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'points', 'value' => $badge->badges_userpoints));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:points:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= elgg_view('input/submit', array('value' => elgg_echo("save")));

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'body' => $body);

$form = elgg_view_form('badges/edit', $form_vars, $vars);

echo "<div class='mtl'>" . $back_button . "</div>";
echo $form;
