<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
define('GAME',true);

include('../../_incl_data/class/__db_connect.php');
include('../../_incl_data/__config.php');
//ini_set('display_errors','on');

function e($t) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' ( ритическа€ ошибка): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","Ѕагнутый","6","1","-1")');
}
$time_start = microtime(true);
if(isset($_GET['cron_core']))
{
	$id = array(
		'id' => $_GET['uid'],
		'pass' => $_GET['pass']
	);
	if(md5($id['id'].'530f94c2a4868dac1ba81eb58d2bc098'.$id['pass']) == $_GET['cron_core'])
	{
		$uzr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`pass` FROM `users` WHERE `id` = "'.mysql_real_escape_string($id['id']).'" AND `pass` = "'.mysql_real_escape_string($id['pass']).'" LIMIT 1'));
		if(isset($uzr['id']))
		{
			$CRON_CORE = true;
			$_COOKIE['login'] = $uzr['login'];
			$_COOKIE['pass'] = $uzr['pass'];
            $skey = md5($_COOKIE['login'].$_COOKIE['pass'].$c['skey']);
            $_COOKIE['auth2'] = $skey;
			$_POST['id'] = 'reflesh';
			
			
			if(isset($_GET['atack'])) {
				$_POST['atack'] = $_GET['atack'];
			}
			if(isset($_GET['block'])) {
				$_POST['block'] = $_GET['block'];
			}
			if(isset($_GET['usepriem'])) {
				$_POST['usepriem'] = $_GET['usepriem'];
			}
			if(isset($_GET['useitem'])) {
				$_POST['useitem'] = $_GET['useitem'];
			}
			
		}
		unset($uzr);
	}
}

if(isset($CRON_CORE))
{
	
	if(isset($_POST['atack'],$_POST['block']) || (isset($_POST['id']) && $_POST['id']=='reflesh') || isset($_POST['usepriem']) || isset($_POST['useitem']))
	{
		if(isset($_POST['useitemon'])) {
			$_POST['useitemon'] = iconv('UTF-8', 'windows-1251', $_POST['useitemon']);
		}
		/* session_start();
		$tm = microtime();
		$tm = explode(' ',$tm);
		$tm = $tm[0]+$tm[1];
		
		if(!isset($CRON_CORE))
		{
			include('../../_incl_data/__config.php');
			if($_SESSION['tbr']>$tm)
			{
				die('<script>ggcode="'.$code.'";if(t057!=null){clearTimeout(t057);}</script>');
			}else{
				$_SESSION['tbr'] = $tm+0.350;
			}
		}
		

		unset($tm);		
		$js = '';
		include('../../_incl_data/class/__user.php');
		include('../../_incl_data/class/__magic.php');
		include('../../_incl_data/class/_cron_.php');	
		include('../../_incl_data/class/__quest.php');	
		 */
		/* if(!isset($CRON_CORE))
		{
			if(!isset($u->info['id']) || ($u->info['joinIP']==1 && $u->info['ip']!=$_SERVER['HTTP_X_REAL_IP']))
			{
				die($c['exit']);
			}
		}
		
		$u->stats = $u->getStats($u->info['id'],0);
		
		if(!isset($CRON_CORE))
		{
			if($u->info['online']<time()-30)
			{
				mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."' WHERE `id`='".$u->info['id']."' LIMIT 1");
			}
		} */

		//include('../../_incl_data/class/__battle.php');
		//include('log_text.php');

		/* $btl->is = $u->is;
		$btl->items = $u->items;
		$btl->info = $btl->battleInfo($u->info['battle']);
		if(!isset($btl->info['id']))
		{
			if($u->info['battle']==-1)
			{
				//завершаем поединок
				$upd = mysql_query('UPDATE `users` SET `battle` = "0",`online` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if(!$upd)
				{
					if(!isset($CRON_CORE)) die('ќшибка завершени€ поединка.');
				}else{
					if(!isset($CRON_CORE)) echo '<script>location="main.php";</script>';
				}
			}else{
				mysql_query('UPDATE `users` SET `battle` = "0" WHERE `battle` = "'.$u->info['battle'].'" LIMIT 100');
				if(!isset($CRON_CORE)) {
					die('<script>location="main.php";</script>');
				}
			}
		}else{
			//получаем массив с игроками в бою
				$btl->teamsTake();

			if(isset($_POST['useitem']))
			{
				$magic->useItems((int)$_POST['useitem']);
				if($u->error!='') {
					echo '<font color=red><center><b>'.$u->error.'</b></center></font>';
				}
			}
		 */	
			//заносим удары,приемы,эффекты и т.д.
				//удар
					if(isset($_POST['atack']) && isset($_POST['block']))
					{
						$btl->addAtack();
					}
				//прием
					if(isset($_POST['usepriem']))
					{
						$priem->pruse($_POST['usepriem']);
					}
				//используем закл€тие / пирожки
					
			
			//проводим действи€ (удары, использование приемов, если есть возможность нанести удар или использовать прием)			
				$btl->testActions();
			//авто-смена противника, либо просто смена противника
				if($u->stats['hpNow']>=1)
				{
					//ручна€ смена
					if(isset($_POST['smn']) && $_POST['smn']!='none')
					{
						/* ---------------- */
						$_POST['smn'] = iconv('UTF-8', 'windows-1251', $_POST['smn']);
						$uidz = mysql_fetch_array(mysql_query('SELECT `id`,`inUser` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['smn']).'" AND `battle` = "'.$u->info['battle'].'" LIMIT 1'));
						if($uidz['inUser']>0)
						{
							$uidz['id'] = $uidz['inUser'];
						}
						$rsm = $btl->smena($uidz['id'],false);
						if($rsm!=1)
						{
							echo '<font color=red><center><b>'.$rsm.'</b></center></font>';
						}
						unset($rsm);
						$js .= 'smena_login = \'none\';';
					}
					//авто-смена
					if($u->info['enemy']==0 || $btl->stats[$btl->uids[$u->info['enemy']]]['hpNow']<=0 || isset($btl->ga[$u->info['id']][$u->info['enemy']]))
					{
						$btl->autoSmena();
					}
				}else{
					$btl->mainStatus = 3;
				}
			//получаем данные о поединке
				
			//получаем данные о логе бо€
				
			//≈сли бой сыгран - завершаем
				if($btl->info['team_win']==-1)
				{
					$btl->testFinish();
				}else{
					$btl->testFinish();
				}
			if($btl->info['team_win']==-1)
			{
				$js .= $btl->genTeams($u->info['id']);
			}else{
				$btl->mainStatus = 3;
				$btl->e = $u->btl_txt;
			}
			
			if(!isset($CRON_CORE)) {
				$js .= $btl->myInfo($u->info['id'],1);
				//выводим данные	
				if($btl->e!='')
				{
					echo '<font color="red"><center><b>'.$btl->e.'</b></center></font>';
				}
				if(isset($btl->ga[$u->info['id']][$u->info['enemy']]))
				{
					if($u->info['hpNow']>=1) {
						$btl->mainStatus = 2;		
					}
				}else{
					if($u->info['enemy']!=0 && $btl->info['team_win']==-1 && $u->info['hpNow']>=1)
					{
						$js .= $btl->myInfo($u->info['enemy'],2);
					}
				}
				if($btl->info['izlom']>0)
				{
					$js .= 'volna('.(1+$btl->info['izlomRoundSee']).');';
				}
					$i = 1;
					while($i<=7)
					{
						if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$i]<0)
						{
							$btl->users[$btl->uids[$u->info['id']]]['tactic'.$i] = 0;
						}
						if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$i]>25 && $i<7)
						{
							$btl->users[$btl->uids[$u->info['id']]]['tactic'.$i] = 25;
						}
						$i++;
					}
				$atk1 = 0;
				if(!isset($CRON_CORE)) {$rsys = $u->sys_see(0);}
				if($rsys != '') {
					$js .= $rsys;
				}
				unset($rsys);
				if(isset($btl->ga[$u->info['enemy']][$u->info['id']]))
				{
					$atk1 = 1;
				}
			}
			
		if( $btl->cached == true ) {
			$btl->clear_cache_start();
		}
		/*
		echo '<script>ggcode="'.$code.'";if(t057!=null){clearTimeout(t057);}</script>';
		*/
		}
	}
//}
//$time_end = microtime(true);
//$time = $time_end - $time_start;
//printf("<p>¬рем€ генерации: %1.4f секунд",$time);
//unlink($lock_file);
?>