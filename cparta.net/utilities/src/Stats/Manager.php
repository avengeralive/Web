<?php

class Stats_Manager extends Entity_Manager {

    /**
     * 
     * @return \Entity
     */
    protected function createElement() {
        return new Offer();
    }

    public function sortStatsAsc($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

    public function getStats($data, $where, $typeSorts, $subs, $types) {
        $recs = array();
        $tobd = '';
        $profitBD = 'sum(comission_cpa)';
        $db = DB::getInstance();
        if ($types == 10) {
            $profitBD = 'sum(comission)';
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($types == 40) {
            $profitBD = 'sum(comission+comission_cpa)';
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $i = 0;

        foreach ($data as $arr) {
            if ($typeSorts == 1) {
                $type = "date_format(date, '%Y-%m-%d')='" . $arr->d . "'";
            } elseif($typeSorts==11){
                $type = "date_format(date, '%H')='" . $arr->d . "'";
            }elseif ($typeSorts == 2) {
                $type = "offer_id = '" . $arr->offer_id . "'";
                $sql = "select name FROM offers where id = '" . $arr->offer_id . "'";
                $offer_name = $db->query($sql)->fetchColumn();
            } elseif ($typeSorts == 3) {
                if (!empty($subs)) {
                    $type = $subs . " = '" . $arr->sub . "'";
                } else {
                    $type = "subid1 = '" . $arr->subid1 . "' and subid2 = '" . $arr->subid2 . "' and subid3 = '" . $arr->subid3 . "' and subid4 = '" . $arr->subid4 . "' and subid5 = '" . $arr->subid5 . "'";
                }
            } elseif ($typeSorts == 4) {
                $type = "short_country = '" . $arr->short_country . "'";
                $sql = "select name_ru FROM sxgeo_country where iso = '" . $arr->short_country . "'";
                $short_country = $db->query($sql)->fetchColumn();
            } elseif ($typeSorts == 5) {
                $type = "stream = '" . $arr->stream . "'";
                $sql = "select id,name FROM streams where id = '" . $arr->stream . "'";
                $stream = $db->query($sql)->fetchObject();
            } elseif ($typeSorts == 6) {
                $type = "landing_id = '" . $arr->landing_id . "'";
                $sql = "select name,offer_id,url FROM landings where id = '" . $arr->landing_id . "'";
                $land_arr = $db->query($sql)->fetchObject();
                $land = $land_arr->name; 
                $land_url = $land_arr->url;
                $sql = "select name FROM offers where id = '" . $land_arr->offer_id . "'";
                $land_offer_name = $db->query($sql)->fetchColumn();
                $land_offer_name = mb_substr($land_offer_name, 0, 35, 'UTF-8');   
            } elseif ($typeSorts == 7) {
                $type = "prelanding_id = '" . $arr->prelanding_id . "'";
                $sql = "select name FROM prelandings where id = '" . $arr->prelanding_id . "'";
                $preland = $db->query($sql)->fetchColumn();
                $sql = "select count(id) FROM clients_log where user_id = '" . $this->byUserId . "' and prelanding_id = '" . $arr->prelanding_id . "' and date BETWEEN '" . $this->byDate . "'";
                $count_prelends_all = $db->query($sql)->fetchColumn();
                $sql = "select count(id) FROM clients_log where user_id = '" . $this->byUserId . "' and prelanding_id = '" . $arr->prelanding_id . "' and date BETWEEN '" . $this->byDate . "' and prelendToLend = 1";
                $count_prelends_tl = $db->query($sql)->fetchColumn();   
                if($count_prelends_tl > 0 && $count_prelends_all > 0){
                    $tl = round((($count_prelends_tl*100)/$count_prelends_all),1);
                }else{
                    $tl = 0;    
                }
                
            } elseif ($typeSorts == 8) {
                $type = "mobile = '" . $arr->mobile . "'";
                $mobile = $arr->mobile == 1 ? 'Мобильный' : 'ПК';
            } elseif ($typeSorts == 9) {
                $type = "referer_host = '" . $arr->referer_host . "'";
                $refhost = $arr->referer_host;
            } elseif ($typeSorts == 10) {
                $type = "user_id = '" . $arr->user_id . "'";
                $webmaster = DB::getInstance()->query("select concat_ws(', ',id,email) from users where id=" . $arr->user_id)->fetchColumn();
            }

            $sql = "select count(id) FROM zakaz where " . $type . " and status='1' and date BETWEEN '" . $this->byDate . "' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $zakaz_wait = $db->query($sql)->fetchColumn();

            $sql = "select count(id) FROM zakaz where " . $type . " and status='2' and date BETWEEN '" . $this->byDate . "' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $zakaz_hold = $db->query($sql)->fetchColumn();

            $sql = "select count(id) FROM zakaz where " . $type . " and date BETWEEN '" . $this->byDate . "' and status='3' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $zakaz_ok = $db->query($sql)->fetchColumn();

            $sql = "select count(id) FROM zakaz where " . $type . " and date BETWEEN '" . $this->byDate . "' and status='0' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $zakaz_cancel = $db->query($sql)->fetchColumn();

            $sql = "select count(id) FROM zakaz where " . $type . " and date BETWEEN '" . $this->byDate . "' and status='5' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $zakaz_trash = $db->query($sql)->fetchColumn();

            $sql = "select " . $profitBD . " FROM zakaz where " . $type . " and date BETWEEN '" . $this->byDate . "' and status='1' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $comission_wait = $db->query($sql)->fetchColumn();

            $sql = "select " . $profitBD . " FROM zakaz where " . $type . " and status='2' and date BETWEEN '" . $this->byDate . "' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $comission_hold = $db->query($sql)->fetchColumn();

            $sql = "select " . $profitBD . " FROM zakaz where " . $type . " and status='3' and date BETWEEN '" . $this->byDate . "' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $comission_ok = $db->query($sql)->fetchColumn();

            $sql = "select " . $profitBD . " FROM zakaz where " . $type . " and status='0' and date BETWEEN '" . $this->byDate . "' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $comission_cancel = $db->query($sql)->fetchColumn();

            $sql = "select " . $profitBD . " FROM zakaz where " . $type . " and status='5' and date BETWEEN '" . $this->byDate . "' " . $tobd;
            if (!empty($where)) {
                foreach ($where as $k) {
                    $sql .= " and ";
                    $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                }
            }
            $comission_trash = $db->query($sql)->fetchColumn();

            if ($types == 70) {
                $sql = "select sum(comission) as profit_web,sum(comission+comission_cpa) as profit_cpa FROM zakaz where " . $type . " and status in (2,3) and date BETWEEN '" . $this->byDate . "' " . $tobd;
                if (!empty($where)) {
                    foreach ($where as $k) {
                        $sql .= " and ";
                        $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
                    }
                }
                $profit_arr = $db->query($sql)->fetchObject();
            }

            $cr = round((($zakaz_wait + $zakaz_hold + $zakaz_ok + $zakaz_cancel + $zakaz_trash) / $arr->hosts) * 100, 2);
            $epc = round(($comission_ok + $comission_hold) / $arr->hosts, 2);
            if ($arr->hosts != 0) {
                $kolvo_zakaz = $zakaz_wait + $zakaz_hold + $zakaz_cancel + $zakaz_ok;
                if ($kolvo_zakaz != 0) {
                    $approove = sprintf("%.2f", 100 / $kolvo_zakaz * ($zakaz_ok + $zakaz_hold));
                } else {
                    $approove = '0';
                }
            } else {
                $approove = '0';
            }
            $recs[$i]['date_s'] = strtotime($arr->d);
            $recs[$i]['date'] = $arr->d;

            if (isset($offer_name) && $offer_name != '') {
                $recs[$i]['name'] = $offer_name;
                $recs[$i]['offer_id'] = $arr->offer_id;
            }
            if ($typeSorts == 3 && empty($subs)) {
                $recs[$i]['subid1'] = $arr->subid1;
                $recs[$i]['subid2'] = $arr->subid2;
                $recs[$i]['subid3'] = $arr->subid3;
                $recs[$i]['subid4'] = $arr->subid4;
                $recs[$i]['subid5'] = $arr->subid5;
            } elseif ($typeSorts == 3 && !empty($subs)) {
                $recs[$i]['sub'] = $arr->sub;
            } elseif ($typeSorts == 4) {
                $recs[$i]['short_country'] = $short_country;
                $recs[$i]['country_iso'] = $arr->short_country;
            } elseif ($typeSorts == 5) {
                $recs[$i]['stream_id'] = $stream->id;
                $recs[$i]['stream_name'] = $stream->name;
            } elseif ($typeSorts == 6) {

                $recs[$i]['land']['name'] = $land;
                $recs[$i]['land']['offer'] = $land_offer_name;
                $recs[$i]['land']['url'] = $land_url;
            } elseif ($typeSorts == 7) {
                $recs[$i]['preland'] = $preland;
                $recs[$i]['TL'] = $tl;
            } elseif ($typeSorts == 8) {
                $recs[$i]['mobile'] = $mobile;
            } elseif ($typeSorts == 9) {
                $recs[$i]['refhost'] = $refhost;
            } elseif ($typeSorts == 10) {
                $recs[$i]['webmaster'] = $webmaster;
            }

            $recs[$i]['m15s'] = round((1 - $arr->m15s) * 100, 1);
            $recs[$i]['monline'] = $arr->monline;
            $recs[$i]['mclicks'] = ($arr->mclicks * 10000);
            $recs[$i]['mscroll'] = ($arr->mscroll * 10000);
            $recs[$i]['minput'] = ($arr->minput * 10000);
            $recs[$i]['mselect'] = ($arr->mselect * 10000);

            $recs[$i]['hosts'] = $arr->hosts;
            $recs[$i]['clicks'] = $arr->clicks;
            $recs[$i]['zakaz_wait'] = $zakaz_wait;
            $recs[$i]['zakaz_all'] = $zakaz_ok + $zakaz_hold;
            $recs[$i]['zakaz_cancel'] = $zakaz_cancel;
            $recs[$i]['zakaz_sum'] = $zakaz_ok + $zakaz_hold + $zakaz_cancel + $zakaz_wait;
            $recs[$i]['zakaz_trash'] = $zakaz_trash;
            $recs[$i]['comission_wait'] = ($comission_wait > 0) ? $comission_wait : 0;
            $recs[$i]['comission_all'] = (($comission_ok + $comission_hold) > 0) ? ($comission_ok + $comission_hold) : 0;
            $recs[$i]['comission_cancel'] = ($comission_cancel > 0) ? $comission_cancel : 0;
            $recs[$i]['comission_trash'] = ($comission_trash > 0) ? $comission_trash : 0;

            if ($types == 70) {
                $recs[$i]['profit_cpa'] = $profit_arr->profit_cpa;
                $recs[$i]['profit_web'] = $profit_arr->profit_web;
            }

            $recs[$i]['cr'] = $cr;
            $recs[$i]['epc'] = $epc;
            $recs[$i]['approove'] = $approove;
            $i++;
        }
        
        if (!empty($this->sortBy)) {
            $sorts = explode(' ', $this->sortBy);
            if($sorts[0] == 'id'){
                usort($recs,  create_function('$a,$b','return -($a["date_s"] - $b["date_s"]);'));
            }else{
                if($sorts[1] == 'asc'){
                    usort($recs,  create_function('$a,$b','return $a["'.$sorts[0].'"] - $b["'.$sorts[0].'"];'));
                }elseif($sorts[1] == 'desc'){
                    usort($recs,  create_function('$a,$b','return -($a["'.$sorts[0].'"] - $b["'.$sorts[0].'"]);'));
                }                
            }           

        }

        return $recs;
    }

    public function getByReferer($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "SELECT DISTINCT referer_host, avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput,  count(distinct ip) as hosts,count(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by referer_host";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 9, 0, $type);
        return $return;
    }

    public function getByWebmasters($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "SELECT DISTINCT user_id, avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput,  count(distinct ip) as hosts,count(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by user_id";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 10, 0, $type);
        return $return;
    }

    public function getByDevices($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "SELECT DISTINCT mobile, avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput,  count(distinct ip) as hosts,count(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by mobile";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 8, 0, $type);
        return $return;
    }

    public function getByPrelandings($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "SELECT DISTINCT prelanding_id, avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput,  count(distinct ip) as hosts,count(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by prelanding_id";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 7, 0, $type);
        return $return;
    }

    public function getByLandings($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "SELECT  DISTINCT landing_id, avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput, count(distinct ip) as hosts,count(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by landing_id";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 6, 0, $type);
        return $return;
    }

    public function getByOffers($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "SELECT DISTINCT offer_id, avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput,  count(distinct ip) as hosts,count(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by offer_id";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 2, 0, $type);
        return $return;
    }

    public function getByDates($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "select avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput, DATE_FORMAT(date, '%Y-%m-%d') as d,COUNT(DISTINCT(ip)) as hosts,COUNT(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by d";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 1, 0, $type);
        return $return;
    }

    public function getByHours($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "select avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput, DATE_FORMAT(date, '%H') as d,COUNT(DISTINCT(ip)) as hosts,COUNT(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by (d+0) desc";
////echo $sql;
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 11, 0, $type);
        return $return;
    }

    public function getBySubsId($where, $type) {
        $db = DB::getInstance();
        $sql = "select avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput, " . $this->bySubs . " DATE_FORMAT(date, '%Y-%m-%d') as d,COUNT(DISTINCT(ip)) as hosts,COUNT(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' and user_id = " . $this->byUserId;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by " . $this->groupBy;
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 3, $this->bySubs2, $type);
        return $return;
    }

    public function getByCountrys($where, $type) {
        $db = DB::getInstance();
        $tobd = '';
        if ($type == 10) {
            $tobd = 'and user_id = ' . $this->byUserId;
        } elseif ($type == 40) {
            $tobd = 'and owner_id = ' . $this->byUserId;
        }
        $sql = "select avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput, short_country, DATE_FORMAT(date, '%Y-%m-%d') as d,COUNT(DISTINCT(ip)) as hosts,COUNT(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' " . $tobd;
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by short_country";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 4, 0, $type);
        return $return;
    }

    public function getByStreams($where, $type) {
        $db = DB::getInstance();
        $sql = "select avg(metric_15s)  as m15s, avg(metric_online)  as monline, avg(metric_select) as mselect,  avg(metric_scroll)  as mscroll, avg(metric_clicks)  as mclicks, avg(metric_input) as minput, stream, DATE_FORMAT(date, '%Y-%m-%d') as d,COUNT(DISTINCT(ip)) as hosts,COUNT(id) as clicks FROM clients_log where date BETWEEN '" . $this->byDate . "' and user_id = " . $this->byUserId . " and stream != 0";
        if (!empty($where)) {
            foreach ($where as $k) {
                $sql .= " and ";
                $sql .= $k['where'] . " " . $k['type'] . " " . $k['values'];
            }
        }
        $sql .= " group by stream";
        parent::setSql($sql);
        $data = parent::get();
        $return = self::getStats($data, $where, 5, 0, $type);
        return $return;
    }

}
