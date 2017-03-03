<?php
	$filter = elgg_extract('filter', $vars, 'whitelist');
	$group = $vars['entity'];
	$options = array('guid' => $group->guid,
			'annotation_name' => $filter,
			'count' => true);
	$count = elgg_get_annotations($options);

	echo "<h3>".elgg_echo("elggman:$filter:messages", array($count))."</h3>";
	echo elgg_view_form("elggman/whitelist/add", null, array('entity' => $group,
								'filter' => $filter));


	if ($count) {

		$content = '';

		$options['count'] = FALSE;
		$options['limit'] = 10;
		$content .= elgg_list_annotations($options);

		echo $content;
	}
	else {
		echo elgg_echo("elggman:$filter:nocontent");
	}
?>
