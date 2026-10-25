<?php

class Offer_Pinger_Drcash extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {

        list($s, $api_key) = explode(',', $settings);
        
        $id = Providers_Drcash::registerLead($s, $api_key, $zakaz);

        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$id, $api_key])
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        
        return true;
        
        include_once START_PATH . '/../includes/ad1api/index.php';
        $ad1api = new ad1api();
        $send = $ad1api->GetSubID();
        $comments = '';
        $order = $zakaz->id;
        $sub_arr = $send['data']['subaccounts'];
        $subid = '';
        foreach ($sub_arr as $subs) {
            if ($subs['title'] == $order) {
                $subid = $subs['id'];
                break;
            }
        }

        if ($subid && $subid != '' && $subid != 0) {
            $send = $ad1api->GetOrder($subid);
            if ($send['data']['statsCount'] == 1) {
                $order_arr = $send['data']['stats'];
                $status = $order_arr[0]['status']['id'];
                $logger = Registry::get('di')->logger;
                $logger->info('AD1 CNFNEC#' . $zakaz->id . ',СЃС‚Р°С‚СѓСЃ: ' . $status . ' |||  response ad1: ' . var_export($send, 1));
                if ($status == 0 or $status > 4) {
                    return true;
                }
                if ($status == 3) {
                    $st = 2;
                }
                if ($status == 2) {
                    $st = 0;
                }
                if ($status == 1) {
                    $st = 2;
                }
                if ($status == 4) {
                    $st = 5;
                }
                $zakaz->updateZakaz($zakaz->id, $st, $comments);
            } else {
                //$zakaz->updateZakaz($zakaz->id, 5, 'РЎРїР°Рј/РґСѓР±Р»СЊ');
                //$logger = Registry::get('di')->logger;
                //$logger->info('AD1 CNFNEC#' . $zakaz->id . ', response ad1: ' . var_export($send, 1));				
            }
        } else {
            //$zakaz->updateZakaz($zakaz->id, 5, 'РЎРїР°Рј/РґСѓР±Р»СЊ');
            //$logger = Registry::get('di')->logger;
            //$logger->info('AD1 РЎРўРђРўРЈРЎ#' . $zakaz->id . ', response ad1: ' . var_export($send, 1));				
        }
    }

    public function checkStatus2( \Zakaz $zakaz) {
        
        return true;
        
        
        include_once START_PATH . '/../includes/ad1api/index.php';
        $ad1api = new ad1api();
        $send = $ad1api->GetSubID();
        $comments = '';
        $order = $zakaz->id;
        $sub_arr = $send['data']['subaccounts'];
        foreach ($sub_arr as $subs) {
            if ($subs['title'] == $order) {
                $subid = $subs['id'];
                break;
            }
        }
        if ($subid && $subid != '' && $subid != 0) {
            $send = $ad1api->GetOrder($subid);
            if ($send['data']['statsCount'] == 1) {
                $order_arr = $send['data']['stats'];
                $status = $order_arr[0]['status']['id'];
                if ($status != 3) {
                    return true;
                }
                if ($status == 3) {
                    $addstatus = 4;
                }
                $zakaz->update([
                    'addstatus' => $addstatus
                ]);
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

}
