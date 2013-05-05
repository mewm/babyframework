<?php

namespace Baby\Logger;

use Baby\Helper;

class Logger {

	public $logger = null;

	public function __construct($channel, $logFile)
	{
		//Only monolog support
		$this->logger = new \Monolog\Logger($channel);
		$this->logger->pushHandler(new \Monolog\Handler\StreamHandler($logFile));
		return $this->logger;
	}

}