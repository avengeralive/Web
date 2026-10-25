<?php
//header('Access-Control-Allow-Origin: *');
define('_JSEXEC', 1);
define('JS_BASE', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
use lib\JLoads,
    lib\JBase;

/**
* json.php
*
* Центральный диспетчер
*
*
**/


include_once $_SERVER['DOCUMENT_ROOT'] . '/list.php';

/************configuration *********/
if (get_magic_quotes_gpc())exit;

if (!function_exists('fil')) {
    function fil($text)
    {
        $quotes = array("\x27", "\x22", "\x60", "\t", "\n", "\r", "*", "%", "<", ">", "?", "!");
        $goodquotes = array("-", "+", "#");
        $repquotes = array("\-", "\+", "\#");
        $text = trim(strip_tags($text));
        $text = str_replace($quotes, '', $text);
        $text = str_replace($goodquotes, $repquotes, $text);
        return $text;
    }
}

if( !function_exists('Filtr') ) {
    function Filtr($Text)
    {
        if (gettype($Text)=='array')
        {
            foreach ($Text as $name => $value)
            {
                if(function_exists('real_escape_string')){

                    $arr_value[$name] = fil($value);
                    $arr_value[$name] = htmlspecialchars($arr_value[$name]);
                    $arr_value[$name] = ($arr_value[$name]);
                }
                else
                {
                    $arr_value[$name] = fil($value);
                    $arr_value[$name] = htmlspecialchars($arr_value[$name]);

                }
            }

            return $arr_value;
        }
        else
        {
            if(function_exists('real_escape_string'))
            {


                $cdf = fil($Text);
                $cdf= htmlspecialchars($cdf);
                $cdf = ($cdf);

                return $cdf;
            }
            else
            {
                $cdf = fil($Text);
                $cdf= htmlspecialchars($cdf);
                return $cdf;
            }}}
}

/************[end]configuration *********/

$JLoads = new JLoads;

/************function *********/

function action($fun, $param)
{

    if (!function_exists($fun)) {
        if (!empty($fun)) {

            if (file_exists(JS_BASE . DS . 'function/action' . DS . $fun . '.php')) {
                require_once(JS_BASE . DS . 'function/action' . DS . $fun . '.php');
                $func = $fun;
                if (!empty($param))
                    return $func($param);
                else
                    return $func(false);
            } else {
                echo 'Функция: ' . $fun . ' не найдена';
                exit;
            }
        }
    } else {

        $func = $fun;
        if (!empty($param))
            return $func($param);
        else
            return $func(false);

    }
}



/************объявляем USERID и TOKEN на основе $_REQUEST['token']*********/

if (!empty($_REQUEST['token'])) {
    if ( !defined('TOKEN')) define('TOKEN', $_REQUEST['token']);
    $WWW = '';
    $W = JBase::Query("SELECT `user_id` FROM `session_users` WHERE `wad_md5` = '".$_REQUEST['token']."' AND `domain` = '".DOMAIN."' LIMIT 1");
    while ($Where = $W->fetch_assoc()) {
    	$WWW = $Where['user_id'];
		if ($WWW > 0) $user = $WWW;
	}
	define('USERID', $WWW);
}




  

JLoads::initJSON();

$fun=0;
if (! empty($_GET['func']))
    $fun = $_GET['func'];

if (! empty($_POST['func']))
    $fun = $_POST['func'];

if ($fun) {
    $action = $_REQUEST['action'];
    
	//if ($token) define('TOKEN', $token); // cохраним token в конcтанте доcтупной отовcюду...
    
    $list_class = [
        "api" => "Api",
        "menuAdm" => "CMenuAdm",
        "user" => "CUser",
        "css" => "CCSS",
        "js" => "CCSS",
        "galery" => "CGalery",
        "sys" => "CSys",
        "stat" => "CStat",
        "panel" => "CPanel",
        "yandex" => "Yandex"
    ];
    $class = "\\lib\\" . ((isset($list_class[$fun]) && $list_class[$fun]) ? $list_class[$fun] : $fun); // обращение к cлаccу по его нику или прямо по названию
                                                                      // echo " !$class!, $fun , !$action!, ->". method_exists($class,$action);

    if ($fun && $action && method_exists($class, $action)) {
        //$method = array($class, $action);
		
         $method = $class."::".$action; // c php 7.0
        // по новому функцию вызываетcя прямо из клаccа c автоматичеccкой подгрузкой
        ob_start();  
        $res = $method();
        $cont = ob_get_contents();
        
        ob_end_clean();
        if ($cont && !$res)
            $res = $cont;
        if ($cont && $res)
        
        header('Content-Type: application/json');

        if (JBase::isJSON($res))
            echo $res;
        else
            echo json_encode($res); 
        die();
    }
}


