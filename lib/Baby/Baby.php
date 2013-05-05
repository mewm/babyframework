<?php

use Baby\Autoloader,
	Baby\Db,
	Baby\Router,
	Baby\Application,
	Baby\Logger,
	Baby\Helper;

class Baby {

	/**
	 * Holds routes
	 * @var null|Router
	 */
	private static $router = null;

	private static $app = null;

	private static $loggers = null;

	/**
	 * Dispatches app
	 * @param \ArrayObject $dispatchSettings
	 */
	public static function app(ArrayObject $dispatchSettings)
	{

		//Register autoloaders
		self::importModule('Autoloader', 'ClassLoader');
		Autoloader\ClassLoader::initialize();

		//Database
		Db\Dataprovider::initialize(Baby\Config::get('db', 'driver'));
		
		//Fire routes to the application here
		self::$router = new Router($_SERVER['REQUEST_URI']);		
		self::$app = new Application\App(self::$router);

	}


	/**
	 * Log feature
	 * @param  string $channel 
	 */
	public static function log($channel = 'application') 
	{
		$_logFile = Baby\Config::get('paths', 'logPath') . $channel . '.log';
		if(!isset(self::$loggers[$channel])) {
			self::$loggers[$channel] = new Logger\Logger($channel, $_logFile);	
		}

		return self::$loggers[$channel]->logger;
	}


	/**
	 * Import a vendor
	 * @param  string $folder 	
	 * @param  string $class  
	 */
	public static function importVendor($folder, $class) 
	{
		$_vendorPath = Baby\Config::get('paths', 'corePath') .'vendor' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $class .'.php';
		if(file_exists($_vendorPath)) {
			require_once $_vendorPath;
		} else {
			throw new \RuntimeException('Vendor not found: '. $_vendorPath);
		}
	}

	/**
	 * Import a madule
	 * @param  string $folder 
	 * @param  string $class  
	 */
	public static function importModule($folder, $class) 
	{
		$_classPath = Baby\Config::get('paths', 'corePath') . $folder . DIRECTORY_SEPARATOR . $class .'.php';
		if(file_exists($_classPath)) {
			require_once $_classPath;
		} else {
			throw new \RuntimeException('Module not found: '. $_classPath);
		}
	
	}


}