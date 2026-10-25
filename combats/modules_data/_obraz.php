<?
if(!defined('GAME'))
{
	die();
}



?>
<style>
.fade {
  opacity: 1;
}

.fade:hover {
  opacity: 0.6;
}
</style>
<style>
.line {
    border-bottom-style: inset;
    border-bottom-width: 1px;
    border-collapse: separate;
    border-left-style: inset;
    border-left-width: 1px;
    border-right-style: inset;
    border-right-width: 1px;
    border-top-style: inset;
    border-top-width: 1px;
    color: rgb(0, 0, 0);
    display: block;
    font-family: Verdana, Arial, Helvetica, Tahoma, sans-serif;
    font-size: 13px;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    height: 1px;
    line-height: normal;
    text-align: start;
    white-space: normal;
    display: block;
-webkit-margin-before: 0.5em;
-webkit-margin-after: 0.5em;
-webkit-margin-start: auto;
-webkit-margin-end: auto;
border-style: inset;
border-width: 1px;
}
.title {
    COLOR: #8f0000;
    FONT-FAMILY: Arial;
    FONT-SIZE: 12pt;
    FONT-WEIGHT: bold;
    TEXT-ALIGN: center;
}
</style>
<script LANGUAGE='JavaScript'>
document.ondragstart = test;
//запрет на перетаскивание
document.onselectstart = test;
//запрет на выделение элементов страницы
document.oncontextmenu = test;
//запрет на выведение контекстного меню
function test() {
 return false
}
</SCRIPT>

<table width="100%" cellspacing="0" cellpadding="0">
  <form method="post" action="/main.php?inv">
    <tr>
	<td valign="top" align="right">
	<input type="submit" name="edit" value="Вернуться" /><br>
	</td>
	</tr>
	<tr>
	<td>
      <center><?echo '<b class="title">Выбрать образ персонажа</b> '.$u->microLogin($u->info['id'],1).'&nbsp;&nbsp;';?></center></br>
    </tr>
  </form>
</table>
<center>
<?
$sp = mysql_query('SELECT * FROM `obraz` WHERE `sex` = "'.$u->info['sex'].'" AND `level` <= "'.$u->info['level'].'"
AND (`login` = "" OR `login` = "'.$u->info['login'].'") AND (`uid` = "" OR `uid` = "'.$u->info['id'].'")
AND (`align` = "0" OR `align` = "'.$u->info['align'].'") AND (`clan` = "0" OR `clan` = "'.$u->info['clan'].'") ORDER BY `level` ASC, `img` ASC');
while($pl = mysql_fetch_array($sp))
{
	$tr = true;
	$trd = '';
	$po = $u->lookStats($pl['tr']);
	$t = $u->items['tr'];
	$x = 0;
	if( $pl['level'] > 0 ) {
		$trd .= "\r".'&bull; Уровень персонажа: '.$pl['level'].'';
	}
	if( $pl['itm'] > 0 ) {
		$pl['itm'] = explode(',',$pl['itm']);
		$j = 0;
		$tritm = '';
		while( $j < count($pl['itm']) ) {
			$itm_id = $pl['itm'][$j];
			if( $itm_id > 0 ) {
				$itm_id = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$itm_id.'" LIMIT 1'));
				$itm_id_true = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id` = "'.$itm_id['id'].'" AND
				`delete` = 0 AND `inOdet` > 0 AND `inShop` = 0 AND `uid` = "'.$u->info['id'].'"
				LIMIT 1'));
				if(!isset($itm_id_true['id'])) {
					$tr = false;
				}
				if( $j > 0 ) {
					$tritm .= ', ';
				}
				$tritm .= '&quot;'.$itm_id['name'].'&quot;';
			}
			$j++;
		}
		if( $tritm != '' ) {
			$trd .= "\r".'&bull; Предметы: '.$tritm.'';
		}
	}
	while($x < count($t))
	{
		$n = $t[$x];
		if(isset($po['tr_'.$n])) {
			$trd .= "\r".'&bull; '.$u->is[$n].': '.$po['tr_'.$n].'';
			if($po['tr_'.$n] > $u->stats[$n]) {
				$tr = false;
			}
		}
		$x++;
	}
	if( isset($i['tr_reputation']) && $i['tr_reputation']!=''){ // Требуемая репутация для покупки
				$need_rep = 0;
				$tr_rep = $this->lookStats($i['tr_reputation']);
				foreach($tr_rep as $row){
					if( $this->rep[$row[0]] >= $row[1] ){
						$need_rep++;
					}
				}
			} else $need_rep = 0;
	
	if( ($pl['tr'] == '' && $pl['itm'] == '') || $tr == true ) {
		if( $trd != '' ) {
			$trd = 'Требуется минимальное:'.$trd;
		}
		echo '<a href="/main.php?inv=1&obr_sel='.$pl['id'].'&rnd='.$code.'"><img class="fade" title="'.$trd.'" src="//img.testcombats.ru/i/obraz/'.$pl['sex'].'/'.$pl['img'].'" width="120" height="220" /></a> ';
	}
}
?>
</center>