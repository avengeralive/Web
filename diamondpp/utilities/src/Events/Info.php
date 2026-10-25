<?php

class Events_Info {

    public $photo = false;
    public $title = '';
    public $plain = '';
    public $link = false;

    public function __construct($title, $plain, $photo = false, $link = '') {
        $this->title = $title;
        $this->photo = $photo;
        $this->plain = $plain;
        $this->link = $link;
    }

}
