<?
if(!defined('GAME')){
	die();
}

if($u->room['file']=='moon/buyticket'){

	$zd = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` >= '.time().' AND `vars` = "teleport" LIMIT 1',1);
	
	if(isset($_GET['teleport']))
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

.fade {
  opacity: 0.6;
}

.fade:hover {
  opacity: 1.0;
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
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="//img.testcombats.ru/city/mooncity/mpng/mvokzal.jpg" id="img_ione" width="500" height="240"  border="1"/>
					<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:223px;"> 
                      
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						 <span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						 <span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/mooncity.gif">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;</div>
						 
						
                     	<div style="position:absolute; left:45px; top:26px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=17" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/angelscity.gif" width="50" height="50" title="Отправиться в Angels City" class="aFilter" /></a>'; ?></div>
						
						<div style="position:absolute; left:115px; top:26px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=16" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/capitalcity.gif" width="50" height="50" title="Отправиться в Capital City" class="aFilter"/></a>'; ?></div>
						<div style="position:absolute; left:185px; top:26px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=18" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/demonscity.gif" width="50" height="50" title="Отправиться в Demons City" class="aFilter"/></a>'; ?></div>
						
						
					 	<div style="position:absolute; left:257px; top:26px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=19" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/sandcity.gif" width="50" height="50" title="Отправиться в Sand City" class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:400px; top:26px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=20" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/suncity.gif" width="50" height="50" title="Отправиться в Sun City" class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:329px; top:26px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=21" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/devilscity.gif" width="50" height="50" title="Отправиться в Devils City" class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:118px; top:140px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=21" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/emeraldscity.gif" width="50" height="50" title="Отправиться в Emeralds City" class="aFilter"/></a>'; ?></div>
						<div style="position:absolute; left:186px; top:140px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="?teleport=22" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/abadonedplain.gif" width="50" height="50" title="Отправиться в Abadoned City" class="aFilter"/></a>'; ?></div>
						<div style="position:absolute; left:257px; top:140px; width:50px; height:50px; z-index:90;" class="fade"><img src="//img.testcombats.ru/city/mooncity/mpng/port3.gif" width="50" height="50" title="" class="aFilter"/></div>
						<div style="position:absolute; left:332px; top:140px; width:50px; height:50px; z-index:90;" class="fade"><img src="//img.testcombats.ru/city/mooncity/mpng/port4.gif" width="50" height="50" title="" class="aFilter"/></div>
					 	<div style="position:absolute; left:434px; top:150px; width:35px; height:59px; z-index:90;"><img <? thisInfRm('12.180.0.603'); ?> src="//img.testcombats.ru/city/mooncity/mpng/vokzal.gif" width="35" height="59" title="" class="aFilter"/></div>
                      
						
					  
                      <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    </td>
                  </tr>
                </table> 

				<div style="width:500px; text-align:right; background-color:#D3D3D3;">
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('12.180.0.665'); ?>>Портал</a></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('12.180.0.603'); ?>>Вокзал</a></span>
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
<?php
}