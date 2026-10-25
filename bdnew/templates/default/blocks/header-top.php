
<header class="header mt-25">
    <div class="container">
        <div class="row align-items-center">
            <div class="col align-self-center">
                <div class="logo">
                    <a href="./"><img src="./templates/<?php echo $template; ?>/img/Logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="col-4 align-self-center">
                <ul class="nav justify-content-center menu">
                    <li class="nav-item"><a data-type="40" class="nav-link typePage">Рекламодатель</a></li>
                    <li class="nav-item"><a data-type="10" class="nav-link typePage active">Вебмастер</a></li>
                </ul>
            </div>
            <!--
            <div class="col-3">
                <div class="phone text-center">
                    <i class="fa fa-phone" aria-hidden="true"></i> <a class=""  href=""> + 7 ( 000 ) 000-00-00</a>
                </div>
            </div>
            -->
            <div class="col-4 align-self-end">

                <ul class="nav justify-content-center login">
                    <li class="nav-item"><a class="nav-link" href="#about">Войти</a></li>
                    <li class="nav-item"><a class="nav-link" href="#offer">Регистрация</a></li>
                </ul>
                    
                    
                    <?php if (User::isAuth()) { ?>
                        <a class="login__btn js-login" href="?autologin">В кабинет &rarr;</a>
                    <?php } else if (User::isAuth()){ ?>
                        <a class="login__btn js-login" href="#js-modal-login">Войти</a>
                        <a class="reg__btn js-reg" href="#js-modal-registr">Регистрация</a>
                    <?php } ?>

            </div>
        </div>
    </div>
</header>