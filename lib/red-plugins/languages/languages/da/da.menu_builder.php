<?php

	$danish = array(
	
		/**
		 * Menu punkts and titles
		 */
	
		'menu_builder' => "Menu Bygger",
		'LOGGED_OUT' => "Bes�gende",
		
		// punkt
		'item:object:menu_builder_menu_item' => "Menu Bygger punkt",
	
		// views
		// edit
		'menu_builder:edit_mode:off' => "Vis tilstand",
		'menu_builder:edit_mode:on' => "�ndrings tilstand",
		'menu_builder:edit_mode:add' => "Klik for at tilf�je ny menu punkt",
	
		'menu_builder:toggle_context' => "Skift sammenh�ng",
		'menu_builder:toggle_context:normal_user' => "Viser menuen som ikke admin bruger",
		'menu_builder:toggle_context:logged_out' => "Viser menuen for bes�gende",
		'menu_builder:toggle_context:all' => "Viser alle menuens punkter",
		'menu_builder:toggle_context:default' => "Viser menuen som administrator",
				
		// add
		'menu_builder:add:title' => "Tilf�j nyt menu punkt",
		'menu_builder:add:form:title' => "Titel",
		'menu_builder:add:form:url' => "URL",
		'menu_builder:add:form:parent' => "Overordnet menu punkt",
		'menu_builder:add:form:parent:toplevel' => "�verst niveau menu punkt",
		'menu_builder:add:form:access' => "Hvem skal kunne se dette menu punkt?",
		'menu_builder:add:access:admin_only' => "Kun admins",
	
		// actions
		'menu_builder:actions:edit:error:input' => "Forkert input for at tilf�je/�ndre et menu punkt",
		'menu_builder:actions:edit:error:entity' => "Det givne GUID kunne ikke findes",
		'menu_builder:actions:edit:error:subtype' => "Det givne GUID er ikke et menu punkt",
		'menu_builder:actions:edit:error:create' => "Der er desv�rre opst�et en fejl under oprettelsen af menu punktet, pr�v venligst igen",
		'menu_builder:actions:edit:error:parent' => "Du kan ikke flytte dette menupunkt, for det har undermenuer. Flyt venligst alle undermenuer f�rst.",
		'menu_builder:actions:edit:error:save' => "Der er desv�rre opst�et en fejl under gemmelsen af menu punktet, pr�v venligst igen",
		'menu_builder:actions:edit:success' => "Menupuntket er hermed gemt",
	
		'menu_builder:actions:delete:success' => "Menupunktet er hermed slettet",
		
	);
					
	add_translation("da",$danish);
