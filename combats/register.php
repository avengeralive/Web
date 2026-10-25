<?
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__chat_class.php');
include('_incl_data/class/__filter_class.php');

if(isset($_GET['showcode']))
{
	include('secureimg/security.php');
	die();
}

$ipban2 = (!function_exists('GetRealIp') ? GetRealIpTest() : GetRealIp());

$multer = 0;
$ppl = mysql_query('SELECT * FROM `logs_auth` WHERE `ip`!="" AND (`ip`="'.mysql_real_escape_string($ipban2).'" OR `ip`="'.mysql_real_escape_string($_COOKIE['ip']).'")');
while($spl = mysql_fetch_array($ppl))
{
   	$multe = mysql_fetch_array(mysql_query('SELECT `id`,`timereg` FROM `users` WHERE `id` = "'.$spl['uid'].'" LIMIT 1'));
	if( $multe['timereg'] + 86400 > time() ) $multer = $multe['timereg'] + 86400 - time();
}

/* Отправка кода активации email */
if (isset($_POST['SendCode'])  && $_POST['SendCode']!='')
{
    $gd = array( 0,0,0,0,0,0,0,0,0,0,0 );
	$email = trim($_POST['mail']);

	$error = '';
    $good = 1;

	//проверяем e-mail
    $res = mysql_fetch_array(mysql_query('SELECT `mail` from `users` where `mail`="'.mysql_real_escape_string($email).'" LIMIT 1'));
    //код активации
    $code = mysql_fetch_array(mysql_query('SELECT `code`,`time` from `register_emailconfirmation` where `mail`="'.mysql_real_escape_string($email).'" LIMIT 1'));

	if(isset($res['mail']))
	{
		$error = 'Игрок с таким email уже существует.';
		$_POST['step'] = 3;
	}

	if(strlen($email)<6 || strlen($email)>50)
	{
		$error = 'E-mail не может быть короче 6-ти символов и длинее 50-ти.';
		$_POST['step'] = 3;
	}

	if(!preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email))
	{
		$error = 'Вы указали явно ошибочный E-mail.';
        $error2 = 'Чтобы получить код активации email, вам нужно указать верный email.';
        $_POST['step'] = 3;
	}
    if($error != '')
	{
		$gd[4] = $error;
        $gd[6] = $error2;
		$good = 0;
	} else {
		$gd[4] = 1;
	}

	if($code['time'] > time() - 300)
	{
		$error = 'Вы не можете запрашивать код чаще, чем 1 раз в 5 минут.';
		$_POST['step'] = 3;
	}

	if($error != '')
	{
		$gd[6] = $error;
		$good = 0;
	} else {
		$gd[4] = 1;
	}

	if( $good == 1 )
	{
		if(!$code['code'])
		{
			//Генерация кода
		    $activate = '';
		    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		    $alphaLength = strlen($alphabet) - 1;

			for ($i = 0; $i < 15; $i++)
			{
		        $n = rand(0, $alphaLength);
		        $activate .= $alphabet[$n];
		    }
			//Сохраняем код в базу
			mysql_query('INSERT INTO `register_emailconfirmation` (`mail`,`code`,`ip`,`time`, `attemps`)
			VALUES ("'.$email.'", "'.$activate.'", "'.$ipban2.'", "'.time().'", "0")');

		} else $activate = $code['code'];

		//Отправка кода активации email
	    $from    = 'admin@testcombats.ru';//'support@OurCombats.ru';
		$subject = 'Код активации на сайте testcombats.ru';
	    $subject = "=?windows-1251?B?".base64_encode($subject)."?=\n";

        $headers  = 'Mime-Version: 1.1'."\r\n";
		$headers .= 'Date: '.date("r")."\r\n";
        $headers .= 'Reply-To: '.$from."\r\n";
		$headers .= 'From: Наш Бойцовский Клуб <'.$from.'>'."\r\n";
		$headers .= 'Content-type: text/html; charset=windows-1251'."\r\n";

		$message = '<html>
				<head>
					<title>Подтверждение E-mail</title>
				</head>
			<body>
				Здравствуйте!<br>
				Для прохождения регистрации, укажите код в форме регистрации: '.$activate.'
                <br>
				Форма регистрации находится здесь:<br>
				https://testcombats.ru/register.php<br>
				<br>
				--<br>
				Бойцовский Клуб https://www.testcombats.ru<br>
				Администрация Бойцовского Клуба: support@OurCombats.ru<br>
				P.S. Данное письмо сгенерировано автоматически, отвечать на него не нужно.
			</body>
		</html>';

		$result = mail($email, $subject, $message, $headers);
        if($result) mysql_query('UPDATE `register_emailconfirmation`
		SET `time` = "'.time().'", attemps=attemps+1 where `mail`="'.mysql_real_escape_string($email).'" LIMIT 1');
	}

	$rt .= '["'.$gd[0].'","'.$gd[1].'","'.$gd[2].'","'.$gd[3].'","'.$gd[4].'","'.$gd[5].'","'.$gd[6].'","'.$gd[7].'","'.$gd[8].'","'.$gd[9].'","'.$gd[10].'","1"]';
	die($rt);
}

/* Регистрация AJAX */
elseif( isset($_POST['id']) && $multer == 0)// && $nobot == 1
{
	session_start();

	include('_incl_data/class/__reg.php');
	include('_incl_data/class/__user.php');
	
	function premiumGold($uid)
	{
    	$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "757"'));
    	$bonusT = 864000;
  		$bonus = array(
		"name"=>"Gold Премиум",
		"speed_Loc" => "30",
		"speedHp" => "75",
		"speedMp" => "75",
		"addExp" => "50",
		"addRep" => "0",
		"ym_delay"=>"50",
		"yv_drop"=>"2",
		"speed_dunger"=>"30",
		"mfza"=>"10",
		"mf_yron"=>"10",
		"sale_prc"=>"100",
		"saleEkr_prc"=>"100",
		"Exp_zver"=>"100",
		"type"=>"3");
		
		$ins = mysql_query('INSERT INTO `premium` SET
		`name` = "'.$bonus['name'].'",
		`uid` = "'.$uid.'", 
		`type` = "'.$bonus['type'].'",
		`time_delete` = "'.(time()+$bonusT).'",
		`speed_Loc` = "'.$bonus['speed_Loc'].'",
		`speedHp` = "'.$bonus['speedHp'].'",
		`speedMp` = "'.$bonus['speedMp'].'",
		`addExp` = "'.$bonus['addExp'].'",
		`addRep` = "'.$bonus['addRep'].'",
		`ym_delay` = "'.$bonus['ym_delay'].'",
		`yv_drop` = "'.$bonus['yv_drop'].'",
		`speed_dunger` = "'.$bonus['speed_dunger'].'",
		`mfza` = "'.$bonus['mfza'].'",
		`mf_yron` = "'.$bonus['mf_yron'].'",
		`sale_prc` = "'.$bonus['sale_prc'].'",
		`saleEkr_prc` = "'.$bonus['saleEkr_prc'].'",
		`Exp_zver` = "'.$bonus['Exp_zver'].'",
		`money` = "0" ');

		if($ins){
			mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`) VALUES ("'.$uid.'","'.$eff['id2'].'","'.$eff['mdata'].'","'.$eff['mname'].'","757","'.(time()+$bonusT).'","1","1")');
			return true;
		}else{
			return false;
		}
	}
	$rt = '';

	if($_POST['sex']==1) $_POST['sex'] = 0;//Мужчины
    elseif($_POST['sex']==2) $_POST['sex'] = 1;//Женщины

	$gd = array( 0,0,0,0,0,0,0,0,0,0,0 );
	$reg_d = array(
		0 => htmlspecialchars(iconv('UTF-8', 'windows-1251', trim($_POST['login'])),NULL,'cp1251'),
		1 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['pass']),NULL,'cp1251'),
		2 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['pass2']),NULL,'cp1251'),
		3 => (int)$_POST['dd'],
		4 => (int)$_POST['mm'],
		5 => (int)$_POST['yy'],
		6 => (int)$_POST['sex'],
		7 => (int)$_POST['rules'],
		8 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['mail']),NULL,'cp1251'),
		9 => (int)$_POST['keycode'],
		10 => (int)$_POST['align']);
	//Проверка логина
	//Запрещенные логины
  	$error = '';
    $good = 1;
   	$nologin = array(0=>'ангел',1=>'angel',2=>'администрация',3=>'administration',4=>'Комментатор',
	5=>'Мироздатель',6=>'Мусорщик',7=>'Падальщик',8=>'Повелитель',9=>'Архивариус',10=>'Пересмешник',
	11=>'Волынщик',12=>'Лорд Разрушитель',13=>'Милосердие',14=>'Справедливость',15=>'Искушение',16=>'Вознесение',
	17=>'админ', 18=>'SUPERCOMBATS', 19=>'DARKCOMBATS', 20=>'СУПЕРКОМБАТС', 21=>'ДАРККОМБАТС', 22=>'ДАРКОМБАТС',
	23=>'RECOMBATS', 24=>'РЕКОМБАТС', 25=>'ARTOVIK', 26=>'АРТОВИК', 27=>'Админ', 28=>'Благодать', 29=>'Алхимик',30=>'HITBK',31=>'Erabk', 32=>'Antibk', 33=>'Nicebk', 34=>'Nice bk', 35=>'GOD bk', 36=>'GODbk', 37=>'SKYBKR', 38=>'COOLBK' , 39=>'AGEBK', 40=>'VIRUSBK',41=>'GreatBK');

	$blacklist = "!@#$%^&*()\+Ёё|/'`\"";
    $sr = '_-1234567890';
	$i = 0;

	mb_internal_encoding('windows-1251');
	$lower_login = mb_strtolower($filter->mystr($reg_d[0]));
    $lower_login = str_replace(' ', '',  $lower_login);

	while($i<count($nologin))
	{
		$lower_nologin = mb_strtolower(str_replace(array('_','-'), '', $nologin[$i]));
		if(preg_match("/".$lower_nologin."/i", $lower_login))//Не работает - i, сравниваем в нижнем регистре
		{
			$error = 'Выберите, пожалуйста, другой ник.';
			$_POST['step'] = 1;
			$i = count($nologin);
		}
		$i++;
	}

	$reg_d[0] = str_replace('  ',' ',$reg_d[0]);
	//Логин от 2 до 20 символов
	if(strlen($reg_d[0])>18) { 
		$error = 'Логин должен содержать не более 18 символов.'; $_POST['step'] = 1;
	}
	if(strlen($reg_d[0])<4) { 
		$error = 'Логин должен содержать не менее 4 символов.'; $_POST['step'] = 1;
	}
	//Один алфавит
	if($reg_d[0]) $er = $r->en_ru($reg_d[0]);
	if($er==true) {
		$error = 'В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.'; $_POST['step'] = 1;
	}

	//Запрещенные символы
	if(preg_match( '/['.preg_quote($sr).']+/', $reg_d[0] )) {
		$error = 'Логин содержит запрещенные символы: '.$sr; $_POST['step'] = 1;
	}

	//Персонажи в базе
	//проверять на регистр????
	if($reg_d[0]!='')
	{
		$log = mysql_fetch_array(mysql_query('SELECT `id` from `users` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
		$log2 = mysql_fetch_array(mysql_query('SELECT `id` from `lastnames` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
	}
	if(isset($log['id']) || isset($log2['id']))
	{
		$error = 'Логин '.$reg_d[0].' уже занят, выберите другой.'; $_POST['step'] = 1;
	}
	//Разделители
	if(substr_count($reg_d[0],' ')+substr_count($reg_d[0],'-')+substr_count($reg_d[0],'_')>2)
	{
		$error = 'Не более двух разделителей одновременно (пробел, тире, нижнее подчеркивание).'; $_POST['step'] = 1;
	}
	$reg_d[0] = trim($reg_d[0],' ');
	if($error != '') {
		$gd[0] = $error;
		$good = 0;
	}else{
		$gd[0] = 1;
	}
	//проверяем пароль
	$error = '';
	if(strlen($reg_d[1])<6 || strlen($reg_d[1])>30)
	{
		$error = 'Длина пароля не может быть меньше 6 символов или более 30 символов.'; $_POST['step'] = 2;
	}
	if($reg_d[1]!=$reg_d[2])
	{
		$error = 'В анкете пароль нужно ввести дважды, для проверки. Во второй раз вы его ввели неверно, будьте внимательнее.'; $_POST['step'] = 2;
	}
	if($reg_d[0] && $reg_d[1] && preg_match('/'.str_replace('/', '\/', $reg_d[0]).'/i',$reg_d[1]))
	{
		$error = 'Пароль содержит элементы логина.'; $_POST['step'] = 2;
	}
	if($reg_d[1] && $reg_d[2] && $reg_d[1] != $reg_d[2] ) {
		$error = 'Пароли не совпадают.'; $_POST['step'] = 2;
	}
	if($_POST['step']!=2)
	{
		$stp = 3; $noup = 0;
	}
	if($error != '') {
		$gd[1] = $error;
		$good = 0;
	}else{
		$gd[1] = 1;
	}
	
	//Проверка даты
	$error = '';
	$ddmmyy = array(
		'',
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	);
	
	$tstd = date('d.m.Y',strtotime(''.$reg_d[3].' '.$ddmmyy[$reg_d[4]].' '.$reg_d[5].''));
	if( $reg_d[3] < 10 ) {
		$reg_d[3] = '0'.$reg_d[3];
	}
	if( $reg_d[4] < 10 ) {
		$reg_d[4] = '0'.$reg_d[4];
	}
	if( $tstd != ''.$reg_d[3].'.'.$reg_d[4].'.'.$reg_d[5].'' ) {
		$error = 'Ошибка в написании дня рождения.';
	}
	if($error != '') {
		$gd[2] = $error;
		$good = 0;
	}else{
		$gd[2] = 1;
	}
	
	if( $reg_d[7] != 1 ) {
		$error = 'Примите соглашение и дайте разрешение на возможность рассылки информации на ваш E-mail';
	}
	if($error != '') {
		$gd[3] = $error;
		$good = 0;
	}else{
		$gd[3] = 1;
	}
	
	$error = '';
	//проверяем e-mail
    $res = mysql_fetch_array(mysql_query('SELECT `mail` from `users` where `mail`="'.mysql_real_escape_string($reg_d[8]).'" LIMIT 1'));

	if(isset($res['mail']))
	{
		$error = 'Игрок с таким email уже существует.'; $_POST['step'] = 3;
	}

	if(strlen($reg_d[8])<6 || strlen($reg_d[8])>50)
	{
		$error = 'E-mail не может быть короче 6-ти символов и длинее 50-ти.'; $_POST['step'] = 3;
	}
	
	if(!preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $reg_d[8]))
	{
		$error = 'Вы указали явно ошибочный E-mail.<br>'; $_POST['step'] = 3;
	}

	if($error != '')
	{
		$gd[4] = $error;
		$good = 0;
	}else{
		$gd[4] = 1;
	}

	//проверяем mail code
    /*$code = mysql_fetch_array(mysql_query('SELECT `code` from `register_emailconfirmation` where `mail`="'.mysql_real_escape_string($reg_d[8]).'" LIMIT 1'));
    $error = '';
    if(strlen(trim($_POST['mail_code']))<1)
	{
		$error = 'Код подтверждения E-mail не указан. Введите код, полученный на ваш email.'; $_POST['step'] = 6;
	}
	elseif($code['code'] != trim($_POST['mail_code']))
	{
		$error = 'Код подтверждения E-mail неверный. Введите код, полученный на ваш email.';
		$_POST['step'] = 6;
	}*/

    if($error != '') {
		$gd[6] = $error;
		$good = 0;
	}else{
		$gd[6] = 1;
	}
	
	$error = '';
	//проверяем ключ
	if($reg_d[9] != $_SESSION['code'])
	{
        $error = 'Неверно указан код подтверждения.';
		$_POST['step'] = 3;
	}
	
	if($error != '') {
		$gd[5] = $error;
		$good = 0;
	}else{
		$gd[5] = 1;
	}
	
	if( $good == 1 ) {
		if( $reg_d[7] == 2 ) {
			$reg_d[7] = 1;
		}else{
			$reg_d[7] = 0;
		}
		if( $reg_d[10] == 1 ) {
			$reg_d[10] = 1;
		}elseif( $reg_d[10] == 2 ) {
			$reg_d[10] = 3;
		}elseif( $reg_d[10] == 3 ) {
			$reg_d[10] = 7;
		}else{
			$reg_d[10] = 0;
		}

		$reg_d[10] = 0;
		//Регистрируем
		//Создаем персонажа
		if($_POST['refu'] > 0)
		{
			$ref = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['refu']).'" LIMIT 1'));
			if(isset($ref['id'])) {
				$_POST['ref'] = $ref['id'];
			}else{
				$_POST['ref'] = 0;
			}
			unset($ref,$_POST['refu']);
		}
		mysql_query('INSERT INTO `users` (`name`,`align`,`real`,`login`,`host_reg`,`pass`,`ip`,`ipreg`,`city`,`cityreg`,`room`,`timereg`,
		`activ`,`mail`,`bithday`,`sex`,`fnq`,`money`
		) VALUES (
			"",
			"'.$reg_d[10].'",
			"1",
			"'.mysql_real_escape_string($reg_d[0]).'",
			"'.mysql_real_escape_string(0+(int)$_POST['ref']).'",
			"'.mysql_real_escape_string(md5($reg_d[1])).'",
			"'.mysql_real_escape_string(IP).'",
			"'.mysql_real_escape_string(IP).'",
			"capitalcity",
			"capitalcity",
			"4",
			"'.time().'",			
			"0",
			"'.mysql_real_escape_string($reg_d[8]).'",
			"'.mysql_real_escape_string($reg_d[3].'.'.$reg_d[4].'.'.$reg_d[5]).'",
			"'.mysql_real_escape_string($reg_d[6]).'",
			"0",
			"0"
		)');	
				
		$uid = mysql_insert_id();
		premiumGold($uid);
	if( $uid > 0 )
	{			
	
	//Сундук новичка
		mysql_query("INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES
		(10268, 0, 0.00, 0.00, 0.00, ".$uid.", 0, 'nohaos=1|onlyOne=1|oneType=4|musor=1|noremont=1|sudba=1|nosale=1|notransfer=1|usefromfile=1', 0, 0, 0, 0, 0.00, 1, 'Ангел', '', '', 1, 1, 'addmoney', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");
		
		mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`2price`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','4014',200,'sudba=1|noremont=1|notransfer=1|usefromfile=1|nodelete=1',1,2,'capitalcity',".time().")");

		$txt = '<font color=red>Внимание:</font> Давайте поприветствуем нового бойца: <b><font color=darkgreen>'.$reg_d[0].'[0]</font><a target=_blank href=//testcombats.ru/info/'.$uid.'><img src=//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif></a></b>';
		mysql_query("INSERT INTO `chat` (`new`,`city`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'capitalcity','','','".$txt."','".time()."','0','1','1')");
	
	    //mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.$uid.'" LIMIT 1');
  		mysql_query('UPDATE `users` SET `molch1` = "'.(time()+3*60).'" WHERE `id` = "'.$uid.'" LIMIT 1');
		mysql_query('UPDATE `users` SET `info_delete` = "'.(time()+3*60).'" WHERE `id` = "'.$uid.'" LIMIT 1');

  		//Создаем статы персонажа
		//mysql_query("INSERT INTO `online` (`uid`,`timeStart`) VALUES ('".$uid."','".time()."')");
		mysql_query("INSERT INTO `stats` (`id`,`stats`,`exp`,`skills`,`upLevel`) VALUES ('".$uid."','s1=3|s2=3|s3=3|s4=3|rinv=40',0,0,0)");
			
		//мульты
		$ipm1 = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `ip`!="'.mysql_real_escape_string(IP).'" ORDER BY `id` ASC LIMIT 1'));
		$ppl = mysql_query('SELECT * FROM `logs_auth` WHERE `ip`!="" AND (`ip` = "'.mysql_real_escape_string(IP).'" OR `ip`="'.mysql_real_escape_string($ipm1['ip']).'" OR `ip`="'.mysql_real_escape_string($_COOKIE['ip']).'")');
		while($spl = mysql_fetch_array($ppl))
		{
			$ml = mysql_fetch_array(mysql_query('SELECT `id` FROM `mults` WHERE (`uid` = "'.$spl['uid'].'" AND `uid2` = "'.$uid.'") OR (`uid2` = "'.$spl['uid'].'" AND `uid` = "'.$uid.'") LIMIT 1'));
			if(!isset($ml['id']) && $spl['ip']!='' && $spl['ip']!='127.0.0.1')
			{
				mysql_query('INSERT INTO `mults` (`uid`,`uid2`,`ip`) VALUES ("'.$uid.'","'.$spl['uid'].'","'.$spl['ip'].'")');
			}
		}

	mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`)
	VALUES ('".$uid."','".mysql_real_escape_string(IP)."','".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."','1','".time()."')");
			
	//Обновяем таблицы
	mysql_query("UPDATE `users` SET `online`='".time()."',`ip` = '".mysql_real_escape_string(IP)."' WHERE `uid` = '".$uid."' LIMIT 1");
			
	if(!setcookie('login',$reg_d[0], (time()+60*60*24*7) , '' , '.'.$c['host'] ) || !setcookie('pass',md5($reg_d[1]), (time()+60*60*24*7) , '' , '.'.$c['host'] ))
	{
		die('Ошибка сохранения cookie.');
	} 
	    setcookie('login',$reg_d[0],time()+60*60*24*7,'',$c['host']);
		setcookie('pass',md5($reg_d[1]),time()+60*60*24*7,'',$c['host']);
	    setcookie('login',$reg_d[0],time()+60*60*24*7);
		setcookie('pass',md5($reg_d[1]),time()+60*60*24*7);		
		
        $skey = md5($reg_d[0].md5($reg_d[1]).$c['skey']);
		setcookie('auth2', $skey, time()+60*60*24*7,'','.'.$c['host']);
		setcookie('auth2', $skey, time()+60*60*24*7, '', $c['host']);

        setcookie('login', $_POST['login'], time() + 60 * 60 * 24 * 7);
	    setcookie('pass', md5($_POST['pass']), time() + 60 * 60 * 24 * 7);
		setcookie('auth2', $skey, time()+60*60*24*7);
		}
	}
	
	if( $good == 1 ) {
		$gd[7] = 1;
	}
	
	$rt .= '["'.$gd[0].'","'.$gd[1].'","'.$gd[2].'","'.$gd[3].'","'.$gd[4].'","'.$gd[5].'","'.$gd[6].'","'.$gd[7].'","'.$gd[8].'","'.$gd[9].'","'.$gd[10].'"]';
	//
	die($rt);
}

/* Данные регистрации */
$reg_id = microtime();
$reg_id = str_replace(' ','.',$reg_id);
$reg_id = str_replace('.','',$reg_id);
?>
<!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Регистрация - Наш Бойцовский Клуб - www.testcombats.ru</title>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/psi.js"></script>
<link rel="stylesheet" href="/css/register.css?<?=time()?>" type="text/css" media="screen"/>
<link href="//img.testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
<link href="/css/common.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="3D3D3B">
<link href="//img.testcombats.ru/css/reg.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	width:100%;
	height:100%;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	//background-color: #000;
	font-size: 10pt; font-family: Verdana, Helvetica, Arial, Tahoma, sans-serif;
	//background-image: url(//img.testcombats.ru/admin/zmk_all.jpg);
	background: url(//img.testcombats.ru/admin/zmk_all.jpg ) no-repeat;
    background-position: center center;
    background-color: #000;
    background-size: cover;
}
.style5 {color: #990000}
.style7 {color: #364875}
.style6 {color: #DFD3A3;
	font-size: 9px;
}
.стиль3 {color: #666666}
.стиль4 {
	color: #FF0000;
	font-weight: bold;
}
.mmg {
	FONT-SIZE: 8pt; FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif; padding-bottom:8px;
}
html, body { height:100%; }
.imagebacked {
	padding-left: 26px; /* image-width */
	background-repeat: no-repeat;
}

.bleft {
	background-image: url(//img.testcombats.ru/forumsimg/left.png);
    background-repeat: repeat-x;
    background-position: bottom;
}
.btitle {
    background-image: url(//img.testcombats.ru/forumsimg/top_line.png);
    background-repeat: repeat-x;
    background-position: bottom;
	text-align: center;
    color: white;
    font-size: 8pt;
    font-weight: bold;
    padding-top: 10px;
}
.bright {
	background-image: url(//img.testcombats.ru/forumsimg/right.png);
    background-repeat: repeat-x;
    background-position: bottom;
}	

.bmleft {
	background-image: url(//img.testcombats.ru/forumsimg/leftl.png);
}

.bmright {
	background-image: url(//img.testcombats.ru/forumsimg/rightl.png);
}

.bm1left {
	background-image: url(//img.testcombats.ru/forumsimg/leftd.png);
    background-repeat: repeat-x;
    background-position: bottom;
}
.bm1title {
    background-image: url(//img.testcombats.ru/forumsimg/bottom_line.png);
    background-repeat: repeat-x;
    background-position: bottom;
	text-align: center;
    color: white;
    font-size: 8pt;
    font-weight: bold;
    padding-bottom: 10px;
}
.bm1right {
	background-image: url(//img.testcombats.ru/forumsimg/rightd.png);
    background-repeat: repeat-x;
    background-position: bottom;
}

.fade {
  opacity: 1;
}

.fade:hover {
  opacity: 0.6;
}

A:visited {
    /* FONT-WEIGHT: normal; */
    COLOR: #AB772A;
    TEXT-DECORATION: none;
    font-size: 8pt;
}

A:link {
    /* FONT-WEIGHT: normal; */
    /* COLOR: #AB772A; */
    TEXT-DECORATION: none;
    font-size: 8pt;
	font-weight: bold;
}
-->
</style>
<link rel="Stylesheet" type="text/css" href="/scripts/wSelect.css" />
<link rel="Stylesheet" type="text/css" href="/scripts/demo.css" />
<script type="text/javascript" src="/scripts/wSelect.js"></script>
<script language="JavaScript"> 
function CheckValue(a) {
	var b = '';
	for (i = '0'; i < a.value.length; i++) {
	var c = a.value.substring(i, i+1);
	if ((c >= 'A' && c <= 'Z') || (c >= 'a' && c <= 'z') ||
	(c.charCodeAt(0) >= 1040 && c.charCodeAt(0) <= 1103)
	|| (c == ' ') || (c == '-') || (c == '_'))
	{
		b += c;
	}
	}
	if (a.value != b) { a.value = b; }
}
</script>
<!--div style="height: 262px;background: url(//img.testcombats.ru/admin/e1.png) top center no-repeat;" class="fade">
    <div class="container">
        
    </div>
</div-->
<!-- /#header -->
<table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
		      <tbody><tr>
		        <td width="129" class="bleft">&nbsp;</td>
		        <td align="center" class="btitle">
		        	<div style="
    position: relative;
">
		<!--           	  <div class="psi_logo">&nbsp;</div> -->
		            </div>
		        </td>
		        <td width="129" class="bright">&nbsp;</td>
		      </tr>
		      </tbody></table>
<div align="center" style="height:94%; min-height: 750px;">
<table width="96%" height="100%" style="margin-bottom:-44px" border="0" cellspacing="0" cellpadding="0">
	<tr>
	 <td width="23" class="bmleft">&nbsp;</td>
	 <td width="118" valign="top" bgcolor="#f2e5b1"><img src="//img.testcombats.ru/i/regImg2.jpg" width="118" height="257"></td>
	 <td valign="top" bgcolor="#f2e5b1" align="left">
	 	<br>
		<!--<h2 class="reg_h2">&laquo;Бойцовский клуб&raquo;</h2>-->
	 	<p align="left"><img src="//img.testcombats.ru/i/regImg1.gif" width="198" height="26" /></p>
	 	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	 	  <tr>
        <td><form id="register_main" method="post" action="/register">
          <input name="reg_id" id="reg_id" type="hidden" value="<?=$reg_id?>" />
          <div style="padding:100px;">
<? if( $multer > 0 ) { ?>
    <p align=center><b><font color=red>Внимание! Регистрация с одного IP не чаще одного раза в сутки!</font></b></p><br>
<? } ?>
            <div style="padding-right:25px;"><!-- -->
              <div style="padding-bottom:5px;"> <span style="display:inline-block;width:230px;"><font color=red>*</font> Имя вашего персонажа</span> &nbsp;
                <script>psi.inputPrint('register_login<?=$reg_id?>','register_login<?=$reg_id?>',null,null,null,'psi_input1','width:191px;');</script>
                <span style="display:inline-block;width:15px;"> <span id="login_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                  <div id="login_error_text" style="font-size:8pt;">&nbsp;</div>
                  </span></span> </span></div>
                  <div style="padding-left:16px; color: #847167;" class="mmg"><span class="style5">Внимание!</span> Логин может содержать от 4 до 15 символов, и состоять только из букв русского ИЛИ анг. алфавита, цифр, символов '_', '-' и пробела. Логин не может начинаться или заканчиваться символами '_', '-' или пробелом.</div>
              <div style="padding-bottom:5px;"> <span style="display:inline-block;width:230px;"><font color=red>*</font> Пароль</span> &nbsp;
                <script>psi.inputPrint('register_pass<?=$reg_id?>','register_pass<?=$reg_id?>',null,null,'password','psi_input1','width:191px;');</script>
                <span style="display:inline-block;width:15px;"> <span id="pass_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                  <div id="pass_error_text">&nbsp;</div>
                  </span></span> </span> </div>
              <div style="padding-bottom:5px;"> <span style="display:inline-block;width:230px;"><font color=red>*</font> Пароль еще раз</span> &nbsp;
                <script>psi.inputPrint('register_pass2<?=$reg_id?>','register_pass2<?=$reg_id?>',null,null,'password','psi_input1','width:191px;');</script>
                <span style="display:inline-block;width:15px;"> &nbsp; </span></div>
              <div align="center"><span style="color:#09F"></span></div>
              <div style="padding-bottom:5px;"> <span style="display:inline-block;width:230px;"><font color=red>*</font> Ваш пол</span>
			  <span style="padding-left:15px;"> <small class="cp radio1txt" id="register_sex<?=$reg_id?>block1" value="0">
                <div style="display:inline-block;">
				<script>
                	//radioPring:function( id , name , block , last , title )
					psi.radioPring('register_sex<?=$reg_id?>','register_sex<?=$reg_id?>',true,0,'Мужской');
				</script>
                </small>&nbsp; <small class="cp radio1txt" id="register_sex<?=$reg_id?>block2" value="1">
                  <script>
				  		psi.radioPring('register_sex<?=$reg_id?>','register_sex<?=$reg_id?>',true,1,'Женский');
                        psi.radioPress('register_sex<?=$reg_id?>',$('#register_sex<?=$reg_id?>_1'),1);
                </script>
                  </div>
                  </small>&nbsp; </span> <span style="display:inline-block;width:15px;"> <span id="sex_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                    <div id="sex_error_text">&nbsp;</div>
                    </span></span> </span> </div>
              <div style="padding-left:16px; color: #847167;" class="mmg"><span class="style5">Внимание!</span> Пол персонажа должен соответствовать реальному полу игрока.</div>
              <div style="padding-bottom:5px;"> <span style="display:inline-block;width:230px;"><font color=red>*</font> День рождения</span> &nbsp;
                <div style="display:inline-block;">
                <div id="1register_dd<?=$reg_id?>" align="center" class="psi_input1_none psi_list" style="width:43px;">
                  <select name="register_dd<?=$reg_id?>" id="register_dd<?=$reg_id?>">
                    <?
                    $i = 1;
                    while( $i <= 31 ) {
                        $j = $i;
                        if( $j < 10 ) {
                            $j = '0'.$j;	
                        }
                    ?>
                    <option value="<?=$i?>">
                      <?=$j?>
                      </option>
                    <?
                        $i++;
                    }
                    unset($i,$j);
                    ?>
                    </select>
                  </div>
                <div id="1register_mm<?=$reg_id?>" align="center" class="psi_input1_none psi_list" style="width:43px;">
                  <select name="register_mm<?=$reg_id?>" id="register_mm<?=$reg_id?>">
                    <?
                    $i = 1;
                    while( $i <= 12 ) {
                        $j = $i;
                        if( $j < 10 ) {
                            $j = '0'.$j;	
                        }
                    ?>
                    <option value="<?=$i?>">
                      <?=$j?>
                      </option>
                    <?
                        $i++;
                    }
                    unset($i,$j);
                    ?>
                    </select>
                  </div>
                <div id="1register_yyyy<?=$reg_id?>" align="center" class="psi_input1_none psi_list" style="width:60px;">
                  <select name="register_yyyy<?=$reg_id?>" id="register_yyyy<?=$reg_id?>">
                    <?
                    $i = date('Y') - 10;
                    while( $i >= date('Y') - 80 ) {
                        $j = $i;
                    ?>
                    <option value="<?=$i?>">
                      <?=$j?>
                      </option>
                    <?
                        $i--;
                    }
                    unset($i,$j);
                    ?>
                    </select>
                  </div>
                  </div>
                <span style="display:inline-block;width:15px;"><span id="bd_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                  <div id="bd_error_text">&nbsp;</div>
                  </span></span> </span> </div>
                  <div style="padding-left:16px; color: #847167;" class="mmg"><span class="style5">Внимание!</span> Дата рождения должна быть правильной, она используется в игровом процессе. Анкеты с неправильной датой будут удаляться без предупреждения.</div>
              <div> <span style="display:inline-block;width:230px;"><font color=red>*</font> E-mail</span> &nbsp;
                <script>psi.inputPrint('register_mail<?=$reg_id?>','register_mail<?=$reg_id?>',null,null,null,'psi_input1','width:191px;');</script>
                <span style="display:inline-block;width:15px;"> <span id="mail_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                  <div id="mail_error_text">&nbsp;</div>
                  </span></span> </span> </div>
                  <div style="padding-left:16px; color: #847167;" class="mmg"><span class="style5">Внимание!</span> Используется только для регистрации и восстановления (в случае его утери) доступа к персонажу. Он нигде не отображается и не используется в целях спама.</div>

            	<!--<div style="padding-bottom:5px;"> <span style="display:inline-block;width:230px;"><font color=red>*</font> Подтверждение E-mail</span> &nbsp;
                <script>psi.inputPrint('mail_code<?=$reg_id?>','mail_code<?=$reg_id?>',null,null,null,'psi_input1','width:87px;');</script>
                <input class="btnnew" onClick="psi.SendCode();" type="button" value="Получить код">
                <span style="display:inline-block;width:15px;"> <span id="mail_code_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                  <div id="mail_code_error_text">&nbsp;</div>
                  </span></span> </span> </div>
					<div style="padding-left:16px; color: #847167;" class="mmg"><span class="style5">Внимание!</span> Укажите верный E-mail, иначе вы не получите код подтверждения и не сможете пройти регистрацию.</div>-->

			  <div> <span style="display:inline-block;width:230px;"><font color=red>*</font> Код с картинки</span> &nbsp; <img src="show_reg_img/security.php?register_id=<?=str_replace(' ','0',microtime())?>" width="107" height="26" style="display:inline-block; vertical-align:bottom;">
                <script>psi.inputPrint('register_key<?=$reg_id?>','register_key<?=$reg_id?>',null,null,null,'psi_input1','width:81px;');</script>
                <span style="display:inline-block;width:15px;"> <span id="key_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                  <div id="key_error_text">&nbsp;</div>
                  </span></span> </span> </div>
              <br>
              <div title="Я принимаю все правила и соглашения, а так-же разрешаю оповещать меня по E-mail"> <small class="cp" id="register_rules<?=$reg_id?>block">
                <span style="display:inline-block;"><script>psi.checkPring('register_rules<?=$reg_id?>','register_rules<?=$reg_id?>',true);</script></span>
                <span style="font-size: 8pt;">&nbsp;Я ознакомился с <a href="//testcombats.ru/encicl/2.php" target="_blank">Соглашением о предоставлении сервиса игры</a> и <a href="//testcombats.ru/encicl/1.php" target="_blank">Законами</a>&nbsp;<br>"Наш Бойцовский Клуб - OurCombats" и согласен по всем пунктам.</small> <span style="display:inline-block;width:15px;"> <span id="rules_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
                  <div id="rules_error_text">&nbsp;</div>
                  </span></span> </span> </div></span>
              <br>
              <div align="center">
                <input onclick="top.location.href='/';" value="Вернуться" type="button"> <input onClick="psi.testForm();" type="button" value="Зарегистрироваться">
                </div>
              <!-- -->
              </div>
            </div>
          <input type="hidden" value="<?=round((int)$_GET['ref'])?>" name="refu<?=$reg_id?>" id="refu<?=$reg_id?>">
        </form></td>
        </tr>
  </table>
	</td>
	<td width="139" valign="top" bgcolor="#f2e5b1"><img height=144 src="//img.testcombats.ru/i/regImg3.jpg" width=139 border=0></td>
	<td width="23" class="bmright">&nbsp;</td>
</tr>
 </table>
 <table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td width="129" class="bm1left">&nbsp;</td>
<td class="bm1title"><? echo $c['counters'];//счетчики ?></td>
<td width="129" class="bm1right">&nbsp;</td>
</tr>
</tbody></table>
</div>
<!-- -->
<script>
psi.startTestingData(<?=$reg_id?>);
</script>
</body>
</html>