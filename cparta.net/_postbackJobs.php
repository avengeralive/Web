<?php
include dirname(__FILE__) . '/includes/config.php';
$time = time() ;
$db = DB::getInstance();
$sql = "select * from postback_requests where status='new' and nextTimeRequest < '$time'";
$stmt = $db->query($sql);
if ($stmt->rowCount() == 0) {
    exit;
}
$list = $stmt->fetchAll();

    foreach($list as $postback){
        $sql = "select * from postback_requests where id=".$postback['id'];
        $stmt = $db->query($sql);
        if ($stmt->rowCount() == 0) {
            continue;
        }
        $Job = $stmt->fetchObject();
        $id = $Job->id;
        if($Job->status != 'new' || $Job->nextTimeRequest > time() ){
            continue;
        }

        $arr = ['order','status','stream_id','lead_time','ip','profit','offer_id','offer_name','subid1','subid2','subid3','subid4','subid5'];
        $vars = $Job->postData;
        $vars = explode('|', $vars);
        $vars = array_combine($arr, $vars);

        $sql = "update postback_requests set status = 'working' where id='$id'";
        $db->query($sql);
        if($Job->retries >= 5){
            $sql = "update postback_requests set status = 'error' where id='$id'";
            $db->query($sql);

            if($Job->postback_id != 0){
                $str = 'постбек в настройках потока '.$Job->stream_id;
            }else{
                $str = 'глобальный постбек';
            }

            $user = User::getById($Job->user_id);
            $mail_body = 'Здравствуйте!<br /><br />Ваш '.$str.' недоступен, проверьте правильность ввода ссылки. Спасибо.<br /><br />CPA-сеть<br />https://cpa.com';
            $sender = Mailing_Sender::getDefaultSender();
            $letter = new Mailing_Letter;
            $letter->setSubject('Ошибка при отправке постбека');
            $letter->setTo($user->email);
            $letter->setHtml($mail_body);
            $sender->send($letter);

            continue;
        }

        $ch = curl_init($Job->url);
        if ($Job->type_send == 2) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($http_code !== 200){
            switch($Job->retries){
                case 0:
                    $nextTimeRequest = time() + 60;
                    break;
                case 1:
                    $nextTimeRequest = time() + 60*2;
                    break;
                case 2:
                    $nextTimeRequest = time() + 60*4;
                    break;
                case 3:
                    $nextTimeRequest = time() + 60*8;
                    break;
                case 4:
                    $nextTimeRequest = time() + 60*16;
                    break;
            }

            $sql = "update postback_requests set status = 'new',retries = retries + '1',nextTimeRequest  = '$nextTimeRequest' where id='$id'";
            $db->query($sql);
            continue;
        }


        $logs = new PostbackLogs();
        $logs->user_id = $Job->user_id;
        $logs->postback_id = $Job->postback_id;
        $logs->stream_id = $Job->stream_id;
        $logs->date_send = time();
        $logs->url = $Job->url;
        $logs->str = implode('|', $vars);
        $logs->create();

        $sql = "update postback_requests set status = 'done' where id='$id'";
        $db->query($sql);
    }
