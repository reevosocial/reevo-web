<?php
/**
 * New recext river entry
 *
 * @package Bookmarks
 */

$item = $vars['item'];
/* @var ElggRiverItem $item */

$object = $item->getObjectEntity();
$excerpt = elgg_get_excerpt($object->description);
$img = elgg_view('output/img', array(
	'src' => $object->image,
	'alt' => $title,
));

$vars['attachments'] = $img;
$vars['message'] = $excerpt;

echo elgg_view('page/components/image_block', array( 'image' => elgg_view('river/elements/image', $vars), 'body' => elgg_view('river/elements/body', $vars), 'class' => 'elgg-river-item elgg-river-item-recext',)
);
