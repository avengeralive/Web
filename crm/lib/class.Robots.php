<?php
namespace lib;

class Robots {

    /*
        * https://1v1-crm.ru/json/?func=Robots&action=PikassaCreatePayment
    */

    function PikassaCreatePayment(){
		$list 			= 17;
		$status			= 80;
		$pikassa		= '';

		$QQ = "SELECT * FROM list$list WHERE `status` = '$status' AND `paymentStatus` = ''";
		$date = JBase::Query($QQ);

		while($res = $date->fetch_assoc()){
			$id = $res['id'];
			$pikassa = Pikassa::CreatePayment($res);
			
			if(!$pikassa) return "Error";

			$msg = "Здравствуйте!".PHP_EOL."Вы только что сделали заказ. Пройдите пожалуйста по ссылке для предоплаты".PHP_EOL."{$pikassa['data']['paymentLink']}";
            SMS::sendSingle($list, $id, $msg);
            
            if($pikassa['success']){
                $uuid = $pikassa['data']['uuid'];
                $paymentLink = $pikassa['data']['paymentLink'];
                $QQ = "UPDATE list17 SET `paymentUuid` = '$uuid', `paymentLink` = '$paymentLink', `paymentStatus` = 'Платеж создан' WHERE `id` = '$id' AND `status` = '80'";
                JBase::Query($QQ);
            }else{
                $msg = $pikassa['error']['code'].") ".$pikassa['error']['message'];
                $QQ = "UPDATE list17 SET `paymentStatus` = '$msg' WHERE `id` = '$id' AND `status` = '80'";
                JBase::Query($QQ);
            }

		}

		return $pikassa;
    }

    /*
        * https://1v1-crm.ru/json/?func=Robots&action=PikassaCheakPayment
    */

    function PikassaCheakPayment(){
        $list = 17;
        $QQ = "SELECT * FROM list17 WHERE `status` = '80' AND (`paymentStatus` = 'Платеж создан' OR `paymentStatus` = 'InvoiceFailed')";
        $con = JBase::Query($QQ);
        $data = '';
        $status1 = [];
        while($res = $con->fetch_assoc()){
            $id = $res['id'];
            $ids = [$id];
            $data = Pikassa::CheackPaymentStatus($res);
            $data = json_decode($data, true);
            $status1[$id] = $data['data']['status']['name'];
            if($data['data']['status']['name'] == 'InvoicePaid'){
                $msg = "Ваша предоплата за заказ получена. Ожидайте информации о статусе вашего заказа";
			    SMS::sendSingle($list, $id, $msg);
                $status = $data['data']['status']['name'];
                JBase::Query("UPDATE list17 SET `paymentStatus` = '$status' WHERE `status` = '80' AND `id` = '$id'");
                JBase::statusChange(17, $ids, 31);
            }elseif($data['data']['status']['name'] == 'InvoiceFailed'){
                $status = $data['data']['status']['name'];
                JBase::Query("UPDATE list17 SET `paymentStatus` = '$status' WHERE `status` = '80' AND `id` = '$id'");
            }elseif($data['data']['status']['name'] == 'InvoiceCancelled'){
                $status = $data['data']['status']['name'];
                JBase::Query("UPDATE list17 SET `paymentStatus` = '$status' WHERE `status` = '80' AND `id` = '$id'");
                JBase::statusChange(17, $ids, 4);
            }
        }
        return $status1;
    }
    
}


?>