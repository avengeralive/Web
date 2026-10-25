<?php

$error_message = '';

// Если была передана форма авторизации
if (isset($_GET['autologin']) && (false !== ($uid = User::isAuth()))) {
    $_SESSION['id'] = (int) $uid;
    $deystvie = '3';
    include_once './includes/userslog/index.php';
    Header('Location: ./cabinet.php');
    exit;
}
if (isset($_POST['login_email'])) {
    $error_type = 'error';
    if (isset($_POST['login_email']) && $_POST['login_email'] != '') {
        if (preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $_POST['login_email'])) {
            if (isset($_POST['login_password']) && $_POST['login_password'] != '') {

                $email = $mysqli->real_escape_string(htmlspecialchars($_POST['login_email']));
                $password = $mysqli->real_escape_string(htmlspecialchars(md5(md5($_POST['login_password']))));

                // Проверяем, есть ли такой пользователь в базе и совпадает ли email/пароль с теми что в базе
                $sql = "SELECT id FROM users WHERE `email` = '$email' and `password` = '$password'";
                $res = $mysqli->query($sql);
                $result = $res->fetch_assoc();
                if ((int) $result['id']) {
                    $_SESSION['id'] = (int) $result['id'];
                    $user_id = $_SESSION['id'];
                    User::setAuth($user_id);

                    // Пишем в базу данные о посетителе и его успешной регистрации
                    // Список действий ($deystvie):
                    // 1 - Посещение страницы
                    // 2 - Регистрация
                    // 3 - Авторизация
                    // 4 - Неудачная авторизация					
                    // 5 - Смена реквизитов
                    // 6 - Смена пароля доступа					
                    // 6 - Change the access password
                    $deystvie = '3';
                    include_once './includes/userslog/index_old.php';
                    
                    Header('Location: ./cabinet.php');
                    
                    exit;
                } else {
                    $error_message = $loc['auth']['t14'];
                    $deystvie = '4';
                    include_once './includes/userslog/index.php';
                }
            } else {
                $error_message = $loc['auth']['t15'];
            }
        } else {
            $error_message = $loc['auth']['t16'];
        }
    } else {
        $error_message = $loc['auth']['t17'];
    }
}
?>