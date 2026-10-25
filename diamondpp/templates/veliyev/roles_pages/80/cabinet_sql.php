<?php

// Если выполняется не администратором, то редиректим на главную
// If you are not an administrator, then redirect to home
if (!isset($user_tip) || $user_tip!='80')
	{
	Header('Location: ./');
	exit;
	}

// Выясняем сколько всего рекламодателей зарегистрировано в системе
// We find out how much advertisers are registered in the system
$sql = "SELECT COUNT(`id`) as kolvo_rekl FROM users WHERE `tip`='40' AND `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_rekl=htmlentities($count['kolvo_rekl']);

// Выясняем сколько всего вебмастеров зарегистрировано в системе 
// We find out how many webmasters are registered in the system
$sql = "SELECT COUNT(`id`) as kolvo_webmaster FROM users WHERE `tip`='10' AND `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_webmaster=htmlentities($count['kolvo_webmaster']);

// Выясняем сколько вебмастеров работало за последние сутки (привлекало трафик)
// We find out how many webmasters worked for the last day ( attracted traffic)
$sql = "SELECT COUNT(DISTINCT `user_id`) as kolvo_webmaster_rabotal FROM clients_log WHERE `user_id`!='0' AND `date` >= NOW() - INTERVAL 1 DAY";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_webmaster_rabotal=htmlentities($count['kolvo_webmaster_rabotal']);

// Выясняем сколько в системе необработанных заявок
// We find out how the system of orders in the rough
$sql = "SELECT COUNT(`id`) as kolvo_not_leads FROM zakaz WHERE `status`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_not_leads=htmlentities($count['kolvo_not_leads']);

// Выясняем сколько в системе заказов в холде
// We find out how the system of orders in the Hold
$sql = "SELECT COUNT(`id`) as kolvo_hold_leads FROM zakaz WHERE `status`='2'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_hold_leads=htmlentities($count['kolvo_hold_leads']);

// Выясняем сколько в системе оплаченных заказов
// We find out how many paid orders system
$sql = "SELECT COUNT(`id`) as kolvo_oplachen_leads FROM zakaz WHERE `status`='3'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_oplachen_leads=htmlentities($count['kolvo_oplachen_leads']);

// Выясняем сколько в системе отклоненных лидов
// We find out how many rejected orders system
$sql = "SELECT COUNT(`id`) as kolvo_otkaz_leads FROM zakaz WHERE `status`='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_otkaz_leads=htmlentities($count['kolvo_otkaz_leads']);

// Выясняем сколько офферов в системе
// We find out how the system offers
$sql = "SELECT COUNT(`id`) as kolvo_offer FROM offers";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_offer=htmlentities($count['kolvo_offer']);

// Выясняем сколько в системе работающих офферов
// We find out how many are already working offers
$sql = "SELECT COUNT(`id`) as kolvo_active_offer FROM offers WHERE `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_active_offer=htmlentities($count['kolvo_active_offer']);

// Выясняем сколько офферов на модерации
// We find out how much offers moderated
$sql = "SELECT COUNT(`id`) as kolvo_moderate_offer FROM offers WHERE `active`='2'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_moderate_offer=htmlentities($count['kolvo_moderate_offer']);



// Выясняем сколько в системе неактивированных партнеров
// We find out how the system of unactivated partners
$sql = "SELECT COUNT(`id`) as kolvo_neactive_users FROM users WHERE `active`='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_neactive_users=htmlentities($count['kolvo_neactive_users']);

// Выясняем сколько в системе заблокированных партнеров
// We find out how the system of blocked partners
$sql = "SELECT COUNT(`id`) as kolvo_block_users FROM users WHERE `active`='5'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_block_users=htmlentities($count['kolvo_block_users']);

// Выясняем сколько трафика привлечено за все время (уникальные и неуникальные посещения)
// We find out how much traffic is brought in all the time (unique and non-unique visits)
$sql = "SELECT COUNT(`ip`) as unikov_i_ne_unikov_nalito_vsego FROM clients_log WHERE `user_id`!='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_i_ne_unikov_nalito_vsego=htmlentities($count['unikov_i_ne_unikov_nalito_vsego']);

// Выясняем сколько трафика привлечено за все время (только уникальные посещения)
// We find out how much traffic is brought in all the time (only unique visits)
$sql = "SELECT COUNT(DISTINCT `ip`) as unikov_nalito_vsego FROM clients_log WHERE `user_id`!='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_nalito_vsego=htmlentities($count['unikov_nalito_vsego']);

// Выясняем сколько трафика привлечено за сегодня (только уникальные посещения)
// We find out how much traffic is brought today (only unique visits)
$segodna_day = date('d');
$sql = "SELECT COUNT(DISTINCT `ip`) as unikov_nalito_segodna FROM clients_log WHERE `user_id`!='0' AND DATE_FORMAT(date, '%d') = '$segodna_day'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_nalito_segodna=htmlentities($count['unikov_nalito_segodna']);

// Выясняем сколько трафика привлечено за вчера (только уникальные посещения)
// We find out how much traffic is brought yesterday (only unique visits)
$sql = "SELECT COUNT(DISTINCT `ip`) as unikov_nalito_vchera FROM clients_log WHERE `user_id`!='0' AND `date` >= (CURDATE()-1) AND `date` < CURDATE()";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_nalito_vchera=htmlentities($count['unikov_nalito_vchera']);

?>