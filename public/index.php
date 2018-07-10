<?php
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

defined('REAL_PATH')
   || define('REAL_PATH', realpath(dirname(__FILE__) . '/../public'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/../../Library'),
    get_include_path(),
)));
require_once 'Zend/Application.php';  
$url = $_SERVER['REQUEST_URI'];
if (strpos($url, '/v1/') !== false) {
    //Create application, bootstrap, and run
	$application = new Zend_Application(
		APPLICATION_ENV, 
		APPLICATION_PATH . '/configs/restapplication.ini'
	);
} else {
	//Create application, bootstrap, and run
	$application = new Zend_Application(
		APPLICATION_ENV, 
		APPLICATION_PATH . '/configs/application.ini'
	);
}
$application->bootstrap()
            ->run();
