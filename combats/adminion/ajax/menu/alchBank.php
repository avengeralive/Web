<?php
if(isset($_GET['action']) && $_GET['action']!=''){
	
	if($_GET['action']=='alchLogin' && isset($_POST['alchLogin']) && $_POST['alchLogin']!=''){
		$_POST['alchLogin'] = iconv('utf-8', 'cp1251', $_POST['alchLogin']);
		$checkAlch = mysql_query('SELECT `id`,`login` FROM `users` WHERE `login`="'.mysql_real_escape_string($_POST['alchLogin']).'" LIMIT 1;');
		if(mysql_num_rows($checkAlch)){
			$alch = mysql_fetch_array($checkAlch);
			echo'Персонаж: '.$alch['login'].'';
			$checkAlchBank = mysql_query('SELECT * FROM `bank_alh` WHERE `uid`="'.$alch['id'].'" LIMIT 1;');
			if(mysql_num_rows($checkAlchBank)){
				$alch2 = mysql_fetch_array($checkAlchBank);
				echo'<br>Алхимический счет №: <b>'.$alch2['id'].'</b>. <a onclick="alchEditLoad('.$alch2['id'].');return false;">Редактировать</a>
					<div id="alchEdit"></div>
				';
			}
			else{
				echo'<br>Алхимический счет №: <b>нет</b>. <a onclick="alchLoadCreate('.$alch['id'].');return false;">Создать</a>?
					<div id="alchCreate"></div>
				';
			}
		}
		else{
			echo'Персонаж не найден';
		}
	}
	elseif($_GET['action']=='alchLoadCreate' && isset($_GET['uid']) && $_GET['uid']!=''){
		$checkAlch = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id`="'.mysql_real_escape_string($_GET['uid']).'" LIMIT 1;'));
		$checkAlchBank = mysql_query('SELECT * FROM `bank_alh` WHERE `uid`="'.mysql_real_escape_string($_GET['uid']).'" LIMIT 1;');
		if(mysql_num_rows($checkAlchBank)<1){
			mysql_query('INSERT INTO `bank_alh` (`uid`) VALUES("'.mysql_real_escape_string($_GET['uid']).'")');
			mysql_query('UPDATE `users` SET `align`="50" WHERE `id`="'.mysql_real_escape_string($_GET['uid']).'" LIMIT 1;');
			echo'Счет '.mysql_insert_id().' успешно создан.<script>checkAlch(\''.$checkAlch['login'].'\');</script>';
		}
		else{
			echo'У данного алхимика счет уже существует';
		}
	}
	elseif($_GET['action']=='alchEditLoad' && isset($_GET['id']) && $_GET['id']!=''){
		
		$checkAlchBank = mysql_query('SELECT * FROM `bank_alh` WHERE `id`="'.mysql_real_escape_string($_GET['id']).'" LIMIT 1;');
		if(mysql_num_rows($checkAlchBank)){
			$alchBank = mysql_fetch_array($checkAlchBank);
			echo'<br>Редактирование счета № <b>'.$alchBank['id'].'</b><br>
				Скидка: <input type="number" min="0" step="0.01" id="alchDiscount" value="'.$alchBank['procent'].'"> %<br>
				<button onclick="alchSave('.$alchBank['id'].');">Сохранить</button>
				<div id="alchSaveStatus"></div>
			';
		}
		else{
			echo'Алхимический счет не найден';
		}
	}
	elseif($_GET['action']=='alchEditSave' && isset($_GET['id']) && $_GET['id']!=''){
		$checkAlchBank = mysql_query('SELECT * FROM `bank_alh` WHERE `id`="'.mysql_real_escape_string($_GET['id']).'" LIMIT 1;');
		if(mysql_num_rows($checkAlchBank)){
			$alchBank = mysql_fetch_array($checkAlchBank);
			if(isset($_POST['procent']) && $_POST['procent']>0){
				mysql_query('UPDATE `bank_alh` SET `procent`="'.$_POST['procent'].'" WHERE `id`="'.$alchBank['id'].'" LIMIT 1;');
				echo'Успешно сохранено';
			}
			
		}
		else{
			echo'Алхимический счет не найден';
		}
		
		
		
	}
	elseif($_GET['action']=='alchOrdersLoad'){
		$st = array(
			0=>'Рассматривается',
			1=>'Одобрено',
			2=>'Отклонено'
		);
		echo'
		Заказы алхимиков на получение екр
			<table style="width:950px; max-width:950px; margin: 0 auto;"> 
				<tbody>
					<tr>
						<td>№</td>
						<td>Дата</td>
						<td>Логин</td>
						<td>Валюта</td>
						<td>Курс</td>
						<td>Екр</td>
						<td>Сумма($)</td>
						<td>Сумма(&#8381;)</td>
						<td>Комментарий</td>
						<td>Статус</td>
					</tr>
					'; 
					$list = mysql_query('SELECT `bank_alh_log`.*,`users`.`login` FROM `bank_alh_log`,`users` WHERE `bank_alh_log`.`uid`=`users`.`id`  ORDER BY `id` DESC;');
					while($al = mysql_fetch_array($list)){
						echo'
							<tr>
								<td>'.$al['id'].'</td>
								<td>'.$al['date'].'</td>
								<td>'.$u->microLogin($al['uid'],1).'</td>
								<td style="text-align: center;">$</td>
								<td>'.$al['kurs'].'</td>
								<td>'.$al['ekr'].'</td>
								<td>'.$al['money'].'</td>
								<td>'.$al['moneyRUB'].'</td>
								<td><input type="text" value="'.$al['comment'].'" id="alch_comment" onchange="alchCommentUpd('.$al['id'].',this.value)"></td>';
								if($al['status']!='0'){
									$dis = 'disabled';
								}
								else{
									$dis = '';
								}
								echo'
								<td>
									<select id="orderStatus_'.$al['id'].'" onChange="alchSetOrderStatus('.$al['id'].',this.value);" '.$dis.'>';
									foreach ($st as $key => $value) {
										if($key==$al['status']){
											$sel = 'selected';
										}
										else{
											$sel='';
										}
										echo'<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
									}
									echo'
									</select>
								</td>
							</tr>
						';
					}
		echo'
					
				</tbody>
			</table>
			<div id="setOrderStatus"></div>
		';
	}
	elseif($_GET['action']=='alchSetOrderStatus' && isset($_GET['id']) && $_GET['id']!='' && isset($_GET['status']) && $_GET['status']!=''){
		
		$check = mysql_query('SELECT `id`,`uid`,`ekr` FROM `bank_alh_log` WHERE `id`="'.mysql_real_escape_string($_GET['id']).'" AND `status`="0"  LIMIT 1;');
		if(mysql_num_rows($check)){
			$alch = mysql_fetch_array($check);
			$alchInfo = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id`="'.$alch['uid'].'" LIMIT 1;'));
			if($_GET['status']=='1'){
				mysql_query('UPDATE `bank_alh` SET `ekr`=`ekr`+'.$alch['ekr'].' WHERE `uid`="'.$alch['uid'].'" LIMIT 1;');
				$text = 'Ваша заявка № <b>'.$alch['id'].'</b> на получение '.$alch['ekr'].' екр <b>одобрена</b>!';
			}
			elseif($_GET['status']=='2'){
				$text = 'Ваша заявка № <b>'.$alch['id'].'</b> на получение '.$alch['ekr'].' екр <b>отклонена</b>!';
			}
			mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("'.$text.'","capitalcity","'.$alchInfo['login'].'","6","1","-1")');
			
			mysql_query('UPDATE `bank_alh_log` SET `status`="'.mysql_real_escape_string($_GET['status']).'" WHERE `id`="'.mysql_real_escape_string($_GET['id']).'" AND `status`="0" LIMIT 1;');
			echo'Статус заказа: '.$_GET['id'].' успешно изменен.<script>alchDisableSelect('.$_GET['id'].');</script>';
		}
		else{
			echo'Ошибка: такого заказа не существует.';
		}
	}
	elseif($_GET['action']=='alchCommentUpd' && isset($_GET['id']) && $_GET['id']!=''){
		mysql_query('UPDATE `bank_alh_log` SET `comment`="'.$_GET['text'].'" WHERE `id`="'.$_GET['id'].'" LIMIT 1;');
	}
	die();
}
?>
<script>
function alchCommentUpd(id,text){
	$.ajax({
		url: "?mod=context&menu=alchBank&action=alchCommentUpd",
		type: "GET",
		data: "id="+id+"&text="+text+"", 
		success: function(data){}
	});
}

</script>
<style>
table {
	border-collapse: collapse;
}

td {
	border: 2px solid #999999;
	padding:3px;
}

</style>
Логин: <input type="text" name="login" id="alchLogin" oninput="checkAlch(this.value);">
<div id="alchResult"></div>
<div id="alchOrders" style="margin-top:15px;"><script>alchOrdersLoad();</script></div>
