<?
if(!defined('GAME')) { die(); }

$res = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id` = '".mysql_real_escape_string($u->info['clan'])."' LIMIT 1"));
$cpr = explode('|', $u->info['clan_prava']);

if(!isset($res['id'])) {
  die('Клан был расформирован.');
}

if(!isset($_GET['events']) && !isset($_GET['diplom']) && !isset($_GET['control']) && !isset($_GET['deposit']) && !isset($_GET['titul']) && !isset($_GET['rules']) && !isset($_GET['info']) && !isset($_GET['members'])) {
  $_GET['events'] = 1;
}

//Возможности текущего титула
$tt = array(
	0	=>	array('000000000','Доступные каналы'),
	1	=>	array(1,'Просмотр событий клана'),
	2	=>	array(1,'Создание событий клана'),
	3	=>	array(0,'Просмотр хранилища'),
	4	=>	array(0,'Использование вещей из хранилища'),
	5	=>	array(0,'Изъятие предметов из хранилища'),
	6	=>	array(1,'Просмотр казны и списка игроков, пополнявших казну'),
	7	=>	array(1,'Пополнение казны'),
	8	=>	array(0,'Использование казны'),
	9	=>	array(0,'Прием в клан'),
	10	=>	array(0,'Изгнание из клана'),
	11	=>	array(0,'Редактирование информации о клане'),
	12	=>	array(0,'Клановые союзы'),
	13	=>	array(0,'Управление клановыми союзами и альянсами'),
	14	=>	array(0,'Обьявление войны'),
	15	=>	array(1,'Абилки'),
	15	=>	array(0,0),
	16	=>	array(0,0),
	17	=>	array(0,0),
	18	=>	array(0,0),
	19	=>	array(0,0),
	20	=>	array(0,0)
);

if($u->info['clan_prava'] != 'glava') {
  $utitl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.$u->info['clan_prava'].'" LIMIT 1'));
  if(!isset($utitl['id'])) {
    $utitl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = 2 LIMIT 1'));
  }
} else {
  $utitl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = 1 LIMIT 1'));
}

if(isset($utitl['id'])) {
	$i = 1;
	while($i < count($tt)) {
		if($utitl['prava'][$i] > 0) {
			$tt[$i][0] = 1;
		}
		$i++;
	}
}

$u->info['tt'] = $tt;

//Уровень клана
$lvl_exp = array(
	0 => 0,
	1 => 500000,
	2 => 2000000,
	3 => 5500000,
	4 => 10500000,
	5 => 20500000,
	6 => 35500000,
	7 => 65500000,
	8 => 105500000,
	9 => 205500000,
	10 => 305500000,
	11 => 505500000,
	12 => 705500000,
	13 => 1000000000
);

if($res['exp'] >= $lvl_exp[$res['level']+1] && isset($lvl_exp[$res['level']+1])) {
	$res['level']++;
	mysql_query('UPDATE `clan` SET `level` = "'.$res['level'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
	mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
	"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","Ваш клан достиг уровня '.$res['level'].'!"
	)');
}

//Права клана
$lvl_prava = array(
	0  => array(8,0,0,0,0,50,20,200),
	1  => array(12,1,0,0,0,50,20,200),
	2  => array(16,1,0,0,0,50,20,200),
	3  => array(20,1,0,0,0,50,20,200),
	4  => array(24,1,1,0,0,100,40,200),
	5  => array(28,1,1,0,0,100,40,200),
	6  => array(32,1,1,0,0,100,40,200),
	7  => array(36,1,1,0,0,200,80,200),
	8  => array(40,1,1,1,1,200,80,200),
	9  => array(44,1,1,1,1,200,80,200),
	10 => array(48,1,1,1,1,200,80,200),
	11 => array(52,1,1,1,1,200,80,200)
)

?>
<script type="text/javascript" src="js/jquery.js"></script>
<style>

body { background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_44.jpg);}
.a {text-decoration:none; color:#333333; font-size:10px;}
.a:hover{text-decoration:none; color:#333333; font-size:10px;}
 
.clanimg { padding-right:5px; margin-bottom:-2px;}
.infimg {margin-left:2px; margin-bottom:-1px;}

#clanpanel {width:100%; height:32px; color:#333333; font-weight:bold; font-size:11px;}
#clanpanel .head{ float:left; width:75px; height:18px; font-size:11px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_03.jpg); background-repeat:no-repeat;}
#clanpanel .panel{ float:left; width:100%; height:32px; font-size:11px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_08.jpg); background-repeat:repeat-x;}
#clanpanel .foot{ float:left; width:75px; height:12px; font-size:11px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_27.jpg); background-repeat:no-repeat;}

.tabs ul {list-style:none; float:left; margin:0px; padding:0px;}

.name{ float:left; color:#990000; height:32px; padding-left:85px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_s3r3_07.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:15px;}
 .clanicon{ padding-right:10px; margin-bottom:-2px;}

.tabs .events{ float:left; height:32px; padding-left:50px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_09.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:5px;}
.tabs .control{ float:left; height:32px; padding-left:50px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_11.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:5px;}

.tabs .deposit{ float:left; height:32px; padding-left:50px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_13.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:5px;}

.tabs .clanart{ float:left; height:32px; padding-left:50px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_17.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:5px;}

.tabs .rules{ float:left; height:32px; padding-left:50px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_19.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:5px;}

.tabs .info{ float:left; height:32px; padding-left:50px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_21.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:5px;}

.tabs .members{ float:left; height:32px; padding-left:50px; background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_23.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:5px;}

.tabs .last{ float:right; width:15px; height:32px;background-image:url(//img.testcombats.ru/i/clanpanel/klan_img_25.jpg); background-repeat:no-repeat;}


#clancontent {width:100%; float:left; padding-top:25px; }
.eventsblock {}



.legtitle   {font-weight:bold; padding:0px 5px 0px 5px; color:#990000;}
.legcontent {padding:0px 5px 0px 5px;}

.section {
	width: 100%;

	margin: 0 0 30px;
}
ul.tabs {
	height: 28px;
	line-height: 25px;
	list-style: none;
	margin:0px; padding:0px;
	font-size:10px;
	color:#666;
}
.tabs li {
	float: left;
	position: relative;
	cursor:pointer;
	font-size:10px;
}

.tabs li a{
	color:#666;
	font-size:10px;
}
.tabs li:hover,
.vertical .tabs li:hover {

}
li.current a{
	color:#333333;
	font-size:10px;

}


.box {
width:80%;
float:left;
display: none;
padding-top:25px;


}
.box.visible {
	display: block;
}
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

function openMod(title, dat) {
  var d = document.getElementById('useMagic');
  if(d != undefined) {
    document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="Закрыть" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
    document.getElementById('moddata').innerHTML = dat;
    d.style.display = '';
  }
}



function closeMod() {
  var d = document.getElementById('useMagic');
  if(d != undefined) {
    document.getElementById('modtitle').innerHTML = '';
    document.getElementById('moddata').innerHTML = '';
    d.style.display = 'none';
  }
}

function addNewEvent() {
  openMod('Добавить событие',
	'<form method="post" action="main.php?clan&events&add=<?=$code?>">Заголовок: <input name="titleadd" value="" style="width:335px;" type="text"><br><textarea name="textadd" style="width:412px;" rows="5"></textarea><br><div align="right"><input type="submit" value="Добавить событие"></div></form>');
}

function addNewTitul() {
  openMod('Добавить титул',
	'<form method="post" action="main.php?clan&titul&add=<?=$code?>">Название титула: <input name="tituladd" value="" style="width:235px;" type="text"><br><small style="float:left">(не более 30-ти символов)</small><input style="float:right" type="submit" value="Добавить титул"></div></form>');
}

</script>

<div id="useMagic" style="display:none; position:absolute; border:solid 1px #776f59; left: 50px; top: 186px;" class="modpow">
 <div class="mt" id="modtitle"></div>
 <div class="md" id="moddata"></div>
</div>
<input  style="float:right;margin:1px" type="button" value="Вернуться" onClick="document.location='main.php'">
<input  style="float:right;margin:1px" type="button" value="Обновить" onClick="document.location='<?=$_SERVER['REQUEST_URI']?>'">
<?
if($u->info['clan_prava'] != 'glava') {
  if(isset($_GET['clan_exit']) && $u->newAct($_GET['sd4']) == true) {
    if($u->info['money'] >= 50) {
	  $txt = 'Игрок <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif"></a> покинул клан. (50 кр.)';
	  mysql_query('INSERT INTO `clan_news` (`clan`, `time`, `ddmmyyyy`, `uid`, `ip`, `login`, `title`, `text`) VALUES ("'.$res['id'].'", "'.time().'", "'.date('d.m.Y').'", "0", "127.0.0.1", "Администрация", "Клановое сообщение", "'.mysql_real_escape_string($txt).'")');
	  mysql_query('UPDATE `users` SET `palpro` = 0, `clan` = 0, `align` = 0, `clan_prava` = "0|0|0|0", `money` = `money` - 50 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	  $ar = $u->rem_itm_cl($u->info, $res['id'], 7);
    } else {
	  echo '<script>setTimeout("alert(\'Для выхода из клана требуется наличие 50 кр.\');",500)</script>';
	}
  }
?>
<input style="float:right;margin:1px;margin-right:50px;color:red;" type="button" value="Покинуть клан (50 кр.)" onClick="document.location='main.php?clan&clan_exit=1&sd4=<?=$u->info['nextAct']?>'">
<? } ?>
<br>
<div class="section">
<div id="clanpanel">
  <div class="head" style="position:relative"><img src="//img.testcombats.ru/i/align/align<?=$res['align'];?>.gif" style="position:absolute;top:23px;left:40px;" /></div>
    <div class="panel" style="white-space:nowrap;min-width:1000px;">
      <div class="name" onclick='location.href="main.php?clan&events"' title="События клана" style="cursor:pointer"><img class="clanicon" src="//img.testcombats.ru/i/clan/<?=$res['name_mini'];?>.gif"><?=$res['name'];?></div>
      <ul class="tabs">
      <? if($tt[15][0] == 1) { ?><li class="events"><a href="main.php?clan&ability">Абилки</a></li><? } ?>
      <? if($tt[11][0] == 1) { ?><li class="control"><a href="main.php?clan&control">Управление</a></li><? } ?>
      <? if($tt[3][0] == 1) { ?><!--li class="deposit"><a href="main.php?clan&deposit">Хранилище</a></li-><? } ?>
      <? if($tt[11][0] > 0) { ?><!--li class="clanart"><a href="main.php?clan&titul">Титулы</a></li--><? } ?>
      <!--li class="rules"><a href="main.php?clan&rules">Права</a></li-->
      <li class="info"><a href="main.php?clan&info">О клане</a></li>
      <li class="members"><a href="main.php?clan&members">Соклановцы</a></li>
      <? if($tt[12][0] == 1) { ?>
      <li class="rules"><a href="main.php?clan&diplom">Дипломатия</a></li>
      <? } ?>
      <li class="last"></li>
      </ul>
    </div>
 <div class="foot"></div>
</div><? if(isset($_GET['events'])) { ?>
   <div class="box visible">
   <style>
   .leftimg {
    float:left; /* Выравнивание по левому краю */
    margin: 17px 17px 17px 7px; /* Отступы вокруг картинки */
   }
   .rightimg  {
    float: right; /* Выравнивание по правому краю  */ 
    margin: 17px 7px 17px 17px; /* Отступы вокруг картинки */
   }
   .dnbx {
	   width:25px;
	   height:22px;
	   background-color:#ecece4;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx1 {
	   width:25px;
	   height:22px;
	   background-color:#ecece4;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx5 {
	   height:22px;
	   background-color:#ecece4;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx:hover {
	   width:25px;
	   height:22px;
	   background-color:#dbdad5;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx2 {
	   width:25px;
	   height:22px;
	   background-color:#b5b4b1;
	   color:#ecebe6;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   </style>
    <fieldset style="border:1px dashed #eeeeee">
      <legend><span class="legtitle">События</span></legend>
      <?
	  	  
	  $c_r = ''; $c_c = ''; $c_p = '';	 
	  
	  if(isset($_GET['add'],$_POST['textadd']) && $tt[2][0] == 1) {
		 $lmsg = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_news` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.(time()-10).' LIMIT 1'));
		 if(isset($lmsg['id'])) {
			 $c_r .= '<font color="#FF0000"><b>Нельзя добавлять сообщения чаще одного раза в 10 секунд</b></font><br>'; 
		 }else{
			 $tadd = htmlspecialchars($_POST['textadd'],NULL,'cp1251');
			 $ttadd = htmlspecialchars($_POST['titleadd'],NULL,'cp1251');
			 if(str_replace(' ','',str_replace('	','',$tadd)) == '') {
				 $c_r .= '<font color="#FF0000"><b>Нельзя отправлять пустое событие</b></font><br>';  
			 }elseif(str_replace(' ','',str_replace('	','',$ttadd)) == '') {
				 $c_r .= '<font color="#FF0000"><b>Нельзя отправлять пустой заголовок</b></font><br>';  
			 }else{
				$tadd = str_replace("\n",'<br>',$tadd);
				mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
				"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","'.$u->info['id'].'","'.$u->info['ip'].'","'.$u->info['login'].'","'.mysql_real_escape_string($ttadd).'","'.mysql_real_escape_string($tadd).'"
				)');
				$c_r .= '<font color="#FF0000"><b>Событие было успешно добавлено</b></font><br>'; 
			 }
		 }
	  }elseif(isset($_GET['delete']) && $tt[2][0] == 1) {
		  $upd = mysql_query('UPDATE `clan_news` SET `delete` = "'.$u->info['id'].'" WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" AND `uid` != "0" AND `id` = "'.mysql_real_escape_string($_GET['delete']).'" LIMIT 1');
		  if($upd) {
			 $c_r .= '<font color="#FF0000"><b>Событие было успешно удалено</b></font><br>';  
		  }else{
			  $c_r .= '<font color="#FF0000"><b>Событие не найдено</b></font><br>';  
		  }
	  }
	   
	  $dd = date('d');
	  $mm = date('m');
	  $yy = date('Y');	
	  
	  if(isset($_GET['mm'])) {
		 $mm =  ceil((int)$_GET['mm']);
	  }
	  if(isset($_GET['dd'])) {
		 $dd =  ceil((int)$_GET['dd']);
	  }
	  if(isset($_GET['yy'])) {
		 $yy =  ceil((int)$_GET['yy']);
	  }
	    
	  $mml = ceil($mm)-1;
	  $mmr = ceil($mm)+1;	  
	  $yyl = $yy;
	  $yyr = $yy;	  
	  if($mml < 1) {
		$yyl--;
		$mml = 12;  
	  }	  
	  if($mmr > 12) {
		$yyr++;
		$mmr = 1;  
	  }	
	  $dds = array('','пн','вт','ср','чт','пт','<font color="#981115">сб</font>','<font color="#981115">вс</font>');
	  $mms = array('','январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь');
	  $num = 0; $lday = 0;
	  for($i = 0; $i < 7; $i++)
	  {
		$dayofweek = date('w',mktime(0, 0, 0, $mm, $day_count, $yy));
		$dayofweek = $dayofweek - 1;
		if($dayofweek == -1) $dayofweek = 6;
	
		if($dayofweek == $i)
		{
		  $week[$num][$i] = $day_count;
		  $lday = $day_count;
		  $day_count++;
		}else{
		  $week[$num][$i] = "";
		}
	  }
	  
	  function freenews($d,$m,$y) {
		  global $res;
		  $r = $d;
		  if($d < 9) {
			 $d = '0'.$d; 
		  }
		  if($m < 9) {
			 $m = '0'.((int)$m); 
		  }
		  $n = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_news` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" AND `ddmmyyyy` = "'.$d.'.'.$m.'.'.$y.'" LIMIT 1'));
		  if(isset($n['id'])) {
			 $r = '<a style="text-decoration:underline;" href="?clan&events&ftr=1&mm='.$m.'&yy='.$y.'&dd='.$d.'">'.$r.'</a>'; 
		  }
		  return $r;
	  }
	  
	  $i = 1;
	  $c_c .= '<div style="width:260px;border:1px solid #9d9d9d;padding:10px;background-color:#ecebe7">';
	  if($tt[2][0] > 0) {
	  	$c_c .= '<center><input  type="button" value="Добавить событие" onClick="addNewEvent();"></center><br>';
	  }
	  $c_c .= '<div><span style="float:left" class="dnbx" title="'.$mms[$mml].' '.$yyl.'" onclick="location=\'?clan&events&mm='.$mml.'&yy='.$yyl.'\'">&lt;</span><span style="float:right" class="dnbx" onclick="location=\'?clan&events&mm='.$mmr.'&yy='.$yyr.'\'" title="'.$mms[$mmr].' '.$yyr.'">&gt;</span><center class="dnbx5">'.$yy.' '.$mms[ceil($mm)].'</center></div><br>';
	  while($i <= 49) {
		 if($i <= 7) {
		 	$c_c .= '<small class="dnbx1"><b>'.$dds[$i].'</b></small>';
		 }else{
			if($i-7 > 7) {
				$lday++;
				if(date('d',mktime(0, 0, 0, $mm, $lday)) == $lday) {
					if($lday == date('d') && $mm == ceil(date('m')) && $yy == date('Y')) {
						$c_c .= '<span class="dnbx2">'.freenews($lday,$mm,$yy).'</span>';
					}else{
						$c_c .= '<span class="dnbx">'.freenews($lday,$mm,$yy).'</span>';
					}
				}else{
					$c_c .= '<span class="dnbx1">&nbsp;</span>';
				}
			}else{
				if($week[0][$i-8] > 0) {
					if($week[0][$i-8] == date('d') && $mm == ceil(date('m')) && $yy == date('Y')) {
						$c_c .= '<span class="dnbx2">'.freenews($week[0][$i-8],$mm,$yy).'</span>';
					}else{
						$c_c .= '<span class="dnbx"">'.freenews($week[0][$i-8],$mm,$yy).'</span>';
					}
				}elseif($lday > 0) {
					$c_c .= '<span class="dnbx1">&nbsp;</span>';
				}
			}
		 }
		 if($i == 7 || $i == 14 || $i == 21 || $i == 28 || $i == 35 || $i == 42) {
			if($lday > 0 || $i != 14) {
				$c_c .= '<br>';
			}
		 }
		 $i++; 
	  }
	  $c_c .= '</div>';
	  
		if($tt[1][0] == 1) {
		  $cnftr = '';
		  if(isset($_GET['ftr'])) {
			  if($_GET['ftr'] == 1) {
				$dd1 = $dd;
				$mm1 = $mm;
				$yy1 = $yy;
				if($dd1 < 9) {
					$dd1 = '0'.$dd1;
				}
				if($mm1 < 9) {
					$mm1 = '0'.$mm1;
				}
			  	$cnftr = ' AND `ddmmyyyy` = "'.mysql_real_escape_string($dd1.'.'.$mm1.'.'.$yy1).'"';
			  }
		  }
			$pg = round((int)$_GET['pg']);
			if($pg < 1) {
				$pg = 1;	
			}
			$pgssee = ceil(($pg-1)*5);
		  
			$pgs = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `clan_news` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0"'.$cnftr));
			$pgs = $pgs[0];
			$pga = ceil($pgs/5);
	
			$i = 1;
			while($i <= $pga) {
				if($pg == $i) {
					$c_p .= ' <b>'.$i.'</b> ';
				}else{
					if(isset($_GET['ftr'])) {
						$c_p .= ' <a href="?clan&events&dd='.$dd.'&mm='.$mm.'&yy='.$yy.'&ftr='.$_GET['ftr'].'&pg='.$i.'">'.$i.'</a> ';
					}else{
						$c_p .= ' <a href="?clan&events&pg='.$i.'">'.$i.'</a> ';
					}
				}
				$i++;
			}
			
			if($c_p != '') {
				$c_p = 'Страницы: '.$c_p;
			}
		  
		  $sp = mysql_query('SELECT * FROM `clan_news` WHERE `clan` = "'.$res['id'].'" AND `delete` < 1'.$cnftr.' ORDER BY `id` DESC LIMIT '.mysql_real_escape_string($pgssee).',5');
		  while($pl = mysql_fetch_array($sp)) {
			  if($pl['uid'] > 0) {
				$login = $u->microLogin($pl['uid'],1);
				if($tt[2][0] == 1){
					$pl['text'] = '<img src="//img.testcombats.ru/i/clear.gif" width="13" height="13" title="Удалить событие" class="leftimg" style="cursor:pointer" onclick="location=\'main.php?clan&events&pg='.ceil($pg).'&delete='.$pl['id'].'\'">'.$pl['text'];
				}
			  }else{
				$login = '';  
			  }
			  
			  $c_r .= '
	<table width="100%" border="0" style="border:1px solid #aeaeae" cellspacing="0" cellpadding="5">
	  <tr>
		<td bgcolor="#c4c3c1"><div style="float:left"><i>'.date('d.m.Y H:i',$pl['time']).'</i> &nbsp; &nbsp; &nbsp; <a class="a" href="javascript:void(0)">'.$pl['title'].'</a></div><div style="float:right">'.$login.'</div></td>
	  </tr>
	  <tr>
		<td>'.$pl['text'].'</td>
	  </tr>
	</table><br>';
		  }	 
	  }
	  if($c_r == '') {
		 $c_r .= '<br><br><br><br><br><br><br><br><center><b>Событий пока нет или глава клана не предоставил вам к ним доступ</b></center>'; 
	  }
	   
	  ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td align="left" valign="top"><?=$c_r?></td>
        <td width="300" align="center" valign="top"><?=$c_c?></td>
      </tr>
      <tr>
        <td align="left" valign="top"><?=$c_p?></td>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
      </table>
    </fieldset>
   </div>
    <?php
   }elseif(isset($_GET['ability'])) {
	$r1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_rating` WHERE `clan` = "'.$res['id'].'" AND `date` = "'.date('dmY').'" LIMIT 1'));
	$r2 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_rating` WHERE `clan` = "'.$res['id'].'" AND `date` != "'.date('dmY').'" ORDER BY `id` DESC LIMIT 1'));
	$clan_prava = mysql_fetch_array(mysql_query('SELECT * FROM `clan_prava` WHERE `uid` = "'.$u->info['id'].'" AND `clan` = "'.$u->info['clan'].'" LIMIT 1'));
   ?>
   <fieldset style="padding: 10px;margin-top:15px; padding-bottom:10px;">
            <legend style='font-weight:bold; color:#8F0000;'>Абилки</legend>
			<?php
			// 
			$abil = array();
			//
			if( $r1['pos'] == 1) {
				$abil['exp'] = 20;
				$abil['stats'] = 5;
				$abil['amp'] = 10;
				//$abil['atck'] = 15;
				//$abil['atck2'] = 10;
				$abil['hpmp'] = 150000;
				$abil['molch15'] = 10;
				$abil['molch30'] = 5;
				$abil['exit_btl'] = 5;
				$abil['hpvinos5'] = 20;
				$abil['hl11'] = 20;
				$abil['hl10'] = 20;
				/* $abil['h20'] = 20;
				$abil['hl9'] = 20; */
				$abil['hl8'] = 30;
				$abil['hl7'] = 20;
				$abil['hl6'] = 20;
				/* $abil['hl5'] = 20;
				$abil['hl4'] = 20;
				$abil['hl3'] = 20; */
				$abil['hl2'] = 30;
				$abil['hl1'] = 5;
			}elseif( $r1['pos'] == 2 ) {
				$abil['exp'] = 10;
				$abil['stats'] = 3;
				$abil['amp'] = 5;
				//$abil['atck'] = 10;
				//$abil['atck2'] = 5;
				$abil['hpmp'] = 140000;
				$abil['molch15'] = 5;
				$abil['molch30'] = 3;
				$abil['exit_btl'] = 3;
				$abil['hpvinos5'] = 15;
				$abil['hl11'] = 15;
				$abil['hl10'] = 15;
				/* $abil['h20'] = 15;
				$abil['hl9'] = 15; */
				$abil['hl8'] = 20;
				$abil['hl7'] = 15;
				$abil['hl6'] = 15;
				/* $abil['hl5'] = 15;
				$abil['hl4'] = 15;
				$abil['hl3'] = 15; */
				$abil['hl2'] = 20;
				$abil['hl1'] = 3;
			}elseif( $r1['pos'] == 3 ) {
				$abil['exp'] = 5;
				$abil['stats'] = 1;
				$abil['amp'] = 3;
				//$abil['atck'] = 5;
				//$abil['atck2'] = 3;
				$abil['hpmp'] = 130000;
				$abil['molch15'] = 3;
				$abil['molch30'] = 1;
				$abil['exit_btl'] = 1;
				$abil['hpvinos5'] = 10;
				$abil['hl11'] = 10;
				$abil['hl10'] = 10;
				/* $abil['h20'] = 10;
				$abil['hl9'] = 10; */
				$abil['hl8'] = 15;
				$abil['hl7'] = 10;
				$abil['hl6'] = 10;
				/* $abil['hl5'] = 10;
				$abil['hl3'] = 10;
				$abil['hl4'] = 10; */
				$abil['hl2'] = 15;
				$abil['hl1'] = 1;
			}elseif( $r1['pos'] == 4 ) {
				$abil['exp'] = 0;
				$abil['stats'] = 0;
				$abil['amp'] = 0;
				//$abil['atck'] = 3;
				//$abil['atck2'] = 1;
				$abil['hpmp'] = 120000;
				$abil['molch15'] = 1;
				$abil['molch30'] = 0;
				$abil['exit_btl'] = 0;
				$abil['hpvinos5'] = 5;
				$abil['hl11'] = 5;
				$abil['hl10'] = 5;
				/* $abil['h20'] = 5;
				$abil['hl9'] = 5; */
				$abil['hl8'] = 10;
				$abil['hl7'] = 5;
				$abil['hl6'] = 5;
				/* $abil['hl5'] = 5;
				$abil['hl4'] = 5;
				$abil['hl3'] = 5; */
				$abil['hl2'] = 10;
				$abil['hl1'] = 0;
			}elseif( $r1['pos'] == 5 ) {
				$abil['exp'] = 0;
				$abil['stats'] = 0;
				$abil['amp'] = 0;
				//$abil['atck'] = 1;
				//$abil['atck2'] = 0;
				$abil['hpmp'] = 110000;
				$abil['m1'] = 0;
				$abil['m2'] = 0;
				$abil['molch15'] = 0;
				$abil['molch30'] = 0;
				$abil['exit_btl'] = 0;
				$abil['hpvinos5'] = 1;
				$abil['hl11'] = 1;
				$abil['hl10'] = 1;
				/* $abil['h20'] = 1;
				$abil['hl9'] = 1; */
				$abil['hl8'] = 3;
				$abil['hl7'] = 1;
				$abil['hl6'] = 1;
				/* $abil['hl5'] = 1;
				$abil['hl4'] = 1;
				$abil['hl3'] = 1; */
				$abil['hl2'] = 3;
				$abil['hl1'] = 0;
			}else{
				$abil['exp'] = 0;
				$abil['stats'] = 0;
				$abil['amp'] = 0;
				//$abil['atck'] = 0;
				//$abil['atck2'] = 0;
				$abil['hpmp'] = 10000;
				$abil['m1'] = 0;
				$abil['m2'] = 0;
				$abil['molch15'] = 0;
				$abil['molch30'] = 0;
				$abil['exit_btl'] = 0;
				$abil['hpvinos5'] = 0;
				$abil['hl11'] = 1;
				$abil['hl10'] = 1;
				/* $abil['h20'] = 0;
				$abil['hl9'] = 0; */
				$abil['hl8'] = 1;
				$abil['hl7'] = 0;
				$abil['hl6'] = 0;
				/* $abil['hl5'] = 0;
				$abil['hl4'] = 0; */
				/* $abil['hl3'] = 0; */
				$abil['hl2'] = 1;
				$abil['hl1'] = 0;
			}
			/* $abil['_h20'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "h20" LIMIT 1'));
			$abil['_h20'] = 0 + $abil['_h20'][0];
			$abil['h20'] -= $abil['_h20'];
			//
			$abil['_hl9'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl9" LIMIT 1'));
			$abil['_hl9'] = 0 + $abil['_hl9'][0];
			$abil['hl9'] -= $abil['_hl9'];
			//
			$abil['_hl3'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl3" LIMIT 1'));
			$abil['_hl3'] = 0 + $abil['_hl3'][0];
			$abil['hl3'] -= $abil['_hl3'];
			//
			$abil['_hl4'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl4" LIMIT 1'));
			$abil['_hl4'] = 0 + $abil['_hl4'][0];
			$abil['hl4'] -= $abil['_hl4'];
			//
			$abil['_hl5'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl5" LIMIT 1'));
			$abil['_hl5'] = 0 + $abil['_hl5'][0];
			$abil['hl5'] -= $abil['_hl5']; */
			//
			$abil['_hl6'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl6" LIMIT 1'));
			$abil['_hl6'] = 0 + $abil['_hl6'][0];
			$abil['hl6'] -= $abil['_hl6'];
			//
			$abil['_hl7'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl7" LIMIT 1'));
			$abil['_hl7'] = 0 + $abil['_hl7'][0];
			$abil['hl7'] -= $abil['_hl7'];
			//
		    $abil['_hl8'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl8" LIMIT 1'));
			$abil['_hl8'] = 0 + $abil['_hl8'][0];
			$abil['hl8'] -= $abil['_hl8'];
			//
			$abil['_hl2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl2" LIMIT 1'));
			$abil['_hl2'] = 0 + $abil['_hl2'][0];
			$abil['hl2'] -= $abil['_hl2'];
			//
			$abil['_hl10'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl10" LIMIT 1'));
			$abil['_hl10'] = 0 + $abil['_hl10'][0];
			$abil['hl10'] -= $abil['_hl10'];
			//
			$abil['_hl11'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl11" LIMIT 1'));
			$abil['_hl11'] = 0 + $abil['_hl11'][0];
			$abil['hl11'] -= $abil['_hl11'];
			//
			/* $abil['_molch15'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "molch15" LIMIT 1'));
			$abil['_molch15'] = 0 + $abil['_molch15'][0];
			$abil['molch15'] -= $abil['_molch15']; */
			//
			$abil['_molch30'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "molch30" LIMIT 1'));
			$abil['_molch30'] = 0 + $abil['_molch30'][0];
			$abil['molch30'] -= $abil['_molch30'];
			//
			$abil['_exit_btl'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "exit_btl" LIMIT 1'));
			$abil['_exit_btl'] = 0 + $abil['_exit_btl'][0];
			$abil['exit_btl'] -= $abil['_exit_btl'];
			//
			$abil['_hpvinos5'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hpvinos5" LIMIT 1'));
			$abil['_hpvinos5'] = 0 + $abil['_hpvinos5'][0];
			$abil['hpvinos5'] -= $abil['_hpvinos5'];
			//
			//$abil['_atck'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "atck" LIMIT 1'));
			//$abil['_atck'] = 0 + $abil['_atck'][0];
			//$abil['atck'] -= $abil['_atck'];
			//
			//$abil['_atck2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "atck2" LIMIT 1'));
			//$abil['_atck2'] = 0 + $abil['_atck2'][0];
			//$abil['atck2'] -= $abil['_atck2'];
			
			
			$html = '';
			$er = '';
		   if($u->info['clan']==$u->info['clan']) {
			if( $abil['atck'] > 0 ) {
				 if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				   if(isset($_GET['atckadd'])){
					include'clan/useatack.php';
				   }
				   
				   
				   
				//Обычная нападалка
				$html .= '<img onclick="mod8();" onMouseOver="top.hi(this,\'<b>Нападение</b> (Осталось '.$abil['atck'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/n/attack.gif"> ';
				}
			}
			
			if( $abil['atck2'] > 0 ) {
				 if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				if(isset($_GET['atckad'])){
					include'clan/useatackk.php';
				}
				//Кровавое нападалка
				$html .= '<img onclick="mod9();" onMouseOver="top.hi(this,\'<b>Кровавое Нападение</b> (Осталось '.$abil['atck2'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/n/attackb.gif"> ';
			}
		}
			
	//сокрушение
	/* if( isset($_GET['hl9add']) && $abil['hl9'] > 0 ) {
	    $abil['hl9']--;
		$additm = $u->addItem(994,$u->info['id']);
	if( $additm > 0 ) {
		$_GET['login'] = $u->info['login']; //на кого кастуем
		$magic->useItems($additm);
		unset($_GET['login']);
		mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl9")');
		$msg = 'Cокушение';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	if( $u->error != '' ) {
		$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl9'].' на сегодня)<b>';
	}else{
		$er = 'Вы ощутили силу каста &quot;<b>Сокрушение</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl9'].' на сегодня)<b>';
	}
	}else{
		$er = 'Что-то пошло не так, каст не сработал...';
	}
	}
    if($abil['hl9'] > 0 ) {
	if($u->info['battle'] > 0) {
	    $html .= '';
    }else{
	     $html .= '<img onclick="location.href=\'/main.php?clan&ability&hl9add\';" onMouseOver="top.hi(this,\'<b>Сокрушение</b> (Осталось: '.$abil['hl9'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/spell_powerup10.gif"> ';
	}
} */
	//Холодный Разум
	/* if( isset($_GET['h20add']) && $abil['h20'] > 0 ) {
	    $abil['h20']--;
		$additm = $u->addItem(8510,$u->info['id']);
	if( $additm > 0 ) {
		$_GET['login'] = $u->info['login']; //на кого кастуем
		$magic->useItems($additm);
		unset($_GET['login']);
		mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","h20")');
		$msg = 'Cокушение';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	if( $u->error != '' ) {
		$er = $u->error.'<br></b>(Осталось кастов: '.$abil['h20'].' на сегодня)<b>';
	}else{
		$er = 'Вы ощутили силу каста &quot;<b>Холодный Разум</b>&quot;.<br></b>(Осталось кастов: '.$abil['h20'].' на сегодня)<b>';
	}
	}else{
		$er = 'Что-то пошло не так, каст не сработал...';
	}
	}
    if($abil['h20'] > 0 ) {
	if($u->info['battle'] > 0) {
	    $html .= '';
    }else{
	     $html .= '<img onclick="location.href=\'/main.php?clan&ability&h20add\';" onMouseOver="top.hi(this,\'<b>Холодный Разум</b> (Осталось: '.$abil['h20'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/spell_stat_intel.gif"> ';
	}
}			 */
	//защита от оружия
	/* if( isset($_GET['hl3add']) && $abil['hl3'] > 0 ) {
		$abil['hl3']--;
		$additm = $u->addItem(1001,$u->info['id']);
	if( $additm > 0 ) {
		$_GET['login'] = $u->info['login']; //на кого кастуем
		$magic->useItems($additm);
		unset($_GET['login']);
		mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl3")');
		$msg = 'Защита от оружия';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	if( $u->error != '' ) {
		$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl3'].' на сегодня)<b>';
	}else{
		$er = 'Вы ощутили силу каста &quot;<b>Защиты от оружия</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl3'].' на сегодня)<b>';
    }
	}else{
		$er = 'Что-то пошло не так, каст не сработал...';
	}
	}
	if($abil['hl3'] > 0 ) {
	if($u->info['battle'] > 0) {
	   $html .= '';
	}else{
		$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl3add\';" onMouseOver="top.hi(this,\'<b>Защита от оружия</b> (Осталось: '.$abil['hl3'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_protect10.gif">';
	}
} */
	//жажда жизни +5
	/* if( isset($_GET['hpvinos']) && $abil['hpvinos5'] > 0 ) {
		$abil['hpvinos5']--;
		$additm = $u->addItem(3102,$u->info['id']);
	if( $additm > 0 ) {
		$_GET['login'] = $u->info['login']; //на кого кастуем
		$magic->useItems($additm);
		unset($_GET['login']);
		mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hpvinos5")');
		$msg = 'Жажда жизни +5';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	if( $u->error != '' ) {
		$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hpvinos5'].' на сегодня)<b>';
	}else{
		$er = 'Вы ощутили силу каста &quot;<b>Жажда жизни +5</b>&quot;.<br></b>(Осталось кастов: '.$abil['hpvinos5'].' на сегодня)<b>';
	}
	}else{
		$er = 'Что-то пошло не так, каст не сработал...';
	}
}
	if($abil['hpvinos5'] > 0 ) {
	if($u->info['battle'] > 0) {
		$html .= '';
   }else{
		$html .= '<img onclick="location.href=\'/main.php?clan&ability&hpvinos\';" onMouseOver="top.hi(this,\'<b>Жажда Жизни +5</b> (Осталось: '.$abil['hpvinos5'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_powerHPup5.gif">';
	}
} */
	
	//Магическое усиление
	/* if( isset($_GET['hl4add']) && $abil['hl4'] > 0 ) {
		$abil['hl4']--;
		$additm = $u->addItem(4942,$u->info['id']);
	if( $additm > 0 ) {
		$_GET['login'] = $u->info['login']; //на кого кастуем
		$magic->useItems($additm);
		unset($_GET['login']);
		mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl4")');
		$msg = 'Магическое усиление';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	if( $u->error != '' ) {
		$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl4'].' на сегодня)<b>';
	}else{
		$er = 'Вы ощутили силу каста &quot;<b>Магического усиления</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl4'].' на сегодня)<b>';
	}
	}else{
		$er = 'Что-то пошло не так, каст не сработал...';
	}
	}
	if($abil['hl4'] > 0 ) {
	if($u->info['battle'] > 0) {
	    $html .= '';
    }else{
		$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl4add\';" onMouseOver="top.hi(this,\'<b>Магическое усиление</b> (Осталось: '.$abil['hl4'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/invoke_spell_godintel100.gif">';
	}
} */

	/* //защита от магии
	if( isset($_GET['hl5add']) && $abil['hl5'] > 0 ) {
		$abil['hl5']--;
		$additm = $u->addItem(4941,$u->info['id']);
	if( $additm > 0 ) {
		$_GET['login'] = $u->info['login']; //на кого кастуем
		$magic->useItems($additm);
		unset($_GET['login']);
		mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl5")');
		$msg = 'Защита от магии';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	if( $u->error != '' ) {
		$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl5'].' на сегодня)<b>';
	}else{
		$er = 'Вы ощутили силу каста &quot;<b>Защита от магии</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl5'].' на сегодня)<b>';
	}
	}else{
		$er = 'Что-то пошло не так, каст не сработал...';
	}
}
	if($abil['hl5'] > 0) {
    if($u->info['battle'] > 0) {
		$html .= '';
	}else{
	    $html .= '<img onclick="location.href=\'/main.php?clan&ability&hl5add\';" onMouseOver="top.hi(this,\'<b>Защита от магии</b> (Осталось: '.$abil['hl5'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/magearmor.gif">';
	}
} */
	
	//Восстановление Энергии +120 ХП
	if( isset($_GET['hl8add']) && $abil['hl8'] > 0 )
	{
		$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
		$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
		if($u->info['hpNow']>=$u->stats['hpAll']) {
			$er = 'Вам незачем восстанавливать Энергию';
		}elseif($u->info['tactic7'] < 2.50 ) {
	    	$er = 'Недостаточно духа!';
		}elseif($u->info['hpNow'] < 0) {
			$er = 'Вы умерли...';
		}elseif(isset($bu['id'])) {
		    $er = 'Нельзя использовать свиток каждый ход...';
		}elseif($battle['noeff'] > 0 ) {
			$er = 'Запрет на использования свитков восстановления';
		}else{
			$abil['hl8']--;
			$u->info['hpNow'] += 120;
            if($u->info['hpNow']>$u->info['hpAll']) $u->info['hpNow']=$u->info['hpAll'];
			$u->info['tactic7'] -= 2.50;

			mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`)
			VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');

			mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` )
			VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl8")');

			mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

			$msg = 'Восстановление Энергии +120';

			mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`)
			VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');

			$er = 'Успешно использован свиток "'.$msg.'"<br></b>(Осталось восстановлений: '.$abil['hl8'].' на сегодня)<b>';

			$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
			if(isset($lastHOD['id']))
			{
				$id_hod = $lastHOD['id_hod'];
				if($lastHOD['type'] != 6) $id_hod++;

				$txt = '{u1} '.($u->info['sex']==1 ? "использовала" : "использовал").' &quot;<b>'.$msg.'</b>&quot;. ['.intval($u->info['hpNow']).'/'.intval($u->info['hpAll']).']';
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`)
				VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
			}
		}
	}
	if($abil['hl8'] > 0 )
	{
	    $html .= '<img onclick="location.href=\'/main.php?clan&ability&hl8add\';" onMouseOver="top.hi(this,\'<b>Восстановление Энергии +120</b> (Осталось: '.$abil['hl8'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/cureHP120.gif">';
	}
		
    //Восстановление Энергии +600 ХП
	if( isset($_GET['hl10add']) && $abil['hl10'] > 0 )
	{
		$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
		$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
		if($u->info['hpNow']>=$u->stats['hpAll']) {
			$er = 'Вам незачем восстанавливать Энергию';
		}
		elseif($u->info['tactic7'] < 5 ) {
			$er = 'Недостаточно духа!';
		}elseif($u->info['hpNow'] < 0) {
			$er = 'Вы умерли...';
		}elseif(isset($bu['id'])) {
	        $er = 'Нельзя использовать свиток каждый ход...';
		}elseif($battle['noeff'] > 0 ) {
			$er = 'Запрет на использования свитков восстановления';
		}else{
			$abil['hl10']--;
			$u->info['hpNow'] += 600;
            if($u->info['hpNow']>$u->info['hpAll']) $u->info['hpNow']=$u->info['hpAll'];
			$u->info['tactic7'] -= 5;

			mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`)
			VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');

			mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` )
			VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl10")');

			mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

			$msg = 'Восстановление Энергии +600';

			mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`)
			VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');

			$er = 'Успешно использован свиток "'.$msg.'"<br></b>(Осталось восстановлений: '.$abil['hl10'].' на сегодня)<b>';

			$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
			if(isset($lastHOD['id']))
			{
				$id_hod = $lastHOD['id_hod'];
				if($lastHOD['type'] != 6) $id_hod++;
				
				$txt = '{u1} '.($u->info['sex']==1 ? "использовала" : "использовал").' &quot;<b>'.$msg.'</b>&quot;. ['.intval($u->info['hpNow']).'/'.intval($u->info['hpAll']).']';
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`)
				VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
			}
		}
	}
	if($abil['hl10'] > 0 )
	{
	    $html .= '<img onclick="location.href=\'/main.php?clan&ability&hl10add\';" onMouseOver="top.hi(this,\'<b>Восстановление Энергии +600</b> (Осталось: '.$abil['hl10'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/cureHP600.gif">';
	}
	
	//Восстановление манны +250 МР
	if( isset($_GET['hl2add']) && $abil['hl2'] > 0 )
	{
		$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
		$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
		if($u->info['mpNow']>=$u->stats['mpAll']) {
			$er = 'Вам незачем восстанавливать манну';
		}elseif($u->info['tactic7'] < 2.50 ) {
			$er = 'Недостаточно духа!';
		}elseif($u->info['hpNow'] < 0) {
			$er = 'Вы умерли...';
		}elseif(isset($bu['id'])) {
		    $er = 'Нельзя использовать свиток каждый ход...';
		}elseif($battle['noeff'] > 0 ) {
			$er = 'Запрет на использования свитков восстановления';
		}else{
			$abil['hl2']--;
			$u->info['mpNow'] += 250;
	        if($u->info['mpNow']>$u->info['mpAll']) $u->info['mpNow']=$u->info['mpAll'];
			$u->info['tactic7'] -= 2.50;

			mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`)
			VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');

			mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` )
			VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl2")');

			mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->info['mpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

			$msg = 'Восстановление манны +250 МР';

			mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`)
			VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');

			$er = 'Успешно использован свиток "'.$msg.'"<br></b>(Осталось восстановлений: '.$abil['hl2'].' на сегодня)<b>';

			$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
			if(isset($lastHOD['id']))
			{
				$id_hod = $lastHOD['id_hod'];
				if($lastHOD['type'] != 6) $id_hod++;

				$txt = '{u1} '.($u->info['sex']==1 ? "использовала" : "использовал").' &quot;<b>'.$msg.'</b>&quot;. ['.intval($u->info['mpNow']).'/'.intval($u->info['mpAll']).']';
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`)
				VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
			}
		}
	}
	if($abil['hl2'] > 0 )
	{
		$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl2add\';" onMouseOver="top.hi(this,\'<b>Восстановление манны +250</b> (Осталось: '.$abil['hl2'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/cureMana50.gif">';
	}

	//молча 15 минут
	/*if( isset($_GET['molch15add']) && $abil['molch15'] > 0 ) {
    	$abil['molch15']--;
		$user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_GET['molch15add']).'" LIMIT 1'));
    if($u->info['login']==$user['login']) {
		$er = 'Вы не можете использовать молчанку на себя!';
	}elseif($user['molch1'] > time()  ) {
	    $er = 'На персонаже уже есть заклятие молчания!';
	}elseif(!isset($user['id'])) {
		$er = 'Персонаж с логином &quot;'.htmlspecialchars($_GET['molch15add'],NULL,'cp1251').'&quot; не найден.';
	}else{
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","molch15")');
		mysql_query('UPDATE `users` SET `molch1` = "'.(time()+900).'" WHERE `login` = "'.mysql_real_escape_string($_GET['molch15add']).'" LIMIT 1 ');
		$er = 'Вы наказали молчанием персонажа <b> '.$u->microLogin($user['id'],1).'</b> сроком 15 минут <br> (Осталось: '.$abil['molch15'].' шт. на сегодня) ';
		$msg = '[img[items/silence15.gif]] Персонаж &quot;'.$u->info['login'].'&quot; наложил заклятие молчания на &quot;'.$user['login'].'&quot;, сроком 15 минут';
	    mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$msg."','".time()."','6','0','1')");		
		$ms = 'Молча 15 минут';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$ms.'","'.$u->info['id'].'")');
	}
}
	if($abil['molch15'] > 0 ) {
		$html .= '<img onclick="mod6();" onMouseOver="top.hi(this,\'<b>Заклятие молчания</b> (Осталось: '.$abil['molch15'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/n/silence15.gif">';
	}
	
	*/
	
	//выход из боя
	/*if( isset($_GET['exit_battle']) && $abil['exit_btl'] > 0 ) {
		$abil['exit_btl']--;
		$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
	if( $battle['dn_id'] > 0 || $battle['izlom'] > 0 ) {
		$er = '<font color=red><b>Магия не действует в пещерах и подобных локациях...</b></font>';	
	}elseif( $battle['noinc'] > 0 ) {
		$er = '<font color=red><b>Бой изолирован и вы не можете его покинуть</b></font>';	
	}elseif( $battle['clone'] > 0 ) {
		$er = '<font color=red><b>Невозможно покинуть поединок с клоном</b></font>';
	}elseif($u->info['battle']==0) {
		$er = 'Использовать можно только в поединке!';
	}else{
		mysql_query('UPDATE `stats` SET `battle_yron` = 0, `battle_exp` = 0,`tactic1` = 0 , `tactic2` = 0 , `tactic3` = 0 , `tactic4` = 0 , `tactic5` = 0 , `tactic6` = 0 , `tactic7` = -1 , `last_pr` = 0 , `last_hp` = -1 , `team` = 0, `old_battle` = "'.$u->info['battle'].'" WHERE `id` = '.$u->info['id'].' LIMIT 1');
		mysql_query('UPDATE `users` SET `battle` = "0", `lose` = `lose` + 1 WHERE `id` = '.$u->info['id'].' LIMIT 1');
		mysql_query('DELETE FROM `eff_users` WHERE `v1` = "priem" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0');
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","exit_btl")');
		$er = 'Вы сбежали с поля боя, ваши союзники насмехаются над вами...';
	}
}
	if($abil['exit_btl'] > 0 ) {
		$html .= '<img onclick="location.href=\'/main.php?clan&ability&exit_battle\';" onMouseOver="top.hi(this,\'<b>Выход из боя</b> (Осталось: '.$abil['exit_btl'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/n/retreat.gif">';
	}*/

	//Восстановление манны +1000 МР
	if( isset($_GET['hl11add']) && $abil['hl11'] > 0 )
	{
		$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
		$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
		if($u->info['tactic7'] < 5 ) {
			$er = 'Недостаточно духа!';
		}elseif($u->info['hpNow'] < 0) {
			$er = 'Вы умерли ...';
		}elseif($u->info['mpNow']>=$u->stats['mpAll']) {
			$er = 'Вам незачем восстанавливать манну';
		}elseif(isset($bu['id'])) {
		    $er = 'Нельзя использовать свиток каждый ход...';
		}elseif($battle['noeff'] > 0 ) {
			$er = 'Запрет на использования свитков восстановления';
		}else{
			$abil['hl11']--;
			$u->info['mpNow'] += 1000;
			if($u->info['mpNow']>$u->info['mpAll']) $u->info['mpNow']=$u->info['mpAll'];
			$u->info['tactic7'] -= 5;

			mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`)
			VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');

			mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` )
			VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl11")');

			mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->info['mpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

			$msg = 'Восстановление манны +1000 МР';

			mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`)
			VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');

			$er = 'Успешно использован свиток "'.$msg.'"<br></b>(Осталось восстановлений: '.$abil['hl11'].' на сегодня)<b>';

			$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
			if(isset($lastHOD['id']))
			{
				$id_hod = $lastHOD['id_hod'];
				if($lastHOD['type'] != 6) $id_hod++;

				$txt = '{u1} '.($u->info['sex']==1 ? "использовала" : "использовал").' &quot;<b>'.$msg.'</b>&quot;. ['.intval($u->info['mpNow']).'/'.intval($u->info['mpAll']).']';
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`)
				VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
			}
		}
	}
    if($abil['hl11'] > 0 )
	{
	    $html .= '<img onclick="location.href=\'/main.php?clan&ability&hl11add\';" onMouseOver="top.hi(this,\'<b>Восстановление манны +1000</b> (Осталось: '.$abil['hl11'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/cureMana1000.gif">';
    }
	
	//лечение травм
	if( isset($_GET['hl6add']) && $abil['hl6'] > 0 )
	{
		$abil['hl6']--;
		mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl6")');
		$travm = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid`="'.$u->info['id'].'" and `id_eff`="4" and `delete`="0" LIMIT 1'));
	    if($travm) {
			mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$travm['id'].'" LIMIT 1');
			$msg = 'Лечени травм';
			mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
			$er = 'Вы исцелились от "'.$travm['name'].'"</b><br>(Осталось лечений: '.$abil['hl6'].' на сегодня)';
		}else{
			$er = 'У вас нету травмы.';
		}
	}
	if($abil['hl6'] > 0 ) {
	if($u->info['battle'] > 0) {
	    $html .= '';
	}else{
		$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl6add\';" onMouseOver="top.hi(this,\'<b>Лечени травм</b> (Осталось: '.$abil['hl6'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/pal_buttond.gif">';
	}
}

	//уникальная тактика
	/* if( isset($_GET['hl7add']) && $abil['hl7'] > 0 )
	{
		$bu = mysql_fetch_array(mysql_query('SELECT * FROM `tactic` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
		if($u->info['battle'] == 0) {
		    $er = 'Использовать можно только в поединке!';
		}elseif(isset($bu['id'])) {
		    $er = 'Нельзя использовать свиток каждый ход...';
		}else{
			$abil['hl7']--;
			mysql_query('INSERT INTO `tactic` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
		    mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl7")');
	        mysql_query('UPDATE `stats` SET
				   `tactic1` = `tactic1` + 1,
				   `tactic2` = `tactic2` + 1,
				   `tactic3` = `tactic3` + 1,
				   `tactic4` = `tactic4` + 1,
				   `tactic5` = `tactic5` + 1,
				   `tactic6` = `tactic6` + 1 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		    $msg = 'Уникальную тактику +1';
			mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');

		    $er = 'Вы использовали Уникальную тактику +1';	}
	} */
	if($abil['hl7'] > 0 ) {
		$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl7add\';" onMouseOver="top.hi(this,\'<b>Уникальная тактика</b> (Осталось: '.$abil['hl7'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/invoke_tactics5.gif">';
	}
			
					
	//Колодцы 
	if( $abil['hpmp'] > 0 )
	{
		$hplast = $abil['hpmp'];
		$mplast = $abil['hpmp'];
		$hpcl = mysql_fetch_array(mysql_query('SELECT SUM(`val`) FROM `clan_ab` WHERE `var` = "hpvortex" AND `date` = "'.date('dmY').'" AND `clan` = "'.$u->info['clan'].'" LIMIT 1'));
		$hpcl = $hpcl[0];
		$mpcl = mysql_fetch_array(mysql_query('SELECT SUM(`val`) FROM `clan_ab` WHERE `var` = "mpvortex" AND `date` = "'.date('dmY').'" AND `clan` = "'.$u->info['clan'].'" LIMIT 1'));
		$mpcl = $mpcl[0];
		$hplast -= $hpcl;
		$mplast -= $mpcl;
	if(isset($_GET['hpvortex'])) {
	if($u->info['battle'] > 0) {
		$er = 'Невозможно использовать в поединке!';
	}
	elseif( $u->stats['hpNow'] >= $u->stats['hpAll'] ) {
		$er = 'Вам незачем восстанавливать здоровье (HP)';
 	}
	 elseif( $hplast > 0 )
	{
		$heal = round($u->stats['hpAll']-$u->stats['hpNow']);
	if( $heal > $hplast ) {
		$heal = $hplast;
	}
		$u->stats['hpNow'] += $heal;
		$hplast -= $heal;
		$er = 'Вы успешно восстановили '.$heal.' HP.';
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->stats['hpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ab` (`clan`,`var`,`val`,`uid`,`time`,`date`)
		VALUES ("'.$u->info['clan'].'","hpvortex","'.$heal.'","'.$u->info['id'].'","'.time().'","'.date('dmY').'")');
		$msg = 'Колодец жизни';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`)
		VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	} else {
		$er = 'Колодец исчерпал свои ресурсы, попробуйте завтра';
	}
}

	if(isset($_GET['mpvortex'])) {
	if($u->info['battle'] > 0) {
		$er = 'Невозможно использовать в поединке!';
	}elseif( $u->stats['mpNow'] >= $u->stats['mpAll'] ) {
		$er = 'Вам незачем восстанавливать ману (MP)';
	}elseif( $mplast > 0 ) {
		$heal = round($u->stats['mpAll']-$u->stats['mpNow']);
	if( $heal > $mplast ) {
		$heal = $mplast;
	}
		$u->stats['mpNow'] += $heal;
		$mplast -= $heal;
		$er = 'Вы успешно восстановили '.$heal.' MP.';
		mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->stats['mpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('INSERT INTO `clan_ab` (`clan`,`var`,`val`,`uid`,`time`,`date`)
		VALUES ("'.$u->info['clan'].'","mpvortex","'.$heal.'","'.$u->info['id'].'","'.time().'","'.date('dmY').'")');
		$msg = 'Колодец маны';
		mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$u->info['clan'].'","'.time().'","10","'.$u->info['login'].'","'.$msg.'","'.$u->info['id'].'")');
	}else{
		$er = 'Колодец исчерпал свои ресурсы, попробуйте завтра';
	}
  }
}
?>
<script>
function mod9() {
	top.win.add(
		'mod1panel',
		'Используем кровавое нападение',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod9back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod9back( login ) {
	location.href='/main.php?clan&ability&atckad='+login;
}
function mod8() {
	top.win.add(
		'mod1panel',
		'Используем нападение',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod8back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod8back( login ) {
	location.href='/main.php?clan&ability&atckadd='+login;
}
function mod7() {
	top.win.add(
		'mod1panel',
		'Заклятие молчания',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod7back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod7back( login ) {
	location.href='/main.php?clan&ability&molch30add='+login;
}
function mod6() {
	top.win.add(
		'mod1panel',
		'Заклятие молчания',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod6back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod6back( login ) {
	location.href='/main.php?clan&ability&molch15add='+login;
}


function abil1() {
	top.win.add(
		'abil1panel',
		'Помощь соклану &nbsp;',
		'<center><br>Введите логин соклана:<br><small>(Помогать можно только в нападениях)</small><br><br></center>',
		{
			'a1':'top.frames[\'main\'].abil1back(top.$(\'#abil1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#abil1v1\');top.$(\'#abil1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="abil1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
}
function abil1back( login ) {
	location.href='/main.php?clan&ability&brohelp='+login;
}
</script>
                <?
				
				//Помощь соклану и нападалки
				if(isset($_GET['brohelp']))
				{
					$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `clan` = "'.$u->info['clan'].'" AND `login` = "'.mysql_real_escape_string($_GET['brohelp']).'" ORDER BY `id` ASC LIMIT 1'));
					$b = mysql_fetch_array(mysql_query('SELECT `id`,`old_battle` FROM `stats` WHERE `id` = "'.$u->info['id'].'" AND `old_battle` > 0 LIMIT 1'));

					//Проверка на наличие общего врага
                    $result = mysql_query('SELECT `uid` FROM `battle_users` WHERE `battle` = "'.$usr['battle'].'" AND `hp`>=0');
					while($row = mysql_fetch_array($result))
					{
                        $trupojor = mysql_fetch_array(mysql_query('SELECT id FROM `users` WHERE `id`="'.$row['uid'].'" AND `no_ip` = "trupojor" LIMIT 1'));
						if(isset($trupojor['id'])) break;
					}

					if(isset($usr['id']) && isset($trupojor['id'])) $en_count = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_users` WHERE `battle` = "'.$usr['battle'].'" AND `hp`>=0 LIMIT 1'));
					else $en_count[0] = 0;

					//Ограничение количества нападающих на Общего врага
			        if(isset($trupojor['id']) && $en_count[0] >= $c['tj_maxplayers']+1)
					{
						$er = 'Общий враг занят. Станьте в очередь, пожалуйста!';
					}
					elseif($usr['battle'] == $b['old_battle'])
					{
			            $er = 'Невозможно вмешаться, вы уже были в этом поединке ;)';
					}elseif(isset($usr['id'])) {
						if( $u->info['battle'] > 0 ) {
							$er = 'Вы уже сражаетесь!';
						}elseif( $usr['room'] != $u->info['room'] ) {
							$er = 'Вы должны находиться в одной комнате.';
						}elseif( $usr['battle'] > 0 ) {
							$ubtl = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$usr['battle'].'" LIMIT 1'));
							$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_last` WHERE `uid` = "'.$u->info['id'].'" AND `battle_id` = "'.$usr['battle'].'" LIMIT 1'));
							if(!isset($ubtl['id'])) {
								$er = 'Поединок не найден!';
							}elseif(isset($test['id'])) {
								$er = 'Нельзя вмешаться, вы уже были в этом поединке.';
							}elseif($ubtl['team_win'] != -1) {
								$er = 'Поединок уже завершился!';
							}elseif($ubtl['razdel'] > 0 || $ubtl['dungeon'] > 0 || $ubtl['dn_id'] > 0 || $ubtl['izlom'] > 0){
								$er = 'Вмешиваться в турниры, пещерные бои и хаотичные поединки запрещено!';
							}else{
								//
								$usrst = mysql_fetch_array(mysql_query('SELECT `id`,`team` FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));
								//Обновляем НР и МР игрокам
								if($u->stats['level']<=7)
								{
									$u->info['tactic7'] = floor(20/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->stats['level']==8)
								{
									$u->info['tactic7'] = floor(30/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->stats['level']==9)
								{
									$u->info['tactic7'] = floor(50/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->stats['level']>=10)
								{
									$u->info['tactic7'] = floor(40/$u->stats['hpAll']*$u->stats['hpNow']);
								}
								
								// Бафф Зверя animal_bonus ---------------------------------
								if($u->info['animal'] > 0) {
									$a = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.$u->info['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
									if(isset($a['id'])) {
										if($a['eda']>=1) {
											$anl = mysql_fetch_array(mysql_query('SELECT `bonus` FROM `levels_animal` WHERE `type` = "'.$a['type'].'" AND `level` = "'.$a['level'].'" LIMIT 1'));
											$anl = $anl['bonus'];
											
											$tpa = array(1=>'cat',2=>'owl',3=>'wisp',4=>'demon',5=>'dog',6=>'pig',7=>'dragon');
											$tpa2 = array(1=>'Кота',2=>'Совы',3=>'Светляка',4=>'Чертяки',5=>'Пса',6=>'Свина',7=>'Дракона');
											$tpa3 = array(1=>'Кошачья Ловкость',2=>'Интуиция Совы',3=>'Сила Стихий',4=>'Демоническая Сила',5=>'Друг',6=>'Полная Броня',7=>'Инферно');
											
											mysql_query('INSERT INTO `eff_users` (`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`,`user_use`) VALUES ("-1","201","summon_pet_'.$tpa[$a['type']].'.gif",22,"'.$u->info['id'].'","'.$tpa3[$a['type']].' ['.$a['level'].']","'.$anl.'","0","77","priem","'.$u->info['id'].'")');
											
										}else{
											$u->send('',$u->info['room'],$u->info['city'],'',$u->info['login'],'<b>'.$a['name'].'</b> нуждается в еде...',time(),6,0,0,0,1);
										}
									}
								}
								//Духовность, спасение
								if( $u->stats['s7'] > 49 ) {
									mysql_query("
										INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
										( 22, '".$u->stats['id']."', 'Спасение', 'add_spasenie=1', 0, 77, 0, '".$u->stats['id']."', 0, 'priem', 324, 'preservation.gif', 1, -1, 'спасение', 0, 0, '', 0, 0, 0, 1, 0);
									");
								}					
								//
								mysql_query('UPDATE `users` SET `battle` = "'.$ubtl['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								mysql_query('UPDATE `stats` SET `team` = "'.$usrst['team'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								//
								$u->info['battle'] = $usr['battle'];
								$u->info['team'] = $usrst['team'];

								$btxt = '';
								if( $u->info['align'] > 0 ) {
									$btxt = $btxt.'<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif >';
								}
								if( $u->info['align2'] > 0 ) {
									$btxt = $btxt.'<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$u->info['align2'].'.gif >';
								}
								if( $u->info['clan'] > 0 ) {
									$btxt = $btxt.'<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$u->info['clan'].'.gif >';
								}
								$btxt = $btxt.'<b>{u1}</b>['.$u->info['level'].']<a href=info/'.$u->info['id'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_capitalcity.gif ></a>';
								if( $u->info['sex'] == 1 ) {
									$btxt = $btxt.' вмешалась в поединок.';
								}else{
									$btxt = $btxt.' вмешался в поединок.';
								}
								$btxt .= ' (Помощь соклану <b>'.$usr['login'].'</b>['.$usr['level'].'])';

								$magic->inBattleLog($btxt,$usr);
								//
								$er = 'Вы успешно вмешались за соклана &quot;'.$usr['login'].'&quot;! (Страница обновится автоматически)';
							}
						}else{
							$er = 'Соклан не находится в поединке!';
						}
					}else{
						$er = 'Соклан с логином &quot;'.htmlspecialchars($_GET['brohelp']).'&quot; не найден.';
					}
				}
				
				
				$html .= '<img onclick="abil1();" onMouseOver="top.hi(this,\'<b>Помощь соклану</b> (Бесконечно)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/n/mirror.gif"> ';
				//
				if( $hplast < 1 ) {
					$html .= '<img class="pwqnovice" onMouseOver="top.hi(this,\'Абилка закончилась, попробуйте <b>позже</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/items/n/healvortex.gif"> ';
				}else{
					$html .= '<img onclick="location.href=\'/main.php?clan&ability&hpvortex\';" class="cp" onMouseOver="top.hi(this,\'Восстановить Здоровье (HP). Осталось: <b>'.$hplast.' HP</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/items/n/healvortex.gif"> ';
				}
				if( $mplast < 1 ) {
					$html .= '<img class="pwqnovice" onMouseOver="top.hi(this,\'Абилка закончилась, попробуйте <b>позже</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/items/n/manavortex.gif"> ';
				}else{
					$html .= '<img onclick="location.href=\'/main.php?clan&ability&mpvortex\';" class="cp" onMouseOver="top.hi(this,\'Восстановить Ману (HP). Осталось: <b>'.$mplast.' MP</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/items/n/manavortex.gif"> ';
				}
		   }
			
					
			if($tt[15][0] == 0) {
				$html = 'У вашего клана нет абилок, или глава клана запретил вам их использовать ';
			}
			if($er != '') {
				echo '<div style="padding-bottom:10px;"><b><font color=red>'.$er.'</font></b></div>';
			}
			echo $html;
			unset($html);
			?>
        </fieldset>
   
   
   <? }elseif(isset($_GET['control'])) { ?> 
   <script>
	function changeLogin(selObj){
	  selid = selObj.options[selObj.selectedIndex].value;
	  $('#sn_titul').val($('#slg'+selid).attr('vtitul'));
	  $('#sn_zvanie').val($('#slg'+selid).attr('vzvanie'));
	  $('#sn_canals').val($('#slg'+selid).attr('vcanals'));
	  
	  if($('#slg'+selid).attr('vtitul') == 'глава клана') {
		  $('#rp_titul').attr({'disabled':'disabled'});
		  $('#sn_zvanie').attr({'disabled':'disabled'});
		  $('#sn_canals').attr({'disabled':'disabled'});
		  $('#rp_save').attr({'disabled':'disabled'});
	  }else{
		  $('#rp_titul').attr({'disabled':false});
		  $('#sn_zvanie').attr({'disabled':false});
		  $('#sn_canals').attr({'disabled':false});
		  $('#rp_save').attr({'disabled':false});
	  }
	}
   </script>
   <div class="box visible">
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
		Тип управления кланом: <a href="javascript:void(0)"><? if($res['politic'] == 1) { ?>Диктатура<? }else{ ?>Демократия<? } ?></a>
    </div><br>
	 <td width="15%">
		<? $clan_inf = mysql_fetch_array(mysql_query('SELECT * FROM `clan_info` WHERE `id` = "'.$res['id'].'"')); 
    	if(!isset($clan_inf['id'])){
    		$clan_inf['info'] = '';
    		$clan_inf['deviz'] = '';
    		$upd = mysql_query('INSERT INTO `clan_info` (`id`,`info`, `deviz`) VALUES ("'.$res['id'].'", "", "")');
    	}
    	if(isset($_POST['clans_inf'])){
    		$upd = mysql_query('UPDATE `clan_info` SET `info`="'.mysql_real_escape_string($_POST['clan_info']).'", `deviz`="'.mysql_real_escape_string($_POST['clan_deviz']).'" WHERE `id` = "'.$res['id'].'" ');
    		if($upd){
    			echo '<b><font color=red>Информация о клане успешно обновлена.</font></b>';
    			$clan_inf = mysql_fetch_array(mysql_query('SELECT * FROM `clan_info` WHERE `id` = "'.$res['id'].'"')); 
    		}
    	}
    	?>
    <form method="post" action="">
    	<b>Девиз клана:</b><br>
    	<input class="form-control" name="clan_deviz" type="text" value="<?=$clan_inf['deviz']?>" size="50" maxlength="104" /><input  name="clans_inf" type="submit" value="Сохранить">
    </form>
		</td>
    <?
	$c_pr = array(
		30, //принять
		0, //выгнать
		0 //сменить главу
	);
 
	if(isset($_POST['svb_give_money']) && $tt[7][0] == 1) {
		$mn = round((int)$_POST['svb_give_money'],2);
		if($mn >= 0.01) {
			if($res['money1'] < $mn) {
				echo '<font color="#FF0000"><b>В клане недостаточно средств</b></font><br>';
			}else{
				$res['money1'] -= $mn;
				$u->info['money'] += $mn;
				echo '<font color="#FF0000"><b>Вы успешно сняли с казны клана '.$mn.' кр.</b></font><br>';
				mysql_query('UPDATE `clan` SET `money1` = "'.mysql_real_escape_string($res['money1']).'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `money` = "'.mysql_real_escape_string($u->info['money']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$res['id'].'","'.time().'","1","'.$u->info['login'].'","'.mysql_real_escape_string($mn).'","'.$u->info['id'].'")');
			}
		}
	}elseif(isset($_POST['svb_take_money']) && $tt[6][0] == 1) {
		$mn = round((int)$_POST['svb_take_money'],2);
		if($mn >= 0.01) {
			if($u->info['money'] < $mn) {
				echo '<font color="#FF0000"><b>У вас недостаточно средств</b></font><br>';
			}else{
				$res['money1'] += $mn;
				$u->info['money'] -= $mn;
				echo '<font color="#FF0000"><b>Вы успешно положили в казну клана '.$mn.' кр.</b></font><br>';
				mysql_query('UPDATE `clan` SET `money1` = "'.mysql_real_escape_string($res['money1']).'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `money` = "'.mysql_real_escape_string($u->info['money']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$res['id'].'","'.time().'","2","'.$u->info['login'].'","'.mysql_real_escape_string($mn).'","'.$u->info['id'].'")');
			}
		}
	}elseif(isset($_POST['invite']) && ($_POST['invite'] == 'Пригласить' || $_POST['invite'] == 'Выгнать' || $_POST['invite'] == 'Назначить') && $tt[11][0] == 1) {
		if($_POST['invite'] == "Выгнать" && $tt[10][0] == 1) {
			$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
			//$ttus = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.$usr['clan_prava'].'" LIMIT 1'));
			if(!isset($usr['id'])) {
				echo '<font color="#FF0000"><b>Игрок не найден в клане.</b></font><br>';
			} elseif($tt['prioritet'] >= $utitl['prioritet']) {
				echo '<font color="#FF0000"><b>Игрок старше вас по званию, либо звания совпадают.</b></font><br>';
			} elseif($res['money1'] < $c_pr[1]) {//$u->info['money']
				echo '<font color="#FF0000"><b>У вас не достаточно кр. для исключения игрока из клана (Требуется: '.$c_pr[1].' кр.)</b></font><br>';
			}elseif($usr['clan_prava'] == 'glava' ) {
		     	echo '<font color="#FF0000"><b>Вы не можете выгнать главу клана.</b></font><br>';
			}elseif($usr['id'] == $u->info['id']) {
				echo '<font color="#FF0000"><b>Вы не можете выгнать самого себя.</b></font><br>';
			}else {
			  	$ar = $u->rem_itm_cl($usr, $res['id'], 8);
              	$clan_delay = time() + 86400 * 3;
				mysql_query('UPDATE `users` SET `clan_delay` = "'.$clan_delay.'", `palpro` = 0, `clan_prava` = 0, `clan` = 0, `mod_zvanie` = "", `align` = 0 WHERE `id` = "'.$usr['id'].'" LIMIT 1');
                $res['money1'] -= $c_pr[1];
                mysql_query('UPDATE `clan` SET `money1` = "'.$res['money1'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
				//$u->info['money'] -= $c_pr[1];
				//mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$c_r .= '<font color="#FF0000"><b>Игрок &quot;'.$usr['login'].'&quot; был исключен из клана за '.$c_pr[1].' кр.</b></font><br>'; 
				$txt = 'Игрок <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="info/'.$u->info['id'].'"><img src="//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif"></a> исключил из клана игрока <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="info/'.$usr['id'].'"><img src="//img.testcombats.ru/i/inf_'.$usr['cityreg'].'.gif"></a>';
				mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
				"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","'.mysql_real_escape_string($txt).'"
				)');
			}
		}elseif($_POST['invite'] == "Назначить" && $u->info['clan_prava'] == 'glava') {
			$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" AND `clan` = "'.$res['id'].'" AND `banned` = "0" LIMIT 1'));
			if(!isset($usr['id'])) {
				echo '<font color="#FF0000"><b>Игрок не найден в клане.</b></font><br>';
			}elseif($u->info['money'] < $c_pr[2]) {
				echo '<font color="#FF0000"><b>У вас не достаточно кр. для назначения игрока на пост главы клана (Требуется: '.$c_pr[2].' кр.).</b></font><br>';
			}elseif($usr['clan_prava'] == 'glava') {
				echo '<font color="#FF0000"><b>Игрок уже является главой клана.</b></font><br>';
			}else{
				mysql_query('UPDATE `users` SET `clan_prava` = "glava", `clan` = "'.$res['id'].'", `mod_zvanie` = "Глава клана", `align` = "'.$res['align'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
				$u->info['money'] -= $c_pr[2];
				mysql_query('UPDATE `users` SET `clan_prava` = "2", `mod_zvanie` = "новичок", `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$c_r .= '<font color="#FF0000"><b>Игрок &quot;'.$usr['login'].'&quot; был назначен главой клан за '.$c_pr[0].' кр.</b></font><br>'; 
				$txt = 'Игрок <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="info/'.$u->info['id'].'"><img src="//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif"></a> назначил игрока <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="info/'.$usr['id'].'"><img src="//img.testcombats.ru/i/inf_'.$usr['cityreg'].'.gif"></a> на должность <b>Главы клана</b>';
				mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
				"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","'.mysql_real_escape_string($txt).'"
				)');
			}
		}elseif($_POST['invite'] == "Пригласить" && $tt[9][0] == 1)
		{
			$is_cl = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `users` WHERE `clan` = '".$res['id']."'"));
            $usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));// AND `clan` != "'.$res['id'].'"
			
			if($usr['clan_delay']>time()) {
				echo '<font color="#FF0000"><b>У персонажа запрет на вступление в кланы ещё: '.$u->timeOut($usr['clan_delay']-time()).'</b></font><br>';
			} elseif(!isset($usr['id'])) {
				echo '<font color="#FF0000"><b>Подходящий игрок не найден, либо не прошел проверку на чистоту.</b></font><br>';
			}elseif($usr['clan_prava'] == 'glava') {
				echo '<font color="#FF0000"><b>Игрок уже является главой клана.</b></font><br>';
			}elseif($usr['palpro'] < time()) {
				echo '<font color="#FF0000"><b>Игрок должен пройти проверку у паладинов.</b></font><br>';
			}elseif($res['money1'] < $c_pr[0]) {//$u->info['money']
				echo '<font color="#FF0000"><b>У вас не достаточно кр. для приема игрока в клан (Требуется: '.$c_pr[0].' кр.).</b></font><br>';
			}elseif($usr['clan'] != '0' || $usr['align'] != '0') {
				echo '<font color="#FF0000"><b>Персонаж уже находится в клане, либо имеет склонность.</b></font><br>';
            } elseif($is_cl[0] >= $lvl_prava[$res['level']][0]) {
                echo '<font color="#FF0000"><b>Достигнут лимит приглашений. Повысте уровень клана.</b></font><br>';
			}else{
				
				$test = mysql_fetch_array(mysql_query('SELECT * FROM `clan_add` WHERE `uid` = "'.$usr['id'].'" AND `clan` = "'.$res['id'].'" AND `yes` = 0 AND `no` = 0 LIMIT 1'));
				if( isset($test['id']) )
				{
					if( $test['yes'] == 0 && $test['no'] == 0 ) {
						echo '<font color="#FF0000"><b>Персонаж &quot;'.$usr['login'].'&quot; еще не решил вступать в клан &quot;'.$res['name'].'&quot; или нет.</b></font><br>';
					}
				}else{
					echo '<font color="#FF0000"><b>Персонажу &quot;'.$usr['login'].'&quot; отправлено приглашение на вступление в клан.</b></font><br>';
					mysql_query('INSERT INTO `clan_add` ( `uid`,`uid_clan`,`time`,`clan` ) VALUES ("'.$usr['id'].'","'.$u->info['id'].'","'.time().'","'.$res['id'].'")');
				}
			}	
		}
	}
	?>
    <? if($tt[9][0] > 0) { ?>
    <div>
	<input style="width:144px;" value="Пригласить в клан" onClick="openMod('<b>Пригласить игрока в клан</b>','<form action=\'main.php?clan&control&priem\' method=\'post\'>Логин: <input type=\'text\' style=\'width:90px;\' id=\'logingo\' name=\'logingo\'><input type=\'submit\' name=\'invite\' value=\'Пригласить\'></form><br>');" type="button" /> 
	(это вам обойдется в <?=$c_pr[0]?><b> кр.</b>)<br />
    (перед приемом в клан, персонаж должен пройти проверку у паладинов)<br />
    </div>
    <? } ?>
    <? if($tt[10][0] > 0) { ?>
    <div>
	<input type="button" style="width:144px;" value="Выгнать из клана" onClick="openMod('<b>Выгнать игрока из клана</b>','<form action=\'main.php?clan&control&unpriem\' method=\'post\'>Логин: <input type=\'text\' style=\'width:90px;\' id=\'logingo\' name=\'logingo\'><input type=\'submit\' name=\'invite\' value=\'Выгнать\'></form><br>');"> 
    (это вам обойдется в <?=$c_pr[1]?><b> кр.</b>)<br />
    </div>
    <? } ?>
    <? if($u->info['clan_prava'] == 'glava') { ?>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
	<input style="width:144px;" value="Сменить главу клана" onClick="openMod('<b>Назначить главу клана</b>','<form action=\'main.php?clan&control&newglava\' method=\'post\'>Логин: <input type=\'text\' style=\'width:90px;\' id=\'logingo\' name=\'logingo\'><input  type=\'submit\' name=\'invite\' value=\'Назначить\'></form><br>');" type="button" /> (глава клана вправе сложить с себя полномочия, назначив главой клана другого персонажа)<br />
	</div>
    <? } ?>
    <? if($tt[11][0] > 0) { ?>
    <fieldset>
      <legend><span class="legtitle">Редактирование статуса персонажа</span></legend>
      <?
	  if(isset($_GET['saveuser']) && $tt[11][0] == 1) {
		 //[rp_login] => 0 [rp_titul] => 0 [rp_zvanie] => [rp_canals] => 
		 $c_r = '';
		 $usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['rp_login']).'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
		 if(isset($usr['id'])) {
			 if($usr['clan_prava'] != 'glava') {
			 	$tt = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.$usr['clan_prava'].'" LIMIT 1'));
				if($tt['prioritet'] < $utitl['prioritet']) {
					//новый титул
					if((int)$_POST['rp_titul'] > 0) {
						$tt_new = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.mysql_real_escape_string($_POST['rp_titul']).'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
						if(isset($tt_new['id'])) {
							if($tt_new['prioritet'] < $utitl['prioritet']) {
								mysql_query('UPDATE `users` SET `clan_prava` = "'.$tt_new['id'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
								$c_r .= '<font color="#FF0000"><b>Игроку &quot;'.$usr['login'].'&quot; был присвоен титул &quot;'.$tt_new['name'].'&quot;</b></font><br>'; 
								if($tt_new['prioritet'] < $tt['prioritet']) {
									//понижен
									$txt = 'Игрок <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif"></a> понизил титул игроку <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="inf.php?'.$usr['id'].'"><img src="//img.testcombats.ru/i/inf_'.$usr['cityreg'].'.gif"></a> до &quot;<b>'.$tt_new['name'].'</b>&quot;';
								}else{
									//присвоен
									$txt = 'Игрок <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="//img.testcombats.ru/i/inf_'.$u->info['cityreg'].'.gif"></a> присвоил титул &quot;<b>'.$tt_new['name'].'</b>&quot; игроку <img src="//img.testcombats.ru/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="//img.testcombats.ru/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="inf.php?'.$usr['id'].'"><img src="//img.testcombats.ru/i/inf_'.$usr['cityreg'].'.gif"></a>';
								}
								
								mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
								"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","'.mysql_real_escape_string($txt).'"
								)');
								
							}else{
								$c_r .= '<font color="#FF0000"><b>Вы не можете назначать титул старше вашего титула</b></font><br>'; 
							}
						}
					}
					mysql_query('UPDATE `users` SET `mod_zvanie` = "'.mysql_real_escape_string($_POST['rp_zvanie']).'",`ccanals` = "'.mysql_real_escape_string($_POST['rp_canals']).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
					$c_r .= '<font color="#FF0000"><b>Информация успешно сохранена</b></font><br>';					
					
				}else{
					$c_r .= '<font color="#FF0000"><b>Игрок старше вас по званию, либо звания совпадают</b></font><br>'; 
				}
			 }else{
				$c_r .= '<font color="#FF0000"><b>Игрок старше вас по званию, либо звания совпадают</b></font><br>'; 
			 }
		 }else{
			 $c_r .= '<font color="#FF0000"><b>Игрок не состоит в клане '.$res['name'].'</b></font><br>';  
		 }
	  }
	  echo $c_r;
	  ?>
      <form method="post" action="main.php?clan&control&saveuser">
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Логин:</div><select onchange="changeLogin(this);" style="width:211px;" name="rp_login">
      <option value="0" style="color:#CCCCCC">выберите логин</option>
	  <?
      $sp = mysql_query('SELECT `id`,`login`,`clan_prava`,`ccanals`,`mod_zvanie` FROM `users` WHERE `clan` = "'.$res['id'].'"');
	  while($pl = mysql_fetch_array($sp)) {
		  $cp = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.mysql_real_escape_string($pl['clan_prava']).'" LIMIT 1'));
		  if($pl['clan_prava'] == 'glava') {
			 $cp['name'] = 'глава клана'; 
		  }
		  echo '<option id="slg'.$pl['id'].'" value="'.$pl['id'].'" vtitul="'.$cp['name'].'" vzvanie="'.$pl['mod_zvanie'].'" vcanals="'.$pl['ccanals'].'">'.$pl['login'].'</option>';
	  }
	  ?></select>
      </div>
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Звание в клане:</div><input style="width:211px;" id="sn_zvanie" name="rp_zvanie" type="text" />
      </div>
      <div>
      <!--div style="display:inline-block;width:150px;">Каналы чата:</div><input style="width:211px;" id="sn_canals" name="rp_canals" type="text" /><br />
      <small>(Перепешите через запятую номера доступных каналов. Например: 1,3,7. Доступные каналы: 1-9)</small--> <input  name="Отправить" type="submit" id="rp_save" value="Сохранить" />
      </div>
      </form>
    </fieldset>
      <? } ?>
    <? if($tt[5][0] == 1) { ?>
    <fieldset>
      <legend><span class="legtitle">Казна клана</span></legend>
      <form method="post" action="?clan&control&give_money">
      Деньги в казне клана: <?=$res['money1']?> кр. <? if($res['money2'] > 0) { ?><br />
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?=$res['money2']?> екр. <input type="button" value="Список операций" /><? } ?><br />
      <? if($tt[7][0] > 0) { ?>
      Забрать из казны: <input id="svb_give_money" name="svb_give_money" value="0" type="text" /> <input type="submit" value=">>" />
      <? } ?>
      </form>
      <? if($tt[6][0] > 0) { ?>
      <form method="post" action="?clan&control&take_money">
      <div style="border-top:1px solid #cac9c7;margin-top:5px;padding-top:5px;">
      Положить деньги в казну: <input id="svb_take_money" name="svb_take_money" value="0" type="text" /> <input type="submit" value=">>" />
      <small>(при себе: <?=$u->info['money']?>кр.)</small>
      </div>
      </form>
      <? } ?>
    </fieldset>
	<? } ?>
      <? if($tt[11][0] > 0 && $tt[3][0] == 1) { ?>
      <form method="post" action="?clan&control#vipiska">
      <div style="margin-top:5px;padding-top:5px;">
      Заказать выписку для хранилища: <small>(услуга стоит 1кр.)</small> <input id="svb_vipiska" name="svb_vipiska" value="<?=date('d.m.Y')?>" type="text" /> <input  type="submit" value="Заказать" />
      </div>
      </form>
      <? } ?>
      <?php if(isset($_POST['svb_vipiska'])){
		$sees = '';
		$t = 0;
		$updates = mysql_query('UPDATE `users` SET `money` = `money` - 1 WHERE `id` = "'.$u->info['id'].'"');
		if($updates){
			$dsee['t1'] = strtotime($_POST['svb_vipiska'].' 00:00:00');
			$dsee['t2'] = strtotime($_POST['svb_vipiska'].' 23:59:59');
			$sp1 = mysql_query('SELECT * FROM `clan_operations` WHERE  `clan` = "'.$res['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` ASC LIMIT 10000');
			echo '<div id="vipiska"><hr/>';
			echo '<h3 style="color: #8f0000; text-align: left;">Выписка за '.$_POST['svb_vipiska'].'</h3>';
			echo '<hr/>';
			while($pl1 = mysql_fetch_array($sp1))
			{
				$t = 1;
				$pl1['text'] = ' Персонаж '.$pl1['text'].' ';
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
				}else{
					$pl1['text'] .= '<u>Незивестная ошибка. Код: '.$pl1['val'].' / '.$pl1['type'].'</u>';
				}
				$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl1['time']).' / <b style="color:green">Выписка клана</b>:</small>'.$pl1['text'].' '.$dseetext;
				$dsee['dv'] .= '<br>';
				$dseetext="";
			}
			if($t == 0) {
				echo '<font color="red"><b>Действий за <B>'.$_POST['svb_vipiska'].'</B> не найдено.</b></font><br><br></div>';
			}else{
				echo $dsee['dv'].'</div>';
			}
		}
	}?>
   </div> 
   <?
   }elseif(isset($_GET['diplom']) && $tt[12][0] == 1) {
	
	if($tt[14][0] == 1){
		if(isset($_GET['clanwars'])) {
			//RadioGroup1
			$cln = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `name` = "'.mysql_real_escape_string($_POST['logingo']).' " OR `name` = " '.mysql_real_escape_string($_POST['logingo']).' " OR `name` = "'.mysql_real_escape_string($_POST['logingo']).'" OR `name` = " '.mysql_real_escape_string($_POST['logingo']).'" OR `name_mini` = "'.mysql_real_escape_string($_POST['logingo']).'" OR `name_rus` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
			if(isset($cln['id'])) {
				if($cln['id'] == $res['id']) {
					
					$rn = array(
					'<font color="#FF0000"><b>Остроумно, но здесь так делать нельзя :-)</b></font><br>',
					'<font color="#FF0000"><b>Это будет очень сложно сделать, Ваши сокланы против!</b></font><br>',
					'<font color="#FF0000"><b>Не уподобляйтесь большинству, защищайте интересы своего клана!</b></font><br>');					
					echo $rn[rand(0,2)];				
				}elseif($cln['join1'] == $res['join1'] && $res['join1'] > 0) {
					echo '<font color="#FF0000"><b>Вы состоите в союзе с этим кланом</b></font><br>';				
				}elseif($cln['join2'] == $res['join2'] && $res['join2'] > 0) {
					echo '<font color="#FF0000"><b>Вы состоите в альянсе с этим кланом</b></font><br>';		
				}else{
					$lwar = mysql_fetch_array(mysql_query('SELECT * FROM `clan_wars` WHERE `time_finish` > '.time().' AND ((`clan1` = "'.$cln['id'].'" AND `clan2` = "'.$res['id'].'") OR (`clan2` = "'.$cln['id'].'" AND `clan1` = "'.$res['id'].'")) LIMIT 1 '));
					if(!isset($lwar['id'])) {
						$mkr = 100; $tpcw = 1;
						if($_POST['RadioGroup1'] == 2) {
							$mkr = 300; $tpcw = 2;
						}
						/*if( true == true ) {
							echo '<font color="#FF0000"><b>Нельзя обьявить войну прямо сейчас</b></font><br>';
						}else*/if($mkr > $res['money1']) {
							echo '<font color="#FF0000"><b>В казне клана не достаточно средств</b></font><br>';
						}else{
							mysql_query('UPDATE `clan` SET `money1` = `money1` - '.$mkr.' WHERE `id` = "'.$res['id'].'" LIMIT 1');
							mysql_query('INSERT INTO `clan_wars` (`clan1`,`clan2`,`time_start`,`time_finish`,`type`,`text`) VALUES ("'.$res['id'].'","'.$cln['id'].'","'.time().'","'.(time()+60*60*24*1).'","'.$tpcw.'","Война!")');
							mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$res['id'].'","'.time().'","4","'.$u->info['login'].'","clanwar_'.$mkr.'_'.$cln['id'].'","'.$u->info['id'].'")');
							echo '<font color="#FF0000"><b>Вы успешно объявили войну клану &quot;'.$cln['name'].'&quot; за '.$mkr.' кр.</b></font><br>';
						}
					}else{
						echo '<font color="#FF0000"><b>Вы уже ведете войну с данным кланом</b></font><br>';
					}
				}
			}else{
				echo '<font color="#FF0000"><b>Клан с таким названием не найден</b></font><br>';
			}
		}
	}
	
   ?>
    <br /><br />
    <fieldset>
      <legend><span class="legtitle">Клановые войны</span></legend>
      <? if($tt[14][0] == 1){ ?>
      <input onClick="openMod('<b>Объявить войну клану</b>','<form action=\'main.php?clan&diplom&clanwars\' method=\'post\'>Название клана: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br><label><input type=\'radio\' name=\'RadioGroup1\' value=\'1\' id=\'RadioGroup1_0\'>Обычная война (100 кр.)</label><br><span style=\'float:left\'><label><input type=\'radio\' name=\'RadioGroup1\' value=\'2\' id=\'RadioGroup1_1\'>Кровавая война (300кр.)</label></span><input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" type="submit" name="button" id="button" value="Начать войну" />
      <? } ?>
      <br />
      <div style="border:1px solid #CECECE;padding:10px;">
      <?
	  $ms = '';
	  $sp = mysql_query('SELECT * FROM `clan_wars` WHERE (`clan1` = "'.$res['id'].'" OR `clan2` = "'.$res['id'].'") AND `time_finish` > "'.time().'"');
	  while($pl = mysql_fetch_array($sp)) {
		  $cln1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['clan1'].'" LIMIT 1'));
		  $cln2 = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['clan2'].'" LIMIT 1'));
		  $ms .= '<div style="border:1px solid #CECECE;padding:10px;">Война между кланами <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$cln1['name_mini'].'.gif">'.$cln1['name'].'</b> и <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$cln2['name_mini'].'.gif">'.$cln2['name'].'</b>.<br>';
		  if($pl['text'] != '') {
			$ms .= 'Причина войны: <i>'.$pl['text'].'</i><br>';  
		  }
		  $ms .= 'Время войны: '.date('d.m.Y H:i',$pl['time_start']).' - '.date('d.m.Y H:i',$pl['time_finish']).'</div>';
	  }
	  if($ms == '') {
	  ?>
      	В данный момент Ваш клан не ведет войн.
      <?
	  }else{
		 echo $ms; 
	  }
	  ?>
      </div>
    </fieldset>
  <fieldset>
    <legend><span class="legtitle">Союзы</span></legend>
      <? if($tt[13][0] == 1) {
	  if(isset($_GET['joint']) && $tt[13][0] == 1) {
		  if($_GET['joint'] == 1) {
			 //вступление в союз
			  $nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
			  $cnm = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" AND `type` = "1" LIMIT 1'));
			  if(isset($cnm['id'])) {
				$cnmz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$cnm['id'].'" AND `clan` = "'.$res['id'].'" AND `time_end` = "0" AND `time_start` = "0" AND `type` = "1" LIMIT 1'));
				if(isset($cnmz['id'])) {
					echo '<font color="#FF0000"><b>Ваш клан уже подал заявку в данный союз</b></font><br>';
				}elseif($res['join1'] > 0) {
					echo '<font color="#FF0000"><b>Ваш клан уже находится в союзе</b></font><br>'; 
				}else{
					mysql_query('UPDATE `clan` SET `join1` = "'.$cnm['id'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
					echo '<font color="#FF0000"><b>Вы успешно подали заявку в союз &quot;'.$cnm['name'].'&quot;</b></font><br>';
					mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$cnm['id'].'","'.time().'","1")');
				}
			  }else{
				 echo '<font color="#FF0000"><b>Альянс или союз с такиим названием не существует</b></font><br>'; 
			  }
		  }else{
			 //вступление в альянс
			  $nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
			  $cnm = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" AND `type` = "2" LIMIT 1'));
			  if(isset($cnm['id'])) {
				$cnmz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$cnm['id'].'" AND `clan` = "'.$res['id'].'" AND `time_end` = "0" AND `time_start` = "0" AND `type` = "2" LIMIT 1'));
				if(isset($cnmz['id'])) {
					echo '<font color="#FF0000"><b>Ваш клан уже подал заявку в данный альянс</b></font><br>';
				}elseif($res['join1'] == 0) {
					echo '<font color="#FF0000"><b>Для вступления в альянс требуется вступить в союз</b></font><br>'; 
				}elseif($res['join2'] > 0) {
					echo '<font color="#FF0000"><b>Ваш клан уже находится в альянсе</b></font><br>'; 
				}else{
					mysql_query('UPDATE `clan` SET `join1` = "'.$cnm['id'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
					echo '<font color="#FF0000"><b>Вы успешно подали заявку в альянс &quot;'.$cnm['name'].'&quot;</b></font><br>';
					mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$cnm['id'].'","'.time().'","2")');
				}
			  }else{
				 echo '<font color="#FF0000"><b>Альянс или союз с такиим названием не существует</b></font><br>'; 
			  }
		  }
	  }elseif(isset($_GET['newjoint']) && $tt[13][0] == 1) {
		if($_GET['newjoint'] == 1) {
			//союзы
			if($res['join1'] > 0) {
				echo '<font color="#FF0000"><b>Ваш клан уже состоит в союзе</b></font><br>';
			}else{
				$nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
				if(str_replace(' ','',str_replace('	','',$nm)) == '') {
					echo '<font color="#FF0000"><b>Введите название союза</b></font><br>';
				}else{
					$cnm = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" LIMIT 1'));
					if(!isset($cnm['id'])) {
						mysql_query('INSERT INTO `clan_joint` (`time_open`,`name`,`type`,`clan_open`,`clan_glava`) VALUES ("'.time().'","'.mysql_real_escape_string($nm).'","1","'.$res['id'].'","'.$res['id'].'")');
						$id = mysql_insert_id();
						$res['join1'] = $id;
						mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`,`time_start`) VALUES ("'.$res['id'].'","'.$id.'","'.time().'","1","'.time().'")');
						mysql_query('UPDATE `clan` SET `join1` = "'.$id.'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
						echo '<font color="#FF0000"><b>Вы успешно создали союз &quot;'.$nm.'&quot;</b></font><br>';
					}else{
						echo '<font color="#FF0000"><b>Альянс или союз с такиим названием уже существует</b></font><br>';
					}
				}
			}
		}else{
			//альянсы
			if($res['join1'] == 0) {
				echo '<font color="#FF0000"><b>Ваш клан должен состоять в союзе</b></font><br>';
			}elseif($res['join2'] > 0) {
				echo '<font color="#FF0000"><b>Ваш клан уже состоит в альянсе</b></font><br>';
			}else{
				$nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
				if(str_replace(' ','',str_replace('	','',$nm)) == '') {
					echo '<font color="#FF0000"><b>Введите название альянса</b></font><br>';
				}else{
					$cnm = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" LIMIT 1'));
					if(!isset($cnm['id'])) {
						mysql_query('INSERT INTO `clan_joint` (`time_open`,`name`,`type`,`clan_open`,`clan_glava`) VALUES ("'.time().'","'.mysql_real_escape_string($nm).'","2","'.$res['id'].'","'.$res['id'].'")');
						$id = mysql_insert_id();
						$res['join2'] = $id;
						mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`,`time_start`) VALUES ("'.$res['id'].'","'.$id.'","'.time().'","2","'.time().'")');
						mysql_query('UPDATE `clan` SET `join2` = "'.$id.'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
						echo '<font color="#FF0000"><b>Вы успешно создали альянс &quot;'.$nm.'&quot;</b></font><br>';
					}else{
						echo '<font color="#FF0000"><b>Альянс или союз с такиим названием уже существует</b></font><br>';
					}
				}
			}
		}
	  }elseif(isset($_GET['cancel']) && $tt[13][0] == 1) {
		 $zvn = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `id` = "'.mysql_real_escape_string($_GET['cancel']).'" AND `time_start` = "0" AND `time_end` = "0" LIMIT 1')); 
		 if(!isset($zvn['id'])) {
			 echo '<font color="#FF0000"><b>Заявка на вступление не найдена</b></font><br>';
		 }else{
			 $rzv = '';
			if($zvn['clan'] == $res['id']) {
				//отмена присоединения
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				if($szu['type'] == 1) {
					$rzv = 'Клан <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</b> отказался от присоединения к союзу <b>'.$szu['name'].'</b>.';
				}else{
					$rzv = 'Клан <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</b> отказался от присоединения к альянсу <b>'.$szu['name'].'</b>.';
				}
			}elseif($zvn['alians'] == $res['join1']) {
				//отказ в присоединении к союзу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Союз <b>'.$szu['name'].'</b> отказал клану <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b> в присоединении.';
			}elseif($zvn['alians'] == $res['join2']) {
				//отказ в присоединении к альянсу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Альянс <b>'.$szu['name'].'</b> отказал клану <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b> в присоединении.';
			}
			if($rzv != '') {
				echo '<font color="#FF0000"><b>'.$rzv.'</b></font><br>';
				mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$zvn['id'].'"');
			}
		 }
	  }elseif(isset($_GET['ok']) && $tt[13][0] == 1) {
		 $zvn = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `id` = "'.mysql_real_escape_string($_GET['ok']).'" AND `time_start` = "0" AND `time_end` = "0" LIMIT 1')); 
		 if(!isset($zvn['id'])) {
			 echo '<font color="#FF0000"><b>Заявка на вступление не найдена</b></font><br>';
		 }else{
			 $rzv = '';
			if($zvn['alians'] == $res['join1']) {
				//присоединение к союзу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Союз <b>'.$szu['name'].'</b> принял клан <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b>.';
				mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` != "'.$zvn['id'].'" AND `clan` = "'.$szu['clan'].'" AND `type` = "1"');
				//mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$szu['id'].'","'.time().'","1")');
				mysql_query('UPDATE `clan` SET `join1` = "'.$zvn['alians'].'" WHERE `id` = "'.$szu['id'].'"');
			}elseif($zvn['alians'] == $res['join2']) {
				//присоединение к альянсу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Альянс <b>'.$szu['name'].'</b> принял клан <b><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b>.';
				mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` != "'.$zvn['id'].'" AND `clan` = "'.$szu['clan'].'" AND `type` = "2" AND `time_end` = "0"');
				//mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$szu['id'].'","'.time().'","2")');
				mysql_query('UPDATE `clan` SET `join2` = "'.$zvn['alians'].'" WHERE `id` = "'.$szu['id'].'"');
			}
			if($rzv != '') {
				echo '<font color="#FF0000"><b>'.$rzv.'</b></font><br>';
				mysql_query('UPDATE `clan_join` SET `time_start` = "'.time().'" WHERE `id` = "'.$zvn['id'].'"');
			}
		 }
	  }
	  ?>
      <? if($res['join1'] == 0 && $res['level'] > 0) { ?>
      <input type="submit" name="button" id="button" value="Создать союз" onClick="openMod('<b>Создать союз</b>','<form action=\'main.php?clan&diplom&newjoint=1\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />
      <input type="submit" name="button" id="button" value="Присоединиться к союзу" onClick="openMod('<b>Присоединиться к союзу</b>','<form action=\'main.php?clan&diplom&joint=1\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />
      <? }
	  
	  if($res['join2'] == 0 && $res['level'] > 0) { ?>
      <input type="submit" name="button" id="button" value="Присоединиться к альянсу" onClick="openMod('<b>Присоединиться к альянсу</b>','<form action=\'main.php?clan&diplom&joint=2\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />
      <input type="submit" name="button" id="button" value="Создать альянс" onClick="openMod('<b>Создать альянс</b>','<form action=\'main.php?clan&diplom&newjoint=2\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />      
      <br /><br /><? } ?><? } ?>
      <div style="border:1px solid #CECECE;padding:10px;">
      	<? 
		$ms = '';
		
		//Собственные союзы и альянсы
		if($res['join1'] > 0) {
			$j1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join1'].'" LIMIT 1'));
			if(isset($j1['id'])) {
				$ms .= '<div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">';
				$ms .= 'Вы состоите в клановом союзе <b>'.$j1['name'].'</b>.';
				if( $j1['clan_glava'] != $res['id'] ) { 
					$ms .= ' <a href="main.php?clan&diplom&delclanme=1"><img title="Покинуть союз" width="13" height="13" src="//img.testcombats.ru/i/clear.gif"></a>';
				}
				$ms .= '<Br>Состав союза: ';
				//$ms .= '<a href="javascript:void(0)"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</a>';
				$i = 0;
				if( isset($_GET['delclanme']) ) {
					if( $j1['clan_glava'] != $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) { 
						$dels = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$res['id'].'" AND `alians` = "'.$j1['id'].'" AND `time_end` = "0" AND `time_start` > 0 LIMIT 1'));
						if(isset($dels['id'])) {
							mysql_query('UPDATE `clan` SET `join1` = "0" WHERE `id` = "'.$res['id'].'" LIMIT 1');
							mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$dels['id'].'" LIMIT 1');
							echo '<div><b><font color=red>Вы успешно покинули союз &quot;'.$j1['name'].'&quot;</font></b></div>';
							header('location: main.php?clan&diplom');
						}else{
							echo '<div><b><font color=red>Ваш клан не состоит в данном союзе</font></b></div>';
						
						}
					}else{
						echo '<div><b><font color=red>Вы не можете покинуть данный союз</font></b></div>';
					}
				}elseif( $j1['clan_glava'] == $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) {
					if( isset($_GET['delclan']) ) {
						$delc = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.mysql_real_escape_string($_GET['delclan']).'" LIMIT 1'));
						$dels = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$delc['id'].'" AND `alians` = "'.$j1['id'].'" AND `time_end` = "0" AND `time_start` > 0 LIMIT 1'));
						
						if( isset($delc['id']) && isset($dels['id']) ) {
							if( $delc['id'] != $res['id'] ) {
								mysql_query('UPDATE `clan` SET `join1` = "0" WHERE `id` = "'.$dels['id'].'" LIMIT 1');
								mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$dels['id'].'" LIMIT 1');
								echo '<div><b><font color=red>Клан &quot;'.$delc['name'].'&quot; был исключен из данного союза</font></b></div>';
								header('location: main.php?clan&diplom');
							}else{
								echo '<div><b><font color=red>Клан ответственный за союз не может покинуть данный союз</font></b></div>';
							}
						}else{
							echo '<div><b><font color=red>Клан не состоит в данном союзе</font></b></div>';
						}
					}
				}
				$sp1 = mysql_query('SELECT `u`.*,`s`.* FROM `clan_join` AS `u` LEFT JOIN `clan` AS `s` ON `s`.`id` = `u`.`clan` WHERE `u`.`alians` = "'.$j1['id'].'" AND `u`.`time_end` = "0" AND `u`.`time_start` > 0');
				while($pl1 = mysql_fetch_array($sp1)) {
					if($i > 0) {
						$ms .= ',';
					}
					$ms .= ' <a href="javascript:void(0)"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$pl1['name_mini'].'.gif">'.$pl1['name'].'</a>';
					if( $j1['clan_glava'] == $res['id'] ) {
						if($res['id'] != $pl1['clan']) { 
							if($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) {
								$ms .= ' <a title="Выгнать из союза" href="main.php?clan&diplom&delclan='.$pl1['clan'].'"><img width="13" height="13" src="//img.testcombats.ru/i/clear.gif"></a>';
							}
						}
					}
					$i++;
				}
				if( $j1['clan_glava'] == $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) {
					$ms .= '<br>Вы основатель союза, можете ограничить каналы союза чата:<br>';
					$cnls = '<i>выключено</i>';
					//$ms .= '<form method="post" action="?clan&diplom&savecanals='.$res['id'].'"><a style="display:inline-block;width:210px;" href="javascript:void(0)"><img src="//img.testcombats.ru/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</a> &nbsp; '.$cnls.' &nbsp; <input type="submit" value="сохранить"></form>';
					$sp1 = mysql_query('SELECT `u`.*,`s`.* FROM `clan_join` AS `u` LEFT JOIN `clan` AS `s` ON `s`.`id` = `u`.`clan` WHERE `u`.`alians` = "'.$j1['id'].'" AND `u`.`time_end` = "0" AND `u`.`time_start` > 0');
					while($pl1 = mysql_fetch_array($sp1)) {
						$ms .= '<form method="post" action="?clan&diplom&savecanals='.$pl1['id'].'"><a style="display:inline-block;width:210px;" href="javascript:void(0)"><img src="//img.testcombats.ru/i/clan/'.$pl1['name_mini'].'.gif">'.$pl1['name'].'</a> &nbsp; '.$cnls.' &nbsp; <input type="submit" value="сохранить"></form>';
					}
				}
				//Перечисляем открытые каналы клана
				
				$ms .= '</div>';
			}
		}
		/* if($res['join2'] > 0) {
			$j1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join2'].'" LIMIT 1'));
			if(isset($j1['id'])) {
				$ms .= '<div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">';
				$ms .= 'Вы состоите в клановом альянсе <b>'.$j1['name'].'</b>. Состав альянса: ';
				//$ms .= '<a href="javascript:void(0)"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</a>';
				$sp1 = mysql_query('SELECT `u`.*,`s`.* FROM `clan_join` AS `u` LEFT JOIN `clan` AS `s` ON `s`.`id` = `u`.`clan` WHERE `u`.`alians` = "'.$j1['id'].'" AND `u`.`time_end` = "0" AND `u`.`time_start` > 0');
				$i = 0;
				while($pl1 = mysql_fetch_array($sp1)) {
					if($i > 0) {
						$ms .= ', ';	
					}
					$ms .= '<a href="javascript:void(0)"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$pl1['name_mini'].'.gif">'.$pl1['name'].'</a>';
					$i++;
				}
				$ms .= '<br>Вы основатель альянса.<br>';				
				$ms .= '</div>';
			}
		} */
		
		//Союзы и альянсы в которых состоит клан
		
		
		if($ms == '') {
		?>
        <center>В данный момент у вашего клана нет дипломатических отношений.</center>
        <? }else{ echo $ms; } ?>
      </div>
      <? if($tt[13][0] == 1) { ?>
      <br />
      <center>Заявки на союзы</center>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="50%" align="center" valign="top">
          	<div style="border:1px solid #CECECE;padding:10px;">
            	<a href="javascript:void(0)">Ваши заявки на установление союза</a>
                <br />
                <br />
                <?
				$ms = '';
				$sp = mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.mysql_real_escape_string($res['id']).'" AND `time_start` = "0" AND `time_end` = "0" AND `type` = "1"');
				while($pl = mysql_fetch_array($sp)) {
					$suz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$pl['alians'].'" LIMIT 1'));
					$ms .= '<div style="border-bottom:1px solid #cac9c7;text-align:left;margin-bottom:5px;padding-bottom:5px;">Вы подали заявку на вступление в союз <b>'.$suz['name'].'</b>.<br><div style="float:left;">Время подачи заявки: '.date('d.m.Y H:i',$pl['time']).'</div><a style="float:right;" href="?clan&diplom&cancel='.$pl['id'].'">Отменить</a><br></div>';
				}
				if($ms == '') {
				?>
                С Вами никто не подавал заявки
                <? }else{ echo $ms; } ?>
            </div>
          </td>
          <td align="center" valign="top">
          	<div style="border:1px solid #CECECE;padding:10px;">
            	<a href="javascript:void(0)">Заявки на установление союза с вами</a>
                <br />
                <br />
                <?
				$ms = '';
				$sp = mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.mysql_real_escape_string($res['join1']).'" AND `time_start` = "0" AND `time_end` = "0" AND `type` = "1"');
				while($pl = mysql_fetch_array($sp)) {
					$suz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$pl['alians'].'" LIMIT 1'));
					$clz = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['clan'].'" LIMIT 1'));
					$ms .= '<div style="border-bottom:1px solid #cac9c7;text-align:left;margin-bottom:5px;padding-bottom:5px;">Клан <a href="javascript:void(0)"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$clz['name_mini'].'.gif">'.$clz['name'].'</a> подал заявку на вступление в Ваш союз <b>'.$suz['name'].'</b>.<br><div style="float:left;">Время подачи заявки: '.date('d.m.Y H:i',$pl['time']).'</div><div style="float:right;"><a href="?clan&diplom&ok='.$pl['id'].'">Принять</a> &nbsp; <a href="?clan&diplom&cancel='.$pl['id'].'">Отказать</a></div><br></div>';
				}
				if($ms == '') {
				?>
                С Вами никто не подавал заявки
                <? }else{ echo $ms; } ?>
            </div>
          </td>
        </tr>
      </table>
   	<? } ?>
    </fieldset>    
   <? } elseif(isset($_GET['deposit'])) {
	
	$itmc = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `uid` = "-21'.$res['id'].'" AND `delete` = 0 LIMIT 1'));
	$itmc = $itmc[0];
	$itms = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid` >= 0 AND `iu`.`delete` = "0"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['ungive_itm']).'" LIMIT 1'));
	$ps = $u->lookStats($itms['data']);
	$ps['cl'] = explode('#', $ps['toclan']);
	$use_s = $ps['cl'][1];
	if(isset($_GET['ungive_itm']) && $ps['cl'][0] == $res['id'] && ($tt[14][0] == 1 || ($u->info['id'] == $use_s))) {
		$itm = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid` >= 0 AND `iu`.`delete` = "0"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['ungive_itm']).'" LIMIT 1'));
		if(isset($itm['id'])) {
			$btlud = mysql_fetch_array(mysql_query('SELECT `id`,`battle` FROM `users` WHERE `id` = "'.$itm['uid'].'" LIMIT 1'));
			if( $u->testBattle($btlud['battle']) == true ) {
				echo '<font color="#FF0000"><b>Нельзя изымать предметы с персонажа в бою</b></font><br>';
			}else{
			 	echo $u->ungive_itm_cl($_GET['ungive_itm'], $u->info, $res['id']);
			}
		}
	} elseif(isset($_GET['take_itm']) && $tt[4][0] == 1) {
		$itm = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid`="-21'.$res['id'].'" AND `iu`.`delete`="0"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['take_itm']).'" LIMIT 1'));
		if(isset($itm['id'])) {
		  echo $u->take_itm_cl($_GET['take_itm'], $u->info, $res['id']);
	    }
	} elseif(isset($_GET['give_itm'])) {
      $itm = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inslot` > 0 AND `iu`.`gift` = "" AND `iu`.`data` NOT LIKE "%frompisher=%"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['give_itm']).'" LIMIT 1'));
		if($itmc >= $lvl_prava[$res['level']][5]) {
			echo '<font color="#FF0000"><b>Хранилище переполнено</b></font><br>';
		} elseif(isset($itm['id'])) {
		  echo $u->set_cl_item($_GET['give_itm'], $u->info, $res['id']);
		}
	}
	if($tt[4][0] == 1) {
		$itm_clan = $u->genInv(66, '(`iu`.`uid` = "-21'.$u->info['clan'].'" OR `iu`.`data` LIKE "%toclan='.$u->info['clan'].'#%") AND `iu`.`delete` = 0 AND `iu`.`inShop` = 0 ORDER BY `lastUPD` DESC');
	} else {
		$itm_clan[2] = '<br /><br /><center>У вас нет доступа к использованию хранилища</center>';
	}
	$itm_user = $u->genInv(65, '`iu`.`uid` = '.$u->info['id'].' AND `iu`.`delete` = 0 AND `iu`.`inOdet` = 0 AND `iu`.`inShop` = 0 AND `im`.`inslot` > 0 AND `iu`.`gift` = "" AND `iu`.`data` NOT LIKE "%frompisher=%" ORDER BY `lastUPD` DESC');
   
   ?>
   <div class="box visible">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="50%" valign="top">
    <fieldset style="margin:0;padding:0">
      <legend><span class="legtitle">Хранилище (предметов : <?=$itmc?>/<?=$lvl_prava[$res['level']][5]?>)</span></legend>
      <? if($itm_clan[2] != '') { ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
	  <?=$itm_clan[2]?>
      </table>
      <? }else{ echo '<center><br />Хранилище клана пусто<br /><br /></center>'; } ?>
    </fieldset>
         </td>
         <td width="50%" valign="top">
    <fieldset style="margin:0;padding:0">
      <legend><span class="legtitle">Рюкзак</span></legend>
      <? if($itm_user[2] != '') { ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
	  <?=$itm_user[2]?>
      </table>
      <? }else{ echo '<center><br />Рюкзак пуст<br /><br /></center>'; } ?>
    </fieldset>
         </td>
       </tr>
     </table>
   </div>
   <? }elseif(isset($_GET['titul']) && $tt[11][0]==1) { ?>
   <script>
   function editTitul(id) {
		if($('#edpnltitul'+id).css('display') == 'none') {
			$('#edpnltitul'+id).css({'display':''});
		}else{
			$('#edpnltitul'+id).css({'display':'none'});
		}
   }
   </script>
   <div class="box visible">
        <?
		if(isset($_POST['tituladd'])) {
			//Добавляем новый титул
			$tc = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" LIMIT 25'));
			if($tc[0] >= 20) {
				echo '<font color="#FF0000"><b>Нельзя добавлять более 25-ти титулов, для добавления нового сотрите старые</b></font><br>';
			}else{
				$nm = htmlspecialchars($_POST['tituladd'],NULL,'cp1251');
				if(str_replace(' ','',str_replace('	','',$nm)) == '') {
					echo '<font color="#FF0000"><b>Название титула не должно быть пустым</b></font><br>';
				}else{
					mysql_query('INSERT INTO `clan_tituls` (`prioritet`,`clan`,`user_add`,`time_add`,`name`) VALUES ("0","'.$res['id'].'","'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($nm).'")');
					echo '<font color="#FF0000"><b>Титул был успешно добавлен</b></font><br>';
				}
			}
		}elseif(isset($_GET['save'])) {
			//сохраняем титул
			$tc = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `id` = "'.mysql_real_escape_string($_GET['save']).'" AND `delete` = "0" LIMIT 1'));
			if(isset($tc['id'])) {
				$tc['info'] = htmlspecialchars($_POST['t_info'],NULL,'cp1251');
				$tc['prioritet'] = round((int)$_POST['t_prioritet']);
				if($tc['prioritet']>10000) {
					$tc['prioritet'] = 10000;
				}
				$i = 1;
				$tc['canals'] = '';
				while($i <= 9) {
					if($_POST['t_klan'.$i]) {
						$tc['canals'] .= '1';
					}else{
						$tc['canals'] .= '0';
					}
					$i++;
				}
				$i = 0;
				$tc['prava'] = '';
				while($i <= 20) {
					if($_POST['t_tr'.$i]) {
						$tc['prava'] .= '1';
					}else{
						$tc['prava'] .= '0';
					}
					$i++;
				}
				$_POST['colorsp'] = preg_replace('/[^a-zа-яё0-9]/i','',$_POST['colorsp']);
				mysql_query('UPDATE `clan_tituls` SET `prioritet` = "'.$tc['prioritet'].'",`info` = "'.mysql_real_escape_string($tc['info']).'", `color` = "'.mysql_real_escape_string($_POST['colorsp']).'", `canals` = "'.$tc['canals'].'", `prava` = "'.$tc['prava'].'" WHERE `id` = "'.$tc['id'].'" LIMIT 1');
				echo '<font color="#FF0000"><b>Титул был успешно сохранен</b></font><br>';
			}else{
				echo '<font color="#FF0000"><b>Титул не найден</b></font><br>';
			}
		}elseif(isset($_GET['delete'])) {
			$tc = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `id` = "'.mysql_real_escape_string($_GET['delete']).'" AND `delete` = "0" LIMIT 1'));
			if(isset($tc['id'])) {
				mysql_query('UPDATE `clan_tituls` SET `delete` = "'.$u->info['id'].'" WHERE `id` = "'.$tc['id'].'" LIMIT 1');
				echo '<font color="#FF0000"><b>Титул был удален</b></font><br>';
			}else{
				echo '<font color="#FF0000"><b>Титул не найден</b></font><br>';
			}
		}
?>

<?
		$i = 0;
		$sp = mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" LIMIT 25');
		while($pl = mysql_fetch_array($sp)) {
		?>
		<div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
        
        <b style="color:#<?=$pl['color']?>">*</b> &nbsp; <a style="display:inline-block;width:250px;" onclick="editTitul(<?=$pl['id']?>)" href="javascript:void(0)"><?=$pl['name']?></a><font color="#999999"><i><?=$pl['info']?></i></font>
        <img src="//img.testcombats.ru/i/clear.gif" title="Удалить титул" onclick="location='main.php?clan&titul&delete=<?=$pl['id']?>'" style="float:right;cursor:pointer;">
        <div id="edpnltitul<?=$pl['id']?>" style="display:none;margin:10px;border:1px solid #9e9e9e;padding:10px;">
           <form method="post" action="?clan&titul&save=<?=$pl['id']?>">
           <span style="float:right"><a onclick="editTitul(<?=$pl['id']?>)" href="javascript:void(0)">x</a></span>
                <center>Редактирование титула <a onclick="editTitul(<?=$pl['id']?>)" href="javascript:void(0)"><?=$pl['name']?></a></center><br>
                Описание: <input style="width:360px;" value="<?=$pl['info']?>" type="text" name="t_info"><br>
                Приоритет: <input style="text-align:center;width:50px;" value="<?=$pl['prioritet']?>" type="text" name="t_prioritet" /> <small>Значение</small><br />
                <br>
                Каналы чата: 
                <? $j = 1;
				while($j <= 9) {
						if($pl['canals'][$j-1] == 1) {
							$pl['check'] = 'checked';
						}else{
							$pl['check'] = '';
						}
				?> 
                <label for="t_klan<?=$j?>"><?=$j?></label>
                <input <?=$pl['check']?> type="checkbox" <?=$pl['check2']?> name="t_klan<?=$j?>" id="t_klan<?=$j?>">
                <? $j++; }
				echo '<br><br>';
				$j = 1;
				while($j < count($tt)) {
					if($tt[$j][1] != '0') {
						if($pl['prava'][$j] == 1) {
							$pl['check'] = 'checked';
						}else{
							$pl['check'] = '';
						}
						?>
                <input <?=$pl['check']?> type="checkbox" name="t_tr<?=$j?>" id="t_tr<?=$j?>">
                <label for="t_tr<?=$j?>"><?=$tt[$j][1]?></label><br>
                        <?
					}
					$j++;
				}
				?>
                <br>
                Картинка: *<br>
                Цвет: &nbsp; &nbsp; &nbsp; <div style="cursor:pointer;display:inline-block;width:20px;height:15px;background-color:#<?=$pl['color']?>">&nbsp;</div> #<input name="colorsp" maxlength="6" type="text" value="<?=$pl['color']?>" /><br />
                <small>(вы можете воспользовать <a onclick="ssclrttl()" href="javascript:void(0)">таблицей цветов - показать/скрыть</a>)</small><br />
       		 <br><br>
                <input  type="submit" value="Сохранить">
          </form>
          </div>
        </div>
     <?
   		$i++;
		}

		if($i == 0) {
			echo 'В клане нет ни одного титула';
		}
		?>
        <input  type="button" onclick="addNewTitul()" value="Добавить титул">
   </div>
   <? }elseif(isset($_GET['info'])) {
	  
	  //полученный опыт
	  $edd = mysql_fetch_array(mysql_query('SELECT SUM(`exp`) FROM `clan_exp` WHERE `clan` = "'.$res['id'].'" AND `dd` = "'.ceil(date('d')).'" AND `mm` = "'.ceil(date('m')).'" AND `yyyy` = "'.ceil(date('Y')).'"'));
	  $eww = mysql_fetch_array(mysql_query('SELECT SUM(`exp`) FROM `clan_exp` WHERE `clan` = "'.$res['id'].'" AND `ww` = "'.ceil(date('W')).'" AND `yyyy` = "'.ceil(date('Y')).'"'));
	  $emm = mysql_fetch_array(mysql_query('SELECT SUM(`exp`) FROM `clan_exp` WHERE `clan` = "'.$res['id'].'" AND `mm` = "'.ceil(date('m')).'" AND `yyyy` = "'.ceil(date('Y')).'"'));
	 
	  $edd = 0+$edd[0];
	  $eww = 0+$eww[0];
	  $emm = 0+$emm[0];	   
   ?>   
   <div class="box visible">
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    Название клана: <img src="//img.testcombats.ru/i/clan/<?=$res['name_mini']?>.gif" style="vertical-align:bottom" width="24" height="15"><a href="javascript:void(0)"><?=$res['name']?></a> (<?=$res['name_mini']?>)
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    Уровень клана: <?=$res['level']?>
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    Опыт клана: <?=number_format($res['exp'], 0, ",", " ")?> / <?=number_format($lvl_exp[$res['level']+1], 0, ",", " ")?>
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    <table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
       
        <td width="500">&nbsp;&bull; Клан опыт за сегодня: <b style="color:#0033a1"><?=$edd?></b><br>&nbsp;&bull; Клан опыт за неделю: <b style="color:#0033a1"><?=$eww?></b><br>&nbsp;&bull; Клан опыт за месяц: <b style="color:#0033a1"><?=$emm?></b></td>
       
      </tr>
    </table>
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
	<table width="50%" border="0" style="border:1px solid #232323;" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Уровень</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Игроки</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Союз</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Создать союз</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Альянс</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Создать альянс</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Хранилище</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Передач на игрока</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;" bgcolor="#cccccc"><strong>Передач всего</strong></td>
  </tr>
  <?
  $i = 0;
  $yn = array('Нет','Да');
  while($i < count($lvl_prava)) {
	  $bgclr = '';
	  if($res['level'] >= $i) {
		 $bgclr = ' bgcolor="#8fd155"'; 
	  }
	  if($i < count($lvl_prava)-1) {
  ?>
  <tr<?=$bgclr?>>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$i?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][0]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][1]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][2]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][3]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][4]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][5]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][6]?></td>
    <td style="border-bottom:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][7]?></td>
  </tr>
  <?
	  }else{
		  
  ?>
  <tr<?=$bgclr?>>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$i?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][0]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][1]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][2]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][3]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][4]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][5]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][6]?></td>
    <td align="center" valign="middle"><?=$lvl_prava[$i][7]?></td>
  </tr>
  <?
	  }
  $i++;
  }
  ?>
  </table>
    </div>

  </div>
   <? }elseif(isset($_GET['members'])) { ?>
   <div  class="box visible">
    <fieldset style="border:1px dashed #eeeeee">
      <legend align="center"><span class="legtitle"><img title="Приватно" onClick="top.chat.addto('klan','private')" style="vertical-align:bottom;cursor:pointer;" src="//img.testcombats.ru/i/lock.gif" width="20" height="15"> Соклановцы</span></legend>
      <? if(!isset($_GET['online'])) { ?>
      <input  onClick="location='main.php?clan&members&online'" type="button" value="Только online" style="float:right">
      <? }else{ ?>
      <input  onClick="location='main.php?clan&members'" type="button" value="Показать всех" style="float:right">
      <? } ?>
      <br>
      <?
	  $sp = mysql_query('SELECT `id`,`battle`,`login`,`clan`,`level`,`room`,`cityreg`,`align`,`clan_prava`,`mod_zvanie`,`sex`,`city`,`online`,`banned` FROM `users` WHERE `clan` = "'.$res['id'].'"');
	  $r = '<br>'; $j = 0; $i = 0;
	  if($res['join1'] > 0 || $res['join2'] > 0) {
		 $r .= '<fieldset style="border:1px dashed #eeeeee;margin-top:5px;">
      <legend align="left"><span class="legtitle">Основной состав</span></legend>'; 
	  }
	  while($pl = mysql_fetch_array($sp)) {
		  if(!isset($_GET['online']) || $pl['online'] > time()-120) {
			  $pl['textcolor1'] = '';
			  if($pl['online'] > time()-120) {
				 $ico = '<img onClick="top.chat.addto(\''.$pl['login'].'\',\'private\')" src="//img.testcombats.ru/i/lock.gif" width="20" height="15" style="cursor:pointer;vertical-align:bottom">'; 
				 $j++;
			  }else{
				  $pl['textcolor1'] = '#837f82';
				 $ico = '<img src="//img.testcombats.ru/i/offline.gif" width="20" height="15" style="vertical-align:bottom">'; 
			  }		  
			  $zvn = $pl['mod_zvanie'];
			  $zvn = str_replace('[b]','<b>',$zvn);
			  $zvn = str_replace('[/b]','</b>',$zvn);
			  $zvn = str_replace('[i]','<i>',$zvn);
			  $zvn = str_replace('[/i]','</i>',$zvn);
			  $zvn = str_replace('[u]','<u>',$zvn);
			  $zvn = str_replace('[/u]','</u>',$zvn);
			  $zvn = str_replace('[c=','<font color="',$zvn);
			  $zvn = str_replace('=]','">',$zvn);
			  $zvn = str_replace('[/c]','</font>',$zvn);
			  if($pl['clan_prava'] == 'glava') {
				 if($zvn == 'Стажер' || $zvn == '') {
					 $zvn = '<b style="color:#008097">глава клана</b>';
				 }
				 $zvn = '<img style="vertical-align:top" src="//img.testcombats.ru/i/clan/'.$res['name_mini'].'.gif" width="24" title="Глава клана">'.$zvn; 
			  }
			  $ttl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `id` = "'.$pl['clan_prava'].'" LIMIT 1'));
			  if(isset($ttl['id'])) {
				 $zvn = '<font color="#'.$ttl['color'].'"><b>'.$ttl['name'].'</b></font> - '.$zvn; 
			  }
			  if($pl['online'] > time()-120) {
				  $rm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`city` FROM `room` WHERE `id` = "'.$pl['room'].'" LIMIT 1'));
				  if(isset($rm['id'])) {
					 $zvn .= ' - <i>'.$rm['name'].'</i>'; 
				  }
			  }else{
				  $zvn .= ' - <i><font color="grey">персонаж сейчас не в клубе</font></i>';
			  }
			  if($pl['battle'] > 0) {
				$zvn .= ' <a href="logs.php?id='.$pl['battle'].'" target="_blank"><img width="20" height="20" style="vertical-align:bottom"src="//img.testcombats.ru/i/fighttype0.gif" title="Открыть лог поединка"></a>';  
			  }
			$r .= '<div style="padding:5px;background-color:#efedee"><span style="display:inline-block;width:350px;">'.$ico.' &nbsp;&nbsp; &nbsp; <img src="//img.testcombats.ru/i/align/align'.$pl['align'].'.gif" width="12" height="15" style="vertical-align:bottom"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$res['name_mini'].'.gif" width="24" height="15"><a onClick="top.chat.addto(\''.$pl['login'].'\',\'to\')" style="color:'.$pl['textcolor1'].'" href="javascript:void(0)">'.$pl['login'].'</a><font color="'.$pl['textcolor1'].'">['.$pl['level'].']<a href="//testcombats.ru/inf.php?'.$pl['id'].'" title="Инф. о '.$pl['login'].'" target="_blank"><img src="//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif" width="12" height="11"></a></font></span>'.$zvn.'</div>';
		  }
		  $i++;
	  }
	  
	  if($res['join1'] > 0 || $res['join2'] > 0) {
	  	$r .= '</fieldset>';
	  }
	  $nacln = '';	  
	  if($res['join1'] > 0) {
	  	$clna = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join1'].'" AND `type` = "1" AND `time_close` = "0" LIMIT 1'));
		$cn_sp = mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$clna['id'].'" AND `clan` != "'.$res['id'].'" AND `time_end` = "0" AND `time_start` > 0');
		while($cn_pl = mysql_fetch_array($cn_sp)) {
			/* ----------------------------------------------------------------------------------------------------------------------------- */
			  $nacln .= ' AND `clan` != "'.$cn_pl['clan'].'"';
			  $clnf = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$cn_pl['clan'].'" LIMIT 1'));
			  $sp = mysql_query('SELECT `id`,`battle`,`login`,`clan`,`level`,`room`,`cityreg`,`align`,`clan_prava`,`mod_zvanie`,`sex`,`city`,`online`,`banned` FROM `users` WHERE `clan` = "'.$cn_pl['clan'].'"');
			  $r .= '<fieldset style="border:1px dashed #eeeeee;margin-top:5px;">
      <legend align="left"><span class="legtitle">Состав &quot;'.$clna['name'].'&quot;</span></legend>';
			  $j = 0; $i = 0;
			  while($pl = mysql_fetch_array($sp)) {
				  if(!isset($_GET['online']) || $pl['online'] > time()-120) {
					  $pl['textcolor1'] = '';
					  if($pl['online'] > time()-120) {
						 $ico = '<img onClick="top.chat.addto(\''.$pl['login'].'\',\'private\')" src="//img.testcombats.ru/i/lock.gif" width="20" height="15" style="cursor:pointer;vertical-align:bottom">'; 
						 $j++;
					  }else{
						  $pl['textcolor1'] = '#837f82';
						 $ico = '<img src="//img.testcombats.ru/i/offline.gif" width="20" height="15" style="vertical-align:bottom">'; 
					  }		  
					  $zvn = $pl['mod_zvanie'];
					  $zvn = str_replace('[b]','<b>',$zvn);
					  $zvn = str_replace('[/b]','</b>',$zvn);
					  $zvn = str_replace('[i]','<i>',$zvn);
					  $zvn = str_replace('[/i]','</i>',$zvn);
					  $zvn = str_replace('[u]','<u>',$zvn);
					  $zvn = str_replace('[/u]','</u>',$zvn);
					  $zvn = str_replace('[c=','<font color="',$zvn);
					  $zvn = str_replace('=]','">',$zvn);
					  $zvn = str_replace('[/c]','</font>',$zvn);
					  if($pl['clan_prava'] == 'glava') {
						 if($zvn == 'Стажер' || $zvn == '') {
							 $zvn = '<b style="color:#008097">глава клана</b>';
						 }
						 $zvn = '<img style="vertical-align:top" src="//img.testcombats.ru/i/clan/'.$clnf['name_mini'].'.gif" width="24" title="Глава клана">'.$zvn; 
					  }
					  $ttl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$clnf['id'].'" AND `id` = "'.$pl['clan_prava'].'" LIMIT 1'));
					  if(isset($ttl['id'])) {
						 $zvn = '<font color="#'.$ttl['color'].'"><b>'.$ttl['name'].'</b></font> - '.$zvn; 
					  }
					  if($pl['online'] > time()-120) {
						  $rm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`city` FROM `room` WHERE `id` = "'.$pl['room'].'" LIMIT 1'));
						  if(isset($rm['id'])) {
							 $zvn .= ' - <i>'.$rm['name'].'</i>'; 
						  }
					  }else{
						  $zvn .= ' - <i><font color="grey">персонаж сейчас не в клубе</font></i>';
					  }
					  if($pl['battle'] > 0) {
						$zvn .= ' <a href="logs.php?id='.$pl['battle'].'" target="_blank"><img width="20" height="20" style="vertical-align:bottom"src="//img.testcombats.ru/i/fighttype0.gif" title="Открыть лог поединка"></a>';  
					  }
					$r .= '<div style="padding:5px;background-color:#efedee"><span style="display:inline-block;width:350px;">'.$ico.' &nbsp;&nbsp; &nbsp; <img src="//img.testcombats.ru/i/align/align'.$pl['align'].'.gif" width="12" height="15" style="vertical-align:bottom"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$clnf['name_mini'].'.gif" width="24" height="15"><a onClick="top.chat.addto(\''.$pl['login'].'\',\'to\')" style="color:'.$pl['textcolor1'].'" href="javascript:void(0)">'.$pl['login'].'</a><font color="'.$pl['textcolor1'].'">['.$pl['level'].']<a href="//testcombats.ru/inf.php?'.$pl['id'].'" title="Инф. о '.$pl['login'].'" target="_blank"><img src="//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif" width="12" height="11"></a></font></span>'.$zvn.'</div>';
				  }
				  $i++;
			  }
			  $r .= '</fieldset>';
			/* ----------------------------------------------------------------------------------------------------------------------------- */
		}
	  }
	  if($res['join2'] > 0) {
	  	$cn_sp0 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join2'].'" AND `type` = "2" AND `time_close` = "0" LIMIT 1'));
		$cn_sp = mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$cn_sp0['id'].'" AND `clan` != "'.$res['id'].'"'.$nacln.' AND `time_end` = "0" AND `time_start` > 0');
		while($cn_pl = mysql_fetch_array($cn_sp)) {
			/* ----------------------------------------------------------------------------------------------------------------------------- */
			  $clnf = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$cn_pl['clan'].'" LIMIT 1'));
			  $clna = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join2'].'" LIMIT 1'));
			  $sp = mysql_query('SELECT `id`,`battle`,`login`,`clan`,`level`,`room`,`cityreg`,`align`,`clan_prava`,`mod_zvanie`,`sex`,`city`,`online`,`banned` FROM `users` WHERE `clan` = "'.$cn_pl['clan'].'"');
			  $r .= '<fieldset style="border:1px dashed #eeeeee;margin-top:5px;">
      <legend align="left"><span class="legtitle">Состав &quot;'.$clna['name'].'&quot;</span></legend>';
			  $j = 0; $i = 0;
			  while($pl = mysql_fetch_array($sp)) {
				  if(!isset($_GET['online']) || $pl['online'] > time()-120) {
					  $pl['textcolor1'] = '';
					  if($pl['online'] > time()-120) {
						 $ico = '<img onClick="top.chat.addto(\''.$pl['login'].'\',\'private\')" src="//img.testcombats.ru/i/lock.gif" width="20" height="15" style="cursor:pointer;vertical-align:bottom">'; 
						 $j++;
					  }else{
						  $pl['textcolor1'] = '#837f82';
						 $ico = '<img src="//img.testcombats.ru/i/offline.gif" width="20" height="15" style="vertical-align:bottom">'; 
					  }		  
					  $zvn = $pl['mod_zvanie'];
					  $zvn = str_replace('[b]','<b>',$zvn);
					  $zvn = str_replace('[/b]','</b>',$zvn);
					  $zvn = str_replace('[i]','<i>',$zvn);
					  $zvn = str_replace('[/i]','</i>',$zvn);
					  $zvn = str_replace('[u]','<u>',$zvn);
					  $zvn = str_replace('[/u]','</u>',$zvn);
					  $zvn = str_replace('[c=','<font color="',$zvn);
					  $zvn = str_replace('=]','">',$zvn);
					  $zvn = str_replace('[/c]','</font>',$zvn);
					  if($pl['clan_prava'] == 'glava') {
						 if($zvn == 'Стажер' || $zvn == '') {
							 $zvn = '<b style="color:#008097">глава клана</b>';
						 }
						 $zvn = '<img style="vertical-align:top" src="//img.testcombats.ru/i/clan/'.$clnf['name_mini'].'.gif" width="24" title="Глава клана">'.$zvn; 
					  }
					  $ttl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$clnf['id'].'" AND `id` = "'.$pl['clan_prava'].'" LIMIT 1'));
					  if(isset($ttl['id'])) {
						 $zvn = '<font color="#'.$ttl['color'].'"><b>'.$ttl['name'].'</b></font> - '.$zvn; 
					  }
					  if($pl['online'] > time()-120) {
						  $rm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`city` FROM `room` WHERE `id` = "'.$pl['room'].'" LIMIT 1'));
						  if(isset($rm['id'])) {
							 $zvn .= ' - <i>'.$rm['name'].'</i>'; 
						  }
					  }else{
						  $zvn .= ' - <i><font color="grey">персонаж сейчас не в клубе</font></i>';
					  }
					  if($pl['battle'] > 0) {
						$zvn .= ' <a href="logs.php?id='.$pl['battle'].'" target="_blank"><img width="20" height="20" style="vertical-align:bottom"src="//img.testcombats.ru/i/fighttype0.gif" title="Открыть лог поединка"></a>';  
					  }
					$r .= '<div style="padding:5px;background-color:#efedee"><span style="display:inline-block;width:350px;">'.$ico.' &nbsp;&nbsp; &nbsp; <img src="//img.testcombats.ru/i/align/align'.$pl['align'].'.gif" width="12" height="15" style="vertical-align:bottom"><img style="vertical-align:bottom" src="//img.testcombats.ru/i/clan/'.$clnf['name_mini'].'.gif" width="24" height="15"><a onClick="top.chat.addto(\''.$pl['login'].'\',\'to\')" style="color:'.$pl['textcolor1'].'" href="javascript:void(0)">'.$pl['login'].'</a><font color="'.$pl['textcolor1'].'">['.$pl['level'].']<a href="//testcombats.ru/inf.php?'.$pl['id'].'" title="Инф. о '.$pl['login'].'" target="_blank"><img src="//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif" width="12" height="11"></a></font></span>'.$zvn.'</div>';
				  }
				  $i++;
			  }
			  $r .= '</fieldset>';
			/* ----------------------------------------------------------------------------------------------------------------------------- */
		}
	  }
	  
	  $r .= '<br>Всего: <a href="main.php?clan&members">'.$i.'</a>';
	  echo $r;
	  ?>
    </fieldset>
   </div>
  <? } ?>


</div><!-- .section -->