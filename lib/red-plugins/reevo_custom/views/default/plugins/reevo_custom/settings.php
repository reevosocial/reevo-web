<?php

$fb_apptoken       = elgg_get_plugin_setting('fb_apptoken', 'reevo_custom');
$fb_apptoken_input = elgg_view('input/text',
	array(
		'name'  => 'params[fb_apptoken]',
		'value' => $fb_apptoken,
		'class' => 'wiki-url'
	)
);
$fb_apptoken_url_tip = elgg_echo('reevo_custom:fbevent:token:label');

// General settings information
$wiki_title    = elgg_echo('reevo_custom:fbevent:token:title');

echo <<<___HTML

<div>
  <fieldset>
    <h3>$wiki_title</h3>

    <p><label for="params[fb_apptoken]">$fb_apptoken_url_label</label>
       $fb_apptoken_input<br/><span class="tip">$fb_apptoken_url_tip</span></p>
  </fieldset>

</div>

___HTML;
