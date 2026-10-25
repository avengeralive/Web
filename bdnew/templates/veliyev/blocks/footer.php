<footer class="footer navbar-fixed-bottom">
        <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 ">
                <a href="./"><img src="./templates/<?php echo $template; ?>/img/Logo footer.png" alt="logo"></a>
                <p class="phone">
                    <a class=""  href="">
                            <?php
                            if (isset($settings_phone) && $settings_phone!=''){
                                echo $settings_phone;
                            }
                            ?>
                    
                    </a>
                </p>
                
                <p>
                            <?php
                            if (isset($settings_email) && $settings_email!=''){
                                echo '<p>'.$settings_email.'</p>';
                            }
                            ?>
                </p>
                
                <p class="copy hidden-xs hidden-sm">&copy <?= date('Y');?> </p>
            </div>
            <div class="col-md-3 col-xs-12">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Общее</a>  
                  <a class="nav-link" href="/info.php">Информация</a>
                  <a class="nav-link" href="/about.php">О компании</a>
                  <a class="nav-link" href="/contacts.php">Контакты</a>
                  <a class="nav-link" href="#">Задать вопрос</a>
                </nav>
            </div>
            <div class="col-md-3 col-xs-12">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Вебмастеру</a>  
                  <a class="nav-link" href="./signup.php">Регистрация</a>
                  <a class="nav-link" href="#">Офферы</a>
                  <a class="nav-link" href="./rules.php">Правила</a>
                  <a class="nav-link" href="#">FAQ по системе</a>
                </nav>
            </div>
            <div class="col-md-3 col-xs-12">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Рекламадателю</a>  
                  <a class="nav-link" href="./signup.php">Регистрация</a>
                  <a class="nav-link" href="#">Добавить оффер</a>
                  <a class="nav-link" href="./integration.php">Инструкция</a>
                </nav>
            </div>
        </div>
        <p class="copy hide-sm-andup">&copy <?= date('Y');?> </p>    
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <script src="./templates/<?php echo $template; ?>/js/jquery-3.3.1.min.js"></script>
    
    <script type="text/javascript">
/*
        $(document).ready(function(){
            $("body").on('click','[href*="#"]', function (event) {
                event.preventDefault();
                var id  = $(this).attr('href'),
                top = $(id).offset().top;
                $('body,html').animate({scrollTop: top}, 1000);
            });
        });
 */       
        $('#offers-tab a').on('click', function (e) {
          e.preventDefault()
          $(this).tab('show')
        });
        
        
    </script>
    
    <link href="./templates/<?php echo $template; ?>/lib/noty-3.2.0/noty.css" rel="stylesheet">
    <script src="./templates/<?php echo $template; ?>/lib/noty-3.2.0/noty.min.js" type="text/javascript"></script>
    
    <link rel="stylesheet" href="./templates/<?php echo $template; ?>/lib/noty-3.2.0/themes/nest.css"/>
    <link rel="stylesheet" href="./templates/<?php echo $template; ?>/lib/animate.css"/>    
    
    <script src="./templates/<?php echo $template; ?>/js/main.js" type="text/javascript"></script>
    
    </body>
</html>