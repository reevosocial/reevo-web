<?php

namespace Elgg\CLI;

use Elgg\Application;
use Exception;
use RegistrationException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
error_reporting(0);

/**
 * user:add CLI command
 */
class GetUserCommand extends Command {

	/**
	 * {@inheritdoc}
	 */
	protected function configure() {
		$this->setName('user:get')
				->setDescription('Check for user account')
				->addOption('email', null, InputOption::VALUE_OPTIONAL, 'Search keyword')
				->addOption('username', null, InputOption::VALUE_OPTIONAL, 'Search keyword')
				->addOption('as', null, InputOption::VALUE_OPTIONAL, 'Username of the user to login');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function handle() {

		$admin = get_user('55');
		$login = login($admin);

		$username = $this->option('username');
		$email = $this->option('email');

		if ($this->option('username')) {
			$user = get_user_by_username($username);
			if ($user) {
				// print_r($user);
			} else {
				exit();
			}
		}

		if ($this->option('email')) {
			$user = get_user_by_email($email);
			if ($user) {
				$user = $user[0];
			} else {
				exit();
			}
		}
		$export['username'] = $user->username;
		$export['email'] = $user->email;
		$export['name'] = $user->name;
		$export['description'] = $user->description;
		$export['briefdescription'] = $user->briefdescription;
		$export['interests'] = $user->interests;
		$export['website'] = $user->website;
		$export['guid'] = $user->guid;
		$export['icon'] = $user->getIconURL('master');
		// echo $user->description;

		print_r(json_encode($export));
		// print_r($login);

		// $guid = register_user($username, $password, $name, $email);
		// $user = get_user($guid);
		// print_r($user);


	}

}
