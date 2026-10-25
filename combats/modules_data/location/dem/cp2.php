<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

if( date('H') >= 19 || date('H') < 6 ) {
	$tattack = '<a style="color:#D8D8D8" style="cursor:pointer" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');">Напасть</a> &nbsp; ';
}
if($u->room['file']=='dem/cp2')
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
                      <div style="position:relative; cursor: pointer; width: 500px; height: 268px;"  id="ione" ><img src="//img.testcombats.ru/city/demonscity/<? echo $now; ?>/dem_bg2_1.jpg" alt="" oncontextmenu="return false;" name="img_ione" width="500" height="268" border="0" id="img_ione"/></div>
					
					<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:250px;"> 
                         <? echo $tattack; ?>
                          &nbsp;
						  <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><span style="color:white;" onclick="location.href='main.php?homeworld=<? echo $code; ?>';">Возврат</span><? } unset($hgo); ?> &nbsp;
                         <span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						 <span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						 <span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/demonscity.gif" oncontextmenu="return false;">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;
					</div>
                    
                  <div style="position: absolute; left: 330px; top: 70px; width: 87px; height: 108px; z-index: 910;"><img class="aFilter" src="//img.testcombats.ru/city/demonscity/<? echo $now; ?>/dm_hostel.gif" oncontextmenu="return false;" width="87" height="108" <? thisInfRm('4.180.0.505'); ?>></div>
                      
                      <div style="position: absolute; left: 205px; top: 5px; width: 73px; height: 159px; z-index: 910;"><img class="aFilter" src="//img.testcombats.ru/city/demonscity/<? echo $now; ?>/dm_dtower.gif" oncontextmenu="return false;" width="73" height="159" <? thisInfRm('4.180.0.279'); ?>></div>
                      
                      <div style="position: absolute; left: 115px; top: 90px; width: 81px; height: 64px; z-index: 910;"><img class="aFilter" src="//img.testcombats.ru/city/demonscity/<? echo $now; ?>/dm_bank.gif" oncontextmenu="return false;" width="81" height="64" <? thisInfRm('4.180.0.278'); ?>></div>
					  
                  <div style="position:absolute; left:16px; top:155px; width:30px; height:54px; z-index:910;"><img  src="//img.testcombats.ru/city/demonscity/<? echo $now; ?>/dm_left1.gif" oncontextmenu="return false;" width="30" height="53" <? thisInfRm('4.180.0.286'); ?> class="aFilter" /></div>
                  
					
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
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.286'); ?>>Центральная площадь</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.278'); ?>>Банк</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('4.180.0.505'); ?>>Общежитие</a></span>
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
		height: 1px;">
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