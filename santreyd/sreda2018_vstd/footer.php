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
<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/dom.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/mask.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/swiper.min.js"></script>
    <<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.fancybox.pack.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.formstyler.min.js"></script>
    
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/addtocopy.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/script.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/add.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/sliders/owl.carousel.js"></script>
    <script src="<? echo SITE_TEMPLATE_PATH; ?>/js/fav.js"></script>
<script>
    var swiper = new Swiper('.swiper-container-main', {
        navigation: {
            nextEl: '.main-slider-arrow-next',
            prevEl: '.main-slider-arrow-prev',
        },
        loop: true,
        autoplay: 3000,
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
        $('.b-nav-catalog__link-more').click(function() {


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
                <li><a href="/catalog/santehnika/aksessuary-dlya-vannoy/">Аксессуары </a></li>
                        <li><a href="/catalog/santehnika/bannye-kompleksy/">Банные комплексы </a></li>
                        <li><a href="/catalog/santehnika/basseyn-spa/">Бассейны </a></li>
                        <li><a href="/catalog/santehnika/bide/">Биде </a></li>
                        <li><a href="/catalog/santehnika/bani/">Бани </a></li>
                        <li><a href="/catalog/santehnika/vanna/">Ванны </a></li>
                        <li><a href="/catalog/santehnika/gidromassazhnaya-vanna/">Ванны гидромассажные </a></li>
                        <li><a href="/catalog/santehnika/dushevye-poddony/">Душевые поддоны </a></li>
                        <li><a href="/catalog/santehnika/dushevaya-kabina/">Душевые кабины </a></li>
                        <li><a href="/catalog/santehnika/dushevye-ugolki/">Душевые уголки </a></li>
                        <li><a href="/catalog/santehnika/zerkala-dlya-vannoy/">Зеркала </a></li>
                        <li><a href="/catalog/santehnika/installjacii/">Инсталляции </a></li>
                        <li><a href="/catalog/santehnika/ledogeneratory/">Ледогенераторы </a></li>
                        <li><a href="/catalog/santehnika/pissuary/">Писсуары </a></li>
                        <li><a href="/catalog/santehnika/parogenerator-dlya-hamama/">Парогенераторы </a></li>
                        <li><a href="/catalog/santehnika/polotentsesushiteli-otoplenie/">Полотенцесушители </a></li>
                        <li><a href="/catalog/santehnika/rakoviny/">Раковины</a></li>
                        <li><a href="/catalog/santehnika/sauna/">Сауны </a></li>
                        <li><a href="/catalog/santehnika/svetilniki-v-vannuyu/">Светильники </a></li>
                        <li><a href="/catalog/santehnika/dush/">Душевые лейки </a></li>
                        <li><a href="/catalog/santehnika/sushilki-dlya-ruk/">Сушилки для рук </a></li>
                        <li><a href="/catalog/santehnika/sideniya/">Сиденья табуреты </a></li>
                        <li><a href="/catalog/santehnika/smesiteli-dlya-bide/">Смесители для биде </a></li>
                        <li><a href="/catalog/santehnika/smesiteli-dlya-kukhni/">Смесители для кухни </a></li>
                        <li><a href="/catalog/santehnika/smesiteli-dlya-vannoy/">Смесители для ванной </a></li>
                        <li><a href="/catalog/santehnika/smesiteli-dlya-dusha/">Смесители для душа </a></li>
                        <li><a href="/catalog/santehnika/smesiteli/">Смесители для раковины </a></li>
                        <li><a href="/catalog/santehnika/gigienicheskiy-dush/">Смесители с гигиеническим душем </a></li>
                        <li><a href="/catalog/santehnika/tekstil-dlya-vannoy-komnaty/">Текстиль </a></li>
                        <li><a href="/catalog/santehnika/unitazy/">Унитаз </a></li>
                        <li><a href="/catalog/santehnika/hamam/">Хамам </a></li>
                        <li><a href="/catalog/santehnika/specialnaya-santehnika/">Специальная сантехника </a></li>
                        <li><a href="/catalog/santehnika/izlivy/">Изливы </a></li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Мебель
            <ul>
                <li><a href="/catalog/mebel/mebel-dlya-vannoy-komnaty/">Мебель для ванной </a></li>
                        <li><a href="/catalog/mebel/aksessuary-dlya-doma/">Аксессуары для дома </a></li>
                        <li><a href="/catalog/mebel/komody/">Комоды </a></li>
                        <li><a href="/catalog/mebel/biblioteki/">Библиотеки </a></li>
                        <li><a href="/catalog/mebel/gostinye/">Гостиные </a></li>
                        <li><a href="/catalog/mebel/detskaya-mebel/">Детская мебель </a></li>
                        <li><a href="/catalog/mebel/divany-i-kresla/">Диваны и кресла </a></li>
                        <li><a href="/catalog/mebel/bary/">Домашний Бар </a></li>
                        <li><a href="/catalog/mebel/interernye-zerkala/">Интерьерные зеркала </a></li>
                        <li><a href="/catalog/mebel/mebel-dlya-kukhni/">Мебель для кухни </a></li>
                        <li><a href="/catalog/mebel/spalni/">Мебель для спальни </a></li>
                        <li><a href="/catalog/mebel/ruchki-mebelnye/">Ручки мебельные </a></li>
                        <li><a href="/catalog/mebel/skameyki/">Скамейки </a></li>
                        <li><a href="/catalog/mebel/stoly/">Столы </a></li>
                        <li><a href="/catalog/mebel/stulya1/">Стулья </a></li>
                        <li><a href="/catalog/mebel/taburety/">Табуреты </a></li>
                        <li><a href="/catalog/mebel/ulichnaya-mebel/">Уличная мебель </a></li>
                        <li><a href="/catalog/mebel/shkafy/">Шкафы </a></li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Камины
            <ul>
                <li><a href="/catalog/kaminy/aksessuary-dlya-kamina/">Аксессуары для камина </a></li>
                <li><a href="/catalog/kaminy/biokamin/">Биокамины </a></li>
                <li><a href="/catalog/kaminy/kamin-topka-prirodnym-gazom/">Камин топка природным газом </a></li>
                <li><a href="/catalog/kaminy/kamin-topka-uglem/">Камин топка углем </a></li>
                <li><a href="/catalog/kaminy/kamin-elektricheskiy/">Камин электрический </a></li>
                <li><a href="/catalog/kaminy/kamin-drovyanoy/">Камины дровяные </a></li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Кухни
            <ul>
                <li><a href="/catalog/kuhni/aksessuary-dlya-kukhni/">Аксессуары для кухни </a></li>
                <li><a href="/catalog/kuhni/kuhonnye-moyki/">Кухонные мойки </a></li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Отделочные материалы
            <ul>
                <li><a href="/catalog/otdelochnye-materialy/bordyury/">Бордюры и плинтуса </a></li>        
                <li><a href="/catalog/otdelochnye-materialy/dekorativnye-panno-i-3d-paneli/">Декоративные панно и 3D панели </a></li>
                <li><a href="/catalog/otdelochnye-materialy/iskusstvenny-kamen/">Искусственный камень </a></li>
                <li><a href="/catalog/otdelochnye-materialy/mozaika/">Мозаика </a></li>   
                <li><a href="/catalog/otdelochnye-materialy/napolnye-pokrytiya/">Напольные покрытия </a></li>
                <li><a href="/catalog/otdelochnye-materialy/parket-dla-vannoy/">Паркет </a></li> 
                <li><a href="/catalog/otdelochnye-materialy/plitka/">Плитка </a></li> 
                <li><a href="/catalog/otdelochnye-materialy/stenovie-paneli/">Стеновые панели </a></li>    
                <li><a href="/catalog/otdelochnye-materialy/freski/">Фрески </a></li>
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Предметы интерьера
            <ul>
                <li><a href="/catalog/predmety-interera/vazy/">Вазы </a></li>
                <li><a href="/catalog/predmety-interera/veshalki/">Вешалки </a></li> 
                <li><a href="/catalog/predmety-interera/zerkala/">Зеркала </a></li>  
                <li><a href="/catalog/predmety-interera/podsvechniki/">Подсвечники </a></li>
                <li><a href="/catalog/predmety-interera/chasy/">Часы </a></li>
                <li><a href="/catalog/predmety-interera/shkatulki/">Шкатулки </a></li>   
            </ul>
        </div>
        <div class="b-nav-mobile__list-item b-nav-mobile__list-click">Освещение
            <ul>
                <li><a href="/catalog/osveshenie/led/">LED </a> </li>
                <li><a href="/catalog/osveshenie/bolshie-lyustry/">Большие люстры </a> </li>
                <li><a href="/catalog/osveshenie/bra/">Бра </a> </li>  
                <li><a href="/catalog/osveshenie/bra-i-nastennye/">Бра и настенные </a></li>
                <li><a href="/catalog/osveshenie/lyustry/">Люстры </a></li>   
                <li><a href="/catalog/osveshenie/svetilniki/">Светильники </a></li>               
            </ul>
        </div>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="/brands/">Бренды</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="/search/">Подбор товара</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="/infopage/dizaynery/">Дизайнеры</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="/news/">Новости</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="/about/">О нас</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="">Доставка</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link" href="/about/contacty/">Контакты</a>
        <a class="b-nav-mobile__list-item b-nav-mobile__list-item-link sale_link" href="">Распродажа</a>
    </div>
    <div class="b-nav-mobile__catalog-list list_mobile_nav-hidden" id="nav_catalog_list">

        <div id="b-nav-mobile__catalog-close"></div>
        <div class="b-nav-mobile__list-item"></div>
        <a class="b-nav-catalog__link" href="/catalog/santehnika/aksessuary-dlya-vannoy/">Аксессуары </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/vanna/">Ванны</a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/bannye-kompleksy/">Банные комплексы </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/basseyn-spa/">Бассейны </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/bide/">Биде </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/bani/">Бани </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/gidromassazhnaya-vanna/">Ванны гидромассажные </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/dushevye-poddony/">Душевые поддоны </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/svetilniki-v-vannuyu/">Светильники </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/sauna/">Сауны </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/installjacii/">Инсталляции </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/dush/">Душевые лейки </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/smesiteli/">Смесители для раковины </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/unitazy/">Унитаз </a>
                    <a class="b-nav-catalog__link" href="/catalog/santehnika/hamam/">Хамам </a>
                    <a class="b-nav-catalog__link" href="/catalog/mebel/biblioteki/">Библиотеки </a>
                    <a class="b-nav-catalog__link" href="/catalog/mebel/mebel-dlya-vannoy-komnaty/">Мебель для ванной </a>
                    <a class="b-nav-catalog__link" href="/catalog/mebel/bary/">Домашний Бар </a>
    </div>
</div>

</body>
</html>