Notification Editor for Elgg
============================
![Elgg 2.0](https://img.shields.io/badge/Elgg-2.0.x-orange.svg?style=flat-square)

## Features

 * Editable HTML notification templates built with Mustache
 * Flexible use of object and variables in templates
 * An option to send intstant notification with custom templates

![Interface](https://raw.github.com/hypeJunction/Elgg-notifications_editor/master/screenshots/interface.png "Admin Interface")

## Subscription Notifications

The plugin will automatically hijack notifications for all registered notifications events (events that
send out subscription notifications). The plugin will first try to locate a view that corresponds to
the subject, summary and body of the notification, and use the template view, if it's found.
Administrators have the ability to edit the templates, in which case a new template object is
created and stored in the database.

Notification views are stored in:
 `/views/default/notifications/$action/$object_type/$object_subtype/$part.$language.html`, where
`$action` is an action triggering the notification event,
`$object_type` is `object`, `group`, `user`, `site`, `annotation` or `relationship`
`$object_subtype` is an entity subtype, or annotation name, or relationship name
`$part` is either `subject`, `summary` or `body`
`$language` is the language of the recipient


## Custom (Instant) Notifications

For this to work, your delivery method handlers need to trigger `'format','notification'` hook and pass the
notification object as return. For email delivery method, enable *notifications_html_handler* plugin.

```php
// enable templates for notifier
elgg_register_plugin_hook_handler('send', 'notification:notifier', 'notifier_notification_send');
function notifier_notification_send($hook, $type, $result, $params) {
	$notification = $params['notification'];
	$notification = elgg_trigger_plugin_hook('format', 'notification', $params, $notification);

	// continue with logic
}
```

You can send instant notifications using templates by passing a template name with the notification parameters:

```php
notify_user($to, $from, '', '', array(
	'template' => 'my_template',
	'my_param' => $param,
));
```

You can then edit your templates, and reference your params as so:

```html
// in notifications/my_template/body.en.html
This is my template with {{params.my_param}}!
```

To make templates editable by admin, register them:

```php
elgg_register_plugin_hook_handler('get_templates', 'notifications', function($h, $t, $r) {
	$r[] = 'my_template';
	return $r;
}
```

Below you can see how to send a notification using a custom template.

Let's say we want to notify a user that their account has been created:

```php
notify_user($recipient->guid, $site->guid, '', '', array(
	'template' => 'useradd',
	'actor' => elgg_get_logged_in_user_entity(),
	'password' => '123456789',
));
```

```html
// in /views/default/notifications/useradd/body.en.html
Dear {{recipient.name}},

{{#actor}}
	{{actor.name}} has created an account for you at <a href="{{site.getURL}}">{{site.name}}</a>.
{{/actor}}
{{^actor}}
	A use raccount has been created for you at <a href="{{site.getURL}}">{{site.name}}</a>.
{{/actor}}

Your login credentials are as follows:

Username: {{recipient.username}}
Password: {{params.password}}

Once you have logged in, we highly recommend that you change your password.
You can do so in your <a href="{{site.getURL}}settings/user/{{recipient.username}}">account settings</a>.

<a href="{{site.getURL}}login" class="elgg-button">Login</a>
```

## Properties

Properties available in templates:

See [mustache reference](https://mustache.github.io/mustache.5.html) for information on ternaries and loops

#### Available in all notifications

<table class="elgg-table-alt mam elgg-text-help">

	<tbody>

		<tr>

			<td>**{{sender.name}}**</td>

			<td>Name of the sender</td>

		</tr>

		<tr>

			<td>**{{sender.getURL}}**</td>

			<td>URL of the sender's profile</td>

		</tr>

		<tr>

			<td>**{{sender.XXX}}**</td>

			<td>Any metadata or method attached to the sender object (e.g. {{sender.language}})</td>

		</tr>

		<tr>

			<td>**{{recipient.name}}**</td>

			<td>Name of the recipient</td>

		</tr>

		<tr>

			<td>**{{recipient.getURL}}**</td>

			<td>URL of the recipients's profile</td>

		</tr>

		<tr>

			<td>**{{recipient.XXX}}**</td>

			<td>Any metadata or method attached to the recipient object (e.g. {{recipient.first_name}})</td>

		</tr>

		<tr>

			<td>**{{language}}**</td>

			<td>Language of the recipient</td>

		</tr>

		<tr>

			<td>**{{site.name}}**</td>

			<td>Name of the site</td>

		</tr>

		<tr>

			<td>**{{site.getURL}}**</td>

			<td>URL of the site (with the trailing slash)</td>

		</tr>

		<tr>

			<td>**{{params.XXX}}**</td>

			<td>Additional params passed to the notification object. The actual available values depend on the notification</td>

		</tr>

	</tbody>

</table>

#### Available in subscription notifications

<table class="elgg-table-alt mam elgg-text-help">

	<tbody>

		<tr>

			<td>**{{action}}**</td>

			<td>Action name that triggered the subscription notification event</td>

		</tr>

		<tr>

			<td>**{{actor.name}}**</td>

			<td>Name of the actor (a user performing an action)</td>

		</tr>

		<tr>

			<td>**{{actor.getURL}}**</td>

			<td>URL of the actor's profile</td>

		</tr>

		<tr>

			<td>**{{actor.XXX}}**</td>

			<td>Any metadata or method attached to the actor object (e.g. {{actor.language}})</td>

		</tr>

		<tr>

			<td>**{{object.XXX}}**</td>

			<td>Depending on the event, an object is either an entity, or an annotation, or a relationship. Available properties may vary depending on that.</td>

		</tr>

		<tr>

			<td>**{{target.XXX}}**</td>

			<td>Target of the event: For events that involve Elgg entities, the target is the container entity, e.g. if object is a blog, the target is either a user or group For events that involve annotations, the target is an entity that that annotation is made on For events that involve relationships, the target is an object with subject and object properties, where subject represents the subject of the relationship and object represents the object of the relationship</td>

		</tr>

	</tbody>

</table>