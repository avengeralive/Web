    <div class="container">

            <?php include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

            <div class="auth-form">                
                <div class="col-12">
                    <h2 class="">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</h2>
                    
                    <form name="login_form" class="login-form needs-validation" action="./recover.php" id="loginForm" method="post">
                        <p class="errormsgLogin"></p>
                        
                        <div class="form-group">
                          <label for="email">* E-mail</label>
                          <input type="text" class="form-control" id="email" name="recover_email" placeholder="E-mail" required maxlength="40">
                        </div>
                        
                        <div class="form-group row">
                            
                            <div class="col-7">
                                <label for="captcha">* Введите код с картинки</label>
                                <input type="text" class="form-control" id="captcha" name="captcha">
                            </div>
                            
                            <div class="col-5 ">
                                <img onclick="ResetCaptcha();" id="captcha" class="img-fluid " style="margin-top:22px;" src="captcha.php?rnd=<?=rand(1,10000); ?>">
                            </div>
                          
                        </div>

                        <div class="form-group text-center">
                          <button class="btn login-form__btn" name="login_submit" type="submit">Отправить</button>
                        </div>

                    </form>

                    
                    
                </div>    
            </div>

    </div>

        
    <!-- BEGIN FOOTER -->
        <?php include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
    
        




    