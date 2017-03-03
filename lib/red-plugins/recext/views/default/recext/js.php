//<script>

elgg.provide('elgg.recext');

elgg.recext.init = function() {
	$('.elgg-menu-item-recext > a').each(function () {
		this.href += '&title=' + encodeURIComponent(document.title);
	});
};

elgg.register_hook_handler('init', 'system', elgg.recext.init);
