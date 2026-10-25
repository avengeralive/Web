<?
if(!defined('GAME'))die();
$orders_max = 50;
$err = '';
$id_bank = 12493728;
?>

<table align=right>
	<tr>
		<td>
			<INPUT TYPE="button" onclick="location.href='main.php?bukmeker=1';" value="Обновить" title="Обновить">
			<INPUT TYPE="button" onclick="location.href='main.php';" value="Вернуться" title="Вернуться">
		</td>
	</tr>
</table>
<center><h4><i>Добро пожаловать в панель Радио Combats, <?=$u->info['login']?>!</h4></i></center>

<div class="divTableCell" style="width:40%" >
	
<?
$status = mysql_fetch_array(mysql_query('SELECT `delete` FROM `dj_orders` WHERE `id` = "1" LIMIT 1'));
$last = mysql_fetch_array(mysql_query('SELECT `time` FROM `dj_orders` WHERE `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));

if($u->info['bukmeker']==1 || $u->info['admin']==1 || $u->info['id']==$id_bank)
{
	echo "<FIELDSET>";
	echo "<LEGEND><h3>Сообщение в чат:</h3> </LEGEND>";

    if (isset($_POST['systemM']) && trim($_POST['sysMes'])!='')
	{
        $_POST['sysMes'] = strip_tags($_POST['sysMes']);
        $_POST['sysMes'] = htmlspecialchars($_POST['sysMes']);

		if($u->info['id']==$id_bank) $r .='<font color=black ><b>'.$u->info['login'].':</b></font> <font color=darkred><i>  '.$_POST['sysMes'].'</i></font>';
        else $r .='<font color=black ><b>DJ-Combats:</b></font> <img src=//testcombats.ru/res/img/medals/radio.gif width=24 height=17 /> <font color=red> <b>'.$u->info['login'].'</b></font> <font color=darkred><i>  '.$_POST['sysMes'].'</i></font>';

		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
		VALUES ('1','capitalcity','','','','".mysql_real_escape_string($r)."','".time()."','6','0')");

        echo "<br><font color=red><b>Системное сообщение отправленно</b></font>";
    }
	elseif (isset($_GET['table']) && ($_GET['table']==1 || $_GET['table']==0))
	{
        mysql_query('UPDATE `dj_orders` SET `delete` = "'.intval($_GET['table']).'" WHERE `id`="1" LIMIT 1');
        $status['delete'] = $_GET['table'];
    }
    elseif (isset($_GET['delete']) && $_GET['delete'] != 1)
	{
        if($_GET['delete'] > 0) mysql_query('UPDATE `dj_orders` SET `delete` = "'.time().'" WHERE `id`="'.mysql_real_escape_string($_GET['delete']).'" LIMIT 1');
		else mysql_query('UPDATE `dj_orders` SET `delete` = "'.time().'" WHERE `id`>"1"');
    }

	$form_text = ($u->info['id']==$id_bank ? 'Текст сообщения от '.$u->info['login'] : 'Текст сообщения от Диджея');
    echo "<form action='#' method='POST'>";
    echo "	<input type='text' class='inps' name='sysMes' size='100'  placeholder='".$form_text."'>";
    echo " 	<input type='submit' name='systemM' style=\"border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;\" value='Отправить'>";
    echo "</form>";

	echo "</FIELDSET></br>";
}

if (isset($_POST['OrderDJ']) && trim($_POST['OrderName'])!='' && trim($_POST['OrderAvtor'])!='' && $last['time'] < (time()-900))
{
    $_POST['OrderName'] = strip_tags(trim($_POST['OrderName']));
    $_POST['OrderName'] = htmlspecialchars($_POST['OrderName']);

	$_POST['OrderAvtor'] = strip_tags(trim($_POST['OrderAvtor']));
    $_POST['OrderAvtor'] = htmlspecialchars($_POST['OrderAvtor']);

	mysql_query("INSERT INTO `dj_orders` (`uid`,`title`,`avtor`,`time`)
	VALUES ('".$u->info['id']."','".mysql_real_escape_string($_POST['OrderName'])."','".mysql_real_escape_string($_POST['OrderAvtor'])."','".time()."')");

    $err = "<br><font color=red><b>Ваш заказ успешно добавлен</b></font>";
}

echo "<FIELDSET>";
echo '<LEGEND><h3>Стол заказов:</h3> </LEGEND>';
if($err) echo $err.'<br>';

if($u->info['bukmeker']==1 || $u->info['admin']==1)
{
	echo "Статус: ".($status['delete'] ? '<font color=green>Включен' : '<font color=red>Выключен').'</font>';
	echo '&nbsp;['.($status['delete'] ? '<a href="?bukmeker=1&table=0">выкл' : '<a href="?bukmeker=1&table=1">вкл').'</a>]';

	echo '<div style="float:right"><INPUT TYPE="button" onclick="location.href=\'main.php?bukmeker=1&delete=0\';" value="Очистить"></div>';
}

echo '<br><br><b>Заказы:</b>';

$i = 1;
$sp = mysql_query('SELECT * FROM `dj_orders` WHERE `id` > "1" ORDER BY `id` ASC');
while( $pl = mysql_fetch_array($sp) )
{
	if(!$pl['delete'] || ($pl['delete'] && $u->info['admin']==1))
	{
		echo '<br>'.$i.'. <b>'.$pl['title'].'</b> (<i>'.$pl['avtor'].'</i>) - '.$u->microLogin($pl['uid'],1).' '.date('d-m-Y H:s', $pl['time']);

        if($u->info['bukmeker']==1 || $u->info['admin']==1) echo '&nbsp;'.($pl['delete'] ? '[<font color=red>удален</font>]' : '[<a href="?bukmeker=1&delete='.$pl['id'].'">уд-ть</a>]');

		$i++;
	}
}

$orders = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `dj_orders` WHERE `id` > "1" LIMIT 1'));

echo '<br><br><h4>Добавить заказ:</h4>';

if($status['delete']==1 && $orders[0] < $orders_max && $last['time'] < (time()-900) && $u->info['level'] > 7)
{
    echo "<br><form action='#' method='POST'>";
    echo "<input type='text' class='inps' name='OrderName' size='100'  placeholder='Название композиции'>";
    echo "<p><input type='text' class='inps' name='OrderAvtor' size='100'  placeholder='Исполнитель'></p>";
    echo " <input type='submit' name='OrderDJ' class='btn btn-inverse' value='Отправить'>";
    echo "</form>";
}
elseif($status['delete']==0) echo '<font color=red>Стол заказов сейчас выключен.</font>';
elseif($orders[0] >= $orders_max) echo '<font color=red>Стол заказов уже заполнен.</font>';
elseif($u->info['level'] < 8) echo '<font color=red>Стол заказов доступен с 8 уровня.</font>';
else echo '<font color=red>Вы уже сделали заказ.</font>';

echo "</FIELDSET></br>";
?>
</div>