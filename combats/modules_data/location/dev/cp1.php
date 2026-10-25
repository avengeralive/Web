<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

if( date('H') >= 22 || date('H') < 6 ) {
	$tattack = '<a style="color:#D8D8D8" style="cursor:pointer" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');">Напасть</a> &nbsp; ';
}
if($u->room['file']=='dev/cp1')
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

var rooms = ['1','1'];

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
                      <div style="position:relative; cursor: pointer; width: 500px; height: 268px;"  id="ione"><img src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dev_bg1_1.jpg" oncontextmenu="return false;" alt="" name="img_ione" width="500" height="268" border="0" id="img_ione"/></div>
					
					<div id="buttons_on_image" style="cursor: pointer; font-weight: bold; color: rgb(216, 216, 216); font-size: 10px; z-index: 99; text-shadow: rgb(0, 0, 0) 1px 1px 10px; position: absolute; bottom: 8px; right: 23px;top:250px;"> 
                         <? echo $tattack; ?>&nbsp;
					<span><a href="/news" target="_blank"><b style="color:white;">Новости</b></a></span> &nbsp;
					<span><a href="/forum" target="_blank"><b style="color:white;">Форум</b></a></span> &nbsp;
					<span><b style="color:white; "><img style="height: 10px;padding-top: 1px;" oncontextmenu="return false;" src="//img.testcombats.ru/i/city_ico/devilscity.gif">&nbsp;<? echo $rowonmax; ?></b></span> &nbsp;
					</div>
                    
                  <div style="position: absolute; left: 198px; top: 8px; width: 149px; height: 136px; z-index: 5;"><img <? thisInfRm('9.180.0.535'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_club.gif" oncontextmenu="return false;" width="149" height="136" title="" class="aFilter" /></div><!--Бойцовский Клуб-->
				  
                  <!--<div style="position: absolute; left: 376px; top: 118px; width: 79px; height: 88px; z-index: 91;"><img  <? thisInfRm('1.180.0.371'); ?> src="//img.testcombats.ru/city/demonscity/day/loto.gif" oncontextmenu="return false;" class="aFilter" width="86" height="63" /></div>-->
                  
				  <div style="position: absolute; left: 53px; top: 48px; width: 41px; height: 55px; z-index: 5;"><img  <? thisInfRm('9.180.0.531'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_shop.gif" oncontextmenu="return false;" width="41" height="55" title="" class="aFilter" /></div><!--Гос. Магазин-->
				
				 <div style="position: absolute; left: 343px; top: 31px; width: 49px; height: 52px; z-index: 5;"><img   <? thisInfRm('хх'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_temple.gif" oncontextmenu="return false;" width="49" height="52" title="" class="aFilter" /></div>
                  
				  <div style="position: absolute; left: 376px; top: 44px; width: 79px; height: 68px; z-index: 91;"><img  <? thisInfRm('9.180.0.533'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_repair.gif" oncontextmenu="return false;" width="79" height="68" title="" class="aFilter" /></div><!--Рем. Мастерская-->
                  
				  <div style="position: absolute; left: 96px; top: 3px; width: 32px; height: 60px; z-index: 91;"><img  <? thisInfRm('9.180.0.530'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_comshop.gif" oncontextmenu="return false;" width="32" height="60" title="" class="aFilter" /></div><!--Ком. Магазин-->
				  
				  <div style="position: absolute; left: 319px; top: 112px; width: 57px; height: 59px; z-index: 92;"><img  <? thisInfRm('9.180.0.532'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_post.gif" oncontextmenu="return false;" width="57" height="59" title="" class="aFilter" /></div><!--Почта-->
				  
				  <div style="position: absolute; left: 96px; top: 138px; width: 60px; height: 50px; z-index: 92;"><img  <? thisInfRm('9.180.0.412'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_station.gif" oncontextmenu="return false;" width="60" height="50" class="aFilter" /></div><!-- Вокзал -->
				  
				  <div style="position: absolute; left: 389px; top: 171px; width: 47px; height: 60px; z-index: 92;"><img  <? thisInfRm('8.180.0.x'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_optshop.gif" oncontextmenu="return false;" width="47" height="60" class="aFilter" /></div>
                 
				 <div style="position: absolute; left: 129px; top: 146px; width: 75px; height: 90px; z-index:99;"><img <? thisInfRm('8.180.0.х'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/stellav.gif" oncontextmenu="return false;" width="75" height="90" title="" class="aFilter" /></div>
                  
				  <div style="position: absolute; left: 244px; top: 186px; width: 21px; height: 15px; z-index: 91;"><img  <? thisInfRm('9.180.0.414'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_north.gif" oncontextmenu="return false;" width="21" height="15" title="" class="aFilter" /></div><!-- Стр улица -->
                  
                  <!--div style="position:absolute; left:446px; top:153px; width:30px; height:54px; z-index:94;"><img <? thisInfRm('9.180.0.414'); ?> src="//img.testcombats.ru/city/demonscity/day/dm_right.gif" oncontextmenu="return false;" width="30" height="54" class="aFilter" /></div-->
				  
				  <div style="position: absolute; left: 221px; top: 220px; width: 22px; height: 15px; z-index: 91;"><img <? thisInfRm('8.180.0.х'); ?> src="//img.testcombats.ru/city/devilscity/<? echo $now; ?>/dv_south.gif" oncontextmenu="return false;" width="22" height="15" title="" class="aFilter" /></div>
                  
                   
					<?
					if( date('m') == 12 || date('m') == 1 ) {
						//Елка НГ
					?>
					<div style="position: absolute; left: 43px; top: 150px; width: 32px; height: 43px; z-index: 100;"><img <? thisInfRm('1.180.0.208'); ?> src="//img.anticombats.com/newyear2014.png" width="60" height="90" title="" class="aFilter" /></div>
					<?
                    }
					?>
			
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
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.535'); ?>>Бойцовский Клуб</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.530'); ?>>Комиссионный магазин</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.531'); ?>>Государственный магазин</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.412'); ?>>Вокзал</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.532'); ?>>Почта</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.533'); ?>>Ремонтная мастерская</a></span>
		<!--span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('8.180.0.хх'); ?>>Оптовой магазин</a></span-->
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('9.180.0.414'); ?>>Страшилкина улица</a></span>
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