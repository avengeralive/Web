<?php

class Paysys extends Entity {

    protected $_user = 0;
    
    public static function tableName() {
        return 'users_paysys';
    }

    public function setUser($user) {
        $this->_user = $user;
        return $this;
    }

    public function getUserPaysys() {
        $sql = "select * from " . static::tableName();
        $vars = [];
        if ($this->_user) {
            $sql .= " where user_id = :id";
            $vars['id'] = $this->_user;
        }
        $sql .= " limit 1";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute($vars);
        return $stmt->fetchObject();
    }
}
