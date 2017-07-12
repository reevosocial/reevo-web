<?php

namespace hypeJunction\Notifications;

/**
 * @property string $event
 * @property string $object_type
 * @property string $object_subtype
 * @property string $summary
 * @property string $subject
 * @property string $body
 * @property string $language
 * @property string $template
 */
class Template extends \ElggObject {

	const TYPE = 'object';
	const SUBTYPE = 'notification_template';

	/**
	 * {@inheritdoc}
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();
		$this->attributes['subtype'] = self::SUBTYPE;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDisplayName() {
		if ($this->template && elgg_language_key_exists("notification:$this->template")) {
			return elgg_echo("notification:$this->template");
		}
		return $this->subject;
	}

}
