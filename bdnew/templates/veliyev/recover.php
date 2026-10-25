    <div class="container">

            <?php //include './templates/'.$template.'/blocks/menu-top-home.php'; ?>

            <div class="form">
                <form class="" action="./recover.php" method="post">
                    <div class="form-box">
                        <h3 class="form-box__title">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</h3>
                        <div class="form-box__row">
                            <label for="">Ваш E-mail</label>
                            <input type="email" name="recover_email" value=""/>
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
                        <button type="submit" name="button" class="btn btn-white btn--radius">Отправить</button>
                    </div>
                </form>
            </div>

    </div>

        
    <!-- BEGIN FOOTER -->
        <?php //include './templates/'.$template.'/blocks/footer.php'; ?>
    <!-- END FOOTER -->
    
        




    