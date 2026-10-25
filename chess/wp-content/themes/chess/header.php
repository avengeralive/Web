<!DOCTYPE html>
<html lang="ru" data-ng-app="website">
    <head>
        <meta charset="utf-8">
        <title><? wp_title(); ?></title>
        <link rel="shortcut icon" href="<? echo get_field('favicon', 2); ?>">
        <link rel="canonical" href="<? echo get_site_url(); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <? wp_head(); ?>
        <link rel="stylesheet" href="/wp-content/themes/chess/css/assets.min.css">
        <link href="http://allfont.ru/allfont.css?fonts=mon-amour-two-medium" rel="stylesheet" type="text/css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i');
            @font-face {
                font-family: 'Mon Amour Two Medium';
                src: url('/wp-content/themes/chess/fonts/mon-amour-two-medium_[allfont.ru].ttf');
            }
            @font-face {
                font-family: 'Bikham Cyr Script';
                src: url('/wp-content/themes/chess/fonts/bikham-cyr-script_[allfont.ru].ttf');
            }
            @font-face {
                font-family: 'Algeria One';
                src: url('/wp-content/themes/chess/fonts/11895.ttf');
            }
        </style>
        <link rel="stylesheet" href="/wp-content/themes/chess/style.css">
    </head>
    <body <? body_class(); ?>>
        <div class="page">
            <header id="section-header" class="header moto-section" data-widget="section" data-container="section">
                <div class="moto-widget moto-widget-block moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" data-widget="block" data-spacing="aaaa">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="moto-cell col-sm-12" data-container="container">
                                <div class="moto-widget moto-widget-container moto-container_header_5937baa13" data-widget="container" data-container="container" data-css-name="moto-container_header_5937baa13" data-moto-sticky="{ }">
                                    <div class="moto-widget moto-widget-row row-fixed moto-justify-content_center moto-spacing-top-small moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto nopddg" data-grid-type="sm" data-widget="row" data-spacing="sasa">
                                        <div class="container-fluid">
                                            <div class="row" data-container="container">
                                                <div class="moto-widget moto-widget-row__column moto-cell col-xs-8 col-sm-2" data-widget="row.column" data-bgcolor-class="" data-container="container">
                                                    <div data-widget-id="wid__image__5b029378b5e79" class="moto-widget moto-widget-image moto-preset-default  moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto  " data-widget="image">
                                                        <a class="moto-widget-image-link moto-link" href="/"   data-action="page">
                                                            <img data-src="<? echo get_field('logo', 2); ?>" class="moto-widget-image-picture logo1 lazyload" data-id="155" title="" alt="">
                                                            <img data-src="<? echo get_field('logo2', 2); ?>" class="moto-widget-image-picture logo2 lazyload" data-id="155" title="" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="moto-widget moto-widget-row__column moto-cell menublc col-xs-4 col-sm-10" data-widget="row.column" data-bgcolor-class="" data-container="container">
                                                    <div data-widget-id="wid__menu__5b029378ce75e" class="moto-widget moto-widget-menu moto-preset-default moto-align-right moto-align-center_mobile-h moto-spacing-top-small moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto" data-preset="default" data-widget="menu">
                                                        <a href="#" class="moto-widget-menu-toggle-btn"><i class="moto-widget-menu-toggle-btn-icon fa fa-bars"></i></a>
                                                        <ul class="moto-widget-menu-list moto-widget-menu-list_horizontal">
                                                            <? $menu = get_menu_array('Главное меню');
                                                            foreach ($menu as $element) { ?>
                                                            <li class="moto-widget-menu-item">
                                                                <a href="<? echo $element->url; ?>" data-action="page" class="moto-widget-menu-link moto-widget-menu-link-level-1 <!--moto-widget-menu-link-active--> moto-link"><? echo $element->title; ?></a>
                                                                <? if ($element->child_elements) { ?>
                                                                <ul class="moto-widget-menu-sublist">
                                                                <? foreach ($element->child_elements as $sub_element) { ?>
                                                                    <li class="moto-widget-menu-item">
                                                                        <a href="<? echo $sub_element->url; ?>" data-action="page" class="moto-widget-menu-link moto-widget-menu-link-level-2 moto-link"><? echo $sub_element->title; ?></a>
                                                                    </li>
                                                                <? } ?>
                                                                </ul>
                                                                <? } ?>
                                                            </li>
                                                            <? } ?>
															<?php pll_the_languages(array('show_flags'=>1,'show_names'=>0)); ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
            </header>