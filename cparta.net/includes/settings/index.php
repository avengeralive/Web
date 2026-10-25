<?php

	// Получение данных из таблицы SETTINGS (настройки сети)
	// Get the data from the SETTINGS table (network settings)
	$sql_settings = "SELECT * FROM settings";
	$result_settings = $mysqli->query($sql_settings);
	$res_settings=mysqli_fetch_array($result_settings);
	$settings_url=htmlentities($res_settings['url']);
	$settings_registration_wm=htmlentities($res_settings['registration_wm']);
	$settings_registration_rk=htmlentities($res_settings['registration_rk']);
	$settings_admin_login=htmlentities($res_settings['admin_login']);
	$settings_zagolovok=htmlentities($res_settings['zagolovok']);
	$settings_podzagolovok=htmlentities($res_settings['podzagolovok']);
	$settings_balance_cpa=htmlentities($res_settings['balance_cpa']);
	$settings_min_vyvod=htmlentities($res_settings['min_vyvod']);
	$settings_account_max_offers=htmlentities($res_settings['account_max_offers']);
	$settings_account_max_prelandings=htmlentities($res_settings['account_max_prelandings']);
	$settings_account_max_landings=htmlentities($res_settings['account_max_landings']);
	$settings_account_max_shortlinks=htmlentities($res_settings['account_max_shortlinks']);
	$settings_account_max_subacc=htmlentities($res_settings['account_max_subacc']);
	$settings_account_max_callcenters=htmlentities($res_settings['account_max_callcenters']);
	$settings_account_max_operators=htmlentities($res_settings['account_max_operators']);
	$settings_sms_ok=htmlentities($res_settings['sms_ok']);
	$settings_smslogin=htmlentities($res_settings['smslogin']);
	$settings_smspassword=htmlentities($res_settings['smspassword']);
	$settings_smsapikey=htmlentities($res_settings['smsapikey']);
	$settings_sms_price=htmlentities($res_settings['sms_price']);
	$settings_russianpost_ok=htmlentities($res_settings['russianpost_ok']);
	$settings_russianpost_login=htmlentities($res_settings['russianpost_login']);
	$settings_russianpost_password=htmlentities($res_settings['russianpost_password']);	
	$settings_paysystem_pay=htmlentities($res_settings['paysystem_pay']);
	$settings_paysystem_landings=htmlentities($res_settings['paysystem_landings']);
	$settings_webmoney_wmr=htmlentities($res_settings['webmoney_wmr']);
	$settings_webmoney_key=htmlentities($res_settings['webmoney_key']);
	$settings_yk_obrabotchik=htmlentities($res_settings['yk_obrabotchik']);
	$settings_yk_scid=htmlentities($res_settings['yk_scid']);
	$settings_yk_shopid=htmlentities($res_settings['yk_shopid']);
	$settings_yk_shoppassword=htmlentities($res_settings['yk_shoppassword']);
	$settings_refprocent=htmlentities($res_settings['refprocent']);
	$settings_email=htmlentities($res_settings['email']);
	$settings_icq=htmlentities($res_settings['icq']);
	$settings_skype=htmlentities($res_settings['skype']);
        $settings_telegram=htmlentities($res_settings['telegram']);
        $settings_vk=htmlentities($res_settings['vk_support']);
	$settings_phone=htmlentities($res_settings['phone']);
        $settings_address=htmlentities($res_settings['address']);
	//$settings_ip_otladka=htmlentities($res_settings['ip_otladka']);
	$settings_ip_otladka='188.123.231.229';
	$settings_notice_email=htmlentities($res_settings['notice_email']);
	$settings_notice_regwebmaster=htmlentities($res_settings['notice_regwebmaster']);
	$settings_notice_regreklamodatel=htmlentities($res_settings['notice_regreklamodatel']);
	$settings_notice_addoffer=htmlentities($res_settings['notice_addoffer']);
        $settings_notice_prognoz=htmlentities($res_settings['notice_prognoz']);
        $settings_coins_min=htmlentities($res_settings['mincoins']);
?>