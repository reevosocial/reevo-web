<?php
/**
 * Elggman plugin settings
 * 
 * @package Elggman
 */

$readme = " (<a href='". elgg_get_site_url() . "admin_plugin_text_file/elggman/README.md'>README</a>)";
?>
<div>
<?php

// check for mimedecode library
if(!include(elgg_get_plugins_path() . "elggman/vendors/Mail/mimeDecode.php")) {
	// show the failure page with instructions.
	echo "<div>";
	echo elgg_echo('elggman:dependency_fail');
	echo $readme;
	echo "</div>";
} else {
// settings
?>
    <div><label><?php echo elgg_echo('elggman:mailname'); ?></label><br />
    <?php echo elgg_view('input/text', array('name' => 'params[mailname]', 'value' => $vars['entity']->mailname,)); ?>
    </div>
    <div class="mtm"><label><?php echo elgg_echo('elggman:api_key'); ?></label><br />
    <?php echo elgg_view('output/text', array('value' => elggman_apikey())); ?>
    <div class="elgg-text-help"><?php echo elgg_echo('elggman:api_key:description') . $readme; ?> </div>
    </div>
<?php
}
?>
</div>
