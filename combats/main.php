<?php
function GetRealIp(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}
function var_info($vars, $d = false){
    //echo "<pre style='border: 1px solid gray;border-radius: 5px;padding: 3px 6px;background: #cecece;color: black;font-family: Arial;font-size: 12px;'>\n";
    //var_dump($vars);
    //echo "</pre>\n";
    if ($d) exit();
}
define('IP',GetRealIp());

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');
include('_incl_data/class/__filter_class.php');
include('_incl_data/class/__quest.php');

    if(isset($u->info['id']) && $u->info['battle'] == 0 && $u->info['inTurnirnew'] == 0)
	{
    	$te = mysql_fetch_array(mysql_query('SELECT * FROM `turnir_end` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));

		if(isset($te['id']))
		{
			mysql_query('DELETE FROM `turnir_end` WHERE `uid` = "'.$u->info['id'].'"');
			if( $te['type'] == 1 )
			{
				mysql_query("INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`,
				`inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`,
				`overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`)
				VALUES (6833, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '',
				'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");

				$u->info['win']++;
				$u->info['win_t']++;
				$u->info['money'] += $te['money'];
				$u->info['money2'] += $te['ekr'];
				$u->info['exp'] += $te['exp'];
		 	}
			elseif( $te['type'] == 2 )
			{
				$u->info['lose']++;
				$u->info['lose_t']++;
		 	}
			elseif( $te['type'] == 3 ) $u->info['nich']++;

			mysql_query('UPDATE `users` SET
				`win` = "'.$u->info['win'].'",
				`lose` = "'.$u->info['lose'].'",
				`nich` = "'.$u->info['nich'].'",
				`money` = "'.$u->info['money'].'",
				`win_t` = "'.$u->info['win_t'].'",
				`lose_t` = "'.$u->info['lose_t'].'",
                `money2` = `money2` + '.$te['ekr'].'
				WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

			mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	        //mysql_query('UPDATE `users` SET `money2` = `money2` + '.$te['ekr'].' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			//mysql_query('DELETE FROM `turnir_end` WHERE `uid` NOT IN (SELECT `id` FROM `users`)');

			header('location: /main.php');
			die();
		}
	}

if($u->info['banned'] > 0) {
	header('location: /index.php');
	die();
}
$tjs = '';

if($u->info['bithday'] == '01.01.1800' && $u->info['inTurnirnew'] == 0) {
	unset($_GET,$_POST);
}


#--------для общаги, и позже для почты
$sleep = $u->testAction('`vars` = "sleep" AND `uid` = "'.$u->info['id'].'" LIMIT 1',1);
if($u->room['file'] != "cc/room_hostel" && $u->room['file'] != "an/room_hostel" && $sleep['id']>0)
{
    mysql_query('UPDATE `actions` SET `vars` = "unsleep" WHERE `id` = "'.$sleep['id'].'" LIMIT 1');
}
if($u->room['file']=="sleeproom" || $u->room['file']=="post"){$ellius=0;}else{$ellius=1;}

#--------для общаги, и позже для почты
if($u->info['online'] < time()-60 || $u->info['afk'] != '')
{
	$filter->setOnline($u->info['online'],$u->info['id'],0);
	//$u->onlineBonus();	
	mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."',`afk`='' WHERE `id`='".$u->info['id']."' LIMIT 1");	
}elseif($u->info['timeMain'] < time()-60 || $u->info['afk'] != ''){
	mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."',`afk`='' WHERE `id`='".$u->info['id']."' LIMIT 1");	
}

if(!isset($u->info['id']) || ($u->info['joinIP']==1 && $u->info['ip']!=$_SERVER['HTTP_X_REAL_IP']) || $u->info['banned']>0){
	die($c['exit']);
}

if($u->info['battle_text']!=''){
	//Показываем системку и заносим данные
	if($u->info['last_b']>0){		
		mysql_query('INSERT INTO `battle_last` (`battle_id`,`uid`,`time`,`act`,`level`,`align`,`clan`,`exp`)
		VALUES ("'.$u->info['last_b'].'","'.$u->info['id'].'","'.time().'","'.$u->info['last_a'].'","'.$u->info['level'].'","'.$u->info['align'].'","'.$u->info['clan'].'","'.$u->info['exp'].'")');
	}
}

if(isset($_GET['newclan']))
{
	$czv = mysql_fetch_array(mysql_query('SELECT * FROM `clan_add` WHERE `uid` = "'.$u->info['id'].'" AND `yes` = 0 AND `no` = 0 AND `id` = "'.mysql_real_escape_string($_GET['newclan']).'" LIMIT 1'));
	if( isset($czv['id']) )
	{
		$clns = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`align`,`money1` FROM `clan` WHERE `id` = "'.$czv['clan'].'" LIMIT 1'));
		$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`money`,`clan`,`cityreg`,`align` FROM `users` WHERE `id` = "'.$czv['uid_clan'].'" LIMIT 1'));
		if(isset($_GET['newclan_val']))
		{
			if( $_GET['newclan_val'] == 2 )
			{
				$u->error = 'Вы отказались от заявки на вступление в клан &quot;'.$clns['name'].'&quot;.';
				mysql_query('UPDATE `clan_add` SET `no` = "'.time().'" WHERE `id` = "'.$czv['id'].'" LIMIT 1');
			}elseif( $_GET['newclan_val'] == 1 )
			 {
				if($u->info['clan'] > 0) {
					$u->error = 'Вы уже находитесь в клане и не можете принять заявку.';
				}elseif($u->info['align'] == 2) {
					$u->error = 'Хаосникам нельзя вступать в клан.';
				}elseif($u->info['align'] == 50) {
					$u->error = 'Алхимикам нельзя вступать в клан.';
				}elseif(($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4)) {
					$u->error = 'Модераторам нельзя вступать в клан.';
				}elseif($u->info['banned'] > 0) {
					$u->error = 'Ваш персонаж заблокирован. Что же вы здесь делаете?';
				}elseif($u->info['level'] < 7) {
					$u->error = 'Персонажам ниже 7-го уровня нельзя вступать в клан.';
				}/* elseif($clns['money1'] < 0) {//$usr['money']
					$u->error = 'У клана персонажа &quot;'.$clns['name'].'&quot;, который пригласил вас, недостаточно денег. Необходимо: 100 кр.';
				} */else{
                    $clns['money1'] -= 100;
					//$usr['money'] -= 100;
					$u->info['align'] = $clns['align'];
					$u->info['clan'] = $clns['id'];
					$u->info['mod_zvanie'] = 'Рекрут';
					$u->info['clan_prava'] = '0|0|0|0|0';

					mysql_query('UPDATE `users` SET `align` = "'.$u->info['align'].'", `clan` = "'.$u->info['clan'].'", `mod_zvanie` = "Рекрут", `clan_prava` = "0|0|0|0|0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					//mysql_query('UPDATE `users` SET `money` = "'.$usr['money'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
                    mysql_query('UPDATE `clan` SET `money1` = "'.$clns['money1'].'" WHERE `id` = "'.$clns['id'].'" LIMIT 1');
					mysql_query('UPDATE `clan_add` SET `yes` = "'.time().'" WHERE `id` = "'.$czv['id'].'" LIMIT 1');
					mysql_query('UPDATE `clan_add` SET `no` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `yes` = 0 AND `no` = 0');

					mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
						"'.$u->info['clan'].'","'.time().'","'.date('d.m.Y').'","0","213.159.207.116","Администрация",
						"Клановое сообщение","Игрок <img src=\"//img.testcombats.ru/i/align/align'.$usr['align'].'.gif\" style=\"vertical-align:bottom\"><img src=\"https://img.testcombats.ru/i/clan/'.$usr['clan'].'.gif\" style=\"vertical-align:bottom\"><a href=\"javascript:void(0)\">'.$usr['login'].'</a>['.$usr['level'].']<a target=\"_blank\" title=\"Инф. о '.$usr['login'].'\" href=\"info/'.$usr['id'].'\"><img src=\"//img.testcombats.ru/i/inf_'.$usr['cityreg'].'.gif\"></a> принял в клан нового игрока <img src=\"//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif\" style=\"vertical-align:bottom\"><img src=\"//img.testcombats.ru/i/clan/'.$u->info['clan'].'.gif\" style=\"vertical-align:bottom\"><a href=\"javascript:void(0)\">'.$u->info['login'].'</a>['.$u->info['level'].']<a target=\"_blank\" title=\"Инф. о '.$u->info['login'].'\" href=\"info/'.$u->info['id'].'\"><img src=\"//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif\"></a>"
						)');
				}
			}
		}
	}else{
		$u->error = 'Неудалось найти заявку #'.(0+$_GET['newclan']).' на вступление в клан';
	}
}

if(!isset($_GET['mAjax']) AND !isset($_GET['ajaxHostel']))
	echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT">
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<link href="//img.testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
</head>
<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#D7D7D7;">';
/*-----------------------*/
$act = -2; $act2 = 0;
$u->stats = $u->getStats($u->info['id'],0);
$u->aves = $u->ves(NULL);
if(!isset($u->stats['act']))
{
	$u->stats['act'] = 0;
}
if($u->stats['act']==1)
{
	$act = 1;
}
$u->rgd = $u->regen($u->info['id'],array(0),0);

//Проверка уровня
$ul = $u->testLevel();

if(isset($_GET['atak_user']) && $u->info['battle'] == 0 && $_GET['atak_user']!=$u->info['id'])//Нападение крестиком
{
	if($u->room['noatack'] == 0)
	{
		$ua = mysql_fetch_array(mysql_query('SELECT `id`,`clan` FROM `users` WHERE`id` = "'.mysql_real_escape_string($_GET['atak_user']).'" LIMIT 1'));
		$cruw = mysql_fetch_array(mysql_query('SELECT `id`,`type` FROM `clan_wars` WHERE
		((`clan1` = "'.$ua['clan'].'" AND `clan2` = "'.$u->info['clan'].'") OR (`clan2` = "'.$ua['clan'].'" AND `clan1` = "'.$u->info['clan'].'")) AND
		`time_finish` > '.time().' LIMIT 1'));
		unset($ua);

		if(isset($cruw['id'])) {$cruw = $cruw['type'];} else {$cruw = 0;}
	
		$ua = mysql_fetch_array(mysql_query('SELECT `s`.*,`u`.* FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `s`.`id` = `u`.`id` WHERE ((`s`.`atack` > "'.time().'" OR `s`.`atack` = 1 OR 1 = '.$cruw.' OR 2 = '.$cruw.') OR (`s`.`atack2` > "'.time().'" OR `s`.`atack2` = 1 OR 1 = '.$cruw.' OR 2 = '.$cruw.')) AND `s`.`id` = "'.mysql_real_escape_string($_GET['atak_user']).'" LIMIT 1'));
        if(isset($ua['id'])) $en_count = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_users` WHERE `battle` = "'.$ua['battle'].'" AND `hp`>=0 LIMIT 1'));
		else $en_count[0] = 0;

        $has_art = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE
		`data` LIKE "%art=1%" AND `uid` = "' . $u->info['id'] . '" AND `delete` = "0" AND `inOdet`!="0" LIMIT 1'));

		if($ua['no_ip'] == 'trupojor' && $en_count[0] >= $c['tj_maxplayers']+1)//Ограничение количества нападающих на Общего врага
		{
   			$u->error = 'Общий Враг занят. Станьте в очередь, пожалуйста!';
		}
        elseif($ua['no_ip'] == 'trupojor' && $u->info['level'] < 7)//Ограничение уровня для нападающих на Общего врага
		{
   			$u->error = 'Напасть на Общего Врага можно с 7 уровня.';
		}
        elseif($ua['no_ip'] == 'trupojor' && isset($has_art['id']))//Ограничение артов нападающих на Общего врага
		{
   			$u->error = 'Нельзя нападать на Общего Врага в артовых вещах!';
		}
		elseif(isset($ua['id']) && $ua['online'] > time()-520)
		{
			$usta = $u->getStats($ua['id'],0); // статы цели
			$minHp = floor($usta['hpAll']/100*33); // минимальный запас здоровья цели при котором можно напасть
            //eLog('tst');
            
			if( $ua['battle'] > 0 )
			{
				$uabt = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$ua['battle'].'" AND `team_win` = "-1" LIMIT 1'));
				if(!isset($uabt['id'])) $ua['battle'] = 0;
			}

			if( $ua['battle'] == 0 && $minHp > $usta['hpNow'] ) {
				$u->error = 'Нельзя напасть, у противника не восстановилось здоровье';
			}
			elseif($uabt['noinc'] == 2)
			{
				$u->error = 'Вы не можете вмешаться в клановую войну!<br>Если вы хотите помочь соклану, воспользуйтесь клановой абилкой "Помощь соклану"';
			}elseif( isset($uabt['id']) && $uabt['type'] == 500 && $ua['team'] == 1 ) {
				$u->error = 'Нельзя сражаться на стороне монстров!';
			}elseif( isset($uabt['id']) && $uabt['invis'] > 0 ) {
				$u->error = 'Нельзя вмешиваться в невидимый бой!';
			}elseif( $magic->testAlignAtack( $u->info['id'], $ua['id'], $uabt) == false ) {
				$u->error = 'Нельзя помогать вражеским склонностям!';
			}elseif( $magic->testTravma( $ua['id'] , 3 ) == true ) {
				$u->error = 'Противник тяжело травмирован, нельзя напасть!';
			}elseif( $magic->testTravma( $u->info['id'] , 4 ) == true ) {
				$u->error = 'У вас неизлечимая травма, нельзя напасть!';
			}elseif( $magic->testTravma( $u->info['id'] , 2 ) == true ) {
				$u->error = 'Вы травмированы, нельзя напасть!';
			}elseif($ua['room']==$u->info['room'] && ($minHp <= $usta['hpNow'] || $ua['battle'] > 0))
			{
				if( $ua['type_pers'] == 0 )
				{
					if( $cruw == 2 ) $ua['type_pers'] = 99;
					else $ua['type_pers'] = 50;
				}

				if( $ua['no_ip'] == 'trupojor' ) $ua['type_pers'] = 500;
                //if( $u->info['room'] == 472 ) $ua['type_pers'] = 99;//Ристалище
				
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$usta['hpNow'].'",`mpNow` = "'.$usta['mpNow'].'" WHERE `id` = "'.$usta['id'].'" LIMIT 1');

				$good = $magic->atackUser($u->info['id'],$ua['id'],$ua['team'],$ua['battle'],$ua['bbexp'],$ua['type_pers'],0,0,0,1);

				if($good)
				{
					if( $cruw == 2 )
					{
						$rtxt = '[img[items/pal_button9.gif]] &quot;'.$u->info['login'].'&quot; совершил'.$sx.' кровавое нападение по метке на персонажа &quot;'.$ua['login'].'&quot;.';
					}else{
						$rtxt = '[img[items/pal_button8.gif]] &quot;'.$u->info['login'].'&quot; совершил'.$sx.' нападение по метке на персонажа &quot;'.$ua['login'].'&quot;.';
					}
				
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`)
					VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");

					//if( $ua['no_ip'] == 'trupojor' )$u->SaveStats($u->info['id']);//Кеш одетых вещей

					header('location: main.php');
					die();
				}
			}else{
				if($ua['room']!=$u->info['room']){
				//Персонаж в другой комнате
					$u->error = 'Персонаж находится в другой комнате';
				}else{
					$u->error = 'Персонаж имеет слишком малый уровень жизней.';
				}
			}
		}else{
			//На персонажа нельзя напасть
			$u->error = 'Персонаж не в игре, либо на нем нет метки';
		}
	}else{
		$u->error = 'Вам запрещается атаковать без разрешения...';
	}
}

if($ul==1)
{
	$act = 1;
}	
if($u->info['repass'] > 0)
{
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
	if(isset($_POST['renpass']) && $_POST['renpass']==$_POST['renpass2'] && md5($_POST['renpass'])!=$u->info['pass']) {
		if($u->info['ip']==IP) {
			$u->info['pass'] = md5($_POST['renpass']);
			setcookie('pass',$u->info['pass'],time()+30*60*60*24,'','testcombats.ru');
			mysql_query('UPDATE `users` SET `pass` = "'.mysql_real_escape_string($u->info['pass']).'",`repass` = "0",`type_pers` = "0",`bot_room` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `bot` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}else{
			die('<font color="red"><b>Внимание!</b> Смена пароля привязана к ip %'.$u->info['ip'].'.<br>Для восстановления контроля войдите с данного IP, либо обратитесь к Администрации проекта через нового персонажа. Приносим извинения за неудобства!</font>');
		}
	}else{
		//unlink($lock_file);
		if(isset($_POST['renpass'])) {
			if($u->info['pass']==md5($_POST['renpass']))
			{
				echo '<font color="red"><b>Внимание!</b>Ваш новый пароль должен различаться со старым.</font>';
			}elseif($_POST['renpass']!=$_POST['renpass2']) {
				echo '<font color="red"><b>Внимание!</b>Пароли не совпадают.</font>';
			}
		}
		die('<br><br><br><font color="red"><b>Смените пожалуйста пароль от персонажа!</b><br>Данная смена проходит, если пароль не менялся более 2 месяцев.</font><br><br><hr>
			<form action="main.php" method="post">
		<fieldset>
		<legend><b>Сменить пароль</b></legend>
		<table>
			<tr><td align=right>Новый пароль:</td><td><input type=password name="renpass"></td></tr>
			<tr><td align=right>Новый пароль (еще раз):</td><td><input type=password name="renpass2"></td></tr>
			<tr><td align=right><input type=submit value="Сменить пароль" name="changepsw"></td><td></td></tr>
		</table>
		</fieldset>
		</font>');
	}
}


/*-----------------------*/
if( $u->info['battle'] == 0 ){
	$btl_last = mysql_fetch_array(mysql_query('SELECT `id`,`battle` FROM `battle_users` WHERE `uid` = "'.$u->info['id'].'" AND `finish` = "0" LIMIT 1'));
}
if( isset($btl_last['id']) && $u->info['battle'] == 0 )
{
	include('modules_data/btl_.php');
	$u->info['battle_lsto'] = true;
}
elseif(($u->info['battle']==0 && $u->info['admin']==0) || $u->info['admin']==1)
{ 
	//Проверка/Снятие предметов
	if( !isset($sleep['id']) ) {
		$act2 = $u->testItems($u->info['id'],$u->stats,0);
	}
	if($act2!=-2 && $act==-2){
		$act = $act2;
	}
	
	if( $u->room['block_all'] != 0 ) {
		unset($_GET['inv'],$_GET['skills'],$_GET['anketa']);
	}
	
	if(!isset($u->tfer['id']) && $u->room['block_all'] == 0){
		//Одеть/снять предмет
		if(isset($_GET['rstv']) && isset($_GET['inv'])) {
			$act = $u->freeStatsMod($_GET['rstv'],$_GET['mf'],$u->info['id']);
		} elseif(isset($_GET['ufs2']) && isset($_GET['inv'])){
			$act = $u->freeStats2Item($_GET['itmid'],$_GET['ufs2'],$u->info['id'],1);
		} elseif(isset($_GET['ufs2mf']) && isset($_GET['inv'])){
			$act = $u->freeStats2Item($_GET['itmid'],$_GET['ufs2mf'],$u->info['id'],2);
		} elseif(isset($_GET['ufsmst']) && isset($_GET['inv'])){
			$act = $u->itemsSmSave($_GET['itmid'],$_GET['ufsmst'],$u->info['id']);
		} elseif(isset($_GET['ufsms']) && isset($_GET['inv'])){
			$act = $u->itemsSmSave($_GET['itmid'],$_GET['ufsms']+100,$u->info['id']);
		} elseif(isset($_GET['ufs']) && isset($_GET['inv'])){
			$act = $u->freeStatsItem($_GET['itmid'],$_GET['ufs'],$u->info['id']);
		} elseif(isset($_GET['sid']) && isset($_GET['inv'])){
			$act = $u->snatItem($_GET['sid'],$u->info['id']);
		} elseif(isset($_GET['oid']) && isset($_GET['inv'])){
			$act = $u->odetItem($_GET['oid'],$u->info['id']);//Надеть
		} elseif(isset($_GET['item_rune']) && isset($_GET['inv'])){			
			$act = $u->runeItem(NULL,'',0);
		} elseif(isset($_GET['remitem'],$_GET['inv'])){
			$act = $u->snatItemAll($u->info['id']);
		} elseif(isset($_GET['delete']) && isset($_GET['inv']) && $u->newAct($_GET['sd4'])){
			if($u->info['allLock'] < time()) {
				$u->deleteItem(intval($_GET['delete']),$u->info['id']);
			}else{
				echo '<script>setTimeout(function(){alert("Вам запрещено удалять предметы до '.date('d.m.y H:i',$u->info['allLock']).'")},250);</script>';
			}
		} elseif(isset($_GET['unstack']) && isset($_GET['inv']) && $u->newAct($_GET['sd4'])){
			$u->unstack(intval($_GET['unstack']), intval($_GET['unstackCount']));
		} elseif(isset($_GET['stack']) && isset($_GET['inv'])){
			$u->stack($_GET['stack']);
		} elseif(isset($_GET['end_qst_now'])){
			$q->endq((int)$_GET['end_qst_now'],'end');
		}
		//Использовать эффект
		if(isset($_GET['use_pid'])){
			$magic->useItems((int)$_GET['use_pid']);
		}
	}else{
		if($u->room['block_all'] > 0) {
			if(isset($_GET['use_pid'])) {
				$u->error = 'В данной локации запрещено пользоваться чем-либо...';
			}
		}
	}

}

if($magic->youuse > 0) $act = 1;

//Получение статов
if($act!=-2)
{
    $u->stats = $u->getStats($u->info['id'],0,1);

	$u->aves = $u->ves(NULL);
	if(!isset($sleep['id']))$act2 = $u->testItems($u->info['id'],$u->stats,0);
	if($act2!=-2 && $act==-2)$act = $act2;
}

if($u->info['battle']==0 && ($u->stats['s1'] < 1 || $u->stats['s2'] < 1 || $u->stats['s3'] < 1 || $u->stats['s4'] < 1))
{
    //Скидываем вещи при нулевом стате
    $count = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'"
	AND `inOdet` > "0" AND `inOdet` < "40" LIMIT 1'));

	if($count[0]);
	{
		$result = mysql_query('UPDATE `items_users` SET `inOdet` = "0" WHERE `uid` = "'.$u->info['id'].'" AND `inOdet` > "0" AND `inOdet` < "40"');
      	$u->stats = $u->getStats($u->info['id'],0,1);
      	if($act!=-2) $u->error = 'Нельзя надеть вещь, которая делает стат <= 0 или когда любой стат = 0.';
	}
}

if($u->info['inTurnirnew']) $realUser = mysql_fetch_array(mysql_query('SELECT `align` FROM `users` WHERE `inUser` = "'.$u->info['id'].'" LIMIT 1'));


if(isset($_GET['buyvip']) && $u->info['battle'] == 0){
	include('buyvip/main.php');
}elseif(isset($_GET['security']) && !isset($u->tfer['id']) && $ellius==1){
	include('modules_data/_changepass.php');
}elseif(isset($_GET['quests']) && true == false){
	include('modules_data/_quests.php');
}elseif(isset($_GET['dostij'])){
	include('modules_data/dostij.php');
}elseif(isset($_GET['achiev'])){
	include('modules_data/achiev.php');
}elseif(isset($_GET['enaqrada'])){
	include('modules_data/enaqrada.php');
}elseif($u->info['level']>=0 && isset($_GET['friends']) && !isset($u->tfer['id'])){
	include('modules_data/_friends.php');
}elseif(($u->info['admin']>0 || $u->info['level']>7 || $u->info['align'] == 50) && isset($_GET['notepad']) && !isset($u->tfer['id'])){
	include('modules_data/notepad.php');
}elseif(($u->info['level'] > 0) && isset($_GET['add_eff']) && !isset($u->tfer['id'])){
	include('modules_data/add_eff.php');
}/* elseif(($u->info['level'] > 0) && isset($_GET['newProfa']) && !isset($u->tfer['id'])){
	include('modules_data/newProfa.php');
} *//* elseif(($u->info['level'] > 0) && isset($_GET['ejedevniy']) && !isset($u->tfer['id'])){
	include('modules_data/_ejedevniy.php');
} *//* elseif(($u->info['level'] > 8) && isset($_GET['second']) && !isset($u->tfer['id'])){
	include('modules_data/second.php');
} */elseif((($u->info['align']>1 && $u->info['align']<2) || ($realUser['align']>1 && $realUser['align']<2) || $u->info['admin']>0)
&& isset($_GET['light']) && !isset($u->tfer['id']) && $u->info['jail']==0)//паладины
{
	if( $u->info['id'] == 1000001 )
	{
		$u->info['admin'] = 0;
		die();
	}
	include('modules_data/_mod.php');
}
elseif((($u->info['align']>3 && $u->info['align']<4) || ($realUser['align']>3 && $realUser['align']<4) || $u->info['admin']>0)
&& isset($_GET['dark']) && !isset($u->tfer['id']) && $u->info['jail']==0)//тарманы
{
	if( $u->info['id'] == 1000001 )
	{
		$u->info['admin'] = 0;
		die();
	}
	include('modules_data/_mod.php');
	
}elseif(isset($_GET['admin']) && $u->info['admin']>0 && $u->info['jail']==0)//Админ
{
	if( $u->info['id'] == 1000001 ) {
		$u->info['admin'] = 0;
		die();
	}
	if($u->info['id']==7) {
	include('modules_data/_light.php');
	}else{include('modules_data/_mod.php');}
}elseif( $u->info['align'] > 1 && $u->info['align'] < 2 && isset($_GET['clan_moders']) && !isset($u->tfer['id'])){
	include('modules_data/_clan_moders.php');
//тарманы клан
}/* elseif( $u->info['align'] > 3 && $u->info['align'] < 4 && isset($_GET['clan_moders']) && !isset($u->tfer['id'])){
    include('modules_data/_clan_moders.php');
} */elseif(isset($_GET['vip']) && !isset($u->tfer['id'])){
	include('modules_data/vip.php');
}/* elseif(isset($_GET['zadanievesi']) && !isset($u->tfer['id'])){
	include('modules_data/zadanievesi.php');
} *//* elseif(isset($_GET['osenevent']) && !isset($u->tfer['id'])){
	include('modules_data/osenevent.php');
} *//* elseif(isset($_GET['ezda']) && !isset($u->tfer['id'])){
	include('modules_data/ezda.php');
} */elseif(isset($_GET['relikt']) && !isset($u->tfer['id'])){
	include('modules_data/_relikt.php');
}/* elseif(isset($_GET['bagreport']) && !isset($u->tfer['id'])){
	include('modules_data/_bagreport.php');
} */elseif((isset($_GET['zayvka']) && $u->info['battle']==0) || (isset($_GET['zayvka']) && ($_GET['r']==6 || $_GET['r']==7 || !isset($_GET['r'])) && $u->info['battle']>0) && !isset($u->tfer['id'])){
	if($u->room['zvsee'] == 1) {
		include('modules_data/_zv2.php');
	}else{
		include('modules_data/_zv.php');
	}
}elseif(isset($_GET['alh']) && $u->info['level']>=0 && !isset($u->tfer['id'])){
	include('modules_data/_alh.php');
}elseif($u->info['clan']>0 && isset($_GET['clan']) && !isset($u->tfer['id'])){
	if( $u->info['id'] == 1000001 ) {
		$u->info['admin'] = 0;
		die();
	}
	include('modules_data/_clan.php');
}elseif($u->info['clan']>0 && isset($_GET['clantest']) && !isset($u->tfer['id'])){
	if( $u->info['id'] == 1000001 ) {
		$u->info['admin'] = 0;
		die();
	}
	//include('modules_data/_clantest.php');
}elseif(isset($_GET['alhp']) && ($u->info['admin']==1 || $u->info['align'] == 50 || $u->info['align2'] == 50) && !isset($u->tfer['id'])){
	if( $u->info['id'] == 1000001 ) {
		$u->info['admin'] = 0;
		die();
	}
	include('modules_data/_alhp.php');
//Панель букмекера
	}elseif( isset($_GET['bukmeker']) && $u->info['level']>0 && !isset($u->tfer['id'])){
	include('modules_data/_bukmeker.php');
	//Панель Наемника
	}elseif( $u->info['align2'] == 7.99 && isset($_GET['11_panel']) && $u->info['level']>3 && !isset($u->tfer['id'])){
	include('modules_data/11_panel.php');
	//Панель Лекарь
	}elseif( $u->info['align2'] == 8.99 && isset($_GET['12_panel']) && $u->info['level']>3 && !isset($u->tfer['id'])){
	include('modules_data/12_panel.php');
	//Панель Правизора
	}elseif( $u->info['align2'] == 9.99 && isset($_GET['13_panel']) && $u->info['level']>3 && !isset($u->tfer['id'])){
	include('modules_data/13_panel.php');
	//Панель Кузнеца
	}elseif( $u->info['align2'] == 10.99 && isset($_GET['14_panel']) && $u->info['level']>3 && !isset($u->tfer['id'])){
	include('modules_data/14_panel.php');
	//Панель светлого
	}elseif( $u->info['align'] >= 1 && $u->info['align'] < 2 && isset($_GET['1_panel']) && $u->info['level']>3 && !isset($u->tfer['id'])){
	include('modules_data/1_panel.php');
	//Панель темного
	}elseif( $u->info['align'] >= 3 && $u->info['align'] < 4 && isset($_GET['3_panel']) && $u->info['level']>3 && !isset($u->tfer['id'])){
	include('modules_data/3_panel.php');
	//Панель Министра
	}elseif( $u->info['align'] >= 7 && $u->info['align'] < 8 && isset($_GET['7_panel']) && $u->info['level']>3 && !isset($u->tfer['id'])){
	include('modules_data/7_panel.php');
	}
	elseif (($u->info['battle'] != 0 && $u->info['admin']==0) || ($u->info['battle'] != 0 && $u->info['admin']==1 && !isset($_GET['inv'])))//инв для админов в бою
    //elseif ($u->info['battle'] != 0)
	{
		if((!isset($btl_last['id']) || $u->info['battle'] > 0) && !isset($u->info['battle_lsto'])) include('modules_data/btl_.php');//поединок
	}else{
    	
		if(isset($_GET['talk']) && !isset($u->tfer['id']))
		{
			if($u->info['dnow']>0)
			{
				include('_incl_data/class/__dungeon.php');

			}
			include('modules_data/_dialog.php');
		}elseif(isset($_GET['act_sec']) && !isset($u->tfer['id']) && $ellius==1){
			include('modules_data/_security.php');
		}elseif(isset($_GET['inv']) && !isset($u->tfer['id']) && $ellius==1){
			include('modules_data/_inv.php');//Вывод инвентаря
		}/* elseif(isset($_GET['cryshop']) && !isset($u->tfer['id']) && $ellius==1  && $u->info['level']>0){
			include('modules_data/_cryshop.php');
		} */elseif(isset($_GET['referals']) && $ellius==1 && !isset($u->tfer['id'])){
			include('modules_data/_ref.php');
		}elseif(isset($_GET['obraz']) && !isset($u->tfer['id']) && $ellius==1){
			include('modules_data/_obraz.php');
		}elseif(isset($_GET['galery']) && !isset($u->tfer['id']) && $ellius==1){
			include('modules_data/_galery.php');
		}elseif(isset($_GET['skills']) && !isset($u->tfer['id']) && $ellius==1){
			include('modules_data/_umenie.php');
		}elseif((isset($_GET['transfer']) || isset($u->tfer['id'])) && $u->info['level']>=$c['level_transfer'] && $ellius==1 && $u->info['inTurnir'] == 0 && $u->info['inTurnirnew'] == 0){
			if($u->info['allLock'] > time()) {
				include('modules_data/_locations.php');
				echo '<script>setTimeout(function(){alert("Вам запрещены передачи до '.date('d.m.y H:i',$u->info['allLock']).'")},250);</script>';
			}else{
				include('modules_data/_transfers.php');
			}
		}elseif(isset($_GET['anketa']) && !isset($u->tfer['id']) && $ellius==1){
	    	include('modules_data/_anketa.php');
		}elseif(isset($_GET['pet']) && $u->info['animal']>0 && true == false && $ellius==1){
			include('modules_data/_animal.php');
		}elseif(isset($_GET['newanimal']) && $ellius==1){
			include('modules_data/_newanimal.php');
		}elseif(isset($_GET['act_trf']) && $u->room['block_all']==0){
			include('modules_data/act_trf.php');
		}elseif(!isset($u->tfer['id'])){
				include('modules_data/_locations.php');
		}
	}


if($u->room['name']=='Башня Смерти' && $u->info['inUser']>0 && $u->info['lost']>0){
}

//Проверяем квесты на готовность
if(is_object($q)) $q->testquest();

$iloc = '';
$iloce = '';
$sp = mysql_query('SELECT * FROM `items_local` WHERE (`room` = "'.$u->info['room'].'" OR `room` = "-1") AND `delete` = "0" AND `user_take` = "0"
AND `tr_login` = "'.$u->info['login'].'"');
while( $pl = mysql_fetch_array($sp) )
{
	$itmo = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
	if( isset($itmo['id']) )
	{
		$tk = 1;
		$glid = 0;
		//
		if( $pl['room'] != -1 && $pl['room'] != $u->info['room'] ) {
			if(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
				$iloce = 'Вы находитесь в другой комнате...';
			}
			$tk = 0;
		}elseif( $pl['tr_login'] != '0' && $pl['tr_login'] != $u->info['login']) {
			if(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
				$iloce = 'Данный предмет для другого персонажа...';
			}
			$tk = 0;
		}elseif( $pl['tr_sex'] != -1 && $pl['tr_sex'] != $u->info['sex'] ) {
			if(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
				$iloce = 'Данный предмет для противоположного пола...';
			}
			$tk = 0;
		}
		if($pl['time'] + 86400 < time() ) {
			//Не успели поднять
			$glid = 1;
			mysql_query('UPDATE `items_local` SET `delete` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}elseif(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
			//
			if( $u->info['battle'] > 0 && $tk == 1 ) {
				$iloce = 'Вы не можете поднять предмет, завершите поединок...';
			}elseif($tk == 1 ) {
				$iloce = 'Вы успешно подняли предмет &quot;'.$itmo['name'].'&quot; в локации &quot;'.$u->room['name'].'&quot;.';
				mysql_query('UPDATE `items_local` SET `delete` = "'.time().'" , `user_take` = "'.$u->info['id'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				//выдаем предмет
				$glid = 1;
				if( $pl['data'] == '0' ) {					
					$u->addItem($pl['item_id'],$u->info['id'],'|from_loc_id='.$pl['id'].'|from_loc='.$u->info['room']);
				}else{
					$u->addItem($pl['item_id'],$u->info['id'],'|from_loc_id='.$pl['id'].'|from_loc='.$u->info['room'].'|'.$pl['data']);
				}
				/*
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES
				('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."',
				'Персонаж <b>".$u->info['login']."</b> поднял предмет <b>".$itmo['name']."</b> в локации ".$u->room['name'].".','".time()."','6','0')");
				*/
			}			
		}
		if( $glid == 0 ) {
			if( $tk == 1 && $pl['tr_login'] == '0' ) {
				$tk = 2;
			}
			$iloc .= '<a class="tolobf'.$tk.'" href="main.php?take_loc_item='.$pl['id'].'" target="main"><div class="outer"><div class="middle"><div class="inner">'.
			'<img title="Забрать &quot;'.$itmo['name'].'&quot;';
			if( $pl['tr_login'] ) {
				$iloc .= '\n'.'Предмет для игрока &quot;'.$pl['tr_login'].'&quot;';
			}elseif( $pl['tr_sex'] == 0 ) {
				$iloc .= '\n'.'Предмет для мужчин';
			}elseif( $pl['tr_sex'] == 1 ) {
				$iloc .= '\n'.'Предмет для женщин';
			}else{
				$iloc .= '\n'.'Предмет может подобрать каждый';
			}
			$iloc .= '" src="//img.testcombats.ru/i/items/'.$itmo['img'].'">'.
			'</div></div></div></a> ';	
		}
	}else{
		echo '[!]';
	}
	unset($tk,$itmo);
}

if( $iloc != '' ) {
	if( $iloce != '' ) {
		$iloc = '<div style="padding:10px;"><font color=red>' . $iloce . '</font></div>'.$iloc;
	}
	$iloc = '<style>'.
	'.tolobf0 { display:inline-block; width:80px; height:80px; background-color:#e5e5e5; text-align:center; }.tolobf0:hover { background-color:#d5d5d5; text-align:center; }.tolobf2 { display:inline-block; width:80px; height:80px; background-color:#FFD700; text-align:center; }.tolobf2:hover { background-color:#DAA520; text-align:center; }.tolobf1 { display:inline-block; width:80px; height:80px; background-color:#d5d5e5; text-align:center; }.tolobf1:hover { background-color:#d5d5d5; text-align:center; }.outer {    display: table;    position: absolute;    height: 80px;    width: 80px;}.middle {    display: table-cell;    vertical-align: middle;}.inner {  margin-left: auto; margin-right: auto; width: 80px; }'.
	'</style>'.
	'<h3>В комнате разбросаны предметы</h3>' . $iloc;
	$tjs .= 'top.frames[\'main\'].locitems=1;parent.$(\'#canal1\').html( \'' . $iloc . '\' );';
}else{
	$tjs .= 'top.frames[\'main\'].locitems=1;parent.$(\'#canal1\').html( \'\' );';
}

unset($iloc,$iloce);

/*-----------------------*/
$spl = mysql_fetch_array(mysql_query('SELECT `exp` FROM `levels` WHERE `nextLevel` = "'.($u->info['level']+1).'" ORDER BY `exp` ASC LIMIT 1'));
$spl = $spl['exp'];
echo '<script>top.myexpLineTop27('.$u->info['exp'].','.$spl.');'.$tjs.'top.ctest("'.$u->info['city'].'");top.sd4key="'.$u->info['nextAct'].'"; var battle = '.(0+$u->info['battle']).'; top.hic();</script></body>
</html>';
?>