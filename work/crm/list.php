<?php
use lib\JBase;
//header('Access-Control-Allow-Origin: *');
define('VOCU_FWK', true); // запускаем наш фреймверк
function is_valid_domain_name($domain_name)
{
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) && // valid chars check
        preg_match("/^.{1,253}$/", $domain_name) && // overall length check
        preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)); // length of each label
}
foreach (array('SSL_TLS_SNI','HTTP_HOST','SERVER_NAME') as $index) {
    if (isset($_SERVER[$index])) {
        if (! is_valid_domain_name($_SERVER[$index])) {
            @list ($admin_login, $try_domain) = explode('@', $_SERVER['SERVER_ADMIN']);
            if (is_valid_domain_name($try_domain)) {
                $_SERVER[$index] = $try_domain;
            } else {
                exit();
            }
        }
    }
}

if (! defined('_WEXEC') and ! defined('_JSEXEC') and ! defined('_MODEXEC')) {
    define('WPATH_BASE', dirname(__FILE__));
    define('DS', DIRECTORY_SEPARATOR);
    define('JS_BASE', dirname(__FILE__));
    
    if (file_exists(WPATH_BASE . DS . 'error/404.html')) {
        require_once (WPATH_BASE . DS . 'error/404.html');
        
        exit();
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        header('Status: 404 Not Found');
        exit();
    }
}

function filtr_text($value)
{
    if (gettype($value) == 'string')
        return strip_tags(($value));
    if (gettype($value) == 'array')
        return $value;
}

function filtr_html($value)
{
    return htmlspecialchars($value);
}

function filtr_int($value)
{
    return ((int) $value);
}

function userType($user)
{
    $userType = 0;
    $userType = JBase::Get_Field_Value_From_Id('my_users', $user, 'usertype');
    if(!empty($userType))
        return $userType;
    else
        return 5;
}

function HTTP() {
    $HTTP = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
    return $HTTP;
}

define('SSH_LOGIN', 'www-data');
define('SSH_PASSWORD', 'XGvPZzGs2WcM55Z7atcZ');
define('SSH_PORT', '22');
define('MYSQL_HOST', 'localhost');
define('MYSQL_LOGIN', SSH_LOGIN);
define('MYSQL_PASSWORD', SSH_PASSWORD);
define('MYSQL_DB', 'crm'); 
                                            
// автозагрузка классов из пространств имен
spl_autoload_register(function ($name) {

    $name = str_replace('\\', '/', $name);
    $arr = explode("/", $name);
    if (is_array($arr) && count($arr) > 1) { // если это пространства имен...
        $fname = basename($name);
        $fdir = dirname($name);
        $path = $_SERVER["DOCUMENT_ROOT"] . "/" . $fdir . "/class." . $fname . ".php";
        if (file_exists($path))
            include_once $path;
        else {
            // поищем просто по имени в lib  JBase
            $path = $_SERVER["DOCUMENT_ROOT"] . "/lib/class." . $fname . ".php";
            if (file_exists($path))
                include_once $path;
        }
        $ar_global_class=array("JBase","JLoads");
        if (in_array($fname, $ar_global_class)) {
            $path = $_SERVER["DOCUMENT_ROOT"] . "/lib/class.$fname.php";
            if (file_exists($path))
                include_once $path;
        }
    }else { // начинается не со слеша... 
        $ar_global_class=array("JBase","JLoads");
        if (in_array($name, $ar_global_class)) {
            $path = $_SERVER["DOCUMENT_ROOT"] . "/lib/class.$name.php";
            if (file_exists($path))
                include_once $path;
        }
    }
    
    
});
// if (!defined('TOKEN') && $_REQUEST['token'])
//     define('TOKEN', $_REQUEST['token']); // cохраним token в конcтанте доcтупной отовcюду
	define('DOMAIN', JBase::get_db()); // cохраним domain в конcтанте доcтупной отовcюду



