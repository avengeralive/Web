<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Инструменты</h1>
        </div>
        <? include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>

    <div class="row grow">
        
        <div class="col-md-12 mb30">
                <a class="btn-link snd" style="padding-right: 15px;" href="./parking.php">Парковка доменов</a>
                <a class="btn-link active" style="padding-right: 15px;" href="./buydomain.php">Покупка домена</a>
                <a class="btn-link snd" style="padding-right: 15px;" href="./postback.php">Глобальный постбек</a>
        </div>

       <div class="col-md-12">
          <div class="row irow">
                    <div class="col-md-4 mb-30 p0">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Домен" aria-label="Домен" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn button" type="button" id="button-addon2">Проверить</button>
                          </div>
                        </div>
                    </div>
          </div>
       </div>
        <div class="col-md-12">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                
                  <div class="accordion mt-50 accordiontools" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne" style="padding-left:0px !important;">
                          <h5 class="mb-0">
                            <a class="btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Информация <i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
                            </a>
                          </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                Купленный домен нельзя отвязать от BD-CPA.
                                <br><br>
                                Купленный домен будет автоматически припаркован на 1 год. По истечению срока, вы можете продлить домен (галочка автопродление). При установленной галочке – автопродление – деньги будут автоматически списываться с вашего баланса.
                                <br><br>
                                Купить домен можно только со средств баланса, пополнить баланс из вне – нельзя.
                                <hr>
                                  Вы можете зарегистрировать новый домен в зоне ".RU" прямо из кабинета и оплатить его со своего баланса вебмастера.<br>Домен припаркуется автоматически к BD-CPA.
                                
                            </div>
                        </div>
                    </div>
                  </div>
            
    
                
                  
                
                
            </div>
          </div>
        </div>
    </div>

</main>