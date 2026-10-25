<? get_header(); ?>
        <section id="slider">
            <div class="slider owl-carousel">
                <? $slider = get_field('slajder', get_the_ID()); 
                foreach ($slider as $slide) { 
                $img = $slide['kartinka'];
                ?>
                <div class="slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-5 middletext wow fadeInLeft">
                                        <h2><?=$slide['zagolovok_slajda']; ?></h2>
                                        <p><?=$slide['podzagolovok_slajda']; ?></p>
                                        <a href="<?=$slide['ssylka_knopki']; ?>"><?=$slide['tekst_knopki']; ?></a>
                                    </div>
                                    <div class="col-7 wow fadeInRight">
                                        <img src="<?=wp_get_attachment_image_url($img, 'full'); ?>" alt="<?=get_post_meta($img, '_wp_attachment_image_alt', TRUE);?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                    </div>    
                </div>
                <? } ?>
            </div>
        </section>
        <section id="production">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 heading text-center">
                        <h2>Ювелирные украшения</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-2">
                        <a href="product-category/braslety/">
                            <div class="category-item">
                                <img src="<?=get_template_directory_uri();?>/images/m1.png">
                                <p>Браслеты</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <a href="/product-category/podveski/">
                            <div class="category-item">
                                <img src="<?=get_template_directory_uri();?>/images/m2.png">
                                <p>Подвески</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <a href="/product-category/kolcza/">
                            <div class="category-item">
                                <img src="<?=get_template_directory_uri();?>/images/m3.png">
                                <p>Кольца</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <a href="/product-category/sergi/">
                            <div class="category-item">
                                <img src="<?=get_template_directory_uri();?>/images/m4.png">
                                <p>Серьги</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <a href="/product-category/drugie-izdeliya/">
                            <div class="category-item">
                                <img src="<?=get_template_directory_uri();?>/images/m5.png">
                                <p>Другие изделия</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <a href="/zvyozdnye-kollekcii/">
                            <div class="category-item">
                                <img src="<?=get_template_directory_uri();?>/images/m6.png">
                                <p>Здёздные коллекции</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="proposals">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 heading text-center">
                        <h2>Что мы предлагаем</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 proposal">
                        <p><span class="number">1</span>Преимущество украшений компании Velvetin
                            Jewellery заключается не только в их
                            оригинальном дизайне, но и вариативности
                            любого изделия. Можно выбрать как цвет
                            золота (белое, желтое или красное), так и
                            драгоценные камни для декорирования
                            (бриллианты и сапфиры любых цветов,
                            рубины, гранаты, цавориты и пр.), а также
                            различные их сочетания.</p>
                    </div>
                    <div class="col-md-4 proposal">
                        <p><span class="number">2</span>Мы можем реализовать любой уникальный
                            эскиз серег, браслета, кольца, подвески,
                            цепочки. Мы предлагаем Вам придумать
                            украшение самостоятельно! Оно будет
                            изготовлено в минимальные сроки. Можно
                            заказать гравировку (например, имя, дата
                            рождения, вес и рост при рождении, любые
                            аббревиатуры и т.д.).</p>
                    </div>
                    <div class="col-md-4 proposal">
                        <p><span class="number">3</span>Каждый заказ компании Velvetin Jewellery
                            будет доставлен Вам в индивидуальной
                            подарочной упаковке.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 proposal">
                        <p><span class="number">4</span>Мы работаем исключительно официально,
                            имеем всю необходимую разрешительную
                            документацию: лицензии на производство,
                            продажу и ремонт ювелирных изделий.</p>
                    </div>
                    <div class="col-md-4 proposal">
                        <p><span class="number">5</span>При покупке Вы получаете все то, что
                            получили бы в любом ювелирном магазине:
                            изделие с пробой, опробированную бирку
                            на изделии со всеми характеристикам и
                            кассовый чек при оплате наличными..</p>
                    </div>
                    <div class="col-md-4 proposal">
                        <p><span class="number">6</span>На все изделия компании Velvetin Jewellery
                            предоставляется гарантия 6 месяцев..</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="star">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 heading text-center">
                        <h2>Звёздные клиенты</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10 p0">
                        <div class="owl-carousel star-carousel">
                            <? $clients = get_posts(['post_type' => 'clients', 'numberposts' => -1, 'order' => 'asc']); 
                            foreach ($clients as $client) {
                            ?>
                            <div class="star-item">
                                <a href="/zvyozdnye-klienty/">
                                    <img src="<?=get_field('foto_krugloe', $client->ID); ?>" style="border-radius:50%;">
                                    <p><?=$client->post_title;?></p>
                                </a>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </section>
        <section id="promo">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 heading text-center promocolor">
                        <h2>Акции</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="promo-item">
                                    <span class="date">03.09.2018</span>
                                    <p>Скидка на коллекцию “Carpe Diem”</p>
                                    <a href="#">Подробнее</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="promo-item">
                                    <span class="date">21.09.2018</span>
                                    <p>Многодетным мамам - подарки и скидки!</p>
                                    <a href="#">Подробнее</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="promo-item">
                                    <span class="date">10.08.2018</span>
                                    <p>Акция на покупку двух и более изделий
                                        из коллекции “Гранаты” от
                                        Анастасии Цветаевой</p>
                                    <a href="#">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </section>
<? get_footer(); ?>