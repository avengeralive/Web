<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Сантехника,Сантехника в Москве,официальный сайт сантехники,Мир сантехники,Лучшая Сантехника,Цены на сантехнику,сантехники оптом,сантрейд,сантрейд сантехника");
$APPLICATION->SetPageProperty("keywords_inner", "Сантехника,Сантехника в Москве,официальный сайт сантехники,Мир сантехники,Лучшая Сантехника,Цены на сантехнику,сантехники оптом,сантрейд, сантрейд сантехника");
$APPLICATION->SetPageProperty("keywords", "Сантехника, Сантехника в Москве, Официальный сайт сантехники");
$APPLICATION->SetPageProperty("description", "Интернет Магазин сантехники Сантрейд Импорт.РУ | 10 лет на рынке | Официальный поставщик с 2009 года | Сантехника из Италии Германии и Испании | Сотни брендов, тысячи коллекций | Сантехника для дома и офиса со склада и под заказ | Доставка по Москве и России | Оптовые цены! Работаем 24/7|");
$APPLICATION->SetPageProperty("title", "Сантехника Сантрейд");
$APPLICATION->SetTitle("Сантехника Сантрейд");
?>    
        <section class="s-first">
            <div class="b-nav-catalog__wrap">
                <ul class="b-nav-catalog">
                    <li><div class="b-nav-catalog__open-catalog" id="open_catalog">Каталог товаров</div></li>
                    <? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "full_catalog2",
    array(
        "ROOT_MENU_TYPE" => "catalog",
        "MENU_CACHE_TYPE" => "Y",
        "MENU_CACHE_TIME" => "36000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "catalog",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "Y",
        "COMPONENT_TEMPLATE" => "full_catalog2"
    ),
    false,
    array(
        "ACTIVE_COMPONENT" => "Y"
    )
); ?>
                    <!--<li><span class="b-nav-catalog__link b-nav-catalog__link-more b-nav-catalog__open-catalog">Показать больше</span></li>-->
                </ul>
            </div>

            <div class="s-main-slider">
                <div class="swiper-container-main">
                    <div class="swiper-wrapper">
                        <?
        $APPLICATION->IncludeComponent("ps:ps.home_slider", ".default",
            Array(
                "CACHE_TIME" => "86400",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => ".default",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "36",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "2",
                "SECTION_ID" => 15126
            )
        );
        ?>
                    </div>
                    <div class="s-main-slider__arrows">
                        <svg version="1.1" class="main-slider-arrow main-slider-arrow-prev a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                        <g>
                            <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z
                                 M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4
                                c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                            <path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8
                                c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>
                        </g>
                        </svg>
                        <svg version="1.1" class="main-slider-arrow main-slider-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                        <g>
                            <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z
                                 M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4
                                c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                            <path d="M29.6,20l-4.5-4.8c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l2.9,3.1H12.4c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1h14.2
                                l-2.9,3.1c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l0,0l4.5-4.8C30,21,30,20.4,29.6,20z"/>
                        </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="b-grid-aside">
                <div class="b-grid-aside__profile">
                    <!--<div class="b-grid-aside__profile-item">
                        <div class="b-grid-aside__profile-icon"><img src="/local/templates/sreda2018_vstd/images/user.png" alt=""></div>
                        <div class="b-grid-aside__profile-welcome">
                            Здравствуйте <span>Дмитрий!</span>
                        </div>
                    </div>-->
                    <div class="b-grid-aside__profile-item">
                        <div class="b-grid-aside__profile-welcome">
                            Добро <span>пожаловать!</span>
                        </div>
                    </div>
                    <div class="b-grid-aside__profile-item">
                        <div class="b-grid-aside__profile-site">sreda-obitaniya.ru</div>
                    </div>
                    <div class="b-grid-aside__profile-item">
                        <a class="b-grid-aside__link-login" href="/personal/profile/">Войти</a>
                    </div>
                    <!--<div class="b-grid-aside__profile-item">
                        <span class="b-grid-aside__info-text">Войти через:</span>
                        <div class="b-grid-aside__login-icon--wrap">
                            <div class="b-grid-aside__login-icon">
                                <svg aria-hidden="true" data-prefix="fab" data-icon="vk" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-vk fa-w-18 fa-3x"><path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z" class=""></path></svg>
                            </div>
                            <div class="b-grid-aside__login-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="266.893px" height="266.895px" viewBox="0 0 266.893 266.895" enable-background="new 0 0 266.893 266.895" xml:space="preserve" class="mdl-js">
<path id="Blue_1_" fill="#3C5A99" d="M248.082,262.307c7.854,0,14.223-6.369,14.223-14.225V18.812  c0-7.857-6.368-14.224-14.223-14.224H18.812c-7.857,0-14.224,6.367-14.224,14.224v229.27c0,7.855,6.366,14.225,14.224,14.225  H248.082z"/>
<path id="f" fill="#FFFFFF" d="M182.409,262.307v-99.803h33.499l5.016-38.895h-38.515V98.777c0-11.261,3.127-18.935,19.275-18.935  l20.596-0.009V45.045c-3.562-0.474-15.788-1.533-30.012-1.533c-29.695,0-50.025,18.126-50.025,51.413v28.684h-33.585v38.895h33.585  v99.803H182.409z"/>
</svg>
                            </div>
                            <div class="b-grid-aside__login-icon">
                                <svg aria-hidden="true" data-prefix="fab" data-icon="vk" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-vk fa-w-18 fa-3x"><path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z" class=""></path></svg>
                            </div>
                            <div class="b-grid-aside__login-icon">
                                <svg aria-hidden="true" data-prefix="fab" data-icon="vk" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-vk fa-w-18 fa-3x"><path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z" class=""></path></svg>
                            </div>
                        </div>
                    </div>-->
                    <div class="b-grid-aside__registration">
                        <span class="b-grid-aside__reg-text">Новый покупатель?</span>
                        <a class="b-grid-aside__link-registration" href="/personal/profile/?register=yes">Регистрация</a>
                    </div>
                </div>
                <!--<ul class="">
                    <li class=""><a class="" href="">Мои</a></li>
                    <li><a class="" href="">Мои заказы</a></li>
                    <li><a class="" href="">Центр сообщений</a></li>
                    <li><a class="" href="">Мои желания</a></li>
                    <li><a class=" black_link" href="">Статус заказа</a></li>
                </ul>-->
            </div>
        </section>
        <div class="b-banner-five">
            <?
        $APPLICATION->IncludeComponent("ps:ps.home_slider", "matty",
            Array(
                "CACHE_TIME" => "86400",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "matty",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "46",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "2",
                "SECTION_ID" => 15126
            )
        );
        ?>
        </div>

        <section class="crazy-grid">
            <div class="crazy-grid-line">
                <h2>Посмотрите популярные категории</h2>
            </div>
            <?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "mytemp",
    array(
        "IBLOCK_TYPE_ID" => "home",
        "IBLOCK_ID" => "30",
        "BASKET_URL" => "/personal/cart/",
        "COMPONENT_TEMPLATE" => "mytemp",
        "IBLOCK_TYPE" => "catalog",
        "SECTION_ID" => 15124,
        "SECTION_CODE" => "",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "desc",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "trendFilter",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "HIDE_NOT_AVAILABLE" => "N",
        "PAGE_ELEMENT_COUNT" => "7",
        "LINE_ELEMENT_COUNT" => "3",
        "PROPERTY_CODE" => array(
            0 => "NEWPRODUCT",
            1 => "",
        ),
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_PROPERTY_CODE" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
            3 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_ORDER" => "desc",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER2" => "desc",
        "TEMPLATE_THEME" => "site",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "LABEL_PROP" => array(
            0 => "NEWPRODUCT"
        ),
        "OFFER_ADD_PICT_PROP" => "-",
        "OFFER_TREE_PROPS" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
        ),
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "Y",
        "SHOW_CLOSE_POPUP" => "N",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SEF_MODE" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_LAST_MODIFIED" => "N",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_FILTER" => "N",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRODUCT_PROPERTIES" => array(
        ),
        "OFFERS_CART_PROPERTIES" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
        ),
        "ADD_TO_BASKET_ACTION" => "ADD",
        "PAGER_TEMPLATE" => "round",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Товары",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "COMPATIBLE_MODE" => "N",
    ),
    false
);?>

            <div class="clear"></div>
        </section>
    

        <section class="second-slider">
            <div class="second-slider-line">
                <h2>Выбор покупателя</h2>
                <div class="clear"></div>
            </div>
            <div class="swiper-container-second">
                <div class="swiper-wrapper">
                    <?
        $APPLICATION->IncludeComponent("ps:ps.home_choice", "",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => ".default",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "34",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "15"
            )
        );
        ?>
                </div>
            </div>
            <div class="second-slider-arrows">
                <svg version="1.1" class="second-slider-arrow second-slider-arrow-prev a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                            <g>
                                <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z
                                     M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4
                                    c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                                <path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8
                                    c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>
                            </g>
                            </svg>
                            <svg version="1.1" class="second-slider-arrow second-slider-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                            <g>
                                <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z
                                     M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4
                                    c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                                <path d="M29.6,20l-4.5-4.8c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l2.9,3.1H12.4c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1h14.2
                                    l-2.9,3.1c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l0,0l4.5-4.8C30,21,30,20.4,29.6,20z"/>
                            </g>
                            </svg>
            </div>
            <div class="swiper-pagination"></div>
        </section>

        <section class="bubbles">
            <div class="bubbles-bg">
                <?
                CModule::IncludeModule("iblock");
        $items = CIBlockElement::GetByID(440987);
        $arItem = $items->GetNext();
    ?>
    <h2><?=$arItem["NAME"];?></h2>
    <?=$arItem["DETAIL_TEXT"];?>
 
                
            </div>
        </section>

        <section class="s-brends">
            <h2>Популярные бренды</h2>
            <div class="s-brends__list">
                <?
        $APPLICATION->IncludeComponent("ps:ps.brands", "",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => ".default",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "35",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "10"
            )
        );
        ?>
            </div>
        </section>


<?
// $text = COption::GetOptionString("askaron.settings", "UF_HOME_PREFOOTEXT");
if ($text) {
?>
    <div class="page-content">
         <script>
             $(document).ready(function () {
                $('.prefotter_text').attr('data-hei', $('.prefotter_text').height());
                $('.prefooter_showmore span').click(function (e) {
                    if (!$('.prefotter_text').is(':animated')) {
                        var hei = <?=COption::GetOptionString("askaron.settings", "UF_HOME_PREFOOHEI")?>;
                        if ($('.js-open').is(':visible')) {
                            hei = $('.prefotter_text').data('hei');
                            $('.prefooter_showmore').animate({'bottom': '10px'}, 100);
                        } else {
                            $('.prefooter_showmore').animate({'bottom': 0}, 100);
                        }
                        $('.prefotter_text').animate({'height': hei}, 300, function () {
                            $('.prefotter_text').toggleClass('closed');
                            $('.js-open').toggle();
                            $('.js-close').toggle();
                        });
                    }
                });
                $('.prefooter_showmore span:first-child').click();
            });
        </script>
        <div class="prefooter_text_box">
            <div class="prefotter_text">
                <?= $text; ?>
            </div>
            <div class="prefooter_showmore">
                <span class="js-open">Читать</span>
                <span class="js-close">Свернуть</span>
            </div>
        </div>
    </div>
<?
}

if (CModule::IncludeModule("iblock")) {
    $arFilter = array(
        "IBLOCK_ID" => 42, // инфоблок Шахматный текст
        "ACTIVE" => "Y",
        "ID" => 437213, // Префутер на главной
    );
    $dbEl = CIBlockElement::GetList(Array(), $arFilter, false, false, Array('ID', 'IBLOCK_ID', 'NAME', 'ALT_*'));
    if($obEl = $dbEl->GetNextElement()) {
        $arSect = $obEl->GetProperties();
    }
    for($cou = 1; $cou < 4; $cou++){
        $title = $pic = $alt = $text = '';
        if ($arSect['ALT_ALT_' . $cou]['VALUE']) {
            $alt = $arSect['ALT_ALT_' . $cou]['~VALUE'];
        }
        if ($arSect['ALT_TITLE_' . $cou]['VALUE']) {
            $title = '<h3>' . $arSect['ALT_TITLE_' . $cou]['~VALUE'] . '</h3>';
        }
        if ($arSect['ALT_PICTURE_' . $cou]['VALUE']) {
            $pic = '<img src="'.CFile::GetPath($arSect['ALT_PICTURE_' . $cou]['VALUE']).'" alt="' . $alt . '" title="' . $alt . '" />';
        }
        if ($arSect['ALT_TEXT_' . $cou]['VALUE']['TEXT']) {
            $text = $arSect['ALT_TEXT_' . $cou]['~VALUE']['TEXT'];
        }
        if($title || $pic || $text) {
            $descr .= '<div class="s-loft__item"><div class="s-loft__img">' . $pic . '</div><div class="s-loft__content">' . $title . $text . '</div></div>';
        }
    }
}
?>
        <section class="s-loft">
            <h2>Популярное предложение</h2>
            <div class="s-loft-wrap">
                <?= $descr; ?>
            </div>
        </section>

        <section class="design-photo">
            <h2>Категории</h2>
            <img src="../local/templates/sreda2018_vstd/images/design-photo.jpg" alt="design photo" />
            <div class="design-photo-text">
                <h3>Заказать<br>
                    дизай проект</h3>
                <p>Удивительное творение Янсена - бра из меди в форме пальмы, Франция, ранние 70-е. Maison Jansen- офис дизайна интерьера в Париже, основаный в 1880 году Жан-Анри Янсеном - голландцем по происхождению и продолжавший существовать более века, до 1989 года.</p>
                <a href="#" class="btn">Заказать проект</a>
            </div>
        </section>

        <section class="s-blog">
            <h2>Блог</h2>
            <div class="s-blog__wrap">
                <div class="s-blog__list">
                    <?
            $APPLICATION->IncludeComponent("ps:ps.home_newsblogs", ".default",
                Array(
                    "CACHE_TIME" => "86400",
                    "CACHE_TYPE" => "A",
                    "COMPONENT_TEMPLATE" => ".default",
                    "ELEMENT_SORT_FIELD" => "SORT",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "IBLOCK_ID" => "39",
                    "IBLOCK_TYPE" => "home",
                    "PAGE_ELEMENT_COUNT" => "5",
                    "SECTION_ID" => 15125
                )
            );
            ?>
                    
                </div>
            </div>
        </section>

        <div class="s-news">
            <h2>Новости</h2>
            <div class="s-news__wrap">
                <?
        $APPLICATION->IncludeComponent("ps:ps.home_newsblogs", ".default",
            Array(
                "CACHE_TIME" => "86400",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => ".default",
                "ELEMENT_SORT_FIELD" => "SORT",
                "ELEMENT_SORT_ORDER" => "asc",
                "IBLOCK_ID" => "39",
                "IBLOCK_TYPE" => "home",
                "PAGE_ELEMENT_COUNT" => "5",
                "SECTION_ID" => 15126
            )
        );
        ?>
            </div>
        </div>

        
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>