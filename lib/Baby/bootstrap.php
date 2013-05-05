<?php
/**
 * Collects the framework
 */

require_once(INSTALL_PATH .'lib/Baby/Config.php');

//Load configuration
Baby\Config::initialize($dispatchSettings['config']);

//Run application
\Baby::app($dispatchSettings);