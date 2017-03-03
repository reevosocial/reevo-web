<?php
/**
 * A Wiki Page
 *
 * @package       Lorea
 * @subpackage    MediawikiAPI
 *
 * TODO: Add license
 */

class ElggWikiPage extends ElggObject {

    /**
     * Set subtype to wiki_page
     *
     * @return Void
     */
    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->subtype = "wiki_page";
    }
}
