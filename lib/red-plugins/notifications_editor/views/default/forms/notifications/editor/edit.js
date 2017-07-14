define(function(require) {

	var elgg = require('elgg');
	var $ = require('jquery');
	var spinner = require('elgg/spinner');

	$(document).on('change', '#notifications-editor-type', function(e) {
		var $type_picker = $(this);
		var $subtype_picker = $('#notifications-editor-subtype');

		var object_type = $type_picker.val();

		elgg.action('notifications/editor/subtypes', {
			data: {
				object_type: object_type,
			},
			beforeSend: spinner.start,
			complete: spinner.stop,
			success: function(data) {
				if (data.status < 0 || typeof data.output.object_subtypes === 'undefined') {
					return;
				}
				$subtype_picker.children('option').remove();
				$.each(data.output.object_subtypes, function(i, v) {
					console.log(v);
					$subtype_picker.append($('<option>').attr('value', v).text(v));
				});
			}
		});

	});
});
