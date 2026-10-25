<div class="over">
    <div class="all">
        <div class="lvl1">
            <header>
                <div class="b-logo"><a href="#" class="logo"><img src="/land/img/logo.png" alt=""></a></div>
                <a id="hamburger-icon"><span class="line line-1"></span><span class="line line-2"></span><span class="line line-3"></span></a>
                <div class="mobile-menu mobile-menu-toggle">
                    <nav>
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Offers</a></li>
                            <li><a href="">Contacts</a></li>
                        </ul>
                    </nav>
                    <div class="head-right">
                        <div class="b-reg"><a href="#" class="btn-reg">Registration</a><div class="b-login"><a href="#" class="login">Sign in</a></div></div>
                        <div class="b-lang"><a href="index.php" class="lang">RU</a><span class="lang active">EN</span></div>
                    </div><!--end head-right -->
                </div><!--end mobile-menu -->
            </header>
            <div class="level-cont">
                <div class="b-slogan">
                    <h1>CPA NETWORK
                        <span>AND DIRECT ADVERTISER</span></h1>
                    <h2>WITH AUTHOR'S <span>WHITEHAT &amp;&nbsp;NUTRA&minus;</span>OFFERS</h2>
                </div><!--end b-slogan -->

                <div class="b-form-request">
                    <div class="form-reg">
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
                            <label for="">Login</label>
                            <input class="input inp-login" type="text">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label for="">password</label>
                            <input class="input inp-pass" type="text">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label for="">your messenger</label>
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
                            <label for="">E-mail</label>
                            <input class="input inp-email" type="text">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label class="mess-type" for="">Telegram</label>
                            <input class="input inp-telegram" type="text">
                        </div><!--end row-form -->
                        <div class="row-form b-row-submit">
                            <input type="submit" class="inp-submit" value="JOIN">
                        </div><!--end row-form -->
                        <div class="row-form small">
                            <div class="yslovia"><input class="inp-checkbox" type="checkbox">I have read and accepted <a href="#">the terms and conditions</a></div>
                        </div><!--end row-form -->
                        <div class="row-form small row-b-login">
                            Have an account?  <a class="btn-login js-tgl-login" href="#">Sign in</a>
                        </div><!--end row-form -->
                    </div><!--end form-reg -->
                    <div class="form-login" style="display:none">
                        <div class="row-form">
                            <label for="">Login</label>
                            <input class="input inp-login" type="text">
                        </div><!--end row-form -->
                        <div class="row-form">
                            <label for="">password</label>
                            <input class="input inp-pass" type="text">
                        </div><!--end row-form -->
                        <div class="row-form b-row-submit">
                            <input type="submit" class="inp-submit" value="Sign in">
                        </div><!--end row-form -->
                        <div class="row-form small row-b-login">
                            Нет аккаунта? <a class="btn-login js-tgl-reg" href="#">Registration</a>
                        </div><!--end row-form -->
                    </div><!--end form-login -->
                </div><!--end b-form-request -->
                <div class="mobile-b-login-form mobile-form-reg">
                    <input type="submit" class="inp-submit" value="JOIN">
                    <div class="acc-yes">Have an account? <a class="btn-login js-tgl-login" href="#">Sign in</a></div>
                </div><!--end mobile-b-login-form -->
                <div class="mobile-b-login-form mobile-form-login">
                    <input type="submit" class="inp-submit" value="Войти">
                    <div class="acc-yes">No account? <a class="btn-login js-tgl-reg" href="#">Registration</a></div>
                </div><!--end mobile-b-login-form -->
            </div><!--end level-cont -->
            <div class="money1"></div>
            <div class="money2"></div>
        </div><!--end lvl1 -->
        <div class="lvl2">
            <h2>advantages</h2>
            <h3>AvaLeads provides each partner with:</h3>
            <ul class="list-advantages">
                <li class="item">
                    <div class="ico"><img src="/land/img/ic1.png" alt=""></div>
                    More than <br>
                    50 copyright products
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic2.png" alt=""></div>
                    Own call <br>
                    centers
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic3.png" alt=""></div>
                    Friendly <br>
                    support 24/7
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic4.png" alt=""></div>
                    Exclusives
                    and <br> private
                    offers
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic5.png" alt=""></div>
                    VIP conditions <br>
                    for TOP-
                    publishrers
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic6.png" alt=""></div>
                    Weekly and <br>
                    early
                    payments
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic7.png" alt=""></div>
                    Fresh and <br>
                    relevant
                    promotions
                </li>
                <li class="item">
                    <div class="ico"><img src="/land/img/ic8.png" alt=""></div>
                    Detailed analytics
                </li>
            </ul>
            <div class="men-write">
                <a href="#" class="btn-write">contact the manager</a>
            </div>
        </div><!--end lvl2 -->
        <div class="lvl3">
            <h2>WHITEHAT OFFERS FOR ANY TRAFFIC SOURCE</h2>
            <h3>High conversion rate without bans and problems with moderation</h3>
            <div class="slider-items">
                <div class="slider">
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item1.png" alt=""></div>
                            <div class="b-text">
                                <h4>зимние<br>
                                    меховые<br>
                                    шапки</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item1.png" alt=""></div>
                            <div class="b-text">
                                <h4>Glucowise –
                                    глюкометр, измеряющий уровень сахара без боли!</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item1.png" alt=""></div>
                            <div class="b-text">
                                <h4>зимние
                                    меховые
                                    шапки</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item1.png" alt=""></div>
                            <div class="b-text">
                                <h4>зимние
                                    меховые
                                    шапки</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item1.png" alt=""></div>
                            <div class="b-text">
                                <h4>зимние
                                    меховые
                                    шапки</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item2.png" alt=""></div>
                            <div class="b-text">
                                <h4>зимние
                                    меховые
                                    шапки</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item2.png" alt=""></div>
                            <div class="b-text">
                                <h4>зимние
                                    меховые
                                    шапки</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                    <div class="slide">
                        <div class="block">
                            <div class="img"><img src="/land/img/item1.png" alt=""></div>
                            <div class="b-text">
                                <h4>зимние
                                    меховые
                                    шапки</h4>
                                <div class="price">Выплата<br>
                                    630 руб.</div>
                                <div class="country">Россия</div>
                            </div>
                            <div class="bottom"><a href="#" class="link"><span>Узнать подробнее</span></a></div>
                        </div>
                    </div><!--end slide -->
                </div><!--end slider -->
            </div><!--end slider-items -->
            <div class="money3"></div>
        </div><!--end lvl3 -->
        <div class="lvl4">
            <h2>Contacts</h2>
            <div class="contacts">
                <div class="block">
                    <div class="title">for publishers</div>
                    <div class="email">
                        <div class="name">Дмитрий</div>
                        ds@avaleads.com
                    </div>
                </div><!--end block -->
                <div class="block">
                    <div class="title">for advertisers</div>
                    <div class="email">
                        <div class="name">Дмитрий</div>
                        ds@avaleads.com
                    </div>
                </div><!--end block -->
                <div class="block">
                    <div class="title">for advertisers</div>
                    <div class="email">
                        <div class="name">Дмитрий</div>
                        ds@avaleads.com
                    </div>
                </div><!--end block -->
            </div><!--end contacts -->
        </div><!--end lvl4 -->
        <div class="lvl5">
            <h2>Partners</h2>
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
                <div class="title">Business <br>
                    account</div>
                <div class="b-check"><img src="/land/img/rs1.png" alt=""></div>
                <div class="b-check"><img src="/land/img/rs2.png" alt=""></div>
                <div class="b-check"><img src="/land/img/rs3.png" alt=""></div>
                <div class="b-check"><img src="/land/img/rs4.png" alt=""></div>
            </div>
        </div><!--end lvl6 -->
        <footer>
            <div class="socs">
                <a href=""><img src="/land/img/ss1.png" alt=""></a>
                <a href=""><img src="/land/img/ss2.png" alt=""></a>
                <a href=""><img src="/land/img/ss3.png" alt=""></a>
            </div>
            <ul class="foot-menu">
                <li><a href="">Sign In</a></li>
                <li><a href="">Write to us</a></li>
            </ul>
            <div class="politika"><a href="#">Privacy policy</a></div>
            <div class="copy">© 2020 AvaLeads.All right reserved.</div>
        </footer>
    </div>
</div>
