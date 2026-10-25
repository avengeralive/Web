<?php
namespace Leadrock\Helpers;

class Storage
{
    const TRACK_ID = 'leadrock_track_id';
    const FB_PIXEL_ID = 'leadrock_facebook_id';

    private static $isSessionStarted = false;

    /**
     * Store param value in all available storage
     *
     * @param $param
     * @param $value
     */
    public static function saveParam($param, $value)
    {
        Cookie::init();
        Cookie::set($param, $value, Cookie::PERMANENT);

        self::startSession();
        $_SESSION[$param] = $value;
    }

    /**
     * Restore param value from storage using prioritising conditions
     *
     * @param $param
     * @return mixed
     */
    public static function restoreParam($param)
    {
        Cookie::init();
        $id = Cookie::get($param);

        if (empty($id)) {
            self::startSession();
            $id = isset($_SESSION[$param]) ? $_SESSION[$param] : null;
        }

        return $id;
    }

    public static function clearAll()
    {
        Cookie::clear(self::TRACK_ID);
        Cookie::clear(self::FB_PIXEL_ID);
    }

    /**
     * Session starter
     */
    private static function startSession()
    {
        if (!self::$isSessionStarted) {
            session_start();
            self::$isSessionStarted = true;
        }
    }
}