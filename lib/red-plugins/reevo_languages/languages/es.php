<?php

return array (

// ************* BLOG

  'blog' => 'Blog',
	'blog:blogs' => 'Blog',
	'blog:revisions' => 'Revisiones',
	'blog:archives' => 'Archivos',
	'blog:blog' => 'Blog',
	'item:object:blog' => 'Publicaciones',

	'blog:title:user_blogs' => 'Publicaciones de %s',
	'blog:title:all_blogs' => 'Todas las publicaciones del blog',
	'blog:title:friends' => 'Publicaciones de amigos',

	'blog:group' => 'Publicaciones de grupos',
	'blog:enableblog' => 'Habilitar publicaciones del Blog para Grupos',
	'blog:write' => 'Crear una publicación',

	// Editing
	'blog:add' => 'Crear una publicación',
	'blog:edit' => 'Editar publicación',
	'blog:excerpt' => 'Extracto',
	'blog:body' => 'Cuerpo',
	'blog:save_status' => '&Uacute;ltimo guardado: ',

	'blog:revision' => 'Revisi&oacute;n',
	'blog:auto_saved_revision' => 'Revisi&oacute;n autoguardada',

	// messages
	'blog:message:saved' => 'Publicación guardada.',
	'blog:error:cannot_save' => 'No se puede guardar la publicación.',
	'blog:error:cannot_auto_save' => 'No se puede guardar la publicación en el Blog automáticamente.',
	'blog:error:cannot_write_to_container' => 'Acceso insuficiente para guardar la publicación.',
	'blog:messages:warning:draft' => '¡Este es un borrador no guardado de esta publicación!',
	'blog:edit_revision_notice' => '(Versi&oacute;n antigua)',
	'blog:message:deleted_post' => 'Publicación borrada.',
	'blog:error:cannot_delete_post' => 'No se puede borrar la publicación.',
	'blog:none' => 'No hay publicaciones',
	'blog:error:missing:title' => '¡Por favor ingresa un t&iacute;tulo!',
	'blog:error:missing:description' => '¡Por favor ingresa contenidos!',
	'blog:error:cannot_edit_post' => 'Esta publicación no existe o no tienes permiso para verla.',
	'blog:error:post_not_found' => 'No se puede encontrar el blog especificado.',
	'blog:error:revision_not_found' => 'No se puede encontrar esta revisi&oacute;n.',

	// river
	'river:create:object:blog' => '%s ha creado la publicación %s en el Blog',
	'river:comment:object:blog' => '%s ha comentado en la publicación %s',

	// notifications
	'blog:notify:summary' => 'Hay una nueva publicación en el blog titulada %s',
	'blog:notify:subject' => 'Nueva publicación: %s',
	'blog:notify:body' =>
'
%s creó una nueva publicación en el blog titulada: %s

%s

Ver y comentar en este enlace:
%s
',

	// widget
	'blog:widget:description' => 'Mostrar las &uacute;ltimas publicaciones del Blog',
	'blog:moreblogs' => 'M&aacute;s publicaciones',
	'blog:numbertodisplay' => 'N&uacute;mero de publicaciones a mostrar',
	'blog:noblogs' => 'No hay publicaciones',

  // event-manager

  'event_manager:event'  => 'Participar del evento',
  'event_manager:event:rsvp' => 'Inscripción',
  'event_manager:event:relationship:event_attending'  => 'Quiero participar',
  'event_manager:event:relationship:event_attending:undo'  => 'Cancelar mi participación',
  'event_manager:river:event_relationship:create:event_attending' => '%s participará de %s',
  'event_manager:edit:form:fee' => 'Costo',

);
