<?php
/**
 * Config
 * Easy accesible libary of configs
 * @author Dennis Micky Jensen <root@mewm.org>
 */

namespace Baby;

require_once(INSTALL_PATH .'lib'. DIRECTORY_SEPARATOR .'Baby'. DIRECTORY_SEPARATOR .'Baby.php');

class Config {

	/**
	 * Holds config instance
	 * @var Baby\Config|null
	 */
	private static $configInstance = null;

	/**
	 * Holds all configs
	 * @var array
	 */
	private static $configs = array();

	/**
	 * Creates config intance
	 * @param  string $configFile
	 * @return Baby\Config
	 */
	public static function initialize($configFile = '') 
	{
		//Singleton
		if(self::$configInstance instanceof self) {
			return self::$configInstance;
		}

		$configFile = INSTALL_PATH . 'config' . DIRECTORY_SEPARATOR . $configFile;
		if(file_exists($configFile)) {

			$_configs = require_once $configFile;
			self::$configInstance = new Config($_configs);
			return self::$configInstance;

		} else {
			throw new \RuntimeException("Could not find config {$configFile}");	
		}

	}

	/**
	 * Constructs config array
	 * @param array $configs 
	 */
	private function __construct(array $configs)
	{
		//Add manual configs here
		$configs['paths']['corePath'] = INSTALL_PATH . 'lib' . DIRECTORY_SEPARATOR . 'Baby' . DIRECTORY_SEPARATOR;
		$configs['paths']['vendorPath'] = INSTALL_PATH .'lib' . DIRECTORY_SEPARATOR . 'Baby' . DIRECTORY_SEPARATOR . 'vendor/' . DIRECTORY_SEPARATOR;
		$configs['paths']['logPath'] = INSTALL_PATH .'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR;

		//Loop and set configs
		$_configs = new \ArrayObject($configs);
		foreach($_configs->getIterator() as $group => $configs) {
			
			$configs = new \ArrayObject($configs);
			foreach($configs->getIterator() as $key => $value) {
				$this->set($group, $key, $value);
			}

		}

		return true;

	}

	/**
	 * Set config
	 * @param mixed $group 
	 * @param mixed $key   
	 * @param mixed $value 
	 */
	public function set($group, $key, $value)
	{
		self::$configs[$group][$key] = $value;
		return true;
	}

	/**
	 * Fetches config
	 * @param  mixed $group 
	 * @param  mixed $key   
	 * @return mixed
	 */
	public static function get($group, $key) 
	{	
		if(!isset(self::$configs[$group][$key])) {
			throw new \OutOfBoundsException('The config is not set: '. $group . ' = '. $key);
		}

		return self::$configs[$group][$key];
	}

}