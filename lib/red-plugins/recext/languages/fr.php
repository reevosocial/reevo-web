<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "Signets",
	'recext:add' => "Ajouter un signet",
	'recext:edit' => "Modifier le signet",
	'recext:owner' => "Les signets de %s",
	'recext:friends' => "Signets des contacts",
	'recext:everyone' => "Tous les signets du site",
	'recext:this' => "Mettre cette page en signet",
	'recext:this:group' => "Mettre en signet dans %s",
	'recext:recextlet' => "Récupérer le 'recextlet'",
	'recext:recextlet:group' => "Récupérer le 'recextlet' du groupe",
	'recext:inbox' => "Boîte de réception des signets",
	'recext:with' => "Partager avec",
	'recext:new' => "Un nouveau signet",
	'recext:address' => "Adresse de la ressource à ajouter à vos signets",
	'recext:none' => 'Aucun signet',

	'recext:notify:summary' => 'Nouveau signet nommé %s',
	'recext:notify:subject' => 'Nouveau signet: %s',
	'recext:notify:body' =>
'%s a ajouté un nouveau signet: %s

Adresse: %s

%s

Voir et commenter ce signet: 
%s
',

	'recext:delete:confirm' => "Etes-vous sûr(e) de vouloir supprimer cette ressource ?",

	'recext:numbertodisplay' => 'Nombre de signets à afficher',

	'recext:shared' => "Mis en signet",
	'recext:visit' => "Voir la ressource",
	'recext:recent' => "Signets récents",

	'river:create:object:recext' => '%s mis en signet %s',
	'river:comment:object:recext' => '%s a commenté le signet %s',
	'recext:river:annotate' => 'a posté un commentaire sur ce signet',
	'recext:river:item' => 'un élément',

	'item:object:recext' => 'Eléments mis en signets',

	'recext:group' => 'Signets du groupe',
	'recext:enablerecext' => 'Activer les signets du groupe',
	'recext:nogroup' => 'Ce groupe n\'a pas encore de signets',
	
	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "Ce widget affiche vos derniers signets.",

	'recext:recextlet:description' =>
			"Le recextlet vous permet de partager ce que vous trouvez sur le web avec vos contacts, ou pour vous-même. Pour l'utiliser, glissez simplement le bouton ci-dessous dans votre barre de liens de votre navigateur.",

	'recext:recextlet:descriptionie' =>
			"Si vous utilisez Internet Explorer, faites un clic droit sur le bouton et ajoutez le dans vos favoris, puis dans votre barre de liens.",

	'recext:recextlet:description:conclusion' =>
			"Vous pouvez mettre en signet n'importe quelle page en cliquant sur le recextlet.",

	/**
	 * Status messages
	 */

	'recext:save:success' => "Votre élément a bien été mis en signet.",
	'recext:delete:success' => "Votre signet a bien été supprimé.",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "Votre signet n'a pas pu être enregistré. Vérifiez que le titre et le lien sont corrects et réessayez.",
	'recext:save:invalid' => "L’adresse du signet est invalide et ne peut donc pas être sauvegardée.",
	'recext:delete:failed' => "Votre signet n'a pas pu être supprimé. Merci de réessayer.",
	'recext:unknown_recext' => 'Impossible de trouver le signet spécifié',
);
