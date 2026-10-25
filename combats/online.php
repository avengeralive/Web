<?php
	header('Content-Type: text/html; charset=windows-1251');
		
	define('GAME',true);
	include('_incl_data/__config.php');	
	include('_incl_data/class/__db_connect.php');	
	include('_incl_data/class/__user.php');
	include('_incl_data/class/__filter_class.php');
	include('_incl_data/class/__chat_class.php');

	
	if(!isset($u->info['id']) || $u->info['banned']>0)
	{
		die(json_encode(array('js'=>'top.location="/battle?exit='.$code.'";')));
	}
	elseif($u->info['ip']!=$_SERVER['HTTP_X_REAL_IP'])
	{
		
	}
	
	/* if($u->info['activ']>0) {
		die('Вам необходимо активировать персонажа.<br>Авторизируйтесь с главной страницы.');
	} */
	
	if($u->info['repass'] > 0) {
		die();
	}
		
	if($u->info['bithday'] == '01.01.1800') {
		unset($_GET['msg'],$_POST['msg'],$_POST['warnMsg']);
		$_GET['r3'] = 1;
	}
	
	if( $u->info['admin'] == 0 ) {
		unset($_GET['r3']);
	}
		
	if($u->info['online'] < time() - 60)	{
		mysql_query('UPDATE `users` SET `online` = '.time().' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
		$filter->setOnline($u->info['online'],$u->info['id'],0);
		$u->onlineBonus();		
	}
		
	if(isset($_POST['delMsg']) && ($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)))
	{
		if(((int)$_POST['delMsg']) > 0) {
			mysql_query('UPDATE `chat` SET `delete` = "'.$u->info['id'].'" WHERE `id` = "'.mysql_real_escape_string(((int)$_POST['delMsg'])).'" LIMIT 1');
		}else{
			mysql_query('UPDATE `users` SET `molch3` = "'.(time()+3600*3).'" WHERE `id` = "'.mysql_real_escape_string(-((int)$_POST['delMsg'])).'" LIMIT 1');
		}
	}
	
	$r = array(
		'rnd'=>$code,
		'rn'=>NULL,
		'list'=>NULL,
		'msg'=>NULL,
		'key'=>NULL,
		'js'=>NULL,
		'xu'=>0
	);
	//
		
	$u->onlineBonus();
		
	if($u->info['battle'] > 0) {
		$btl = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$u->info['battle'].'" AND `time_over` = 0 LIMIT 1'));
		if(!isset($btl['id'])) {
			$r['js'] .= 'top.frames["main"].location="main.php";';
		}
	}

	//Союзы и альянсы
	if($u->info['clan'] > 0)//&& ($msg['to'] == 'union' || $msg['to'] == 'aliance')
	{
		$una = mysql_fetch_array(do_query('SELECT `id`, `join1`, `join2` FROM `clan` WHERE `id` = "'.$u->info['clan'].'" LIMIT 1'));

		if(isset($una['join1']) && $una['join1'] > 0)// && $msg['to'] == 'union'
		{
			$u2 = mysql_fetch_array(do_query('SELECT `id` FROM `clan_join` WHERE `clan` = "'.$u->info['clan'].'"
			AND `time_start`=0 AND `time_end`="0" AND `alians`="'.$una['join1'].'" LIMIT 1'));
			if(!isset($u2['id'])) $u1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$una['join1'].'" LIMIT 1'));
		}

		if(isset($una['join2']) && $una['join2'] > 0) //&& $msg['to'] == 'aliance'
		{
          	$a2 = mysql_fetch_array(do_query('SELECT `id` FROM `clan_join` WHERE `clan` = "'.$u->info['clan'].'"
			AND `time_start`=0 AND `time_end`="0" AND `alians`="'.$una['join1'].'" LIMIT 1'));
            if(!isset($a2['id'])) $a1 = mysql_fetch_array(do_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$una['join1'].'" LIMIT 1'));
		}
	}
	

	//Отправляем сообщения
	if(isset($_POST['msg']) && str_replace(' ','',$_POST['msg'])!='')
	{
		$msg = array();
		$_POST['msg'] = str_replace('\x3C','<',$_POST['msg']);
		$_POST['msg'] = str_replace('\x3','>',$_POST['msg']);
		$_POST['msg'] = iconv('UTF-8', 'windows-1251', $_POST['msg']);
		function tolink($buf) {
			$x=explode(" ",$buf);
			$newbuf='';
			for ($j=0; $j<count($x); $j++) {
			 $uname = '<b><i>[Внутренняя ссылка]</i></b>';
			 //
			 if( strripos($x[$j], 'testcombats.ru/info/') == true ) {
				 $ulogin = explode('/info/',$x[$j]);
				 $ulogin = $ulogin[1];
				 $ulogin = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.mysql_real_escape_string($ulogin).'" OR `login` = "'.mysql_real_escape_string($ulogin).'" LIMIT 1'));
				 if(isset($ulogin['login'])) {
					 $ulogin = htmlspecialchars($ulogin['login']);
				 	 $uname = '<font color=#831db7>[НБК Информация о &quot;'.$ulogin.'&quot;]</font>';
				 }
			 }elseif( strripos($x[$j], 'testcombats.ru/item/') == true ) {
				 $ulogin = explode('/item/',$x[$j]);
				 $ulogin = $ulogin[1];
				 $ulogin = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($ulogin).'" LIMIT 1'));
				 if(isset($ulogin['name'])) {
					 $ulogin = htmlspecialchars($ulogin['name']);
				 	 $uname = '<font color=#d9a903>[НБК Предмет &quot;'.$ulogin.'&quot;]</font>';
				 }else{
					 $uname = '<font color=#5f9b00>[НБК Библиотека предметов]</font>';
				 }
			 }elseif( strripos($x[$j], 'testcombats.ru/forum') == true ) {
				 $ulogin = explode('/forum?read=',$x[$j]);
				 $ulogin = $ulogin[1];
				 $ulogin = explode('&',$ulogin);
				 $ulogin = $ulogin[0];
				 //
				 $ulogin = mysql_fetch_array(mysql_query('SELECT `title` FROM `forum_msg` WHERE `id` = "'.mysql_real_escape_string($ulogin).'" AND `delete` = 0 LIMIT 1'));
				 if(isset($ulogin['title'])) {
					 $ulogin = htmlspecialchars($ulogin['title']);
				 	 $uname = '<font color=#0055b5>[НБК Форум &quot;'.$ulogin.'&quot;]</font>';
				 }else{
					 $ulogin = explode('/forum?r=',$x[$j]);
					 $ulogin = $ulogin[1];
					 $ulogin = explode('&',$ulogin);
					 $ulogin = $ulogin[0];
					 //
					 $ulogin = mysql_fetch_array(mysql_query('SELECT `name` FROM `forum_menu` WHERE `id` = "'.mysql_real_escape_string($ulogin).'" LIMIT 1'));
					 if(isset($ulogin['name'])) {
					 	$uname = '<font color=#0055b5>[НБК Конференция форума &quot;'.$ulogin['name'].'&quot;]</font>';
					 }else{
						$uname = '<font color=#0055b5>[НБК Форум]</font>'; 
					 }
				 }
			 }
			 //
             if (preg_match	("/(https:\\/\\/)?([a-z_0-9-.]+\\.ourcombats+\\.com(([ \"'>\r\n\t])|(\\/([^ \"'>\r\n\t]*)?)))/",$x[$j],$ok))
				$newbuf.=str_replace($ok[2],"<small><a href=//".$ok[2]." target=_blank ><i>https://".$ok[2]."</i></a></small>",str_replace("https://","",$x[$j]))." ";
			 elseif (preg_match ("/(https:\\/\\/)?(ourcombats+\\.com(([ \"'>\r\n\t])|(\\/([^ \"'>\r\n\t]*)?)))/",$x[$j],$ok)) 
			 $newbuf.=str_replace($ok[2],"<small><a href=//$ok[2] target=_blank ><i>".$uname."</i></a></small>",str_replace("https://","",$x[$j]))." ";
			 else $newbuf.=$x[$j]." ";
			}
			return $newbuf;
		}	
		$_POST['msg'] = $chat->expworld($_POST['msg'],120);
		$_POST['msg'] = str_replace('\\','\\\\',$_POST['msg']);
		$_POST['msg'] = str_replace('"','[s1;]',$_POST['msg']);
		$_POST['msg'] = str_replace("'",'[s2;]',$_POST['msg']);
		$_POST['msg'] = str_replace('<','[s3;]',$_POST['msg']);
		$_POST['msg'] = str_replace('>','[s4;]',$_POST['msg']);
		$_POST['msg'] = str_replace('	',' ',$_POST['msg']);
		$_POST['msg'] = str_replace('&gt;','[s4;]',$_POST['msg']);
		$_POST['msg'] = str_replace('&lt;','[s3;]',$_POST['msg']);
		
		$_POST['msg'] = str_replace("\r",'[s3;]br[s4;]',$_POST['msg']);
		$_POST['msg'] = str_replace("\b",'[s3;]br[s4;]',$_POST['msg']);
		$_POST['msg'] = str_replace("",'[s3;]TAB[s4;]',$_POST['msg']);
		$_POST['msg'] = str_replace("",'[s3;]TAB[s4;]',$_POST['msg']);
		

		$_POST['msg'] = htmlspecialchars($_POST['msg'],NULL,'cp1251');
		$_POST['msg'] = str_replace('%usersmile%','',$_POST['msg']);
		$_POST['msg'] = tolink($_POST['msg']);
				
		$_POST['msg'] = str_replace('::','',$_POST['msg']);
		
		$_POST['msg'] = str_replace('[s1;]','&quot;',$_POST['msg']);
		$_POST['msg'] = str_replace("[s2;]",'&quot;',$_POST['msg']);
		$_POST['msg'] = str_replace('[s3;]','&lt;',$_POST['msg']);
		$_POST['msg'] = str_replace('[s4;]','&gt;',$_POST['msg']);
		
		$_POST['msg'] = str_replace('	',' ',$_POST['msg']);
				
		$lmg = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `chat` WHERE `login` = "'.$u->info['login'].'" AND `time` > '.(time()-2).' LIMIT 2'));
		if($lmg[0] > 0) {
			$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Вы не можете отправлять так часто сообщения... </small>","Black","1","1","0"]);';
			if($u->info['molch1'] < time()) {
				if($u->info['molch1'] < -5) {
					//Молчанка за флуд на 5 минут
					$u->info['molch1'] = time()+300;
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Вы наказаны за флуд на 5 минут </small>","Black","1","1","0"]);';					
				}elseif($u->info['molch1'] < 0) {
					$u->info['molch1']--;
				}else{
					$u->info['molch1'] = -1;
				}
				mysql_query('UPDATE `users` SET `molch1` = "'.$u->info['molch1'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
		}elseif($chat->str_count($_POST['msg'],4)=='/afk')
		{
			$_POST['msg'] = str_replace('/afk','',$_POST['msg']);
			$_POST['msg'] = htmlspecialchars($_POST['msg'],NULL,'cp1251');
			$_POST['msg'] = ' '.$_POST['msg'].' ';
			if(str_replace(' ','',$_POST['msg']) == '')
			{
				$_POST['msg'] = 'away from keyboard';
			}
			mysql_query('UPDATE `users` SET `dnd` = "",`afk` = "'.mysql_real_escape_string($_POST['msg']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Успешно выставлен <b>/afk</b> статус: <i>'.$_POST['msg'].'</i></small>","Black","1","1","0"]);';
		}
		elseif($chat->str_count($_POST['msg'],2)=='/g' && $u->info['admin']>0)
		{
			$_POST['msg'] = str_replace('/g',' ',$_POST['msg']);
			$_POST['msg'] = str_replace('{m}','<b>'.$u->info['login'].'</b>: ',$_POST['msg']);
				mysql_query('INSERT INTO `chat` (`nosee`,`invis`,`da`,`delete`,`molch`,`new`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,`sound`,`global`) VALUES (
				"0",
				"'.$u->info['invis'].'",
				"1",
				"0",
				"0",
				"1",
				"",
				"",
				"'.$u->info['city'].'",
				"0",
				"'.time().'",
				"0",
				"0",
				"'.mysql_real_escape_string($_POST['msg']).'",
				"0",
				"red",
				"0",
				"0",
				"0")');
		}elseif($chat->str_count($_POST['msg'],4)=='/dnd')
		{
			$_POST['msg'] = str_replace('/dnd','',$_POST['msg']);
			if(str_replace(' ','',$_POST['msg']) == '')
			{
				$_POST['msg'] = 'do not disturb';
			}
			$_POST['msg'] = htmlspecialchars($_POST['msg'],NULL,'cp1251');
			$_POST['msg'] = ' '.$_POST['msg'].' ';
			mysql_query('UPDATE `users` SET `afk` = "",`dnd` = "'.mysql_real_escape_string($_POST['msg']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Успешно выставлен <b>/dnd</b> статус: <i>'.$_POST['msg'].'</i></small>","Black","1","1","0"]);';
		}else{
			//Записываем данные
			$msg['time'] = time();
			$msg['spam'] = 0;
			$msg['type'] = 1;
			$msg['toChat'] = 0;
			$msg['color'] = 'Black';
			$msg['typeTime'] = 0;
			$msg['sound'] = 0;
			$msg['global'] = 0;
			$msg['molch'] = 0;
			$msg['login'] = $u->info['login'];
			$msg['cancel'] = 0;
			$msg['delete'] = 0;
			$msg['to'] = '';
			$msg['da'] = 0;
			
			$msg['color'] = $u->info['chatColor'];
/* 			if($u->info['admin'] == 0  || true == true) {
				$msg['fspam'] = $filter->spamFiltr(str_replace('точка','.',$_POST['msg']));
				if($msg['fspam']!='0')
				{
					$msg['spam'] = 1; $msg['delete'] = 1;
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>['.$msg['fspam'].'] В нашем чате запрещается сообщать ссылки на атльтернативные проекты. Повторные попытки могут привести к блокировке персонажа.</small>","Black","1","1","0"]);';
				}
				
				if($msg['spam'] == 1 && $u->info['molch1']<time())
				{
					$mban = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` >= '.strtotime('now 00:00:00').' AND `vars` = "msg_bans" LIMIT 1',1);
					if(!isset($mban['id']))
					{
						$u->addAction(time(),'msg_bans','1');
						$mban['vals'] = 0;
					}else{
						mysql_query('UPDATE `actions` SET `vals` = `vals` + 1 WHERE `id` = "'.$mban['id'].'" LIMIT 1');
						$msg['delete'] = time();
					}	
					
					if($mban['vals']+1 < 2)
					{
						$msg['fspam'] = str_replace('%','</b>,<b>',$msg['fspam']);
						$msg['fspam'] = '<b>'.ltrim($msg['fspam'],'0</b>,<b>').'</b>';
						$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>В нашем чате запрещается сообщать ссылки на атльтернативные проекты. Запрещенные слова: '.$msg['fspam'].'. Предупреждения ['.($mban['vals']+1).'/1]</small>","Black","1","1","0"]);';
					}else{
						$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>В нашем чате запрещается сообщать ссылки на атльтернативные проекты. Вы наказаны за нарушение правил общения.</small>","Black","1","1","0"]);';
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','0','','','<b>Автоинформатор</b>: Персонаж ".$u->info['login']." [".$u->info['level']."] был наказан за нарушение правил общения.','-1','6','0')");
						mysql_query('UPDATE `users` SET `molch1` = "'.(time()+1*60*60).'",`molch2` = "'.(time()+1*60*60).'",`info_delete` = "'.(time()+1*60*60).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; <small><font color=red>Автоинформатор</font></small>: '.$msg['text'].' ['.$msg['fspam'].'].';
						mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$u->info['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					}
				}
			} */
			//Нормируем типы сообщений
			if(preg_match("/private\[(.*?)\]/", $_POST['msg'], $msg['to']))
			{
				$msg['to'] = $msg['to'][1];
				$_POST['msg'] = str_replace('private['.$msg['to'].']','private ['.$msg['to'].']',$_POST['msg']); $msg['to'] = '';
			}elseif(preg_match("/to\[(.*?)\]/", $_POST['msg'], $msg['to']))
			{
				$msg['to'] = $msg['to'][1];
				$_POST['msg'] = str_replace('to['.$msg['to'].']','to ['.$msg['to'].']',$_POST['msg']); $msg['to'] = '';
			}
			
			if(preg_match("/private \[(.*?)\]/", $_POST['msg'], $msg['to'])) 
			{
				$msg['to'] = trim($msg['to']['1'],' '); $msg['type'] = 3; $_POST['msg'] = str_replace('private ['.$msg['to'].']',' ',$_POST['msg']);
			}elseif(preg_match("/to \[(.*?)\]/", $_POST['msg'], $msg['to'])) 
			{
				$msg['to'] = trim($msg['to']['1'],' '); $msg['type'] = 2; $_POST['msg'] = str_replace('to ['.$msg['to'].']',' ',$_POST['msg']);
			}
			
			
			
			if(isset($_POST['trader']) && $_POST['trader'] == 1) {
				//Торговый чат
				$msg['to'] = 'trade';
				$msg['type'] = 1;
			}
			
			if(!is_array($msg['to']))
			{
				$qix = mysql_fetch_array(mysql_query('SELECT `id` FROM `friends` WHERE `ignor` > 0 AND `login_ignor` = "'.mysql_real_escape_string($u->info['login']).'" AND `user_ignor` = "'.mysql_real_escape_string($msg['to']).'" LIMIT 1'));
				if(isset($qix['id']))
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<b>Вас добавили в игнор</b>: Вы не можете отправлять сообщения персонажу &quot;'.htmlspecialchars($msg['to']).'&quot;.","Black","1","1","0"]);';
					$msg['cancel']++;
				}elseif($msg['type']==3 && $u->info['active']!='') {
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Отправлять сообщения в <b>приват</b> могут только активированные персонажи.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}
            }

			if($msg['type'] == 3 && $msg['to'] == 'union')
			{

				if(!isset($u1['name']))
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Вы не являетесь частью одного из <b>Союзов</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					$msg['to'] = 'u'.$u1['name'];
					$msg['da'] = 1;
                    //pr($msg['to']);
				}
			}
			elseif($msg['type'] == 3 && $msg['to'] == 'aliance')
			{
				if(!isset($a1['name']))
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Вы не являетесь частью одного из <b>Альянсов</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					$msg['to'] = 'a'.$a1['name'];
					$msg['da'] = 1;
				}
			}
			elseif($msg['type'] == 3 && $msg['to'] == 'klan')
			{
				if($u->info['clan']==0)
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Вы не являетесь частью одного из <b>Кланов</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					$msg['to'] = 'k'.$u->info['clan'];
					$msg['da'] = 1;
				}
			}elseif($msg['type'] == 3 && $msg['to'] == 'pals')
			{
				if($u->info['align']<=1 || $u->info['align']>=2)
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Вы не являетесь частью <b>Ордена Света</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					//Все ок
					$msg['type'] = -3;
				}
			}elseif($msg['type'] == 3 && $msg['to'] == 'tars')
			{
				if($u->info['align']<=3 || $u->info['align']>=4)
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","0","","'.$u->info['login'].'","<small>Вы не являетесь частью <b>Армады Тьмы</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					//Все ок
					$msg['type'] = -3;
				}
			}
						
			if($u->info['molch1']>time())
			{
				if( $msg['to'] != '' && !isset($admq['id']) && !is_array($msg['to']))
				{
					$result8 = mysql_query('SELECT `id`, `admin` FROM `users`
					WHERE `login` = "'.mysql_real_escape_string($msg['to']).'" AND `admin` > 0 LIMIT 1') or eLog(mysql_error().' to: '.$msg['to']);
                    $admq = mysql_fetch_array($result8);

					if( $msg['type'] != 3 || $u->info['molch3']>time() ) {//не писать в приват админам при molch3
						unset($admq);
					}
				}
				if( !isset($admq['id']) ) {
					$msg['molch'] = 1;
				}
			}			
			
			if($msg['cancel']==0)
			{
				if(is_array($msg['to']))
				{
					$msg['to'] = '';
				}
				if($msg['type']==3 && $msg['da']>0)
				{
					$msg['type'] = -3;
				}
				
				$msw = $chat->smileText($_POST['msg'],$msg['to'],$u->info['room'],$u->info['city']);				
				$nosend = 0;
				if($msw != false)
				{
					$_POST['msg'] = $msw;
					$msg['to']   = '';
					$msg['type'] = 21;
					if($msw == 'USER IS FALSE')
					{
						$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Персонажа нет в данной комнате.</small>","Black","1","1","0"]);';
						$nosend = 1;
					}
				}elseif($chat->str_count($_POST['msg'],3) == '/e ')
				{
					$msg['type'] = 21;
					$_POST['msg'] = ltrim($_POST['msg'],'/e ');						
				}elseif($chat->str_count($_POST['msg'],3) == '/е ')
				{
					$msg['type'] = 21;
					$_POST['msg'] = ltrim($_POST['msg'],'/е ');						
				}elseif($chat->str_count($_POST['msg'],4) == ' /e ')
				{
					$msg['type'] = 21;
					$_POST['msg'] = ltrim($_POST['msg'],' /e ');						
				}elseif($chat->str_count($_POST['msg'],4) == ' /е ')
				{
					$msg['type'] = 21;
					$_POST['msg'] = ltrim($_POST['msg'],' /е ');						
				}
				if($nosend == 0) {
					$activ = 0;
					if($u->info['activ'] > 0) {
						$activ = 1;
					}
					
					/* if( $u->info['win']<10) {
						 $msg['nosee'] = round($u->info['host_reg']);
						 if( $msg['nosee'] == 0 ) {
							 $msg['nosee'] = -1;
							 $r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small><b>В целях борьбы против рекламы, общение в чате доступно после 10 побед.</b> </small>","red","1","1","0"]);';
						 }
					} */ 
					
					
					mysql_query('INSERT INTO `chat` (`nosee`,`active`,`invis`,`da`,`delete`,`molch`,`new`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,`sound`,`global`) VALUES (
					"'.$msg['nosee'].'",
					"'.$activ.'",
					"'.$u->info['invis'].'",
					"'.$msg['da'].'",
					"'.$msg['delete'].'",
					"'.$msg['molch'].'",
					"1",
					"'.$msg['login'].'",
					"'.mysql_real_escape_string($msg['to']).'",
					"'.$u->info['city'].'",
					"'.$u->info['room'].'",
					"'.$msg['time'].'",
					"'.$msg['type'].'",
					"'.$msg['spam'].'",
					"'.mysql_real_escape_string($_POST['msg']).'",
					"'.$msg['toChat'].'",
					"'.$msg['color'].'",
					"'.$msg['typeTime'].'",
					"'.$msg['sound'].'",
					"'.$msg['global'].'")');
					
					
				}	
			}
		}	
			if($msg['type'] == 2 && mb_convert_case($msg['to'], MB_CASE_LOWER, "cp1251") == 'комментатор') {				
				if(preg_match("/анекдот/i",mb_convert_case($_POST['msg'], MB_CASE_LOWER, "cp1251"))) {
					//$com_act = 0;
					$text_com = '';
					$sp_all = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `a_com_act` WHERE `act` = "'.$text_com.'" AND `time` > "'.time().'" LIMIT 5'));
					if($sp_all[0] > 0) {
						if(rand(0,100) < 100) {
							$text_com = array(
								'Отстань попрошайка! ... Ищу анекдоты, интернет не маленький!',
								'Подожди... Сейчас что-нибудь найду',
								'Почти нашел... :smiles_835: ',
								'Вот один есть, но он не интересный...',
								'А свет на центральной площади тьму &quot;пинает&quot;... Эх... :smiles_244: ',
								'Да угомоните кто нибудь его',
								' :eek: ',
								' :nunu: ',
								' :smiles_341: ',
								' :smiles_0593: '
							);
							$text_com = $text_com[rand(0,(count($text_com)-1))];
						}
					}else{
						$sp_all = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `a_com_anekdot`'));
						$sp_all = rand(1,$sp_all[0]);
						$sp_all = mysql_fetch_array(mysql_query('SELECT * FROM `a_com_anekdot` WHERE `id` = "'.$sp_all.'" LIMIT 1'));
						if(isset($sp_all['id'])) {
							$text_com = $sp_all['text'];
							$text_com = str_replace("<br>&nbsp;","<br>&nbsp; &nbsp; ",$text_com);
							$text_com = str_replace("<br />","<br />&nbsp; &nbsp; ",$text_com);
							$text_com = str_ireplace("\r\n"," ",$text_com);
							$text_com = str_replace(" "," ",$text_com);
							$text_com = '<font color=red><b>Анекдот</b></font>:<br>&nbsp; &nbsp; '.$text_com.'<br>';
						}else{
							$text_com = 'Анекдот из головы вылетел...';
						}
						mysql_query('INSERT INTO `a_com_act` (`act`,`time`,`uid`) VALUES ("0","'.(time()+60).'","'.$u->info['id'].'")');
					}
					if($text_com != '') {
						mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$text_com.'","Комментатор","'.$u->info['login'].'","'.$u->info['city'].'","'.$u->info['room'].'","2","'.time().'","1")');
					}
					//$msg['cancel']++;
				}else{
					include('commentator.php');
					if($comment != '') {
						mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$comment.'","Комментатор","'.$u->info['login'].'","'.$u->info['city'].'","'.$u->info['room'].'","2","'.time().'","1")');
					}
				}
			}	
			mysql_query('UPDATE `users` SET `afk` = "",`dnd` = "",`timeMain` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		
	
	
	if( $u->info['room'] == 362 && (int)$_GET['r3'] != 1 )
	{
		/*
		Башня смерти название комнаты*/
		$rmnm = mysql_fetch_array(mysql_query('SELECT `name` FROM `bs_map` WHERE `x` = "'.$u->info['x'].'" AND `y` = "'.$u->info['y'].'" LIMIT 1'));
		$u->room['name'] = $rmnm['name'];
		
	}
	
	//Получаем список онлайн
	if($_GET['r1']!=0)
	{
		$sp = mysql_query('SELECT `u`.`pass`,`u`.`sex`,`s`.`dnow`,`u`.`timeMain`,`s`.`bot`,`s`.`atack`,`u`.`afk`,`u`.`dnd`,`u`.`banned`,`u`.`molch1`,
		`u`.`room`,`u`.`id`,`u`.`city`,`u`.`cityreg`,`u`.`online`,`u`.`align`,`u`.`align2`,`u`.`clan`,`u`.`login`,`u`.`level`,`u`.`inTurnir`,`u`.`battle`,
		`u`.`invis`,`u`.`inUser`,`s`.`x`,`s`.`y` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`
		WHERE ((`u`.`room` = "'.$u->info['room'].'" AND "'.mysql_real_escape_string((int)$_GET['r3']).'" != "1")
		OR ("'.mysql_real_escape_string((int)$_GET['r3']).'" = "1" AND `pass` != "saintlucia" AND `room` != "303")) ORDER BY `u`.`inUser` DESC,`u`.`online` DESC,`u`.`login` DESC LIMIT 300');


		$ar_id = 0;
		$ar_lvl = 0;
		$ar_all = 0;
		$usl = array();
		$cw = array();
		$usid = array();

		while($pl = mysql_fetch_array($sp))
		{
			$clan = $pl['clan'];
			$ysee = 1;
			if($pl['inUser'] > 0)
			{
				if($pl['inTurnir'] == 0) {
					$ysee = 0;
				}else{
					if($pl['online'] < time()-120) {
						mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}
				}
			}else{
				if($pl['inTurnir'] > 0) {
					$ysee = 0;
				}
			}
            
			if(!isset($usl[$pl['login']])) {
				$ysee = 1;
			}
			//if($u->info['id']==5100291) eLog($ysee.' : '.$u->info['dnow'].' : '.$pl['dnow'].' : '.$_GET['r3']);
			if((int)$_GET['r3'] != 1 && $u->info['room']==405) {//$u->info['room']==405 - без этого, не показывало игроков из-за налчичия $u->info['dnow']
				if( $u->info['dnow'] != $pl['dnow'] ) {
					$ysee = 0;
				}
			}
			
			if( $pl['room'] >= 362 && $pl['room'] <= 366 && (int)$_GET['r3'] != 1) {
				if( $pl['x'] != $u->info['x'] || $pl['y'] != $u->info['y'] || $pl['room'] != $u->info['room']) {
					$ysee = 0;
				}
			}

			if( $usid[$pl['login']] == true ) {
				$ysee = 0;
			}

			$usl[$pl['login']] = $pl['id'];
			
			if( ($pl['online'] > time()-520 || $pl['inUser'] > 0) && ($pl['bot']!=1 || $pl['pass'] == '#acapulka#') && $pl['banned'] == 0 && $ysee == 1)
			{
				$usid[$pl['login']] = true;	
				if( $pl['timeMain'] < time() - 15 * 60 && $pl['afk'] == '' && $pl['dnd'] == '' ) {
					$pl['afk'] = 'away from keyboard';
					mysql_query('UPDATE `users` SET `afk` = "'.$pl['afk'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				}elseif( $pl['timeMain'] < time() - 15 * 60 ) {
					$pl['afk'] = '';
					if( $pl['sex'] == 1 ) {
						$pl['afk'] .= 'Отошла';
					}else{
						$pl['afk'] .= 'Отошел';
					}
					$pl['afk'] .= ' '.$u->timeOut(time()-$pl['timeMain']).' назад';
				}
				if($pl['invis'] != 1 && $pl['invis'] < time()) {
					if($pl['clan']>0)
					{
						if($u->info['clan'] > 0 && $pl['clan'] != $u->info['clan']) {
							if(!isset($cw['war'][$pl['clan']][$u->info['clan']])) {
								$pl['cwar'] = mysql_fetch_array(mysql_query('SELECT `id`,`type` FROM `clan_wars` WHERE
								((`clan1` = "'.$pl['clan'].'" AND `clan2` = "'.$u->info['clan'].'") OR (`clan2` = "'.$pl['clan'].'" AND `clan1` = "'.$u->info['clan'].'")) AND
								`time_finish` > '.time().' LIMIT 1'));
								if(isset($pl['cwar']['id'])) {
									$cw['war'][$pl['clan']][$u->info['clan']] = $pl['cwar']['type'];
								}else{
									$cw['war'][$pl['clan']][$u->info['clan']] = 0;
								}
							}
							if($cw['war'][$pl['clan']][$u->info['clan']] > 0) {
								$pl['atack'] = $cw['war'][$pl['clan']][$u->info['clan']];
							}
						}
						if(!isset($cw[$pl['clan']])) {
							$pl['clan'] = mysql_fetch_array(mysql_query('SELECT `name_mini` FROM `clan` WHERE `id` = "'.$pl['clan'].'" LIMIT 1'));
							$cw[$pl['clan']['name_mini']] = $pl['clan']['name_mini'];
						}else{
							$pl['clan'] = $cw[$pl['clan']];
						}
						$pl['clan'] = $pl['clan']['name_mini'];
					}
					if($pl['atack'] > time() || $pl['atack'] == 1 || $pl['atack'] == 2)
					{
						if( $pl['atack'] != 2 ) {
							$pl['atack'] = 1;
						}
					}else{
						$pl['atack'] = 0;
					}

					//Нападение крестиком
					if($pl['id']!=50932 && $pl['id']!=50933)
					{
                    	$clan_u = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_join` WHERE ((`alians` = "'.$clan.'" AND `clan` = "'.$u->info['clan'].'")
						OR (`alians` = "'.$u->info['clan'].'" AND `clan` = "'.$clan.'")) AND `time_end` = "0" AND `time_start` > 0 LIMIT 1'));

						$cln1 = mysql_fetch_array(mysql_query('SELECT `join1` FROM `clan` WHERE `id` = "'.$u->info['clan'].'" LIMIT 1'));
                		$cln2 = mysql_fetch_array(mysql_query('SELECT `join1` FROM `clan` WHERE `id` = "'.$clan.'" LIMIT 1'));

						if($u->info['login']==$pl['login'] || ($u->info['clan']==$clan && $clan > 0) || isset($clan_u['id'])
						|| ($cln1['join1'] == $cln2['join1'] && $cln1['join1'] && $cln2['join1'])) $pl['atack'] = 0;
					}

					$no_atack_rooms = array(321,472,479);
					if($u->info['battle']!=0 || $pl['dnow']!=0 || $u->info['dnow']!=0 || in_array($u->info['room'], $no_atack_rooms) || in_array($pl['room'], $no_atack_rooms)) $pl['atack'] = 0;//Не показывать крестики когда уже в бою
					

					$trvm = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `eff_users` WHERE `uid` = "'.$pl['id'].'" AND (`id_eff` = "4" OR `id_eff` = "6") AND `delete` = "0" ORDER BY `id_eff` ASC LIMIT 6'));
					$trvm = $trvm['name'];
					$r['list'] .= '"'.$r['xu'].'":["'.$pl['id'].'","'.$pl['login'].'","'.$pl['level'].'","'.$pl['align'].'","'.$pl['clan'].'","'.$pl['cityreg'].'","'.$pl['city'].'","'.$pl['room'].'","'.$pl['afk'].'","'.$pl['dnd'].'","'.$pl['banned'].'","'.$pl['molch1'].'","'.$pl['battle'].'","'.$pl['atack'].'","'.$trvm.'","'.($pl['sex']*0).'","'.$pl['align2'].'"],';
					$ar_id  += $pl['id'];
					$ar_lvl += $pl['level'];
					$ar_all += $pl['align']+$pl['clan']+$pl['molch1']+$pl['banned']+$pl['battle'];
					if($pl['afk']!='')
					{
						$ar_all += 2;
					}else if($pl['dnd']!='')
					{
						$ar_all += 1;
					}
				}
				$r['xu']++;
			}
		}
		unset($pl,$sp);
		$r['list'] = rtrim($r['list'],',');
		$r['list'] = '{'.$r['list'].'}';
	}

function json_fix_cyr($json_str) { 
		return $json_str; 
	}


		//Получаем сообщения чата
		if(isset($_GET['mid']) && !isset($_POST['mid']))
		{
			$_POST['mid'] = $_GET['mid'];
		}
		$r['msg'] = '';
		$i = 0; $l = 0;
        $chat_from = 600;//С какого времени показывать чат
		$sp = mysql_query('SELECT `nosee`,`frv`,`id`,`dn`,`active`,`invis`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,
		`sound`,`global`,`delete`,`molch`,`da` FROM `chat`
		WHERE
		(
			(
				`delete` > 0
			AND
				`time` > '.(time()-360).'
			)
			OR
			(
						`time` > '.(time()-$chat_from).'
				OR
					(
							`time` = -1
						AND
						(
							`to` = "'.$u->info['login'].'"
						OR
							`type` = 8
						)
					)
				OR
					(
							`time` < -1
						AND
							`time` > -'.time().'
						AND
							(
								`to` = "'.$u->info['login'].'"
							OR
								`type` = 8
							OR
								`to` = ""
							)
					)
			)
		)
		AND
			`new` = "1"
		AND
			(
				`id` > '.((int)$_POST['mid']).'
			OR
				`delete` > 0
			OR
				`spam` > 0
			OR
				(
					`time` < 0
				AND
					`time` > -'.time().'
				AND
					(
						`to` = "'.$u->info['login'].'"
					OR
						`to` = ""
					)
				)
			)
		ORDER BY `id` ASC');
		while($pl = mysql_fetch_array($sp))
		{
			if( $pl['delete'] > 0 ) {
				$r['msg'] .= ',"m'.$i.'":["'.$pl['id'].'","","delete","","","","","","","0","0","0","1","",""]';	
			}
			
			if($pl['type'] == 6 || $pl['type'] == 8){ $pl['city'] = $u->info['city']; }
			
			$see = 1;			
			
			if($pl['type'] == 8 && $u->info['admin'] == 0 && (($u->info['align'] <= 1 || $u->info['align'] >= 2) && ($u->info['align'] <= 3 || $u->info['align'] >= 4))) {
				$see = 0;
			}
			
			if( ( $pl['type'] > 0 && $pl['type'] < 4 ) || $pl['type'] == -3 ) {
				$pl['room'] = $u->info['room'];
				$pl['city'] = $u->info['city'];
			}
			
			//Проверки на доступ к просмотру
			if((($pl['type']==3 || $pl['type']==4) && ($pl['city']==$u->info['city'] || $pl['global']==1)) || (($pl['type']==5 || $pl['type']==6 ||			
			(
				$pl['type']==8 && ( $u->info['admin'] > 0 || ($u->info['align'] > 1 && $u->info['align'] < 2) )
			)			 
			) && ($pl['city']==$u->info['city'] || $pl['global']==1)) || ($pl['type']==7 && $pl['city']==$u->info['city'] && $pl['room']==$u->info['room']) || ($pl['type']==6 && ($pl['city']==$u->info['city'] || $pl['global']==1)) || $pl['type']==9 || $pl['type']==10)
			{
				if($pl['to']!='' && $pl['login']!=$u->info['login'] && $pl['to']!=$u->info['login'])
				{
					$n = 0;
					$ex = explode(',',$pl['to']);
					$j = 0;
					while($j<count($ex))
					{
						if(trim($ex[$j],' ')==$u->info['login'])
						{
							$n++;
						}
						$j++;
					}	
					if($n==0)
					{
						$see = 0;
					}
					unset($n,$j,$ex);		
				}
			}
			//Клановое сообщение, а также сообщение союзу или альянсу (по всем городам)
            //el($u->info['id'], $pl['to'],$u1['name']);
			if($pl['type']==-3 && ($pl['to']=='k'.$u->info['clan'] || $pl['to']=='u'.$u1['name'] || $pl['to']=='a'.$a1['name']
			|| ($pl['to']=='pals' && $u->info['align']>1 && $u->info['align']<2) || ($pl['to']=='tars' && $u->info['align']>3 && $u->info['align']<4)))
			{
				$pl['type'] = 3;
				if($pl['to']=='k'.$u->info['clan'])
				{
					$pl['to'] = 'klan';
				}
                elseif($pl['to']=='u'.$u1['name'])
				{
					$pl['to'] = 'union';
				}
                elseif($pl['to']=='a'.$a1['name'])
				{
					$pl['to'] = 'aliance';
				}
				$see = 1;

				if($pl['to']=='pals' && $u->info['admin'] > 0 && $pl['login'] != $u->info['login']) $see = 0;//Не показывать админам чат модераторов
				if($pl['to']=='tars' && $u->info['admin'] > 0 && $pl['login'] != $u->info['login']) $see = 0;//Не показывать админам чат модераторов
			}
			elseif($pl['type']==-3)
			{
				$see = 0;
			}
			
			//Системное сообщение только в этой комнате
			if($pl['type']==6 && $pl['room'] > 0 && $pl['room'] != $u->info['room'] && $pl['to']=='')
			{
				$see = 0;
			}
		
			//Системное сообщение по всему городу
			if($pl['type']==8 && $pl['city']!=$u->info['city'] && $pl['global']==0)
			{
				$see = 0;
			}
			
			//Сообщение с молчанкой
			if($pl['molch']>0)
			{
				$see = 0;
			}
			
			//Сообщение отправлено в другой комнате
			if(($pl['type']==1 || $pl['type']==2) && ($pl['room'] != $u->info['room'] || $pl['city'] != $u->info['city']) && ($pl['global']==0 || $_COOKIE['chatCfg11']==0))
			{
				$see = 0;
			}
						
			//Сообщение прочее, в другом городе
			if($pl['city'] != $u->info['city'] && $pl['global']==0) {
				$see = 0;
			}
			
			//Глобал
			if($pl['global']==1 && $pl['city']==$u->info['city'] && $pl['type']!=-3)
			{
				$see = 1;
			}
			
			//Неактивированный персонаж
			if($pl['active'] == 1 && $u->info['admin'] == 0 && $pl['login'] != $u->info['login']) {
				if(($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4)) {
					//$see = 0;
				}else{
					$see = 0;
				}
			}
			
		//Приглашение стать воспитанником
			/* if($pl['type']==90 && $pl['delete'] == 0 && $pl['to'] == $u->info['login'])
			{
				setcookie('nasta','tester',time()+60*60*24);
				$r['js'] .= 'top.nasta="'.$pl['login'].'";';
				mysql_query('UPDATE `chat` SET `delete` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				$pl['delete'] = time();
			} */
			
			//Пещерное сообщение
			if( $pl['dn'] > 0 && $u->info['dnow'] != $pl['dn'] ) {
				$see = 0;
			}
			
			$modr = 0;
			
			if( ($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4) ) {
				$modr = 1;
			}
			
			if( $pl['login'] != $u->info['login'] && $pl['nosee'] != 0 && $u->info['id'] != $pl['nosee'] && $u->info['admin'] == 0 && $modr == 0 && $u->info['align']!=50 )
			{
				$see = 0;
			}else{
				if( $pl['nosee'] != 0 )
				{
					if( $pl['login'] != $u->info['login'] )
					{
						$noseein = 'скрыто';
						if( $u->info['id'] == $pl['nosee'] ) $noseein = 'ваш реферал';

						$pl['text'] = '<span style=\"padding:0 5px 0 5px;background-color:#FFC;\"><font color=red><small>['.$noseein.']</small></font> '.$pl['text'].'</span>';
						if( $u->info['admin'] > 0 || ($pl['nosee']==-1 && $u->info['align']==50)) $see = 1;//$modr == 1
					}
				}
			}
			if($see == 1 && $pl['delete'] == 0 && $pl['login'] != '') {
				
				//Проверяем игнор
				//$n = 0;
				//$qix = '';
				//$ex = explode(',',$pl['to']);
				//$j = 0;
				//while($j<count($ex)) {
				//	if( $j > 0 ) {
				//		$qix .= ' OR ';
				//	}
				//	$qix = ' `login_ignor` = "'.mysql_real_escape_string(htmlspecialchars(trim($ex[$j],' '))).'" ';
				//	$j++;
				//}

				$qix = mysql_fetch_array(mysql_query('SELECT `id` FROM `friends` WHERE `ignor` > 0 AND `login_ignor` = "'.mysql_real_escape_string($pl['login']).'" AND (`user_ignor` = "'.$u->info['login'].'" OR `user` = "'.$u->info['id'].'") LIMIT 1'));
				if(isset($qix['id'])) {
					$see = 0;
				}
				unset($qix);
				//unset($n,$j,$ex,$qix);
				
			}
			
			if($see == 1 && $pl['delete'] == 0)
			{
				//$pl['text'] = str_replace('"','&nbsp;',$pl['text']);
				if($pl['time'] < 0)
				{
					if($pl['to'] == '') {
						$lmsch = mysql_fetch_array(mysql_query('SELECT `id` FROM `chat` ORDER BY `id` DESC LIMIT 1'));
						if( isset($lmsch['id']) ) {
							$lmsch['id']++;
							mysql_query('UPDATE `chat` SET `id` = "'.$lmsch['id'].'",`time` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
							$pl['id'] = $lmsch['id'];
						}else{
							mysql_query('UPDATE `chat` SET `time` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
						}
					}else{
						mysql_query('UPDATE `chat` SET `time` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}
					$pl['time'] = time();
				}
				if($pl['delete']>0)
				{
					$r['msg'] .= ',"'.$i.'":{"d":"'.$pl['id'].'"}';
				}elseif($pl['spam']>0)
				{
					$r['msg'] .= ',"'.$i.'":{"s":"'.$pl['id'].'"}';
				}else{
					
					$reimg = array();
					if(preg_match_all("/\[img\[(.*?)\]\]\[1\]/", $pl['text'], $reimg) && ($u->info['admin']>0 || $pl['type']==5 || $pl['type']==6 || $pl['type']==10 || $pl['type']==11))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('[img['.$reimg[1][$k].']][1]','<img src=//img.testcombats.ru/i/'.$reimg[1][$k].' height=19>',$pl['text']);
							$k++;
						}
					}
					if(preg_match_all("/\[img\[(.*?)\]\]/", $pl['text'], $reimg) && ($u->info['admin']>0 || $pl['type']==5 || $pl['type']==6 || $pl['type']==10 || $pl['type']==11))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('[img['.$reimg[1][$k].']]','<img src=//img.testcombats.ru/i/'.$reimg[1][$k].'>',$pl['text']);
							$k++;
						}
					}
					
					if(preg_match_all("/item\[(.*?)\]/", $pl['text'], $reimg))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('item['.$reimg[1][$k].']','<b oncontextmenu=\"return false;\" onClick=\"alert(\'Функция временно недоступна!\');\" style=\"cursor:pointer;\" class=\"itemsInfo\">Предмет</b>',$pl['text']);
							$k++;
						}
					}
					if(preg_match_all("/item \[(.*?)\]/", $pl['text'], $reimg))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('item ['.$reimg[1][$k].']','<b oncontextmenu=\"return false;\" onClick=\"alert(\'Функция временно недоступна!\');\" style=\"cursor:pointer;\" class=\"itemsInfo\">Предмет</b>',$pl['text']);
							$k++;
						}
					}

					/*if(preg_match_all("/news", $pl['text'], $reimg))//Ссылки на новости
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace($reimg[1][$k], '<a href="'.$reimg[1][$k].'" class=\"itemsInfo\" target=\"_blank\">'.$reimg[1][$k].'</a>',$pl['text']);
							$k++;
						}
					}*/
					
					if($pl['type'] != 3) {
						if($pl['invis'] == 1 || $pl['invis'] > time()) {
							if($u->info['admin'] == 0) {
								$pl['login'] = '<b><i>Невидимка</i></b>';
							}else{
								$pl['login'] = '<b><i>Невидимка</i></b></a> <small>('.$pl['login'].')</small>';
							}
							
						}
					}
					
					if( $pl['invis'] > 0 && ($pl['type'] == 1 || $pl['type'] == 2) ) {
						$pl['color'] = 'Black';
					}
					
					//if( $u->info['mat'] == 1 ) {
						//$pl['text'] = str_replace('<i><f c=','',$pl['text']);
						//$pl['text'] = str_replace(' />&lt;ВЦ&gt;</i>','',$pl['text']);
					//}
					
					//конвертация данных				
					$r['msg'] .= ',"m'.$i.'":["'.$pl['id'].'","'.$pl['time'].'","'.$pl['type'].'","'.$pl['login'].'","'.$pl['to'].'","'.$pl['text'].'","'.$pl['color'].'","'.$pl['toChat'].'","'.$pl['typeTime'].'","'.$pl['sound'].'","'.$pl['global'].'","'.$pl['molch'].'","'.$pl['active'].'","'.date('H:i',$pl['time']).'","'.date('d.m.Y H:i',$pl['time']).'","'.$pl['frv'].'","'.$pl['invis'].'"]';
				}
			}
			if($l < $pl['id'])
			{
				$l = $pl['id'];
			}
			$i++;
            
		}
            /*if($i)
			{
				error_log($r['msg'].' : '.$i.' : '.$l);
				$res = file_put_contents($chat_file, $r['msg'], FILE_APPEND | LOCK_EX);//Пишем содержимое в файл
				$res = file_put_contents($chat_file2, $i);//Пишем содержимое в файл
                $res = file_put_contents($chat_file3, $l);//Пишем содержимое в файл
			} else {
						$res = file_put_contents($chat_file, '');//Пишем содержимое в файл
						$res = file_put_contents($chat_file2, 0);//Пишем содержимое в файл
                        $res = file_put_contents($chat_file3, 0);//Пишем содержимое в файл
					}*/
		//} else {
					//$r['msg'] = file_get_contents($chat_file);
                    //$i = file_get_contents($chat_file2);
                    //$l = file_get_contents($chat_file3);
                    //error_log('Используем кеш');
				//}
		//While вывода чата
		//error_log($r['msg']);
		$r['msg'] = '{"ld":"'.(0+$l).'","id":"'.$i.'"'.$r['msg'].'}';
		/*$rsys = $u->sys_see(0);
		if($rsys != '') {
			$r['js'] .= $rsys;
		}
		unset($rsys);*/
	//Проверяем изменения персонажа
	if($_POST['tgfs'] == 0) {
		$tgfc = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `telegram` WHERE `uid` = "'.$u->info['id'].'" AND `open` = "0" LIMIT 1'));	
		if($tgfc[0]>0)
		{
			$r['js'] .= 'top.tgf_ico(1);';
		}
	}
	//Генерируем ключ
	$r['key'] = md5($u->room['name'].'+'.$ar_id.'+'.$ar_lvl.'+'.$ar_all);
	unset($ar_id,$ar_lvl);
	if($_COOKIE['chatCfg12']==0)
	{
		$_GET['key'] = time();
	}
	if($r['key']==$_GET['key'])
	{
	//Список онлайн остается неизменным
	unset($r['rn'],$r['list'],$r['key'],$r['xu']);
	}elseif($_GET['r1']!=0)
	{
  		$r['rn'] = iconv('cp1251','utf-8',$u->room['name']);
		$r['list'] = iconv('cp1251','utf-8',$r['list']);
	}
	
	$posts = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` AS `iu` WHERE `iu`.`uid` = "-51'.$u->info['id'].'" AND `iu`.`delete` = 0 AND `iu`.`inOdet` = 0 AND `iu`.`inShop` = 0 AND `iu`.`lastUPD` < '.time().' LIMIT 1'));
	$posts = $posts[0];
	
	if($posts > 0) {
		$r['js'] .= ' $("#postdiv").show();';
	}else{
		$r['js'] .= ' $("#postdiv").hide();';
	}
	
	//Предложения вступить в клан
	$sp = mysql_query('SELECT * FROM `clan_add` WHERE `uid` = "'.$u->info['id'].'" AND `yes` = 0 AND `no` = 0');
	while( $pl = mysql_fetch_array($sp) )
	{
		$clns = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`align` FROM `clan` WHERE `id` = "'.$pl['clan'].'" LIMIT 1'));
		$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level` FROM `users` WHERE `id` = "'.$pl['uid_clan'].'" LIMIT 1'));
		$r['js'] .= 'top.inclanNew('.$pl['id'].',"'.$clns['align'].'","'.$clns['id'].'","'.$clns['name'].'","'.$usr['login'].'</b>['.$usr['level'].']<b>");';
	}
	unset($clns);
	
	//Предложение на обмен
	$trf = mysql_fetch_array(mysql_query('SELECT * FROM `transfers` WHERE `uid2` = "'.$u->info['id'].'" AND `start2` = 0 AND `cancel1` = 0 AND `cancel2` = 0 LIMIT 1'));
	if(isset($trf['id']))
	{
		$utf = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$trf['uid1'].'" LIMIT 1'));
		if(isset($utf['login']) && $u->info['battle'] == 0)
		{
			if($trf['text']=='') $trf['text'] = 'не указано.';
			$r['js'] .= 'top.intransferNew('.$trf['id'].',"'.$utf['login'].'", "'.$trf['text'].'");';
		}else{
			mysql_query('UPDATE `transfers` SET `cancel2` = "'.time().'" WHERE `id` = "'.$trf['id'].'" LIMIT 1');
		}
	}
	
	//Перекодируем строки
	if($r['js']!=NULL)
	{
		$r['js'] = iconv('cp1251','utf-8',$r['js']);
	}else{
		unset($r['js']);
	}
	if($r['msg']!=NULL)
	{
		$r['msg'] = iconv('cp1251','utf-8',$r['msg']);
	}else{
		unset($r['msg']);
	}
	unset($c,$u,$db);
	$r = json_encode($r);
	//$r = json_fix_cyr($r);
	echo $r;
	//
	unset($r);
?>