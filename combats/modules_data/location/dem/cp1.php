<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

if( date('H') >= 19 || date('H') < 6 ) {
	$tattack = '<a style="color:#D8D8D8" style="cursor:pointer" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');">Напасть</a> &nbsp; ';
}
if($u->room['file']=='dem/cp1')
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <?php $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;padding-left: 4px;"><?php include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
 <table width="500" border="0" cellspacing="0" cellpadding="0">
								<? if( $u->error != '' )  { ?>
                           <font color=red><b>
						<? echo err_tr().$u->error; ?></font></b>
				<? } ?> 
                  <tr>
                    <td>
                      <div style="position:relative; cursor: pointer;" id="ione">
                      <div style="position:relative; cursor: pointer; width: 500px; height: 268px;"  id="ione"><img src="//img.testcombats.ru/city/demonscity/<? echo $now; ?>/dem_bg1_1.jpg" oncontextmenu="return false;" alt="" name="img_ione" width="500" height="268" border="0" id="img_ione"/></div>
					
					<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:250px;"> 
                         <? echo $tattack; ?>
                          &nbsp;
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
			<span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
			<span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/demonscity.gif" oncontextmenu="return false;">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;
					</div>
                    
                  <div style="position:absolute; left:68px; top:0px;  z-index:5;;"><img <? thisInfRm('4.180.0.508'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_club.gif" oncontextmenu="return false;" width="160" height="124"  class="aFilter" /></div>
				  
                  <!--<div style="position: absolute; left: 376px; top: 118px; width: 79px; height: 88px; z-index: 91;"><img  <? thisInfRm('1.180.0.371'); ?> src="//img.testcombats.ru/city/demonscity/day/loto.gif" oncontextmenu="return false;" class="aFilter" width="86" height="63" /></div>-->
                  
				  <div style="position: absolute; left:226px; top:31px; width: 71px; height: z-index: 5;"><img  <? thisInfRm('4.180.0.290'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_shop.gif" oncontextmenu="return false;" width="71" height="99"  class="aFilter" /></div>
				
				 <div style="position: absolute; left:275px; top:134px;  z-index:5;"><img   <? thisInfRm('4.180.0.504'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_comshop.gif" oncontextmenu="return false;" width="63" height="60"  class="aFilter" /></div>
                  
				  <div style="position: absolute; left:269px; top:69px;  z-index:5;"><img  <? thisInfRm('4.180.0.249'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_repair.gif" oncontextmenu="return false;" width="69" height="59"  class="aFilter" /></div>
                  
				  <div style="position: absolute; left:337px; top:48px;  z-index:5;"><img  <? thisInfRm('4.180.0.287'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_dungeon.gif" oncontextmenu="return false;" class="aFilter" width="42" height="35" /></div>
				  
				  <div style="position: absolute; left:350px; top:85px;  z-index:5;"><img  <? thisInfRm('1.180.0.x'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_temple.gif" oncontextmenu="return false;" class="aFilter" width="57" height="83" /></div>
				  
				  <div style="position: absolute; left:410px; top:146px;  z-index:5;"><img  <? thisInfRm('1.180.0.x'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_dastman.gif" oncontextmenu="return false;" class="aFilter" width="44" height="87" /></div>
				  
				  <div style="position: absolute; left:397px; top:80px;  z-index:5;"><img  <? thisInfRm('1.180.0.x'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_optshop.gif" oncontextmenu="return false;" class="aFilter" width="50" height="70" /></div>
                 
				 <div style="position:absolute; left:187px; top:119px;  z-index:5;"><img <? thisInfRm('4.180.0.503'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_post.gif" oncontextmenu="return false;" width="61" height="80" class="aFilter" /></div>
                  
				  <div style="position:absolute; left:101px; top:128px;  z-index:5;"><img  <? thisInfRm('4.180.0.282'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_station.gif" oncontextmenu="return false;" width="99" height="85" class="aFilter" /></div>
                  
                  <div style="position: absolute; left:40px; top:75px;  z-index:5;"><img src="//img.testcombats.ru/city/demonscity/day/stellav.gif" oncontextmenu="return false;" width="75" height="90" <? thisInfRm('1.180.0.420'); ?> class="aFilter" /></div>
                  
                  
				  <div style="position:absolute; left:446px; top:153px; width:30px; height:54px; z-index:94;"><img <? thisInfRm('4.180.0.293'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_right.gif" oncontextmenu="return false;" width="30" height="54" class="aFilter" /></div>
                  
                  <!--div style="position:absolute; left:16px; top:155px; width:30px; height:54px; z-index:910;"><img  src="//img.testcombats.ru/city/demonscity/day/dm_left1.gif" oncontextmenu="return false;" width="30" height="53" <? thisInfRm('4.180.0.хх'); ?> class="aFilter" /></div-->
                  
					<!--<?
					if( date('m') == 12 || date('m') == 1 ) {
						//Елка НГ
					?>
					<div style="position: absolute; left: 145px; top: 125px; width: 32px; height: 43px; z-index: 100;"><img <? thisInfRm('1.180.0.208'); ?> src="//img.anticombats.com/newyear2014.png" oncontextmenu="return false;" width="60" height="90" title="" class="aFilter" /></div>
					<?
                    }
					?>-->
			
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
                  <? echo $goline; ?> </div></td>
              </tr>
            </table>
<?php
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
<?php
}
?>
        
		<!-- -->
            <div style="width:500px; text-align:left; background-color:#D3D3D3;">
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.508'); ?>>Бойцовский Клуб</a></span>
	<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.282'); ?>>Вокзал</a></span>
	<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.503'); ?>>Почта</a></span>
	<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.290'); ?>>Магазин</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.249'); ?>>Ремонтная мастерская</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.504'); ?>>Коммиссионый магазин</a></span>
	<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.287'); ?>>Вход в Катакомбы</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.293'); ?>>Страшилкина улица</a></span>
        </div>
            <!-- -->



		<div style="display:none; height:0px " id="moveto"></div>
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
?>
<!--<style>
.mon_atack {cursor:pointer;}
.d_show {display: block;transition: 0.5s;}
.d_hide{ display: none;transition: 0.5s;}
</style>
<script>
(function ($) {
	//$( "#dialog" ).addClass('d_hide');
}) (jQuery);

	function showDlg()
	{
	    if($( "#dialog" ).hasClass('d_hide'))
		{
			$( "#dialog" ).addClass('d_show');
            $( "#dialog" ).removeClass('d_hide');
		}
		else 
		{
			$( "#dialog" ).addClass('d_hide');
            $( "#dialog" ).removeClass('d_show');
		}
	}

</script>-->