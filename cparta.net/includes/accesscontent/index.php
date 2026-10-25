<?php

// Записываем в переменную название текущей открытой страницы
// Write to the variable name of the current open page
$current_page = curr_file();

// Если аккаунт не активирован, то редиректим на страницу профиль (там должна произойти активация аккаунта).
// If the account is not activated, then redirect to the profile page ( there should happen account activation).
if (($user_active == '0' || $user_active == '2') && $current_page != 'profile.php') {
    Header('Location: ./profile.php');
    exit;
}

// Проверяем, имеет ли данный пользователь права открывать текущую страницу
// Check if the user has the right to open the current page
if ($user_tip == '0') {
    Header('Location: ./logout.php');
    exit;
}
$sql_access_content = "SELECT $user_tip FROM access_content WHERE `page`='$current_page' AND `$user_tip`='1'";
$result_access_content = $mysqli->query($sql_access_content);
if (mysqli_num_rows($result_access_content) == 0) {
    Header('Location: ./logout.php');
    exit;
}
?>
