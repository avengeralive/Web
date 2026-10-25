<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Ваш профиль</h1>
        </div>
        <? include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>
    <div class="row grow">
        <div class="col-xl-8">
            <h3 class="empty"></h3>
            <div class="block">
                <div class="row irow h150">
                    <div class="col-lg-8">
                        <img src="./tmp/avatars/<?=$user_ava; ?>" class="avatar_client">
                        <p><?=$user_name; ?></p>
                        <p><?=$user_email; ?></p>
                        <p>ID: <?=$user_id; ?>,<?=$user_login;?></p>
                    </div>
                    <div class="col-lg-2">
                        <p>Баланс</p>
                        <p><?php echo number_format($user_balance, 0, ',', ' '); ?> ₽</p>
                    </div>
                    <div class="col-lg-2">
                        <p>В ожидании</p>
                        <p><?php echo number_format($user_hold, 0, ',', ' '); ?> ₽</p>
                    </div>
                </div>
                <div class="row irow bortop">
                    <div class="block col-lg-4 p00">
                        <a href="./profile.php" class="edit">Редактировать профиль</a>
                    </div>
                    <div class="block col-lg-3 p00">
                        <a href="./finances.php" class="withdraw">Вывести средства</a>
                    </div>
                    <div class="block col-lg-5 text-right p00">
                        <?php if($email_check == 0){ ?>
                            <a href="/post/verifyemail.php?mode=1" class="not_verified" id="email-verify">E-mail</a>
                        <? } else { ?>
                            <a href="#" class="verified" id="email-verify">E-mail</a>
                        <? } ?>
                        <?php if($phone_check == 0){ ?>
                            <a href="#" class="not_verified" id="sms-verify">Телефон</a>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <h3>Ваш личный менеджер</h3>
            <div class="block">
                <div class="row irow h150">
                    <div class="col-xl-12">
                        <img src="./tmp/avatars/photo2.png" class="avatar_client">
                        <p>Илона</p>
                        <p class="online">online</p>
                    </div>
                </div>
                <div class="row irow bortop">
                    <div class="block col-sm-3 col-md-2">
                        <a href="skype:<?=$settings_skype; ?>?add"><img src="./img/skype.svg"></a>
                    </div>
                    <div class="block col-sm-3 col-md-2">
                        <a href="https://vk.com/<?=$settings_vk; ?>"><img src="./img/vk.svg"></a>
                    </div>
                    <div class="block col-sm-3 col-md-2">
                        <a href="https://t.me/<?=$settings_telegram; ?>"><img src="./img/telegram.svg"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row grow">
        <div class="col-xl-12">
            <div class="block">
                <h3 class="md20">Cтатистика за последние 30 дней <ul class="legend">
                    <li><div style="width: 16px; height: 16px; background: #A4A1FB; border-radius: 4px;"></div> Принято</li>
                    <li><div style="width: 16px; height: 16px; background: #5FE3A1; border-radius: 4px;"></div> Отклонено</li>
                    <li><div style="width: 16px; height: 16px; background: #FDA397; border-radius: 4px;"></div> Треш</li>
                    <li><div style="width: 16px; height: 16px; background: #FFDA83; border-radius: 4px;"></div> В ожидании</li>
                </ul></h3>
                
                <?php
                    $arr_zakaz_all = [];
                    $arr_zakaz_ok = [];
                    $arr_zakaz_wait = [];
                    $arr_zakaz_cancel = [];
                    $arr_zakaz_trash = [];
                    
                    $days = [];

                $db = DB::getInstance();
                
                for($i=30;$i>=0;$i--){
                    $date_s = time() - 60 * 60 * 24 * $i;
                    
                    $start = date("Y-m-d 00:00:00", $date_s);
                    $end = date("Y-m-d 23:59:59", $date_s);
                    
                    $zakaz_all = 0;
                    $zakaz_ok = 0;
                    $zakaz_wait = 0;
                    $zakaz_cancel = 0;
                    $zakaz_trash = 0;
                    
                    
                    $sql = "SELECT 
                            (select count(*) FROM zakaz where date between '$start' and '$end' and user_id=" . $user_id . ") zakaz_all,
                            (select count(*) FROM zakaz where date between '$start' and '$end' and user_id=" . $user_id . " and status=1) zakaz_wait, 
                            (select count(*) FROM zakaz where date between '$start' and '$end' and user_id=" . $user_id . " and status in (2,3)) zakaz_ok, 
                            (select count(*) FROM zakaz where date between '$start' and '$end' and user_id=" . $user_id . " and status=0) zakaz_cancel,
                            (select count(*) FROM zakaz where date between '$start' and '$end' and user_id=" . $user_id . " and status=5) zakaz_trash";

                    $res = $db->query($sql)->fetchObject();
                    
                    $date_zakaz = explode("-", date('d-m-Y', $date_s));
                    $date_zakaz = $date_zakaz[0] .'.'.$date_zakaz[1];
                    
                    $zakaz_all = $res->zakaz_all;
                    $zakaz_wait = $res->zakaz_wait;
                    $zakaz_ok = $res->zakaz_ok;
                    $zakaz_cancel = $res->zakaz_cancel;
                    $zakaz_trash = $res->zakaz_trash;
                    
                    $arr_zakaz_all[] = $zakaz_all;
                    $arr_zakaz_ok[] = $zakaz_ok;
                    $arr_zakaz_wait[] = $zakaz_wait;
                    $arr_zakaz_cancel[] = $zakaz_cancel;
                    $arr_zakaz_trash[] = $zakaz_trash; 
                    
                    $days[] = $date_zakaz;  
                    

                }
                ?>
                <style>
                #chartdiv {
                  width: 100%;
                  height: 500px;
                }

                </style>

                <!-- Resources -->
                <script src="https://www.amcharts.com/lib/4/core.js"></script>
                <script src="https://www.amcharts.com/lib/4/charts.js"></script>
                <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

                <!-- Chart code -->
                <script>
                /*am4core.ready(function() {



                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                var chart = am4core.create("chartdiv", am4charts.XYChart);
                chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                chart.data = [
                <? foreach ($days as $key => $value) { ?>
                    {
                        category: "<? echo $value; ?>",
                        value1: <? echo $arr_zakaz_wait[$key]; ?>,
                        value2: <? echo $arr_zakaz_trash[$key]; ?>,
                        value3: <? echo $arr_zakaz_cancel[$key]; ?>,
                        value4: <? echo $arr_zakaz_ok[$key]; ?>
                    },
                <? } ?>
                ];

                chart.colors.step = 0;
                chart.padding(30, 30, 10, 30);
                chart.legend = new am4charts.Legend();

                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "category";
                categoryAxis.renderer.grid.template.location = 0;
                //categoryAxis.renderer.inside = true;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.min = 0;
                //valueAxis.max = 100;
                //valueAxis.strictMinMax = true;
                valueAxis.renderer.inside = true;
                valueAxis.renderer.labels.template.disabled = true;
                valueAxis.extraMax = 0.1;
                valueAxis.calculateTotals = true;
                valueAxis.renderer.minWidth = 50;
                valueAxis.reverseOrder = true;


                var series1 = chart.series.push(new am4charts.ColumnSeries());
                series1.columns.template.width = am4core.percent(80);
                series1.columns.template.fill = am4core.color("#A4A1FB");
                series1.columns.template.stroke = am4core.color("#A4A1FB");;
                series1.columns.template.tooltipText =
                  "{name}: {valueY}";
                series1.name = "Принято";
                series1.dataFields.categoryX = "category";
                series1.dataFields.valueY = "value4";
                series1.sequencedInterpolation = true;
                //series1.dataFields.valueYShow = "totalPercent";
                //series1.dataItems.template.locations.categoryX = 0.5;
                series1.stacked = true;
                series1.tooltip.pointerOrientation = "vertical";

                var bullet1 = series1.bullets.push(new am4charts.LabelBullet());
                bullet1.interactionsEnabled = false;
                //bullet1.label.text = "{valueY}";
                bullet1.label.fill = am4core.color("#ffffff");
                bullet1.locationY = 0.5;

                var series2 = chart.series.push(new am4charts.ColumnSeries());
                series2.columns.template.width = am4core.percent(80);
                series2.columns.template.fill = am4core.color("#5FE3A1");
                series2.columns.template.stroke = am4core.color("#5FE3A1");
                series2.columns.template.tooltipText =
                  "{name}: {valueY}";
                series2.name = "Отклонено";
                series2.dataFields.categoryX = "category";
                series2.dataFields.valueY = "value3";
                series2.sequencedInterpolation = true;
                //series2.dataFields.valueYShow = "totalPercent";
                //series2.dataItems.template.locations.categoryX = 0.5;
                series2.stacked = true;
                series2.tooltip.pointerOrientation = "vertical";

                var bullet2 = series2.bullets.push(new am4charts.LabelBullet());
                bullet2.interactionsEnabled = false;
                //bullet2.label.text = "{valueY}";
                bullet2.locationY = 0.5;
                bullet2.label.fill = am4core.color("#ffffff");

                var series3 = chart.series.push(new am4charts.ColumnSeries());
                series3.columns.template.width = am4core.percent(80);
                series3.columns.template.fill = am4core.color("#FDA397");
                series3.columns.template.stroke = am4core.color("#FDA397");
                series3.columns.template.tooltipText =
                  "{name}: {valueY}";
                series3.name = "Треш";
                series3.dataFields.categoryX = "category";
                series3.dataFields.valueY = "value2";
                series3.sequencedInterpolation = true;
                //series3.dataFields.valueYShow = "totalPercent";
                //series3.dataItems.template.locations.categoryX = 0.5;
                series3.stacked = true;
                series3.tooltip.pointerOrientation = "vertical";

                var bullet3 = series3.bullets.push(new am4charts.LabelBullet());
                bullet3.interactionsEnabled = false;
                //bullet3.label.text = "{valueY}";
                bullet3.locationY = 0.5;
                bullet3.label.fill = am4core.color("#ffffff");

                var series4 = chart.series.push(new am4charts.ColumnSeries());
                series4.columns.template.width = am4core.percent(80);
                series4.columns.template.fill = am4core.color("#FFDA83");
                series4.columns.template.stroke = am4core.color("#FFDA83");
                series4.columns.template.tooltipText =
                  "{name}: {valueY}";
                series4.name = "В ожидании";
                series4.dataFields.categoryX = "category";
                series4.dataFields.valueY = "value1";
                series4.sequencedInterpolation = true;
                //series4.dataFields.valueYShow = "totalPercent";
                //series4.dataItems.template.locations.categoryX = 0.5;
                series4.stacked = true;
                series4.tooltip.pointerOrientation = "vertical";

                var bullet4 = series4.bullets.push(new am4charts.LabelBullet());
                bullet4.interactionsEnabled = false;
                //bullet4.label.text = "{valueY}";
                bullet4.locationY = 0.5;
                bullet4.label.fill = am4core.color("#ffffff");

                var totalSeries = chart.series.push(new am4charts.ColumnSeries());
                totalSeries.dataFields.valueY = "none";
                totalSeries.dataFields.categoryX = "category";
                totalSeries.stacked = true;
                totalSeries.hiddenInLegend = true;
                totalSeries.columns.template.strokeOpacity = 0;

                var totalBullet = totalSeries.bullets.push(new am4charts.LabelBullet());
                totalBullet.dy = -20;
                totalBullet.label.text = "{valueY.total}";
                totalBullet.label.hideOversized = false;
                totalBullet.label.fontSize = 18;
                totalBullet.label.background.fill = totalSeries.stroke;
                totalBullet.label.background.fillOpacity = 0.2;
                totalBullet.label.padding(5, 10, 5, 10);

                //chart.scrollbarX = new am4core.Scrollbar();

                

                }); // end am4core.ready() */
                </script>
                <div id="chartdiv">
                    <? $sum = array(); $max = 0; foreach ($days as $key => $value) { $sum[$key] = $arr_zakaz_wait[$key] + $arr_zakaz_trash[$key] + $arr_zakaz_cancel[$key] + $arr_zakaz_ok[$key]; if ($sum[$key] > $max) $max = $sum[$key]; } $max = $max*1.2; ?>
                    <? foreach ($days as $key => $value) { ?>
                    <div style="height: 100%; width: calc(100% / <? echo count($days); ?>); padding: 0 10px; float: left; transform: rotate(180deg); position: relative;" class="cluster">
                        <div style="height: 50px; width: 100%; writing-mode: vertical-rl; text-orientation: mixed;"><? echo $value; ?></div>
                        <div style="height: <? echo $arr_zakaz_wait[$key] * 100 / $max; ?>%; width: 100%; background: #FFDA83;"></div>
                        <div style="height: <? echo $arr_zakaz_trash[$key] * 100 / $max; ?>%; width: 100%; background: #FDA397;"></div>
                        <div style="height: <? echo $arr_zakaz_cancel[$key] * 100 / $max; ?>%; width: 100%; background: #5FE3A1;"></div>
                        <div style="height: <? echo $arr_zakaz_ok[$key] * 100 / $max; ?>%; width: 100%; background: #A4A1FB;"></div>
                        <div class="g_ttp">
                            <table style="width: 100%; z-index: 1;">
                                <tr>
                                    <td></td>
                                    <td>Всего</td>
                                    <td><? echo $sum[$key]; ?></td>
                                </tr>
                                <tr>
                                    <td><div style="width: 16px; height: 16px; background: #A4A1FB; border-radius: 4px;"></div></td>
                                    <td>Принято</td>
                                    <td><? echo $arr_zakaz_ok[$key]; ?></td>
                                </tr>
                                <tr>
                                    <td><div style="width: 16px; height: 16px; background: #5FE3A1; border-radius: 4px;"></div></td>
                                    <td>Отклонено</td>
                                    <td><? echo $arr_zakaz_cancel[$key]; ?></td>
                                </tr>
                                <tr>
                                    <td><div style="width: 16px; height: 16px; background: #FDA397; border-radius: 4px;"></div></td>
                                    <td>Треш</td>
                                    <td><? echo $arr_zakaz_trash[$key]; ?></td>
                                </tr>
                                <tr>
                                    <td><div style="width: 16px; height: 16px; background: #FFDA83; border-radius: 4px;"></div></td>
                                    <td>В ожидании</td>
                                    <td><? echo $arr_zakaz_wait[$key]; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <? } ?>
                    <style>
                        .g_ttp { display: none; transform: rotate(180deg);  }
                        .cluster:hover .g_ttp { display: block; background: #FFFFFF; border-radius: 4px; position: absolute; left: -75px; bottom: 30%; padding: 15px; box-shadow: 2px 4px 8px #E1E1FA; min-width: 182px; }
                        .cluster:hover { z-index: 2; }
                        .cluster:hover .g_ttp:after { content: ''; background: #FFFFFF; box-shadow: 6px 6px 8px #E1E1FA; width: 52px; height: 52px; display: block; position: absolute; z-index: -1; transform: rotate(45deg); left: calc(50% - 24px); bottom: -25px; }
                        .legend li { list-style: none; display: inline-block; margin: 0 20px; }
                        .legend li div { float: left; margin-right: 10px;}
                        .legend { display: inline-block; line-height: 16px; float: right; }
                    </style>
                </div> 
            </div>
        </div>
    </div>
    <div class="row grow">
        <div class="col-xl-12">
            <div class="row irow">  
                <h2>Новые офферы</h2>
            </div>
            <div class="row irow npd">  
            <?php        
            $offersManager = new Offers_Manager(DB::getInstance());     
            $offersManager->where('active', 1); 
            $offersManager->where(false, '(uroven_dostupa>0 or (select 1 from offers_visible where offer_id=offers.id and user_id=' . $user_id . ')=1)', Entity_Manager::WHERE_RAW);
            $offersManager->limit(4);
            $offersManager->sortBy('id', 'desc');
            $result = $offersManager->get();
            if (is_array($result) && count($result) > 0) {
                foreach ($result as $res) {
                    $o_deystvie = htmlentities($res['deystvie']);
                    $o_sql = "SELECT deystvie FROM deystvie_tpl WHERE `id`='$o_deystvie'";
                    $o_result = $mysqli->query($o_sql);
                    $o_res = mysqli_fetch_array($o_result);
                    $o_deystvie = htmlentities($o_res['deystvie']);
                    $offer_comission = explode('|', trim($res['comission']));
                ?>
                <div class="col-lg-6 col-xl-3 prod_card">
                    <a href="./offers.php?offer=<?=$res['id']; ?>">
                        <div class="block bbt nbr">
                            <div class="imgdiv">
                                <img src="./tmp/offer<?php echo $res['id']; ?>.png">
                            </div>
                        </div>
                        <div class="block ntr">
                            <p class="wdw_mon_p">Выплата от <span class="wdw_mon"><?=$offer_comission[0]; ?> ₽</span> <img class="verified" src="./img/verified.svg"></p>
                            <h3><?= html_entity_decode($res['name'], ENT_QUOTES, 'utf-8'); ?></h3>
                        </div>
                    </a>
                </div>          
            <?php } } ?> 
            </div>
        </div> 
    </div>
    <div class="row grow">
        <div class="col-xl-6">
            <h2>Последние события</h2>
            <div class="block">
                <table class="events_div">
                <?php                  
                    $events = Events::getCabinetEvents();
                    foreach($events as $event){
                        if($event->type <= 8 || $event->type == 8192 || $event->type == 16384){
                        $info = Events_Builder::factory($event);
                ?>
                    <tr>
                        <td><?= date('m.d', strtotime($event->created)); ?></td>
                        <td><a href="<?=$info->link; ?>"><?=$info->title; ?></a></td>
                    </tr>
                <?php } } ?>
                </table>
                <a href="#" class="all">Все события <img src="./img/cheveron.svg"></a>
            </div>
        </div>
        <div class="col-xl-6">
            <h2>Наши новости</h2>
            <?php
                $newsManager = new News_Manager(DB::getInstance());
                $newsManager->where('user_tip', 10);
                $newsManager->sortBy('id', 'desc');
                $newsManager->limit(5);
                $result = $newsManager->get();

                foreach ($result as $n) {
                    $text =  TrimText($n->news,250);
                    $text =  html_entity_decode($text, ENT_QUOTES, 'utf-8');
            ?>
            <div class="block article_card">
                <a href="./news.php">
                    <div class="imgdiv">
                        <img src="#">
                    </div>
                    <div class="text">
                        <h3><?=$n->news_zagolovok; ?></h3>
                        <p class="date"><?=$n->date; ?></p>
                        <?=$text; ?>
                        <p class="vsh"><img src="./img/visible.svg"> 2k <img src="./img/share.svg"> 800</p>
                    </div>
                </a>
            </div>    
            <?php } ?>
        </div>
    </div>
</main>
<div class="modal fade" id="modal-sms" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Подтверждение номера телефона</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          
                          <p class="text-center">На Ваш номер отправлено смс с кодом,<br>введите полученный код в форму ниже</p>
                        <div class="form-group" style="width:150px;margin:20px auto;">
                          <input type="text" class="form-control" name="sms-check" id="sms-check" value="">
                        </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="smscodecheck">Подтвердить</button>
                      </div>
                    </div>
                  </div>
                </div>