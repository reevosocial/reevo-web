<?php


echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('title'),
	'name' => 'title',
	'value' => $vars['title'],
	'arequired' => true,
]);

echo elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

?>

<p><?php echo elgg_echo("recext:recextlet:description"); ?></p>
