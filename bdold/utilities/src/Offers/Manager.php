<?php

class Offers_Manager extends Entity_Manager {

    /**
     * 
     * @return \Entity
     */
    protected function createElement() {
        return new Offer();
    }

    /**
     * 
     * @return \Offer
     */
    public function get() {
        return parent::get();
    }
}
