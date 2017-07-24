<?php

namespace Beck24\Contact;

class Plugin {
	
	/**
	 * @var Singleton The reference to *Singleton* instance of this class
	 */
	private static $_instance;
	private $events;
	private $hooks;
	
	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct() {
		$this->events = Events::getInstance();
		$this->hooks = Hooks::getInstance();
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
    
    public function events() {
    	return $this->events;
    }
    
    public function hooks() {
    	return $this->hooks;
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

	
	public function contactPageHandler($page) {
		switch ($page[0]) {
			case 'received':
				$content = elgg_view_resource('elgg_contact/received');
				break;
		
			default:
				$content = elgg_view_resource('elgg_contact/contact');
				break;
		}
		
		if ($content) {
			echo $content;
			return true;
		}
		
		return false;
	}
}