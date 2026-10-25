<?php

class Chat extends Entity {

    public static function tableName() {
        return 'chat';
    }
    
    public static function getLastMessages() {
        $sql = "select * from chat order by id desc";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            return [];
        }
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $row;
    }

}
