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
                    <img class="avatar " src="./tmp/avatars/photo1.jpg">
                  </div>
                  
                    <div class="col">

                        <div class="user-info mb-10 mt-15">
                            <div><b>Игорь</b></div>
                            <div> Личный менеджер</div><br>
                            <font color="green"><b>Online</b></font>
                        </div>
                      
                    </div>
                  
              </div>
              
              <div class="row mt-30">
                  
                  <div class="col text-center">
                      <a href="skype:live:62987c2ac7b79a6e?chat" target="_blank">
                      <img style="width: 30px;" src="./templates/<?=$template; ?>/img/skype2.png">
                      </a>
                  </div>
                  
                  <div class="col text-center">
                    <a href="https://vk.com/gfdgvbv" target="_blank">
                    <img style="width: 30px;" src="./templates/<?=$template; ?>/img/004-vk.png">
                    </a>
                  </div>
                  
                  <div class="col text-center">
                    <a href="https://t.me/Dominion26" target="_blank">  
                    <img style="width: 30px;" src="./templates/<?=$template; ?>/img/telegram.png">
                    </a>
                  </div>

              </div>
            
          </div>
        </div>
    </div>
    <!--
    <div class="col-12 mb-50">
        <h2 class="title-card">Ваша статистика:</h2>
        <div class="card">
          <div class="card-body text-center">
              
              <img class="img-fluid" src="./templates/<?=$template; ?>/img/Group 442.png">
            
          </div>
        </div>
    </div>
    -->
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
    $text =  TrimText($n->news,100);

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
