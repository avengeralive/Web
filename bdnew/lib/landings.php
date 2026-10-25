<?php

// Блок с добавлением нового лендинга в базу (если пользователь - АДМИНИСТРАТОР)
// Block with the addition of the new Landing at the base (if the user - ADMIN)
if (isset($_POST['submit_addlanding']) && ( $user_tip == '70' || $user_tip == '20' || $user_tip == '90' || $user_tip == '110')) {
    if ((isset($_POST['name']) && $_POST['name'] != '') && (isset($_POST['url']) && $_POST['url'] != '') && (isset($_POST['offer_id']) && $_POST['offer_id'] != '')) {
        $name = htmlentities($_POST['name']);
        $url = htmlentities($_POST['url']);
        $offer_id = htmlentities($_POST['offer_id']);

        $sql_getowner = "SELECT owner_id FROM offers WHERE `id`='$offer_id'";
        $result_getowner = $mysqli->query($sql_getowner);
        $type = 0;
        $type = htmlentities($_POST['type']);
        if (mysqli_num_rows($result_getowner) > 0) {
            $res_getowner = mysqli_fetch_array($result_getowner);
            $owner_id = htmlentities($res_getowner['owner_id']);
            $request = "INSERT INTO `landings`(`type`, `name`,`url`,`offer_id`,`owner_id`) VALUES ('$type', '$name','$url','$offer_id','$owner_id')";
            $result = $mysqli->query($request);
            Events::trigger(Events::EVENT_LANDING_NEW, $offer_id);
            header('location:' . $_SERVER['PHP_SELF'] . '?xtext=1');
            exit;
        }
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=2');
        exit;
    }
}

// Блок с удалением лендинга из базы (если пользователь - АДМИНИСТРАТОР)
// Block Landing with removal from the database (if the user - ADMIN)
if (isset($_GET['delete']) && $_GET['delete'] != '' && $user_tip == '70' || $user_tip == '20' || $user_tip == '90' || $user_tip == '110') {
    $id_landing = htmlentities($_GET['delete']);
    $sql = "SELECT * FROM landings WHERE `id`='$id_landing'";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $request = "DELETE from landings WHERE `id`='$id_landing'";
        $result = $mysqli->query($request);
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=3');
        exit;
    }
}

// Блок с добавлением нового лендинга в базу (если пользователь - РЕКЛАМОДАТЕЛЬ)
// Block with the addition of the new Landing at the base (if the user - advertisers)
if (isset($_POST['submit_addlanding']) && $user_tip == '40') {
    if ((isset($_POST['name']) && $_POST['name'] != '') && (isset($_POST['url']) && $_POST['url'] != '') && (isset($_POST['offer_id']) && $_POST['offer_id'] != '')) {
        $name = htmlentities($_POST['name']);
        $url = htmlentities($_POST['url']);
        $offer_id = htmlentities($_POST['offer_id']);

        $sql_getowner = "SELECT owner_id FROM offers WHERE `id`='$offer_id'";
        $result_getowner = $mysqli->query($sql_getowner);
        if (mysqli_num_rows($result_getowner) > 0) {
            $res_getowner = mysqli_fetch_array($result_getowner);
            $owner_id = htmlentities($res_getowner['owner_id']);
            // Если текущий пользователь действительно является владельцем оффера к которому добавляется лендинг, то добавляем лендинг в базу
            // If the current user is the owner really offera to which is added Landing, then add the database Landing
            if ($owner_id == $user_id) {
                // Если не превышено максимально возможное количество лендингов на один оффер у рекла, то разрешаем добавить лендинг
                // If you do not exceed the maximum possible number of Landing for one offer from advertisements, it is permissible to add the Landing
                $sql_account_count_landings = "SELECT id FROM landings WHERE `owner_id`='$user_id' AND `offer_id`='$offer_id'";
                $result_account_count_landings = $mysqli->query($sql_account_count_landings);
                if (mysqli_num_rows($result_account_count_landings) >= $settings_account_max_landings) {
                    header('location:' . $_SERVER['PHP_SELF'] . '?xtext=4');
                    exit;
                } else {
                    $request = "INSERT INTO `landings`(`name`,`url`,`offer_id`,`owner_id`) VALUES ('$name','$url','$offer_id','$owner_id')";
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