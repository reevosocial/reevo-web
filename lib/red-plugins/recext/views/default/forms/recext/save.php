<?php
/**
 * Edit / add a recext
 *
 * @package Bookmarks
 */

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$address = elgg_extract('address', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$source = elgg_extract('source', $vars, '');
$image = elgg_extract('image', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
$shares = elgg_extract('shares', $vars, array());

?>
<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title, 'maxlength' => '72')); ?>
</div>
<div>
	<label><?php echo elgg_echo('recext:address'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'address', 'value' => $address)); ?>
</div>
<div>
	<label><?php echo elgg_echo('description'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>
<div>
	<label><?php echo elgg_echo('recext:source'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'source', 'value' => $source)); ?>
</div>
<div>
	<label><?php echo elgg_echo('recext:image'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'image', 'value' => $image)); ?>
</div>
<div>
	<label><?php echo elgg_echo('tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>

<?php

$categories = elgg_view('input/categories', $vars);
if ($categories) {
	echo $categories;
}

?>
<div>
	<label><?php echo elgg_echo('access'); ?></label><br />
	<?php echo elgg_view('input/access', array(
		'name' => 'access_id',
		'value' => $access_id,
		'entity' => get_entity($guid),
		'entity_type' => 'object',
		'entity_subtype' => 'recext',
	)); ?>
</div>
<div class="elgg-foot">
<?php

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>
