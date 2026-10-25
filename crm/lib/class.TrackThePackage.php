<?php
namespace lib;

class TrackThePackage{
    
    function start(){
        $post       = (isset($_POST)) ? $_POST : $_GET;
        $ids        = $post['ids'];
        $list       = $post['list'];
        $status     = $post['status'];
        $account    = $post['account'];
        $user_id    = NULL;
        $api_key    = NULL;
        $tracks = '';
        $data = array();

        $buf = JBase::Get_Data('list50','*',['id'=>$account]);
        $buf = $buf->fetch_assoc();
        $user_id = $buf['userId'];
        $api_key = $buf['key'];

        if(is_array($ids)){
            foreach ($ids as $value) {
                $data[] = JBase::Get_Data('list'.$list,'*',['id'=>$value]);
            }
        }else{
            $data[] = JBase::Get_Data('list'.$list,'*',['id'=>$value]);
        }

        for ($i=0; $i < count($data); $i++) { 
            $result = mysqli_fetch_assoc($data[$i]);
            $tracks .= $result['russianpostTrack'];
            $trackingData[] = array(
                "trackingUserClientPhone"=>strval($result['phone']),
                    "trackingUserClientTrack"=>strval($result['russianpostTrack']),
                    "trackingUserClientEmail"=>strval($result['email']),
                    "trackingUserClientName"=>strval($result['name']),
                    "trackingUserClientItemCost"=>(int)$result['total'],
                    "sendToUserEmailFullTracking"=>(bool)false,
                    "sendToAdminEmailFullTracking"=>(bool)false,
                    "trackingUserClientOrderNumber"=>strval($result['id']),
                    "trackingUserClientDescription"=>"задержка",
                    "trackingUserPaymentType"=>(int)1,
                    'trackingUserClientDeliveryServiceId'=>0,
                    'testMode'=>false
            );
        }

        $requestKey = md5($user_id . ':' . $tracks . ':' . $api_key);
        $params = array(
            "trackingUserId"=>$user_id,
            "trackingRequestKey"=>$requestKey,
            "testMode"=>false,
            "trackingData"=>$trackingData
        );
        $posts = self::sendRequest($params);
        $r = json_decode($posts, true);
        if($r['resultState'] > 0){
            foreach($ids as $value){
                Debugging::debug('TrackThePackage','ID='.$value.' '.$posts);
                JBase::Update_Data('list19',['status'=>'87'],['id'=>$value]);
            }
        }else{
            foreach($ids as $value){
                Debugging::debug('TrackThePackage','ID='.$value.' '.$posts); 
                JBase::Update_Data('list19',['status'=>'5', 'shippedAt'=>time()],['id'=>$value]);
            }
        }
    }

    function sendRequest($params){
        $url									= "http://apilr2.r-lab.biz/addtrack.ashx";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-Type: text/plain; charset=utf-8",
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params, JSON_UNESCAPED_UNICODE));
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
}
