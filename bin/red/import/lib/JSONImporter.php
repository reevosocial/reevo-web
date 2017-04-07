<?php

class JSONImporter {

	private $translations;
	private $settings;

	public function __construct() {
		$this->site = elgg_get_site_entity();
	}

	public function setSettings($settings) {
		$defaultOwner = get_entity($settings['default_owner_guid']);

		if (!$defaultOwner | !$defaultOwner instanceof ElggUser) {
			throw new Exception("Could not find default user.");
		} else {
			echo "Default owner of entities is " . $defaultOwner->username . PHP_EOL;
		}

		$this->settings = $settings;
	}

	private function getDefaultOwner() {
		return $this->settings['default_owner_guid'];
	}

	public function import($file) {
		$this->translations = array();

		$objects = json_decode(file_get_contents($file), true);
		$objectslog = array();

		foreach ($objects as $object) {
			switch ($object['type']) {
				case 'user':
					$object['elgg'] = $this->importUser($object);
					break;
				case 'group':
					$object['metadata']['elgg_guid'] = $this->importGroup($object);
					break;
				case 'object':
					$object['metadata']['elgg_guid'] = $this->importObject($object);
					break;
				case 'relationship':
					$guids = $this->importRelationship($object);
					$object['elgg_guid_one'] = $guids[0];
					$object['elgg_guid_two'] = $guids[1];
					break;
			}

			$objectslog[] = $object;
		}

//		rename($file, $file . ".imported");
		file_put_contents($file . ".imported.log", json_encode($objectslog, JSON_PRETTY_PRINT));

		return true;
	}

	private function translate($source_guid, $target_guid = null, $type = 'guid') {
		if ($target_guid) {
			if (!array_key_exists($type, $this->translations)) {
				$this->translations[$type] = array();
			}

			$this->translations[$type][$source_guid] = $target_guid;
		} else {
			if (array_key_exists($source_guid, $this->translations[$type])) {
				return $this->translations[$type][$source_guid];
			} else {
				return $source_guid;
			}
		}
	}

	private function importUser($object) {

		$metadata = $object['metadata'];

		if ($metadata['username']) {
			$user = get_user_by_username($metadata['username']);
		} elseif ($metadata['email']) {
			$user = get_user_by_email($metadata['email']);
		} else {
			throw new Exception("No user identifier provided.");
		}

		if ($user) {
			$user = $user[0];

//			if (!$this->site->isUser($user->guid)) {
				$this->site->addUser($user->guid);
	//		}

			$password = '';

		} else {
			$email = explode('@', $metadata['email']);
			$username = $email[0];
			$username = str_replace("-","", $username);
			$username = str_replace("+","", $username);
			$username = trim($username);

			while (strlen($username) < 4) {
				$username .= '0';
			}

			if (get_user_by_username($username)) {
				$i = 1;
				while (get_user_by_username($username . $i)) {
					$i++;
				}
				$username = $username . $i;
			}

			$password = $this->generatePassword();

			$user = new ElggUser();
			$user->username = $username;
			$user->email = $metadata['email'];
			$user->name = $metadata['name'];

			if (in_array('briefdescription', $metadata)) {
				$user->briefdescription = $metadata['briefdescription'];
			}

			$user->access_id = ACCESS_PUBLIC;
			$user->salt = generate_random_cleartext_password(); // Note salt generated before password!
			$user->password = generate_user_password($user, $password);
			$user->owner_guid = 0; // Users aren't owned by anyone, even if they are admin created.
			$user->container_guid = 0; // Users aren't contained by anyone, even if they are admin created.
			$user->language = get_current_language();
			$user->save();

			set_user_notification_setting($user->getGUID(), 'email', true);

			if (!$user->guid) {
				throw new Exception("Could not create user " . $metadata['name']);
			}

			$this->site->addUser($user->guid);
		}

		$this->translate($metadata['guid'], $user->guid);

		$returns = array(
			'guid' => $user->guid,
			'username' => $user->username,
			'password' => $password
		);

		return $returns;
	}

	private function generatePassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	private function importGroup($object) {

		$group = new ElggGroup();
		$metadata = $object['metadata'];

		$group->name = $metadata['name'];

		// make group private by default
		$group->membership = ACCESS_PRIVATE;

		if ($translation = $this->translate($metadata['owner_guid'])) {
			$group->owner_guid = $translation;
		} else {
			$group->owner_guid = $this->getDefaultOwner();
		}

		$group->save();

		$this->translate($metadata['guid'], $group->guid);
		$this->translate($metadata['guid'], $group->group_acl, 'acl');

		// make group invisible by default
		$group->access_id = $group->group_acl;
		$group->save();

		return $group->guid;
	}

	private function importObject($object) {

		$metadata = $object['metadata'];

		if ($object['subtype'] == 'file') {
			$elggObject = new ElggFile();
		} else {
			$elggObject = new ElggObject();
			$elggObject->subtype = $object['subtype'];
		}

		foreach ($metadata as $key => $value) {
			if ($key == 'owner_guid') {
				if ($value == 0) {
					$elggObject->$key = $this->getDefaultOwner();
				} else {
					$elggObject->$key = $this->translate($value);
				}
			} elseif (in_array($key, array('parent_guid', 'container_guid'))) {
				if ($value == 0) {
					$elggObject->$key = 0;
				} else {
					$elggObject->$key = $this->translate($value);
				}
			} elseif (!in_array($key, array('binary'))) {
				$elggObject->$key = $value;
			}
		}

		if (!$elggObject->owner_guid) {
			$elggObject->owner_guid = $this->getDefaultOwner();
		}

		// inherit acl from container
		if (isset($metadata['container_guid'])) {
			if ($translation = $this->translate($metadata['container_guid'],false,'acl')) {
				$elggObject->access_id = $translation;
			}
		} else {
			$elggObject->access_id = ACCESS_PUBLIC;
		}

		$elggObject->save();


		// Archiva los metadatos de forma local
		$path = '/srv/reevo-web/www/red';
		$guid = $elggObject->guid;
		$url= $elggObject->getURL();
		$image = ($metadata['image']);
		$address = ($metadata['address']);
		$source = ($metadata['source']);
		$title = ($metadata['title']);

		echo $metadata['title'] . ': ' . $elggObject->guid;
		echo "\n";
		echo $metadata['shorturl'] . ',' . $url ;
		echo "\n";


		// Si no tiene imagen tratamos de obtenerla del og:image de la fuente
		if (!$metadata['image']) {
			//echo "No tiene imagen, trato de obtenerla de $address\n";
			$page_content = file_get_contents($address);
			$dom_obj = new DOMDocument();
			$dom_obj->loadHTML($page_content);
			$meta_val = null;
			foreach($dom_obj->getElementsByTagName('meta') as $meta) {
				if($meta->getAttribute('property')=='og:image'){
					$meta_val = $meta->getAttribute('content');
				}
			}
			$image = $meta_val;
		}

		// Archiva la imagen destacada
		if ($image) {
			if (!file_exists("$path/recext-store/$guid")) {
				mkdir("$path/recext-store/$guid", 0777, true);
			}

			// obtiene la extension del link a la imagen, si no la tiene usa JPG
			$ext = pathinfo($image, PATHINFO_EXTENSION);
			if (!$ext) { $ext = 'jpg'; }

			shell_exec("wget -q '$image' -O $path/recext-store/$guid/$guid.$ext");
			// agrega metadatos a la imagen almacenada
			shell_exec("/usr/bin/exiftool -overwrite_original -title='$title' -comment='Source: $image' -author='$source' -url='$url' $path/recext-store/$guid/$guid.$ext");
			// reemplaza la imagen por la almacenada localmente
			$siteurl = elgg_get_site_url();
			$elggObject->image = '/recext-store/'.$guid.'/'.$guid.'.'.$ext;
			//echo 'url de la imagen: '. $siteurl.'recext-store/'.$guid.'/'.$guid.'.'.$ext;
		}

		// save guid of new ELGG object to translation table
		$this->translate($metadata['guid'], $elggObject->guid);

		if (isset($metadata['binary'])) {
			$elggObject = $this->importBinary($elggObject, $metadata);
		}

		foreach(array('time_created', 'time_updated') as $key) {
			if (array_key_exists($key, $metadata)) {
				$elggObject->$key = $metadata[$key];
			}
		}

		if (isset($metadata['tags'])) {
			$elggObject->tags = string_to_tag_array(strtolower($metadata['tags']));
			echo "\n";
		} else {
			echo "Sin tags: $guid";
			echo "\n";
		}

		$elggObject->save();

		return $elggObject->guid;
	}

	private function importBinary($elggObject, $metadata) {

		$elggObject->setFilename("file/" . elgg_strtolower(time() . $metadata['title']));
		$elggObject->originalfilename = $metadata['title'];

		$file = $elggObject->getFilenameOnFilestore();

		// open file to make sure directory exists
		$elggObject->open("write");
		$elggObject->close();

		copy($this->settings['input_directory'] . $metadata['binary'], $file);

		$mime_type = ElggFile::detectMimeType($file);
		$info = pathinfo($file);

		$office_formats = array('docx', 'xlsx', 'pptx');
		if ($mime_type == "application/zip" && in_array($info['extension'], $office_formats)) {
			switch ($info['extension']) {
				case 'docx':
					$mime_type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
					break;
				case 'xlsx':
					$mime_type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
					break;
				case 'pptx':
					$mime_type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
					break;
			}
		}

		// check for bad ppt detection
		if ($mime_type == "application/vnd.ms-office" && $info['extension'] == "ppt") {
			$mime_type = "application/vnd.ms-powerpoint";
		}

		$elggObject->setMimeType($mime_type);
		$elggObject->simpletype = file_get_simple_type($mime_type);

		return $elggObject;
	}

	private function importRelationship($object) {
		$guid_one = $this->translate($object['guid_one']);
		$guid_two = $this->translate($object['guid_two']);

		if ($guid_one && $guid_two) {
			add_entity_relationship($guid_one, $object['relationship'], $guid_two);
		}

		$group = get_entity($guid_two);
		if ($object['relationship'] == "member" && $group instanceof ElggGroup) {
			add_user_to_access_collection($guid_one, $group->group_acl);
		}

		return array($guid_one, $guid_two);
	}

}
