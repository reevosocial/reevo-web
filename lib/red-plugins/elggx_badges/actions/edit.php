<?php

$guid = (int)get_input('guid');
$access_id = (int)get_input('access_id');
if(!$access_id) {
	$access_id = get_default_access();
}

// check if upload attempted and failed
if (!empty($_FILES['badge']['name']) && $_FILES['badge']['error'] != 0) {
	$error = elgg_get_friendly_upload_error($_FILES['badge']['error']);
	register_error($error);
	forward(REFERER);
}

$badge = get_entity($guid);

$badge->title = get_input('name');
$badge->description = get_input('description');
$badge->access_id = $access_id;
$badge->save();

$badge->badges_name = get_input('name');
$badge->badges_userpoints = get_input('points');

if (get_input('url') != '') {
	$url = get_input('url');
	if (preg_match('/^https?/i', $url)) {
		$badge->badges_url = $url;
	} else {
		$badge->badges_url = elgg_get_config('wwwroot') . $url;
	}
}

if (isset($_FILES['badge']['name']) && !empty($_FILES['badge']['name'])) {
	$filename = $_FILES['badge']['name'];
	$mime = $_FILES['badge']['type'];
	$prefix = 'image/badges/';

	// load previous file object
	$file = new BadgesBadge($guid);

	// delete previous bagde file
	$previous_filename = $file->getFilenameOnFilestore();
	if (file_exists($previous_filename)) {
		unlink($previous_filename);
	}

	// use same filename on the disk - ensures thumbnails are overwritten
	$filestorename = $file->getFilename();
	$filestorename = elgg_substr($filestorename, elgg_strlen($prefix));

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
}

system_message(elgg_echo("badges:saved"));

forward(REFERER);
