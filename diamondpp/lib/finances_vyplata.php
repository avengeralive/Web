<?php

// Блок с обновлением статуса выплаты на "отказ в выплате"
// Block to update the payment status to "failure to pay"
if ((isset($_GET['ne_vyplata']) && $_GET['ne_vyplata'] != '') && (isset($_GET['user']) && $_GET['user'] != '') && $user_tip == '70') {
    $ne_vyplata_id = htmlentities($_GET['ne_vyplata']);
    $polzovatel_id = htmlentities($_GET['user']);

    // Определяем есть ли в базе пользователь, кому НЕ будет выплаты а также размер выплаты
    // Determine whether there is a basis of a user who is not paying as well as the size of the payment
    $sql_r = "SELECT user_id,summ FROM finances_log WHERE `description`='4' AND `id`='$ne_vyplata_id' AND `user_id`='$polzovatel_id' AND `status`='1'";
    $result_r = $mysqli->query($sql_r);
    if (mysqli_num_rows($result_r) > 0) {
        $res_r = mysqli_fetch_array($result_r);

        // Назначаем переменную для суммы выплаты
        // Assign a variable for payout
        $summ = htmlentities($res_r['summ']);

        // Определяем текущий баланс пользователя
        // Define the user's current balance
        $sql_balanceuser = "SELECT balance FROM users WHERE `id`='$polzovatel_id'";
        $result_balanceuser = $mysqli->query($sql_balanceuser);
        $res_balanceuser = mysqli_fetch_array($result_balanceuser);
        $balanceuser = htmlentities($res_balanceuser['balance']);

        // Изменяем статус заявки на "НЕ ВЫПЛАЧЕНО (ОТКАЗ)". СРЕДСТВА ВОЗВРАЩАЮТСЯ НА БАЛАНС ПОЛЬЗОВАТЕЛЯ.
        // Change the status of the application "are not paid (failure)". Funds are returned to the user's balance.
        $request22 = "UPDATE finances_log SET `status`='3' WHERE `description`='4' AND `id`='$ne_vyplata_id' AND `user_id`='$polzovatel_id' AND `status`='1'";
        $result22 = $mysqli->query($request22);
        $request22 = "INSERT INTO finances_log (`user_id`, `operation`, `summ`,`description`,`balance`,`status`) VALUES ('$polzovatel_id', '1', '$summ','10','$balanceuser'+'$summ','2')";
        $result22 = $mysqli->query($request22);
        $request22 = "UPDATE users SET `balance`='$balanceuser'+'$summ' WHERE `id`='$polzovatel_id'";
        $result22 = $mysqli->query($request22);
        header('location:' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Блок с обновлением статуса выплаты на "выплата осуществлена"
// Block to update the payment status to "payment was made"
if ((isset($_GET['ok_vyplata']) && $_GET['ok_vyplata'] != '') && (isset($_GET['user']) && $_GET['user'] != '') && $user_tip == '70') {
    // Назначаем переменные
    // Assign variables
    $vyplata_id = htmlentities($_GET['ok_vyplata']);
    $polzovatel_id = htmlentities($_GET['user']);

    // Определяем есть ли пользователь, кому будет выплата а также размер выплаты
    // Determine if the user is, who will be the payment and payout
    $sql_r = "SELECT user_id,summ FROM finances_log WHERE `description`='4' AND `id`='$vyplata_id' AND `user_id`='$polzovatel_id' AND `status`='1'";
    $result_r = $mysqli->query($sql_r);
    if (mysqli_num_rows($result_r) > 0) {
        // Изменяем статус заявки на "ВЫПЛАЧЕНО"
        // Change the status of the application on the "PAID"
        $request22 = "UPDATE finances_log SET `status`='2' WHERE `description`='4' AND `id`='$vyplata_id' AND `user_id`='$polzovatel_id' AND `status`='1'";
        $result22 = $mysqli->query($request22);
        Events::trigger(Events::EVENT_MONEY_OUT_CONFIRM, $vyplata_id);
        header('location:' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Блок с обновлением статуса выплаты (выплата осуществлена, MASSPAYMENT)
// Unit with updating the status of payment (payment was made, MASSPAYMENT)
if (isset($_GET['masspay']) && $_GET['masspay'] == 'success' && $user_tip == '70') {
    // Изменяем статус ВСЕХ заявок на "ВЫПЛАЧЕНО"
    // Change the status of all requests for "PAID"
    $sql = "select id from finances_log where status=1 and description=4";
    $stmt = DB::getInstance()->query($sql);
    while ($row = $stmt->fetchObject()) {
        Events::trigger(Events::EVENT_MONEY_OUT_CONFIRM, $row->id);
    }
    $sql_paysuccess = "UPDATE finances_log SET `status`='2' WHERE `description`='4' AND `status`='1'";
    $result_paysuccess = $mysqli->query($sql_paysuccess);
    header('location:' . $_SERVER['PHP_SELF']);
    exit;
}
?>