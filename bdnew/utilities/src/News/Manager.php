<?php

class News_Manager extends Entity_Manager{
    protected function createElement() {
        return new News;
    }
}