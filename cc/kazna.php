<?
if(!defined('GAME'))
{
	die();
}
$tattack = '';

if($u->room['file']=='cc/kazna')
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; }  ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <div style="position:relative; cursor: pointer;" id="ione">
                      <img src="https://img.testcombats.ru/loca/new/torg/cap_bg_bank.jpg" alt="" name="img_ione" width="500" height="268" border="1" id="img_ione"/>
                      <div id="buttons_on_image" style="cursor:pointer; font-weight:bold; color:#D8D8D8; font-size:10px;">
                          <? echo $tattack; ?>
                          &nbsp;
                          <span onMouseMove="this.runtimeStyle.color = 'white';" onMouseOut="this.runtimeStyle.color = this.parentElement.style.color;" onclick="window.open('/forum', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')">Форум</span> &nbsp;
                      </div>
                      <script language="javascript" type="text/javascript">
                        <!--
                        if(document.getElementById('ione'))
                        {
                            document.getElementById('ione').appendChild(document.getElementById('buttons_on_image'));
                            document.getElementById('buttons_on_image').style.position = 'absolute';
                            document.getElementById('buttons_on_image').style.bottom = '8px';
                            document.getElementById('buttons_on_image').style.right = '23px';
                        }else{
                            document.getElementById('buttons_on_image').style.display = 'none';
                        }
                        -->
                      </script>
                                    <div style="position: absolute; left: 191px; top: 12px; width: 75px; height: 68px; z-index: 94;">
                                        <img onclick="location.href='main.php?talk=30'"
                                             src="https://img.testcombats.ru/city/1035_qpldntjv.png" width="120" height="220"
                                             class="aFilter" title="Диалог с Казначеем"/></div>
                        <div id="snow"></div>
                        <? echo $goline; ?>
                      </div>
                    </td>
                  </tr>
                </table>  
                <div style="display:none; height:0px " id="moveto"></div>      
              <div align="right" style="padding: 3px;"><small>&laquo;<? echo $c['title3']; ?>&raquo; приветствует Вас, <b><? echo $u->info['login']; ?></b>.<br />
              </small></div></td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table>
      	<small>
        <HR>
        <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" class="btn" value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>

        <br />
        <strong>Внимание!</strong> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <U>только взломщикам</U> для кражи вашего героя.<BR>
        <em>Администрация.</em></small> <BR>
        <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?
}

?>