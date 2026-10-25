<?

function ali_error_handler ($errno, $errmsg, $filename, $linenum, $vars='') {
        if ($errno === 256) {
                // то это наша ошибка!
                };

        // функция перехвата ошибок исполнения
    $dt = date("Y-m-d H:m:s");
	$us = gettimeofday();
	$usec = $us['usec'];
    $err = $dt.":".$usec."\nERRNO=".$errno."\nERRMSG=".$errmsg."\nFILE=".$filename."\nLINE=".$linenum."\n\n";
        if (EHANDLER_SHOW_ERROR) {
                // показать для отладки
				echo "<table width=100%><tr><td bgcolor=#ffeeff>";
                echo "<br><font color=red size=2><pre>".$err."</pre></font>\n"; 
				if (function_exists('debug_backtrace')) {
					echo "<tr><td bgcolor=#ffeeff><font color=black size=2>";
				//	var_dump( debug_backtrace() );
					echo backtrace();
					echo "</font></td></tr>";
					};
				echo "</td></tr></table>";
				flush();
                };
        if (EHANDLER_DUMP_ALL_GLOBALS) {
                // показать для отладки ВСЁ
             //   echo "<hr><pre></pre>";
            //    var_dump($GLOBALS);
                };
        if (EHANDLER_LOG_ERROR) {
                // добавить в лог
	                @error_log ($err, 3, EHANDLER_LOG_FILE);
                };
        if (EHANDLER_EMAIL_ERROR) {
                // отослать письмо вебмастеру 
                @mail (EHANDLER_ADMIN_EMAIL, WWW_SERVER_NAME." ERROR IN ".$filename, $err);
                };
        if (EHANDLER_EXIT_ON_ERROR) {
                // сказать прости пользователю и умереть
				header("HTTP/1.0 503 Service Unavailable");
                echo EHANDLER_SURFER_MESSAGE;
                exit();
                };
}

error_reporting(E_ALL);
set_error_handler("ali_error_handler");


function alid($v) {
return ali_debug('', '', '', $v);
}

function ali_debug($txt, $f, $l, $v=false) {

	if (function_exists('debug_backtrace')) {
		backtrace();
		}
	else {
		$dbg=false;
		};

	if (EHANDLER_BREAKPOINT_DEBUG) {
		echo "<table width='100%'><tr><td bgcolor=#eeeeee>$txt<br>";
//		if (is_array($dbg)) {
//			echo "<pre>DEBUG BACKTRACE:\n";
//			print_r($dbg);
//			echo "</pre><hr><br>\n";
//			};
		if ($v) {
			echo "<pre>";
			print_r($v);
			echo "</pre><br>\n";
			};
		echo "FILE=$f<br>LINE=$l<br><br></td></tr></table>";
		};
	}


//  http://ru.php.net/debug_backtrace
function backtrace()
{
   $output = "<div style='text-align: left; font-family: monospace;'>\n";
//   $output .= "<b>Backtrace:</b><br />\n";
   $backtrace = debug_backtrace();
   foreach ($backtrace as $bt) {
       $args = '';
       foreach ($bt['args'] as $a) {
           if (!empty($args)) {
               $args .= ', ';
           }
           switch (gettype($a)) {
           case 'integer':
           case 'double':
               $args .= $a;
               break;
           case 'string':
               $a = htmlspecialchars(substr($a, 0, 512)).((strlen($a) > 512) ? '...' : '');
               $args .= "\"$a\"";
               break;
           case 'array':
               $args .= 'Array('.count($a).')';
               break;
           case 'object':
               $args .= 'Object('.get_class($a).')';
               break;
           case 'resource':
               $args .= 'Resource('.strstr($a, '#').')';
               break;
           case 'boolean':
               $args .= $a ? 'True' : 'False';
               break;
           case 'NULL':
               $args .= 'Null';
               break;
           default:
               $args .= 'Unknown';
           }
       }
       $output .= "<br />\n";
       $output .= "<b>file:</b> ".(isset($bt['file'])?$bt['file']:'').":".(isset($bt['line'])?$bt['line']:'')."<br />\n";
       $output .= "<b>call:</b> ".
	   	(isset($bt['class'])?$bt['class']:'').
	   	(isset($bt['type'])?$bt['type']:'').
	   	"{$bt['function']}($args)<br />\n";
   }
   $output .= "</div>\n";
   return $output;
}

?>
