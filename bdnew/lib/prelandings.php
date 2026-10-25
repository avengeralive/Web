<?php

// Блок с добавлением нового прелендинга в базу (если пользователь - АДМИНИСТРАТОР)
// Block with the addition of the new prelanding at the base (if the user - ADMIN)
if (isset($_POST['submit_addprelanding']) && ( $user_tip == '70' || $user_tip == '20' )) {
    if ((isset($_POST['name']) && $_POST['name'] != '') && (isset($_POST['url']) && $_POST['url'] != '') && (isset($_POST['offer_id']) && $_POST['offer_id'] != '')) {
        $name = htmlentities($_POST['name']);
        $url = htmlentities($_POST['url']);
        $offer_id = htmlentities($_POST['offer_id']);

        $sql_getowner = "SELECT owner_id FROM offers WHERE `id`='$offer_id'";
        $result_getowner = $mysqli->query($sql_getowner);
        if (mysqli_num_rows($result_getowner) > 0) {
            $res_getowner = mysqli_fetch_array($result_getowner);
            $owner_id = htmlentities($res_getowner['owner_id']);
            $request = "INSERT INTO `prelandings`(`name`,`url`,`offer_id`,`owner_id`) VALUES ('$name','$url','$offer_id','$owner_id')";
            $result = $mysqli->query($request);
            Events::trigger(Events::EVENT_PRELANDING_NEW, $offer_id);
            header('location:' . $_SERVER['PHP_SELF'] . '?xtext=1');
            exit;
        }
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=2');
        exit;
    }
}

// Блок с удалением прелендинга из базы (если пользователь - АДМИНИСТРАТОР)
// Block prelanding with removal from the database (if the user - ADMIN)
if (isset($_GET['delete']) && $_GET['delete'] != '' && $user_tip == '70' || $user_tip == '20') {
    $id_prelanding = htmlentities($_GET['delete']);
    $sql = "SELECT * FROM prelandings WHERE `id`='$id_prelanding'";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $request = "DELETE from prelandings WHERE `id`='$id_prelanding'";
        $result = $mysqli->query($request);
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=3');
        exit;
    }
}

// Блок с добавлением нового прелендинга в базу (если пользователь - РЕКЛАМОДАТЕЛЬ)
// Block with the addition of the new prelanding at the base (if the user - advertisers)
if (isset($_POST['submit_addprelanding']) && $user_tip == '40') {
    if ((isset($_POST['name']) && $_POST['name'] != '') && (isset($_POST['url']) && $_POST['url'] != '') && (isset($_POST['offer_id']) && $_POST['offer_id'] != '')) {
        $name = htmlentities($_POST['name']);
        $url = htmlentities($_POST['url']);
        $offer_id = htmlentities($_POST['offer_id']);

        $sql_getowner = "SELECT owner_id FROM offers WHERE `id`='$offer_id'";
        $result_getowner = $mysqli->query($sql_getowner);
        if (mysqli_num_rows($result_getowner) > 0) {
            $res_getowner = mysqli_fetch_array($result_getowner);
            $owner_id = htmlentities($res_getowner['owner_id']);
            // Если текущий пользователь действительно является владельцем оффера к которому добавляется прелендинг, то добавляем прелендинг в базу
            // If the current user is the owner really offer to which is added prelanding, then add the database prelanding
            if ($owner_id == $user_id) {
                // Если не превышено максимально возможное количество прелендингов на один оффер у рекла, то разрешаем добавить прелендинг
                // If you do not exceed the maximum possible number of prelanding for one offer from advertisements, it is permissible to add the prelanding
                $sql_account_count_prelandings = "SELECT id FROM prelandings WHERE `owner_id`='$user_id' AND `offer_id`='$offer_id'";
                $result_account_count_prelandings = $mysqli->query($sql_account_count_prelandings);
                if (mysqli_num_rows($result_account_count_prelandings) >= $settings_account_max_prelandings) {
                    header('location:' . $_SERVER['PHP_SELF'] . '?xtext=4');
                    exit;
                } else {
                    $request = "INSERT INTO `prelandings`(`name`,`url`,`offer_id`,`owner_id`) VALUES ('$name','$url','$offer_id','$owner_id')";
                    $result = $mysqli->query($request);
                    header('location:' . $_SERVER['PHP_SELF'] . '?xtext=1');
                    exit;
                }
            }
        }
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=2');
        exit;
    }
}
?>