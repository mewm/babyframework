<?php
/**
 * Class loader
 * Registers different autoload methods
 * @author Dennis Micky Jensen <root@mewm.org>
 */

namespace Baby\Autoloader;

use Baby\Config,
	Baby\Helper;

class ClassLoader {

	/**
	 * Holds singleton instance
	 * @var Baby\Autoloader|null
	 */
	private static $autoloaderInstance = null;

	/**
	 * Holds autoloaders
	 */
	private $autoloaders = null;

	/**
	 * Singleton
	 * @return Baby\Autoloader
	 */
	public static function initialize() 
	{
		//Singleton
		if(!self::$autoloaderInstance instanceof self) {
			self::$autoloaderInstance = new self();
		}

		return self::$autoloaderInstance;
	}

	/**
	 * Register the autload methods upon instanciation
	 */
	private function __construct()
	{
		//Register framework assets
		\Baby::importVendor('Psr', 'Autoloader/SplClassLoader');
		$this->autoloaders['Baby'] = new \SplClassLoader('Baby', dirname(Config::get('paths', 'corePath')));
		$this->autoloaders['Baby']->register();

		//Register autoloader for each vendor
		foreach(new \DirectoryIterator(Config::get('paths', 'vendorPath')) as $vendor) {
			if(!$vendor->isDot() && $vendor->isDir()) {
				$this->autoloaders[$vendor->getBasename('.php')] = new \SplClassLoader($vendor->getBasename('.php'), Config::get('paths', 'vendorPath'));
				$this->autoloaders[$vendor->getBasename('.php')]->register();
			}
		}

		$this->autoloaders[] = new \SplClassLoader($vendor->getBasename('.php'), Config::get('paths', 'vendorPath'));

		//Load non PSR0 classes
		spl_autoload_register(array($this, 'controller'));
		spl_autoload_register(array($this, 'model'));
	}


	/**
	 * Loads controller
	 * @param  string $class
	 */
	public function controller($class) 
	{
		$this->load('controller', $class);
	}

	/**
	 * Loads model
	 * @param  string $class
	 */
	public function model($class)
	{		
		$this->load('model', $class);
	}


	/**
	 * Generic app loader
	 * @param  string $type
	 * @param  string $class
	 */
	private function load($type, $class) {

		$_classIsolated = explode('\\', $class);
		$_classIsolated = $_classIsolated[count($_classIsolated) - 1];

		$_classPath = Config::get('paths', 'appPath') . $type . DIRECTORY_SEPARATOR . $_classIsolated .'.php';
		if(file_exists($_classPath)) {
			require_once($_classPath);
		}
	}


}