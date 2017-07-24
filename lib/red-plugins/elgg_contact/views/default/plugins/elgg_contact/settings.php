<?php

echo elgg_echo('contact:recipients');
echo elgg_view('input/plaintext', array(
    'name' => 'params[recipients]',
    'value' => $vars['entity']->recipients
));
echo elgg_view('output/longtext', array(
    'value' => elgg_echo('contact:recipients:help'),
    'class' => 'elgg-subtext'
));

echo '<br><br>';

echo elgg_view('input/dropdown', array(
    'name' => 'params[inputtype]',
    'value' => $vars['entity']->inputtype,
    'options_values' => array(
        'plaintext' => elgg_echo('option:no'),
        'longtext' => elgg_echo('option:yes')
    )
));
echo ' ' . elgg_echo('contact:inputtype');

echo '<br><br>';

echo elgg_echo('contact:received:text');
echo elgg_view('input/longtext', array(
    'name' => 'params[received]',
    'value' => $vars['entity']->received
));

echo '<br><br>';
