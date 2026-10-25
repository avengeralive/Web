<?php
define('GAME', true);

include('../_incl_data/__config.php');
include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');

//print_r($_POST);
$id = '';
foreach ($_POST as $key => $val)
{
    $id_i = explode("_", $val);
    $id .= '`id` = "' . round((int)$id_i[1]) . '" OR ';
}
$id = trim($id, ' OR ');
$it_user = mysql_query('SELECT * FROM `items_users` WHERE (' . $id . ') AND `uid` = "' . $u->info['id'] . '" AND `delete` = 0 LIMIT 3');
$i = 1;
$lvl1 = 0;
$lvl2 = 0;
$lvl3 = 0;
$lid = array();
while ($it_us = mysql_fetch_array($it_user))
{
    if (!isset($lid[$it_us['id']]))
	{
        $it_main = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "' . $it_us['item_id'] . '"'));
        if ($i == 1) {
            $lvl1 = $it_main['level'];
        } elseif ($i == 2) {
            $lvl2 = $it_main['level'];
        } elseif ($i == 3) {
            $lvl3 = $it_main['level'];
        }
        $na += $it_us['name'] . ",";
        $lid[$it_us['id']] = true;
        $i++;
    }
}

if ($i < 3)
{
    die('Необходимо выбрать 3 разных руны.');
}

if($lvl1!=$lvl2 || $lvl2!=$lvl3)
{
    die('Необходимо выбрать 3 руны одного уровня.');
}

$na = trim($na, ',');
$rep = 0;
$unik = 0;
$chance = 10;
if ($lvl1 == $lvl2 && $lvl2 == $lvl3 && $lvl1 == 4) {
    $rep = 1;
    $levmin = 4;
} elseif ($lvl1 == $lvl2 && $lvl2 == $lvl3 && $lvl1 == 7) {
    $rep = 2;
    $levmin = 7;
} elseif ($lvl1 == $lvl2 && $lvl2 == $lvl3 && $lvl1 == 9)
{
    $rep = 3;
    $levmin = 9;
	//Уникальная руна шанс получения 1%
	if(rand(1, 100) <= 1){
		$unik = 1;
	}

} else {
	    $levmin = 9;
	    if($levmin >= $lvl3){
	        $levmin = $lvl3;
	    }
	    if($levmin >= $lvl2){
	        $levmin = $lvl2;
	    }
	    if($levmin >= $lvl1){
	        $levmin = $lvl1;
	    }
}

if($levmin != 9){
    if($levmin == 7)
	{
        $rep = 2;
    }elseif($levmin == 4)
	{
        $rep = 1;
    }
}

if ($unik == 1)
{
    $rune = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" AND `level` = "1" ORDER BY RAND() LIMIT 1'));
} else {
    $rune = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" AND `level` = "' . $levmin . '" ORDER BY RAND() LIMIT 1'));
}

if(isset($rune['name'])) {
		echo 'В результате плавки получена руна "'.$rune['name'].'".';
		$u->addItem($rune['id'],$u->info['id'], null, null, null, '', $na);
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE ('.$id.') AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 ');
	if($u->rep['rep1'] < 10000){
		$u->rep['rep1'] += $rep;
		mysql_query('UPDATE `rep` SET `rep1` = "'.$u->rep['rep1'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	}else{
		echo 'Руна не найдена... Попробуйте еще! "'.$rune['name'].'".';
	}

unset($_POST);