<?php
/**
 * Elggman plugin language pack
 */

$english = array(
	'elggman' => "Mailing list",
	'elggman:mailname' => "Mailing list domain",
	'elggman:subscribe' => "Subscribe",
	'elggman:unsubscribe' => "Unsubscribe",
	'elggman:subscribe:info' => "You'll receive forum posts in your mailbox and you'll be able to reply writing a message.",
	'elggman:subscription:failure' => "Something went wrong while you was subscribing",
	'elggman:unsubscription:failure' => "Something went wrong while you was unsubscribing",
	'elggman:subscribed' => "You subscribed successfully!",
	'elggman:unsubscribed' => "You unsubscribed successfully!",
	'elggman:alreadysubscribed' => "You are already subscribed",
	'elggman:nopermissions' => "You have no permissons to subscribe to list, maybe you need to send a join request",
	'elggman:welcome:subject' => "Welcome to the %s mailing list!",
	'elggman:welcome:body' => "Hi %s!

You are now a member of the '%s' mailing list! Click below to begin posting!

%s

or send a message to

%s",
	'elggman:subscription:options' => "Subscription options",
	'elggman:management:options' => "Management options",
	'elggman:owner' => "%s's mailing list",
	'elggman:members' => "Mailing list members",
	'elggman:obfuscated' => "Send my email obfuscated on mails (%s@%s)",
	'elggman:starred' => "Receive mails only from starred threads",
	'notification:method:mailshot' => 'Mailing list',
	'elggman:dependency_fail' => 'You need to install php-mail-mimedecode before using this plugin.',
	// api key
	'elggman:api_key' => "Mail server api key",
	'elggman:api_key:description' => "Configure your mail server to use this api key when sending to elgg.",
	// moderation
	'elggman:moderate' => "Moderate",
	'elggman:moderation' => "Moderation",
	'elggman:moderation:accept' => "Accept",
	'elggman:moderation:accept_all' => "Accept all",
	'elggman:moderation:drop' => "Drop",
	'elggman:moderation:drop_all' => "Drop all",
	'elggman:moderation:messages' => "%s messages to moderate",
	'elggman:moderation:accept:ok' => "Message accepted",
	'elggman:moderation:accept_all:ok' => "All messages accepted",
	'elggman:moderation:drop:ok' => "Message dropped succesfully",
	'elggman:moderation:drop_all:ok' => "All messages dropped succesfully",
	'elggman:moderation:fail' => "Moderation action failed",
	'elggman:moderation:nocontent' => "There are no messages to moderate",
	'elggman:manage' => "Manage",
	'elggman:whitelist' => "Whitelist",
	'elggman:whitelist:nocontent' => "There are no whitelist elements",
	'elggman:whitelist:messages' => "Whitelist emails",
	'elggman:whitelist:add' => "Add",
	'elggman:whitelist:add:ok' => "Email added to whitelist",
	'elggman:whitelist:add:duplicate' => "Email already present in whitelist",
	'elggman:whitelist:delete:ok' => "Email deleted from whitelist",
	'elggman:whitelist:delete:fail' => "Error deleting email from whitelist",
	'elggman:blacklist' => "Blacklist",
	'elggman:blacklist:nocontent' => "There are no blacklist elements",
	'elggman:blacklist:nocontent' => "There are no blacklist elements",
	'elggman:blacklist:messages' => "Blacklist emails",
	'elggman:blacklist:add' => "Add",
	'elggman:blacklist:add:ok' => "Email added to blacklist",
	'elggman:blacklist:add:duplicate' => "Email already present in blacklist",
	'elggman:blacklist:delete:ok' => "Email deleted from blacklist",
	'elggman:blacklist:delete:fail' => "Error deleting email from blacklist",
	'elggman:forwarded' => "Mail from an external address (%s) accepted by moderation",
	// settings
	'elggman:group_settings' => "Settings",
	'elggman:moderation:allow' => "Allow messages external to the group or network",
	'elggman:settings:save' => "Save settings",
	'elggman:uploaded:file' => "File uploaded from mailing list",
	'elggman:attachments' => "Attachments",
	

		
);

add_translation('en', $english);
