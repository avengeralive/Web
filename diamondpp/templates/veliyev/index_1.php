    <div class="container">
        
        <div class="row first-screen">

            <?php include './templates/'.$template.'/blocks/menu-top-home.php'; ?>


            <div class="slide-1 row align-items-center justify-content-center">                
                <div class="col-9">
                    <h1>WELCOME TO BlackDollar</h1>
                    <p>
                    Рекламодатели и вебмастера, приветствуем вас на сайте BlackDollar. Мы рекламная платформа, деятельность которой основана на модели cost-per-action (оплата-за-действие). Сотрудничая с нами, вебмастера получают деньги за арбитраж трафика, приводя на сайты клиентов новую целевую аудиторию, а партнеры получают новых пользователей, заказы, оплату по выгодной цене. Заработок двух сторон доходит до десятков тысяч долларов. 
                    <br>
                    Монетизируйте свой бизнес вместе с нами!
                    </p>
                    <button class="btn-def btn-signin"></button>
                </div> 
                
                <div class="social">
                    <ul>
                        <li><a href="#"><img src="./templates/<?php echo $template; ?>/img/004-vk.png"></a></li>
                    </ul>
                    <ul>
                        <li><a href="#"><img src="./templates/<?php echo $template; ?>/img/003-facebook.png"></a></li>
                    </ul>
                    <ul>
                        <li><a href="#"><img src="./templates/<?php echo $template; ?>/img/telegram.png"></a></li>
                    </ul>
                    <ul>
                        <li><a href="#"><img src="./templates/<?php echo $template; ?>/img/002-instagram.png"></a></li>
                    </ul>
                </div>
                
            </div>

            <div class="row align-items-end justify-content-center" style="width: 100%;">
                <div class="col-12">
                    <a class="next-slide" href="#advantage">
                    <button class="btn-next btn-def"></button>
                    </a>
                </div>    
            </div>

        </div>

        <main>

            <section class="slide-2" id="advantage">
                <h3>ПОЧЕМУ БОЛЕЕ <span style="color:#00C8AD">1000 ВЕБМАСТЕРОВ</span> РАБОТАЮТ С НАМИ?</h3> 

                <div class="row items">
                    <div class="col item">
                        <img src="./templates/<?php echo $template; ?>/img/Group 340.png" alt="logo">
                        <p>Прибыльные<br>оферы</p>
                    </div>
                    <div class="col item">
                        <img src="./templates/<?php echo $template; ?>/img/Group 341.png" alt="logo">
                        <p>Досрочные<br>выплаты</p>
                    </div>
                    <div class="col item">
                        <img src="./templates/<?php echo $template; ?>/img/Group 342.png" alt="logo">
                        <p>Отличная<br>конверсия</p>
                    </div>
                    <div class="col item">
                        <img src="./templates/<?php echo $template; ?>/img/Group 343.png" alt="logo">
                        <p>Дружественный<br>саппорт</p>
                    </div>
                    <div class="col item">
                        <img src="./templates/<?php echo $template; ?>/img/Group 344.png" alt="logo">
                        <p>Удобная<br>статистика</p>
                    </div>
                    <div class="col item">
                        <img src="./templates/<?php echo $template; ?>/img/Group 345.png" alt="logo">
                        <p>Выплата<br>компенсаций</p>
                    </div>
                    <div class="col item">
                        <img src="./templates/<?php echo $template; ?>/img/Group 346.png" alt="logo">
                        <p>Акции<br>и Бонусы</p>
                    </div>
                </div>

            </section>

            <!-- BEGIN OFFERS -->
            <section class="offers">

                <ul class="nav nav-tabs justify-content-center">
                  <li class="nav-item">
                    <a class="nav-link active"  id="nav-top-offers-tab" data-toggle="tab" href="#top-offers" role="tab" aria-controls="nav-top-offers" aria-selected="true">Топ офферов</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="nav-new-offers-tab" data-toggle="tab" href="#new-offers" role="tab" aria-controls="nav-new-offers" aria-selected="false">Новые офферы</a>
                  </li>
                </ul>

                <p class="sort"></p>

                <div class="tab-content" id="listOffers">
                  <div class="tab-pane fade show active" id="top-offers" role="tabpanel" aria-labelledby="top-offers">
                        <table class="table table-borderless">
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Рейтинг</th>
                                <th scope="col">EPC</th>
                                <th scope="col">CR</th>
                                <th scope="col">Гео-положение</th>
                                <th scope="col">Условия</th>
                            </tr>

                            <?php
                            $offersHome = Offer::getOffersTop(3);
                            if (is_array($offersHome) && count($offersHome) > 0){
                                $i=0;
                                foreach($offersHome as $res_ok){
                                    $offer_id=$res_ok['id'];
                                    $offer_name=$res_ok['name'];
                                    //if($i==0 || $i==4){echo '<div class="row clearfix">';}
                                    ?>

                                    <tr>
                                        <td scope="col">
                                            <?php 
                                            if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
                                                    {
                                                    ?>
                                                    <img src="./tmp/offer<?php echo $offer_id; ?>.jpg">
                                                    <?php
                                                    }
                                            ?>
                                            &nbsp;&nbsp;&nbsp; <?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>        
                                        </td>
                                        <td scope="col">Рейтинг</td>
                                        <td scope="col">EPS</td>
                                        <td scope="col">CR</td>
                                        <td scope="col">Гео-положение</td>
                                        <td scope="col">Условия</td>
                                    </tr>


                                    <?php
                                    //if($i==3 || $i==7){echo '</div>';}
                                    $i++;
                                }
                            }
                            ?>
                        </table>

                        <a class="view-all" href="">
                            <button class="btn-view-all btn-def"></button>
                        </a>

                  </div>
                  <div class="tab-pane fade" id="new-offers" role="tabpanel" aria-labelledby="new-offers">

                      ..new-offers..

                  </div>
                </div>



            </section>
            <!-- END OFFERS -->

        </main>
        
    </div>

    <!-- BEGIN FOOTER -->
        <?php include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
    