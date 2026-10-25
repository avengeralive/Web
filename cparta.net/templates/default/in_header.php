<?
if ($user_active == 0) {
    if ($user_tip == '10') {
        Header('Location: tg://resolve?domain=@CpartaWebbot&start='.$user_id);
    }
    else if ($user_tip == '40') {
        Header('Location: tg://resolve?domain=@CpartaRek_bot&start='.$user_id);
    }
}
// if ($user_tip == 70){
    $id = $_SESSION['id'];
    $QQ = "SELECT * FROM `users` WHERE `id` = '$id' ";
    $res = DB::Query($QQ);
    $res_data = $res->fetch_assoc();
    if ($res_data['agreement'] == '0'){
        header("Location: ./politica.php");
    }
// }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="Самая серьезная партнерская сеть">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="./templates/<?php echo $template; ?>/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="./templates/<?php echo $template; ?>/css/styles-login.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-favicon.png"/>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="./templates/<?php echo $template; ?>/js/jquery-3.3.1.min.js"></script>
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
    <link href="./templates/<?php echo $template; ?>/lib/noty-3.2.0/noty.css" rel="stylesheet">
    <script src="./templates/<?php echo $template; ?>/lib/noty-3.2.0/noty.min.js" type="text/javascript"></script>
    
    <link rel="stylesheet" href="./templates/<?php echo $template; ?>/lib/noty-3.2.0/themes/nest.css"/>
    <link rel="stylesheet" href="./templates/<?php echo $template; ?>/lib/animate.css"/>    
    <script src="./templates/<?php echo $template; ?>/js/firebase.js"></script>
    <script src="./templates/<?php echo $template; ?>/js/firebase-main.js"></script>
    <script src="./templates/<?php echo $template; ?>/js/main.js"></script>
</head>
<body class="mb-0">
    <div class="container-fluid">
        <?php
        if (isset($_SESSION['adm'])) {
            ?>
            <div style="position:fixed;top:0px;right:0px;z-index: 100000;">	
                <a href="http://cparta.net/?alout&hash=<?php echo md5($_SESSION['adm'] . 'autologin123123'); ?>" style="display: block;padding:10px;background: #1c76a9;color:#fff;font-weight:bold;" href="">Вернуться в адм.</a>
            </div>
            <?php
        }
        ?>

            <div class="left-panel main-menu p-0 mt-20">
                
                <?php
                $count_mess = Messanger::getCountNew($user_id);
                // Меню левое
                include './templates/' . $template . '/roles_pages/' . $user_tip . '/main_menu.php';
                ?>

            </div>
            <div class="main-content  p-0">
                
                <?php
                // Блок с верхним горизонтальное меню
                // Block the upper horizontal menu
                include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php';
                ?>
                <div class="wrap">



