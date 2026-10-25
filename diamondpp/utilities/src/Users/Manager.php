<?php

class Users_Manager extends Entity_Manager {

    /**
     * 
     * @return \Entity
     */
    protected function createElement() {
        return new User();
    }

    /**
     * 
     * @return \Offer
     */
    public function get() {
        return parent::get();
    }
    
    public function getUsersAdmin() {
        $sql = "SELECT  u.id,u.*,(`hold` + `balance`) as balance_all, (select count(distinct ip) from clients_log where user_id=u.id ".$this->byDate.") as hosts,(select count(*) from zakaz where user_id=u.id ".$this->byDate.") as orders FROM users u ".$this->byReg;
              
        if (!empty($this->where)) {
            $sql .= " where ";
            $sql .= "( " . implode(") and (", $this->where) . ' )';
        }
        $sql.= " order by " . $this->sortBy;
        if ($this->limit > 0) {
            $sql.= " limit ";
            if ($this->offset) {
                $sql.= " " . intval($this->offset) . ', ';
            }
            $sql.=$this->limit;
        }

        parent::setSql($sql);
        return parent::get();
    }
    
    public function getCountUsers() {
        $sql = "select sql_calc_found_rows * from " . forward_static_call(array(get_class($this->createElement()), "tableName"));       
        if (!empty($this->where)) {
            $sql .= " where ";
            $sql .= "( " . implode(") and (", $this->where) . ' )';
        }
        parent::setSql($sql);
        $count = parent::get();
        return count($count);
    }
    
    
    public function getUsersUTM() {
        $sql = "select count(*) as hosts,";
        $sql .= " ".$this->u1." as u_source,utm_medium,utm_campaign,utm_term,utm_content,";
        $sql .= "(select count(id) from users where ".$this->u1."=u_source and tip = '10') as signups, 
                (select count(id) from zakaz force index(status) where status between 2 and 3 and user_id in(select id from users where ".$this->u1."=u_source)) as orders,
                (select count(id) from users where ".$this->u1."=u_source and id in(select user_id from zakaz force index(status) where status between 2 and 3 group by user_id having count(*)>1) ) as orders1,
                (select count(id) from users where ".$this->u1."=u_source and id in(select user_id from zakaz force index(status) where status between 2 and 3 group by user_id having count(*)>10) ) as orders10,
                (select count(id) from users where ".$this->u1."=u_source and id in(select user_id from zakaz force index(status) where status between 2 and 3 group by user_id having count(*)>100) ) as orders100,
                (select sum(comission_cpa) from zakaz force index(status) where status between 2 and 3 and user_id in(select id from users where ".$this->u1."=u_source)) as profit_cpa,
                (select count(id) from clients_log where user_id in (select id from users where ".$this->u1."=u_source)) as clicks
                from users_log where ".$this->u1." != '' ";
        
        $sql .= " group by ".$this->u1;
        if (!empty($this->sortBy)) {
            $sql.= " order by " . $this->sortBy;
        }          
        parent::setSql($sql);
        return parent::get();
        
    }    
}
