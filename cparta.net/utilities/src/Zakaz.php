<?php

class Zakaz extends Entity {

    const STATUS_REJECT = 0;
    const STATUS_WAITING = 1;
    const STATUS_HOLD = 2;
    const STATUS_APPROVED = 3;
    const STATUS_TRASH = 5;
    const WARNING_PASTE = 1;
    const WARNING_ONLINE = 2;


    public static function tableName() {
        return 'zakaz';
    }

    public function create() {
        $r = parent::create();
        if (!$r) {
            return false;
        }

        $offer = Offer::getById($this->offer_id);

        if ($offer->email_ok) {
            $seller = Seller::getById($this->owner_id);
            $mail_body = 'Здравствуйте!<br /><br />У Вас в личном кабинете CPA-сети, на оффере &laquo;' . $offer->name . '&raquo; появился новый необработанный заказ.<br />Пожалуйста, загляните и обработайте его, не забыв изменить статус заказа. Если у Вас будут вопросы или уточнения, пожалуйста, беспокойте техническую поддержку. Спасибо.<br /><br />CPA-сеть<br />http://' . getenv("HTTP_HOST");
            $sender = Mailing_Sender::getDefaultSender();
            $letter = new Mailing_Letter;
            $letter->setSubject('У Вас новый заказ в личном кабинете');
            $letter->setTo($seller->email);
            $letter->setHtml($mail_body);
            $sender->send($letter);
        }

        if ($this->stream && $this->stream != '' && $this->stream != 0) {
            $stream = Stream::getById($this->stream);
            if ($stream->postback_add != 0 && $stream->postback_url != '') {
                $postback = Stream::postback($stream, $offer, $this, 'waiting');
            }
        }

        if (!isset($postback) || $postback === null) {
            $postback = Postback::getByUserId($this->user_id);
            if (!empty($postback)) {
                if ($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://') {
                    Postback::sendPostback($offer, $this, 'waiting');
                }
            }
        }
        return $r;
    }

    public function check() {
        if ($this->pinger_type == '')
            return;
        $pinger_type = $this->pinger_type;
        $status = new $pinger_type;
        //file_put_contents('/var/www/www-root/data/www/cparta.net/test_ping.txt', $this->id.' - '.$this->pinger_type.'
//', FILE_APPEND);
        $status->checkStatus($this);
        return $status;
    }

    public function pingAgain($settings) {
        if ($this->pinger_type == '')
            return;
        $pinger_type = $this->pinger_type;
        $status = new $pinger_type;
        $status->ping($settings, $this);
        return $status;
    }

    public function checkAddStatus() {
        if ($this->pinger_type == '')
            return;
        $pinger_type = $this->pinger_type;
        $status = new $pinger_type;
        $status->checkStatus2($this);
        return true;
    }

    public function updateZakaz($zakaz_id, $status, $comments) {
        if($status == 3){
            $data['zakaz_id'] = $zakaz_id;
            User::telegram(32, $data);
        }
        $settings = Settings::getById(1);
        $settings_refprocent = $settings->refprocent;
        $settings_mincoins = $settings->mincoins;

        $date_obrabotka = date('d.m.Y H:i:s');
        $zakaz = Zakaz::getById($zakaz_id);
        $offer_id = $zakaz->offer_id;
        $offer = Offer::getById($offer_id);
        $webmaster_id = $zakaz->user_id;
        $kolvo = $zakaz->kolvo;
        $comission = $zakaz->comission;
        $comission_cpa = $zakaz->comission_cpa;
        $cena = $zakaz->cena;
        $owner_id = $zakaz->owner_id;
        $old_status_zakaza = $zakaz->status;
        $addstatus = $zakaz->addstatus;

        //$offer_deystvie = $offer->deystvie;
        // Сумма заказа = цена * количество заказанного
        //$summa_zakaza = $cena * $kolvo;
        // Комиссия вебмастеру = комиссия вебмастеру * количество заказанного
        $summa_comission = $comission;
        // Комиссия в пользу CPA-сети = комиссия CPA-сети * количество заказанного
        $summa_comission_cpa = $comission_cpa;
        // Общая сумма вычитаемой с рекламодателя комиссии = комиссия вебмастеру + комиссия в пользу CPA-сети
        $comission_all = $summa_comission + $summa_comission_cpa;

        $owner = User::getById($owner_id);

        $webmaster = User::getById($webmaster_id);

        if($comission_cpa >= $settings_mincoins){
            $new_coins = $webmaster->coins + 1;
        }
                

        if ($status == $old_status_zakaza) {
            $this->update([
                'comments' => $comments
            ]);
        }

        if ($status == 2 && $old_status_zakaza == 1) {
            Events::trigger(Events::EVENT_ORDER_CONFIRM, $zakaz_id, ['comission' => $this->comission, 'owner_id' => $this->owner_id, 'user_id' => $this->user_id]);
            // Назначаем переменную под текущий баланс рекламодателя
            $balance_reklamodatel = $owner->balance;
            $new_balance_rekl = $balance_reklamodatel - $comission_all;
            // Назначаем переменную под текущий баланс вебмастера
            //$balance_webmaster=$webmaster->balance;   
            $hold_webmaster = $webmaster->hold;
            $new_hold_webmaster = $hold_webmaster + $summa_comission;

            $addstatus = 2;

            $this->update([
                'status' => $status,
                'addstatus' => $addstatus,
                'date_obrabotka' => $date_obrabotka,
                'comments' => $comments
            ]);
            /*
              $offer->update([
              'kolvo_lids' => $kolvo_lids
              ]);
              $offer->where('id', $offer->id);
              $offer->where('off_lids', '1');
             */
            // Вычитаем у рекламодателя с баланса средства (сумма комиссии вебмастера для помещения в ХОЛД и сумму комиссии CPA-сети)

            $owner->update([
                'balance' => $new_balance_rekl
            ]);

            // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя    
            $log_finances = new FinancesLog;
            $log_finances->user_id = $owner_id;
            $log_finances->operation = 2;
            $log_finances->summ = $comission_all;
            $log_finances->description = 12;
            $log_finances->balance = $new_balance_rekl;
            $log_finances->status = 2;
            $log_finances->create();

            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            if ($webmaster_id != '0') {

                $webmaster->update([
                    'hold' => $new_hold_webmaster
                ]);
                $log_finances = new HoldLog;
                $log_finances->user_id = $webmaster_id;
                $log_finances->operation = 1;
                $log_finances->summ = $summa_comission;
                $log_finances->description = 5;
                $log_finances->balance = $new_hold_webmaster;
                $log_finances->status = 2;
                $log_finances->create();

                if ($this->stream && $this->stream != '' && $this->stream != 0) {
                    $stream = Stream::getById($this->stream);
                    if ($stream->postback_add != 0 && $stream->postback_url != '') {
                        $postback = Stream::postback($stream, $offer, $this, 'approved');
                    }
                }

                if (!isset($postback) || $postback === null) {
                    $postback = Postback::getByUserId($this->user_id);
                    if (!empty($postback)) {
                        if ($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://') {
                            Postback::sendPostback($offer, $this, 'approved');
                        }
                    }
                }
            }
        } elseif ($status == 0 && $old_status_zakaza == 1) {
            $addstatus = 0;
            Events::trigger(Events::EVENT_ORDER_CANCEL, $zakaz_id, ['comission' => $this->comission, 'owner_id' => $this->owner_id, 'user_id' => $this->user_id]);
            $this->update([
                'status' => $status,
                'addstatus' => $addstatus,
                'date_obrabotka' => $date_obrabotka,
                'comments' => $comments
            ]);
            if ($webmaster_id != '0') {

                if ($this->stream && $this->stream != '' && $this->stream != 0) {
                    $stream = Stream::getById($this->stream);
                    if ($stream->postback_add != 0 && $stream->postback_url != '') {
                        $postback = Stream::postback($stream, $offer, $this, 'decline');
                    }
                }

                if (!isset($postback) || $postback === null) {
                    $postback = Postback::getByUserId($this->user_id);
                    if (!empty($postback)) {
                        if ($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://') {
                            Postback::sendPostback($offer, $this, 'decline');
                        }
                    }
                }
            }
        } elseif ($status == 5 && $old_status_zakaza == 1) {
            $addstatus = 0;

            $this->update([
                'status' => $status,
                'addstatus' => $addstatus,
                'date_obrabotka' => $date_obrabotka,
                'comments' => $comments
            ]);
            if ($webmaster_id != '0') {
                if ($this->stream && $this->stream != '' && $this->stream != 0) {
                    $stream = Stream::getById($this->stream);
                    if ($stream->postback_add != 0 && $stream->postback_url != '') {
                        $postback = Stream::postback($stream, $offer, $this, 'decline');
                    }
                }

                if (!isset($postback) || $postback === null) {
                    $postback = Postback::getByUserId($this->user_id);
                    if (!empty($postback)) {
                        if ($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://') {
                            Postback::sendPostback($offer, $this, 'decline');
                        }
                    }
                }
            }
        } elseif ($status == 3 && $old_status_zakaza == 2) {
            if ($webmaster_id != '0') {

                $hold_webmaster = $webmaster->hold;
                $balance_webmaster = $webmaster->balance;
                $new_hold_webmaster = $hold_webmaster - $summa_comission;
                $new_balance_webmaster = $balance_webmaster + $summa_comission;

                

                
                
                $webmaster->update([
                    'hold' => $new_hold_webmaster,
                    'balance' => $new_balance_webmaster,
                    'coins' => $new_coins
                ]);

                // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастеру  
                $log_finances = new FinancesLog;
                $log_finances->user_id = $webmaster_id;
                $log_finances->operation = 1;
                $log_finances->summ = $summa_comission;
                $log_finances->description = 5;
                $log_finances->balance = $new_balance_webmaster;
                $log_finances->status = 2;
                $log_finances->create();

                $log_finances = new HoldLog;
                $log_finances->user_id = $webmaster_id;
                $log_finances->operation = 2;
                $log_finances->summ = $summa_comission;
                $log_finances->description = 5;
                $log_finances->balance = $new_hold_webmaster;
                $log_finances->status = 2;
                $log_finances->create();

                $refovod_webmaster = $webmaster->myrefovod;

                // Узнаем текущий баланс рефовода
                if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '' && $webmaster->ref_program == 1) {


                    $refovod = User::getById($refovod_webmaster);
                    $balance_refovod = $refovod->balance;
                    $summ_referal = $summa_comission / 100 * $settings_refprocent;
                    $new_balance_ref = $balance_refovod + $summ_referal;
                    $refovod->update([
                        'balance' => $new_balance_ref
                    ]);
                    // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастеру  
                    $log_finances = new FinancesLog;
                    $log_finances->user_id = $refovod_webmaster;
                    $log_finances->operation = 1;
                    $log_finances->summ = $summ_referal;
                    $log_finances->description = 11;
                    $log_finances->balance = $new_balance_ref;
                    $log_finances->status = 2;
                    $log_finances->create();
                }

                $new_balance_cpa = $settings->balance_cpa + $summa_comission_cpa;

                $settings->update([
                    'balance_cpa' => $new_balance_cpa
                ]);
            } else {

                $new_balance_cpa = $settings->balance_cpa + $comission_all;
                $settings->update([
                    'balance_cpa' => $new_balance_cpa
                ]);
            }
            $this->update([
                'status' => $status,
                'addstatus' => $addstatus,
                'date_obrabotka' => $date_obrabotka,
                'comments' => $comments
            ]);
        } elseif ($status == 3 && $old_status_zakaza == 1) {
            if ($webmaster_id != '0') {

                //$hold_webmaster=$webmaster->hold; 
                $balance_webmaster = $webmaster->balance;
                //$new_hold_webmaster = $hold_webmaster-$summa_comission;
                $new_balance_webmaster = $balance_webmaster + $summa_comission;

                $webmaster->update([
                    'balance' => $new_balance_webmaster,
                    'coins' => $new_coins
                ]);

                // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастеру  
                $log_finances = new FinancesLog;
                $log_finances->user_id = $webmaster_id;
                $log_finances->operation = 1;
                $log_finances->summ = $summa_comission;
                $log_finances->description = 5;
                $log_finances->balance = $new_balance_webmaster;
                $log_finances->status = 2;
                $log_finances->create();

                $refovod_webmaster = $webmaster->myrefovod;

                // Узнаем текущий баланс рефовода
                if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '' && $webmaster->ref_program == 1) {


                    $refovod = User::getById($refovod_webmaster);
                    $balance_refovod = $refovod->balance;
                    $summ_referal = $summa_comission / 100 * $settings_refprocent;
                    $new_balance_ref = $balance_refovod + $summ_referal;
                    $refovod->update([
                        'balance' => $new_balance_ref
                    ]);
                    // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастеру  
                    $log_finances = new FinancesLog;
                    $log_finances->user_id = $refovod_webmaster;
                    $log_finances->operation = 1;
                    $log_finances->summ = $summ_referal;
                    $log_finances->description = 11;
                    $log_finances->balance = $new_balance_ref;
                    $log_finances->status = 2;
                    $log_finances->create();
                }
                // Назначаем переменную под текущий баланс рекламодателя
                $balance_reklamodatel = $owner->balance;
                $new_balance_rekl = $balance_reklamodatel - $comission_all;

                $addstatus = 4;

                $new_balance_cpa = $settings->balance_cpa + $summa_comission_cpa;

                $settings->update([
                    'balance_cpa' => $new_balance_cpa
                ]);
            } else {

                $new_balance_cpa = $settings->balance_cpa + $comission_all;
                $settings->update([
                    'balance_cpa' => $new_balance_cpa
                ]);
            }
            $this->update([
                'status' => $status,
                'addstatus' => $addstatus,
                'date_obrabotka' => $date_obrabotka,
                'comments' => $comments
            ]);
                        
        }elseif($status == 1 && $old_status_zakaza == 3) {
            if($webmaster_id!='0'){

                // Назначаем переменную под текущий баланс рекламодателя
                $balance_reklamodatel = $owner->balance;
                $new_balance_rekl = $balance_reklamodatel + $comission_all;

                
                $balance_webmaster=$webmaster->balance; 
                $new_balance_webmaster = $balance_webmaster-$summa_comission;

                $owner->update([
                    'balance' => $new_balance_rekl
                ]);

                // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя    
                $log_finances = new FinancesLog;
                $log_finances->user_id = $owner_id;
                $log_finances->operation = 2;
                $log_finances->summ = $comission_all;
                $log_finances->description = 12;
                $log_finances->balance = $new_balance_rekl;
                $log_finances->status = 2;
                $log_finances->create();

                $new_balance_cpa = $settings->balance_cpa + $summa_comission_cpa;

                    $webmaster->update([
                        'balance' => $new_balance_webmaster
                    ]);     
                    // Пишем в базу, в таблицу "finances"
                    $log_finances = new FinancesLog;
                    $log_finances->user_id = $webmaster_id;
                    $log_finances->operation = 2;
                    $log_finances->summ = $summa_comission;
                    $log_finances->description = 14;
                    $log_finances->balance = $new_balance_webmaster;
                    $log_finances->status = 2;
                    $log_finances->create(); 

                    $new_balance_cpa = $settings->balance_cpa - $summa_comission_cpa;

                    $settings->update([
                        'balance_cpa' => $new_balance_cpa
                    ]);                   

            }else{
                
                $new_balance_cpa = $settings->balance_cpa - $comission_all;               
                $settings->update([
                    'balance_cpa' => $new_balance_cpa
                ]); 
                
            }
                $addstatus = 1;
                $this->update([
                    'status' => $status,
                    'addstatus' => $addstatus,
                    'date_obrabotka' => $date_obrabotka,
                    'comments'=>$comments
                ]);
        }           
        
        
    }
        
}