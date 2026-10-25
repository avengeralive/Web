<?php

class Offers_Category extends Entity {

    public static function tableName() {
        return 'category_tpl';
    }
    const NO_EMPTY = 1;

    public static function getAll($type = false) {
        $sql = "select * from category_tpl order by name asc";
        if ($type) {
            if ($type == static::NO_EMPTY) {
                $sql = "select ct.* from category_tpl ct left join offers o on ct.id=o.category where o.active=1 group by ct.id order by ct.name asc ";
            }
        }
        $db = DB::getInstance();
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
