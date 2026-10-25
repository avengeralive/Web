<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

	$tattack = 'onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');"';

if($u->room['file']=='an/cp3')
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
					   <div style="position:relative; cursor: pointer; width: 780px;" id="ione"><img src="//img.testcombats.ru/loca/angelscity/park/angels_park_BG_<?php if( date('H') >= 22 || date('H') < 6 ) { echo 'night'; } ?>.png" id="img_ione" width="780" height="330"  border="1"/> <!--ЦП бг-->
					   <div style="cursor: pointer; position:absolute; left:357px; top:113px; width:75; height:46; z-index:90; "><img <?php thisInfRm('2.180.0.00'); ?> src="https://img.testcombats.ru/loca/angelscity/park/vorota.png" width="75" height="46" title="" class="aFilter" /></div> <!--Ворота -->
					   <div style="cursor: pointer; position:absolute; left:539px; top:115px; width:130; height:117; z-index:90; "><img <?php thisInfRm('2.180.0.244'); ?> src="https://img.testcombats.ru/loca/angelscity/park/znah.png" width="130" height="117" title="" class="aFilter" /></div> <!--Знаъарь -->
					   <div style="cursor: pointer; position:absolute; left:665px; top:255px; width:58; height:60; z-index:90; "><img <?php thisInfRm('2.180.0.395'); ?> src="https://img.testcombats.ru/loca/angelscity/angel_right.png" width="58" height="60" title="" class="aFilter" /></div> <!--Направо -->
					   <div style="cursor: pointer; position:absolute; left:50px; top:255px; width:58; height:60; z-index:90; "><img <?php thisInfRm('2.180.0.236'); ?> src="https://img.testcombats.ru/loca/angelscity/angel_left.png" width="58" height="60" title="" class="aFilter" /></div> <!--Налево -->
					   					   
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
        
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('2.180.0.234'); ?>>Центральная площадь</a></span>
<div style="display:none; height:0px " id="moveto"></div>
              </td>
        </tr>
      </table>
      	<small>

        <HR>
		
		<INPUT id="forum" class="btn btn-inverse" <?php echo $tattack; ?> value="Напасть" type="button" name="forum">


       
		<INPUT id="forum" class="btn btn-inverse" onclick="window.open('https://testcombats.ru/', '/', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Новости" type="button" name="forum">
          <?php $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<?php echo $code; ?>';" class="btn btn-inverse" value="Возврат" type="button" name="combats2"><?php } unset($hgo); ?>
          <INPUT id="forum" class="btn btn-inverse" onclick="window.open('https://testcombats.ru/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        <br />
        <strong>Внимание!</strong> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <U>только взломщикам</U> для кражи вашего героя.<BR>
        <em>Администрация.</em></small> <BR>
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