<?php

/**
 * Badge viewer
 */

$file_guid = (int) get_input("file_guid");
$file = get_entity($file_guid);

if ($file) {

	$contents = $file->grabFile();
	$filesize = strlen($contents);

	if ($filesize) {

		// expires every 14 days
		$expires = 14 * 60*60*24;

		// overwrite header caused by php session code so badge can be cached
		$mime = $file->getMimeType();
		header("Content-Type: $mime");
		header("Content-Length: $filesize");
		header("Cache-Control: public", true);
		header("Pragma: public", true);
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT', true);

		// Return the badge and exit
		echo $contents;
	}
}

exit;
