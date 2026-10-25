<?php

// ���� ����������� �� ���������������, �� ���������� �� �������
// If you are not an administrator, then redirect to home
if (!isset($user_tip) || $user_tip!='70')
	{
	Header('Location: ./');
	exit;
	}

// �������� ������� ����� �������������� ���������������� � �������
// We find out how much advertisers are registered in the system
$sql = "SELECT COUNT(`id`) as kolvo_rekl FROM users WHERE `tip`='40' AND `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_rekl=htmlentities($count['kolvo_rekl']);

// �������� ������� ����� ����������� ���������������� � ������� 
// We find out how many webmasters are registered in the system
$sql = "SELECT COUNT(`id`) as kolvo_webmaster FROM users WHERE `tip`='10' AND `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_webmaster=htmlentities($count['kolvo_webmaster']);

// �������� ������� ����������� �������� �� ��������� ����� (���������� ������)
// We find out how many webmasters worked for the last day ( attracted traffic)
$sql = "SELECT COUNT(DISTINCT `user_id`) as kolvo_webmaster_rabotal FROM clients_log WHERE `user_id`!='0' AND `date` >= NOW() - INTERVAL 1 DAY";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_webmaster_rabotal=htmlentities($count['kolvo_webmaster_rabotal']);

// �������� ������� � ������� �������������� ������
// We find out how the system of orders in the rough
$sql = "SELECT COUNT(`id`) as kolvo_not_leads FROM zakaz WHERE `status`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_not_leads=htmlentities($count['kolvo_not_leads']);

// �������� ������� � ������� ������� � �����
// We find out how the system of orders in the Hold
$sql = "SELECT COUNT(`id`) as kolvo_hold_leads FROM zakaz WHERE `status`='2'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_hold_leads=htmlentities($count['kolvo_hold_leads']);

// �������� ������� � ������� ���������� �������
// We find out how many paid orders system
$sql = "SELECT COUNT(`id`) as kolvo_oplachen_leads FROM zakaz WHERE `status` IN ('2','3')";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_oplachen_leads=htmlentities($count['kolvo_oplachen_leads']);

// �������� ������� � ������� ����������� �����
// We find out how many rejected orders system
$sql = "SELECT COUNT(`id`) as kolvo_otkaz_leads FROM zakaz WHERE `status`='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_otkaz_leads=htmlentities($count['kolvo_otkaz_leads']);

// �������� ������� ������� � �������
// We find out how the system offers
$sql = "SELECT COUNT(`id`) as kolvo_offer FROM offers";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_offer=htmlentities($count['kolvo_offer']);

// �������� ������� � ������� ���������� �������
// We find out how many are already working offers
$sql = "SELECT COUNT(`id`) as kolvo_active_offer FROM offers WHERE `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_active_offer=htmlentities($count['kolvo_active_offer']);

// �������� ������� ������� �� ���������
// We find out how much offers moderated
$sql = "SELECT COUNT(`id`) as kolvo_moderate_offer FROM offers WHERE `active`='2'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_moderate_offer=htmlentities($count['kolvo_moderate_offer']);

// �������� ����� ����������� ������� ��������������
// We find out the amount of the aggregate balance of advertisers
$sql = "SELECT SUM(`balance`) as summ_balance_rekl FROM users WHERE `tip`='40' AND `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$summ_balance_rekl=htmlentities($count['summ_balance_rekl']);

// �������� ����� ����������� ������� �����������
// We find out the cumulative balance of webmasters
$sql = "SELECT SUM(`balance`) as summ_balance_webmaster FROM users WHERE `tip`='10' AND `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$summ_balance_webmaster=htmlentities($count['summ_balance_webmaster']);

// �������� ����� ����������� ������� �����������
// We find out the cumulative balance of webmasters
$sql = "SELECT SUM(`hold`) as summ_balance_webmaster_hold FROM users WHERE `tip`='10' AND `active`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$summ_balance_webmaster_hold=htmlentities($count['summ_balance_webmaster_hold']);

// �������� ������� �������������� ������ �� ����� �������
// We find out how much raw Withdrawal requests
$sql = "SELECT COUNT(`id`) as vyvod_ne_obrabotano FROM finances_log WHERE `description`='4' AND `status`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$vyvod_ne_obrabotano=htmlentities($count['vyvod_ne_obrabotano']);

// �������� ����� ����� � ������
// We find out the amount of money to a conclusion
$sql = "SELECT SUM(`summ`) as vyvod_summa FROM finances_log WHERE `description`='4' AND `status`='1'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$vyvod_summa=htmlentities($count['vyvod_summa']);
if ($vyvod_summa=='') {$vyvod_summa='0';}

// �������� ������� � ������� ���������������� ���������
// We find out how the system of unactivated partners
$sql = "SELECT COUNT(`id`) as kolvo_neactive_users FROM users WHERE `active`='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_neactive_users=htmlentities($count['kolvo_neactive_users']);

// �������� ������� � ������� ��������������� ���������
// We find out how the system of blocked partners
$sql = "SELECT COUNT(`id`) as kolvo_block_users FROM users WHERE `active`='5'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$kolvo_block_users=htmlentities($count['kolvo_block_users']);

// �������� ������� ������� ���������� �� ��� ����� (���������� � ������������ ���������)
// We find out how much traffic is brought in all the time (unique and non-unique visits)
$sql = "SELECT COUNT(`ip`) as unikov_i_ne_unikov_nalito_vsego FROM clients_log WHERE `user_id`!='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_i_ne_unikov_nalito_vsego=htmlentities($count['unikov_i_ne_unikov_nalito_vsego']);

// �������� ������� ������� ���������� �� ��� ����� (������ ���������� ���������)
// We find out how much traffic is brought in all the time (only unique visits)
$sql = "SELECT COUNT(DISTINCT `ip`) as unikov_nalito_vsego FROM clients_log WHERE `user_id`!='0'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_nalito_vsego=htmlentities($count['unikov_nalito_vsego']);

// �������� ������� ������� ���������� �� ������� (������ ���������� ���������)
// We find out how much traffic is brought today (only unique visits)
$segodna_day = date('d');
$sql = "SELECT COUNT(DISTINCT `ip`) as unikov_nalito_segodna FROM clients_log WHERE `user_id`!='0' AND DATE_FORMAT(date, '%d') = '$segodna_day'";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_nalito_segodna=htmlentities($count['unikov_nalito_segodna']);

// �������� ������� ������� ���������� �� ����� (������ ���������� ���������)
// We find out how much traffic is brought yesterday (only unique visits)
$sql = "SELECT COUNT(DISTINCT `ip`) as unikov_nalito_vchera FROM clients_log WHERE `user_id`!='0' AND `date` >= (CURDATE()-1) AND `date` < CURDATE()";
$result = $mysqli->query($sql);
$count=mysqli_fetch_assoc($result);
$unikov_nalito_vchera=htmlentities($count['unikov_nalito_vchera']);

?>