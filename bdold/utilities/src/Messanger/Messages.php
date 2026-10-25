<?php

class Messanger_Messages extends Entity {

    public static function tableName() {
        return 'messanger_messages';
    }
    
    public static function getByChat($chat_id) {
        $sql = "select * from messanger_messages where chat_id=?";

        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$chat_id]);
        if ($stmt->rowCount() == 0) {
            throw new Entity_NotFoundException("chat not found");
        }
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $row;
    }
}
