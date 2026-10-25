<?
if(!defined('GAME'))
{
	die('/index.php');
}

function GetRealIp()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
 {
   $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}
define('IP',GetRealIp());

if($_SERVER['HTTP_REFERER'] == 'https://btl4.net/' && $_COOKIE['b4n'] != '2') {
	setcookie('b4n','1',time()+60*60*24*3);
}


/*
if(IP != '') {
	die('Регистрация временно отключена. Идет восстановление персонажей.');
}
*/

class register
{
	public function testLogin($v)
	{
		
	}
	
	public function en_ru($txt)
	{
		$g = false;
		$en = preg_match("/^(([0-9a-zA-Z _-])+)$/i", $txt);
		$ru = preg_match("/^(([0-9а-яА-Я _-])+)$/i", $txt);
		if(($ru && $en) || (!$ru && !$en))
		{
			$g = true;
		}
		return $g;
	}
	public function testStep()
	{
		global $c,$reg,$error,$filter,$chat,$reg_d,$noup,$youip;
		$stp = 1;
		if(isset($_POST['step']) && isset($reg['id']))
		{
			$upd = '';
			
			$lr = mysql_fetch_array(mysql_query('SELECT `id`,`ipreg` FROM `users` WHERE `cityreg`="capitalcity" AND `timereg`>"'.(time()-60*60*1).'" AND `ipreg` = "'.mysql_real_escape_string(IP).'" LIMIT 1'));
			if(isset($_COOKIE['reg_capitalcity']) || (int)$_COOKIE['reg_capitalcity']>time() || isset($lr['id']))
			{
				$error .= 'Недавно с вашего IP уже регистрировался персонаж. С одного IP адреса разрешена регистрация персонажей не чаще, чем раз в час. Попробуйте позже.<br>'; $_POST['step'] = 1;
			}
			
			if($error=='')
			{
				
				$reg_bonus = false;
			}
			
		
			
			$reg_bonus = true;
			
			if($_POST['step']>1)
			{
				//Запрещенные логины
				$nologin = array(0=>'ангел',1=>'angel',2=>'администрация',3=>'administration',4=>'Комментатор',5=>'Мироздатель',6=>'Мусорщик',7=>'Падальщик',8=>'Повелитель',9=>'Архивариус',10=>'Пересмешник',11=>'Волынщик',12=>'Лорд Разрушитель',13=>'Милосердие',14=>'Справедливость',15=>'Искушение',16=>'Вознесение');
				$blacklist = "!@#$%^&*()\+Ёё|/'`\"";
				$sr = '_-йцукенгшщзхъфывапролджэячсмитьбюё1234567890';
				$i = 0;
				while($i<count($nologin))
				{
					if(preg_match("/".$nologin[$i]."/i",$filter->mystr($reg_d[0])))
					{
						$error .= 'Выберите, пожалуйста, другой ник.<br>'; $_POST['step'] = 1; $i = count($nologin);
					}
					$i++;
				}
				$reg_d[0] = str_replace('  ',' ',$reg_d[0]);
				//Логин от 2 до 20 символов
				if(strlen($reg_d[0])>20) 
				{ 
					$error .= 'Логин должен содержать не более 20 символов.<br>'; $_POST['step'] = 1;
				}
				if(strlen($reg_d[0])<4) 
				{ 
					$error .= 'Логин должен содержать не менее 4 символов.<br>'; $_POST['step'] = 1;
				}
				//Один алфавит
				$er = $this->en_ru($reg_d[0]);
				if($er==true)
				{
					$error .= 'В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.<br>'; $_POST['step'] = 1;
				}
				//Запрещенный символы
				if(strpos($sr,$reg_d[0]))
				{
					$error .= 'Логин содержит запрещенные символы.<br>'; $_POST['step'] = 1;
				}				
				//Персонажи в базе
				$log = mysql_fetch_array(mysql_query('SELECT `id` from `users` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
				$log2 = mysql_fetch_array(mysql_query('SELECT `id` from `lastnames` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
				if(isset($log['id']) || isset($log2['id']))
				{
					$error .= 'Логин '.$reg_d[0].' уже занят, выберите другой.<br>'; $_POST['step'] = 1;
				}
				//Разделители
				if(substr_count($reg_d[0],' ')+substr_count($reg_d[0],'-')+substr_count($reg_d[0],'_')>2)
				{
					$error .= 'Не более двух разделителей одновременно (пробел, тире, нижнее подчеркивание).<br>'; $_POST['step'] = 1;
				}
				$reg_d[0] = trim($reg_d[0],' ');				
				
				
				if($_POST['step']!=1)
				{
					$stp = 2; $noup = 0;
				}
			}
			if($_POST['step']>2)
			{
				//проверяем пароль
				if(strlen($reg_d[1])<6 || strlen($reg_d[1])>30)
				{
					$error .= 'Длина пароля не может быть меньше 6 символов или более 30 символов.<br>'; $_POST['step'] = 2;
				}
				if($reg_d[1]!=$reg_d[2])
				{
					$error .= 'В анкете пароль нужно ввести дважды, для проверки. Во второй раз вы его ввели неверно, будьте внимательнее.<br>'; $_POST['step'] = 2;
				}
				if(preg_match('/'.$reg_d[0].'/i',$reg_d[1]))
				{
					$error .= 'Пароль содержит элементы логина.<br>'; $_POST['step'] = 2;
				}
				if($_POST['step']!=2)
				{
					$stp = 3; $noup = 0;
				}
			}
			if($_POST['step']>3)
			{
				//проверяем e-mail
				if(strlen($reg_d[3])<6 || strlen($reg_d[3])>50)
				{
					$error .= 'E-mail не может быть короче 6-х символов и длинее 50-ти.<br>'; $_POST['step'] = 3;
				}
				
				if(!preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $reg_d[3]))
				{
					$error .= 'Вы указали явно ошибочный E-mail.<br>'; $_POST['step'] = 3;
				}
				
				$reg_d[4] = $chat->str_count($reg_d[4],30);
				$reg_d[5] = $chat->str_count($reg_d[5],30);
				
				if($_POST['step']!=3)
				{
					$stp = 4; $noup = 0;
				}
			}
			if($_POST['step']>4)
			{
				//Имя, Пол, Город, Девиз и т.д.
				$er = $this->en_ru($reg_d[6]);
				if($er==true || strlen($reg_d[6])<2)
				{
					$error .= 'Укажите ваше реальное имя!<br>'; $_POST['step'] = 4;
				}
				
				$reg_d[6] = $chat->str_count($reg_d[6],90);
				$reg_d[7] = round($reg_d[7]);
				$reg_d[8] = round($reg_d[8]);
				$reg_d[9] = round($reg_d[9]);
				
				if($reg_d[7]<1 || $reg_d[7]>31 || $reg_d[8]<1 || $reg_d[8]>12 || $reg_d[9]<1920 || $reg_d[9]>2006)
				{
					$error .= 'Ошибка в написании дня рождения.<br>'; $_POST['step'] = 4;
				}
				
				if($reg_d[15]!=0 && $reg_d[15]!=1)
				{
					$error .= 'Вы указали не верный пол.<br>'; $_POST['step'] = 4;
				}
				
				if($reg_d[14]!='Black' && $reg_d[14]!='Blue' && $reg_d[14]!='Fuchsia' && $reg_d[14]!='Gray' && $reg_d[14]!='Green' && $reg_d[14]!='Maroon' && $reg_d[14]!='Navy' && $reg_d[14]!='Olive' && $reg_d[14]!='Purple' && $reg_d[14]!='Teal' && $reg_d[14]!='Orange' && $reg_d[14]!='Chocolate' && $reg_d[14]!='DarkKhaki' && $reg_d[14]!='SandyBrown')
				{
					$error .= 'Вы указали не верный цвет сообщения в чате.<br>'; $_POST['step'] = 4;
				}				
				
				if($_POST['step']!=4)
				{
					$stp = 5; $noup = 0;
				}			
			}
			if($_POST['step']>5)
			{
				//Соглашение с законами 
				if(!isset($_POST['law_'.$reg['id']]) || $_POST['law_'.$reg['id']]!='on')
				{
					$error .= 'Извините, без принятия правил нашего клуба, вы не можете зарегистрировать свой персонаж.<br>'; $_POST['step'] = 5;
				}
				
				if(!isset($_POST['law2_'.$reg['id']]) || $_POST['law2_'.$reg['id']]!='on')
				{
					$error .= 'Извините, без принятия <u>Соглашения о предоставлении сервиса игры '.$c['title'].'</u>, вы не можете зарегистрировать персонаж.<br>'; $_POST['step'] = 5;
				}
				
				if($_POST['code']!=$_SESSION['code'] || $_SESSION['code']<100 || $_POST['code']=='')
				{
					$error .= 'Ошибка введения кода.<br>'; $_POST['step'] = 5;
				}
				
				if($_POST['step']!=5)
				{
					//завершение регистрации и редирект в игру
					
					if($filter->spamFiltr($reg_d[13])!=0)
					{
						$reg_d[13] = '';
					}
					if($filter->spamFiltr($reg_d[10])!=0)
					{
						$reg_d[10] = '';
					}
					if($filter->spamFiltr($reg_d[6])!=0)
					{
						$reg_d[6] = '';
					}
					
					
					$mbid = 'NULL';
					/*}else{
						/* чистим возможные данные */
						/*if($mbid [0]> 0) {
							mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$mbid[0].'" LIMIT 1');
							mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$mbid[0].'" LIMIT 1');
							mysql_query('DELETE FROM `bank` WHERE `uid` = "'.$mbid[0].'" LIMIT 1');
							mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$mbid[0].'" LIMIT 1');
							mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$mbid[0].'" LIMIT 1');
						}
						$mbid = $mbid[0];
					}*/
					
					if($_COOKIE['b4n'] == '1') {
						setcookie('b4n','2',time()+60*60*24*3);
						$reg['referal'] = 'btl4.net';
					}elseif(isset($_COOKIE['hstreger'])) {
						$reg['referal'] = $_COOKIE['hstreger'];
					}
					
					$ins = mysql_query("INSERT INTO `users` (`activ`,`fnq`,`host_reg`,`room`,`login`,`pass`,`ipreg`,`ip`,`city`,`cityreg`,`a1`,`q1`,`mail`,`name`,`bithday`,`sex`,`city_real`,`icq`,`icq_hide`,`deviz`,`chatColor`,`timereg`) VALUES (
					'0',
					'0',
					'".mysql_real_escape_string($reg['referal'])."',
					'0',
					'".$reg_d[0]."',
					'".md5($reg_d[1])."',
					'".IP."',
					'".IP."',
					'capitalcity',
					'capitalcity',
					'".$reg_d[4]."',
					'".$reg_d[5]."',
					'".$reg_d[3]."',
					'".$reg_d[6]."',
					'".$reg_d[7].".".$reg_d[8].".".$reg_d[9]."',
					'".$reg_d[15]."',
					'".$reg_d[10]."',
					'".$reg_d[11]."',
					'".$reg_d[12]."',
					'".$reg_d[13]."',
					'".$reg_d[14]."',
					'".time()."')");
					if($ins)
					{
						$uid = mysql_insert_id();
						
						$refer = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`banned`,`admin`,`level` FROM `users` WHERE `id` = "'.mysql_real_escape_string($reg['referal']).'" LIMIT 1'));
						if(isset($refer['id'])) {
							mysql_query("INSERT INTO `items_users` (`gift`,`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$refer['login']."','".$uid."','3199','noodet=1|items_in_file=sunduk_new|var_id=1|open=1|noremont=1|nodelete=1|nosale=1',1,2,'capitalcity',".time().")");
							$text = '<font color=red>Вы стали воспитанником игрока &quot;'.$refer['login'].'&quot;! В инвентаре (раздел -прочее-) вы найдете вспомогательные предметы.</font>';
							mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						}
						
						mysql_query("INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES
						(10268, 0, 0.00, 0.00, 0.00, ".$uid.", 0, 'nohaos=1|onlyOne=1|oneType=4|musor=1|noremont=1|sudba=1|nosale=1|notransfer=1|usefromfile=1', 0, 0, 0, 0, 0.00, 1, 'Ангел', '', '', 1, 1, 'addmoney', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");
		
						mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`2price`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','4014',200,'sudba=1|noremont=1|notransfer=1|usefromfile=1|nodelete=1',1,2,'capitalcity',".time().")");
						//mysql_query("INSERT INTO `online` (`uid`,`timeStart`) VALUES ('".$uid."','".time()."')");
						mysql_query('UPDATE `users` SET `molch1` = "'.(time()+5*60).'" WHERE `id` = "'.$uid.'" LIMIT 1');
						mysql_query('UPDATE `users` SET `info_delete` = "'.(time()+5*60).'" WHERE `id` = "'.$uid.'" LIMIT 1');
						mysql_query("INSERT INTO `stats` (`id`,`stats`,`exp`,`skills`,`upLevel`) VALUES ('".$uid."','s1=3|s2=3|s3=3|s4=3|rinv=40',0,0,0)");
						//Добавляем предметы
						//mysql_query("INSERT INTO `items_users` (`gift`,`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('Мироздатель','".$uid."','1','add_hpAll=3',10,2,'capitalcity',".time().")");
						//mysql_query("INSERT INTO `items_users` (`gift`,`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('Мусорщик','".$uid."','73','add_mib3=1|add_mab3=1|add_mib4=1|add_mab4=1',20,2,'capitalcity',".time().")");
						//mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','724','moment=1|sudba=".mysql_real_escape_string($reg_d[0])."|moment_hp=100|nohaos=1|musor=2|noremont=1',100,2,'capitalcity',".time().")");
						//mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','865','tr_lvl=1|sudba=".mysql_real_escape_string($reg_d[0])."|useOnLogin=1|musor=1|noremont=1',50,2,'capitalcity',".time().")");
						//mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','4014','sudba=".mysql_real_escape_string($reg_d[0])."|noremont=1|usefromfile=1|musor=1|nodelete=1|nosale=1|expUpg=30000',1,2,'capitalcity',".time().")");
						
						
						$txt = '<font color=red>Внимание:</font> Давайте поприветствуем нового бойца: <b><font color=darkgreen>'.$reg_d[0].'[0]</font><a target=_blank href=//testcombats.ru/info/'.$uid.'><img src=//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif></a></b>';
						mysql_query("INSERT INTO `chat` (`new`,`city`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'capitalcity','','','".$txt."','".time()."','0','1','1')");
						//$text = 'Вы получили предмет [img[items/pot_cureHP100_20.gif]][1] &quot;Зелье Жизни&quot;, он находится в инвентаре, в разделе &quot;эликсиры&quot;';
						//mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						//$text = 'Вы получили предмет [img[items/pal_button8.gif]][1] &quot;Нападение&quot;, он находится в инвентаре, в разделе &quot;заклятия&quot;';
						//mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						//$text = 'Вы получили предмет [img[items/qsvit_hran.gif]][1] &quot;Свиток Обучения&quot;, он находится в инвентаре, в разделе &quot;заклятия&quot;. <b><font color=red>Использовав данный свиток Вы получите +30 000 ед. опыта</font></b>';
						//mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						
						$skey = md5($_COOKIE['login'].$_COOKIE['pass'].$c['skey']);
						if(isset($_COOKIE['login']) || isset($_COOKIE['pass']))
						{
							setcookie('login','',time()-60*60*24,'',$c['host']);
							setcookie('pass','',time()-60*60*24,'',$c['host']);
                            setcookie('auth2','',time()-60*60*24,'',$c['host']);
						}
						setcookie('login',$reg_d[0],time()+60*60*24*7,'',$c['host']);
						setcookie('pass',md5($reg_d[1]),time()+60*60*24*7,'',$c['host']);
						setcookie('auth',md5($reg_d[1].'AUTH'.IP),time()+60*60*24*365,'',$c['host']);
                        setcookie('auth2','',time()-60*60*24*7,$skey,$c['host']);
						setcookie('reg_capitalcity',true,time()+60*60,'',$c['host']);

						$chat->send('',1,'capitalcity','','','Вас приветствует новичок: [login:'.$reg_d[0].']',time(),12,1,0,0);
						mysql_query("UPDATE `users` SET `online`='".time()."' WHERE `uid` = '".$uid."' LIMIT 1");
						mysql_query("UPDATE `register_code` SET `reg_id`='".$uid."',`time_finish`='".time()."' WHERE `id` = '".$cd['id']."' LIMIT 1");
						mysql_query("UPDATE `items_users` SET `delete`='".time()."' WHERE `secret_id` = '".$cd['code']."' LIMIT 1");
						header('location: /battle');						
						die('Регистарция прошла успешно...');
					}else{
						$error .= 'Ошибка регистрации. Попробуйте позже...<br>';
					}
				}			
			}
		}
		return $stp;
	}
}

$r = new register;
?>