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

                        <?php
                        $s = Seller::getById($user_id);
                        $forecast = $s->forecastBalance();
                        if($forecast['count'] >= 5 && $forecast['zakaz'] != 0){
                            $f_str = '<font color="green">'.$loc['in_header_top_menu']['t50'].'</font>';
                        }elseif($forecast['count'] < 5 && $forecast['zakaz'] != 0){
                            $f_str = '<a href="./finances.php"><font color="red">'.$loc['in_header_top_menu']['t51'].'</font></a>';
                        }elseif($forecast['zakaz'] == 0){
                            $f_str = $loc['in_header_top_menu']['t52'];
                        }
                        ?>
                        
                        <div class="user-info mb-10 mt-15">
                            <div><b><?=$user_email; ?></b></div>
                            <div><a href="./profile.php"><i class="fa fa-cog" aria-hidden="true"></i> Редактировать профиль</a></div>
                        </div>
                        
                        <div class="user-info mt-20">
                            <div class="balances"><img src="./templates/<?= $template; ?>/img/deposit.png"> <?php echo $loc['in_header_top_menu']['t17']; ?> <a class="" href="./finances.php"><?php echo number_format($user_balance, 0, ',', ' '); ?></a> <i class="fa fa-rub" aria-hidden="true"></i></div>
                            <div><a class="" href="./finances.php">Пополнить счет</a></div>
                        </div>
                        
                        <div class="user-info mb-10 mt-5">
                            <div class="balances">
                                <?php echo $loc['in_header_top_menu']['t49']; ?>&nbsp; <?php echo $f_str; ?>
                            </div>
                            <div>
                                <?php
                                if($forecast['zakaz'] != 0){
                                ?>
                                Хватит на <?=$forecast['count']; ?> <?=$forecast['days_str']; ?>
                                <?php
                                }
                                ?> 
                            </div>
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
                <div class="card h-100">
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
                      
                      <div class="text-center mt-50">
                          <a href="./news.php" class="more">
                            Больше новостей<br>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                          </a>
                      </div> 
                      
                  </div>
                </div>
                
            </div>
            
        </div>

        
    </div>
    
</div>
