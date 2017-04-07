<?php
/**
 * Lorea Languages -- Translation files for Elgg
 *
 * @package        Lorea
 * @subpackage     Languages
 * @homepage       https://lorea.org/plugin/languages
 * @copyright      See COPYRIGHT.txt
 * @license        COPYING, https://gnu.org/licenses/gpl
 *
 */

elgg_register_event_handler('init', 'system', 'languages_init');

function languages_init() {

	 $translations = array(
	 	       'ca',	// Catalan
		       'da',	// Danish
		       'de',	// German
		       'en',	// English
		       'es',	// Spanish
		       'eu',	// Basque
		       'fr',	// French
	 	       'gl',	// Galician
		       'it',	// Italian
		       'ja',	// Japanese
		       'nl',	// Dutch
		       'pt',	// Portuguese
		       'sr',	// Serbian
		       'th',	// Thai
		       'zh',	// Chinese (Mandarin)
	);

	$path = elgg_get_plugins_path() . "languages/languages";

	foreach ($translations AS $lang) {
		register_translations("$path/$lang");
	}

	if (!elgg_is_logged_in()) {
		if (($lang = languages_get_useragent_language()) !== false) {
			elgg_set_config('language', $lang);
		}
	}

}

/**
 * languages_get_useragent_language -- Get preferred language from browser
 * 
 * @return String preferred language, or false
 */
function languages_get_useragent_language() {

	if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {

		register_translations(elgg_get_config('path') . "languages/", true);

		$available_languages = array_keys(elgg_get_config('translations'));
		$accepted_languages  = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);

		foreach ($accepted_languages as $i => $accepted_language) {
			$accepted_languages[$i] = trim(array_shift(preg_split("/[-;]/", $accepted_language)));
		}

		$langs = array_intersect($accepted_languages, $available_languages);
		if (count($langs) > 0) {
			return array_shift($langs);
		}
	}
	return false;

}
