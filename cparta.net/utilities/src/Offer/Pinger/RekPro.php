<?php

class Offer_Pinger_RekPro extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        //var_dump(explode(',', $settings));
        //var_dump("!");
        list($offerID) = explode(',', $settings);
        //var_dump($offerID)
        $offer = Offer::getById($zakaz->offer_id);
        $id = Providers_RekPro::registerLead($offerID, $zakaz);
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
            $logger->custom('RekPro', $zakaz->id . '-'. $order);
            
        $res = Providers_RekPro::getStatus($order);

        $st = $res->status->id;
        $sub_st = $res->sub_status->id;

        if ($st === NULL) {
            return true; //статусы закрыты
        }
        
        $logger = Registry::get('di')->logger;
        $logger->info('RekPro order#' . $zakaz->id . ', response: ' . var_export($res, 1));

            
        if ($st == 1 && ($sub_st == 0 || $sub_st == 1)) {
            $comments = "Заказ подтвержден";
            $status = Zakaz::STATUS_APPROVED;
        }
        else if ($st == 1 && $sub_st == 2) {
            $comments = "Посылка отправлена получателю, находится в пути";
            $status = Zakaz::STATUS_APPROVED;
        }
        else if ($st == 1 && $sub_st == 3) {
            $comments = "Клиент отказался выкупать посылку";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 1 && $sub_st == 6) {
            $comments = "Посылка выкуплена";
            $status = Zakaz::STATUS_APPROVED;
        }
        else if ($st == 1 && $sub_st == 7) {
            $comments = "Посылка выкуплена частично. Например оплачена только доставка или часть товара.";
            $status = Zakaz::STATUS_APPROVED;
        }
        else if ($st == -2 && $sub_st == 1) {
            $comments = "Новый заказ, ожидает обработки";
            $zakaz->update(['comments'=>$comments]);
            return true;
            //$status = Zakaz::STATUS_APPROVED;
        }
        else if ($st == -2 && $sub_st == 4) {
            $comments = "Мы дозвонились до клиента, но он попросил дать ему время подумать ,установлен перезвон на комфортное для клиента время";
            $zakaz->update(['comments'=>$comments]);
            return true;
        }
        else if ($st == -2 && $sub_st == 5) {
            $comments = "Мы дозвонились до клиента, но он попросил перезвонить позже, установлен перезвон на комфортное для клиента время";
            $zakaz->update(['comments'=>$comments]);
            return true;
        }
        else if ($st == -1 && $sub_st == 1) {
            $comments = "Клиент отказался";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == -1 && $sub_st == 2) {
            $comments = "Клиент отказался подтверждать заказ, утверждает что нашел дешевле";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == -1 && $sub_st == 3) {
            $comments = "Клиент отказался подтверждать заказ, не устроили условия доставки";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == -1 && $sub_st == 6) {
            $comments = "Клиент отказался подтверждать заказ, утверждает что просто хотел проконсультироваться по товару";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == -1 && $sub_st == 8) {
            $comments = "Абонент недоступен больше недели, не удалось дозвониться до клиентаАбонент недоступен больше недели, не удалось дозвониться до клиента";
            $status = Zakaz::STATUS_TRASH;
        }
        else if ($st == -1 && $sub_st == 12) {
            $comments = "Клиент отказался подтверждать заказ, утверждает что его не устраивает цена, дорого...";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == -1 && $sub_st == 13) {
            $comments = "Клиент отказался подтверждать заказ, утверждает что передумал";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == -1 && $sub_st == 14) {
            $comments = "Отказ. Клиент отказывается предоставлять данные для подтверждения заказа";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == -1 && $sub_st == 15) {
            $comments = "Не удалось подтвердить заказ. Клиент не говорит ни на одном из языков доступном нашему КЦ";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 1) {
            $comments = "Ошибка/Спам/Дубль";
            $status = Zakaz::STATUS_TRASH;
        }
        else if ($st == 2 && $sub_st == 2) {
            $comments = "Отклонили заказ по причине не корректных данных в заявке";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 3) {
            $comments = "Дубль. Заказ отклонен по той причине что по данному клиенту уже имеется подтвержденный заказ на этот же оффер за последние 3 дня";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 4) {
            $comments = "Тестовая заявка(отклонена)";
            $status = Zakaz::STATUS_TRASH;
        }
        else if ($st == 2 && $sub_st == 5) {
            $comments = "В оффере не поддерживается данное GEO(GEO определяется по коду телефона)";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 6) {
            $comments = "Отказ. Заказ пришлось отклонить по той причине что не имеется доставки в регион получателя";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 8) {
            $comments = "Отказ. Заказ пришлось отклонить по той причине что не имеется доставки в регион получател";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 9) {
            $comments = "Фиктивная заявка. Клиент утверждает что ранее приобрел такой же товар, а теперь ищет продавца чтобы сделать возврат товара и своих денежных средств";
            $status = Zakaz::STATUS_TRASH;
        }
        else if ($st == 2 && $sub_st == 10) {
            $comments = "В оффере не поддерживается данное GEO(GEO определяется по коду телефона)";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 11) {
            $comments = "Фиктивнaя заявка. Клиент оставил заявку что бы проконсультироватся по своей ранее оформленной заявке";
            $status = Zakaz::STATUS_TRASH;
        }
        else if ($st == 2 && $sub_st == 12) {
            $comments = "В оффере не поддерживается данное GEO(GEO определяется по коду телефона)";
            $status = Zakaz::STATUS_REJECT;
        }
        else if ($st == 2 && $sub_st == 14) {
            $comments = "Фиктивнaя заявка. Клиент оставил заявку что бы проконсультироватся купленному ранее товару";
            $status = Zakaz::STATUS_TRASH;
        }
        else if ($st == 2 && $sub_st == 15) {
            $comments = "Спам от данного Вебмастер, обратитесь к саппорту если считаете что это не спам";
            $status = Zakaz::STATUS_TRASH;
        }
            $logger = Registry::get('di')->logger;
            $logger->custom('RekPro', $zakaz->id . '-'. $order. '-'.$st. '-'.$status);
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }
    
    public function checkStatus2( \Zakaz $zakaz) {
        
        //Берем ид заказа в функции ping выше видно как его записывали
        list($order) = explode(',', $zakaz->pinger_value);

        $res = Providers_RekPro::getStatus($order);
        $status = $res->status_code;
        if ($status === NULL) {
            return true; //статусы закрыты
        }
        
        if ($status == -10) {
            $zakaz->update(['addstatus'=>5]);
            return true;
        }
        if ($status == 10) {
            $zakaz->update(['addstatus'=>4]);
            return true;
        }

        return true;
    }
}
