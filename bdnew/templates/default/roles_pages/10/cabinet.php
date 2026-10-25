<div class="row cabinet main mt-50 mb-50">
    
    <div class="col-xl-6 col-lg-12 mb-50">
        <h2 class="title-card">Ваш профиль</h2>
        <div class="card">
          <div class="card-body">
              
              <div class="row">
                  
                  <div class="col-auto text-center p-0">
                    <img class="avatar " src="./tmp/avatars/<?=$user_ava; ?>">
                  </div>
                  
                    <div class="col">

                        <div class="user-info mb-10 mt-15">
                            <div><b><?=$user_email; ?></b></div>
                            <div><a href="./profile.php"><i class="fa fa-cog" aria-hidden="true"></i> Редактировать профиль</a></div>
                        </div>
                        
                        <div class="user-info mt-20">
                            <div class="balances"><img src="./templates/<?= $template; ?>/img/deposit.png"> <?php echo $loc['in_header_top_menu']['t17']; ?> <a class="" href="./finances.php"><?php echo number_format($user_balance, 0, ',', ' '); ?></a> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <div><a class="" href="./finances.php">Вывести средства</a></div>
                        </div>
                        
                        <div class="user-info mb-10 mt-5">
                            <div class="balances"><img src="./templates/<?= $template; ?>/img/passage-of-time.png"> <?php echo $loc['in_header_top_menu']['t15']; ?> <a class="" href="./finances.php"><?php echo number_format($user_hold, 0, ',', ' '); ?></a> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <div></div>
                        </div>
                        <div class="user-info mt-5">
                            <div class="balances"><img src="./templates/<?= $template; ?>/img/coin.png"> Баланс Yes-coin: <a href=""><?php echo number_format($user_coins, 0, ',', ' '); ?></a></div>
                            <div></div>
                        </div>

                                <?php
                                if($phone_check == 0){
                                ?>
                                <div class="user-info mt-5">
                                <div class="balances">

                                    <a href="./profile.php"><span style="color:#DB6060;text-decoration: underline;">Подтвердите номер телефона</span></a>
                                </div>
                                <div></div>
                                </div>
                                <?php
                                }
                                ?>

                        

                        
                    </div>
                  
              </div>
            
          </div>
        </div>
    </div>
    
    <div class="col-xl-6 col-lg-12 mb-50">
        <h2 class="title-card">Ваш личный менеджер</h2>
        <div class="card">
          <div class="card-body">
              
              <div class="row">
                  
                  <div class="col-auto text-center p-0">
                    <img class="avatar " src="./tmp/avatars/photo2.png">
                  </div>
                  
                    <div class="col">

                        <div class="user-info mb-10 mt-15">
                            <div><b>Илона</b></div>
                            <div> Личный менеджер</div><br>
                            <font color="green"><b>Online</b></font>
                        </div>
                      
                    </div>
                  
              </div>
              
              <div class="row mt-30">
                  
                  <div class="col text-center">
                      <a href="skype:<?=$settings_skype; ?>?add" target="_blank">
                      <img style="width: 30px;" src="./templates/<?=$template; ?>/img/skype2.png">
                      </a>
                  </div>
                  
                  <div class="col text-center">
                    <a href="https://vk.com/<?=$settings_vk; ?>" target="_blank">
                    <img style="width: 30px;" src="./templates/<?=$template; ?>/img/004-vk.png">
                    </a>
                  </div>
                  
                  <div class="col text-center">
                    <a href="https://t.me/<?=$settings_telegram; ?>" target="_blank">  
                    <img style="width: 30px;" src="./templates/<?=$template; ?>/img/telegram.png">
                    </a>
                  </div>

              </div>
            
          </div>
        </div>
    </div>

    <div class="col-12 mb-50">
        <h2 class="title-card">Cтатистика за последние 30 дней:</h2>
        <div class="card">
          <div class="card-body text-center">
              <script src="./templates/<?=$template; ?>/js/chartjs/dist/Chart.js"></script>
              
              <canvas id="myChart" height="100px"></canvas>
<?php /*
$statsManager = new Stats_Manager(DB::getInstance());
$statsManager->byUserId = $user_id;
$getRequest = new Request($_GET);

if (isset($getRequest->date) and $getRequest->date != 0 and $getRequest->date != '') {
    $dd = explode(' - ', $getRequest->date);
} else {
    $dd = array(0 => date('d.m.Y', (time() - 60 * 60 * 24 * 30)), 1 => date('d.m.Y', time()));
}

$dat1 = $dd[0];
$dat2 = $dd[1];
$statsManager->dat1 = date('Y-m-d', strtotime($dat1));
$statsManager->dat2 = date('Y-m-d', strtotime($dat2));
$statsManager->tdat1 = date('Ymd', strtotime($dat1));
$statsManager->tdat2 = date('Ymd', strtotime($dat2));

$statsManager->byDate = htmlentities($statsManager->dat1) . " " . $DT . "' AND '" . htmlentities($statsManager->dat2) . ' ' . $NT;

$result = $statsManager->getByDates($where, 10);


        
        */

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

    /*
    foreach ($result as $d => $res) {
        
        $date_zakaz = explode("-", $res['date']);
        $date_zakaz = $date_zakaz[2] .'.'.$date_zakaz[1];
        $days[] = $date_zakaz;  
        $zakaz_all[] = $res['zakaz_all'] + $res['zakaz_wait'] + $res['zakaz_cancel'] + $res['zakaz_trash'];
        $zakaz_ok[] = $res['zakaz_all'];
        $zakaz_wait[] = $res['zakaz_wait'];
        $zakaz_cancel[] = $res['zakaz_cancel'];
        $zakaz_trash[] = $res['zakaz_trash'];      
        
        
        
        

    }    
    
    echo json_encode($days);echo '<br>';
    echo json_encode($zakaz_all);echo '<br>';
    echo json_encode($zakaz_ok);echo '<br>';
    echo json_encode($zakaz_wait);echo '<br>';
    echo json_encode($zakaz_cancel);echo '<br>';
    echo json_encode($zakaz_trash);echo '<br>';
    
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
     * *
     */
?>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($days); ?>,
        datasets: [{
            label: 'Всего',
            data: <?php echo json_encode($arr_zakaz_all); ?>,
            borderColor: 'DodgerBlue',
            pointBackgroundColor: 'DodgerBlue',
            pointHoverBackgroundColor: '#1E90FF',
            pointHoverBorderColor: 'DodgerBlue',
            pointHoverBorderWidth: 2,
            backgroundColor: '#1E90FF',
            fill: false
        },
        {
            label: 'Принято',
            data: <?php echo json_encode($arr_zakaz_ok); ?>,
            borderColor: 'SpringGreen',
            pointBackgroundColor: 'SpringGreen',
            pointHoverBackgroundColor: '#00FF7F',
            pointHoverBorderColor: 'SpringGreen',
            pointHoverBorderWidth: 2,
            backgroundColor: '#00FF7F',
            fill: false
        },
        {
            label: 'Отклонено',
            data: <?php echo json_encode($arr_zakaz_cancel); ?>,
            borderColor: 'Crimson',
            pointBackgroundColor: 'Crimson',
            pointHoverBackgroundColor: '#DC143C',
            pointHoverBorderColor: 'Crimson',
            pointHoverBorderWidth: 2,
            backgroundColor: '#DC143C',
            fill: false
        },
        {
            label: 'Треш',
            data: <?php echo json_encode($arr_zakaz_trash); ?>,
            borderColor: 'Gray',
            pointBackgroundColor: 'Gray',
            pointHoverBackgroundColor: '#808080',
            pointHoverBorderColor: 'Gray',
            backgroundColor: '#808080',
            pointHoverBorderWidth: 2,
            fill: false
        },
        {
            label: 'В ожидании',
            data: <?php echo json_encode($arr_zakaz_wait); ?>,
            borderColor: 'Gold',
            pointBackgroundColor: 'Gold',
            pointHoverBackgroundColor: '#FFD700',
            pointHoverBorderColor: 'Gold',
            backgroundColor: '#FFD700',
            pointHoverBorderWidth: 2,
            fill: false
        }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 0,
                    min: 0,
                    stepSize: 25
                }
            }]
        },
        tooltips: {
            mode: 'index',
            caretSize: 0
        },
        hover: {
            mode: 'index'
        },
        elements: {
            point: {
                pointStyle: 'circle',
                radius: 5,
                hoverRadius: 7
            }
        },
        legend: {
            labels: {
                usePointStyle: true,
                padding: 15
            }
            
        }
        
    }
});
</script>

          </div>
        </div>
    </div>

    <div class="col-12 mb-50">
        <h2 class="title-card">Новые офферы:</h2>

<?php        
    $offersManager = new Offers_Manager(DB::getInstance());     
    $offersManager->where('active', 1); 
    $offersManager->where(false, '(uroven_dostupa>0 or (select 1 from offers_visible where offer_id=offers.id and user_id=' . $user_id . ')=1)', Entity_Manager::WHERE_RAW);
    $offersManager->limit(8);
    $offersManager->sortBy('id', 'desc');
    $result = $offersManager->get();
?>        
        <div class="row">
            
            <?php
            if (is_array($result) && count($result) > 0) {
                foreach ($result as $res) {
                    $o_deystvie = htmlentities($res['deystvie']);
                    $o_sql = "SELECT deystvie FROM deystvie_tpl WHERE `id`='$o_deystvie'";
                    $o_result = $mysqli->query($o_sql);
                    $o_res = mysqli_fetch_array($o_result);
                    $o_deystvie = htmlentities($o_res['deystvie']);
                    $offer_comission = explode('|', trim($res['comission']));
                ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-30">
                        <a href="./offers.php?offer=<?=$res['id']; ?>">
                        <div class="promo p-0" style="background:  url('./tmp/offer<?php echo $res['id']; ?>.png') no-repeat center 30%;    background-size: 60%;">
                            <div class="promo-title">
                                <?= html_entity_decode($res['name'], ENT_QUOTES, 'utf-8'); ?>
                                <div class="promo-descr">
                                    <?=$o_deystvie; ?><br>Выплата от <?=$offer_comission[0]; ?> р.
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>            
                <?php
                }
            }
            ?>
            
        </div>
        
        <div class="row mt-50">
            
            <div class="col-xl-6 col-md-12 mb-50 mb-30">
                <h2 class="title-card">Последние события:</h2>
                <div class="card" style="min-height: 710px;">
                  <div class="card-body">
                      
                    <div class="list-group list-group-flush actions">
<?php                  
  $events = Events::getCabinetEvents();
  foreach($events as $event){
      

      if($event->type <= 8 || $event->type == 8192 || $event->type == 16384){
          $info = Events_Builder::factory($event);
?>
                      <a href="<?=$info->link; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <p style="width:500px;    margin-right: 25px;" class="mb-1"><?=$info->title; ?></p>
                            <small style=""class="text-muted"><?=$event->created; ?></small>
                        </div>
                      </a>
<?php
      }
  }
?>
                        
                    </div>                      
                  </div>
                </div>
            </div>
            
            <div class="col-xl-6 col-md-12 mb-50 mb-30">
                <h2 class="title-card">Наши новости:</h2>
                <div class="card" style="min-height: 710px;">
                  <div class="card-body">

                    <div class="list-group list-group-flush news">
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
                        
                      <a href="./news.php" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                          <p class="mb-1 title-news"><?=$n->news_zagolovok; ?></p>
                          <small class="text-muted"><?=$n->date; ?></small>
                        </div>
                        <p class="mt-5"><?=$text; ?></p>
                      </a>
<?php  
}
?>
                        
                    </div>
                      <!--
                      <div class="text-center mt-50">
                          <a href="./news.php" class="more">
                            Больше новостей<br>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                          </a>
                      </div> 
                      -->
                  </div>
                </div>
                
            </div>
            
        </div>

        
    </div>
    
</div>
