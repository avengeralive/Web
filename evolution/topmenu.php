<div class="top-menu-holder">
    <div class="container">
        <nav class="top-menu">
            <ul>
                <li class="home">
                    <a href="<?= SITE_DIR ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>


                <li>
                    <a class="tm-dropdown" target="#menu-point-1">О клинике</a>
                </li>
			<!--	<li><a href="/about/foto_rabot.php">Фото работ</a></li>-->
                <li>
                    <a class="tm-dropdown" target="#menu-point-2">Мы предлагаем</a>
                </li>

                <li>
                    <a class="tm-dropdown" target="#menu-point-3">Проблемы-решения</a>
                </li>

                <li>
                    <a href="/price/">Прейскурант</a>
                </li>

                <li>
                    <a href="/about/news.php">Новости и акции</a>
                </li>

                <li>
                    <a href="/contacts/">Контакты</a>
                </li>
                <li><button type="submit" class="btn" id="header-search"><i class="fa fa-search"></i></button></li>
                <form id="search-form" method="get" action="/about/search.php" class="">
                                <input type="text" name="q" placeholder="Поиск по клинике" class="form-control">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </form>
            </ul>


            <div class="tm-dropdown-menu" id="menu-point-1" style="z-index:5!important;">
                <div>
                    <h3>О клинике</h3>

					<ul>
                        <li><a href="/about/">Клиника Evolution</a></li>
                        <li><a href="/about/doctors.php">Специалисты клиники</a></li>
    
                      <li><a href="/about/park-tehniki.php">Парк техники</a></li>      
<li><a href="/about/partners.php">Наши друзья и партнеры</a></li>
                          
                    </ul>           
                </div>
            </div>


            <div class="tm-dropdown-menu" id="menu-point-2">
                <div>
                    <h3>Аппаратные процедуры</h3>
                    <ul>
                        <li><a href="/procedures/non_surgical_facelift.php">Безоперационная подтяжка лица</a></li>
                        <li><a href="/procedures/laser_rejuvenation.php">Лазерное омоложение</a></li>
                        <li><a href="/procedures/laser_epilation.php">Лазерная эпиляция</a></li>
                   <!--    <li><a href="/procedures/laser-resurfacing.php">Лазерная шлифовка</a></li>-->
                        <li><a href="/procedures/double_chin_correction.php">Коррекция второго подбородка</a></li>
                        <li><a href="/procedures/photorejuvenation.php">Фотоомоложение</a></li>
                        <li><a href="/procedures/neck_rejuvenation.php">Омоложение шеи</a></li>
                        <li><a href="/procedures/rf-lifting.php">RF-лифтинг</a></li>
                        <li><a href="/procedures/tattoo-removal-laser.php">Удаление татуировки лазером</a></li>
                        <li><a href="/procedures/tatouage-removal-laser.php">Удаление татуажа лазером</a></li>                      
                    </ul>
                </div>

                <div>
                    <h3>Инъекционные процедуры</h3>
                    <ul>
                        <li><a href="/procedures/botox.php">Инъекции Ботокса</a></li>
                        <li><a href="/procedures/contour_plasty.php">Контурная пластика</a></li>
                        <li><a href="/procedures/lip-augmentation.php">Увеличение губ</a></li>
                        <li><a href="/procedures/biorevitalization.php">Биоревитализация</a></li>
                        <li><a href="/procedures/mesotherapy.php">Мезотерапия</a></li>
                       <li><a href="/procedures/plasmolifting.php">Плазмолифтинг</a></li>
                        <li><a href="/procedures/double_chin_correction.php">Коррекция второго подбородка</a></li>
                    </ul>
                </div>

                <div>
                    <h3>Эстетические услуги</h3>
                    <ul>
                        <li><a href="/procedures/micropigmentation.php">Перманентный макияж</a></li>
                        <li><a href="/procedures/face-cleaning.php">Чистка лица</a></li>
                        <li><a href="/procedures/chemical-peeling.php">Химический пилинг</a></li>
                        <li><a href="/procedures/massage.php">Массаж</a></li>
                        <li><a href="/procedures/metabolic_balance.php">Метаболик Баланс</a></li>
                        <li><a href="/procedures/podiatry.php">Услуги подолога</a></li>
                        <li><a href="/procedures/medical_pedicure.php">Медицинский педикюр</a></li>
                        <li><a href="/procedures/treatment_ingrown_nail.php">Лечение вросшего ногтя</a></li>
                        <li><a href="/procedures/plantar_wart_removal.php">Удаление подошвенной бородавки</a></li>
                    </ul>
                </div>
                 <div>

                   <h3>Услуги для мужчин</h3>
                    <ul>
                        <li><a href="/procedures/tattoo-removal-laser.php">Удаление татуировки лазером</a></li>
                        <li><a href="/problems/gipergidroz.php">Повышенное потоотделение</a></li>
                        <li><a href="/problems/dryablaya-koza.php">Дряблая кожа</a></li>
                        <li><a href="/problems/morshiny.php">Морщины</a></li>
<li><a href="/problems/bruises-under-the-eyes.php">Синяки под глазами</a></li>
<li><a >Выпадение волос, облысение</a></li>
<li><a href="/procedures/massage.php">Массаж</a></li>
<li><a >Коррекция возрастных изменений</a></li>
                    </ul>
                </div>
            </div>




            <div class="tm-dropdown-menu" id="menu-point-3">
                <div>
                    <h3>Возрастные изменения</h3>
                    <ul>
                        <li><a href="/problems/morshiny.php">Морщины</a></li>
                        <li><a href="/problems/dryablaya-koza.php">Дряблая кожа</a></li>
                        <li><a href="/problems/drooping_eyelids.php">Нависшие веки</a></li>
                        <li><a href="/problems/eye_bags.php">Мешки под глазами</a></li>
                        <li><a href="/problems/bruises-under-the-eyes.php">Синяки под глазами</a></li>
                        <li><a href="/problems/nasolacrimal-furrow.php">Носослезная борозда</a></li>
                        <li><a href="/problems/nasolabial-folds.php">Носогубные складки</a></li>
                        <li><a href="/problems/sagging_cheeks.php">Обвисшие щеки</a></li>
                        <li><a href="/problems/vtoroj-podborodok.php">Второй подбородок</a></li>                        
                    </ul>
                </div>

                <div>
                    <h3>Проблемная кожа</h3>
                    <ul>
                        <li><a href="/problems/acne.php">Акне (угревая болезнь)</a></li>
                        <li><a href="/problems/postacne.php">Постакне (рубцовые изменения)</a></li>
                        <li><a href="/problems/rozacea.php">Розацеа</a></li>
                        <li><a href="/problems/kuperoz.php">Купероз кожи</a></li>                        
                        <li><a href="/problems/enlarged_pores.php">Расширенные поры</a></li>
                        <li><a href="/problems/dry-skin.php">Сухая кожа</a></li>
                        <li><a href="/problems/hyperpigmentation.php">Гиперпигментация</a></li>
                        <li><a href="/problems/novoobrazovanija.php">Новообразования</a></li>
                    </ul>
                </div>

                <div>
                    <h3>Тело</h3>
                    <ul>
                        <li><a href="/problems/gipergidroz.php">Повышенное потоотделение</a></li>
                        <li><a href="/problems/vroshie-volosy.php">Вросшие волосы</a></li>
                        <li><a href="/problems/novoobrazovanija.php">Новообразования</a></li>
                        <li><a href="/problems/hyperpigmentation.php">Гиперпигментация</a></li>
                        <li><a href="/problems/over_weight.php">Лишний вес</a></li>
                        <li><a href="/problems/stretch-marks.php">Растяжки, стрии</a></li>

                        <li><a href="/problems/mozoli.php">Мозоли</a></li>
                        <li><a href="/problems/ingrown_nail.php">Вросший ноготь</a></li>
                        <li><a href="/problems/plantar_wart.php">Подошвенная бородавка</a></li>

                    </ul>
                </div>


                <div>
                    <h3>Волосы</h3>
                    <ul>
                        <li><a >Выпадение волос, облысение</a></li>
                        <li><a >Ломкие волосы</a></li>
                        <li><a >Ослабленные волосы</a></li>
                        <li><a >Гирсутизм</a></li>
                        <li><a >Гипертрихоз</a></li>
                    </ul>
                </div>
                
            </div>




        </nav>
    </div>
</div>
