<?php

$redirect = 0;
// Если был переход по партнерской ссылке выданной вебмастеру в свойствах оффера
// If there was a transition on affiliate link issued by the webmaster in the properties offer
if ((isset($_GET['p']) && $_GET['p'] != '' && $_GET['p'] != '0') OR ( isset($_GET['stats']) && $_GET['stats'] != '' && $_GET['stats'] != '0') AND ! isset($_GET['stream']) AND ! isset($_GET['s'])) {
    if (isset($_GET['p']) && $_GET['p'] != '' && $_GET['p'] != '0') {
        $partnerlink = partnerstroka_decode(htmlentities($_GET['p']), true);
    } elseif (isset($_GET['stats']) && $_GET['stats'] != '' && $_GET['stats'] != '0') {
        $partnerlink = partnerstroka_decode(htmlentities($_GET['stats']), true);
    }
    if(isset($_GET['referer'])) {
        $referer = htmlspecialchars($_GET['referer']);
    }else {
        $referer = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }
    if (isset($_GET['subid1'])) {
        $subid1 = htmlspecialchars($_GET['subid1']);
    }
    if (isset($_GET['subid2'])) {
        $subid2 = htmlspecialchars($_GET['subid2']);
    }
    if (isset($_GET['subid3'])) {
        $subid3 = htmlspecialchars($_GET['subid3']);
    }
    if (isset($_GET['subid4'])) {
        $subid4 = htmlspecialchars($_GET['subid4']);
    }
    if (isset($_GET['subid5'])) {
        $subid5 = htmlspecialchars($_GET['subid5']);
    }
    if (count($partnerlink) == 4) {
        $userid = htmlentities($partnerlink[0]);
        if ($userid == '1') {
            $userid = '0';
        }
        $offerid = htmlentities($partnerlink[1]);
        $prelandingid = str_replace('z', ',', htmlentities($partnerlink[2]));
        $landingid = str_replace('z', ',', htmlentities($partnerlink[3]));

        // echo $userid.'<br />';
        // echo $offerid.'<br />';
        // echo $prelandingid.'<br />';
        // echo $landingid.'<br />';
        // exit;
    } else {
        $userid = htmlentities($partnerlink[0]);
        if ($userid == '1') {
            $userid = '0';
        }
        $offerid = htmlentities($partnerlink[1]);
        $landingid = htmlentities($partnerlink[2]);
        $prelandingid = '0';
    }


    // Проверяем есть ли оффер с указанным ID
    // Check whether the offer is, with the specified ID
    $sql_checkoffer = "SELECT id,kolvo_lids,offer_end,owner_id,postclick,off_balance,off_lids,active FROM offers WHERE `id`='$offerid'";
    $result_checkoffer = $mysqli->query($sql_checkoffer);
    if (mysqli_num_rows($result_checkoffer) > 0) {
        $res_checkoffer = mysqli_fetch_array($result_checkoffer);
        $offerid = htmlentities($res_checkoffer['id']);
        $ownerid = htmlentities($res_checkoffer['owner_id']);
        $postclick = htmlentities($res_checkoffer['postclick']);
        $off_balance = htmlentities($res_checkoffer['off_balance']);
        $kolvo_lids = htmlentities($res_checkoffer['kolvo_lids']);
        $offer_end = htmlentities($res_checkoffer['offer_end']);
        $off_lids = htmlentities($res_checkoffer['off_lids']);
        $active = htmlentities($res_checkoffer['active']);

        if ($active == 0) {
            // Определяем какой домен используется для витрины
            // Determine which domain is used for showcase
            $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
            $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
            $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

            // Помещаем домен в переменную
            // Put the variable domain
            $domain_vitrina = htmlentities($res_domain_vitrina['domain']);
            $redirect = 1;
        }

        if ($offer_end != 0) {

            if ($offer_end <= time()) {
                $sql_off_offer = "UPDATE offers SET `active`='0' WHERE `id`='$offerid' AND `owner_id`='$ownerid'";
                $result_off_offer = $mysqli->query($sql_off_offer);

                // Определяем какой домен используется для витрины
                // Determine which domain is used for showcase
                $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
                $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
                $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

                // Помещаем домен в переменную
                // Put the variable domain
                $domain_vitrina = htmlentities($res_domain_vitrina['domain']);

                // Редиректим посетителя на витрину
                // Redirect the visitor to the shop window
                //Header('Location: http://'.$domain_vitrina);
                //exit;
                $redirect = 1;
            }
        }

        if ($off_lids != 0) {

            if ($kolvo_lids == 0) {
                $sql_off_offer = "UPDATE offers SET `active`='0' WHERE `id`='$offerid' AND `owner_id`='$ownerid'";
                $result_off_offer = $mysqli->query($sql_off_offer);

                // Определяем какой домен используется для витрины
                // Determine which domain is used for showcase
                $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
                $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
                $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

                // Помещаем домен в переменную
                // Put the variable domain
                $domain_vitrina = htmlentities($res_domain_vitrina['domain']);

                // Редиректим посетителя на витрину
                // Redirect the visitor to the shop window
                //Header('Location: http://'.$domain_vitrina);
                //exit;
                $redirect = 1;
            }
        }


        // Если указано при каком минимальном балансе рекламодателя оффер должен отключаться то выполняем проверку
        // If you specify at what minimum balance of advertiser's offer must be switched off then complete the checkout
        if ($off_balance != '0') {
            // Узнаем баланс рекламодателя
            // Learn advertiser balance
            $sql_reklamodatel_data = "SELECT balance FROM users WHERE `id`='$ownerid'";
            $result_reklamodatel_data = $mysqli->query($sql_reklamodatel_data);
            $res_reklamodatel_data = mysqli_fetch_array($result_reklamodatel_data);
            $balance_reklamodatel = htmlentities($res_reklamodatel_data['balance']);

            // Если на балансе у рекламодателя сумма меньше или равна той при которой оффер должен выключаться, то выключаем оффер.
            // If the balance of the advertiser's total is less than or equal to that in which the offer should be turned off, then turn off the offer.
            if ($balance_reklamodatel <= $off_balance) {
                $sql_off_offer = "UPDATE offers SET `active`='0' WHERE `id`='$offerid' AND `owner_id`='$ownerid'";
                $result_off_offer = $mysqli->query($sql_off_offer);

                // Определяем какой домен используется для витрины
                // Determine which domain is used for showcase
                $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
                $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
                $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

                // Помещаем домен в переменную
                // Put the variable domain
                $domain_vitrina = htmlentities($res_domain_vitrina['domain']);

                // Редиректим посетителя на витрину
                // Redirect the visitor to the shop window
                //Header('Location: http://'.$domain_vitrina);
                //exit;
                $redirect = 1;
            }
        }

        $type = Offer_Landing::TYPE_BEST_SIMPLE_RANDOM;
        if (isset($_REQUEST['sab'])) {
            $type = Offer_Landing::TYPE_BEST_SMART_RANDOM;
        }
        $prelandingid = explode(',', $prelandingid);
        $prelandingid = Offer_Prelanding::getBest($prelandingid, $type);



        $landingid = explode(',', $landingid);
        $landingid = Offer_Landing::getBest($landingid, $type);

        if ($prelandingid == '0') {
            // Проверяем есть ли лендинг с указанным ID
            // Check whether there landing with the specified ID
            $sql_checklanding = "SELECT id,url FROM landings WHERE `id`='$landingid'";
            $result_checklanding = $mysqli->query($sql_checklanding);
            if (mysqli_num_rows($result_checklanding) > 0) {
                $res_checklanding = mysqli_fetch_array($result_checklanding);
                $url = htmlentities($res_checklanding['url']);

                // Подключаем все необходимые функции
                // Connect all the necessary functions
                include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/functions.php';
            }
        } else {
            // Получаем УРЛ лендинга
            // Check landing URL
            $sql_checklanding = "SELECT id,url FROM landings WHERE `id`='$landingid'";
            $result_checklanding = $mysqli->query($sql_checklanding);
            if (mysqli_num_rows($result_checklanding) > 0) {
                $res_checklanding = mysqli_fetch_array($result_checklanding);
                $url_landing = htmlentities($res_checklanding['url']);
            }

            // Проверяем есть ли прелендинг с указанным ID
            // Check whether there prelanding with the specified ID
            $sql_checkprelanding = "SELECT id,url FROM prelandings WHERE `id`='$prelandingid'";
            $result_checkprelanding = $mysqli->query($sql_checkprelanding);
            if (mysqli_num_rows($result_checkprelanding) > 0) {
                $res_checkprelanding = mysqli_fetch_array($result_checkprelanding);
                $url = htmlentities($res_checkprelanding['url']);
                // Подключаем все необходимые функции
                // Connect all the necessary functions
                include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/functions.php';
            }
        }
    }
}

// Если был переход по ссылке субаккаунта выданной вебмастеру в разделе СУБАККАУНТЫ
// If there was a transition to the link subaccount webmaster issued under subaccounts
if ((isset($_GET['s']) && $_GET['s'] != '' && $_GET['s'] != '0')  || (isset($_GET['stream']) && $_GET['stream'] != '' && $_GET['stream'] != '0')) {
    if (isset($_GET['s']) && $_GET['s'] != '' && $_GET['s'] != '0') {
        $subacc_id = htmlentities($_GET['s']);
    } elseif (isset($_GET['stream']) && $_GET['stream'] != '' && $_GET['stream'] != '0') {
        $subacc_id = htmlentities($_GET['stream']);
    }
    // Проверяем есть ли субаккаунт с указанным ID
    // Check whether there subaccount with the specified ID
    $sql_readsubacc = "SELECT * FROM streams WHERE `id`='$subacc_id'";
    $result_readsubacc = $mysqli->query($sql_readsubacc);
    $usePreland = false;
    $useLanding = false;
    if (mysqli_num_rows($result_readsubacc) > 0) {
        
        $res_readsubacc = mysqli_fetch_array($result_readsubacc);
        $userid = htmlentities($res_readsubacc['user_id']);
        if ($userid == '1') {
            $userid = '0';
        }
        
        
        $_SESSION['stream'] = $res_readsubacc['id'];
        
        $offerid = htmlentities($res_readsubacc['offer_id']);
        $landingid = htmlentities($res_readsubacc['landing_id']);
        $prelandingid = htmlentities($res_readsubacc['prelanding_id']);
        $smartAB = intval($res_readsubacc['smartAB']);

        $landingidArray = explode(',', $landingid);
        $prelandingidArray = explode(',', $prelandingid);
        $landingid = $landingidArray[array_rand($landingidArray)];
        $type = Offer_Landing::TYPE_BEST_SIMPLE_RANDOM;
        if ($smartAB) {
            $type = Offer_Landing::TYPE_BEST_SMART_RANDOM;
        }


        $md = new \Detection\MobileDetect;
        $grab_pc = $grab_mobile = [];
        if ($res_readsubacc['auto_mobile']) {

            // 1 simple
            // 2 - mobile
            // 4 adap
            $grab_pc = [];
            $sql = "select id from landings where offer_id=" . $offerid . " and ((type&1)=1 || (type&4=4)) and id in({$res_readsubacc['landing_id']})";
            try {
                $stmt = DB::getInstance()->query($sql);
                $grab_pc = $stmt->fetchAll(PDO::FETCH_COLUMN);
            } catch (Exception $ex) {
                
            }
            if (empty($grab_pc)) {
                // ПК пустые
                $sql = "select id from landings where offer_id=" . $offerid . " and ((type&1)=1 || (type&4=4))";
                $stmt = DB::getInstance()->query($sql);
                $grab_pc = $stmt->fetchAll(PDO::FETCH_COLUMN);
            }

            $grab_mobile = [];
            $sql = "select id from landings where offer_id=" . $offerid . " and ((type&2)=2) and id in({$res_readsubacc['landing_id']})";
            try {
                $stmt = DB::getInstance()->query($sql);
                $grab_mobile = $stmt->fetchAll(PDO::FETCH_COLUMN);
            } catch (Exception $ex) {
                
            }
            if (empty($grab_mobile)) {
                // ПК пустые
                $sql = "select id from landings where offer_id=" . $offerid . " and ((type&2)=2 || (type&4=4))";
                $stmt = DB::getInstance()->query($sql);
                $grab_mobile = $stmt->fetchAll(PDO::FETCH_COLUMN);
            }

            //grab mob

            if ($md->isMobile() || $md->isTablet()) {
                $landingidArray = $grab_mobile;
            } else {
                $landingidArray = $grab_pc;
            }
        }
        
        $landingid = Offer_Landing::getBest($landingidArray, $type);
        

        if ($prelandingid == '') {
            $prelandingid = false;
        } else {
            $prelandingid = Offer_Prelanding::getBest($prelandingidArray, $type);
        }
        $usePreland = $prelandingid;
        $useLanding = $landingid;


        $domainid = htmlentities($res_readsubacc['domain_id']);
        if(isset($_GET['referer'])) {
            $referer = htmlspecialchars($_GET['referer']);
        }else {
            $referer = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        }
        if (isset($_GET['subid1'])) {
            $subid1 = htmlspecialchars($_GET['subid1']);
        } else {
            $subid1 = htmlspecialchars($res_readsubacc['subid1']);
        }
        if (isset($_GET['subid2'])) {
            $subid2 = htmlspecialchars($_GET['subid2']);
        } else {
            $subid2 = htmlspecialchars($res_readsubacc['subid2']);
        }
        if (isset($_GET['subid3'])) {
            $subid3 = htmlspecialchars($_GET['subid3']);
        } else {
            $subid3 = htmlspecialchars($res_readsubacc['subid3']);
        }
        if (isset($_GET['subid4'])) {
            $subid4 = htmlspecialchars($_GET['subid4']);
        } else {
            $subid4 = htmlspecialchars($res_readsubacc['subid4']);
        }
        if (isset($_GET['subid5'])) {
            $subid5 = htmlspecialchars($_GET['subid5']);
        } else {
            $subid5 = htmlspecialchars($res_readsubacc['subid5']);
        }
        // Проверяем есть ли оффер с указанным ID
        // Check whether the offer is, with the specified ID
        $sql_checkoffer = "SELECT id,type_offer,kolvo_lids,offer_end,owner_id,postclick,off_balance,off_lids,active FROM offers WHERE `id`='$offerid'";

        $result_checkoffer = $mysqli->query($sql_checkoffer);
        if (mysqli_num_rows($result_checkoffer) > 0) {

            $res_checkoffer = mysqli_fetch_array($result_checkoffer);
            $offerid = htmlentities($res_checkoffer['id']);
            $type_offer = htmlentities($res_checkoffer['type_offer']);
            $ownerid = htmlentities($res_checkoffer['owner_id']);
            $postclick = htmlentities($res_checkoffer['postclick']);
            $off_balance = htmlentities($res_checkoffer['off_balance']);
            $kolvo_lids = htmlentities($res_checkoffer['kolvo_lids']);
            $offer_end = htmlentities($res_checkoffer['offer_end']);
            $off_lids = htmlentities($res_checkoffer['off_lids']);
            $active = htmlentities($res_checkoffer['active']);

            if ($active == 0) {
                // Определяем какой домен используется для витрины
                // Determine which domain is used for showcase
                $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
                $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
                $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

                // Помещаем домен в переменную
                // Put the variable domain
                $domain_vitrina = htmlentities($res_domain_vitrina['domain']);
                $redirect = 1;
            }

            // Если указано при каком минимальном балансе рекламодателя оффер должен отключаться то выполняем проверку
            // If you specify at what minimum balance of advertiser's offer must be switched off then complete the checkout
            if ($off_balance != '0') {
                // Узнаем баланс рекламодателя
                // Learn advertiser balance
                $sql_reklamodatel_data = "SELECT balance FROM users WHERE `id`='$ownerid'";
                $result_reklamodatel_data = $mysqli->query($sql_reklamodatel_data);
                $res_reklamodatel_data = mysqli_fetch_array($result_reklamodatel_data);
                $balance_reklamodatel = htmlentities($res_reklamodatel_data['balance']);

                // Если на балансе у рекламодателя сумма меньше или равна той при которой оффер должен выключаться, то выключаем оффер.
                // If the balance of the advertiser's total is less than or equal to that in which the offer should be turned off, then turn off the offer 
                if ($balance_reklamodatel <= $off_balance) {
                    $sql_off_offer = "UPDATE offers SET `active`='0' WHERE `id`='$offerid' AND `owner_id`='$ownerid'";
                    $result_off_offer = $mysqli->query($sql_off_offer);

                    // Определяем какой домен используется для витрины
                    // Determine which domain is used for showcase
                    $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
                    $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
                    $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

                    // Помещаем домен в переменную
                    // Put the variable domain
                    $domain_vitrina = htmlentities($res_domain_vitrina['domain']);

                    // Редиректим посетителя на витрину
                    // Redirect the visitor to the shop window
                    //Header('Location: http://'.$domain_vitrina);
                    //exit;
                    $redirect = 1;
                }
            }
            if ($offer_end != 0) {

                if ($offer_end <= time()) {
                    $sql_off_offer = "UPDATE offers SET `active`='0' WHERE `id`='$offerid' AND `owner_id`='$ownerid'";
                    $result_off_offer = $mysqli->query($sql_off_offer);

                    // Определяем какой домен используется для витрины
                    // Determine which domain is used for showcase
                    $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
                    $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
                    $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

                    // Помещаем домен в переменную
                    // Put the variable domain
                    $domain_vitrina = htmlentities($res_domain_vitrina['domain']);

                    // Редиректим посетителя на витрину
                    // Redirect the visitor to the shop window
                    //Header('Location: http://'.$domain_vitrina);
                    //exit;
                    $redirect = 1;
                }
            }

            if ($off_lids != 0) {

                if ($kolvo_lids == 0) {
                    $sql_off_offer = "UPDATE offers SET `active`='0' WHERE `id`='$offerid' AND `owner_id`='$ownerid'";
                    $result_off_offer = $mysqli->query($sql_off_offer);

                    // Определяем какой домен используется для витрины
                    // Determine which domain is used for showcase
                    $sql_domain_vitrina = "SELECT domain FROM domains WHERE `active`='2' ORDER BY `id` DESC";
                    $result_domain_vitrina = $mysqli->query($sql_domain_vitrina);
                    $res_domain_vitrina = mysqli_fetch_array($result_domain_vitrina);

                    // Помещаем домен в переменную
                    // Put the variable domain
                    $domain_vitrina = htmlentities($res_domain_vitrina['domain']);

                    // Редиректим посетителя на витрину
                    // Redirect the visitor to the shop window
                    //Header('Location: http://'.$domain_vitrina);
                    //exit;
                    $redirect = 1;
                }
            }

            if ($usePreland === false) {


                // Проверяем есть ли лендинг с указанным ID
                // Check whether there landing with the specified ID
                $sql_checklanding = "SELECT id,url FROM landings WHERE `id`='$landingid'";
                $result_checklanding = $mysqli->query($sql_checklanding);

                if (mysqli_num_rows($result_checklanding) > 0) {
                    $res_checklanding = mysqli_fetch_array($result_checklanding);
                    $url = htmlentities($res_checklanding['url']);

                    //if($type_offer == 1 || $type_offer == 2){
                        $sql_checkdomain = "SELECT domain FROM domains WHERE `id`='$domainid'";
                        $result_checkdomain = $mysqli->query($sql_checkdomain);
                        if (mysqli_num_rows($result_checkdomain) > 0) {
                            $res_checkdomain = mysqli_fetch_array($result_checkdomain);

                            $url = str_replace("http://demo-brand.ru", "", $url);
                            $url = 'http://' . $res_checkdomain['domain'] . $url;

                        }
                        //var_dump($url); die();
                        include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/functions.php';
                    //}else{
                    //    include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/functions.php';
                    //}
                }
            } else {
                // use preland
                $op = Offer_Prelanding::getById($usePreland);
                $domain = Domain::getById($domainid);
                $url = $op->url;
                if ($domain) {
                    $url = str_replace('http://demo-brand.ru', 'http://' . $domain->domain, $url);
                }
                if ($useLanding) {
                    $ol = Offer_Landing::getById($useLanding);
                    $url_landing = $ol->url;
                    if ($domain) {

                        $url_landing = str_replace('http://demo-brand.ru', 'http://' . $domain->domain, $url_landing);
                    }
                }

                include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/functions.php';
            }
        }
    }
}
?>