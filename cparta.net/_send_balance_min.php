<?php
include dirname(__FILE__) . '/includes/config.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$db = DB::getInstance();    
$sql = "select * from users where (balance_mess='1' or f_send_admin = 1) and type_rekl = 0 and tip = 40";
$stmt = $db->query($sql);
if ($stmt->rowCount() == 0) {
    exit(0);
}
$list = $stmt->fetchAll();
foreach($list as $seller){   

    $s = Seller::getById($seller['id']);
    $forecast = $s->forecastBalance();
    
    if($forecast['count'] > 5 || $forecast['zakaz'] == 0){
        continue;
    }
    
    $days_count = $forecast['count'];
    $days_str = $forecast['days_str'];
    $balance = $s->balance;
    $to_mess = '';
    $mess = '';
    
    if($days_count < 5 && $balance > 5000){
        $mess .= 'Ваш баланс достигнет 0 примерно через '.$days_count.' '.$days_str.'.';
        $mess .= '<br>Рекомендуем срочно <a href="https://yes-cpa.com/?al&id='.$s->id.'&hash='. md5($s->id.'autologin123123') .'&balance">пополнить баланс</a> во избежание остановки отправки Вам заказов!<br>';
    }
    if($days_count < 5 && $balance < 5000){
        $mess .= 'На вашем балансе не достаточно средств!<br>В ближайшее время отправка заказов будет остановлена!';
        $mess .= '<br>Рекомендуем срочно <a href="https://yes-cpa.com/?al&id='.$s->id.'&hash='. md5($s->id.'autologin123123') .'&balance">пополнить баланс</a> во избежание остановки отправки Вам заказов!<br>'; 
    }
    
    $time = time();
    $date_from = time()-3600*24*4;
    $date_to = time()-3600*24;
    $date_from = date('Y-m-d', $date_from) . ' 00:00:00';
    $date_to = date('Y-m-d', $date_to) . ' 23:59:59';
    
    $mess_to_admin = 'У рекламодателя '. $s->email .' ' . $s->alias . ' ('. $s->id .') баланс: '. $s->balance .' руб. Хватит примерно на '.$days_count.' '.$days_str.'.';
  
    $sql = "select distinct offer_id from zakaz where owner_id = '".$s->id."' and date between '".$date_from."' and '".$date_to."'";
    $db = DB::getInstance();
    $stmt = $db->query($sql);
    $row = $stmt->fetchAll();   

    if(count($row) != 0){
        $mess .= '<p style="margin-top:25px;font-weight:bold;">Заказы за последние 3 дня:</p>';
        $mess .= '<table style="width:100%;margin-top:10px;">';
        foreach($row as $z){
            $offer = Offer::getById($z['offer_id']);
            $sql = "select count(id) from zakaz where offer_id = '".$offer->id."' and owner_id = '".$s->id."' and date between '".$date_from."' and '".$date_to."'";
            $db = DB::getInstance();
            $count_zakaz =  $db->query($sql)->fetchColumn();
            
            $days_arr = ['заказ','заказа','заказов'];
            $cases = array (2, 0, 1, 1, 1, 2);
            $str_zakaz = $days_arr[ ($count_zakaz%100>4 && $count_zakaz%100<20)? 2: $cases[min($count_zakaz%10, 5)] ];            
                    
            $mess .= '<tr>';
            
            $mess .= '<td width="90px">';
            $mess .= '<img style="border-radius: 10px;padding: 10px;border: 3px solid #006b9d;height: 60px;width: 60px;" src="https://yes-cpa.com/tmp/offer'. $offer->id .'.jpg">';
            $mess .= '<td>';

            $mess .= '<td>';
            $mess .= '<b>'. $offer->name .'</b>';
            $mess .= '<td>';

            $mess .= '<td>';
            $mess .= '<b>'. $count_zakaz .' '.$str_zakaz.' за последние 3 дня</b>';
            $mess .= '<td>';
            
            $mess .= '<tr>';
            
        }
        $mess .= '</table>';
    }
    

    if($s->balance_mess == 1){
        $mail_body = 'Здравствуйте!<br /><br />'.$mess.'<br /><br />CPA-сеть<br />https://yes-cpa.com';
        $sender = Mailing_Sender::getDefaultSender();
        $letter = new Mailing_Letter;
        $letter->setSubject('Необходимо пополнить баланс');
        $letter->setTo($s->email);
        $letter->setHtml($mail_body);
        $sender->send($letter);
    }
    
    $settings = Settings::getById(1);
    
    if($settings->notice_prognoz == 1){
        
        $us = new Users_Manager(DB::getInstance());
        $us->where('tip', [70,60], Entity_Manager::WHERE_IN );
        $arr = $us->get();
        //$send_email = explode(',', trim($s->f_send_mail));
        
        foreach ($arr as $admin){
            $mail_body = 'Здравствуйте!<br /><br />'.$mess_to_admin.'<br /><br />CPA-сеть<br />https://yes-cpa.com';
            $sender = Mailing_Sender::getDefaultSender();
            $letter = new Mailing_Letter;
            $letter->setSubject('Баланс рекламодателя');
            $letter->setTo($admin->email);
            $letter->setHtml($mail_body);
            $sender->send($letter);            
        }
        
    } 
    
}