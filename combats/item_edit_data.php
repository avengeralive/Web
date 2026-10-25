<?php
/*

	ядро дл€ обработки данных.
	ќбработка поединков, обработка за€вок, обработка ботов, обработка пещер, обработка турниров, обработка временных генераций

*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 1) {
	
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.mysql_real_escape_string($_GET['edit_item_data']).'" LIMIT 1'));
	if(isset($itm['id'])) {
		if(isset($_POST['newdata'])) {
			mysql_query('UPDATE `items_main_data` SET `data` = "'.mysql_real_escape_string($_POST['newdata']).'" WHERE `id` = "'.mysql_real_escape_string($itm['id']).'" LIMIT 1');
			die('<script>window.close();</script>');
		}
		echo '<form method="post" action="item_edit_data.php?edit_item_data='.$itm['items_id'].'"><b>Номер предмета: '.$itm['items_id'].'</b><br><textarea name="newdata" rows="20" cols="100">'.$itm['data'].'</textarea><br><input type="submit" value="Сохранить"></form>';
	}
}/* elseif( $u->info['admin'] == 1) {
	
				if(isset($_GET['id_su'])){
					$str2 = iconv("UTF-8", "WINDOWS-1251", $_POST['newname']);
					$re = mysql_query("UPDATE `items_main` SET `name` = '".$str2."' WHERE `id` = '".$_GET['id_su']."'");
				if($re){
					echo 'Вы успешно обновили название';
				}
			}	
				die('<script>window.close();</script>');
		}
		echo '<form method="post" action="item_edit_data.php?id_su='.$itm['items_id'].'"><b>Номер предмета: '.$itm['items_id'].'</b><br><textarea name="newname" rows="20" cols="100">'.$itm['name'].'</textarea><br><input type="submit" value="Cохранить"></form>';
	}
} */else{
	header('location: https://testcombats.ru/');
}
	
?>