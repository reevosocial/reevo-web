<?php

    // Make sure we don't get any nasty errors when no settings are present
    if (!elgg_get_config('site_opengraph'))
        elgg_set_config('site_opengraph', array());

    // Set some sensible defaults, merging with overrides from config settings
    elgg_set_config('site_opengraph', array_merge(array(
        'og:title' => $vars['title'],
        'og:type' => 'website',
        'og:url' => current_page_url(),
        'og:site_name' => elgg_get_config('sitename'),
        'og:description' => elgg_get_config('sitedescription'),
        'fb:app_id' => '1724849754416904', // App id de red.reevo
        'og:image' => 'https://assets.reevo.org/banners/reevo_ogimage_default.es.png' // Imagen por defecto

    ), elgg_get_config('site_opengraph')));


    $headers = elgg_trigger_plugin_hook('header', 'opengraph', array('url' => current_page_url()), elgg_get_config('site_opengraph'));

    foreach ($headers as $property => $content) {
        ?>
        <meta property="<?=$property;?>" content="<?=$content;?>" />
        <?php
    }
