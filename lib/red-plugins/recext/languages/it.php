<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "Segnalibri",
	'recext:add' => "Aggiungi segnalibro",
	'recext:edit' => "Modifica segnalibro",
	'recext:owner' => "Segnalibri di %s",
	'recext:friends' => "Segnalibri degli amici",
	'recext:everyone' => "Segnalibri nel sito",
	'recext:this' => "Aggiungi questa pagina ai segnalibri",
	'recext:this:group' => "Segnalibro in %s",
	'recext:recextlet' => "Ottieni il Bookmarklet",
	'recext:recextlet:group' => "Ottieni il Bookmarklet di gruppo",
	'recext:inbox' => "Segnalibri in arrivo",
	'recext:with' => "Condividi con",
	'recext:new' => "Un nuovo segnalibro",
	'recext:address' => "Indirizzo del segnalibro",
	'recext:none' => 'Nessun segnalibro',

	'recext:notify:summary' => 'Nuovo segnalibro chiamato %s',
	'recext:notify:subject' => 'Nuovo segnalibro: %s',
	'recext:notify:body' =>
'%s ha aggiunto un nuovo segnalibro: %s

Indirizzo: %s

%s

Visualizza e commenta il segnalibro:
%s
',

	'recext:delete:confirm' => "Sei sicuro di voler eliminare questa risorsa?",

	'recext:numbertodisplay' => 'Numero di segnalibri da visualizzare',

	'recext:shared' => "Aggiunto ai segnalibri",
	'recext:visit' => "Visita risorsa",
	'recext:recent' => "Ultimi segnalibri",

	'river:create:object:recext' => '%s ha aggiunto ai segnalibri %s',
	'river:comment:object:recext' => '%s ha commentato un segnalibro %s',
	'recext:river:annotate' => 'un commento a questo segnalibro',
	'recext:river:item' => 'un elemento',

	'item:object:recext' => 'Segnalibri',

	'recext:group' => 'Segnalibri di gruppo',
	'recext:enablerecext' => 'Abilita i segnalibri di gruppo',
	'recext:nogroup' => 'Questo gruppo non ha ancora salvato nulla nei segnalibri',
	
	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "Visualizza i tuoi ultimi segnalibri.",

	'recext:recextlet:description' =>
			"Un Bookmarklet è un pulsante speciale che si salva nella barra dei preferiti del browser. Permette di salvare qualsiasi risorsa trovata sul web nei preferiti e, volendo, condividerla con gli amici. Per attivarlo trascinare il pulsante nella barra dei preferiti del tuo browser:",

	'recext:recextlet:descriptionie' =>
			"Se stai usando Internet Explorer, bisogna cliccare col tasto destro sull'icona del Bookmarklet, selezionare ''aggiungi ai preferiti'' e poi scegliere la barra dei collegamenti.",

	'recext:recextlet:description:conclusion' =>
			"Dopo sarà possibile aggiungere velocemente ai preferiti qualsiasi pagina visitata cliccando nel browser questo pulsate .",

	/**
	 * Status messages
	 */

	'recext:save:success' => "L'elemento è stato aggiunto ai segnalibri.",
	'recext:delete:success' => "Il segnalibro è stato eliminato.",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "Il segnalibro non può essere salvato. Assicurasi di aver inserito un titolo e un indirizzo, quindi riprovare.",
	'recext:save:invalid' => "L'indirizzo del segnalibro non è valido e non può essere salvato.",
	'recext:delete:failed' => "Il segnalibro non può essere eliminato. Riprovare.",
	'recext:unknown_recext' => 'Impossibile trovare il segnalibro specificato.',
);
