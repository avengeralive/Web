<?
if(!defined('GAME')){
	die();
}

if($u->room['file']=='moon/mportal'){

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
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="//img.testcombats.ru/city/mooncity/mpng/vok2_8_main.jpg" id="img_ione" width="500" height="240"  border="1" oncontextmenu="return false;"/>
					<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:223px;"> 
                      
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						 <span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						 <span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/mooncity.gif" oncontextmenu="return false;">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;</div>
					 
                      <?php
						if(!$nTravma)
						{
						?>
						
						<div style="position:absolute; left:77px; top:59px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="#" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/mn_dun_telep1.gif" oncontextmenu="return false;" width="81" height="108" title="Отправиться в ПТП" class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:183px; top:61px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="#" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/mn_dun_telep2.gif" oncontextmenu="return false;" width="66" height="108" title="Отправиться в Бездну" class="aFilter" /></a>'; ?></div>
						
						
						<div style="position:absolute; left:262px; top:62px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="#" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/mn_dun_telep3.gif" oncontextmenu="return false;" width="78" height="106" title="Отправиться в Катакомбы" class="aFilter"/></a>'; ?></div>
						
						
					 	<div style="position:absolute; left:349px; top:55px; width:50px; height:50px; z-index:90;" class="fade"><? echo '<a href="#" style="font-size: 8pt;"><img src="//img.testcombats.ru/city/mooncity/mpng/mn_dun_telep4.gif" oncontextmenu="return false;" width="77" height="118" title="Отправиться в Пещеру Мглы" class="aFilter"/></a>'; ?></div>
						
						<div style="position:absolute; left:438px; top:166px; width:35px; height:59px; z-index:90;"><img <? thisInfRm('12.180.0.608'); ?> src="//img.testcombats.ru/city/mooncity/mpng/cp.gif" oncontextmenu="return false;" width="40" height="43" title="" class="aFilter" /></div>
                      
                      <?php } ?>
					  
					  <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    </td>
                  </tr>
                </table> 

				<!--div style="width:500px; text-align:right; background-color:#D3D3D3;">
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('12.180.0.xx'); ?>>Вход в ПТП</a></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('12.180.0.xx'); ?>>Вход в Бездну</a></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('12.180.0.xx'); ?>>Вход в Катакомбы</a></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('12.180.0.xx'); ?>>Вход в Пещеру Мглы</a></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('12.180.0.608'); ?>>Страшилкина улица</a></span>
				</div-->				
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