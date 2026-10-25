<?php
//Общие функции
if ($_POST && $c['form_write'])
{
	if(!substr_count($_SERVER['PHP_SELF'], 'online.php') &&
	!substr_count($_SERVER['PHP_SELF'], 'refresh.php'))
	{
		$body="=====================\n";
	    $body.=date("d-m-Y H:i", time())."\n";
	    $body.="F: ".$_SERVER['PHP_SELF']."\n";
	    $body.="IP: ".$_SERVER['REMOTE_ADDR']."\n";
	    while (list($key1, $value1) = each(${"_POST"}))
	    {
	        if($key1=='pass')  $body.=$key1.": ".md5($value1)."\n";
			else $body.="$key1: $value1\n";
	    }
	    $fp = fopen("/home/admin/web/".$c['host']."/public_html/adminion/form-logs/post-".date('d-m-Y').".txt", "a");
	    fwrite($fp, $body);
	    fclose($fp);
	}
}

//Debug
function dtr($echo = true)//Показывает стек вызовов - файлы и функции
{
    global $u, $c, $ADMIN;

	$stack = '';
    $i = 1;
    $trace = debug_backtrace();
    unset($trace[0]);

	foreach($trace as $node)
	{
		$stack .= "#".$i.": ".basename($node['file']) ."(" .$node['line']."): ";
        if(isset($node['class'])) $stack .= $node['class'] . "->";
        $stack .= $node['function'] . "()" . PHP_EOL;
        $i++;
    }

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1) echo nl2br($stack).'<br>';
	else return $stack;
}

function dvar($var, $line = 0)//Вывод массивов, переменных и объектов
{
	global $u, $c;

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1)
	{
		echo '<pre>'.err_tr($line);

		if (is_array($var) || is_object($var)) echo htmlentities(print_r($var, true));
		elseif (is_string($var)) echo "str(" . strlen($var) . ") \"" . htmlentities($var) . "\"<br>";
		else var_dump($var);

		echo "\n</pre>";
	}
}

//echo '<pre>';
//print_r(get_defined_vars());
//echo "\n</pre>";


function pr($s1 = 'test', $s2 = 'test', $s3 = 'test', $s4 = 'test', $s5 = 'test', $s6 = 'test', $s7 = 'test', $s8 = 'test', $s9 = 'test', $s10 = 'test')//Вывод для отладки
{
    global $u, $c, $ADMIN;

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1)
	{
        for($n = 1; $n <= 10; $n++)
		{
			if(${'s'.$n} != 'test' || $n==1)
			{
				if (is_array(${'s'.$n}) || is_object(${'s'.$n})) dvar(${'s'.$n}, 1);
				else  echo err_tr().${'s'.$n}."<br>";
			}
		}
	}
}

function err_tr($line = 0)//Трейс для отладки
{
    global $u, $c, $ADMIN;

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1)
	{
        $trace = debug_backtrace();
		$trace[$line]['file'] = str_replace('.php', '', $trace[$line]['file']);
        $trace[$line+1]['file'] = str_replace('.php', '', $trace[$line+1]['file']);
        $trace[$line+2]['file'] = str_replace('.php', '', $trace[$line+2]['file']);

        //$result =  basename($trace[$line+2]['file'])."[" .$trace[1]['line']."][".$trace[$line+3]['function']."] => ";
        $result = "";
		$result .= basename($trace[$line+1]['file'])."[" .$trace[1]['line']."][".$trace[$line+2]['function']."] => ";
		$result .= basename($trace[$line]['file'])."[" .$trace[$line]['line']."][".$trace[$line+1]['function']."]: ";
        return $result;
	}

	return;
}

function ex($str = '')//Выход для отладки
{
    global $u, $c, $ADMIN;

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1)
	{
		if ($str != '' && (is_array($str) || is_object($str))) dvar($str, 1);
		else {
    			echo err_tr();
				if($str != '') echo ": ".$str."<br>";
			 }
		exit('<font color=red>#exit</font><br>');
	}
}

function eLog($str, $line = 0)
{
	global $c;

    if (is_array($str) || is_object($str)) $str2 = print_r($str, true);
	else $str2 = $str;
	
	error_log(err_tr($line).$str2);
}

function el($s1 = 'test', $s2 = 'test', $s3 = 'test', $s4 = 'test', $s5 = 'test', $s6 = 'test', $s7 = 'test', $s8 = 'test', $s9 = 'test', $s10 = 'test')
{
    global $u, $c, $ADMIN;

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1)
	{
        for($n = 1; $n <= 10; $n++)
		{
			if(${'s'.$n} != 'test' || $n==1)
			{
				if (is_array(${'s'.$n}) || is_object(${'s'.$n})) $str2 = print_r(${'s'.$n}, true);
				else  $str2 = ${'s'.$n};

				error_log(err_tr().$str2);
			}
		}
	}
}

function merr($echo = true)
{
    global $dbgo, $u, $c, $ADMIN;

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1)
	{
		$text = err_tr().'<font color=red>Mysql Error: '.mysql_errno($dbgo) . ": " . mysql_error($dbgo) . "</font><br>";

		if($echo) echo $text;
		else return $text;
	}
}

function derr($echo = true)
{
    global $dbgo, $u, $c, $ADMIN;

	if(in_array($u->info['id'], $c['admins']) || $ADMIN==1)
	{
		$errors = error_get_last();
		$text = err_tr()."<font color=red>PHP error: ".$errors['type']."<br>".$errors['message']."</font><br>";

		if($echo) echo $text;
		else return $text;
	}
}

function dStart($str = 'prof', $line = 0)
{
    global $c, $prof_timing, $prof_names, $prof_line, $reset_prof;

	$prof_timing[] = microtime(true);
    $prof_names[] = $str;

	$trace = debug_backtrace();
    $trace[$line]['file'] = str_replace('.php', '', $trace[$line]['file']);
    $trace[$line+1]['file'] = str_replace('.php', '', $trace[$line+1]['file']);
    $prof_line[] = basename($trace[$line]['file'])."[" .$trace[$line]['line']."]";
	//basename($trace[$line+1]['file'])."[" .$trace[$line+1]['line']."] => ".
}

function dPrint($log = 1)
{
    global $u, $c, $prof_timing, $prof_names, $prof_line, $ADMIN, $reset_prof;

	if(!in_array($u->info['id'], $c['admins']) && !$ADMIN) $log = 1;

	$size = count($prof_timing);
	$total_time = $prof_timing[$size-1]-$prof_timing[0];
	
	if($size==1)
	{
        dStart('all', 1);
		$size++;
	}

    for($i=0; $i<=$size - 1; $i++)
    {
        if($prof_names[$i] == 'prof') $prof_names[$i].='['.$i.']';
		$per = ' ('.($i ? round(($prof_timing[$i]-$prof_timing[$i-1])/($total_time/100),2) : '0').'%)';
		if($log==1) eLog ($prof_line[$i]." ".$prof_names[$i].":".sprintf(" %f", ($i==0 ? 0  : $prof_timing[$i]-$prof_timing[$i-1])).$per);
		else echo $prof_line[$i]."&nbsp;<b>".$prof_names[$i]."</b>:".sprintf("&nbsp;%f", ($i==0 ? 0  : $prof_timing[$i]-$prof_timing[$i-1])).$per."<br>";
    }

	if($size > 2)
	{
		$trace = debug_backtrace();
		$trace[0]['file'] = str_replace('.php', '', $trace[0]['file']);
        $trace[1]['file'] = str_replace('.php', '', $trace[1]['file']);

		if($trace[1]['file']) $str = basename($trace[1]['file'])."[" .$trace[1]['line']."]";
		//if($trace[1]['file']) $str = basename($trace[1]['file'])."[" .$trace[1]['line']."] => ".$str;

        if($log==1) eLog ($str." all:".sprintf(" %f", $prof_timing[$size-1]-$prof_timing[0]).' (100%)');
		else echo $str."&nbsp;<b>all</b>:".sprintf("&nbsp;%f", $prof_timing[$size-1]-$prof_timing[0]).' (100%)<br><br>';
	}

	unset($GLOBALS['prof_timing'], $GLOBALS['prof_names'], $GLOBALS['prof_line']);
}

function ErrShow()
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
}

if((isset($c['test_server']) && $c['test_server']==1 && $u->info['admin']>0) || $SHOW_ERR==1) ErrShow();


//Генерация кода
function GenCode($len)
{
    $activate = '';
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $alphaLength = strlen($alphabet) - 1;

	for ($i = 0; $i < $len; $i++)
	{
        $n = rand(0, $alphaLength);
        $activate .= $alphabet[$n];
    }

	return $activate;
}

function Exists($url)
{
	$file_headers = @get_headers($url);
	return ($file_headers[0] == 'HTTP/1.1 404 Not Found'  ? false : true);
}

function TextToLink($text)
{
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $text);
}

function LA()
{
    $la = sys_getloadavg();
	$la_now = round(($la[0]*100)/8);

	return array($la[0], $la[1], $la[2], $la_now);
}

function do_query($sql, $line=0)
{
    $result = mysql_query($sql);

	$err = mysql_error();

	if($err)
	{
		$err = err_tr($line).'error ('.mysql_errno().'): '.$err;

    	error_log(err_tr($line).'query: '.$sql);
    	error_log($err);
	}

	return $result;
}

/*function DelUser($uid)
{
    $pl = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id`="'.$uid.'" LIMIT 1'));
	if(!isset($pl['id'])) return false;
    $del = 0;

	mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
    mysql_query('DELETE FROM `actions_fast` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
    mysql_query('DELETE FROM `aaa_birthday` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `aaa_bonus` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `aaa_reting_list` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
    mysql_query('DELETE FROM `achiev` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `aaa_znahar` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `bank` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `dungeon_actions` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$pl['id'].'" OR `uid` = "-51'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `forum_msg` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `friends` WHERE `user` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `friends` WHERE `friend` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `izlom_rating` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `logs_auth` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `mults` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `mults` WHERE `uid2` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `notepad` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `obraz` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `online` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `rep` WHERE `id` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `stats` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_animal` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_gifts` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
    mysql_query('DELETE FROM `telegram` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];

	return $del;
}*/

?>