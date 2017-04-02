<?php
/**
 * Tasks languages
 *
 * @package ElggTasks
 */

$danish = array(

	/**
	 * Menu items and titles
	 */

	'tasks' => "Opgaver",
	'tasks:owner' => "%s's opgaver",
	'tasks:friends' => "Venners' opgaver",
	'tasks:all' => "Klubbens opgaver",
	'tasks:add' => "Ny opgave",

	'tasks:group' => "Gruppe opgaver",
	'groups:enabletasks' => 'Aktiver gruppe opgaver',

	'tasks:edit' => "Ændre opgave",
	'tasks:delete' => "Slet opgave",
	'tasks:history' => "Historik",
	'tasks:view' => "Vis opgave",
	'tasks:revision' => "Revision",

	'tasks:navigation' => "Navigation",
	'tasks:via' => "via opgaver",
	'item:object:task_top' => 'Top-niveau opgaver',
	'item:object:task' => 'Opgaver',
	'tasks:nogroup' => 'Denne gruppe har endnu ingen opgaver',
	'tasks:more' => 'Flere opgaver',
	'tasks:none' => 'Ingen opgaver lige nu',

	/**
	* River
	**/

	'river:create:object:task' => '%s oprettet en opgave %s',
	'river:create:object:task_top' => '%s oprettet en opgave %s',
	'river:update:object:task' => '%s opdateret en opgave %s',
	'river:update:object:task_top' => '%s opdateret en opgave %s',
	'river:comment:object:task' => '%s kommenter på en opgave %s',
	'river:comment:object:task_top' => '%s kommenter på en opgave %s',

	/**
	 * Form fields
	 */

	'tasks:title' => 'Opgaver titel',
	'tasks:description' => 'Opgave tekst',
	'tasks:tags' => 'Tags',
	'tasks:access_id' => 'Læse adgang',
	'tasks:write_access_id' => 'Skrive adgang',

	/**
	 * Status and error messages
	 */
	'tasks:noaccess' => 'Ingen adgang til opgaver',
	'tasks:cantedit' => 'Du kan ikke ændre denne opgave',
	'tasks:saved' => 'Opgave gemt',
	'tasks:notsaved' => 'Opgaven kunne ikke gemmes',
	'tasks:error:no_title' => 'Du skal vælge en titel til opgaven.',
	'tasks:delete:success' => 'Opgaven hermed slettet.',
	'tasks:delete:failure' => 'Opgaven kunne ikke slettes.',

	/**
	 * Task
	 */
	'tasks:strapline' => 'Sidst opdateret %s af %s',

	/**
	 * History
	 */
	'tasks:revision:subtitle' => 'Revision lavet %s af %s',

	/**
	 * Widget
	 **/

	'tasks:num' => 'Antallet af opgaver vist',
	'tasks:widget:description' => "Dette er en liste med dine opgaver.",

	/**
	 * Submenu items
	 */
	'tasks:label:view' => "Vis opgave",
	'tasks:label:edit' => "Ændre opgave",
	'tasks:label:history' => "Opgave historik",

	/**
	 * Sidebar items
	 */
	'tasks:sidebar:this' => "Denne opgave",
	'tasks:sidebar:children' => "Under-opgaver",
	'tasks:sidebar:parent' => "Over opgave",

	'tasks:newchild' => "Ny under-opgave",
	'tasks:backtoparent' => "Tilbage til '%s'",
	
	
	
	'tasks:start_date' => "Start",
	 'tasks:end_date' => "Slut",
	 'tasks:percent_done' => " færdig",
	 'tasks:work_remaining' => "Tilbage.",
	 

	 'tasks:task_type' => 'Type',
	 'tasks:status' => 'Status',
	 'tasks:assigned_to' => 'Opgave ejer',
	 
	 'tasks:task_type_'=>"",
	 'tasks:task_type_0'=>"",
	 'tasks:task_type_1'=>"Analyse",
	 'tasks:task_type_2'=>"Specifikationer",
	 'tasks:task_type_3'=>"Udvikling",
	 'tasks:task_type_4'=>"Test",
	 'tasks:task_type_5'=>"Event",
	 
	 'tasks:task_status_'=>"",
	 'tasks:task_status_0'=>"",
	 'tasks:task_status_1'=>"Åbnet",
	 'tasks:task_status_2'=>"Aktiveret",
	 'tasks:task_status_3'=>"På hold",
	 'tasks:task_status_4'=>"I gang",
	 'tasks:task_status_5'=>"Lukket",
	 
	 'tasks:task_percent_done_'=>"0%",
	 'tasks:task_percent_done_0'=>"0%",
	 'tasks:task_percent_done_1'=>"20%",
	 'tasks:task_percent_done_2'=>"40%",
	 'tasks:task_percent_done_3'=>"60%",
	 'tasks:task_percent_done_4'=>"80%",
	 'tasks:task_percent_done_5'=>"100%",
	 
	 'tasks:tasksboard'=>"Opgave tavle",
	 'tasks:tasksmanage'=>"Styring",
	 'tasks:tasksmanageone'=>"Styre en opgave",
);

add_translation("da", $danish);