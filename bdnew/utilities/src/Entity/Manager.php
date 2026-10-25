<?php

abstract class Entity_Manager {

    /**
     *
     * @var PDO
     */
    protected $db;
    protected $sql = false;
    protected $limit = 50;
    protected $offset = 0;
    protected $sortBy = 'id desc';
    protected $where = array();
    protected $values = array();

    const WHERE_STRICT = 1;
    const WHERE_LIKE = 2;
    const WHERE_IN = 3;
    const WHERE_RAW = 4;
    const WHERE_NOT_IN = 5;
    const WHERE_OR = 6;
    
    public function __construct(PDO $db = null) {
        if (!$db) {
            DB::getInstance();
        }
        $this->db = $db;
    }

    protected $total = 0;

    public function getTotal() {
        return $this->total;
    }

    /**
     * Создает сущность
     * @return \Entity Сущность
     */
    abstract protected function createElement();

    /**
     * 
     * @param type $offset
     * @return \Offers_Manager
     */
    public function offset($offset) {
        $this->offset = $offset;
        return $this;
    }

    public function group_by($group_by) {
        $this->group_by = $group_by;
        return $this;
    }

    public function where($field, $value, $type = false) {
        if (!$type) {
            $type = static::WHERE_STRICT;
        }
        if ($type == static::WHERE_RAW) {
            $this->where[] = $value;
        }
        if ($type == static::WHERE_OR) {
            $this->where[] = $field;
        }
        if ($type == static::WHERE_NOT_IN) {
            $this->where[] = $field . ' not in (' . implode(',', array_fill(0, count($value), '?')) . ')';
            $this->values = array_merge($this->values, $value);
        }
        if ($type == static::WHERE_IN) {
            $this->where[] = $field . ' in (' . implode(',', array_fill(0, count($value), '?')) . ')';
            $this->values = array_merge($this->values, $value);
        }
        if ($type == static::WHERE_STRICT) {
            $this->where[] = $field . ' = ?';
            $this->values[] = $value;
            return $this;
        }
        if ($type == static::WHERE_LIKE) {
            $this->where[] = $field . ' like ? or ' . $field . ' like ? or ' . $field . ' like ?';
            $this->values[] = '%' . $value;
            $this->values[] = '%' . $value . '%';
            $this->values[] = $value . '%';
        }
        if (is_string($type)) {
            $this->where[] = $field . $type . ' ?';
            $this->values[] = $value;
        }
        return $this;
    }

    public function limit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function sortBy($field, $type) {
        if (!in_array(strtoupper($type), array('ASC', 'DESC'))) {
            return $this;
        }
        $this->sortBy = $field . ' ' . $type;
        return $this;
    }

    public function sortByRaw($str) {
        $this->sortBy = $str;
        return $this;
    }

    public function setSql($sql) {
        $this->sql = $sql;
        return $this;
    }

    public function get() {

        if (!$this->sql) {
            $this->_buildSql();
        }
        $list = array();
        $stmt = $this->db->prepare($this->sql);
        $stmt->execute($this->values);
        while ($row = $stmt->fetchObject()) {

            $el = $this->createElement();
            $el->setRow($row);
            $list[] = $el;
        }


        $this->total = $this->db->query("select found_rows()")->fetchColumn();



        return $list;
    }

    protected function _buildSql() {

        $sql = "select sql_calc_found_rows * from " . forward_static_call(array(get_class($this->createElement()), "tableName"));
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
        $this->sql = $sql;

        return $this;
    }

}
