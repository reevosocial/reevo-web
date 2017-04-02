<?php
/**
* Elgg recext save action
*
* @package Bookmarks
*/

$title = htmlspecialchars(get_input('title', '', false), ENT_QUOTES, 'UTF-8');
$description = get_input('description');
$address = get_input('address');
$access_id = get_input('access_id');
$image = get_input('image');
$source = get_input('source');
$tags = get_input('tags');
$guid = get_input('guid');
$share = get_input('share');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('recext');

// don't use elgg_normalize_url() because we don't want
// relative links resolved to this site.
if ($address && !preg_match("#^((ht|f)tps?:)?//#i", $address)) {
	$address = "http://$address";
}

if ($image && !preg_match("#^((ht|f)tps?:)?//#i", $image)) {
	$image = "http://$image";
}

if (!$title || !$address ) {
	register_error(elgg_echo('recext:save:failed'));
	forward(REFERER);
}

// see https://bugs.php.net/bug.php?id=51192
$php_5_2_13_and_below = version_compare(PHP_VERSION, '5.2.14', '<');
$php_5_3_0_to_5_3_2 = version_compare(PHP_VERSION, '5.3.0', '>=') &&
		version_compare(PHP_VERSION, '5.3.3', '<');

$validated = false;
if ($php_5_2_13_and_below || $php_5_3_0_to_5_3_2) {
	$tmp_address = str_replace("-", "", $address);
	$validated = filter_var($tmp_address, FILTER_VALIDATE_URL);
} else {
	$validated = filter_var($address, FILTER_VALIDATE_URL);
}
if ($validated == false) {
	register_error(elgg_echo('recext:save:failed'));
	forward(REFERER);
}

if ($guid == 0) {
	$recext = new ElggObject;
	$recext->subtype = "recext";
	$recext->container_guid = (int)get_input('container_guid', elgg_get_logged_in_user_guid());
	$new = true;
} else {
	$recext = get_entity($guid);
	if (!$recext->canEdit()) {
		system_message(elgg_echo('recext:save:failed'));
		forward(REFERRER);
	}
}

// Verifica que el link no esté duplicado
if ($recext->address != $address) {
	function object_to_array($data)
	{
	    if (is_array($data) || is_object($data))
	    {
	        $result = array();
	        foreach ($data as $key => $value)
	        {
	            $result[$key] = object_to_array($value);
	        }
	        return $result;
	    }
	    return $data;
	}

	$duplicates_count = elgg_get_entities_from_metadata(array(
	    'type' => 'object',
	    'subtype' => 'recext',
			'count' => TRUE,
	    'metadata_name_value_pairs' => array(
	        array(
	            'name' => 'address',
	            'value' => $address,
	            'opearnd' => '=',
	            'case_sensitive' => FALSE,
	        ),
	    ),
	));

	if ($duplicates_count > 0 ) {
		$duplicates_count = elgg_get_entities_from_metadata(array(
		    'type' => 'object',
		    'subtype' => 'recext',
				'count' => FALSE,
		    'metadata_name_value_pairs' => array(
		        array(
		            'name' => 'address',
		            'value' => $address,
		            'opearnd' => '=',
		            'case_sensitive' => FALSE,
		        ),
		    ),
		));
		$duplicated = object_to_array($duplicates_count);
		$original = $duplicated[0]['guid'];
		register_error(elgg_echo('recext:save:failed:duplicated', array($original)));
		forward(REFERER);
	}
}


$tagarray = string_to_tag_array($tags);

$recext->title = $title;
$recext->address = $address;
$recext->shorturl = $address;
$recext->description = $description;
$recext->access_id = $access_id;
$recext->tags = $tagarray;

if (!$source) {
	$recext->source = ucfirst(str_replace("www.","",parse_url($address, PHP_URL_HOST)));
} else {
	$recext->source = $source;
}

if (!$description) {
	$page_content = file_get_contents($address);
	$dom_obj = new DOMDocument();
	$dom_obj->loadHTML($page_content);
	$meta_val = null;
	foreach($dom_obj->getElementsByTagName('meta') as $meta) {
		if($meta->getAttribute('property')=='og:description'){
			$meta_val = $meta->getAttribute('content');
		} else {
			if($meta->getAttribute('name')=='description'){
					$meta_val = $meta->getAttribute('content');
			}
		}
	}
	$recext->description = $meta_val;
} else {
	$recext->description = $description;
}

$oldimage = $recext->image;

if (!$image) {
	$page_content = file_get_contents($address);
	$dom_obj = new DOMDocument();
	$dom_obj->loadHTML($page_content);
	$meta_val = null;
	foreach($dom_obj->getElementsByTagName('meta') as $meta) {
		if($meta->getAttribute('property')=='og:image'){
			$meta_val = $meta->getAttribute('content');
		}
	}
	$recext->image = $meta_val;
} else {
	$recext->image = $image;
}


if ($recext->save()) {
	elgg_clear_sticky_form('recext');

	// @todo
	if (is_array($shares) && sizeof($shares) > 0) {
		foreach($shares as $share) {
			$share = (int) $share;
			add_entity_relationship($recext->getGUID(), 'share', $share);
		}
	}
	system_message(elgg_echo('recext:save:success'));

	//add to river only if new
	if ($new) {
		elgg_create_river_item(array(
			'view' => 'river/object/recext/create',
			'action_type' => 'create',
			'subject_guid' => elgg_get_logged_in_user_guid(),
			'object_guid' => $recext->getGUID(),
		));
	}

	// Archiva los metadatos de forma local
	$path = getcwd();
	$guid = $recext->getGUID();
	$url= $recext->getURL();

	// Archiva la imagen destacada
	if ($oldimage != $image || !$oldimage) { // verifica que sea una nueva imagen
		if($recext->image) {
			if (!file_exists("$path/recext-store/$guid")) {
				mkdir("$path/recext-store/$guid", 0777, true);
			}

			// obtiene la extension del link a la imagen, si no la tiene usa JPG
			$ext = pathinfo(strtok($recext->image, '?'), PATHINFO_EXTENSION);
			if (!$ext) { $ext = 'jpg'; }

			shell_exec("wget -q $recext->image -O $path/recext-store/$guid/$guid.$ext");
			// agrega metadatos a la imagen almacenada
			// shell_exec("/usr/bin/exiftool -overwrite_original -title='$title' -comment='Source: $recext->image' -author='$source' -url='$url' $path/recext-store/$guid/$guid.$ext");
			// reemplaza la imagen por la almacenada localmente
			$siteurl = elgg_get_site_url();
			$recext->image = '/recext-store/'.$guid.'/'.$guid.'.'.$ext;
		}
	}
	// die($recext->getURL());
	forward($recext->getURL());

} else {
	register_error(elgg_echo('recext:save:failed'));
	forward("recext");
}
