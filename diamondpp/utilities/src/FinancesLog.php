<?php

class FinancesLog extends Entity {

    public static function tableName() {
        return 'finances_log';
    }

    protected $_start, $_end, $_type = 0, $_user = 0;

    public function setStartDate($date) {
        $this->_start = date('Y-m-d', strtotime($date)).' 00:00:00';
        return $this;
    }

    public function setEndDate($date) {
        $this->_end = date('Y-m-d', strtotime($date)).' 23:59:59';
        return $this;
    }

    public function setType($type) {
        $this->_type = $type;
        return $this;
    }

    public function setUser($user) {
        $this->_user = $user;
        return $this;
    }

    public function getStat() {
        $sql = "select fl.*,flt.description,u.email,u.wmr from " . static::tableName() . " fl left join finances_tpl flt on fl.description=flt.id left join users u on fl.user_id=u.id where `date` between :start and :end ";
        $vars = [];
        $vars['start'] = $this->_start;
        $vars['end'] = $this->_end;
        $where = false;
        if ($this->_type) {
            $sql.=" and fl.user_id in (select id from users where tip=:tip) ";
            $vars['tip'] = $this->_type;
        } else {
            if ($this->_user) {
                $sql .= " and fl.user_id = :id";
                $vars['id'] = $this->_user;
            }
        }
        $sql .= " and fl.description in (1,2,3,4,18,20,30) and status=2 ";
        $sql .= " order by date desc";
        //var_dump($sql);
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute($vars);
        $list = [];
        while ($row = $stmt->fetchObject()) {
            $list[date('d.m.Y', strtotime($row->date))][] = $row;
        }
        return $list;
    }

}
