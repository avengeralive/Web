<?php

class Offer_Pinger_DotPro extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        $logger = Registry::get('di')->logger;
	
        include_once START_PATH . '/../includes/dottapi/index.php';
        $DotttApi = new DotttApi();
        
        list( $userTo, $id) = explode(',', $settings);

        $logger->warning('order#' . $zakaz->id . ', request dotpro: ' . var_export([
                    $id, $zakaz->name, $zakaz->phone, $userTo, $zakaz->user_id, $zakaz->short_country, $zakaz->browser_name, $zakaz->subid1, $zakaz->subid2, $zakaz->subid3], 1));


        $send = $DotttApi->SendOrder($id, $zakaz->name, $zakaz->phone, $userTo, $zakaz->user_id, $zakaz->short_country, $zakaz->browser_name, $zakaz->subid1, $zakaz->subid2, $zakaz->subid3);

        if(is_null($send)){
            throw new Exception("ГЕО не подходит");
            
        }
        $logger = Registry::get('di')->logger;
        $logger->warning('order#' . $zakaz->id . ', response dotpro: ' . var_export($send, 1));

        $status = htmlentities($send['status']);
        $idDott = htmlentities($send['id']);
        //$sql_upd = "UPDATE zakaz SET `dott_id`= '$idDott',`comments`= '$status' WHERE `id`='$order_id'";


        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$userTo, $id, $idDott]),
        ]);
        return true;
    }

	
    public function checkStatus( \Zakaz $zakaz) {
        //$order = $zakaz->pinger_value;
        include_once START_PATH . '/../includes/dottapi/index.php';
        $DotttApi = new DotttApi();
        list( $userTo, $id, $order) = explode(',', $zakaz->pinger_value);
        $send = $DotttApi->GetOrder($order);
        if (!isset($send[0]['status']) or $send[0]['status'] == '-2') {
            if(!isset($send[0]['comment']) or $send[0]['comment'] == ''){
				return false;
			}
        }
        if ($send[0]['status'] == 1) {
            $status = 2;
        } elseif ($send[0]['status'] == '-1') {
            $status = 0;
        } elseif ($send[0]['status'] == 2) {
            $status = 5;
        } elseif ($send[0]['status'] == '-2') {
            $status = 1;
        }
        $comments = $send[0]['comment'];
        $zakaz->updateZakaz($zakaz->id, $status, $comments);

        return true;
    }

    
    public function checkStatus2( \Zakaz $zakaz) {
        //$order = $zakaz->pinger_value;
        include_once START_PATH . '/../includes/dottapi/index.php';
        $DotttApi = new DotttApi();
        list( $userTo, $id, $order) = explode(',', $zakaz->pinger_value);
        $send = $DotttApi->GetOrder($order);
        if(!isset($send[0]['dop_status']) or $send[0]['dop_status'] == 1){return true;}	
        if($send[0]['dop_status'] != 3 && $send[0]['dop_status'] != 6){return true;}		
        if($send[0]['dop_status'] == 3){$addstatus = 5;}
        if($send[0]['dop_status'] == 6){$addstatus = 4;}  
        
        $zakaz->update([
            'addstatus' => $addstatus
        ]);           
        return true;
    }    
}
