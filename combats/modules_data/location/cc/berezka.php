<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cc/berezka')
{	
	
	
	/* if(isset($u->stats['shopSaleEkr'],$_GET['sale'])){
		$bns = 0+$u->stats['shopSaleEkr'];
		if($bns!=0){
			if($bns>0){
				$bns = '+'.$bns;
			}
			//$shopProcent = $u->shopSaleM( $shopProcent , $itm );
			if($shopProcent>99){ $shopProcent = 99; }
			if($shopProcent<1){ $shopProcent = 1; }
			//echo '<div style="color:grey;">&nbsp; <b>У Вас действует бонус при продаже: '.$bns.'%</b></div>';
		}
	} */
	
	if(isset($_POST['itemgift']))
	{
		$to = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['to_login']).'" ORDER BY `id` ASC LIMIT 1'));
	if(isset($to['id'])) {
	if($u->info['align'] == 2 || $u->info['haos'] > time()) {
		$re = '<div align="left">Хаосникам запрещается делать подарки другим игрокам</div>';
	}elseif($to['id']==$u->info['id']) {
		$re = '<div align="left">Очень щедро дарить что-то самому себе.</div>';
	}elseif($u->info['level']<8) {
		$re = '<div align="left">Дарить подарки можно начиная с 8-го уровня</div>';
	}else{
				if( $_POST['itemgift'] > 1000000000000 ) {
					$itm_l = mysql_fetch_array(mysql_query('SELECT * FROM `users_gifts` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.mysql_real_escape_string((int)$_POST['itemgift']-1000000000000).'" LIMIT 1'));
					if( isset($itm_l['id']) && $itm_l['money2'] > $u->info['money2'] ) {
						$re = '<div align="left">Недостаточно денег</div>';
					}elseif( isset($itm_l['id']) ) {
						$itm = $u->addItem(4533,1,'|gift_id='.$itm_l['id'].'');
						if( $itm > 0 ) {
							$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE (`im`.`type` = "38") AND `iu`.`id` = "'.mysql_real_escape_string($itm).'" AND `iu`.`uid` = "1" AND `iu`.`gift` = "" AND `iu`.`delete` = "0" AND `iu`.`inOdet` = "0" AND `iu`.`inShop` = "0" LIMIT 1'));
							if(isset($itm['id'])) {
								$u->info['money2'] -= $itm_l['money2'];
								mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								
								$itm['gtxt1'] = $_POST['podarok2'];
								$itm['gtxt2'] = $_POST['txt'];
													
								$itm['gtxt1'] = str_replace('\x3C','<',$itm['gtxt1']);
								$itm['gtxt1'] = str_replace('\x3','>',$itm['gtxt1']);	
								$itm['gtxt1'] = htmlspecialchars($itm['gtxt1'],NULL,'cp1251');
								$itm['gtxt2'] = str_replace('\x3C','<',$itm['gtxt2']);
								$itm['gtxt2'] = str_replace('\x3','>',$itm['gtxt2']);	
								$itm['gtxt2'] = htmlspecialchars($itm['gtxt2'],NULL,'cp1251');
								
								$giftlogin = $u->info['login'];
								
								if( $_POST['from'] == 1 ) {
									//Анонимно
									$giftlogin = '<i>Анонима</i>';
								}elseif( $_POST['from'] == 2 && $u->info['clan'] > 0 ) {
									//От клана
									$cln = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$u->info['clan'].'" LIMIT 1'));
									if(isset($cln['id'])) {
										$giftlogin = 'клана <img src="//img.testcombats.ru/i/clan/'.$cln['id'].'.gif"> <b>'.$cln['name'].'</b>';
									}
								}
								
								$fspam = $filter->spamFiltr(str_replace('точка','.',str_replace('ру','ru',$itm['gtxt1']))); 								
								if( $fspam != '0' ) {
									$itm['gtxt1'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
									$itm['gtxt2'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
								}
								
								$upd = mysql_query('UPDATE `items_users` SET `data` = "'.$itm['data'].'",`gtxt1` = "'.mysql_real_escape_string($itm['gtxt1']).'",`gtxt2` = "'.mysql_real_escape_string($itm['gtxt2']).'", `uid` = "'.$to['id'].'", `gift` = "'.$giftlogin.'",`time_create` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
								$whos = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$to['id'].'" LIMIT 1'));
								$ld = $u->addDelo(1, $to['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Получен подарок от  [id="'.$u->info['id'].'"/ Логин : "'.$u->info['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
								$ld = $u->addDelo(1, $u->info['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Сделал подарок персонажу  [id="'.$to['id'].'"/ Логин : "'.$whos['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
								if($upd)
								{
									$re = '<div align="left">Подарок был успешно отправлен к &quot;'.$to['login'].'&quot; за '.$itm_l['money'].' кр.</div>';
									if( $giftlogin == $u->info['login'] ) {
										$text = ' Получен подарок <b>'.$itm_l['name'].'</b>. От персонажа [login:'.$u->info['login'].'] .';
									}else{
										$text = ' Получен подарок <b>'.$itm_l['name'].'</b>. От персонажа '.$giftlogin.' .';
									}
									mysql_query("INSERT INTO `chat` (`new`, `city`, `room`, `login`, `to`, `text`, `time`, `type`, `toChat`) VALUES ('1','".$u->info['city']."', '', '', '".$to['login']."', '".$text."', '".time()."', '6', '0')");
								}else{
									$re = '<div align="left">Не удалось сделать подарок</div>';
								}
							}else{
								$re = '<div align="left">Не удалось сделать подарок, он испортился...</div>';
							}
						}else{
							$re = '<div align="left">Не удалось сделать подарок, курьер случайно сломал его...</div>';
						}
					}else{
						$re = '<div align="left">Предмет не найден</div>';
					}
				}else{
					$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE (`im`.`type` = "38") AND `iu`.`id` = "'.mysql_real_escape_string($_POST['itemgift']).'" AND `iu`.`uid` = "'.$u->info['id'].'" AND (`iu`.`gift` = "" OR (`iu`.`data` LIKE "%|zazuby=%" AND `iu`.`gift` = 1)) AND `iu`.`delete` = "0" AND `iu`.`inOdet` = "0" AND `iu`.`inShop` = "0" LIMIT 1'));
					$po = $u->lookStats($itm['data']);
					 If(isset($itm['id']))
					{
						//$itm['data'] = '';
						
						$itm['gtxt1'] = $_POST['podarok2'];
						$itm['gtxt2'] = $_POST['txt'];
											
						$itm['gtxt1'] = str_replace('\x3C','<',$itm['gtxt1']);
						$itm['gtxt1'] = str_replace('\x3','>',$itm['gtxt1']);	
						$itm['gtxt1'] = htmlspecialchars($itm['gtxt1'],NULL,'cp1251');
						$itm['gtxt2'] = str_replace('\x3C','<',$itm['gtxt2']);
						$itm['gtxt2'] = str_replace('\x3','>',$itm['gtxt2']);	
						$itm['gtxt2'] = htmlspecialchars($itm['gtxt2'],NULL,'cp1251');
						
						$fspam = $filter->spamFiltr(str_replace('точка','.',str_replace('ру','ru',$itm['gtxt1']))); 								
						if( $fspam != '0' ) {
							$itm['gtxt1'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
							$itm['gtxt2'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
						}
						
						$giftlogin = $u->info['login'];
								
						if( $fspam != '0' ) {
							//Если спам то хуй анонимно!
						}elseif( $_POST['from'] == 1 ) {
							//Анонимно
							$giftlogin = '<i>Анонима</i>';
						}elseif( $_POST['from'] == 2 && $u->info['clan'] > 0 ) {
							//От клана
							$cln = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$u->info['clan'].'" LIMIT 1'));
							if(isset($cln['id'])) {
								$giftlogin = 'клана  '.$cln['name'].'';
							}
						}
						
						$upd = mysql_query('UPDATE `items_users` SET `data` = "'.$itm['data'].'",`gtxt1` = "'.mysql_real_escape_string($itm['gtxt1']).'",`gtxt2` = "'.mysql_real_escape_string($itm['gtxt2']).'", `uid` = "'.$to['id'].'", `gift` = "'.$giftlogin.'",`time_create` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
						$whos = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$to['id'].'" LIMIT 1'));
						$ld = $u->addDelo(1, $to['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Получен подарок от  [id="'.$u->info['id'].'"/ Логин : "'.$u->info['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"] ('.$giftlogin.')',time(),$u->info['city'],'Shop.gift',0,0);
						$ld = $u->addDelo(1, $u->info['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Сделал подарок персонажу  [id="'.$to['id'].'"/ Логин : "'.$whos['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'" ('.$giftlogin.')]',time(),$u->info['city'],'Shop.gift',0,0);
						if($upd)
						{
							$re = '<div align="left">Подарок был успешно отправлен к &quot;'.$to['login'].'&quot;</div>';
							if( $giftlogin == $u->info['login'] ) {
								$text = ' Получен подарок <b>'.$itm['name'].'</b>. От персонажа [login:'.$u->info['login'].'] .';
							}else{
								$text = ' Получен подарок <b>'.$itm['name'].'</b>. От персонажа '.$giftlogin.' .';
							}
							mysql_query("INSERT INTO `chat` (`new`, `city`, `room`, `login`, `to`, `text`, `time`, `type`, `toChat`) VALUES ('1','".$u->info['city']."', '', '', '".$to['login']."', '".$text."', '".time()."', '6', '0')");
						}else{
							$re = '<div align="left">Не удалось сделать подарок</div>';
						}
					}else{
						$re = '<div align="left">Предмет не найден</div>';
					}
				}
			}
		}else{
			$re = '<div align="left">Персонаж с таким логином не найден</div>';
		}
	}
	
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}
	
	$sid = 2;
	
	

	$sale_ekr = true;
	if( $u->info['id'] > 0 ) {
		$sale_ekr = true;
	}else{
		if( isset($_GET['sale']) ) {
			//unset($_GET['sale']);	
		}
	}

	$error = '';
	
	if(isset($_GET['buy'])){
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}elseif(isset($_GET['sale']) && isset($_GET['item']) && $u->newAct($_GET['sd4']) && $sale_ekr == true ) {
		$id = (int)$_GET['item'];
		$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.*, count(`iuu`.id) as inGroupCount
			FROM `items_users` AS `iu`
			LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)
			LEFT JOIN `items_users` as `iuu` ON (`iuu`.inGroup = `iu`.inGroup AND `iuu`.item_id = `im`.id )
			WHERE `iuu`.`uid`="'.$u->info['id'].'" AND `iu`.`uid`="'.$u->info['id'].'" AND `im`.`price2` > 0 AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		$po = $u->lookStats($itm['data']);	
		if($u->info['allLock'] > time()) {
			$po['nosale'] = 1;
		}
		
		/* $effvip = mysql_fetch_array(mysql_query('SELECT `id`,`timeUse` FROM `eff_users` WHERE `data` LIKE "%add_silver=%" AND `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1')); */
		//$cblim = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `ekr_sale` WHERE `uid` = "'.$u->info['id'].'" AND `time` >= '.$effvip['timeUse'].' LIMIT 1'));
		
		//if( $cblim[0] >= $u->stats['silver'] * 5 ) {
		//	$error = 'Лимит продаж предметов в березку исчерпан, обновите VIP аккаунт';
		//}else
		if( ($itm['gift'] != '' && $itm['gift'] != '0') && (  $itm['type'] == 37 || $itm['type'] ==  38 || $itm['type'] == 39 || $itm['type'] == 63 ) ) {
			$error = 'Нельзя продавать подарки, они должны оставаться на память! :)';
		}elseif(isset($po['nosale'])){
			$error = 'Не удалось продать предмет ...';
		}elseif(isset($po['fromshop']) && ($po['fromshop'] != 777 && $po['fromshop'] != 2) && ($po['fromshop'] != 610 && $po['fromshop'] != 2)){
			$error = 'Предмет не был приобретен за Еврокредиты, его нельзя продать здесь...';
		}elseif($itm['gift'] != '0' && $itm['gift'] != '') {
				$error = 'Не удалось продать предмет ... Все-таки подарок ;)';
		}elseif(isset($po['frompisher'])){
			$error = 'Не удалось продать предмет ... предмет из подземелья';
		}elseif(isset($po['srok'])){
			$error = 'Предметы со сроком годности продавать нельзя ...';
		}elseif(isset($itm['id'])){
			if($itm['2price']>0){
				$itm['price2'] = $itm['2price'];
			}
			$shpCena = round($itm['price2'],2);
			$plmx = 0;
			if($itm['iznosMAXi']!=$itm['iznosMAX'] && $itm['iznosMAX']!=0){
				$plmx = $itm['iznosMAX'];
			}else{
				$plmx = $itm['iznosMAXi'];
			}
			if($itm['iznosNOW']>0){
				$prc1 = floor($itm['iznosNOW'])/$plmx*100;
			}else{
				$prc1 = 0;
			}
			$shpCena = $u->shopSaleM( $shpCena , $itm );
			$shpCena = $shpCena/100*(100-$prc1);
			if($itm['iznosMAX']>0 && $itm['iznosMAXi']>0 && $itm['iznosMAXi']>ceil($itm['iznosMAX'])){
				$shpCena = $shpCena/100*(ceil($itm['iznosMAX'])/$itm['iznosMAXi']*100);
			}
			/* if( isset($po['art']) ) {
				$shpCena = $u->round2($shpCena*$u->berezCena()); // Процент продажи 35%
			}else{
				$shpCena = $u->round2($shpCena*$u->berezCena()); // Процент продажи 35%
			} */
			if($type==16 || $type==777 || $type==610){
					$shpCena = $pl['price2'];
					if($pl['2price'] > 0 ) {
						$shpCena = $pl['2price'];
					}
					$shpCena = $this->shopSaleM($shpCena,$pl);
					if($pl['kolvo']>0){
						$shpCena = $shpCena*$pl['kolvo'];
					}
					$plmx = 0;
					if($pl['iznosMAXi']!=$pl['iznosMAX'] && $pl['iznosMAX']!=0){
						$plmx = $pl['iznosMAX'];
					}else{
						$plmx = $pl['iznosMAXi'];
					}
					if($pl['iznosNOW']>0){
						$prc1 = floor($pl['iznosNOW'])/$plmx*100;
					}else{
						$prc1 = 0;
					}
					$shpCena = $shpCena/100*(100-$prc1);
					if($pl['iznosMAX']>0 && $pl['iznosMAXi']>0 && $pl['iznosMAXi']>ceil($pl['iznosMAX'])){
						$shpCena = $shpCena/100*(ceil($pl['iznosMAX'])/$pl['iznosMAXi']*100);
					}

			/* if($itm['magic_inci'] == 'addmoney'){
				$shpCena = $itm['price2'];
			}else{
				$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'"'));
				if($premium){
					if($u->berezCena() != 0){
						if( isset($po['art']) ) {
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена арта
						}else{
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена
						}
						$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // Цена предметов
					}
					else{
						$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // Цена предметов
					}
				}else{
					if($u->berezCena() != 0){
						if( isset($po['art']) ) {
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена арта
						}else{
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена
						}
						$shpCena = $u->round2($shpCena*0.9); // Цена предметов
					}
					else{
						$shpCena = $u->round2($shpCena*0.9); // Цена предметов
					}
				} */
				if($shpCena<0){
					$shpCena = 0;
				}
			}
			$col = $u->itemsX($itm['id']);	
			if($col>0){
				$shpCena = $shpCena*$col;
			}
			if($shpCena<0){
				$shpCena = 0;
			}
			$upd2 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			if($upd2){
				if($col>1){
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id`="'.$itm['item_id'].'" AND `uid`="'.$itm['uid'].'" AND `inGroup` = "'.$itm['inGroup'].'" LIMIT '.$col.'');	
				}
				$u->info['money2'] += $shpCena;
				$upd = mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if($upd){
					mysql_query('INSERT INTO `ekr_sale` (`uid`,`time`,`money2`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($shpCena).'")');
					$u->info['catch'] += $shpCena;
					mysql_query('UPDATE `users` SET `catch` = "'.$u->info['catch'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$error = 'Вы успешно продали предмет &quot;'.$itm['name'].' [x'.$col.']&quot; за '.$shpCena.' екр.';
					mysql_query('UPDATE `items_users` SET `inGroup` = "0",`delete` = "'.time().'" WHERE `inGroup` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$itm['group_max'].'');
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' екр.</B>.',time(),$u->info['city'],'System.Ekrshop',0,$shpCena);
				}else{
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' екр.</B> (кредиты не переведены).',time(),$u->info['city'],'System.Ekrshop',0,0);
					$error = 'Не удалось продать предмет...';
				}
			}else{
				$error = 'Не удалось продать предмет...';
			}
		}else{
			$error = 'Предмет не найден в инвентаре.';
		}
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	<script type="text/javascript">
	function AddCount(name, txt){
		document.getElementById("hint4").innerHTML = '<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor="#CCC3AA"><tr><td align=center><B>Купить неск. штук</td><td width=20 align=right valign=top style="cursor: pointer" onclick="closehint3();"><BIG><B>x</TD></tr><tr><td colspan=2>'+
		'<form method=post><table border=0 width=100% cellspacing=0 cellpadding=0 bgcolor="#FFF6DD"><tr><INPUT TYPE="hidden" name="set" value="'+name+'"><td colspan=2 align=center><B><I>'+txt+'</td></tr><tr><td width=80% align=right>'+
		'Количество (шт.) <INPUT TYPE="text" NAME="count" id=count size=4></td><td width=20%>&nbsp;<INPUT TYPE="submit" value=" »» ">'+
		'</TD></TR></form></TABLE></td></tr></table>';
		document.getElementById("hint4").style.visibility = 'visible';
		document.getElementById("hint4").style.left = '100px';
		document.getElementById("hint4").style.top = '100px';
		document.getElementById("count").focus();
	}
	function closehint3() {
	document.getElementById('hint4').style.visibility='hidden';
	Hint3Name='';
	}	
	</script>
	<style type="text/css"> 
	
	.pH3			{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	.class_ {
		font-weight: bold;
		color: #C5C5C5;
		cursor:pointer;
	}
	.class_st {
		font-weight: bold;
		color: #659BA3;
		cursor:pointer;
	}
	.class__ {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
	}
	.class__st {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
		font-size: 10px;
	}
	.class_old {
		font-weight: bold;
		color: #919191;
		cursor:pointer;
	}
	.class__old {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #838383;
		font-size: 10px;
	}
	
</style>

	<TABLE width="100%" cellspacing="0" cellpadding="0" style="font-size:9pt;">
	<tr><td valign="top"><div style="margin-top: 5px;" align="center" class="pH3"><? echo $u->room['name']; ?></div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<br />
	<TABLE width="100%" cellspacing="0" cellpadding="4">
	<TR>
	<form name="F1" method="post">
	<TD valign="top" align="left">
	<!--Магазин-->
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>
	<tr>
	<td align="center" height="21">
	<?php 
		/*названия разделов (сверху)*/
		if(!isset($_GET['sale']) && !isset($_GET['gifts']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>Отдел&nbsp;&quot;Оружие: кинжалы,ножи&quot;</b>',
				2=>'<b>Отдел&nbsp;&quot;Оружие: топоры&quot;</b>',
				3=>'<b>Отдел&nbsp;&quot;Оружие: дубины,булавы&quot;</b>',
				4=>'<b>Отдел&nbsp;&quot;Оружие: мечи&quot;</b>',
				5=>'<b>Отдел&nbsp;&quot;Оружие: магические посохи&quot;</b>',
				6=>'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',
				7=>'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',
				8=>'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',
				28=>'<b>Отдел&nbsp;&quot;Одежда: плащи&quot;</b>',
				9=>'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',
				10=>'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',
				11=>'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',
				12=>'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',
				13=>'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',
				14=>'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',
				15=>'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',
				16=>'<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',
				17=>'<b>Отдел&nbsp;&quot;Ювелирные товары: ожерелья&quot;</b>',
				18=>'<b>Отдел&nbsp;&quot;Ювелирные товары: кольца&quot;</b>',
				19=>'<b>Отдел&nbsp;&quot;Заклинания: нейтральные&quot;</b>',
				20=>'<b>Отдел&nbsp;&quot;Заклинания: боевые и защитные&quot;</b>',
				37=>'<b>Отдел&nbsp;&quot;Заклинания: исцеляющие&quot;</b>',
				38=>'<b>Отдел&nbsp;&quot;Заклинания: манящие&quot;</b>',
				56=>'<b>Отдел&nbsp;&quot;Заклинания: тактические&quot;</b>',
				51=>'<b>Отдел&nbsp;&quot;&quot;</b>',
				52=>'<b>Отдел&nbsp;&quot;Чарки&quot;</b>',
				53=>'<b>Отдел&nbsp;&quot;Книги&quot;</b>',
				21=>'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',
				22=>'<b>Отдел&nbsp;&quot;Эликсиры&quot;</b>',
				32=>'<b>Отдел&nbsp;&quot;Дополнительно:Руны&quot;</b>',
				25=>'<b>Отдел&nbsp;&quot;Открытки&quot;</b>',
				29=>'<b>Отдел&nbsp;&quot;Капюшоны&quot;</b>',
				33=>'<b>Отдел&nbsp;&quot;Дополнительно: Чарки&quot;</b>',
				34=>'<b>Отдел&nbsp;&quot;Сувениры: Упаковка&quot;</b>',
				35=>'<b>Отдел&nbsp;&quot;Дополнительно:Книги&quot;</b>',
				36=>'<b>Отдел&nbsp;&quot;Сундуки&quot;</b>',
				39=>'<b>Отдел&nbsp;&quot;Дополнительно:Благословение&quot;</b>',
				40=>'<b>Отдел&nbsp;&quot;Дополнительно:Тактические&quot;</b>',
				41=>'<b>Отдел&nbsp;&quot;Дополнительно:Усиление оружий&quot;</b>',

				54=>'<b>Отдел&nbsp;&quot;Чеки&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}
			
		} elseif (isset($_GET['sale'])) 
		{
			echo '<B>Отдел&nbsp;&quot;Продажа предметов&quot;</B>';	
		}
	?>
	</tr>
	<tr><td>
	<!--Рюкзак / Прилавок-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
	<?php if(isset($_GET['gifts'])) { ?>
		<tr><td bgcolor="#D5D5D5">
		Вы можете сделать подарок дорогому человеку. Ваш подарок будет отображаться в информации о персонаже.
		<OL>
		<LI>Укажите логин персонажа, которому хотите сделать подарок<BR>
		Логин
		  <INPUT TYPE=text NAME=to_login value="">
		<LI>Цель подарка. Будет отображаться в информации о персонаже (не более 60 символов)<BR>
		<INPUT TYPE=text NAME=podarok2 value="" maxlength=60 size=50>
		<LI>Выберите, от чьего имени подарок:<BR>
		<INPUT TYPE=radio NAME=from value=0 checked> <B><?=$u->info['login']?></B> [<?=$u->info['level']?>]<BR>
		<INPUT TYPE=radio NAME=from value=1 > анонимно<BR>
		<? if($u->info['clan']>0){ ?><INPUT TYPE=radio NAME=from value=2 > от имени клана<BR><? } ?>
		<LI>Нажмите кнопку <B>Подарить</B> под предметом, который хотите преподнести в подарок:<BR>
		</OL>
		<input name="itemgift" id="itemgift" type="hidden" value="0" />
		</td></tr>
    <?php }if(isset($_GET['gifts'])){
			$htmlg2 = '';			
			$sp = mysql_query('SELECT * FROM `users_gifts` WHERE `uid` = "'.$u->info['id'].'"');
			while( $pl = mysql_fetch_array($sp) )
			{
				$itmg2 = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="center" style="border-right:#A5A5A5 1px solid; padding:5px;">'.
					'<img style="padding-bottom:5px;" src="//img.testcombats.ru/i/items/'.$pl['img'].'"><br>'.
					'<input onClick="document.getElementById(\'itemgift\').value='.(10+$pl['id']).';document.F1.submit();" type="button" value="Подарить за '.$pl['money'].' кр.">'.
				'</td><td align="left" valign="top" style="border-right:#A5A5A5 1px solid; padding:5px;">'.
					'<a href="//testcombats.ru/item/0">'.$pl['name'].'</a> &nbsp; (Масса: 1)<br>Долговечность: 0/1<br>'.
					'<small><b>Описание:</b><br>Это именной подарок, его можете подарить только Вы.<br>Сделано в Capital city</small>'.
				'</td></tr></table>';
				$htmlg2 .= '<tr><td align="center" bgcolor="#e2e0e0">'.$itmg2.'</td></tr>';
			}			
			if( $htmlg2 != '' ) {
				echo '<tr><td align="center" bgcolor="#e2e0e0"><h3>Уникальные подарки</h3>' . $htmlg2 . '</td></tr>';
				echo '<tr><td align="center" bgcolor="#e2e0e0"><h3>Стандартные подарки</h3></td></tr>';
			}
			unset($htmlg2,$itmg2);
            
			$itmAll = $u->genInv(3,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND (`im`.`type` = "38") AND (`iu`.`gift` = "" OR (`iu`.`data` LIKE "%|zazuby=%" AND `iu`.`gift` = 1)) ORDER BY `lastUPD` DESC');
			if($itmAll[0]==0){
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">У вас нет подходящих предметов</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
            
			echo $itmAllSee;
			
		}elseif(isset($_GET['sale'])) {
			$itmAll = $u->genInv(16,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `im`.`price2` > 0 AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
			if($itmAll[0]==0)
			{
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
			echo '<tr><td align="center" bgcolor="#e2e0e0"><small>Продажа предметов купленных за екр. осуществляется с учетом износа предмета, а так-же налога на продажу.<br><b>Магазин принимает обмундирование за 100% от их стоимости.<br><font color=red><b>Внимание!</b></font> Все улучшения, заточки, руны, зачарования предметов не входят в стоимость предмета при продаже! </small></td></tr>'.$itmAllSee;
		}else{
			//Выводим вещи в магазине для покупки
			$u->shopItems($sid);?>
<?php }	?>
	</TABLE>	 
	</TD></TR>
	</TABLE>
    <div align="center">
    </div></TD>
	</FORM>
	</TR>
	</TABLE>	
	<td width="280" valign="top">
    <TABLE cellspacing="0" cellpadding="0"><TD width="100%">&nbsp;</TD><TD>
	<table  border="0" cellpadding="0" cellspacing="0">
	<tr align="right" valign="top">
	<td>
	<!-- -->
	<? echo $goLis; ?>
	<!-- -->
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td nowrap="nowrap">
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
	<tr>
	<td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.11&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.11',1); ?>">Страшилкина улица</a></td>
	</tr>

	<tr>
	<td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.298&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.298',1); ?>">Артефактный магазин</a></td>
	</tr>

	<tr>
	<td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.673&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.673',1); ?>">Прилавок Забытых</a></td>
	</tr>

	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br />
      <div align="left"><small>
      Масса: <b><?=$u->aves['now']?>/<?=$u->aves['max']?></b><br>
	У вас в наличии : <b><?php echo round($u->info['money'],2); ?></b> кр.<br />
	  У вас в наличии : <b style="font-size:8pt;color:#339900;"><font color="darkgreen"><?php echo round($u->info['money2'],2); ?></b></font> екр.</small><br>
      
	<?php
	//if($u->info['admin']>0) {
		if($sale_ekr == true) {
			if(!isset($_GET['sale'])){ 
				echo '<INPUT TYPE="button" value="Продать вещи" onclick="location=\'?otdel='.$_GET['otdel'].'&sale=1\'">&nbsp;';
			} else {
				echo '<INPUT TYPE="button" value="Купить вещи" onclick="location=\'?otdel='.$_GET['otdel'].'\'">&nbsp;';
			}
		
		}
	//}
	?>
    <INPUT TYPE="button" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';">
    
    <BR>
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (1=>'&nbsp;&nbsp;Кинжалы,ножи',
2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Топоры',
3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дубины,булавы',
4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Мечи',
5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Магические посохи',
6=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сапоги',
7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Перчатки',
8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Рубахи и футболки',
9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Легкая броня',
10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Тяжелая броня',
11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Шлемы',
12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Наручи',
13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Пояса',
14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Поножи',
15=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Щиты',
16=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Серьги',
17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ожерелья',
18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Кольца',
19=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Нейтральные',
20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Боевые и защитные',
21=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Амуниция',
22=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Эликсиры',
23=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Подарки',
24=>'',
25=>'',
26=>'',
27=>'',
28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Плащи', 
29=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Капюшоны',
30=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Еда',
31=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Чеки',
32=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Руны',
33=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Чарки',
34=>'',
35=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Книги',
36=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сундуки',
37=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Исцеляющие',
38=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Манящие',
39=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Благословение',
40=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Тактические',
41=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Усиления');




		$i=1;
		while ($i!=-1)
		{
			if(isset($otdels_array[$i]))
			{
				if(isset($_GET['otdel']) && $_GET['otdel']==$i) 
				{
				$color = 'C7C7C7';	
				} else {
				$color = 'e2e0e0';
				}
				if($i == 1) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/1.png"><b>Оружие:</b></div>';
			} elseif($i == 6) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/2.png"><b><b>Одежда:</b></div>';
			} elseif($i == 15) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/3.png"> <b><b>Щиты:</b></div>';
			} elseif($i == 16) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/4.png"> <b><b>Ювелирные товары:</b></div>';
			} elseif($i == 19) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/6.png"> <b><b>Заклинания:</b></div>';
			} elseif($i == 21) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/7.png"> <b><b>Амуниция:</b></div>';
			} elseif($i == 22) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/5.png"> <b><b>Эликсиры:</b></div>';
			} elseif($i == 23) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/8.png"> <b><b>Подарки:</b></div>';
			} elseif($i == 28) {
			  echo '<div class="shop_menu_txt"><div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/9.png"> <b><b>Дополнительно:</b></div>';
			}
			echo '
			<A HREF="?otdel='.$i.'"><DIV style="background-color: #'.$color.'">
			'.$otdels_array[$i].'
			</A></DIV>
			';
			} else {
			$i = -2;
			}
			$i++;
		}
		
		if(isset($_GET['gifts'])) 
		{
			$color = 'C7C7C7';	
		}else{
			$color = 'e2e0e0';	
		}
		echo '<A HREF="?otdel=4&gifts=1"><DIV style="background-color: #'.$color.'">Сделать подарки</A></DIV>';
	} ?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>