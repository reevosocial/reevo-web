<?php

$user = get_user(get_input('user_guid'));

$order = array('name' => 'badges_name', 'direction' => ASC);
$entities = elgg_get_entities_from_metadata(array('type' => 'object', 'subtype' => 'badge', 'limit' => false, 'order_by_metadata' => $order));

foreach ($entities as $entity) {
	$label = "<img src=\"" . elgg_add_action_tokens_to_url(elgg_get_site_url() . 'action/badges/view?file_guid=' . $entity->guid) . "\"> " . $entity->title . " - {$entity->badges_userpoints} " . elgg_echo('badges:points');
	$options[$label] = $entity->guid;
}

$body = "<div class='mtl mbm'><label>" . elgg_echo("badges:username") . ":</label><br>";
$body .= elgg_view("input/text", array('name' => 'username', 'value' => $user->username));
$body .= "</div>";

$body .= "<div class='mbm'>";
$body .= elgg_view('input/checkboxes', array(
	'name' => 'locked',
	'id' => 'locked',
	'options' => array(elgg_echo('badges:lock') => 0)
));
$body .= elgg_view("output/longtext", array("value" => elgg_echo("badges:lock:info"), 'class' => 'elgg-subtext'));
$body .= "</div>";

$body .= "<div class='mbl'><label>" . elgg_echo("badges:assign_list") . "</label><br>";
$body .= elgg_view("input/radio", array('name' => 'badge', 'value' => $entity->guid,  'options' => $options));
$body .= "</div>";

$body .= elgg_view('input/submit', array('value' => elgg_echo("badges:assign_badge")));

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'body' => $body);

$form = elgg_view_form('badges/assign', $form_vars, $vars);

echo $form;
