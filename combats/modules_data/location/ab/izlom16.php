<?
if(!defined('GAME'))
{
	die();
}
$tattack = '';

if($u->room['file']=='ab/izlom16')
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; }  ?>
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
                      <img src="https://img.testcombats.ru/i/images/300x225/ap_bg_iz_npc100500.jpg" alt="" name="img_ione" width="500" height="268" border="1" id="img_ione"/>
                      <div id="buttons_on_image" style="cursor:pointer; font-weight:bold; color:#D8D8D8; font-size:10px;">
                      </div>
                      
                      <div style="position: absolute; left: 430px; top: 196px; width: 48px; height: 33px; z-index: 94;"><img <? thisInfRm('3.180.0.268'); ?> src="https://img.testcombats.ru/i/images/300x225/ab_iz_exit.gif" width="48" height="33" class="aFilter" /></div><!--Загадочное Место-->
                      <div style="position: absolute; left: 278px; top: 53px; width: 167px; height: 94px; z-index: 94;"><img <? thisInfRm('3.180.0.269'); ?> src="https://img.testcombats.ru/i/images/300x225/ab_iz_gate.gif" width="167" height="94" class="aFilter" /></div>
			<div style="position: absolute; left: 22px; top: 161px; width: 75px; height: 68px; z-index: 94;"><img <? thisInfRm('3.180.0.270'); ?> src="https://img.testcombats.ru/i/images/300x225/ab_iz_shop.gif" width="75" height="68" class="aFilter" /></div>
                      <div style="position: absolute; left: 112px; top: 13px; width: 75px; height: 68px; z-index: 94;"><img onclick="location.href='main.php?talk=4'" src="https://img.testcombats.ru/i/images/300x225/ab_iz_npc.gif" width="110" height="177" class="aFilter" title="Диалог с Шейла" /></div>
                      <div id="snow"></div>
                        <? echo $goline; ?>
                      </div>
                    </td>
                  </tr>
                </table>   
                <div style="display:none; height:0px " id="moveto"></div>     
              </td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table><div style="width: 500px;">
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
<?
}

?>