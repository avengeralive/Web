<?
if(!defined('GAME'))
{
	die();
}

//удаляем предмет (1 из кучи) , а так-же добавляем + 1 к репутации
if($u->info['room'] == 484)
{
	$u->deleteItem($itm['id']);
	mysql_query('UPDATE `rep` set `rep1` = `rep1` + 10 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	$u->error = 'Вы успешно использовали '.$itm['name'].'<br>Вы повысили репутацию Храма Знаний на +10 ед.';
}else{
	$u->error = ''.$itm['name'].' можно использовать только в локации Храм Знаний';
}
?>