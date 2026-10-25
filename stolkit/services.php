<?
/*
Template name: Services
*/
get_header(); ?>
         <!-- top_menu -->
         <? the_post(); ?>

         <!-- top_menu -->
         <div class="row">
           <div class="container" style="padding: 50px 0px;">
             <div class="col-sm-12">
               <h1 style="color: #000; text-align: center; font-family: 'ALSSchlangesans-Black'; text-transform: uppercase; font-size: 50px;">Услуги</h1>
             </div>
             <? $services = get_posts(array('post_type' => 'services', 'posts_per_page' => 1000));
    foreach ($services as $service) { ?>   
              <div class="col-md-4">
                <div class="col-md-12">
                  <a href="<? echo $service->guid; ?>"><img src="<? echo get_the_post_thumbnail_url($service->ID); ?>" style="width: 100%;"></a>
                  <a href="<? echo $service->guid; ?>"><h2 style="font-size: 14px;"><? echo $service->post_title; ?></h2></a>
                </div>
              </div> 
            <? } ?>
           </div>
         </div>
         <!-- /.es1_main_bg -->
         <div class="es13_bg" style="height: auto !important; padding-bottom: 50px; margin-top: 0px !important;">
            <div class="es13_bg__text">
               наши сроки от 1 до 7 дней под ключ<br>
               <!--<img width="120px" height="120px" src="css/img/badg_op.png">-->
               <br>
               <small style="font-size: 50%;">замер&nbsp;&nbsp;&nbsp;&nbsp;<span>&bull;</span>&nbsp;&nbsp;&nbsp;&nbsp;производство&nbsp;&nbsp;&nbsp;&nbsp;<span>&bull;</span>&nbsp;&nbsp;&nbsp;&nbsp;монтаж</small>
            </div>
         </div>
         <div class="es13_14">
            <div class="container">
               <h3>ИСКУССТВЕННЫЙ КАМЕНЬ - ЛУЧШЕЕ РЕШЕНИЕ!</h3>
               <div class="row">
               <div class="col-md-6" style="text-align: center;">
                  <a class="yellow-button" href="#home1" aria-controls="home1" role="tab" data-toggle="tab" style="font-size: 16px;  width: 80%; margin: 10px 0px; font-family: ALSSchlangesans-Black !important;">Полезное видео</a>
                  <a class="yellow-button" href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="font-size: 16px; width: 80%; margin: 10px 0px; font-family: ALSSchlangesans-Black !important;">Сравнение материалов</a>
                  <a class="yellow-button" href="#messages" aria-controls="messages" role="tab" data-toggle="tab" style="font-size: 16px; width: 80%; margin: 10px 0px; font-family: ALSSchlangesans-Black !important;">Почему искусственный камень? </a>
               </div>
               <div class="col-md-6">
                  <div class="tab-content">
                     <div role="tabpanel" class="tab-pane active" id="home1">
                        <iframe width="100%" height="250" src="https://www.youtube.com/embed/RtXowVJPdQw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                     </div>
                     <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="h1">
                                 <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1"> Искусственный камень</a>
                                 </h4>
                              </div>
                              <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="h1">
                                 <div class="panel-body">
                                    <ul>
                                       <li>Мировая технология без швов!</li>
                                       <li>Возможно бесшовно интегрировать мойку</li>
                                       <li>Устойчив к кислотам и загрязнениям</li>
                                       <li>Не впитывает запахи</li>
                                       <li>1500 цветовых текстур на любой вкус</li>
                                       <li>Единственный материал, который подлежит реставрации</li>
                                       <li>Приятный на ощупь - комнатная температура</li>
                                       <li>Экологичный, имеет сертификаты и используется в медицине</li>
                                       <li>Герметичный бортик - отсутствие селиконовой прослойки</li>
                                       <li>Возможно придать изогнутую форму</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="h2">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2"> Кварцевый агломерат</a>
                                 </h4>
                              </div>
                              <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h2">
                                 <div class="panel-body">
                                    <ul>
                                       <li>Нет возможности бесшовного соединения</li>
                                       <li>Износостойкий, но хрупкий</li>
                                       <li>Не подлежит реставрации</li>
                                       <li>Высокая стоимость</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="h3">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3"> ДСП/ЛДСП</a>
                                 </h4>
                              </div>
                              <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h3">
                                 <div class="panel-body">
                                    <ul>
                                       <li>Не долговечный</li>
                                       <li>Стыки подвержены разрушению при контакте с влагой</li>
                                       <li>Покрытие - формальдегидная смола!</li>
                                       <li>Впитывает запахи и влагу</li>
                                       <li>Нет бесшовного соединения</li>
                                       <li>Бортики с силиконовой прослойкой - сложно ухаживать</li>
                                       <li>В стыки забивается грязь</li>
                                       <li>Подвержен царапинам</li>
                                       <li>Не термоустойчив</li>
                                       <li>Нет возможности придать изогнутую форму</li>
                                       <li>При скруглении угла -разрушается целостность, уменьшается срок службы</li>
                                       <li>Ограниченный размерный ряд</li>
                                       <li>Не ремонтопригоден</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="h4">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4"> Мрамор</a>
                                 </h4>
                              </div>
                              <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h4">
                                 <div class="panel-body">
                                    <ul>
                                       <li>Не долговечный</li>
                                       <li>Гигроскопичен - сложно выводить любые пятна</li>
                                       <li>Подвержен образованию плесени</li>
                                       <li>Холодный на ощупь</li>
                                       <li>Имеет естественный радиоактивный фон!</li>
                                       <li>Есть стыки</li>
                                       <li>Нет возможности бесшовно интегрировать мойку</li>
                                       <li>Подвержен царапинам</li>
                                       <li>Не подлежит реставрации</li>
                                       <li>Нет возможности придать изогнутую форму</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="h5">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5"> Гранит</a>
                                 </h4>
                              </div>
                              <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h5">
                                 <div class="panel-body">
                                    <ul>
                                       <li>Холодный на ощупь</li>
                                       <li>Нет возможности бесшовного соединения</li>
                                       <li>Тяжелый - может провиснуть мебель</li>
                                       <li>Изначально предназначен для экстерьера</li>
                                       <li>Тупит ножи</li>
                                       <li>Имеет радиоактивный фон (не проходит по стандартам)</li>
                                       <li>Гигроскопичен - сложно выводить любые пятна</li>
                                       <li>Холодный на ощупь</li>
                                       <li>Нет возможности бесшовно интегрировать мойку</li>
                                       <li>Не подлежит реставрации</li>
                                       <li>Нет возможности придать изогнутую форму</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="h6">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" aria-controls="collapse6"> Литьевой жидкий гранит и мрамор </a>
                                 </h4>
                              </div>
                              <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h6">
                                 <div class="panel-body">
                                    <ul>
                                       <li>Содержит полиэфирные токсичные смолы&nbsp;</li>
                                       <li>Нет сертификации в мире</li>
                                       <li>Слой камня 3-6 мм.&nbsp;</li>
                                       <li>Подложка ДСП - деформирует со временем камень</li>
                                       <li>Источает неприятных запах (мастера работают в противогазах)</li>
                                       <li>Тяжело выветривается полиэфирная смола</li>
                                       <li>Нет возможности сделать герметичный и эстетичный бортик (только аналог борта ДСП)</li>
                                       <li>Сильно царапается</li>
                                       <li>Имеет вид пластика</li>
                                       <li>Нет возможности придать изогнутую форму</li>
                                       <li>Ограничен по текстурам и расцветкам</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="h7">
                                 <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapse7"> Камень 35 мм</a>
                                 </h4>
                              </div>
                              <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h7">
                                 <div class="panel-body">
                                    <p>Литьевой жидкий гранит или мрамор, залитый в форму в полную толщину. Имеет все те же недостатки.&nbsp;</p>
                                    <p>Камень по мировому стандарту исключительно 12мм в толщину! Толщина изделия добирается путем использования подложки и бесшовного увеличения кромки! Стандарт кромки: 40мм.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div role="tabpanel" class="tab-pane" id="messages" style="height: 300px; overflow-y: scroll; border: 1px solid #000; padding: 15px; border-right: 4px solid #ffe710;">
                        <h2>Идеально ровная поверхность</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i1.jpg" style="float: right; height: 120px; margin-left: 5px;">
                        <p>На изделиях из искусственного камня нет швов и стыков. Если ваше изделие имеет например г-образную форму, шва вы никогда не заметите. А так же со столешницей можно бесшовно интегрировать мойку.</p>
                        <h2>Прочность и долговечность</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i2.jpg" style="float: left; height: 120px; margin-right: 5px;">
                        <p>На изделиях из искусственного камня нет швов и стыков. Если ваше изделие имеет например г-образную форму, шва вы никогда не заметите. А так же со столешницей можно бесшовно интегрировать мойку.</p>
                        <h2>Отсутствие пор - легко ухаживать</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i3.jpg" style="float: right; height: 120px; margin-left: 5px;">
                        <p>На изделиях из искусственного камня нет швов и стыков. Если ваше изделие имеет например г-образную форму, шва вы никогда не заметите. А так же со столешницей можно бесшовно интегрировать мойку.</p>
                        <h2>Ремонтопригодность</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i4.jpg" style="float: left; height: 120px; margin-right: 5px;">
                        <p>На изделиях из искусственного камня нет швов и стыков. Если ваше изделие имеет например г-образную форму, шва вы никогда не заметите. А так же со столешницей можно бесшовно интегрировать мойку.</p>
                        <h2>СОТНИ ЦВЕТОВ И ТЕКСТУР</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i5.jpg" style="float: right; height: 120px; margin-left: 5px;">
                        <p>Вам доступны более 1500 различных цветов. Текстуры под различные виды камня, такие как гранит и мрамор. А так же в искусственном камне есть цвета, многие из которых не возможно встретить в природе.</p>
                        <h2>ЭКОЛОГИЧНОСТЬ</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i6.jpg" style="float: left; height: 130px; margin-right: 5px;">
                        <p>Искусственный листовой камень препятствует размножению грибков, плесени и бактерий. Он не выделяет ни каких искусственных токсичных веществ в отличии от литьевого мрамора. Акриловая смола используется даже в стоматологии для производства пломб.</p>
                        <h2>РАЗНООБРАЗИЕ ФОРМ</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i7.jpg" style="float: right; height: 170px; margin-left: 5px;">
                        <p>Воплощайте ваши дизайнерские фантазии - ни каких ограничений по размеру или форме изделия. Искусственному камню можно придать любую форму и изгиб, а так же с легкостью можно интегрировать любые раковины и мойки путем бесшовного соединения.</p>
                        <h2>КОМНАТНАЯ ТЕМПЕРАТУРА</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i8.jpg" style="float: left; height: 130px; margin-right: 5px;">
                        <p>В отличии от натурального камня, искусственный никогда не бывает обжигающе холодным. Он создаст уют и комфорт в вашем доме, поэтому даже в районе окна столешница интегрированная в подоконник будет сохранять комнатную температуру.</p>
                        <h2>ЭРГОНОМИЧНОСТЬ</h2>
                        <img src="<? echo get_template_directory_uri(); ?>/img/pik/i9.jpg" style="float: right; height: 150px; margin-left: 5px;">
                        <p>Искусственный камень превосходно сочетает красоту и влагостойкость, обеспечивая удобство использования в любом помещении. Столешницы из искусственного камня в ванную комнату удобно объединит пространство, а столешница на кухню интегрированная в подоконник создаст дополнительную полезную поверхность.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <? get_template_part('templates/common/best'); ?>
      <!-- /.es2 -->
      <br><br><br>
      <div class="es13_14">
         <div class="container">
            <h3>КОМПАНИЯ “СТОЛКИТ”</h3>
            <h2>100% качество по цене от производителя!</h2>
            <div class="es13_14__desc">Компания “Столкит” производит и устанавливает изделия из искусственного камня по лучшей цене в Москве и области! Благодаря собственному производственному цеху, оснащенному по всем передовым технологиям уже более 10 лет компания является самой надежной и стабильной. Наши цены обусловлены тем, что мы имеем специальные условия среди поставщиков камня благодаря большим оборотам и отлаженные производственные и логистические процессы, которые позволяют экономить ресурсы.</div>
         </div>
      </div>
      <!-- /.es13_14 -->
      <div class="b-line"></div>
      <div class="es3">
         <h2 style="font-size:40px;">
            наши изделия
         </h2>
         <div class="container">
            <div class="es3__block">
               <div class="col-md-12 heroSlider-fixed ">
                  <div class="overlay">
                  </div>
                  <!-- Slider -->
                  <div class="slider responsive">
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/88.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em; display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li1.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left;">СТОЛЕШНИЦЫ/МОЙКИ НА КУХНЮ</strong>
                        </p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/izdelya/stolishnica_v_sanuzel.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li2.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left;">СТОЛЕШНИЦЫ В САНУЗЕЛ</strong></p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/1345.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li3.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left;">ИНТЕГРИРОВАННЫЕ МОЙКИ / РАКОВИНЫ</strong></p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/izdelya/podokonniki.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li4.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left; line-height: 60px;">ПОДОКОННИКИ</strong></p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/izdelya/stoyki _resepshn.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li5.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left; line-height: 60px;">СТОЙКИ РЕСЕПШН</strong></p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/izdelya/barnie_stoyki.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li6.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left; line-height: 60px;">БАРНЫЕ СТОЙКИ</strong></p>
                        <div class="es3_strzag"></div>
                     
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/izdelya/stoli.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li7.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left; line-height: 60px;">СТОЛЫ</strong></p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/izdelya/ekskluziv.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li8.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left; line-height: 60px;">ЭКСКЛЮЗИВ</strong></p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                     <div>
                        <img src="<? echo get_template_directory_uri(); ?>/img/izdelya/druqie_izdelie.jpg" alt="" />
                        <p style="text-align: left; font-size: 2.4em;display: block;">
                           <img src="<? echo get_template_directory_uri(); ?>/img/li9.svg" style="width: 60px; padding: 0px; float: left;">
                           <strong style="width: calc(100% - 60px); float: left; line-height: 60px;">ДРУГИЕ ИЗДЕЛИЯ</strong></p>
                        <div class="es3_strzag"></div>
                        
                        <a class="yellow-button" href="#">Подробнее</a>
                     </div>
                  </div>
                  <!-- control arrows -->
                  <div class="prev">
                     <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  </div>
                  <div class="next">
                     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  </div>
               </div>
               <!--<div class="zoom-gallery" id="zoom-instance-2" style="margin: 0px auto; width: 900px; height: 397px;">
                  <img width="55" alt="preloader" src="<? echo get_template_directory_uri(); ?>/img/preloader.gif" height="18" class="preloader">
                  
                             <ul>
                  
                  
                  
                  
                  
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/079/aranzacja_agat-opal_plus-novum-xii2010.jpg">
                  
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;">Стол    Цена: <span>3100 р.</span></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/803/60a4363a307cc71b2db17a6365b4a4f6.jpg">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;">Стул    Цена: <span>3100 р.</span></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/794/%D1%8F2.jpg">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;">Раковина    Цена: <span>3100 р.</span></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/66f/%D1%8F.jpg">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;">Кухня    Цена: <span>3100 р.</span></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/933/Razdvizhnyie-mezhkomnatnyi-derevyannyie-dveri-1-1024x768.jpg">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;">Шкаф    Цена: <span>3100 р.</span></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/94c/dvery_garmoshka.jpg">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;">Дверце    Цена: <span>3100 р.</span></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/733/dveri_steklo_vstavka.jpg">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;">Столешница    Цена: <span>3100 р.</span></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/d44/dveri_s_frezerovkoj.png">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;"></li>
                         </ul>
                     </li>
                     
                  
                     <li title="<? echo get_template_directory_uri(); ?>/upload/iblock/3e7/2.jpg">
                         <ul class="align-left">
                             <li class="20x308" style="background-color: none; color: #464545; font-size:2.4em; line-height:30px; height:auto;"></li>
                         </ul>
                     </li>
                  
                  
                             </ul>
                             
                         </div>-->
            </div>
         </div>
         <!-- /.container -->
         <div class="es3__podtext">
            <span>Любое изделие по выгодной акции</span>
            <span><img src="<? echo get_template_directory_uri(); ?>/img/es3_but.png" alt=""  data-toggle="modal" data-target="#kupitDeshevle"/></span>
         </div>
      </div>
      <!-- /.es3 -->
      <? get_template_part('templates/common/sms'); ?>
      <!-- /.b-sms_bg --><div class="b_greyblock_bg">
      <!-- <div class="container">
         <div class="b_greyblock__block">
           <div class="b_greyblock_ico b_greyblock_ico1"><a href="/mezhkomnatnye-dveri/">Межкомнатные двери</a></div>
           <div class="b_greyblock_ico b_greyblock_ico2"><a href="/vkhodnye-dveri/">Входные двери</a></div>
           <div class="b_greyblock_ico b_greyblock_ico3"><a href="/razdvizhnye-dveri/">Раздвижные двери</a></div>db
         </div>
         </div>-->
      </div>
      <!--<div class="es2" style="padding-bottom: 30px;">
      <style>
      .s2, .s3, .s4, .s5, .s6, .s7, .s8 { display: none; }
      .sh li { list-style: none; display: inline-block; }
      .st { display: block;
      color: #000;
      cursor: pointer;
      text-decoration: none;
      /*background: #ffe710;*/
      font-size: 20px;
      padding: 5px;
      width: 40px;
      height: 40px;
      line-height: 30px;
      border-radius: 20px; }
      .st.active {
      background: #ffe710;
      }
      .s1 li {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 10px;
      }
      .s1 li:hover {
      background: #f0f0f0;
      }
      .s1 li.active {
      background: #f0f0f0;
      border: 1px solid #ddd;
      }
      .models { display: none; }
      .edge li {
         list-style: none;
         display: inline-flex;
         width: calc(20% - 20px);
         justify-content: center;
         align-items: center;
         height: 100px;
         margin: 10px;
      }
      .calculator__slider-box__slider-width__slider__list6 li {
         list-style: none;
         display: inline-flex;
         width: calc(50% - 20px);
         justify-content: center;
         align-items: center;
         height: 100px;
         margin: 10px;
      }
      .edge li:hover {
         background: #f0f0f0;
      }
      .edge li.active {
         background: #f0f0f0;
         border: 1px solid #ddd;
      }
      </style>
      <script type="text/javascript">
         var data = {};
         //data.tip = 
      </script>
      <h3>Калькулятор</h3>
      <div class="es2_block">
      <div class="sh">
         <ul class="calculator__list">
            <li><a class="st st1 active" onclick="$('.ss').hide(); $('.s1').show(); $('.st').removeClass('active'); $(this).addClass('active');">1</a></li>
            <li><a class="st st2" onclick="$('.ss').hide(); $('.s2').show(); $('.st').removeClass('active'); $(this).addClass('active');">2</a></li>
            <li><a class="st st3" onclick="$('.ss').hide(); $('.s3').show(); $('.st').removeClass('active'); $(this).addClass('active');">3</a></li>
            <li><a class="st st4" onclick="$('.ss').hide(); $('.s4').show(); $('.st').removeClass('active'); $(this).addClass('active');">4</a></li>
            <li><a class="st st5" onclick="$('.ss').hide(); $('.s5').show(); $('.st').removeClass('active'); $(this).addClass('active');">5</a></li>
            <li><a class="st st6" onclick="$('.ss').hide(); $('.s6').show(); $('.st').removeClass('active'); $(this).addClass('active');">6</a></li>
            <li><a class="st st7" onclick="$('.ss').hide(); $('.s7').show(); $('.st').removeClass('active'); $(this).addClass('active');">7</a></li>
            <li><a class="st st8" onclick="$('.ss').hide(); $('.s8').show(); $('.st').removeClass('active'); $(this).addClass('active');">8</a></li>
         </ul>
      </div>
      <div class="s1 ss">
      <h2>Выбор формы</h2>
      <ul class="calculator">
      <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-0').show();">
      <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form1.png" alt="Прямая" style="height: 100px;">
      </li>
      <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-1').show();">
      <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form2.png" alt="Г - образная" style="height: 100px;">
      </li>
      <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-2').show();">
      <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form3.png" alt="П - образная" style="height: 100px;">
      </li>
      <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-3').show();">
      <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form4.png" alt="Радуга" style="height: 100px;">
      </li>
      </ul>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s1').hide(); $('.s2').show(); $('.st').removeClass('active'); $('.st2').addClass('active');">Далее</a>
      </div>
      <div class="s2 ss">
      <h2>Выбор размера</h2>
      <ul class="calculator_models">
      <li class="models-0 models active">
      <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
      <input type="text" class="size size-left" alt="Размер Слева" value="900">
      <img src="<? echo get_template_directory_uri(); ?>/img/model/model11.png" alt="">
      </li>
      <li class="models-1 models">
      <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
      <input type="text" class="size size-left" alt="Размер Слева" value="1 200">
      <input type="text" class="size size-right" alt="Размер Справа" value="1 200">
      <input type="text" class="size size-bottom" alt="Размер Снизу" value="900">
      <img src="<? echo get_template_directory_uri(); ?>/img/model/model44.png" alt="">
      </li>
      <li class="models-2 models">
      <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
      <input type="text" class="size size-left" alt="Размер Слева" value="1 200">
      <input type="text" class="size size-right" alt="Размер Справа" value="1 200">
      <input type="text" class="size size-left-bottom" alt="Размер Слева Снизу" value="900">
      <input type="text" class="size size-right-bottom" alt="Размер Справа Снизу" value="900">
      <input type="text" class="size size-center" alt="Размер По центру" value="900">
      <img src="<? echo get_template_directory_uri(); ?>/img/model/model33.png" alt="">
      </li>
      <li class="models-3 models">
      <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
      <input type="text" class="size size-left" alt="Размер Слева" value="900">
      <input type="text" class="size size-left-left" alt="Размер Слева Слева" value="1 200">
      <img src="<? echo get_template_directory_uri(); ?>/img/model/model22.png" alt="">
      </li>
      </ul>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s2').hide(); $('.s1').show(); $('.st').removeClass('active'); $('.st1').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s2').hide(); $('.s3').show(); $('.st').removeClass('active'); $('.st3').addClass('active');">Далее</a>
      </div>
      <div class="s3 ss">
      <h2>Выбор текстуры</h2>
      <div class="view active" id="grandex_1" style="box-sizing: border-box; height: 350px;">
         <div class="topr" style="width: 100%; float: left; height: 80px; overflow-x: scroll;">
            <div style="height: 80px;">
               <a class="yellow-button" style="cursor: pointer; margin: 0 10px;">model 1</a>
               <a class="yellow-button" style="cursor: pointer; margin: 0 10px;">model 2</a>
               <a class="yellow-button" style="cursor: pointer; margin: 0 10px;">model 2</a>
               <a class="yellow-button" style="cursor: pointer; margin: 0 10px;">model 2</a>
               <a class="yellow-button" style="cursor: pointer; margin: 0 10px;">model 2</a>
            </div>
         </div>
         <div class="leftr" style="width: 20%; float: left; overflow-y: scroll; height: 220px;">
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 1</a>
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 2</a>
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 1</a>
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 2</a>
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 1</a>
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 2</a>
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 1</a>
            <a class="yellow-button" style="cursor: pointer; margin: 10px 0;">prod 2</a>
         </div>
         <div class="all" style="width: 80%; float: left;">
            <div class="el" data-name="Dirty Sand" data-id="S-201" onclick="$('.el').removeClass('active');
            $(this).addClass('active');">
            <figure><img class="lazy" data-src="http://kamnelon.ru/assets/img/textures/grandex/s-201.jpg" alt="Dirty Sand" src="http://kamnelon.ru/assets/img/textures/grandex/s-201.jpg" style="opacity: 1;"></figure>
            <span>Dirty Sand <small>S-201</small></span>
            </div>
            <div class="el" data-name="Peaceful Night" data-id="S-202" onclick="$('.el').removeClass('active');
            $(this).addClass('active');">
            <figure><img class="lazy" data-src="http://kamnelon.ru/assets/img/textures/grandex/s-202.jpg" alt="Peaceful Night" src="http://kamnelon.ru/assets/img/textures/grandex/s-202.jpg" style="opacity: 1;"></figure>
            <span>Peaceful Night <small>S-202</small></span>
            </div>
            <div class="el" data-name="Sparkling Sand" data-id="S-203" onclick="$('.el').removeClass('active');
            $(this).addClass('active');">
            <figure><img class="lazy" data-src="http://kamnelon.ru/assets/img/textures/grandex/s-203.jpg" alt="Sparkling Sand" src="http://kamnelon.ru/assets/img/textures/grandex/s-203.jpg" style="opacity: 1;"></figure>
            <span>Sparkling Sand <small>S-203</small></span>
            </div>
         </div>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s3').hide(); $('.s2').show(); $('.st').removeClass('active'); $('.st2').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s3').hide(); $('.s4').show(); $('.st').removeClass('active'); $('.st4').addClass('active');">Далее</a>
      </div>
      <div class="s4 ss">
      <h2>Наличие криволинейных участков</h2>
      <div class="general-width">
      <form action="action" class="for-form clearfix">
      <p class="for-form__button  for-click--no" onclick="$('.for-click').removeClass('active'); $('.for-click--no').addClass('active');">Нет</p>
      <div class="for-form__buttons">
      <p class="for-click" onclick="$('.for-click').addClass('active'); $('.for-click--no').removeClass('active');">Есть</p><input class="figure" value="">
      </div>
      <div class="clear"></div>
      <p class="for-form__question">Сколько</p>
      </form>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s4').hide(); $('.s3').show(); $('.st').removeClass('active'); $('.st3').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s4').hide(); $('.s5').show(); $('.st').removeClass('active'); $('.st5').addClass('active');">Далее</a>
      </div>
      <div class="s5 ss">
      <h2>Выбор формы кромки</h2>
      <ul class="calculator__slider-box__slider-width__slider__list edge">
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img1.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img2.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img3.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img4.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img5.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img6.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img7.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img8.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img9.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img10.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img11.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img12.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img13.png" alt="">
      </li>
      <li>
      <img src="<? echo get_template_directory_uri(); ?>/img/form-img14.png" alt="">
      </li>
      </ul>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s5').hide(); $('.s4').show(); $('.st').removeClass('active'); $('.st4').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s5').hide(); $('.s6').show(); $('.st').removeClass('active'); $('.st6').addClass('active');">Далее</a>
      </div>
      <div class="s6 ss">
      <h2>Выбор формы бортиков</h2>
      <ul class="calculator__slider-box__slider-width__slider__list6">
      <li>
      <div class="calculator__slider-box__slider-width__slider__list__block-form">
      <img src="<? echo get_template_directory_uri(); ?>/img/form2-img1.png" alt="Прямолинейный">
      </div>
      <p class="calculator__slider-box__slider-width__slider__list__description">Прямолинейный</p>
      </li>
      <li>
      <div class="calculator__slider-box__slider-width__slider__list__block-form">
      <img src="<? echo get_template_directory_uri(); ?>/img/form2-img2.png" alt="Интегрированный">
      </div>
      <p class="calculator__slider-box__slider-width__slider__list__description">Интегрированный</p>
      </li>
      <li>
      <div class="calculator__slider-box__slider-width__slider__list__block-form">
      <img src="<? echo get_template_directory_uri(); ?>/img/form2-img3.png" alt="Интегрированный">
      </div>
      <p class="calculator__slider-box__slider-width__slider__list__description">BACK SPLASH</p>
      </li>
      </ul>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s6').hide(); $('.s5').show(); $('.st').removeClass('active'); $('.st5').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s6').hide(); $('.s7').show(); $('.st').removeClass('active'); $('.st7').addClass('active');">Далее</a>
      </div>
      <div class="s7 ss">
      <h2>Наличие вырезов под технику</h2>
      <div class="general-width">
      <form action="action" class="for-form clearfix">
      
      <div class="for-form__buttons for-form__buttons--radio">
         <label>Нет</label>
      <label>Под варочную панель</label>
      <label>Под мойку</label>
      </div>
      </form>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s7').hide(); $('.s6').show(); $('.st').removeClass('active'); $('.st6').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s7').hide(); $('.s8').show(); $('.st').removeClass('active'); $('.st8').addClass('active');">Далее</a>
      </div>
      <div class="s8 ss">
      <h2>Дополнительные опции</h2>
      <div class="general-width">
      <form action="action" class="for-form clearfix">
      <div class="for-form__buttons--checkbox">
      <label onclick="$(this).toggleClass('active')">Замер</label>
      <label onclick="$(this).toggleClass('active')">Монтаж</label>
      <label onclick="$(this).toggleClass('active')">Доставка</label>
      </div>
      </form>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s8').hide(); $('.s7').show(); $('.st').removeClass('active'); $('.st7').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;">Рассчитать стоимость</a>
      </div>
      </div>
      </div>-->
      <? get_template_part('templates/common/recalc'); ?>
      <? get_template_part('templates/common/free'); ?>
      <? get_template_part('templates/common/claimer'); ?>
      <? get_template_part('templates/common/timer'); ?>
      <? get_template_part('templates/common/textures'); ?>
      <? get_template_part('templates/common/claim'); ?>
      <? get_template_part('templates/common/reviews'); ?>
      <? get_template_part('templates/common/portfolio'); ?>
      <? get_template_part('templates/common/free_consultation'); ?>
      <? get_template_part('templates/common/contacts'); ?>
      <? get_footer(); ?>