<?php

class ApiController {

    /**
     *
     * @var Api
     */
    protected $api;

    /**
     *
     * @var User
     */
    protected $user;

    public function __construct() {
        $this->api = new Api(new Api_Request(new Request($_REQUEST)), new Api_Response);
        // $this->checkKey();
    }


    /**
     * Получает статистику пользователя за последние 30д
     */
    public function getUserStat() {
        $res = $this->api->getResponse();
        $res->balance = $this->user->balance;
        $res->hold = $this->user->hold;
        $detailed = [];

        $type = 'days';
        if ($this->api->getRequest()->by == 'month') {
            $type = 'month';
        }
        if ($type == 'days') {
            for ($i = 0; $i < 30; $i++) {
                $start = ( date('Y-m-d', strtotime('-' . $i . ' days')) );
                $end = ( date('Y-m-d', strtotime('-' . ($i - 1) . ' days')) );
                $sql = "select sum(comission*kolvo) from zakaz where status in (2,3) and user_id=" . $this->user->id . " and `date` between '$start' and '$end'";
                //echo $sql;
                $total = floatval(DB::getInstance()->query($sql)->fetchColumn());
                $detailed[] = ['start' => $start, 'end' => $end, 'earn' => $total];
            }
        }
        if ($type == 'month') {
            for ($i = 0; $i < 12; $i++) {
                $start = date('Y-m-d', strtotime('first day of -' . $i . ' month'));
                $end = date('Y-m-d', strtotime('first day of -' . ($i - 1) . ' month'));

                $sql = "select sum(comission*kolvo) from zakaz where status in (2,3) and user_id=" . $this->user->id . " and `date` between '$start' and '$end'";
                $total = floatval(DB::getInstance()->query($sql)->fetchColumn());
                $detailed[] = ['start' => $start, 'end' => $end, 'earn' => $total];
            }
        }
        $res->detailed = $detailed;
        echo $res;
    }

    /**
     * Создает пользователя
     * @return boolean
     */
    public function createUser() {

        try {

            $this->api->getRequest()->validate('skype', function($val) {
                return strlen($val) > 3;
            });
            $this->api->getRequest()->validate('email', function($val) {
                return filter_var($val, FILTER_VALIDATE_EMAIL);
            });
            $this->api->getRequest()->validate('password', function($pass) {
                return strlen($pass) > 4;
            });
            $this->api->getRequest()->validate('ip', function($ip) {
                return filter_var($ip, FILTER_VALIDATE_IP);
            });
            $u = new User;
            $req = $this->api->getRequest();
            $u->skype = $req->skype;
            $u->email = $req->email;
            $u->password = $req->password;
            $u->ip = $req->ip;
            if (isset($req->name)) {
                $u->name = $req->name;
            }


            $newUser = $this->api->createUser($u);
            $this->api->getResponse()->id = $newUser->id;
            $this->api->getResponse()->key = $newUser->apikey;
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode() ? $e->getCode() : Api_Response::STATUS_BADREQUEST);
            exit;
        }
        echo $this->api->getResponse();
        return true;
    }

    /**
     * Установить Пользователя апи модуля
     * @param User $user
     * @return \ApiController
     */
    public function setUser(User $user) {
        $this->user = $user;
        $this->api->setUser($user);
        return $this;
    }

    public function checkKey() {

        try {
            $this->api->getRequest()->validate('key');

            $key = $this->api->getRequest()->key;
            if ($key == '') {
                throw new Exception("key must be not empty", Api_Response::STATUS_BADREQUEST);
            }

            $this->setUser(User::getByApiKey($key));
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode() ? $e->getCode() : Api_Response::STATUS_DENY);
            exit;
        }

        return true;
    }

    public function getNews() {
        echo $this->api->getNews();
    }

    public function getOrderStatus($id) {
        $this->checkKey();
        try {
            echo $this->api->getOrderStatus($id);
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode() ? $e->getCode() : Api_Response::STATUS_DENY);
            exit;
        }

        return true;
    }

    public function getOrdersStatuses() {
        $this->checkKey();
        try {
            $this->api->getRequest()->validate('ids', function($ids) {
                return strlen($ids) > 0;
            });
            $ids = $this->api->getRequest()->ids;
            
            echo $this->api->getOrdersStatuses($ids);
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode() ? $e->getCode() : Api_Response::STATUS_DENY);
            exit;
        }

        return true;
    }

    public function forgot() {
        try {

            $this->api->getRequest()->validate('email', function($e) {
                return filter_var($e, FILTER_VALIDATE_EMAIL);
            });
            $this->api->userSendForgetEmail($this->api->getRequest()->email);
        } catch (Exception $e) {

            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
            return;
        }
        echo $this->api->getResponse();
    }

    public function login() {
        try {
            $this->api->getRequest()->validate('email');
            $this->api->getRequest()->validate('password');
            $req = $this->api->getRequest();
            $u = User::login($req->email, $req->password);
            $this->api->getResponse()->balance = $u->balance;
            $this->api->getResponse()->hold = $u->hold;
            $this->api->getResponse()->name = $u->name;
            $this->api->getResponse()->email = $u->email;
            $this->api->getResponse()->skype = $u->skype;
            $this->api->getResponse()->key = $u->apikey;
            $this->api->getResponse()->id = $u->id;
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
            return;
        }
        echo $this->api->getResponse();
    }

    public static function answerLeadvertex($id,$comments,$status = null){
        $url = 'https://sjb.leadvertex.ru/api/admin/updateOrder.html?token=123456&id='.$id;

        $curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($status){
            curl_setopt($curl, CURLOPT_POSTFIELDS, "status=".$status."&comment=".$comments);
        }else{
            curl_setopt($curl, CURLOPT_POSTFIELDS, "comment=".$comments);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
 		$posts = json_decode(curl_exec($curl), true);
        curl_close($curl);
    }

    public function createOrderLeadvertex(){
        try {
            $req = $this->api->getRequest();
            $status = $req->status;

            if($status != '56' && $status != '0') exit;


            // ! Проверка на сущесвтование заказа от вебмасетра 86
            if($req->offerName == 'sjb'){
                $sql = "SELECT * FROM zakaz WHERE `externalId` = '{$req->id}' AND `user_id` = 86";
                $stmt = DB::getInstance()->query($sql);
                if ($stmt->rowCount() > 0) {
                    self::answerLeadvertex($req->id,'Данный заказ существует в системе');
                    exit;
                }
            }
            

            // * Проверка на обязательное поле offerName
            if(!$req->offerName){
                $res = [
                    "status"=> 400,
                    "error"=> "[offerName] Cannot be empty"
                ];
                $res = json_encode($res);
                self::answerLeadvertex($req->id,'Название проекта пустое',88);
                exit($res);
            }


            // * Проверка на обязательное поле goods
            if(!$req->goods){
                $res = [
                    "status"=> 400,
                    "error"=> "[goods] Cannot be empty"
                ];
                $res = json_encode($res);
                self::answerLeadvertex($req->id,'Товар пустой',88);
                exit($res);
            }else{
                $goods = json_decode($req->goods,true);
                if(!is_array($goods)) {
                    $res = [
                        "status"=> 400,
                        "error"=> "Array expected"
                    ];
                    $res = json_encode($res);
                    self::answerLeadvertex($req->id,'В товаре ожидался массив',88);
                    exit($res);
                }
            }
            

            // * Проверка на обязательное поле ip
            if(!$req->ip){
                // $res = [
                //     "status"=> 400,
                //     "error"=> "[ip] Cannot be empty"
                // ];
                // $res = json_encode($res);
                // self::answerLeadvertex($req->id,'Поле ip пустое',88);
                // exit($res);
                $req->ip = '176.59.116.216';
            }else{
                if(!filter_var($req->ip, FILTER_VALIDATE_IP)){
                        $res = [
                            "status"=> 400,
                            "error"=> "Invalid ip"
                        ];
                        $res = json_encode($res);
                        self::answerLeadvertex($req->id,'Неверный ip',88);
                        exit($res);
                }
            }


             // Проверка на обязательное поле FIO
             if(!$req->fio){
                $res = [
                    "status"=> 400,
                    "error"=> "[fio] Cannot be empty"
                ];
                $res = json_encode($res);
                self::answerLeadvertex($req->id,'Поле ФИО не может быть пустым',88);
                exit($res);
             }


             // * Проверка на обязательное поле phone
             if(!$req->phone){
                $res = [
                    "status"=> 400,
                    "error"=> "[phone] Cannot be empty"
                ];
                $res = json_encode($res);
                self::answerLeadvertex($req->id,'Поле телефон пустое',88);
                exit($res);
             }else {
                $checkCountry = Utils_Phones::getCountryCodeByPhone($req->phone);
                $checkPhone = false;
                if ($checkCountry) {
                    $checkPhone = Utils_Phones::formatPhoneByCountry($checkCountry, $req->phone);
                }
                if ($checkPhone === false) {
                    $res = [
                        "status"=> 400,
                        "error"=> "Incorrect phone number format"
                    ];
                    $res = json_encode($res);
                    self::answerLeadvertex($req->id,'Неверные данные | телефон',88);
                    exit($res);
                }
             }



            foreach ($goods as $key => $val) {
                $data = [
                    'name'  => $req->offerName,
                    'goodID' => $val['goodID'],
                ];
                if(Stream::getLeadvertexStream($data)){
                    $stream = Stream::getLeadvertexStream($data);
                }
            }
            
            $stream = Stream::getById($stream);

            if(!$stream) {
                $res = [
                    "status"=> 400,
                    "error"=> "Stream not found"
                ];
                $res = json_encode($res);
                self::answerLeadvertex($req->id,'По данному товару не найденно потоков');
                exit($res);
            }


            $client = new Client;
            try {
                $ipInfo = Geo::getInfoByIp($req->ip);
                $client->country = $ipInfo['country']['name_ru'];
                $client->country_short = $ipInfo['country']['iso'];
                $client->city = $ipInfo['city']['name_ru'];
                $client->region = $ipInfo['region']['name_ru'];
            } catch (Exception $ex) {
                // ip not detect
            }

            $client->referer = (isset($req->referer)) ? $req->referer : '';

            $stream->externalWebmaster = $req->webmasterID;
            $stream->externalWebmaster2 = $req->externalWebmaster;
            $stream->externalId = $req->id;

            $client->name = $req->fio;
            $client->phone = $req->phone;
            
            $stream->subid1 = $req->sub1;
            $stream->subid2 = $req->sub2;
            $stream->subid3 = $req->sub3;
            $stream->subid4 = $req->sub4;
            $stream->subid5 = $req->sub5;
            


            $client->ip = $req->ip;

            $sn = '';
            $count = 1;
            if ($req->count > 0) {
                $count = max(1, intval($req->count));
            }
            $comments = '';

            $zakaz = $this->api->createOrderByStream($stream, $client, $count, $sn, $comments);

            // $this->api->getResponse()->id = $zakaz->id;
            // $this->api->getResponse()->crmid = $zakaz->pinger_value;
            
        } catch (Exception $e) { 
            echo 'Ошибка'.$e;
        }

        echo $this->api->getResponse();
    }

    // stream ID pGtnEq
    public function createOrder() {
        $this->checkKey();
        try {
            $this->api->getRequest()->validate('stream');
            $this->api->getRequest()->validate('ip', function( $req ) {
                return filter_var($req, FILTER_VALIDATE_IP);
            });
            $this->api->getRequest()->validate('clientname', function($req) {
                return strlen($req) > 0;
            });
            $this->api->getRequest()->validate('phone', function($req) {
                return strlen($req) > 0;
            });

            $req = $this->api->getRequest();
            $stream = Stream::getById($req->stream);
            if (!$stream || $stream->user_id != $this->user->id) {
                throw new Exception("Stream not found", Api_Response::STATUS_BADREQUEST);
            }

            $client = new Client;
            try {
                $ipInfo = Geo::getInfoByIp($req->ip);
                $client->country = $ipInfo['country']['name_ru'];
                $client->country_short = $ipInfo['country']['iso'];
                $client->city = $ipInfo['city']['name_ru'];
                $client->region = $ipInfo['region']['name_ru'];
            } catch (Exception $ex) {
                // ip not detect
            }
            
            if (isset($req->email)) {
                $client->email = $req->email;
            }

            $client->referer = $req->referer;

            // if (isset($req->externalWebmaster)) {
                $stream->externalWebmaster = $req->externalWebmaster;
                $stream->externalWebmaster2 = $req->externalWebmaster2;
            // }else {
                // $stream->externalWebmaster = '';
            // }
            // if (isset($req->externalId)) {
                $stream->externalId = $req->externalId;
            // }else {
                // $stream->externalId = '';
            // }
            $client->name = $req->clientname;
            $client->phone = $req->phone;

            $stream->subid1 = $req->sub1;
            $stream->subid2 = $req->sub2;
            $stream->subid3 = $req->sub3;
            $stream->subid4 = $req->sub4;
            $stream->subid5 = $req->sub5;
            


            $client->ip = $req->ip;

            $artikul = '';
            if ($req->artikul != '') {
                $artikul = $req->artikul;
            }
            $count = 1;
            if ($req->count > 0) {
                $count = max(1, intval($req->count));
            }
            $comments = '';
            if ($req->comments != '') {
                $comments = $req->comments;
            }
            $zakaz = $this->api->createOrderByStream($stream, $client, $count, $artikul, $comments);
            $this->api->getResponse()->id = $zakaz->id;
            $this->api->getResponse()->crmid = $zakaz->pinger_value;
        } catch (Exception $e) {
		$req = $this->api->getRequest();
	        $res = $this->api->getResponse();

        	try {
	            $stmt = DB::getInstance()->prepare('insert into api_logs set user_id=?, req=?, res=?');
	            $stmt->execute([
	                $this->user->id,
	                json_encode($_REQUEST),
			json_encode([$this->api->getResponse(), $e->getMessage(), $e->getCode()]),
	            ]);
	        } catch (Exception $e) {
	            
	        }


            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
            return;
        }
		$req = $this->api->getRequest();
        $res = $this->api->getResponse();

        try {
            $stmt = DB::getInstance()->prepare('insert into api_logs set user_id=?, req=?, res=?');
            $stmt->execute([
                $this->user->id,
                json_encode($_REQUEST),
		$this->api->getResponse(),
            ]);
        } catch (Exception $e) {
            
        }

        echo $this->api->getResponse();
    }

    public function getOfferLandings($id) {
        $this->checkKey();
        $offer = Offer::getById($id);
        if (!$offer) {
            echo $this->api->getResponse()->drop("offer with id $id not found", Api_Response::STATUS_NOTFOUND);
            exit;
        }
        if ($offer->active != 1) {
            echo $this->api->getResponse()->drop("offer with id $id not active", Api_Response::STATUS_DENY);
            exit;
        }
        try {
            echo $this->api->getOfferLandings($offer->id);
        } catch (Exception $ex) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
        }
    }

    public function getOfferTransits($id) {
        $this->checkKey();
        $offer = Offer::getById($id);
        if (!$offer) {
            echo $this->api->getResponse()->drop("offer with id $id not found", Api_Response::STATUS_NOTFOUND);
            exit;
        }
        if ($offer->active != 1) {
            echo $this->api->getResponse()->drop("offer with id $id not active", Api_Response::STATUS_DENY);
            exit;
        }
        try {
            echo $this->api->getOfferTransits($offer->id);
        } catch (Exception $ex) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
        }
    }

    public function getOfferSources($id) {
        $this->checkKey();
        $offer = Offer::getById($id);
        if (!$offer) {
            echo $this->api->getResponse()->drop("offer with id $id not found", Api_Response::STATUS_NOTFOUND);
            exit;
        }
        if ($offer->active != 1) {
            echo $this->api->getResponse()->drop("offer with id $id not active", Api_Response::STATUS_DENY);
            exit;
        }
        try {
            echo $this->api->getOfferSources($offer->id);
        } catch (Exception $ex) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
        }
    }

    public function getOffers() {
        $this->checkKey();
        try {
            echo $this->api->getOffers();
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
        }
        return;
    }

}
