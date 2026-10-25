<?php
define('GAME', true);

function GetRealIp()
{
    if (!empty($_SERVER['https_CLIENT_IP'])) {
        $ip = $_SERVER['https_CLIENT_IP'];
    } elseif (!empty($_SERVER['https_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['https_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

define('IP', GetRealIp());


include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__chat_class.php');

//session_start();

if (isset($_GET['login']))
{
    $_POST['login'] = $_GET['login'];
    $_POST['pass'] = $_GET['pass'];
}

/* if (isset($_POST['psw']))
{
    $_POST['pass'] = $_POST['psw'];
} */

if (isset($_SESSION['login']) && !isset($_POST['login']))//
{
	$_POST['login'] = $_SESSION['login'];
    $_POST['pass'] = $_SESSION['pass'];
}

/*if (isset($_GET['cookie_login']) && $_GET['cookie_login'] != '')
{
	setcookie('login', $_GET['cookie_login'], time() + 60 * 60 * 24 * 7, '', $c['host']);
    setcookie('pass', $_GET['cookie_pass'], time() + 60 * 60 * 24 * 7, '', $c['host']);
    header('location: /bk');
    die();
}*/

function error($e)
{
    global $c;
    die('<html><head>
	 <meta https-equiv="Content-Type" content="text/html; charset=windows-1251">
	 <meta https-equiv="Content-Language" content="ru"><TITLE>Произошла ошибка</TITLE></HEAD>
	 <BODY text="#FFFFFF"><p><font color=black>
	 Произошла ошибка: <pre>' . $e . '</pre><b><p><a href="https://'.$c['host'].'">Назад</b></a><HR>
	 <p align="right">(c) <a href="https://' . $c['host'] . '">' . $c['name'] . '</a></p>
	 </body></html>');
}

//$socauth = false;

if (isset($_POST['login']) && isset($_POST['pass']))
{
	$u = mysql_fetch_array(mysql_query('SELECT `u`.`pass2`,`u`.`id`,`u`.`auth`,`u`.`login`,`u`.`pass`,`u`.`city`,`u`.`ip`,`u`.`ipreg`,`u`.`online`,
	`u`.`banned`,`u`.`admin`,`u`.`host_reg`,`u`.`securetime`,`u`.`timereg`, `u`.`bot_id` FROM `users` AS `u`
	WHERE `u`.`login`="' . mysql_real_escape_string($_POST['login']) . '" ORDER BY `id` ASC LIMIT 1'));// AND `bot_id`="0"

    if (isset($u['id'])) $auth_count = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `logs_auth` WHERE `uid` = "' . $u['id'] . '"
	AND `time` > "'.(time()-900).'" AND `type`="3" LIMIT 1'));

	$auth = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "' . $u['id'] . '" AND `ip` = "' . mysql_real_escape_string(IP) . '" LIMIT 1'));
	if ($c['securetime'] > 0 && IP != $u['ip'] && IP != $u['ipreg'] && !isset($auth['id'])
	&& $u['securetime'] < $c['securetime'] && $u['timereg'] < $c['securetime'])
	{
	    error('Вы не можете войти на персонажа "' . $_POST['login'] . '".<br>Скорее всего вы давно не меняли пароль. Для смены перейдите по ссылке: <a href="/repass.php?login=' . htmlspecialchars($_POST['login'], NULL, 'cp1251') . '">СМЕНА ПАРОЛЯ</a><br><br>Вам необходимо сменить пароль для безопасности персонажа, на почту по которой зарегистрирован персонаж придет новый случайно сгенерированный пароль.<br>Если у вас нет доступа к E-mail: Зарегистрируйте нового персонажа и обратитесь к Администрации, либо модераторам.');
	}

	if (md5(md5($_POST['pass'])) == $u['pass'])
	{
	    $_POST['pass'] = md5($_POST['pass']);
	}

	if (!isset($u['id']))
	{
	    error('Логин "' . $_POST['login'] . '" не найден в базе.');
	}
	elseif(isset($auth_count[0]) && $auth_count[0] > 2) error('Вы ввели пароль неверно 10 раз. Вы не сможете войти 15 минут.');// && $u['pass'] != md5($_POST['pass'])
	elseif ($u['bot_id'] != 0 || ($u['pass'] != md5($_POST['pass'])))// && $socauth == false
	{
	    mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`)
		VALUES ('" . $u['id'] . "','" . mysql_real_escape_string(IP) . "','" . mysql_real_escape_string($_SERVER['https_USER_AGENT']) . "','10','" . time() . "')");

		error('Неверный пароль к персонажу "' . $_POST['login'] . '".');
	}
	elseif ($u['banned'] > 0)
	{
	    $fm = mysql_fetch_array(mysql_query('SELECT * FROM `users_delo` WHERE `uid` = "' . $u['id'] . '" AND `hb`!=0 ORDER BY `id` DESC LIMIT 1'));
	    if (!isset($fm['id']))
		{
	        $fm['text'] = 'Причина блокировки: <i>Причина пока-что не указана.</i>';
	    }
	    error(
	        'Персонаж <b>' . $_POST['login'] . '</b> заблокирован.' .
	        '<br>' . $fm['text'] . '<br>' .
	        '<br><b>Внимание!</b> Если Вы уверены, что произошла ошибка и Вы ничего не нарушали, оставьте, пожалуйста, вашу заявку на <a href="https://testcombats.ru/support.php">Центр Тех поддержки пользователей</a>' .
	        '<br>Перед тем как писать, <b>ВНИМАТЕЛЬНО</b> ознакомитесь с <a target="_blank" href="https://testcombats.ru/encicl/law.html">действующими законами</a> и <a target="_blank" href="https://testcombats.ru/encicl/law2.html">пользовательским соглашением</a>.'
	        . '<br><br><font color="red"><b>Если Вы заблокированы правомерно, то у Вас есть шанс выйти из блока на платной основе</b></font> <font color="green"><b>(минимальная сумма 100 ЕКР, данная сумма идёт на баланс вашего игрового персонажа и внутри игры можно распоряжаться ею как угодно)</b></font> .'
	    );
	} //else {

	    //Второй пароль
	   /*  if ($u['pass2'] != '' && $u['pass2'] != '0')
		{
	        $_SESSION['login'] = $_POST['login'];
	        $_SESSION['pass'] = $_POST['pass'];
	        $good2 = false;
	        $koko = '';

	        if (md5($_POST['code']) == $u['pass2']) {
	            $good2 = true;
	            unset($_SESSION['login'], $_SESSION['pass']);
	        } else {
	            $koko = 'Неверный второй пароль';

				if($c['test_server'])
				{
                    setcookie('login', '', time() - 60 * 60 * 24, '', '.'.$c['host_work']);//mine
	        		setcookie('pass', '', time() - 60 * 60 * 24, '', '.'.$c['host_work']);//mine
				}
	            setcookie('login', '', time() - 60 * 60 * 24, '', '.'.$c['host']);//mine
	        	setcookie('pass', '', time() - 60 * 60 * 24, '', '.'.$c['host']);//mine
	            setcookie('login', '', time() - 60 * 60 * 24, '', $c['host']);
	            setcookie('pass', '', time() - 60 * 60 * 24, '', $c['host']);
	            setcookie('login', '', time() - 60 * 60 * 24);
	            setcookie('pass', '', time() - 60 * 60 * 24);
	        }
 */
	       /*  if ($koko != '') {
	            $koko = '<font color="red"><b>' . $koko . '</b></font>'; */
	        }
	       /*  if ($good2 == false) {
	            ?>
	            <HTML>
	            <HEAD>
	                <link rel=stylesheet type="text/css" href="//testcombats.ru/i/main.css">
	                <meta content="text/html; charset=windows-1251" https-equiv=Content-type>
	                <META https-Equiv=Cache-Control Content=no-cache>
	                <meta https-equiv=PRAGMA content=NO-CACHE>
	                <META https-Equiv=Expires Content=0>
	                <TITLE>Второй пароль</TITLE>
	            </HEAD>
	            <body bgcolor=666666>
	            <H3><FONT COLOR="black">Запрос второго пароля к персонажу.</FONT></H3>
	            <?= $koko ?>
	            <div align="center">
	                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
	                        codebase="//fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
	                        width="100%" height="100%">
	                    <param name="movie" value="//testcombats.ru/psw2.swf"/>
	                    <param name="quality" value="high"/>
	                    <param name="wmode" value="transparent">
	                    <embed src="//testcombats.ru/psw2.swf"
	                           quality="high"
	                           type="application/x-shockwave-flash"
	                           WMODE="transparent"
	                           width="600"
	                           height="250"
	                           pluginspage="//www.macromedia.com/go/getflashplayer"/>
	                </object>
	            </div>
	            </BODY>
	            </HTML>
	            <?
	            die();
	        } */
	   // }

	    //$st = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id`="' . $u['id'] . '" LIMIT 1'));
	   // if (!isset($st['id'])) {
	        //mysql_query("INSERT INTO `stats` (`id`,`stats`) VALUES ('" . $u['id'] . "','s1=3|s2=3|s3=3|s4=3|rinv=40')");
	    //}
	    //$on = mysql_fetch_array(mysql_query('SELECT * FROM `online` WHERE `uid`="' . $u['id'] . '" LIMIT 1'));
	   /*  if (!isset($on['id'])) {
	        mysql_query("INSERT INTO `online` (`uid`,`timeStart`) VALUES ('" . $u['id'] . "','" . time() . "')");
	    } */

		/* if (isset($_COOKIE['login']) || isset($_COOKIE['pass']))
		{
            if($c['test_server'])
			{
                setcookie('login', '', time() - 60 * 60 * 24, '', '.'.$c['host_work']);//mine
	        	setcookie('pass',  '', time() - 60 * 60 * 24, '', '.'.$c['host_work']);//mine
                setcookie('auth2', '', time() - 60 * 60 * 24, '', '.'.$c['host_work']);
			}

			setcookie('login', '', time() - 60 * 60 * 24, '', '.'.$c['host']);//mine
	        setcookie('pass', '', time() - 60 * 60 * 24, '', '.'.$c['host']);//mine

			setcookie('login', '', time() - 60 * 60 * 24, '', $c['host']);
	        setcookie('pass', '', time() - 60 * 60 * 24, '', $c['host']);

			setcookie('login', '', time() - 60 * 60 * 24);
	        setcookie('pass', '', time() - 60 * 60 * 24);

			setcookie('auth2', '', time()-60*60*24,'',$c['host']);
            setcookie('auth2', '', time()-60*60*24,'','.'.$c['host']);
            setcookie('auth2', '', time() - 60 * 60 * 24);
	    }
 */
	    //мульты
	    if ($u['admin'] == 0)
		{
	        $ipm1 = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "' . mysql_real_escape_string($u['id']) . '" AND `ip`!="' . mysql_real_escape_string($u['ip']) . '" ORDER BY `id` ASC LIMIT 1'));
	        $ppl = mysql_query('SELECT * FROM `logs_auth` WHERE `ip`!="" AND (`ip` = "' . mysql_real_escape_string($u['ip']) . '" OR `ip`="' . mysql_real_escape_string($ipm1['ip']) . '" OR `ip`="' . mysql_real_escape_string($u['ipreg']) . '" OR `ip`="' . mysql_real_escape_string(IP) . '" OR `ip`="' . mysql_real_escape_string($_COOKIE['ip']) . '")');
	        while ($spl = mysql_fetch_array($ppl)) {
	            $ml = mysql_fetch_array(mysql_query('SELECT `id` FROM `mults` WHERE (`uid` = "' . $spl['uid'] . '" AND `uid2` = "' . $u['id'] . '") OR (`uid2` = "' . $spl['uid'] . '" AND `uid` = "' . $u['id'] . '") LIMIT 1'));
	            if (!isset($ml['id']) && $spl['uid'] != $inf['id'] && $spl['ip'] != '' && $spl['ip'] != '127.0.0.1' && $spl['ip'] != '213.159.207.116') {
	                mysql_query('INSERT INTO `mults` (`uid`,`uid2`,`ip`) VALUES ("' . $u['id'] . '","' . $spl['uid'] . '","' . $spl['ip'] . '")');
	            }
	        }
	    }

	    if (isset($_COOKIE['ip']) && $_COOKIE['ip'] != IP)
		{
	        mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`)
			VALUES ('" . $u['id'] . "','" . mysql_real_escape_string($_COOKIE['ip']) . "','" . mysql_real_escape_string($_SERVER['https_USER_AGENT']) . "','1','" . time() . "')");
	    }

		
        setcookie('login', $_POST['login'], time() - 60 * 60 * 24, '', '.'.$c['host']);//mine
	    setcookie('pass', $u['pass'], time() - 60 * 60 * 24, '', '.'.$c['host']);//mine
		setcookie('login', $_POST['login'], time() + 60 * 60 * 24 * 7, '', $c['host']);
	    setcookie('pass', $u['pass'], time() + 60 * 60 * 24 * 7, '', $c['host']);
		$skey = md5($_POST['login'].$u['pass'].$c['skey']);
		setcookie('auth2', $skey, time()-60*60*24*7,'','.'.$c['host']);
		setcookie('auth2', $skey, time()+60*60*24*7, '', $c['host']);
        
		setcookie('login', $_POST['login'], time() + 60 * 60 * 24 * 7);
	    setcookie('pass', md5($_POST['pass']), time() + 60 * 60 * 24 * 7);
	    setcookie('ip', IP, time() + 60 * 60 * 24 * 150, '');
		setcookie('auth2', $skey, time()+60*60*24*7);
		
        

	    if ($u['online'] < time() - 520)
		{
	        $sp = mysql_query('SELECT `user` FROM `friends` WHERE `friend` = "' . $u['id'] . '"');
	        while ($pl = mysql_fetch_array($sp)) {
	            $usr = mysql_fetch_array(mysql_query('SELECT `id`,`online`,`login`,`city`,`room` FROM `users` WHERE `id` = "' . $pl['user'] . '" LIMIT 1'));
	            if (isset($usr['id']) && $usr['online'] > time() - 600) {
	                $chat->send('', $usr['room'], $usr['city'], '', $usr['login'], 'Вас приветствует: <b>' . $u['login'] . '</b>.', time(), 6, 0, 0, 0, 1);
	            }
	        }
	    }

	    $apu = '';

	    if ($u['auth'] != md5($u['login'] . 'AUTH' . IP) || $_COOKIE['auth'] != md5($u['login'] . 'AUTH' . IP) || $u['auth'] == '' || $u['auth'] == '0') {
	        if ($u['auth'] != '' && $u['auth'] != '0' && $u['ip'] != IP) {
	            mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
				VALUES ('1','capitalcity','0','','" . $u['login'] . "','В предыдущий раз этим персонажем заходили с другого компьютера " . date('d.m.Y H:i', $u['online']) . ". (Предыдущий ip: " . $u['ip'] . ")','-1','6','0')");
	        }
	        $apu = "`auth` = '" . md5($u['login'] . 'AUTH' . IP) . "',";
	        setcookie('auth', md5($u['login'] . 'AUTH' . IP), time() + 60 * 60 * 24 * 365, '', 'testcombats.ru');
	    }

	    if ($u['repass'] == 0) {
	        $ipnew = IP;
	    } else {
	        $ipnew = $u['ip'];
	    }

	    if ($u['login'] != 'admin')
		{
	        mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`)
			VALUES ('" . $u['id'] . "','" . IP . "','" . mysql_real_escape_string($_SERVER['https_USER_AGENT']) . "','0','" . time() . "')");
	    }
	    mysql_query("UPDATE `users` SET " . $apu . "`ip`='" . $ipnew . "',`dateEnter`='" . mysql_real_escape_string($_SERVER['https_USER_AGENT']) . "',`online`='" . time() . "' WHERE `login` = '" . mysql_real_escape_string($_POST['login']) . "' AND `pass` = '" . mysql_real_escape_string(md5($_POST['pass'])) . "' LIMIT 1");

	    if (isset($_POST['active_code_key'])) {
	        header('location: /active.php?code=' . htmlspecialchars($_POST['active_code_key'], NULL, 'cp1251'));
	    } else {
	        header('location: /battle');
	    }
	//}
//}//if (isset($_POST['psw']))
?>