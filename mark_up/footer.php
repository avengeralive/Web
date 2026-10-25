<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<?php require 'index.config.php'; ?>
</div>

<footer class="infoshel-footer">
    <div class="infoshel-container infoshel-footer__container">
        <div class="infoshel-footer__container-logo">
            <a href="<?php bloginfo('url'); ?>"></a>
        </div>
        <div class="infoshel-footer__container-download">
            <a target="_blank" href="/files/InfoShell.pdf">Скачать презентацию о компании <span></span></a>
        </div>
        <div class="infoshel-footer__container-phone">
            <p>Мск:<?php echo $contacts['moskow']['tel'];?></p>
            <p>СПб:<?php echo $contacts['piter']['tel'];?></p>
            <a href="" data-toggle="modal" data-target="#modal-contact" data-target="#exampleModalCenter"><span></span>Заказать звонок</a>
        </div>
        <div class="infoshel-footer__container-link"><a href="#"></a></div>
    </div>
</footer>
<?
        include(locate_template('template_form.php'));
    ?>

<div class="modal modal-infoshel" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-infoshel-form" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                <section class="infoshel-main-form">
                    <div class="infoshel-main-form__container infoshel-container">
                        <h1>Стоимость разработки</h1>
                        <p class="infoshel-main-form__title-text">Стоимость разработки рассчитывается индивидуально в зависимости от сложности, объема и сроков выполнения работ. Разработчик мобильных приложений оценивает все сложности разработки и временные затраты проекта. Затем аналитики определяют стоимость продукта с нуля.</p>

                        <div class="infoshel-main-form__form">
                            <div class="infoshel-main-form__form-column infoshel-main-form__form-left">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ваше Имя</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите ваше имя">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail2"># телефона</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Введите ваш номер телефона *">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail3">Ваш e-mail</label>
                                    <input type="email" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="Введите ваш e-mail адрес">
                                </div>
                            </div>

                            <div class="infoshel-main-form__form-column infoshel-main-form__form-right">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Сообщение</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Опишите ваш проект, пожалуйста"></textarea>
                                </div>
                                <div class="infoshel-main-form__block-btn">
                                    <div class="infoshel-main-form__block-btn-download">
                                        <span></span>
                                        <div class="infoshel-main-form__block-btn-download-text">
                                            <p><b>Прикрепить файл</b></p>
                                            <p class="infoshel-main-form__block-btn-download-text-bottom">не больше  2 MB (xls, doc, pdf, jpg)</p>
                                        </div>
                                    </div>
                                    <button class="infoshel-button infoshel-main-form__form-btn">Отправить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/forms/contact_form.html"?>

<!-- Code to include calc -->
<?php require __DIR__.'/calc/calc.script.inc.html'; ?>
<!-- /Code to include calc -->

<!--Мои js-->
<script src="<?php echo $templateDir;?>/js/modal_contact_form.js"></script>
<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(934261, "init", {
        id:934261,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/934261" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23922742-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23922742-1');
  
    
  //Google Analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-23922742-1', 'auto');

    var OpenStatParser = {
        _params: {},
        _parsed: false,
        _decode64: function(data) {
            if (typeof window['atob'] === 'function') {
                return atob(data);
            }
            var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
            var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                ac = 0,
                dec = "",
                tmp_arr = [];
            if (!data) {
                return data;
            }

            data += '';
            do {
                h1 = b64.indexOf(data.charAt(i++));
                h2 = b64.indexOf(data.charAt(i++));
                h3 = b64.indexOf(data.charAt(i++));
                h4 = b64.indexOf(data.charAt(i++));
                bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
                o1 = bits >> 16 & 0xff;
                o2 = bits >> 8 & 0xff;
                o3 = bits & 0xff;
                if (h3 == 64) {
                    tmp_arr[ac++] = String.fromCharCode(o1);
                } else if (h4 == 64) {
                    tmp_arr[ac++] = String.fromCharCode(o1, o2);
                } else {
                    tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
                }
            } while (i < data.length);

            dec = tmp_arr.join('');
            return dec;
        },
        _parse: function() {
            var prmstr = window.location.search.substr(1);
            var prmarr = prmstr.split('&');
            this._params = {};
            for (var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split('=');
                this._params[tmparr[0]] = tmparr[1];
            }
            this._parsed = true;
        },
        hasMarker: function() {
            if (!this._parsed) {
                this._parse();
            }
            return (typeof this._params['_openstat'] !== 'undefined') ? true : false;
        },
        buildCampaignParams: function() {
            if (!this.hasMarker()) {
                return false;
            }
            var openstat = this._decode64(this._params['_openstat']);
            var statarr = openstat.split(';');
            utmcampaign = statarr[3];
            utmsource = statarr[0];
            utmcontent = statarr[2];
        }
    }
    if (OpenStatParser.hasMarker()) {
        var campaignParams = OpenStatParser.buildCampaignParams();
        if (campaignParams !== false) {
            ga('set', {'campaignName': utmcampaign, 'campaignSource': utmsource, 'campaignMedium': 'cpc', 'campaignContent': utmcontent});
        }
    }
    ga('require', 'displayfeatures');
    ga('send', 'pageview');
</script>
<!-- Google Universal Analytics -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1005830998;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1005830998/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<script src="<?php echo $templateDir;?>/js/lib/OwlCarousel2/dist/owl.carousel.js"></script>
<script src="<?php echo $templateDir;?>/js/lib/WOW/dist/wow.min.js"></script>
<script src="<?php echo $templateDir;?>/js/lib/Responsive-Scroller-jQuery-Floating-Carousel/floatingcarousel.min.js"></script>
<script src="<?php echo $templateDir;?>/js/ajaxForms.js?v=20190411"></script>
<script src="<?php echo $templateDir;?>/js/infoshell2_main.js?v=20190411"></script>
<script src="<?php echo $templateDir;?>/js/anime-master/lib/anime.js"></script>
<script src="<?php echo $templateDir;?>/js/anime-master/lib/anime.es.js"></script>
<script src="<?php echo $templateDir;?>/js/anime-master/lib/anime.min.js"></script>
<script src="<?php echo $templateDir;?>/js/email_form_animation.js"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            delay: { show: 500, hide: 200 },
            placement: 'bottom'
        })
    })
    $(document).ready(function(){
        let view_counter = 0;
        showEmailForm(view_counter);
		<?
		if(array_key_exists('mailsuccess', $_REQUEST) && $_REQUEST['mailsuccess'] == 1) {
		?>
        $('body').append('<div class="modaler-backdrop in"></div>');
        $('.form-success').show();
        setTimeout(function(){
            $('.modaler-backdrop').fadeOut(5000);
            $('.form-success').fadeOut(5000);
        }, 1500)
		<?}?>
        $(".testimonials").owlCarousel({
            margin:15,
            autoHeight:true,
            dots: false,
            nav: true,
            navText: [],
            responsive : {
                320 : {
                    items: 1,
                    stagePadding: 50,
                    nav: false
                },
                766 : {
                    items: 2,
                    nav: false
                },
                1000 : {
                    items: 3
                }
            }
        });
        $(".blog").owlCarousel({
            margin:15,
            autoHeight:true,
            dots: false,
            nav: true,
            navText: [],
            loop: true,
            responsive : {
                320 : {
                    items: 1,
                    stagePadding: 50,
                    nav: false
                },
                766 : {
                    items: 2,
                    nav: false
                },
                1000 : {
                    items: 3
                }
            }
        });
        $(".showcase").owlCarousel({
            items: 1,
            nav: true,
            loop: true
        });
        $(".portfolio-preview").owlCarousel({
            items: 1,
            nav: true,
            navText: [],
            autoHeight: true,
            dotsContainer: '.custom-owl-dots',
            responsive : {
                320 : {
                    stagePadding: 25,
                    nav: false
                },
                766 : {
                    nav: false
                },
                985 : {
                    nav: true
                }
            }
        });
    });
</script>

<!-- VK API -->
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?160",t.onload=function(){VK.Retargeting.Init("VK-RTRG-313655-7tLhR"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script>
<noscript><img src="https://vk.com/rtrg?p=VK-RTRG-313655-7tLhR" style="position:fixed; left:-999px;" alt=""/></noscript>
<!-- VK API -->
<? } ?>
<!-- CALLBACKKILLER -->
<link rel="stylesheet" href="https://cdn.callbackkiller.com/widget/cbk.css">
<script type="text/javascript" src="https://cdn.callbackkiller.com/widget/cbk.js?cbk_code=16793" charset="UTF-8" async></script>
<script type="application/ld+json">
{"@context":"http://schema.org","@type":"Organization","url":"https://infoshell.ru/",
"contactPoint":[{"@type":"ContactPoint","telephone":"+7 (495) 215-51-82","contactType":"customer service"}],
"address":{"@type":"PostalAddress","addressLocality": "Москва","streetAddress": "ст. метро Маяковская, 1-я Тверская-Ямская улица, 16/23, оф. 8"},
"email":"info@infoshell.ru",
"faxNumber":"+7 (495) 215-51-82",
"name":"InfoShell.Ru","logo":"https://infoshell.ru/wp-content/themes/mark_up/img1/logo.svg",
"location":{"@context": "http://schema.org","@type": "Place","geo": {"@type": "GeoCoordinates","latitude":"55.772867","longitude":"37.591710"}},
"sameAs" : [
    "https://www.facebook.com/https://vk.com/infoshell",
    "https://www.facebook.com/infoshell.apps/",
    "https://dribbble.com/InfoShell",
    "https://www.behance.net/infoshell"
  ]}
</script>
<? wp_footer(); ?>
</body>
</html>