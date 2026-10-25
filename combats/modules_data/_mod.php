<?
if(!defined('GAME')) {
	die();
}

session_start();


if(isset($realUser['align']))
{
	$align_temp = $u->info['align'];
    $u->info['align'] = $realUser['align'];
}

$rang = '';
if(floor($u->info['align'])==1) { 
	$rang = 'Паладин'; 
}elseif(floor($u->info['align'])==3) {
	$rang = 'Тарман'; 
}elseif($u->info['admin']>0){ 
	$rang = 'Ангел'; 
}else{
	$rang = '<b>Неизвестное существо</b>';
}

if(isset($_GET['exitMod'])) {
	unset($_SESSION['palpsw']);
}

if(isset($_GET['remod'])) {
	if($_GET['remod']==1) {
		$_SESSION['remod'] = 3;
	}else{
		$_SESSION['remod'] = 1;
	}
}

$zv = array(1=>'light',2=>'admin',3=>'dark');

$merror = '';

if($u->info['admin']>0)
{
	if($_SESSION['remod']==3 || !isset($_SESSION['remod']))
	{
		$u->info['align'] = '3.99';
	}elseif($_SESSION['remod']==1)
	{
		$u->info['align'] = '1.99';
	}
}

$mod_login = $u->info['login'];

if($u->info['invise'] > 0) {
	$mod_login = "<b>Невидимка</b>";
}

//возможности (перечисляем)
$vz_id = array(
0=>'m1',
1=>'mm1',
2=>'m2',
3=>'mm2',
4=>'sm1',
5=>'sm2',
6=>'citym1',
7=>'citym2',
8=>'citysm1',
9=>'citysm2',
10=>'addld',
11=>'cityaddld',
12=>'seeld',
13=>'telegraf',
14=>'f1',
15=>'f2',
16=>'f3',
17=>'f4',
18=>'f5',
19=>'f6',
20=>'f7',
21=>'f8',
22=>'boi',
23=>'elka',
24=>'haos',
25=>'haosInf',
26=>'deletInfo',
27=>'zatoch',
28=>'banned',
29=>'unbanned',
30=>'readPerevod',
31=>'provItm',
32=>'provMsg',
33=>'trPass',
34=>'shaos',
35=>'szatoch',
36=>'editAlign',
37=>'priemIskl',
38=>'proverka',
39=>'marry',
40=>'ban0',
41=>'useunnoper',
42=>'usenoper',
43=>'useunalign',
44=>'usealign1',
45=>'usealign3',
46=>'usealign7',
47=>'useuntravm',
48=>'heal',
49=>'invis',
50=>'attack',
51=>'sex',
52=>'unbtl',
53=>'nick',
54=>'testchat',
55=>'newuidinv');
//названия возможностей
$vz = array(
'm1'=>'Заклятие молчания',
'mm1'=>'Заклятие молчания (3 дн.)',
'm2'=>'Заклятие форумного молчания',
'mm2'=>'Заклятие форумного молчания (3 дн.)',
'sm1'=>'Снять молчанку',
'sm2'=>'Снять форумную молчанку',
'citym1'=>'Заклятие молчания (междугородняя)',
'citym2'=>'Заклятие форумного молчания (междугородняя)',
'citysm1'=>'Снять молчанку (междугородняя)',
'citysm2'=>'Снять форумную молчанку (междугородняя)',
'addld'=>'Добавить запись в личное дело',
'cityaddld'=>'Добавить запись в личное дело (междугородняя)',
'seeld'=>'Просмотр личного дела',
'telegraf'=>'Телеграф',
'f1'=>'Форум. Ответ в ответе',
'f2'=>'Форум. Удаление ответа',
'f3'=>'Форум. Восстановление темы',
'f4'=>'Форум. Удаление темы',
'f5'=>'Форум. Перемещение темы',
'f6'=>'Форум. Прикрепление / Открепление темы',
'f7'=>'Форум. Возобновление обсуждения',
'f8'=>'Форум. Закрытие обсуждения',
'boi'=>'Модерация боев',
'elka'=>'Модерация ёлки',
'haos'=>'Хаос',
'haosInf'=>'Хаос (бессрочно)',
'deletInfo'=>'Снять / Наложить Обезличивание',
'zatoch'=>'Заточение персонажа',
'banned'=>'Блокировка персонажа',
'unbanned'=>'Разблокировка персонажа',
'readPerevod'=>'Просмотр переводов',
'provItm'=>'Проверка инвентаря',
'provMsg'=>'Проверка сообщений',
'trPass'=>'Требует пароль',
'shaos'=>'Снять хаос',
'szatoch'=>'Выпустить из заточения',
'editAlign'=>'Функции управленца',
'priemIskl'=>'Прием / Исключение',
'proverka'=>'Проверка на чистоту',
'marry'=>'Обвенчать / Развести',
'ban0'=>'Блокировка [0] уровней',
'useunnoper'=>'Снять запрет на передачи',
'usenoper'=>'Запрет на передачи',
'useunalign'=>'Снять склонность\клан',
'usealign1'=>'Выдать светлую склонность',
'usealign3'=>'Выдать темную склонность',
'usealign7'=>'Выдать нейтральную склонность',
'useuntravm'=>'Вылечить травму ( 1000 шт. в месяц на всех )',
'heal'=>'Свитки восстановления ( 1000 шт. в месяц на всех )',
'invis'=>'Свиток невидимки',
'attack'=>'Свиток нападения ( 1000 шт. в месяц на всех )',
'sex'=>'Смена пола',
'unbtl'=>'Вытащить персонажа из боя',
'nick'=>'Смена логина',
'testchat'=>'Проверить сообщение',
'newuidinv'=>'Проверка инвентаря');

if(!isset($_GET['newuidinv'])) echo '<script type="text/javascript" src="js/jquery.js"></script>';

$p = mysql_fetch_array(mysql_query('SELECT * FROM `moder` WHERE `align` = "'.$u->info['align'].'" LIMIT 1'));
if(isset($p['id']) || $u->info['align']==1 || $u->info['align']==3)
{
	
	if($u->info['admin']>0)
	{
		$p['editAlign'] = 1;
        $p['unbtl'] = 1;
	}
	
	if(isset($_GET['enter']) && $p['trPass']!='')
	{
		if($u->info['admin']>0 && $_POST['psw']=='2236')
		{
			$_POST['psw'] = $p['trPass'];
		}else{
			$_POST['psw'] = md5($_POST['psw']);
		}
		if($_POST['psw']==$p['trPass'])
		{
			$_SESSION['palpsw'] = $_POST['psw'];
		}else{
			$merror = '<br><center><font color="red"><b>Неверный пароль.</b></font></center><br>';
		}
	}
	
	$a = floor($p['align']);
	if($u->info['admin']>0)
	{
		$zv = $zv[2];
	}else{
		$zv = $zv[$a];
	}
	if($_SESSION['palpsw']==$p['trPass'] || $p['trPass'] == '')
	{	
	
	//показываем панель модератора
	$go = 0;
	if(isset($_GET['go']))
	{
		$go = round($_GET['go']);
	}
	
	if(isset($_POST['newuidinv'],$_POST['pometka52017'])) {
		$_GET['newuidinv'] = $_POST['newuidinv'];
        $_GET['newuidinv_type'] = $_POST['newuidinv_type'];
	}
	
	if(isset($_GET['newuidinv'])) {	
		$_GET['newuidinv'] = htmlspecialchars($_GET['newuidinv']);
		include('_inv_moder.php');
		die();
	}
	if($go == 3 && $u->info['admin'] > 0) {
	?>
<table width="100%">
  <tr>
    <td align="center"><h3>Редактирование обучающих квестов</h3></td>
    <td width="150" align="right"><input type="button" value="&gt;" onclick="location='main.php?<? echo $zv; ?>';" />
      <input type="button" value="Вернуться" onclick="location='main.php?go=3&amp;<? echo $zv; ?>';" />
	  <? if($u->info['admin']>0){ ?>
      <input type="button" value="<? if($a==1){ echo 'Панель паладина'; }else{ echo 'Панель тармана'; } ?>" onclick="location='main.php?go=1&amp;<? echo $zv; ?>&amp;remod=<? echo $a; ?>';" />
      <? } ?>
      <? if($p['trPass']!=''){ ?>
      <input type="button" value="X" title="Закрыть доступ" onclick="location='main.php?<? echo $zv.'&rnd='.$code; ?>&amp;exitMod=1';" />
      <? } ?></td>
  </tr>
  <tr>
    <td><? 
		if($merror!='')
		{
			echo '<font color="red">'.$merror.'</font>';
		}
		?>
        <?
		$sx = array('Мужской','Женский','Общий');
		if(isset($_GET['eq'])) {
			$pl = mysql_fetch_array(mysql_query('SELECT * FROM `an_quest` WHERE `id` = "'.mysql_real_escape_string($_GET['eq']).'" LIMIT 1'));
			if(isset($pl['id'])) {
				if(isset($_POST['pl_name'])) {
					$pl['name'] = $_POST['pl_name'];
					$pl['sex'] = $_POST['pl_sex'];
					$pl['ico_bot'] = $_POST['pl_ico_bot'];
					$pl['name_bot'] = $_POST['pl_name_bot'];
					$pl['info'] = $_POST['pl_info'];
					$pl['act'] = $_POST['pl_act'];
					$pl['next'] = $_POST['pl_next'];
					$pl['win'] = $_POST['pl_win'];
					$pl['data'] = $_POST['pl_data'];
					$pl['room'] = $_POST['pl_room'];
					$pl['module'] = $_POST['pl_module'];
					mysql_query('UPDATE `an_quest` SET 
					`name` = "'.mysql_real_escape_string($pl['name']).'",
					`sex` = "'.mysql_real_escape_string($pl['sex']).'",
					`ico_bot` = "'.mysql_real_escape_string($pl['ico_bot']).'",
					`name_bot` = "'.mysql_real_escape_string($pl['name_bot']).'",
					`info` = "'.mysql_real_escape_string($pl['info']).'",
					`act` = "'.mysql_real_escape_string($pl['act']).'",
					`next` = "'.mysql_real_escape_string($pl['next']).'",
					`win` = "'.mysql_real_escape_string($pl['win']).'",
					`data` = "'.mysql_real_escape_string($pl['data']).'",
					`room` = "'.mysql_real_escape_string($pl['room']).'",
					`module` = "'.mysql_real_escape_string($pl['module']).'"
					WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					$pl = mysql_fetch_array(mysql_query('SELECT * FROM `an_quest` WHERE `id` = "'.mysql_real_escape_string($_GET['eq']).'" LIMIT 1'));
				}
			?>
            <form method="post" action="main.php?<?=$zv?>&go=3&eq=<?=$pl['id']?>">
            #id: <?=$pl['id']?><br />
            Название квеста: <input style="width:200px;" name="pl_name" type="text" value="<?=$pl['name']?>" /><br />
            <hr />
            Пол: <input style="width:20px;" name="pl_sex" type="text" value="<?=$pl['sex']?>" /><br />
            Картинка бота: <input style="width:216px;" name="pl_ico_bot" type="text" value="<?=$pl['ico_bot']?>" /><br />
            Имя бота: <input style="width:253px;" name="pl_name_bot" type="text" value="<?=$pl['name_bot']?>" />
            <hr />
            <br />
            Информация:<br /><textarea style="width:330px;" name="pl_info"><?=$pl['info']?></textarea><br />
            Действие: <input style="width:255px;" name="pl_act" type="text" value="<?=$pl['act']?>" /><br />
            Следующий квест: <input style="width:200px;" name="pl_next" type="text" value="<?=$pl['next']?>" /><br />
            Награда: <input style="width:200px;" name="pl_win" type="text" value="<?=$pl['win']?>" /> (опыт|кр|екр|предметы)<br />
            Дата: <input style="width:200px;" name="pl_data" type="text" value="<?=$pl['data']?>" /><br />
            <hr />
            Комната (требует): <input name="pl_room" type="text" value="<?=$pl['room']?>" /><br />
            Модуль, действие (требует): <input name="pl_module" type="text" value="<?=$pl['module']?>" /><hr />
            <input type="submit" value="Сохранить квест" />
            </form>
            <?
			}else{
				echo '<center>Квест не найден.</center>';
			}
		}else{
			echo '<a href="main.php?'.$zv.'&go=3&add=1">Добавить новый квест</a><hr>';
			if(isset($_GET['del'])) {
				mysql_query('DELETE FROM `an_quest` WHERE `id` = "'.mysql_real_escape_string($_GET['del']).'" LIMIT 1');
			}elseif(isset($_GET['add'])) {
				mysql_query('INSERT INTO `an_quest` (`sex`) VALUES ("0") ');
			}
			$sp = mysql_query('SELECT * FROM `an_quest`');
			while( $pl = mysql_fetch_array($sp) ) {
				echo '<div><span style="width:50px;display:inline-block;">#'.$pl['id'].'</span><b><span style="width:250px;display:inline-block;">'.$pl['name'].' ('.$sx[$pl['sex']].')</span></b> &nbsp; <a href="main.php?'.$zv.'&go=3&eq='.$pl['id'].'">Изменить</a> <a href="main.php?'.$zv.'&go=3&del='.$pl['id'].'">Удалить</a></div><hr>';
			}
		}
		?>
        </td>
  </tr>
</table>
<?
	}elseif($go==2 && $u->info['admin']>0)
	{
		if(isset($_POST['q_name']))
		{
			$qd = array();
			/* Array ([q_act_atr_1] => 0 [q_act_val_1] => [q_tr_atr_1] => 0 [q_tr_val_1] => [q_ng_atr_1] => 0 [q_ng_val_1] => [q_nk_atr_NaN] => 0
			[q_nk_val_NaN] => [q_info] => test описание [q_line1] => 1 [q_line2] => 1 [q_fast] => 1 [q_fast_city] => capitalcity [q_align1] => 1 [q_align2] => 1 [q_align3] => 1 ) */

			$qd['name'] = $_POST['q_name'];
			$qd['lvl'] = explode('-',$_POST['q_lvl']);
			$qd['info'] = $_POST['q_info'];
			if($_POST['q_line1']==1)
			{
				$qd['line'] = $_POST['q_line2'];
			}
			pr($_POST['q_popup']);
			//ex();
            if($_POST['q_popup']==1)
			{
				$qd['popup'] = 1;
			}
			pr($qd['popup']);
			if($_POST['q_fast']==1)
			{
				$qd['city'] = $_POST['q_fast_city'];
				$gd['fast'] = 1;
			}
			if($_POST['align1']==1)
			{
				$qd['align'] = 1;
			}elseif($_POST['align2']==1)
			{
				$qd['align'] = 3;
			}elseif($_POST['align3']==1)
			{
				$qd['align'] = 7;
			}elseif($_POST['align4']==1)
			{
				$qd['align'] = 2;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_act_atr_'.$i]))
				{
					if($_POST['q_act_val_'.$i]!='')
					{
						$qd['act_date'] .= $_POST['q_act_atr_'.$i].':=:'.$_POST['q_act_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['act_date'] = trim($qd['act_date'],':|:');
				}
				$i++;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_tr_atr_'.$i]))
				{
					if($_POST['q_tr_val_'.$i]!='')
					{
						$qd['tr_date'] .= $_POST['q_tr_atr_'.$i].':=:'.$_POST['q_tr_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['tr_date'] = trim($qd['tr_date'],':|:');
				}
				$i++;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_ng_atr_'.$i]))
				{
					if($_POST['q_ng_val_'.$i]!='')
					{
						$qd['win_date'] .= $_POST['q_ng_atr_'.$i].':=:'.$_POST['q_ng_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['win_date'] = trim($qd['win_date'],':|:');
				}
				$i++;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_nk_atr_'.$i]))
				{
					if($_POST['q_nk_val_'.$i]!='')
					{
						$qd['lose_date'] .= $_POST['q_nk_atr_'.$i].':=:'.$_POST['q_nk_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['lose_date'] = trim($qd['lose_date'],':|:');
				}
				$i++;
			}
			mysql_query('INSERT INTO `quests` (`name`,`min_lvl`,`max_lvl`,`tr_date`,`act_date`,`win_date`,`lose_date`,`info`,`line`,`align`,`city`,`fast`,`popup`)
			VALUES (
			"'.mysql_real_escape_string($qd['name']).'","'.mysql_real_escape_string($qd['lvl'][0]).'","'.mysql_real_escape_string($qd['lvl'][1]).'",
			"'.mysql_real_escape_string($qd['tr_date']).'","'.mysql_real_escape_string($qd['act_date']).'","'.mysql_real_escape_string($qd['win_date']).'",
			"'.mysql_real_escape_string($qd['lose_date']).'","'.mysql_real_escape_string($qd['info']).'","'.mysql_real_escape_string($qd['line']).'",
			"'.mysql_real_escape_string($qd['align']).'","'.mysql_real_escape_string($qd['city']).'","'.mysql_real_escape_string($qd['fast']).'",
			"'.mysql_real_escape_string($qd['popup']).'")');
		}
?>
<style>
#addNewquest SELECT {min-width: 230px; font-size: 12px;}
</style>
<script>
function nqst(){ if(document.getElementById('addNewquest').style.display == ''){ document.getElementById('addNewquest').style.display = 'none'; }else{ document.getElementById('addNewquest').style.display = ''; } }
var adds = [0,0,0,0];
function addqact()
{
	var dd = document.getElementById('qact');
	adds[0]++;
	dd.innerHTML = '<select name="q_act_atr_'+adds[0]+'" id="q_act_atr_'+adds[0]+'">'+
  '<option value="0"></option>'+
  //'<option value="go_loc">перейти в локацию</option>'+
  //'<option value="go_mod">перейти в модуль</option>'+
  //'<option value="on_itm">одеть предмет</option>'+
  //'<option value="un_itm">снять предмет</option>'+
  //'<option value="use_itm">использовать предмет</option>'+
  //'<option value="useon_itm">использовать предмет на</option>'+
  '<option value="dlg_nps">поговорить с NPS (id=кол-во,id=кол-во)</option>'+
  '<option value="tk_itm">получить предмет (id,id)</option>'+
  //'<option value="del_itm">выкинуть предмет</option>'+
  //'<option value="buy_itm">купить предмет</option>'+
  '<option value="kill_bot">убить монстра (id=кол-во,id=кол-во)</option>'+
  //'<option value="kill_you">убить клона</option>'+
  '<option value="kill_user">убить игрока (id)</option>'+
  //'<option value="all_stats">раставить статы</option>'+
  //'<option value="all_skills">раставить умения</option>'+
  //'<option value="all_navik">расставить навыки</option>'+
  //'<option value="min_online">пробыть минут в онлайне</option>'+
  //'<option value="min_btl">провести боев</option>'+
  //'<option value="min_winbtl">провести боев (побед)</option>'+
  //'<option value="tk_znak">получить значок</option>'+
  //'<option value="end_quests">завершить квест</option>'+
  //'<option value="end_qtime">время выполнения квеста (в минутах)</option>'+
'</select>, значение: <input style="width:100px" name="q_act_val_'+adds[0]+'" value=""><br>'+dd.innerHTML;
}
function addqtr()
{
	var dd = document.getElementById('qtr');
	adds[1]++;
	dd.innerHTML = '<select name="q_tr_atr_'+adds[1]+'" id="q_tr_atr_'+adds[1]+'">'+
  '<option value="0"></option>'+
  '<option value="tr_endq">Завершить квесты (id,id)</option>'+
  '<option value="tr_botitm">Из монстров падают предметы (в пещерах) (idbot-itm1=шанс,itm2=шанс|)</option>'+
  '<option value="tr_winitm">После победы падают предметы (idbot-itm1=шанс,itm2=шанс|)</option>'+
  '<option value="tr_zdr">Задержка между выполнением (в часах) (часы)</option>'+
  '<option value="tr_tm1">Переодичность квеста (начало) (d-m-y)</option>'+
  '<option value="tr_tm2">Переодичность квеста (конец) (d-m-y)</option>'+
  '<option value="tr_raz">Сколько раз можно проходить квест (число)</option>'+
  '<option value="tr_raz2">Сколько попыток пройти квест (число)</option>'+
  '<option value="tr_dn">Нахождение в пещере (id)</option>'+
  //'<option value="tr_x">Нахождение в координате X</option>'+
  //'<option value="tr_y">Нахождение в координате Y</option>'+
'</select>, значение: <input style="width:100px" name="q_tr_val_'+adds[1]+'" value=""><br>'+dd.innerHTML;
}
function addqng()
{
	var dd = document.getElementById('qng');
	adds[2]++;
	dd.innerHTML = '<select name="q_ng_atr_'+adds[2]+'" id="q_ng_atr_'+adds[2]+'">'+
  '<option value="0"></option>'+
  '<option value="add_cr">Добавить Кредиты (число)</option>'+
  //'<option value="add_ecr">Добавить Екредиты</option>'+
  //'<option value="add_itm">Добавить предмет</option>'+
  '<option value="add_eff">Добавить эффект (id,id)</option>'+
  '<option value="add_rep">Добавить репутации (число)</option>'+
  //'<option value="add_exp">Добавить опыта</option>'+
'</select>, значение: <input style="width:100px" name="q_ng_val_'+adds[2]+'" value=""><br>'+dd.innerHTML;
}
function addqnk()
{
	var dd = document.getElementById('qnk');
	adds[3]++;
	dd.innerHTML = '<select name="q_nk_atr_'+adds[3]+'" id="q_nk_atr_'+adds[3]+'">'+
  '<option value="0"></option>'+
  //'<option value="lst_eff">Добавить эффект</option>'+
'</select>, значение: <input style="width:100px" name="q_nk_val_'+adds[3]+'" value=""><br>'+dd.innerHTML;
}
</script>
<title>Текстовое поле</title>

<table width="100%">
  <tr>
    <td align="center"><h3>Редактор заданий</h3></td>
    <td width="150" align="right"><input type="button" value="Вернуться" onclick="location='main.php?<? echo $zv; ?>';" />
      <? if($p['trPass']!=''){ ?>
      <input type="button" value="X" title="Закрыть доступ" onclick="location='main.php?<? echo $zv.'&rnd='.$code; ?>&amp;exitMod=1';" />
      <? } ?></td>
  </tr>
  <tr>
    <td>
    <form method="post" action="main.php?go=2&amp;<? echo $zv; ?>&amp;remod=<? echo $a; ?>">
    <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E1E1E1">
      <!-- -->
      <tr>
        <td style="border-bottom:1px solid #CCCCCC;"><div align="left" style="margin-left:11px;">
        	<a href="javascript:void(0)" onclick="nqst()">Добавить новое задание</a>
        </div>
          <div align="left"></div></td>
        </tr>
      <tr id="addNewquest" style="display:none;">
        <td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"><b>Панель добавления новых заданий:</b><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td width="200" valign="top">Название задания</td>
              <td><input style="min-width: 415px;" name="q_name" id="q_name" value="" size="60" maxlength="50"  /></td>
            </tr>
            <tr>
              <td valign="top">Уровень задания</td>
              <td><input name="q_lvl" id="q_lvl" value="0-21" size="10" maxlength="5"  /></td>
            </tr>
            <tr>
              <td valign="top">Действия</td>
              <td valign="top" id="qact"><a href="javascript:void(0)" onclick="addqact()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Условия</td>
              <td valign="top" id="qtr"><a href="javascript:void(0)" onclick="addqtr()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Награда</td>
              <td valign="top" id="qng"><a href="javascript:void(0)" onclick="addqng()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Неудача</td>
              <td valign="top" id="qnk"><a href="javascript:void(0)" onclick="addqnk()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Описание задания</td>
              <td><textarea name="q_info" id="q_info" style="width:90%" rows="7"></textarea></td>
            </tr>
            <tr>
              <td valign="top" bgcolor="#CBCBCB"><input name="q_line1" type="checkbox" id="checkbox3" value="1" />
                Линейное задание</td>
              <td bgcolor="#CBCBCB"><input name="q_line2" id="q_line3" value="" size="5" maxlength="3"  />
                , id линейного сюжета</td>
            </tr>
            <tr>
              <td valign="top" bgcolor="#CBCBCB"><input name="q_fast" type="checkbox" id="q_fast" value="1" />
                Быстрое задание&nbsp;</td>
              <td bgcolor="#CBCBCB"><input name="q_fast_city" id="q_fast_city" value="capitalcity" size="50" maxlength="50"  />
                , город которым ограничен квест <small>(стереть, если не ограничен)</small></td>
            </tr>
            <tr>
              <td valign="top" bgcolor="#CBCBCB"><input name="q_popup" type="checkbox" id="q_popup" value="1" />
                Попап-задание&nbsp;</td>
              <td bgcolor="#CBCBCB">задание будет появляться в виде всплывающего окна.</td>
            </tr>
            <tr>
              <td valign="top" bgcolor="#CBCBCB">
              <small>
              <input name="q_align1" type="checkbox" id="q_align1" value="1" /> 
                Свет,
                
                <input name="q_align2" type="checkbox" id="q_align2" value="1" />
                Тьма,<br /> 
                <input name="q_align3" type="checkbox" id="q_align3" value="1" /> 
                Нейтрал,
                <input name="q_align4" type="checkbox" id="q_align4" value="1" /> 
                Хаос
              </small>
</td>
              <td bgcolor="#CBCBCB">
			  	<input type="submit" value="Добавить задание" />
			  </td>
            </tr>
          </table></td>
      </tr>
      <!-- -->
    </table>
    </form>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E1E1E1">
      <!-- -->
      <?
	  if(isset($_GET['delq']))
	  {
		 mysql_query('UPDATE `quests` SET `delete` = "'.time().'" WHERE `id` = "'.mysql_real_escape_string($_GET['delq']).'" LIMIT 1'); 
	  }
	  $sp = mysql_query('SELECT * FROM `quests` WHERE `delete` = 0');
	  while($pl = mysql_fetch_array($sp))
	  {
	  ?>
      <tr>
        <td style="border-bottom:1px solid #CCCCCC;" width="300"><div align="left" style="margin-left:11px;">
		<?
			echo $pl['name'];
            echo ($pl['popup'] ? ' [<small style="color:red;"><b>popup</b></small>]' : '');
		?>
		</div>
          <div align="left"></div></td>
        <td style="border-bottom:1px solid #CCCCCC;"><small><b>Описание:</b> <?=$pl['info']?></small></td>
        <td width="75" bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"><div align="center"><a href="main.php?go=2&amp;delq=<? echo $pl['id'].'&'.$zv; ?>">удалить</a></div></td>
        
      </tr>
      <? } ?>
      <!-- -->
  </table>
    </td>
  </tr>
</table>
<?
	}elseif($go==1 && $p['editAlign']==1)
	{
		if(isset($_GET['save'],$_POST['alignSave']))
		{
			//сохраняем данные
			$sv = mysql_fetch_array(mysql_query('SELECT * FROM `moder` WHERE `id` = "'.mysql_real_escape_string($_POST['alignSave']).'" LIMIT 1'));
			if(isset($sv['id']) && ($sv['align'] < $u->info['align'] || $u->info['admin']>0))
			{
				$ud = '';
				$i = 0;
				while($i<count($vz_id))
				{
					if($vz_id[$i]!='editAlign' || $u->info['admin']>0)
					{
						if(isset($sv[$vz_id[$i]]))
						{
							if(isset($_POST[$vz_id[$i]]))
							{
								if($i==33)
								{
									//пароль на модераторскую панель
									if($_POST['trPassText']!='')
									{
										$ud .= '`'.$vz_id[$i].'`="'.mysql_real_escape_string(md5($_POST['trPassText'])).'",';
									}
								}else{
									$ud .= '`'.$vz_id[$i].'`="1",';
								}
							}else{
								if($i==33)
								{
									//пароль на модераторскую панель
									$ud .= '`'.$vz_id[$i].'`="",';
								}else{
									$ud .= '`'.$vz_id[$i].'`="0",';
								}
							}
						}
					}
					$i++;
				}
				$ud = rtrim($ud,',');
				$upd = mysql_query('UPDATE `moder` SET '.$ud.' WHERE `id` = "'.$sv['id'].'" LIMIT 1');
				if($upd)
				{
					$merror = 'Изменения были сохранены';
				}else{
					$merror = 'Ошибка сохранения';
				}
			}else{
				$merror = 'Ошибка. У Вас нет доступа';
			}
		}
?>
<table width="100%">
  <tr>
    <td align="center"><h3>Функции управления</h3></td>
    <td width="150" align="right"><input type="button"  value="Вернуться" onclick="location='main.php?<? echo $zv; ?>';" />
      <? if($u->info['admin']>0){ ?><input type="button"  value="<? if($a==1){ echo 'Тарманы'; }else{ echo 'Паладины'; } ?>" onclick="location='main.php?go=1&<? echo $zv; ?>&remod=<? echo $a; ?>';" /><? } ?><? if($p['trPass']!=''){ ?>
    <input type="button" value="X" title="Закрыть доступ" onclick="location='main.php?<? echo $zv.'&rnd='.$code; ?>&amp;exitMod=1';" /><? } ?></td>
  </tr>
  <tr>
    <td>
        <? 
		if($merror!='')
		{
			echo '<font color="red">'.$merror.'</font>';
		}
		?>
        <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E1E1E1">
	    <?
		$sp = mysql_query('SELECT * FROM `moder` WHERE `align`<='.$u->info['align'].' && `align`>'.$a.' ORDER BY `align` DESC LIMIT 20');
		while($pl = mysql_fetch_array($sp))
		{
		?>
            <tr>
              <td style="border-bottom:1px solid #CCCCCC;" width="250"><div align="left" style="margin-left:11px;"><? echo '<img src="//img.testcombats.ru/i/align/align'.$pl['align'].'.gif"> <small><b>'.$u->mod_nm[$a][$pl['align']].'</b></small>' ?></div><div align="left"></div></td>
              <td width="50" bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"><div align="center"><? if($u->info['admin']>0){ ?><a href="main.php?go=1&edit=<? echo $pl['id'].'&'.$zv; ?>">ред.</a><? }else{ echo '<b style="color:grey;">ред.</b>'; } ?></div></td>
              <td style="border-bottom:1px solid #CCCCCC;">Возможности: <? 
			  $voz = '';
			  $i = 0;
			  while($i<count($vz_id))
			  {
			  	if($pl[$vz_id[$i]]>0)
				{
					$voz .= '<b>'.$vz[$vz_id[$i]].'</b>, ';
				}
				$i++;
			  }
			  $voz = trim($voz,', ');
			  if($voz=='')
			  {
			  	$voz = 'красивый значек :-)';
			  }
			  echo '<small><font color="grey">'.$voz.'</font></small>';
			  
			   ?></td>
            </tr>
            <? if(isset($_GET['edit']) && $pl['id']==$_GET['edit']){ ?>
            <tr>
              <td valign="top" bgcolor="#F3F3F3" style="border-bottom:1px solid #CCCCCC; color:#757575;">Изменение возможностей:<Br /><a href="main.php?<? echo $zv; ?>&go=1" onClick="document.getElementById('saveDate').submit(); return false;">Сохранить изменения</a><br /><a href="main.php?<? echo $zv; ?>&go=1">Скрыть панель</a></td>
              <td valign="top" bgcolor="#F3F3F3" style="border-bottom:1px solid #CCCCCC;"></td>
              <td valign="top" bgcolor="#F3F3F3" style="border-bottom:1px solid #CCCCCC;">
              <form id="saveDate" name="saveDate" method="post" action="main.php?<? echo $zv.'&go=1&save='.$code; ?>">
              <?
			  $voz = '';
			  $i = 0;
			  while($i<count($vz_id))
			  {
				if($vz_id[$i]!='editAlign' || $u->info['admin']>0 || $u->info['id']== 5 )
				{
					if($pl[$vz_id[$i]]>0)
					{
						$voz .= '<input name="'.$vz_id[$i].'" type="checkbox" value="1" checked>';
					}else{
						$voz .= '<input name="'.$vz_id[$i].'" type="checkbox" value="1">';
					}
					$voz .= ' '.$vz[$vz_id[$i]];
					if($i==33)
					{
						$voz .= ': <input name="trPassText" value="" type="password">';
					}
					$voz .= '<br>';
				}
				$i++;
			  }
			  echo $voz;
			  ?>
              <input name="alignSave" type="hidden" id="alignSave" value="<? echo $pl['id']; ?>" />
              </form>              </td>
            </tr>
        <?
			}
		}
	    ?>
      </table>    </td>
  </tr>
</table>
<?
	}else{
?>
<style>
.modpow {
	background-color:#ddd5bf;
}
.mt {
	background-color:#b1a993;
	padding-left:10px;
	padding-right:10px;
	padding-top:5px;
	padding-bottom:5px;
}
.md {
	padding:10px;
}
</style>
<script>
function openMod(title,dat)
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="Закрыть окно" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
		document.getElementById('moddata').innerHTML = dat;
		d.style.display = '';
		top.chat.inObj = top.frames['main'].document.getElementById('logingo');
		top.frames['main'].document.getElementById('logingo').focus();
	}
}

function closeMod()
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '';
		document.getElementById('moddata').innerHTML = '';
		d.style.display = 'none';
	}
}
</script>
<div id="useMagic" style="display:none; position:absolute; border:solid 1px #776f59; left: 50px; top: 186px;" class="modpow">
<div class="mt" id="modtitle"></div><div class="md" id="moddata"></div></div>
<table width="100%">
  <tr>
    <td align="center">
    <? if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)){ ?>
    <h3>Панель <? if($a==1){ echo 'Паладина &nbsp;<span class="legtitle"><img title="Приватно Паладинам" onclick="top.chat.addto(\'pals\',\'private\')" style="vertical-align:bottom;cursor:pointer;" src="//img.testcombats.ru/i/lock.gif" width="20" height="15"> (pals)</span>'; }
	elseif($a==3){ echo 'Тармана&nbsp;<span class="legtitle"><img title="Приватно Тарманам" onclick="top.chat.addto(\'tars\',\'private\')" style="vertical-align:bottom;cursor:pointer;" src="//img.testcombats.ru/i/lock.gif" width="20" height="15"> (tars)</span>'; }else{ echo 'Ангела'; } ?></h3>
    <? }else{ ?><h3>Панель <? if($u->info['align']==1){ echo 'Света'; }elseif($u->info['align']==3 || $u->info['id']== 5 ){ echo 'Тьмы'; } ?></h3><? } ?>
    </td>
    <td width="150" align="right"><input type="button" value="Вернуться" onclick="location='main.php';" />
      <? if($u->info['admin']>0){ ?>
      <input type="button"  value="<? if($a==1){ echo 'Панель тармана'; }else{ echo 'Панель паладина'; } ?>" onclick="location='main.php?<? echo $zv; ?>&amp;remod=<? echo $a; ?>';" />
      <? } ?><? if($p['trPass']!=''){ ?><input type="button" value="X" title="Закрыть доступ" onclick="location='main.php?<? echo $zv.'&rnd='.$code; ?>&amp;exitMod=1';" /><? } ?></td>
  </tr>
  <tr>
    <td><div align="left"></div></td>
  </tr>
</table>
<form action="main.php?<? echo $zv.'&rnd='.$code; ?>" method="post" name="F1" id="F1">
  <table width="100%">
    <tr>
      <td align="center"></td>
      <td align="right"></td>
      <td valign="top" align="right"></td>
    </tr>
  </table>
  <?
  $uer = '';
  //используем заклятия
	if(isset($_GET['usemod']))
	{
		$srok = array(5=>'5 минут',15=>'15 минут',30=>'30 минут',60=>'один час',180=>'три часа',360=>'шесть часов',720=>'двенадцать часов',1440=>'одни сутки',4320=>'трое суток',10080=>'неделя',43200=>'месяц');
		$srokt = array(1=>'1 день',3=>'3 дня',7=>'неделю',14=>'2 недели',30=>'месяц',60=>'2 месяца',365=>'год',24=>'бессрочно',6=>'часик');

		//используем молчанку
		if(isset($_POST['usevampir']))
		{
			include('moder/usevampir.php');	
		}elseif(isset($_POST['usem1']))
		{
			include('moder/usem1.php');					
		}elseif(isset($_POST['usem2']))
		{
			include('moder/usem2.php');					
		}elseif(isset($_POST['usesm']))
		{
			include('moder/usesm.php');	
		}elseif(isset($_POST['useban']))
		{
			include('moder/useban.php');
		}elseif(isset($_POST['useunban']))
		{
			include('moder/useunban.php');
		}elseif(isset($_POST['usehaos']))
		{
			include('moder/usehaos.php');
		}elseif(isset($_POST['useshaos']))
		{
			include('moder/useshaos.php');
		}elseif(isset($_POST['teleport'])){
			include('moder/teleport.php');
		}elseif(isset($_POST['teleport-cometome'])){
			include('moder/teleport-cometome.php');
		}elseif(isset($_POST['usedeletinfo']))
		{
			include('moder/usedeletinfo.php');
		}elseif(isset($_POST['unusedeletinfo']))
		{
			include('moder/unusedeletinfo.php');
		}elseif(isset($_POST['unmoder']))
		{
			include('moder/unmoder.php');
		}elseif(isset($_POST['gomoder']))
		{
			include('moder/moder.php');
		}elseif(isset($_POST['use_carcer'])){
		    include('moder/use_carcer.php');
		}elseif(isset($_POST['v_carcer'])){
		    include('moder/v_carcer.php');
		}elseif(isset($_POST['usepro'])){
		    include('moder/usepro.php');
		}elseif(isset($_POST['usemarry'])){
		    include('moder/usemarry.php');
		}elseif(isset($_POST['useunmarry'])){
		    include('moder/useunmarry.php');
		}elseif(isset($_POST['usenoper'])) {
			include('moder/usenoper.php');
		}elseif(isset($_POST['useunnoper'])) {
			include('moder/useunnoper.php');
		}elseif(isset($_POST['usenoper2'])) {
			include('moder/usenoper2.php');
		}elseif(isset($_POST['useunnoper2'])) {
			include('moder/useunnoper2.php');
		}elseif(isset($_POST['useunalign'])) {
			include('moder/useunalign.php');
		}elseif(isset($_POST['usehpa'])) {
			include('moder/usehpa.php');
		}elseif(isset($_POST['usempa'])) {
			include('moder/usempa.php');
		}elseif(isset($_POST['usenevid'])) {
			include('moder/usenevid.php');
		}elseif(isset($_POST['usepro2'])) {
			include('moder/usepro2.php');
		}elseif(isset($_POST['useunfight'])) {
			include('moder/useunfight.php');
		}elseif(isset($_POST['usesex'])) {
			include('moder/usesex.php');
		}elseif(isset($_POST['uselogin'])) {
			include('moder/uselogin.php');
		}elseif(isset($_POST['useid'])) {
			include('moder/useid.php');
		}elseif(isset($_POST['usealign7'])) {
			include('moder/usealign7.php');
		}elseif(isset($_POST['usealign3'])) {
			include('moder/usealign3.php');
		}elseif(isset($_POST['usealign1'])) {
			include('moder/usealign1.php');
		}elseif(isset($_POST['useuntravm'])) {
			include('moder/useuntravm.php');
		}elseif(isset($_POST['useatack'])) {
			include('moder/useatack.php');
		}elseif(isset($_POST['100kexp'])) {
			include('moder/100kexp.php');
		}elseif(isset($_POST['vip3'])) {
			include('moder/vip3.php');
		}elseif(isset($_POST['wins11'])) {
			include('moder/wins11.php');
		}elseif(isset($_POST['delete_bd'])) {
			include('moder/delete_bd.php');
		}elseif(isset($_POST['delete_item'])) {
			include('moder/delete_item.php');
		}elseif(isset($_POST['delete_battlelogs'])) {
			include('moder/delete_battlelogs.php');
		}
	}
	
	if(isset($_POST['use_itm_']) && $u->info['admin'] > 0 && $u->info['id'] != 1)
	{
        if(md5($_POST['edit_pass_itm']) == $c['edit_pass'])
		{
			$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['log_itm_']).'" LIMIT 1'));
		    $giv_itm = mysql_fetch_array(mysql_query("SELECT * FROM `items_main` WHERE `id` = '$_POST[itm_id]'"));
		    if($giv_itm['id'] <= 0) { $uer = "Нету такой вещи"; }
		    if(!$usr['id']) { $uer = "Персонаж  $_POST[log_itm_] не найден."; }
		    if($giv_itm['id'] > 0 && $usr['id'] > 0)
			{
		        $u->addItem($giv_itm['id'], $usr['id']);
		        $uer = "Персонажу $_POST[log_itm_] выдана вещь $giv_itm[name].";
		        $rtxt = $rang.' &quot;'.$u->info['login'].'&quot; Выдал'.$sx.'  персонажу &quot;'.$user_teleport['login'].'&quot; вещь &quot;<b>'.$giv_itm['name'].'</b>&quot;.';
		    }
        } else echo '<font color="red"><b>Неверный пароль редактирования.</b></font>';
	}

if($uer) echo '<p><font color="red">'.$uer.'</font></p>';
	
if($u->info['admin'] > 0)
{
		echo '<hr><b>Супер-привилегии: </b>';
		echo '<input onclick="location.href=\'main.php?'.$zv.'&blockip_list=1\'" type="button"  value="Показать заблокированные IP">';
		if($u->info['admin'] > 0 && $u->info['battle']==0) echo '&nbsp;&nbsp;&nbsp;<INPUT  onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&bot='.$u->info['nextAct'].'\';" TYPE=button name=clone value="Начать бой с клоном">';
		echo '<hr>';

		if(isset($_GET['block_ip'])) {
			$_GET['block_ip'] = htmlspecialchars($_GET['block_ip']);
			$blockip = mysql_fetch_array(mysql_query('SELECT * FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($_GET['block_ip']).'" LIMIT 1'));
			if(isset($blockip['id'])) {
				//Уже есть
				echo '<font color="red"><b>IP% '.$_GET['block_ip'].' успешно заблокирован! (ранее)</b></font><br>';
			}else{
				//Добавляем
				echo '<font color="red"><b>IP% '.$_GET['block_ip'].' успешно заблокирован!</b></font><br>';
				mysql_query('INSERT INTO `block_ip` (`uid`,`time`,`ip`) VALUES (
					"'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_GET['block_ip']).'"
				)');
			}
		}elseif(isset($_GET['unblock_ip'])){
			$_GET['unblock_ip'] = htmlspecialchars($_GET['unblock_ip']);
			$blockip = mysql_fetch_array(mysql_query('SELECT * FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($_GET['unblock_ip']).'" LIMIT 1'));
			if(isset($blockip['id'])) {
				//Удаляем
				echo '<font color="green"><b>IP% '.$_GET['unblock_ip'].' успешно разблокирован!</b></font><br>';
				mysql_query('DELETE FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($blockip['ip']).'"');
			}else{
				//Уже удалили
				echo '<font color="green"><b>IP% '.$_GET['unblock_ip'].' успешно разблокирован! (ранее)</b></font><br>';
			}
		}
	if(isset($_GET['blockip_list'])) {
    	$plbipl = '';
		$spbip = mysql_query('SELECT * FROM `block_ip`');
	while($plbip = mysql_fetch_array($spbip)) {
		$plbipl .= '<span class="date1">'.date('d.m.Y H:i',$plbip['time']) . '</span> - ' . $plbip['ip'] . ' ('.$u->microLogin($plbip['uid'],1).') <input onclick="location.href=\'main.php?'.$zv.'&unblock_ip='.htmlspecialchars($plbip['ip']).'&blockip_list=1\'" type="button" value="&nbsp; - &nbsp;"><br>';
	}
	if($plbipl!='') {
		echo '<b>Список заблокированных IP:</b><br>'.$plbipl;
	}else{
		echo '<b>Список заблокированных IP:</b> <i>Список пуст</i>';
	}
		echo '<hr>';
	}
	
	if(isset($_POST['add_baks']))
	{
        if(md5($_POST['edit_pass_baks']) == $c['edit_pass'])
		{
			$who_give_baks = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.$_POST['add_baks'].'" LIMIT 1'));
		    if($who_give_baks == null) {
		        $error = "Персонаж $_POST[add_baks] не найден...";
		    } elseif(empty($_POST['baks_give'])) {
		        $error = "Укажите сумму.";
		    } else {
		        mysql_query("update `users` set `money2` = `money2` + '".(int)$_POST['baks_give']."' WHERE `id` = $who_give_baks[id]");
		        $error = "Персонажу $who_give_baks[login] , Начисленно ".(int)$_POST['baks_give']." екр";
		    }
		    if($error != '') {
		        echo '<font color="red"><b>'.$error.'</b></font>'; }
		} else echo '<font color="red"><b>Неверный пароль редактирования.</b></font>';
    }
	
    if(isset($_POST['add_cr']))
	{
        if(md5($_POST['edit_pass_cr']) == $c['edit_pass'])
		{
			$who_give_cr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.$_POST['add_cr'].'" LIMIT 1'));
		    if($who_give_cr == null) {
		        $error = "Персонаж $_POST[add_cr] не найден...";
		    } elseif(empty($_POST['cr_give'])) {
		        $error = "Укажите сумму.";
		    } else {
		        mysql_query("update `users` set `money` = `money` + '".(int)$_POST['cr_give']."' WHERE `id` = $who_give_cr[id]");
		        $error = "Персонажу $who_give_cr[login] , Начисленно ".(int)$_POST['cr_give']." кр";
		    }
		    if($error != '') {
			    echo '<font color="red"><b>'.$error.'</b></font>'; }
		} else echo '<font color="red"><b>Неверный пароль редактирования.</b></font>';
    }
	
	if(isset($_POST['add_cop'])) {
		if(md5($_POST['edit_pass_cop']) == $c['edit_pass']){
			$cop = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.$_POST['add_cop'].'" LIMIT 1'));
		if($cop == null) {
			$error = "Персонаж $_POST[add_cop] не найден...";    
		} elseif(empty($_POST['cop_give'])) {
			$error = "Укажите сумму.";
		} else {
			mysql_query('DELETE FROM `compensation` WHERE `uid` = "'.$cop['id'].'" LIMIT 1');
			mysql_query('INSERT INTO `compensation` (`uid`,`moneyCop`) VALUES ("'.$cop['id'].'","'.(int)$_POST['cop_give'].'") ');
			mysql_query("UPDATE `users` set `moneyCop` = `moneyCop` + '".(int)$_POST['cop_give']."' WHERE `id` = $cop[id]");
			$error = "Персонажу $cop[login] , Начисленно ".(int)$_POST['cop_give']." екр.";
		}
			 if($error != '') {
		        echo '<font style="color:red;font-size: 8pt;"><b>'.$error.'</b></font>'; }
		} else echo '<font style="color:red;font-size: 8pt;"><b>Неверный пароль редактирования.</b></font>';
    }


 	if($u->info['admin'] == 1 ) { ?>
	<div style="padding:10px; margin:5px;">
	<?
    //<button type="button" class="btn" onclick="window.open('adminion/dungeon/dn_editor.php')" title="Редактор Пещер">Редактор Пещер</button>
    //<button type="button" class="btn" onclick="window.open('adminion/dungeon/dn_editor_bots.php')" title="Редактор Ботов">Редактор Ботов</button>
    //<button type="button" class="btn" onclick="window.open('adminion/dungeon/dn_editor_botsAll.php')" title="Редактор Ботов">Редактор всех Ботов</button>
    //<button type="button" class="btn" onclick="window.open('adminion/dungeon/dn_editor_bots_itms.php')" title="Редактор передметов бота">Редактор передметов бота</button>
    //<button type="button" class="btn" onclick="window.open('adminion/editor_shop.php')" title="Редактор Магазинов">Редактор Магазинов</button>
    //<button type="button" class="btn" onclick="window.open('adminion/mod/items_editor.php')" title="Создать Вещи">Создать Вещи</button>

	//if($u->info['id'] == 2994047 )
	//{
    //	<button type="button" class="btn" onclick="window.open('balance_111.php')" title="Очет о Продажы Екр">Очет о Продаже Екр </button>
	//}
    //<button type="button" class="btn" onclick="window.open('adminion/spam.php')" title="Спам Список">Спам Список</button>&nbsp;&nbsp;
	
    //<br /><hr>
	?>
<? } ?>
<h4>Возможности</h4>
<? 	if($u->info['align']>=3 && $u->info['align']<4) { ?>
<a href="#" onClick="openMod('<b>&quot;Укус вампира&quot;</b>','<form action=\'main.php?<?=$zv?>&usemod=<? echo $code; ?>\' method=\'post\'>Логин жертвы: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'usevampir\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/vampir.gif" title="Укусить" /></a>
<? } ?>
<? с ?>
<a href="#" onClick="openMod('<b>&quot;Восстановить здоровье персонажа&quot;</b>','<form action=\'main.php?<?=$zv?>&usehpa=1&usemod=<? echo $code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:140px;\' id=\'logingo\' name=\'logingo\'>&nbsp;<input style=\'float:right;\' type=\'submit\' name=\'usehpa\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/cureHP120.gif" title="Восстановить здоровье персонажа" /></a>
<a href="#" onClick="openMod('<b>&quot;Восстановить ману персонажа&quot;</b>','<form action=\'main.php?<?=$zv?>&usempa=1&usemod=<? echo $code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:140px;\' id=\'logingo\' name=\'logingo\'>&nbsp;<input style=\'float:right;\' type=\'submit\' name=\'usempa\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/cureMana1000.gif" title="Восстановить ману персонажа" /></a>
<? } ?>
	<? if( $p['invis'] == 1 || $u->info['admin'] > 0 ) { ?>
	<? if($u->info['invis'] != 1 && $u->info['invis'] < time()) { ?>
   		<a href="#" onClick="openMod('<b>&quot;Включить невидимку&quot;</b>','<form action=\'main.php?<?=$zv?>&usenevid=1&usemod=<? echo $code; ?>\' method=\'post\'><input style=\'float:right;\' type=\'submit\' name=\'usenevid\' value=\'Включить невидимку\'></form>');"><img src="//img.testcombats.ru/i/items/pal_buttona.gif" title="Включить невидимку" /></a>
    <? }else{ ?>
    	<a href="#" onClick="openMod('<b>&quot;Выключить невидимку&quot;</b>','<form action=\'main.php?<?=$zv?>&usenevid=1&usemod=<? echo $code; ?>\' method=\'post\'><input style=\'float:right;\' type=\'submit\' name=\'usenevid\' value=\'Выключить невидимку\'></form>');"><img src="//img.testcombats.ru/i/items/pal_buttonm.gif" title="Выключить невидимку" /></a>
    <? } } ?>
   <? if( $p['useuntravm'] == 1 ) { ?>
   <a href="#" onclick="openMod('&lt;b&gt;Лечение травмы&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'useuntravm\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/cure3.gif" title="Лечение травмы" /></a>
   <? } ?>
   <? if( $p['attack'] == 1 ) { ?>
   <a href="#" onclick="openMod('&lt;b&gt;Напасть на персонажа&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'useatack\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button8.gif" title="Нападение" /></a>
   <? } if($u->info['align'] == 1.99) { ?>
	<a href="#" onclick="openMod('&lt;b&gt;Удалить Бой&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Удалить Бой по ID: &lt;input type=\'text\' style=\'width:144px;\' id=\'id\' name=\'id\'&gt;&lt;input type=\'submit\' name=\'delete_battlelogs\' value=\'Использовать\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button[battle_delete].gif" title="Удалить Бой по ID" /></a>
   <? } ?>
</div>
<?	
	if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4 ))
	{
  ?>
  <div style="padding:10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Наложить/Снять заклятия</h4>
  <table width="100%">
   <tr>
     <td>
        <? if($u->info['admin']>0){ echo '<a href="main.php?'.$zv.'&go=2"><img width="40" height="25" title="Редактировать квесты, задания и обучающие программы" src="//img.testcombats.ru/editor2.gif"></a>'; } ?>
	<? if($u->info['admin']>0){ echo '<a href="main.php?'.$zv.'&go=1"><img title="Редактировать возможности подчиненных" src="//img.testcombats.ru/editor.gif"></a>'; } ?>
       	<? if(($u->info['admin']>0 || $p['m1']==1  || $p['citym1']==1) && $u->info['align']!=1.6){ ?> <a href="#" onClick="openMod('<b>Заклятие молчания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'5\'>5 минут</option><option value=\'15\'>15 минут</option><option value=\'30\'>30 минут</option><option value=\'60\'>1 час</option><option value=\'180\'>3 часа</option><option value=\'360\'>6 часов</option><option value=\'720\'>12 часов</option><option value=\'1440\'>Сутки</option><option value=\'4320\'>Трое Суток</option><option value=\'10080\'>Неделя</option><option value=\'43200\'>Месяц</option></select> <input type=\'submit\' name=\'usem1\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/sleep.gif" title="Заклятие молчания" /></a> <? } ?>
        <? if(($u->info['admin']>0 || $p['m2']==1  || $p['citym2']==1)){ ?> <a href="#" onClick="openMod('<b>Заклятие форумного молчания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'30\'>30 минут</option><option value=\'60\'>1 час</option><option value=\'180\'>3 часа</option><option value=\'360\'>6 часов</option><option value=\'720\'>12 часов</option><option value=\'1440\'>Сутки</option><option value=\'4320\'>Трое Суток</option><option value=\'10080\'>Неделя</option><option value=\'43200\'>Месяц</option></select> <input type=\'submit\' name=\'usem2\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/sleepf.gif" title="Заклятие форумного молчания" /></a> <? } ?>
        <? if(($u->info['admin']>0 || $p['sm1']==1 || $p['sm2']==1 || $p['citysm1']==1 || $p['citysm2']==1)){ ?>
        <a href="#" onClick="openMod('<b>Заклятие форумного молчания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Снять заклятие: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'1\'>чат</option><option value=\'2\'>форум</option><option value=\'3\'>чат + форум</option></select> <input type=\'submit\' name=\'usesm\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/sleep_off.gif" title="Снять заклятие молчания" /></a> <? } ?>
        <? if($p['banned']==1 || $p['ban0']==1){ ?> <a href="#" onClick="openMod('<b>Заклятие смерти</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'useban\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/pal_button6.gif" title="Заклятье смерти" /></a> <? } ?>
        <? if($p['unbanned']==1){ ?> <a href="#" onClick="openMod('<b>Снять заклятие смерти</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'useunban\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/pal_button7.gif" title="Снять заклятье смерти" /></a> <? } ?>
	<? if($p['haos']==1){ ?> <a href="#" onClick="openMod('<b>Отправить в хаос</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'3\'>3 суток</option><option value=\'7\'>Неделя</option><option value=\'14\'>2 недели</option><option value=\'30\'>Месяц</option><option value=\'60\'>2 месяца</option><? if($p['haosInf']==1){ ?><option value=\'1\'>Бессрочно</option><? } ?> <input type=\'submit\' name=\'usehaos\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/pal_button4.gif" title="Отправить в хаос" /></a> <? } ?>
        <? if($p['shaos']==1){ ?> <a href="#" onClick="openMod('<b>Выпустить из хаоса</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'useshaos\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/pal_button5.gif" title="Выпустить из хаоса" /></a> <? } ?>
       	<? if($p['deletInfo']==1){ ?> <a href="#" onClick="openMod('<b>Обезличивание</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'7\'>Неделя</option><option value=\'14\'>2 недели</option><option value=\'30\'>Месяц</option><option value=\'60\'>2 месяца</option><option value=\'1\'>Бессрочно</option> <input type=\'submit\' name=\'usedeletinfo\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/cui.gif" title="Обезличивание" /></a>
        <a href="#" onClick="openMod('<b>Снять заклятие обезличивания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'unusedeletinfo\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/uncui.gif" title="Снять обезличивание" /></a> <? } ?>
	<? if($p['priemIskl']==1 && $a==1){ ?> <a href="#" onClick="openMod('<b>Принять в ОС</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Звание: &nbsp; <select style=\'margin-left:2px;\' name=\'zvanie\'><option value=\'1.1\'> Паладин Поднебесья</option><option value=\'1.5\'>Паладин Солнечной Улыбки</option><option value=\'1.6\'>Инквизитор</option><option value=\'1.81\'>Глава Инквизиции</option><option value=\'1.7\'>Паладин Огненной Зари</option><option value=\'1.75\'>Паладин-Хранитель</option><option value=\'1.9\'>Паладин Неба</option><option value=\'1.91\'>Старший Паладин Неба</option><option value=\'1.92\'>Ветеран Ордена</option><input type=\'submit\' name=\'gomoder\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/pal.gif" title="Принять в ОС (Повысить)" /></a>
        <a href="#" onClick="openMod('<b>Изгнать из ОС</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'unmoder\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/unpal.gif" title="Изгнать из ОС" /></a> <? } ?>  
        <? if($u->info['admin']>0 || ($p['priemIskl']==1 && $a==3)){ ?>
        <a href="#" onClick="openMod('<b>Принять в Армаду</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Звание: &nbsp; <select style=\'margin-left:2px;\' name=\'zvanie\'><option value=\'3.01\'>Тарман-Служитель</option><option value=\'3.05\'>Тарман-Надсмотрщик</option><option value=\'3.06\'>Каратель</option><option value=\'3.81\'>Министр Обороны</option><option value=\'3.07\'>Тарман-Убийца</option><option value=\'3.075\'>Тарман-Хранитель</option><option value=\'3.09\'>Тарман-Палач</option><option value=\'3.091\'>Тарман-Владыка</option><input type=\'submit\' name=\'gomoder\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/palt.gif" title="Принять в Армаду (Повысить)" /></a>
        <a href="#" onClick="openMod('<b>Изгнать из Армады</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'unmoder\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/unpalt.gif" title="Изгнать из ОС" /></a> <? } ?>  
	<? if($p['proverka']==1){ ?> <a href="#" onclick="openMod('<b>Проверка на чистоту</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><input type=\'submit\' name=\'usepro\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/check.gif" title="Проверка на чистоту" /></a> <? } ?>
	<? if($p['proverka']==1){ ?> <a href="#" onclick="openMod('<b>Снять проверку на чистоту</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><input type=\'submit\' name=\'usepro2\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/pal_buttont.gif" title="Снять проверку на чистоту" /></a> <? } ?>
	<? if($p['proverka']==1){ ?> <a href="#" onclick="openMod('&lt;b&gt;Запрет передач&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usenoper\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/mod/magic2.gif" title="Запрет на передачи" /></a>
        <? } ?>
        <? if($p['proverka']==1){ ?> <a href="#" onclick="openMod('&lt;b&gt;Снять запрет передач&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'useunnoper\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/mod/magic9.gif" title="Снять запрет на передачи" /></a>
        <? } ?>
        <? if($p['proverka']==1){ ?> <a href="#" onclick="openMod('&lt;b&gt;Полный запрет передач&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usenoper2\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/mod/magic2.gif" title="Полный запрет на передачи" /></a>
        <? } ?>
        <? if($p['proverka']==1){ ?> <a href="#" onclick="openMod('&lt;b&gt;Снять полный запрет передач&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'useunnoper2\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/mod/magic9.gif" title="Снять полный запрет на передачи" /></a>
        <? } ?>	
	<? if( $u->info['admin'] > 0) {
	if($p['usealign3']==1){ ?>
	<a href="#" onclick="openMod('&lt;b&gt;Выдать темную склонность&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usealign3\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button[dark].gif" title="Выдать темную склонность" /></a>
	<? } if($p['usealign1']==1){ ?>
	<a href="#" onclick="openMod('&lt;b&gt;Выдать светлую склонность&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usealign1\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button1.gif" title="Выдать светлую склонность" /></a>
	<? } if($p['usealign7']==1){ ?>
	<a href="#" onclick="openMod('&lt;b&gt;Выдать нейтральную склонность&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usealign7\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/palbuttonneutralsv3.gif" title="Выдать нейтральную склонность" /></a>
	<? } } ?>
	<? if($p['proverka']==1){ ?><a href="#" onclick="openMod('&lt;b&gt;Снять склонность\клан&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'useunalign\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/palbuttondarkhc1.gif" title="Снять склонность\клан" /></a>
	<? } ?>
        <? if($p['unbtl']==1){ ?>
        <a href="#" onclick="openMod('&lt;b&gt;Вытащить из поединка&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' value=\'<?php echo (isset($_POST['logingo']) ? $_POST['logingo'] : $u->info['login']);?>\'style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'useunfight\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button[battle_end].gif" title="Вытащить из поединка" /></a>
        <? } if($u->info['admin'] > 0 ){ ?>
        <a href="#" onclick="openMod('&lt;b&gt;Рисануть опыта&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;<br>Добавочный опыт: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo2\' name=\'logingo2\'&gt;&lt;input type=\'submit\' name=\'100kexp\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/100kexp.gif" title="Рисануть опыта" /></a>
        <? } if($u->info['admin'] > 0 ){ ?>
        <a href="#" onclick="openMod('&lt;b&gt;Выдать VIP&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;<br>Введите число 3 (три): &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo2\' name=\'logingo2\'&gt;&lt;input type=\'submit\' name=\'vip3\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/aprem1.gif" title="Выдать VIP" /></a>
	<? } if($u->info['admin'] > 0 ){ ?>
        <a href="#" onclick="openMod('&lt;b&gt;Выдать 11 побед&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;<br>Введите число 11: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo2\' name=\'logingo2\'&gt;&lt;input type=\'submit\' name=\'wins11\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/lmap.gif" title="Выдать 11 Побед" /></a>
        <? } ?> 
        <? if($p['zatoch']==1){ ?> <a href="#"  onClick="openMod('<b>Посадить</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заточения: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'1\'>1 день</option><option value=\'3\'>3 дня</option><option value=\'7\'>неделя</option><option value=\'14\'>14 дней</option><option value=\'30\'>30 дней</option><option value=\'365\'>365 дней</option><option value=\'24\'>Бессрочно</option><option value=\'6\'>часик</option><input type=\'submit\' name=\'use_carcer\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/jail.gif" title="Заточение" /></a> <? } ?>
        <? if($p['szatoch']==1){ ?> <a href="#" onClick="openMod('<b>Выпустить из заточения</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'v_carcer\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/jail_off.gif" title="Выпустить из заточения" /></a> <? } ?>
        <? if($p['marry']==1){ ?>
        <a href="#" onclick="openMod('<b>Свадьба</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo2\' name=\'logingo2\'><br><input type=\'submit\' name=\'usemarry\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/marry.gif" title="Брак" /></a>
        <a href="#" onclick="openMod('<b>Расторгнуть брак</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><input type=\'submit\' name=\'useunmarry\' value=\'Исп-ть\'></form>');"><img src="//img.testcombats.ru/i/items/unmarry.gif" title="Расторгнуть брак" /></a>
		<? } ?>
        <? if($u->info['admin']>0){ ?> 
		<a onClick="openMod('<b>Телепортация</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\' value=\'<? echo $u->info['login']; ?>\'><br>Город: &nbsp; <select style=\'margin-left:2px;\' name=\'city\'><option value=\'angelscity\'>Angels City</option><option value=\'capitalcity\'>Capital City</option><option value=\'demonscity\'>Demons City</option><option value=\'devilscity\'>Devils City</option><option value=\'sandcity\'>Sand City</option><option value=\'suncity\'>Sun City</option><option value=\'emeraldscity\'>Emeralds City</option><option value=\'mooncity\'>Moon City</option><option value=\'abandonedplain\'>Abandonedplain</option></select><input type=\'submit\' name=\'teleport\' value=\'Исп-ть\'></form>');" href="#"><img src="//img.testcombats.ru/i/items/teleport.gif" title="Телепортация" /></a>
		     <a onClick="openMod('<b>Отправить игрока к себе</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\' value=\'\'><br>Режим: &nbsp; <select style=\'margin-left:2px;\' name=\'cometome\'><option value=\'to-room\'>К себе</option><option value=\'to-fight\'>К себе и в бой</option><option value=\'to-dungeon\'>К себе в пещеру</option></select> <input type=\'submit\' name=\'teleport-cometome\' value=\'Исп-ть\'></form>');" href="#"><img src="//img.testcombats.ru/i/items/openport.gif" title="Отправить игрока к себе" /></a>
			 <!--<a href="#" onclick="openMod('<center><b>Начислить Екр</b></center>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа : <input type=\'text\' style=\'width:144px;\' id=\'add_baks\' name=\'add_baks\'><br />Укажите сумму : <input type=\'text\' style=\'width:144px;\' id=\'baks_give\' name=\'baks_give\'><br /><input name=\'edit_pass_baks\' type=\'text\' placeholder=\'пароль редактирования\'/><br><center><input type=\'submit\' name=\'set\' value=\'Выдать\'></center></form>');" href="#"><img src="//img.testcombats.ru/i/items/lab2_5kr.gif" title="Начислить Екр" /></a>
			<a href="#" onclick="openMod('<center><b>Начислить КР</b></center>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа :<input type=\'text\' style=\'width:144px;\' id=\'add_cr\' name=\'add_cr\'><br />Укажите сумму :<input type=\'text\' style=\'width:144px;\' id=\'cr_give\' name=\'cr_give\'><br /><input name=\'edit_pass_cr\' type=\'text\' placeholder=\'пароль редактирования\'/><br><center><input type=\'submit\' name=\'set\' value=\'Выдать\'></center></form>');" href="#"><img src="//img.testcombats.ru/i/items/mod/magic7.gif" title="Начислить КР" />  </a>-->
			 <a href="#" onclick="openMod('<center><b>Выдать вещь по Id</b></center>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'log_itm_\' name=\'log_itm_\'><br />ID вещи: <input type=\'text\' name=\'itm_id\' /><br /><input name=\'edit_pass_itm\' type=\'text\' placeholder=\'пароль редактирования\'/><input type=\'submit\' name=\'use_itm_\' value=\'Выдать\'></form>');"><img src="//img.testcombats.ru/i/items/bad_present_dfighter.gif" title="Выдать шмотку" /></a>
	   <a href="#" onclick="openMod('&lt;b&gt;Сменить пол персонажа&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;&lt;input type=\'submit\' name=\'usesex\' value=\'Исп-ть\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/male.png" title="Сменить пол персонажа" /></a>
    <a href="#" onclick="openMod('&lt;b&gt;Сменить логин персонажа&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Логин персонажа: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'&gt;<br>Новый логин: &lt;input type=\'text\' style=\'width:144px;\' id=\'logingo2\' name=\'logingo2\'&gt;&lt;input type=\'submit\' name=\'uselogin\' value=\'Изменить\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/nick.gif" title="Сменить логин персонажа" /></a>
	<? if($u->info['id'] == 15260604 || $u->info['id'] == 15260607)	{ ?>
	<a href="#" onclick="openMod('&lt;b&gt;Удалить персонажа&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Удалить ID: &lt;input type=\'text\' style=\'width:144px;\' id=\'idgo\' name=\'idgo\'&gt;&lt;input type=\'submit\' name=\'delete_bd\' value=\'Использовать\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/setid.gif" title="Удалить персонаж" /></a>
	<? } if($u->info['id'] == 15260604 || $u->info['id'] == 15260607) { ?>
	<a href="#" onclick="openMod('&lt;b&gt;Удалить Предмет&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Удалить предмет ID: &lt;input type=\'text\' style=\'width:144px;\' id=\'id\' name=\'id\'&gt;&lt;input type=\'submit\' name=\'delete_item\' value=\'Использовать\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/spell_seduct.gif" title="Удалить предмет" /></a>
	<? } if($u->info['id'] == 15260604 || $u->info['id'] == 15260607) { ?>
	<a href="#" onclick="openMod('&lt;b&gt;Удалить Бой&lt;/b&gt;','&lt;form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'&gt;Удалить Бой по ID: &lt;input type=\'text\' style=\'width:144px;\' id=\'id\' name=\'id\'&gt;&lt;input type=\'submit\' name=\'delete_battlelogs\' value=\'Использовать\'&gt;&lt;/form&gt;');"><img src="//img.testcombats.ru/i/items/pal_button[battle_delete].gif" title="Удалить Бой по ID" /></a>
	<? } if($u->info['id'] == 15260604 || $u->info['id'] == 15260607) { ?>
	<a href="#" onclick="openMod('<center><b>Начислить Компенсацию</b></center>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'add_cop\' name=\'add_cop\'><br />Укажите сумму: <input type=\'text\' style=\'width:144px;\' id=\'cop_give\' name=\'cop_give\'><br><input name=\'edit_pass_cop\' type=\'text\' placeholder=\'пароль редактирования\'/><input type=\'submit\' name=\'set\' value=\'Выдать\'></form>');"><img src="//img.testcombats.ru/i/items/battle_reward_hon_100.gif" title="Начислить Компенсацию" /></a>
   	<? } ?>
	   
	 <? } ?></td>
   </tr>
  </table>
   </div>
  <? }
  if($p['seeld']==1) {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Персонажи на одном ip-адресе</h4>  
  Введите ip-адрес  <input name="loginLD51" type="text" id="loginLD51" size="30" /> <input type="submit" name="pometka51" id="pometka51"  value="Показать" />
  </div>
<?
  if(isset($_POST['pometka51'])) {
	 $sp = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD51']).'" AND `type` != 3 GROUP BY `uid`'); 
	 $i = 1;
	 $r = '';
	 $ursz = array();
	 while($pl = mysql_fetch_array($sp)) {
		 $tst = mysql_fetch_array(mysql_query('SELECT `id`,`admin`,`no_ip` FROM `users` WHERE `no_ip` != "" AND `id` = "'.$pl['uid'].'" LIMIT 1'));
		 if(isset($tst['id']) && $tst['admin'] == 0 && ($tst['no_ip'] == 0 || $tst['no_ip'] == '')) {
			 if(!isset($ursz[$pl['uid']])) {
				$ursz[$pl['uid']] = $u->microLogin($pl['uid'],1); 
			 }
			 $de = mysql_fetch_array(mysql_query('SELECT min(`time`),max(`time`) FROM `logs_auth` WHERE `uid` = "'.mysql_real_escape_string($pl['uid']).'" GROUP BY `uid` LIMIT 1'));
			 $r .= '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">';
			 $r .= '<span style="display:inline-block;width:30px">'.$i.'.</span> <span style="display:inline-block;width:250px">'.$ursz[$pl['uid']].'</span>';
			 
			 $r .= ' &nbsp; <small>(Череда авторизаций: '.date('d.m.Y H:i',$de[0]).' - '.date('d.m.Y H:i',$de[1]).')</small>';
			 
			 $r .= '</div>';
			 $i++;
		 }
	 }
	 
	 if( $u->info['admin'] == 0 && $u->info['align'] != 1.99 ) {
	 	echo '&nbsp;&nbsp; <font color="red">Список персонажей с ip-адреса:<b>'.$_POST['loginLD51'].'</b></font><br>';
	 }else{
		$block = mysql_fetch_array(mysql_query('SELECT * FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD51']).'" LIMIT 1')); 
	 	if(!isset($block['id'])) {
			echo '&nbsp;&nbsp; <font color="green">Список персонажей с ip-адреса:<b>'.$_POST['loginLD51'].'</b></font>';
			echo ' <input  onclick="location.href=\'main.php?'.$zv.'&block_ip='.htmlspecialchars($_POST['loginLD51']).'\'" type="button" value="Заблокировать IP">';
			echo '<br>';
		}else{
			echo '&nbsp;&nbsp; <font color="red">Список персонажей с ip-адреса:<b>'.$_POST['loginLD51'].'</b></font>';
			echo ' <input  onclick="location.href=\'main.php?'.$zv.'&unblock_ip='.htmlspecialchars($_POST['loginLD51']).'\'" type="button" value="Разблокировать IP">';
			echo '<br>';
		}
	 }
	 
	 
	 if($r == '') {
		 echo '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">Персонажи с данным ip-адресом не найдены</div>';
	 }else{
		 echo $r;
	 }	 
	 unset($r);
  }
  
  }
  if($u->info['admin'] > 0) {
	  
			$types = array(
				1  => array('Образ',120,220,100),
				2  => array('Заглушка (снизу)',120,40,15),
				3  => array('Заглушка (сверху)',120,20,5),
				4  => array('Шлем',60,60,25),
				5  => array('Наручи',60,40,25),
				6  => array('Левая рука',60,60,25),
				7  => array('Правая рука',60,60,25),
				8  => array('Броня',60,80,25),
				9  => array('Пояс',60,40,25),
				10 => array('Ботинки',60,40,25),
				11 => array('Поножи',60,80,25),
				12 => array('Перчатки',60,40,25),
				13 => array('Кольца №1',20,20,10),
				14 => array('Кулон',60,20,25),
				15 => array('Серьги',60,20,25),						
				16 => array('Заглушка под информацию о персонаже',244,287,5),						
				17 => array('Кольцо №2',20,20,10),
				18 => array('Кольцо №3',20,20,10)					
			);
	  
	  if(isset($_GET['grood_img'])) {
		  
		  $imgid = round((int)$_GET['grood_img']);
		  if(mysql_query('UPDATE `reimage` SET `good` = "'.$u->info['id'].'" WHERE `id` = "'.mysql_real_escape_string($imgid).'" AND `good` = "0" AND `bad` = "0" LIMIT 1')) {
			  //Переносим изображение			  
			  $vr = mysql_fetch_array(mysql_query('SELECT * FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'" LIMIT 1'));
			  $vr['format'] = explode('.',$vr['src']);
			  $vr['format'] = $vr['format'][2];
			  copy('clan_prw/'.$vr['src'],'img.testcombats.ru/rimg/r'.$vr['id'].'.'.$vr['format']);
			  mysql_query('UPDATE `reimage` SET `format` = "'.$vr['format'].'" WHERE `id` = "'.mysql_real_escape_string($imgid).'" LIMIT 1');
			  
		 	  if($vr['clan'] == 0) {
				//Отправляем системку
		  		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  		'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'Вам одобрили изображение -".$types[$vr['type']][0]."-, установить изображение возможно в инвентаре, в разделе &quot;Галерея&quot;\'.','-1','5','0')");
			  }else{
				//Отправляем системку
		  		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  		'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'Вам одобрили клановое изображение -".$types[$vr['type']][0]."-, установить изображение возможно в инвентаре, в разделе &quot;Галерея&quot;\'.','-1','5','0')");
			  }
		  }
		  
	  }elseif(isset($_GET['bad_img'])) {
		  
		  $imgid = round((int)$_GET['bad_img']);
		  if(mysql_query('UPDATE `reimage` SET `bad` = "'.$u->info['id'].'" WHERE `id` = "'.mysql_real_escape_string($imgid).'" AND `good` = "0" AND `bad` = "0" LIMIT 1')) {
			  //Возвращаем 90% екр. за образ
			  $vr = mysql_fetch_array(mysql_query('SELECT * FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'" LIMIT 1'));
			  $vr['money2'] = round($vr['money2']/100*9);
			  
			  if($vr['clan'] > 0) {
				  //возврат для клана				  
				  mysql_query('UPDATE `clan` SET `money2` = `money2` + '.$vr['money2'].' WHERE `id` = "'.$vr['clan'].'" LIMIT 1');
		 			//Отправляем системку
		  			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  			'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'Вам было отказано в регистрации кланового изображения -".$types[$vr['type']][0]."- , ".$vr['money2']." екр. были переведены в казну клана\'.','-1','5','0')");

			  }else{
				  //возврат для игрока в банк
				  $bnk = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$vr['uid'].'" AND `block` = "0" ORDER BY `id` DESC LIMIT 1'));
				  if(isset($bnk['id'])) {
				  	mysql_query('UPDATE `bank` SET `money2` = `money2` + '.$vr['money2'].' WHERE `id` = "'.$bnk['id'].'" LIMIT 1');
				  }
		 			//Отправляем системку
		  			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  			'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'Вам было отказано в регистрации изображения -".$types[$vr['type']][0]."- , ".$vr['money2']." екр. были переведены на ваш банковский счет №".(0+$bnk['id'])."\'.','-1','5','0')");
			  
			  }
		  }
		  
	  }
	  
	  $zvr = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `reimage` WHERE `good` = "0"'));
	  if($zvr[0] > 0) {
		  		  
	?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <div style="padding:10px;"><b>Заявки на регистрацию изображений для предметов:</b>
  &nbsp;   <?
  			
			$sp = mysql_query('SELECT * FROM `reimage` WHERE `good` = "0" AND `bad` = "0" ORDER BY `id` ASC LIMIT 10');
			$i = 1;
			
			$va = array('Нет','Да');
			
			$rt = '';
			while($pl = mysql_fetch_array($sp)) {
				if($pl['bag'] > 0) {
					$rt .= '<font color=red><b>(!)</b>';
				}
				
				$plcln = 0;
				if($pl['clan'] > 0) {
					$plcln = 1;
				}
				
				$rt .= '<div style="border-top:1px solid grey;padding:5px;">'.$i.'. <span class="date1">'.date('d.m.y H:i',$pl['time']).'</span> <b>'.$u->microLogin($pl['uid'],1).'</b> , &quot;'.$types[$pl['type']][0].'&quot; , Анимация: <b>'.$va[$pl['animation']].'</b> , Изображение для клана: <b>'.$va[$plcln].'</b> , <img onclick="imresize(this,'.$types[$pl['type']][2].','.$types[$pl['type']][1].');" style="border:1px solid blue;cursor:pointer;" src="/clan_prw/'.$pl['src'].'" height="20">';
				
				$rt .= ' <input onclick="location.href=\'main.php?admin=1&grood_img='.$pl['id'].'\'" type="button" value="Принять" style="background:#E2EDD8"> <input type="button" onclick="location.href=\'main.php?admin=1&bad_img='.$pl['id'].'\'" style="background:#FCC9CA" value="Отказать"> <br>';
				
				$rt .= '</div>';
				
				if($pl['bag'] > 0) {
					$rt .= '</font>';
				}
				$i++;
			}
			echo $rt;
			
  ?>
  </div>
  <script>
  function imresize(e,h,w) {
	 if($(e).height() == 20) {		 
		  $(e).animate({'height':h+'px'},100,null,function(){
			if($(e).width() != w) {
			 	$(e).css({'border-color':'red'});
		 	}else{
				$(e).css({'border-color':'green'}); 
		 	}	  
		  }); 
	 }else{		 
		 $(e).animate({'height':'20px'},100);
		 $(e).css({'border-color':'blue'});	
		 $(e).width(false);	 
	 }
  }
  </script>
  </div>
<? 
	  }
	  
	  $zvr = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `_clan` WHERE `admin_time` = "0"'));
	  if($zvr[0] > 0) {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <div style="padding:10px;"><b>Заявки на регистрацию кланов:</b> &nbsp; <?
  if(isset($_GET['goodClan'])) {
	 //Разрешение
	 $cl = mysql_fetch_array(mysql_query('SELECT * FROM `_clan` WHERE `admin_time` = "0" AND `id` = "'.mysql_real_escape_string($_GET['goodClan']).'" LIMIT 1')); 
	 if(isset($cl['id']))
	 {
		 $pu = mysql_fetch_array(mysql_query('SELECT `id`,`city`,`room`,`clan`,`login`,`align`,`level`,`sex`,`money`,`banned` FROM `users` WHERE `id` = "'.mysql_real_escape_string($cl['uid']).'" LIMIT 1'));
		 $tc = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `clan` WHERE `name` = "'.mysql_real_escape_string($cl['name']).'" OR `name` = "'.mysql_real_escape_string($cl['name2']).'"
		 OR `name_mini` = "'.mysql_real_escape_string($cl['name']).'" OR `name_mini` = "'.mysql_real_escape_string($cl['name2']).'"
		 OR `name_rus` = "'.mysql_real_escape_string($cl['name']).'" OR `name_rus` = "'.mysql_real_escape_string($cl['name2']).'" LIMIT 1'));
		 if(!isset($pu['id'])) {
			 echo '<font color=red><b>Персонаж выступающий в роли Главы клана не найден, id '.$cl['uid'].'</b></font><br>';
		 }elseif($pu['clan'] > 0 || $pu['align'] > 0 || $pu['banned'] > 0) {
			 echo '<font color=red><b>Персонаж выступающий в роли Главы клана уже находится в клане, либо имеет склонность, либо заблокирован</b></font><br>';
		 }elseif($u->testAlign( $cl['align'] , $pu['id'] ) == 0 ) {
			 echo '<font color=red><b>Персонаж выступающий в роли Главы клана не может создавать клан с данной склонностью!</b></font><br>';
		 }elseif(isset($tc['id'])) {
			 echo '<font color=red><b>Схожий клан был зарегистрирован ранее, клана №'.$tc['id'].' ('.$tc['name'].').</b></font><br>';
		 }else{

			 //Переносим изображения в img.testcombats.ru/i/clan/{name}.gif / {name}_big.gif / {id}.gif / {id}.gif
			 //Маленький значок
             //$copyImg = copy('clan_prw/'.$cl['img1'],'/home/admin/web/img.testcombats.ru/public_html/i/clan/'.$cl['name2'].'.gif');
             //$copyImg = exec('cp /home/admin/web/testcombats.ru/public_html/clan_prw/'.$cl['img1'].' /home/admin/web/img.testcombats.ru/public_html/i/clan/'.$cl['name2'].'.gif',$output,$return1);

			 if(!$return1)
			 {
				//ex();
				 mysql_query('UPDATE `_clan` SET `admin_time` = "'.time().'",`admin_ok` = "'.$u->info['id'].'" WHERE `id` = "'.$cl['id'].'" LIMIT 1');
				 $ins = mysql_query('INSERT INTO `clan` (`name`,`name_rus`,`name_mini`,`site`,`align`,`time_reg`) VALUES (
					"'.$cl['name2'].'",
					"'.$cl['name'].'",
					"'.$cl['name2'].'",
					"'.str_replace('//','',$cl['site']).'",
					"'.$cl['align'].'",
					"'.time().'"
				 )');
				 if( $ins ) {
					 //
					 $cl['_id'] = mysql_insert_id();
					 $u->insertAlign( $cl['align'] , $pu['id'] );
					 mysql_query('INSERT INTO `clan_info` (`id`,`info`) VALUES (
					 "'.$cl['_id'].'",
					 "'.mysql_real_escape_string($cl['info']).'"
					 )');
                     exec('cp /home/admin/web/testcombats.ru/public_html/clan_prw/'.$cl['img1'].' /home/admin/web/img.testcombats.ru/public_html/i/clan/'.$cl['_id'].'.gif');
                     exec('cp /home/admin/web/testcombats.ru/public_html/clan_prw/'.$cl['img2'].' /home/admin/web/img.testcombats.ru/public_html/i/clan/'.$cl['_id'].'_big.gif');
                     exec('cp /home/admin/web/testcombats.ru/public_html/clan_prw/'.$cl['img2'].' /home/admin/web/img.testcombats.ru/public_html/i/clan/cln'.$cl['_id'].'.gif');
                     exec('cp /home/admin/web/testcombats.ru/public_html/clan_prw/'.$cl['img2'].' /home/admin/web/img.testcombats.ru/public_html/i/clan/cln'.$cl['name2'].'_big.gif');
					 mysql_query('UPDATE `users` SET `clan` = "'.$cl['_id'].'",`clan_prava` = "glava",`align` = "'.$cl['align'].'" WHERE `id` = "'.$pu['id'].'" LIMIT 1');
					 echo '<font color=red><b>Вы одобрили регистрацию клана &quot;'.$cl['name'].'&quot;</b></font><br>';
				 }else{
					  echo '<font color=red><b>Не удалось перенести значок 2</b></font><br>';
				 }
			 }else{
				 echo '<font color=red><b>Не удалось перенести значок 1</b></font><br>';
			 }
			 //Отправляем системку главе клана
		  	mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  	'1','".$pu['city']."','0','','".$pu['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'Поздравляем Вас с регистрацией клана &quot;".mysql_real_escape_string($cl['name'])."&quot;, будьте успешны! Соблюдайте законы нашего Мира и всячески помогайте его улучшать.\' .','-1','6','0')");

		 }
	 }
  }elseif(isset($_GET['badClan'])) {
	 //Отказ
	 $cl = mysql_fetch_array(mysql_query('SELECT * FROM `_clan` WHERE `admin_time` = "0" AND `id` = "'.mysql_real_escape_string($_GET['badClan']).'" LIMIT 1')); 
	 if(isset($cl['id'])) {
		  $pu = mysql_fetch_array(mysql_query('SELECT `id`,`city`,`room`,`clan`,`login`,`align`,`level`,`sex`,`money`,`banned` FROM `users` WHERE `id` = "'.mysql_real_escape_string($cl['uid']).'" LIMIT 1')); 
		  echo '<font color=red><b>Вы отказали в регистрации клану &quot;'.$cl['name'].'&quot;</b></font><br>';
		  mysql_query('UPDATE `_clan` SET `admin_time` = "'.time().'",`admin_ca` = "'.$u->info['id'].'" WHERE `id` = "'.$cl['id'].'" LIMIT 1');
		  //Отправляем системку персонажу
		  mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  '1','".$pu['city']."','0','','".$pu['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'К сожалению Вам отказано в регистрации клана &quot;".mysql_real_escape_string($cl['name'])."&quot;, были не соблюдены правила регистрации. Вам отправлено по почте ".round($cl['money']*1,2)." кр.\' .','-1','6','0')");
	 	  
		 // Отправляем сумму
			mysql_query("INSERT INTO `items_users`(`item_id`,`1price`,`uid`,`delete`,`lastUPD`)VALUES('1220','".mysql_real_escape_string(round($cl['money']*1,2))."','-51".$pu['id']."','0','".time()."');");
					
			$txt = 'Кредиты от Администрации: '.round($cl['money']*1,2).' кр. Прибытие: '.date('d.m.Y H:i',time()).'';
			mysql_query('INSERT INTO `post` (`uid`,`sender_id`,`time`,`money`,`text`) VALUES("'.$pu['id'].'","0","'.time().'","'.mysql_real_escape_string(round($cl['money']*1,2)).'","'.mysql_real_escape_string($txt).'")');

			//чат
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$pu['city']."','0','','".$pu['login']."','<font color=red>Внимание!</font> Получена новая почта от Администрации','-1','6','0')");
		  
	 }
  }
  ?></div>
  <script>
  function imgResize1(id) {
	  if($('#'+id).width() == 16) {
		  $('#'+id).animate({'height':'99px','width':'100px'},'fast');
	  }else{
		  $('#'+id).animate({'height':'15px','width':'16px'},'fast');
	  }
  }
  function seeClanINfo(id) {
	 if( $('#'+id).css('display') == 'block') {
		 $('#'+id).fadeOut('fast');
	 }else{
		 $('#'+id).fadeIn('fast');
	 }
  }
  </script>
  <?
  		$sp = mysql_query('SELECT * FROM `_clan` WHERE `admin_time` = "0" ORDER BY `time` ASC LIMIT 10');
		while($pl = mysql_fetch_array($sp)) {
			echo '<div style="border-top:1px solid grey;padding:5px;">
			#'.$pl['id'].' <font color="#cac9c7">|</font>
			'.date('d.m.y H:i',$pl['time']).' / '.$pl['money'].'.00 кр.
			<font color="#cac9c7">|</font>
			<img style="border:1px solid grey;display:inline-block;vertical-align:bottom;margin:0;padding:1px;" src="//testcombats.ru/clan_prw/'.$pl['img1'].'" width="24" height="15">'.
			'<span id="img'.$pl['id'].'clan2"><img id="img'.$pl['id'].'clan" style="border:1px solid blue;border-left:0;display:inline-block;vertical-align:bottom;margin:0;padding:0;" src="//testcombats.ru/clan_prw/'.$pl['img1'].'">'.
			'<script>$("#img'.$pl['id'].'clan").ready(function(){$("#img'.$pl['id'].'clan2").html(" "+$("#img'.$pl['id'].'clan").width()+"x"+$("#img'.$pl['id'].'clan").height()); });</script>
			</span>
			<font color="#cac9c7">|</font>
			<img id="img'.$pl['id'].'clan30" style="border:1px solid grey;display:inline-block;cursor:pointer;vertical-align:bottom;margin:0;padding:1px;width:16px;height:15px;" onclick="imgResize1(\'img'.$pl['id'].'clan30\')" src="//testcombats.ru/clan_prw/'.$pl['img2'].'">'.
			'<span id="img'.$pl['id'].'clan4"><img id="img'.$pl['id'].'clan3" style="border:1px solid blue;border-left:0;display:inline-block;vertical-align:bottom;margin:0;padding:0;" src="//testcombats.ru/clan_prw/'.$pl['img2'].'">'.
			'<script>$("#img'.$pl['id'].'clan3").ready(function(){$("#img'.$pl['id'].'clan4").html(" "+$("#img'.$pl['id'].'clan3").width()+"x"+$("#img'.$pl['id'].'clan3").height()); });</script>
			</span>
			<font color="#cac9c7">|</font>
			'.$u->microLogin($pl['uid'],1).'
			<font color="#cac9c7">|</font>
			<span style="display:inline-block;background:white;padding:2px 20px 2px 20px;text-align:center;">'.$pl['name'].'</span>
			<font color="#cac9c7">|</font>
			<span style="display:inline-block;background:white;padding:2px 20px 2px 20px;text-align:center;">'.$pl['name2'].'</span> (EN)
			<font color="#cac9c7">|</font>
			<img src="//img.testcombats.ru/i/align/align'.$pl['align'].'.gif">
			<font color="#cac9c7">|</font>
			<a href="javascript:void(0)" onClick="seeClanINfo(\'clndiv'.$pl['id'].'\');">Сайт и Описание</a>
			<font color="#cac9c7">|</font>
			&nbsp;<input onclick="location.href=\'?admin=1&goodClan='.$pl['id'].'\'" type="button" value="Разрешить"> &nbsp;<font color="#cac9c7">|</font>&nbsp; <input onclick="location.href=\'?admin=1&badClan='.$pl['id'].'\'" type="button" value="Отказать">
				<div id="clndiv'.$pl['id'].'" style="padding:10px;display:none">
					<b>Сайт клана:</b> <a target="_blank" href="'.$pl['site'].'">'.$pl['site'].'</a><br><Br>
					Описание клана (для библиотеки):<br>
					<div style="max-width:620px;margin:10px;padding:10px;background:white;">
					<img src="//testcombats.ru/clan_prw/'.$pl['img2'].'" width="100" height="99" style="float:right">
					<center><h3>'.$pl['name'].'</h3></center>
					<br><div style="text-align:justify;">'.$pl['info'].'</div></div>
					<div style="width:600px;" align="center"><a href="javascript:void(0)" onClick="seeClanINfo(\'clndiv'.$pl['id'].'\');">(Скрыть информаци сайта и описания)</a></div>					
				</div>
			</div>';
		}
  ?>
  </div>
  <? 
	  }
  }
	
  if($u->info['admin'] > 0)
  {
	  if(isset($_POST['add_item_to_user2']))
	  {
		if(md5($_POST['edit_pass1']) == $c['edit_pass'])
		{
			 $uad = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['add_item_to_login']).'" LIMIT 1'));
			 if( isset($uad['id']))
			 {
				for($n=1; $n<=$_POST['add_item_to_user_num']; $n++)
				{
				 	$u->addItem(round((int)$_POST['add_item_to_user']),$uad['id'], null, null, null, null, null, 1);
				}
	            mysql_query('INSERT INTO `users_delo` (`onlyAdmin`,`hb`,`uid`,`time`,`city`,`text`,`login`,`ip`) VALUES ("1","0","'.$uad['id'].'","'.time().'","'.$uad['city'].'","'.$rang.' &quot;'.$u->info['login'].'&quot; <font color=red>выдал предмет</font>: №'.round((int)$_POST['add_item_to_user']).' (X'.$_POST['add_item_to_user_num'].') персонажу <b>'.$uad['login'].'</b>.","'.$u->info['login'].'","'.$u->info['ip'].'")');

				echo '<font color=red><b>'.$_POST['add_item_to_user_num'].' предметов было доставлено к персонажу</b></font>';
			 }else{
				 echo '<font color=red><b>Персонаж не найден</b></font>';
			 }
        } else echo '<font color="red"><b>Неверный пароль редактирования.</b></font>'.md5($_POST['edit_pass1']);
	  }
      if(isset($_POST['add_item_all2']) && isset($_POST['add_item_all']) && $_POST['add_item_all']!='')
	  {
        if(md5($_POST['edit_pass2']) == $c['edit_pass'])
		{
            $count = 0;
			$result = mysql_query('SELECT `id` FROM `users` WHERE `online` > "'.(time()-86400*7).'"
			AND `banned` = "0" AND `pass`!="saintlucia" AND no_ip!="trupojor"');
			while($uad = mysql_fetch_array($result))
			{
			 	$u->addItem(round((int)$_POST['add_item_all']),$uad['id'], null, null, null, null, null, 1);
                $count++;
			}

			mysql_query('INSERT INTO `users_delo` (`onlyAdmin`,`hb`,`uid`,`time`,`city`,`text`,`login`,`ip`)
			VALUES ("1","0","'.$u->info['id'].'","'.time().'","'.$u->info['city'].'","'.$rang.' &quot;'.$u->info['login'].'&quot; <font color=red>выдал предмет</font>: №'.round((int)$_POST['add_item_all']).' всем персонажам.","'.$u->info['login'].'","'.$u->info['ip'].'")');

			echo '<font color=red><b>Предмет был доставлен ко всем персонажам, входившим последние 7 дней в игру('.$count.').</b></font>';
        } else echo '<font color="red"><b>Неверный пароль редактирования.</b></font>';
	  }

	  if(isset($_POST['add_premium_all']) && isset($_POST['add_premium']))
	  {
		if(md5($_POST['edit_pass3']) == $c['edit_pass'])
		{
			$bonus = array(
			"name" => "Премиум",
			"speed_Loc" => "30",
			"speedHp" => "150",
			"speedMp" => "150",
			"addExp" => "100",
			"addRep" => "50",
			"ym_delay" => "50",
			"yv_drop" => "2",
			"speed_dunger" => "50",
			"mfza" => "10",
			"mf_yron" => "10",
			"sale_prc" => "100",
			"saleEkr_prc" => "100",
			"Exp_zver" => "100"
    		);

			$ptime = array('1' => '1800', '3' => '7200');
			$bonusT = $ptime[$_POST['add_premium']];
			$count = 0;

			$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "757"'));

			$result = mysql_query('SELECT `id` FROM `users` WHERE `online` > "'.(time()-7200*1).'" AND `banned` = "0"
			AND `pass`!="saintlucia" AND no_ip!="trupojor"');

			while($uad = mysql_fetch_array($result))
			{
				//echo $uad['id'].'<br>';
				$res = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "' . $uad['id'] . '" AND `time_delete` > "'.time().'"'));

			    $time_end = (isset($res['time_delete']) ? $res['time_delete'] : time()) + $bonusT;

			    if ($res['id'])
				{
					$ins = mysql_query('UPDATE `premium` SET
					`name` = "' . $bonus['name'] . '",
					`type` = "3",
					`time_delete` = "' . $time_end . '",
					`speed_Loc` = "' . $bonus['speed_Loc'] . '",
					`speedHp` = "' . $bonus['speedHp'] . '",
					`speedMp` = "' . $bonus['speedMp'] . '",
					`addExp` = "' . $bonus['addExp'] . '",
					`addRep` = "' . $bonus['addRep'] . '",
					`ym_delay` = "' . $bonus['ym_delay'] . '",
					`yv_drop` = "' . $bonus['yv_drop'] . '",
					`speed_dunger` = "' . $bonus['speed_dunger'] . '",
					`mfza` = "' . $bonus['mfza'] . '",
					`mf_yron` = "' . $bonus['mf_yron'] . '",
					`sale_prc` = "' . $bonus['sale_prc'] . '",
					`saleEkr_prc` = "' . $bonus['saleEkr_prc'] . '",
					`Exp_zver` = "' . $bonus['Exp_zver'] . '",
					`money` = "0"
					WHERE `uid` = "' . $uad['id'] . '"');
			    } else {
			        $ins = mysql_query('INSERT INTO `premium` SET
					`name` = "' . $bonus['name'] . '",
					`uid` = "' . $uad['id'] . '",
					`type` = "3",
					`time_delete` = "' . $time_end . '",
					`speed_Loc` = "' . $bonus['speed_Loc'] . '",
					`speedHp` = "' . $bonus['speedHp'] . '",
					`speedMp` = "' . $bonus['speedMp'] . '",
					`addExp` = "' . $bonus['addExp'] . '",
					`addRep` = "' . $bonus['addRep'] . '",
					`ym_delay` = "' . $bonus['ym_delay'] . '",
					`yv_drop` = "' . $bonus['yv_drop'] . '",
					`speed_dunger` = "' . $bonus['speed_dunger'] . '",
					`mfza` = "' . $bonus['mfza'] . '",
					`mf_yron` = "' . $bonus['mf_yron'] . '",
					`sale_prc` = "' . $bonus['sale_prc'] . '",
					`saleEkr_prc` = "' . $bonus['saleEkr_prc'] . '",
					`Exp_zver` = "' . $bonus['Exp_zver'] . '",
					`money` = 0');
			    }

				if ($ins)
				{
			        mysql_query('DELETE FROM `eff_users` WHERE `uid` = "' . $uad['id'] . '" AND `overType` = "777" AND `delete` = "0"') or die(mysql_error());
			        
			    	$result2 = mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`)
					VALUES ("' . $uad['id'] . '","' . $eff['id2'] . '","' . $eff['mdata'] . '","' . $eff['mname'] . '","777","' . $time_end . '","1","1")');
                    $count++;
				}
			}

			echo '<font color=red><b>Премиум Gold сроком '.($_POST['add_premium']==1 ? 'день' : 'неделя').' был выдан всем персонажам, входившим последние 7 дней в игру ('.$count.').</b></font>';
        } else echo '<font color="red"><b>Неверный пароль редактирования.</b></font>';
	  }
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Выдача</h4>
  	Выдать
	<select name="add_item_to_user_num">
	<?php
	for($n=1; $n<=50; $n++)
	{
		$sel = ($_POST['add_item_to_user_num']==$n ? ' selected' : '');
		echo '<option'.$sel.' value="'.$n.'">'.$n.'</option>';
	}
	?>
    </select>
  	предметов <input name="add_item_to_user" value="<?if(isset($_POST['add_item_to_user']))echo $_POST['add_item_to_user'];?>" /> персонажу <input name="add_item_to_login" value="<? echo (isset($_POST['add_item_to_login']) ? $_POST['add_item_to_login'] : $u->info['login']);?>" />
      <input name="edit_pass1" type="text" placeholder="Пароль"/>
	  <input type="submit" name="add_item_to_user2" id="add_item_to_user2"  value="Выдать" />
  </div>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  	Выдать предмет <input name="add_item_all" value="<?if(isset($_POST['add_item_all']))echo $_POST['add_item_all'];?>" />  всем персонажам
    <input name="edit_pass2" type="text" placeholder="Пароль"/>
  	<input type="submit" name="add_item_all2" id="add_item_all2"  value="Выдать" />
  </div>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  	Выдать Премиум Gold сроком на
	<select name="add_premium">
			<option value="1" <? if($_POST['add_premium']==1) echo ' selected';?>>1 час</option>
            <option value="2" <? if($_POST['add_premium']==2) echo ' selected';?>>2 часа</option>
    </select>  всем персонажам
    <input name="edit_pass3" type="text" placeholder="Пароль"/>
  	<input type="submit" name="add_premium_all" id="add_premium_all"  value="Выдать" />
  </div>
  <? 
  }
	
  if($p['addld']==1 || $p['cityaddld']==1 || $u->info['align']=="1.1" || $u->info['align']=="3.01"){ ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Добавить в дело</h4>
    Добавить в "дело" игрока заметку о нарушении правил, накрутке и пр.<br />
	<?
	  	if(isset($_POST['pometka']))
		{
			$er = '';
			$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`admin`,`align` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['loginLD']).'" LIMIT 1'));
			if(isset($usr['id']))
			{
				if(($u->info['align']>1 && $u->info['align']<2 && $usr['align']>3 && $usr['align']<4) || ($usr['align']>1 && $usr['align']<2 && $u->info['align']>3 && $u->info['align']<4) || $usr['admin']>$u->info['admin'])
				{
					$er = 'Персонаж "'.$_POST['loginLD'].'" носит вражескую склонность.';	
				}else{
					//Заносим данные в ЛД
					$lastD = mysql_fetch_array(mysql_query('SELECT `id` FROM `users_delo` WHERE `login` = "'.$u->info['login'].'" AND `time`>'.(time()-3).' LIMIT 1'));
					if(!isset($lastD['id']))
					{
						$hbld = 0;
						$hbld2 = 0;
						if(isset($_POST['hbld']))
						{
							$hbld = $a;
						}
						if(isset($_POST['hbldt'])) {
							$hbld2 = 1;
						}
						$ins = mysql_query('INSERT INTO `users_delo` (`onlyAdmin`,`hb`,`uid`,`time`,`city`,`text`,`login`,`ip`) VALUES ("'.$hbld2.'","'.$hbld.'","'.$usr['id'].'","'.time().'","'.$usr['city'].'","'.$rang.' &quot;'.$mod_login.'&quot; <b>сообщает</b>: '.mysql_real_escape_string(htmlspecialchars($_POST['textLD'],NULL,'cp1251')).'","'.$u->info['login'].'","'.$u->info['ip'].'")');
						if(!$ins)
						{
							$er = 'Ошибка записи в личное дело';
						}else{
							$er = 'Запись в личное дело прошла успешно';
						}
					}else{
						$er = 'Писать пометки в личном деле можно не чаще одного раза в 3 секунды.';
					}
				}
			}else{
				$er = 'Персонаж с логином "'.$_POST['loginLD'].'" не найден.';
			}
			if($er!='')
			{
				echo '<font color="red"><b>'.$er.'</b></font><br>';
			}
		}
	  ?>
    Введите логин
  <input name="loginLD" type="text" id="loginLD" size="30" maxlength="30" />
    Сообщение
  <input name="textLD" type="text" id="textLD" size="70" maxlength="500" /> <input type="submit" name="pometka" id="pometka"  value="Добавить" />
  <br />
  <label>
  <input name="hbld" type="checkbox" id="hbld" value="1" />  
    Записать, как причину отправки в хаос\блокировки
  </label>
  <? if($u->info['admin'] > 0) { ?>
  <br /><label>
  <input name="hbldt" type="checkbox" id="hbldt" value="1" />  
    Записать в секретное дело (видят только верховные и администрация)
  </label>
  <? }
  }
  
  if($p['readPerevod']==1){
  if(isset($_POST['itemID1b'])) {
	  $its = '';
	  $its = $u->genInv(1,'`iu`.`id` = "'.mysql_real_escape_string($_POST['itemID1']).'" LIMIT 1');
	  if($its[0] == 0) {
		 $its = 'Предмет не найден.'; 
	  }else{
		  $its = $its[2];
	  }
	  echo '<br><br><b>Предмет <u>id'.$_POST['itemID1'].'</u>:</b><br>'.$its;
  }
  ?><div style="padding-top:10px;">
    Проверить наличие предмета у персонажа <small>(не обязательно)</small> 
      <input name="itemID1login" type="text" id="itemID1login" size="30" maxlength="30" />
    , id предмета 
      <input name="itemID1" type="text" id="itemID1" size="30" maxlength="30" />
      <input type="submit" name="itemID1b" id="itemID1b"  value="Проверить" />
    </div>
  </div>
  <?
	$dsee = array();
	$dsee['login'] = $_POST['loginacts1'];
	$dsee['date'] = date('d.m.Y',time());
	if(isset($_POST['datesee']))
	{
		$dsee['date'] = $_POST['datesee'];
	}
	$dsee['date'] = explode('.',$dsee['date']);
	$dsee['date'] = $dsee['date'][2].'-'.$dsee['date'][1].'-'.$dsee['date'][0];
	$dsee['t1'] = strtotime($dsee['date'].' 00:00:00');
	$dsee['t2'] = strtotime($dsee['date'].' 23:59:59');
	$dsee['date'] = date('d.m.Y',$dsee['t1']);	
	 $i = 2;
	 while($i<=8)
	 {
		 if($_POST['hbld'.$i]==1)
		 {
		 	$dsee[$i] = 1;
		 }else{
			$dsee[$i] = 0; 
		 }
		 $i++;
	 }
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
    <h4>Показать переводы кредитов/вещей</h4>
    Просмотр действий персонажа
      <input name="loginacts1" type="text" id="loginacts1" value="<?=$dsee['login']?>" size="30" maxlength="30" />

      <p>
      <input name="hbld2" type="checkbox" id="hbld2" value="1" <?php if($dsee[2]==1){ echo 'checked="checked"'; } ?> />
    переводы 
      
  , 
    <input name="hbld3" type="checkbox" id="hbld3" value="1"  <?php if($dsee[3]==1){ echo 'checked="checked"'; } ?> />
    банк

    , 
    <input name="hbld4" type="checkbox" id="hbld4" value="1" <?php if($dsee[4]==1){ echo 'checked="checked"'; } ?> />
    покупка / ремонт

    , 
    <input name="hbld5" type="checkbox" id="hbld5" value="1" <?php if($dsee[5]==1){ echo 'checked="checked"'; } ?> />
    работа с инвентарем

    ,
    <input name="hbld6" type="checkbox" id="hbld6" value="1" <?php if($dsee[6]==1){ echo 'checked="checked"'; } ?> />
поединки ,
    <input name="hbld7" type="checkbox" id="hbld7" value="1" <?php if($dsee[7]==1){ echo 'checked="checked"'; } ?> /> добавление предметов,
	
    <input name="hbld8" type="checkbox" id="hbld8" value="1" <?php if($dsee[8]==1){ echo 'checked="checked"'; } ?> /> почта
	</p>

    За дату  
    <input name="delosee_1"  onclick="document.getElementById('datesee').value='<?=date('d.m.Y',($dsee['t1']-86400))?>';" type="submit" value="&laquo;" />
    <input name="datesee" type="text" id="datesee" value="<?=$dsee['date']?>" size="15" maxlength="10" />
    <input name="delosee_2"  onclick="document.getElementById('datesee').value='<?=date('d.m.Y',($dsee['t1']+86400))?>';" type="submit" value="&raquo;" />
    <input type="submit" name="delosee" id="delosee"  value="Отправить" />
    <?
	if(isset($_POST['delosee']) || isset($_POST['delosee_1']) || isset($_POST['delosee_2'])) {
	?>
    <div style="padding:0 0 5px 0; border-bottom:1px solid #cac9c7;">
    <small>Дата логов: <?=$dsee['date']?>, логин: <?=$dsee['login']?></small>
    </div>
    <?
	$dsee['inf'] = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($dsee['login']).'" LIMIT 1'));
	if(isset($dsee['inf']['id']) && ($dsee['inf']['admin']==0 || $u->info['admin']>0))
	{
		$sp = mysql_query('SELECT * FROM `users_delo` WHERE `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` DESC LIMIT 10000');
		while($pl = mysql_fetch_array($sp))
		{
			$dl = explode('.',$pl['login']);
			$se = 1;
			     if($dl[0]=='AddItems' && $dsee[7]==0){ $se = 0;
			}elseif($dl[0]=='Bank' && $dsee[3]==0){ $se = 0;
			}elseif(($dl[0]=='Shop' || $dl[0]=='EkrShop') && $dsee[4]==0){ $se = 0;
			}elseif($dl[1]=='remont' && $dsee[4]==0){ $se = 0;
			}elseif($dl[1]=='shop' && $dsee[4]==0){ $se = 0; 
			}elseif($dl[1]=='inventory' && $dsee[5]==0){ $se = 0;
			}elseif($dl[1]=='transfer' && $dsee[2]==0){ $se = 0;
			}
			if($se==1)
			{
				$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl['time']).' / <b>'.$pl['login'].'</b>:</small> '.$pl['text'];
				$dsee['dv'] .= '<br>';
			}
		}
		if($dsee[8]==1){
			//$sp1 = mysql_query('SELECT * FROM `post` WHERE  `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" OR `sender_id` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" OR `sender_id` = "-'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" LIMIT 10000');
			$sp1 = mysql_query('SELECT * FROM `post` WHERE  `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` DESC LIMIT 10000');
			echo '<hr/>';
			while($pl1 = mysql_fetch_array($sp1))
			{
				if (!$pl1['item_id']==0) {$dseetext = "[item:#".$pl1['item_id']."]";}
				$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl1['time']).' / <b>Почтовая посылка</b>:</small>'.$pl1['text'].' '.$dseetext;
				$dsee['dv'] .= '<br>';
				$dseetext="";
			} 
		}
		$sp1 = mysql_query('SELECT * FROM `clan_operations` WHERE  `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` DESC LIMIT 10000');
		echo '<hr/>';
		while($pl1 = mysql_fetch_array($sp1))
		{
			$pl1['text'] = ' Персонаж ';
			if( $pl1['type'] == 1 ) {
				$pl1['text'] .= '<b>снял кредиты</b> с казны клана: '.$pl1['val'].' кр.';
			}elseif( $pl1['type'] == 2 ) {
				$pl1['text'] .= '<b>положил кредиты</b> в казну клана: '.$pl1['val'].' кр.';
			}elseif( $pl1['type'] == 5 ) {
				$pl1['text'] .= '<b>взял</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана.';
			}elseif( $pl1['type'] == 4 ) {
				$pl1['text'] .= '<b>пожертвовал</b> предмет &quot;'.$pl1['val'].'&quot; в хранилище клана.';
			}elseif( $pl1['type'] == 7 ) {
				$pl1['text'] .= '<b>получил</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана. (Самостоятельный выход)';
			}elseif( $pl1['type'] == 8 ) {
				$pl1['text'] .= '<b>получил</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана. (Был изгнан из клана)';
			}elseif( $pl1['type'] == 3 ) {
				$pl1['text'] .= '<b>вернул</b> предмет &quot;'.$pl1['val'].'&quot; в хранилища клана.';
			} elseif( $pl1['type'] == 6 ) {
				$pl1['text'] .= '<b>изъял</b> предмет &quot;'.$pl1['val'].'&quot;.';
			} elseif( $pl1['type'] == 9 ) {
				$pl1['text'] .= '<b>вернул</b> предмет &quot;'.$pl1['val'].'&quot;. [Выход из клана (Возврат вещей не пренадлежащих персонажу)]';
			}elseif( $pl1['type'] == 10 ) {
					$pl1['text'] .= 'использовал абилку <b>&quot;'.$pl1['val'].'&quot;</b>.';
			}
			else{
				$pl1['text'] .= '<u>Незивестный тип операции. Предмет: '.$pl1['val'].' Тип: '.$pl1['type'].'</u>';
			}
			$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl1['time']).' / <b style="color:green">Клановая казна</b>:</small>'.$pl1['text'].' '.$dseetext;
			$dsee['dv'] .= '<br>';
			$dseetext="";
		} 
		
		if($dsee['dv']=='')
		{
			echo '<font color="red"><b>Действий и переводов за <B>'.$dsee['date'].'</B> не найдено.</b></font>';
		}else{
			echo $dsee['dv'];
		}
	}else{
		echo '<font color="red"><b>Персонаж не найден, либо его дело нельзя просматривать...</b></font>';
	}
	?>
    <?php } ?>
  </div>
  <? } 
  
  if($p['priemIskl']==1){
	  if(isset($_POST['pometka52015'])) {
	  	$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['loginLD52015']).'" ORDER BY `id` ASC LIMIT 1'));
	  	if(!isset($uu['id'])) {
			echo '<div><font color=red><b>Персонаж не найден!</b></font></div>';
		}elseif($u->info['admin'] == 0 && $uu['align'] > 1 && $uu['align'] < 2 && $a != 1) {
			echo '<div><font color=red><b>Вы не можете поменять звание этому паладину</b></font></div>';
		}elseif($u->info['admin'] == 0 && $uu['align'] > 3 && $uu['align'] < 4 && $a != 3) {
			echo '<div><font color=red><b>Вы не можете поменять звание этому тарману</b></font></div>';
		}elseif( $a == 1 && ($uu['align'] <= 1 || $uu['align'] >=2 || ($uu['admin'] > 0 && $u->info['admin'] == 0) || ($uu['align'] > $u->info['align'] && $u->info['admin'] == 0)) ) {
			echo '<div><font color=red><b>Вы не можете поменять звание этому персонажу!</b></font></div>';
		}elseif( $a == 3 && ($uu['align'] <= 3 || $uu['align'] >=4 || ($uu['admin'] > 0 && $u->info['admin'] == 0) || ($uu['align'] > $u->info['align'] && $u->info['admin'] == 0)) ) {
			echo '<div><font color=red><b>Вы не можете поменять звание этому персонажу</b></font></div>';
		}else{
			$sx = '';
			if($u->info['sex']==1)
			{
				$sx = 'а';
			}
			if( $a == 1 ) {
				$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; поменял'.$sx.' звание паладина ('.$uu['align'].') на &quot;'.htmlspecialchars($_POST['textLD52015']).'&quot;.';
			}elseif( $a == 3 ) {
				$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; поменял'.$sx.' звание тармана ('.$uu['align'].') на &quot;'.htmlspecialchars($_POST['textLD52015']).'&quot;.';	
			}
			mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".mysql_real_escape_string($rtxt)."','".$u->info['login']."',0)");
			echo '<div><font color=red><b>Вы успешно поменяли звание персонажу!</b></font></div>';	
			mysql_query('UPDATE `users` SET `mod_zvanie` = "'.mysql_real_escape_string($_POST['textLD52015']).'" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
		}
	  }
	?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Изменить звание <? if( $a == 1 ) { echo 'паладина'; }elseif( $a == 3 ) { echo 'тармана'; } ?></h4>  
  Введите логин  <input name="loginLD52015" type="text" id="loginLD52015" size="30" maxlength="30" /> Новое звание <input name="textLD52015" type="text" id="textLD52015" size="70" maxlength="30" /> <input type="submit" name="pometka52015" id="pometka52015"  value="Сохранить" />
  </div>
<?
  }
  if($p['newuidinv']==1)
  {	
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Проверка вещей персонажа</h4>
  Логин
  <input name="newuidinv" type="text" id="newuidinv" size="30" maxlength="30" / value="<? echo (isset($_POST['newuidinv']) ? $_POST['newuidinv'] : $u->info['login']);?>">
  <input type="submit" name="pometka52017" id="pometka52017"  value="Проверить" />
  </div>
  <?  
  }
  if($p['testchat']==1 || $u->info['admin']>0)
  {	
      //if($u->info['admin']>0)
      //{
  ?>
  	    <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
    	<h4>Посмотреть сообщения чата</h4>
		Таблица
        <select name="table152017">
			<?
			echo '<option value="1" '.($_POST['table152017']==1 ? ' selected' : '').'>История</option>';
            echo '<option value="2" '.($_POST['table152017']==2 ? ' selected' : '').'>Чат</option>';
			?>
    	</select>
    	Дата
  	     <input name="date52017" type="text" id="date52017" size="12" maxlength="30" value="<? echo ($_POST['date52017'] ? $_POST['date52017'] : date('d.m.Y', time())); ?>"/>
        Время:
		<select name="time152017">
			<?
			if(!isset($_POST['time152017'])) $_POST['time152017'] = 0;
			for($n=0; $n<=24; $n++) echo '<option value="'.$n.'" '.($_POST['time152017']==$n ? ' selected' : '').'>'.$n.'</option>';
			?>
    	</select>
		-
        <select name="time252017">
			<?
            if(!isset($_POST['time252017'])) $_POST['time252017'] = 24;
			for($n=0; $n<=24; $n++) echo '<option value="'.$n.'" '.($_POST['time252017']==$n ? ' selected' : '').'>'.$n.'</option>';
			?>
    	</select>
		Тип:
		<select name="type52017">
			<option value="0" <? if($_POST['type52017']==0) echo ' selected';?>>Все</option>
            <option value="1" <? if($_POST['type52017']==1) echo ' selected';?>>Общие</option>
            <option value="2" <? if($_POST['type52017']==2) echo ' selected';?>>Не общие</option>
            <option value="3" <? if($_POST['type52017']==3) echo ' selected';?>>Переписки</option>
    	</select>
		Логин(необяз.):
  	     <input name="login52017" type="text" id="login52017" size="20" maxlength="30" value="<? echo $_POST['login52017']; ?>"/>
         Текст(необяз.): <input name="text52017" type="text" id="text52017" size="50" value="<? echo $_POST['text52017']; ?>" />
         <input name="ch52017" type="checkbox" id="ch52017" /> ID
  	     <input type="submit" name="see_chat" id="see_chat" value="Показать" />
    	</div>
  <?
    	  if(isset($_POST['see_chat']))
    	  {
			  if($_POST['time152017']<10) $_POST['time152017'] = '0'.$_POST['time152017'];
              if($_POST['time252017']<10) $_POST['time252017'] = '0'.$_POST['time252017'];

			  $chsee1 = strtotime($_POST['date52017'].' '.$_POST['time152017'].':00:00');
              $chsee2 = strtotime($_POST['date52017'].' '.$_POST['time252017'].':00:00');
			  $ch_table =  ($_POST['table152017']==2 ? 'chat' : 'chat_history');

              $qq = '';
			  if($_POST['login52017']) $qq .= ' AND (`login` LIKE "%'.$_POST['login52017'].'%" OR `to` LIKE "%'.$_POST['login52017'].'%")';
    		  if($_POST['text52017'])  $qq .= ' AND `text` LIKE "%' . mysql_real_escape_string($_POST['text52017']) . '%"';

			  if($_POST['type52017']==1)     $qq .= ' AND `login` = "" AND `to` = ""';
			  elseif($_POST['type52017']==2) $qq .= ' AND (`login` != "" OR `to` != "")';
			  elseif($_POST['type52017']==3) $qq .= ' AND `login` != "" AND `to` != ""';

    		  $sp = mysql_query('SELECT * FROM `'.$ch_table.'` WHERE `to` NOT LIKE "%Багнутый%" AND `login` NOT LIKE "%Багнутый%"
			  AND `time`>"'.$chsee1.'" AND `time`<"'.$chsee2.'"'.$qq.' ORDER BY `time`');

			  echo '<table border=0 width="100%">';
			  while( $pl = mysql_fetch_array($sp))
    		  {
                 $pl['type'] = ($pl['type'] == 3 ? '<font color=red><b>private</b></font>' : 'to');
    			 echo  '<tr><td style="width: 125px;"><span class=date2>'.date('d.m.Y H:i:s',$pl['time']).'</span> </td><td>';
				 if($_POST['ch52017']) echo '[id:'.$pl['id'].'] ';
    			 if($pl['login']) echo '[<b>'.$pl['login'].'</b>] ';
    			 if($pl['login'] && $pl['to']) echo $pl['type'].' ';
    			 if($pl['to']) echo '[<b>'.$pl['to'].'</b>] ';
                 if(!$pl['login'] && !$pl['to']) echo '[<font color=red>Общее</font>] ';
    			 echo '<font color="'.$pl['color'].'">'.$pl['text'].'</font></td></tr>';
    		  }
              echo '</table>';
    	  }
      //}
  }
  
  if($p['telegraf']==1) {
	  if(isset($_POST['pometka5'])) {
		 $tous = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['loginLD5']).'" LIMIT 1')); 
		 if(isset($tous['id'])) {
			 if($u->info['align'] > 1 && $u->info['align'] < 2) {
				 $zvnt = 'Паладин <b>'.$mod_login.'</b> сообщает';
				 $zvno = 'Паладинский орден';
			 }elseif($u->info['align'] > 3 && $u->info['align'] < 4) {
				 $zvnt = 'Тарман <b>'.$mod_login.'</b> сообщает';
				 $zvno = 'Армада Тьмы';
			 }elseif($u->info['admin'] > 0) {
				 $zvnt = 'Администрация сообщает';
				 $zvno = 'Администрация';
			 }else{
				 $zvnt = 'Администрация сообщает.';
				 $zvno = 'Администрация';
			 }
			 mysql_query('INSERT INTO `telegram` (`uid`,`from`,`tema`,`text`,`time`) VALUES ("'.$tous['id'].'","<b><font color=red>'.$zvno.'</font></b>","'.$zvnt.'","'.mysql_real_escape_string(htmlspecialchars($_POST['textLD5'],NULL,'cp1251')).'","'.time().'")');
		 	 echo '<font color="red"><b>Сообщение успешно отправлено</b></font>';
		 }else{
			 echo '<font color="red"><b>Персонаж не найден...</b></font>';
		 }
	  }
  ?>
  <!--div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Отправить телеграф</h4>  
  Введите логин  <input name="loginLD5" type="text" id="loginLD5" size="30" maxlength="30" /> Сообщение <input name="textLD5" type="text" id="textLD5" size="70" maxlength="1000" /> <input type="submit" name="pometka5" id="pometka5"  value="Написать" />
  </div-->
  <?  
  }
  
  if($u->info['admin'] > 0)///((($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4)) && $u->info['align']!=1.1 && $u->info['align']!=1.5) ||
  {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Просмотр списка невидимок</h4>  
  <?
	if(isset($_POST['pometka587'])) {
		$sp = mysql_query('SELECT `id`,`login` FROM `users` WHERE `invis` = 1 OR `invis` > "'.time().'"');
		$html = '';
		while( $pl = mysql_fetch_array($sp) ) {
			$html .=  $u->microLogin($pl['id'],1) . ' -> <b>'.$pl['login'].'</b> (id '.$pl['id'].')<br>';
		}
		if($html == '') {
			$html = '<b style="color:red">Нет персонажей-невидимок</b>';
		}
		echo $html.'<br>';
	}
  ?>
  <input type="submit" name="pometka587" id="pometka587"  value="Показать список невидимок" />
  </div>
  <?  
  }
  
  if($p['telegraf']==1) {
		if($u->info['align'] > 1 && $u->info['align'] < 2  && $u->info['admin'] == 0) {
			$zvnt = 'Паладин <b>'.$mod_login.'</b> сообщает:';
			$zvno = 'Паладинский орден';
		}elseif($u->info['align'] > 3 && $u->info['align'] < 4  && $u->info['admin'] == 0) {
			$zvnt = 'Тарман <b>'.$mod_login.'</b> сообщает:';
			$zvno = 'Армада Тьмы';
		}elseif($u->info['admin'] > 0) {
			$zvnt = 'Администратор сообщает:';
			$zvno = 'Администрация';
		}else{
			$zvnt = 'Администрация сообщает:';
			$zvno = 'Администрация';
		}
	  if(isset($_POST['pometka577']))
	  {
		//if(md5($_POST['edit_pass'] == $c['edit_pass']))
		//{
		 //$tous = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['loginLD5']).'" LIMIT 1')); 
		// if(isset($tous['id'])) {
			// mysql_query('INSERT INTO `telegram` (`uid`,`from`,`tema`,`text`,`time`) VALUES ("'.$tous['id'].'","<b><font color=red>'.$zvno.'</font></b>","'.$zvnt.'","'.mysql_real_escape_string(htmlspecialchars($_POST['textLD5'],NULL,'cp1251')).'","'.time().'")');
                $tlogin = '';
				$tinvis = $u->info['invis'];
				if(isset($_POST['hbld577']))
				{
		 			if($_POST['hbld577']==1) $_POST['textLD577'] = ''.$zvnt.' '.$_POST['textLD577'];
					else { $_POST['textLD577'] = $_POST['textLD577']; $tlogin = ($_POST['hbld577']==2 ? 'Справедливость' : 'Повелитель Багов'); $tinvis = 0;}
				} else $_POST['textLD577'] = '<font color=red><b>'.$zvno.'</b><font> сообщает: '.$_POST['textLD577'];

				mysql_query('INSERT INTO `chat` (`invis`,`da`,`delete`,`molch`,`new`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,`sound`,`global`) VALUES (
				"'.$tinvis.'",
				"1",
				"0",
				"0",
				"1",
				"'.$tlogin.'",
				"",
				"'.$u->info['city'].'",
				"0",
				"'.time().'",
				"0",
				"0",
				"'.mysql_real_escape_string($_POST['textLD577']).'",
				"0",
				"red",
				"0",
				"0",
				"0")');
			 echo '<font color="red"><b>Сообщение успешно отправлено</b></font>';
		 //}else{
		 //	 echo '<font color="red"><b>Персонаж не найден...</b></font>';
		 //}
		 //} else echo '<font color="red"><b>Неверный пароль редактирования.</b></font>';
	  }
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Мегафон</h4>  
  Сообщение <input style="width: 60%;" name="textLD577" type="text" id="textLD577" size="70" maxlength="1000" />
  <input type="submit" name="pometka577" id="pometka577"  value="Написать" />
  <br />
  <?
  if($u->info['admin'] > 0) {?>
  <input name="hbld577" type="checkbox" id="hbld577" value="2" /> Отправить от <b>Справедливость</b>
  <input name="hbld577" type="checkbox" id="hbld577" value="3" /> Отправить от <b>Повелитель Багов</b>
  <? }?>
  </div>

	<?
	if($u->info['admin'] > 0)
	{
	    if(isset($_POST['popup_update']))
		{
			$len_popup_text = strlen($_POST['popup_text']);
			if($len_popup_text < 800)
			{
				$result = mysql_query('UPDATE `quests` SET `info` = "'.mysql_real_escape_string($_POST['popup_text']).'" WHERE `id` = "1" LIMIT 1');
				echo '<font color="red"><b>Сообщение обновлено</b></font>';

				if($_POST['popup_reset'])
				{
					echo '<font color="red"><b>, флаг "прочитано" сброшен у всех игроков</b></font>';
	                mysql_query('UPDATE `users` SET `fnq` = "1" WHERE `online` > "'.(time()-86400*45).'" AND `no_ip` != "trupojor"
					AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 AND `pass` != "saintlucia"');
				}

	            if($_POST['popup_reset_admin'])
				{
					echo '<font color="red"><b>, флаг "прочитано" сброшен у админов</b></font>';
	                mysql_query('UPDATE `users` SET `fnq` = "1" WHERE `admin` > "0"');
				}
			} else echo '<font color="red"><b>Длина сообщения не более 800 знаков, вы ввели '.$len_popup_text.' знаков</b></font>';
		}
	   $new_info = mysql_fetch_array(mysql_query('SELECT `info` FROM `quests` WHERE `id` = "1" LIMIT 1'));
       $info_count = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `fnq` = "0"  AND `online` > "'.(time()-86400*45).'"
	   AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 AND `pass` != "saintlucia"  LIMIT 1'));
       $info_count2 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > "'.(time()-86400*45).'"
	   AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 AND `pass` != "saintlucia"  LIMIT 1'));
	   ?>
		<div style="padding:10px; margin:5px; border-bottom:1px solid #cac9c7;">
		  <h4>Всплывающее оповещение (прочитали: <?=$info_count[0];?> из <?=$info_count2[0];?>)</h4>
		  <textarea style="width: 70%;" name=popup_text rows=6 cols=100><?=$new_info['info'];?></textarea>
		  <br><input name=popup_reset type=checkbox> Сбросить флаг "прочитано" всем (увидят при входе в игру все, входившие за последние 45 дней)
          <br><input name=popup_reset_admin type=checkbox> Сбросить флаг "прочитано" админам (увидят при входе в игру только админы)
		  <p><input  name="popup_update" type=submit value=Сохранить></p>
	 	</div>
	  <?
  }
  }
  
  if($p['seeld']==1) {
  $pld520 = date('d.m.Y');
  if( isset($_POST['loginLD520']) ) {
	  $pld520 = $_POST['loginLD520'];
  }
  $pld520TS = strtotime(str_replace(".", "-", $pld520));
  $pld520 = date('d.m.Y',$pld520TS);
  if($u->info['align']!=1.1 && $u->info['align']!=1.5)
  {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Регистрации персонажей</h4>  
  Дата регистрации  
  <input name="pometka520"  onclick="document.getElementById('loginLD520').value='<?=date('d.m.Y',($pld520TS-86400))?>';" type="submit" value="&laquo;" />
  <input value="<?=$pld520?>" name="loginLD520" type="text" id="loginLD520" size="20" maxlength="10" /> 
  <input name="pometka520"  onclick="document.getElementById('loginLD520').value='<?=date('d.m.Y',($pld520TS+86400))?>';" type="submit" value="&raquo;" />
  <input type="submit" name="pometka520" id="pometka520"  value="Показать" />
  <?
  if( isset($_POST['pometka520'])) {
	  $sp = mysql_query('SELECT `users`.`id`,`users`.`host_reg`,`users`.`banned`,`users`.`battle`,`users`.`online`,`users`.`molch1`,`users`.`bithday` FROM `users` LEFT JOIN `stats` ON `stats`.`id` = `users`.`id` WHERE `users`.`bithday` != "01.01.1800" AND `stats`.`bot` = 0 AND `users`.`timereg` >= '.$pld520TS.' AND `users`.`timereg` < '.($pld520TS+86400).' ORDER BY `users`.`id` ASC');
	  $i = 1;
	  echo '<br><b><font color=red>Персонажи зарегистрированные '.$pld520.'</font></b>';
	  while( $pl = mysql_fetch_array($sp) ) {
		 $urt5202 = '<br>'.$i.'. '.$u->microLogin($pl['id'],1).''; 
		 
		 if( $pl['banned'] > 0 ) {
			 $urt5202 = '<font color=red>'.$urt5202.'</font>';
		 }elseif( $pl['online'] > time()-520 ) {
			 $urt5202 = '<font color=green>'.$urt5202.'</font>';
		 }
		 if( $pl['molch1'] > time() ) {
			 $urt5202 .= ' <img title="На персонаже молчанка" src=//img.testcombats.ru/i/sleep2.gif width=24 height=15>';
		 }
		 if( $pl['battle'] > 0 ) {
			 $urt5202 .= ' <a href="/logs.php?log='.$pl['battle'].'" target="_blank"><img src=//img.testcombats.ru/i/fighttype0.gif title="Персонаж в поединке"></a>';
		 }
		 if( $pl['host_reg'] > 0 ) {
			 $urt5202 .= ' &nbsp; <small>(Реферал персонажа '.$u->microLogin($pl['host_reg'],1).')</small>';
		 }
		 $urt520 .= $urt5202;
		 $i++;
	  }
	  echo $urt520;
	  unset($urt520,$i,$pl,$sp);
  }
  ?>
  </div>
  <?
  if($u->info['align']!=1.7 && $u->info['align']!=3.07 && $u->info['align']!=1.75 && $u->info['align']!=3.075) {?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Авторизации с ip-адреса (последние 100)</h4>  
  Введите ip-адрес  <input name="loginLD52" type="text" id="loginLD52" size="30" maxlength="30" /> <input type="submit" name="pometka52" id="pometka52"  value="Показать" />
  <input type="submit" name="pometka53" id="pometka53"  value="Показать (неудачные)" />
  </div>
  <?
	  if(isset($_POST['pometka52']) || isset($_POST['pometka53'])) {
		 if(isset($_POST['pometka53'])) {
		 	$sp = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD52']).'" AND `type` = "3" ORDER BY `id` DESC LIMIT 100'); 		 
		 }else{
		 	$sp = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD52']).'" ORDER BY `id` DESC LIMIT 100'); 
		 }
		 $i = 1;
		 $r = '';
		 $ursz = array();
		 while($pl = mysql_fetch_array($sp)) {
			$tst = mysql_fetch_array(mysql_query('SELECT `id`,`admin`,`no_ip` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
			if(isset($tst['id']) && $tst['admin'] == 0 && ($tst['no_ip'] == '' && $tst['no_ip'] == 0)) {
				 if(!isset($ursz[$pl['uid']])) {
					$ursz[$pl['uid']] = $u->microLogin($pl['uid'],1); 
				 }
				 $r .= '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">';
				 $r .= '<span style="display:inline-block;width:30px">'.$i.'.</span> <span style="display:inline-block;width:250px">'.$ursz[$pl['uid']].'</span>';
				 if($pl['type']==3) {
					 $r .= '<span style="display:inline-block;width:100px;color:red;">неудачно</span>';
				 }else{
					 $r .= '<span style="display:inline-block;width:100px;color:green;">успешно</span>';
				 }
				 $r .= ' &nbsp; '.date('d.m.Y H:i',$pl['time']).'';
				 
				 $r .= '</div>';
				 $i++;
			}
		 }
		 
		 echo '&nbsp;&nbsp; <font color="red">Список последних 100 авторизаций с ip-адресом:<b>'.$_POST['loginLD51'].'</b></font><br>';
		 if($r == '') {
			 if(isset($_POST['pometka53'])) {
			 	echo '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">Авторизации с данным ip-адресом не найдены (неудачные)</div>';
			 }else{
				echo '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">Авторизации с данным ip-адресом не найдены</div>'; 
			 }
		 }else{
			 echo $r;
		 }	 
		 unset($r);
	  }
	}
  }
  }
  
  if($u->info['admin'] > 0 || $u->info['align'] == 3.99 || $u->info['align'] == 1.99)
  {
	$dsee = array();
	if(!isset($_POST['smod1'])) {
		$_POST['smod1'] = date('d.m.Y');
	}
	$dsee['date'] = explode('.',$_POST['smod1']);
	$dsee['date'] = $dsee['date'][2].'-'.$dsee['date'][1].'-'.$dsee['date'][0];
	$dsee['t1'] = strtotime($dsee['date'].' 00:00:00');
	$dsee['t2'] = strtotime($dsee['date'].' 23:59:59');
	$dsee['date'] = date('d.m.Y',$dsee['t1']);	  
	?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Показать лог действий модераторов</h4>
  
  Показать действия за <input name="smod1" type="text" id="smod1" value="<?=$_POST['smod1']?>" size="11" maxlength="10" />
  Логин модератора <input name="smod2" type="text" id="smod2" value="<?=$_POST['smod2']?>" size="30" maxlength="30" />
  <input type="submit" name="delosee3" id="delosee3"  value="Поиск" />
  </div>
  <?
	  if(isset($_POST['delosee3']))
	  {
		  $sp = mysql_query('SELECT * FROM `users_delo` WHERE `login` = "'.mysql_real_escape_string($_POST['smod2']).'" AND `time` >= '.$dsee['t1'].' AND `time` <= '.$dsee['t2'].'');
		  $rdl = '';
		  while($pl = mysql_fetch_array($sp)) {
			 $rdl .= '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">'; 
			 $rdl .= '<div style="display:inline-block;width:150px;color:green">'.date('d.m.Y H:i:s',$pl['time']).'</div>';
			 $rdl .= $pl['text'].' персонажу '.$u->microLogin($pl['uid'],1);
			 $rdl .= '</div>';
		  }
		  if($rdl == '') {
			 $rdl = 'Модератор не совершал действий за данное число'; 
		  }
		  echo $rdl;
	  }
  } 
}
	//показываем панель модератора
	}else{
		echo $merror.'<form action="main.php?'.$zv.'&enter='.$code.'" method="post"><center><br><br><br>Для входа в панель требуется пароль<hr>Введите пароль: <input value="" name="psw" type="password"><input type="submit" value="ок" /><br><small style="color:grey;">Если Вы не угадаете пароль больше трех раз<br>доступ в панель будет заблокирован на сутки.</small></form>';
	}
}
if(isset($realUser['align']))
{
    $u->info['align'] = $align_temp;
}

?>