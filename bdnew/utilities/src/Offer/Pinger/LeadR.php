<?php
// 89bcb03ab8b03b0fc8db9728c9fcbf0d
class Offer_Pinger_LeadR extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {

        list($flow, $u, $api_key) = explode(',', $settings);
        
        $id = Providers_LeadR::registerLead($flow, $u, $api_key, $zakaz);

        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$id, $u, $api_key])
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list( $id, $u, $api_key ) = explode(',', $zakaz->pinger_value);

        $res = Providers_LeadR::getStatus($id, $u, $api_key);

        if ($res['status'] === NULL) {
            return true; //статусы закрыты
        }		
	
        $comments = $res['comment'];
                
        if ($res['status'] == 0 || $res['status'] == '-2') {
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось
        }
        if ($res['status'] == '-1') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($res['status'] == 2) {
            $status = Zakaz::STATUS_TRASH;
        } elseif ($res['status'] == 1 || $res['status'] == 3) {
            $status = Zakaz::STATUS_HOLD;
        }

        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
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
