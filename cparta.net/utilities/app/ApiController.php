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
        $this->checkKey();
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
        try {
            echo $this->api->getOrderStatus($id);
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode() ? $e->getCode() : Api_Response::STATUS_DENY);
            exit;
        }

        return true;
    }

    public function getOrdersStatuses() {
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

    // stream ID pGtnEq
    public function createOrder() {
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
            //var_dump($req->stream); die();
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
            $client->name = $req->clientname;
            $client->phone = $req->phone;
            
            $stream->subid1 = $req->sub1;
            $stream->subid2 = $req->sub2;
            $stream->subid3 = $req->sub3;
            $stream->subid4 = $req->sub4;
            $stream->subid5 = $req->sub5;
            $stream->subid6 = $req->sub6;
            $stream->externalId = $req->externalId;
            
            $client->ip = $req->ip;

            $sn = '';
            if ($req->sn != '') {
                $sn = $req->sn;
            }
            $count = 1;
            if ($req->count > 0) {
                $count = max(1, intval($req->count));
            }
            $comments = '';
            if ($req->comments != '') {
                $comments = $req->comments;
            }
            $zakaz = $this->api->createOrderByStream($stream, $client, $count, $sn, $comments);
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
        try {
            echo $this->api->getOffers();
        } catch (Exception $e) {
            echo $this->api->getResponse()->drop($e->getMessage(), $e->getCode());
        }
        return;
    }

}
