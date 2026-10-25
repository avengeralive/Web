<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='an/bk2')
{
	
	
if($magic->testTravma( $u->info['id'] , 4 )) $nTravma = 1;
else $nTravma  = 0;
if($nTravma) $re = 'У вас неизлечимая травма! Вы не можете посещать залы Бойцовского Клуба.';
?>
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
                    <td>
					<? if(!$nTravma) { ?>
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="//img.testcombats.ru/i/images/300x225/club/navig3.jpg" id="img_ione" width="500" height="240"  border="1"/>
                      <div style="position:absolute; left:162px; top:125px; width:16px; height:18px; z-index:90;"><img src="//img.testcombats.ru/i/images/300x225/fl1.gif" width="16" height="18" title="Вы находитесь в '<? echo $u->room['name']; ?>'" /></div>
					  <div style="position:absolute; left:281px; top:173px; width:122px; height:31px; z-index:90;"><img onclick="location='main.php?loc=2.180.0.238';" src="//img.testcombats.ru/i/images/300x225/map_sec5.gif" width="122" height="31"  class="aFilter"  <? thisInfRm('2.180.0.238'); ?>/></div><!--Торговый Зал-->
                      <div style="position:absolute; left:23px; top:116px; width:120px; height:35px; z-index:90;"><img src="//img.testcombats.ru/i/images/300x225/map_2stair.gif" width="120" height="35"  class="aFilter"  /></div><!--2 этаж-->
					  <div style="position:absolute; left:118px; top:175px; width:101px; height:37px; z-index:90;"><img onClick="alert('Проход через Торговый Зал');" src="//img.testcombats.ru/i/images/300x225/map_sec3.gif" width="101" height="37"  class="aFilter" title="Комната Знахаря"/></div><!--Комната Знахаря-->
                      <div style="position:absolute; left:36px; top:41px; width:63px; height:40px; z-index:90;"><img onClick="alert('Зал на ремонте');" src="//img.testcombats.ru/i/images/300x225/map_sec2.gif" width="63" height="40"  class="aFilter" <? thisInfRm('1.180.0.XX'); ?>/></div><!--Переход на 3 этаж-->
					  <div style="position:absolute; left:24px; top:180px; width:91px; height:43px; z-index:90;"><img onclick="location='main.php?loc=2.180.0.230';" src="//img.testcombats.ru/i/images/300x225/map_sec1.gif" width="91" height="43"  class="aFilter" <? thisInfRm('2.180.0.230'); ?>/></div><!--Переход Бойцовский клуб-->
					  <div style="position:absolute; left:122px; top:52px; width:123px; height:39px; z-index:90;"><img onClick="alert('Проход через Рыцарский Зал');" src="//img.testcombats.ru/i/images/300x225/map_sec7.gif" width="123" height="39"  class="aFilter" <? thisInfRm('1.180.0.333'); ?> /></div><!--Башня рыцарей-Магов-->
					  <div style="position:absolute; left:305px; top:51px; width:123px; height:30px; z-index:90;"><img onclick="location='main.php?loc=2.180.0.299';" src="//img.testcombats.ru/i/images/300x225/map_sec6.gif" width="123" height="30"  class="aFilter" <? thisInfRm('2.180.0.299'); ?>  /></div><!--Рыцарский Зал-->
					  <div style="position:absolute; left:391px; top:120px; width:89px; height:32px; z-index:90;"><img onClick="alert('Проход через Рыцарский Зал или Торговый Зал');" src="//img.testcombats.ru/i/images/300x225/map_sec4.gif" width="89" height="32"  class="aFilter" <? thisInfRm('1.180.0.223'); ?> /></div><!--Таверна-->
                      <? } ?>
					  <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    </td>
                  </tr>
                </table>  
              <div style="display:none; height:0px " id="moveto"></div>      
              <div align="right" style="padding: 3px;"><small>&laquo;<b><? echo $u->room['name']; ?></b>&raquo; приветствует Вас, <b><? echo $u->info['login']; ?></b>.<br />

            </small></div></td>
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
		height: 1px;">
		<? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>
          <INPUT id="forum"  onclick="window.open('//testcombats.ru/news', 'news', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Новости" type="button" name="forum">
		  <INPUT id="forum" onclick="window.open('//testcombats.ru/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum"><br>
		<small>
            <b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на
            халяву". Пароль не нужен ни
            паладинам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br>
            <i>Администрация.</i></small><BR>
      </div></td>
  </tr>
</table>
<?
}

?>