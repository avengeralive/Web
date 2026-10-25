            <header class="row align-items-start">

                <div class="col-md-4 col-xs-12 align-self-center">
                    <div class="logo">
                        <a href="./"><img width="200px" src="./templates/<?php echo $template; ?>/img/Logo@2x.png" alt="logo"></a>
                    </div>
                </div>
                
                <?php 
                   if (curr_file() == 'sdfsdf.php') { 
                ?>

                <div class="col-md-4 align-self-center hidden-xs hidden-sm hidden-md">
                    <ul class="nav justify-content-center menu">
                    <li class="nav-item"><a data-type="40" class="nav-link typePage">Рекламодатель</a></li>
                    <li class="nav-item"><a data-type="10" class="nav-link typePage active">Вебмастер</a></li>
                    </ul>
                </div>
                
                <?php 
                    }
                ?>

                <div class="col-md-8 col-xs-12 align-self-center">

                    <?php if (User::isAuth()) { ?>
                        <ul class="nav justify-content-end login">
                            <li class="nav-item"><a class="nav-link" href="./cabinet.php">В кабинет</a></li>
                            <li class="nav-item"><a class="nav-link" href="./logout.php">Выход</a></li>
                        </ul>
                    <?php } else { ?>
                        <ul class="nav justify-content-end login">
                            <li class="nav-item"><a class="nav-link" href="./login.php">Войти</a></li>
                            <li class="nav-item"><a class="nav-link" href="./signup.php">Регистрация</a></li>
                        </ul>
                    <?php } ?>

                </div>

            </header>