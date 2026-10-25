<?php
/*
Template Name: New.Infoshell "iOS"
*/
require 'index.header.php';
?>
    <section class="infoshel-article-page__firstSlide">
        <div class="infoshel-container container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="infoshel-article-page__firstSlide-text">
                        <h2 class="infoshel-h2"><?php the_title(); ?></h2>
                        <p>
                            Команда <b>Infoshell</b> предлагает создание приложений для <b>iPhone, iPad</b> с учетом
                            индивидуальных требований бизнеса. Мы осуществляем разработку для <b>iOS</b> в соответствии
                            с техническим заданием или видением заказчика.<br><br>
                            Получите у менеджеров <b>Infoshell</b> консультацию. Вам станет понятно, нужно ли вам
                            мобильное приложение и какое приложение необходимо: на <b>Android</b> или <b>iOS</b>.<br><br>
                            Оставив заявку на создание приложений для <b>iPhone</b>, вы получите готовые решения
                            по автоматизации бизнеса, а по истечению срока разработки - готовое приложение.
                        </p>
                        <button class="infoshel-button mt-4" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="infoshel-article-page__firstSlide-ios-img"></div>
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
            <h2 class="infoshel-h2">Мы делаем:</h2>
            <div class="row infoshel-article-page__webService-row">
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="infoshel-article-page__webService-block">
                        <div class="infoshel-article-page__webService-block-bg"></div>
                        <span>для бизнеса</span>
                        <h4>Приложения для любой сферы бизнеса: </h4>
                        <ul>
                            <li>- Pитейл</li>
                            <li>- FMCG</li>
                            <li>- E-commerce</li>
                            <li>- Логистика</li>
                            <li>- И др</li>
                        </ul>
                        <div class="infoshel-article-page__webService-block-bottom">
                            <button class="infoshel-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="infoshel-article-page__webService-block">
                        <div class="infoshel-article-page__webService-block-bg"></div>
                        <span>Банки и финансы</span>
                        <h4>Приложения для сферы финансов:</h4>
                        <ul>
                            <li>- B2B и B2C ДБО</li>
                            <li>- Инвестиционные сервисы</li>
                            <li>- Сервисы оповещения</li>
                        </ul>
                        <div class="infoshel-article-page__webService-block-bottom">
                            <button class="infoshel-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                        </div>

                    </div>
                </div>

                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="infoshel-article-page__webService-block">
                        <div class="infoshel-article-page__webService-block-bg"></div>
                        <span>Lifestyle</span>
                        <h4>Lifestyle-приложения</h4>
                        <ul>
                            <li>- Мода</li>
                            <li>- Новости</li>
                            <li>- Культура</li>
                            <li>- Путешествия</li>
                            <li>- Здоровье</li>
                            <li>- Отдых и досуг</li>
                        </ul>
                        <div class="infoshel-article-page__webService-block-bottom">
                            <button class="infoshel-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                        </div>

                    </div>
                </div>

                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="infoshel-article-page__webService-block">
                        <div class="infoshel-article-page__webService-block-bg"></div>
                        <span>Соц. сети</span>
                        <h4>Приложения  социальных сетей:</h4>
                        <ul>
                            <li>- Мобильные соц.  сети</li>
                            <li>- Мессенджеры</li>
                            <li>- и другие рограммы для общения</li>
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
                    'category'=>'54',
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
                <div id="mobile_app" class="tab-pane active" role="tabpanel" aria-labelledby="mobile_app-tab">
                    <div class="infoshel-main-ourWork__flex-container">
                        <div class="infoshel-main-ourWork__text">
                            <h3>InfoShell.Mobile</h3>
                            <p>Разрабатываем мобильные IT-решения для fintch,<br>
                                e-commerce и маркетплейсов.<br><br>
                                С собственной продуктовой аналитикой, дизайном,<br>
                                веб и мобильной разработкой.
                            </p>
                        </div>
                        <div class="infoshel-main-ourWork__video">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/yHoZVMRBhz4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="infoshel-article-page__orderWeb color-grey">
        <div class="infoshel-container container">
            <h2 class="infoshel-h2">Заказать iOS разработку у нас</h2>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="infoshel-article-page__orderWeb-block">
                        <div class="infoshel-article-page__orderWeb-block-img">
                            <div class="infoshel-article-page__orderWeb-icon-rocket-yellow"></div>
                            <span>Более 50 реализованных iOS-приложений</span>
                        </div>

                        <p>Мы разрабатываем приложения разных типов: от корпоративных бизнес-приложений до социальных сетей и игр, от приложений по автоматизации до банковских клиентов.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="infoshel-article-page__orderWeb-block">
                        <div class="infoshel-article-page__orderWeb-block-img">
                            <div class="infoshel-article-page__orderWeb-icon-head-yellow"></div>
                            <span>Опытная  команда</span>
                        </div>
                        <p>У нас слаженный коллектив программистов высшего уровня, разработавших вместе большое количество проектов.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="infoshel-article-page__orderWeb-block">
                        <div class="infoshel-article-page__orderWeb-block-img">
                            <div class="infoshel-article-page__orderWeb-icon-arms-yellow"></div>
                            <span>Oриентация на цели заказчика</span>
                        </div>
                        <p>Наша главная задача – помочь клиенту решить его проблемы и задачи. Мы индивидуально подходим к каждому проекту и разрабатываем именно то, что поможет нашему заказчику достигнуть поставленных целей.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="infoshel-article-page__orderWeb-block">
                        <div class="infoshel-article-page__orderWeb-block-img">
                            <div class="infoshel-article-page__orderWeb-icon-mountain-yellow"></div>
                            <span>Успешный опыт и надежность</span>
                        </div>
                        <p>Большой опыт продвижения продуктов в ТОП AppStore.
                            С нами сотрудничают такие компании как ФК Зенит, Faberlic, Radio Record и другие известные бренды.</p>
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
    <section class="infoshel-main-development-stages">
        <div class="container">
            <h3 class="infoshel-h2 infoshel-main-development-stages__h2">Этапы разработки</h3>
            <ol class="development-stages">
                <li class="development-stages--stage">
                    <div class="development-stages--stage-image"><img alt="консультация клиента" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/1.png" ></div>
                    <div class="development-stages--stage-content">
                        <div class="relative">
                            <span class="development-stages--stage-head">1. Идея проекта и консультация</span>
                            <div class="develop-tooltip"><span>?</span>
                                <div class="develop-tooltip-content">
                                        <p><strong>Идея и консультация</strong></p>
                                        <p>Почти всегда идея, с которой клиенты приходят к нам, требует аналитики и доработки. Эта работа необходима, чтобы на старте четко понимать, что мы имеем и в каком направлении двигаться, а также, чтобы продумать стратегию создания лучшего продукта.</p>
                                        <p>На этом этапе мы проводим аналитику рынка приложений/веб-сервисов по выбранной тематике, выявляем лидеров и находим примеры плохой реализации, определяем критерии их успеха или провала. Мы изучаем продукты конкурентов с точки зрения интерфейсных решений, ориентирования на конечного пользователя, выполнения сервисом своих целей и задач и выявляем их преимущества и недостатки.</p>
                                        <p>Полученные знания проецируем на будущее приложение, формируем представление о конечном продукте, о пользователях и их целях, и в результате получаем видение будущего проекта, зафиксированное в документе - project vision.</p>
                                        <p>После консультации с нашим специалистом у Вас появится точное понимание, как сделать так чтобы проект выстрелил.</p>
                                        <p>Приступаем к работе!</p>
                                </div>
                            </div>
                        </div>
                        <p class="development-stages--stage-text">Люди приходят к нам в компанию не просто, чтобы заказать мобильное приложение, но чтобы воплотить в жизнь свои идеи или автоматизировать бизнес-процессы. Наши разработчики и аналитики бесплатно проконсультируют вас.</p>
                    </div><img alt="разбор идеи" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/idea.png" width="107" height="112" class="idea">
                </li>
                <li class="development-stages--stage">
                    <div class="development-stages--stage-image"><img alt="оценка затрат" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/2.png" ></div>
                    <div class="development-stages--stage-content">
                        <div class="relative">
                            <span class="development-stages--stage-head">2. Оценка проекта и предложение</span>
                            <div class="develop-tooltip"><span>?</span>
                                <div class="develop-tooltip-content">
                                        <p><strong>Оценка проекта и предложение</strong></p>
                                        <p>После составления project vision проекта наша команда разработчиков оценивает примерные трудозатраты на реализацию продукта. Исходя из поставленных задач и технологических ограничений, составляется оценка количества часов, необходимых на создание вашего продукта.</p>
                                        <p>На основе полученной оценки формируется предварительное коммерческое предложение, в которое входит описание похожих проектов, реализованных нашей компанией, состав команды разработчиков и профессиональный уровень каждого участника,  стоимость всего проекта с разбиением на этапы.</p>
                                        <p>На коммерческом предложении в дальнейшем будет основан договор.</p>
                                </div>
                            </div>
                        </div>
                        <p class="development-stages--stage-text">Разработчик производит оценку проекта. После чего клиент получает предварительную стоимость мобильного программного обеспечения.</p>
                    </div>
                </li>
                <li class="development-stages--stage">
                    <div class="development-stages--stage-image"><img alt="обсуждение и договор о сотрудничестве" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/3.png" ></div>
                    <div class="development-stages--stage-content">
                        <div class="relative">
                            <span class="development-stages--stage-head">3. Бэклог и договор</span>
                            <div class="develop-tooltip"><span>?</span>
                                <div class="develop-tooltip-content">
                                        <p><strong>Бэклог и договор</strong></p>
                                        <p>Далее, команда разработчиков вместе с продукт оунером (Product Owner)* и Заказчиком составляет второй единый документ приложения - Бэклог Продукта**.</p>
                                        <br>
                                        <p>* продукт оунер – руководитель проекта</p>
                                        <br>
                                        <p>Ответственность за содержимое бэклога, его упорядочение и доступность всем членам проекта несет Product Owner. Он также ответственен за достижение максимальной ценности продукта и работы, выполняемой командой, поэтому непрерывно анализирует текущий ход работ над продуктом и ищет способы по улучшения его. Эту роль может исполнять как человек со стороны заказчика, так и сотрудник нашей компании.</p>
                                        <br>
                                        <p>**бэклог – список задач для команды разработчиков, которые полностью описывают проект</p>
                                        <br>
                                        <p>Документ представляет собой иерархическую структуру из пользовательских возможностей и технических требований, упорядоченных по очередности реализации, более важный функционал будет реализован раньше остальных. Каждому элементу Бэклога присваиваться описание, порядковый номер, оценка объема работы и ценность. Это позволяет просчитать окончательную стоимость продукта.</p>

                                        <p>Договор в первую очередь обеспечивает полную прозрачность проводимых работ для заказчика и позволяет ему контролировать процесс от А до Я на каждом этапе. Все этапы прописываются отдельно, что позволяет производить оплату выполненной работы по факту сдачи.</p>
                                        <p>Бэклог – гибкий документ, который позволяет Заказчику вносить даже серьезные изменения в продукт по ходу разработки, ведь большинство новаторских идей придумываются уже в ходе выполнения проекта. Дополнительный функционал оформляется в виде доп. соглашений к договору, в которых отмечается, сдвинет ли реализация вносимых изменений сроки завершения этапов проекта.</p>
                                </div>
                            </div>
                        </div>
                        <p class="development-stages--stage-text">Встреча с продукт-оунером, обсуждение ключевых деталей. Разработчик составит бэклог на весь проект совместно с заказчиком. После утверждения бэклога, с заказчиком подписывается договор.</p>
                    </div>
                </li>
                <li class="development-stages--stage-preinner">
                    <div class="development-stages--stage-image"><img alt="планирование" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/4.png" ></div>
                    <div class="development-stages--stage-content">
                        <div class="relative">
                            <span class="development-stages--stage-head">4. Планирование спринта</span>
                            <div class="develop-tooltip"><span>?</span>
                                <div class="develop-tooltip-content">
                                        <p><strong>Планирование спринта</strong></p>
                                        <p>Сердцем Scrum* является Спринт** длительностью в одну или две недели, в течение которых создается потенциально готовая к выпуску и использованию часть продукта. </p>
                                        <br>
                                        <p>*Scrum – гибкая методология создания, по который мы ведем проекты</p>
                                        <p>** Спринт-этап в рамках которого реализуется определенная часть проекта</p>
                                        <br>
                                        <p>Обычно длительность Спринта является постоянной на протяжении всего периода разработки. Следующий Спринт начинается сразу же по окончании предыдущего.</p>
                                        <p>Спринт состоит из списка того, какие функции нужно разработать и гибкого плана, служащего ориентиром в работе по проекту. Ресурсом для планирования спринта является Бэклог Продукта.</p>
                                        <p>Объем работ на предстоящий Спринт определяется во время планирования Спринта в ходе совместной работы всей команды.</p>
                                        <p>При планировании Спринта команда отвечает на следующие вопросы:</p>
                                        <p>•	Цель Спринта, или каков будет результат выполнения запланированных на него работ?</p>
                                        <p>•	Как будет выполняться программирование?</p>
                                </div>
                            </div>
                        </div>
                        <p class="development-stages--stage-text">Договоренность с заказчиком о том какие задачи будут выполнены на ближайшем спринте.</p>
                    </div>
                </li>
                <li class="development-stages--stage-inner">
                    <div class="development-stages--stage-arrow-up">Проект пока <br>не завершен</div>
                    <div class="development-stages--stage-arrow-down"></div>
                    <div class="development-stages--stage-image"><img alt="демонстрация тестового продукта" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/5.png" ></div>
                    <div class="development-stages--stage-content">
                        <div class="relative">
                            <span class="development-stages--stage-head">5. Ретроспектива</span>
                            <div class="develop-tooltip"><span>?</span>
                                <div class="develop-tooltip-content">
                                        <p><strong>Ретроспектива спринта</strong></p>
                                        <p>Каждый день в течение Спринта в определенное время проходят Скрам митинги - 15-минутные встречи/созвоны для команды разработчиков с целью синхронизации действий и создания плана работы на ближайшие 24 часа.</p>
                                        <p>В конце Спринта, после демонстрации Заказчику результата работы, команда проводит ретроспективу. Ретроспектива дает команде возможность инспектировать себя и определить успешные/неудачные моменты работы. И что самое важное, в процессе ретроспективы команда находит пути улучшения качества разрабатываемого продукта и применяет их в течение следующего Спринта.</p>
                                </div>
                            </div>
                        </div>
                        <p class="development-stages--stage-text">Демонстрация заказчику результатов разработки за неделю. Команда анализирует риски и проблемы, завершает спринт, оптимизирует дальнейший процесс написания мобильного программного продукта.</p>
                    </div>
                    <div class="clock"><img alt="отчет о проделанной работе" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/clock.png"  width="99" height="78"><b>24 часа</b><span>Каждый день команда отчитывается продукт-оунеру о выполненных задачах.</span></div>
                </li>
                <li class="development-stages--stage-last">
                    <div class="development-stages--stage-last-arrow-down">проект завершен</div>
                    <div class="development-stages--stage-image"><img alt="задача завершена" src="https://infoshell.ru/wp-content/themes/mark_up/img1/stages/6.png" ></div>
                    <div class="development-stages--stage-content">
                        <span class="development-stages--stage-head">6. Мобильное приложение создано.</span>
                        <p class="development-stages--stage-text">Клиент получает отменное готовое приложение, который можно использовать по назначению.</p>
                    </div>
                </li>
            </ol>
            <!-- /development-stages-->
        </div>
        <!-- /container-->
    </section>

    <!--
    <section class="infoshel-article-page__list-services">
        <div class="infoshel-container container">
            <h2 class="infoshel-h2">Преимущества разработки приложений для iOS</h2>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="infoshel-article-page__list-services-column">
                        <div class="infoshel-article-page__list-services-block">
                            <div class="infoshel-article-page__list-services-block-img">
                                <i class="infoshel-article-page__list-services-icon-russia"></i>
                            </div>
                            <p>Россия на 9 месте по доходу с iOS-приложений и на 5 месте по числу загрузок в AppStore.*</p>
                        </div>

                        <div class="infoshel-article-page__list-services-block">
                            <div class="infoshel-article-page__list-services-block-img">
                                <i class="infoshel-article-page__list-services-icon-dollar"></i>
                            </div>
                            <p>10 млрд. $ – выручка разработчиков за 2017 год.*</p>
                        </div>

                        <div class="infoshel-article-page__list-services-block">
                            <div class="infoshel-article-page__list-services-block-img">
                                <i class="infoshel-article-page__list-services-icon-iphone"></i>
                            </div>
                            <p>Каждую секунду из магазина загружается около 850 программ и игр для iPhone и iPad.*</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="infoshel-article-page__orderWeb-column">
                        <div class="infoshel-article-page__list-services-block">
                            <div class="infoshel-article-page__list-services-block-img">
                                <i class="infoshel-article-page__list-services-icon-phone"></i>
                            </div>
                            <p>На апрель 2016 года россияне купили и используют почти 10 млн IPhone различных поколений и 3 млн IPad (итого 13 млн устройств в России).</p>
                        </div>

                        <div class="infoshel-article-page__list-services-block">
                            <div class="infoshel-article-page__list-services-block-img">
                                <i class="infoshel-article-page__list-services-icon-bag"></i>
                            </div>
                            <p>30 млрд $ - общая сумма выручки создателей мобильных приложений за всю историю существования магазина.*</p>
                        </div>

                        <div class="infoshel-article-page__list-services-block">
                            <div class="infoshel-article-page__list-services-block-img">
                                <i class="infoshel-article-page__list-services-icon-apple"></i>
                            </div>
                            <p>Более платежеспособная аудитория: AppStore приносит на 70% больше доходов чем Google Play.*</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 infoshel-article-page__list-services-bottom-text">
                    <p>*по данным AppAnnie на конец 2017 года</p>
                </div>
            </div>
        </div>
    </section>
    //-->

    <!-- Code to include calc -->
    <!--<section id="calc">
    <div class="container">
        <header>
            <h3 class="h3">Стоимость разработки приложения для iOS</h3>
            <p>Воспользуйтесь калькулятором расчета цены на создание мобильного приложения под операционную систему iOS, заполнив несколько полей!</p>
            <h4 class="h3"><b id="price">0</b> руб</h4>
        </header>

        <?php //require 'calc2/calc.inc.config.php'; ?>
        <?php //require 'calc2/calc.inc.php'; ?>

    </div>
</section>//-->
    <!-- /Code to include calc -->

    <section class="infoshel-main-itProduct">
        <div class="infoshel-main-itProduct__container infoshel-container container">
            <h2 class="infoshel-h2 infoshel-main-itProduct__h2">Зачем нужно мобильное приложение?</h2>
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