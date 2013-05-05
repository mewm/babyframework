<?php
/**
 * App
 * Forges the application from the router
 * @author Dennis Micky Jensen <root@mewm.org>
 */

namespace Baby\Application;

use Baby\Helper,
	Baby\Router,
	Baby\Application\Controller;

class App {

	/**
	 * Construct the application
	 * Fetches controller, action and params, then processes the request
	 * @param Router $router
	 */
	public function __construct(Router $router)
	{
		//Router vars
		$_controllerName = ucfirst($router->getController()); //Yes, I know PHP is case insensitive, but I like it to look authentical in the logs :P
		$_actionName = $router->getAction();
		$_params = $router->getParams();

		//Search for controller
		$_controllerClass = 'Baby\Application\\' . $_controllerName;
		if(class_exists($_controllerClass)) {
		
			//Grab controller
			$_controller = new $_controllerClass();
			if($_controller instanceof \Baby\Application\Controller) {

				//Does action exists?
				if(method_exists($_controller, $_actionName)) {

					//Execute action
					$_controller->prepare($_actionName)->flush();

				} else {
					throw new \OutOfBoundsException('Could not find requested action: '. $_actionName .' in controller '. $_controllerClass);	
				}

			} else {
				throw new \OutOfBoundsException('Invalid controller. Not instance of \Baby\Application\Controller');
			}

		} else {
			throw new \OutOfBoundsException('Could not find requested controller: '. $_controllerClass);
		}
	
	}

}