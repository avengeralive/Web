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

    public function telegram($type, $data = null){
        $token = "1097575237:AAF7nT0D7dQrHK_Vy4dD3gNaX8wjaJqfiOY";
        if($type == 1 || $type == 4 || $type == 8){
            $text = (isset($data['text'])) ? $data['text'] : $type;
            $sql = "SELECT * FROM `users` WHERE `tip` = 10 AND `events_telegram` != ''";
            $connect = DB::Query($sql);
            while($res = mysqli_fetch_assoc($connect)){
                $user = User::getById($res['id']);
                foreach (Events::$_desc as $k => $t) {
                    if(($k & $user->events_telegram) == $type){
                        // $text .= 'ID='.$res['id'].' '.$k.urlencode("\n");
                        if($res['telegram_user_id'] != 0){
                            $text = str_ireplace("<br>", "%0A", $text);
                            $chat_id = (int)$res['telegram_user_id'];
                            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
                        }
                     }
                }
            }
        }elseif($type == 32){
            $zakaz_id = (isset($data['zakaz_id'])) ? $data['zakaz_id'] : 0;
            $text = 'Ваш заказ №'.$zakaz_id.' перенесен в подтвержденные';
            if($zakaz_id != 0){
                $sql_zakaz = "SELECT * FROM `zakaz` WHERE `id` = '$zakaz_id'";
                $connect_zakaz = DB::Query($sql_zakaz);
                $result_zakaz = mysqli_fetch_assoc($connect_zakaz);
                $user_id = $result_zakaz['user_id'];
                $sql_user = "SELECT * FROM `users` WHERE `id` = '$user_id' AND `tip` = 10 AND `events_telegram` != ''";
                $connect_user = DB::Query($sql_user);
                if($connect_user){
                    $result_user = mysqli_fetch_assoc($connect_user);
                    foreach (Events::$_desc as $k => $t) {
                        if(($k & $result_user['events_telegram']) == $type){
                            if($result_user['telegram_user_id'] != 0){
                                $chat_id = (int)$result_user['telegram_user_id'];
                                $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
                            }
                        }
                        // else{
                        //     $text = "заказ №".$zakaz_id." user_id = ".$user->events_telegram." Не подписан на events_telegram = ".$type;
                        //     $chat_id = "672437343";
                        //     $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
                        //  }
                    }
                }
            }
        }elseif($type == 777){
            $text = $data['text'];
            $text = str_ireplace("<br>", "%0A", $text);
            $chat_id = "-333292529";
            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
        }
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
        //if ($stmt->rowCount() == 0) {
        //    throw new Entity_NotFoundException("user not found");
        //}
        $row = $stmt->fetchObject();
//var_dump($row); die();
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
