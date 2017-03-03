<?php
	$group = $vars['entity'];
	$options = array('type' => 'object',
			'subtype' => 'moderated_discussion',
			'count' => true,
			'container_guid' => $group->guid);
	$count = elgg_get_entities($options);

	if ($group->elggman_moderate) {
		echo "<div class='elggman-moderate'>";
		echo "<h3>".elgg_echo('elggman:moderation')."</h3>";
		if ($count) {
			echo "<div>".elgg_echo('elggman:moderation:messages', array($count))."</div>";
			foreach(array('moderate') as $action) {
				
				echo elgg_view('output/url', array(
							'href'=> "elggman/$action/".$group->guid,
							'text' => elgg_echo("elggman:$action"),
							'class' => 'elgg-button mrs mts',
							));
			}
		}
		else {
			echo "<div>".elgg_echo('elggman:moderation:nocontent')."</div>";
		}
		foreach(array('whitelist', 'blacklist') as $action) {
			
			echo elgg_view('output/url', array(
						'href'=> "elggman/$action/".$group->guid,
						'text' => elgg_echo("elggman:$action"),
						'class' => 'elgg-button mrs mts',
						));
		}
		echo '</div>';
	}

	echo "<div class='elggman-settings mtm'>";
	echo "<h3>".elgg_echo('elggman:group_settings')."</h3>";
	echo elgg_view_form('elggman/group_settings', null, $vars);
	echo "</div>";

?>
