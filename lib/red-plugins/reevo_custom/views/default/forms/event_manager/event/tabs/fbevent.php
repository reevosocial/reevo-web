<!-- Este código captura los datos de un evento en FB a partir de su ID y los deja disponible para autocompletar el formulario de creación de evento. -->
<?php
$event = $_GET["fbevent"];
$token = '719872494746214|1bb9b9b55a26e3ce921b2f1cf06d865b';
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

?>
