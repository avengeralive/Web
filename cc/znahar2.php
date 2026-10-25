<?
if(!defined('GAME')){
	die();
}

if($u->room['file']=='cc/znahar2'){

if($magic->testTravma( $u->info['id'] , 4 )) $nTravma = 1;
else $nTravma  = 0;
if($nTravma) $re = 'У вас неизлечимая травма! Вы не можете посещать залы Бойцовского Клуба.';

	
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
height:1px;
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
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="//img.testcombats.ru/city/capitalcity/doctor_cap.jpg" id="img_ione" width="500" height="240"  border="1"/>
					<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:223px;"> 
                      
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						 <span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						 <span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/capitalcity.gif">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;</div>
					 
                      <?php
						if(!$nTravma)
						{
						?>
                      <div style="position:absolute; left:453px; top:163px; width:32px; height:42px; z-index:90;"><img <? thisInfRm('1.180.0.221'); ?> src="//img.testcombats.ru/city/capitalcity/exitor.png" width="32" height="42" title="" class="aFilter" /></div>
					  <div style="position:absolute; left:18px; top:55px; width:91px; height:135px; z-index:90;"><img <? thisInfRm('1.180.0.482'); ?> src="//img.testcombats.ru/city/capitalcity/cap_doctor_seance.gif" width="91" height="135" title="" class="aFilter" /></div>
                      
                      <?php } ?>
					  
					  <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    </td>
                  </tr>
                </table> 

				<div style="width:500px; text-align:right; background-color:#D3D3D3;">
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.482'); ?>>Сеанс у Знахаря</a></span>
				<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.221'); ?>>Торговый зал</a></span>
				</div>				
              <div style="display:none; height:0px " id="moveto"></div>     
              </td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
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
		border-width: 1px;">
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