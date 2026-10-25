<?php
define('GAME', true);

include('../_incl_data/__config.php');
include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');


$price1 = array('0' => '1.49', '1' => '4.99');
$price2 = array('0' => '2.99', '1' => '9.99');
$price3 = array('0' => '4.49', '1' => '14.99');
$time = array('0' => '604800', '1' => '2592000');
$bonusT = $time[$_POST['price']];

if ($_POST['type'] == 1)
{
    $price = $price1[$_POST['price']];
    $eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "755"'));
    $bonus = array(
        "name" => "Премиум",
        "speed_Loc" => "10",
        "speedHp" => "25",
        "speedMp" => "25",
        "addExp" => "10",
        "addRep" => "10",
        "ym_delay" => "10",
        "yv_drop" => "0",
        "speed_dunger" => "10",
        "mfza" => "3",
        "mf_yron" => "3",
        "sale_prc" => "93",
        "saleEkr_prc" => "93",
        "Exp_zver" => "25"
    );
}
elseif ($_POST['type'] == 2)
{
    $price = $price2[$_POST['price']];
    $eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "756"'));
    $bonus = array(
        "name" => "Премиум",
        "speed_Loc" => "20",
        "speedHp" => "100",
        "speedMp" => "100",
        "addExp" => "50",
        "addRep" => "30",
        "ym_delay" => "30",
        "yv_drop" => "0",
        "speed_dunger" => "30",
        "mfza" => "5",
        "mf_yron" => "5",
        "sale_prc" => "95",
        "saleEkr_prc" => "95",
        "Exp_zver" => "50"
    );
}
elseif ($_POST['type'] == 3)
{
    $price = $price3[$_POST['price']];
    $eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "757"'));
    $bonus = array(
			"name"=>"Премиум",
			"speed_Loc" => "30",
			"speedHp" => "150",
			"speedMp" => "150",
			"addExp" => "100",
			"addRep" => "50",
			"ym_delay"=>"50",
			"yv_drop"=>"2",
			"speed_dunger"=>"50",
			"mfza"=>"10",
			"mf_yron"=>"10",
			"sale_prc"=>"100",
			"saleEkr_prc"=>"100",
			"Exp_zver"=>"100"
    );
}

if ($u->info['money2'] < $price)
{
    echo "Недостаточно денег";
} else {
    mysql_query('UPDATE `users` SET `money2` = `money2` - "' . $price . '" WHERE `id` = "' . $u->info['id'] . '"');

	$res = mysql_fetch_array(mysql_query('SELECT * FROM `premium`
	WHERE `uid` = "' . $u->info['id'] . '" AND `time_delete`>"'.time().'"'));

	if($res['type'] != $_POST['type']) unset($res['time_delete']);
    $time_end = (isset($res['time_delete']) ? $res['time_delete'] : time()) + $bonusT;

    if ($res['id'])
	{
		$ins = mysql_query('UPDATE `premium` SET 
				`name` = "' . $bonus['name'] . '",
				`type` = "' . $_POST['type'] . '",
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
				`money` = "' . $price . '" 
				WHERE `uid` = "' . $u->info['id'] . '"');
    } else {
        $ins = mysql_query('INSERT INTO `premium` SET 
				`name` = "' . $bonus['name'] . '",
				`uid` = "' . $u->info['id'] . '", 
				`type` = ' . $_POST['type'] . ',
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
				`money` = ' . $price . ' ');
    }
    if ($ins)
	{
        //$ef_now = mysql_fetch_array(mysql_query('SELECT id FROM `eff_users`
		//WHERE `uid` = ' . $u->info['id'] . ' AND `delete` = "0" AND `overType` = "777" LIMIT 1'));

		//$ef_us = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users`
		//WHERE `uid` = ' . $u->info['id'] . ' AND `delete` = "0" AND `overType` = "777"'));// AND `id`!="'.$ef_now['id'].'"

		//if ($ef_us['overType'] == 777)
		//{
            //убираем прошлые эффекты
            //$goodUse = 0;
            //$upd1 = mysql_query('UPDATE `eff_users` SET `timeUse` = 0 WHERE `uid` = "' . $u->info['id'] . '" AND `overType` = "777" AND `delete` = "0"');
            //if ($upd1) {$goodUse = 1;}

        mysql_query('DELETE FROM `eff_users` WHERE `uid` = "' . $u->info['id'] . '" AND `overType` = "777" AND `delete` = "0"') or die(mysql_error());
        //}

    	$result = mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`)
		VALUES ("' . $u->info['id'] . '","' . $eff['id2'] . '","' . $eff['mdata'] . '","' . $eff['mname'] . '","777","' . $time_end . '","1","1")');

		echo "Поздравляем! Вы успешно купили премиум!";
    } else {
        //echo "Ошибка";
    }
}