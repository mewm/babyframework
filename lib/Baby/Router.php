<?php
/**
 * Handles everthing with the url;
 */
namespace Baby;

use Baby\Helper;

class Router 
{
	/**
	 * Controller
	 * @var string
	 */
	private $controllerName = null;
	
	/**
	 * Action
	 * @var string
	 */
	private $actionName = null;

	/**
	 * Parameters
	 * @var array
	 */
	private $params = array();

	/**
	 * Construct routes
	 * @param string $requestUri URI
	 */
	public function __construct($requestUri)
	{
		$_uriExploded = array_values(array_filter(explode('/', $requestUri))); //Remove blanks and reset keys
	
		switch (count($_uriExploded)) {
			
			//Default request
			case 0:
				$this->controllerName = \Baby\Config::get('web', 'defaultController');
				$this->actionName = \Baby\Config::get('web', 'defaultAction');
				break;
			
			//One 1
			case 1:
				$this->controllerName = $_uriExploded[0];
				$this->actionName = \Baby\Config::get('web', 'defaultAction');
				break;
			
			case 2:
				$this->controllerName = $_uriExploded[0];
				$this->actionName = $_uriExploded[1];
				break;

			case 3:
			default:
				$this->controllerName = $_uriExploded[0];
				$this->action = $_uriExploded[1];
				$this->params = array_slice($_uriExploded, 2);
				break;
		}
	
	}

	/**
	 * Get controller
	 * @return string
	 */
	public function getController()
	{
		return $this->controllerName;
	}

	/**
	 * Get action
	 * @return string
	 */
	public function getAction()
	{
		return $this->actionName;
	}

	/**
	 * Return parameters
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}
}