<?php

class Offer_Pinger_СpaPrivate extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($target, $goods) = explode(',', $settings);
        
        $id = Providers_СpaPrivate::registerLead($target, $goods, $zakaz);
        
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$target, $goods, $id])
        ]);
        
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {       
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list($target, $goods, $order) = explode(',', $zakaz->pinger_value);

        $res = Providers_СpaPrivate::getStatus($target, $order);
	
        if ($res->responce != 'success') {
            return true;
        }
        
	$stat = $res->data[0]->status;
        
        if ($stat == 'waiting') {
            return true; //ничего не сменилось, статус=1
        }
        if ($stat == 'rejected') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($stat == 'approved') {
            $status = Zakaz::STATUS_HOLD;
        }
        $comments = '';
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
