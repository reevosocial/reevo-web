<?php
return array(

	/**
	 * Menu items and titles
	 */
	'recext' => "Enlaces",
	'recext:add' => "Agregar un enlace",
	'recext:edit' => "Editar enlace",
	'recext:owner' => "Enlaces de %s",
	'recext:friends' => "Enlaces de amigos",
	'recext:everyone' => "Todos los enlaces",
	'recext:this' => "Marcar esta p&aacute;gina",
	'recext:this:group' => "Marcar en %s",
	'recext:recextlet' => "Herramientas de enlace rápido",
	'recext:recextlet:group' => "Herramientas de enlace rápido",
	'recext:inbox' => "Bandeja de entrada de enlaces",
	'recext:with' => "Compartir con",
	'recext:new' => "Un nuevo enlace",
	'recext:address' => "URL del enlace",
	'recext:source' => "Fuente",
	'recext:image' => "URL de la imagen que ilustra el enlace",
	'recext:none' => 'No hay enlaces',
	'recext:linksource' => "Leer el contenido completo en %s",


	'recext:notify:summary' => 'Nuevo enlace llamado %s',
	'recext:notify:subject' => 'Nuevo enlace: %s',
	'recext:notify:body' =>
'%s compartió un nuevo enlace: %s

Dirección: %s

%s

Ver y comentar el enlace en:
%s
',

	'recext:delete:confirm' => "¿Seguro que deseas borrar este enlace?",

	'recext:numbertodisplay' => 'N&uacute;mero de enlaces a mostrar',

	'recext:shared' => "Compartido",
	'recext:visit' => "Visitar enlace",
	'recext:recent' => "Enlaces recientes",

	'river:create:object:recext' => '%s compartió el enlace %s',
	'river:comment:object:recext' => '%s compartió en el enlace %s',
	'recext:river:annotate' => 'comentó este enlace',
	'recext:river:item' => 'un enlace',

	'item:object:recext' => 'Enlaces',

	'recext:group' => 'Enlaces de grupos',
	'recext:enablerecext' => 'Habilitar enlaces para Grupos',
	'recext:nogroup' => 'Este Grupo no tiene enlaces a&uacute;n',

	/**
	 * Widget and recextlet
	 */
	'recext:widget:description' => "Mostrar los &uacute;ltimos enlaces.",
	'recext:recextlet:tags' => "Indica etiquetas para este sitio (separadas por coma)",
	'recext:recextlet:button' => "Compartir en Reevo",
	'recext:recextlet:description' =>
			"Este botón (o <i>bookmarklet</i>) permite compartir y almacenar cualquier enlace de Internet dentro de la red de Reevo. Para usarlo, simplemente arrastra el botón de abajo a la barra de enlaces de tu navegador:",

	'recext:recextlet:descriptionie' =>
			"Si usas Internet Explorer, necesitas hacer click con el bot&oacute;n derecho del rat&oacute;n al enlace, select 'Añadir a favoritos, y entonces a la barra de enlaces.",

	'recext:recextlet:description:conclusion' =>
			"A continuación, puedes guardar cualquier página que visites haciendo clic en él. Si al momento de clickear en el botón has realizado una selección de texto en la página a almacenar, la selección se usará para autocompletar el campo de Descripción. Muy conveniente, ¿no?",

	/**
	 * Status messages
	 */

	'recext:save:success' => "El enlace fue guardado exitosamente.",
	'recext:delete:success' => "El enlace ha sido borrado.",

	/**
	 * Error messages
	 */

	'recext:save:failed' => "El enlace no pudo ser guardado. Aseg&uacute;rate de que el t&iacute;tulo y el enlace est&eacute;n correctamente escritos.",
	'recext:save:failed:duplicated' => "Ya existe un enlace con ese enlace. <a target=\"_blank\"href=\"/recext/view/%s\">Ir al enlace creado previamente...</a>",
	'recext:save:invalid' => "La direcci&oacute;n no es válida y no pudo ser guardada.",
	'recext:delete:failed' => "El enlace no pudo ser borrado. Intentalo de nuevo.",
	'recext:unknown_recext' => 'No se puede encontrar el enlace indicado',

	'recext:toggle:feature' => "Destacar",
	'recext:toggle:unfeature' => "No destacar",

	'recext:action:toggle_metadata:error' => "Un error desconocido ha ocurrido al editar el enlace, por favor intentelo de nuevo.",
	'recext:action:toggle_metadata:success' => "El enlace se editó correctamente.",


);
