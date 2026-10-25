<?
if(!defined('GAME')){
	die();
}

if($u->room['file']=='dem/vokzal'){

if($magic->testTravma( $u->info['id'] , 4 )) $nTravma = 1;
else $nTravma  = 0;
if($nTravma) $re = 'У вас неизлечимая травма! Вы не можете посещать Вокзал.';

$zd = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` >= '.time().' AND `vars` = "teleport" LIMIT 1',1);
	
	if(isset($_GET['teleport']) && !isset($zd['id']))
	{
		$tp = mysql_fetch_array(mysql_query('SELECT * FROM `teleport` WHERE `city` = "'.$u->info['city'].'" AND `cancel` = "0" AND `id` = "'.((int)$_GET['teleport']).'" LIMIT 1'));
		if(isset($tp['id']))
		{
			if($u->info['money']>=$tp['price1'])
			{
				$rm = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `name` = "Вокзал" AND `city` = "'.$tp['toCity'].'" LIMIT 1'));
				if(isset($rm['id']))
				{
					$u->info['money'] -= $tp['price1'];
					$u->info['city'] = $tp['toCity'];
					mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'",`city` = "'.$u->info['city'].'",`room` = "'.$rm['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					if( $u->stats['vip'] == 3 ) {
						$tp['time'] = round($tp['time']/2);
					}
					$u->addAction((time()+$tp['time']*60),'teleport',$tp['toCity']);
					die('<script>location="main.php";</script>');
				}else{
					$error = 'Нельзя телепортироваться, возможно вокзал в этом городе был разрушен...';
				}
			}else{
				$error = 'У вас недостаточно средсв';
			}
		}else{
			$error = 'Нельзя телепортироваться...';
		}
	}
	/* if ($u->info['vip'] == 3 ) {
	$tportal = '<img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" onclick="location=main.php?loc=12.180.0.665" class="menutop">Портал</a>';
	}

	if ($u->info['vip'] == 3 ) {
	$tportal2 = '<img src="//img.testcombats.ru/city/mooncity/mpng/vok_teleport.gif" width="35" height="59" title="" class="aFilter" />';
	} */
?>
<style>
.line {
    border-bottom-style: inset;
    border-bottom-width: 1px;
    border-collapse: separate;
    border-left-style: inset;
    border-left-width: 1px;
    border-right-style: inset;
    border-right-width: 1px;
    border-top-style: inset;
    border-top-width: 1px;
    color: rgb(0, 0, 0);
    display: block;
    font-family: Verdana, Arial, Helvetica, Tahoma, sans-serif;
    font-size: 13px;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    height: 1px;
    line-height: normal;
    text-align: start;
    white-space: normal;
    display: block;
-webkit-margin-before: 0.5em;
-webkit-margin-after: 0.5em;
-webkit-margin-start: auto;
-webkit-margin-end: auto;
border-style: inset;
border-width: 1px;
}
</style>

<script type="text/javascript" src="/js/jquery.locations.js"></script>
<link href="/css/fightclub.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;padding-left: 4px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <? if($u->error!=''){ echo '<font color="red"><b>'.$u->error.'</b></font>'; } ?>
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
				<table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td id="ViewLocation">
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="//img.testcombats.ru/city/mooncity/mpng/vok_3_main.jpg" id="img_ione" width="500" height="240"  border="1" oncontextmenu="return false;"/>
					<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:223px;"> 
                      
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						 <span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						 <span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/demonscity.gif" oncontextmenu="return false;">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;</div>
					 
                      <?php
						if(!$nTravma)
						{
						?>
						
						<div style="position:absolute; left:29px; top:70px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=37" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/mooncity.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Moon City за 10 кр." class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:79px; top:70px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=31" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/angelscity.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Angels City за 10 кр." class="aFilter" /></a>'; ?></div>
						
						
						<div style="position:absolute; left:129px; top:70px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=8" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/capitalcity.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Capital City за 10 кр" class="aFilter"/></a>'; ?></div>
						
						
					 	<div style="position:absolute; left:179px; top:70px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=32" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/sandcity.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Sand City за 10 кр." class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:29px; top:120px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=33" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/suncity.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Sun City за 10 кр." class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:79px; top:120px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=34" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/devilscity.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Devils City за 25 кр." class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:129px; top:120px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=35" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/emeraldscity.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Emeralds City за 25 кр." class="aFilter"/></a>'; ?></div>
						<div style="position:absolute; left:179px; top:120px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=36" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/abadonedplain.gif" oncontextmenu="return false;" width="40" height="40" title="Отправиться в Abadoned City за 50 кр." class="aFilter"/></a>'; ?></div>
                      
					  <div style="position:absolute; left:235px; top:40px; width:140px; height:169px; z-index:90;"><img src="//img.testcombats.ru/city/mooncity/mpng/vv_3.gif" oncontextmenu="return false;" width="140" height="169" title="Вы находитесь в городе Demons City" class="aFilter" /></div>
					 
					  <div style="position:absolute; left:380px; top:150px; width:35px; height:59px; z-index:90;"><img <? thisInfRm('4.180.0.667'); ?> src="//img.testcombats.ru/city/mooncity/mpng/vok_teleport.gif" oncontextmenu="return false;" width="35" height="59" title="" class="aFilter" /></div>
					  <div style="position:absolute; left:434px; top:150px; width:35px; height:59px; z-index:90;"><img <? thisInfRm('4.180.0.286'); ?> src="//img.testcombats.ru/city/mooncity/mpng/vokzal.gif" oncontextmenu="return false;" width="35" height="59" title="" class="aFilter" /></div>
                      
                      <?php } ?>
					  
					  <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    </td>
                  </tr>
                </table> 

				<div style="width:500px; text-align:right; background-color:#D3D3D3;">
				<span><b style="font-size: 6pt;color: darkred;">Телепортация в другие города<? if(isset($zd['id'])){ echo '&nbsp;(Возможна через '.$u->timeOut($zd['time']-time()).')</b>'; } ?>&nbsp;</b></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.667'); ?>>Портал</a></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.286'); ?>>Центральная площадь</a></span>
				</div>				
              <div style="display:none; height:0px " id="moveto"></div>     
              </td>
          <td>
             
          </td>
        </tr>
      </table>
      	<div style="width: 500px;">
      	<small style="smaller">
        <HR class="line" height="1px" align="right" style="width: 500px;
		display: block;
		unicode-bidi: isolate;
		margin-block-start: 0.5em;
		margin-block-end: 0.5em;
		margin-inline-start: auto;
		margin-inline-end: auto;
		overflow: hidden;
		border-style: inset;
		border-width: 1px;
		height:1px;">
		<small>
            <b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на
            халяву". Пароль не нужен ни
            паладинам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br>
            <i>Администрация.</i></small>
        
      </div></td>
  </tr>
</table>
<?php }