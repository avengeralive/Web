<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Администрирование</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="style.css?1">
    <!-- endinject -->
    <link rel="shortcut icon" href="favicon.png" />

    <!-- plugins:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="off-canvas.js"></script>
    <script src="hoverable-collapse.js"></script>
    <script src="template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- End custom js for this page-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>

    <script src="https://dadata.ru/static/js/lib/jquery.suggestions-15.2.min.js"></script>
    <link href="https://suggestions.dadata.ru/suggestions/libs/jquery.suggestions/15.7/css/suggestions.css" type="text/css" rel="stylesheet" />


</head>

<body>
<div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <span class="nav-profile-name"><?= $_SESSION['user']['name']; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="?action=logout">
                            <i class="mdi mdi-logout text-primary"></i>
                            Выход
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid page-body-wrapper">

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="?section=index">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">Главная</span>
                    </a>
                </li>

                <?php if (in_array($_SESSION['user']['role'], ['admin'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?section=orders">
                        <i class="mdi mdi-dropbox menu-icon"></i>
                        <span class="menu-title">Заказы</span>
                    </a>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['admin'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?section=excel">
                        <i class="mdi mdi-dropbox menu-icon"></i>
                        <span class="menu-title">Загрузить из файла</span>
                    </a>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['admin', 'rop'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?section=schedule">
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                        <span class="menu-title">График</span>
                    </a>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['admin'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?section=managers">
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                        <span class="menu-title">Менеджеры</span>
                    </a>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['admin'])) { ?>
                <li class="nav-item">
                    <div class="nav-link">
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                        <span class="menu-title">Товарные остатки</span>
                    </div>
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="?section=stock&account_id=2"> AvaMed24 </a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['admin', 'report', 'rop'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?section=reports">
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                        <span class="menu-title">Отчеты</span>
                    </a>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['admin', 'developer'])) {  ?>
                    <li class="nav-item">
                        <div class="nav-link">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title">Почта России</span>
                        </div>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="?section=rp_shipment"> Отгрузка </a></li>
                            <li class="nav-item"> <a class="nav-link" href="?section=rp_orders"> Заказы </a></li>
                            <li class="nav-item"> <a class="nav-link" href="?section=rp_batches"> Партии </a></li>
                            <li class="nav-item"> <a class="nav-link" href="?section=rp_accounts"> Аккаунты </a></li>
                        </ul>
                    </li>
                <?php } ?>


                <?php if (in_array($_SESSION['user']['role'], ['admin', 'developer'])) {  ?>
                    <li class="nav-item">
                        <div class="nav-link">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title">Наложенный платеж</span>
                        </div>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="?section=cod_orders&delivered=1"> Заказы </a></li>
                            <li class="nav-item"> <a class="nav-link" href="?section=cod_file"> Файл платежей </a></li>
                        </ul>
                    </li>
                <?php } ?>


                <?php if (in_array($_SESSION['user']['role'], ['admin'])) { ?>
                <li class="nav-item">
                    <div class="nav-link">
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                        <span class="menu-title">WhatsApp</span>
                    </div>
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="?section=whatsapp_shops"> Магазины </a></li>
                        <li class="nav-item"> <a class="nav-link" href="?section=whatsapp_messages"> Сообщения </a></li>
                        <li class="nav-item"> <a class="nav-link" href="?section=whatsapp_settings"> Настройки </a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['admin'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?section=settings">
                        <i class="mdi mdi-settings menu-icon"></i>
                        <span class="menu-title">Настройки</span>
                    </a>
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="?section=settings_leads_costs"> Стоимость лидов </a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if (in_array($_SESSION['user']['role'], ['developer'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?section=settings">
                        <i class="mdi mdi-settings menu-icon"></i>
                        <span class="menu-title">Настройки</span>
                    </a>
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="?section=settings_leads_costs"> Стоимость лидов </a></li>
                    </ul>
                </li>
                <?php } ?>

            </ul>
        </nav>

        <div class="main-panel">
            <div class="content-wrapper">
