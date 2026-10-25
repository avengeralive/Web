<?php

class Offer_Pinger_LeadVertexKZ extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
		$logger = Registry::get('di')->logger;
		$logger->custom("lvkz"," *** Pinger сработал! *** ", var_export($data, 1));
        list($sub, $webmasterID,$good_id, $token) = explode(',', $settings);

        $vertexData = ['sub'=> $sub,'webmaster'=> $webmasterID,'token'=> $token,'good_id'=> $good_id];
		$id = Providers_LeadVertexKZ::registerLead($sub, $webmasterID, $token, $zakaz, $good_id);
		$logger->custom("lvkz"," *** Получен ли айди? *** ", var_export($data, 1), .$id);
		$zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$sub, $webmasterID, $token, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list( $sub, $webmasterID, $token, $order) = explode(',', $zakaz->pinger_value);

        $status = Providers_LeadVertexKZ::getPaymentStatus($sub, $webmasterID, $token, $order);
        if ($status == '-1') {
            $zakaz->update(['addstatus'=>5]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == '1') {
            $zakaz->update(['addstatus'=>4]);
            return true; //ничего не сменилось, статус=1
        }
        
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list( $sub, $webmasterID, $token, $order) = explode(',', $zakaz->pinger_value);

        $res = Providers_LeadVertexKZ::getStatus($sub, $webmasterID, $token, $order);
		$status = $res->status;
        if ($status === NULL) {
            return true; //статусы закрыты
        }		
        $logger = Registry::get('di')->logger;
        $logger->info('LEADVERTEX order#' . $zakaz->id . ', response: ' . var_export($res, 1));
		
        if ($status == 'processing') {
		$zakaz->update(['comments'=>$res->fields->comment]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'canceled') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'spam') {
            $status = Zakaz::STATUS_TRASH;
        } elseif ($status == 'accepted' || $status == 'paid') {
            $status = Zakaz::STATUS_HOLD;
        }
        $comments = $res->fields->comment;
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
offername;
//            $vars['additional10'] = $zakaz->user_id;
//            $vars['additional12'] = $zakaz->id;
 //       }

        $res = self::request('post', 'addOrder', $sub, $webmasterId, $token, $vars);

        if (!isset($res->OK)) {
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $res);
            throw new Exception("Не принят");
        }
        return $res->OK;
    }

    public static function getPaymentStatus($sub, $webmasterId, $token, $id) {
        $res = self::request('get', 'getOrdersByIds', $sub, $webmasterId, $token, ['ids' => $id]);
        if (!isset($res->$id)) {
            throw new Exception("Bad Request");
        }
        $data = $res->$id;
        return $data->payment->status;
    }

    public static function getStatus($sub, $webmasterId, $token, $id) {
        $res = self::request('get', 'getOrdersByIds', $sub, $webmasterId, $token, ['ids' => $id]);
        if (!isset($res->$id)) {
            throw new Exception("Bad Request");
        }
        $data = $res->$id;
        return $data;
    }

