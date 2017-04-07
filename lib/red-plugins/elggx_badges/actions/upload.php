<?php

// check if upload attempted and failed
if (!empty($_FILES['badge']['name']) && $_FILES['badge']['error'] != 0) {
	$error = elgg_get_friendly_upload_error($_FILES['badge']['error']);
	register_error($error);
	forward(REFERER);
}

$filename = $_FILES['badge']['name'];
$mime = $_FILES['badge']['type'];

$access_id = (int)get_input('access_id');
if(!$access_id) {
	$access_id = get_default_access();
}

$prefix = 'image/badges/';

$filestorename = strtolower(time() . $filename);

$file = new BadgesBadge();
$file->setFilename($prefix . $filestorename);
$file->setMimeType($mime);
$file->originalfilename = $filename;
$file->subtype = 'badge';
$file->access_id = $access_id;
$file->open("write");
$file->write(get_uploaded_file('badge'));
$file->close();

$file->title = get_input('name');
$file->description = get_input('description');
$guid = $file->save();

/**
 * Add the name as metadata. This is a hack to
 * allow sorting the admin list view by name
 */
$file->badges_name = get_input('name');

// Add the userpoints at which this badge will be awarded
$file->badges_userpoints = get_input('points');

if (get_input('url') != '') {
	$url = get_input('url');
	if (preg_match('/^https?/i', $url)) {
		$file->badges_url = $url;
	} else {
		$file->badges_url = elgg_get_config('wwwroot') . $url;
	}
}

system_message(elgg_echo("badges:uploaded"));

forward(REFERER);
