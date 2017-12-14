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

// Cambia el formato de los titulos si ya se programaron para FB
if ($recext->phpsfp && elgg_is_admin_logged_in()) {
	$yapublicado = 'style = "font-style: italic; font-weight: 300;"';
}

	echo <<<HTML
	<a class="recext-gallery-item" style="background-image: url('$image')" href="{$recext->getURL()}">
		<header>
			<h3 $yapublicado>$recext->title</h3>
			<span class='subtitle'>$recext->source</span>
		</header>
	</a>
HTML;
