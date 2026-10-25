<?
/**
*    Не совсем класс, а ф-ия перехвата ошибок и ее подключение.
*/

function ali_error_handler ($errno, $errmsg, $filename, $linenum, $vars) {
        if ($errno === 256) {
                // то это наша ошибка!
                };

        // функция перехвата ошибок исполнения
    $dt = date("Y-m-d H:i:s");
    $err = $dt."\nERRNO=".$errno."\nERRMSG=".$errmsg."\nFILE=".$filename."\nLINE=".$linenum."\n\n";
        if (EHANDLER_SHOW_ERROR) {
                // показать для отладки
				echo "<table width=100%><tr><td bgcolor=#ffeeff>";
                echo "<br><font color=red size=2><pre>".$err."</pre></font>\n"; 
				echo "</td></tr></table>";
				flush();
                };
        if (EHANDLER_DUMP_ALL_GLOBALS) {
                // показать для отладки ВСЁ
                echo "<hr><pre></pre>";
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

function ali_debug($txt, $f, $l, $v=false) {
	if (EHANDLER_BREAKPOINT_DEBUG) {
		echo "<table width=100%><tr><td bgcolor=#eeeeee>$txt<br>";
		if ($v) {
			echo "<pre>";
			print_r($v);
			echo "</pre><br>";
			};
		echo "FILE=$f<br>LINE=$l<br><br></td></tr></table>";
		};
	}

?>
