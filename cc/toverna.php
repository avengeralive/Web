<?php
if(!defined('GAME'))
{
	die();
}

$tattack = '';

	$tattack = 'onclick="top.useMagic(\'Пьяный мордобой\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');"';

if($u->room['file']=='cc/toverna')
{
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
					   <div style="position:relative; cursor: pointer; width: 780px;" id="ione"><img src="https://img.testcombats.ru/loca/capitalcity/alllock/tovern.png" id="img_ione" width="780" height="330"  border="1"/> <!--ЦП бг-->
                                    <div style="position: absolute; left: 480px; top: 70px; width: 137px; height: 220px; z-index: 94;">
                                        <img onclick="location.href='main.php?talk=31'"
                                             src="https://img.testcombats.ru/city/mlvillage_pers1.png" width="137" height="220"
                                             class="aFilter" title="Диалог с Олафом"/></div>
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
        
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.224'); ?>>Рыцарский зал</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <?php thisInfRm('1.180.0.221'); ?>>Торговый зал</a></span>
		<div style="display:none; height:0px " id="moveto"></div>
              </td>
        </tr>
      </table>
      	<small>
        <HR>
		
		<INPUT id="forum" class="btn btn-inverse" <?php echo $tattack; ?> value="Пьяный мордобой" type="button" name="forum">


       
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
