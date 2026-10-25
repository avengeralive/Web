    <div class="container">

            <?php //include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

            <div class="form">
                <form class="" action="./signup.php" method="post">
                    <div class="form-box">
                        <h3 class="form-box__title">РЕГИСТРАЦИЯ<br> ВЕБМАСТЕРА<h3>
                        <input id="type_reg" type="hidden" name="registration_tip" value="10">
                        <div class="form-box__row">
                            <label for="">Ваш E-mail*</label>
                            <input type="email" name="registration_email"  placeholder="E-mail" required/>
                        </div>
                        <div class="form-box__row">
                            <label for="">Телефон *</label>
                            <input type="text" name="registration_phone" placeholder="+7" required/>
                        </div>
                        <div class="form-box__row">
                            <label for="">Telegram *</label>
                            <input type="text" name="registration_telegram" value="" placeholder="@" required/>
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
                                <img onclick="ResetCaptcha();" id="captcha" class="img-fluid " style="margin-top:22px;" src="captcha.php?rnd=<?=rand(1,10000); ?>">
                            </div>
                        </div>
                        <label class="form-box__rules" for="rule"> <input type="checkbox" name="registration_agree_rules" value="" id="rule"/> Я принимаю правила работы системы</label>
                        <button type="submit" name="button" class="btn btn-white btn--radius">Зарегистрироваться</button>
                    </div>
                </form>
            </div>

    </div>


        
    <!-- BEGIN FOOTER -->
        <?php include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
    
        




    