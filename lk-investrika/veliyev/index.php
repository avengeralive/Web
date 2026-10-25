    <div class="container-fluid home">

            <?php include './templates/'.$template.'/blocks/menu-top-home.php'; ?>


            <div class="slide-1 row">                
                <div class="col-md-9 col-xs-12">
                    <h1>WELCOME TO BlackDollar</h1>
                    
                    <p><span>Рекламодатели и вебмастера,</span> приветствуем вас на сайте BlackDollar.</p>
                    <p>Мы рекламная платформа, деятельность которой основана на модели cost-per-action (оплата-за-действие).</p>
                    <p>Сотрудничая с нами, <span>вебмастера получают деньги за арбитраж трафика,</span> приводя на сайты клиентов новую целевую аудиторию, а <span>партнеры получают новых пользователей, заказы, оплату по выгодной цене.</span> Заработок двух сторон доходит до десятков тысяч долларов.</p>

                    <h2>Монетизируйте свой бизнес вместе с нами!</h2>
                    
                    <a href="./signup.php"><button class="btn-def btn-signin">НАЧАТЬ РАБОТУ</button></a>
                </div> 
                <div class="col-md-3 col-xs-12">
                    <div class="social">
                        <ul>
                            <li><a target="_blank" href="https://vk.com/BDCPA"><img src="./templates/<?php echo $template; ?>/img/004-vk.png"></a></li>
                            <li><a href="#"><img src="./templates/<?php echo $template; ?>/img/003-facebook.png"></a></li>
                            <li><a href="#"><img src="./templates/<?php echo $template; ?>/img/telegram.png"></a></li>
                            <li><a href="#"><img src="./templates/<?php echo $template; ?>/img/002-instagram.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>

    </div>    

        <main>
   
            <section class="promo-home">
                <div class="container-fluid home">
                    <h1>АКЦИЯ</h1> 
                    <h2><span>Лидо</span>марафон</h2> 
                    <h3>призы за лиды</h3> 

                    <div class="row">
                        <div class="col-4 text-center">
                            <img src="./templates/<?php echo $template; ?>/img/promo_p1.png">
                            <div class="p-descr p1">
                                <p><span>1000</span> лидов</p>
                                <p><span>Iphone</span> 8 plus 64Gb</p>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <img src="./templates/<?php echo $template; ?>/img/promo_p2.png">
                            <div class="p-descr p2">
                                <p><span>700</span> лидов</p>
                                <p><span>Apple Watch</span> Series 3</p>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <img src="./templates/<?php echo $template; ?>/img/promo_p3.png">
                            <div class="p-descr p3">
                                <p><span>500</span> лидов</p>
                                <p><span>Apple</span> AirPods</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="slide-2" id="advantage">
                
                <div class="container-fluid home">
                
                <h1>Почему <span>более 1000 вебмастеров</span> работают с нами?</h1> 

                <div class="row items">
                    <div class="col item">
                        <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Group 340.png" alt="">
                        <p>Прибыльные<br>оферы</p>
                    </div>
                    <div class="col item">
                        <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Group 341.png" alt="">
                        <p>Досрочные<br>выплаты</p>
                    </div>
                    <div class="col item">
                        <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Group 342.png" alt="">
                        <p>Отличная<br>конверсия</p>
                    </div>
                    <div class="col item">
                        <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Group 343.png" alt="">
                        <p>Дружественный<br>саппорт</p>
                    </div>
                    <div class="col item">
                        <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Group 344.png" alt="">
                        <p>Удобная<br>статистика</p>
                    </div>
                    <div class="col item">
                        <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Group 345.png" alt="">
                        <p>Выплата<br>компенсаций</p>
                    </div>
                    <div class="col item">
                        <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Group 346.png" alt="">
                        <p>Акции<br>и Бонусы</p>
                    </div>
                </div>
                
                </div>

            </section>

        <div class="container-fluid home">    
            
            <!-- BEGIN OFFERS -->
            <section class="offers mb-100">

                <ul class="nav nav-tabs justify-content-center text-center" id="offers-tab">
                  <li class="nav-item">
                    <a class="nav-link active"  id="nav-top-offers-tab" data-toggle="tab" href="#top-offers" role="tab" aria-controls="nav-top-offers" aria-selected="true">Топ офферов</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-new-offers-tab" data-toggle="tab" href="" role="tab" aria-controls="nav-new-offers" aria-selected="false">Новые офферы</a>
                  </li> 
                </ul>

                <p class="sort"></p>

                <div class="tab-content" id="listOffers">
                  <div class="tab-pane fade show active" id="top-offers" role="tabpanel" aria-labelledby="top-offers">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th class="text-center" scope="col">Рейтинг</th>
                                <th class="text-center" scope="col">CR</th>
                                <th class="text-center" scope="col">EPC</th>
                                <th class="text-center" scope="col">Отчисления</th>
                            </tr>
                            </thead>
                            <?php
                            $offersHome = Offer::getOffersTop(5);
                            if (is_array($offersHome) && count($offersHome) > 0){
                                $i=0;
                                foreach($offersHome as $res_ok){
                                    $offer_id=$res_ok['id'];
                                    $offer_name=$res_ok['name'];
                                    
                                    $cr_view = $epc_view = 0;
                                    $cr_view = $res_ok['cr'];
                                    $epc_view = $res_ok['epc'];
                                    $offer_comission = explode('|', trim($res_ok['comission']));
                                    ?>

                                    <tr height="100px">
                                        <td class="align-middle " scope="col">
                                            <div style="white-space:nowrap;display: inline-block;">
                                            <?php 
                                            if (file_exists('./tmp/offer'.$offer_id.'.png')) 
                                                    {
                                                    ?>
                                            <img src="./tmp/offer<?php echo $offer_id; ?>.png" class="img-offer">
                                                    <?php
                                                    }
                                            ?>
                                            <span class="hidden-xs hidden-sm">&nbsp; <?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></span>    
                                            </div>      
                                        </td>
                                        <td class="text-center align-middle" scope="col">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 160.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 160.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 160.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 160.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 160.png" alt="">
                                        </td>
                                        <td class="text-center align-middle" scope="col"><?=round($cr_view, 2); ?>%</td>
                                        <td class="text-center align-middle" scope="col"><?=round($epc_view, 2); ?></td>
                                        <td class="text-center align-middle" scope="col"><?=$offer_comission[0]; ?> руб.</td>
                                    </tr>


                                    <?php
                                    //if($i==3 || $i==7){echo '</div>';}
                                    $i++;
                                }
                            }
                            ?>
                        </table>

                  </div>
                    <div class="tab-pane fade" id="new-offers" role="tabpanel" aria-labelledby="new-offers">

                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th class="text-center" scope="col">Рейтинг</th>
                                <th class="text-center" scope="col">CR</th>
                                <th class="text-center" scope="col">EPC</th>
                                <th class="text-center" scope="col">Отчисления</th>
                            </tr>
                            </thead>
                            <?php
                            $offersHome = Offer::getNewOffers(5);
                            if (is_array($offersHome) && count($offersHome) > 0){
                                $i=0;
                                foreach($offersHome as $res_ok){
                                    $offer_id=$res_ok['id'];
                                    $offer_name=$res_ok['name'];
                                    
                                    $cr_view = $epc_view = 'new';

                                    $offer_comission = explode('|', trim($res_ok['comission']));
                                    ?>

                                    <tr height="100px">
                                        <td class="align-middle" scope="col">
                                            <div style="white-space:nowrap;display: inline-block;">
                                            <?php 
                                            if (file_exists('./tmp/offer'.$offer_id.'.png')) 
                                                    {
                                                    ?>
                                            <img src="./tmp/offer<?php echo $offer_id; ?>.png" class="img-offer">
                                                    <?php
                                                    }
                                            ?>
                                            <span class="hidden-xs hidden-sm">&nbsp; <?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></span>    
                                            </div>
                                        </td>
                                        <td class="text-center align-middle" scope="col">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 161.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 161.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 161.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 161.png" alt="">
                                            <img class="img-fluid" src="./templates/<?php echo $template; ?>/img/Path 161.png" alt="">
                                        </td>
                                        <td class="text-center align-middle" scope="col"><?=$epc_view; ?></td>
                                        <td class="text-center align-middle" scope="col"><?=$cr_view; ?></td>
                                        <td class="text-center align-middle" scope="col"><?=$offer_comission[0]; ?> руб.</td>
                                    </tr>


                                    <?php
                                    //if($i==3 || $i==7){echo '</div>';}
                                    $i++;
                                }
                            }
                            ?>
                        </table>

                  </div>
                </div>



            </section>
            <!-- END OFFERS -->

        </div>    
            
        </main>
        
    

    <!-- BEGIN FOOTER -->
        <?php include './templates/'.$template.'/footer.php'; ?>
    <!-- END FOOTER -->
    