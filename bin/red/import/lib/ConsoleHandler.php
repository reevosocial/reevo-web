<?php

class ConsoleHandler {

	public function __construct() {

		if (PHP_SAPI !== 'cli') {
			die('This script is only accessible from console.');
		}

		$this->options = getopt('i:d:h:s:');

		if (array_diff(array('i','d','h'), array_keys($this->options))) {
			die('Usage: php import-json.php -i /input-dir/ -h test.pleio.nl -d <default_owner_guid> -s ssl');
		}

	}

	public function parse() {

		$_SERVER['HTTP_HOST'] = $this->options['h'];

		if (isset($this->options['s']) == "ssl") {
			$_SERVER['HTTPS'] = true;
		}

		return array(
			'default_owner_guid' => $this->options['d'],
			'input_directory' => $this->options['i']
		);
	}
}