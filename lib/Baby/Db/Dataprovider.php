<?php
/**
 * Data provider
 * @author Dennis Micky Jensen <root@mewm.org>
 */

namespace Baby\Db;

class Dataprovider {

	/**
	 * Holds driver
	 * @var Baby\Database\DriverInterface
	 */
	private $driver;

	/**
	 * Initializes a new driver
	 * @return Baby\Database\DriverInterface
	 */
	public static function initialize($driverName) {

		//A lot of these drivers are supported in phpactiverecord
		switch ($driverName) {
			case 'mysql':
			case 'pgsql':
			case 'sqlite':
			case 'oci':
				$genericDriver = new Driver\PhpActiveRecord();
				return new Dataprovider($genericDriver)	;
				break;

			default:
				throw new \RangeException('Driver not supported:'. $driverName);
				break;				
		}

	}

	/**
	 * Connect to driver
	 * @param Baby\Database\DriverInterface $driver [description]
	 */
	public function __construct(Driver\DriverInterface $driver) 
	{
		$this->driver = $driver;
		$this->driver->connect();
	}
	
}
