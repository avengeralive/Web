<?php

class Mailing_Group_Manager extends Entity_Manager {

    public function createElement() {
        return new Mailing_Group;
    }
    /**
     * 
     * @return \Mailing_Group
     */
    public function get() {
        return parent::get();
    }

}
