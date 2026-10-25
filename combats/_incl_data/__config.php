<?php
//error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
//ini_set('display_errors','off');
setlocale(LC_CTYPE ,"ru_RU.CP1251");

//if($_SERVER['REMOTE_ADDR']!='195.46.185.138')//!isset($u->info['id']) || $u->info['admin'] == 0 ||
//{
	//if(!isset($CRON_HOST)) die('Ведутся технические работы в течение 1-3 часа игра будет доступна');
//}


/* Конфигурации игры */
$c['title']  = 'Наш Бойцовский Клуб» - Бесплатная, современная браузерная онлайн игра'; //Название игры
$c['title2'] = ' - Бесплатная, современная онлайн игра посвященная сражениям и магии!';
$c['title3']  = 'Наш Бойцовский Клуб';
$c['name']   =  'Наш Бойцовский Клуб';
$c['keys']   = ''; //Ключевые слова META
$c['desc']   = ''; //Описание META

//Сервера
$c['host'] = (isset($CRON_HOST) ? $CRON_HOST : $_SERVER['HTTP_HOST']);
$c['host'] = str_replace('www.', '', $c['host']);

$c['doc_root']    = '/home/admin/web/'.$c['host'].'/public_html';
$c['forum']       = 'forum.'.$c['host'];
$c['img']   	  = 'img.testcombats.ru';
$c['img_root']    = '/home/admin/web/'.$c['img'].'/public_html';
$c['admin_email'] = 'сo@testcombats.ru';
$c['thiscity']    = 'capitalcity';
$c['capitalcity'] = $c['host'];
$c['abandonedplain'] = $c['host'];
$c['exit']		  = '<script>top.location="https://'.$c['host'].'/";</script><noscript><meta http-equiv="refresh" content="0; URL=https://'.$c['host'].'/"></noscript>';
//$c['admins'] = array(15260604);//Кому показывать отладки
$c['form_write'] = true;//запись данных форм

//Валюта
$c['curency_name'] = 'RUB';
$c['curency_value'] = 80;

//Бот клон
$c['bot_level'] = 6; // до какого лвл бот (включительно)
$c['propsk_die'] = 0; //Смерть при пропуске ходов, 0 - выкл. , >= 1 - количество пропусков до смерти при нападении

//Скупка
$c['exp'] = 0; //бонус опыта
$c['shop_type1'] = 100; //в гос НЕ ТРОГАТЬ
$c['shop_type2'] = 90; //в березку НЕ ТРОГАТЬ
$c['shop_all'] = 0; //Скупка на все! , 0 - сделать для отключения скупки.
$c['shop_all_type1'] = 99; //Скупка только с госе! , 0 - сделать для отключения скупки.
$c['shop_all_type2'] = 99; //Скупка только с березки! , 0 - сделать для отключения скупки. 
//
$c['nosanich']	 = false; //Странички Саныча не выпадают - true , выпадают - false
$c['zuby'] = false; //зубы
$c['limitedexp'] = true; //лимит опыта
$c['infinity5level'] = false; //вечные 5 уровни
$c['expstop'] = 100000000; //Опыт на котором останавливаемся
$c['noobgade'] = false; //нуб квест (пещера)
$c['bonusonline'] = false; //бонус за онлайн
$c['bonusonline_kof'] = 0; //коэфицент кр за лвл
$c['level_transfer'] = 8; //С какого уровня разрешены передачи
$c['znahar'] = true; //бесплатный знахарь
$c['nolevel'] = false; //лимитирование уровней
$c['noitembuy'] = false; //Не требует ресурсы для покупки
//$c['effz'] = 15; //Скольким секундам равен заряд
$c['money_haot'] = false; //кр за хаоты
$c['money_haot_proc'] = false; //сколько процентов от фулла выдает в награду
$c['crtoecr'] = 0; //Курс обмена кр на екр (если 0, то выключено)
$c['ecrtocr'] = 10; //Курс обмена екр на кр
$c['bonuslevel'] = true; //Бонус уровня
$c['bonussocial'] = false; //Бонус социальный
$c['exp_limit_many'] = true; //Лимит опыта, если более 5 боев, то 0 опыта даст

$c['exp_mega'] = false; //Повышенный лимит опыта
$c['exp_mega_val'] = array(
	0 => 0,
	1 => 0,
	2 => 0,
	3 => 0,
	4 => 0,
	5 => 0,
	6 => 0,
	7 => 0,
	8 => 0,
	9 => 0,
	10 => 0,
	11 => 0
); //Повышенный лимит опыта

$c['w'] = date('w');
$c['m'] = date('m');

//Игра
//$code = explode(' ',microtime());
//$code = $code[0].''.round($code[1]/rand(1,5));
$code = '1';

//Счетчики
$c['counters']  = '';

$c['copyright'] = 'Copyright © '.date('Y').' «Наш Бойцовский Клуб»';
$c['securetime'] = 0; //Время последнего возможного взлома персов (подбор пароля по базам данных других игр)
$c['skey'] = 'LAc0~GsPyYWl%m5d';

if(isset($_GET['version'])) die('Version: '.$c['ver'].'');

//Хаотические бои
$c['haos_maxplayers'] = 40;//максимальное количество игроков в хаотическом бою
$c['haos_time_start'] = 300;//макимальное время до начала боя в секундах

//Общий враг
$c['tj_maxplayers'] = 50;//максимальное количество игроков против общего врага
$c['tj_interval'] = 1500;//минимальный интервал милисекунд между ударами общего врага
$c['tj_interval_pr'] = 500;//минимальный интервал милисекунд между приемами на общего врага

//Лимит EKR стоимости комплекта для артов, например, для надевания свитков 5052-54
$c['art_limit'] = 2000;

//Комиссионка
$c['cs_com'] = 10;//Комиссия за продажу вещей в комиссионке

$c['cron_log'] = false;//Лог крона в файл

$c['edit_pass'] = '93209b9f662a204900f75fa3f9a45923';//Пароль редактирования - для опций админа

//Статусы боев - урон, коэф.1, коэф.2
$c['btl_status'] = array(
array(50000,  1,1,   '','<b color="red">Кровавый Поединок</b>'),
array(125000, 2,2.5, '<b color="red">Великая Битва</b>','<b color="red">Кровавая Битва</b>'),
array(225000, 3,3.75,'<b color="red">Величайшая Битва</b>','<b color="red">Кровавая Резня</b>'),
array(350000, 4,5,   '<b color="red">Историческая Битва</b>','<b color="red">Кровавая Сеча</b>'),
array(500000, 5,6.5, '<b color="red">Эпохальная Битва</b>','<b color="red">Кровавое Побоище</b>'),
array(75000000, 6,8, '<b color="red">Судный День</b>','<b color="red">Судный День</b>')
);

$c['aligns'] = array(
0=>array(0),
1=>array(0,1.1,1.5,1.6,1.7,1.75,1.9,1.91,1.92,1.81,1.99),
2=>array(0),
3=>array(0,3.01,3.05,3.06,3.07,3.075,3.09,3.091,3.092,3.81,3.99),
7=>array(0),
9=>array(0),
50=>array(0)
);

include_once('functions.php');

?>