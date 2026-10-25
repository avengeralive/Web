<?
if(!defined('GAME')) die();

//Выдаем предметы
$items = array(3101=>5,4466=>3,1463=>4,1461=>4,1001=>5,994=>5,4941=>5,4037=>5,4038=>5,4039=>5,4040=>5,4514=>3,4515=>3,3075=>10,4257=>5,
4247=>5,4252=>5,4262=>5,4267=>5,5020=>1);

foreach ($items as $key => $value)
{
	$idit = $u->addItem($key,$u->info['id'],'|noremont=1|sudba='.$u->info['login'], NULL, $value);
	mysql_query('UPDATE `items_users` SET `gift` = "PrimeBK" WHERE `id` = "'.$idit.'" LIMIT 1');//`iznosMAX` = "'.$value.'"
}

$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot;. В инвентарь добавлены подарки. С Днем Рождения клуба!';

mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');

?>