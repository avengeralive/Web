<?php

class Offer_Pinger_1v1 extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($offerID) = explode(',', $settings);

        $offer = Offer::getById($zakaz->offer_id);

        $id = Providers_1v1::registerLead($offerID, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$id])
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {



		//Берем ид заказа в функции ping выше видно как его записывали
		
        list($order) = explode(',', $zakaz->pinger_value);
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $order);
			
        $res = Providers_1v1::getStatus($order);
		$st = $res->status;
        if ($st === NULL || $st == 0) {
            return true; //статусы закрыты
        }
		
        $logger = Registry::get('di')->logger;
        $logger->info('LEADVERTEX order#' . $zakaz->id . ', response: ' . var_export($res, 1));

			
        $comments =$res->comment;

        if ($st == '17') {
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось, статус=1
        }
        if ($st == '16') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($st == '14') {
            $status = Zakaz::STATUS_TRASH;
        } elseif ($st == '18' || $st == '20') {
            $status = Zakaz::STATUS_HOLD;
        }

            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $order. '-'.$st. '-'.$status);

        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }
	
    public function checkStatus2( \Zakaz $zakaz) {
		//Берем ид заказа в функции ping выше видно как его записывали
        list($order) = explode(',', $zakaz->pinger_value);

        $res = Providers_1v1::getStatus($order);
		$status = $res->status;
        if ($status === NULL || $status == 0) {
            return true; //статусы закрыты
        }
		
        if ($status == '16') {
            $zakaz->update(['addstatus'=>5]);
            return true;
        }
        if ($status == '20') {
            $zakaz->update(['addstatus'=>4]);
            return true;
        }

        return true;
    }
}
