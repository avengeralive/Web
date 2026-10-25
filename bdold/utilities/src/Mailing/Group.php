<?php

class Mailing_Group extends Entity {

    const GROUP_TYPE_INTERNAL = 1;
    const GROUP_TYPE_CUSTOM = 2;

    public static function tableName() {
        return 'mailing_groups';
    }

    public function reSaveUsers($users) {
        $sql = "delete from mailing_groups_users where group_id=" . $this->id;
        $db = DB::getInstance();
        $db->query($sql);

        if (!$users) {
            $users = [];
        }
        foreach ($users as $id) {
            $sql = "insert into mailing_groups_users set group_id=" . $this->id . ", user_id=" . intval($id);
            $db->query($sql);
        }
        return true;
    }

    public function getTotalUsers() {
        $sql = "Select count(*) from mailing_groups_users where group_id=" . $this->id;
        return ($a = DB::getInstance()->query($sql)->fetchColumn()) ? $a : 0;
    }

    public function getUsers($onlyGroup = false) {
        $sql = "select u.*,if(group_id=$this->id,1,0) as in_group from users u left join mailing_groups_users mgu on u.id=mgu.user_id where u.notify=1 and (group_id=" . $this->id;
        if (!$onlyGroup) {
            $sql .= " or group_id is null or group_id!=" . $this->id;
        }

        $sql .= " )order by id desc";
        return DB::getInstance()->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

}
