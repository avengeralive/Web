<?php

class Seller extends User {

    public function getNextOrderId() {
        $sql = "select max(zakaz_number) as s from zakaz where owner_id=" . $this->id;
        $a = DB::getInstance()->query($sql)->fetchColumn();
        if (is_numeric($a)) {
            return $a + 1;
        }
        return 1;
    }

    public function forecastBalance() {
        $time = time();
        $date_from = time() - 3600 * 24 * 4;
        $date_to = time() - 3600 * 24;
        $date_from = date('Y-m-d', $date_from) . ' 00:00:00';
        $date_to = date('Y-m-d', $date_to) . ' 23:59:59';
        $sql = "select sum(summ) as sum from finances_log where description in (12,13) and date between '" . $date_from . "' and '" . $date_to . "' and user_id=" . $this->id;
        $db = DB::getInstance();
        $stmt = $db->query($sql);
        $row = $stmt->fetchObject();
        if (empty($row->sum)) {
            $arr = ['zakaz' => 0, 'count' => 0, 'days_str' => ''];
            return $arr;
        }

        $forecast = round($this->balance / ( $row->sum / 3 ));
        $days_arr = ['день', 'дня', 'дней'];
        $cases = array(2, 0, 1, 1, 1, 2);
        $days = $days_arr[($forecast % 100 > 4 && $forecast % 100 < 20) ? 2 : $cases[min($forecast % 10, 5)]];
        $arr = ['zakaz' => 1, 'count' => $forecast, 'days_str' => $days];
        return $arr;
    }

    protected $_geoPinger = false;

    /**
     * Устанавливает пингер
     * @param type $row
     * @return \Seller
     */
    public function setGeoPinger($row) {
        $this->_geoPinger = $row;
        return $this;
    }

    /**
     * Определяет продавца по оферу и клиенту, бывает так что на 1 офер разные продавцы в разных странах
     * @param Offer $offer
     * @param Client $client
     * @return Seller
     */
    public static function getByOffer(Offer $offer, Client $client) {

        // сначала проверим конкретную страну
        $sql = "select * from offers_owner where country_iso=? and offer_id=? and percent>0";

        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([
            $client->country_short,
            $offer->id
        ]);
        $doCommon = false;
        if ($stmt->rowCount() > 0) {
            // что-то есть
            $random = [];
            while ($row = $stmt->fetchObject()) {
                for ($i = 0; $i < $row->percent; $i++) {
                    $random[] = $row;
                }
            }
            if (!empty($random)) {
                $row = $random[rand(1, count($random)) - 1];
                return Seller::getById($row->owner_id);
            } else {
                $doCommon = true;
            }
        } else {
            $doCommon = true;
        }
        if ($doCommon) {
            // пробуем общее
            $sql = "Select * from offers_owner where offer_id={$offer->id} and andOther=1";
            $stmt = DB::getInstance()->query($sql);
            if ($stmt->rowCount() > 0) {
                // есть общее
                return Seller::getById($stmt->fetchObject()->owner_id);
            }
        }

        return Seller::getById($offer->owner_id);
        // 265	ad1
        // 645 kma
        // 350 monster
        if (($offer->id == 60) && in_array($client->country_short, ['MD'])) {
            return Seller::getById(350);
        }
        if (($offer->id == 46) && in_array($client->country_short, ['RU'])) {
            return Seller::getById(350);
        }

        if (($offer->id == 84) && in_array($client->country_short, ['RU', 'UA', 'KZ'])) {
            return Seller::getById(350);
        }
        if (($offer->id == 117) && in_array($client->country_short, ['UA', 'RU'])) {
            return Seller::getById(350);
        }
        if (($offer->id == 117) && $client->short_country != 'RU' && $client->short_country != 'UA') {
            return Seller::getById(46);
        }


        if (($offer->id == 54) && in_array($client->country_short, ['KZ', 'UA', 'BY'])) {
            return Seller::getById(350);
        }

        if (($offer->id == 25) && in_array($client->country_short, ['KZ'])) {
            return Seller::getById(350);
        }
        if (($offer->id == 26) && in_array($client->country_short, ['KG'])) {
            return Seller::getById(350);
        }



        if (($offer->id == 5) && in_array($client->country_short, ['UA', 'BY'])) {
            return Seller::getById(350);
        }


        if (($offer->id == 6) && in_array($client->country_short, ['UA', 'BY'])) {
            return Seller::getById(645);
        }
        ## RU на Тибурон
        if (($offer->id == 6) && in_array($client->country_short, ['RU'])) {
            return Seller::getById(613);
        }

        if (($offer->id == 21) && in_array($client->country_short, ['MD'])) {
            return Seller::getById(645);
        }
        if (($offer->id == 22) && in_array($client->country_short, ['MD'])) {
            return Seller::getById(645);
        }
        if (($offer->id == 23) && in_array($client->country_short, ['KZ'])) {
            return Seller::getById(645);
        }
        if (($offer->id == 64) && in_array($client->country_short, ['UA'])) {
            return Seller::getById(645);
        }



        if (($offer->id == 26) && in_array($client->country_short, ['UA', 'BY', 'KZ'])) {
            return Seller::getById(265);
        }
        if (($offer->id == 65) && in_array($client->country_short, ['UA', 'GE', 'KZ'])) {
            return Seller::getById(265);
        }
        if (($offer->id == 66) && in_array($client->country_short, ['UA', 'BY'])) {
            return Seller::getById(265);
        }
        if (($offer->id == 72) && in_array($client->country_short, ['UA'])) {
            return Seller::getById(265);
        }
        if (($offer->id == 169) && in_array($client->country_short, ['UA', 'RU'])) {
            return Seller::getById(265);
        }
        if (($offer->id == 174) && in_array($client->country_short, ['RU'])) {
            return Seller::getById(265);
        }
        if (($offer->id == 178) && in_array($client->country_short, ['UA'])) {
            return Seller::getById(265);
        }
        if (($offer->id == 54) && in_array($client->country_short, ['AM'])) {
            return Seller::getById(265);
        }






        if (($offer->id == 23) && $client->country_short == 'GE') {
            return Seller::getById(265);
        }

        if (($offer->id == 6 || $offer->id == 21) && $client->country_short == 'KZ') {
            return Seller::getById(265);
        }


        if ($offer->id == 6 || $offer->id == 21 || $offer->id == 23 || $offer->id == 54 || $offer->id == 104) {
            if ($client->country_short == 'KZ') {
                return Seller::getById(1052);
            }
        }

        if ($offer->id == 136 && in_array($client->short_country, ['UA', 'BY'])) {
            return Seller::getById(350);
        }
        if ($offer->id == 136 && $client->country_short == 'AM') {
            return Seller::getById(265);
        }

        if ($offer->id == 171 && $client->country_short == 'RU') {
            return Seller::getById(350);
        }
        if ($offer->id == 171 && $client->country_short == 'BY') {
            return Seller::getById(350);
        }

        if ($offer->id == 75 && $client->country_short != 'RU') {
            return Seller::getById(350); ///monster
        }
        if ($offer->id == 136 && in_array($client->short_country, ['KZ', 'KG'])) {
            return Seller::getById(1052);
        }

        if ($offer->id == 166 && $client->country_short == 'RU') {
            return Seller::getById(350); ///monster
        }


        if ($offer->id == 54 && $client->country_short == 'KG') {
            return Seller::getById(1052);
        }



        if ($offer->id == 124) {
            if ($client->country_short == 'UA') {
                return Seller::getById(74);
            }
            if ($client->country_short == 'KZ' || $client->country_short == 'KG') {
                return Seller::getById(1052);
            }
        }


        if ($offer->id == 168) {
            if ($client->country_short == 'RU') {
                return Seller::getById(613);
            }
        }
        if ($offer->id == 26) {
            if ($client->country_short == 'RU') {
                return Seller::getById(613);
            }
        }



        if ($offer->id == 134) {
            $clientNew = Client_Log::getById($client->id);
            if ($clientNew) {
                $clientNew->update([
                    'offer_id' => 124
                ]);
            }
            if ($client->country_short == 'KZ' || $client->country_short == 'KG') {
                return Seller::getById(1052);
            }
            if ($client->country_short != 'UA') {
                //$offer = Offer::getById(124);
                return Seller::getById(613);
            }
        }



        if ($offer->id == 11) {
            if ($client->country_short == 'MD' || $client->country_short = 'UA') {
                return Seller::getById(46);
            }
        }

        // Духи
        if ($offer->id == 58 && $client->country_short == 'RU') {
            return Seller::getById(472);
        }
        if ($offer->id == 58 && $client->country_short == 'KG') {
            return Seller::getById(265);
        }

        if ($offer->id == 46) {
            if ($client->country_short == 'RU') {
                return Seller::getById(308);
            }
        }

        if ($offer->id == 65) {
            if ($client->country_short != 'RU') {
                return Seller::getById(350);
            }
        }



        if ($offer->id == 59) {
            if ($client->country_short == 'UA') {
                return Seller::getById(350);
            }
        }

        return Seller::getById($offer->owner_id);
    }

}
