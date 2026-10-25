<?php

class Client_Log extends Entity {

    public static function tableName() {
        return 'clients_log';
    }

    /**
     * 
     * @param type $code
     * @return Client_Log
     */
    public static function getByCode($code) {
        $sql = "select * from clients_log where code=?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$code]);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $row = $stmt->fetchObject();
        return (new static)->setRow($row);
    }

    public static function getById($code) {
        $sql = "select * from clients_log where id=?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$code]);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $row = $stmt->fetchObject();
        return (new static)->setRow($row);
    }

    /**
     * Преобразовывает лог в клиента и возвращает клиента
     * @return \Client
     */
    public function castToClient() {
        $client = new Client;
        $client->id = $this->id;
        $client->browser = $this->browser_name;
        $client->browser_version = $this->browser_version;
        $client->ip = $this->ip;
        $client->city = $this->town;
        $client->region = $this->region;
        $client->country = $this->country;
        $client->country_short = $this->short_country;
        $client->referer = $this->referer;
        $client->referer_host = $this->referer_host;
        $client->useragent = $this->useragent;
        $client->platform = $this->platform;
        $client->is_mobile = $this->mobile;
        $client->paste = $this->paste;
        $client->metric_online = $this->metric_online;


        return $client;
    }

}
