<?php

use GuzzleHttp\Exception\ClientException;
use Telegram\Bot\Api;

class User extends Entity {

    const STATUS_BLOCK = 5;
    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 0;
    const TYPE_WEBMASTER = 10;
    const TYPE_ADVERTISER = 40;
    const TYPE_ADMIN = 70;

    public static function tableName() {
        return 'users';
    }

    public function sendTelegram($msg) {
        if( $this->telegram == ''){
            return false;
        }
        $key = Registry::get('di')->telegram['KEY'];
        $api = new Api($key);

        $AuthCommands = [
            [new Telegram_Command_Balance()],
            [new Telegram_Command_StatToday(), new Telegram_Command_StatYesterday()],
            [new Telegram_Command_Stat7Days(), new Telegram_Command_Autologin()],
        ];
        $commands = $AuthCommands;

        $message = $msg;
        
        array_walk_recursive($commands, function(&$el) {
            $el = (string) $el;
        });
        
        $reply_markup = $api->replyKeyboardMarkup([
            'keyboard' => $commands,
            'resize_keyboard' => true, 
            'one_time_keyboard' => true
        ]);

        
        try {
            
            $response = $api->sendMessage([
                'chat_id' => $this->telegram, 
                'text' => $message,
                'reply_markup' => $reply_markup
            ]);
            
        } catch (ClientException $e) {
            //die();
        }
    }

    public function create() {
        $this->password = md5(md5($this->password));
        if (!isset($this->tip)) {
            $this->tip = self::TYPE_WEBMASTER;
        }
        $this->apikey = md5(microtime(1));
        $this->date_registration = date("Y-m-d H:i:s");
        return parent::create();
    }

    /**
     * Попытка авторизации
     * @param type $email
     * @param type $password
     */
    public static function login($email, $password) {
        $sql = "select * from users where email=? and `password`=md5(md5(?))";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email, $password]);
        if ($stmt->rowCount() == 0) {
            throw new Exception("Not found", Api_Response::STATUS_NOTFOUND);
        }
        $u = new User;
        $u->setRow($stmt->fetchObject());
        if ($u->active != 1) {
            throw new Exception("User not active", -1);
        }
        return $u;
    }

    /**
     * Проверяет авторизирован ли человек, false-нет, id (int) если да
     * @return boolean|int
     */
    public static function isAuth() {

        if (!isset($_COOKIE['auth_id'], $_COOKIE['auth_hash'])) {
            return false;
        }

        if (base64_decode($_COOKIE['auth_hash']) == sha1('OLOLOTRALALALASUPERMEGAKEY.KOTORIINIKTONEZNAET AZAZAZ' . $_COOKIE['auth_id'])) {
            return intval($_COOKIE['auth_id']);
        }
        return false;
    }

    /**
     * Выставляет кукисы авторизации
     * @param type $user_id
     */
    public static function setAuth($user_id) {
        setcookie('auth_id', $user_id, time() + 60 * 60 * 24 * 14, '/');
        $hash = md5(md5('SUPERMEGAKEY' .time(). '.AZAZAZ' . $user_id));
        setcookie('auth_hash', base64_encode(sha1('OLOLOTRALALALASUPERMEGAKEY.KOTORIINIKTONEZNAET AZAZAZ' . $user_id)), time() + 60 * 60 * 24 * 14, '/');
        setcookie('authhash', $hash, time() + 60 * 60 * 24 * 14, '/');
        
        $users = User::getById($user_id);
        $users->update([
            'authhash' => $hash
        ]);
        
        return true;
    }

    /**
     * Получить пользователя по ключу
     * @param string $key
     * @return \User
     * @throws Entity_NotFoundException
     */
    public static function getByApiKey($key) {
        $sql = "select * from users where active=1 and apikey=?";

        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$key]);
        if ($stmt->rowCount() == 0) {
            throw new Entity_NotFoundException("user not found");
        }
        $row = $stmt->fetchObject();

        return (new User)->setRow($row);
    }

    /**
     * Получает юзера по почте
     * 
     * @param string $email
     * @return User
     */
    public static function getByEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        }
        $sql = "Select * from users where email=?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $row = $stmt->fetchObject();
        return (new User)->setRow($row);
    }
    
    public static function getByZC($uid) {
        $sql = "Select * from users where zaleycash_id=?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$uid]);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $row = $stmt->fetchObject();
        return (new User)->setRow($row);
    }

    /**
     * Возвращает офферы для пользователя где есть доп бонус
     * @param Zakaz $zakaz
     */
    public function getByBonuses($user_id) {
        $list = array();
        $db = DB::getInstance();
        $sql = "select offers_reward from users where offers_reward != '' and id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id]);
        $row = $stmt->fetch(PDO::FETCH_COLUMN);
        $offers_awards = explode('|', trim($row));
        $offer_bonus = array();
        foreach ($offers_awards as $key => $bonus) {
            if ($bonus == '') {
                continue;
            }
            $offer_bonus[] = explode(':', trim($bonus));
        }
        if ($offer_bonus && is_array($offer_bonus)) {
            $i = 0;
            foreach ($offer_bonus as $key => $bonus) {
                $list[$i][0] = $bonus[0];
                $list[$i][1] = $bonus[1];
                $i++;
            }
        }

        return $list;
    }

    public static function getPercentSusp($user_id) {
        $sql = "select count(id) as all_zakaz from zakaz where status in (2,3) and user_id = ?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$user_id]);
        if ($stmt->rowCount() == 0) {
            return 0;
        }
        $all_ok_zakaz = $stmt->fetchColumn();

        $sql = "select count(id) as all_zakaz from zakaz where status in (2,3) and warning = 1 and user_id = ?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$user_id]);
        if ($stmt->rowCount() == 0) {
            return 0;
        }
        $all_warning_zakaz = $stmt->fetchColumn();

        $percent = round(($all_warning_zakaz * 100) / $all_ok_zakaz, 1);
        return $percent;
    }
    
    public static function findLogin($login, $user_id) {
        $login = htmlentities($login);
        
        $sql = "Select id, login, avatar from users where chatMe = 1 and id != ? and login LIKE ?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$user_id, '%'.$login.'%']);
        if ($stmt->rowCount() == 0) {
            return null;
        }
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $list = [];
        foreach ($row as $user) {
            $list[] = [
                'login' => $user->login,
                'avatar' => $user->avatar,
                'id' => $user->id,
            ];
        } 
        return $list;
    }

}
