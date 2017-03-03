<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "Lesezeichen",
	'recext:add' => "Lesezeichen hinzufügen",
	'recext:edit' => "Lesezeichen editieren",
	'recext:owner' => "Lesezeichen von %s",
	'recext:friends' => "Lesezeichen Deiner Freunde",
	'recext:everyone' => "Alle Lesezeichen der Community",
	'recext:this' => "Lesezeichen für diese Seite hinzufügen",
	'recext:this:group' => "Lesezeichen in %s setzen",
	'recext:recextlet' => "Bookmarklet zum Browser hinzufügen",
	'recext:recextlet:group' => "Gruppen-Bookmarklet zum Browser hinzufügen",
	'recext:inbox' => "Lesezeichen-Inbox",
	'recext:with' => "Teile das Lesezeichen mit",
	'recext:new' => "Ein neues Lesezeichen",
	'recext:address' => "Zieladresse des Lesezeichens",
	'recext:none' => 'Noch keine Lesezeichen vorhanden.',

	'recext:notify:summary' => 'Ein neues Lesezeichen %s wurde erstellt',
	'recext:notify:subject' => 'Neues Lesezeichen: %s',
	'recext:notify:body' =>
'%s hat ein neues Lesezeichen erstellt: %s

Adresse: %s

%s

Schau Dir das neue Lesezeichen an und schreibe einen Kommentar:
%s
',

	'recext:delete:confirm' => "Bist Du sicher, dass Du dieses Lesezeichen löschen willst?",

	'recext:numbertodisplay' => 'Anzahl der anzuzeigenden Lesezeichen-Einträge.',

	'recext:shared' => "Lesezeichen gesetzt",
	'recext:visit' => "Gehe zu dieser Seite",
	'recext:recent' => "Neuesten Lesezeichen",

	'river:create:object:recext' => '%s hat das Lesezeichen %s hinzugefügt.',
	'river:comment:object:recext' => '%s kommentierte das Lesezeichen %s',
	'recext:river:annotate' => 'einen Kommentar zum Lesezeichen',
	'recext:river:item' => 'einen Eintrag',

	'item:object:recext' => 'Lesezeichen',

	'recext:group' => 'Gruppen-Lesezeichen',
	'recext:enablerecext' => 'Gruppen-Lesezeichen aktivieren',
	'recext:nogroup' => 'Diese Gruppe hat noch keine Lesezeichen.',
	
	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "Dieses Widget zeigt Deine neuesten Lesezeichen an.",

	'recext:recextlet:description' =>
			"Ein Lesezeichen-Bookmarklet ist eine spezielle Schaltfläche, die Du zur Lesezeichen-Leiste in Deinem Browser hinzufügen kannst. Das Bookmarklet ermöglicht es Dir, für eine Internetseite, die Du zu einem späteren Zeitpunkt noch einmal besuchen willst, ein Lesezeichen zu erstellen und dieses Lesezeichen wahlweise auch mit Deinen Freunden zu teilen. Um das Bookmarklet einzurichten, ziehe die angezeigte Schaltfläche einfach in die Lesezeichen-Leiste Deines Browsers:",

	'recext:recextlet:descriptionie' =>
			"Wenn Du den Internet Explorer verwendest, klicke mit der rechten Maustaste auf das Bookmarklet-Icon, wähle 'Zu Favoriten hinzufügen' und dann die Lesezeichen-Leiste.",

	'recext:recextlet:description:conclusion' =>
			"Du kannst dann ein Lesezeichen für eine Seite erstellen, indem Du auf die Bookmarklet-Schaltfläche in der Lesezeichen-Leiste des Browsers klickst.",

	/**
	 * Status messages
	 */

	'recext:save:success' => "Für den Eintrag wurde ein Lesezeichen gesetzt.",
	'recext:delete:success' => "Das Lesezeichen wurde gelöscht.",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "Das Lesezeichen konnte nicht gespeichert werden. Bitte gebe einen Titel und eine Zieladresse an und versuche es noch einmal.",
	'recext:save:invalid' => "Die Adresse des Lesezeichens ist ungültig und kann nicht gespeichert werden.",
	'recext:delete:failed' => "Das Lesezeichen konnte nicht gelöscht werden. Versuche es bitte noch einmal.",
	'recext:unknown_recext' => 'Das ausgewählte Lesezeichen ist nicht auffindbar.',
);
