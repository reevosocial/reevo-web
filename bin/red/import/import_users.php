#!/usr/bin/env php
<?php
/**
 * import-reevo-beta-users -- CLI to create Reevo beta users from a CSV file.
 *
 * The CSV file can be created from SQL command in MW database:
 * 
 * Use it: ./import-mw-users /path/to/wiki_users.csv
 *
 * @package        Lorea
 * @subpackage     CLIT
 * @homepage       http://lorea.org/plugin/clit
 * @copyright      2013,2014 Lorea Faeries <federation@lorea.org>
 * @license        COPYING, http://www.gnu.org/licenses/agpl
 *
 * Copyright 2013 Lorea Faeries <federation@lorea.org>
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License
 * as published by the Free Software Foundation, either version 3 of
 * the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

// Elgg likes to have a REQUEST_URI. That's a great place to document the API.
$_SERVER['REQUEST_URI'] = 'api://localhost/import-reevo-beta-users';

// Your CLI script should simply require this file, and you're set.
require_once(dirname(__FILE__) . "/functions.php");

// Now you have access to the Elgg engine, like if you were using the
// Web, just better :)

//var_dump($argv);

//echo "Arguments: $argv[1]";

_info( "Loading file $argv[1]" );
// $list = echo file_get_contents($argv[1]);
// _info( sprintf("Got %d users", $list) );


//echo readfile($argv[1]);
// echo $list;

// if (!is_array($list)) {
// 	_oops("No file?");
// 	echo "No file";
// 	exit(1);
// }

$m = 0;
$n = 0;

// Get group from second parameter
$group = get_group_from_group_alias($argv[2]);
// Site
$site_guid = elgg_get_site_entity()->guid;



$file = fopen($argv[1], "r");
while(!feof($file)){
    $line = fgets($file);

	list($username, $name, $password, $email, $briefdesc) = explode(',', $line);

	$password = generate_random_cleartext_password();

	echo "$username ($name) <$email> // $password\n";

	// Prevent notifications: we're going to send an email later
	elgg_unregister_notification_method('email');

	if (($guid = register_user($username, $password, $name, $email)) !== false) {
		_info("imported $username ($name) <$email> with GUID $guid");

		// Add description
		$u = get_user($guid);
		$u->description = $briefdesc;
		$u->enabled = 'yes';

		// Validate user
		elgg_get_user_validation_status($guid, true, 'beta_user');

		// Make the user a member of the $group
		add_entity_relationship($guid, 'member', $group->guid);
		add_user_to_access_collection($guid, $group->group_acl);

		// Register to the mailing-list
		add_entity_relationship($guid, 'notifymailshot', $group->guid);
		// Mark as beta user
		add_entity_relationship($guid, 'beta_user', $site_guid);

		// Notify user
		$message_file = $argv[3];
		welcome($u, $password, $group, $message_file);

		$n++;
	} else {
		_warn("NOT IMPORTED: $username ($name) <$email>");
		$m++;
	}

}
fclose($file);
echo "";

_info("Subscribing users to group $group->name.");

exit(1);


function welcome($user, $pass, $group, $message_file) {
	$site_url 	= elgg_get_site_url();
	$group_url 	= $group->getURL();
	$username 	= $user->username;
	$name 		= $user->name;
	$from    	= 'Reevo (BETA) <webmaster@beta.reevo.org>';
	$to      	= $user->name .'<'.$user->email.'>';
	$subject 	= "Talleres de Verano";

	$body 		= file_get_contents('./'.$message_file);
	$body 		= str_replace("@NAME@",$name,$body);
	$body 		= str_replace("@USERNAME@",$username,$body);
	$body 		= str_replace("@PASSWORD@",$pass,$body);
	$body 		= str_replace("@URL@",$site_url,$body);

	$params   	= null;

	return elgg_send_email($from, $to, $subject, $body, $params);
}

$batch = new ElggBatch('elgg_get_entities_from_relationships', 'welcome');


_done("Imported $n users. $m failed.");

// You should have a report in /tmp/report_import-mw-users.log :)
