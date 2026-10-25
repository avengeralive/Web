<?
session_start();
if(!defined('GAME')) {die();}

if(isset($_GET['newuidinv']))
{
	$newuid = mysql_fetch_array(mysql_query('SELECT * FROM `users`
	WHERE `login` = "'.mysql_real_escape_string($_GET['newuidinv']).'" OR `id` = "'.mysql_real_escape_string($_GET['newuidinv']).'"  LIMIT 1'));

	$uid = $newuid['id'];

	if($newuid['admin'] > $u->info['admin']){die('Вы не можете просматривать эту информацию.');}
}

if(!isset($newuid['id'])){die('Персонаж не найден.');}

$u->info['marker'] = 'inv';
$_SESSION['adm_inv'] = $newuid['id'];

if(isset($_GET['delete_adm']))
{
	$u->deleteItem(intval($_GET['delete_adm']),$newuid['id']);
}

if( !isset( $_GET['otdel'] ) || ( $_GET['otdel']<1 && $_GET['otdel']>7 ) )
{
	$_GET['otdel'] = 1; // Если раздел не указан.
	$_GET['paged'] = $_SESSION['paged'] = 0;
}

if( isset($_GET['otdel']) )
{
	if( !isset($_GET['paged']) && (isset($_GET['use_pid']) || isset($_GET['sid']) || isset($_GET['oid']) || isset($_GET['usecopr']) || isset($_GET['delcop'])) ) {
		$_GET['paged'] = $_SESSION['paged']; // use item and load old paging
	} elseif(isset($_GET['paged']) && $_GET['paged']!='') {
		$_SESSION['paged'] = $_GET['paged']; // Задаем новую страницу.
	} elseif(isset($_SESSION['paged']) && $_SESSION['paged']!='' && $_SESSION['otdel']==$_GET['otdel']) {
		$_GET['paged'] = $_SESSION['paged']; // Если страница уже имеется в сессии, возвращаем её в текущую.
	} else {
		$_GET['paged'] = $_SESSION['paged'] = 0;
	}
}

if(isset($_GET['newuidinv_type']))
{
	if($_GET['newuidinv_type']==1) $inshop = '1';
	elseif($_GET['newuidinv_type']==2)  $inshop = '30';
	else  $inshop = '0';
    if($_GET['newuidinv_type']==3)  $uid = '-21'.$newuid['clan'];
	elseif($_GET['newuidinv_type']==4)  $uid = '-51'.$newuid['id'];
} else $inshop = '0';

$inventorySortBox = '<div id="inventorySortBox">
	Сортировка: <br/>
		<input type="button" onclick="inventoryAjax(\'main.php?'.$zv.'=1&mAjax=true&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&boxsort=name&otdel=' . intval($_GET['otdel']) . '\');" value="названию" />
		<input type="button" onclick="inventoryAjax(\'main.php?'.$zv.'=1&mAjax=true&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&boxsort=cost&otdel=' . intval($_GET['otdel']) . '\');" value="цене" />
		<input type="button" onclick="inventoryAjax(\'main.php?'.$zv.'=1&mAjax=true&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&boxsort=type&otdel=' . intval($_GET['otdel']) . '\');" value="типу" />
</div>';

$filt='`lastUPD` DESC';
if(isset($_GET['boxsort']))
{
	switch($_GET['boxsort'])
	{
		case'name':
			$filt='`name` ASC';
		break;
		case'cost':
			$filt='`price2` DESC, `price1` DESC';
		break;
		case'type':
			$filt='`inslot`';
		break;
	}
}

$pc = 25;//Сколько показывать на одну страницу
$pg = round((int)@$_GET['paged']);
$pxc = $pg*$pc;
$nlim = ' LIMIT '.$pxc.' , '.$pc.'';

//Количество страниц - должен совпадать с запросом в $u->genInv 1357908642
$sql ='`im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'"';
$pages = mysql_query('SELECT `iu`.`id` FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `im`.`id` = `iu`.`item_id`
WHERE `iu`.`uid`="'.$newuid['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="'.$inshop.'" AND '.$sql.'
GROUP BY `im`.id, `iu`.item_id, `iu`.inGroup HAVING `iu`.inGroup > 0
UNION ALL SELECT `iu`.`id`
FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)
WHERE  `iu`.inGroup=0 AND `iu`.`uid`="'.$uid.'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="'.$inshop.'" AND '.$sql.'
GROUP BY `iu`.id, `iu`.item_id');
$pgs = mysql_num_rows($pages);

$page_look = '';

if($pgs > $pc)
{
	$page_look .= '<table border=0 cellpadding=0 cellspacing=0 width=100% bgcolor="#A5A5A5"><tr><td width=99% align=center style="min-height:18px;padding:2px 4px;">';
	$page_look .= 'Страницы: ';
	$i = 1;

	while($i <= ceil($pgs/$pc))
	{
        $page_look .= (($i-1 == $pg) ? '<b>'.$i.'</b> ' : '<a class="pgdas'.$sep.'" href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel='.$_GET['otdel'].'&rn=.'.$_GET['rn'].'&paged='.($i-1).'\');">'.$i.'</a> ');
		$i++;
	}
	$page_look .= '</td><td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>';
}
//if( isset($_GET['boxsort']) && $_GET['otdel']==5 ) {
	//if($_POST['subfilter']) {
		//$itmAll = $u->genInv(1,'`iu`.`uid`="'.$newuid['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `name` LIKE "%'.addcslashes(mysql_real_escape_string($_POST['filter']), '%_').'%" ORDER BY `name` ASC');
	//}
//} else {
	$itmAll = $u->genInv(1,'`iu`.`uid`="'.$uid.'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="'.$inshop.'" AND `im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'" ORDER BY '.$filt.''.$nlim);
//}

$itmAllSee = ($itmAll[0] > 0 ? $itmAll[2]: 'ПУСТО');

$clrb = '';
$clrba = '';

if($u->aves['now'] >= $u->aves['max'])
{
	$clrb = 'color:#BB0000;';
	$clrba = ' &nbsp; (У вас перегруз!)';
}

$showItems = '<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
		<table style="border: 1px solid grey;" width="100%" cellspacing="0" cellpadding="4" bgcolor="#d4d2d2">
	      <tr class="all_inv">
	        <td width="20%" style="border-right: 1px solid grey;" align=center class="' . ($_GET['newuidinv_type'] == 0 ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type=0&mAjax=true&otdel='.$_GET['otdel'].'&rn=.'.$_GET['rn'].'&paged=0\');">Инвентарь</a></td>
            <td width="20%" style="border-right: 1px solid grey;" align=center class="' . ($_GET['newuidinv_type'] == 1 ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type=1&mAjax=true&otdel='.$_GET['otdel'].'&rn=.'.$_GET['rn'].'&paged=0\');">Общежитие</a></td>
            <td width="20%" style="border-right: 1px solid grey;" align=center class="' . ($_GET['newuidinv_type'] == 2 ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type=2&mAjax=true&otdel='.$_GET['otdel'].'&rn=.'.$_GET['rn'].'&paged=0\');">Магазин</a></td>
            <td width="20%" style="border-right: 1px solid grey;" align=center class="' . ($_GET['newuidinv_type'] == 3 ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type=3&mAjax=true&otdel='.$_GET['otdel'].'&rn=.'.$_GET['rn'].'&paged=0\');">Хранилище</a></td>
            <td width="20%" style="border-right: 1px solid grey;" align=center class="' . ($_GET['newuidinv_type'] == 4 ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type=4&mAjax=true&otdel='.$_GET['otdel'].'&rn=.'.$_GET['rn'].'&paged=0\');">Почта</a></td>
		  </tr>
		  </tr>
	    </table>
	</td>
  </tr>
  <tr>
    <td valign="top">
		<table style="" width="100%" cellspacing="0" cellpadding="4" bgcolor="#d4d2d2">
	      <tr class="all_inv">
	        <td width="16%" style="border-right: 1px solid grey;" align=center class="' . (($_GET['otdel'] == 1) ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel=1&rn=1.1&paged=0\');">Обмундирование</a></td>
	        <td width="14%" style="border-right: 1px solid grey;" align=center class="' . (($_GET['otdel'] == 2) ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel=2&rn=2.1&paged=0\');">Заклятия</a></td>
	        <td width="14%" style="border-right: 1px solid grey;" align=center class="' . (($_GET['otdel'] == 3) ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel=3&rn=3.1&paged=0\');">Эликсиры</a></td>
	        <td width="14%" style="border-right: 1px solid grey;" align=center class="' . (($_GET['otdel'] == 5) ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel=5&rn=5.1&paged=0\');">Чарки</a></td>
			<td width="14%" style="border-right: 1px solid grey;" align=center class="' . (($_GET['otdel'] == 6) ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel=6&rn=6.1&paged=0\');">Руны</a></td>
	        <td width="14%" style="border-right: 1px solid grey;" align=center class="' . (($_GET['otdel'] == 7) ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel=7&rn=7.1&paged=0\');">Еда</a></td>
			<td width="14%" style="border-right: 1px solid grey;" align=center class="' . (($_GET['otdel'] == 4) ? 'inv_active' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?'.$zv.'=1&newuidinv='.$_GET['newuidinv'].'&newuidinv_type='.$_GET['newuidinv_type'].'&mAjax=true&otdel=4&rn=4.1&paged=0\');">Прочее</a></td>
	      </tr>
	    </table>
	</td>
  </tr>
  <tr>
    <td align="center">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top:0px; border-left: 1px solid #A5A5A5; border-right: 1px solid #A5A5A5;" bgcolor="#a5a5a5">
	      <tr>
	        <td align="left" valign="middle" style="color:#2b2c2c; height: 18px;font-size:12px; padding:4px;'.$clrb.'">Масса: ' . (0+$u->aves['now']) . ' / ' . $u->aves['max'] . ' '.$clrba.'<!--, предметов: ' . $u->aves['items'] . '--></td>
			<td align="center" valign="middle" style="color:#2b2c2c; font-size:12px"></td>
			<td align="right" valign="middle" style="color:#2b2c2c; font-size:12px; position:relative;">
			<form id="line_filter" style="display:inline;" onsubmit="return false;" prc_adsf="true">
				Поиск по имени: <div style="display:inline-block; position:relative; ">
				<input type="text" id="inpFilterName"  placeholder="Введите название предмета..."  autofocus="autofocus" 	size="44" autocomplete="off">
				<img style="position:absolute; cursor:pointer; right: 2px; top: 3px; width: 12px; height: 12px;" onclick="document.getElementById(\'inpFilterName\').value=\'\';invFilterByName();" title="Убрать фильтр (клавиша Esc)"  src="https://img.testcombats.ru/i/clear.gif">
				<input type="submit" style="display: none" id="inpFilterName_submit" value="Фильтр" onclick="return false">
				<div class="autocomplete-suggestions" style="position: absolute; display: none;top: 15px; left:0px; margin:0px auto; right: 0px; font-size:12px; font-family: Tahoma; max-height: 300px; z-index: 9999;"></div>
				</div>
			</form>

				<input type="button" onclick="inventorySort(this);" style="margin:0px 2px;" value="Сортировка" />
				'.$inventorySortBox.'
			</td>
	      </tr>
	    </table>
	</td>
  </tr>
  <tr>
    <td valign="top" align="center">
		<div style="border-bottom: 1px solid #A5A5A5;border-top: 1px solid #A5A5A5;" id="itmAllSee">
			<table width="100%" border="0" cellspacing="1" align="center" cellpadding="0" bgcolor="#A5A5A5">' . (( $u->info['invBlock'] == 0 ) ? $itmAllSee : '<div align="center" style="padding:10px;background-color:#A5A5A5;"><form method="post" action="main.php?inv=1&otdel='.$_GET['otdel'].'&relockinvent"><b>Рюкзак закрыт.</b><br><img title="Замок для рюкзака" src="/img.testcombats.ru/i/items/box_lock.gif"> Введите пароль: <input id="relockInv" name="relockInv" type="password"><input type="submit" value="Открыть"></form></div>' ) . '</table>
		</div>
	</td>
  </tr>
  <tr><td>'.$page_look.'</td></tr>
</table>
<script language="JavaScript">
 	if($.cookie(\'invFilterByName\')) $("#ShowInventory").hide();
	$(document).ready(function (){ $("#ShowInventory").show(); });
</script>';

if(isset($_GET['mAjax'])){exit($showItems);}
?>

<script type="text/javascript" src="/js/jquery.1.11.js"></script>
<script type="text/javascript" src="/js/jquery.cookie.1.4.1.js"></script>
<script type="text/javascript" src="/js/jquery.autocomplete.js"></script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top"  id="itmAll">
			<div style="z-index: 2; position: relative; width:100%; display:table; box-sizing: border-box; margin: 0px; padding: 0px 5px 3px 5px;">
				<div style="display:table-cell;" align="center"><h3>Вещи персонажа <?=$newuid['login'].' ['.$newuid['level'].'] ID: '.$newuid['id']?></h3></div>
				<div style="display:table-cell; text-align: right;"><input class="btnnew" type="button" onclick="top.frames['main'].location='main.php'" value="Вернуться" />

				</div>
			</div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" noresize="noresize">
				<? if( $u->error != '' )  { ?>
				<tr>
					<td>
						<div style="min-height:18px;padding:2px 4px;"><font color="#FF0000"><b><? echo $u->error; ?></b></font></div>
					</td>
				</tr>
				<? } ?> 
				<tr>
					<td id="ShowInventory"><?php echo $showItems; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script>
$.cookie('invFilterByName','');
var UpdateItemList;
	function inventorySort(e){
		if ( $('#inventorySortBox').css('display') =='none') {
			$('#inventorySortBox').show();
			$(e).addClass('focus');
		} else {
			$('#inventorySortBox').hide();
			$(e).removeClass('focus');
		}
	}
	function inventoryHeight() {
		var height = $('#itmAll').height();
		var heW = $(window).height();
		heW = heW-148; // 1060
		height = height-120; // 462
		var heMax = $("#itmAllSee").children('table').height();
		if (heMax > height) {
			if (heW > height) {
				$("#itmAllSee").height(heW);
			} else {
				$("#itmAllSee").height(height);
			}
		} else {
			$("#itmAllSee").height(heMax);
		}
	}
	//$(window).ready(function(){
		//inventoryHeight();
	//});
	//$(window).resize(function(){
		//inventoryHeight();
	//});

	function seetext(id) {
		var id = document.getElementById('close_text_itm'+id);
		if(id.style.display == 'none') {
			id.style.display = '';
		}else{
			id.style.display = 'none';
		}
	}

	function UpdateItemList(){
		var inv_names = [];
		var items = $('a.inv_name');
		$(items).each(function(){ if($.inArray($(this).text(), inv_names)<0) inv_names.push($(this).text()); });
		$('#inpFilterName').autocomplete({ lookup:inv_names, onSelect: invFilterByName });
	}
	function invFilterByName(){
  $.cookie('invFilterByName', '');
		var val = $('#inpFilterName').val();
		if (val == '') {$("a.inv_name").parents('.item').stop().show();}
		else {
			$.cookie('invFilterByName', val);
			$("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$("a.inv_name:contains('" + val + "')").parents('.item').stop().show();
		}
	}

	function inventoryAjax(url){
		$('#ShowInventory').html('<div align="center" style="padding:10px;background-color:#d4d2d2;color:grey;"><b>Загрузка...</b></div>');
		$.ajax({
			url: url,
			cache: false,
			dataType: 'html',
			success: function (html) {
				$('#ShowInventory').html(html);

				//inventoryHeight();
                UpdateItemList();
                $("html, body").animate({ scrollTop: 0 }, "slow");

				UpdateItemList();
			}
		});
	}

$(document).ready(function () {

	function UpdateItemList(){
		var inv_names = [];
		var items = $('a.inv_name');
		$(items).each(function(){ if($.inArray($(this).text(), inv_names)<0) inv_names.push($(this).text()); });
		$('#inpFilterName').autocomplete({ lookup:inv_names, onSelect: invFilterByName });
	}

	function invFilterByName(){
		$.cookie('invFilterByName', '');
		var val = $('#inpFilterName').val();
		if (val == '') $("a.inv_name").parent().parent().stop().show();
		else {
			$.cookie('invFilterByName', val);
			$("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$("a.inv_name:contains('" + val + "')").parents('.item').stop().show();
		}
	}

	UpdateItemList(); // пересчет предметов.
	invFilterByNameTimer=null;

	// просматриваем результат
	$('#line_filter').submit(function (){ $('#inpFilterName_submit').trigger('click'); });

	// Если в выпадающем списке предметов листаем при помощи клавиш Up и Down, автоматически просматриваем результат.
	$('#inpFilterName').keyup(function (e){ $('#inpFilterName_submit').trigger('click'); });

	// Запоминаем прошлый поиск предмета и активируем его при открытии инвентаря\сундука
	if ($.cookie('invFilterByName')) { $('#inpFilterName').val($.cookie('invFilterByName')); invFilterByName(); }

	// Автообновление в реальном времени при написании текста.
	$('#line_filter').click(function (){ window.clearInterval(invFilterByNameTimer); if($('#inpFilterName').val()=='')invFilterByName(); else invFilterByNameTimer=setTimeout(invFilterByName, 200); return false;} );


});

jQuery.expr[":"].contains = function (elem, i, match, array){
	return (elem.textContent || elem.innerText || jQuery.text(elem) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0;
}

</script>