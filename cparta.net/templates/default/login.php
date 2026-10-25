    <div class="container">

            <?php //include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

            <div class="form">
                <form class="" action="./login.php" method="post">
                    <div class="form-box">
                        <h3 class="form-box__title">ВХОД В ЛИЧНЫЙ<br> КАБИНЕТ ВЕБМАСТЕРА</h3>
                        <div class="form-box__row">
                            <label for="">Ваш E-mail</label>
                            <input type="email" name="login_email" value=""/>
                        </div>
                        <div class="form-box__row">
                            <label for="">Пароль</label>
                            <input type="password"  autocomplete="on" name="login_password" value=""/>
                        </div>
                        <button type="submit" name="button" class="btn btn-white btn--radius">Войти</button>
                        <a href="/recover.php" class="form-box__forgot">Забыли пароль?</a>
                    </div>
                </form>
            </div>

    </div>


        
    <!-- BEGIN FOOTER -->
        <?php //include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
    
        




    