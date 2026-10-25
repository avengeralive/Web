<?php

class Entity implements ArrayAccess {

    protected $_attributes = array();

    public function __construct() {
        
    }

    /**
     * Возвращает всю коллекцию
     * @param type $order
     * @param type $where
     * @return \static
     */
    public static function getAll($order = false, $where = false) {
        $sql = "select * from " . static::tableName() . "";
        if ($where) {
            $sql .= " where " . $where;
        }
        if ($order) {
            $sql .= " order by " . $order;
        }
        $stmt = DB::getInstance()->query($sql);
        $list = [];
        while ($row = $stmt->fetchObject()) {
            $el = new static;
            $el->setRow($row);
            $list[]=$el;
        }
        return $list;
    }

    public function delete() {
        $sql = "delete from " . static::tableName() . " where id=" . $this->id;
        return DB::getInstance()->query($sql)->rowCount();
    }

    public function update($vars) {
        $db = DB::getInstance();
        $sql = "update " . static::tableName() . " set ";
        $chain = array();
        foreach ($vars as $k => $v) {
            $chain[] = '`' . $k . "`=?";
        }
        $sql .= implode(",", $chain);
        $sql .= " where id=" . $this->id;
        $stmt = $db->prepare($sql);
        try {
            $stmt->execute(array_values($vars));
        } catch (Exception $e) {

            return false;
        }
        return true;
    }

    /**
     * Создает запись
     * @return boolean|\Entity
     */
    public function create() {
        $sql = "insert into " . static::tableName() . " set ";
        $chain = array();
        foreach ($this->_attributes as $k => $v) {
            $chain[] = '`' . $k . "`=?";
        }
        $sql .= implode(",", $chain);
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        try {
            $stmt->execute(array_values($this->_attributes));
        } catch (Exception $e) {
            return false;
        }
        $lastId = $db->lastInsertId();
        $this->id = $lastId;
        $row = $db->query("select * from " . static::tableName() . " where id=" . $lastId)->fetchObject();
        $this->setRow($row);
        return $this;
    }

    /**
     * Название таблицы
     * @return string
     */
    public static function tableName() {
        return '';
    }

    public static function getById($id) {
        $db = DB::getInstance();
        $sql = "select * from " . static::tableName() . " where id=" . intval($id);
        $stmt = $db->query($sql);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $el = new static();
        $el->setRow($stmt->fetchObject());
        return $el;
    }

    public function __set($name, $value) {
        $this->_attributes[$name] = (is_null($value) ? '' : $value);
        return $this->_attributes;
    }

    /**
     * 
     * @param type $name
     * @return midex
     */
    public function __get($name) {
        if (!isset($this->_attributes[$name])) {
            return null;
        }
        return $this->_attributes[$name];
    }

    public function offsetExists($offset) {
        return isset($this->_attributes[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->_attributes[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->_attributes[$offset]) ? $this->_attributes[$offset] : null;
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->_attributes[] = $value;
        } else {
            $this->_attributes[$offset] = $value;
        }
    }

    public function setRow($row) {
        foreach ($row as $k => $v) {
            $this->$k = $v;
        }
        return $this;
    }

}
