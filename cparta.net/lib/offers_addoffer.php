<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

// Что будет при добавлении оффера
// What happens when you add offer
if (isset($_POST['addoffer_submit']) && ($user_tip == '40' || $user_tip == '70' || $user_tip == '20' || $user_tip == '90' || $user_tip == '110')) {
    // Если текущая роль - рекламодатель, то действует ограничение на количество офферов на аккаунте
    // If the current role - the advertiser, the effect on the number of offerov on account limit
    if ($user_tip == '40') {
        $sql_account_count_offers = "SELECT id FROM offers WHERE `owner_id`='$user_id'";
        $result_account_count_offers = $mysqli->query($sql_account_count_offers);
        if (mysqli_num_rows($result_account_count_offers) >= $settings_account_max_offers) {
            Header('Location: ./offers.php?xtext=6');
            exit;
        }
    }

    if (isset($_POST['vladelec']) && $_POST['vladelec'] != '') {
        if (isset($_POST['name']) && $_POST['name'] != '') {
            $offer_name = htmlentities($_POST['name']);
            if (isset($_POST['url']) && $_POST['url'] != '') {
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
                
                
                $off_lids = 0;
                $kolvo_lids = 0;
/*
                $kolvo_lids = (htmlentities($_POST['offers_kolvo_lids']) == '') ? 0 : htmlentities($_POST['offers_kolvo_lids']);
                $off_lids = 0;
                if ($kolvo_lids != 0) {
                    $off_lids = 1;
                } else {
                    $kolvo_lids = 0;
                }
*/
                $offer_url = htmlentities($_POST['url']);
                $offer_owner = htmlentities($_POST['vladelec']);





                $offer_cena = implode('|', $_POST['cena']);
                if (isset($_POST['tip_comission'])) {
                    $offer_tip_comission = implode('|', $_POST['tip_comission']);
                } else {
                    $offer_tip_comission = '1';
                }
                $offer_comission = implode('|', $_POST['comission']);

                if (isset($_POST['comission_cpa'])) {
                    $offer_comission_cpa = implode('|', $_POST['comission_cpa']);
                } else {
                    $offer_comission_cpa = '0';
                }
                if (isset($_POST['uroven_dostupa'])) {
                    $offer_uroven_dostupa = htmlentities($_POST['uroven_dostupa']);
                } else {
                    $offer_uroven_dostupa = '2';
                }
                if (isset($_POST['tip_comission_cpa'])) {
                    $offer_tip_comission_cpa = implode('|', $_POST['tip_comission_cpa']);
                } else {
                    $offer_tip_comission_cpa = $offer_tip_comission;
                }
                $offer_deystvie = htmlentities($_POST['deystvie']);
                $type_offer = htmlentities($_POST['type_offer']);
                //$offer_hold = htmlentities($_POST['hold']);
                $offer_hold = 0;
                $offer_postclick = htmlentities($_POST['postclick']);
                
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

                /* 	
                  if (isset($_POST['city1']) && $_POST['city1']!='')
                  {
                  $offer_city1=htmlentities($_POST['city1']);
                  $sql_cities_name = "SELECT id,name_ru FROM sxgeo_cities WHERE `id`='$offer_city1'";
                  $result_cities_name=$mysqli->query($sql_cities_name);
                  if (mysqli_num_rows($result_cities_name) > 0)
                  {
                  $res_cities_name=mysqli_fetch_array($result_cities_name);
                  $offer_city_id1=htmlentities($res_cities_name['id']);
                  $offer_city1=htmlentities($res_cities_name['name_ru']);
                  } else {$offer_city_id1='0'; $offer_city1='0';}
                  } else {$offer_city_id1='0'; $offer_city1='0';}
                 */

                $offer_geo = implode(':', $offer_iso) . '|' . implode(':', $offer_region_id);

                $keyword = '';
                if (isset($_POST['keyword']))
                    $keyword = htmlentities($_POST['keyword']);
                $sql_moderation = "INSERT INTO offers (`type_offer`, `avg_approve`, `keyword`, `offer_end`,`kolvo_lids`, `name`,`url`,`owner_id`,`cena`,`comission_cpa`,`uroven_dostupa`,`deystvie`,`comission`,`tip_comission`,`tip_comission_cpa`,`hold`,`postclick`,`tip_traffic`,`geo`, `off_lids`, `hidehold`) VALUES ('$type_offer', (crc32(rand()*9999)%55+25), '$keyword', '$offerEx','$kolvo_lids','$offer_name','$offer_url','$offer_owner','$offer_cena','','$offer_uroven_dostupa','$offer_deystvie','$offer_comission','$offer_tip_comission','$offer_tip_comission_cpa','$offer_hold','$offer_postclick','$offer_tip_traffic','$offer_geo','$off_lids','$hidehold')";
                $result_moderation = $mysqli->query($sql_moderation);
                $offer_id = $mysqli->insert_id;

                $sql = "insert into offer_similar (`offer_id`) values ('$offer_id')";
                $stmt = DB::getInstance()->prepare($sql);
                $stmt->execute();

                
                //var_dump($sql_moderation);
                if ($settings_notice_addoffer == '1' && $user_tip == '40') {
                    $mail_subj = domain() . ': ' . $loc['offers.php']['t217'];
                    $mail_body = $loc['offers.php']['t218'] . '<br /><br />' . $loc['offers.php']['t219'] . '&nbsp;<b>' . $offer_name . '</b><br /><br />' . $loc['offers.php']['t220'] . '&nbsp;<b>' . $user_email . '</b><br /><br />' . $loc['offers.php']['t221'] . '&nbsp;' . domain() . '<br /><a href="' . site_url() . '">' . site_url() . '</a>';

                    if ($settings_notice_email != '') {
                        $to_email = $settings_notice_email;
                        SendEMail($to_email, $mail_subj, $mail_body);
                        $mail_sended = true;
                    } else {
                        $sql_userdata = "SELECT email FROM users WHERE `tip`='70' AND `active`='1'";
                        $result_userdata = $mysqli->query($sql_userdata);
                        if (mysqli_num_rows($result_userdata) > 0) {
                            while ($res_userdata = mysqli_fetch_array($result_userdata)) {
                                $to_email = htmlentities($res_userdata['email']);
                                SendEMail($to_email, $mail_subj, $mail_body);
                                $mail_sended = true;
                            }
                        }
                    }
                }

                Header('Location: ./offers.php?xtext=4');
                exit;
            } else {
                Header('Location: ./offers.php?xtext=1');
                exit;
            }
        } else {
            Header('Location: ./offers.php?xtext=2');
            exit;
        }
    } else {
        Header('Location: ./offers.php?xtext=3');
    }
}
?>