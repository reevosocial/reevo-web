<?php

$entity = $vars['entity'];
if ($entity->elggman_moderate) {
	$moderate = 'on';
}

echo "<div class='mts'>";
echo elgg_view('input/checkbox', array('name' => 'moderate', 'value' => 'on', 'checked' => $moderate));
echo '<label>'.elgg_echo('elggman:moderation:allow').'<label>';
echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->guid));
echo "</div>";
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('elggman:settings:save')));
