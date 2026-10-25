    </div>
</section>
<!-- START menu modal window -->
<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "full_catalog",
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
        "COMPONENT_TEMPLATE" => "full_catalog"
    ),
    false,
    array(
        "ACTIVE_COMPONENT" => "Y"
    )
); ?>
<!-- END menu modal window -->
<footer>
    <div class="page">
        <div class="footer_search_block_css">
            <form class="form footer-search-form" action="/search/index.php">
                <div class="input-group input-group-footer">
                    <input id="title-search-input-footer" placeholder="Кто ищет тот..." name="q" class="input-group-field" value="" type="search">
                    <div class="input-group-button input-group-button-footer">
                        <input type="submit" class="button button-footer-find" value="НАЙДЕТ">
                    </div>
                </div>
            </form>
        </div>
        <div class="footer__wrap">
            <div class="footer__menu">
                <div class="footer-block footer-block-1">
                    <ul class="footer-ul footer-ul-1">
                        <li class="footer-li footer-li-1st footer-li-1">
                            <p class="footer-block-p-js-1">ЛИЧНЫЙ КАБИНЕТ</p>
                        </li>
                        <li class="footer-li footer-li-1">
                            <a href="/personal/">Моя информация</a>
                        </li>
                        <li class="footer-li footer-li-1">
                            <a href="/personal/favourite/">Мои избранные</a>
                        </li>
                        <li class="footer-li footer-li-1">
                            <a href="#">Подарочные карты</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-block footer-block-2">
                    <ul class="footer-ul footer-ul-1">
                        <li class="footer-li footer-li-1st footer-li-2">
                            <p class="footer-block-p-js-2">ПОМОЩЬ</p>
                        </li>
                        <li class="footer-li footer-li-2"><a href="#">Обслуживание клиентов</a></li>
                        <li class="footer-li footer-li-2"><a href="#">Вопросы и ответы</a></li>
                        <li class="footer-li footer-li-2"><a href="/about/dostavka/">Информация о доставке</a></li>
                        <li class="footer-li footer-li-2"><a href="/about/guaranii/">Возврат и обмен</a></li>
                        <li class="footer-li footer-li-2"><a href="/personal/order/">Статус заказа</a></li>
                    </ul>
                </div>
                <div class="footer-block footer-block-3">
                    <ul class="footer-ul footer-ul-1">
                        <li class="footer-li footer-li-1st footer-li-3">
                            <p class="footer-block-p-js-3">КОМПАНИЯ</p>
                        </li>
                        <li class="footer-li footer-li-3"><a href="/about/">О компании</a></li>
                        <li class="footer-li footer-li-3"><a href="/about/contacty/">Контакты</a></li>
                        <li class="footer-li footer-li-3"><a href="/infopage/vakansii/">Вакансии</a></li>
                        <li class="footer-li footer-li-3"><a href="/blog/">Блог</a></li>
                        <li class="footer-li footer-li-3"><a href="/news/">Новости</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__social">
                <div class="footer-block footer-block-4">
                    <div class="footer-block-text">
                        <p class="footer-block-4-text">МЫ В СОЦИАЛЬНЫХ СЕТЯХ</p>
                        <table class="footer-block-4-table">
                            <tbody class="footer-block-4-tbody">
                            <tr class="footer-block-4-tr">
                                <td class="footer-block-4-td"><a href="https://www.facebook.com/sredaobitaniyaVip/"><img alt="facebook" class="footer-block-4-img" src="/local/templates/sreda2018_vstd/images/footer-facebook.png"></a></td>
                                <td class="footer-block-4-td"><a href="https://ru.pinterest.com/dmgsreda/"><img alt="pinterest" class="footer-block-4-img" src="/local/templates/sreda2018_vstd/images/footer-p.png"></a></td>
                                <td class="footer-block-4-td"><a href="https://twitter.com/sredashop"><img alt="twitter" class="footer-block-4-img" src="/local/templates/sreda2018_vstd/images/footer-twitter.png"></a></td>
                            </tr>
                            <tr class="footer-block-4-tr">
                                <td class="footer-block-4-td"><a href="https://plus.google.com/u/0/106472826675463508738"><img alt="google+" class="footer-block-4-img" src="/local/templates/sreda2018_vstd/images/footer-google.png"></a></td>
                                <td class="footer-block-4-td"><a href="https://www.instagram.com/vasha_sreda_obitaniya/"><img alt="instagram" class="footer-block-4-img" src="/local/templates/sreda2018_vstd/images/footer-instagram.png"></a></td>
                                <td class="footer-block-4-td"><a href="https://www.youtube.com/channel/UCdGtgCvEX8QsMCszWvjV0ZQ"><img alt="youtube" class="footer-block-4-img" src="/local/templates/sreda2018_vstd/images/footer-youtube.png"></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</footer>
<div class="footer_copyright_block_css">
    <p class="copyright-p"><span>Сантрейд импорт</span> © Москва 2011-2018 Все права защищены.</p>
</div>
<script src="/local/templates/sreda2018_vstd/js/jquery.js"></script>
<script src="/local/templates/sreda2018_vstd/js/swiper.min.js"></script>
<script src="/local/templates/sreda2018_vstd/js/script.js"></script>
<script>
    var swiper = new Swiper('.swiper-container-main', {
        navigation: {
            nextEl: '.main-slider-arrow-next',
            prevEl: '.main-slider-arrow-prev',
        },
        loop: true,
        autoplay: 5000,
        speed: 400
    });
      var swiper2 = new Swiper('.swiper-container-second', {
        slidesPerView: 6,
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
          nextEl: '.second-slider-arrow-next',
          prevEl: '.second-slider-arrow-prev',
        },
        breakpoints: {
        576: {
        slidesPerView: 2,
        }
        }
    });



</script>

<script>
    $(document).ready(function(){


        $(window).scroll(function(){
            if ($(window).scrollTop() > 150) {
                $('.header_new--right__t').addClass('sticky');
            }
            else {
                $('.header_new--right__t').removeClass('sticky')
            }
        });

        var menu_burger = $('#burger_menu');
        var menu_close = $('#close_menu');
        var menu = $('#mobile_nav');
        var catalog = $('.b-nav-mobile__catalog');
        menu_burger.click(function() {
            menu.toggleClass('is-open');
            if ($(menu).is(".is-open") ) {
                $('html').css( "overflow-y", "hidden" );
            } else {
                $('html').css( "overflow-y", "auto" );
            }
        });
        menu_close.click(function() {
            menu.toggleClass('is-open');

            if ($(menu).is(".is-open") ) {
                $('html').css( "overflow-y", "hidden" );
            } else {
                $('html').css( "overflow-y", "auto" );
            }

        });
        var catalog_close = $('#b-nav-mobile__catalog-close');
        var nav_catalog_list = $('#nav_catalog_list');
        var list_mobile_nav = $('#list_mobile_nav');

        catalog_close.click(function() {
            nav_catalog_list.addClass('list_mobile_nav-hidden');
            list_mobile_nav.removeClass('list_mobile_nav-hidden');
            if ( $(menu).is( ".is-open" ) ) {
                $('html').css( "overflow-y", "hidden" );
            } else {
                $('html').css( "overflow-y", "auto" );
            }
        });

        catalog.click(function() {
            nav_catalog_list.removeClass('list_mobile_nav-hidden');
            list_mobile_nav.addClass('list_mobile_nav-hidden');
            if ( $(menu).is( ".is-open" ) ) {
                $('html').css( "overflow-y", "hidden" );
            } else {
                $('html').css( "overflow-y", "auto" );
            }

        });

        var site_reveal_menu = $('#site-reveal-menu');
        var open_catalog = $('#open_catalog');
        var close_catalog = $('#close_catalog');
        open_catalog.click(function() {


            site_reveal_menu.toggleClass('without-overlay');
            if ($(site_reveal_menu).is(".without-overlay") ) {
                $('#site-reveal-menu').css( "display", "block" );
            } else {
                $('#site-reveal-menu').css( "display", "none" );
            }
            if ( $(site_reveal_menu).is( ".without-overlay" ) ) {
                $('html').css( "overflow-y", "hidden" );
            } else {
                $('html').css( "overflow-y", "auto" );
            }

        });

        $('.b-nav-mobile__list-click').click(function (event) {
            $(this).children("ul").slideToggle();
            event.stopPropagation();
        });

        close_catalog.click(function() {
            site_reveal_menu.toggleClass('without-overlay');
            if ($(site_reveal_menu).is(".without-overlay") ) {
                $('#site-reveal-menu').css( "display", "block" );
            } else {
                $('#site-reveal-menu').css( "display", "none" );
            }
            if ( $(site_reveal_menu).is( ".without-overlay" ) ) {
                $('html').css( "overflow-y", "hidden" );
            } else {
                $('html').css( "overflow-y", "auto" );
            }
        });
    });
</script>

<div class="b-nav-mobile" id="mobile_nav">
    <div class="b-nav-mobile__close" id="close_menu"></div>
    <div class="b-nav-mobile__list" id="list_mobile_nav">
        <div class="b-nav-mobile__list-item"></div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Сантехника
            <ul>
                <li> <a href="/home">Аксессуары</a></li>
                <li> <a href="/home"> Банные комплексы</a></li>
                <li> <a href="/home"> Бассейны</a></li>
                <li> <a href="/home"> Биде</a></li>
                <li> <a href="/home"> Бани</a></li>
                <li> <a href="/home"> Ванны</a></li>
                <li> <a href="/home"> Ванны гидромассажные</a></li>
                <li> <a href="/home"> Душевые поддоны</a></li>
                <li> <a href="/home"> Душевые кабины</a></li>
                <li> <a href="/home"> Душевые уголки</a></li>
                <li> <a href="/home">  Зеркала</a></li>
                <li> <a href="/home">  Инсталляции</a></li>
                <li> <a href="/home">  Ледогенераторы</a></li>
                <li> <a href="/home">  Писсуары</a></li>
                <li> <a href="/home">  Парогенераторы</a></li>
                <li> <a href="/home">   Полотенцесушители</a></li>
                <li> <a href="/home">  Раковины</a></li>
                <li> <a href="/home">  Сауны</a></li>
                <li> <a href="/home">  Светильники</a></li>
                <li> <a href="/home">  Душевые лейки</a></li>
                <li> <a href="/home">  Сушилки для рук</a></li>
                <li> <a href="/home">  Сиденья табуреты</a></li>
                <li> <a href="/home">  Смесители для биде</a></li>
                <li> <a href="/home">  Смесители для кухни</a></li>
                <li> <a href="/home">  Смесители для ванной</a></li>
                <li> <a href="/home">  Смесители для душа</a></li>
                <li> <a href="/home">  Смесители для раковины</a></li>
                <li> <a href="/home">  Смесители с гигиеническим душем</a></li>
                <li> <a href="/home">  Текстиль</a></li>
                <li> <a href="/home">  Унитаз</a></li>
                <li> <a href="/home">  Хамам</a></li>
                <li> <a href="/home">  Специальная сантехника</a></li>
                <li> <a href="/home">  Изливы</a></li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Мебель
            <ul>
                <li>  Мебель для ванной</li>
                <li>  Аксессуары для дома</li>
                <li>  Комоды</li>
                <li>  Библиотеки</li>
                <li>  Гостиные</li>
                <li> Детская мебель</li>
                <li>  Диваны и кресла</li>
                <li> Домашний Бар</li>
                <li> Интерьерные зеркала</li>
                <li> Мебель для кухни</li>
                <li> Мебель для спальни</li>
                <li>  Ручки мебельные</li>
                <li> Скамейки</li>
                <li> Столы</li>
                <li>Стулья</li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Камины
            <ul>
                <li>Аксессуары для камина</li>
                <li> Биокамины</li>
                <li> Камин топка природным газом</li>
                <li> Камин топка углем</li>
                <li>Камин электрический</li>
                <li> Камины дровяные</li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Кухни
            <ul>
                <li>Аксессуары для кухни</li>
                <li> Кухонные мойки</li>
                <li> ОТДЕЛОЧНЫЕ МАТЕРИАЛЫ</li>
                <li> Бордюры и плинтуса</li>
                <li> Декоративные панно и 3D панели</li>
                <li> Искусственный камень</li>
                <li> Мозаика</li>
                <li> Напольные покрытия</li>
                <li> Паркет</li>
                <li> Плитка</li>
                <li> Стеновые панели</li>
                <li> Фрески</li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Предметы интерьера
            <ul>
                <li>Вазы</li>
                <li>Вешалки</li>
                <li>Зеркала</li>
                <li>Подсвечники</li>
                <li>Часы</li>
                <li>Шкатулки</li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Освещение
            <ul>
                <li>LED</li>
                <li>Большие люстры</li>
                <li>Бра</li>
                <li>Бра и настенные</li>
                <li>Люстры</li>
                <li>Светильники</li>
            </ul>
        </div>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">Бренды</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">Подбор товара</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">Дизайнеры</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">Новости</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">О нас</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">Доставка</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">Контакты</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link sale_link" href="">Распродажа</a>
    </div>
    <div class="b-nav-mobile__catalog-list list_mobile_nav-hidden" id="nav_catalog_list">

        <div id="b-nav-mobile__catalog-close"></div>
        <div class="b-nav-mobile__list-item"></div>
        <a class="b-nav-mobile__list-item" href="#">Душевые кабины и углы</a>
        <a class="b-nav-mobile__list-item" href="#">Ванны</a>
        <a class="b-nav-mobile__list-item" href="#">Унитазы</a>
        <a class="b-nav-mobile__list-item" href="#">Раковины</a>
        <a class="b-nav-mobile__list-item" href="#">Кухонные мойки</a>
        <a class="b-nav-mobile__list-item" href="#">Смесители</a>
        <a class="b-nav-mobile__list-item" href="#">Душевая программа</a>
        <a class="b-nav-mobile__list-item" href="#">Биде</a>
        <a class="b-nav-mobile__list-item" href="#">Писсуары</a>
        <a class="b-nav-mobile__list-item" href="#">Инсталляция</a>
        <a class="b-nav-mobile__list-item" href="#">Сифоны</a>
        <a class="b-nav-mobile__list-item" href="#">Трапы и душевые лотки</a>
        <a class="b-nav-mobile__list-item" href="#">Аксессуары</a>
        <a class="b-nav-mobile__list-item" href="#">Полотенцесушители</a>
        <a class="b-nav-mobile__list-item" href="#">Водонагреватели</a>
        <a class="b-nav-mobile__list-item" href="#">Радиаторы отопления</a>
        <a class="b-nav-mobile__list-item" href="#">Котлы отопления</a>
        <a class="b-nav-mobile__list-item" href="#">Тепловые котлы</a>
        <a class="b-nav-mobile__list-item" href="#">Комплектующие</a>
    </div>
</div>

</body>
</html>