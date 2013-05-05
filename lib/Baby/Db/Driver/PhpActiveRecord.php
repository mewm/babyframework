<?php
/**
 * PhpActiveRecord driver
 * @author Dennis Micky Jensen <root@mewm.org>
 */
namespace Baby\Db\Driver;

class PhpActiveRecord implements DriverInterface {

	/**
	 * Internal driver
	 * @var string
	 */
	private $internalDriver = '';
	
	/**
	 * Construct driver
	 */
	public function __construct()
	{
		//Do all needed stuff for the driver here, like import of libaries etc.
		require_once(\Baby\Config::get('paths', 'vendorPath') .'php-activerecord/ActiveRecord.php');
		$this->internalDriver = $internalDriver;		

	}

	/**
	 * Connect using driver
	 * @return $cfg
	 */
	public function connect()
	{

		$host = \Baby\Config::get('db', 'host');
		$user = \Baby\Config::get('db', 'user');
		$password = \Baby\Config::get('db', 'password');
		$database = \Baby\Config::get('db', 'database');

		$cfg = \ActiveRecord\Config::instance();
		$cfg->set_model_directory(\Baby\Config::get('paths', 'appPath') .'model/');
		$cfg->set_connections(array(
			'development' => "{$this->internalDriver}://{$user}:{$password}@{$host}/{$database}"
		));

		return $cfg;

	}

	
}