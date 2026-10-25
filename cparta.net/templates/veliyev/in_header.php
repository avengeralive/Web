<?
if ($user_active == 0) {
    if ($user_tip == '10') {
        Header('Location: tg://resolve?domain=@CpartaWebbot&start='.$user_id);
    }
    else if ($user_tip == '40') {
        Header('Location: tg://resolve?domain=@CpartaRek_bot&start='.$user_id);
    }
}

$id = $_SESSION['id'];
    $QQ = "SELECT * FROM `users` WHERE `id` = '$id' ";
    $res = DB::Query($QQ);
    $res_data = $res->fetch_assoc();
    if ($res_data['agreement'] == '0'){
        header("Location: ./politica.php");
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/a2fd2fc03d.js"></script>
        <link rel="stylesheet" href="./templates/veliyev/fonts/stylesheet.css">
        <link rel="stylesheet" href="./templates/veliyev/css/style_new.css">


        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="Самая серьезная партнерская сеть">
        <title><?php echo $page_title; ?></title>
        <!--<link rel="stylesheet" href="./templates/<?php echo $template; ?>/css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link href="./templates/<?php echo $template; ?>/css/styles-login.css" rel="stylesheet">-->
        <link rel="icon" type="image/png" href="/favicon.png" />
        <link rel="apple-touch-icon-precomposed" href="/apple-touch-favicon.png"/>
        
        
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        
        <link href="./templates/<?php echo $template; ?>/lib/noty-3.2.0/noty.css" rel="stylesheet">
        <link rel="stylesheet" href="./templates/<?php echo $template; ?>/lib/noty-3.2.0/themes/nest.css"/>
        <link rel="stylesheet" href="./templates/<?php echo $template; ?>/lib/animate.css"/>  
        
        <script src="./templates/<?php echo $template; ?>/lib/noty-3.2.0/noty.min.js" type="text/javascript"></script> 
        <script src="./templates/<?php echo $template; ?>/js/firebase.js"></script>
        <script src="./templates/<?php echo $template; ?>/js/firebase-main.js"></script>
        <script src="./templates/<?php echo $template; ?>/js/main.js"></script>
    </head>
    <body class="mb-0">
        <header>
            <a href="./cabinet.php"><img src="./img/logo.jpg"></a>
            <a href="#" class="mobmenu"><i class="fas fa-bars"></i></a>
            <ul class="menu">
                <li><a <? if (in_array(curr_file(), ['cabinet.php', 'profile.php'])) { ?>class="active"<? } ?> href="./cabinet.php">Кабинет</a></li>
                <li><a <? if (in_array(curr_file(), ['zakaz.php'])) { ?>class="active"<? } ?> href="./zakaz.php">Заказы</a></li>
                <li><a <? if (in_array(curr_file(), ['stats.php'])) { ?>class="active"<? } ?> href="./stats.php">Статистика</a></li>
                <li><a <? if (in_array(curr_file(), ['streams.php'])) { ?>class="active"<? } ?> href="./streams.php">Потоки</a></li>
                <li><a <? if (in_array(curr_file(), ['offers.php'])) { ?>class="active"<? } ?> href="./offers.php">Офферы</a></li>
                <li><a <? if (in_array(curr_file(), ['finances.php'])) { ?>class="active"<? } ?> href="./finances.php">Финансы</a></li>
                <li><a <? if (in_array(curr_file(), ['tools.php'])) { ?>class="active"<? } ?> href="./tools.php">Инструменты</a></li>
                <li><a <? if (in_array(curr_file(), ['tickets.php'])) { ?>class="active"<? } ?> href="./tickets.php">Поддержка</a></li>
                <li><a <? if (in_array(curr_file(), ['help.php'])) { ?>class="active"<? } ?> href="./help.php">FAQ</a></li>
                <li><hr></li>
                <li><a class="active" href="./logout.php">Выход</a></li>
                <?php if (isset($_SESSION['adm'])) { ?>
                    <li><a href="http://cparta.net/?alout&hash=<?php echo md5($_SESSION['adm'] . 'autologin123123'); ?>" style="color: #f00;">Вернуться в адм.</a></li>
                <?php } ?>
            </ul>
        </header>
    <!--<div class="container-fluid">
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
                //include './templates/' . $template . '/roles_pages/' . $user_tip . '/main_menu.php';
                ?>

            </div>
            <div class="main-content  p-0">
                
                <?php
                // Блок с верхним горизонтальное меню
                // Block the upper horizontal menu
                //include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php';
                ?>
                <div class="wrap">-->



