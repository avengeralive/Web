<?php

class Offer_Award {

    const TYPE_PERCENT = 2;
    const TYPE_MONEY = 1;

    /**
     *
     * @var Offers_Country
     */
    public $country;

    /**
     *
     * @var Offer_Region
     */
    public $region;
    public $price;
    public $currency;
    public $webmaster_award;
    public $webmaster_award_type;
    public $cpa_award;
    public $cpa_award_type;

    /**
     * Подсчитывает конкретные значения комиссии
     * @return \stdClass
     */
    public function calcAward($items = 1,$cena) {
        $res = new stdClass;
        $res->webmaster = $items * $this->webmaster_award;
        $res->cpa = $items * $this->cpa_award;
        if ($this->webmaster_award_type == self::TYPE_PERCENT) {
            $res->webmaster = round($items * $this->webmaster_award * $cena / 100, 2);
        }
        if ($this->cpa_award_type == self::TYPE_PERCENT) {
            $res->cpa = round($items * $this->cpa_award * $cena / 100, 2);
        }
        return $res;
    }

}
