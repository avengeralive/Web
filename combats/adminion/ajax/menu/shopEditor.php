<?php

$sid = array(

	0 => '',
	1 => 'Гос. маг',
	2 => 'Березка',
	3 => 'Книжный Магазин',
	5 => 'Коморка Луки',
	6 => 'Цветочный магазин',
	7 => 'Заросшая Кузница',
	8 => 'Елочный магазин',
	9 => 'Таверна',
	10=> 'Излом Хаоса',
	11=> 'Алтарь Крови',
	14=> 'Храмовая Лавка',
	17=> 'Грибоед',
	27 => '_shop_referal_',
	33 => 'hrump_shop',
	44 => 'shop_kat',
	45 => 'altar_cat',
	106=> 'Магазин Новичка',
	400=> 'Общий рыцарский магазин dungeon_shop_all',
	404=> 'shop_priz',
	609=> 'Универмаг',
	610=> 'Прилавок Забытых',
	700=> 'Наковальня',
	701=> 'ПТП',
	702=> 'Катакомбы',
	703=> 'Мгла',
	777=> 'artshop',
	801=> 'Пещера Тысячи Проклятий',
	802=> 'Бездна',
	803=> 'Катакомбы',
	804=> 'Пещера Мглы',
	805=> 'Потерянный Вход',
	

);

if(isset($_GET['action']) && $_GET['action']!=''){
	//Получение разделов определенного магазина
	if($_GET['action']=='getRazdel' && isset($_GET['id']) && $_GET['id']!=''){
		echo'&nbsp;&nbsp;&nbsp;Раздел:&nbsp;<select name="r_id" id="r_id" onChange="selShopRazCont('.$_GET['id'].',this.value);">';
		echo '<option value="0">Выберите раздел</option>'; 
		$sp = mysql_query('SELECT `r` FROM `items_shop` WHERE `sid` = "'.mysql_real_escape_string($_GET['id']).'" GROUP BY `r`');
		while( $pl = mysql_fetch_array($sp) ) {
			echo '<option value="'.$pl['r'].'">'.$pl['r'].'</option>'; 
		}
      echo'</select>';
	}
	//Вывод содержимого определенного ID раздела с определенным ID магазина
	elseif($_GET['action']=='selShopRazCont' && isset($_GET['id']) && $_GET['id']!='' && isset($_GET['selShop']) && $_GET['selShop']!=''){
	
		$sp = mysql_query('SELECT * FROM `items_shop` WHERE `sid` = "'.mysql_real_escape_string($_GET['selShop']).'" AND `r` = "'.mysql_real_escape_string($_GET['id']).'"');
		while( $pl = mysql_fetch_array($sp) ) {
			$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
			
			if($pl['tr_items']!=''){
				$pl['tr_items'] = ''.$pl['tr_items'].',';
			}
			else{
				$pl['tr_items'] = $pl['tr_items'];
			}
			
			echo'
			<div id="item_'.$pl['iid'].''.$itm['id'].'"><br><br>
				<div style="text-align:center;"><img src="//img.testcombats.ru/i/items/'.$itm['img'].'"></div>
				<div class="divTable" style="max-width:500px; margin: 0 auto;">
					<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell">ITS_IID: <b id="its_id">'.$pl['iid'].'</b>, ITM_ID:<b id="itm_id">'.$itm['id'].'</b></div>
						<div class="divTableCell"><a href="//'.$c['host'].'/item/'.$itm['id'].'" target="_blank">'.$itm['name'].'</a></div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">В магазине:</div>
						<div class="divTableCell"><input value="'.$pl['kolvo'].'" type="text" id="itm_'.$pl['iid'].'_x"> шт.</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Цена в базе:</div>
						<div class="divTableCell"><input value="'.$itm['price1'].'" type="text" id="itm_'.$itm['id'].'_b1"> кр.</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Цена в базе:</div>
						<div class="divTableCell"><input value="'.$itm['price2'].'" type="text" id="itm_'.$itm['id'].'_b2"> екр.</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Цена в базе:</div>
					<div class="divTableCell"><input value="'.$itm['price4'].'" type="text" id="itm_'.$itm['id'].'_b4"> реп.</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Цена в магазине:</div>
						<div class="divTableCell"><input value="'.$pl['price_1'].'" type="text" id="itm_'.$pl['iid'].'_p1"> кр.</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Цена в магазине:</div>
						<div class="divTableCell"><input value="'.$pl['price_2'].'" type="text" id="itm_'.$pl['iid'].'_p2"> екр.</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Цена в реп. храма:</div>
						<div class="divTableCell"><input value="'.$pl['price_4'].'" type="text" id="itm_'.$pl['iid'].'_p4"> реп.</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Требование ресурса:</div>
						<div class="divTableCell"><input value="'.$pl['tr_items'].'" type="text" id="itm_'.$pl['iid'].'_trres"></div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Поиск предмета:<br><small>(* для требований)</small></div>
						<div class="divTableCell">
							<input value="" type="number" id="sId" placeholder="id" onchange="shopEditorSearchId('.$pl['iid'].');" oninput="shopEditorSearchId('.$pl['iid'].');"><br>
							<input value="" type="text" id="sName" placeholder="название" onchange="shopEditorSearchName('.$pl['iid'].');" oninput="shopEditorSearchName('.$pl['iid'].');"><br>
							<div id="sResult"></div>
						</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell"><button onclick="saveItm('.$pl['iid'].','.$itm['id'].');">Сохранить изменения</button></div>
						<div class="divTableCell"><button onclick="delItmShop('.$pl['iid'].','.$itm['id'].');">Удалить из магазина(безвозвратно)</button></div>
					</div>
					</div>
				</div>
				
			</div>
			<div id="workMsg_'.$pl['iid'].''.$itm['id'].'" class="workMsg"></div>
			';
		}
	
	
	}
	//Сохранение данных определенного предмета
	
	// `items_shop`.`item_id` = `items_main`.`id`
	
	elseif($_GET['action']=='saveItm'){
/* 		echo'<pre>';
		print_r($_POST);
		echo'</pre>';  */
		
		//Количество
		$kolvo = $_POST['itm_'.$_POST['its_id'].'_x'];
		
		$_POST['prtr'] = trim($_POST['prtr'],','); 

		
		//Цена в магазине (items_shop)
		$priceShopKr = $_POST['itm_'.$_POST['its_id'].'_p1'];
		$priceShopEkr = $_POST['itm_'.$_POST['its_id'].'_p2'];
		$priceHramRep = $_POST['itm_'.$_POST['its_id'].'_p4'];

		//В базе (items_main)
		$priceMainKr = $_POST['itm_'.$_POST['itm_id'].'_b1'];
		$priceMainEkr = $_POST['itm_'.$_POST['itm_id'].'_b2'];
		$priceMainRepHram = $_POST['itm_'.$_POST['itm_id'].'_b4'];

		 mysql_query('UPDATE `items_shop` SET
		`kolvo` = "'.mysql_real_escape_string($kolvo).'",
		`price_1` = "'.mysql_real_escape_string($priceShopKr).'",
		`price_2` = "'.mysql_real_escape_string($priceShopEkr).'",
		`price_4` = "'.mysql_real_escape_string($priceHramRep).'",
		`tr_items` = "'.mysql_real_escape_string($_POST['prtr']).'"
		WHERE `iid` = "'.mysql_real_escape_string($_POST['its_id']).'" AND `sid`="'.mysql_real_escape_string($_POST['sid']).'" LIMIT 1;'); 

		$res = do_query('UPDATE `items_main` SET
		`price1` = "'.mysql_real_escape_string($priceMainKr).'",
		`price2` = "'.mysql_real_escape_string($priceMainEkr).'",
		`price4` = "'.mysql_real_escape_string($priceMainRepHram).'"
		WHERE `id` = "'.mysql_real_escape_string($_POST['itm_id']).'" LIMIT 1;');
		
		
		echo 'Успешно сохранено';
	}
	elseif($_GET['action']=='delItmShop'){
		mysql_query('DELETE FROM `items_shop` WHERE `iid` = "'.mysql_real_escape_string($_POST['id']).'" AND `sid`="'.mysql_real_escape_string($_POST['sid']).'" LIMIT 1;');
		echo'Успешно удалено';
	}
	
	
	elseif($_GET['action']=='sItemId' && isset($_GET['sId']) && $_GET['sId']!='' && isset($_GET['itId']) && $_GET['itId']!=''){
		$s = mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($_GET['sId']).'" ORDER BY `id` DESC');
		if(mysql_num_rows($s)>0){
			while($si = mysql_fetch_array($s)){
				echo ''.$si['name'].' - ID['.$si['id'].'] <input type="number" size="3" id="kolvo_'.$_GET['itId'].'_'.$si['id'].'" placeholder="кол-во"><a onclick="javascript:shopAddRes('.$si['id'].','.$_GET['itId'].')">+</a><br>';
			}
		}
		else{
			echo'Ничего не найдено';
		}
	}
	elseif($_GET['action']=='sItemName' && isset($_GET['sName']) && $_GET['sName']!='' && isset($_GET['itId']) && $_GET['itId']!=''){
		$_GET['sName'] = iconv('UTF-8', 'windows-1251', $_GET['sName']);
		$s = mysql_query('SELECT * FROM `items_main` WHERE `name` LIKE "%'.mysql_real_escape_string($_GET['sName']).'%" ORDER BY `id` DESC');
		if(mysql_num_rows($s)>0){
			while($si = mysql_fetch_array($s)){
				echo ''.$si['name'].' - ID['.$si['id'].'] <input type="number" size="3" id="kolvo_'.$_GET['itId'].'_'.$si['id'].'" placeholder="кол-во"><a onclick="javascript:shopAddRes('.$si['id'].','.$_GET['itId'].')">+</a><br>';
			}
		}
		else{
			echo'Ничего не найдено';
		}
	}	

	die();
}

?>

<div class="getRazdel">
	Магазин:&nbsp;
	<select name="shop_id" id="shop_id" onChange="selShop(this.value)">
	<option value="0">Выберите раздел</option>
	<?php
		$sp = mysql_query('SELECT `sid` FROM `items_shop` GROUP BY `sid`');
		while( $pl = mysql_fetch_array($sp) ) {
			echo '<option value="'.$pl['sid'].'">'.$sid[$pl['sid']].'</option>'; 
		}
	?>
	</select>
</div>
<div id="getRazdel" class="getRazdel"></div>
<div id="razdelContent" class="razdelContent"></div>