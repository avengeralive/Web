    <div class="container">

            <?php include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

            <div class="auth-form">                
                <div class="col-12">
                    <h2 class="">ВХОД В АККАУНТ</h2>
                    
                    <form name="login_form" class="login-form needs-validation" action="./login.php" id="loginForm" method="post">
                        <p class="errormsgLogin"></p>
                        
                        <div class="form-group">
                          <label for="email">* E-mail</label>
                          <input type="text" class="form-control" id="email" name="login_email" value="<?php if(isset($_POST['login_email'])) {echo $_POST['login_email'];} ?>" placeholder="E-mail" required maxlength="40">
                        </div>
                        
                        <div class="form-group">
                          <label for="password">* Введите пароль</label>
                          <input type="password" class="form-control" id="password" name="login_password" placeholder="Пароль">
                        </div>
                        
                        <div class="form-group text-center">
                          <button class="btn login-form__btn" name="login_submit" type="submit">Войти</button>
                        </div>
                        
                        <div class="form-group text-center">
                          <a class="text-center" href="./recover.php">Забыли пароль?</a>
                        </div>

                    </form>

                    
                    
                </div>    
            </div>

    </div>


        
    <!-- BEGIN FOOTER -->
        <?php include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
    
        




    