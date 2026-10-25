<?php

class Export_Advansets extends Export {

    public function __construct() {
        parent::__construct();
        header("Content-Type:application/json;charset=utf8");
    }

    public function buildExport($id = false) {
        $om = new Offers_Manager($this->db);
        $om->where('active', 1);
        if ($id) {
            $om->where('id', $id);
        }

        $result = array();
        try {
            $result['status'] = 200;
            $result['error'] = '';

            $om->limit(-1);
            $list = $om->get();

            $out = array();
            foreach ($list as $offer) {
                $el = new stdClass();

                $el->id = $offer->id;
                $el->title = $offer->name;
                $el->url = 'https:///offers.php?offer='.$offer->id;
                $el->description = $offer->descr;
                $el->hold = (int) $offer->hold;
                $el->postclick = (int) $offer->postclick;
                $el->avg_approve = (int) $offer->avg_approve;
                $el->price = (int) $offer->cena;
                $el->payout_currency = 'RUB';
                $cat = Offers_Category::getById($offer->category);
                if (!$cat) {
                    $el->category = 'Не определена';
                } else {
                    $el->category = $cat->name;
                }
                if (file_exists(START_PATH . '/../tmp/offer' . $offer->id . '.jpg')) {
                    $site = Registry::get('di')->site;
                    $host = $site['host'];
                    $el->logo = $host . '/tmp/offer' . $offer->id . '.jpg';
                } else {
                    $el->logo = false;
                }

                // список стран
                $iso = $offer->getISOCountries();
                $countries = Offers_Country::getNamesByIso($iso);
                $el->geo = new stdClass();
                $el->geo->country = array();
                foreach ($countries as $iso => $name) {
                    $regions = [];
                    $rlist = $offer->getRegionsByCountry($iso);
                    if (!empty($rlist)) {

                        foreach ($rlist as $item) {

                            $regions[] = (object) array(
                                        'code' => $item->iso,
                                        'name' => $item->name_ru,
                            );
                        }
                    }

                    $el->geo->country[] = (object) array(
                                'code' => $iso,
                                'name' => $name,
                                'region' => $regions,
                    );
                }

                // доступные источники
                $el->sources = array();
                $list = $offer->getSources();
                foreach ($list as $os) {
                    $el->sources[] = (object) array(
                                'id' => (int) $os->id,
                                'title' => $os->name,
                                'legal' => (int) $os->legal,
                    );
                }

                // список транзитов / прелендинга
                $el->transits = array();
                $list = $offer->getPrelandings();
                foreach ($list as $opre) {
                    $el->transits[] = (object) array(
                                'url' => $opre->url,
                                'title' => $opre->name,
                    );
                }

                // список лендингов
                $el->landings = array();
                $list = $offer->getLandings();
                foreach ($list as $oland) {
                    $el->landings [] = (object) array(
                                'url' => $oland->url,
                                'title' => $oland->name,
                    );
                }

                //goals
                $el->goals = array();
                $offerActionString = $offer->getActionName();

                $awards = $offer->getAwards();
                $alist = array();
                foreach ($awards as $award) {

                    $item = new stdClass();
                    $item->title = $offerActionString;
                    $item->profit = $award->webmaster_award;
                    $item->currency = $award->currency;
                    $item->isPercent = ($award->webmaster_award_type == Offer_Award::TYPE_PERCENT) ? true : false;
                    $item->geo = $award->country->iso;
                    $alist[] = $item;
                }
                $el->goals = $alist;

                $out[] = $el;
            }
            $result['data'] = $out;
        } catch (Exception $e) {
            $result['status'] = 500;
            $result['error'] = $e->getMessage();
        }


        return $result;
    }

    public function getExported() {

        $result = $this->buildExport();


        return json_encode($result, JSON_PRETTY_PRINT);
    }

}
