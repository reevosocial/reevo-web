<?php

$address = htmlspecialchars(get_input('url', '', false), ENT_QUOTES, 'UTF-8');
$siteurl = elgg_get_site_url();

// don't use elgg_normalize_url() because we don't want
// relative links resolved to this site.
if ($address && !preg_match("#^((ht|f)tps?:)?//#i", $address)) {
	$address = "http://$address";
}

if (!$address ) {
	register_error(elgg_echo('reevo_custom:fbevent:save:failed'));
	forward(REFERER);
}

if (strpos($address, 'facebook.com/events') == false) {
  register_error(elgg_echo('reevo_custom:fbevent:save:failed'));
	forward(REFERER);
}

forward($siteurl . 'events/event/new?fbevent=' . $address);



?>
