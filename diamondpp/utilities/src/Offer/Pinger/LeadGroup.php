<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL & ~E_NOTICE);

class Offer_Pinger_LeadGroup extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($id_l, $sub, $token) = explode(',', $settings);
        $offer = Offer::getById($zakaz->offer_id);
        $id = Providers_LeadGroup::registerLead($sub, $token, $zakaz, $offer->name, $id_l);
		// $logger = Registry::get('di')->logger;
        // $logger->text('LEADVERTEX order#' . $zakaz->id . ', response: ' . var_export($res, 1));
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $id
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        $offer = Offer::getOfferOwners($zakaz->offer_id);
        //list($id, $sub, $token) = explode(',', $zakaz->pinger_value);
        foreach ($offer as $oo) {
            if ($oo->owner_id == $zakaz->owner_id) $settings = $oo->pinger_value;
        }
        //var_dump($settings);
//var_dump($offer);
//var_dump($zakaz->pinger_value);
        $status = Providers_LeadGroup::getPaymentStatus($zakaz->pinger_value, $settings);
        if ($status == 'spam') {
            $zakaz->update(['addstatus'=>30]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'processing') {
            $zakaz->update(['addstatus'=>4]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'accepted') {
            $zakaz->update(['addstatus'=>5]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'canceled') {
            $zakaz->update(['addstatus'=>12]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'shipped') {
            $zakaz->update(['addstatus'=>33]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'delivered') {
            $zakaz->update(['addstatus'=>33]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'paid') {
            $zakaz->update(['addstatus'=>33]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'return') {
            $zakaz->update(['addstatus'=>33]);
            return true; //ничего не сменилось, статус=1
        }
        
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        //list($id, $sub, $token) = explode(',', $zakaz->pinger_value);
        // $id = $zakaz->pinger_value;
        $offer = Offer::getOfferOwners($zakaz->offer_id);
        //var_dump($offer);
        //var_dump($zakaz);
        foreach ($offer as $oo) {
            if ($oo->owner_id == $zakaz->owner_id) $settings = $oo->pinger_value;
        }
        //var_dump($settings);
        $res = Providers_LeadGroup::getStatus($zakaz->pinger_value, $settings);
        if(!isset($res->statusGroup)) return;
        $status = $res->statusGroup;
        $comments = $res->comment;
//var_dump($status); die();
        if ($status === NULL) {
            $status = Zakaz::STATUS_WAITING;
            //return true; //статусы закрыты
        }		

        elseif ($status == 'processing') {
            $status = Zakaz::STATUS_WAITING;
            //$zakaz->update(['comments'=>$comments]);
            //return true; //ничего не сменилось, статус=1
        }
        elseif ($status == 'canceled') {
            self::requestLV($zakaz,$comments);
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'spam') {
            // self::requestLV($zakaz,$comments);
            $status = Zakaz::STATUS_TRASH;
        } elseif ($status == 'accepted' || $status == 'paid' || $status == 'delivered' || $status == 'return') {
            $status = Zakaz::STATUS_APPROVED;
        }
//var_dump($status); die();
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
