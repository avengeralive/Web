<?php

class Offer extends Entity {

    const TYPE_GOODS = 1;
    const TYPE_INFOBUSINESS = 2;
    // целевое действие
    const ACTION_CONFIRM_ORDER = 1;
    const ACTION_PAYED_ORDER = 2;
    const ACTION_REGISTRATION = 3;
    const ACTION_EFFECTIVE_REGISTRATION = 4;
    const ACTION_ONLINE_PAYMENT = 5;
    const ACTION_MOBILE_SUBSCRIBE = 6;

    public static function tableName() {
        return 'offers';
    }

    /**
     * Возвращает статистику для ТОП, Возраст, пол, устройства. 
     * Заполняется из админки
     * @return boolean|Object
     */
    public function getStat() {
        if (User::isAuth()) {
            $u = User::getById(User::isAuth());
            if ($u->tip != 70) {
                return false;
            }
        }
        $sql = "select * from offers_stat where approve_ok>0 and offer_id=" . $this->id;
        $stmt = DB::getInstance()->query($sql);
        if ($stmt->rowCount() == 0) {
            return false;
        }
        return $stmt->fetchObject();
    }

    /**
     * Возвращает статистику для ТОП, Возраст, пол, устройства. 
     * Заполняется из админки
     * @return boolean|Object
     */
    public static function getOfferOwners($id) {
        $sql = "select * from offers_owner where offer_id=" . $id . " order by country_iso asc";
        $stmt = DB::getInstance()->query($sql);
        if ($stmt->rowCount() == 0) {
            return [];
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * 
     * Обновляет показатели CR и EPC по след логике:
     * CRновое =  (Число лидов по офферу + рандом(от 50 до 400)) / ((Число кликов по офферу + 10000)
     * 
     * 
     * EPCновое = (Число заявок+рандом(50,400) * цену вознаграждения / * (число кликов + 10000 )
     * 
     * Для инфо оферов: type=2 (значения от 500 до 4000)
     */
    public static function getFakeCrAndEpcFor($id) {
        $sql = "select 100*(    
                    (select count(*) from zakaz where offer_id=o.id and status!=5) 
                        + if(1=0, 0, 
                                (if(o.type=1 or o.type=0, 
                                crc32(id)%350+50, 
                                ( crc32(id)%350+50) * 2)
                            )
                          )
                    )/
                    (if(1=0,0,10000) +(select count(*) from clients_log where offer_id=o.id))
            as cr, 
             if(round(tip_comission)=2, round(cena)/100*round(comission), round(comission) )
                    * ( if(1=0, 0, (if(o.type=1 or o.type=0, 
                        crc32(id)%350+50, 
                        ( crc32(id)%350+50) * 2)
                       )
                     ) + (select count(*) from zakaz where offer_id=o.id and status in (1,3,2) ) )/
                    (if(1=0,0, 10000)+(select count(*) from clients_log where offer_id=o.id) )
                    as epc,
                    (select count(*) from zakaz where offer_id=o.id and status!=5) as leads
                from offers as o where id=" . intval($id);
        return DB::getInstance()->query($sql)->fetchObject();
    }

    public static function getRealCrAndEpcFor($id) {
        $sql = "select 100*(    
                    (select count(*) from zakaz where offer_id=o.id and status!=5) 
                        + if(0=0, 0, 
                                (if(o.type=1 or o.type=0, 
                                crc32(id)%350+50, 
                                ( crc32(id)%350+50) * 2)
                            )
                          )
                    )/
                    (if(0=0,0,10000) +(select count(*) from clients_log where offer_id=o.id))
            as cr, 
             if(round(tip_comission)=2, round(cena)/100*round(comission), round(comission) )
                    * ( if(0=0, 0, (if(o.type=1 or o.type=0, 
                        crc32(id)%350+50, 
                        ( crc32(id)%350+50) * 2)
                       )
                     ) + (select count(*) from zakaz where offer_id=o.id and status in (1,3,2) ) )/
                    (if(0=0,0, 10000)+(select count(*) from clients_log where offer_id=o.id) )
                    as epc,
                    (select count(*) from zakaz where offer_id=o.id and status!=5) as leads
                from offers as o where id=" . intval($id);
        return DB::getInstance()->query($sql)->fetchObject();
    }

    /**
     * 
     * Обновляет показатели CR и EPC по след логике:
     * CRновое =  (Число лидов по офферу + рандом(от 50 до 400)) / ((Число кликов по офферу + 10000)
     * 
     * 
     * EPCновое = (Число заявок+рандом(50,400) * цену вознаграждения / * (число кликов + 10000 )
     * 
     * Для инфо оферов: type=2 (значения от 500 до 4000)
     */
    public static function updateCrAndEpcForAll() {
        $sql = "update offers o set 
                cr=100*(    
                    (select count(*) from zakaz where offer_id=o.id and status!=5) 
                        + if(o.real_cr=1, 0, 
                                (if(o.type=1 or o.type=0, 
                                crc32(id)%350+50, 
                                ( crc32(id)%350+50) * 2)
                            )
                          )
                    )/
                    (if(o.real_cr=1,0,10000) +(select count(*) from clients_log where offer_id=o.id)),

                epc=
                    if(round(tip_comission)=2, round(cena)/100*round(comission), round(comission) )
                    * ( if(o.real_cr=1, 0, (if(o.type=1 or o.type=0, 
                        crc32(id)%350+50, 
                        ( crc32(id)%350+50) * 2)
                       )
                     ) + (select count(*) from zakaz where offer_id=o.id and status in (1,3,2) ) )/
                    (if(o.real_cr=1,0, 10000)+(select count(*) from clients_log where offer_id=o.id) )

        ";
        DB::getInstance()->query($sql);
    }
    
    public static function updateApproveForAll() {
        $sql = "update offers o set
                avg_approve = 100 / (select count(*) from zakaz where offer_id=o.id and status!=5) * (select count(*) from zakaz where offer_id=o.id and status in (2,3))";
        
        DB::getInstance()->query($sql);

    }

    /**
     * Получает всех пользователей которым доступен офер (типа ВИП)
     * 
     * @return Entity_Manager
     */
    public function getVipUsers() {
        $um = new Users_Manager(DB::getInstance());
        $um->where(false, 'id in (select user_id from offers_visible where offer_id=' . $this->id . ')', Entity_Manager::WHERE_RAW);
        $um->limit(-1);
        return $um->get();
    }

    /**
     * Проверяет виден ли офер пользователю
     * @param int|Offer $offer_id ид офера или сам офер
     * @param int|User $user_id ид пользователя или сам пользователь
     * @return boolean
     */
    public static function isVisibleForUser($offer_id, $user_id) {
        $id = false;
        if ($offer_id instanceof Offer) {
            $id = $offer_id->id;
        } else {
            $id = $offer_id;
        }
        $uid = false;
        if ($user_id instanceof User) {
            $uid = $user_id->id;
        } else {
            $uid = $user_id;
        }
        return DB::getInstance()->query('select 1 from offers_visible where offer_id=' . intval($id) . ' and user_id=' . intval($uid))->rowCount() > 0;
    }

    /**
     * Уведомляет другие ПП 
     * @param Zakaz $zakaz
     * @return boolean
     */
    public function pingOtherCpa(Zakaz $zakaz) {
        if ($zakaz->status == Zakaz::STATUS_TRASH) {
            return;
        }
        $logger = Registry::get('di')->logger;
        $logger->info('order#' . $zakaz->id . ', check pinger send');
        //
        //        
        $this->pinger_type = '';
        $this->pinger_value = '';

        $sql = "select * from offers_owner where offer_id=" . $zakaz->offer_id . " and owner_id=" . $zakaz->owner_id . " and country_iso='" . $zakaz->short_country."'";
        try{
            $stmt = DB::getInstance()->query($sql);
        }catch(Exception $e){
            throw new Exception("Bad ip");
        }
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetchObject();
            $this->pinger_type = $row->pinger_type;
            $this->pinger_value = $row->pinger_value;
        } else {
            $sql = "select * from offers_owner where offer_id=" . $zakaz->offer_id . " and andOther=1";
            $stmt = DB::getInstance()->query($sql);
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetchObject();
                $this->pinger_type = $row->pinger_type;
                $this->pinger_value = $row->pinger_value;
            }
        }
        //
        
        if ($this->pinger_type == '') {

            $logger->info('order#' . $zakaz->id . ', has no pinger_type');
            return true;
        }

            $logger->info('offer#' . $this->id . ', has: ' . $this->pinger_type);
            $classes = explode(',', $this->pinger_type);
            $values = explode(':', $this->pinger_value);
            $id = 0;
        
        foreach ($classes as $class) {
            $logger->info('order#' . $zakaz->id . ', try to register in ' . $class);
            $pinger = new $class;
            $pinger->setOffer($this);
            $value = '';
            if (isset($values[$id])) {
                $value = $values[$id];
            }
            $id++;
            try {
                $ret = $pinger->ping($value, $zakaz);
            } catch (Exception $e) {
                $logger->info('PingerType: ' . $class . ' made exception: ' . $e->getMessage() . ", order #" . $zakaz->id);
                $zakaz->updateZakaz($zakaz->id, 5, 'Не принят');
                return;
            }


            if ($ret) {
                $logger->info('order#' . $zakaz->id . ', success register in ' . $class);
                return $ret;
            }
            $logger->info('order#' . $zakaz->id . ', failed register in ' . $class);
        }
        $logger->info('order#' . $zakaz->id . ', no pingers return true');
        $zakaz->updateZakaz($zakaz->id, 5, 'Рекламодатель не принял заказ');
        return false;
    }

    public function getTrands($type = false) {
        $sql = "select * from offers_trands where offer_id=" . $this->id . " order by `date` desc limit 12"; //за год же
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        $list = [];
        while ($row = $stmt->fetchObject()) {
            $el = [];
            if (!$type) {
                $el['yandex'] = (int) $row->yandex;
                $el['google'] = (int) $row->google;
                $el['publer'] = (int) $row->publer;
            } else {
                $el[$type] = (int) $row->$type;
            }
            $list[$row->date] = $el;
        }
        $start = strtotime('first day of this month');
        for ($i = 0; $i < 12; $i++) {
            $month = $start - 60 * 24 * 60 * 30 * $i;
            $monthKey = date("Y-m", $month);
            if (isset($list[$monthKey]))
                continue;
            if ($type) {
                $list[$monthKey][$type] = 0;
                continue;
            }
            $list[$monthKey] = [
                'yandex' => 0,
                'publer' => 0,
                'google' => 0,
            ];
        }
        krsort($list);
        return $list;
    }

    /**
     * Возвращает вознаграждение за офер
     * @return \Offer_Award
     */
    public function getAwards() {
        $sql = "select * from offers_visible where offer_id = ".$this->id." and user_id = ".$user_id; //за год же
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        
        $offer_comission_res = $stmt->fetchAll();
        if (is_array($offer_comission_res) && count($offer_comission_res) > 0) {
            $this->comission = $offer_comission_res[0]['comission'];
            $this->comission_cpa = $offer_comission_res[0]['comission_cpa'];
        }
        
        $l = explode('|', $this->geo);
        $awardType = explode('|', $this->tip_comission);
        $awardTypeCpa = explode('|', $this->tip_comission_cpa);

        $awards = explode('|', $this->comission);
        $awardsСpa = explode('|', $this->comission_cpa);
        $prices = explode('|', $this->cena);

        $countries = explode(':', $l[0]);
        $regions = array();
        if (isset($l[1])) {
            $regions = explode(':', $l[1]);
        }
        $list = array();
        foreach ($countries as $id => $name) {
            $el = new Offer_Award;
            $country = new Offers_Country;
            $country->iso = $name;
            $names = Offers_Country::getNamesByIso(array($name));
            $country->name = isset($names[$name]) ? $names[$name] : 'NA';
            $el->currency = Offers_Country::getCurrencyByIso($name);
            if (isset($regions[$id]) && $regions[$id] > 0) {
                $el->region = Offer_Region::getById($regions[$id]);
            }
            $el->price = $prices[$id];
            $el->webmaster_award = $awards[$id];
            $el->webmaster_award_type = $awardType[$id];
            $el->cpa_award = $awardsСpa[$id];
            $el->cpa_award_type = $awardTypeCpa[$id];
            $el->country = $country;
            $list[] = $el;
        }

        return $list;
    }

    /**
     * Оповещает другие партнерки по необходимости
     * @param Zakaz $zakaz
     */
    public function PingResellers(Zakaz $zakaz) {
        
    }

    public function getISOCountries() {
        $l = explode('|', $this->geo);
        $c = explode(':', $l[0]);
        $list = array();
        foreach ($c as $country) {
            $list[$country] = true;
        }
        return array_keys($list);
    }

    /**
     * @TODO: по сути это не офера задача, нужно будет вынести в другой класс
     * @return type
     */
    public function getActionName() {
        $db = DB::getInstance();
        return ($a = $db->query("select deystvie from deystvie_tpl where id=" . intval($this->deystvie))->fetchColumn()) ? $a : false;
    }

    public function getRegionsByCountry($iso) {
        $l = explode('|', $this->geo);

        $db = DB::getInstance();
        $countries = explode(':', $l[0]);
        $regions = explode(':', $l[1]);
        $list = array();
        if (array_search(strtoupper($iso), $countries) === false) {
            return $list;
        }
        foreach ($countries as $id => $name) {
            if (strtoupper($name) != strtoupper($iso)) {
                continue;
            }
            $region = $regions[$id];
            if ($region == 0) {
                continue;
            }
            $sql = "select * from sxgeo_regions where id=" . intval($region);
            $row = $db->query($sql)->fetchObject();
            if (!$row) {
                continue;
            }
            $el = new Offer_Region;
            $el->setRow($row);
            $list[] = $el;
        }
        return $list;
    }

    /**
     * 
     * @return \Offer_Prelanding
     */
    public function getPrelandings() {
        $list = array();
        $db = DB::getInstance();
        $sql = "select * from prelandings where offer_id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->id));
        while ($row = $stmt->fetchObject()) {
            $el = new Offer_Prelanding;
            $el->setRow($row);
            $list[] = $el;
        }
        return $list;
    }

    /**
     * Возвращает все лендинги офера
     * @return \Offer_Landing
     */
    public function getLandings() {
        $list = array();
        $db = DB::getInstance();
        $sql = "select * from landings where offer_id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->id));
        while ($row = $stmt->fetchObject()) {
            $el = new Offer_Landing;
            $el->setRow($row);
            $list[] = $el;
        }
        return $list;
    }

    /**
     * Возвращает все источники офера
     * @return boolean|\Offer_Source
     */
    public function getSources() {
        $list = array();
        $db = DB::getInstance();
        $tip = explode('|', $this->tip_traffic);
        $ids = array();
        $id = 1;
        foreach ($tip as $status) {

            if ($status) {
                $ids[] = $id;
            }
            $id++;
        }
        if (empty($ids)) {
            return false;
        }

        $sql = "select id, tip as name, if(id in (" . implode(',', array_fill(0, count($ids), '?')) . '), 1,0) as legal  from tip_traffic_tpl';
        $stmt = $db->prepare($sql);
        $stmt->execute($ids);
        while ($row = $stmt->fetchObject()) {
            $el = new Offer_Source;
            $el->setRow($row);
            $list[] = $el;
        }
        return $list;
    }

    /**
     * Возвращает офферы для веба где был хоть один переход
     */
    public function getByWebmaster($user_id) {
        $list = array();
        $db = DB::getInstance();
        $sql = "select id,name from offers where id in (select distinct offer_id from clients_log where user_id=" . $user_id . ")";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }
        return $list;
    }

    /**
     * Возвращает офферы для рекла где был хоть один переход
     */
    public function getBySeller($user_id) {
        $list = array();
        $db = DB::getInstance();
        $sql = "select id,name from offers where owner_id =" . $user_id;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }
        return $list;
    }

    /**
     * Возвращает офферы для админа где был хоть один переход
     */
    public function getByAdmin() {
        $list = array();
        $db = DB::getInstance();
        $sql = "select id,name from offers";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }
        return $list;
    }
    
    /**
     * Возвращает Похожие офферы
     */
    public static function getSimilarTo($id) {
        $list = array();
        $db = DB::getInstance();
        $sql = "select similar from offer_similar where offer_id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetchColumn();
        return $row;
    }
    
    /**
     * Возвращает офферы на главную
     */    
    public static function getOffersTop($limit) {
        $list = array();
        $db = DB::getInstance();
        $sql = "select id,name,cr,epc,comission from offers where active = 1 and home=1 order by epc desc limit ".$limit;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }
        /*
        if(count($list) < 8){
            //$limit = 8 - count($list);
            $sql = "select id,name,(select count(id) from zakaz where offer_id = offers.id) as z from offers where active=1 and uroven_dostupa > 0 order by z desc limit ".$limit;
            $stmt = $db->prepare($sql);
            $stmt->execute();    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $list[] = $row;
            }            
        }
         * 
         */


        return $list;
    }    
    
    /**
     * Возвращает офферы на главную
     */    
    public static function getNewOffers($limit) {
        $list = array();
        $db = DB::getInstance();
        $sql = "select id,name,cr,epc,comission from offers where active = 1 and type_offer != 4 order by id desc limit ".$limit;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }
        /*
        if(count($list) < 8){
            //$limit = 8 - count($list);
            $sql = "select id,name,(select count(id) from zakaz where offer_id = offers.id) as z from offers where active=1 and uroven_dostupa > 0 order by z desc limit ".$limit;
            $stmt = $db->prepare($sql);
            $stmt->execute();    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $list[] = $row;
            }            
        }
         * 
         */


        return $list;
    }    
}
