<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();

$feeds = CXML::get_feed_boards($JSCat['user']);
$feedstat = CXML::feedstat($JSCat['user']); 

?>

<div id="top">
	<h1>Выгрузка
    	<i>XML фиды для площадок</i>
   </h1>
</div>

<table cellpadding="" cellspacing="" border="0" width="100%">
  <tr><td>Количество категорий</td><td colspan="5"><?php echo json_encode($feedstat['count'])?></td></tr>
  <tr><td>Общее количество объявлений</td><td colspan="5"><?php echo array_sum(array_column($feedstat['fields'], 'total')) ?></td></tr>
  <tr>
    <td width="50%">Объявлений в фиде</td>
    <td>Cian: <?php echo array_sum(array_column($feedstat['fields'], 'cian')) ?></td>
    <td>Avito: <?php echo array_sum(array_column($feedstat['fields'], 'avito')) ?></td>
    <td>Yandex: <?php echo array_sum(array_column($feedstat['fields'], 'yandex')) ?></td>
    <td>Domclick: <?php echo array_sum(array_column($feedstat['fields'], 'domclick')) ?></td>
    <td>N1: <?php echo array_sum(array_column($feedstat['fields'], 'n1')) ?></td>
  </tr>
  <tr>
    <td>Из них платных</td>
    <td>Cian: <?php echo (array_sum(array_column($feedstat['fields'], 'cianhighlight'))) + 
    		(array_sum(array_column($feedstat['fields'], 'cianpremium'))) +
    		(array_sum(array_column($feedstat['fields'], 'ciantop3'))) ?>
    </td>
    <td>Avito: <?php echo (array_sum(array_column($feedstat['fields'], 'avitoVIP'))) + 
    		(array_sum(array_column($feedstat['fields'], 'avitoPushUp'))) +
    		(array_sum(array_column($feedstat['fields'], 'avitoPremium'))) +
    		(array_sum(array_column($feedstat['fields'], 'avitoHighlight'))) +
    		(array_sum(array_column($feedstat['fields'], 'avitoQuickSale'))) +
    		(array_sum(array_column($feedstat['fields'], 'avitoTurboSale'))) ?></td>
    <td>Yandex: <?php echo (array_sum(array_column($feedstat['fields'], 'yandexraise'))) + 
    		(array_sum(array_column($feedstat['fields'], 'yandexpremium'))) +
    		(array_sum(array_column($feedstat['fields'], 'yandexpromotion'))) ?></td>
    <td>Domclick: 0</td>
    <td>N1: 0</td>
  </tr>
  <tr><td>Общий фид</td><td colspan="5"><input class="ios8" id="compare" <?php echo ($feedstat['compare'] == 1) ? 'checked="checked"' : '' ?> value="<?php echo $feedstat['compare']?>" type="checkbox"><label title="" for="compare"></label></td></tr>
  <tr><td>Снять премиум услуги</td><td colspan="5"><input class="ios8" id="premium" type="checkbox"><label title="" for="premium"></label></td></tr>
</table>

<div class="alerts">
<!-- 
	<h2>Мы самостоятельно выгрузим ваши объекты на 50+ площадок. Критерии:</h2>
 -->
	<h2>Рекомендации по выгрузке:</h2>
	<li>В объявлении используйте фотографии хорошего качества, без водяных знаков, указывайте подробное описание и детали объекта</li>
	<li>Не используйте базу собственников для наращивания объемов выгрузки. Есть вероятность, что площадки могут отклонить ваш фид.</li>
</div>

<div feed id="list">	
	<?php for ($i = 0; $i < count($feeds); $i++) {
		$buy = ($feeds[$i]['buy'] == '1') ? 'buy' : '';
		if ($feeds[$i]['on'] == '1') {
			$validator = ($feeds[$i]['link_doc']) ? ('<a href="'. $feeds[$i]['link_doc'] .'" target="_blank" rel="noopener noreferrer">Валидатор</a>') : '';
			$rules = ($feeds[$i]['link_rules']) ? ('<a href="'. $feeds[$i]['link_rules'] .'" target="_blank" rel="noopener noreferrer">Как подключить</a>') : '';
			echo '<div id="f'. $feeds[$i]['id'] .'" '. $buy .'>
				<span>'. $feeds[$i]['name'] .'<img src="'. $feeds[$i]['link_img'] .'" /><input type="text" value="'. $feeds[$i]['feedlink'] .'"></span>
				<span>'. $rules .'</span>
				<span>'. $validator .'</span>
			</div>';
		}
	} ?>
</div>

<script>
	
	$('#compare').change(update.bind(this, 'compare'));
	$('#premium').change(update.bind(this, 'premium'));	
	function update(id) {
		var json = {func:'CXML', domain:JSCat.domain, token:JSCat.token};
		json["action"] = id;
		json["status"] = $('#'+ id).is(":checked");
		$.post("/json/", json, function() {location.reload()});
	}	
		
</script>