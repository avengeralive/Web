<?php
if(!defined('GAME'))
{
	die();
}
$item_need = 50;//Сколько надо для покупки
$item_id = 8531;//ID предмета

if($u->room['file']=='an/lotot')
{
	$loto = mysql_fetch_array(mysql_query('SELECT * FROM `loto_info` WHERE `time_start` <= "'.time().'"
	AND (`time_finish` > '.time().' OR `finished` = 0) LIMIT 1'));
	//
	if( $loto['time_finish'] < time() && $loto['finished'] == 0 )
	{
        //Завершаем розыгрыш
		$loto['finished'] = 1;
		mysql_query('UPDATE `loto_info` SET `finished` = 1 WHERE `id` = "'.$loto['id'].'" LIMIT 1');//$loto['finished']

		$tickets = array();
		$sp = mysql_query('SELECT `id` FROM `items_users`WHERE `item_id`="4539" AND `data` LIKE "%Тираж №'.$loto['id'].', Билет%"');
        while( $pl = mysql_fetch_array($sp) ) {$tickets[] = $pl['id'];}

		$tickets_num = count($tickets);
		if($tickets_num < $loto['tiraj']) for($n=$tickets_num; $n<$loto['tiraj']; $n++) $tickets[] = 0;
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
							$u->addItem($pl['item_id'], $uwin['uid']);

							mysql_query('INSERT INTO `users_delo` (`onlyAdmin`,`hb`,`uid`,`time`,`city`,`text`,`login`,`ip`)
							VALUES ("1","0","'.$uad['id'].'","'.time().'","'.$uad['city'].'",
							" &quot;'.$uad['login'].'&quot; <font color=red>выиграл предмет</font>: <b>&quot;'.$pl['text'].' ('.$pl['item_id'].')&quot;</b> в лотерию <b>&quot;'.$loto['name'].'&quot;</b> №'.$loto['id'].'. Билет №'.$t_num[1].'.","AddItems.capitalcity","0")');
						 }

						mysql_fetch_array(mysql_query('DELETE FROM `items_users` WHERE `id`="'.$winner.'" LIMIT 1'));
					}
				}
                //if($winner != 0) echo 'Победитель: Билет №'.$t_num[1].'<br>Приз: '.$pl['text'].'<hr>';

				unset($tickets[$win]);
                $tickets = array_values($tickets);
                $tickets_num -= 1;
				$i++;
			}
		}
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
			$error = 'Вы успешно приобрели лотерейный билет, тираж №'.$loto['id'].'.';
			$u->addItem(4539,$u->info['id'],'|info=Лотерея &quot;'.$loto['name'].'&quot;<br>Тираж №'.$loto['id'].', Билет №'.($loto['buy']+1).'<br><b>Розыгрыш завершится '.date('d.m.Y H:i',$loto['time_finish']).'</b>');
			$u->info['money'] -= $loto['price'];
			mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			//
			$loto['buy']++;
			mysql_query('UPDATE `loto_info` SET `buy` = `buy` + 1 WHERE `id` = "'.$loto['id'].'" LIMIT 1');
            mysql_fetch_array(mysql_query('DELETE FROM `items_users` WHERE `item_id` = "'.$item_id.'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$item_need));
		}
	}
	//
	if( $loto['finished'] == 1 ) {
		unset( $loto );
	}
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
<div class="tab">
<button class="tablinks active" onclick="openTab(event, 'newloto')"><b>Текущая лотерея</b></button>
   <button class="tablinks" onclick="openTab(event, 'currentloto')"><b>Призы в текущем розыгрыше</b></button>
	<button class="tablinks" onclick="openTab(event, 'usersloto')"><b>Участники текущего розыгрыша </b></button>
     <button class="tablinks" onclick="openTab(event, 'lastloto')"><b>Победители прошлого розыгрыша</b></button>
	 	 <div style="float: right;">
        	<input style="margin-top: 8px;" class="btn btn-inverse" type="button" value="Вернуться" onClick="location='main.php?loc=2.180.0.234&rnd=<? echo $code; ?>';"/>
		</div>
	<div id="textgo" style="visibility:hidden;"></div>	 
</div>
<?php echo '<b style="color:red">'.$error.'</b>'; ?>
<div id="newloto" class="tabcontent" style="display: block;">
        	<center><h3><? if(isset($loto['id'])) { echo ' &quot;'.$loto['name'].'&quot;'; } ?></h3></center>
            <? if(!isset($loto['id'])) { ?>Розыгрышей нет<? }else{ ?>
            <div style="padding:20px;">
			<?
				$items = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "'.$item_id.'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
			?>
            Начало розыгрыша: <span class="date"><?=date('d.m.Y H:i',$loto['time_start'])?></span><br />
            Завершение розыгрыша: <span class="date"><?=date('d.m.Y H:i',$loto['time_finish'])?></span><br />
            Куплено билетов: <?=$loto['buy']?> из <b><?=$loto['tiraj']?></b><br />
            Стоимость билета: <b><?=$loto['price']?>.00 кр. и 50 черепов</b><br />
				  У вас в наличии: <b ><?php echo round($u->info['money'],2); ?> кр.</b> &nbsp;</br>
				  У вас в наличии черепов: <b style="color:#ff0000;"><?=$items[0];?></b> шт.
            <br />
            <? if( $loto['finished'] == 0 ) { ?>
            <center><input onclick="location.href='main.php?buyloto=1'" type="button" class="btn btn-inverse" value="Купить лотерейный билет" /><? } ?></center><br />
            <small>(Один игрок может купить несколько билетов)</small><hr />
			<?}?>
</div></div>
<div id="currentloto" class="tabcontent">
            <center><h3>Призы в текущем розыгрыше<h3></center>
            <?php
			$sp = mysql_query('SELECT * FROM `loto_itm` WHERE `lid` = "'.$loto['id'].'"');
			while( $pl = mysql_fetch_array($sp) ) {
				$itm = mysql_fetch_array(mysql_query('SELECT `img` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
				echo '<img src="https://img.testcombats.ru/i/items/'.$itm['img'].'">&nbsp;'.$pl['text'].', <b>Количество: '.$pl['colvo'].'</b><hr>';
			}
			?>
</div>
<div id="usersloto" class="tabcontent">
            <?
			$usrs = array();
			$bilets = array();
			$sp = mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `item_id` = "4539"');
			while( $pl = mysql_fetch_array($sp) ) {
				if(!isset($bilets[$pl['uid']])) {
					$usrs[] = $pl['uid'];
					$bilets[$pl['uid']] = 0;
				}
				$bilets[$pl['uid']]++;
			}
			echo '<center><h3>Участники текущего розыгрыша ('.count($usrs).')</h3></center>';
			$i = 0;
			function declOfNum($number, $titles) {
				$cases = array (2, 0, 1, 1, 1, 2);
				return $number." ".$titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
			}
			while( $i < count($usrs) ) {
				$tks = $bilets[$usrs[$i]];
				if( $usrs[$i] < 0 ) {
					$usrs[$i] = str_replace('-91','',$usrs[$i]);
					$usrs[$i] = str_replace('-92','',$usrs[$i]);
				}
				echo '<div><span style="float:left">'.($i+1).'. '.$u->microLogin($usrs[$i],1).'</span><span style="float:right"><small>Билетов: <div style="width:54px;display:inline-block;">'.$tks.'</div></small></span><br></div><hr>';
				$i++;
			}
			?>
</div>
<div id="lastloto" class="tabcontent">
			<?
			$last_loto = mysql_fetch_array(mysql_query('SELECT * FROM `loto_info` WHERE `finished` = 1 ORDER BY `id` DESC LIMIT 1'));
            ?><br>
			<center><h3><? if(isset($last_loto['id'])){ echo $last_loto['name']; } ?></h3></center></br>
            <?
			$i = 0;
			$sp = mysql_query('SELECT * FROM `loto_win` WHERE `lid` = "'.$last_loto['id'].'" ORDER BY `id` DESC');
			while( $pl = mysql_fetch_array($sp) ) {
				if( $pl['uid'] < 0 ) {
					$pl['uid'] = str_replace('-91','',$pl['uid']);
					$pl['uid'] = str_replace('-92','',$pl['uid']);
				}
				if( $pl['uid'] == -1 ) {
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