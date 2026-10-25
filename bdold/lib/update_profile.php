<?php
if (isset($_REQUEST['push'], $_REQUEST['token'])) {
    if ($_REQUEST['push'] == 'save') {
        $u = User::getById($user_id);
        $user = $u;
        $u->update(['push' => $_REQUEST['token']]);        
    }
    exit;
}

// Если была передана форма активация аккаунта профиля
// If the form is activated the account was transferred Profile
if (isset($_REQUEST['tele'], $_REQUEST['telehash'])) {
    if (md5($_REQUEST['tele'] . "tele333") == $_REQUEST['telehash']) {
        $u = User::getById($user_id);
        $u->update(['telegram' => $_REQUEST['tele']]);
        $u->sendTelegram("Все получилось! Дай пять \xE2\x9C\x8B" . PHP_EOL . "Теперь можешь использовать комманды!");
    }
    Header('Location: ./profile.php?success');
    exit;
}
if (isset($_POST['profile_activation_submit']) && isset($_POST['activation_code'])) {
    $activation_code = htmlentities($_POST['activation_code']);
    $sql_checkactivationcode = "SELECT activation_code FROM users WHERE `id` = '$user_id'";
    $result_checkactivationcode = $mysqli->query($sql_checkactivationcode);
    $res_checkactivationcode = mysqli_fetch_array($result_checkactivationcode);

    if ($activation_code == $res_checkactivationcode['activation_code']) {
        // Активация аккаунта
        // Account activation
        $deystvie = '7';
        include_once './includes/userslog/index.php';
        $sql_activate_account = "UPDATE users SET active = '1' WHERE id = $user_id";
        $mysqli->query($sql_activate_account);

        if ($user_tip == '10') {
            $user_tip_info = $loc['profile.php']['t50'];
        } elseif ($user_tip == '40') {
            $user_tip_info = $loc['profile.php']['t51'];
        }

        if (($settings_notice_regwebmaster == '1' && $user_tip == '10') || ($settings_notice_regreklamodatel == '1' && $user_tip == '40')) {
            $mail_subj = domain() . ': ' . $loc['profile.php']['t43'] . ' ' . $user_tip_info;
            $mail_body = $loc['profile.php']['t44'] . '<br /><br />' . $loc['profile.php']['t45'] . '&nbsp;' . $user_tip_info . ':&nbsp;<b>' . $user_email . '<br /><br />' . $loc['profile.php']['t46'] . '&nbsp;' . domain() . '<br /><a href="' . site_url() . '">' . site_url() . '</a>';
            if ($settings_notice_email != '') {
                $to_email = $settings_notice_email;
                SendEMail($to_email, $mail_subj, $mail_body);
                $mail_sended = true;
            } else {
                $sql_userdata = "SELECT email FROM users WHERE `tip`='70' AND `active`='1'";
                $result_userdata = $mysqli->query($sql_userdata);
                if (mysqli_num_rows($result_userdata) > 0) {
                    while ($res_userdata = mysqli_fetch_array($result_userdata)) {
                        $to_email = htmlentities($res_userdata['email']);
                        SendEMail($to_email, $mail_subj, $mail_body);
                        $mail_sended = true;
                    }
                }
            }
        }

        Header('Location: ./cabinet.php');
        exit;
    } else {
        $errortext_profile = '<font color=red>' . $loc['profile.php']['t47'] . '</font>';
    }
}

// Если была передана форма изменения профиля
// If the form has been transferred Profile changes
if (isset($_POST['action']) && $_POST['action'] == 'save_events') {
    $events_email = 0;
    $events_telegram = 0;
    $events_push = 0;
    if (isset($_POST['events_email'])) {
        foreach ($_POST['events_email'] as $i => $null) {
            $events_email = $events_email | intval($i);
        }
    }
    if (isset($_POST['events_telegram'])) {
        foreach ($_POST['events_telegram'] as $i => $null) {
            $events_telegram = $events_telegram | intval($i);
        }
    }
    if (isset($_POST['events_push'])) {
        foreach ($_POST['events_push'] as $i => $null) {
            $events_push = $events_push | intval($i);
        }
    }
    $u = User::getById($user_id);
    $u->update([
        'events_email' => $events_email,
        'events_push' => $events_push,
        'events_telegram' => $events_telegram,
    ]);
    Header('Location: ./profile.php?success');

    exit;
}
if (isset($_POST['profile_rekvizit_submit'])) {
    // Проверяем, есть ли в базе пользователь пославший запрос на изменение профиля
    // Check whether there is a basis of the user who sent the request to change the profile
    $sql = "SELECT id FROM users WHERE `id` = '$user_id'";
    $res = $mysqli->query($sql);
    $result = $res->fetch_assoc();
    if ((int) $result['id']) {
        if (isset($_POST['profile_wmr'])) {
            $profile_wmr = htmlentities($_POST['profile_wmr']);
        } else {
            $profile_wmr = '';
        }
        if (isset($_POST['profile_name'])) {
            $profile_name = htmlentities($_POST['profile_name']);
        } else {
            $profile_name = '';
        }
        if (isset($_POST['profile_phone'])) {
            $profile_phone = htmlentities($_POST['profile_phone']);
        } else {
            $profile_phone = '';
        }
        if (isset($_POST['profile_skype'])) {
            $profile_skype = htmlentities($_POST['profile_skype']);
        } else {
            $profile_skype = '';
        }
        if (isset($_POST['profile_icq'])) {
            $profile_icq = htmlentities($_POST['profile_icq']);
        } else {
            $profile_icq = '';
        }
        if (isset($_POST['profile_login'])) {
            $profile_login = htmlentities($_POST['profile_login']);
        } else {
            $profile_login = '';
        }
        // Пишем в базу данные о посетителе и о том, что он инициировал изменение данных профиля
        // Список действий ($deystvie):
        // 1 - Посещение страницы
        // 2 - Регистрация
        // 3 - Авторизация
        // 4 - Неудачная авторизация					
        // 5 - Смена реквизитов
        // 6 - Смена пароля доступа
        // Write in the visitor data base and that he initiated the change in the profile data
        // Action List ($deystvie):
        // 1 - Visiting the page
        // 2 - Registration
        // 3 - Authorization
        // 4 - Authorization Failed
        // 5 - Change details
        // 6 - Change the access password		

        $deystvie = '5';
        include_once './includes/userslog/index.php';
        $notify = 0;
        if (isset($_POST['notify']))
            $notify = 1;
        $sql_smena_rekvizitov = "UPDATE users SET notify=$notify, wmr = '$profile_wmr', name = '$profile_name', login = '$profile_login', phone = '$profile_phone', skype = '$profile_skype', icq = '$profile_icq' WHERE id = $user_id";
        $mysqli->query($sql_smena_rekvizitov);
        Header('Location: ./profile.php?success');
        exit;
    } else {
        Header('Location: ./logout.php');
        exit;
    }
}

// Если была передана форма изменения пароля доступа
// If the form was given to change the access password
if (isset($_POST['profile_changepassword_submit'])) {
    // Проверяем, есть ли в базе пользователь пославший запрос на изменение пароля доступа
    // Check whether there is a basis of the user who sent the request to change the access password
    $sql = "SELECT id,password FROM users WHERE `id` = '$user_id'";
    $res = $mysqli->query($sql);
    $result = $res->fetch_assoc();
    if ((int) $result['id']) {
        if ((isset($_POST['profile_password_1']) && $_POST['profile_password_1'] != '') && (isset($_POST['profile_password_2']) && $_POST['profile_password_2'] != '')) {
                        
            $password = $mysqli->real_escape_string(htmlspecialchars(md5(md5($_POST['old_password']))));
            if($password == $result['password']){
            

                $profile_password_1 = htmlentities($_POST['profile_password_1']);
                $profile_password_2 = htmlentities($_POST['profile_password_2']);
                if ($profile_password_1 == $profile_password_2) {
                    // шифруем пароль
                    // Encrypt the password
                    $profile_password_1 = md5(md5($profile_password_1));

                    // Пишем в базу данные о посетителе и о том, что он инициировал смену пароля
                    // Список действий ($deystvie):
                    // 1 - Посещение страницы
                    // 2 - Регистрация
                    // 3 - Авторизация
                    // 4 - Неудачная авторизация					
                    // 5 - Смена реквизитов
                    // 6 - Смена пароля доступа
                    // Write in the visitor data base and that he initiated the change password
                    // Action List ($deystvie):
                    // 1 - Visiting the page
                    // 2 - Registration
                    // 3 - Authorization
                    // 4 - Authorization Failed
                    // 5 - Change details
                    // 6 - Change the access password				

                    $deystvie = '6';
                    include_once './includes/userslog/index.php';
                    $sql_smena_parola = "UPDATE users SET password = '$profile_password_1' WHERE id = $user_id";
                    $mysqli->query($sql_smena_parola);
                    Header('Location: ./profile.php?successpasswd');
                    exit;
                } else {
                    $errortext_profile = $loc['profile.php']['t48'];
                }
            } else {
                $errortext_profile = 'Старый пароль указан неверно!';
            }
        } else {
            $errortext_profile = $loc['profile.php']['t49'];
        }
    } else {
        Header('Location: ./logout.php');
        exit;
    }
}
?>