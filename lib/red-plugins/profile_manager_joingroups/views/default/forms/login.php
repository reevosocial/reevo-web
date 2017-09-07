<?php
/**
 * Elgg login form
 *
 * @package Elgg
 * @subpackage Core
 */
$groups = get_input('g');
$goto = get_input('goto');


echo elgg_view_field([
	'#type' => 'text',

	'name' => 'username',
	'autofocus' => true,
	'required' => true,
	'#label' => elgg_echo('loginusername'),
]);

echo elgg_view_field([
	'#type' => 'password',
	'name' => 'password',
	'required' => true,
	'#label' => elgg_echo('password'),
]);

echo elgg_view('login/extend', $vars);

if (isset($vars['returntoreferer'])) {
	echo elgg_view_field([
		'#type' => 'hidden',
		'name' => 'returntoreferer',
		'value' => 'true'
	]);
}

ob_start();
?>
<div style="display:none;">
	<label for='register-groups'><?php echo 'Grupos'; ?></label>

	<div class='profile_manager_register_input_container'>
		<?php
		echo elgg_view('input/text', array(
			'id' => 'register-groups',
			'name' => 'groups',
			'value' => $groups,
		));
		?>
	</div>

	<div class='profile_manager_register_input_container'>
		<?php
		echo elgg_view('input/text', array(
			'id' => 'register-goto',
			'name' => 'goto',
			'value' => $goto,
		));
		?>
	</div>


</div>


<div class="elgg-foot">
	<label class="mtm float-alt">
		<input type="checkbox" name="persistent" value="true" />
		<?php echo elgg_echo('user:persistent'); ?>
	</label>

	<?php
	echo elgg_view('input/submit', array('value' => elgg_echo('login')));

	echo elgg_view_menu('login', array(
		'sort_by' => 'priority',
		'class' => 'elgg-menu-general elgg-menu-hz mtm',
	));
	?>
</div>
<?php
$footer = ob_get_clean();
elgg_set_form_footer($footer);
