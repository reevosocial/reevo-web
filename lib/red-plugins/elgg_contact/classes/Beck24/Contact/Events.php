<?php

namespace Beck24\Contact;

class Events {
	
	/**
	 * @var Singleton The reference to *Singleton* instance of this class
	 */
	private static $_instance;
	
	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct() {
		elgg_register_event_handler('init', 'system', [$this, 'init']);
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
	
	function init() {
		$plugin = Plugin::getInstance();
		
		elgg_register_action('contact/email', PLUGIN_DIR . '/actions/send.php', 'public');
    
	    // Register contact page as public page for walled-garden
	    elgg_register_plugin_hook_handler('public_pages', 'walled_garden', [$plugin->hooks(), 'publicPages']);
    
    	elgg_register_page_handler('contact', [$plugin, 'contactPageHandler']);
        
		// add navigation
		elgg_register_menu_item('site', array(
        	'name' => 'contact',
			'text' => elgg_echo('contact:contact'),
			'href' => 'contact'
		));
	}
	
}