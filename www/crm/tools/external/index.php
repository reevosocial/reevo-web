<?php
// error_reporting(E_ALL);
// ini_set('display_errors', True);
// echo "Hola";
require_once "../../civicrm.settings.php";
require_once 'CRM/Core/Config.php';
$config = CRM_Core_Config::singleton( );
require_once 'api/api.php';


	if ($_GET['email']) { $email 										= $_GET['email'];}
	if ($_GET['first_name']) { $first_name 					= ucwords(strtolower($_GET['first_name']));}
	if ($_GET['last_name'])	{ $last_name 						= ucwords(strtolower($_GET['last_name']));}
	if ($_GET['image_URL']) { $image_URL 						= $_GET['image_URL'];}
	if ($_GET['street_name']) { $street_name				= $_GET['street_name'];}
	if ($_GET['street_number']) { $street_number		= $_GET['street_number'];}
	if ($_GET['street_address']) { $street_address	= $_GET['street_address'];}
 	if ($_GET['state_id']) { $state_id							= $_GET['state_id'];}
 	if ($_GET['country_id']) { $country_id					= $_GET['country_id'];}
	if ($_GET['city']) { $city											= ucwords(strtolower($_GET['city']));}
	if ($_GET['agregar']) { $grupos_agregar					= explode(',', $_GET['agregar']);}
	if ($_GET['sacar']) { $grupos_sacar							= explode(',', $_GET['sacar']);}
	if ($_GET['tags']) { $tags_agregar							= explode(',', $_GET['tags']);}
	if ($_GET['nueva_direccion']) {$add_address			= $_GET['nueva_direccion'];}
	if ($_GET['nota']) { $add_note 									= $_GET['nota'];}
	if ($_GET['nota_titulo']) { $add_note_title 		= $_GET['nota_titulo'];}
	if ($_GET['url']) { $url 												= $_GET['url'];}
	if ($_GET['yo']) { $yo = $_GET['yo'];} else {$yo = 1;}

 echo "<h2>$email</h2>";
 echo	"$email</br>
 $first_name</br>
 $last_name</br>
 $image_URL</br>
 $street_name</br>
 $street_number</br>
 $street_address</br>
 $country_id</br>
 $url</br></br>";


// Checks if email is already in database

$email_exists = civicrm_api3('email', 'get', array('email' => $email));

if ($email_exists['count'] == 0) {
	echo "<h3>El usuario se ha creado</h3>";

	$data = array(
		 'contact_type' 	=> 'Individual',
		 'first_name' 		=> $first_name,
		 'last_name' 		=> $last_name,
		 'image_URL'		=> $image_URL
		 );

	$contact = civicrm_api3('Contact','Create',$data);
	
//  Attach email to the contact
	$data = array(
		  'contact_id'		=> $contact['id'],
		  'email' 			=> $email,
		  'is_primary' 		=> 1,
		);
	$new_email = civicrm_api3('email', 'create', $data);


// 	Attach the adrress information to the contact
	$data = array(
	  'contact_id' 			=> $contact['id'],
	  'location_type_id' 	=> 1, //Home
	  'street_name' 		=> $street_name,
	  'street_number' 		=> $street_number,
	  'street_address' 		=> $street_address,
	  'state_province_id' 			=> $state_id,
	  'country_id' 			=> $country_id,
	  'city' 				=> $city,
	  'is_primary' 			=> 1,
	);
	$new_address = civicrm_api3('address', 'create', $data);


//	Add the contact to certain groups
	if (!empty($grupos_agregar)) {
		foreach($grupos_agregar as $value) {
			$data = array(
			  'contact_id' 		=> $contact['id'],
			  'group_id' 		=> $value,
			);

			$new_grupos_agregar = civicrm_api3('group_contact', 'create', $data);
		}	
	}

//	Tag the contact with certain tags
	if (!empty($tags_agregar)) {
		foreach($tags_agregar as $value) {
			$data = array(
			  'contact_id' 		=> $contact['id'],
			  'tag_id' 		=> $value,
			);

			$new_tags_agregar = civicrm_api3('entity_tag', 'create', $data);
		}	
	}

//	Add a note to the contact
	if (!empty($add_note)) {
		$note = civicrm_api('Note','Create',array('entity_id' => $contact['id'], 'note' => $add_note, 'subject' => $add_note_title, 'contact_id' => $yo, 'version' =>3, 'json' => '1'));
	}	
	


} else {
	
	// THE EMAIL EXISTS IN DATABASE ****************
	echo "<h3>El usuario se ha actualizado</h3>";

	echo $url;
	// Get the id of existing user
	$contact_id = $email_exists['values'][$email_exists[id]]['contact_id'];

	// Obtiene los datos anteriores
	$data = array(
		 'contact_type' 	=> 'Individual',
		 'contact_id' 		=> $contact_id,
		 );

	$old = civicrm_api3('Contact','Get',$data);

 	if (empty($first_name)) {$first_name = $old['values'][$old[id]]['first_name'];}	
 	if (empty($last_name)) {$last_name = $old['values'][$old[id]]['last_name'];}	
 	if (empty($image_URL)) {$image_URL = $old['values'][$old[id]]['image_URL'];}	


	$data = array(
		 'contact_type' 	=> 'Individual',
		 'contact_id' 		=> $contact_id,
		 'first_name' 		=> $first_name,
		 'last_name' 		=> $last_name,
		 'image_URL'		=> $image_URL
		 );

	$contact = civicrm_api3('Contact','Create',$data);

//	Remove the previous address if "add address is not set"
// 	if (empty($add_address)) {
// 		$params = array(
// 		  'contact_id' => $contact_id,
// 		);
// 
// 		$result = civicrm_api3('address', 'get', $params);
// 		$prior_address_id = array_keys($result['values'])[0];
// 		$result = civicrm_api3('address', 'delete', array('id' => $prior_address_id));
// 	}
	
// 	Attach the adrress information to the contact
	$data = array(
	  'contact_id' 			=> $contact_id,
	  'location_type_id' 	=> 4, //Otro
	  'street_name' 		=> $street_name,
	  'street_number' 		=> $street_number,
	  'street_address' 		=> $street_address,
	  'state_province_id' 			=> $state_id,
	  'country_id' 			=> $country_id,
	  'city' 				=> $city,
	  'is_primary' 			=> 0,
	);
	$new_address = civicrm_api3('address', 'create', $data);



//	Add the contact to certain groups
	if (!empty($grupos_agregar)) {
		foreach($grupos_agregar as $value) {
			$data = array(
			  'contact_id' 		=> $contact_id,
			  'group_id' 		=> $value,
			);

			$new_grupos_agregar = civicrm_api3('group_contact', 'create', $data);
		}	
	}

			
//	Remove the contact to certain groups
	if (!empty($grupos_sacar)) {	
		foreach($grupos_sacar as $value) {
			$data = array(
			  'contact_id' 		=> $contact_id,
			  'group_id' 		=> $value,
			);

			$new_grupos_sacar = civicrm_api3('group_contact', 'delete', $data);
		}
	}

//	Tag the contact with certain tags
	if (!empty($tags_agregar)) {
		foreach($tags_agregar as $value) {
			$data = array(
			  'contact_id' 		=> $contact['id'],
			  'tag_id' 		=> $value,
			);

			$new_tags_agregar = civicrm_api3('entity_tag', 'create', $data);
		}	
	}

//	Add a note to the contact
	if (!empty($add_note)) {
		$note = civicrm_api('Note','Create',array('entity_id' => $contact_id, 'note' => $add_note, 'subject' => $add_note_title, 'contact_id' => $yo, 'version' =>3, 'json' => '1'));
	}	
	
}

//	Redirect to ther page at the end
	if (!empty($url)) {
		header( 'Location: '.$url );
	}	

?>
