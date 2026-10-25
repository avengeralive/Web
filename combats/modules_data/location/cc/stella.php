<?php
if(!defined('GAME'))
{
 die();
}
if($u->room['file']=='cc/stella')
{
if( isset($_GET['1'])) {
	$p = 300;
	if($u->info['money'] < $p) {
	echo '<font color=red><b>У вас недостаточно еврокредиты.<br></font></b>';
	}else{
		$additm = $u->addItem(4945,$u->info['id'],'|onlyOne=1');
		if( $additm > 0 ) {
		$u->info['money2'] -= 300;
		$_GET['login'] = $u->info['login']; //на кого кастуем
		$magic->useItems($additm);
		unset($_GET['login']);
		do_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		do_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
		}
	}
}
?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><div align="center" class="pH3">Стелла Выбора</div>
    <br />
	
		
		<fieldset>
<legend style="color:brown;">Вы можете тут обрести любую склонность на ваш выбор:</legend>

<? echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?get&1\';" onMouseOver="top.hi(this,\'<b>Светлая Склонность</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/align_light.gif"></td><td class="cp"><b>Светлая Склонность</b> - стоимость использования <b>300 екр.</b></td></tr></tbody></table>';
echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?get&7\';" onMouseOver="top.hi(this,\'<b>Нейтральная Склонность</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/align_neitral.gif"></td><td class="cp"><b>Нейтральная Склонность</b> - стоимость использования <b>300 екр.</b></td></tr></tbody></table>';
echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?get&3\';" onMouseOver="top.hi(this,\'<b>Тёмная Склонность</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/align_dark.gif"></td><td class="cp"><b>Тёмная Склонность</b> - стоимость использования <b>300 екр.</b></td></tr></tbody></table>';
?>

</fieldset>
	
	</td>
    <td width="280" valign="top"><table align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100%">&nbsp;</td>
        <td><table  border="0" cellpadding="0" cellspacing="0">
          <tr align="right" valign="top">
            <td><!-- -->
              <? echo $goLis; ?>
              <!-- -->
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
                    <tr>
                      <td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
                      <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.9';" title="<? thisInfRm('1.180.0.9',1); ?>">Центральная площаль</a></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
		</td>
      </tr>
    </table>
      <div><br />
	  </div></td>
  </tr>
</table>


<? } ?>