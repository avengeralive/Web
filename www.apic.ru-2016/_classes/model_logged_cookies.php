<?
/**
*  ice@rusklimat.ru
*  —ергей «а€рный 
*/

class model_logged_cookies{

var $logged = false;
var $perm_level = false;
var $user = false;

	// 26.07.2004 added
var $id = false;
var $login = false;
	// 26.07.2004 added


function model_logged_cookies($m, $LOGGED_SECRET_KEY) {
	$this->m = &$m;
	$this->LOGGED_SECRET_KEY = $LOGGED_SECRET_KEY;
	}


// основыва€сь на полном шаманстве, IP адресе и строке идентификации браузера мы генерируем уникальную строчку.
function get_key() {
		global $HTTP_SERVER_VARS;
        $timestamp = time();
		srand ((double) microtime() * 1000000);
        $key = md5(uniqid(rand(1000, 9999), true));
        $crc = abs(crc32($timestamp.$key.$HTTP_SERVER_VARS["HTTP_USER_AGENT"].$_SERVER["REMOTE_ADDR"].$this->LOGGED_SECRET_KEY));
        return array(
			'timestamp'=>$timestamp,
			'key'=>$key,
			'full_key'=>dechex($timestamp)."-".$key."-".dechex($crc)
			);
        }

// провер€ем выданную строчку на правильность формата и то что ей пользуетс€ тот же самый браузер и IP адрес что и должен 
function check_key($s){
	global $HTTP_SERVER_VARS;
	if (eregi("[A-Za-z0-9]{6,10}-[A-Za-z0-9]{28,34}-[A-Za-z0-9]{6,10}", $s)) {
		list($timestamp, $key, $crc) = explode("-", $s);
		$timestamp = hexdec($timestamp);
		$crc = hexdec($crc);
    	if ($crc == abs(crc32($timestamp.$key.$HTTP_SERVER_VARS["HTTP_USER_AGENT"].$_SERVER["REMOTE_ADDR"].$this->LOGGED_SECRET_KEY))) {
				return Array(
					'status'=>true,
					'key'=>$key	,
					'full_key'=>$s
					);
        	};
		};
	return Array('status'=>false, 'full_key'=>$s);
	}



// смотрим в базу на предмет есть ли така€ сесси€
function is_logged($s) {
	$ss = $this->check_key($s);
	if (!$ss["status"]) {
		return Array('status'=>false);
		};

	$q = "
	SELECT
		lo.id as session_id,
		lo.user_id,
		us.id,
		us.user_name,
		us.login,
		us.email,
		us.subscribe_status,
		us.phone,
		us.city_id,
		us.address
	FROM
		".MYSQL_DB.".logged   as lo
	LEFT JOIN
		".MYSQL_DB.".user_card as us
	ON 
		us.id = lo.user_id
	WHERE
		lo.skey = '#key#'
		AND
			lo.logged = 'Y'
		";

	$r = $this->m->selectOneRow($q, __FILE__, __LINE__, 
        Array(
			'key'=>$ss["key"]
            )
        );
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	$logged = ( $this->m->rows > 0 );

    if (!$logged) {
        return Array('status'=>false);
        };

    return Array(
        'status'=>true, 
		'user'=>$r,
		'key'=>$ss['key']
        );
	}



// вобще то эту фукцию никто не использует -)
function get_user_by_session($sp) {
	$q = "
	SELECT
		lo.id as session_id,
		lo.user_id,
		us.*
	FROM
		".MYSQL_DB.".logged   as lo
	LEFT JOIN
		".MYSQL_DB.".user_card as us
	ON 
		us.id = lo.user_id
	WHERE
		lo.skey = '#key#'
		";

	$r = $this->m->selectOneRow($q, __FILE__, __LINE__, 
        Array(
			'key'=>$sp
            )
        );
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	$logged = ( $this->m->rows > 0 );

    if (!$logged) {
        return Array('status'=>false);
        };

    return Array(
        'status'=>true, 
		'user'=>$r
        );
	}



// логиним пользовател€ и записываем в Ѕƒ строчку
function set_logged($s, $user_id) {
	global $HTTP_SERVER_VARS;
	$ss = $this->check_key($s);
	if (!$ss["status"]) {
		return Array('status'=>false);
		};

	$q = "
	INSERT
		".MYSQL_DB.".logged
	SET
		skey = '#key#',
		created = NOW(),
		updated = NOW(),
		user_id = '#user_id#',
		logged = 'Y',
		HTTP_USER_AGENT = '#HTTP_USER_AGENT#',
		HTTP_HOST = '#HTTP_HOST#'
		";
	$r = $this->m->query($q, __FILE__, __LINE__, 
    	Array(
			"key"=>$ss["key"],
			"user_id"=>$user_id,
			"HTTP_USER_AGENT" => $HTTP_SERVER_VARS["HTTP_USER_AGENT"],
			"HTTP_HOST" => $_SERVER["REMOTE_ADDR"]
			)
		);
   if ($this->m->error ) {
       return Array('status'=>false);
       };

	$this->logged = true;
	$this->user_id = $user_id;

	setcookie('JSESSIONID',   $ss["full_key"],     time()+666006, '/');

   return Array(
       'status'=>true
       );
	}



function set_logout($key){
	$q = "
	UPDATE
		".MYSQL_DB.".logged
	SET
		logged = 'N'
	where
		skey = '#key#'
		";
	$r = $this->m->query($q, __FILE__, __LINE__, 
    	Array(
			"key"=>$key
			)
		);
   if ($this->m->error ) {
       return Array('status'=>false);
       };

	setcookie('JSESSIONID',    '', time()-666006, '/');

   return Array(
       'status'=>true
       );
	}




}
?>