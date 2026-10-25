<?php

class Stream_Manager extends Entity_Manager{
    public function createElement() {
        return new Stream;
    }
}