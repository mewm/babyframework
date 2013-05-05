<?php
/**
 * Contains native methods for the framework
 */

namespace Baby;

use Baby;

class Helper {

	/**
	 * Extracts and object or array
	 * @param  mixed $package 
	 * @return string
	 */
	public static function par($package)
	{
		echo '<pre>';
		print_r($package);
		echo '<pre>';
	}


	public static function getBaseClass($fullClass)
	{
		$_baseClass = explode('\\', $fullClass);
		return $_baseClass[count($_baseClass) - 1];
	}

}