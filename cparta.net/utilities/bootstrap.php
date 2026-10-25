<?php

date_default_timezone_set('Europe/Moscow');

define("START_PATH", dirname(__FILE__));
define('ENVIRONMENT', file_exists(dirname(__FILE__) . '/_local') ? 'LOCAL' : 'PROD');

spl_autoload_register(function($className) {
    $path = dirname(__FILE__) . '/src/' . str_replace('_', DIRECTORY_SEPARATOR, $className);

    if (file_exists($path . '.php')) {
        require_once $path . '.php';
    }
    $path = dirname(__FILE__) . '/app/' . str_replace('_', DIRECTORY_SEPARATOR, $className);

    if (file_exists($path . '.php')) {
        require_once $path . '.php';
    }
    return false;
});
require_once dirname(__FILE__) . '/../includes/config.php';
require_once dirname(__FILE__) . '/src/composer/vendor/autoload.php';

$di = new DI();
$di->set('db_config', [
    'host' => $dbhost,
    'name' => $dbbase,
    'user' => $dblogin,
    'pass' => $dbpass
]);
foreach (glob(dirname(__FILE__) . '/resources/*.php') as $fn) {
    $name = preg_replace('/\.(\w+$)/', '', basename($fn));
    $di->set($name, require_once $fn);
}

$di->logger = new Logger_File(dirname(__FILE__) . '/logs');
Registry::set('di', $di);

if (ENVIRONMENT == 'PROD') {
    ini_set('display_errors', 'Off');
} else {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    
}
