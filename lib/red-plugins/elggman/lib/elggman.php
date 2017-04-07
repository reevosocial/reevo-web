<?php

function elggman_email_in_filter($entity, $email, $filter) {
	
	$options = array('guid' => $entity->guid,
		'annotation_name' => $filter,
		'annotation_value' => $email,
		);
	$access = elgg_set_ignore_access(true);
	$annotations = elgg_get_annotations($options);
	elgg_set_ignore_access($access);
	if (count($annotations)) {
		return true;
	}
	return false;
}

function elggman_message_accept($entity) {
	$group = $entity->getContainerEntity();
	$group_alias = $group->alias;
	if (elggman_incoming_mail($entity->sender, $group_alias, $entity->data, elggman_apikey(), true)) {
		$entity->delete();
	}
}

function elggman_moderated_message($group, $headers, $subject, $body, $data, $sender) {
	if (empty($group->elggman_moderate)) {
		// external messages not allowed
		return;
	}
	$in_blacklist = elggman_email_in_filter($group, $sender, 'blacklist');
	if ($in_blacklist) {
		// drop
		return;
	}
	$entity = new ElggObject();
	$entity->subtype = 'moderated_discussion';
	$user = current(get_user_by_email($sender));
	if ($user instanceof ElggUser) {
		$owner = $user;
	} else {
		$owner = $group->getOwnerEntity();
	}
	$prev_user = elgg_get_logged_in_user_entity();
	login($owner);
	$entity->owner_guid = $owner->guid;
	$entity->container_guid = $group->guid;
	$entity->access_id = $group->group_acl;

	$entity->title = $subject;
	$entity->description = $body;
	$entity->data = $data;
	$entity->sender = $sender;
	$entity->save();
	$in_whitelist = elggman_email_in_filter($group, $sender, 'whitelist');
	if ($in_whitelist) {
		elggman_message_accept($entity);
	}
	if ($prev_user)
		login($prev_user);
}

function elggman_create_file($group, $owner, $body, $filename, $mime_type) {
	$prev_user = elgg_get_logged_in_user_entity();
	login($owner);

	$name_parts = explode('.', $filename);
	$extension = $filename;
	if (count($name_parts) > 1) {
		$extension = $name_parts[count($name_parts)-1];
	}

	$filestorename = elgg_strtolower(time().$filename);

	$access_id = $group->access_id;;
	$file = new FilePluginFile();
	$file->subtype = "file";
	$file->title = $filename;
	$file->owner_guid = $owner->guid;
	$file->description = elgg_echo('elggman:uploaded:file');
	$file->access_id = $access_id;
	$file->container_guid = $group->getGUID();
	$file->originalfilename = $filename;
	$file->setFilename("file/".$filestorename);
	$file->open('write');
	$file->write($body);
	$file->close();
	$mime_type = ElggFile::detectMimeType($file->getFilenameOnFilestore(), $mime_type);
	$file->setMimeType($mime_type);
	$file->simpletype = file_get_simple_type($mime_type);
	$file->save();
	elggman_create_thumbnails($file, $filename, $mime_type);
	if ($prev_user)
		login($prev_user);
	return $file;
}

function elggman_extract_multipart_text($result, $group) {
	foreach($result->parts as $part) {
		if ($part->ctype_primary == 'text' && $part->ctype_secondary == 'plain') 
		{
			return $part;
		}
	}
	return $result;
}

function elggman_extract_attachments($result, $group, $owner) {
	$first_text_found = false;
	$files = array();
	if ($result->ctype_primary != 'multipart') {
		return;
	}
	foreach($result->parts as $part) {
		$mime_type = "$part->ctype_primary/$part->ctype_secondary";
		if ($mime_type == 'text/plain' && !$first_text_found) {
			$first_text_found = true;
			continue;
		}
		foreach($part->ctype_parameters as $key => $value) {
			if ($key == 'name' && !empty($value)) {
				$filename = $value;
			}
		}
		foreach($part->d_parameters as $key => $value) {
			if ($key == 'filename' && !empty($value)) {
				$filename = $value;
			}
		}
		if ($filename) {
			$file = elggman_create_file($group, $owner, $part->body, $filename, $mime_type);
		}
		if ($file) {
			$files[] = $file;
		}
	}
	return $files;
}

function elggman_extract_body($result, $group) {
	if ($result->ctype_primary == 'multipart') {
		$part = elggman_extract_multipart_text($result, $group);
	}
	elseif ($result->ctype_primary == 'text' && $result->ctype_secondary == 'plain') {
		$part = $result;
	}
	else {
		error_log("unknown message type: $result->ctype_primary $result->ctype_secondary");
		return;
	}
	// look for charset and decode if needed
	$charset = $part->ctype_parameters['charset'];
	if ($charset) {
		$body = iconv( $charset, 'utf-8', $part->body );
	}
	else {
		$body = $part->body;
	}
	$body = htmlspecialchars_decode($body);

	return $body;
}

function elggman_incoming_mail($sender, $list, $data, $secret, $accepted=false) {
	require_once elgg_get_plugins_path() . "elggman/vendors/Mail/mimeDecode.php";

	// check secret
	if ($secret != elggman_apikey()) {
		error_log('elggman: incorrect api key on the mail server');
		return;
	}

	// check user and group are valid
	$group = get_group_from_group_alias($list);
	$user = current(get_user_by_email($sender));
	if (!$group) {
		error_log("elggman: no group or user for email! $user->name $group->name $sender $list");
		return;
	}
	// check for moderation
	elgg_load_library('elgg:threads');

	// decode email
	$params['include_bodies'] = true;
	$params['decode_bodies']  = true;
	$params['decode_headers'] = true;

	$decoder = new Mail_mimeDecode($data);
	$result = $decoder->decode($params);
	
	$subject = htmlspecialchars_decode($result->headers['subject']);

	$body = elggman_extract_body($result, $group);
	// get message parameters
	if ((!$user || !$group->isMember($user)) && !$accepted) {
		elggman_moderated_message($group, $headers, $subject, $body, $data, $sender);
		return;
	}

	// if there is no user means this has been accepted by moderators
	if (!$user) {
		$user = $group->getOwnerEntity();
		$sender_parts = explode('@', $sender);
		$forwarded = $sender_parts[0] . '@...';
		$body .= "\n\n(".elgg_echo('elggman:forwarded', array($forwarded)).')';
		$forwarded_for = $sender;
	}

	if ($part !== $result) {
		$files = elggman_extract_attachments($result, $group, $user);
		if (count($files)) {
			$attachments = "\n";
			$attachments .= elgg_echo("elggman:attachments").":";
			foreach($files as $file) {
				$attachments .= "[$file->originalfilename]: " . $file->getURL(). "\n";
			}
			$body .= $attachments;
		}
	}
	$message_id = htmlspecialchars_decode($result->headers['message-id']);
	$in_reply_to = htmlspecialchars_decode($result->headers['in-reply-to']);

	$message_id = trim($message_id, ' <>');
	$in_reply_to = trim($in_reply_to, ' <>');

	login($user);
	if ($in_reply_to) {
		$group_mailinglist = elggman_get_group_mailinglist($group);
		if (strpos($in_reply_to, $group_mailinglist)) {
			$parent_guid = current(explode('.', $in_reply_to));
		} else {
			$parent = current(elgg_get_entities_from_metadata(array(
				'type' => 'object',
				'subtypes' => array('groupforumtopic', 'topicreply'),
				'metadata_name' => 'message_id',
				'metadata_value' => $in_reply_to,
				'limit' => 1,
			)));
			$parent_guid = $parent->guid;
		}
		if (!$parent_guid) {
			error_log("elggman: cant find parent $in_reply_to");
			return;
		}


		$reply_guid = threads_reply($parent_guid, $body, $subject, array('forwarded_for' => $forwarded_for));
		$reply = get_entity($reply_guid);
		$reply->message_id = $message_id;
		add_to_river('river/annotation/group_topic_post/reply', 'reply', $user->guid, $topic->guid, "", 0, $reply_guid);
	}
	else {
		$options = array(
			'title' => $subject,
			'description' => $body,
			'status' => 'open',
			'access_id' => $group->access_id,
			'container_guid' => $group->guid,
			'message_id' => $message_id,
			'forwarded_for' => $forwarded_for,
			'tags' => null );

		$topic_guid = threads_create($guid, $options);
		add_to_river('river/object/groupforumtopic/create', 'create', $user->guid, $topic_guid);
	}
	return true;
}

function elggman_create_thumbnails($file, $filestorename, $mime_type) {
	$prefix = 'files/';
        if ($file->simpletype == "image") {
                $file->icontime = time();

                $thumbnail = get_resized_image_from_existing_file($file->getFilenameOnFilestore(), 60, 60, true);
                if ($thumbnail) {
                        $thumb = new ElggFile();
                        $thumb->setMimeType($mime_type);

                        $thumb->setFilename($prefix."thumb".$filestorename);
                        $thumb->open("write");
                        $thumb->write($thumbnail);
                        $thumb->close();

                        $file->thumbnail = $prefix."thumb".$filestorename;
                        unset($thumbnail);
                }

                $thumbsmall = get_resized_image_from_existing_file($file->getFilenameOnFilestore(), 153, 153, true);
                if ($thumbsmall) {
                        $thumb->setFilename($prefix."smallthumb".$filestorename);
                        $thumb->open("write");
                        $thumb->write($thumbsmall);
                        $thumb->close();
                        $file->smallthumb = $prefix."smallthumb".$filestorename;
                        unset($thumbsmall);
                }

                $thumblarge = get_resized_image_from_existing_file($file->getFilenameOnFilestore(), 600, 600, false);
                if ($thumblarge) {
                        $thumb->setFilename($prefix."largethumb".$filestorename);
                        $thumb->open("write");
                        $thumb->write($thumblarge);
                        $thumb->close();
                        $file->largethumb = $prefix."largethumb".$filestorename;
                        unset($thumblarge);
                }
	}
}

