<?php

namespace Beck24\Contact;

elgg_make_sticky_form('contact');

$first_name = get_input('first_name');
$last_name = get_input('last_name');
$country = get_input('country');
$city = get_input('city');

$country_list = array("1002"=>"Albania","1082"=>"Alemania","1005"=>"Andorra","1006"=>"Angola","1007"=>"Anguilla","1009"=>"Antigua y Barbuda","1008"=>"Antártica","1187"=>"Arabia Saudí","1003"=>"Argelia","1010"=>"Argentina","1011"=>"Armenia","1012"=>"Aruba","1013"=>"Australia","1014"=>"Austria","1015"=>"Azerbayán","1212"=>"Bahamas","1016"=>"Bahrein","1017"=>"Bangladesh","1018"=>"Barbados","1021"=>"Belice","1022"=>"Benín","1023"=>"Bermuda","1019"=>"Bielorrusia","1025"=>"Bolivia","1250"=>"Bonaire, San Eustaquio y Saba","1026"=>"Bosnia Herzegovina","1027"=>"Botswana","1029"=>"Brasil","1032"=>"Brunei Darussalam","1033"=>"Bulgaria","1034"=>"Burkina Faso","1036"=>"Burundi","1024"=>"Bután","1020"=>"Bélgica","1040"=>"Cabo Verde","1037"=>"Camboya","1038"=>"Camerún","1039"=>"Canadá","1043"=>"Chad","1044"=>"Chile","1045"=>"China","1057"=>"Chipre","1048"=>"Colombia","1049"=>"Comores","1050"=>"Congo, Repúbica Democrática del","1114"=>"Corea, República Popular Democrática de","1115"=>"Corea, República de","1053"=>"Costa Rica","1055"=>"Croacia","1056"=>"Cuba","1248"=>"CuraÃ§ao","1054"=>"CÃ´te d'Ivoire","1059"=>"Dinamarca","1060"=>"Djibuti","1061"=>"Dominica","1064"=>"Ecuador","1065"=>"Egipto","1066"=>"El Salvador","1225"=>"Emiratos Árabes Unidos","1068"=>"Eritrea","1192"=>"Eslovaquia","1193"=>"Eslovenia","1198"=>"España","1228"=>"Estados Unidos","1069"=>"Estonia","1070"=>"Etiopía","1177"=>"Federación Rusa","1074"=>"Fidji","1170"=>"Filipinas","1075"=>"Finlandia","1076"=>"Francia","1080"=>"Gabón","1213"=>"Gambia","1081"=>"Georgia","1083"=>"Ghana","1084"=>"Gibraltar","1087"=>"Granada","1085"=>"Grecia","1086"=>"Groenlandia","1088"=>"Guadalupe","1089"=>"Guam","1090"=>"Guatemala","1077"=>"Guayana Francesa","1245"=>"Guernsey","1091"=>"Guinea","1067"=>"Guinea Ecuatorial","1092"=>"Guinea-Bissau","1093"=>"Guyana","1094"=>"Haití","1152"=>"Holanda","1097"=>"Honduras","1098"=>"Hong Kong","1099"=>"Hungría","1101"=>"India","1102"=>"Indonesia","1103"=>"Iran, República de ","1104"=>"Iraq","1105"=>"Irlanda","1028"=>"Isla Bouvet","1046"=>"Isla Christmas","1159"=>"Isla Norfolk","1246"=>"Isla de Man","1100"=>"Islandia","1041"=>"Islas Caimán","1227"=>"Islas Circundantes Menores de los Estados Unidos","1047"=>"Islas Cocos (Keeling)","1052"=>"Islas Cook","1073"=>"Islas Feroe","1197"=>"Islas Georgias del Sur y Sandwich del Sur","1095"=>"Islas Heard y McDonald","1072"=>"Islas Malvinas","1160"=>"Islas Mariana del Norte","1135"=>"Islas Marshall","1194"=>"Islas Salomón","1221"=>"Islas Turcas y Caicos","1031"=>"Islas Vírgenes, Británicas","1234"=>"Islas Vírgenes, E.E.U.U.","1106"=>"Israel","1107"=>"Italia","1108"=>"Jamaica","1109"=>"Japón","1244"=>"Jersey","1110"=>"Jordania","1111"=>"Kazajistán","1112"=>"Kenia","1117"=>"Kirguistán","1113"=>"Kiribati","1251"=>"Kosovo","1116"=>"Kuwait","1118"=>"Laos, República Democrática Popular","1121"=>"Lesoto","1119"=>"Letonia","1122"=>"Liberia","1124"=>"Liechtenstein","1125"=>"Lituania","1126"=>"Luxemburgo","1120"=>"Líbano","1123"=>"Líbia","1127"=>"Macao","1128"=>"Macedonia, República de","1129"=>"Madagascar","1131"=>"Malasia","1130"=>"Malawi","1132"=>"Maldivas","1133"=>"Mali","1134"=>"Malta","1146"=>"Marruecos","1136"=>"Martinica","1138"=>"Mauricio","1137"=>"Mauritania","1139"=>"Mayotte","1141"=>"Micronesia, Estados Federados de","1142"=>"Moldavia","1144"=>"Mongolia","1243"=>"Montenegro","1145"=>"Montserrat","1147"=>"Mozambique","1035"=>"Myanmar","1140"=>"México","1143"=>"Mónaco","1148"=>"Namibia","1149"=>"Nauru","1150"=>"Nepal","1155"=>"Nicaragua","1157"=>"Nigeria","1158"=>"Niue","1161"=>"Noruega","1153"=>"Nueva Caledonia","1154"=>"Nueva Zelanda","1156"=>"Níger","1162"=>"Omán","1163"=>"Pakistán","1164"=>"Palau","1166"=>"Panamá","1167"=>"Papúa Nueva Guinea","1168"=>"Paraguay","1169"=>"Perú","1171"=>"Pitcairn","1078"=>"Polinesa Francesa","1172"=>"Polonia","1173"=>"Portugal","1174"=>"Puerto Rico","1175"=>"Qatar","1226"=>"Reino Unido","1042"=>"República Centroafricana","1058"=>"República Checa","1051"=>"República Democrática del Congo","1062"=>"República Dominicana","1179"=>"Reunión","1178"=>"Ruanda","1176"=>"Rumanía","1249"=>"Saint Maarten (parte holandesa)","1185"=>"Samoa","1004"=>"Samoa Americana","1181"=>"San Cristóbal y Nieves","1186"=>"San Marino","1183"=>"San Pedro y Miquelón","1184"=>"San Vicente y las Granadinas","1180"=>"Santa Helena","1182"=>"Santa Lucía","1096"=>"Santa Sede (Ciudad Estado del Vaticano)","1207"=>"Santo Tomé y Príncipe","1188"=>"Senegal","1242"=>"Serbia","1238"=>"Serbia y Montenegro","1189"=>"Seychelles","1190"=>"Sierra Leona","1191"=>"Singapur","1206"=>"Siria, República Árabe de","1195"=>"Somalia","1199"=>"Sri Lanka","1196"=>"Sudáfrica","1200"=>"Sudán","1204"=>"Suecia","1205"=>"Suiza","1247"=>"Sur de Sudán","1201"=>"Surinam","1202"=>"Svalbard y Jan Mayen","1203"=>"Swazilandia","1236"=>"Sáhara Occidental","1211"=>"Tailandia","1208"=>"Taiwan","1209"=>"Tajikistán","1210"=>"Tanzania, Republica de","1030"=>"Territorio Británico del Océano Índico","1165"=>"Territorio Palestino, Ocupado","1079"=>"Tierras Australes y Antárticas Francesas","1063"=>"Timor Oriental","1214"=>"Togo","1215"=>"Tokelau","1216"=>"Tonga","1217"=>"Trinidad y Tobago","1220"=>"Turkmenistán","1219"=>"Turquía","1222"=>"Tuvalu","1218"=>"Túnez","1224"=>"Ucrania","1223"=>"Uganda","1229"=>"Uruguay","1230"=>"Uzbekistán","1231"=>"Vanuatu","1232"=>"Venezuela","1233"=>"Vietnam","1235"=>"Wallis y Futuna","1237"=>"Yemen","1239"=>"Zambia","1240"=>"Zimbaue","1241"=>"Ã…land Islands</option>");

$country_name = $country_list[$country];


$email = get_input('email');
$subject = get_input('subject');
$message = get_input('message');

if (empty($message) || empty($subject) || empty($email)) {
    register_error(elgg_echo('contact:error:fields'));
    forward(REFERER);
}

if (!is_email_address($email)) {
    register_error(elgg_echo('contact:error:email'));
    forward(REFERER);
}

// we're clear
elgg_clear_sticky_form('contact');

$message = elgg_echo('contact:from',  array($first_name, $last_name, $email));
$message .= elgg_echo('contact:place', array($city, $country_name));
$message .= get_input('message');

// get our admin-defined recipients
$recipient_list = elgg_get_plugin_setting('recipients', PLUGIN_ID);

$recipient_array = explode("\n", $recipient_list);

foreach ($recipient_array as $recipient) {
    $to = trim($recipient);

    if (is_email_address($to)) {
//        elgg_send_email(elgg_get_site_entity()->email, $to, $subject, $message);
        elgg_send_email($email, $to, $subject . ' - ' . $country_name, $message);

    }
}

// cambia la extension de dominio para que funcione la redireccion al CRM tanto en Alfa, Beta o Master
$site = explode('.',elgg_get_site_url());

// forward('contact/received');
forward("http://reevo.{$site[2]}crm/external/?email={$email}&first_name={$first_name}&last_name={$last_name}&city={$city}&state_id=&country_id={$country}&agregar=6&nota=Se suscribió el boletin&url=http://red.reevo.{$site[2]}contact/received");
