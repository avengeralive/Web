<?php

class Mailing_Manager extends Entity_Manager {

    /**
     * 
     * @return \Mailing
     */
    public function get() {
        return parent::get();
    }
    protected function createElement() {
        return new Mailing;
    }

}
