<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

if( date('H') >= 22 || date('H') < 6 ) {
	$tattack = '<a style="color:#D8D8D8" style="cursor:pointer" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');">Напасть</a> &nbsp; ';
}
if($u->room['file']=='dev/cp3')
{
	if(date("H")>=6 && date("H")<22) {
		$now = 'day';
	}else{
		$now = 'night';
	}
?>
<script>
<?
if(date("H")<8 || date("H")>21)
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
var no = 20; // snow number
var speed = 15; // smaller number moves the snow faster
var sp_rel = 1.4; //speed relevation
var snowflake1 = "//img.testcombats.ru/i/itimeges/snow1.gif";
var snowflake2 = "//img.testcombats.ru/i/itimeges/snow2.gif";
 
var i, doc_width, doc_height;

dx = new Array();
xp = new Array();
yp = new Array();
am = new Array();
stx = new Array();
sty = new Array();

Array.prototype.exists = function(el)
{
    for(var i=0;i<this.length;i++)
	if(this[i]==el)
	    return true;
    return false;	
}

var rooms = ['0','1'];

function SetVariable(c) {
	dx[c] = 0;                        // set coordinate variables
	am[c] = Math.random()*15;         // set amplitude variables
	xp[c] = Math.random()*(doc_width-35) + 0 + am[c];  // set position variables
	yp[c] = 0;
	stx[c] = 0.02 + Math.random()/10; // set step variables
	sty[c] = 0.7 + Math.random();     // set step variables
}

function DrawWeather(room) {
  
    doc_width = document.getElementById('img_ione').width;
    doc_height = document.getElementById('img_ione').height;
    
	var div = '';
	for (i = 0; i < no; ++ i) {  
		SetVariable(i);
		div += "<div id=\"dot"+ i +"\" style=\"POSITION: absolute; Z-INDEX: 30" + i +"; VISIBILITY: visible; TOP: " + 0 + "px; LEFT: " + 0 + "px;\"><img id=\"im"+ i +"\" src=\"" + (sty[i]<sp_rel ? snowflake2 : snowflake1 ) + "\" border=\"0\" alt=\"Снежинка\"></div>";
	}
	
	document.getElementById('snow').innerHTML = div;	
	return 1;
}

function WeatherBegin() {  // IE main animation function
    
    for (i = 0; i < no; ++ i) {  // iterate for every dot
        yp[i] += sty[i] < sp_rel ? sty[i]/2 : sty[i];
        if (yp[i] > doc_height-40) {
            SetVariable(i);
            var im = document.getElementById('im'+i);
            im.src = (sty[i] < sp_rel) ? snowflake2 : snowflake1;
        }
        dx[i] += stx[i];
        document.getElementById('dot'+i).style.top = yp[i];
        document.getElementById('dot'+i).style.left = xp[i] +  am[i]*Math.sin(dx[i]);
    }
    setTimeout('WeatherBegin()', speed);
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <?php $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;"><?php include('modules_data/stats_loc.php'); ?></td>
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
                      <div style="position:relative; cursor: pointer; width: 500px; height: 268px;"  id="ione"><img src="//img.testcombats.ru/city/devilscity/day/dev_bg3.jpg" oncontextmenu="return false;" alt="" name="img_ione" width="500" height="268" border="0" id="img_ione"/></div>
			<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:250px;"> 
                         <? echo $tattack; ?>&nbsp;
                        <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><span style="color:white;" onclick="location.href='main.php?homeworld=<? echo $code; ?>';">Возврат</span><? } unset($hgo); ?> &nbsp;
						<span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
						<span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
						<span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" src="//img.testcombats.ru/i/city_ico/devilscity.gif" oncontextmenu="return false;">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;
            </div>
                    
                <div style="position: absolute; left:81px; top:30px; width:126px; height:192px; z-index: 90;"><img <? thisInfRm('8.180.0.xx'); ?> src="//img.testcombats.ru/city/devilscity/day/dv_mouse.gif" oncontextmenu="return false;" width="126" height="192" title="" class="aFilter" /></div>
                      <div style="position: absolute; left:395px; top:159px; width:69px; height:26px; z-index: 90;"><img <? thisInfRm('9.180.0.414'); ?> src="//img.testcombats.ru/city/devilscity/day/dv_exit.gif" oncontextmenu="return false;" width="69" height="26" title="" class="aFilter" /></div>
                      <div style="position: absolute; left:208px; top:13px; width:81px; height:162px; z-index: 90;"><img <? thisInfRm('9.180.0.446'); ?> src="//img.testcombats.ru/city/devilscity/day/dv_fog.gif" oncontextmenu="return false;" width="81" height="162" title="" class="aFilter" /></div>
					  
					  
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
         <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.414'); ?>>Страшилкина улица</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.446'); ?>>Туманные Низины</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('7.180.0.622'); ?>>Перебежчик Брут</a></span>
        <!--<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('7.180.0.536'); ?>>Магазин</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('5.180.0.354'); ?>>Вокзал</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('7.180.0.621'); ?>>Почта</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('7.180.0.623'); ?>>Ремонтная мастерская</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('7.180.0.622'); ?>>Оптовой магазин</a></span>-->
       
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