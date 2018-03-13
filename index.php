<?php

spl_autoload_register();
session_start();

use Core\Application;

/**
 * 
 */
$application = new Application();
$application->launch();
