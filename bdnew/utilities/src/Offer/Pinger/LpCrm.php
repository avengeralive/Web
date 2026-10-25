<?php

class Offer_Pinger_LpCrm extends Offer_Pinger {


    public function ping($settings, \Zakaz $zakaz) {
        list($prod_id, $apikey) = explode(',', $settings);
        $res = Providers_LpCrm::registerLead($prod_id, $apikey, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$apikey, $res]),
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
			return true;
        list($site_id, $apikey, $zakaz->id) = explode(',', $zakaz->pinger_value);

        $res = Providers_LpCrm::getPaymentStatus($apikey, $zakaz->id);

        if ($res == 5 or $res == '-1'){
            return true; //ничего не сменилось, статус=1
        }
        if ($res == 6) {
            $addstatus = 4;
        } elseif ($res == 7) {
            $addstatus = 5;
        }
        $zakaz->update([
                'addstatus' => $addstatus
        ]);

        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        return true;

        list($apikey, $orderid) = explode(',', $zakaz->pinger_value);

        $res = Providers_LpCrm::getStatus($apikey, $orderid);

        $st = $res->status;
        if ($st == 0 or $st == 1){
            return true; //ничего не сменилось, статус=1
        }
        if ($st == 4 || $st == 77 || $st == 99) {
            $status = Zakaz::STATUS_REJECT;
            $comments = $res->cancel_description;
        } elseif ($st == 3) {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($st == 13 || $st == 88) {
            $status = Zakaz::STATUS_TRASH;
            $comments = $res->cancel_description;
        }
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }


}
