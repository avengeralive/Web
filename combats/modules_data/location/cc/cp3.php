<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

if( date('H') >= 19 || date('H') < 6 ) {
	$tattack = '<a style="color:#D8D8D8" style="cursor:pointer" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');">Напасть</a> &nbsp; ';
}

if($u->room['file']=='cc/cp3')
{
	if(date("H")>=6 && date("H")<19) {
		$now = 'day';
	}else{
		$now = 'night';
	}
?>
<script>
<?
if(date("H")<8 || date("H")>19)
{
?>
function AtackNoWindow()
{
	var dt = document.getElementById('atackDiv');
	if(dt.style.display=='none')
	{
		dt.style.display = '';
	}else{
		dt.style.display = 'none';
	}
}
<?
}
?>
</script>
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
                      <div style="position:relative; cursor: pointer; width: 500px; height: 268px;"  id="ione"><img src="//img.testcombats.ru/city/capitalcity/<? echo $now; ?>/city_capres2.jpg" alt="" oncontextmenu="return false;" width="500" height="268" border="0" id="img_ione"/></div> <!--Бг страшилки-->
			<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:250px;"> 
                         <? echo $tattack; ?>
                          &nbsp;
                         <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><span style="color:white;" onclick="location.href='main.php?homeworld=<? echo $code; ?>';">Возврат</span><? } unset($hgo); ?> &nbsp;
			<span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
			<span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
			<span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/capitalcity.gif" oncontextmenu="return false;">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;
                   </div>
                     
                      <!--<div style="position: absolute; left: 192px; top: 171px; width: 73px; height: 47px; z-index: 90;"><img  <? thisInfRm('1.180.0.321'); ?> src="//img.testcombats.ru/newcap/st4_b1.gif" oncontextmenu="return false;" width="90" height="47"  class="aFilter" /></div>-->
                      <div style="position: absolute; left: 69px; top: 143px; width: 73px; height: 47px; z-index: 89;"><img  <? thisInfRm('1.180.0.215'); ?> src="//img.testcombats.ru/city/capitalcity/day/cp_libshop.gif" oncontextmenu="return false;" width="53" height="48"  class="aFilter" /></div>
                      <div style="position: absolute; left: 112px; top: 95px; width: 73px; height: 47px; z-index: 88;"><img  <? thisInfRm('1.180.0.296'); ?> src="//img.testcombats.ru/city/capitalcity/day/auction.gif" oncontextmenu="return false;" width="154" height="90"  class="aFilter" /></div>
                      <div style="position: absolute; left: 261px; top: 123px; width: 73px; height: 47px; z-index: 87;"><img  <? thisInfRm('1.180.0.255'); ?> src="//img.testcombats.ru/city/capitalcity/day/cp_zooshop.gif" oncontextmenu="return false;" width="56" height="61"  class="aFilter" /></div>
                      <div style="position: absolute; left: 313px; top: 109px; width: 73px; height: 47px; z-index: 88;"><img  <? thisInfRm('1.180.0.321'); ?> src="//img.testcombats.ru/city/capitalcity/day/cp_portal.gif" oncontextmenu="return false;" width="75" height="90"  class="aFilter" /></div>
                      <div style="position: absolute; left: 392px; top: 104px; width: 73px; height: 47px; z-index: 88;"><img  <? thisInfRm('1.180.0.322'); ?> src="//img.testcombats.ru/city/capitalcity/day/cp_deathroom.gif" oncontextmenu="return false;" width="94" height="91"  class="aFilter" /></div>
                      
                        <div style="position:absolute; left:446px; top:153px; width:30px; height:54px; z-index:94;"><img <? thisInfRm('1.180.0.x'); ?> src="//img.testcombats.ru/i/images/300x225/capital/2stop.gif" oncontextmenu="return false;" width="29" height="54" class="aFilter" /></div>
        
                        <div style="position:absolute; left:16px; top:155px; width:30px; height:54px; z-index:910;"><img <? thisInfRm('1.180.0.11'); ?> src="//img.testcombats.ru/i/images/300x225/capital/3strelka.gif" oncontextmenu="return false;" width="30" height="53" class="aFilter" /></div>
                        
						
						
						<script language="javascript" type="text/javascript">
                                                if(document.getElementById('ione'))
                        {
                            document.getElementById('ione').appendChild(document.getElementById('buttons_on_image'));
                            document.getElementById('buttons_on_image').style.position = 'absolute';
                            document.getElementById('buttons_on_image').style.bottom = '8px';
                            document.getElementById('buttons_on_image').style.right = '23px';
                        }else{
                            document.getElementById('buttons_on_image').style.display = 'none';
                        }
						</script>  
					
						<div id="snow"></div>
                        <? echo $goline; ?>
                      </div>
                    </td>
                  </tr>
                </table> 
<?
if(date("H")<8 || date("H")>21)
{
?>
                <div align="center" id="atackDiv" style="display:none;">
                   <form method="post" action="main.php">
                   <table width="300" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div style="width:300px; padding:3px; margin:7px; background-color:#CCCCCC; border:1px solid #575757;"> Введите логин жертвы:<br />
                            <input name="atack" type="text" id="atack" size="35" maxlength="30" />
                            <input type="submit" name="button" id="button" class="btn" value="OK" />
                      </div></td>
                    </tr>
                  </table>                 
                  </form>
                </div> 
<?
}
?>
        <div style="width:500px; text-align:left; background-color:#D3D3D3;">
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.11'); ?>>Страшилкина улица</a></span>
	<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.215'); ?>>Книжный магазин</a></span>
	<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.255'); ?>>Зоомагазин</a></span>
	<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.321'); ?>>Портал</a></span>
	<!--<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.#'); ?>>Аукцион</a></span>-->
	<!--<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.322'); ?>>Алтарь Крови</a></span>-->
	<!--<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.321'); ?>>Подземелья</a></span>-->
        </div>

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
<? } ?>