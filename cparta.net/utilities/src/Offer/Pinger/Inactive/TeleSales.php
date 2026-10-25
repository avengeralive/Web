<?php

class Offer_Pinger_TeleSales extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        
        list($webmaster, $advertiser, $offer_id, $token) = explode(',', $settings);
        $id = Providers_TeleSales::registerLead([
                    'token' => $token,
                    'offer_id' => $offer_id,
                    'webmaster_id' => $webmaster,
                    'advertiser' => $advertiser,
                        ], $zakaz->name, $zakaz->phone, $zakaz->ip);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$id, $token])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        if ($zakaz->addstatus == 4)
            return;
        list( $id, $token) = explode(',', $zakaz->pinger_value);
        $res = Providers_TeleSales::getPaymentStatus($token, $id);
        $status = $res->order_status_id;

        if ($status == '8') {
            $zakaz->update(['addstatus' => 4]);
            return;
        }
        if ($status == '16') {
            $zakaz->update(['addstatus' => 5]);
            return;
        }

        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list( $id, $token) = explode(',', $zakaz->pinger_value);
        $res = Providers_TeleSales::getPaymentStatus($token, $id);

        $status = $res->order_status_id;

        $comments = [];
        if (in_array($status, [1, 2, 5])) {
            $comments[] = $this->reasonToText($res->order_reason_id);
            $comments[] = $res->order_comment;
            $comments = implode(', ', array_filter($comments));
            $zakaz->update(['comments' => $comments]);
            return true;
        }
        $statusNew = -1;

        if (in_array($status, [4, 14])) {
            $comments[] = $this->reasonToText($res->order_reason_id);
            $statusNew = Zakaz::STATUS_REJECT;
        }
        if (in_array($status, [3])) {
            $comments[] = $this->reasonToText($res->order_reason_id);
            $statusNew = Zakaz::STATUS_HOLD;
        }

        if (in_array($status, [15])) {
            $statusNew = Zakaz::STATUS_TRASH;
        }

        $comments[] = $res->order_comment;

        $comments = implode(', ', array_filter($comments));

        if ($statusNew == -1) {
            $zakaz->update(['comments' => $comments]);
            return;
        }
        $zakaz->updateZakaz($zakaz->id, $statusNew, $comments);
        return true;
    }

    protected function reasonToText($id) {
        $statuses = [
            1 => 'Не устраивает доставка',
            2 => 'Не заказывал',
            3 => 'Нашел дешевле',
            4 => 'Консультация по товару',
            5 => 'Дорого',
            6 => 'Передумал',
            7 => 'Не предоставляет всех данных для подтверждения',
            8 => 'Глухой/немой, не говорит по-русски',
            9 => 'Другая причина',
            10 => 'Недоступен',
            11 => 'Не отвечает',
            12 => 'Абонент не доступен больше недели',
            13 => 'Некорректные данные',
            14 => 'Не существующий номер',
            15 => 'Не верное ГЕО',
            16 => 'Нет доставки в этот Регион',
            17 => 'Спам',
            18 => 'Претензия +',
            19 => 'Консультация по возврату',
            20 => 'Консультация по пред. заявке',
            21 => 'Тест',
            22 => 'Не берет трубку',
            23 => 'Перезвонить позже',
            24 => 'Абонент не доступен',
            25 => 'Сбрасывает',
            26 => 'Попросил отправить фото товара',
            27 => 'Хочет подумать',
            28 => 'Не может определиться с адресом доставки',
            29 => 'Хочет скидку',
            30 => 'Другая причина',
            31 => 'Назвал неправильный адрес',
            32 => 'Адрес не совпадает с IP, телефоном',
            33 => 'ФИО заказа не совпадает с исходным',
            34 => 'Другая причина',
            35 => 'Абсолютно другой товар',
            36 => 'Товар не понравился',
            37 => 'Не полная комлпектация',
            38 => 'Бракованный товар',
            39 => 'Не знает как пользоваться',
            40 => 'Стоимость выше заявленной',
            41 => 'Сломался, обращение по гарантии',
            42 => 'Посмотрю, что другу придет, Понравится - выкуплю',
            43 => 'Обещает выкупить',
            44 => 'Другая причина',
            45 => 'Не заказывал',
            46 => 'ФРОД',
            47 => 'Оплатит доставку',
            48 => 'Уже привез курьер, заказал не у нас',
            49 => 'Не успел выкупить, посылка возвращается',
            50 => 'Отказался еще при подтверждении',
            51 => 'Отказался после подтверждения',
            52 => 'Нахожусь в больницу',
            53 => 'Нахожусь в командировке',
            54 => 'Ошибка данных, уже не актуально',
            55 => 'Заказал друг, а он уехал',
            56 => 'Не хочет стоять в очередях на ПОчте',
            57 => 'Пропал интерес, не актуально',
            58 => 'Нет денег',
            59 => 'Не выдали своевременно, теперь некогда',
            60 => 'Не пойду на Почту больше',
            61 => 'Знакомые заказали такой же товар, не устроило каче',
            62 => 'Другая причина',
            63 => 'Неверное ФИО',
            64 => 'Неверный адрес',
            65 => 'Заклеен штрих код, нет возможности осуществить рег',
            66 => 'Неверные реквизиты отправителя',
            67 => 'Не выдают без уведомления',
            68 => 'Несоответствие суммы',
            69 => 'Размер посылки на почте не соответствует заказу',
            70 => 'Не получено смс с трек-кодом',
            71 => 'Не получал уведомление с почты',
            72 => 'Технические проблемы на почте',
            73 => 'Посылка ушла не по тому адресу',
            74 => 'Посылка ушла не в то ОПС этого города',
            75 => 'Посылка потерялась, нет на Почте',
            76 => 'Другая причина',
            77 => 'Не собирается выкупать',
            78 => 'Уезжает в командировку',
            79 => 'Заказ делал ребенок/родственник/друг',
            80 => 'Уже подарили такой же товар',
            81 => 'Отговорили/Передумал',
            82 => 'Заказал в другом магазине',
            83 => 'Другая причина',
            84 => 'Дубль'
        ];
        if (isset($statuses[$id])) {
            return $statuses[$id];
        }
        return false;
    }

}
