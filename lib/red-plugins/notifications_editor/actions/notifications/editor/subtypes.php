<?php

elgg_ajax_gatekeeper();

$object_type = get_input('object_type');
$object_subtypes = array('');

$dbprefix = elgg_get_config('dbprefix');
$object_type = sanitize_string($object_type);

switch ($object_type) {

	case 'object' :
	case 'group' :
	case 'user' :
	case 'site' :
		$query = "SELECT subtype FROM {$dbprefix}entity_subtypes WHERE type='$object_type'";
		$rows = get_data($query);
		if ($rows) {
			foreach ($rows as $row) {
				$object_subtypes[] = $row->subtype;
			}
		}
		break;

	case 'annotation' :
		$query = "SELECT DISTINCT(ms.string) AS annotation_name FROM {$dbprefix}annotations a JOIN {$dbprefix}metastrings ms ON ms.id = a.name_id";
		$rows = get_data($query);
		if ($rows) {
			foreach ($rows as $row) {
				$object_subtypes[] = $row->annotation_name;
			}
		}
		break;

	case 'relationship' :
		$query = "SELECT DISTINCT(relationship) FROM {$dbprefix}entity_relationships";
		$rows = get_data($query);
		if ($rows) {
			foreach ($rows as $row) {
				$object_subtypes[] = $row->relationship;
			}
		}
		break;
}

echo json_encode(array(
	'object_subtypes' => $object_subtypes,
));