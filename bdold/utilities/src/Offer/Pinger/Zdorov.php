<?php

class Offer_Pinger_Zdorov extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        
        list($url, $login, $passw, $offer) = explode(',', $settings);
        $link = 'https://'.$url.'/webservice.php';
        $id = Providers_Vtiger::registerLead($link, $login,$passw,$offer,$zakaz);
        
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$url, $login, $passw, $id])
        ]);
        
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {       
        list($url, $login, $passw, $order) = explode(',', $zakaz->pinger_value);
        $url = 'https://'.$url.'/webservice.php';
        $res = Providers_Vtiger::getStatus($url, $login, $passw, $order);

	$stat = $res['sostatus'];

        $status_arr_wait = [
            'Новый',
            'В обработке',
            'Ожидает оплаты',
            'Отправлять',
            'Доставка согласована',
            'Приостановлен',
            'Доставить позже',
            'Отправлен',
            'Товар в точке получения',
            'Требует доработки оператора',
            'Доставлять',
            ];  
        $status_arr_paid = [
            'Товар получен',
            'Деньги получены',
            'Деньги получены от потери'
            ];
        $status_arr_frod = [
            'Фейк вернулся',
            'Отказ от получения',
            'Посылка вернулась',
            'Отказ от отправки',
            
            ];        
        
        if (in_array($stat, $status_arr_wait)) {
            return true; //ничего не сменилось, статус=1
        } 
        if (in_array($stat, $status_arr_paid)) {
            $zakaz->update([
                'addstatus' => 4
            ]); 
            return true;
        }    
        if (in_array($stat, $status_arr_frod)) {
            $zakaz->update([
                'addstatus' => 5
            ]); 
            return true;
        }        
        
    }

    public function checkStatus( \Zakaz $zakaz) {

        list($url, $login, $passw, $order) = explode(',', $zakaz->pinger_value);
        $url = 'https://'.$url.'/webservice.php';
        $res = Providers_Vtiger::getStatus($url, $login, $passw, $order);

	$stat = $res['sostatus'];
        
        if ($stat == 'Новый' || $stat == 'В обработке' || $stat == 'Ожидает оплаты') {
            return true; //ничего не сменилось, статус=1
        }
        
        $status_arr_approove = [
            'Отправлять',
            'Доставка согласована',
            'Приостановлен',
            'Доставить позже',
            'Отправлен',
            'Товар в точке получения',
            'Товар получен',
            'Требует доработки оператора',
            'Доставлять',
            'Деньги получены',
            'Отказ от отправки',
            'Отказ от получения',
            'Посылка вернулась',
            'Деньги получены от потери'
            ];
        $status_arr_reject = [
            'Дубль',
            'Брак',
            'Недозвон',
            'Консультация',
            'Не целевой',
            'Отказ',
            'Тест',
            'Фейк',
            'Фейк вернулся'
            ];     
            
        if (in_array($stat, $status_arr_reject)) {
            $status = Zakaz::STATUS_REJECT;
        } elseif (in_array($stat, $status_arr_approove)) {
            $status = Zakaz::STATUS_HOLD;
        }
        $comments = $res['sp_operator_comment_one'] .'|'. $res['sp_operator_comment_two'];
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
