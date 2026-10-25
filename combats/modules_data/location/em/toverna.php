<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

	$tattack = 'onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');"';

if($u->room['file']=='cc/cp1')
{
	if(date("H")>=6 && date("H")<22) {
		$now = 'day';
	}else{
		$now = 'night';
	}
?>
<link href="/css/jquery-ui.min.css" rel="stylesheet" type="text/css">




<style>
    #dialog-link {
            padding: .4em 1em .4em 20px;
            text-decoration: none;
            position: relative;
    }
    #dialog-link span.ui-icon {
            margin: 0 5px 0 0;
            position: absolute;
            left: .2em;
            top: 50%;
            margin-top: -8px;
    }
</style>
<script>

// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
    function() {
            $( this ).addClass( "ui-state-hover" );
    },
    function() {
            $( this ).removeClass( "ui-state-hover" );
    }
);

<?php
if(date("H")<6 || date("H")>=22){
?>
function AtackNoWindow(){
    var dt = document.getElementById('atackDiv');
    if(dt.style.display=='none')
    {
            dt.style.display = '';
    }else{
            dt.style.display = 'none';
    }
}
<?php
}
?>
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
                <table width="590" border="0" cellspacing="0" cellpadding="0">
								<? if( $u->error != '' )  { ?>
                           <font color=red><b>
						<? echo $u->error; ?></font></b>
				<? } ?> 
                  <tr>
                    <td>
                      <div style="position:relative; cursor: pointer; width: 780px;" id="ione">
                      <div style="position: absolute; left: 4px; right: 0px; z-index: 1500; top: 5px;">
                      	<div id="frvrks" style="position:relative;"></div>
                      </div>
					  <?php/* if( date('m') == 12 || date('m') == 1 ) {*/ ?>
					   <div style="position:relative; cursor: pointer; width: 780px;" id="ione"><img src="https://img.testcombats.ru/loca/new/cp/vesna_cap_cp_<?php if( date('H') >= 22 || date('H') < 6 ) { echo 'night'; } ?>.png" id="img_ione" width="780" height="330"  border="1"/> <!--ЦП бг-->
					  <div style="cursor: pointer; position:absolute; left:18px; top:231px; width:38px; height:55px; z-index:90;"><img <?php thisInfRm('1.180.0.323'); ?> src="https://img.testcombats.ru/loca/new/cp/arr_left_png2.png" width="38px" height="55px" title="" class="aFilter" /></div> <!--Парковая улица-->
					  <div style="cursor: pointer; position:absolute; left:710px; top:260px; width:38; height:55; z-index:90; "><img <?php thisInfRm('1.180.0.11'); ?> src="https://img.testcombats.ru/loca/new/cp/arr_right_png2.png" width="38px" height="55px" title="" class="aFilter" /></div> <!--Страшилкина улица-->
                      <div style="cursor: pointer; position:absolute; left:105px; top:205px; width:70; height:46; z-index:90; "><img <?php thisInfRm('1.180.0.272'); ?> src="https://img.testcombats.ru/loca/new/cp/vesna_cap_kom.png" width="70px" height="46px" title="" class="aFilter" /></div> <!--Комок-->
					  <div style="cursor: pointer; position:absolute; left:171px; top:202px; width:122; height:77; z-index:100; "><img <?php thisInfRm('1.180.0.10'); ?> src="https://img.testcombats.ru/loca/new/cp/vesna_cap_shop2.png" width="122px" height="77px" title="" class="aFilter" /></div> <!--Гос-->
					  <div style="cursor: pointer; position:absolute; left:235px; top:30px; width:306; height:200; z-index:90; "><img <?php thisInfRm('1.180.0.3'); ?> src="https://img.testcombats.ru/loca/new/cp/vesna_cap_club2.png" width="306" height="200" title="" class="aFilter" /></div> <!--Бк-->
					  <div style="cursor: pointer; position:absolute; left:290px; top:202px; width:75; height:46; z-index:90; "><img <?php thisInfRm('1.180.0.210'); ?> src="https://img.testcombats.ru/loca/new/cp/vesna_cap_rem2.png" width="75" height="46" title="" class="aFilter" /></div><!--Ремонтная-->
					  <div style="cursor: pointer; position:absolute; left:435px; top:205px; width:110; height:76; z-index:90; "><img <?php thisInfRm('1.180.0.13'); ?> src="https://img.testcombats.ru/loca/new/cp/vesna_cap_berezka2.png" width="110" height="76" title="" class="aFilter" /></div><!--Береза-->
					  <div style="cursor: pointer; position:absolute; left:540px; top:180px; width:112; height:76; z-index:90; "><img <?php thisInfRm('1.180.0.226'); ?> src="https://img.testcombats.ru/loca/new/cp/vesna_cap_po4ta2.png" width="112" height="76" title="" class="aFilter" /></div><!--Почта-->
					  <div style="cursor: pointer; position:absolute; left:650px; top:180px; width:37; height:47; z-index:90; "><img <?php thisInfRm('1.180.0.473'); ?> src="https://img.testcombats.ru/loca/new/cp/cp_u2_png2.png" width="37px" height="47px" title="" class="aFilter" /></div> <!--Торговая улица-->
					  <div style="cursor: pointer; position:absolute; left:615px; top:230px; width:100; height:69; z-index:90; "><img <?php thisInfRm('1.180.0.371'); ?> src="https://img.testcombats.ru/loca/new/cp/vesna_cap_loto2.png" width="100px" height="69px" title="" class="aFilter" /></div> <!--Лото-->
					 <!--<div style="cursor: pointer; position:absolute; left:530px; top:260px; width:55; height:50; z-index:90; "><img <?php thisInfRm('1.180.0.477'); ?> src="https://img.testcombats.ru/loca/new/cp/zima_stella.png" width="55px" height="50px" title="" class="aFilter" /></div>--> <!--Стелла-->
                     <!-- <div style="cursor: pointer; position:absolute; left:140px; top:261px; width:59; height:49; z-index:90; "><img  src="https://img.testcombats.ru/loca/new/cp/snow_ball2.png" width="59px" height="49px" title="" class="aFilter" /></div>-->
					 <!-- <div style="position:absolute; cursor: pointer; left:325px; top:150px; width:102; height:148; z-index:90; "><img <?php thisInfRm('1.180.0.208'); ?> src="https://img.testcombats.ru/loca/new/cp/tree2.gif" width="90px" height="128px" title="" class="aFilter" /></div>-->
					  <?php /*}*/ ?>
					  <script language="javascript" type="text/javascript">
                        <!--
                        if(document.getElementById('ione') && document.getElementById('buttons_on_image'))
                        {
                            document.getElementById('ione').appendChild(document.getElementById('buttons_on_image'));
                            document.getElementById('buttons_on_image').style.position = 'absolute';
                            document.getElementById('buttons_on_image').style.bottom = '8px';
                            document.getElementById('buttons_on_image').style.right = '23px';
                        }
						else if(document.getElementById('buttons_on_image'))
						{
                            document.getElementById('buttons_on_image').style.display = 'none';
                        }
                        -->
                      </script>

                      
                        <div id="snow"></div>
                        <?php echo $goline; ?>
                      </div>
                    </td>
                  </tr>
                </table> 
<?php
if(date("H")<6 || date("H")>=22) 
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
        
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.323'); ?>>Парковая улица</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.11'); ?>>Страшилкина улица</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.272'); ?>>Комок</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.10'); ?>>Гос.Маг</a></span>
		<!--<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.478'); ?>>Снеговик</a></span>-->
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.3'); ?>>Бойцовский клуб</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.210'); ?>>Ремонтная мастерская</a></span>		
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.13'); ?>>Березка</a></span>		
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.226'); ?>>Почта</a></span>		
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.473'); ?>>Торговая улица</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.371'); ?>>Лото</a></span>



		<div style="display:none; height:0px " id="moveto"></div>
              </td>
        </tr>
      </table>
      	<small>
		 <?php
function testMonster( $mon , $type )
{
	$r = true;
	if(isset($mon['id'])) {
		//
		if($type == 'start') {
			//День недели
			if( $mon['start_day'] != -1 ) {
				if( ($mon['start_day'] < 7 && $mon['start_day'] != date('w')) || $mon['start_day'] != 7 ) {
					$r = false;
				}
			}
			//число
			if( $mon['start_dd'] != -1 ) {
				if( $mon['start_dd'] != date('j') ) {
					$r = false;
				}
			}
			//месец
			if( $mon['start_mm'] != -1 ) {
				if( $mon['start_mm'] != date('n') ) {
					$r = false;
				}
			}
			//час
			if( $mon['start_hh'] != -1 )
			{
				if( $mon['start_hh'] > date('G') || $mon['back_hh'] < date('G')) {
					$r = false;
                    //print 't1';
				}
				if( $mon['start_min'] != -1 )
				{
					if( $mon['start_min'] > (int)date('i')
					|| ($mon['back_min']<(int)date('i') && $mon['back_hh'] <= date('G'))
					||  $mon['start_min'] < (int)date('i') && $mon['start_hh'] < date('G') )
					{
						$r = false;
                        //print '<br>t2:'.$mon['start_min'].' '.(int)date('i');
					}
				}
			}
			//print '<br>start:'.$mon['start_hh'].':'.$mon['start_min'];
            //print '<br>time:'.(int)date('G').':'.(int)date('i');
			//print '<br>пуск: '.($r==true ? 'да' : 'нет');

		}elseif($type == 'back') {
			//День недели
			if( $mon['back_day'] != -1 ) {
				if( ($mon['back_day'] < 7 && $mon['back_day'] != date('w')) || $mon['back_day'] != 7 ) {
					$r = false;
				}
			}
			//число
			if( $mon['back_dd'] != -1 ) {
				if( $mon['back_dd'] != date('j') ) {
					$r = false;
				}
			}
			//месец
			if( $mon['back_mm'] != -1 ) {
				if( $mon['back_mm'] != date('n') ) {
					$r = false;
				}
			}
			//часы и мин
			if( $mon['back_hh'] != -1 )
			{
				if( $mon['back_hh'] > date('G') ) {
					$r = false;
				}
				if( $mon['back_min'] != -1 ) {
					if( $mon['back_min'] >= (int)date('i') && $mon['back_hh'] == date('G') ) {
						$r = false;
					}
				}
			}

			//Вышел и не может уйти по какой-то причине
            if( $mon['back_hh'] != -1 && $mon['back_min'] != -1)
			{
				if($mon['back_hh'] < date('G') || ($mon['back_min']+60 < (int)date('i') && $mon['back_hh'] == date('G')))
				{
					$r = true;
				}
			}

            //print '<br>end:'.$mon['back_hh'].':'.$mon['back_min'];
            //print '<br>time:'.(int)date('G').':'.(int)date('i');
			//print '<br>стоп: '.($r==true ? 'да' : 'нет');
		}else{
			//что-то другое
			$r = false;
		}
		//
	}
	return $r;
}

		$sp = mysql_query('SELECT * FROM `aaa_monsters` ORDER BY `start_hh`');
		if(mysql_num_rows($sp) > 0)
		{
			echo '<a class="mon_atack" onclick="showDlg();return false;">Расписание атак монстров</a>';
	        echo '<div class="d_hide" id="dialog" title="Расписание атак монстров">';


			while( $pl = mysql_fetch_array($sp) )
			{
				$btc = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
				if( isset($btc['id']) )
				{
					if( testMonster($pl,'start') == true )
					{
	                    $btl3 = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = '.$btc['id'].' AND `time_over` < "'.time().'"'));
						if($btl3) echo '<a href="/info/'.$btc['id'].'" target="_blank">'.$btc['login'].'</a> <b>уже в битве!</b><br>';
	                    else echo '<a href="/info/'.$btc['id'].'" target="_blank">'.$btc['login'].'</a> <b>уже вышел!</b><br>';
					}else{
						if( $pl['start_hh'] != -1 )
						{
	      					if ($pl['start_mm'] == - 1 ) {$pl['start_mm'] = '00';}

							$time_st = $pl['time_start']+$pl['time_restart']*60;
							$day_st = (date('d', $time_st)==date('d', time()) ? "сегодня" : "завтра");

							//echo '<a href="/info/'.$btc['id'].'" target="_blank">'.$btc['login'].'</a> появится в '.$pl['start_hh'].':'.$pl['start_mm'].'<br>';
	                        echo '<a href="/info/'.$btc['id'].'" target="_blank">'.$btc['login'].'</a> появится '.$day_st.' в '.date('G:i', $time_st).'<br>';
						}
					}
				}
			}

	        echo'</div>';
	    }
		?>
        <HR>
		
		<INPUT id="forum" class="btn btn-inverse" <?php echo $tattack; ?> value="Напасть" type="button" name="forum">


       
		<INPUT id="forum" class="btn btn-inverse" onclick="window.open('https://testcombats.ru/', '/', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Новости" type="button" name="forum">
          <?php $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<?php echo $code; ?>';" class="btn btn-inverse" value="Возврат" type="button" name="combats2"><?php } unset($hgo); ?>
          <INPUT id="forum" class="btn btn-inverse" onclick="window.open('https://testcombats.ru/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        <br />
        <!--<strong>Внимание!</strong> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <U>только взломщикам</U> для кражи вашего героя.<BR>
        <em>Администрация.</em></small> <BR>-->
       <?php echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?php
}
?>
<style>
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

</script>