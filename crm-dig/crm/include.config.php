<?php

$db = new mysqli("92.119.115.173", "crmuser", "V2e3C5x6", 'crm');
if (!$db) {
    header('HTTP/1.1 502 Database error');
    exit;
}

libxml_use_internal_errors(true);

session_start();

define('SITE_ROOT', dirname(__FILE__));

function class_autoloader($class) {
    $class = str_replace('\\', '/', $class);
    if (file_exists(SITE_ROOT.'/classes/'.$class.'.php'))  { require SITE_ROOT.'/classes/'.$class.'.php'; return; }
    echo "$class not found at ".SITE_ROOT;
}

spl_autoload_register('class_autoloader');
