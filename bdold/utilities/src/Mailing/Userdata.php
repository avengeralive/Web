<?php

class Mailing_Userdata extends Entity{
    public static function tableName() {
        return 'mailing_userdata';
    }
    public function create() {
        $this->created = date("Y-m-d H:i:s");
        
        return parent::create();
    }
}