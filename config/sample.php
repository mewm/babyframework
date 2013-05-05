<?php
/**
 * Development configs
 */

return array(
	'paths' => array(
		'installPath' => INSTALL_PATH,
		'appPath' => INSTALL_PATH .'app/'
	),
	'db' => array(
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'database' => 'Baby',
		'driver' => 'mysql'
	),
	'web' => array(
		'defaultController' => 'home',
		'defaultAction' => 'index'
	)
);

?>