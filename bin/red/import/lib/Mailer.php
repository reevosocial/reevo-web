<?php

class Mailer {
	private $settings;

	public function __construct() {
		$this->site = elgg_get_site_entity();
		$this->maillog = array();
	}

	public function setSettings($settings) {
		$this->settings = $settings;
	}

	public function process($file) {
		$objects = json_decode(file_get_contents($file), true);

		foreach ($objects as $object) {
			if ($object['type'] == "user") {
				$username = $object['elgg']['username'];
				$password = $object['elgg']['password'];

				if ($object['elgg']) {
					$this->notifyUser($username, $password);
				}
			}
		}
	}

	public function notifyUser($username, $password) {

		//if ($username != "bartjeu") {
		//	return true;
		//}

		$user = get_user_by_username($username);

		if (!$password && in_array($user->email, $this->maillog)) {
			return true;
		}

		if ($password) {
			$message = $this->settings['message'];
		} else {
			$message = $this->settings['message_nopassword'];
		}

		$message = str_replace("%name%", $user->name, $message);
		$message = str_replace("%username%", $username, $message);
		$message = str_replace("%password%", $password, $message);
		
		$return = html_email_handler_send_email(array(
			'to' => $user->name . " <" . $user->email . ">",
			'subject' => $this->settings['subject'],
			'html_message' => nl2br($message),
			'plaintext_message' => strip_tags($message)
		));

		if ($password) {
			$creds = " including credentials.";
		} else {
			$creds = " without credentials.";
		}

		if ($return) {
			echo "[SENT] to " . $user->email . $creds;
		} else {
			echo "[NOT SENT] to " . $user->email . $creds;
		}

		echo "\r\n";

		$this->maillog[] = $user->email;
	}

}