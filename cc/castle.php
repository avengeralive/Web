<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cc/castle')
{
?>
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
                      <!--<div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="https://img.testcombats.ru/i/images/300x225/club/navig.jpg" id="img_ione" width="500" height="240"  border="1"/>
					  <div style="position:absolute; left:154px; top:148px; width:16px; height:18px; z-index:90;"><img src="https://img.testcombats.ru/i/images/300x225/fl1.gif" width="16" height="18" title="Вы находитесь в '<? echo $u->room['name']; ?>'" /></div>
                      <div style="position:absolute; left:184px; top:94px; width:120px; height:35px; z-index:90;"><img <? thisInfRm('1.180.0.3'); ?> src="https://img.testcombats.ru/i/images/300x225/map_bk.gif" width="120" height="35" class="aFilter" /></div>
                      <div style="position:absolute; left:52px; top:47px; width:123px; height:30px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" src="https://img.testcombats.ru/i/images/300x225/map_klub6.gif" width="123" height="30" class="aFilter" <? thisInfRm('1.180.0.7'); ?>/></div>
					  <div style="position:absolute; left:59px; top:169px; width:123px; height:31px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" src="https://img.testcombats.ru/i/images/300x225/map_klub4.gif" width="123" height="31" class="aFilter"/></div>
					  <div style="position:absolute; left:312px; top:168px; width:123px; height:31px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" src="https://img.testcombats.ru/i/images/300x225/map_klub3.gif" width="123" height="31" class="aFilter" <? thisInfRm('1.180.0.2'); ?>/></div>
					  <div style="position:absolute; left:312px; top:48px; width:123px; height:30px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" src="https://img.testcombats.ru/i/images/300x225/map_klub5.gif" width="123" height="30" class="aFilter"  <? thisInfRm('1.180.0.5'); ?>/></div>
					  <div style="position:absolute; left:216px; top:41px; width:58px; height:49px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" src="https://img.testcombats.ru/i/images/300x225/map_klub2.gif" width="58" height="49" class="aFilter" <? thisInfRm('1.180.0.259'); ?>/></div>
					  <div style="position:absolute; left:66px; top:114px; width:56px; height:13px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" src="https://img.testcombats.ru/i/images/300x225/map_klub1.gif" width="56" height="13" class="aFilter" <? thisInfRm('1.180.0.15'); ?>/></div>
					  <div style="position:absolute; left:196px; top:148px; width:103px; height:47px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" src="https://img.testcombats.ru/i/images/300x225/map_klub7.gif" width="103" height="47" class="aFilter" <? thisInfRm('1.180.0.9'); ?>/></div>
					  <div id="snow"></div>-->
					  <div style="position:relative; cursor: pointer; width: 700;" id="ione"><img src="https://img.testcombats.ru/loca/leg_loc/castle/navig.jpg" id="img_ione" width="700" height="300"  border="1"/>
                      <div style="position:absolute; left:118px; top:19px; width:102px; height:255px; z-index:90;"><img src="https://img.testcombats.ru/loca/leg_loc/castle/room1.png" width="102" height="255" class="aFilter" <? thisInfRm('1.180.0.447'); ?>/></div>
					  <div style="position:absolute; left:8px; top:218px; width:92px; height:75px; z-index:90;"><img src="https://img.testcombats.ru/loca/leg_loc/castle/room2.png" width="92" height="75" class="aFilter" <? thisInfRm('1.180.0.446'); ?>/></div>
					  <div style="position:absolute; left:500px; top:25px; width:82px; height:75px; z-index:90;"><img src="https://img.testcombats.ru/loca/leg_loc/castle/room3.png" width="84" height="184" class="aFilter" <? thisInfRm('1.180.0.448'); ?>/></div>
					  <div style="position: absolute; left: 275px; top: 78px; width: 120px; height: 220px; z-index: 94;"><img onclick="location.href='main.php?talk=31'" src="https://img.testcombats.ru/loca/leg_loc/castle/castelyan.gif" width="120" height="220" class="aFilter" title="Диалог с Кастеляном" /></div>
                      
                    </div>
                    </td>
                  </tr>
                </table>
<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.213'); ?>>Замковая площадь</a></span>
<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.446'); ?>>Башня Мага</a></span>
<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.447'); ?>>Малый Зал</a></span>
<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.448'); ?>>Коридор</a></span>
<? echo $goline; ?>			
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
          <INPUT id="forum" class="btn btn-inverse" onclick="window.open('https://testcombats.ru/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
         <!-- <INPUT class="btn btn-inverse" onclick="window.open('/encicl/help/top1.html', 'help', 'height=300,width=500,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes')" value="Подсказка" type="button">-->

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