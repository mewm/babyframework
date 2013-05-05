<?php

//Framework install path
define('INSTALL_PATH', dirname(__DIR__) .'/');

//Initial dispatch settings
$dispatchSettings = new \ArrayObject(array(
	'debug' => 'true',
	'config' => 'development.php'
));

//Get bootstrap
require_once(INSTALL_PATH . '/lib/Baby/bootstrap.php');





