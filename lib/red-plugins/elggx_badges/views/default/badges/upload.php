<?php

$body = "<div class='mtl mbm'><label>" . elgg_echo("badges:image") . "<font color='red'> (" . elgg_echo("badges:required") . ")</font>:</label><br>";
$body .= elgg_view("input/file", array('name' => 'badge'));
$body .= "</div>";

$body .= "<div class='mbm'><label>" . elgg_echo("badges:name") . "<font color='red'> (" . elgg_echo("badges:required") . ")</font>:</label><br>";
$body .= elgg_view("input/text", array('name' => 'name'));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:name:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbm'><label>" . elgg_echo("badges:description") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'description'));
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
		'value' => '2'
));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:description:access_id"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbm'><label>" . elgg_echo("badges:description:url") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'url'));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:description:url:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbl'><label>" . elgg_echo("badges:points") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'points'));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:points:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= elgg_view('input/submit', array('value' => elgg_echo("upload")));

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'body' => $body
);

$form = elgg_view_form('badges/upload', $form_vars, $vars);

echo $form;
