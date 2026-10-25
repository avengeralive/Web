<?php

class Offer_Pinger_RetailCRMZdorov extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($key, $method, $offer) = explode(',', $settings);


        $data = [
            'apiKey' => $key,
            'order' => [
                'firstName' => $zakaz->name,
                'phone' => $zakaz->phone,
                'customFields' => [
                    'ip' => $zakaz->ip,
                    'offer' => $offer,
                    'country' => $zakaz->short_country,
                    'utm_source' => 'yescpa',
                    'utm_content' => $zakaz->user_id,
                    'price_for_lead' => $zakaz->comission + $zakaz->comission_cpa,
                    'landing_url' => Offer_Landing::getById($zakaz->landing_id)->url,
                    'landing_type' => 'web',
                ]
            ],
            'orderMethod' => $method,
            'orderType' => (in_array(strtolower($zakaz->short_country), ['kz', 'ru', 'ua', 'by', 'az', 'md', 'am', 'kg', 'lv', 'lt', 'ee', 'uz']) ? strtolower($zakaz->short_country) : 'world'),
        ];
        $query = http_build_query($data);
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => $query,
            ),
        ));
        $response = file_get_contents("https://varifort.retailcrm.ru/api/v3/orders/create", false, $context);

        $json = @json_decode($response);
        if (!$response || !$json || !isset($json->success) || $json->success !== true) {
            throw new Exception("Ошибка регистрации");
        }

        $hash = implode(',', [$key, $json->id]);

        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        list($key, $id) = explode(',', $zakaz->pinger_value);
        $data = file_get_contents('https://varifort.retailcrm.ru/api/v3/orders/statuses?apiKey=' . $key . '&ids[]=' . $id);
        $json = json_decode($data);
        $status = $this->mapping($json->orders[0]->status);
        $comments = 'Статус рекламодателя: ' . $json->orders[0]->status;
        if ($status == Zakaz::STATUS_WAITING) {
            $zakaz->update(['comments' => $comments]);
            return true;
        }
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list($key, $id) = explode(',', $zakaz->pinger_value);
        $data = file_get_contents('https://varifort.retailcrm.ru/api/v3/orders/statuses?apiKey=' . $key . '&ids[]=' . $id);
        $json = json_decode($data);

        $status = $this->mapping($json->orders[0]->status);
        if (in_array($status, ['paid', 'delivered'])) {
            $zakaz->update(['addstatus' => 4]);
        }
        if (in_array($status, ['problem', 'parcel-returned', 'lost'])) {
            $zakaz->update(['addstatus' => 5]);
        }
        return true;
    }

    protected function mapping($status) {
        $statuses = [
            'nnew' => Zakaz::STATUS_WAITING,
            'additional-sale' => Zakaz::STATUS_WAITING,
            'ozhydaet' => Zakaz::STATUS_WAITING,
            'new' => Zakaz::STATUS_WAITING,
            'parcel-returned' => Zakaz::STATUS_HOLD,
            'consultation' => Zakaz::STATUS_REJECT,
            'another-door' => Zakaz::STATUS_REJECT,
            'refuse-to-receive' => Zakaz::STATUS_HOLD,
            'fake' => Zakaz::STATUS_TRASH,
            'fv' => Zakaz::STATUS_REJECT,
            'later-1' => Zakaz::STATUS_REJECT,
            'refuse-to-send' => Zakaz::STATUS_HOLD,
            'double' => Zakaz::STATUS_TRASH,
            'defect' => Zakaz::STATUS_REJECT,
            'no-call' => Zakaz::STATUS_REJECT,
            'money-from-lost' => Zakaz::STATUS_HOLD,
            'paid' => Zakaz::STATUS_HOLD,
            'problem' => Zakaz::STATUS_HOLD,
            'injob' => Zakaz::STATUS_HOLD,
            'delivered' => Zakaz::STATUS_HOLD,
            'parcel-on-a-place' => Zakaz::STATUS_HOLD,
            'sent' => Zakaz::STATUS_HOLD,
            'lost' => Zakaz::STATUS_HOLD,
            'stop' => Zakaz::STATUS_HOLD,
            'delivery-approved' => Zakaz::STATUS_HOLD,
            'later' => Zakaz::STATUS_HOLD,
            'send-cream' => Zakaz::STATUS_HOLD,
            'send' => Zakaz::STATUS_HOLD,
            'test' => Zakaz::STATUS_TRASH,
        ];
        if (isset($statuses[$status])) {
            return $statuses[$status];
        }
        return Zakaz::STATUS_REJECT;
    }

}
