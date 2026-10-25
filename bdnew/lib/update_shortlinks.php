<?php

// Блок с добавлением короткой ссылки в базу
// Adding a short link to the database
if (isset($_POST['submit_shortlinks']) && $user_tip == '10') {
    if (isset($_POST['link']) && $_POST['link'] != '') {
        $sql_check_kolvo = "SELECT COUNT('id') as kolvo FROM `shortlinks` WHERE `user_id`='$user_id'";
        $result_check_kolvo = $mysqli->query($sql_check_kolvo);
        $res_check_kolvo = mysqli_fetch_assoc($result_check_kolvo);
        if ($res_check_kolvo['kolvo'] < $settings_account_max_shortlinks) {
            $link = htmlentities($_POST['link']);
            $alt = htmlentities($_POST['alt']);
            $sql_add_shortlink = "INSERT INTO `shortlinks`(`user_id`,`link`,`alt`) VALUES ('$user_id','$link','$alt')";
            $result_add_shortlink = $mysqli->query($sql_add_shortlink);
            header('location:' . $_SERVER['PHP_SELF'] . '?xtext=3');
            exit;
        } else {
            header('location:' . $_SERVER['PHP_SELF'] . '?xtext=1');
            exit;
        }
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=2');
        exit;
    }
}

// Блок с удалением короткой ссылки из базы
// Remove the short link from the database
if (isset($_GET['delete']) && $_GET['delete'] != '') {
    // Проверяем, есть ли указаннная ссылка в базе
    // Check if the link is in the database
    $shortlink_id = htmlentities($_GET['delete']);
    $sql_check_shortlink = "SELECT * FROM shortlinks WHERE `user_id`='$user_id' AND `id`='$shortlink_id'";
    $result_check_shortlink = $mysqli->query($sql_check_shortlink);
    if (mysqli_num_rows($result_check_shortlink) > 0) {
        $sql_delete_shortlink = "DELETE from shortlinks WHERE `user_id`='$user_id' AND `id`='$shortlink_id'";
        $result_delete_shortlink = $mysqli->query($sql_delete_shortlink);
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=4');
        exit;
    } else {
        header('location:' . $_SERVER['PHP_SELF'] . '?xtext=5');
        exit;
    }
}
?>
