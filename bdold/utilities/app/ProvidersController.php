<?php

class ProvidersController {

    public function checkMonster() {
        return ;
        $zm = new Zakaz_Manager(DB::getInstance());
        $zm->limit(-1);
        $zm->where('leadmonster_hash', '', '!=');
        $zm->where('status', 1);

        $list = $zm->get();
        foreach ($list as $order) {
            $status = Providers_MonsterLead::getStatus($order->leadmonster_hash);
            $order->update(['status' => $status]);
        }
    }

}
