<?php
/**
 * Created by PhpStorm.
 * User: garin
 * Date: 07.11.2017
 * Time: 12:11
 */

namespace PluginsStatistic;

final class PluginsStatistic
{
    use \Cetera\DbConnection;
    const HTTP_URL = "http://plugins.fastsite.ru/plugins/plugins_statistic_data/data.php";
    const HTTP_SALT = "N7Aa1d85Fpl~seFvnPXFLaW2zofP%$";
    const SEND_TIMEOUT = 86400;
    const TABLE = "plugins_statistic_info";

    public static function sendData($name)
    {
        try {
            $isAdmin = \Cetera\Application::getInstance()->getUser() && \Cetera\Application::getInstance()->getUser()->isAdmin();
        } catch (\Exception $e) {
            $isAdmin = false;
        }

        if (empty($name) || !$isAdmin || !self::isExpired($name))
            return;

        try {
            self::setExpiredData($name);
        } catch (\Exception $e) {

        }

        $params = array(
            'name' => $name,
            'hash' => md5(self::HTTP_SALT . $_SERVER["SERVER_NAME"]),
            'site' => $_SERVER["SERVER_NAME"],
            'action' => 'setData'
        );

        try {
            @file_get_contents(self::HTTP_URL, false, stream_context_create(array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($params)
                )
            )));
        } catch (\Exception $e) {
        }
    }

    public static function isExpired($name)
    {
        $qb = self::getDbConnection()->createQueryBuilder();
        $data = $qb
            ->select('id')
            ->from(static::TABLE)
            ->where(sprintf("plugin='%s' AND timestamp_x > %d", $name, time() - self::SEND_TIMEOUT))
            ->execute();

        return $data->fetch() ? false : true;
    }

    public static function setExpiredData($name)
    {
        $name = trim($name);

        $qb = self::getDbConnection()->createQueryBuilder();
        $data = $qb
            ->select('id')
            ->from(self::TABLE)
            ->where(sprintf("plugin='%s'", $name))
            ->execute();

        try {
            if ($item = $data->fetch()) {
                self::getDbConnection()->update(static::TABLE, Array(
                    "timestamp_x" => time()
                ), array("id" => $item["id"]));
            } else {
                self::getDbConnection()->insert(static::TABLE, Array(
                    "plugin" => $name,
                    "timestamp_x" => time()
                ));
            }
        } catch (\Exception $e) {
        }
    }
}