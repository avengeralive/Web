<?php
include dirname(__FILE__) . '/includes/config.php';
        $sql = "Select * from frod_blacklist where ip='123' or phone='234'";
        $stmt = DB::getInstance()->query($sql);
        echo $stmt->rowCount();
