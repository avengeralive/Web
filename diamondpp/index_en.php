<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL & ~E_NOTICE);

// Открываем сессию
// Open session
session_set_cookie_params(60*60*24*30, '/');
session_start();

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_not_login.php';

if(isset($_GET['al'], $_GET['hash'], $_GET['id']) && md5($_GET['id'].'autologin123123')==$_GET['hash'] && !isset($_GET['adm'])){
	$sql = "SELECT a.*, b.sort FROM users a, users_roles_tpl b WHERE a.id = ".$_GET['id']." AND b.tip = a.tip";
    $res = $mysqli->query($sql);
    $result = $res->fetch_assoc();

    $sql = "SELECT a.*, b.sort FROM users a, users_roles_tpl b WHERE a.id = ".$_GET['adm']." AND b.tip = a.tip";
    $res = $mysqli->query($sql);
    $result2 = $res->fetch_assoc();

    if ($result['sort'] > $result2['sort']) {
		User::setAuth($_GET['id']);
		$_SESSION['id'] = $_GET['id'];
	        if(isset($_GET['balance'])){
	            header("Location:/finances.php");
	        }else{
	            header("Location:/cabinet.php");
	        }
		
	        
		exit;
	}
	else header("Location:/logout.php");
}

if(isset($_GET['al'], $_GET['adm'], $_GET['hash'], $_GET['id']) && md5($_GET['id'].'autologin123123')==$_GET['hash']){
	$sql = "SELECT a.*, b.sort FROM users a, users_roles_tpl b WHERE a.id = ".$_GET['id']." AND b.tip = a.tip";
    $res = $mysqli->query($sql);
    $result = $res->fetch_assoc();

    $sql = "SELECT a.*, b.sort FROM users a, users_roles_tpl b WHERE a.id = ".$_GET['adm']." AND b.tip = a.tip";
    $res = $mysqli->query($sql);
    $result2 = $res->fetch_assoc();

    if ($result['sort'] > $result2['sort']) {
		User::setAuth($_GET['id']);
		$_SESSION['id'] = $_GET['id'];
		$_SESSION['adm'] = $_GET['adm'];
		header("Location:/cabinet.php");
		exit;
	}
	else header("Location:/logout.php");
}
if(isset($_GET['alout'], $_GET['hash'],$_SESSION['adm']) && md5($_SESSION['adm'].'autologin123123')==$_GET['hash']){
	User::setAuth($_SESSION['adm']);
	$_SESSION['id'] = $_SESSION['adm'];
	unset($_SESSION['adm']);
	header("Location:/cabinet.php");
	exit;
}

// Обработка ситуации при которой был запрос на регистрацию нового пользователя
// Processing of the situation in which there was a request for the registration of a new user
//include './lib/register_new_user.php';

// Обработка ситуации при которой было был запрос на авторизацию пользователя
// Processing of the situation in which it was was a request for user authentication
//include './lib/login_user.php';

// Пишем в базу данные о посетителе
// Write in the visitor data base
include_once './includes/userslog/index.php';

// Подключаем системную ТДС
// Connect system TDS
include './includes/systemtds/index.php';
	
// Подгружаем шаблон хидера
// Header template loaded
//$template = 'veliyev';
include './templates/'.$template.'/header.php';

// Подгружаем шаблон контента страницы
// Loads the page content template
include './templates/'.$template.'/'.curr_file();

// Подгружаем шаблон футера
// Loads the footer template
include './templates/'.$template.'/footer.php';

?>