<?php
/**
 * E-mail display long text
 * Displays a large amount of text, with new lines converted to line breaks
 *
 * @package Elggman
 *
 * @uses $vars['value'] The text to display
 * @uses $vars['post_url'] URL where you can see the same content
 * @uses $vars['mailing_list'] Mailing list which owns this email. This will appear in footer.
 */

$body = $vars['value'];
$body = html_entity_decode($body, ENT_COMPAT, 'UTF-8'); // Decode any html entities
$body = elgg_strip_tags($body); // Strip tags from message
$body = preg_replace("/(\r\n|\r)/", "\n", $body); // Convert to unix line endings in body
$body = preg_replace("/^From/", ">From", $body); // Change lines starting with From to >From

$group = $vars['mailing_list'];
$mailing_list_name = $group->name;
$mailing_list_email = elggman_get_group_mailinglist($group);
$post_url = $vars['post_url'];

if (!$group) {
	echo $body;
	return true;
}

echo <<<___PLAIN_TEXT
$body
_______________________________________________
$mailing_list_name mailing list
$mailing_list_email
$post_url
___PLAIN_TEXT;
