    <div class="container">

            <?php include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

            <div class="auth-form">                
                <div class="col-12">
                    <h2 id="title_type_page">РЕГИСТРАЦИЯ ВЕБМАСТЕРА</h2>
                    
                    <form name="login_form" class="login-form needs-validation" action="./signup.php" onsubmit="return validate_form(this);" id="loginForm" method="post">
                        <input id="type_reg" type="hidden" name="registration_tip" value="10">
                        
                        <div class="form-group">
                          <label for="email">* E-mail</label>
                          <input type="text" class="form-control" id="email" name="registration_email" placeholder="E-mail" required maxlength="40">
                        </div>
                        
                        <div class="form-group">
                          <label for="phone">* Номер телефона</label>
                          <input type="text" class="form-control" id="phone" name="registration_phone" placeholder="+7" required maxlength="40">
                        </div>
                        
                        <div class="form-group">
                          <label for="skype">Ваш Skype</label>
                          <input type="text" class="form-control" id="skype" name="registration_skype" placeholder="Ваш Skype" >
                        </div>
                        
                        
                        <div class="form-group">
                          <label for="telegram">Ваш Telegram</label>
                          <input type="text" class="form-control" id="telegram" name="registration_telegram" value="@" placeholder="Ваш Telegram" >
                        </div>
                        
                        
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="registration_password_1">* Введите пароль</label>
                                <input type="password" class="form-control" id="registration_password_1" required name="registration_password_1">
                            </div>
                            <div class="col-6">
                                <label for="registration_password_2">* Повторите пароль:</label>
                                <input type="password" class="form-control" id="registration_password_2" required name="registration_password_2">
                            </div>                          
                        </div>
                        
                        <div class="form-group row">
                            
                            <div class="col-7">
                                <label for="cap">* Введите код с картинки</label>
                                <input type="text" class="form-control" id="cap" name="captcha">
                            </div>
                            
                            <div class="col-5 ">
                                <img onclick="ResetCaptcha();" id="captcha" class="img-fluid " style="margin-top:22px;" src="captcha.php?rnd=<?=rand(1,10000); ?>">
                            </div>
                          
                        </div>
                        
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="registration_agree_rules" name="registration_agree_rules" checked>
                          <label class="custom-control-label" for="registration_agree_rules">Я принимаю правила работы системы</label>
                        </div>
                        
                        <div class="form-group text-center">
                          <button class="btn login-form__btn" name="login_submit" type="submit">Зарегистрироваться</button>
                        </div>

                    </form>

                    
                    
                </div>    
            </div>

    </div>


        
    <!-- BEGIN FOOTER -->
        <?php include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
    
        




    