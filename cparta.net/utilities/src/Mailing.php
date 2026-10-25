<?php

class Mailing extends Entity {

    const STATUS_NEW = 'new';
    const STATUS_SENDING = 'sending';
    const STATUS_DONE = 'done';

    public static function tableName() {
        return 'mailing';
    }

    public function resetStat() {
        $db = DB::getInstance();

        $sql = "Delete from mailing_links where mailing_id=" . $this->id;
        $db->query($sql);

        $sql = "Delete from mailing_userdata where mailing_id=" . $this->id;
        $db->query($sql);
    }

}
