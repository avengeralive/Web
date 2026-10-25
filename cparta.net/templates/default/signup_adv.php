<div class="container">

<?php //include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

  <div class="form">
  <form action="./signup_adv.php" method="post">
                <div class="form-box">
                    <h3 class="form-box__title">РЕГИСТРАЦИЯ<br> РЕКЛАМОДАТЕЛЯ<h3>
                    <input id="type_reg" type="hidden" name="registration_tip" value="40">
                    <div class="form-box__row">
                        <label for="email">* E-mail</label>
                        <input type="text" class="form-control" id="email" name="registration_email" placeholder="E-mail" required maxlength="40">
                    </div>
                    <div class="form-box__row">
                        <label for="">Телефон *</label>
                        <p>
                            <select name="registration_phone_code" style="width: 100px; float:left; margin-right: 10px; height: 40px;">
                                <option value="+7">Россия (+7)</option>
                            </select>
                            <input style="width: calc(100% - 110px);" type="text" class="registration_phone" name="registration_phone" placeholder="XXXXXXXXXX" required/>
                        </p>
                    </div>
                    <div class="form-box__row">
                        <label for="telegram">Ваш Telegram</label>
                        <input type="text" class="form-control telegram" id="telegram" value="@" minlength="2" name="registration_telegram" placeholder="Ваш Telegram" required>
                    </div>
                    <div class="form-box__row">
                        <label for="company">Название компании</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="Название компании" >
                    </div>
                    <div class="form-box__row">
                        <label for="site">Адрес сайта/лендинга</label>
                        <input type="text" class="form-control" id="site" name="site" placeholder="http://" >
                    </div>
                    <div class="form-box__row form-box__just">
                        <div class="form-box__row-bl">
                            <label for="">Введите пароль *</label>
                            <input type="password" name="registration_password_1" value=""  autocomplete="on" required/>
                        </div>
                        <div class="form-box__row-bl">
                            <label for="">Повторите пароль *</label>
                            <input type="password" name="registration_password_2"  autocomplete="on" value="" required/>
                        </div>
                    </div>                         
                    <div class="form-box__row form-box__just">
                        <div class="form-box__row-bl">
                            <label for="">Введите код с картинки *</label>
                            <input type="text" name="captcha" id="cap" value="" required/>
                        </div>
                        <div class="form-box__row-bl form-box__row-bl--captcha">
                            <img onclick="ResetCaptcha();" class="img-fluid " style="margin-top:22px;" src="captcha.php?rnd=<?=$rand; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source'];?>">
                    <input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium'];?>">
                    <input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign'];?>">
                    <input type="hidden" name="utm_term" value="<?php echo $_GET['utm_term'];?>">
                    <input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content'];?>">
                    <label class="form-box__rules" for="rule"> <input type="checkbox" name="registration_agree_rules" value="" /> Я принимаю правила работы системы</label>
                    <p>Для окончания регистрации Вас переведёт в телеграмм</p>
                    <button type="submit" name="button" class="btn btn-white btn--radius">Зарегистрироваться</button>
                </div>
            </form>
  </div>

</div>


     <!-- BEGIN FOOTER -->
     <?php include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->