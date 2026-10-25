
</div>

    <footer class="footer navbar-fixed-bottom main">
        <div class="container">
        <div class="row">
            <div class="col">
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
                <p>
                </p>
                <p class="copy">&copy <?= date('Y');?> </p>
            </div>
            <div class="col">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Общее</a>  
                  <a class="nav-link" href="/info.php">Информация</a>
                  <a class="nav-link" href="/about.php">О компании</a>
                  <a class="nav-link" href="/contacts.php">Контакты</a>
                </nav>
            </div>
            <div class="col">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Вебмастеру</a>  
                  <a class="nav-link" href="http://api.blackdollar.ru/apidoc/">API</a>
                  <a class="nav-link" href="/help.php">FAQ</a>
                </nav>
            </div>
            <div class="col">
                <nav class="nav flex-column">
                  <a class="nav-link navbar-brand">Рекламадателю</a>  
                  <a class="nav-link" href="/help.php">FAQ</a>
                  <a class="nav-link" href="/info.php">Информация</a>
                </nav>
            </div>
        </div>
        </div>
    </footer>
</div> 
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    

    
    </body>
</html>