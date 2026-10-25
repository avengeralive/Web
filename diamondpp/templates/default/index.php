<div class="over">
    <div class="all">
        <div class="lvl1">
            <header>
                <div class="b-logo"><a href="#" class="logo"><img src="/land/img/logo.png" alt=""></a></div>
                <a id="hamburger-icon"><span class="line line-1"></span><span class="line line-2"></span><span class="line line-3"></span></a>
                <div class="mobile-menu mobile-menu-toggle">
                    <nav>
                        <ul>
                            <li><a href="">О нас</a></li>
                            <li><a href="">Офферы</a></li>
                            <li><a href="">Контакты</a></li>
                        </ul>
                    </nav>
                    <div class="head-right">
                        <div class="b-reg"><a href="#" class="btn-reg">регистрация</a><div class="b-login"><a href="#" class="login">Вход</a></div></div>
                        <div class="b-lang"><span class="lang active">RU</span><a href="index_en.php" class="lang">EN</a></div>
                    </div><!--end head-right -->
                </div><!--end mobile-menu -->
            </header>
            <div class="level-cont">
                <div class="b-slogan">
                    <h1>CPA-СЕТЬ
                        <span>И ПРЯМОЙ РЕКЛАМОДАТЕЛЬ</span></h1>
                    <h2>С АВТОРСКИМИ <span>WHITEHAT &amp;&nbsp;NUTRA&minus;</span>ОФФЕРАМИ</h2>
                </div><!--end b-slogan -->

                <div class="b-form-request">
                    <form class="form-reg" method="post">
                    <?php
	// Если в GET-запросе был передан ID рефовода, то добавляем в форму скрытое поле с этим значением
	// If the GET-request was handed partner ID, then add in the form of a hidden field with the same value
	if (isset($_GET['ref']))
		{
		$refovod=htmlentities((int)$_GET['ref']);
		echo '<input type="hidden" name="referer" value="'.$refovod.'">';
		}
	?>
                        <div class="row-form">
                            <label for="">E-mail</label>
                            <input class="input inp-email" type="text" name="registration_email">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label for="">ПАРОЛЬ</label>
                            <input class="input inp-pass" type="password" name="registration_password_1">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label for="">Выберите мессенджер</label>
                            <div class="b-select my-select">
                                <div class="select-value">Telegram</div>
                                <div class="select-list">
                                    <ul>
                                        <li class="telegram">Telegram</li>
                                        <li class="skype">Skype</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label for="">Повторите пароль</label>
                            <input class="input inp-pass" type="password" name="registration_password_2">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label class="mess-type" for="">Telegram</label>
                            <input class="input inp-telegram" type="text" name="registration_telegram">
                        </div><!--end row-form -->
                        <div class="row-form b-row-submit">
                            <input type="submit" class="inp-submit" value="присоединиться">
                        </div><!--end row-form -->
                        <div class="row-form small">
                            <div class="yslovia"><input class="inp-checkbox" type="checkbox" name="registration_agree_rules">я прочитал и принял <a href="#">условия и положения</a></div>
                        </div><!--end row-form -->
                        <div class="row-form small row-b-login">
                            Есть аккаунт? <a class="btn-login js-tgl-login" href="#">Войти</a>
                        </div><!--end row-form -->
                    </form><!--end form-reg -->
                    <form class="form-login" style="display:none" method="post">
                        <div class="row-form">
                            <label for="">E-mail</label>
                            <input class="input inp-email" type="text" name="login_email">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label for="">ПАРОЛЬ</label>
                            <input class="input inp-pass" type="password" name="login_password">
                        </div><!--end row-form -->
                        <div class="row-form b-row-submit">
                            <input type="submit" class="inp-submit" value="Войти">
                        </div><!--end row-form -->
                        <div class="row-form small row-b-login">
                            Нет аккаунта? <a class="btn-login js-tgl-reg" href="#">Зарегистрироваться</a>
                        </div><!--end row-form -->
                    </form><!--end form-login -->
                    <?php if ($error_message != '') echo "<label style='color: red;'>$error_message</label>"  ?>
                </div><!--end b-form-request -->
                <div class="mobile-b-login-form mobile-form-reg">
                    <input type="submit" class="inp-submit" value="присоединиться">
                    <div class="acc-yes">Есть аккаунт? <a class="btn-login js-tgl-login" href="#">Войти</a></div>
                </div><!--end mobile-b-login-form -->
                <div class="mobile-b-login-form mobile-form-login">
                    <input type="submit" class="inp-submit" value="Войти">
                    <div class="acc-yes">Нет аккаунта? <a class="btn-login js-tgl-reg" href="#">Зарегистрироваться</a></div>
                </div><!--end mobile-b-login-form -->
            </div><!--end level-cont -->
            <div class="money1"></div>
            <div class="money2"></div>
        </div><!--end lvl1 -->
        <div class="lvl2">
            <h2>преимущества</h2>
            <h3>AvaLeads предоставляет каждому партнеру</h3>
            <ul class="list-advantages">
                <li class="item">
                    <div class="ico"><img src="/land/img/ic1.png" alt=""></div>
                    Более 50<br>
                    авторских
                    товаров
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic2.png" alt=""></div>
                    Собственные<br>
                    call-центры
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic3.png" alt=""></div>
                    Дружелюбный<br> саппорт 24/7
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic4.png" alt=""></div>
                    Эксклюзивы
                    и <br>приватные офферы
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic5.png" alt=""></div>
                    VIP-условия<br>
                    для ТОПов
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic6.png" alt=""></div>
                    Еженедельные <br>выплаты  и досрочки
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic7.png" alt=""></div>
                    Свежие<br>
                    актуальные промо
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic8.png" alt=""></div>
                    Детальная <br>аналитика
                </li>
            </ul>
            <div class="men-write">
                <a href="#" class="btn-write">Написать менеджеру</a>
            </div>
        </div><!--end lvl2 -->
        <div class="lvl3">
            <h2>WHITEHAT-ОФФЕРЫ ДЛЯ ЛЮБОГО ИСТОЧНИКА ТРАФИКА</h2>
            <h3>Лей то, что конвертит! Без банов и проблем с модерацией</h3>
            <div class="slider-items">
                <div class="slider">
                    <?php $sql = "SELECT * FROM offers WHERE uroven_dostupa = 1 AND active = 1";
                    $res = $mysqli->query($sql);
                    while ($result = $res->fetch_assoc()) { ?>
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="./tmp/offer<?php echo $result['id']; ?>.png" alt=""></div>
                            <div class="b-text">
                                <h4><?php echo $result['name']; ?></h4>
                                <div class="price">Выплата<br>
                                <?php echo $result['comission']; ?> руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="<?php echo $result['url']; ?>" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div>
                    <?php } ?>
                </div><!--end slider -->
            </div><!--end slider-items -->
            <div class="money3"></div>
        </div><!--end lvl3 -->
        <div class="lvl4">
            <h2>Контакты</h2>
            <div class="contacts">
                <div class="block">
                    <div class="telegram">
                        <div class="name">Telegram</div>
                        @avarekl
                    </div>
                </div><!--end block -->
                <div class="block">
                    <div class="email">
                        <div class="name">E-mail</div>
                        av.lead@yandex.ru
                    </div>
                </div><!--end block -->
                <div class="block">
                    <div class="skype">
                        <div class="name">Skype</div>
                        live:.cid.8a6855af6acdc73e
                    </div>
                </div><!--end block -->
            </div><!--end contacts -->
        </div><!--end lvl4 -->
        <div class="lvl5">
            <h2>Партнеры</h2>
            <div class="partners">
                <div class="block"><img src="/land/img/part1.png" alt=""></div>
                <div class="block"><img src="/land/img/part2.png" alt=""></div>
                <div class="block"><img src="/land/img/part3.png" alt=""></div>
                <div class="block"><img src="/land/img/part4.png" alt=""></div>
                <div class="block"><img src="/land/img/part5.png" alt=""></div>
            </div>
            <div class="money4"></div>
        </div><!--end lvl5 -->
        <div class="lvl6">
            <div class="b-check-acc">
                <div class="title">РАСЧЕТНЫЙ<br>
                    СЧЕТ</div>
                <div class="b-check"><img src="/land/img/rs1.png" alt=""></div>
                <div class="b-check"><img src="/land/img/rs2.png" alt=""></div>
                <div class="b-check"><img src="/land/img/rs3.png" alt=""></div>
                <div class="b-check"><img src="/land/img/rs4.png" alt=""></div>
            </div>
        </div><!--end lvl6 -->
        <footer>
            <div class="socs">
                <a href="skype:live:.cid.8a6855af6acdc73e?add"><img src="./img/skype.svg" width="60px"></a>
                <a href="mailto:av.lead@yandex.ru"><img src="./templates/veliyev/img/mail.png" width="60px"></a>
                <a href="https://t.me/avarekl"><img src="./img/telegram.svg" width="60px"></a>
            </div>
            <ul class="foot-menu">
                <li><a href="">ВХОД</a></li>
                <li><a href="">написать нам</a></li>
            </ul>
            <div class="politika"><a href="#">Политика конфиденциальности</a></div>
            <div class="copy">© 2020 AvaLeads. Все права защищены.</div>
        </footer>
    </div>
</div>
