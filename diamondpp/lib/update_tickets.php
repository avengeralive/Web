<?php

// Если был запрос на создание нового тикета, то выполняем
// If there was a request to create a new ticket, then execute

$post = new Request($_POST);
if (isset($post->rate, $post->id) && User::isAuth()) {
    // check
    $uid = User::isAuth();
    $stmt = "select ticket_id from tickets_reply where id=?";
    $stmt = DB::getInstance()->prepare($stmt);
    $stmt->execute([ $post->id]);
    if ($stmt->rowCount() == 0) {
        exit("404");
    }
    $ticketId = $stmt->fetchColumn();

    $sql = "select 1 from tickets where id=$ticketId and (ot_kogo=? or komu=?)";
    $stmt = DB::getInstance()->prepare($sql);
    $stmt->execute([ $uid, $uid]);
    if ($stmt->rowCount() == 0) {
        exit("404-2");
    }
    $rate = $post->rate;
    if ($rate != 1 && $rate != -1) {
        exit("e2");
    }
    $sql = "update tickets_reply set rate=" . $rate . " where id=" . intval($post->id);
    DB::getInstance()->query($sql);
    DB::getInstance()->query("update tickets set rate=rate+" . $rate . " where id=" . $ticketId);
    exit;
}
if (isset($_POST['form_tickets_submit'])) {
    if (isset($_POST['theme']) && $_POST['theme'] != '') {
        if (isset($_POST['text']) && $_POST['text'] != '') {
            $theme = htmlentities($_POST['theme']);
            $text = htmlentities($_POST['text']);
            if (isset($_POST['komu']) && $_POST['komu'] != '') {
                $komu = htmlentities($_POST['komu']);
                $sql_ticket_add = "INSERT INTO `tickets` (`ot_kogo`,`komu`,`theme`,`text`,`status`) VALUES ('$user_id','$komu','$theme','$text','1')";
            } else {
                $sql_ticket_add = "INSERT INTO `tickets` (`ot_kogo`,`theme`,`text`,`status`) VALUES ('$user_id','$theme','$text','1')";
            }


            $result_ticket_add = $mysqli->query($sql_ticket_add);
            $ticket_id = $mysqli->insert_id;
            Events::trigger(Events::EVENT_TICKET_NEW, $ticket_id);

            $sql = "SELECT email FROM users WHERE `id` = '$user_id' LIMIT 1";
            $result = $mysqli->query($sql);
            $res = mysqli_fetch_array($result);
            $us_email = $res['email'];

            // Отправка E-mail
            // Sending E-mail
            $mail_subj = 'Обращение в тех.поддержку';
            $mail_body1 = 'В системе создан тикет номер ' . $ticket_id . ' от вебмастера ID ' . $user_id . ', время создания тикета - ' . date('d.m.Y H:i:s', time());
            $mail_body2 = 'Добрый день!<br /><br />Благодарим Вас за обращение в службу технической поддержки BD CPA.<br />Мы получили ваш тикет номер ' . $ticket_id . ' и ваш личный менеджер Александр свяжется с Вами в ближайшее время<br /><br /><br />С уважением, служба поддержки BD CPA';
            $from_email = "info@avaleads.pro";
            $mail_headers = '';
            $mail_headers .= "MIME-Version: 1.0\r\n";
            $mail_headers .= "Content-type: text/html; charset=utf-8\r\n";
            $mail_headers .= "From: $from_email\r\n";
            $mail_headers .= "Reply-To: $from_email\r\n";
            $mail_headers .= "Return-Path: $from_email\r\n";
            $mail_headers .= "X-Mailer: PHP/" . phpversion();

            $sender = Mailing_Sender::getDefaultSender();
            $letter = new Mailing_Letter;
            $letter->setSubject($mail_subj);
            $letter->setTo($settings_email);
            $letter->setHtml($mail_body1);
            //$sender->send($letter);


            $sender = Mailing_Sender::getDefaultSender();
            $letter = new Mailing_Letter;
            $letter->setSubject($mail_subj);
            $letter->setTo($us_email);
            $letter->setHtml($mail_body2);
            //$sender->send($letter);

            header('location:' . $_SERVER['PHP_SELF'] . '?xtext=1');
            exit;
        } else {
            header('location:' . $_SERVER['PHP_SELF'] . '?xtext=3');
            exit;
        }
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=2');
        exit;
    }
}

// Если был запрос на создание ответа на тикет, то выполняем
// If there was a request to create a response to the ticket, then the
if (isset($_POST['form_ticket_reply_submit']) && isset($_POST['ticket_id'])) {
    $ticket_id = htmlentities($_POST['ticket_id']);

    // Проверяем, есть ли тикет, ID которого был передан в POST-запросе
    // Check if the ticket is, whose ID was passed to the POST-request
    if ($user_tip == '70' or $user_tip == '80') {
        $mysqli->query("update tickets set `status_new` = '1' where `id` = '$ticket_id'");
        $res_check_ticket = $mysqli->query("SELECT `id` FROM `tickets` WHERE `id`='$ticket_id'");
    } else {
        $res_check_ticket = $mysqli->query("SELECT `id` FROM `tickets` WHERE `komu`='$user_id' OR (`ot_kogo`='$user_id' AND `id`='$ticket_id')");
    }
    if (mysqli_num_rows($res_check_ticket) <> 0) {
        if (isset($_POST['text']) && $_POST['text'] != '') {
            $text = htmlentities($_POST['text']);
            $sql_ticket_add = "INSERT INTO `tickets_reply` (`ticket_id`,`ot_kogo`,`text`) VALUES ('$ticket_id','$user_id','$text')";

            $sql = "SELECT email FROM users WHERE `id` = '$user_id' LIMIT 1";
            $result = $mysqli->query($sql);
            $res = mysqli_fetch_array($result);
            $us_email = $res['email'];

            // Отправка E-mail
            // Sending E-mail
            $mail_subj = 'Ответ на тикет';
            $mail_body1 = 'Поступил ответ на тикет №' . $ticket_id . ' от вебмастера ID ' . $user_id . ', время ответа - ' . date('d.m.Y H:i:s', time());
            $mail_body2 = 'Добрый день!<br /><br />На Ваш тикет №' . $ticket_id . ' поступил ответ от службуы технической поддержки BD CPA.<br />Прочитать ответ <a target="_blank" href="https://avaleads.pro/tickets.php?ticket=' . $ticket_id . '">https://avaleads.pro/</a><br /><br /><br />С уважением, служба поддержки BD CPA';
            $from_email = "info@avaleads.pro";
            $mail_headers = '';
            $mail_headers .= "MIME-Version: 1.0\r\n";
            $mail_headers .= "Content-type: text/html; charset=utf-8\r\n";
            $mail_headers .= "From: $from_email\r\n";
            $mail_headers .= "Reply-To: $from_email\r\n";
            $mail_headers .= "Return-Path: $from_email\r\n";
            $mail_headers .= "X-Mailer: PHP/" . phpversion();

            Events::trigger(Events::EVENT_TICKET_REPLY_NEW, $ticket_id);
            if ($user_tip == '70' or $user_tip == '80') {

                $sender = Mailing_Sender::getDefaultSender();
                $letter = new Mailing_Letter;
                $letter->setSubject($mail_subj);
                $letter->setTo($us_email);
                $letter->setHtml($mail_body2);
                //$sender->send($letter);
            } else {
                $sender = Mailing_Sender::getDefaultSender();
                $letter = new Mailing_Letter;
                $letter->setSubject($mail_subj);
                $letter->setTo($settings_email);
                $letter->setHtml($mail_body1);
                //$sender->send($letter);
            }

            $result_ticket_add = $mysqli->query($sql_ticket_add);
            if (!isset($_GET['xtext'])) {
                $add_stroka = '&xtext=7';
            } else {
                $add_stroka = '';
            }
            header('location:' . $_SERVER['HTTP_REFERER'] . $add_stroka);
            exit;
        } else {
            if (!isset($_GET['xtext'])) {
                $add_stroka = '&xtext=3';
            } else {
                $add_stroka = '';
            }
            header('location:' . $_SERVER['HTTP_REFERER'] . $add_stroka);
            exit;
        }
    } else {
        if (!isset($_GET['xtext'])) {
            $add_stroka = '&xtext=8';
        } else {
            $add_stroka = '';
        }
        header('location:' . $_SERVER['HTTP_REFERER'] . $add_stroka);
        exit;
    }
}

// Если был запрос на закрытие тикета, то выполняем
// If there was a request to close the ticket, then the
if (isset($_GET['close']) && $_GET['close'] != '') {
    $close_ticket = htmlentities($_GET['close']);
    // Проверяем, действительно ли пославший запрос является автором данного тикета или имеет право на его удаление
    // Check if the sent request is indeed the author of the ticket, or has the right to its removal
    if ($user_tip == '70' or $user_tip == '80') {
        $res_check_ticket = $mysqli->query("SELECT `id` FROM `tickets` WHERE `id`='$close_ticket'");
    } else {
        $res_check_ticket = $mysqli->query("SELECT `id` FROM `tickets` WHERE (`ot_kogo`='$user_id' OR `komu`='$user_id') AND `id`='$close_ticket'");
    }
    if (mysqli_num_rows($res_check_ticket) <> 0) {
        $sql_update_ticket = "UPDATE `tickets` SET `status`='0' WHERE `id`='$close_ticket'";
        $result_update_ticket = $mysqli->query($sql_update_ticket);
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=4');
        exit;
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=6');
        exit;
    }
}

// Если был запрос на открытие тикета, то выполняем
// If there was a request to open a ticket, then the
if (isset($_GET['open']) && $_GET['open'] != '') {
    $open_ticket = htmlentities($_GET['open']);
    // Проверяем, действительно ли пославший запрос является автором данного тикета или имеет право на его открытие
    // Check if the sent request is indeed the author of the ticket, or has the right to its opening
    if ($user_tip == '70' or $user_tip == '80') {
        $res_check_ticket = $mysqli->query("SELECT `id` FROM `tickets` WHERE `id`='$open_ticket'");
    } else {
        $res_check_ticket = $mysqli->query("SELECT `id` FROM `tickets` WHERE (`ot_kogo`='$user_id' OR `komu`='$user_id') AND `id`='$open_ticket'");
    }
    if (mysqli_num_rows($res_check_ticket) <> 0) {
        $sql_update_ticket = "UPDATE `tickets` SET `status`='1' WHERE `id`='$open_ticket'";
        $result_update_ticket = $mysqli->query($sql_update_ticket);
        header('location:' . $_SERVER['PHP_SELF'] . '?closed&xtext=5');
        exit;
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=6');
        exit;
    }
}
?>
