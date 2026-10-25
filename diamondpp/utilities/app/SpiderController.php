<?php

class SpiderController {

    protected $ch;

    public function __construct() {
        
    }

    protected function curlInit() {
        $ch = curl_init();
        $tmp = tempnam('/tmp', 'curl');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $tmp);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $tmp);
        curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36');
        return $ch;
    }

    protected function curlGet($ch, $url) {
        curl_setopt($ch, CURLOPT_URL, $url);
        return $this->curlRun($ch);
    }

    protected function curlPost($ch, $url, $data = []) {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        return $this->curlRun($ch);
    }

    protected function curlRun($ch) {
        $data = curl_exec($ch);
        return $data;
    }

    public function tlight() {
	echo '<pre>';
        set_time_limit(0);
        ignore_user_abort(1);

        $chT = $this->curlInit();
        $orders = [];
        if (file_exists('.tlight')) {
            $orders = json_decode(file_get_contents('.tlight'), true);
        }
        //$orders = [];
        // login
        $this->curlGet($chT, 'http://cpa.tlight.biz');
        $this->curlPost($chT, 'http://cpa.tlight.biz/auth/login/', [
            'username' => 'fun_cpa',
            'password' => '@rteyjb23',
        ]);

        $orderList = $this->curlGet($chT, 'http://cpa.tlight.biz/orders/?crm_id=&status=&created_at_from=2016-11-13&created_at_to=&trash_status=&items_per_page=1000&country=&advertiser_comments=&subaccount=&offer=');

        preg_match_all('/grid.*?tbody.*?(.*?)<\/table>/ismu', $orderList, $res);
        preg_match_all('/<tr.*?>(.*?)<\/tr>/ismu', $res[1][1], $res);

        //0-wait
        //10-work


        $i = 0;
        foreach ($res[1] as $row) {
            if ($i == 1) {
                //break;
            }


            $row = explode('</td>', $row);
            if (!isset($row[2]))
                continue;
            $i++;

            $orderId = trim(strip_tags($row[0]));
            $name = trim(strip_tags($row[7]));
            $phone = trim(strip_tags($row[8]));
            $ip = trim(strip_tags($row[10]));
            var_dump($orderId, $name, $phone, $ip);

            if (!isset($orders[$orderId])) {
                //новый заказ который небыл в бд
                $api = $this->curlInit();

                if (1) {
                    $res = $this->curlPost($api, 'http://api./v1/order', [
                        'key' => 'c99386939bd5a5e6f513f0687cbf2f29',
                        'stream' => 417,
                        'clientname' => $name,
                        'phone' => $phone,
                        'ip' => $ip,
                    ]);
                    $res = json_decode($res);
                    if (isset($res->id)) {
                        $orders[$orderId] = ['status' => 1, 'id' => $res->id];
                    }
                }

                // post work
                $this->curlGet($chT, 'http://cpa.tlight.biz/orders/' . $orderId);
                $this->curlPost($chT, 'http://cpa.tlight.biz/orders/' . $orderId, [
                    'customer_address' => '',
                    'in_progress' => 'В работе',
                    'advertiser_comments' => '',
                ]);
            } else {
                //есть заказ
		echo "<hr>";
                echo "Exists";

                $order = $orders[$orderId];
                $status = $order['status'];
                $internalId = $order['id'];
                $o = Zakaz::getById($internalId);
		echo "$orderId / $internalId / $status".PHP_EOL;
//		$status = 1;

                if (($o->status == Zakaz::STATUS_REJECT || $o->status == Zakaz::STATUS_TRASH) && ($status != Zakaz::STATUS_TRASH)) {
                    $this->curlPost($chT, 'http://cpa.tlight.biz/orders/' . $orderId, [
                        'customer_address' => '',
                        'real_status' => '-10',
                        'real_status_reason' => $o->comments,
                        'advertiser_comments' => $o->comments.' / '.$internalId,
                    ]);
                    $orders[$orderId]['status'] = Zakaz::STATUS_TRASH;
                }
		
                if (( $o->status == Zakaz::STATUS_HOLD || $o->status == Zakaz::STATUS_APPROVED) && ($status != Zakaz::STATUS_APPROVED)) {
                    $this->curlPost($chT, 'http://cpa.tlight.biz/orders/' . $orderId, [
                        'customer_address' => '',
                        'real_status' => '10',
                        'real_status_reason' => $o->comments,
                        'advertiser_comments' => $o->comments.' / '.$internalId,
                    ]);
                    $orders[$orderId]['status'] = Zakaz::STATUS_APPROVED;
                }
                if ($o->status == 1) {
                    $this->curlPost($chT, 'http://cpa.tlight.biz/orders/' . $orderId, [
                        'customer_address' => '',
                        'real_status' => '0',
                        'real_status_reason' => $o->comments,
                        'advertiser_comments' => $o->comments.' / '.$internalId,
                    ]);
                    $orders[$orderId]['status'] = Zakaz::STATUS_WAITING;
                }
            }
        }




        //save
        file_put_contents('.tlight', json_encode($orders));
    }

}
