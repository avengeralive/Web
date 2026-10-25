<?
if( isset($s[1]) && $s[1] == '20/reshetka1' )
{
	/* Решетка * Телепортирует на необходимую клетку */
	//Все переменные сохранять в массиве $vad !

	$vad = array('go' => false);
	
	//Проверяем камни
	$vad['sp'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "2851" AND `uid` = "'.$u->info['id'].'"
	AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1'));

	if( isset($vad['sp']['id']) ) $vad['go'] = true;

	if( $vad['go'] == true )
	{
		mysql_query('UPDATE `stats` SET `x` = "5",`y` = "0",`s` = "4" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

		echo '<script>location.href="main.php"</script>';
	} elseif( !isset($vad['sp']['id']) )$r = 'Для прохода требуется предмет &quot;Ключ Отморозков&quot;';

	unset($vad);
}
?>