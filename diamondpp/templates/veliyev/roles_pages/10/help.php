<main>
  <div class="row grow">
    <div class="col-md-7">
      <h1>FAQ</h1>
    </div>
    <?php include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
  </div>
  <div class="row grow">
    <div class="col-md-12">
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" data-target="#faq1" aria-expanded="false" aria-controls="faq1" class="collapsed">
                <?php echo $loc['help.php']['t02']; ?> <i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
              </a>
            </h5>
          </div>
          <div id="faq1" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <b>1.</b>&nbsp;<?php echo $loc['help.php']['t03']; ?>&nbsp;&quot;<a href=./offers.php><?php echo $loc['help.php']['t04']; ?></a>&quot;&nbsp;<?php echo $loc['help.php']['t05']; ?><br>
              <b>2.</b>&nbsp;<?php echo $loc['help.php']['t06']; ?>&nbsp;&quot;<?php echo $loc['help.php']['t07']; ?>&quot;&nbsp;<?php echo $loc['help.php']['t08']; ?><br>
              <b>3.</b>&nbsp;<?php echo $loc['help.php']['t09']; ?>&nbsp;&quot;<a href=./stats.php><?php echo $loc['help.php']['t10']; ?></a>&quot;.&nbsp;<?php echo $loc['help.php']['t11']; ?><br>
              <b>4.</b>&nbsp;<?php echo $loc['help.php']['t12']; ?>&nbsp;&quot;<a href=./finances.php><?php echo $loc['help.php']['t13']; ?></a>&quot;.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" data-target="#faq2" aria-expanded="false" aria-controls="faq2" class="collapsed">
                <?php echo $loc['help.php']['t14']; ?><i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
              </a>
            </h5>
          </div>
          <div id="faq2" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <?php echo $loc['help.php']['t15']; ?><br>
              <?php echo $loc['help.php']['t16']; ?>&nbsp;<b>http://<?php echo $loc['help.php']['t17']; ?>/?p=aS8wuQj&<font color="green">subid1</font>=<?php echo $loc['help.php']['t18']; ?>&<font color="green">subid2</font>=<?php echo $loc['help.php']['t18']; ?>&<font color="green">subid3</font>=<?php echo $loc['help.php']['t18']; ?>&<font color="green">subid4</font>=<?php echo $loc['help.php']['t18']; ?>&<font color="green">subid5</font>=<?php echo $loc['help.php']['t18']; ?></b><br>
              <?php echo $loc['help.php']['t19']; ?>
            </div>
          </div>
        </div>   
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" data-target="#faq3" aria-expanded="false" aria-controls="faq3" class="collapsed">
                  Какая минимальная сумма для выплат?<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
              </a>
            </h5>
          </div>
          <div id="faq3" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <div>
                Минимальная сумма для выплат составляет 1500 рублей
              </div>
            </div>
          </div>
        </div>    
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" data-target="#faq4" aria-expanded="false" aria-controls="faq4" class="collapsed">
                  Есть ли у вас холд?<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
              </a>
            </h5>
          </div>
          <div id="faq4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <div>
                    Да. 7 дней с момента заказа выплаты. Для снятия холда обратитесь в саппорт.
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" data-target="#faq5" aria-expanded="false" aria-controls="faq5" class="collapsed">
                  Как часто производятся выплаты?<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
              </a>
            </h5>
          </div>
          <div id="faq5" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <div>
                    Вы можете оставить заявку на выплату заработанных средств в любой день недели и мы максимально быстро обработаем Вашу заявку
              </div>
            </div>
          </div>
        </div>    
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" data-target="#faq6" aria-expanded="false" aria-controls="faq6" class="collapsed">
                  Как припарковать домен?<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i>
              </a>
            </h5>
          </div>
          <div id="faq6" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                Для прикрепления домена, вам необходимо указать в настройках DNS наш IP адрес 178.208.76.195 в А-запись<br>
                            Пример:
                            <table class="text-center table-bordered mt-15 mb-25">
                                <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Тип</th>
                                    <th>Данные</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@</td>
                                    <td>A</td>
                                    <td>178.208.76.195</td>
                                </tr>
                                </tbody>
                            </table>
                Внимание: Обновление DNS записей может занимать около 8ми часов 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <div class="col-12 mt-35 text-center">
    <!--<table class="table-borderless" style="margin:30px auto;">
        <tr>
            <td colspan="2"><p class="openSansBold" style="color:#223a46;text-align:center;font-size: 18px;">Не нашли свой вопрос?<br>Свяжитесь с нами!</p></td>
        </tr>        
        <tr>
            <td width="40px"><img src="./templates/<?php echo $template; ?>/img/skype.png" width="25px"></td>
            <td><?php if (isset($settings_skype) && $settings_skype!='') {echo '&nbsp;&nbsp;<a style="font-size: 20px;" href="skype:'.$settings_skype.'?add">'.$settings_skype.'</a>';} ?></td>    
        </tr>
        <tr>
            <td width="40px"><img src="./templates/<?php echo $template; ?>/img/mail.png" width="25px"></td>
            <td><?php if (isset($settings_email) && $settings_email!='') {echo '&nbsp;&nbsp;<a style="font-size: 20px;" href="mailto:'.$settings_email.'">'.$settings_email.'</a>';} ?>    </td>    
        </tr>        
    </table>-->  
  </div>
</main>