<?php
/**
 * Main controller
 * Handles a specific action, fetches view etc.
 * All controllers should extend this class
 * @author Dennis Micky Jensen <root@mewm.org>
 */

namespace Baby\Application;

use Baby\Router,
	Baby\Helper,
	Baby\Config;

abstract class Controller {

	/**
	 * Template
	 * @var string
	 */
	private $template = 'template.html';
	
	/**
	 * View
	 * @var string
	 */
	private $view;
	
	/**
	 * Requested controller
	 * @var string
	 */
	private $controller;
	
	/**
	 * Requested action
	 * @var string
	 */
	private $action;


	final public function prepare($action)
	{
		$this->controller = Helper::getBaseClass(get_class($this));
		$this->action = $action;

		//Run action
		$this->$action();

		//Check for view
		if($this->view == null) {
			
			//Guess view
			$_viewPath = Config::get('paths', 'appPath') . 'view' . DIRECTORY_SEPARATOR . strtolower($this->controller) . DIRECTORY_SEPARATOR . $action .'.php';
			if(file_exists($_viewPath)) {

			}

		}

		return $this;
	}

	final public function flush()
	{
		echo 'Execute';	
	}
	
	protected function getView()
	{
		return $this->view;
	}


	final public function __toString()
	{
		return get_class($this);
	}
}

