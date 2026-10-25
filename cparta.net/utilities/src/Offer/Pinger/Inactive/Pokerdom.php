<?php

class Offer_Pinger_Pokerdom extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        $comments = '';
        $status = Zakaz::STATUS_HOLD;

        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

}
