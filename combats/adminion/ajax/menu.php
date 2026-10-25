<?php

include_once('../_incl_data/__config.php');
define('GAME',true);
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');

if($u->info['admin']=000000){
	echo'<ul><li><a onclick="lC(\'alchBank\');return false;">Счета алхимиков</a></li></ul>';
}
else{
?>
<b>Общие</b>
<ul>
	<li><a onclick="lC('workList');return false;">Тикеты</a></li>
	<li><a onclick="lC('hmonitor');return false;">Поединки</a></li>
    <li><a href="/adminion/mod/bots.php" target="_blank">Боты</a></li>
    <li><a href="/adminion/mod/users-online.php" target="_blank">Игроки</a></li>
</ul>
<br>
<b>Система</b>
<ul>
	<li><a onclick="lC('DBstat');return false;">Статистика БД</a></li>
    <li><a href="/adminion/mod/error_logs.php" target="_blank">Лог ошибок</a></li>
	<li><a href="/adminion/mod/cron_logs.php" target="_blank">Лог крона</a></li>
    <li><a href="/adminion/mod/tester.php" target="_blank">Тестер</a></li>
</ul>
<br>
<b>Поиск</b>
<ul>
	<li><a onclick="lC('priemSearch');return false;">Поиск приема</a></li>
	<li><a onclick="lC('userSearch');return false;">Поиск персонажа</a></li>
    <li><a onclick="lC('itemSearch');return false;">Поиск предмета</a></li>
    <li><a onclick="lC('objectSearch');return false;">Поиск объекта</a></li>
</ul>
<br>
<b>Персонажи</b>
<ul>
	
	<li>Редактор персонажа</li>
</ul>
<br>
<b>Предметы</b>
<ul>

	<li><a onclick="lC('');return false;">Добавить предмет</a></li>
	<li><a onclick="lC('test');return false;">Добавить в магазин</a></li>
	<li><a onclick="lC('userItemEditor');return false;">Предметы у персонажей</a></li>
    <li>Редактор предмета</li>
</ul>
<br>
<b>Локации</b>
<ul>
	<li><a onclick="lC('roomEditor');return false;">Редактор локаций</a></li>
	<li>Добавить локацию</li>
</ul>
<br>
<b>Действия</b>
<ul>
	<li><a onclick="lC('moderLogs');return false;">Посмотреть действия</a></li>
	<li><a onclick="lC('clanEditor');return false;">Кланы</a></li>
	<li>Проверить переводы</li>
	<li>Проверить действия</li>
    <li><a onclick="lC('balance_111');return false;">Баланс</a></li>
</ul>
<br>
<b>Действия с чатом</b>
<ul>
	<li><a onclick="lC('spamList');return false;">Спам лист</a></li>
	<li>Проверить чат</li>
</ul>
<br>
<b>Пещеры</b>
<ul>
	<li>Редактор лабиринтов</li>
	<li><a onclick="lC('botEditor');return false;">Редактор ботов</a></li>
	<li><a onclick="lC('complectBotEditor');return false;">Редактор комплектов ботов</a></li>
	<li><a href="/adminion/ajax/menu/dn_editor.php" target="_blank">Редактор пещер</a></li>
	<li>Редактор обьектов</li>
	<li>Создать пещеру</li>
	<li>Редактор квестов</li>
	<li>Создать квест</li>
	<li><a onclick="lC('shopEditor');return false;">Редактор Магазинов</a></li>
</ul>
<?php
}

/*if($u->info['admin']==1)
{
	echo'<ul><li><a onclick="lC(\'alchBank\');return false;">Счета алхимиков</a></li></ul>';
}*/
?>
<br>
<ul>
<li><a href="/battle">Выход</a></li>
</ul>