<style>
.pay td {
	width:50px;
}
.pay td img{
	display:block;
	margin:1px 0 0 0;
}
.pay td:hover img{
	margin:0 0 1px 0;
}
.pay td:hover img {
	filter:progid:DXImageTransform.Microsoft.Alpha(opacity=80); /* IE 5.5+*/
	-moz-opacity: 0.8; /* Mozilla 1.6 и ниже */
	-khtml-opacity: 0.8; /* Konqueror 3.1, Safari 1.1 */
	opacity: 0.8; /* CSS3 - Mozilla 1.7b +, Firefox 0.9 +, Safari 1.2+, Opera 9 */
	cursor:pointer;
}
.bright{
text-align: center;
background:#e0e0e0;
border:1px solid #AEAEAE;
}
.radius {
border-radius: 8px;
  box-shadow: 1.5px 1.5px 0px 0px #eaeaea;
	
}
</style>
<link href="/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr>
<td>
    <td width="80%" valign="top">
	<?php
if(!defined('GAME'))
{
 die();
}
//id Новогоднего подарка
$pidid = 4008;

$dy = (date('n')==12 ? 1 : 0);
$dt = date('Y') + $dy;

if($u->room['file']=='cc/elka')
{
	if(isset($_GET['take_gift']) && date('m') == 12)
	{
		//получаем свой новогодний подарок за текущий год addItem($id,$uid)
		$smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "take_gift_'.$dt.'" LIMIT 1',1);
		if(!isset($smt['id']))
		{
			$pid = $u->addItem($pidid, $u->info['id']);
		
			if($pid>0)
			{
				mysql_query('UPDATE `items_users` SET `gift` = "Администрация",`gtxt1` = "Поздравляем Вас с Новым Годом!" WHERE `id` = "'.$pid.'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
				$u->addAction(time(),'take_gift_'.$dt.'',$u->info['city']);
				echo '<font color=red>Предмет находится у Вас в инвентаре, в разделе "Прочее".</font>';
			}else{
				echo '<font color=red>Не удалось получить подарок...</font>';
			}
		}else{
			echo '<font color=red>Вы уже получили свой подарок ;)</font>';
		}
	}elseif(isset($_GET['del']))
	{
	  if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4))
	  {
		if($u->info['admin']==0)
		{
		  $pInfo = ''.$u->info['align'].'|'.$u->info['clan'].'|'.$u->info['login'].'|'.$u->info['level'].'|'.$u->info['cityreg'].'';
		}else{
		  $pInfo = '1';
		}
		mysql_query("UPDATE `elka` SET `delete`='".$pInfo."' WHERE `id`='".mysql_real_escape_string($_GET['del'])."'");
	  }
	}
	elseif(isset($_GET['use_cup']))
	{
		$smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "use_cupNewYear" LIMIT 1',1);
		if(!isset($smt['id']))
		{
			$u->addAction(time(),'use_cupNewYear','');
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->stats['hpAll'].'",`mpNow` = "'.$u->stats['mpAll'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			echo '<font color=red>Вами было успешно загадано желание. Вы востановили HP.</font>';
		}
	}elseif(isset($_POST['message']))
	{
	  $_POST['message'] = htmlspecialchars($_POST['message'],NULL,'cp1251');
	  if($_POST['message']!='')
	  {
	   $dy = 1;
	   if((date('n',time())==1 && date('j',time())<=15))
	   {
		 $dy = 0;
	   }
	   $u->info['ET'] = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "send_elka" LIMIT 1',1);
	   if(isset($u->info['ET']['id']))
	   {
		 echo '<font color=red>Оставлять надписи на стволе ёлки можно не чаще одного раза в 10 минут</font>';
	   }else{
			$pInfo = ''.$u->info['align'].'|'.$u->info['clan'].'|'.$u->info['login'].'|'.$u->info['level'].'|'.$u->info['cityreg'].'|'.$u->info['id'].'';
			mysql_query("INSERT INTO `elka` (`year`,`time`,`pers`,`text`,`city`) VALUES (".(date('Y',time())+$dy).",".time().",'".$pInfo."','".mysql_real_escape_string($_POST['message'])."','".$u->info['city']."'); ");
			$u->addAction(time(),'send_elka','');
		}
	  }
	}
	
	?><FIELDSET  class="radius"style=" padding: 10px; padding-bottom:10px; margin-right: 15px; font-size:8pt;"><LEGEND style='font-weight:bold; color:#8F0000;'>Посетители оставили надписи на стволе елки:</LEGEND>
	<?
	}
	if(isset($_GET['page']))
	{
	 $fpage = round($_GET['page']);
	 if($fpage<=0)
	 {
	   $fpage = 1;
	 }
	}else{
	 $fpage = 1;
	}
	$limit1 = ($fpage-1)*20+$fpage-1;
	$limit2 = 21;
	
			  $i = mysql_fetch_array(mysql_query('SELECT COUNT(`year`) FROM `elka` WHERE `year` = "'.$dt.'" AND (`delete` = "0" OR '.$u->info['admin'].' > 0) ORDER BY `id` DESC'));
			  $i = $i[0];
			  $d = ceil($i/21);
			  if($i>0)
			  {
			   if($d<13)
			   {
				$j=0;
				$pagesN = '';
				while($i>=0)
				{
				  $i -= 21;
				  if($i!=0)
				  {			  
				   $j++;
				   $r2 = '';
				   if($j<=$d)
				   {
					if(isset($r))
					{
					  $r2 = '&r='.$r;
					}
					//$jt = $j;
					if($fpage==$j) $pagesN .= '<span class="number" style="font-size: 10.04pt;">'.$j.'</span>';
					else $pagesN .= ' <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$j.'" title="Перейти на страницу №'.$j.'">'.$j.'</a> ';
				   }
				  }
				}
				$pages .= ' '.$pagesN.' ';
			   }else{
				$j = $fpage-6;
				$i = 0;
				$pagesN = '';
				while($k<13)
				{
				 if($j>0)
				 {
				  if($j<=$d)
				  {
				   $jt = $j;
				   if($fpage==$j)
				   {
					 $jt = '<span class="number">'.$j.'</span>';
				   }
				   $pagesN .= ' <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$j.'" title="Перейти на страницу №'.$j.'">'.$jt.'</a> ';
				  }
				  $k++;
				 }
				 $j++;
				}
				$prpage = $fpage-12;
				$nxpage = $fpage+12;
				if($prpage<=0)
				{
				  $prpage = 1;
				}
				if($nxpage>$d)
				{
				  $nxpage = $d;
				}
				$_GET['d'] = (int)$_GET['d'];
				if($fpage-7>0)
				{
				 $pages .= '<a href="?id='.$post['id'].'&d='.$_GET['d'].'&page=1" title="Первая страница">«</a> <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$prpage.'" title="Показать предыдущие страницы">...</a> ';
				}
				$pages .= ' '.$pagesN.' ';
				if($fpage<$d-5)
				{
				 $pages .= '<a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$nxpage.'" title="Показать следующие страницы">...</a> <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$d.'" title="Последняя страница">»</a>';
				}
			   }		   
			  }else{
				$pages = '';
			  }
	?>
    <div style="padding:5px;">
	<?
	$sp = mysql_query('SELECT * FROM `elka` WHERE `year`="'.$dt.'" AND `city`="'.$u->info['city'].'" AND (`delete` = "0" OR '.$u->info['admin'].' > 0) ORDER BY `time` DESC LIMIT '.$limit1.','.$limit2.'');
	$page = floor((int)$_POST['page']);
	if($page<1){ $page = 1; }elseif($page>300){ $page==300; }
	while($pl = mysql_fetch_array($sp))
	{
	  $prs = explode('|',$pl['pers']); $pers = '';
	  if($prs[0]!=0)
	  {
		$pers .= '<img src="//img.testcombats.ru/i/align/align'.$prs[0].'.gif">';
	  }
	  if($prs[1]!=0)
	  {
		$clanPrs = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`="'.$prs[1].'" LIMIT 1'));
		$pers .= '<img src="//img.testcombats.ru/i/clan/'.$clanPrs['name_mini'].'.gif">';
	  }
	  $pers .= '<b>'.$prs[2].'</b>['.$prs[3].']<a href="//testcombats.ru/info/'.$prs[5].'" title="Инф. о '.$prs[2].'" target="blank"><img src="//img.testcombats.ru/i/inf_'.$prs[4].'.gif"></a>';
	  if($pl['delete']!='0')
	  {
		if($pl['delete']=='1')
		{
		  if($u->info['admin']>0)
		  {
			$pl['text'] = '<font color=red><i>Сообщение стерто</i></font> <font color=grey><small>('.$pl['text'].')</small></font>';
		  }else{
		   $pl['text'] = '<font color=red><i>Сообщение стерто</i></font>';
		  }
		}else{
	  $prs = explode('|',$pl['delete']); $pers2 = '';
	  if($prs[0]!=0)
	  {
		$pers2 .= '<img src="//img.testcombats.ru/i/align/align'.$prs[0].'.gif">';
	  }
	  if($prs[1]!=0)
	  {
		$clanPrs = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`="'.$prs[1].'" LIMIT 1'));
		$pers2 .= '<img src="//img.testcombats.ru/i/clan/'.$clanPrs['img'].'.gif">';
	  }
	  $pers2 .= '<a href="javascript:top.toUser(\''.$prs[2].'\',\'private\');"><b>'.$prs[2].'</b></a>['.$prs[3].']<a href="//testcombats.ru/info/'.$prs[2].'" title="Инф. о '.$prs[2].'" target="blank"><img src="//img.testcombats.ru/i/inf_'.$prs[4].'.gif"></a>';
	  
		  if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4))
		  {
			$pl['text'] = '<i><font color=red>Сообщение стерто персонажем</font> '.$pers2.'</i> <font color=grey><small>('.$pl['text'].')</small></font>';
		  }else{
		   $pl['text'] = '<i><font color=red>Сообщение стерто персонажем</font> '.$pers2.'</i>';
		  }
		}
	  }
	  if(($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)) && $pl['delete']=='0')
	  {
		$dl = ' <a href="main.php?page='.$_POST['page'].'&del='.$pl['id'].'"><small>Стереть</small></a>';
	  }else{
		$dl = '';
	  }
	  echo '<font class=date>'.date('d.m.Y H:i',$pl['time']).'</font> '.$pers.' - '.$pl['text'].''.$dl.'<BR>';
	}

	if($pages) echo '<p>Страницы: '.$pages.'</p>';

	if($u->info['level']>8 && date('m') == 12)
	{
	?>
  	<FORM method="post" action="main.php">
	 <b>Оставить сообщение:</b>
	 <input type="text" name="message" maxlength="150" size="150" style="width: 60%;">&nbsp;
	 <INPUT type="submit" name="addmessage" value='Добавить'>
	</FORM>
	<? } else echo '<p><font color=red>Оставлять сообщения на стволе Елки можно до Нового Года, игрокам с 9 уровня.</font></p>';?>


    </td></FIELDSET>
    <td valign="top">
	<div align="right">
	
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">	
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
						<div style="position:relative; cursor: pointer; width: 500px;" id="ione"><img src="//img.testcombats.ru/loca/leg_loc/cp/elca_loca.jpg" id="img_ione" width="500" height="268"  border="1"/>
						<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:250px;"> 
                         <? echo $tattack; ?>
                          &nbsp;
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						 <span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						 <span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/capitalcity.gif" oncontextmenu="return false;">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;
						</div>
						<div style="position: absolute; left: 20px; top: 145px; width: 44px; height: 64px; z-index: 91;"><img  onclick="location='main.php?loc=1.180.0.209&amp;rnd=<? echo $code; ?>';" <?php thisInfRm('1.180.0.209'); ?> src="//img.testcombats.ru/loca/leg_loc/cp/icegl.png" width="139" height="68"  class="aFilter" /></div>
						<div style="position: absolute; left:435px; top: 184px; width: 46px; height: 52px; z-index: 91;"><img  onclick="location='main.php?loc=1.180.0.9&amp;rnd=<? echo $code; ?>';" <?php thisInfRm('1.180.0.9'); ?> src="//img.testcombats.ru/loca/leg_loc/cp/city.png" width="46" height="52"  class="aFilter" /></div>
						<div style="position: absolute; left: 145px; top: 98px; width: 98px; height: 148px; z-index: 94;"><img onclick="location.href='main.php?talk=35'" src="//img.testcombats.ru/loca/leg_loc/cp/dedmoroz.png" width="98" height="148" class="aFilter" title="Диалог с Дедом Морозом" /></div>
						<div style="position:absolute; left:317px; top:18px; width:120px; height:35px; z-index:90;">  	
						
	<?
	$sg = 1;
	//Если есть подарки		
	if((date('n',time())==12 || date('n',time())<=2) && $sg==1)
	{
	?>
	<?
    $smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "use_cupNewYear" LIMIT 1',1);
	?>
	    <a href="?use_cup=<? echo $code; ?>" <? if(isset($smt['id'])){ echo 'onClick="alert(\'Использовать желание можно не чаще одного раза в 10 минут\');return false;"'; } ?> /><img style="width: 40px;" src="//img.testcombats.ru/loca/leg_loc/cp/star.png" class="aFilter" <? if(isset($smt['id'])){ echo 'filter: alpha(opacity=35); -moz-opacity: 0.35; -khtml-opacity: 0.35; opacity: 0.35;'; } ?> title="Загадать Желание" ></a>
	</div>
	<div style="position:absolute; left:300px; top:159px; width:120px; height:35px; z-index:90;">
		<? 
			if( date('m') == 12 ) {
				$pd = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "take_gift'.$dt.'" LIMIT 1',1);
		?>
			<a href="?take_gift=<? echo $code; ?>" <? if(isset($pd['id'])){ echo 'onClick="return false;"'; } ?> /><img src="//img.testcombats.ru/loca/leg_loc/cp/gift.png" style="padding:10px; width: 85px;<? if(isset($pd['id'])){ echo 'filter: alpha(opacity=35); -moz-opacity: 0.35; -khtml-opacity: 0.35; opacity: 0.35;'; } ?>" title="Новогодний подарок" class="aFilter" ></a>
		<? } ?>
	</div>
                        <div id="snow"></div>
                        <?php echo $goline; ?>
                      </div>
					</div>
                    </td>
                  </tr>
                </table> 
				
               <div style="display:none; height:0px " id="moveto"></div> 
			<div align="right" valign="top">
			<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.209'); ?>>Ледяная Пещера</a></span>
			<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.9'); ?>>Центральная площадь</a></span>
			</div>				
			</td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table>
      	<small>
       <div style="width: 500px;">
      	<small style="smaller">
        <HR class="line" height="1px" align="right">
		<small>
            <b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на
            халяву". Пароль не нужен ни
            паладинам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br>
            <i>Администрация.</i></small>
      </div>
        
      </div></td>
  </tr>
</table>
	<div id="textgo" style="visibility:hidden;"></div>						  
<?
}
?>