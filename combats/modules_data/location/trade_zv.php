<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='trade_zv')
{
?>
<link rel="stylesheet" type="text/css" href="//img.testcombats.ru/css/loc_bk.css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
									<? if( $u->error != '' )  { ?>
                           <font color=red><b>
						<? echo $u->error; ?></font></b>
				<? } ?> 
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="//img.testcombats.ru/i/images/loc_bk/bg.jpg" id="img_ione" width="500" height="240"  border="1"/>
					  <img class="zv1" onClick="alert('Проход через Бойцовский Клуб!');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 50px; top: 169px; z-index:90;">
					  <img class="cp" onClick="alert('Проход через Бойцовский Клуб!');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 190px; top: 175px; z-index:90;">
					  <img class="dark_zv" onClick="alert('Проход через Бойцовский Клуб');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 350px; top: 169px; z-index:90;">
					  <img class="neut_zv" onClick="alert('Проход через Бойцовский Клуб');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 355px; top: 105px; z-index:90;">
					  <img class="light_zv" onClick="alert('Проход через Бойцовский Клуб!');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 340px; top: 40px; z-index:90;">
					  <img class="zn" onClick="alert('Проход через Бойцовский Клуб!');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 190px; top: 30px; z-index:90;">
					  <img class="trade_zv" onClick="alert('Вы уже находитесь в этой комнате!');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 43px; top: 50px; z-index:90;">
					  <img class="ric_zv" onClick="alert('Проход через Бойцовский Клуб!');" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 25px; top: 105px; z-index:90;">
					  <img class="bk" src="//img.testcombats.ru/i/images/loc_bk/1x1.gif" style="left: 185px; top: 110px; z-index:90;" onClick="location='main.php?loc=1.180.0.3';">
					  <?
					  if($u->room['id']==221) {
					?><div style="position:absolute; left:43px; top:50px; width:119px; height:34px; z-index:90;"><img onClick="alert('Вы уже находитесь в этой комнате!');" onMouseOver="this.className='aFilterhover';" onMouseOut="this.className='aFilter';" src="//img.testcombats.ru/i/images/loc_bk/trade_a.png" width="119" height="34" title="Вы уже находитесь в этой комнате!" class="aFilter" /></div>
					  <?}?>
					  <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    </td>
                  </tr>
                </table>   
                <div style="display:none; height:0px " id="moveto"></div>     
              <div align="right" style="padding: 3px;"><small>&laquo;<? echo $c['title3']; ?>&raquo; приветствует Вас, <b><? echo $u->info['login']; ?></b>.<br />
			  	<?php
             	 if($u->info['level']<6) 
              	 {
               	 	echo '
                 	Вам все время кажется что за вами следят? Чудится, что случайный попутчик мечтает всадить вам топор в спину? При совершении очередной покупки в гос. магазине мучает ощущение, что вас обманули? Кажется, что симпатичная девушка напротив смотрит на вас как на пищу? Успокойтесь, это не паранойя. Это реалии Capital city. Города Тьмы.
                 	';
                 }else{
                 	echo 'Возможно, вы ошиблись этажом - настоящие сражения проходят этажом выше.';
                 } ?>
            </small></div></td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table>
      	<small>
        <HR>
		<INPUT id="forum" onclick="window.open('https://img.testcombats.ru/news/', 'news', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Новости" type="button" name="forum">
          <INPUT onclick="location.href='main.php?zayvka=<? echo $code; ?>';" value="Поединки" type="button" name="combats">
          <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>
          <INPUT id="forum" onclick="window.open('https://img.testcombats.ru/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        <br />
        <strong>Внимание!</strong> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <U>только взломщикам</U> для кражи вашего героя.<BR>
        <em>Администрация.</em></small> <BR>
       <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?
}

?>