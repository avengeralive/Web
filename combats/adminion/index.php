<?php
include_once('../_incl_data/__config.php');
define('GAME',true);
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');

include_once('_incl/__config.php');

if($u->info['admin']!=1 && $u->info['align']!=50 && $u->info['id']!=1){
	die('Нет прав доступа.');
}

	//Из магазина (изменение позиций)
	if(isset($_GET['action1']) && $_GET['action1']!=''){
		
		if($u->info['admin']==1){
		
			if($_GET['action1']=='updPos' && isset($_GET['id']) && $_GET['id']!='' && isset($_GET['newPos']) && $_GET['newPos']!='' && isset($_GET['sid']) && $_GET['sid']!=''){
				if(mysql_query('UPDATE `items_shop` SET `pos`="'.mysql_real_escape_string($_GET['newPos']).'" WHERE `item_id`="'.mysql_real_escape_string($_GET['id']).'" AND `sid`="'.mysql_real_escape_string($_GET['sid']).'" LIMIT 1;')){
					echo 'OK';
				}
			}

		}
		//Заказ екр у администрации алхимиком
		if($u->info['align']==50 || $u->info['admin']==1){
			if($_GET['action1']=='doOrder'){
				if(isset($_GET['contEkr']) && $_GET['contEkr']>0){
					$pl = mysql_fetch_array(mysql_query('SELECT `cur`,`USD` FROM `bank_table` ORDER BY `time` DESC LIMIT 1'));
					$ba = mysql_fetch_array(mysql_query("SELECT `procent` FROM `bank_alh` WHERE `uid` = '".mysql_real_escape_string($u->info['id'])."' LIMIT 1"));
					$ucur = round(round(($pl['cur']/$pl['USD']),4)/100*(100-$ba['procent']),2);
					$total = $_GET['contEkr']*$ucur;
					mysql_query('INSERT INTO `bank_alh_log` (`uid`,`kurs`,`ekr`,`money`,`moneyRUB`) VALUES ("'.$u->info['id'].'","'.$ucur.'","'.mysql_real_escape_string($_GET['contEkr']).'","'.$total.'","'.($total*$pl['USD']).'")');
					echo'Заявка отправлена на рассмотрение';
				}
				else{
					echo'Введите количество екр';
				}
			}
			//Показ истории заказов екр алхимиком у администрации
			elseif($_GET['action1']=='alchLoadStory'){
				
				$st = array(
					0=>'Рассматривается',
					1=>'Одобрено',
					2=>'Отклонено'
				);
				echo'
				История операций
					<table border="1"> 
						<tbody>
							<tr>
								<td>№</td>
								<td>Дата</td>
								<td>Валюта</td>
								<td>Курс</td>
								<td>Екр</td>
								<td>Сумма</td>
								<td>Статус</td>
							</tr>
							';
								$list = mysql_query('SELECT * FROM `bank_alh_log` WHERE `uid`="'.$u->info['id'].'" ORDER BY `id` DESC;');
								while($al = mysql_fetch_array($list)){
									echo'
										<tr>
										<td>'.$al['id'].'</td>
										<td>'.$al['date'].'</td>
										<td style="text-align: center;">$</td>
										<td>'.$al['kurs'].'</td>
										<td>'.$al['ekr'].'</td>
										<td>'.$al['money'].'</td>
										<td>'.$st[$al['status']].'</td>
										</tr>
									';
								}
				echo'
							
						</tbody>
					</table> 			
				';
			}
			//Подсчет стоимости екр при заказе алхимиком у администрации
			elseif($_GET['action1']=='countEkrMoney' && isset($_POST['ekrCount']) & $_POST['ekrCount']>0){
				$pl = mysql_fetch_array(mysql_query('SELECT `cur`,`USD` FROM `bank_table` ORDER BY `time` DESC LIMIT 1'));
				$ba = mysql_fetch_array(mysql_query("SELECT `procent` FROM `bank_alh` WHERE `uid` = '".mysql_real_escape_string($u->info['id'])."' LIMIT 1"));
				$ucur = round(round(($pl['cur']/$pl['USD']),4)/100*(100-$ba['procent']),2);
				
				$total = $_POST['ekrCount']*$ucur;
				
				echo $total;
			}
			
		}
		die();
	}


	if(isset($_GET['mod'])){
		$mod = htmlspecialchars($_GET['mod']);
		if(file_exists('./ajax/'.$mod.'.php')){
			include('./ajax/'.$mod.'.php');
		}else{
			echo 'Модуля <b>'.$mod.'</b> не существует';
		}
		die();
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Adminion <?=$c['adminionVer']?></title>
<link href="https://testcombats.ru/adminion/css/main.css" rel="stylesheet" type="text/css">
<link href="https://testcombats.ru/adminion/css/sheff.css" rel="stylesheet" type="text/css">
<link href="https://testcombats.ru/adminion/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="https://testcombats.ru/adminion/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
<script src="https://testcombats.ru/adminion/js/jquery.min_1.11.1.js"></script>
<script src="https://testcombats.ru/adminion/js/jquery-ui.min.js"></script>
<script src="https://testcombats.ru/adminion/js/jquery.datetimepicker.full.js" charset="utf-8"></script>
<script type="text/javascript" src="https://testcombats.ru/adminion/js/sheff.js"></script>
<script type="text/javascript" src="https://testcombats.ru/adminion/js/ckeditor.js"></script>

</head>
<body>
<div class="loading" id="loading">Загрузка...</div>
<div class="container">
<div class="header" id="header"></div>
<div style="display: flex;">
<div class="menu" id="menu"></div>
<div class="context" id="context"></div>
</div>
<div class="footer" id="footer"></div>
</div>

<script>
$(document).ready(function () {





load();
var timerId = setInterval(function() {header();}, 1000);


});








</script>
</body>
</html>