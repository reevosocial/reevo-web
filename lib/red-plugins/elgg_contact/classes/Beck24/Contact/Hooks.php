<?php

namespace Beck24\Contact;

class Hooks {
	
	/**
	 * @var Singleton The reference to *Singleton* instance of this class
	 */
	private static $_instance;
	
	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct() {

	}
	
	/**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
	private function __clone() {
		
	}
	
	/**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }
	
    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
	public static function getInstance() {
		if (!static::$_instance) {
			static::$_instance = new static();
		}

		return static::$_instance;
	}

	/**
	 * Tell walled garden to reveal contact form
	 *
	 * @param type $hook
	 * @param type $handler
	 * @param type $return
	 * @param type $params
	 * @return type
	 */
	public function publicPages($hook, $handler, $return, $params) {
		$pages = [
			'contact',
			'contact/received'
		];
	
		if (is_array($return)) {
			$pages = array_merge($pages, $return);
		}
	
		return $pages;
	}
}