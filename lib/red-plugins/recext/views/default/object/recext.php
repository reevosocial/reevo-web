<?php
/**
 * Elgg recext view
 *
 * @package ElggBookmarks
 */

$full = elgg_extract('full_view', $vars, FALSE);
$recext = elgg_extract('entity', $vars, FALSE);

if (!$recext) {
	return;
}

$owner = $recext->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$categories = elgg_view('output/categories', $vars);

$link = elgg_view('output/url', array('href' => $recext->address));
$description = elgg_view('output/longtext', array('value' => $recext->description, 'class' => 'pbl'));
$image = elgg_view('output/text', array('value' => $recext->image));
$source = elgg_view('output/text', array('value' => $recext->source));


$owner_link = elgg_view('output/url', array(
	'href' => "recext/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($recext->time_created);

$comments_count = $recext->countComments();
//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $recext->getURL() . '#comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'recext',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full && !elgg_in_context('gallery')) {

	$params = array(
		'entity' => $recext,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	$recext_icon = elgg_view_icon('push-pin-alt');
	$linksource = elgg_echo('recext:linksource', array($source));

	$body = <<<HTML
<div class="recext elgg-content mts">
	<img class="recext-single-image" src="$image" />
	<span class="recext-single-desc">$description</span>
	<span class="recext-single-link"><a href="{$recext->address}">{$linksource}</a></span>


</div>
HTML;

	echo elgg_view('object/elements/full', array(
		'entity' => $recext,
		'icon' => $owner_icon,
		'summary' => $summary,
		'body' => $body,
	));

} elseif (elgg_in_context('gallery')) {
	echo <<<HTML
<div class="recext-gallery-item">
	<img style="width:100%" src="$image" />
	<h3>$recext->title</h3>
	<p class='subtitle'>$owner_link $date</p>
</div>
HTML;
} else {
	// brief view
	$url = $recext->address;
	$display_text = $url;
	$excerpt = elgg_get_excerpt($recext->description);
	if ($excerpt) {
		$excerpt = " - $excerpt";
	}

	if (strlen($url) > 25) {
		$bits = parse_url($url);
		if (isset($bits['host'])) {
			$display_text = $bits['host'];
		} else {
			$display_text = elgg_get_excerpt($url, 100);
		}
	}

	$link = elgg_view('output/url', array(
		'href' => $recext->address,
		'text' => $display_text,
	));

	$content = elgg_view_icon('push-pin-alt') . "$link{$excerpt}";

	$params = array(
		'entity' => $recext,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $content,
	);
	$params = $params + $vars;
	$body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $body);
}
