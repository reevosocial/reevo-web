<?php
/**
 * Bookmarks helper functions
 *
 * @package Bookmarks
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $recext A recext object.
 * @return array
 */
function recext_prepare_form_vars($recext = null) {
	// input names => defaults
	$values = array(
		'title' => get_input('title', ''), // recextlet support
		'address' => get_input('address', ''),
		'description' => get_input('description', ''),
		'access_id' => ACCESS_DEFAULT,
		'tags' => get_input('tags', ''),
		'image' => get_input('image', ''),
		'source' => get_input('source', ''),
		'shorturl' => get_input('shorturl', ''),		
		'shares' => array(),
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $recext,
	);

	if ($recext) {
		foreach (array_keys($values) as $field) {
			if (isset($recext->$field)) {
				$values[$field] = $recext->$field;
			}
		}
	}

	if (elgg_is_sticky_form('recext')) {
		$sticky_values = elgg_get_sticky_values('recext');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('recext');

	return $values;
}
