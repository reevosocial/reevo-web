<!-- Este código captura los datos de un evento en FB a partir de su URL y los deja disponible para autocompletar el formulario de creación de evento. -->
<?php

$event_url = $_GET["fbevent"];
if (strpos($event_url, 'facebook.com/events') == true) {
    $segments = explode('/', $event_url);
    $event = $segments[4];

    $token = elgg_get_plugin_setting('fb_apptoken', 'reevo_custom');
    // Step 1
    $cSession = curl_init();
    // Step 2
    curl_setopt($cSession,CURLOPT_URL,'https://graph.facebook.com/v2.10/'.$event.'?fields=name%2Cowner%2Cdescription%2Ccover%2Cplace%2Cstart_time%2Cend_time%2Cticket_uri&access_token='.$token);

    // curl_setopt($cSession,CURLOPT_URL,'https://graph.facebook.com/v2.10/309395482865978?access_token='.$token);
    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER, false);
    // Step 3
    $result=curl_exec($cSession);
    // Step 4
    curl_close($cSession);
    // Step 5

    global $fbevent;
    $fbevent = json_decode($result, true);
    // print_r($fbevent);
}

?>
