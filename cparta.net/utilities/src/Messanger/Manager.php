<?php

class Messanger_Manager extends Entity_Manager {

    /**
     * 
     * @return \Entity
     */
    protected function createElement() {
        return new Messanger();
    }


    public function get() {
        return parent::get();
    }
}
