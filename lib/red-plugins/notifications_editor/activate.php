<?php

use hypeJunction\Notifications\Template;

require_once __DIR__ . '/autoloader.php';

$subtypes = array(
	Template::SUBTYPE => Template::class,
);

foreach ($subtypes as $subtype => $class) {
	if (!update_subtype('object', $subtype, $class)) {
		add_subtype('object', $subtype, $class);
	}
}