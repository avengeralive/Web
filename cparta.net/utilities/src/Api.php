<?php

class Api {

    const CONTEXT_YESCPA = 1;
    const CONTEXT_SCHOOL = 2;

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    /**
     *
     * @var Api_Response
     */
    protected $response;

    /**
     *
     * @var Api_Request
     */
    protected $request;

    /**
     *
     * @var User
     */
    protected $user;

    /**
     *
     * @return Api_Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @return Api_Response
     */
    public function getResponse() {
        return $this->response;
    }

    public function __call($name, $arguments) {
        throw new Exception("method $name not implemented", 404);
    }

    /**
     * Создает пользователя в ПП
     * Контекст - в каком контексте следует отработать, 1 - для ПП, 2 - для школы (например слать немного иное письмо и тд)
     *
     *
     * @param User $skelet
     * @param int $context
     * @return User Созданный пользователь
     */
    public function createUser(User $skelet, $context = false) {
        if (!$context) {
            $context = self::CONTEXT_YESCPA;
        }

        if (User::getByEmail($skelet->email)) {
            throw new Exception("User with email already exists");
        }
        $url = Registry::get('di')->site['host'];
        $domain = parse_url($url, PHP_URL_HOST);
        if (!function_exists('domain')) {

            function domain() {
                global $domain;
                return $domain;
            }

        }
        $activation_code = md5($skelet->email . 'SECRET CODE');
        $skelet->activation_code = $activation_code;
        require dirname(__FILE__) . '/../../localizations/russian.php';
        $userdata = '<br /><br />' . $loc['reg']['t24'] . '&nbsp;<b>' . $activation_code . '</b><br />' . $loc['reg']['t25'];
        $mail_subj = $domain . ': ' . $loc['reg']['t31'];
        $mail_body = $loc['reg']['t26'] . '<br /><br />' . $loc['reg']['t27'] . '&nbsp;' . $domain . '.&nbsp;' . $loc['reg']['t28'] . '<br />' . $loc['reg']['t29'] . $userdata . '<br /><br />' . $loc['reg']['t30'] . '&nbsp;' . $domain . '<br /><a href="' . $url . '">' . $url . '</a>';

        $skelet->create();

        $sender = Mailing_Sender::getDefaultSender();
        $letter = new Mailing_Letter;
        $letter->setSubject($mail_subj);
        $letter->setTo($skelet->email);
        $letter->setHtml($mail_body);
        $sender->send($letter);
        return $skelet;
    }

// Отправка письма на почту
    public function userSendForgetEmail($email) {
        $user = User::getByEmail($email);
        if (!$user) {
            throw new Exception("User with email: " . $email . " not found", Api_Response::STATUS_NOTFOUND);
        }
// hello govnokod!
        $url = Registry::get('di')->site['host'];

        function domain() {
            global $url;
            return parse_url($url, PHP_URL_HOST);
        }

        require dirname(__FILE__) . '/../../localizations/russian.php';
// eo govnokod


        $resetpass = substr(md5($email . 'S3CR3TC0D34sd18sd' . date('z')), 1, 11);
        $activation_link = $url . 'recover.php?user=' . $email . '&resetpass=' . $resetpass;
        $user->update(['activation_code' => 'change']);
        $mail_body = str_replace('http:', 'https:', $loc['recover.php']['t21'] . '<br /><br />' . $loc['recover.php']['t22'] . '&nbsp;' . $url . '.&nbsp;' . $loc['recover.php']['t23'] . '<br /><br />' . $loc['recover.php']['t24'] . '<br /><a href=[ACTIVATION_LINK]>[ACTIVATION_LINK]</a><br /><br />' . $loc['recover.php']['t25'] . '&nbsp;' . $url . '<br /><a href="' . $url . '">' . $url . '</a>');
        $mail_body = str_replace('[ACTIVATION_LINK]', $activation_link, $mail_body);
        $mail_body = str_replace('http:', 'https:', $mail_body);

        $sender = Mailing_Sender::getDefaultSender();
        $letter = new Mailing_Letter;
        $mail_subj = $loc['recover.php']['t20'];
        $letter->setSubject($mail_subj);
        $letter->setTo($email);
        $letter->setHtml($mail_body);
        $sender->send($letter);
    }

    /**
     * @api {get} /offers getOffers
     * @apiVersion 1.0.0
     * @apiGroup Offers
     * @apiName getOffers
     * @apiDescription Получает все оферы системы
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiSampleRequest /v1/offers
     * @apiVersion 1.0.0
     */
    public function getOffers() {
        $cpad = Export::factory('cpad');
        $data = $cpad->buildExport();
        $offers = $data['data'];
        $this->response->offers = $offers;
        return $this->response;
    }

    /**
     * @api {get} /offer/:id/sources getSources
     * @apiVersion 1.0.0
     * @apiGroup Offers
     * @apiName getSources
     * @apiDescription Получает все разрешенные источники трафика для офера. Legal 1 - разрешено, иначе - запрещенно.
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiParam {String} id ID офера
     * @apiSampleRequest /v1/offer/:id/sources
     */
    public function getOfferSources($id) {
        $cpad = Export::factory('cpad');
        $data = $cpad->buildExport($id);
        $row = $data['data'][0];
        $this->response->sources = $row->sources;
        return $this->response;
    }

    /**
     * @api {get} /offer/:id/landings getLandings
     * @apiVersion 1.0.0
     * @apiGroup Offers
     * @apiName getLandings
     * @apiDescription Получает все доступные лендинги офера
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiParam {String} id ID офера
     * @apiSampleRequest /v1/offer/:id/landings
     */
    public function getOfferLandings($id) {
        $cpad = Export::factory('cpad');
        $data = $cpad->buildExport($id);
        $row = $data['data'][0];
        $this->response->landings = $row->landings;
        return $this->response;
    }

    /**
     * @api {get} /order/:id/status getStatus
     * @apiVersion 1.0.1
     * @apiGroup Orders
     * @apiName getStatus
     * @apiDescription Получает все статус заказа, status и paid +комментарии<br>
     * Расшифровка статусов: <br>
     * status=0 - отклонено<Br>
     * status=1 - ожидание<br>
     * status=3 - подтвержден<br>
     * status=5 - мусор<br>
     * <br>
     * Расшифрока paid: <bR>
     * paid=4 - оплачен<Br>
     * paid=5 - возврат(отмена)<br>
     * paid=1 - проверка на фрод
     *
     *
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiParam {String} id ID заказа
     * @apiSampleRequest /v1/order/:id/status
     * @apiSuccessExample {json} Ответ сервера
     * {
     *   "status": 200,
     *   "order_status": 1,
     *   "order_paid": 0,
     *   "comments": "перезвонить"
     * }
     */
    public function getOrderStatus($id) {
        $zakaz = Zakaz::getById($id);
        if ($zakaz->user_id != $this->user->id) {
            throw new Exception("Order not found", Api_Response::STATUS_NOTFOUND);
        }
        if ($zakaz->status == 2)
            $zakaz->status = 3;

        $this->response->order_status = intval($zakaz->status);
        $this->response->order_paid = intval($zakaz->addstatus);
        $this->response->comments = $zakaz->comments;
		$this->response->crmid = $zakaz->pinger_value;
		
        return $this->response;
    }

    /**
     * @api {get} /orders/statuses getBatchStatuses
     * @apiVersion 1.0.1
     * @apiGroup Orders
     * @apiName getBatchStatus
     * @apiDescription Получает статусы заказов пачкой, status и paid +комментарии<br>
     * Расшифровка статусов: <br>
     * status=0 - отклонено<Br>
     * status=1 - ожидание<br>
     * status=3 - подтвержден<br>
     * status=5 - мусор<br>
     * <br>
     * Расшифрока paid: <bR>
     * paid=4 - оплачен<Br>
     * paid=5 - возврат(отмена)<br>
     * paid=1 - проверка на фрод
     *
     *
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiParam {String} ids Ид заказов через запятую без пробелов, например: 1000,1020,2010,2004...
     * @apiSampleRequest /v1/orders/statuses
     * @apiSuccessExample {json} Ответ сервера
     * {
     *   "status": 200,
     *   "orders": [
     *      "id": 1000, // ид заказа
     *      "order_status": 1,
     *      "order_paid": 0,
     *      "comments": "перезвонить"
     *   ],
     * }
     */
    public function getOrdersStatuses($ids) {
        $zm = new Zakaz_Manager(DB::getInstance());
        $zm->where("user_id", $this->user->id);
        //var_dump(explode(',',$ids));
        $zm->where("id", explode(',', $ids), Entity_Manager::WHERE_IN);
        $list = $zm->get();

        $res = [];
        foreach ($list as $zakaz) {
            if ($zakaz->status == 2)
                $zakaz->status = 3;
            $el = [
                'id' => $zakaz->id,
                'order_status' => intval($zakaz->status),
                'order_paid' => intval($zakaz->addstatus),
                'comments' => $zakaz->comments,
				'crmid' => $zakaz->pinger_value,
            ];
            $res[] = $el;
        }
        $this->response->orders = $res;

        return $this->response;
    }

    /**
     * @api {post} /order/ createOrder
     * @apiVersion 1.0.0
     * @apiGroup Orders
     * @apiName createOrder
     * @apiDescription Создать новый заказ.
     * Кодировка - UTF8<br>
     * <B>Обратите внимание</b><br>
     * В системе установлен фильтр, не более 1 заказа с 1 IP в течении 30 секунд.
     *
     *
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiParam {Number} stream ID потока
     * @apiParam {String} ip IP адрес клиента (формат IP v4 (xxx.xxx.xxx.xxx))
     * @apiParam {String} clientname ФИО клиента
     * @apiParam {String} phone Телефон клиента
     * @apiParam {Number} [count] Количество товаров, по дефолту 1
     * @apiParam {String} [sn] Артикул товара, размер или код
     * @apiParam {String} [comments] Комментарии к заказу
     * @apiParam {String} [sub1] subID1, по умолчанию будут выставленны те значения, которые заданы в настройках потока
     * @apiParam {String} [sub2] subID2, по умолчанию будут выставленны те значения, которые заданы в настройках потока
     * @apiParam {String} [sub3] subID3, по умолчанию будут выставленны те значения, которые заданы в настройках потока
     * @apiParam {String} [email] Почта пользователя
     * @apiParam {String} [referer] Referer пользователя (откуда пришел)
     * @apiSampleRequest /v1/order/
     * @apiSuccessExample {json} Пример ответа
     * {
     *      status: 200,
     *      id: 3293
     * }
     */
    public function createOrderByStream(Stream $stream, Client $client, $kolvo = 1, $artikul = '', $comments = '') {

        $zakaz = new Zakaz;
        $zakaz->stream = $stream->id;

        if ($stream->offer_id == 134) {
            $offer = Offer::getById(124);
//		$changedOffer = true;
        } else {
            $offer = Offer::getById($stream->offer_id);
        }
        
        $zakaz->externalId = $stream->externalId;
        $zakaz->subid1 = $stream->subid1;
        $zakaz->subid2 = $stream->subid2;
        $zakaz->subid3 = $stream->subid3;
        $zakaz->subid6 = $stream->subid6;
        $zakaz->user_id = $stream->user_id;
        $zakaz->landing_id = $stream->landing_id;
        $zakaz->kolvo = $kolvo;
        $zakaz->artikul = $artikul;
        $zakaz->comments = $comments;


        $seller = Seller::getByOffer($offer, $client);


        $cl = new Client_Log;
        $cl->date = date('Y-m-d H:i:s');
        $cl->user_id = $stream->user_id;
        $cl->stream = $stream->id;
        $cl->offer_id = $stream->offer_id;
        $cl->owner_id = $seller->id;
        $cl->landing_id = $stream->landing_id;
        $cl->country = $client->country;
        $cl->short_country = $client->country_short;
        $cl->town = $client->city;
        $cl->region = $client->region;
        $cl->ip = $client->ip;
        $cl->metric_online = 35;
        $client->metric_online = 35;
        if (isset($client->referer)) {
            $cl->referer = $client->referer;
        }

        $cl->subid1 = $stream->subid1;
        $cl->subid2 = $stream->subid2;
        $cl->subid3 = $stream->subid3;
        $cl->subid4 = $stream->subid4;
        $cl->subid5 = $stream->subid5;

        $cl->create();


        return $this->createOrder($client, $offer, $zakaz);
    }

    /**
     * Создает заказ
     * @param Client $client
     * @param Offer $offer
     * @param Seller $seller
     * @return Zakaz Созданный заказ
     */
    public function createOrder(Client $client, Offer $offer, Zakaz $zakaz = null, Seller $seller = null) {

        if (!$zakaz) {
            $zakaz = new Zakaz;
        }

        $zakaz->phone = $client->phone;



        $zakaz->phone = preg_replace("/[^0-9]/", "", $zakaz->phone);

        $checkCountry = Utils_Phones::getCountryCodeByPhone($zakaz->phone);
        $checkPhone = false;
        if ($checkCountry) {
            $checkPhone = Utils_Phones::formatPhoneByCountry($checkCountry, $zakaz->phone);
        }
        if ($checkCountry) {

            if ($checkCountry != $zakaz->short_country && $checkPhone) {
                $zakaz->phone = $checkPhone;
                $zakaz->short_country = $checkCountry;
                $client->country_short = $checkCountry;
                $zakaz->country = DB::getInstance()->query('select name_ru from sxgeo_country where iso=\'' . $checkCountry . '\' limit 1')->fetchColumn();
                $client->country = $zakaz->country;
            }
            if ($checkPhone === false && $offer->type_offer == 1) {
                $zakaz->status = Zakaz::STATUS_TRASH;
                $zakaz->comments = 'Неверные данные | телефон';
            }
        }

        if (!$seller) {
            $seller = Seller::getByOffer($offer, $client);
            if (isset($client->id) && is_numeric($client->id) && $client->id > 0) {
                $clientNew = Client_Log::getById($client->id);
                if ($clientNew) {
                    $clientNew->update([
                        'owner_id' => $seller->id,
                    ]);
                }
            }
        }

        if (!$offer->active) {
            throw new Exception("Offer not active", Api_Response::STATUS_BADREQUEST);
        }


        $zakaz->zakaz_number = $seller->getNextOrderId();
        /*
          if ($offer->id == 134) {
          $offer = Offer::getById(124);
          //		$changedOffer = true;
          }
         *
         */

//	$changedOffer = false;
        $awards = $offer->getAwards($zakaz->user_id);
//self::telegram(json_encode($awards));
        $zakaz->offer_id = $offer->id;
        if (!$zakaz->date) {
            $zakaz->date = date("Y-m-d H:i:s", time());
        }
        $zakaz->owner_id = $seller->id;
        $zakaz->geo = implode(' / ', [$client->country, $client->region, $client->city]);
        $zakaz->ip = $client->ip;

       //$zm = new Zakaz_Manager(DB::getInstance());
        //$zm->where('ip', $zakaz->ip);
        //$zm->where('date', date("Y-m-d H:i:s", time() - 30), '>');
        //$zm->get();
        //if (0 && $zm->getTotal() > 0) {
        //    throw new Exception("Spam detect for ip: [" . $zakaz->ip . "]", Api_Response::STATUS_BADREQUEST);
       ///}
///////////////
///////// ВСТАВКА В ЗАКАЗ ISO КОДА РЕГИОНА
///////////////

        $sql = "SELECT iso FROM `sxgeo_regions` WHERE `name_ru` = '". $client->region ."'";
        $stmt = DB::getInstance()->query($sql);
        if ($stmt->rowCount() > 0) {
            $name_ru = $stmt->fetchColumn();
            $region = explode('-', $name_ru);
            $region = (isset($region[1]) && $region[1] != '') ? $region[1]: '';
            $zakaz->region_iso = $region;
        }

///////////////
///////////////
///////////////


        $zakaz->referer = $client->referer;
        $zakaz->referer_host = $client->referer_host;
        $zakaz->useragent = $client->useragent;

        $zakaz->name = $client->name;
        $zakaz->sex = Utils_Client::getSexByName($client->name)['sex'];
        $zakaz->email = $client->email;
        $zakaz->client_address = $client->address;
        $zakaz->street = $client->street;
        $zakaz->dom = $client->dom;

//////
//////  ПОДОЗРИТЕЛЬНЫЙ ЗАКАЗ
//////

        $warning_type = [];
        if ($client->paste == 1 || $client->metric_online < 30) {
            $zakaz->warning = 1;
            $zakaz->metric_online = $client->metric_online;
            if ($client->paste == 1) {
                $warning_type[] = Zakaz::WARNING_PASTE;
            }
            if ($client->metric_online < 30) {
                $warning_type[] = Zakaz::WARNING_ONLINE;
            }
            $zakaz->warning_type = implode(',', $warning_type);
        }

//////
//////
//////
// prices


        $useAward = null;
        foreach ($awards as $award) {
            if ($award->country instanceof Offers_Country) {
                if ($award->country->iso == $client->country_short) {
                    $useAward = $award;
                    break;
                }
            }
        }
        if (!$useAward && is_array($awards) && isset($awards[0])) {
            $useAward = $awards[0];
        }



        $zakaz->kolvo = max(1, intval($zakaz->kolvo));

        if($offer->type_offer != 4 && $offer->id != 285) {
            $zakaz->cena = $useAward->price;
        }

        $award = $useAward->calcAward($zakaz->kolvo, $zakaz->cena);

        $zakaz->country = $client->country;
        $zakaz->short_country = $client->country_short;

        $zakaz->status = 1;

        $zakaz->browser_name = $client->browser;
        $zakaz->browser_version = $client->browser_version;
        $zakaz->platform = $client->platform;



        $zakaz->mobile = intval($client->is_mobile);
        $zakaz->region = $client->region;
        $zakaz->town = $client->city;
        if (!$zakaz->date_obrabotka) {
            $zakaz->date_obrabotka = date("Y-m-d H:i:s");
        }



        if ($offer->type == 1 && in_array($offer->type_offer, [1,7])) {

            $webmaster = User::getById($zakaz->user_id);

            $user_bonus_this_offer = 0;
            $user_bonus_all_offer = $webmaster->offers_reward_all;
            $dop_bonus = 0;

            if ($webmaster->offers_reward != '') {
                $personal_bonus = explode('|', trim($webmaster->offers_reward));
                if ($personal_bonus && is_array($personal_bonus)) {
                    $offer_bonus = array();
                    foreach ($personal_bonus as $key => $bonus) {
                        if ($bonus[0] == '') {
                            continue;
                        }
                        $offer_bonus[] = explode(':', trim($bonus));
                    }

                    if ($offer_bonus && is_array($offer_bonus)) {
                        foreach ($offer_bonus as $key => $bonus) {
                            if ($bonus[0] == $zakaz->offer_id) {
                                $bonuses[] = explode(',', trim($bonus[1]));
                                foreach ($bonuses as $bonus) {
                                    foreach ($bonus as $k => $v) {
                                        $bon[] = explode('-', trim($v));
                                    }
                                }
                                break;
                            }
                        }
                    }
                    if ($bon && is_array($bon)) {
                        foreach ($bon as $k => $v) {
                            if ($v[0] != '0') {
                                if ($v[0] == $zakaz->short_country) {
                                    $dop_bonus = $v[1];
                                    break;
                                }
                            } else {
                                $dop_bonus = $v[1];
                                break;
                            }
                        }
                    }
                }
            }

            if ($dop_bonus != 0) {
                $user_bonus_this_offer = $dop_bonus;
            } elseif ($dop_bonus == 0 && $user_bonus_all_offer != 0) {
                $user_bonus_this_offer = $user_bonus_all_offer;
            }

            if ($user_bonus_this_offer > $award->cpa) {
                $user_bonus_this_offer = $award->cpa;
            }

            $zakaz->comission = ($award->webmaster + $user_bonus_this_offer);
            $comission_cpa = $award->cpa - $user_bonus_this_offer;
            $zakaz->comission_cpa = $comission_cpa;
        } elseif($offer->type_offer == 1) {
            $zakaz->comission = $award->webmaster;
            $zakaz->comission_cpa = $award->cpa;
        } elseif($offer->type_offer == 2 || $offer->type_offer == 8) {
            if($offer->id == 314 || $offer->id == 313 || $offer->id == 532){

                $com = $zakaz->comission;
                if($com != 0){
                    $zakaz->comission = $award->webmaster;
                    $zakaz->comission_cpa = $award->cpa;

                    if($zakaz->user_id == 1926 && $offer->id != 532){
                        $zakaz->comission = $zakaz->comission + 300;
                        $zakaz->comission_cpa = $zakaz->comission_cpa - 300;
                    }

                }else{
                    $zakaz->comission = 0;
                    $zakaz->comission_cpa = 0;
                }

            }else{
                $com = $zakaz->comission;
                if($com != 0){
                    $zakaz->comission = $com - $award->cpa;
                    $zakaz->comission_cpa = $award->cpa;
                }else{
                    $zakaz->comission = 0;
                    $zakaz->comission_cpa = 0;
                }
            }
        } elseif($offer->type_offer == 4 || $offer->id == 285) {
            $zakaz->comission = $award->webmaster;
            $zakaz->comission_cpa = $award->cpa;
        }

        $zakaz_view_full_comission = $zakaz->comission + $zakaz->comission_cpa;
        $type_rekl = $seller->type_rekl;
        $balance_rekl = $seller->balance;
        $access_zakaz = ($type_rekl == 0 && $balance_rekl < $zakaz_view_full_comission) ? 0 : 1;

/*
        if($offer->type_offer == 1){
            // check for spam
            $zm = false;
            $zm = new Zakaz_Manager(DB::getInstance());
            $zm->where('ip', $zakaz->ip);
            $zm->where('offer_id', $zakaz->offer_id);
            $zm->where('phone', $zakaz->phone);
            $zm->where('date', date("Y-m-d H:i:s", time() - 60 * 10), '>');
            $zm->where('email', '');

            $list = $zm->get();
            if ($zm->getTotal() > 0 && !in_array($zakaz->phone, ['79044467341', '79381545264'])) {
                //$zakaz->status = Zakaz::STATUS_TRASH;
                //$zakaz->comments = 'Дубль заказа. Спам';
                throw new Exception("Spam detect for phone: [" . $zakaz->phone . "]", Api_Response::STATUS_BADREQUEST);
            }
        }
		*/
//
        $checkPhone2 = Utils_Phones::formatPhoneByCountry($zakaz->short_country, $zakaz->phone);
        if ($checkPhone2 === false && $zakaz->email == '' && $offer->type_offer == 1) {
            $zakaz->status = Zakaz::STATUS_TRASH;
            $zakaz->comments = 'Неверные данные | телефон';
        }
        $ban_id = DB::getInstance()->query('SELECT id FROM banned_ip WHERE `phone`="'.$zakaz->phone.'"')->fetchColumn();
		if ($ban_id) 
		{
			$zakaz->status = Zakaz::STATUS_TRASH;
            $zakaz->comments = 'Черный список по телефону';
        }
        $ban_id = DB::getInstance()->query('SELECT id FROM banned_ip WHERE `ip`="'.$zakaz->ip.'"')->fetchColumn();
		if ($ban_id) 
		{
			$zakaz->status = Zakaz::STATUS_TRASH;
            $zakaz->comments = 'Черный список по IP адресу';
        }
        //self::telegram("some order");
        if ($zakaz->create()) {

            if ($zakaz->status == 5) {
                if ($zakaz->stream && $zakaz->stream != '' && $zakaz->stream != 0) {
                    $stream = Stream::getById($zakaz->stream);
                    if ($stream->postback_add != 0 && $stream->postback_url != '') {
                        $postback = Stream::postback($stream, $offer, $zakaz, 'decline');
                    }
                }

                if (!isset($postback) || $postback === null) {
                    $postback = Postback::getByUserId($zakaz->user_id);
                    if (!empty($postback)) {
                        if ($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://') {
                            Postback::sendPostback($offer, $zakaz, 'decline');
                        }
                    }
                }
            } else {
                // $this->telegram('Start trigger');
                Events::trigger(Events::EVENT_ORDER_NEW, $zakaz->id, ['comission' => $zakaz->comission, 'owner_id' => $zakaz->owner_id, 'user_id' => $zakaz->user_id]);
                if($zakaz->owner_id == 1501){
                    $phone = '+79300000242';
                    $sms_text = 'Новый лид#'.$zakaz->id.' : '.$zakaz->name.' , '.$zakaz->phone;

                    $ch = curl_init("http://sms.ru/auth/get_token");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                    $token = curl_exec($ch);
                    curl_close($ch);

                    $ch = curl_init("http://sms.ru/sms/send");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                    "login"		=>	'9300000242',
                    "sha512"	=>	hash("sha512",'privet2018'.$token.'77895686-71B1-1579-926C-5A1AE4DEE74A'),
                    "token"		=>	$token,
                    "to"		=>	$phone,
                    "text"		=>	$sms_text
                    ));
                    $body = curl_exec($ch);
                    curl_close($ch);
                }
            }
            // $this->telegram($access_zakaz);
            // $this->telegram(ENVIRONMENT);
            if ($access_zakaz == 0) {
                DB::getInstance()->query("update users set api_owner_status = '1' where id = " . intval($seller->id));
            }
            if (isset($this->user->id)) {
                DB::getInstance()->query("update users set api_permission=api_permission|1 where id = " . intval($this->user->id));
            }
            $this->response->id = $zakaz->id;
            $add = $zakaz->comission;
            if ($zakaz->prelanding_id > 0) {
                DB::getInstance()->query("update prelandings set amount=amount+$add, orders=orders+1 where id=" . intval($zakaz->prelanding_id));
            }
            if ($zakaz->landing_id > 0) {
                DB::getInstance()->query("update landings set amount=amount+$add, orders=orders+1 where id=" . intval($zakaz->landing_id));
            }
            if (ENVIRONMENT == 'PROD' and $access_zakaz == 1) {
                $offer->pingOtherCpa($zakaz);
            }
        }
        return $zakaz;
    }

    /**
     * @api {get} /news/ getNews
     * @apiVersion 1.0.0
     * @apiGroup News
     * @apiName getNews
     * @apiDescription Получает последние 50 новостей
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiSampleRequest /v1/news
     */
    public function getNews() {

        $nm = new News_Manager(DB::getInstance());
        $nm->where('public_news', 1);
        $nm->where('user_tip', 10);
        $nm->limit(50);

        $list = $nm->get();
        $export = array();
        foreach ($list as $n) {
            $export[] = [
                'id' => $n->id,
                'title' => $n->news_zagolovok,
                'text' => $n->news,
            ];
        }
        $this->response->news = $export;
        return $this->response;
    }

    /**
     * @api {get} /offer/:id/transits getTransits
     * @apiVersion 1.0.0
     * @apiGroup Offers
     * @apiName getTransits
     * @apiDescription Получает все транзитные страницы для офера
     * @apiParam {String} key Апи-Ключ для запроса
     * @apiParam {String} id ID офера
     * @apiSampleRequest /v1/offer/:id/transits
     */
    public function getOfferTransits($id) {
        $cpad = Export::factory('cpad');
        $data = $cpad->buildExport($id);
        $row = $data['data'][0];
        $this->response->transits = $row->transits;
        return $this->response;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function __construct(Api_Request $req = null, Api_Response $res = null) {
        if (!$res) {
            $res = new Api_Response;
        }

        $this->request = $req;
        $this->response = $res;
    }

}
