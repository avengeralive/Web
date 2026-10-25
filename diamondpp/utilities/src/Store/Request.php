<?php


class Store_Request extends Entity {
    public static function tableName() {
        return 'store_req';
    }
    
    public static function getCount(){
        $db = DB::getInstance();        
        $sql = "select count(id) from store_req where status =0";
        $stmt = $db->query($sql);
        return $stmt->fetchColumn();    
    } 
}
