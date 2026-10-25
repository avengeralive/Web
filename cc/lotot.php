<?php
if(!defined('GAME')) {die();}

$item_need = 50;//Сколько надо предметов для покупки
$item_id = 8531;//ID предмета

if($u->room['file']=='cc/lotot')
{
	$loto = mysql_fetch_array(mysql_query('SELECT * FROM `loto_info` WHERE `time_start` <= "'.time().'"
	AND (`time_finish` > '.time().' OR `finished` = 0) LIMIT 1'));

	if( isset($loto['id']) && $loto['time_finish'] < time() && $loto['finished'] == 0 )
	{
		//Завершаем розыгрыш
		$loto['finished'] = 1;
		mysql_query('UPDATE `loto_info` SET `finished` = "1" WHERE `id` = "'.$loto['id'].'" LIMIT 1');

		$tickets = array();
		$sp = mysql_query('SELECT `id` FROM `items_users` WHERE `item_id`="4539" AND `data` LIKE "%Тираж №'.$loto['id'].', Билет%"');
        while( $pl = mysql_fetch_array($sp) ) {$tickets[] = $pl['id'];}

        $tickets_num = count($tickets);
        $tickets_sold = $tickets_num;
		$tickets = $tickets + array_fill($tickets_num, ($loto['tiraj']-$tickets_num), 0);
        $tickets_num = count($tickets);

		$sp = mysql_query('SELECT * FROM `loto_itm` WHERE `lid` = "'.$loto['id'].'"');
		while( $pl = mysql_fetch_array($sp) )
		{
			$i = 0;
			while( $i < $pl['colvo'] )
			{
				$win = rand(0, $tickets_num-1);
				$winner = $tickets[$win];
                $t_num = array (1=>0);
				
				if($winner != 0)
				{
					$uwin = mysql_fetch_array(mysql_query('SELECT `id`,`uid`,`data` FROM `items_users` WHERE `id`="'.$winner.'" LIMIT 1'));
					if(isset($uwin['id']))
					{
						preg_match('/Билет №([0-9]+)/', $uwin['data'], $t_num);

						mysql_query('INSERT INTO `loto_win` (`lid`,`priz`,`uid`,`time`,`bilet`) VALUES (
						"'.$loto['id'].'","'.$pl['id'].'","'.$uwin['uid'].'","'.time().'","'.$t_num[1].'") ');

                        $uad = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city` FROM `users` WHERE `id` = "'.$uwin['uid'].'" LIMIT 1'));
       					if( isset($uad['id']))
						{
                            $u->addItem($pl['item_id'], $uwin['uid'], null, null, null, null, null, 1);

							mysql_query('INSERT INTO `users_delo` (`onlyAdmin`,`hb`,`uid`,`time`,`city`,`text`,`login`,`ip`)
							VALUES ("1","0","'.$uad['id'].'","'.time().'","'.$uad['city'].'",
							" &quot;'.$uad['login'].'&quot; <font color=red>выиграл предмет</font>: <b>&quot;'.$pl['text'].' ('.$pl['item_id'].')&quot;</b> в лотерию <b>&quot;'.$loto['name'].'&quot;</b> №'.$loto['id'].'. Билет №'.$t_num[1].'.","AddItems.capitalcity","0")');

							//pr('Победитель: Билет №'.$t_num[1].'<br>Приз: '.$pl['text'].'<hr>');
						}
					}
				}

				unset($tickets[$win]);
                $tickets = array_values($tickets);
                $tickets_num -= 1;
				$i++;
			}
		}

		//Удаляем билеты розыгрыша
        mysql_query('DELETE FROM `items_users` WHERE `item_id`="4539" AND `data` LIKE "%Тираж №'.$loto['id'].'%" LIMIT '.$tickets_sold);

		//Пишем в чат
		$text = '<font color=red>Внимание!&nbsp;Розыгрыш '.$loto['name'].' тираж №'.$loto['id'].' завершен.</font>';
		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`)
		VALUES (1,'capitalcity',0,'','','".$text."','".time()."','6','0','1')");

		//Добавляем новый розыгрыш
		$loto_finish = $loto['time_finish']+86400*14;

		mysql_query('INSERT INTO `loto_info` (`name`,`time_start`,`time_finish`,`price`,`tiraj`,`buy`,`finished`)
		VALUES ("'.$loto['name'].'","'.$loto['time_finish'].'","'.$loto_finish.'","'.$loto['price'].'", "'.$loto['tiraj'].'","0","0")');

		$loto_id = mysql_insert_id();

		mysql_query('UPDATE `loto_itm` SET `lid` ="'.$loto_id.'" WHERE `lid` =  "'.$loto['id'].'"');

		$text = '<font color=red>Внимание!&nbsp;Запущен новый розыгрыш: '.$loto['name'].' тираж №'.$loto_id.'. Завершение розыгрыша: '.date('d.m.Y H:i', $loto_finish).'.</font>';
		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`)
		VALUES (1,'capitalcity',0,'','','".$text."','".time()."','6','0','1')");

        $loto = mysql_fetch_array(mysql_query('SELECT * FROM `loto_info` WHERE `id` = "'.$loto_id.'" LIMIT 1'));

	}
	//
	if( isset($_GET['buyloto']) && isset($loto['id']) && $loto['finished'] == 0 )
 	{
		$items = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "'.$item_id.'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));

		if( $items[0] < $item_need )
		{
			$error = 'У вас в наличии черепов: '.$items[0].' шт. Нужно: '.$item_need.' шт.';
		}
		elseif( $loto['buy'] >= $loto['tiraj'] ) {
			$error = 'Билетов больше нет.';
		}elseif( $loto['price'] > $u->info['money'] ) {
			$error = 'У вас недостаточно кредитов';
		}else{
			$error = 'Вы успешно приобрели лотерейный билет №'.($loto['buy']+1).', тираж №'.$loto['id'].'.';
			$u->addItem(4539,$u->info['id'],'|info=Лотерея &quot;'.$loto['name'].'&quot;<br>Тираж №'.$loto['id'].', Билет №'.($loto['buy']+1).'<br><b>Розыгрыш завершится '.date('d.m.Y H:i',$loto['time_finish']).'</b>');
			$u->info['money'] -= $loto['price'];
			mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			//
			$loto['buy']++;
			mysql_query('UPDATE `loto_info` SET `buy` = `buy` + 1 WHERE `id` = "'.$loto['id'].'" LIMIT 1');
            mysql_query('DELETE FROM `items_users` WHERE `item_id` = "'.$item_id.'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$item_need);
		}
	}
	//
	if( $loto['finished'] == 1 ) {unset( $loto );}
?><style>
.tab {
  overflow: hidden;

}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
  border-radius: 15px 15px 0px 0px;
    border: 1px solid #ccc;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 15px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  border-top: none;
  display: none;
  padding: 6px 12px;
  background-color: #ccc;
  border-radius: 0px 0px 15px 15px;

}</style>
<script>
function openTab(evt, tabName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<p align="left"><?php echo '<b style="color:red">'.$error.'</b>'; ?></p>
<div class="tab">
<button class="tablinks active" onclick="openTab(event, 'newloto')"><b>Текущая лотерея</b></button>
   <button class="tablinks" onclick="openTab(event, 'currentloto')"><b>Призы в текущем розыгрыше</b></button>
	<button class="tablinks" onclick="openTab(event, 'usersloto')"><b>Участники текущего розыгрыша </b></button>
     <button class="tablinks" onclick="openTab(event, 'lastloto')"><b>Победители прошлого розыгрыша</b></button>
	 	 <div style="float: right;">
        	<input style="margin-top: 8px;" class="btn btn-inverse" type="button" value="Вернуться" onClick="location='main.php?loc=1.180.0.9&rnd=<? echo $code; ?>';"/>
		</div>
	<div id="textgo" style="visibility:hidden;"></div>	 
</div>
<div id="newloto" class="tabcontent" style="display: block;">
            <? if(!isset($loto['id'])) { ?>Розыгрышей нет<? }else{ ?>
            <center><h3><? echo $loto['name'].' #'.$loto['id']; ?></h3></center>
            <div style="padding:20px;">
			<?
				$items = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "'.$item_id.'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
			?>
            Начало розыгрыша: <span class="date"><?=date('d.m.Y H:i',$loto['time_start'])?></span><br />
            Завершение розыгрыша: <span class="date"><?=date('d.m.Y H:i',$loto['time_finish'])?></span><br />
            Куплено билетов: <?=$loto['buy']?> из <b><?=$loto['tiraj']?></b><br />
            Стоимость билета: <b><?=$loto['price']?>.00 кр. и 50 черепов</b><br />
            <br />
			У вас в наличии: <b ><?php echo round($u->info['money'],2); ?> кр.</b> &nbsp;</br>
			У вас в наличии черепов: <b style="color:#ff0000;"><?=$items[0];?></b> шт.
            <br />
            <? if( $loto['finished'] == 0 ) { ?>
            <center><input onclick="location.href='main.php?buyloto=1'" type="button" class="btn btn-inverse" value="Купить лотерейный билет" /><? } ?></center><br />
            <small>(Один игрок может купить несколько билетов)</small><hr />
			<?}?>
</div></div>
<div id="currentloto" class="tabcontent">
            <?php
            if(isset($loto['id']))
			{
				echo '<center><h3>Призы в текущем розыгрыше<h3></center>';

				$sp = mysql_query('SELECT * FROM `loto_itm` WHERE `lid` = "'.$loto['id'].'"');
				while( $pl = mysql_fetch_array($sp) )
				{
					$itm = mysql_fetch_array(mysql_query('SELECT `img` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
					echo '<img style="max-width: 40px;" src="https://img.testcombats.ru/i/items/'.$itm['img'].'">&nbsp;'.$pl['text'].', <b>Количество: '.$pl['colvo'].'</b><hr>';
				}
			} else {echo 'Розыгрышей нет';}
			?>
</div>
<div id="usersloto" class="tabcontent">
            <?
			if(isset($loto['id']))
			{
				$usrs = array();
				$bilets = array();
				$sp = mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `item_id` = "4539" AND `data` LIKE "%Тираж №'.$loto['id'].'%" AND `delete`="0"');
				while( $pl = mysql_fetch_array($sp) )
				{
					if(!isset($bilets[$pl['uid']]))
					{
						$usrs[] = $pl['uid'];
						$bilets[$pl['uid']] = 0;
					}
					$bilets[$pl['uid']]++;
				}
				echo '<center><h3>Участники текущего розыгрыша ('.count($usrs).')</h3></center>';
				$i = 0;
				function declOfNum($number, $titles)
				{
					$cases = array (2, 0, 1, 1, 1, 2);
					return $number." ".$titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
				}
				while( $i < count($usrs) )
				{
					$tks = $bilets[$usrs[$i]];
					if( $usrs[$i] < 0 )
					{
						$usrs[$i] = str_replace('-91','',$usrs[$i]);
						$usrs[$i] = str_replace('-92','',$usrs[$i]);
					}
					echo '<div><span style="float:left">'.($i+1).'. '.$u->microLogin($usrs[$i],1).'</span><span style="float:right"><small>Билетов: <div style="width:54px;display:inline-block;">'.$tks.'</div></small></span><br></div><hr>';
					$i++;
				}
			} else {echo 'Розыгрышей нет';}
			?>
</div>
<div id="lastloto" class="tabcontent">
			<?
			$last_loto = mysql_fetch_array(mysql_query('SELECT * FROM `loto_info` WHERE `finished` = 1 ORDER BY `id` DESC LIMIT 1'));
            ?><br>
			<center><h3><? if(isset($last_loto['id'])){ echo $last_loto['name'].' #'.$last_loto['id']; } ?></h3></center></br>
            <?
			$i = 0;
			$sp = mysql_query('SELECT * FROM `loto_win` WHERE `lid` = "'.$last_loto['id'].'" ORDER BY `id` DESC');
			while( $pl = mysql_fetch_array($sp) )
			{
				if( $pl['uid'] < 0 )
				{
					$pl['uid'] = str_replace('-91','',$pl['uid']);
					$pl['uid'] = str_replace('-92','',$pl['uid']);
				}
				if( $pl['uid'] == -1 )
				{
					echo 'Билет №'.$pl['bilet'].'. <i>(Персонаж был заблокирован, либо удален)</i>';
				}else{
					$witm = mysql_fetch_array(mysql_query('SELECT * FROM `loto_itm` WHERE `id` = "'.$pl['priz'].'" LIMIT 1'));
					echo 'Билет №'.$pl['bilet'].'. Персонаж '.$u->microLogin($pl['uid'],1).' выиграл &quot;<b>'.$witm['text'].'</b>&quot;!';
				}
				echo '<hr>';
				$i++;
			}
			if( $i == 0 ) {
			?>
            <center><h3>Победителей нет</h3></center>
            <? } ?>
</div>
<?
}
?>