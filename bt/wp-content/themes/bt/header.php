<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><? wp_title(); ?></title>
    <meta name="theme-color" content="">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!--link(rel="shortcut icon" href="<? echo get_template_directory_uri(); ?>/img/favicons/favicon-16x16.png" type="image/x-icon")-->
    <!--styles for all pages-->
    <link rel="stylesheet" href="<? echo get_template_directory_uri(); ?>/styles/libs.min.css">
    <link rel="stylesheet" href="<? echo get_template_directory_uri(); ?>/styles/common.min.css">
    <? wp_head(); ?>
  </head>
  <body>
    <div class="header">
      <div class="container">
        <div class="header__container">
          <div class="logo"><a class="logo__link" href="/"><img class="logo__image" src="<? echo get_template_directory_uri(); ?>/img/logos/logo.png" alt=""></a></div>
          <nav class="nav sl--scrollable">
            <ul class="nav__list">
              <li class="nav__item"><a class="nav__link" href="#about">Компания</a></li>
              <li class="nav__item"><a class="nav__link" href="#services">Услуги</a></li>
              <li class="nav__item"><a class="nav__link" href="#gallery">Мероприятия</a></li>
              <li class="nav__item"><a class="nav__link" href="#partners">Партнеры</a></li>
              <li class="nav__item"><a class="nav__link" href="#clients">Клиенты</a></li>
              <li class="nav__item"><a class="nav__link" href="#contacts">Контакты</a></li>
            </ul>
          </nav><a class="mobile-button" href="#"><span></span></a><span class="overlay"></span>
        </div>
      </div>
    </div>