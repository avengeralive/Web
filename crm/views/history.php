<?php namespace lib;
	if (!in_array('partner', $RoleUser) && !in_array('partner', $RoleGroup)) die();	
	
	$post = ($_POST) ?: $_GET;
	$history = [];
	$Result = JBase::Query("select * from change_card where `item_id` = '". (int)$post['id']."'");
	if ($Result) {
		while($par = $Result->fetch_assoc()) {
			$history[$par['time']] = json_decode($par['detail'], true);
		}
	}

	//echo json_encode($history);
?>

<div id="top">
	<h1>История изменений заказа #<?=$post['id']?>
		<i>История изменений заказа</i>
   </h1>
</div>
<div id="list2">
	<?php  if ((int)$JSCat['hi'] !== 13) { //Разрешить оператору просматривать историю изменений заказа
		foreach ($history as $time => $value) {
			?>
			<table class="history">
				<?php if (is_array($value[0])) {?>
					<?php if (isset(array_keys($value)[0]) && array_keys($value)[0] != 'mp3') {?>
						
					<tr>
					<th>Пользователь: <?=($JSCat['operators'][$v['user']]['name'] != null) ? $JSCat['operators'][$v['user']]['name'] : 'admin' ?></th>
					<th colspan="2">Открыт: <?=date("Y-m-d H:i:s", $time)?></th>
					</tr>
					<tr>
					<td></td>
					<td colspan="2">Сохранен: <?=date("Y-m-d H:i:s", $time)?></td>
					</tr>
					<tr><th>Поле</th><th>Было</th><th>Стало</th></tr>
					
					
				<?php 
					}
				}
				foreach ($value as $key2 => $val2) {  ?>
						<tr>
							<?php if ($key2 != 'mp3') {?>
								<!--tr style="background:#<?=dechex($time)?>"-->
								<td><?=$val2['field']?></td>
								<td><?=$val2['old']?></td>
								<td><?=$val2['new']?></td>
							<?php } else {?>
						<td colspan="3"><audio src="<?=$val2['src']?>" controls></audio></td>
					<?php }?>
				</tr>
			<?php } ?>
		</table>
	<?php }
	} ?>
</div>
<div id="detail"></div>

<script>
	setInterval(() => {if (JSCat.mp != '1')  $('#list2 audio').remove()}, 1000) //Разрешить оператору прослушивать записи разговоров
</script>

