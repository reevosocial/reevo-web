<?php

$user = get_user(get_input('user_guid'));

$body = "<div class='mtl mbl'><label>" . elgg_echo("badges:username") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'username', 'value' => $user->username));
$body .= "</div>";

$body .= elgg_view('input/submit', array('value' => elgg_echo("badges:unassign_badge")));

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'body' => $body
);

$form = elgg_view_form('badges/unassign', $form_vars, $vars);

echo $form;
