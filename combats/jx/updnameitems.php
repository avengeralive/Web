<?php
define('GAME',true);
include('../_incl_data/class/__db_connect.php');

if(isset($_GET['id_su'])){
    	$str2 = iconv("UTF-8", "WINDOWS-1251", $_POST['name']);
    	$re = mysql_query("UPDATE `items_main` SET `name` = '".$str2."' WHERE `id` = '".$_GET['id_su']."'");
	if($re){
		echo 'Вы успешно обновили название';
	}else{
		echo 'Ошибка';
	}
}   
?>