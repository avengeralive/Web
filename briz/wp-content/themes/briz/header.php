<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><? wp_title(); ?></title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<? echo get_template_directory_uri(); ?>/styles/libs.min.css">
    <link rel="stylesheet" href="<? echo get_template_directory_uri(); ?>/styles/common.min.css">
    <link rel="shortcut icon" href="<? echo get_template_directory_uri(); ?>/img/favicon.png" type="image/png">
    <? wp_head(); ?>
  </head>
  <body>
    <div class="wrapper">
      <header class="header">
        <div class="container">
          <div class="header__container">
            <div class="logo"><a class="logo__link" href="/"><img class="logo__image" src="<? echo get_template_directory_uri(); ?>/img/logos/logo.png" alt=""></a></div>
            <div class="mobile-button"><span></span></div>
            <nav class="nav">
              <ul class="nav__list nav__list_left">
                <? $menu = wp_get_nav_menu_items('Main left'); ?>
                <? foreach ($menu as $elem) { ?>
                <li class="nav__item"><a class="nav__link" href="<? echo $elem->url; ?>"><? echo $elem->title; ?></a></li>
                <? } ?>
              </ul>
              <ul class="nav__list nav__list_right">
                <? $menu = wp_get_nav_menu_items('Main right'); ?>
                <? foreach ($menu as $elem) { ?>
                <li class="nav__item"><a class="nav__link" href="<? echo $elem->url; ?>"><? echo $elem->title; ?></a></li>
                <? } ?>
                <li class="nav__item nav__list_pcadd"><a class="nav__link" href="#">Region</a></li>
              </ul>
              <ul class="nav__list nav__list_mobileadd">
                <? $menu = wp_get_nav_menu_items('Mobile additional'); ?>
                <? foreach ($menu as $elem) { ?>
                <li class="nav__item"><a class="nav__link" href="<? echo $elem->url; ?>"><? echo $elem->title; ?></a></li>
                <? } ?>
                <li class="nav__item"><a class="nav__link" href="#">Region</a></li>
              </ul>
            </nav>
            <div class="overlay"></div>
          </div>
        </div>
      </header>
      <div class="breadcrumbs block">
              <div class="container">
                <div class="breadcrumbs__container">
                  <ul class="breadcrumbs__list"> 
                    <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/">Home</a></li>
                    <li class="breadcrumbs__item"><? the_title(); ?></li>
                  </ul>
                </div>
              </div>
            </div>