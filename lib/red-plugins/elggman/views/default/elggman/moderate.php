<?php
	$group = $vars['entity'];
	$options = array('type' => 'object',
			'subtype' => 'moderated_discussion',
			'count' => true,
			'container_guid' => $group->guid);
	$count = elgg_get_entities($options);

	if ($count) {
		echo "<div>".elgg_echo('elggman:moderation:messages', array($count))."</div>";

		$content = '';
		foreach(array('drop', 'accept') as $button) {
			$content .= elgg_view('output/url', array(
				'text' => elgg_echo("elggman:moderation:{$button}_all"),
				'href' => "action/elggman/moderation/{$button}_all?guid=$group->guid",
				'class' => 'elgg-button',
				'is_trusted' => true,
				'is_action' => true,
			));
		}

		$options['count'] = FALSE;
		$content .= elgg_list_entities($options);

		echo $content;
	}
	else {
		echo elgg_echo('elggman:moderation:nocontent');
	}
?>
