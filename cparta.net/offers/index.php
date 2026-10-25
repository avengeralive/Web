<?php
// Если был переход по ссылке субаккаунта выданной вебмастеру в личном кабинете
// If there was a transition to the link subaccount webmaster issued in a private office
if (isset($_GET['s']) && $_GET['s'] != '' && $_GET['s'] != '0') {
    // Подключаем файл конфигурации
    // Connect configuration file
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/config.php';

    // Подключаем файл защиты от инжекта для передаваемых переменных
    // Connect the protection of Injection file transmitted variable
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/antiinject/index.php';

    // Подключаем функции кодирования и раскодирования партнерской строки
    // Connect the encoding and decoding functions affiliate line
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/partnerstroka/index.php';

    // Подключаем необходимые библиотеки
    // Connect the required libraries

    include_once $_SERVER['DOCUMENT_ROOT'] . '/../modules/count/index.php';
    //$url .= '?stats=' . $_GET['code'] . '&stream=' . $_GET['s'];
    
    if($offerid == 313 || $offerid == 532){
        header('Location: ' . $url);
        exit;
    }
    
    if (isset($_GET['subid1']) && $_GET['subid1'] != '') {
        $url .= '&subid1=' . $_GET['subid1'];
    }
    if (isset($_GET['subid2']) && $_GET['subid2'] != '') {
        $url .= '&subid2=' . $_GET['subid2'];
    }
    if (isset($_GET['subid3']) && $_GET['subid3'] != '') {
        $url .= '&subid3=' . $_GET['subid3'];
    }
    if (isset($_GET['subid4']) && $_GET['subid4'] != '') {
        $url .= '&subid4=' . $_GET['subid4'];
    }
    if (isset($_GET['subid5']) && $_GET['subid5'] != '') {
        $url .= '&subid5=' . $_GET['subid5'];
    }   
    if (isset($_GET['utm_source'])) {
        $url .= '&utm_source=' . $_GET['utm_source'];
    }
    if (isset($_GET['utm_medium'])) {
        $url .= '&utm_medium=' . $_GET['utm_medium'];
    }
    if (isset($_GET['utm_campaign'])) {
        $url .= '&utm_campaign=' . $_GET['utm_campaign'];
    }
    if (isset($_GET['utm_content'])) {
        $url .= '&utm_content=' . $_GET['utm_content'];
    }
    if (isset($_GET['utm_term'])) {
        $url .= '&utm_term=' . $_GET['utm_term'];
    }
    
    header('Location: ' . $url);
    exit;	
}

// Если было инициировано добавление нового заказа (заявки/действия или пр.) в базу
// If it was initiated by the addition of a new order (orders/actions or e.t.c.) in the base
if (isset($_POST['code']) && $_POST['code'] != '' && $_POST['code'] != '0') {
    $code = htmlentities($_POST['code']);
    // telegram($code);
    // Подключаем файл конфигурации
    // Connect configuration file
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/config.php';

    // Подключаем файл защиты от инжекта для передаваемых переменных
    // Connect the protection of injection file transmitted variables
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/antiinject/index.php';
    // Подключаем необходимые библиотеки
    // Connect the required libraries
    // Получаем данные используя статистику посещений
    // Get the data using the statistics of visits
    $log = Client_Log::getById($code);
    // telegram($log->offer_id);
    if (!$log) {
        exit("z");
    }

    $post = new Request($_POST);
    // достаем офер из лога
    $offer = Offer::getById($log->offer_id);
    // преобразовываем лог в клиента
    $client = $log->castToClient();
    // определяем продавца по оферу и клиенту
    $seller = Seller::getByOffer($offer, $client);
    // формируем заказ
    $zakaz = new Zakaz;
    $zakaz->owner_id = $seller->id;
    $zakaz->kolvo = max(1, intval($post->kolvo));
    $zakaz->artikul = $post->artikul;
    $zakaz->comments = $post->comments;
    $zakaz->user_id = $log->user_id;
    $zakaz->landing_id = $log->landing_id;
    $zakaz->prelanding_id = $log->prelanding_id;

    $zakaz->referer = $_POST['referer'];
    $zakaz->subid1 = $log->subid1;
    $zakaz->subid2 = $log->subid2;
    $zakaz->subid3 = $log->subid3;
    $zakaz->subid4 = $log->subid4;
    $zakaz->subid5 = $log->subid5;
    $zakaz->stream = $log->stream;

    $client->name = $post->name;
    $client->phone = $post->phone;
    $client->email = $post->email;
    $client->address = $post->address;
    $api = new Api;
    try {
        $zakaz = $api->createOrder($client, $offer, $zakaz);
        echo $zakaz->id;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
    exit;
}

// Если поступил внешний запрос на изменение статуса заказа, то выполняем
// If you entered an external request to change the status of an order, then the
if (isset($_POST['shop_key']) && isset($_POST['shop_zakaz_id']) && isset($_POST['shop_zakaz_status'])) {
    // Подключаем файл конфигурации
    // Connect configuration file
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/config.php';

    // Подключаем файл защиты от инжекта для передаваемых переменных
    // Connect the protection of injection file transmitted variables
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/antiinject/index.php';

    // Подключаем файл с настройками системы
    // Connect the file system settings
    include $_SERVER['DOCUMENT_ROOT'] . '/../includes/settings/index.php';

    $shop_key = htmlentities($_POST['shop_key']);
    $shop_zakaz_id = htmlentities($_POST['shop_zakaz_id']);
    $shop_zakaz_status = htmlentities($_POST['shop_zakaz_status']);


    $sql_getdatazakaz = "SELECT * FROM zakaz WHERE `shop_key`='$shop_key' AND `shop_zakaz_id`='$shop_zakaz_id'";
    $result_getdatazakaz = $mysqli->query($sql_getdatazakaz);
    if (mysqli_num_rows($result_getdatazakaz) > 0) {
        $res_getdatazakaz = mysqli_fetch_array($result_getdatazakaz);

        // Функция обновления статуса заказа
        // Function updates the order status
        function update_zakaz() {
            global $mysqli, $id_zakaz, $status;
            $sql_update_zakaz = "UPDATE zakaz SET `status`='$status' WHERE `id`='$id_zakaz'";
            $result_update_zakaz = $mysqli->query($sql_update_zakaz);
        }

        function update_offer($type_sql) {
            global $mysqli, $offer_id;
            $sql_update_offer = "UPDATE offers SET `kolvo_lids`= `kolvo_lids` " . $type_sql . " WHERE `id` = '$offer_id'  AND off_lids = '1' LIMIT 1";
            $result_update_offer = $mysqli->query($sql_update_offer);
        }

        // Назначаем переменные под поступившие данные
        // Assign a variable received data
        $id_zakaz = htmlentities($res_getdatazakaz['id']);
        $date_obrabotka = date('d.m.Y H:i:s');
        $status = $shop_zakaz_status;

        // Узнаем, каков был статус заказа и ID оффера до нашего вмешательства
        // Find out what was the status of the order and ID offera before our intervention
        $sql_zakaz_data = "SELECT status, offer_id, cena, kolvo, user_id, comission, comission_cpa, owner_id FROM zakaz WHERE `id`='$id_zakaz'";
        $result_zakaz_data = $mysqli->query($sql_zakaz_data);
        $res_zakaz_data = mysqli_fetch_array($result_zakaz_data);


        $cena = htmlentities($res_zakaz_data['cena']);
        $kolvo = htmlentities($res_zakaz_data['kolvo']);
        $webmaster_id = htmlentities($res_zakaz_data['user_id']);
        $comission = htmlentities($res_zakaz_data['comission']);
        $comission_cpa = htmlentities($res_zakaz_data['comission_cpa']);

        // Назначаем переменную под ID рекламодателя, владельца оффера
        // Assign a variable ID advertiser offer owner
        $owner_id = htmlentities($res_zakaz_data['owner_id']);

        // Назначаем переменную под ID оффера
        // Assign a variable ID offer
        $offer_id = htmlentities($res_zakaz_data['offer_id']);

        // Назначаем переменную под старый статус заказа
        // Assign a variable for the old order status
        $old_status_zakaza = htmlentities($res_zakaz_data['status']);

        // Узнаем, какой тип действия используется на оффере
        // Find out what type of action used to offer
        $sql_offers_data = "SELECT deystvie FROM offers WHERE `id`='$offer_id'";
        $result_offers_data = $mysqli->query($sql_offers_data);
        $res_offers_data = mysqli_fetch_array($result_offers_data);

        // Назначаем переменную под тип действия на оффере
        // Assign a variable to the type of action to offer
        $offer_deystvie = htmlentities($res_offers_data['deystvie']);

        // Сумма заказа = цена * количество заказанного
        // Amount of order = price * quantity ordered
        $summa_zakaza = $cena * $kolvo;

        // Комиссия вебмастеру = комиссия вебмастеру * количество заказанного
        // The commission = comission webmaster * amount ordered
        $summa_comission = $comission * $kolvo;

        // Комиссия в пользу CPA-сети = комиссия CPA-сети * количество заказанного
        // The commission in favor of the CPA-network = CPA-network comission * amount ordered
        $summa_comission_cpa = $comission_cpa * $kolvo;

        // Общая сумма вычитаемой с рекламодателя комиссии = комиссия вебмастеру + комиссия в пользу CPA-сети
        // The total amount is deducted from the advertiser's commission = commission webmaster + commission in favor of the CPA-network
        $comission_all = $summa_comission + $summa_comission_cpa;

        // Узнаем текущий баланс рекламодателя
        // Check the current balance of advertiser
        $sql_balance_reklamodatel = "SELECT balance FROM users WHERE id=$owner_id";
        $result_balance_reklamodatel = $mysqli->query($sql_balance_reklamodatel);
        $res_balance_reklamodatel = mysqli_fetch_array($result_balance_reklamodatel);

        // Назначаем переменную под текущий баланс рекламодателя
        // Assign a variable for the current balance of advertiser
        $balance_reklamodatel = htmlentities($res_balance_reklamodatel['balance']);

        // Узнаем текущий баланс вебмастера и ID его рефовода
        // Check the current balance of the webmaster and its referrer ID
        $sql_data_webmaster = "SELECT balance,myrefovod FROM users WHERE id=$webmaster_id";
        $result_data_webmaster = $mysqli->query($sql_data_webmaster);
        $res_data_webmaster = mysqli_fetch_array($result_data_webmaster);

        // Назначаем переменную под текущий баланс вебмастера
        // Assign a variable current balance webmaster
        $balance_webmaster = htmlentities($res_data_webmaster['balance']);

        // Назначаем переменную под ID рефовода вебмастера
        // Assign a variable referrer ID webmaster
        $refovod_webmaster = htmlentities($res_data_webmaster['myrefovod']);

        // Узнаем текущий баланс рефовода
        // Check the current balance of the referrer
        if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
            $sql_balance_refovod = "SELECT balance FROM users WHERE `id`='$refovod_webmaster'";
            $result_balance_refovod = $mysqli->query($sql_balance_refovod);
            $res_balance_refovod = mysqli_fetch_array($result_balance_refovod);

            // Назначаем переменную под текущий баланс рефовода
            // Assign a variable current balance referrer
            $balance_refovod = htmlentities($res_balance_refovod['balance']);
        }


        // Если не было изменения статуса заказа, а было только изменение свойств заказа, то изменяем свойства заказа
        // If there was no change in the status of an order, and it was only a change in the order of properties, you are changing the properties of the order
        if ($status == $old_status_zakaza) {
            // Обновляем свойства заказа
            // Update the properties of the order				
            update_zakaz();
        }

        // ОЖИДАЕТ //		
        // EXPECTS //
        // Если происходит изменение статуса с ОЖИДАЕТ на В ХОЛДЕ
        // If there is a change of status with WAITING on HOLD
        elseif ($status == '2' && $old_status_zakaza == '1') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "- '1'";
            update_offer($type_sql);
            // Вычитаем у рекламодателя с баланса средства (сумма комиссии вебмастера для помещения в ХОЛД и сумму комиссии CPA-сети)
            // Subtract the advertiser with the balance of funds (the sum of commission webmasters for premises in HOLD and the amount comission of CPA-network)
            $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
            $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

            // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
            // Write to the database, in "finances" table, information about the funds are debited from the balance of advertiser
            $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',12,'$balance_reklamodatel'-'$comission_all','2')";
            $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Начисляем снятые у рекламодателя с баланса средства вебмастеру в ХОЛД
                // Accrued removed from the advertiser with a balance means webmaster in HOLD
                $sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`+'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
            }
        }

        // Если происходит изменение статуса с ОЖИДАЕТ на ПРИНЯТ
        // If there is a change of status with EXPECT on ACCEPTED
        elseif ($status == '3' && $old_status_zakaza == '1') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "- '1'";
            update_offer($type_sql);
            // Вычитаем у рекламодателя с баланса средства (сумма комиссии вебмастера и сумму комиссии CPA-сети)
            // Subtract the advertiser with the balance of funds (sum commission of webmasters and the amount of CPA-network comission)
            $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
            $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

            // Пишем в базу, в таблицу finances, информацию о списании средств с баланса рекламодателя
            // Write to the database, in finances table, information about the funds are debited from the balance of advertiser
            $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',13,'$balance_reklamodatel'-'$comission_all','2')";
            $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Начисляем комиссию вебмастера на баланс вебмастеру
                // Commission is charged webmaster at webmaster balance
                $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                // Пишем в базу, в таблицу finances, информацию о начислении средств на баланс вебмастеру
                // Write to the database, in finances table, information about the funds be credited to the balance webmaster
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',5,'$balance_webmaster'+'$summa_comission','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

                // Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя в качестве комиссии CPA-сети
                // Is charged to the account of the CPA-network balance of funds deducted from the advertiser's balance sheet as a CPA-network commission
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }
            // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
            // If the order came without a webmaster, then execute
            else {
                // Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя (комиссию вебмастера + комиссию CPA-сети)
                // Accrued on the account balance CPA-network money deducted from the advertiser's balance (commission webmaster + CPA-network comission)
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }

            // Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
            // If the webmaster has a referrer, the referrer accrue referral bonus
            if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                // Начисляем реферальские на счет рефовода
                // Referral bonus is charged to the account of the referrer
                $summ_referal = $summa_comission / 100 * $settings_refprocent;
                $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
                $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                // Пишем в базу, в таблицу "finances", информацию о начислении реферальских на баланс рефовода
                // Write to the database, the table "finances", information on the calculation of the balance of referrers to a referrer
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
            }
        }
        // Если происходит изменение статуса с ОЖИДАЕТ на ОТКЛОНЕН
        // If there is a change of status with WAITING on REJECTED
        elseif ($status == '0' && $old_status_zakaza == '1') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
        }

// В ХОЛДЕ //
// HOLD //
        // Если происходит изменение статуса с в ХОЛДЕ на ОЖИДАЕТ
        // If there is a change in status with HOLD on WAITING
        elseif ($status == '1' && $old_status_zakaza == '2') {
            // Обновляем свойства заказа
            // Update the properties of the order			
            update_zakaz();
            $type_sql = "+ '1'";
            update_offer($type_sql);
            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Вычитаем из холда у вебмастера комиссию вебмастера для последующего возврата на баланс рекламодателю
                // Subtract from Hold at webmaster webmaster commission to return for the advertiser to balance
                $sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`-'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
            }

            // Возвращаем рекламодателю на баланса средства (сумма комиссии вебмастера и сумму комиссии CPA-сети)
            // Return the advertiser at the balance sheet assets (sum comission webmaster and sum CPA-network comission)
            $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
            $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

            // Пишем в базу, в таблицу "finances", информацию о возврате средств на баланс рекламодателю
            // Write to the database, the table "finances", the information on the return of funds to balance the advertiser
            $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',14,'$balance_reklamodatel'+'$comission_all','2')";
            $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
        }

        // Если происходит изменение статуса с в ХОЛДЕ на ПРИНЯТ
        // If there is a change of status with HOLD on ACCEPTED
        elseif ($status == '3' && $old_status_zakaza == '2') {
            // Обновляем свойства заказа и изменяем дополнительный статус на "ЗАКАЗ ОПЛАЧЕН"
            // Update the properties of order and change the optional status to "order has been paid"
            update_zakaz('4');
            $type_sql = "- '1'";
            update_offer($type_sql);
            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Вычитаем средства из ХОЛДа у вебмастера, для последующего зачисления на баланс этому же вебмастеру
                // Subtract money from HOLD in webmaster for further admission to the balance of the same webmaster
                $sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`-'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);

                // Начисляем средства, до этого вычтенные их ХОЛДа вебмастера на баланс этому же вебмастеру
                // Accrued funds deducted before their Holden webmaster to balance the same webmaster
                $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастеру
                // Write to the database, the table "finances", information on the funds be credited to the balance webmaster
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',5,'$balance_webmaster'+'$summa_comission','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
            }

            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя в качестве комиссии CPA-сети
                // Is charged to the account of the CPA-network balance of funds deducted from the advertiser's balance sheet as a CPA-network commission
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }
            // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
            // If the order came without a webmaster, then execute
            else {
                // Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя (сумма комиссии вебмастера и сумму комиссии CPA-сети)
                // Accrued on the account balance CPA-network money deducted from the advertiser's balance (sum webmaster commission and sum CPA-network comission)
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }

            // Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
            // If the webmaster has a referrer, the referrer accrue referral bonus
            if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                // Начисляем реферальские на счет рефовода
                // Referral bonus is charged to the account of the referrer
                $summ_referal = $summa_comission / 100 * $settings_refprocent;
                $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
                $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                // Пишем в базу, в таблицу finances, информацию о начислении реферальских на баланс рефовода
                // Write to the database, in finances table, information about the calculation of the balance of referrers to a referrer
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
            }
        }

        // Если происходит изменение статуса с В ХОЛДЕ на ОТКЛОНЕН
        // If there is a change status with HOLD on REJECTED
        elseif ($status == '0' && $old_status_zakaza == '2') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "+ '1'";
            update_offer($type_sql);
            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Вычитаем у вебмастера из ХОЛДа сумму холда
                // Subtract from the webmaster from HOLD sum Hold
                $sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`-'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
            }

            // Начисляем на баланс рекламодателя сумму, вычтенную у него ранее в качестве комиссии вебмастера и комиссии CPA-сети
            // Advertiser is charged on the balance amount subtracted from him earlier as a webmaster commission and CPA-network commission
            $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
            $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

            // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс рекламодателю
            // Write to the database, in "finances" table, information about the funds be credited to the balance of advertiser
            $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',15,'$balance_reklamodatel'+'$comission_all','2')";
            $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
        }

// ПРИНЯТ //
// ACCEPTED //
        // Если происходит изменение статуса с ПРИНЯТ на ОЖИДАЕТ
        // If there is a change of status with ACCEPTED on WAITING
        elseif ($status == '1' && $old_status_zakaza == '3') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "+ '1'";
            update_offer($type_sql);
            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя в качестве комиссии CPA-сети
                // Subtract from the balance CPA-network funds accrued to the balance of the advertiser as a CPA-network commission
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }
            // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
            // If the order came without a webmaster, then execute
            else {
                // Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя (комиссия вебмастера и комиссия CPA-сети)
                // Subtract with CPA-network balance funds accrued to the balance of advertiser (webmaster comission and CPA-network comission)
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }

            // Возвращаем рекламодателю на баланс вычтенную ранее сумму комиссии вебмастера и сумму комиссии CPA-сети
            // Return the advertiser to balance subtracted before the fee amount and webmasters CPA-network commission
            $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
            $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

            // Пишем в базу, в таблицу finances, информацию о начислении средств на баланс рекламодателю
            // Write to the database, in finances table, information about the funds be credited to the balance of advertiser
            $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',14,'$balance_reklamodatel'+'$comission_all','2')";
            $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Вычитаем с баланса вебмастера сумму комиссии начисленную ранее
                // Subtract the amount from the balance webmaster commission assessed previously
                $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса вебмастера
                // Write to the database, the table "finances", information about the funds are debited from the balance webmaster
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',14,'$balance_webmaster'-'$summa_comission','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
            }

            // Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
            // If the webmaster has referrer, then subtract from referrer referral bonus
            if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                // Вычитаем реферальские со счета рефовода
                // Subtract from an account referral bonus referrer
                $summ_referal = $summa_comission / 100 * $settings_refprocent;
                $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
                $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                // Пишем в базу, в таблицу "finances", информацию о вычитании реферальских с баланса рефовода
                // Write to the database, in "finances" table, information about referrers subtracted from the balance of the referrer
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
            }
        }

        // Если происходит изменение статуса с ПРИНЯТ на ОТКЛОНЕН
        // If there is a change of status with ACCEPTED on REJECTED
        elseif ($status == '0' && $old_status_zakaza == '3') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "+ '1'";
            update_offer($type_sql);
            // Если данный оффер работает по онлайн-оплате, то выполняем
            // If this offer works for online payment, then execute
            if ($offer_deystvie == '5') {
                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Вычитаем с баланса CPA-сети средства начисленные в качестве комиссии CPA-сети (комиссия вебмастера)
                    // Subtract from the balance CPA-network funds accrued as a CPA-network Commission (webmaster commission)
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }
                // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
                // If the order came without a webmaster, then execute
                else {
                    // Вычитаем с баланса CPA-сети средства начисленные в качестве комиссии CPA-сети (комиссия вебмастера и комиссию CPA-сети)
                    // Subtract with CPA-network balance funds accrued as a CPA-network Commission (webmaster commission CPA-network comission)
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }
                // Вычитаем у рекламодателю с баланса начисленную ранее сумму
                // Subtract advertisers with the balance of the amount previously accrued
                $vychet_u_rekla = $summa_zakaza - $comission_all;
                $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$vychet_u_rekla' WHERE `id`='$owner_id'";
                $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

                // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
                // Write to the database, the table "finances", information about the funds are debited from the balance of advertiser
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$vychet_u_rekla',15,'$balance_reklamodatel'-'$vychet_u_rekla','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Вычитаем с баланса вебмастера сумму комиссии начисленную ранее
                    // Subtract the amount from the balance webmaster commission assessed previously
                    $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
                    $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                    // Пишем в базу, в таблицу finances, информацию о списании средств с баланса вебмастера
                    // Write to the database, the table finances, information about the funds are debited from the balance webmaster
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',15,'$balance_webmaster'-'$summa_comission','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }

                // Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
                // If the webmaster has referrer, then subtract from referrer referral bonus
                if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                    // Вычитаем реферальские со счета рефовода
                    // Subtract referral bonus account referrer
                    $summ_referal = $summa_comission / 100 * $settings_refprocent;
                    $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
                    $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                    // Пишем в базу, в таблицу "finances", информацию о вычитании реферальских с баланса рефовода
                    // Write to the database, in "finances" table, information about referrers subtracted from the balance referrer
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }
            } else {
                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя в качестве комиссии CPA-сети
                    // Subtract from the balance CPA-network funds accrued to the balance of the advertiser as a CPA-network commission
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }
                // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
                // If the order came without a webmaster, then execute
                else {
                    // Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя (комиссия вебмастера и комиссию CPA-сети)
                    // Subtract with CPA-network balance funds accrued to the balance of advertiser (webmaster commission and CPA-network comission)
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }

                // Возвращаем рекламодателю на баланс вычтенную ранее сумму комиссии вебмастера и сумму комиссии CPA-сети
                // Return the advertiser to balance subtracted before sum commission webmasters and sum CPA-network commission
                $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
                $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

                // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс рекламодателя
                // Write to the database, the table "finances", information on the funds be credited to the balance of advertiser
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',15,'$balance_reklamodatel'+'$comission_all','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Вычитаем с баланса вебмастера сумму комиссии начисленную ранее
                    // Subtract the amount from the balance webmaster commission assessed previously
                    $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
                    $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                    // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса вебмастера
                    // Write to the database, the table "finances", information about the funds are debited from the balance webmaster
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',15,'$balance_webmaster'-'$summa_comission','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }

                // Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
                // If the webmaster has referrer, then subtract from referrer referral bonus
                if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                    // Вычитаем реферальские со счета рефовода
                    // Subtract referral bonus account referrer
                    $summ_referal = $summa_comission / 100 * $settings_refprocent;
                    $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
                    $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                    // Пишем в базу, в таблицу finances, информацию о вычитании реферальских с баланса рефовода
                    // Write to the database, in finances table, information about referrers subtracted from the balance referrer
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }
            }
        }
        // Если происходит изменение статуса с ПРИНЯТ на В ХОЛДЕ
        // If there is a change of status with ACCEPTED on HOLD
        elseif ($status == '2' && $old_status_zakaza == '3') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "+ '1'";
            update_offer($type_sql);
            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Вычитаем со счета CPA-сети средства (комиссию CPA-сети) для последующего возврата на счет рекламодателю
                // Subtract from the CPA-network account funds (CPA-network comission) to return for on advertiser account
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }
            // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
            // If the order came without a webmaster, then execute
            else {
                // Вычитаем со счета CPA-сети средства (комиссию вебмастера и комиссию CPA-сети) для последующего возврата на счет рекламодателю
                // Subtract from the CPA-network bill means (webmaster commission and CPA-network comission) for subsequent return to the account of the advertiser
                $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
                $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
            }

            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then execute
            if ($webmaster_id != '0') {
                // Вычитаем средства с баланса вебмастера для последующего помещения их в ХОЛД этому же вебмастеру
                // Subtract the balance of funds from the webmaster for later placing them in HOLD the same webmaster
                $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                // Пишем в базу, в таблицу finances, информацию о списании средств с баланса вебмастера
                // Write to the database, the table finances, information about the funds are debited from the balance webmaster
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',16,'$balance_webmaster'-'$summa_comission','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

                // Начисляем средства, ранее взятые с баланса вебмастера в ХОЛД этому же вебмастеру
                // Accrued funds previously taken from the balance of the webmaster to HOLD the same webmaster
                $sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`+'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
            }

            // Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
            // If the webmaster has referrer, then subtract from referrer referral bonus
            if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                // Вычитаем реферальские со счета рефовода
                // Subtract referral bonus account referrer
                $summ_referal = $summa_comission / 100 * $settings_refprocent;
                $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
                $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                // Пишем в базу, в таблицу finances, информацию о вычитании реферальских с баланса рефовода
                // Write to the database, in finances table, information about referrers subtracted from the balance referrer
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
            }
        }

// ОТКЛОНЕН //
// REJECTED //
        // Если происходит изменение статуса с ОТКЛОНЕН на ОЖИДАЕТ
        // If there is a change of status with REJECTED on WAITING
        elseif ($status == '1' && $old_status_zakaza == '0') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
        }

        // Если происходит изменение статуса с ОТКЛОНЕН на В ХОЛДЕ
        // If there is a change of status with REJECTED on HOLD
        elseif ($status == '2' && $old_status_zakaza == '0') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "- '1'";
            update_offer($type_sql);
            // Вычитаем с баланса рекламодателя суммы - сумму комиссию вебмастера и сумму комиссии CPA-сети
            // Subtract the amount from the balance of advertiser - the amount and the amount of commission webmaster CPA-network commission
            $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
            $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

            // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
            // Write to the database, in "finances" table, information about the funds are debited from the balance of advertiser
            $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',12,'$balance_reklamodatel'-'$comission_all','2')";
            $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

            // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
            // If the order came from existing in the database webmaster, then the
            if ($webmaster_id != '0') {
                // Начисляем вебмастеру в ХОЛД сумму комиссии вебмастера
                // Is charged webmaster Hold'em amount webmaster commission
                $sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`+'$summa_comission' WHERE `id`='$webmaster_id'";
                $result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
            }
        }

        // Если происходит изменение статуса с ОТКЛОНЕН на ПРИНЯТ
        // If there is a change of status with REJECTED on ACCEPTED
        elseif ($status == '3' && $old_status_zakaza == '0') {
            // Обновляем свойства заказа
            // Update the properties of the order
            update_zakaz();
            $type_sql = "- '1'";
            update_offer($type_sql);
            // Если данный оффер работает по онлайн-оплате, то выполняем
            // If this offer works for online payment, then execute
            if ($offer_deystvie == '5') {
                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Начисляем на баланс CPA-сети средства в качестве комиссии CPA-сети (комиссия вебмастера)
                    // Is charged on the balance of CPA-network capability as a CPA-network commission (webmaster commission)
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }
                // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
                // If the order came without a webmaster, then execute
                else {
                    // Начисляем на баланс CPA-сети средства в качестве комиссии CPA-сети (комиссия вебмастера и комиссию CPA-сети)
                    // Charged on CPA-network capability as a CPA-network balance commission (webmaster commission and CPA-network comission)
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }
                // Начисляем рекламодателю на баланс заработанную сумму
                // Advertiser is charged on the balance of the amount earned
                $nachislenie_reklu = $summa_zakaza - $comission_all;
                $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$nachislenie_reklu' WHERE `id`='$owner_id'";
                $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

                // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланса рекламодателя
                // Write to the database, the table "finances", information on the funds be credited to the balance of advertiser
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$nachislenie_reklu',17,'$balance_reklamodatel'+'$nachislenie_reklu','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Начисляем на баланс вебмастера сумму комиссии
                    // Is charged on the balance of the amount of commission webmaster
                    $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
                    $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                    // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастера
                    // Write to the database, the table "finances", information on the funds be credited to the balance webmaster
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',13,'$balance_webmaster'+'$summa_comission','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }

                // Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
                // If the webmaster has referrer then accrue referrer referral bonus
                if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                    // Начисляем реферальские на счет рефоводу
                    // Referral bonus accrued to the account referrer
                    $summ_referal = $summa_comission / 100 * $settings_refprocent;
                    $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
                    $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                    // Пишем в базу, в таблицу "finances", информацию о начислении реферальских на баланс рефоводу
                    // Write to the database, in "finances" table, information about the calculation of referrers to balance referrer
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }
            } else {
                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Начисляем вебмастеру на баланс сумму комиссии
                    // Webmaster is charged on the balance of the amount of commission
                    $sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
                    $result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

                    // Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастера
                    // Write to the database, the table "finances", information on the funds be credited to the balance webmaster
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',5,'$balance_webmaster'+'$summa_comission','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }

                // Вычитаем у рекламодателя с баланса сумму комиссии вебмастера и сумму комиссии CPA-сети
                // Subtract the advertiser to balance the amount of webmasters commission and the amount of commission CPA-network
                $sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
                $result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);

                // Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
                // Write to the database, in "finances" table, information about the funds are debited from the balance of advertiser
                $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',13,'$balance_reklamodatel'-'$comission_all','2')";
                $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);

                // Если заказ пришел от имеющегося в базе вебмастера, то выполняем
                // If the order came from existing in the database webmaster, then execute
                if ($webmaster_id != '0') {
                    // Начисляем на баланс CPA-сети комиссию CPA-сети
                    // Charged on CPA-net balance comission CPA-net
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }
                // Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
                // If the order came without a webmaster, then the
                else {
                    // Начисляем на баланс CPA-сети комиссию (комиссию вебмастера и комиссию CPA-сети)
                    // Charged comission on balance CPA-network (commission webmasters and CPA-network comission)
                    $sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
                    $result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
                }

                // Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
                // If the webmaster has referrer then accrue referrer referral bonus
                if ($settings_refprocent != '0' && $refovod_webmaster != '0' && $refovod_webmaster != '') {
                    // Начисляем реферальские на счет рефовода
                    // Referral bonus accrued to the account referrer
                    $summ_referal = $summa_comission / 100 * $settings_refprocent;
                    $sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
                    $result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);

                    // Пишем в базу, в таблицу "finances", информацию о начислении реферальских на баланс рефовода
                    // Write to the database, the table "finances", information on the calculation of referrers to balance referrer
                    $sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
                    $result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
                }
            }
        }
    }
    exit;
}

exit;
?>
