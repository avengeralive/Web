<?php

class Zakaz_Manager extends Entity_Manager {

    public function createElement() {
        return new Zakaz;
    }

}
