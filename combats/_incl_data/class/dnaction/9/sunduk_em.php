<?
if( isset($s[1]) && $s[1] == '103/sunduk_em' ) {
	//Все переменные сохранять в массиве $vad !
  if(isset($bots['id2'])) {
	$r = 'Не все боты убиты ...';
	$vad['go'] = false;
  }
	//Проверяем камни
	$vad['sp'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE (`item_id` = "9083") AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1'));
	if( isset($vad['sp']['id']) ) {
		// Удалена проверка на группировку предметов 13.10.2015
		$vad['pl'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$vad['sp']['item_id'].'" LIMIT 1'));
		$vad['go'] = true;
	}
	if( $vad['go'] == true ) {
		$vad['items'] = array(7314,7304,7301,7303,5042,5042,5042,5044,4936,4937,4928,4927,4926,4929,4917,4917,4917);
		$vad['items'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($vad['items'][rand(0,count($vad['items'])-1)]).'" LIMIT 1'));
		$upd = mysql_query('UPDATE `items_users` SET `lastUPD`="'.time().'",`delete`="'.time().'" WHERE `id`="'.$vad['sp']['id'].'" LIMIT 1');
		if($upd){
			$r = 'Вы растворили &quot;'.$vad['pl']['name'].'&quot;<br>';
			$r = 'Обыскав &quot;'.$obj['name'].'&quot; вы израсходовали Ключ от потерянного сундука обнаружили &quot;'.$vad['items']['name'].'&quot;';
		    $this->pickitem($obj,$vad['items']['id'],$u->info['id'],'',$vad['dn_delete'][$vad['items']['id']]);
			//echo '<script>location.href="main.php"</script>';
		} else {
			$r = 'Что-то пошло не так, попробуйте позже.';
		}
	}elseif( !isset($vad['sp']['id']) ) {
		$r = 'Требуется один Ключ от потерянного сундука';
	}
	unset($vad);
}
?>