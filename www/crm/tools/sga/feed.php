<?php 

require_once "../../civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';

$array = civicrm_api('Contact','Get',array('group' => array(4 => 1), 'version' =>3, 'rowCount' => 0 ));

/*

*/

$activistas = array();
$vuelta = 0;
foreach($array as $valor) {
	foreach($valor as $valor2) {
		
		// Basic info
		
		$activistas[$vuelta]['crmid'] = $valor2['id'];
		$activistas[$vuelta]['nombre'] = $valor2['first_name'];
		$activistas[$vuelta]['apellido'] = $valor2['last_name'];
		$activistas[$vuelta]['ciudad'] = $valor2['city'];
		$activistas[$vuelta]['pais'] = $valor2['country'];
		$activistas[$vuelta]['email'] = $valor2['email'];
		
		// Get notes info
		$notes = civicrm_api('Note', 'Get', array('entity_table' => 'civicrm_contact', 'entity_id' => $valor2['id'], 'version' => 3));
		$max = 0;
		foreach($notes as $valor3) {
				foreach(array_reverse($valor3) as $valor4) {
					if ($max == 0) {
						$activistas[$vuelta]['nota_id'] = $valor4['id'];
						$activistas[$vuelta]['fecha'] = $valor4['modified_date'];
						$activistas[$vuelta]['asunto'] = $valor4['subject'];
						$activistas[$vuelta]['contenido'] = str_replace(array("\r", "\n"), "", $valor4['note']);
						$autor = civicrm_api('Contact','Get', array('id' => $valor4['contact_id'], 'version' =>3));
							foreach($autor as $valor5) { foreach($valor5 as $valor6) {
									if ($valor6['first_name']) {
										$activistas[$vuelta]['autor_nota'] = $valor6['first_name'];
									} else {
										$activistas[$vuelta]['autor_nota'] = '';
									}
								}
							}
						$max = 1;
					}
				}
		} // End notes		

		
		

	$vuelta = ($vuelta + 1);
	}

}

// Sort according to note's id
usort($activistas, function($a1, $a2) {
   $v1 = $a1['nota_id'];
   $v2 = $a2['nota_id'];
   return $v2 - $v1; // $v2 - $v1 to reverse direction
});

echo '<?xml version="1.0" encoding="utf-8"?>
	<rss version="2.0">
		<channel>
		<title></title>
		';

	$max = 0;
foreach($activistas as $valor) {
	if ($max != 20) {
		$max = ($max + 1);
		echo "<item>\n";
		echo "<pubDate>". $valor["fecha"] ."</pubDate>\n";
		if ($valor["autor_nota"] != "") {
			echo "<title>" . $valor["nombre"] ." ".  $valor["apellido"] . " (". $valor["ciudad"] .", ". $valor["pais"].") > ".$valor["asunto"].": ".$valor["contenido"]." por ".$valor["autor_nota"]."</title>\n";
		} else {
			echo "<title>" . $valor["nombre"] ." ".  $valor["apellido"] . " (". $valor["ciudad"] .", ". $valor["pais"].") NUEVO CANDIDATO A ACTIVISTA</title>\n";		
		}
		echo "<link>http://crm.redesdepares.org/tools/sga/newnote.php?id=".$valor["crmid"]."</link>\n";
		echo "<description>".$valor["nota_id"]."</description>";
		echo "</item>\n\n";
  }
}
//print_r($activistas);

echo '</channel></rss>';
?>
