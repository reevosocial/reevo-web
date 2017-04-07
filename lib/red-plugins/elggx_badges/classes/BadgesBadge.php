<?php
/**
 * Badges Badge class
 *
 */

class BadgesBadge extends ElggFile {

	protected function initializeAttributes() {

		parent::initializeAttributes();

		$this->attributes['subtype'] = "badge";
	}

	public function __construct($guid = null) {
		if ($guid && !is_object($guid)) {
			// Loading entities via __construct(GUID) is deprecated, so we give it the entity row and the
			// attribute loader will finish the job. This is necessary due to not using a custom
			// subtype (see above).
			$guid = get_entity_as_row($guid);
		}

		parent::__construct($guid);
	}
}
