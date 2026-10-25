<?
if(!defined('GAME')){
	die();
}

if($u->room['file']=='moon/bk'){

if($magic->testTravma( $u->info['id'] , 4 )) $nTravma = 1;
else $nTravma  = 0;
if($nTravma) $re = 'У вас неизлечимая травма! Вы не можете посещать залы Бойцовского Клуба.';

	
?>
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
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="//img.testcombats.ru/i/images/300x225/club/navig.jpg" id="img_ione" width="500" height="240"  border="1"/>
					 
                      <div style="position:absolute; left:241px; top:128px; width:16px; height:18px; z-index:90;"><img src="//img.testcombats.ru/i/images/300x225/fl1.gif" width="16" height="18" title="Вы находитесь в '<? echo $u->room['name']; ?>'" /></div>
                      <?php
						if(!$nTravma)
						{
						?>
                      <div style="position:absolute; left:184px; top:94px; width:120px; height:35px; z-index:90;"><img src="//img.testcombats.ru/i/images/300x225/map_bk.gif" width="120" height="35" title="" class="aFilter" /></div>
                      <div style="position:absolute; left:66px; top:114px; width:56px; height:13px; z-index:90;"><img <? thisInfRm('12.180.0.620'); ?> onClick="location='main.php?loc=12.180.0.620';"  src="//img.testcombats.ru/i/images/300x225/map_klub1.gif" width="56" height="13"  class="aFilter" /></div><!--Переход залы-->
                      <div style="position:absolute; left:216px; top:41px; width:58px; height:49px; z-index:90;"><a href="#"><img <? thisInfRm('12.180.0.627'); ?> src="//img.testcombats.ru/i/images/300x225/map_klub2.gif" width="58" height="49"  class="aFilter" /></a></div><!--Переход на 2рой этаж-->
                      <div style="position:absolute; left:312px; top:168px; width:123px; height:31px; z-index:90;"><img <? thisInfRm('12.180.0.617'); ?> onClick="location='main.php?loc=12.180.0.617';" src="//img.testcombats.ru/i/images/300x225/map_klub3.gif" width="123" height="31" title="" class="aFilter" /></div><!--Зал войнов 2-->
                      <div style="position:absolute; left:59px; top:169px; width:123px; height:31px; z-index:90;"><img  <? thisInfRm('12.180.0.616'); ?> onClick="location='main.php?loc=12.180.0.616';"  src="//img.testcombats.ru/i/images/300x225/map_klub4.gif" width="123" height="31"  class="aFilter" /></div><!--Зал войнов 1-->
					  <div style="position:absolute; left:312px; top:48px; width:123px; height:30px; z-index:90;"><img  <? thisInfRm('12.180.0.618'); ?> onClick="location='main.php?loc=12.180.0.618';"  src="//img.testcombats.ru/i/images/300x225/map_klub5.gif" width="123" height="30"  class="aFilter"  /></div><!--Зал войнов 3-->
                      <div style="position:absolute; left:52px; top:47px; width:123px; height:30px; z-index:90;"><img <? thisInfRm('12.180.0.619'); ?> onClick="location='main.php?loc=12.180.0.619';" src="//img.testcombats.ru/i/images/300x225/map_klub6.gif" width="123" height="30"  class="aFilter" /></div><!--Будуар 3-->
                      <?php } ?>
					  <div style="position:absolute; left:196px; top:148px; width:103px; height:47px; z-index:90;"><img <? thisInfRm('12.180.0.602'); ?> onClick="location='main.php?loc=12.180.0.602';"  src="//img.testcombats.ru/i/images/300x225/map_klub7.gif" width="103" height="47"  class="aFilter" /></div><!--ЦП-->
					  <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    </td>
                  </tr>
                </table>   
              <div style="display:none; height:0px " id="moveto"></div>     
              <div align="right" style="padding: 3px;"><small>&laquo;<b><? echo $u->room['name']; ?></b>&raquo; приветствует Вас, <b><? echo $u->info['login']; ?></b>.<br />
		
            </small></div></td>
          <td></td>
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
		height: 1px;">
		<? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>
          <INPUT id="forum" onclick="window.open('//testcombats.ru/news', 'news', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Новости" type="button" name="forum">
		  <INPUT id="forum" onclick="window.open('//testcombats.ru/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum"><br>
		<small>
            <b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на
            халяву". Пароль не нужен ни
            паладинам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br>
            <i>Администрация.</i></small><BR>
        
      </div></td>
  </tr>
</table>
<?php
}