<?php

if(isset($_REQUEST['download'])){
    
    include './includes/Zip/index.php';
    
    $landings = Landings::getById($_REQUEST['land']);
    
    
    $landing = $landings->url;
    $offer_id = $landings->offer_id;
    
    $arch_url = explode('/', $landing); 
    $arch_url = array_filter($arch_url); 
    $arch_url = array_values($arch_url);
    /*
    $url = '';
    $url_path_1 = $arch_url[count($arch_url) - 1];
    foreach ($arch_url as $k => $v){
        if($k < 2){continue;}
        $url .= $v . '/';
    }
    */
    $url = $arch_url[count($arch_url) - 2] . '/' . $arch_url[count($arch_url) - 1];
    
    
    $p = dirname(__FILE__) . '/../offers/' . $url;

    if (file_exists('./tmp/dland/' . $landings->id . '.zip')) {
        $file = 'http:///tmp/dland/' . $landings->id . '.zip';
        if (ob_get_level()) {
            ob_end_clean();
        }
        echo $file;
        exit;
    }else{
        zip($p, './tmp/dland/' . $landings->id . '.zip');
        $file = 'http:///tmp/dland/' . $landings->id . '.zip';
        if (ob_get_level()) {
            ob_end_clean();
        }
        echo $file;
        exit;
    }
    
}

if (isset($_POST['action'], $_POST['id']) && $_POST['action'] == 'save_admin_comments' && ($user_tip == '70' || $user_tip == '90' || $user_tip == '110' || $user_tip == '60')) {
    $offer = Offer::getById($_POST['id']);
    $offer->update(['admin_comments' => $_POST['text']]);
    exit;
}
if (isset($_GET['action'])) {

    if ($_GET['action'] == 'getTrands') {
        $type = 'publer';
        if (isset($_GET['type']))
            $type = $_GET['type'];
        if (!in_array($type, ['yandex', 'google', 'publer'])) {
            $type = 'publer';
        }
        $id = 0;
        if (!isset($_GET['offer_id']))
            exit;
        $id = (int) $_GET['offer_id'];
        $offer = Offer::getById($id);
        if (!$offer)
            exit;
        $trands = $offer->getTrands($type);
        $list = [];
        $trands = array_reverse($trands);
        foreach ($trands as $date => $stat) {
            $list[] = array_pop($stat);
        }
        echo json_encode(['type' => $type, 'stat' => $list]);
        exit;
    }
}
// Инициирование редактирования оффера рекламодателем (изменение Дедлайна)
if (isset($_POST['changeDateR']) && isset($_POST['offer_id']) && $user_tip == '40') {

    if (isset($_POST['offers_end_date']) && $_POST['offers_end_date'] != '' && $_POST['offers_end_date'] != 'дд.мм.гггг') {

        if (isset($_POST['offers_end_time']) && htmlentities($_POST['offers_end_time']) != '' && htmlentities($_POST['offers_end_time']) != 'чч:мм') {
            $offers_end_time = htmlentities($_POST['offers_end_time']);
        } else {
            $offers_end_time = '00:00';
        }

        $offers_end_date = htmlentities($_POST['offers_end_date']);

        $offerEndTime = explode(':', $offers_end_time);
        $offerEndDate = explode('.', $offers_end_date);

        $offerEx = mktime($offerEndTime[0], $offerEndTime[1], 0, $offerEndDate[1], $offerEndDate[0], $offerEndDate[2]);
    } else {
        $offerEx = 0;
    }

    $offer_id = htmlentities($_POST['offer_id']);

    $sql = "UPDATE offers SET `offer_end`='$offerEx' WHERE `id`='$offer_id' AND `owner_id`='$user_id'";
    $mysqli->query($sql);
    Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id);
    exit;
}
if (isset($_POST['action']) && $_POST['action'] == 'changeRealCr' && ($user_tip == '70' || $user_tip == '90' || $user_tip == '110' || $user_tip == '60')) {
    $offer = Offer::getById($_POST['id']);
    if (!$offer)
        exit;
    $offer->update(['real_cr' => intval($_POST['val'])]);
    Offer::updateCrAndEpcForAll();
    exit;
}
// Инициирование редактирования оффера рекламодателем (изменение кол-ва лидов)
if (isset($_POST['offers_kolvo_lids']) && isset($_POST['offer_id']) && $user_tip == '40') {

    $offers_kolvo_lids = intval($_POST['offers_kolvo_lids']);
    $offer_id = htmlentities($_POST['offer_id']);
    if ($offers_kolvo_lids != 0) {
        $off_lids = 1;
    } else {
        $kolvo_lids = 0;
    }
    $sql = "UPDATE offers SET `kolvo_lids`='$offers_kolvo_lids', `off_lids`='$off_lids' WHERE `id`='$offer_id' AND `owner_id`='$user_id'";
    $mysqli->query($sql);
    Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id);
    exit;
}

// Инициирование редактирования оффера рекламодателем (изменение СМС-уведомлений)
// Initiate editing offer advertiser (change SMS notifications)
if (isset($_POST['moderate_sms_submit']) && isset($_POST['offer_id']) && $user_tip == '40' && $settings_sms_ok == '1') {
    $offer_id = htmlentities($_POST['offer_id']);
    $offer_sms_ok = htmlentities($_POST['sms_ok']);
    $offer_sms_phone = htmlentities($_POST['sms_phone']);
    $offer_sms_text_zakaz = htmlentities($_POST['sms_text_zakaz']);
    $offer_sms_text_send = htmlentities($_POST['sms_text_send']);
    $offer_sms_text_way = htmlentities($_POST['sms_text_way']);
    $offer_sms_text_success = htmlentities($_POST['sms_text_success']);

    $sql_sms_moderation = "UPDATE offers SET `sms_ok`='$offer_sms_ok', `sms_phone`='$offer_sms_phone', `sms_text_zakaz`='$offer_sms_text_zakaz', `sms_text_send`='$offer_sms_text_send', `sms_text_way`='$offer_sms_text_way', `sms_text_success`='$offer_sms_text_success'  WHERE `id`='$offer_id' AND `owner_id`='$user_id'";
    $result_sms_moderation = $mysqli->query($sql_sms_moderation);
    Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id . '&xtext=7');
    exit;
}

// Инициирование редактирования оффера рекламодателем (изменение EMAIL-уведомлений)
// Initiate editing offer advertiser (change EMAIL-notifications)
if (isset($_POST['moderate_email_submit']) && isset($_POST['offer_id']) && $user_tip == '40') {
    $offer_id = htmlentities($_POST['offer_id']);
    $offer_email_ok = htmlentities($_POST['email_ok']);
    $offer_email_box = htmlentities($_POST['email_box']);
    $keyword = '';
    if (isset($_POST['keyword'])) {
        $keyword = htmlentities($_POST['keyword']);
    }
    $sql_sms_moderation = "UPDATE offers SET `keyword`='$keyword', `email_ok`='$offer_email_ok', `email_box`='$offer_email_box'  WHERE `id`='$offer_id' AND `owner_id`='$user_id'";
    $result_sms_moderation = $mysqli->query($sql_sms_moderation);
    Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id . '&xtext=8');
    exit;
}

// Инициирование редактирования оффера МЕНЕДЖЕРОМ
if (isset($_POST['moderate_submit_60']) && isset($_GET['offer']) && $user_tip == '60') {


    $offer = Offer::getById($_GET['offer']);
    $offer->update([
        'name' => $_POST['name'],
        'offer_descr' => $_POST['offer_descr'],
        'callcenter_info' => $_POST['callcenter_info'],
    ]);


    Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id);
    exit;
}

// Инициирование редактирования/модерации оффера администратором
// Initiate editing / moderation offer administrator
if (isset($_POST['moderate_submit']) && ( $user_tip == '70' || $user_tip == '20' || $user_tip == '90' || $user_tip == '110' || $user_tip == '60')) {

    $offer_id = htmlentities($_GET['offer']);
    if (isset($_POST['name']) && $_POST['name'] != '') {
        if(isset($_POST['telegram_new_offer_text'])){
            $txt = $_POST['telegram_new_offer_text'];
            $QQ = "UPDATE offers SET `telegram_new_offer_text`='$txt' WHERE `id`='$offer_id'";
            $mysqli->query($QQ);
        }

        // update resell
        // 

        if (count($_POST['resell']) >= 1) {
            $sql = "delete from offers_owner where offer_id=" . $offer_id;
            DB::getInstance()->query($sql);

            foreach ($_POST['resell'] as $data) {
                // $stmt = DB::getInstance()->prepare("insert into offers_owner set offer_id=?, country_iso=?, percent=?, owner_id=?, pinger_type=?, pinger_value=?, andOther=?");
                if ($data['country_iso'] == '') {
                    continue;
                }
                if (isset($_POST['delete_resell'][$data['id']])) {
                    continue;
                }

                $pinger_value = $data['id_l'];

                if($data['sub'] != '' || $data['token'] != '') {
                    $pinger_value .= ",".$data['sub'];
                    $pinger_value .= ",".$data['token'];
                }
                $another = isset($data['andOther']) ? 1 : 0;
                $QQ = "insert into offers_owner set offer_id='{$offer_id}', country_iso='{$data['country_iso']}', percent='{$data['percent']}', owner_id='{$data['owner_id']}', pinger_type='{$data['pinger_type']}', pinger_value='{$pinger_value}', andOther='{$another}'";
                DB::Query($QQ);
                // $stmt->execute([
                //     $offer_id,
                //     $data['country_iso'],
                //     $data['percent'],
                //     $data['owner_id'],
                //     $data['pinger_type'],
                //     $pinger_value,
                //     isset($data['andOther']) ? 1 : 0,
                // ]);

            }
        }
        // update stat
        if (isset($_POST['stat'], $_POST['traffic'])) {
            $sql = "insert into offers_stat set offer_id=?, ";
            foreach ($_POST['stat'] as $pre => $names) {
                foreach ($names as $name => $value) {
                    $key = $pre . '_' . $name;
                    $values[$key] = $value;
                }
            }

            $sql .= trim(implode('=?, ', array_keys($values)), ',') . '=?';
            $sql .= " on duplicate key update " . trim(implode('=?,', array_keys($values)), ',') . '=?';
            $values = array_merge([$offer_id], array_values($values), array_values($values));
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->Execute($values);

            foreach ($_POST['traffic'] as $id => $data) {
                $row = implode(',', [ $data['url'], $data['percent']]);
                $sql = "update offers_stat set traffic" . $id . "=?";
                $stmt = DB::getInstance()->prepare($sql);
                $stmt->execute([ $row]);
            }
        }
        //
        $offer_name = htmlentities($_POST['name']);
        $offer_descr = htmlentities($_POST['offer_descr']);

        $type_offer = htmlentities($_POST['type_offer']);
        
        if (isset($_POST['similar_offers']) && $_POST['similar_offers'] != '') {
            $of_sim = htmlentities($_POST['similar_offers']);
            $of_sim = explode(',', $of_sim);
            $of_sim = array_unique($of_sim);
            $of_sim = implode(',', $of_sim);
            $sql = "update offer_similar set similar='$of_sim' where offer_id=?";
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$offer_id]);
        } else {
            $sql = "update offer_similar set similar='' where offer_id=?";
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$offer_id]);
        }

        if (isset($_POST['url']) && $_POST['url'] != '') {
            $offer_url = htmlentities($_POST['url']);
            $offer_category = htmlentities($_POST['category']);

            $offer_cena = implode('|', $_POST['cena']);
            if (isset($_POST['tip_comission'])) {
                $offer_tip_comission = implode('|', $_POST['tip_comission']);
            } else {
                $offer_tip_comission = '1';
            }
            $offer_comission = implode('|', $_POST['comission']);
            //$offer_old_owner = htmlentities($_POST['id_owner']);
            $offer_new_owner = htmlentities($_POST['vladelec']);

            $offer_comission_cpa = implode('|', $_POST['comission_cpa']);

            $offer_uroven_dostupa = htmlentities($_POST['uroven_dostupa']);
            $offer_deystvie = htmlentities($_POST['deystvie']);

            if (isset($_POST['tip_comission_cpa'])) {
                $offer_tip_comission_cpa = implode('|', $_POST['tip_comission_cpa']);
            } else {
                $offer_tip_comission_cpa = '1';
            }

            $offer_hold = htmlentities($_POST['hold']);
            $offer_postclick = htmlentities($_POST['postclick']);
            //$offer_cr = htmlentities($_POST['cr']);
            //$offer_epc = htmlentities($_POST['epc']);

            $offer_email_ok = htmlentities($_POST['email_ok']);
            $offer_email_box = htmlentities($_POST['email_box']);
            $callcenter_info = htmlentities($_POST['callcenter_info']);

            // Если в настройках сети включены СМС-уведомления, то обрабатываем POST-переменные отвечающие за СМС-уведомления.
            // If the network settings are included SMS notifications, then we treat the POST-variables responsible for SMS notifications .
            if ($settings_sms_ok == 1) {
                $offer_sms_ok = htmlentities($_POST['sms_ok']);
                $offer_sms_phone = htmlentities($_POST['sms_phone']);
                $offer_sms_text_zakaz = htmlentities($_POST['sms_text_zakaz']);
                $offer_sms_text_send = htmlentities($_POST['sms_text_send']);
                $offer_sms_text_way = htmlentities($_POST['sms_text_way']);
                $offer_sms_text_success = htmlentities($_POST['sms_text_success']);
            }
            //

            if (isset($_POST['allow_success_status_zakaz'])) {
                $allow_success_status_zakaz = htmlentities($_POST['allow_success_status_zakaz']);
            }
            if (isset($_POST['off_balance'])) {
                $off_balance = htmlentities($_POST['off_balance']);
            }

            $offer_tip_traffic = '';
            $offer_tip_traffic_arr = [];
            
            for ($i = 1; $i <= 22; $i++) {
                if (isset($_POST['tip_traffic'.$i]) && $_POST['tip_traffic'.$i] == 'on') {
                    $offer_tip_traffic_arr[] = 1;
                } else {
                    $offer_tip_traffic_arr[] = 0;
                } 
            }

            $offer_tip_traffic = implode('|', $offer_tip_traffic_arr);
            //var_dump($offer_tip_traffic);

            /*if (isset($_POST['tip_traffic1']) && $_POST['tip_traffic1'] == 'on') {
                $offer_tip_traffic.='1';
            } else {
                $offer_tip_traffic.='0';
            }
            if (isset($_POST['tip_traffic2']) && $_POST['tip_traffic2'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic3']) && $_POST['tip_traffic3'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic4']) && $_POST['tip_traffic4'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic5']) && $_POST['tip_traffic5'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic6']) && $_POST['tip_traffic6'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic7']) && $_POST['tip_traffic7'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic8']) && $_POST['tip_traffic8'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic9']) && $_POST['tip_traffic9'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic10']) && $_POST['tip_traffic10'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic11']) && $_POST['tip_traffic11'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic12']) && $_POST['tip_traffic12'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic13']) && $_POST['tip_traffic13'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic14']) && $_POST['tip_traffic14'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic15']) && $_POST['tip_traffic15'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic16']) && $_POST['tip_traffic16'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic17']) && $_POST['tip_traffic17'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }
            if (isset($_POST['tip_traffic18']) && $_POST['tip_traffic18'] == 'on') {
                $offer_tip_traffic.='|1';
            } else {
                $offer_tip_traffic.='|0';
            }*/
                
            if (isset($_POST['hidehold']) && $_POST['hidehold'] == 'on') {
                $hidehold = 1;
            } else {
                $hidehold = 0;
            }
            if (isset($_POST['deeplink']) && $_POST['deeplink'] == 'on') {
                $deeplink = 1;
            } else {
                $deeplink = 0;
            }

            // Формирование переменной для поля ГЕО-локации клиента
            // Formation of variable fields сustomer GEO-location
            if (isset($_POST['country']) && $_POST['country'] != '') {
                $offer_country = array();
                $offer_iso = array();
                foreach ($_POST['country'] as $key => $val) {
                    if (empty($val)) {
                        $offer_iso = array('0');
                        $offer_country = array('0');
                        break;
                    }
                    $sql_country_name = "SELECT iso,name_ru FROM sxgeo_country WHERE `iso`='$val'";
                    $result_country_name = $mysqli->query($sql_country_name);
                    if (mysqli_num_rows($result_country_name) > 0) {
                        $res_country_name = mysqli_fetch_array($result_country_name);
                        $offer_country[] = htmlentities($res_country_name['name_ru']);
                        $offer_iso[] = htmlentities($res_country_name['iso']);
                    } else {
                        $offer_iso[] = '0';
                        $offer_country[] = '0';
                    }
                }
            } else {
                $offer_iso = '0';
                $offer_country = '0';
            }

            if (isset($_POST['region']) && $_POST['region'] != '') {

                $offer_region_id = array();
                $offer_region = array();
                foreach ($_POST['region'] as $key => $val) {
                    if (empty($val)) {
                        $offer_region_id[] = '0';
                        $offer_region[] = '0';
                        continue;
                    }
                    $sql_region_name = "SELECT id,name_ru FROM sxgeo_regions WHERE `id`='$val'";
                    $result_region_name = $mysqli->query($sql_region_name);
                    if (mysqli_num_rows($result_region_name) > 0) {
                        $res_region_name = mysqli_fetch_array($result_region_name);
                        $offer_region_id[] = htmlentities($res_region_name['id']);
                        $offer_region[] = htmlentities($res_region_name['name_ru']);
                    } else {
                        $offer_region[] = '0';
                        $offer_region_id[] = '0';
                    }
                }
            } else {
                $offer_region_id = '0';
                $offer_region = '0';
            }

            $offer_geo = implode(':', $offer_iso) . '|' . implode(':', $offer_region_id);

            if (isset($_POST['excluded_country']) && $_POST['excluded_country'] != '') {
                $offer_excluded_country = array();
                $offer_excluded_iso = array();
                foreach ($_POST['excluded_country'] as $key => $val) {
                    if (empty($val)) {
                        $offer_excluded_iso = array('0');
                        $offer_excluded_country = array('0');
                        break;
                    }
                    $sql_country_name = "SELECT iso,name_ru FROM sxgeo_country WHERE `iso`='$val'";
                    $result_country_name = $mysqli->query($sql_country_name);
                    if (mysqli_num_rows($result_country_name) > 0) {
                        $res_country_name = mysqli_fetch_array($result_country_name);
                        $offer_excluded_country[] = htmlentities($res_country_name['name_ru']);
                        $offer_excluded_iso[] = htmlentities($res_country_name['iso']);
                    } else {
                        $offer_excluded_iso[] = '0';
                        $offer_excluded_country[] = '0';
                    }
                }
            } else {
                $offer_excluded_iso = '0';
                $offer_excluded_country = '0';
            }

            if (isset($_POST['excluded_region']) && $_POST['excluded_region'] != '') {

                $offer_excluded_region_id = array();
                $offer_excluded_region = array();
                foreach ($_POST['excluded_region'] as $key => $val) {
                    if (empty($val)) {
                        $offer_excluded_region_id[] = '0';
                        $offer_excluded_region[] = '0';
                        continue;
                    }
                    $sql_region_name = "SELECT id,name_ru FROM sxgeo_regions WHERE `id`='$val'";
                    $result_region_name = $mysqli->query($sql_region_name);
                    if (mysqli_num_rows($result_region_name) > 0) {
                        $res_region_name = mysqli_fetch_array($result_region_name);
                        $offer_excluded_region_id[] = htmlentities($res_region_name['id']);
                        $offer_excluded_region[] = htmlentities($res_region_name['name_ru']);
                    } else {
                        $offer_excluded_region[] = '0';
                        $offer_excluded_region_id[] = '0';
                    }
                }
            } else {
                $offer_excluded_region_id = '0';
                $offer_excluded_region = '0';
            }

            $offer_excluded_geo = implode(':', $offer_excluded_iso) . '|' . implode(':', $offer_excluded_region_id);
            var_dump($offer_excluded_geo);

            $keyword = '';
            if (isset($_POST['keyword'])) {
                $keyword = htmlentities($_POST['keyword']);
            }
            if (isset($_POST['real_cr'])) {
                $real_cr = 1;
            } else
                $real_cr = 0;

            $o = Offer::getById($offer_id);


            if ($offer_geo != $o->geo || $o->cena != $offer_cena || $o->comission != $offer_comission) {

                $t = explode('|', $o->geo);
                $geo_was = explode(':', $t[0]);
                $t = explode('|', $offer_geo);
                $geo_new = explode(':', $t[0]);
                $geo_added = [];
                $geo_removed = [];
                foreach ($geo_new as $cnt) {
                    if (!in_array($cnt, $geo_was)) {
                        $geo_added[] = $cnt;
                    }
                }
                foreach ($geo_was as $cnt) {
                    if (!in_array($cnt, $geo_new)) {
                        $geo_removed[] = $cnt;
                    }
                }
                if ($o->comission != $offer_comission) {
                    Events::trigger(Events::EVENT_OFFER_CHANGE_COMISSION, $o->id);
                }
                if (!empty($geo_added) || !empty($geo_removed)) {
                    Events::trigger(Events::EVENT_OFFER_CHANGE_GEO, $o->id, [
                        'added' => $geo_added,
                        'removed' => $geo_removed,
                    ]);
                }


                //$_msg = urlencode(str_replace(' ', ' ', preg_replace("/[^a-zA-ZА-Яа-я0-9=>\r\n|: ,.]/u", "", $offer_id . ", " . $offer_name . ", \rGeo: " . $o->geo . " => " . $offer_geo . ", Price: " . $o->cena . " => " . $offer_cena . " Webmaster: " . $o->comission . " => " . $offer_comission . " . edited by: " . $user_id)));
                //$tbot = "https:///temptelegram.php?m=$_msg"; // ".str_replace(' ','%20', $offer_id.", $offer_name." Гео было: {$o->geo} Гео стало: ".$offer_geo."\nЦена была: ".$o->cena."\nЦена стала: ".$offer_cena."\nОтчисление было: ".$o->comission."\nОтчисление сталo: ".$offer_comission)."";
                //@file_get_contents($tbot . "&cid=81156414");
                //@file_get_contents($tbot . "&cid=205872025");
            }
            $sql_moderation = "UPDATE offers SET 
                            `type_offer` = '$type_offer',
                            `real_cr`=$real_cr,
                            `callcenter_info`='$callcenter_info',
                                `owner_id`='$offer_new_owner',
                `cena`='$offer_cena', 
                `name`='$offer_name',
                `descr`='$offer_descr',
                `url`='$offer_url',
                `category`='$offer_category',
                `comission_cpa`='$offer_comission_cpa', 
                `uroven_dostupa`='$offer_uroven_dostupa', 
                `deystvie`='$offer_deystvie', 
                `comission`='$offer_comission', 
                `tip_comission`='$offer_tip_comission', 
                `tip_comission_cpa`='$offer_tip_comission_cpa',
                `hold`='$offer_hold', 
                `tip_traffic`='$offer_tip_traffic',
                `excluded_geo`='$offer_excluded_geo',
                `geo`='$offer_geo', 
                `postclick`='$offer_postclick',
                `email_ok`='$offer_email_ok', 
                `email_box`='$offer_email_box',
                                `hidehold`='$hidehold',
                                `keyword`= '$keyword',
                                `deeplink`='$deeplink'
                ";

            // Если меняем ограничение на колво лидов
            if (isset($_POST['offers_kolvo_lids'])) {
                $off_lids = 0;
                $offers_kolvo_lids = intval($_POST['offers_kolvo_lids']);
                if ($offers_kolvo_lids != 0) {
                    $off_lids = 1;
                }

                $sql_moderation.="
                    , `kolvo_lids`='$offers_kolvo_lids', 
                    `off_lids`='$off_lids' ";
            }

            // Если меняем ограничение на колво лидов
            if (isset($_POST['offers_end_date']) && $_POST['offers_end_date'] != '' && $_POST['offers_end_date'] != 'дд.мм.гггг') {
                $offerEx = 0;
                if (isset($_POST['offers_end_time']) && htmlentities($_POST['offers_end_time']) != '' && htmlentities($_POST['offers_end_time']) != 'чч:мм') {
                    $offers_end_time = htmlentities($_POST['offers_end_time']);
                } else {
                    $offers_end_time = '00:00';
                }

                $offers_end_date = htmlentities($_POST['offers_end_date']);

                $offerEndTime = explode(':', $offers_end_time);
                $offerEndDate = explode('.', $offers_end_date);

                $offerEx = mktime($offerEndTime[0], $offerEndTime[1], 0, $offerEndDate[1], $offerEndDate[0], $offerEndDate[2]);

                $sql_moderation.="
                        , `offer_end`='$offerEx' ";
            }

            // Если в настройках сети включены СМС-уведомления, то включаем передачу соответствующих параметров
            // If the network settings are included SMS-notification, include the transfer of the relevant parameters
            if ($settings_sms_ok == 1) {
                $sql_moderation.="
                    , `sms_ok`='$offer_sms_ok', 
                    `sms_phone`='$offer_sms_phone', 
                    `sms_text_zakaz`='$offer_sms_text_zakaz', 
                    `sms_text_send`='$offer_sms_text_send', 
                    `sms_text_way`='$offer_sms_text_way', 
                    `sms_text_success`='$offer_sms_text_success' ";
            }
            //

            if (isset($allow_success_status_zakaz)) {
                $sql_moderation.=" , `allow_success_status_zakaz`='$allow_success_status_zakaz' ";
            }

            if (isset($off_balance)) {
                $sql_moderation.=" , `off_balance`='$off_balance' ";
            }

            $sql_moderation.="
                WHERE `id`='$offer_id'";

            $result_moderation = $mysqli->query($sql_moderation);

            ///
            if (isset($_POST['trands'])) {
                foreach ($_POST['trands'] as $date => $stat) {
                    $sql = "insert into offers_trands set offer_id=:i, `date`=:d, yandex=:y, google=:g, publer=:p on duplicate key update yandex=:y, publer=:p, google=:g";
                    $stmt = DB::getInstance()->prepare($sql);
                    $stmt->execute([
                        'i' => $offer_id,
                        'd' => $date,
                        'y' => $stat['yandex'],
                        'g' => $stat['google'],
                        'p' => $stat['publer'],
                    ]);
                }
            }


            //
            Offer::updateCrAndEpcForAll();
            Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id . '&xtext=5');
            exit;
        } else {
            Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id . '&xtext=1');
            exit;
        }
    } else {
        Header('Location:' . $_SERVER['PHP_SELF'] . '?offer=' . $offer_id . '&xtext=2');
        exit;
    }
}

// Инициация включения оффера администратором
// Initiate inclusion offer administrator
if (isset($_GET['on']) && $_GET['on'] != '' && ($user_tip == '70' or $user_tip == '60' or $user_tip == '20' || $user_tip == '90' || $user_tip == '110' || $user_tip == '60')) {
    $on = htmlentities($_GET['on']);
    // Проверяем, подключены ли к офферу лендинги. Если нет - то не активируем оффер
    // Check whether to offer Landing connected. If not - do not activate the offer
    $sql_landings = "SELECT id FROM landings WHERE `offer_id`='$on'";
    $result_landings = $mysqli->query($sql_landings);
    $cvet = 0;
    if (mysqli_num_rows($result_landings) > 0) {
        Events::trigger(Events::EVENT_OFFER_START, $on);

        $sql10 = "UPDATE offers SET `active`='1' WHERE `id`='$on'";
        $result10 = $mysqli->query($sql10);
        header('location:' . $_SERVER['PHP_SELF'] . '?offer=' . $on . '&xtext=7');
        exit;
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?offer=' . $on . '&xtext=8');
        exit;
    }
}

// Инициация выключения оффера администратором
// Initiate off offer administrator
if (isset($_GET['off']) && $_GET['off'] != '' && ($user_tip == '70' or $user_tip == '60'  or $user_tip == '20' || $user_tip == '90' || $user_tip == '110' || $user_tip == '60')) {
    $off = htmlentities($_GET['off']);
    $sql10 = "UPDATE offers SET `active`='0' WHERE `id`='$off'";
    Events::trigger(Events::EVENT_OFFER_STOP, $off);




    $result10 = $mysqli->query($sql10);
    header('location:' . $_SERVER['PHP_SELF']);
    exit;
}

// Инициация удаления оффера администратором
// Initiate removal offer administrator
if (isset($_GET['delete']) && $_GET['delete'] != '' && ($user_tip == '70' || $user_tip == '90' || $user_tip == '110' || $user_tip == '60')) {
    $id_offer = htmlentities($_GET['delete']);
    $sql = "SELECT * FROM offers WHERE `id`='$id_offer'";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $request = "DELETE from offers WHERE `id`='$id_offer'";
        $result = $mysqli->query($request);

        // Если находим промо-картинку от оффера то удаляем ее.
        // If we find a promo picture from offer then remove it.
        $promo_img = './tmp/offer' . $id_offer . '.jpg';
        $promo_img_temp = './tmp/temp_offer' . $id_offer . '.jpg';
        if (file_exists($promo_img)) {
            unlink($promo_img);
        }
        if (file_exists($promo_img_temp)) {
            unlink($promo_img_temp);
        }

        header('location:' . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>