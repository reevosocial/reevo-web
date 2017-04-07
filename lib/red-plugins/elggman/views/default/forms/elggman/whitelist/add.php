<?php
$filter = $vars['filter'];
if (in_array($filter, array('whitelist', 'blacklist'))) {
	echo elgg_view('input/text', array('name' => 'email'));
	echo elgg_view('input/submit', array('name' => 'add',
					'value' => elgg_echo("elggman:$filter:add")));
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['entity']->guid));
	echo elgg_view('input/hidden', array('name' => 'filter', 'value' => $filter));
}
