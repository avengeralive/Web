<?
if(!defined('GAME'))
{
	die();
}
$tattack = '';

if( date('H') >= 19 || date('H') < 6 ) {
	$tattack = '<a style="color:#D8D8D8" style="cursor:pointer" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');">Напасть</a> &nbsp; ';
}

if($u->room['file']=='an/cp1')
{
	if(date("H")>=6 && date("H")<19) {
		$now = 'day';
	}else{
		$now = 'night';
	}
?>
<script>
<?
if(date("H")<6 || date("H")>=19) 
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
                      <div style="position:relative; cursor: pointer;" id="ione"><!-- <? echo $now; ?> -->
                      <img src="//img.testcombats.ru/city/angelscity/<? echo $now; ?>/angel_bg1_1.jpg" oncontextmenu="return false;" alt="" name="img_ione" width="500" height="268" border="1" id="img_ione"/>
                     <div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:250px;"> 
                         <? echo $tattack; ?>
                          &nbsp;
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						 <span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						 <span><b style="color:white; "><img oncontextmenu="return false;" style="height: 10px;padding-top: 1px;"  src="//img.testcombats.ru/i/city_ico/angelscity.gif">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;
					</div>
                
<div style="position: absolute; left: 309px; top: 119px; width: 79px; height: 88px; z-index: 94;"><img  <? thisInfRm('2.180.0.239'); ?> src="//img.testcombats.ru/city/angelscity/day/angvokzal.gif" oncontextmenu="return false;" width="114" class="aFilter" height="89" /></div>

<div style="position: absolute; left: 436px; top: 180px; width: 40px; height: 23px; z-index: 94;"><img  <? thisInfRm('2.180.0.236'); ?> src="//img.testcombats.ru/city/angelscity/day/angstrelka.gif" oncontextmenu="return false;" width="34" class="aFilter" height="20" /></div>

<div style="position: absolute; left: 29px; top: 69px; width: 79px; height: 88px; z-index: 93;"><img  <? thisInfRm('2.180.0.235'); ?> src="//img.testcombats.ru/city/angelscity/day/angshop.gif" oncontextmenu="return false;" width="109" class="aFilter" height="69" /></div>

<div style="position: absolute; left: 80px; top: 132px; width: 79px; height: 71px; z-index: 93;"><img  <? thisInfRm('2.180.0.262'); ?> src="//img.testcombats.ru/city/angelscity/day/angpochta.gif" oncontextmenu="return false;" width="128" height="68" class="aFilter" /></div>

<div style="position: absolute; left: 112px; top: 47px; width: 79px; height: 67px; z-index: 92;"><img  <? thisInfRm('2.180.0.277'); ?> src="//img.testcombats.ru/city/angelscity/day/angcomission.gif" oncontextmenu="return false;" width="98" class="aFilter" height="59" /></div>

<div style="position: absolute; left: 355px; top: 87px; width: 79px; height: 57px; z-index: 93;"><img  <? thisInfRm('2.180.0.249'); ?> src="//img.testcombats.ru/city/angelscity/day/angremont.gif" oncontextmenu="return false;" width="112" class="aFilter" height="58" /></div>

<div style="position: absolute; left: 204px; top: 19px; width: 79px; height: 88px; z-index: 93;"><img  <? thisInfRm('2.180.0.230'); ?> src="//img.testcombats.ru/city/angelscity/day/angklub.gif" oncontextmenu="return false;" width="110" class="aFilter" height="129" /></div>

<div style="position: absolute; left: 16px; top: 99px; width: 50px; height: 50px; z-index: 93;"><img  src="//img.testcombats.ru/city/angelscity/day/t1.gif" oncontextmenu="return false;" width="60" height="64" /></div>
<div style="position: absolute; left: 69px; top: 140px; width: 50px; height: 50px; z-index: 93;"><img  src="//img.testcombats.ru/city/angelscity/day/t1.gif" oncontextmenu="return false;" width="60" height="64" /></div>
<div style="position: absolute; left: 391px; top: 115px; width: 50px; height: 50px; z-index: 93;"><img  src="//img.testcombats.ru/city/angelscity/day/t1.gif" oncontextmenu="return false;" width="60" height="64" /></div>



                        <!-- <div style="position:absolute; left:166px; top:149px; width:27px; height:55px; z-index:99;"><img  src="//img.testcombats.ru/i/images/300x225/capital/2pm.gif" oncontextmenu="return false;" width="27" height="55" title="Памятник Мироздателю" /></div> -->
        
                        <!-- <div style="position:absolute; left:100px; top:146px; width:75px; height:90px; z-index:99;"><img src="//img.testcombats.ru/i/images/300x225/capital/stellav.gif" oncontextmenu="return false;" width="75" height="90" title="Стела выбора" class="aFilter" /></div> -->
                        
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
if(date("H")<6 || date("H")>=22) 
{
?>
                <div align="center" id="atackDiv" style="display:none;">
                   <form method="post" action="main.php">
                   <table width="300" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div style="width:300px; padding:3px; margin:7px; background-color:#CCCCCC; border:1px solid #575757;"> Введите логин жертвы:<br />
                            <input name="atack" type="text" id="atack" size="35" maxlength="30" />
                            <input type="submit" name="button" id="button" value="OK" />
                      </div></td>
                    </tr>
                  </table>                 
                  </form>
                </div> 
<?
}
?>
        <!-- -->
        <div style="width:500px; text-align:left; background-color:#D3D3D3;">
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('2.180.0.230'); ?>>Бойцовский Клуб</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('2.180.0.277'); ?>>Комиссионный магазин</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('2.180.0.235'); ?>>Магазин</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('2.180.0.239'); ?>>Вокзал</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('2.180.0.262'); ?>>Почта</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('2.180.0.249'); ?>>Ремонтная мастерская</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('2.180.0.236'); ?>>Страшилкина улица</a></span>
        </div>
        <!-- -->

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
<?
}

?>