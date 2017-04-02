<?php
/**
 * Post comment on image river view
 */

elgg_load_js('tidypics');
elgg_load_js('lightbox');
elgg_load_css('lightbox');

$item = $vars['item'];

$comment = $item->getObjectEntity();
$subject = $item->getSubjectEntity();
$target = $item->getTargetEntity();

$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$target_link = elgg_view('output/url', array(
	'href' => $target->getURL(),
	'text' => $target->getDisplayName(),
	'class' => 'elgg-river-target',
	'is_trusted' => true,
));

$attachments = '';
$river_comments_thumbnails = elgg_get_plugin_setting('river_comments_thumbnails', 'tidypics');
if ($river_comments_thumbnails == "show") {
	$preview_size = elgg_get_plugin_setting('river_thumbnails_size', 'tidypics');
	if(!$preview_size) {
		$preview_size = 'tiny';
	}
	$image = $target;
	$attachments = elgg_view_entity_icon($image, $preview_size, array(
		'href' => $image->getIconURL('master'),
		'img_class' => 'tidypics-photo',
		'link_class' => 'tidypics-lightbox',
	));
}

$summary = elgg_echo('river:comment:object:image', array($subject_link, $target_link));

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'attachments' => $attachments,
	'message' => elgg_get_excerpt($comment->description),
		'summary' => $summary,
));
