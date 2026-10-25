<?php

$str = json_decode(file_get_contents('php://input'));

$types = htmlentities($str->types);
$typeSort = htmlentities($str->typeSort);
$dates = htmlentities($str->dates);
$idoffer = (isset($str->idoffer)) ? htmlentities($str->idoffer) : 0;
$namesubid1 = (isset($str->namesubid1)) ? htmlentities($str->namesubid1) : 0;
$namesubid2 = (isset($str->namesubid2)) ? htmlentities($str->namesubid2) : 0;
$namesubid3 = (isset($str->namesubid3)) ? htmlentities($str->namesubid3) : 0;
$offset = htmlentities($str->offset);
@session_start();
$user_id = $_SESSION['id'];

if (!empty($types)) {

    include '../includes/config.php';
    include '../includes/antiinject/index.php';

    $dd = explode(' - ', $dates);

    $dat1 = $dd[0];
    $dat2 = $dd[1];
    $dat1 = date('Y-m-d', strtotime($dat1));
    $dat2 = date('Y-m-d', strtotime($dat2));
    $tdat1 = date('Ymd', strtotime($dat1));
    $tdat2 = date('Ymd', strtotime($dat2));

    global $recs;
    // Массив аргументов для функции
    // An array of arguments for the function
    $args = array();
    $recs = array();

    if ($types == 1) {

            // Дата
            // Date
            $args['where'] = array(
                '`date` BETWEEN ' => '"'.htmlentities($dat1).' '.$DT.'" AND ',
                '"'.htmlentities($dat2) => ' '.$NT.'" AND ',
                '`user_id`' => ' = "'.$user_id.'" AND '	
            ); 

            $args['group_by'] = $r;   
            
            $outputfile = 'stats_output_1.php';        
        
    }elseif($types == 2){       
        if(!isset($idoffer) or $idoffer == 0){
            $offers_ids = array();
            $sql = "SELECT `offer_id` FROM clients_log WHERE `offer_id` != '0' AND `user_id` = '$user_id' and `date` BETWEEN '".htmlentities($dat1)." ".$DT."' AND '".htmlentities($dat2)." ".$NT."' GROUP BY `offer_id` ";
            $result=$mysqli->query($sql);            
            if(mysqli_num_rows($result) > 0){
                while($res=mysqli_fetch_array($result)){
                    $offers_ids[] = $res['offer_id'];
                    $recs[$res['offer_id']] = array('hosts'=>0, 'visits' => 0, 'zakaz_ok' => 0, 'zakaz_hold' => 0, 'zakaz_wait' => 0, 'zakaz_cancel' => 0, 'zakaz_trash' => 0, 'comission_ok' => 0, 'comission_hold' => 0, 'comission_wait' => 0, 'comission_cancel' => 0, 'comission_trash' => 0);                
                }

                $offers = implode(',',$offers_ids);  
            }else{
                $offers = 0;
            }
        }else{
            $recs[$idoffer] = array('hosts'=>0, 'visits' => 0, 'zakaz_ok' => 0, 'zakaz_hold' => 0, 'zakaz_wait' => 0, 'zakaz_cancel' => 0, 'zakaz_trash' => 0, 'comission_ok' => 0, 'comission_hold' => 0, 'comission_wait' => 0, 'comission_cancel' => 0, 'comission_trash' => 0);
            $offers = $idoffer;   
        }

        $r = 'd';
        $r1 = 'DATE_FORMAT(date, "%Y-%m-%d") as ' . $r . ', ';

        // Селекторы для хостов
        // Selectors for hosts
        $args['select'][] = $r1;
        $args['select'][] = 'COUNT(DISTINCT(ip)) as hosts,AVG(track_online) as track_online';

        $args['from'] = 'clients_log';

        // Дата
        // Date
        $args['where'] = array(
            '`date` BETWEEN ' => '"' . htmlentities($dat1) . ' ' . $DT . '" AND ',
            '"' . htmlentities($dat2) => ' ' . $NT . '" AND ',
            '`user_id`' => ' = "' . $user_id . '" AND '
        );

        $args['group_by'] = $r;

        $outputfile = 'stats_output_1.php';
    }elseif ($types == 2) {
        if (!isset($idoffer) or $idoffer == 0) {
            $offers_ids = array();
            $sql = "SELECT `offer_id` FROM clients_log WHERE `offer_id` != '0' AND `user_id` = '$user_id' GROUP BY `offer_id`";
            $result = $mysqli->query($sql);
            while ($res = mysqli_fetch_array($result)) {
                $offers_ids[] = $res['offer_id'];
                $recs[$res['offer_id']] = array('hosts' => 0, 'visits' => 0, 'zakaz_ok' => 0, 'zakaz_hold' => 0, 'zakaz_wait' => 0, 'zakaz_cancel' => 0, 'zakaz_trash' => 0, 'comission_ok' => 0, 'comission_hold' => 0, 'comission_wait' => 0, 'comission_cancel' => 0, 'comission_trash' => 0);
            }

            $offers = implode(',', $offers_ids);
        } else {
            $recs[$idoffer] = array('hosts' => 0, 'visits' => 0, 'zakaz_ok' => 0, 'zakaz_hold' => 0, 'zakaz_wait' => 0, 'zakaz_cancel' => 0, 'zakaz_trash' => 0, 'comission_ok' => 0, 'comission_hold' => 0, 'comission_wait' => 0, 'comission_cancel' => 0, 'comission_trash' => 0);
            $offers = $idoffer;
        }


        $r = 'd';
        $r1 = 'offer_id as ' . $r . ', ';

        // Селекторы для хостов
        // Selectors for hosts
        $args['select'][] = $r1;
        $args['select'][] = 'COUNT(DISTINCT(ip)) as hosts';
        $args['from'] = 'clients_log';

        // Дата
        // Date
        $args['where'] = array(
            '`date` BETWEEN ' => '"' . htmlentities($dat1) . ' ' . $DT . '" AND ',
            '"' . htmlentities($dat2) => ' ' . $NT . '" AND ',
            '`offer_id` IN ' => '(' . htmlentities($offers) . ') AND ',
            '`user_id`' => ' = "' . $user_id . '" AND '
        );

        $args['group_by'] = $r;

        $outputfile = 'stats_output_2.php';
    } elseif ($types >= 3) {

        $outputfile = 'stats_output_3.php';
    }
    $args_offer = '';
    $args_subid1 = '';
    $args_subid2 = '';
    $args_subid3 = '';

    // Если указан оффер
    // If you specify offer
    if (isset($idoffer) && $idoffer != 0) {
        $args['where']['`offer_id`'] = ' = ' . htmlentities($idoffer) . ' AND ';
        $args_offer = " AND `offer_id` = '" . htmlentities($idoffer) . "'";
    }

    // Если указан subid2
    // If you specify subid2
    if (isset($namesubid1) && !empty($namesubid1)) {
        $args['where']['`subid1`'] = ' = "' . htmlentities($namesubid1) . '" AND ';
        $args_subid1 = " AND `subid1` = '" . htmlentities($namesubid1) . "'";
    }

    // Если указан subid1
    // If you specify subid1
    if (isset($namesubid2) && !empty($namesubid2)) {
        $args['where']['`subid2`'] = ' = "' . htmlentities($namesubid2) . '" AND ';
        $args_subid2 = " AND `subid2` = '" . htmlentities($namesubid2) . "'";
    }

    // Если указан subid3
    // If you specify subid3
    if (isset($namesubid3) && !empty($namesubid3)) {
        $args['where']['`subid3`'] = ' = "' . htmlentities($namesubid3) . '" AND ';
        $args_subid3 = " AND `subid3` = '" . htmlentities($namesubid3) . "'";
    }

    if ($types >= 3) {
        selectDateFormatAndCount2();
    }

    // Хосты
    // Hosts
    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Комиссия отклонена
    // The Commission rejected
    $args['select'][1] = 'avg(track_online) as track_online';
    $args['from'] = 'clients_log';
    $args['field'] = 'track_online';
    if ($types < 3) {
        selectDateFormatAndCount($args);
    }



    // Визиты
    // Visits
    $args['select'][1] = 'COUNT(id) as visits';
    $args['from'] = 'clients_log';
    $args['field'] = 'visits';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }
    // Заказ принят
    // Order is accepted
    $args['select'][1] = 'COUNT(id) as zakaz_ok';
    $args['from'] = 'zakaz';
    $args['field'] = 'zakaz_ok';
    $args['where']['`status`'] = ' = 3 AND';

    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Заказ холд
    // Order Hold
    $args['select'][1] = 'COUNT(id) as zakaz_hold';
    $args['from'] = 'zakaz';
    $args['field'] = 'zakaz_hold';
    $args['where']['`status`'] = ' = 2 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Заказ ожидает
    // Check to expect
    $args['select'][1] = 'COUNT(id) as zakaz_wait';
    $args['from'] = 'zakaz';
    $args['field'] = 'zakaz_wait';
    $args['where']['`status`'] = ' = 1 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Заказ отклонен
    // Order rejected
    $args['select'][1] = 'COUNT(id) as zakaz_cancel';
    $args['from'] = 'zakaz';
    $args['field'] = 'zakaz_cancel';
    $args['where']['`status`'] = ' = 0 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Заказ отклонен
    // Order rejected
    $args['select'][1] = 'COUNT(id) as zakaz_trash';
    $args['from'] = 'zakaz';
    $args['field'] = 'zakaz_trash';
    $args['where']['`status`'] = ' = 5 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Комиссия принято
    // The Commission accepted
    $args['select'][1] = 'SUM(comission)*kolvo as comission_ok';
    $args['from'] = 'zakaz';
    $args['field'] = 'comission_ok';
    $args['where']['`status`'] = ' = 3 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Комиссия холд
    // Hold the Commission
    $args['select'][1] = 'SUM(comission)*kolvo as comission_hold';
    $args['from'] = 'zakaz';
    $args['field'] = 'comission_hold';
    $args['where']['`status`'] = ' = 2 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Комиссия ожидает
    // The Commission expects
    $args['select'][1] = 'SUM(comission)*kolvo as comission_wait';
    $args['from'] = 'zakaz';
    $args['field'] = 'comission_wait';
    $args['where']['`status`'] = ' = 1 AND';

    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Комиссия отклонена
    // The Commission rejected
    $args['select'][1] = 'SUM(comission)*kolvo as comission_cancel';
    $args['from'] = 'zakaz';
    $args['field'] = 'comission_cancel';
    $args['where']['`status`'] = ' = 0 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    // Комиссия отклонена
    // The Commission rejected
    $args['select'][1] = 'SUM(comission)*kolvo as comission_trash';
    $args['from'] = 'zakaz';
    $args['field'] = 'comission_trash';
    $args['where']['`status`'] = ' = 5 AND';


    if ($types < 3) {
        selectDateFormatAndCount($args);
    }

    /*
      if($offset == 'ASC'){
      ksort($recs);
      }elseif($offset == 'DESC'){
      krsort($recs);
      }
     */
    $mysqli->query("DELETE FROM statistics WHERE userid = '$user_id'");
    foreach ($recs as $date => $rec) {
        // Назначаем переменные для вывода в ежедневных данных	
        // Assign variables to display in daily data
        //$offers=htmlentities($rec['offers']);
        $visits = htmlentities($rec['visits']);
        $hosts = htmlentities($rec['hosts']);
        $zakaz_ok = htmlentities($rec['zakaz_ok']);
        $zakaz_hold = htmlentities($rec['zakaz_hold']);
        $zakaz_wait = htmlentities($rec['zakaz_wait']);
        $zakaz_cancel = htmlentities($rec['zakaz_cancel']);
        $zakaz_trash = htmlentities($rec['zakaz_trash']);
        $comission_ok = htmlentities($rec['comission_ok']);
        $comission_hold = htmlentities($rec['comission_hold']);
        $comission_wait = htmlentities($rec['comission_wait']);
        $comission_cancel = htmlentities($rec['comission_cancel']);
        $comission_trash = htmlentities($rec['comission_trash']);
        $track_online = $rec['track_online'];


        // Если указан оффер
        // If you specify offer
        if (isset($rec['offer_id']) && $rec['offer_id'] != 0) {
            $offer_id = htmlentities($rec['offer_id']);
        } else {
            $offer_id = 0;
        }

        // Если указан subid2
        // If you specify subid2
        if (isset($rec['offer_name']) && !empty($rec['offer_name'])) {
            $offer_name = htmlentities($rec['offer_name']);
        } else {
            $offer_name = 0;
        }

        // Если указан subid1
        // If you specify subid1
        if (isset($rec['subid1']) && !empty($rec['subid1'])) {
            $subid1 = htmlentities($rec['subid1']);
        } else {
            $subid1 = 0;
        }

        // Если указан subid2
        // If you specify subid2
        if (isset($rec['subid2']) && !empty($rec['subid2'])) {
            $subid2 = htmlentities($rec['subid2']);
        } else {
            $subid2 = 0;
        }

        // Если указан subid3
        // If you specify subid3
        if (isset($rec['subid3']) && !empty($rec['subid3'])) {
            $subid3 = htmlentities($rec['subid3']);
        } else {
            $subid3 = 0;
        }

        if ($types == 2) {
            $qdata = $date;
            $ins1 = 'offer_name';
        } elseif ($types == 1) {
            $qdata = strtotime($date);
            $ins1 = 'dates';
        } else {
            $qdata = 0;
            $ins1 = 'dates';
        }

        $cr = ($hosts != '0') ? round((($zakaz_ok + $zakaz_hold + $zakaz_wait + $zakaz_cancel + $zakaz_trash) / $hosts) * 100, 2) : 0;
        $epc = ($hosts != '0') ? round(($comission_ok + $comission_hold) / $hosts, 2) : 0;

        if ($hosts != '0') {
            $kolvo_zakaz = $zakaz_wait + $zakaz_hold + $zakaz_cancel + $zakaz_ok;
            if ($kolvo_zakaz != '0') {
                $approove = sprintf("%.2f", 100 / $kolvo_zakaz * ($zakaz_ok + $zakaz_hold));
            } else {
                $approove = '0';
            }
        } else {
            $approove = '0';
        }
        $zakaz_all_in_day = $zakaz_ok + $zakaz_hold;
        $comission_all_in_day = $comission_ok + $comission_hold;

        $sql = "INSERT INTO statistics (`track_online`, `userid`,`" . $ins1 . "`,`offer_id`,`subid1`,`subid2`,`subid3`,`visits`,`hosts`,`zakaz_ok`,`zakaz_all_in_day`,`zakaz_hold`,`zakaz_wait`,`zakaz_cancel`,`zakaz_trash`,`comission_ok`,`comission_all_in_day`,`comission_hold`,`comission_wait`,`comission_cancel`,`comission_trash`,`cr`,`epc`,`approove`) "
                . "VALUES ('$track_online','$user_id','$qdata','$offer_id','$subid1','$subid2','$subid3','$visits','$hosts','$zakaz_ok','$zakaz_all_in_day','$zakaz_hold','$zakaz_wait','$zakaz_cancel','$zakaz_trash','$comission_ok','$comission_all_in_day','$comission_hold','$comission_wait','$comission_cancel','$comission_trash','$cr','$epc','$approove');";
        $mysqli->query($sql);
    }



    include $outputfile;

    //echo '<pre>';
    //print_r($recs);
    //echo '</pre>';
}

function selectDateFormatAndCount($args = array()) {
    global $mysqli, $recs, $user_id;
    $args_st = array(
        'select' => array(
            'DATE_FORMAT(date, "%Y-%m-%d") as d,',
            'COUNT(DISTINCT(ip)) as hosts'
        ),
        'from' => '',
        'where' => '',
        'group_by' => '',
        'field' => 'hosts'
    );
    $args = array_merge($args_st, $args);
    $args = (object) $args;

    $count = count($args->where);

    $n = 1;

    foreach ($args->where as $key => $value) {
        if ($n == $count) {
            $args->where[$key] = substr(end($args->where), 0, -4);
        }
        $n++;
    }

    $sql = 'SELECT ';

    if (count($args->select) != 0) {
        foreach ($args->select as $select) {
            $sql .= $select . ' ';
        }
    } else
        die($loc['stats.php']['t28']);

    if ($args->from != '') {
        $sql .= 'FROM `' . $args->from . '` ';
    } else
        die($loc['stats.php']['t29']);

    if (count($args->where) != 0) {
        $sql .= 'WHERE ';
        foreach ($args->where as $key => $value) {
            $sql .= $key . ' ' . $value;
        }
    } else
        die($loc['stats.php']['t30']);

    if ($args->group_by != '') {
        $sql .= ' GROUP BY ' . $args->group_by;
    }
    $q = $mysqli->query($sql) or print($mysqli->error);
    while ($r = mysqli_fetch_assoc($q)) {
        $recs[$r['d']][$args->field] = $r[$args->field];
    }
}

function selectDateFormatAndCount2() {
    global $mysqli, $recs, $user_id, $types, $dat2, $dat1, $DT, $NT, $args_offer, $args_subid1, $args_subid2, $args_subid3;

    if ($types == 3) {
        $groupsBy = '`subid1`,`subid2`,`subid3`';
    } elseif ($types > 3) {

        if ($types == 4) {
            $groupsBy = '`subid1`';
            $groupsByArr = 'subid1';
        }
        if ($types == 5) {
            $groupsBy = '`subid2`';
            $groupsByArr = 'subid2';
        }
        if ($types == 6) {
            $groupsBy = '`subid3`';
            $groupsByArr = 'subid3';
        }
    }


    $sql = 'SELECT ' . $groupsBy . ', COUNT(DISTINCT(ip)) as hosts, COUNT(id) as visits FROM clients_log WHERE `user_id` = "' . $user_id . '" AND `date` BETWEEN "' . htmlentities($dat1) . ' ' . $DT . '" AND "' . htmlentities($dat2) . ' ' . $NT . '" ' . $args_offer . '' . $args_subid1 . '' . $args_subid2 . '' . $args_subid3 . ' GROUP BY ' . $groupsBy;
    $result = $mysqli->query($sql);
    while ($res = mysqli_fetch_assoc($result)) {
        if ($types == 3) {
            $recs[] = array('subid1' => $res['subid1'], 'subid2' => $res['subid2'], 'subid3' => $res['subid3'], 'hosts' => $res['hosts'], 'visits' => $res['visits'], 'zakaz_ok' => 0, 'zakaz_hold' => 0, 'zakaz_wait' => 0, 'zakaz_cancel' => 0, 'zakaz_trash' => 0, 'comission_ok' => 0, 'comission_hold' => 0, 'comission_wait' => 0, 'comission_cancel' => 0, 'comission_trash' => 0);
        } elseif ($types > 3) {
            $recs[] = array($groupsByArr => $res[$groupsByArr], 'hosts' => $res['hosts'], 'visits' => $res['visits'], 'zakaz_ok' => 0, 'zakaz_hold' => 0, 'zakaz_wait' => 0, 'zakaz_cancel' => 0, 'zakaz_trash' => 0, 'comission_ok' => 0, 'comission_hold' => 0, 'comission_wait' => 0, 'comission_cancel' => 0, 'comission_trash' => 0);
        }
    }
//var_dump($sql);
    $sql = 'SELECT ' . $groupsBy . ', COUNT(id) as zakaz_ok, SUM(comission)*kolvo as comission_ok FROM zakaz WHERE `status` = "3" AND `user_id`  = "' . $user_id . '" AND `date` BETWEEN "' . htmlentities($dat1) . ' ' . $DT . '" AND "' . htmlentities($dat2) . ' ' . $NT . '" ' . $args_offer . '' . $args_subid1 . '' . $args_subid2 . '' . $args_subid3 . '  GROUP BY ' . $groupsBy;
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) != 0) {
        while ($res = mysqli_fetch_assoc($result)) {
            if ($types == 3) {
                $recs2[] = array('subid1' => $res['subid1'], 'subid2' => $res['subid2'], 'subid3' => $res['subid3'], 'zakaz_ok' => $res['zakaz_ok'], 'comission_ok' => $res['comission_ok']);
            } elseif ($types == 4) {
                $recs2[] = array("'" . $groupsByArr . "'" => $res[$groupsByArr], 'zakaz_ok' => $res['zakaz_ok'], 'comission_ok' => $res['comission_ok']);
            }
        }
        foreach ($recs as $key1 => &$val1) {
            foreach ($recs2 as $key2 => $val2) {
                if ($types == 3) {
                    if ($val2['subid1'] == $val1['subid1'] && $val2['subid2'] == $val1['subid2'] && $val2['subid3'] == $val1['subid3']) {
                        $val1['zakaz_ok'] = $val2['zakaz_ok'];
                        $val1['comission_ok'] = $val2['comission_ok'];
                    }
                } elseif ($types > 3) {
                    if ($val2["'" . $groupsByArr . "'"] == $val1[$groupsByArr]) {
                        $val1['zakaz_ok'] = $val2['zakaz_ok'];
                        $val1['comission_ok'] = $val2['comission_ok'];
                    }
                }
            }
        }
    }


    $sql = 'SELECT ' . $groupsBy . ', COUNT(id) as zakaz_hold, SUM(comission)*kolvo as comission_hold FROM zakaz WHERE `status` = "2" AND `user_id`  = "' . $user_id . '" AND `date` BETWEEN "' . htmlentities($dat1) . ' ' . $DT . '" AND "' . htmlentities($dat2) . ' ' . $NT . '" ' . $args_offer . '' . $args_subid1 . '' . $args_subid2 . '' . $args_subid3 . '  GROUP BY ' . $groupsBy;
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) != 0) {
        while ($res = mysqli_fetch_assoc($result)) {
            if ($types == 3) {
                $recs3[] = array('subid1' => $res['subid1'], 'subid2' => $res['subid2'], 'subid3' => $res['subid3'], 'zakaz_hold' => $res['zakaz_hold'], 'comission_hold' => $res['comission_hold']);
            } elseif ($types > 3) {
                $recs3[] = array("'" . $groupsByArr . "'" => $res[$groupsByArr], 'zakaz_hold' => $res['zakaz_hold'], 'comission_hold' => $res['comission_hold']);
            }
        }
        foreach ($recs as $key1 => &$val1) {
            foreach ($recs3 as $key2 => $val2) {
                if ($types == 3) {
                    if ($val2['subid1'] == $val1['subid1'] && $val2['subid2'] == $val1['subid2'] && $val2['subid3'] == $val1['subid3']) {
                        $val1['zakaz_hold'] = $val2['zakaz_hold'];
                        $val1['comission_hold'] = $val2['comission_hold'];
                    }
                } elseif ($types > 3) {
                    if ($val2["'" . $groupsByArr . "'"] == $val1[$groupsByArr]) {
                        $val1['zakaz_hold'] = $val2['zakaz_hold'];
                        $val1['comission_hold'] = $val2['comission_hold'];
                    }
                }
            }
        }
    }


    $sql = 'SELECT ' . $groupsBy . ', COUNT(id) as zakaz_wait, SUM(comission)*kolvo as comission_wait FROM zakaz WHERE `status` = "1" AND `user_id`  = "' . $user_id . '" AND `date` BETWEEN "' . htmlentities($dat1) . ' ' . $DT . '" AND "' . htmlentities($dat2) . ' ' . $NT . '" ' . $args_offer . '' . $args_subid1 . '' . $args_subid2 . '' . $args_subid3 . '  GROUP BY ' . $groupsBy;
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) != 0) {
        while ($res = mysqli_fetch_assoc($result)) {
            if ($types == 3) {
                $recs4[] = array('subid1' => $res['subid1'], 'subid2' => $res['subid2'], 'subid3' => $res['subid3'], 'zakaz_wait' => $res['zakaz_wait'], 'comission_wait' => $res['comission_wait']);
            } elseif ($types > 3) {
                $recs4[] = array("'" . $groupsByArr . "'" => $res[$groupsByArr], 'zakaz_wait' => $res['zakaz_wait'], 'comission_wait' => $res['comission_wait']);
            }
        }
        foreach ($recs as $key1 => &$val1) {
            foreach ($recs4 as $key2 => $val2) {
                if ($types == 3) {
                    if ($val2['subid1'] == $val1['subid1'] && $val2['subid2'] == $val1['subid2'] && $val2['subid3'] == $val1['subid3']) {
                        $val1['zakaz_wait'] = $val2['zakaz_wait'];
                        $val1['comission_wait'] = $val2['comission_wait'];
                    }
                } elseif ($types > 3) {
                    if ($val2["'" . $groupsByArr . "'"] == $val1[$groupsByArr]) {
                        $val1['zakaz_wait'] = $val2['zakaz_wait'];
                        $val1['comission_wait'] = $val2['comission_wait'];
                    }
                }
            }
        }
    }


    $sql = 'SELECT ' . $groupsBy . ', COUNT(id) as zakaz_cancel, SUM(comission)*kolvo as comission_cancel FROM zakaz WHERE `status` = "0" AND `user_id`  = "' . $user_id . '" AND `date` BETWEEN "' . htmlentities($dat1) . ' ' . $DT . '" AND "' . htmlentities($dat2) . ' ' . $NT . '" ' . $args_offer . '' . $args_subid1 . '' . $args_subid2 . '' . $args_subid3 . '  GROUP BY ' . $groupsBy;
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) != 0) {
        while ($res = mysqli_fetch_assoc($result)) {
            if ($types == 3) {
                $recs5[] = array('subid1' => $res['subid1'], 'subid2' => $res['subid2'], 'subid3' => $res['subid3'], 'zakaz_cancel' => $res['zakaz_cancel'], 'comission_cancel' => $res['comission_cancel']);
            } elseif ($types > 3) {
                $recs5[] = array("'" . $groupsByArr . "'" => $res[$groupsByArr], 'zakaz_cancel' => $res['zakaz_cancel'], 'comission_cancel' => $res['comission_cancel']);
            }
        }
        foreach ($recs as $key1 => &$val1) {
            foreach ($recs5 as $key2 => $val2) {
                if ($types == 3) {
                    if ($val2['subid1'] == $val1['subid1'] && $val2['subid2'] == $val1['subid2'] && $val2['subid3'] == $val1['subid3']) {
                        $val1['zakaz_cancel'] = $val2['zakaz_cancel'];
                        $val1['comission_cancel'] = $val2['comission_cancel'];
                    }
                } elseif ($types > 3) {
                    if ($val2["'" . $groupsByArr . "'"] == $val1[$groupsByArr]) {
                        $val1['zakaz_cancel'] = $val2['zakaz_cancel'];
                        $val1['comission_cancel'] = $val2['comission_cancel'];
                    }
                }
            }
        }
    }

    $sql = 'SELECT ' . $groupsBy . ', COUNT(id) as zakaz_trash, SUM(comission)*kolvo as comission_trash FROM zakaz WHERE `status` = "5" AND `user_id`  = "' . $user_id . '" AND `date` BETWEEN "' . htmlentities($dat1) . ' ' . $DT . '" AND "' . htmlentities($dat2) . ' ' . $NT . '" ' . $args_offer . '' . $args_subid1 . '' . $args_subid2 . '' . $args_subid3 . '  GROUP BY ' . $groupsBy;
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) != 0) {
        while ($res = mysqli_fetch_assoc($result)) {
            if ($types == 3) {
                $recs6[] = array('subid1' => $res['subid1'], 'subid2' => $res['subid2'], 'subid3' => $res['subid3'], 'zakaz_trash' => $res['zakaz_trash'], 'comission_trash' => $res['comission_trash']);
            } elseif ($types > 3) {
                $recs6[] = array("'" . $groupsByArr . "'" => $res[$groupsByArr], 'zakaz_trash' => $res['zakaz_trash'], 'comission_trash' => $res['comission_trash']);
            }
        }
        foreach ($recs as $key1 => &$val1) {
            foreach ($recs6 as $key2 => $val2) {
                if ($types == 3) {
                    if ($val2['subid1'] == $val1['subid1'] && $val2['subid2'] == $val1['subid2'] && $val2['subid3'] == $val1['subid3']) {
                        $val1['zakaz_trash'] = $val2['zakaz_trash'];
                        $val1['comission_trash'] = $val2['comission_trash'];
                    }
                } elseif ($types > 3) {
                    if ($val2["'" . $groupsByArr . "'"] == $val1[$groupsByArr]) {
                        $val1['zakaz_trash'] = $val2['zakaz_trash'];
                        $val1['comission_trash'] = $val2['comission_trash'];
                    }
                }
            }
        }
    }
//var_dump($recs);
}

?>
