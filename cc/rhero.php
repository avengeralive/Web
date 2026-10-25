<?php
if(!defined('GAME')) die();

if($_GET['get']=='voin')
{
	if($u->stats['s6']==0)
	{
        $used = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "altar_voin" AND `time`>"'.time().'" LIMIT 1',1);
		if(!isset($used['id']))
		{
			$effs = array(42,43,310,281);
            do_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` IN (42,43,310,281)');

			foreach($effs as $eff) $magic->add_eff($u->info['id'], $eff);

	        $u->addAction(time()+3600*3, 'altar_voin', '', $u->info['id']);
			$re = "Получено: Усиление Алтарь Война!";
		} else $re = "Алтарь Война доступен 1 раз в 3 часа!";
	} else $re = "Вам недоступен Алтарь Война!";
}
elseif($_GET['get']=='mag')
{
    if($u->stats['s6']!=0)
	{
        $used = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "altar_mag" AND `time`>"'.time().'" LIMIT 1',1);
		if(!isset($used['id']))
		{
			$effs = array(42,43,440,281);
            do_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` IN (42,43,440,281)');

			foreach($effs as $eff) $magic->add_eff($u->info['id'], $eff);

	        $u->addAction(time()+3600*3, 'altar_mag', '', $u->info['id']);
            $re = "Получено: Усиление Алтарь Мага!";
		} else $re = "Алтарь Мага доступен 1 раз в 3 часа!";
	} else $re = "Вам недоступен Алтарь Мага!";
}

if($u->room['file']=='cc/rhero')
{
	if(date("H")>=6 && date("H")<22) $now = 'day';
	else $now = 'night';
?>

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
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <?
					if($re!='') echo '<font color="red"><b>'.$re.'</b></font>';
					if( $u->error != '' ) echo '<font color=red><b>'.err_tr().$u->error.'</font></b>';
				?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <div style="position:relative; cursor: pointer; width: 500px;" id="ione">
						  <div style="cursor:pointer; z-index:3; position: absolute; right: 0px; top: 0px; width:100%; height: 50px; background-color: linear-gradient(to top, #fefcea, #f1da36); #d7d7d7;">
	      				      <div style="display:none; height:0px " id="moveto"></div>
						  </div>
	                      <? echo $goline; ?>
						 <img src="https://img.testcombats.ru/city/rhero/ar_n_<? if( date('H') >= 22 || date('H') < 6 ) { echo 'night'; } ?>.jpg" id="img_ione" width="500" height="268"  border="1"/>
						 <div style="cursor: pointer; position:absolute; left:238px; top:59px; width:28; height:40; z-index:90;"><img <?php thisInfRm('1.180.0.479'); ?> src="https://img.testcombats.ru/city/rhero/rtng.png" width="28px" height="40px" title="" class="aFilter" /></div><!--Рейтинг-->
						 <div style="cursor: pointer; position:absolute; left:97px; top:161px; width:39; height:74; z-index:90;"><a href="?get=voin"><img src="https://img.testcombats.ru/city/rhero/altv1.png" width="39px" height="74px" title="" class="aFilter" /></a></div><!-- Алтарь Война -->
						 <div style="cursor: pointer; position:absolute; left:371px; top:165px; width:38; height:71; z-index:90;"><a href="?get=mag"><img src="https://img.testcombats.ru/city/rhero/altm1.png" width="38px" height="71px" title="" class="aFilter" /></a></div><!-- Алтарь Мага -->

						 <script language="javascript" type="text/javascript">
	                        if(document.getElementById('ione') && document.getElementById('buttons_on_image'))
	                        {
	                            document.getElementById('ione').appendChild(document.getElementById('buttons_on_image'));
	                            document.getElementById('buttons_on_image').style.position = 'absolute';
	                            document.getElementById('buttons_on_image').style.bottom = '8px';
	                            document.getElementById('buttons_on_image').style.right = '23px';
	                        }else if(document.getElementById('buttons_on_image')){
	                            document.getElementById('buttons_on_image').style.display = 'none';
	                        }

	                      </script>
						  <div id="snow"></div>
                      </div>
                    </td>
                  </tr>
                </table> 

		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.479'); ?>>Рейтинг Героев</a></span>
        <span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="?get=voin" class="menutop">Алтарь Война</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="?get=mag" class="menutop">Алтарь Мага</a></span>
		<span style="white-space:nowrap; padding-left:3px; padding-right:3px; height:10px"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" />&nbsp;<a href="#" class="menutop" <? thisInfRm('1.180.0.473'); ?>>Торговая улица</a></span>
         
              </td>
          	   <td></td>
        </tr>
      </table>
      	<small>
        <HR align="right" width="500">
		<INPUT id="forum" class="btnnew btn-success" onclick="top.useMagic('Нападение на персонажа','night_atack','pal_button8.gif',1,'main.php?nightatack=1');" value="Напасть" type="button" name="forum">
		<INPUT id="forum" class="btnnew btn-inverse" onclick="window.open('https://darkglow.testcombats.ru/', 'news', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Новости" type="button" name="forum">
        <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" class="btnnew btn-inverse" value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>
        <INPUT id="forum" class="btnnew btn-inverse" onclick="window.open('/forum/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        <br /><br /><? echo $rowonmax; ?><br />
      </div></td>
  </tr>
</table>
<?
}
?>