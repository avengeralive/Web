<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='an/lightroom')
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;padding-left: 4px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                    <div style="position:relative; cursor: pointer;" id="ione">
                        <img src="//img.testcombats.ru/i/images/300x225/club/navig1.jpg" alt="" name="img_ione" width="500" height="240" border="1" id="img_ione"/>
                        <div style="position:absolute; left:173px; top:88px; width:16px; height:18px; z-index:91;"><img src="//img.testcombats.ru/i/images/300x225/fl1.gif" width="16" height="18" title="Вы находитесь в '<? echo $u->room['name']; ?>'"  /></div>
                        <div style="position:absolute; left:354px; top:115px; width:120px; height:35px; z-index:90;"><img onClick="location='main.php?loc=2.180.0.261';" src="//img.testcombats.ru/i/images/300x225/map_halls.gif" width="120" height="35" class="aFilter" <? thisInfRm('2.180.0.261'); ?>/></div> <!--Залы-->
                        <div style="position: absolute; left: 53px; top: 47px; width: 122px; height: 31px; z-index: 90;"><img onClick="location='main.php?loc=1.180.0.338';" src="//img.testcombats.ru/i/images/300x225/map_zalu4.gif" width="123" height="30" class="aFilter" <? thisInfRm('1.180.0.338'); ?>/></div><!--Зал Паладинов-->
                        <div style="position: absolute; left: 202px; top: 167px; width: 122px; height: 31px; z-index: 90;"><img onClick="location='main.php?loc=1.180.0.341';" src="//img.testcombats.ru/i/images/300x225/map_demon3.gif" width="122" height="31" class="aFilter" <? thisInfRm('1.180.0.341'); ?>/></div><!--Зал тарманов-->
						<div style="position: absolute; left: 158px; top: 85px; width: 122px; height: 31px; z-index: 90;"><img onClick="location='main.php?loc=1.180.0.16';" src="//img.testcombats.ru/i/images/300x225/map_klub5-1.gif" width="122" height="31" class="aFilter" <? thisInfRm('1.180.0.16'); ?>/></div> <!--Зал Света-->
						<div style="position: absolute; left: 57px; top: 187px; width: 122px; height: 31px; z-index: 90;"><img onClick="location='main.php?loc=1.180.0.342';" src="//img.testcombats.ru/i/images/300x225/map_zalu2.gif" width="122" height="31" class="aFilter" <? thisInfRm('1.180.0.342'); ?>/></div> <!--Зал Стихий-->
						
                        <div style="position: absolute; left: 264px; top: 44px; width: 122px; height: 31px; z-index: 90;"><img onClick="location='main.php?loc=1.180.0.375';" src="//img.testcombats.ru/i/images/300x225/map_zalu1.gif" width="122" height="31" class="aFilter" <? thisInfRm('1.180.0.375'); ?>/></div> <!--Зал Тьмы--> 
  
                        <div style="position:absolute; left:17px; top:122px; width:79px; height:32px; z-index:90;"><img onClick="location='main.php?loc=1.180.0.339';" src="//img.testcombats.ru/i/images/300x225/map_zalu3.gif" width="78" height="33" class="aFilter" <? thisInfRm('1.180.0.339'); ?> /></div><!--Совет Белого Братства-->
                        <div style="position:absolute; left:393px; top:170px; width:100px; height:35px; z-index:90;"><img onClick="location='main.php?loc=1.180.0.3';" src="//img.testcombats.ru/i/images/300x225/map_zalu7.gif" width="100" height="35" class="aFilter" <? thisInfRm('1.180.0.3'); ?>/></div> <!--Бойцовский Клуб-->
                        <? echo $goline; ?>
                        <div id="snow"></div>
                    </div>
                    </td>
                  </tr>
                </table>    
                <div style="display:none; height:0px " id="moveto"></div>    
              <div align="right" style="padding: 3px;"><small>&laquo;<b><? echo $u->room['name']; ?></b>&raquo; приветствует Вас, <b><? echo $u->info['login']; ?></b>.<br />
			 </small></div></td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table>
      	<div style="width: 500px;">
      	<small style="smaller">
        <HR height="1px" align="right" style="width: 500px;
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
		<INPUT onclick="location.href='main.php?zayvka=<? echo $code; ?>';" value="Поединки" type="button" name="combats">
			<? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';"  value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>
          <INPUT id="news" onclick="window.open('//testcombats.ru/news', 'news', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Новости" type="button" name="forum">
		  <INPUT id="forum" onclick="window.open('//testcombats.ru/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum"><br>
            <b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на
            халяву". Пароль не нужен ни
            паладинам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br>
            <i>Администрация.</i></small>
      </div>
        
      </div></td>
  </tr>
</table>
<?
}

?>