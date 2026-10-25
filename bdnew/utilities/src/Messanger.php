<?php

class Messanger extends Entity {

    public static function tableName() {
        return 'messanger_room';
    }

    public static function getCountNew($user_id){
        $db = DB::getInstance();        
        $sql = "select count(id) from messanger_room where (user_1 =".$user_id." and status_us1 = 1) or (user_2 =".$user_id." and status_us2 = 1)";
        $stmt = $db->query($sql);
        return $stmt->fetchColumn();    
    } 

    public static function getCountNewChat($user_id, $chat_id){
        $db = DB::getInstance();        
        $sql = "select count(id) from messanger_room where (user_1 =".$user_id." and status_us1 = 1 and id = ".$chat_id.") or (user_2 =".$user_id." and status_us2 = 1 and id =".$chat_id.")";
        $stmt = $db->query($sql);
        return $stmt->fetchColumn();   
    } 
}
