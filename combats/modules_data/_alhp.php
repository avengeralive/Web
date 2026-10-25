<?
if(!defined('GAME'))
{
	die();
}?>
<script type="text/javascript" language="javascript" src='//img.testcombats.ru/js/commoninf.js'></script>
<style>
.modpow {
	background-color:#ddd5bf;
}
.mt {
	background-color:#b1a993;
	padding-left:10px;
	padding-right:10px;
	padding-top:5px;
	padding-bottom:5px;
}
.md {
	padding:10px;
}
</style>
<script>
function openMod(title,dat)
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="Закрыть окно" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
		document.getElementById('moddata').innerHTML = dat;
		d.style.display = '';
	}
}

function closeMod()
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '';
		document.getElementById('moddata').innerHTML = '';
		d.style.display = 'none';
	}
}
</script>
<div id="useMagic" style="display:none; position:absolute; border:solid 1px #776f59; left: 50px; top: 186px;" class="modpow">
<div class="mt" id="modtitle"></div><div class="md" id="moddata"></div></div>
<table align=left></table><table align=right><tr><td><INPUT TYPE="button" onclick="location.href='main.php?alhp=1';" value="Обновить" title="Обновить"> <INPUT TYPE="button" onclick="location.href='main.php';" value="Вернуться" title="Вернуться"></table>

<?
$pl = mysql_fetch_array(mysql_query('SELECT * FROM `bank_table` ORDER BY `time` DESC LIMIT 1'));
$ba = mysql_fetch_array(mysql_query("SELECT * FROM `bank_alh` WHERE `uid` = '".mysql_real_escape_string($u->info['id'])."' LIMIT 1"));
if(isset($ba['id'])) {
?>
<table width=320>
    <tr>
        <td>
			<img src="//img.testcombats.ru/i/alchemy1.gif">
        	<h4>На алхимических счетах:</h4>
            <b><?=$ba['ekr']?></b> Екр.
            <br />
            Задолжность <b><? if($ba['USD'] > 0) { echo $ba['USD']; }else{ echo '0.00'; } ?></b> €
            <hr />       
            <?
			$ucur = round(round(($pl['cur']/100*$pl['USD']),4)/100,2);
			?>     
            Курс: <b>1 €</b>= <b>50 Екр</b>
            <hr />
            <form method="post" action="main.php?alhp=1">
            <?
			if(isset($_POST['buy_ekr'])) {
				$uba = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `id` = "'.mysql_real_escape_string($_POST['buy_ekr']).'" AND `block` = "0" LIMIT 1'));
				if(isset($uba['id'])) {
					echo 'Покупатель: '.$u->microLogin($uba['uid'],1).'<br>';
					echo 'Счет покупателя №'.$uba['id'].'<br>';
					echo 'Бонус покупателя: 0%<br>';
				}else{
					echo '<font color=red>Банковский счет заблокирован, либо не найден.</font><hr>';
					unset($_POST['buy_ekr']);
				}
				echo '<hr>';
				if(isset($uba['id'])) {
					$_POST['buy4ekr'] = round($_POST['buy4ekr'],2);
					if(isset($_POST['buy4ekr']) && $_POST['buy4ekr'] < 1) {
						echo '<font color=red>Минимальная сумма продажи: 1 екр.</font><hr>';
						unset($_POST['buy4ekr']);
					}elseif($_POST['buy4ekr'] > $ba['ekr']) {
						echo '<font color=red>Недостаточно средств на счете</font><hr>';
						unset($_POST['buy4ekr']);
					}
					if(isset($_POST['buygoodluck'])) { 
						echo '<script>alert("Продажа на сумму '.$_POST['buy4ekr'].' екр. была совершена успешно!");location.href="main.php?alhp=1";</script>';
						$ba['ekr'] -= $_POST['buy4ekr'];
						$ba['USD'] += round($_POST['buy4ekr']*$ucur,2);
						mysql_query('UPDATE `bank_alh` SET `ekr` = "'.mysql_real_escape_string($ba['ekr']).'",`USD` = "'.mysql_real_escape_string($ba['USD']).'" WHERE `id` = "'.$ba['id'].'" LIMIT 1');
						mysql_query('UPDATE `bank` SET `moneyBuy` = `moneyBuy` + '.mysql_real_escape_string($_POST['buy4ekr']).',`money2` = `money2` + '.mysql_real_escape_string($_POST['buy4ekr']).' WHERE `id` = "'.$uba['id'].'" LIMIT 1');
						$u->addDelo(788,$uba['uid'],'Банк: получено <b>'.$_POST['buy4ekr'].'</b> екр. от Алхимика <img src=//img.testcombats.ru/i/align/align50.gif width=12 height=15 /><b>'.$u->info['login'].'</b>',time(),'','AlchemistPayment',$ekr,'');
						mysql_query('INSERT INTO `pay_operation` (`uid`,`ekr`,`time`,`good`,`var`,`ref`,`ref2`) VALUES ("'.$uba['id'].'","'.mysql_real_escape_string($_POST['buy4ekr']).'","'.time().'","'.time().'","buy_ekr_alh'.$u->info['id'].'","'.$uba['host_reg'].'","0")');
						
						$money = round($_POST['buy4ekr']*$pl['cur'],2);
						$money = round($money/100*(100-$ba['procent']),2);
						
						$user = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`host_reg` FROM `users` WHERE `id` = "'.mysql_real_escape_string($uba['uid']).'" LIMIT 1'));
						echo '['.$user['host_reg'].']';
						if( $user['host_reg'] > 0 && $_POST['buy4ekr'] >= 1 ) {
							$refer = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`host_reg` FROM `users` WHERE `id` = "'.mysql_real_escape_string($user['host_reg']).'" LIMIT 1'));
							if( isset($refer['id']) ) {
								$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=//img.testcombats.ru/i/align/align50.gif width=12 height=15 /><u><b>Банк</b> &laquo;Бойцовского клуба&raquo; / Алхимик <b>'.$u->info['login'].'</b></u> сообщает: ';
								if($refer['sex'] == 1) {
									$r .= 'Уважаемая';
								}else{
									$r .= 'Уважаемый';
								}
								$ubaref = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$refer['id'].'" ORDER BY `id` DESC LIMIT 1'));
								if( isset($ubaref['id']) ) {
									mysql_query('UPDATE `bank` SET `money2` = "'.mysql_real_escape_string($ubaref['money2']+round($_POST['buy4ekr']*1,2)).'" WHERE `id` = "'.$ubaref['id'].'" LIMIT 1');
								$u->addDelo(788,$refer['id'],'Персонаж  "'.$refer['login'].'" получил '.round($_POST['buy4ekr']*1,2).' Екр за реферала "'.$user['login'].'".  ',time(),  '','ReferalsPayment',0,0);
								mysql_query('INSERT INTO `pay_operation` (`uid`,`ekr`,`time`,`good`,`var`,`ref`,`ref2`) VALUES ("'.$uba['id'].'","'.mysql_real_escape_string($_POST['buy4ekr']).'","'.time().'","'.time().'","buy_ekr_alh'.$u->info['id'].'","'.$uba['host_reg'].'","0")');
								}
								$r .= ' <b>'.$refer['login'].'</b>, Ваш реферал &quot;'.$user['login'].'&quot; приобрел Екр. и на Ваш банковский счет №'.(0+$ubaref['id']).' зачислено '.round($_POST['buy4ekr']*1,2).' Екр. ';
								mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$refer['city']."','".$refer['room']."','','".$refer['login']."','".$r."','-1','5','0')");
							}
						}
						
						$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=//img.testcombats.ru/i/align/align50.gif width=12 height=15 /><u><b>Банк</b> &laquo;Бойцовского клуба&raquo; / Алхимик <b>'.$u->info['login'].'</b></u> сообщает: ';
						
						if($user['sex'] == 1) {
							$r .= 'Уважаемая';
						}else{
							$r .= 'Уважаемый';
						}
						
						$r .= ' <b>'.$user['login'].'</b>, на Ваш банковский счет №'.$uba['id'].' зачислено '.$_POST['buy4ekr'].' екр. Благодарим Вас за покупку!';
						
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$user['city']."','".$user['room']."','','".$user['login']."','".$r."','-1','5','0')");
												
						$text_msg = 'Алхимик <b>'.$u->info['login'].'</b> совершил продажу <b>'.$_POST['buy4ekr'].'</b> екр. (скидка '.$ba['procent'].'% , задолжность '.$ba['USD'].'$). Покупатель: '.$u->microLogin($uba['uid'],1).'. Банковский счет покупателя: № <b>'.$uba['id'].'</b>.';
						
						$balance = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `balance_money` WHERE `cancel` = 0'));
						$balance = $balance[0]+$money;
						mysql_query('INSERT INTO `balance_money` (`time`,`ip`,`money`,`comment2`,`balance`,`cancel`) VALUES ("'.time().'","'.$u->info['ip'].'","'.mysql_real_escape_string((int)$money).'","'.mysql_real_escape_string($text_msg).'","'.$balance.'","'.time().'")');
						
					}else{
						echo 'Сумма екр.:';
						if(!isset($_POST['buy4ekr'])) {
							echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <input name="buy4ekr" style="width:50px;" value="0.00" /> <input value="Далее" type="submit" /><br>';
						}else{
							echo ' <b>'.round((int)$_POST['buy4ekr'],2).'</b> екр.<input name="buy4ekr" type="hidden" value="'.$_POST['buy4ekr'].'" />';
							echo ' &nbsp; <input type="submit" name="buygoodluck" value="Совершить продажу">';
						}
					}
				}
			}
			?>
            <? if(isset($_POST['buy_ekr'])){ ?><input name="buy_ekr" type="hidden" value="<?=$_POST['buy_ekr']?>" /> <? }else{ ?>Перевести екр. на счет: <input name="buy_ekr" size="50" style="width:78px;" value="<?=$_POST['buy_ekr']?>" /> <input value="Далее" type="submit" /><? } ?>
        	</form>
        </td>
    </tr>
</table>
<?
}

echo "<br><h4><div align=left>Необходимые средства в работе алхимика</div></h4>";

$p['m1'] = 1;
$srok = array(15=>'15 минут',30=>'30 минут',60=>'один час',180=>'три часа',360=>'шесть часов',720=>'двенадцать часов',1440=>'одни сутки',4320=>'трое суток');
		
	if(isset($_GET['usemod']))
	{
		if(isset($_POST['usem1']))
		{
			include('moder/usem1.php');					
		}elseif(isset($_POST['teleport']))
		{
			include('moder/teleport.php');
		}elseif(isset($_POST['usealign7'])) {
			include('moder/usealign7.php');
		}elseif(isset($_POST['usealign3'])) {
			include('moder/usealign3.php');
		}elseif(isset($_POST['usealign1'])) {
			include('moder/usealign1.php');
		}
	}
if(isset($_POST['tologin'],$_POST['message'])) {
  $u->send('',1,$infcity,'',htmlspecialchars($_POST['tologin'],NULL,'cp1251'),'<font color=darkblue>Сообщение телеграфом от </font> <b>'.$u->info['login'].'</b>: '.$_POST['message'].'',-1,6,0,0,0,1);
}
?>

<table>
<a href="#" onClick="openMod('<b>Заклятие молчания</b>','<form action=\'main.php?<? echo alhp.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'30\'>30 минуn</option></select> <input type=\'submit\' name=\'usem1\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/silence30.gif" title="Заклятие молчания" /></a>
&nbsp;
<a onClick="openMod('<b>Телепортация</b>','<form action=\'main.php?<? echo alhp.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\' value=\'<? echo $u->info['login']; ?>\'><br>Город: &nbsp; <select style=\'margin-left:2px;\' name=\'city\'><option value=\'capitalcity\'>capitalcity</option><option value=\'angelscity\'>angelscity</option><option value=\'demonscity\'>demonscity</option><option value=\'devilscity\'>devilscity</option><option value=\'suncity\'>suncity</option><option value=\'emeraldscity\'>emeraldscity</option><option value=\'sandcity\'>sandcity</option><option value=\'mooncity\'>mooncity</option><option value=\'eastcity\'>eastcity</option><option value=\'abandonedplain\'>abandonedplain</option><option value=\'dreamscity\'>dreamscity</option><option value=\'lowcity\'>devilscity</option><option value=\'oldcity\'>devilscity</option><option value=\'newcapitalcity\'>newcapital</option></select> <input type=\'submit\' name=\'teleport\' value=\'Исп-ть\'></form>');" href="#"><img src="//img.testcombats.ru/i/items/teleport.gif" title="Телепортация" /></a>&nbsp;

<a href="#" onclick="openMod('&lt;b&gt;Выдать темную склонность&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usealign3\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button[dark].gif" title="Выдать темную склонность" /></a>&nbsp;

<a href="#" onclick="openMod('&lt;b&gt;Выдать светлую склонность&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usealign1\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button1.gif" title="Выдать светлую склонность" /></a>&nbsp;

<a href="#" onclick="openMod('&lt;b&gt;Выдать нейтральную склонность&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usealign7\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/palbuttonneutralsv3.gif" title="Выдать нейтральную склонность" /></a>&nbsp;

<!--a href="#" onclick="openMod('&lt;b&gt;Сменить логин персонажа&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;<br>Новый логин: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo2\' name=\'logingo2\'&gt;&lt;input type=\'submit\' name=\'uselogin\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/nick.gif" title="Сменить логин персонажа" /></a-->&nbsp;
</table>
<br><h4>Телеграф</h4><!--Вы можете отправить короткое сообщение любому персонажу, даже если он находится в offline или другом городе.-->
<form method=post style="margin:5px;">Логин персонажа <input type=text size=15 name="tologin"> Cообщение <input type=text size=70 name="message" placeholder="Текст сообщения"><input type=submit value="Отправить"></form>

<div style="width:100%" >	
	<div><div><h4>Реклама в чат:</h4></div>	<?

if($u->info['align']=50 || $u->info['admin']==1)
{
    if (isset($_POST['systemM']) && !empty($_POST['systemM']))
	{
        $_POST['sysMes'] = strip_tags($_POST['sysMes']);
        $_POST['sysMes'] = htmlspecialchars($_POST['sysMes']);
        $r .='<font color=red><img src=//img.testcombats.ru/i/align/align50.gif width=12 height=15 /><b>'.$u->info['login'].'</b></font><font color=darkred><i>  '.$_POST['sysMes'].'</i></font>';

		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
		VALUES ('1','capitalcity','','','','".mysql_real_escape_string($r)."','".time()."','0','0')");

        echo "<br><font color=red><b>Системное сообщение отправленно</b></font>";
    }

    echo " <form action='#' method='POST'>";
    echo "<input type='text' class='inps' name='sysMes' size='100'  placeholder='Текст рекламного сообщения'>";
    echo " <input type='submit' name='systemM' value='Отправить'>";
    echo "</form>";


}  

?></div>
</br>


<div style="width:100%" >
	<FIELDSET >
		<LEGEND><h3>Список покупателей:</h3> </LEGEND>
		<div style="padding: 0px 0px 10px 10px;">
<?
$sp = mysql_query('SELECT * FROM `pay_operation` WHERE `good` > 0 AND `var`="buy_ekr_alh'.$u->info['id'].'" GROUP BY `uid`');
while( $pl = mysql_fetch_array($sp) )
{
	$onl = mysql_fetch_array(mysql_query('SELECT `id`,`online` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
	$lg = $u->microLogin($pl['uid'],1);
	//if( $lg != '<b><i>Невидимка</i></b> [??]<a target="_blank" href="https://primebk.ru/info/0"><img src="https://img.primebk.ru/i/inf_capitalcity.gif" /></a>' )
	//{
		if($onl['online'] > time()-240)
		{
			$lg = '<font color=green>'.$lg.'</font>';
		}else{
			$lg .= ' (был тут '.date('d.m.Y H:i',$onl['online']).')';
		}
		if( $u->info['align'] = 50 )
		{
			$sum = mysql_fetch_array(mysql_query('SELECT SUM(`ekr`) FROM `pay_operation` WHERE `good` > 0 AND `uid` = "'.$pl['uid'].'" AND `var`="buy_ekr_alh'.$u->info['id'].'" LIMIT 1'));
			$sum = 0+$sum[0];
			echo $lg.' - '.$sum.' ЕКР.<br>';
		}else{
			echo $lg.'<br>';
		}
	//}
}
?>
</div>
</FIELDSET>
</div>
