<?php
/**
 *	Elgg No Friends
 *	@package nofriends
 *	@author RiverVanRain
 *	@license GNU General Public License version 2
 *	@link http://o.wzm.me/crewz/p/1983/personal-net
 **/

elgg_load_js('jquery.ui.autocomplete.html');

if (empty($vars['name'])) {
	$vars['name'] = 'members';
}
$name = $vars['name'];
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

$guids = (array)elgg_extract('values', $vars, array());

$handler = elgg_extract('handler', $vars, 'livesearch');
$handler = htmlspecialchars($handler, ENT_QUOTES, 'UTF-8');

$limit = (int)elgg_extract('limit', $vars, 0);

?>
<div class="elgg-user-picker" data-limit="<?php echo $limit ?>" data-name="<?php echo $name ?>" data-handler="<?php echo $handler ?>">
	<input type="text" class="elgg-input-user-picker" size="30"/>
	<ul class="elgg-user-picker-list">
		<?php
		foreach ($guids as $guid) {
			$entity = get_entity($guid);
			if ($entity) {
				echo elgg_view('input/userpicker/item', array(
					'entity' => $entity,
					'input_name' => $vars['name'],
				));
			}
		}
		?>
	</ul>
</div>
<script>
require(['elgg/UserPicker'], function (UserPicker) {
	UserPicker.setup('.elgg-user-picker[data-name="<?php echo $name ?>"]');
});
</script>
