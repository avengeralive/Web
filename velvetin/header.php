<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">     
        <title><? wp_title(); ?></title>
        <? wp_head(); ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?=get_template_directory_uri();?>/fonts/stylesheet.css">
        <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/animate.css">
        <link rel="stylesheet" href="<?=get_template_directory_uri();?>/style.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/09c41664d7.js"></script>
        <script src="<?=get_template_directory_uri();?>/js/owl.carousel.min.js"></script>
        <script src="<?=get_template_directory_uri();?>/js/script.js"></script>
    </head>
    <body <?=body_class();?>>
        <div class="menu-overlay">
            <div class="menu-popup">
                <a class="menu-close"><img src="<?=get_template_directory_uri();?>/images/close.svg"></a>
                <ul class="block-menu">
                <? $menu = get_menu_array('Боковое меню');
                foreach ($menu as $element) { ?>
                    <li>
                        <a href="<? echo $element->url; ?>" <? if (count($element->child_elements)) { ?>class="opensub"<? } ?>><? echo $element->title; ?> <? if (count($element->child_elements)) { ?><img src="<?=get_template_directory_uri();?>/images/chevron_right.svg" class="inarrow"><? } ?></a>
                        <? if (count($element->child_elements)) { ?>
                        <ul class="sub">
                            <li><a class="menu-skip"><img src="<?=get_template_directory_uri();?>/images/back.svg"></a> <? echo $element->title; ?></li>
                            <? foreach ($element->child_elements as $sub_element) { ?>
                            <li>
                                <a href="<? echo $sub_element->url; ?>" <? if (count($sub_element->child_elements)) { ?>class="opensubsub"<? } ?>><? echo $sub_element->title; ?> <? if (count($sub_element->child_elements)) { ?><img src="<?=get_template_directory_uri();?>/images/chevron_right.svg" class="inarrow trns90"><? } ?></a>
                                <? if (count($sub_element->child_elements)) { ?>
                                <ul class="subsub">
                                <? foreach ($sub_element->child_elements as $sub_sub_element) { ?>
                                <li>
                                    <a href="<? echo $sub_sub_element->url; ?>"><? echo $sub_sub_element->title; ?></a>
                                </li>
                                <? } ?>
                                </ul>
                                <? } ?>
                            </li>
                            <? } ?>
                        </ul>
                        <? } ?>
                    </li>
                <? } ?>
                </ul>
            </div>
        </div>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-2 col-lg-4 alc">
                        <a href="#" class="burger"><img src="<?=get_template_directory_uri();?>/images/menu.svg"></a>
                    </div>
                    <div class="col-1 mob">
                        <a href="/search/"><i class="fas fa-search"></i></a>
                    </div>
                    <div class="col-6 col-lg-4 text-center">
                        <a href="/" class="logo"><img src="<?=get_field('logo', 225); ?>" style="width: 135px;"></a>
                    </div>
                    <div class="col-1 mob">
                        <a href="/favorite"><img src="<?=get_template_directory_uri();?>/images/fav.svg"> <? if (get_fav_count()) { ?><span class="favcnt"><? echo get_fav_count(); ?></span><? } ?></a>
                    </div>
                    <div class="col-1 mob">
                        <a href="/cart"><img src="<?=get_template_directory_uri();?>/images/cart.svg"> <? if (WC()->cart->get_cart_contents_count()) { ?><span class="cartcnt"><? echo WC()->cart->get_cart_contents_count(); ?></span><? } ?></a>
                    </div>
                    <div class="col-1 mob">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div class="col-lg-4 text-right phones">
                        <a href="tel:+78005510515">+7 800 551 05 15</a><br><a href="tel:+79255243828">+7 925 524 38 28</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-2">

                    </div>
                    <div class="col-lg-10 col-xl-8 catalog-menu">
                        <ul>
                        <? $menu = get_menu_array('Горизонтальное меню');
                        foreach ($menu as $element) { ?>
                            <li>
                                <a href="<? echo $element->url; ?>"><? echo $element->title; ?></a>
                                <? if ($element->child_elements) { ?>
                                <ul class="sub">
                                    <? foreach ($element->child_elements as $sub_element) { ?>
                                    <li>
                                        <a href="<? echo $sub_element->url; ?>"><? echo $sub_element->title; ?></a>
                                    </li>
                                    <? } ?>
                                </ul>
                                <? } ?>
                            </li>
                        <? } ?>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-xl-2 addmenublock">
                        <ul class="addmenu">
                            <li><a href="/search/"><img src="<?=get_template_directory_uri();?>/images/search.svg"></a></li>
                            <li><a href="/favorite"><img src="<?=get_template_directory_uri();?>/images/fav.svg"> <? if (get_fav_count()) { ?><span class="favcnt"><? echo get_fav_count(); ?></span><? } ?></a></li>
                            <li><a href="/cart"><img src="<?=get_template_directory_uri();?>/images/cart.svg"> <? if (WC()->cart->get_cart_contents_count()) { ?><span class="cartcnt"><? echo WC()->cart->get_cart_contents_count(); ?></span><? } ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>