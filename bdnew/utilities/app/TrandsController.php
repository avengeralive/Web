<?php

class TrandsController {

    // проверка статистики оферов
    public function stats() {
        //SELECT count(*) as total, referer_host FROM `zakaz` WHERE offer_id=136 group by referer_host


        set_time_limit(0);
        ignore_user_abort(1);


        $db = DB::getInstance();

        if (1) {
            $sql = "select * from zakaz where sex=0";
            $stmt = $db->query($sql);
            $sexIter = 0;
            while ($row = $stmt->fetchObject()) {
                $sex = Utils_Client::getSexByName($row->name);
                if (!$sex['sex'])
                    continue;
                $db->query('update zakaz set sex=' . intval($sex['sex']) . ' where id=' . $row->id);
                $sexIter++;
            }
            echo "sex detect: " . $sexIter . PHP_EOL;
        }


        $sql = "select distinct offer_id as id from zakaz order by offer_id asc";
        $stmt = $db->query($sql);
        while ($row = $stmt->fetchObject()) {

            $offer_id = $row->id;
            $stat = [];

            $totalOrders = $db->query('select count(*) from zakaz where status!=5 and offer_id=' . $row->id)->fetchColumn();





            $stat['approve']['ok'] = 0;
            $stat['approve']['reject'] = 0;
            $stat['approve']['waiting'] = 0;
            if ($totalOrders > 0) {
                $stat['approve']['ok'] = intval(round(intval($db->query("select count(*) from zakaz where status in (2,3) and offer_id=" . $row->id)->fetchColumn()) / $totalOrders * 100));
                $stat['approve']['reject'] = intval(round(intval($db->query("select count(*) from zakaz where status=0 and offer_id=" . $row->id)->fetchColumn()) / $totalOrders * 100));
                $stat['approve']['waiting'] = intval(round(intval($db->query("select count(*) from zakaz where status=1 and offer_id=" . $row->id)->fetchColumn()) / $totalOrders * 100));

                $sql = "select count(*) from zakaz where mobile=1 and status!=5 and offer_id = " . $row->id;
                $stat['device']['phone'] = intval(round(intval($db->query($sql)->fetchColumn()) / $totalOrders * 100));

                $sql = "select count(*) from zakaz where mobile=0 and status!=5 and offer_id = " . $row->id;
                $stat['device']['pc'] = intval(round(intval($db->query($sql)->fetchColumn()) / $totalOrders * 100));

                $sql = "select count(*) from zakaz where sex=1 and status!=5 and offer_id = " . $row->id;
                $stat['sex']['male'] = intval(round(intval($db->query($sql)->fetchColumn()) / $totalOrders * 100));

                $sql = "select count(*) from zakaz where sex=2 and status!=5 and offer_id = " . $row->id;
                $stat['sex']['female'] = intval(round(intval($db->query($sql)->fetchColumn()) / $totalOrders * 100));
            }


            $sql = "insert into offers_stat set offer_id=?, ";
            $values = [];
            foreach ($stat as $pre => $names) {
                foreach ($names as $name => $value) {
                    $key = $pre . '_' . $name;
                    $values[$key] = $value;
                }
            }

            $sql .= trim(implode('=?, ', array_keys($values)), ',') . '=?';
            $sql .= " on duplicate key update " . trim(implode('=?,', array_keys($values)), ',') . '=?';
            $values = array_merge([$offer_id], array_values($values), array_values($values));

            $stmtTmp = DB::getInstance()->prepare($sql);
            $stmtTmp->Execute($values);
            echo "updated: " . $offer_id . "\tTotal orders:" . $totalOrders . PHP_EOL;


            $sql = "SELECT count(*) as total, referer_host,offer_id FROM `zakaz` WHERE status!=5 and offer_id=" . $row->id . " group by referer_host order by count(*) desc limit 4";
            $stmtTraffic = $db->query($sql);

            $id = 1;
            $rest = 0;
            while ($rowTraffic = $stmtTraffic->fetchObject()) {
                $sql = "update offers_stat set traffic" . $id . "=? where offer_id=" . $row->id;
                $_stmt = DB::getInstance()->prepare($sql);
                $host = $rowTraffic->referer_host;


                if (preg_match("/^htt/i", $host) || $host == '') {
                    $host = 'api';
                }
                $_stmt->execute([ $host . ',' . ($totalOrders > 0 ? ( intval($rowTraffic->total / $totalOrders * 100)) : 0) ]);
                $rest+=$rowTraffic->total;
                $id++;
            }
            $sql = "update offers_stat set traffic5=? where offer_id=" . $row->id;
            $_stmt = DB::getInstance()->prepare($sql);

            $_stmt->execute(['Другие,' . ($totalOrders > 0 ? ( intval(($totalOrders - $rest) / $totalOrders * 100)) : 0)]);

            /*
              foreach ($_POST['traffic'] as $id => $data) {
              $row = implode(',', [ $data['url'], $data['percent']]);
              $sql = "update offers_stat set traffic" . $id . "=?";
              $stmt = DB::getInstance()->prepare($sql);
              $stmt->execute([ $row]);
              }
             * 
             */
        }
    }

    public function checkTrands() {
        set_time_limit(0);
        ignore_user_abort(1);

        $om = new Offers_Manager(DB::getInstance());
        $om->where('keyword', '', '!=');
        $list = $om->get();
        $url = "https://publer.wildo.ru/dynamics_json.php?";

        foreach ($list as $offer) {
            $keyword = $offer->keyword;
            $vars['query'] = $keyword;
            $vars['type'] = 'forms';
            $content = file_get_contents($url . http_build_query($vars));
            $json = json_decode($content);
            echo $offer->id . PHP_EOL;
            if (!isset($json->data))
                continue;
            $res = [];
            foreach ($json->data as $date => $count) {
                $date = substr($date, 0, 7);
                if (!isset($res[$date])) {
                    $res[$date] = 0;
                }
                $res[$date]+=$count;
            }
            foreach ($res as $date => $count) {
                $sql = "insert into offers_trands set offer_id=:i, `date`=:d, publer=:p on duplicate key update publer=:p";
                $stmt = DB::getInstance()->prepare($sql);
                $stmt->execute([
                    'i' => $offer->id,
                    'd' => $date,
                    'p' => $count,
                ]);
            }
        }
    }

}
