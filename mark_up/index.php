<?php require 'index.header.php'; ?>
    <section class="infoshel-main-slider">
        <div class="infoshel-main-slider__container owl-theme owl-carousel">
            <div class="infoshel-main-slider__img infoshel-main-slider__img-first">
                <img src="<?php echo $templateDir;?>/img/infoshell2/slider-video.png" alt="">
                <div class="youtube-slider" data-embed="3qRLtrL0eV0">
                    <div class="play-button-main-slider">
                        <svg xmlns="http://www.w3.org/2000/svg" width="157" height="157" viewBox="0 0 157 157">
                            <g id="Play" transform="translate(-642 -223)">
                                <g id="Эллипс_1" data-name="Эллипс 1" transform="translate(642 223)" fill="none" stroke="#f9f9f9" stroke-width="4">
                                    <circle cx="78.5" cy="78.5" r="78.5" stroke="none"/>
                                    <circle cx="78.5" cy="78.5" r="76.5" fill="none"/>
                                </g>
                                <g id="Многоугольник_1" data-name="Многоугольник 1" transform="translate(746 279) rotate(90)" fill="none" stroke-linejoin="round">
                                    <path d="M17.3,9.008a6,6,0,0,1,10.394,0L39.809,30a6,6,0,0,1-5.2,9H10.388a6,6,0,0,1-5.2-9Z" stroke="none"/>
                                    <path class="anim" d="M 22.5 10.00666809082031 C 22.15269088745117 10.00666809082031 21.28861999511719 10.10416793823242 20.76762008666992 11.00722885131836 L 8.656078338623047 32.00055694580078 C 8.135379791259766 32.90311813354492 8.482959747314453 33.69969940185547 8.656570434570313 34.00027847290039 C 8.830169677734375 34.30086517333984 9.346469879150391 35.00000762939453 10.38845825195313 35.00000762939453 L 34.61154174804688 35.00000762939453 C 35.65353012084961 35.00000762939453 36.16981887817383 34.30086517333984 36.34342956542969 34.00028610229492 C 36.51704025268555 33.69969940185547 36.86462020874023 32.90311813354492 36.34391021728516 32.00055694580078 L 24.23237037658691 11.00721740722656 C 23.71137046813965 10.10415649414063 22.84730911254883 10.00666809082031 22.5 10.00666809082031 M 22.50000190734863 6.006664276123047 C 24.52131652832031 6.006664276123047 26.54262542724609 7.007217407226563 27.69710922241211 9.008327484130859 L 39.80865097045898 30.00166702270508 C 42.11634826660156 34.00166702270508 39.22948837280273 39.00000762939453 34.61154174804688 39.00000762939453 L 10.38845825195313 39.00000762939453 C 5.770511627197266 39.00000762939453 2.883651733398438 34.00166702270508 5.191341400146484 30.00166702270508 L 17.30287933349609 9.008338928222656 C 18.45737075805664 7.007221221923828 20.47868919372559 6.006664276123047 22.50000190734863 6.006664276123047 Z" stroke="none" fill="#f9f9f9"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="infoshel-main-slider__img infoshel-main-slider__img-first">
                <img src="<?php echo $templateDir;?>/img/infoshell2/slider-01.jpg" alt="">
            </div>
            <div class="infoshel-main-slider__img infoshel-main-slider__img-second">
                <img src="<?php echo $templateDir;?>/img/infoshell2/slider-02.jpg" alt="">
            </div>
            <div class="infoshel-main-slider__img infoshel-main-slider__img-three">
                <img src="<?php echo $templateDir;?>/img/infoshell2/slider-03.jpg" alt="">
            </div>
        </div>
        <div class="infoshel-main-slider__bottom-text">
            <div class="infoshel-main-slider__bottom-text-bg wow fadeInUp"></div>
            <div class="infoshel-main-slider__bottom-text-container">
                <span class="wow fadeInLeft">Воплощаем ваши digital-амбиции.<br>Работаем по SCRUM.</span>
                <button class="infoshel-button infoshel-main-slider__btn wow fadeInRight" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
            </div>
        </div>
        <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
        <script>
            $(document).ready(function () {
                var youtubeSlider = document.querySelectorAll(".youtube-slider");

                for (var i = 0; i < youtubeSlider.length; i++) {

                    youtubeSlider[i].addEventListener("click", function () {
                        $('.youtube-slider').find('img').remove();
                        var iframe = document.createElement("iframe");
                        iframe.setAttribute("frameborder", "0");
                        iframe.setAttribute("allowfullscreen", "");
                        iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
                        this.innerHTML = "";
                        this.appendChild(iframe);
                    });
                }
            })
        </script>
        <? } ?>
    </section>
    <section class="infoshel-main-services wow fadeIn">
        <div id="carousel-default">
            <ul class="infoshel-main-services__logos">
                <?php foreach($partners as $p) { ?>
                    <li class="infoshel-main-services__logos-icon infoshel-main-services__logos-<?php echo $p; ?>"></li>
                <?php } ?>
            </ul>
        </div>
        <div class="infoshel-main-services__main infoshel-container continer">
            <h2 class="infoshel-h2">Услуги</h2>
            <div class="infoshel-main-services__main-container row">

                <div class="col-lg-3 col-6">
                    <a href="/developing-for-iphone/" class="infoshel-main-services__main-block wow zoomIn" data-wow-duration="0.5s">
                        <div class="infoshel-main-services__main-block-color infoshel-main-services__main-block-color-ios">
                            <div class="infoshel-main-services__main-icon infoshel-main-services__main-icon-ios wow jackInTheBox"></div>
                        </div>
                        <h3 class="infoshel-main-services__main-block-h3">Разработка iOS-приложений</h3>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="/developing-for-android-os/" class="infoshel-main-services__main-block wow zoomIn" data-wow-duration="0.5s">
                        <div class="infoshel-main-services__main-block-color infoshel-main-services__main-block-color-android">
                            <div class="infoshel-main-services__main-icon infoshel-main-services__main-icon-android wow jackInTheBox"></div>
                        </div>
                        <h3 class="infoshel-main-services__main-block-h3">Разработка Android-приложений</h3>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="/web-development/" class="infoshel-main-services__main-block wow zoomIn" data-wow-duration="0.5s">
                        <div class="infoshel-main-services__main-block-color infoshel-main-services__main-block-color-web">
                            <div class="infoshel-main-services__main-icon infoshel-main-services__main-icon-web wow jackInTheBox"></div>
                        </div>
                        <h3 class="infoshel-main-services__main-block-h3">Разработка Web-сервисов</h3>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="/gamedevelopment/" class="infoshel-main-services__main-block wow zoomIn" data-wow-duration="0.5s">
                        <div class="infoshel-main-services__main-block-color infoshel-main-services__main-block-color-mob">
                            <div class="infoshel-main-services__main-icon infoshel-main-services__main-icon-mob wow jackInTheBox"></div>
                        </div>
                        <h3 class="infoshel-main-services__main-block-h3">Создание мобильных и веб-игр</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="infoshel-main-ourAwards">
        <div class="infoshel-main-ourAwards__container infoshel-container container">
            <h2 class="infoshel-h2 infoshel-main-ourAwards__h2">Мы занимаем топовые позиции в отпраслевых рейтингах</h2>
            <div class="infoshel-main-ourAwards__content wow fadeIn row" data-wow-offset="120">
                <div class="col-xl-4 col-lg-6 col-12">
                    <a href="https://ratingruneta.ru/apps/2019/moscow/" target="_blank" class="infoshel-main-ourAwards__content-block">
                        <div class="infoshel-main-ourAwards__content-medal">
                            <p>1</p>
                            <img src="<?php echo $templateDir;?>/images/ourRewardsImg/medal.png" alt="">
                        </div>
                        <div class="infoshel-main-ourAwards__content-description">
                            <div class="infoshel-main-ourAwards__content-head">
                                <span>2019</span>
                                <img src="<?php echo $templateDir;?>/images/ourRewardsImg/pr_source.png" alt="">
                                <p>Рейтинг рунета</p>
                            </div>
                            <p class="infoshel-main-ourAwards__content-block-text">Рейтинг разработчиков мобильных приложений Москва</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <a href="https://ratingruneta.ru/apps/2019/android/" target="_blank" class="infoshel-main-ourAwards__content-block">
                        <div class="infoshel-main-ourAwards__content-medal">
                            <p>1</p>
                            <img src="<?php echo $templateDir;?>/images/ourRewardsImg/medal.png" alt="">
                        </div>
                        <div class="infoshel-main-ourAwards__content-description">
                            <div class="infoshel-main-ourAwards__content-head">
                                <span>2019</span>
                                <img src="<?php echo $templateDir;?>/images/ourRewardsImg/pr_source.png" alt="">
                                <p>Рейтинг рунета</p>
                            </div>
                            <p class="infoshel-main-ourAwards__content-block-text">Рейтинг разработчиков приложений<br> для Android</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <a href="https://www.cnews.ru/reviews/mobilnost_v_biznese_2020/review_table/4f66b8911b27e1ff43752e1ac889dc063c07fbea" target="_blank" class="infoshel-main-ourAwards__content-block">
                        <div class="infoshel-main-ourAwards__content-medal">
                            <p>5</p>
                            <img src="<?php echo $templateDir;?>/images/ourRewardsImg/medal.png" alt="">
                        </div>
                        <div class="infoshel-main-ourAwards__content-description">
                            <div class="infoshel-main-ourAwards__content-head">
                                <span>2018</span>
                                <img src="<?php echo $templateDir;?>/images/ourRewardsImg/cnews2.png" alt="">
                                <p>C News</p>
                            </div>
                            <p class="infoshel-main-ourAwards__content-block-text">Рейтинг крупнейших разработчиков<br> мобильных приложений для бизнеса и госструктур</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <a href="https://www.cnews.ru/tables/75f139c48fb6a2f636d0d9e4b38e832eba0578a4" target="_blank" class="infoshel-main-ourAwards__content-block">
                        <div class="infoshel-main-ourAwards__content-medal">
                            <p>9</p>
                            <img src="<?php echo $templateDir;?>/images/ourRewardsImg/medal.png" alt="">
                        </div>
                        <div class="infoshel-main-ourAwards__content-description">
                            <div class="infoshel-main-ourAwards__content-head">
                                <span>2019</span>
                                <img src="<?php echo $templateDir;?>/images/ourRewardsImg/cnews2.png" alt="">
                                <p>C News</p>
                            </div>
                            <p class="infoshel-main-ourAwards__content-block-text">Рейтинг крупнейших разработчиков<br> мобильных приложений для бизнеса и госструктур</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <a href="https://ratingruneta.ru/apps/android/" target="_blank" class="infoshel-main-ourAwards__content-block">
                        <div class="infoshel-main-ourAwards__content-medal">
                            <p>4</p>
                            <img src="<?php echo $templateDir;?>/images/ourRewardsImg/medal.png" alt="">
                        </div>
                        <div class="infoshel-main-ourAwards__content-description">
                            <div class="infoshel-main-ourAwards__content-head">
                                <span>2020</span>
                                <img src="<?php echo $templateDir;?>/images/ourRewardsImg/pr_source.png" alt="">
                                <p>Рейтинг рунета</p>
                            </div>
                            <p class="infoshel-main-ourAwards__content-block-text">Рейтинг разработчиков приложений<br> для Android</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <a href="https://ratingruneta.ru/apps/moscow/" target="_blank" class="infoshel-main-ourAwards__content-block">
                        <div class="infoshel-main-ourAwards__content-medal">
                            <p>8</p>
                            <img src="<?php echo $templateDir;?>/images/ourRewardsImg/medal.png" alt="">
                        </div>
                        <div class="infoshel-main-ourAwards__content-description">
                            <div class="infoshel-main-ourAwards__content-head">
                                <span>2020</span>
                                <img src="<?php echo $templateDir;?>/images/ourRewardsImg/pr_source.png" alt="">
                                <p>Рейтинг рунета</p>
                            </div>
                            <p class="infoshel-main-ourAwards__content-block-text">Рейтинг разработчиков мобильных приложений Москва</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="ourWork-swiper-block">
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
					'category'=> [53,54,55,56],
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
    </section>-->
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
            <h2 class="infoshel-h2 infoshel-main-ourWork__h2">Наши работы</h2>
            <span class="infoshel-main-ourWork__title-span">Мы превращаем идеи в отличные результаты</span>

            <ul class="infoshel-main-ourWork__buttons nav nav-pills" role="tablist">
                <li class="infoshel-main-ourWork__tab nav-item">
                    <a class="nav-link active" id="mobile_app-tab" data-toggle="pill" href="#mobile_app" role="tab" aria-controls="mobile_app" aria-selected="true">Моб. приложения</a>
                </li>
                <li class="infoshel-main-ourWork__tab nav-item">
                    <a class="nav-link" id="web_services-tab" data-toggle="pill" href="#web_services" role="tab" aria-controls="web_services" aria-selected="false">Веб-Сервисы</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div id="mobile_app" class="tab-pane active" role="tabpanel" aria-labelledby="mobile_app-tab">
                    <div class="infoshel-main-ourWork__flex-container">
                        <div class="infoshel-main-ourWork__text">
                            <h3>InfoShell.Mobile</h3>
                            <p>Разрабатываем мобильные IT-решения для fintch,<br>
                                e-commerce и маркетплейсов.<br><br>
                                С собственной продуктовой аналитикой, дизайном,<br>
                                веб и мобильной разработкой.</p>
                        </div>
                        <div class="infoshel-main-ourWork__video">
                            <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/yHoZVMRBhz4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            <? } ?>
                        </div>
                    </div>
                </div>
                <div id="web_services" class="tab-pane" role="tabpanel" aria-labelledby="web_services-tab">
                    <div class="infoshel-main-ourWork__flex-container">
                        <div class="infoshel-main-ourWork__text">
                            <h3>InfoShell.WebServices</h3>
                            <p>Мы помогаем крупному бизнесу создавать масштабные цифровые продукты:<br><br>
                                Веб-сервисы, CRM/ERP; корпоративные порталы, системы электронной коммерции (e-commerce); программы лояльности</p>
                        </div>
                        <div class="infoshel-main-ourWork__video">
                            <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/wFtIyKWlsYA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            <? } ?>
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


    <!-- CALC -->

    <section class="" style="padding:0;">
        <div id="calculator">
            <div class="container">
                <?php require __DIR__.'/calc/calculator.html'; ?>
            </div>
        </div>
    </section>

    <!-- Code to include calc -->
    <!--
<section id="calc">
    <div class="container">

        <header>
            <h3 class="h3">Калькулятор расчета цены за разработку приложения</h3>
            <p>Узнайте стоимость создания приложения, ответив на несколько простых вопросов!</p>
            <h4 class="h3"><b id="price">0</b> руб</h4>
        </header>

        <?php //require 'calc2/calc.inc.config.php'; ?>
        <?php //require 'calc2/calc.inc.php'; ?>

    </div>
</section>
-->
    <!-- /Code to include calc -->

    <section class="infoshel-main-blog">
        <div class="infoshel-main-blog__container">
            <h2 class="infoshel-h2 infoshel-main-blog__h2 wow fadeInDownMin2">Блог</h2>
            <div class="infoshel-main-blog-goto">
                <p>
                    Мы часто делимся своим опытом в нашем блоге на VC.ru. Следите за нашей активностью!
                </p>
                <a target="_blank" href="<?php echo $socialUrl['vc'];?>">
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
    <section class="infoshel-main-card">
        <div id="map"></div>
        <div class="infoshel-container">
            <div class="with-full-map">
                <div class="infoshel-main-card__accordion">
                    <div class="with-full-map__bg wow fadeInUp" data-wow-offset="100"></div>
                    <p class="infoshel-main-card__accordion__title infoshel-main-card__accordion__title-top wow fadeInUp"  data-wow-delay="0.8s">Контакты:</p>
                    <div id="accordion">
                        <?php $i=0;
                        foreach($contacts as $k=>$city){
                            $i++;
                            echo '<h3 class="',($i==1 ? 'active ' : ''),'wow fadeInUpMin" >',
                            ($i==1 ? '' : '<span class="infoshel-main-card__accordion-pointblack"></span>'),
                            'Россия, г. ',$city['city'],
                            '<span class="infoshel-main-card__accordion-checkon"></span></h3>',
                            '<div',($i==1 ? ' class="active"' : ''),'>',
                            '<p><b>Адрес:</b> ',$city['address'],'</p>',
                            '<p><b>Телефон</b>/факс: ',$city['tel'],'</p>',
                            '<p><b>E-mail:</b> <a href="mailto:',$contacts['moskow']['email'],'">',$contacts['moskow']['email'],'</a></p>',
                            '</div>';
                        } ?>
                    </div>
                    <p class="infoshel-main-card__accordion__title infoshel-main-card__accordion__title-bottom wow fadeInUpMin">Мы в социальных сетях:</p>
                    <div class="infoshel-main-card__accordion-list">
                        <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-fb wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['fb'];?>" target="_blank"></a>
                        <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-bh wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['bh'];?>" target="_blank"></a>
                        <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-ins wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['ins'];?>" target="_blank"></a>
                        <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-kcru wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['vc'];?>" target="_blank"></a>
                    </div>
                </div>
                <div class="infoshel-main-card-btn" data-toggle="modal" data-target="#exampleModalCenter">
                    Написать нам
                </div>
            </div>
        </div>
    </section>
    <div class="modal" id="email_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="whiteSquare"></div>
            <div class="blueSquare"></div>
            <div class="greenSquare"></div>
            <div class="modal-content yellow-bg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form_after_email">
                    <div class="email_form_text_book">
                        <img src="/wp-content/themes/mark_up/images/anim2.0.only-book_1.1.gif" alt="gif-book">
                    </div>
                    <div class="email_form_text top_text">
                        ВАША КНИГА УЖЕ ЖДЕТ ВАС НА ПОЧТЕ!
                    </div>
                    <div class="email_form_text middle_text">
                        Если не можете найти, проверьте папку “Спам”. И пометьте, что мы не спам :)
                    </div>
                    <div class="email_form_text bottom_text">
                        В соцсетях мы тоже делимся полезными материалами. Подписывайтесь!
                    </div>
                    <div class="social-links">
                        <img class="filter_black social-icon vk" src="/wp-content/themes/mark_up/images/vk-normal.svg"/>
                        <img class="filter_black social-icon fb" src="/wp-content/themes/mark_up/images/fb-normal.svg"/>
                        <img class="filter_black social-icon dr" src="/wp-content/themes/mark_up/images/dr-normal.svg"/>
                        <img class="filter_black social-icon bh" src="/wp-content/themes/mark_up/images/bh-normal.svg"/>
                    </div>
                </div>
                <div class="modal-body email_form">
                    <div class="email_form"><img src="/wp-content/themes/mark_up/img/book.png"></div>
                    <div class="email_form_text top_text_before">
                        УЗНАЙТЕ, ЧТО ДОЛЖНО БЫТЬ В УСПЕШНОМ И ПРИБЫЛЬНОМ ПРОЕКТЕ ПЕРЕД СТАРТОМ РАЗРАБОТКИ.
                    </div>
                    <div class="email_form_red">КНИГА АБСОЛЮТНО БЕСПЛАТНА.</div>
                    <div class="email-form-input">
                        <form id="form-book" action="/wp-content/themes/mark_up/mail/book.php" method="POST">
                            <input type="text" name="email" placeholder="Введите ваш e-mail адрес" required>
                            <button  type="submit" class="download_button">
                                Скачать
                            </button>
                        </form>
                    </div>
                </div>
                <div class="agreement">
                    Ознакомлен с
                    <a href="/privacy-policy/" class="policy-link"><u>политикой обработки персональных данных</u></a>
                </div>
            </div>
        </div>
    </div>
    <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<ecb25afb-cfce-4ea7-80df-ed4fc56c4af8>" type="text/javascript"></script>
    <script src="<?php echo $templateDir;?>/js/infoshell2_balloon_autopan.js" type="text/javascript"></script>
    <? } ?>
<?php require 'index.footer.php'; ?>