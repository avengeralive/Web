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
        <style>
            .closed .logohref {
                display: none;
            }
  .closed .menu a {
    visibility: hidden;
  }
  .closed {
    width: 40px;
    padding: 0px;
  }
  .closed .menu {
    padding-left: 10px;
  }
  .closed li {
    width: 40px;
    height: 52px;
  }
  .closed a:before {
    visibility: initial;
  }
  .closed .fi {
    margin-top: 116px;
  }
  .closed+main {
    width: calc(100% - 50px);
    margin-left: 50px;
  }
  .closed .logolink {
    display: none;
  }
  .closed+main>div:nth-child(1) {
    width: calc(100% - 50px);
  }
  .flowtable th:last-child{
    width: 130px;
  }
</style>
    </head>
    <body class="mb-0">
        <header>
            <a class="logohref" style="width: 80%;float:left;" href="./"><img src="/land/img/logo.png" alt="" style="width:70%;"></a>
            <a style="width: 20%;float:left;    padding-left: 10px;
    padding-top: 30px; color: #fff;" class="nav-header nav-link" href="javascript:void(0)" onclick="$('header').toggleClass('closed');"><i class="fa fa-bars"></i></a>
            <ul class="menu">
                <li><a <?php if (in_array(curr_file(), ['cabinet.php', 'profile.php'])) { ?>class="active"<?php } ?> href="./cabinet.php">Кабинет</a></li>
                <li><a <?php if (in_array(curr_file(), ['zakaz.php'])) { ?>class="active"<?php } ?> href="./zakaz.php">Заказы</a></li>
                <li><a <?php if (in_array(curr_file(), ['stats.php'])) { ?>class="active"<?php } ?> href="./stats.php">Статистика</a></li>
                <li><a <?php if (in_array(curr_file(), ['streams.php'])) { ?>class="active"<?php } ?> href="./streams.php">Потоки</a></li>
                <li><a <?php if (in_array(curr_file(), ['offers.php'])) { ?>class="active"<?php } ?> href="./offers.php">Офферы</a></li>
                <li><a <?php if (in_array(curr_file(), ['finances.php'])) { ?>class="active"<?php } ?> href="./finances.php">Финансы</a></li>
                <li><a <?php if (in_array(curr_file(), ['tools.php'])) { ?>class="active"<?php } ?> href="./tools.php">Инструменты</a></li>
                <?php if ($user_refprogram) { ?>
                <li><a <?php if (in_array(curr_file(), ['referals.php'])) { ?>class="active"<?php } ?> href="./referals.php">Реферальная система</a></li>
                <?php } ?>
                <!--<li><a <?php if (in_array(curr_file(), ['tickets.php'])) { ?>class="active"<?php } ?> href="./tickets.php">Поддержка</a></li>-->
                <li><a <?php if (in_array(curr_file(), ['news.php'])) { ?>class="active"<?php } ?> href="./news.php">Новости</a></li>
                <li><a <?php if (in_array(curr_file(), ['help.php'])) { ?>class="active"<?php } ?> href="./help.php">FAQ</a></li>
                
                <li><hr></li>
                <li><a class="active" href="./logout.php">Выход</a></li>
                <?php if (isset($_SESSION['adm'])) { ?>
                    <li><a href="/?alout&hash=<?php echo md5($_SESSION['adm'] . 'autologin123123'); ?>" style="color: #000;">Вернуться в адм.</a></li>
                <?php } ?>
            </ul>
        </header>
    <!--<div class="container-fluid">
        <?php
        if (isset($_SESSION['adm'])) {
            ?>
            <div style="position:fixed;top:0px;right:0px;z-index: 100000;">	

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



