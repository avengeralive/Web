<?php

use lib\CTemplates,
    lib\JLoads;

ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');

session_start();

/**
 * ***************** подгрузка разрешенных точек входа (папок)****************************
 */
// поскольку теперь общая точка входа, для обеспечения обратной совместимости,
// вызов остальных точек входа идет здесь

$uri_clean = $_SERVER['DOCUMENT_URI'];
// обрезаем слеши по краям
$uri_clean = trim($_SERVER['DOCUMENT_URI'], "/");
$uri_clean = strtolower($uri_clean);

//ajax
if($uri_clean == 'json') {
    $index_path = $_SERVER['DOCUMENT_ROOT'].'/json.php';
    if (file_exists($index_path)){
         include_once ($index_path);
         exit();
    }       
}



/**
 * ***************** [end]подгрузка разрешенных точек входа (папок)****************************
 */

define('_WEXEC', 1);
define('WPATH_BASE', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

include_once __DIR__ . '/list.php';

if (! empty($_SERVER['REDIRECT_URL'])) {
    $getArr = explode("/", $_SERVER['REDIRECT_URL']);
    $_GET['page'] = $getArr[1];
    $fTest = true;
    $ArKey = [];
    $ArValue = [];
    foreach ($getArr as $key => $value) {
        if ($fTest) {
            $ArKey[] = $value;
            $fTest = false;
        } else {
            $ArValue[] = $value;
            $fTest = true;
        }
    }
    
    foreach ($ArKey as $key2 => $value2) {
        if (isset($value2) && $value2 != '') {
            $_GET[$value2] = $ArValue[$key2];  //warning
        } else {
            $_GET['page'] = $ArValue[$key2];
        }
    }
}

require_once (WPATH_BASE . '/lib.php');
require_once (WPATH_BASE . '/lib/class.CTemplates.php');
//require_once (WPATH_BASE . '/vendor/autoload.php'); //composer

if (substr($_SERVER['SERVER_NAME'], 0, 4) == 'www.')
    $serv_addr = substr($_SERVER['SERVER_NAME'], 4, strlen($_SERVER['SERVER_NAME']));
else
    $serv_addr = $_SERVER['SERVER_NAME'];

$user = CTemplates::Session_Go();
if (empty($user)) $user = 'wadmin_' . JLoads::$wad_md5;
JLoads::$cap = rand(10000, 99999);

//views
$entry_points = [
	'crm','leads','analytics','calendar','settings','template','users','modules','files','partner','catalogue','roles',
	'configupsell','configdiscount','configcrm','configcommon',
	'russianpost','russianpostapi','russianpostapi2','russianposthistory','russianpostblanks',
	'roles','fields','statuses','containers',
	'pbxtemplate','pbxrules','pbxcrm','pbxhistory','pbxqueue',
	'dadata','antispam','api','postback',
	'smstemplate','smsauto','smsproviders','smshistory',
	'goods','goodsadd','goodsaddbatch','goodshistory',
	'pbx','pbxinbound','pbxback','pbxcalls',
	'operators','operatorinvite','operatorsettings','operatorscripts',
	'statconversion','statoperators','statbuyout','statgeo','user'	
];		    
						    
foreach ($entry_points as $uri_test) {
    if ($uri_test == $uri_clean) {
    	CTemplates::Cabinet($user, $uri_test);
    	exit();
    }
}

$Page = CTemplates::Page();
CTemplates::index($user);

header($_SERVER["SERVER_PROTOCOL"] . " 200");
header('Content-type: text/html; charset=UTF-8');

global $Variable_HTML;
echo $Variable_HTML;

exit();
