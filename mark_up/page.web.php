<?php
/*
Template Name: New.Infoshell "Web"
*/
require 'index.header.php';
?>
<section class="infoshel-article-page__firstSlide">
    <div class="infoshel-container container">
        <div class="row">
            <div class="col-sm-8">
                <div class="infoshel-article-page__firstSlide-text">
                    <h2 class="infoshel-h2"><?php the_title(); ?></h2>
                    <p><b>Infoshell</b> осуществляет разработку качественного программного обеспечения для
                        <b>web сервисов</b> любого уровня сложности.<br><br>
                    Индивидуальный аналитический подход к каждому проекту и проверенная команда профессионалов – вот те ресурсы, которые позволяют нам создать качественное<br>
                        <b>web приложение</b>.</p>
<!--                    --><?php //if(have_posts()) while(have_posts()) { the_post(); the_content(); } ?>
                    <button class="infoshel-button mt-4" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="infoshel-article-page__firstSlide-web-img"></div>
            </div>
        </div>
    </div>
    <div id="carousel-default">
        <ul class="infoshel-main-services__logos">
            <?php foreach($partners as $p) { ?>
            <li class="infoshel-main-services__logos-icon infoshel-main-services__logos-<?php echo $p; ?>"></li>
            <?php } ?>
        </ul>
    </div>
</section>
<section class="infoshel-article-page__webService">
    <div class="infoshel-container container">
        <h2 class="infoshel-h2">Какие веб-сервисы мы делаем</h2>
        <div class="row infoshel-article-page__webService-row">
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="infoshel-article-page__webService-block">
                    <div class="infoshel-article-page__webService-block-bg"></div>
                    <span>Порталы</span>
                    <h4>Повышенного уровня сложности</h4>
                    <ul>
                        <li>- Корпоративные порталы</li>
                        <li>- сложные интернет-проекты</li>
                    </ul>
                    <div class="infoshel-article-page__webService-block-bottom">
                        <button class="infoshel-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="infoshel-article-page__webService-block">
                    <div class="infoshel-article-page__webService-block-bg"></div>
                    <span>Коммерция</span>
                    <h4>Интернет-магазины гипермаркеты</h4>
                    <ul>
                        <li>- E-commerce</li>
						<li>- Маркетплейсы</li>
                    </ul>
                    <div class="infoshel-article-page__webService-block-bottom">
                        <button class="infoshel-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="infoshel-article-page__webService-block">
                    <div class="infoshel-article-page__webService-block-bg"></div>
                    <span>Системы обучения</span>
                    <h4>Системы дистанционного обучения (e-learning)</h4>
                    <ul>
                        <li>- E-learning</li>
                    </ul>
                    <div class="infoshel-article-page__webService-block-bottom">
                        <button class="infoshel-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="infoshel-article-page__webService-block">
                    <div class="infoshel-article-page__webService-block-bg"></div>
                    <span>Системы</span>
                    <h4>Индивидуальная разработка </h4>
                    <ul>
                        <li>- СRM систем</li>
                        <li>- ERP систем</li>
                    </ul>
                    <div class="infoshel-article-page__webService-block-bottom">
                        <button class="infoshel-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <section class="ourWork-swiper-block">
        <h2 class="infoshel-h2">Наши работы</h2>
        <span class="infoshel-main-ourWork__title-span">Мы превращаем идеи в отличные результаты</span>
        <div class="ourWork-swiper-slider">
            <div class="ourWork-swiper-slider-navigation">
                <div class="ourWork-swiper-slider-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.628" height="22.628" viewBox="0 0 22.628 22.628">
                        <path id="Combined_Shape" data-name="Combined Shape" d="M0,16V0H-3V13H-16v3Z" transform="translate(11.314 22.628) rotate(135)" fill="#f9f9f9"/>
                    </svg>
                </div>
                <div class="ourWork-swiper-slider-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.628" height="22.628" viewBox="0 0 22.628 22.628">
                        <path id="Combined_Shape" data-name="Combined Shape" d="M0,16V0H3V13H16v3Z" transform="translate(11.314 22.628) rotate(-135)" fill="#f9f9f9"/>
                    </svg>
                </div>
            </div>
            <div class="swiper-wrapper">
                <?php
                $posts = get_posts(array(
                    'category'=>'56',
                    'orderby'=>'date',
                    'posts_per_page'=>21,
                    'order'=>'DESC'
                ));
                foreach($posts as $post) {
                    setup_postdata($post);
                    $img = wp_get_attachment_image_url((get_post_thumbnail_id(get_the_ID())), 'full');
                    ?>
                    <div class="ourWork-swiper-slide swiper-slide">
                        <a href="<?php the_permalink(); ?>">
                            <div class="ourWork-swiper-slide-img">
                                <img src="<?php echo $img; ?>" alt="">
			                    <?if(get_field('type_apple') || get_field('type_android') || get_field('type_windows')):?>
                                    <div class="ourWork-markers">
					                    <?if(get_field('type_apple')):?>
                                            <span class="infoshel-main-ourWork__slider-img-icon infoshel-main-ourWork__icon-ios infoshel-main-ourWork__icon-surfprise-ios"></span>
					                    <?endif;?>
					                    <?if(get_field('type_android')):?>
                                            <span class="infoshel-main-ourWork__slider-img-icon infoshel-main-ourWork__icon-android infoshel-main-ourWork__icon-surfprise-android"></span>
					                    <?endif;?>
					                    <?if(get_field('type_windows')):?>
                                            <span class="infoshel-main-ourWork__slider-img-icon infoshel-main-ourWork__icon-web infoshel-main-ourWork__icon-surfprise-web"></span>
					                    <?endif;?>
                                    </div>
			                    <?endif;?>
                            </div>
                            <h4><?php the_title(); ?></h4>
                            <p><?php echo (get_post_meta($post->ID, 'short_description', true)); ?></p>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            const swiper = new Swiper('.ourWork-swiper-slider', {
                // Optional parameters
                direction: 'horizontal',
                loop: true,
                slidesPerView: 1,
                spaceBetween: 100,
                centeredSlides: true,
                navigation: {
                    nextEl: '.ourWork-swiper-slider-next',
                    prevEl: '.ourWork-swiper-slider-prev',
                },
                breakpoints: {
                    // when window width is >= 320px
                    1440: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    },
                    1200: {
                        slidesPerView:3,
                        spaceBetween: 10,
                    },
                    900: {
                        slidesPerView:2,
                        spaceBetween: 10,
                    }
                }
            });
        })
    </script>
    <section class="infoshel-main-ourWork">
        <div class="infoshel-container container">
            <div class="tab-content" id="pills-tabContent">
                <div id="web_services" class="tab-pane active" role="tabpanel" aria-labelledby="web_services-tab">
                    <div class="infoshel-main-ourWork__flex-container">
                        <div class="infoshel-main-ourWork__text">
                            <h3>InfoShell.WebServices</h3>
                            <p>Мы помогаем крупному бизнесу создавать масштабные цифровые продукты:<br><br>
                                Веб-сервисы, CRM/ERP; корпоративные порталы, системы электронной коммерции (e-commerce); программы лояльности</p>
                        </div>
                        <div class="infoshel-main-ourWork__video">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/wFtIyKWlsYA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="infoshel-main-scrum">
    <div class="infoshel-container container">
        <h2 class="infoshel-h2 infoshel-main-scrum__h2">Работаем по SCRUM</h2>
        <p class="infoshel-main-scrum__briefly">Получаем работающую систему, сохраняя время и ресурсы</p>
        <div class="infoshel-main-scrum__container row">
            <div class="col-xl-3">
                <div class="infoshel-main-scrum__content-block infoshel-main-scrum__content-block-first">
                    <span class="infoshel-main-scrum__list">1</span>
                    <div class="infoshel-main-scrum__text">
                        <span class="infoshel-main-scrum__title">Знакомство</span>
                        <p>Знакомимся с идеей, кратко описываем систему и предварительный функционал.</p>
                    </div>
                    <span class="infoshel-main-scrum__bottom-text">Обсуждение цены, договор на проектирование</span>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="infoshel-main-scrum__content-block infoshel-main-scrum__content-block-second">
                    <span class="infoshel-main-scrum__list">2</span>
                    <div class="infoshel-main-scrum__text">
                        <span class="infoshel-main-scrum__title">Этап проектирования</span>
                        <p>Проектируем прототип системы. Подробно описываем фуционал системы для оценки разработки.</p>
                    </div>
                    <span class="infoshel-main-scrum__bottom-text">Обсуждение цены, договор на проектирование</span>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="infoshel-main-scrum__content-block">
                    <span class="infoshel-main-scrum__list">3</span>
                    <div class="infoshel-main-scrum__text">
                        <span class="infoshel-main-scrum__title">Разработка</span>
                        <p>Создаем дизайн и занимаемся разработкой системы. Каждые две недели предоставляем продукт с новыми функциями. Обсуждаем, что будет сделано за следующие две недели.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="infoshel-main-scrum__content-block infoshel-main-scrum__content-block-bottom">
                    <span class="infoshel-main-scrum__list">4</span>
                    <div class="infoshel-main-scrum__text">
                        <span class="infoshel-main-scrum__title">Поддержка</span>
                        <p>Заботимся о стабильности системы и оперативно реагируем на ошибки после релиза.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="infoshel-article-page__orderWeb ">
    <div class="infoshel-container container">
        <h2 class="infoshel-h2">Почему выгодно заказать веб - разработку у нас</h2>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="infoshel-article-page__orderWeb-block">
                    <div class="infoshel-article-page__orderWeb-block-img">
                        <div class="infoshel-article-page__orderWeb-icon-rocket"></div>
                        <span>Производительность и масштабируемость</span>
                    </div>

                    <p>Мы разрабатываем веб-сервисы, способные выдерживать высокие нагрузки (до 10000 запросов/сек) и обеспечивать поддержку растущего количества пользователей, записей и операций.</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="infoshel-article-page__orderWeb-block">
                    <div class="infoshel-article-page__orderWeb-block-img">
                        <div class="infoshel-article-page__orderWeb-icon-cycle"></div>
                        <span>Полный цикл разработки продукта</span>
                    </div>
                    <p>Мы предлагаем весь спектр услуг по разработке и внедрению веб-сервиса, от анализа требований и консультирования до оказания долгосрочной технической поддержки.</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="infoshel-article-page__orderWeb-block">
                    <div class="infoshel-article-page__orderWeb-block-img">
                        <div class="infoshel-article-page__orderWeb-icon-arms"></div>
                        <span>Ориентация на заказчика и пользователя</span>
                    </div>
                    <p>Мы анализируем потребности целевой аудитории и разрабатываем решения, удобные для пользователя и эффективные с точки зрения достижения целей клиента.</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="infoshel-article-page__orderWeb-block">
                    <div class="infoshel-article-page__orderWeb-block-img">
                        <div class="infoshel-article-page__orderWeb-icon-mountain"></div>
                        <span>Итерационный подход</span>
                    </div>
                    <p>Разработка web приложения короткими циклами снижает риски и позволяет вносить изменения в ход работы. Вы не тратите время и деньги на написание ТЗ, которое устареет к моменту завершения проекта.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALC -->

<section class="" style="padding:0;">
<div id="calculator">
<div class="container">
<?php require __DIR__.'/calc/calculator.html'; ?>
</div>
</div>
</section>

<!-- Code to include calc -->
<!--<section id="calc">
    <div class="container">
        <header>
            <h3 class="h3">Стоимость разработки приложения для Web</h3>
            <p>Воспользуйтесь калькулятором расчета цены на создание мобильного приложения, заполнив несколько полей!</p>
            <h4 class="h3"><b id="price">0</b> руб</h4>
        </header>

        <?php //require 'calc2/calc.inc.config.php'; ?>
        <?php //require 'calc2/calc.inc.php'; ?>

    </div>
</section>//-->
<!-- /Code to include calc -->


    <section class="section-block infoshel-main-reviews">
        <div class="container">
            <h2 class="infoshel-h2 infoshel-main-reviews__h2 wow fadeIn">Отзывы заказчиков</h2>
            <p class="infoshel-main-reviews__title wow fadeIn" data-wow-delay="0.3s">Конечная цель любого мобильного приложения – автоматизация бизнес-процессов, создание имиджа компании, увеличение прибыли бизнеса за счет популярности продукта в интернете</p>
        </div>
        <div class="infoshel-main-reviews-slider">
            <div class="infoshel-main-reviews-slider-navigation">
                <div class="infoshel-main-reviews-slider-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.628" height="22.628" viewBox="0 0 22.628 22.628">
                        <path id="Combined_Shape" data-name="Combined Shape" d="M0,16V0H-3V13H-16v3Z" transform="translate(11.314 22.628) rotate(135)" fill="#f9f9f9"/>
                    </svg>
                </div>
                <div class="infoshel-main-reviews-slider-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.628" height="22.628" viewBox="0 0 22.628 22.628">
                        <path id="Combined_Shape" data-name="Combined Shape" d="M0,16V0H3V13H16v3Z" transform="translate(11.314 22.628) rotate(-135)" fill="#f9f9f9"/>
                    </svg>
                </div>
            </div>
            <ul class="swiper-wrapper">
                <li class="testimonials-client__item swiper-slide">
                    <div class="youtube" data-embed="vipp5BNsnJc">
                        <div class="play-button"></div>
                    </div>
                    <p class="testimonials-client__name">Сергей Барамба</p>
                    <p class="testimonials-client__job">ИТ Директор Группы компаний «РосОхрана»</p>
                </li>
                <li class="testimonials-client__item swiper-slide">
                    <div class="youtube" data-embed="Ei6sZ13Aq5g">
                        <div class="play-button"></div>
                    </div>
                    <p class="testimonials-client__name">Денис Шпак</p>
                    <p class="testimonials-client__job">Руководитель компании «Mobile Agent»</p>
                </li>
                <li class="testimonials-client__item swiper-slide">
                    <div class="youtube" data-embed="nPW2I_pDLyg">
                        <div class="play-button"></div>
                    </div>
                    <p class="testimonials-client__name">Илья Новиков</p>
                    <p class="testimonials-client__job">Global It Director of Insignia</p>
                </li>
                <li class="testimonials-client__item swiper-slide">
                    <div class="youtube" data-embed="TzvVZDWe-u0">
                        <div class="play-button"></div>
                    </div>
                    <p class="testimonials-client__name">Лев Левицкий</p>
                    <p class="testimonials-client__job">Директор по продуктам и проектам - Киноход</p>
                </li>
            </ul>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            const swiper = new Swiper('.infoshel-main-reviews-slider', {
                // Optional parameters
                direction: 'horizontal',
                loop: true,
                allowTouchMove: false,
                slidesPerView: 1,
                spaceBetween: 70,
                centeredSlides: true,
                // Navigation arrows
                navigation: {
                    nextEl: '.infoshel-main-reviews-slider-next',
                    prevEl: '.infoshel-main-reviews-slider-prev',
                },
                breakpoints: {
                    // when window width is >= 320px
                    1200: {
                        slidesPerView:3,
                        centeredSlides: true,
                    },
                    992: {
                        slidesPerView:2,
                        centeredSlides: false,
                    }
                }
            });

            var youtube = document.querySelectorAll(".youtube");

            for (var i = 0; i < youtube.length; i++) {
                var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";
                var image = new Image();
                image.src = source;

                image.addEventListener( "load", function() {
                    youtube[ i ].appendChild( image );
                }( i ) );

                youtube[i].addEventListener("click", function () {
                    var iframe = document.createElement("iframe");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allowfullscreen", "");
                    iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
                    this.innerHTML = "";
                    this.appendChild(iframe);
                });
            }
        });
    </script>
<section class="infoshel-main-itProduct">
    <div class="infoshel-main-itProduct__container infoshel-container container">
        <h2 class="infoshel-h2 infoshel-main-itProduct__h2">Зачем нужен веб-сервис?</h2>
        <div class="infoshel-main-itProduct__content wow fadeIn row" data-wow-offset="120">
            <div class="col-xl-4 col-lg-6 col-12">
                <div class="infoshel-main-itProduct__content-block wow zoomIn" data-wow-duration="0.5s">
                    <div class="infoshel-main-itProduct__content-icon wow jackInTheBox infoshel-main-itProduct__content-icon-automation"></div>
                    <p class="infoshel-main-itProduct__content-block-text">Автоматизировать и масштабировать бизнес</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
                <div class="infoshel-main-itProduct__content-block wow zoomIn" data-wow-duration="0.5s">
                    <div class="infoshel-main-itProduct__content-icon wow jackInTheBox infoshel-main-itProduct__content-icon-profit"></div>
                    <p class="infoshel-main-itProduct__content-block-text">Увеличить прибыль</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12 mt-lg-4 mt-xl-0">
                <div class="infoshel-main-itProduct__content-block wow zoomIn" data-wow-duration="0.5s">
                    <div class="infoshel-main-itProduct__content-icon wow jackInTheBox infoshel-main-itProduct__content-icon-audience"></div>
                    <p class="infoshel-main-itProduct__content-block-text">Постоянно быть в контакте с аудиторией</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="infoshel-main-blog">
    <div class="infoshel-main-blog__container">
        <h2 class="infoshel-h2 infoshel-main-blog__h2 wow fadeInDownMin2">Блог</h2>
        <div class="infoshel-main-blog-goto">
            <p>
                Мы часто делимся своим опытом в нашем блоге на VC.ru. Следите за нашей активностью!
            </p>
            <a target="_blank" href="<?=$socialUrl['vc'];?>">
                Перейти
            </a>
        </div>
        <div class="infoshel-main-blog__slider owl-theme owl-carousel">
            <?php
            $posts = get_posts(array(
                #'category_name'=>'blog',
                'category'=>77,
                'orderby'=>'date',
                'posts_per_page'=>9,
                'order'=>'DESC'
            ));

            foreach($posts as $post) {
                setup_postdata($post);
                $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'blog_small');
            ?>
            <a href="<?php the_permalink(); ?>" class="infoshel-main-blog__slider-block wow zoomInMin" data-wow-delay="0.3s">
                <div class="infoshel-main-blog__slider-block-img">
                    <img src="<?php echo $img[0]; ?>" alt="1">
                </div>
                <div class="infoshel-main-blog__slider-text">
                    <span><?php the_title(); ?></span>
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
            </a>
            <?php } ?>

        </div>
    </div>
</section>
<?php require 'index.footer.php'; ?>