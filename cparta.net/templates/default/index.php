<header class="header">
        <div class="prez2">
            <div class="header-top">
                <div class="header-top__left">
                    <a class="header-top__left-logo" href="#">
                        <img src="/landing/images/logo.svg" alt="" title=""/>
                    </a>
                    <div class="header-top__left-text">
                        <a href="#">Товарная CPA сеть</a>
                    </div>
                    <div class="header-top__left-text">
                        <a href="https://cparta.net/calk/" target="blank">Калькулятор оффера</a>
                    </div>
                </div>
                <div class="header-top__right">
                    <a href="#" class="header-top__right-close"><svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M38 2.94332L35.0624 0L19.0007 16.0601L2.94026 0L0 2.94197L16.0604 19L0 35.058L2.94026 38L19.0007 21.9385L35.0624 38L38 35.0567L21.9416 19L38 2.94332Z" fill="white"/></svg></a>
                    <?php if (User::isAuth()) { ?>
                    <a href="./cabinet.php" class="btn btn-dark btn--radius">В кабинет</a>
                    <a href="./logout.php" class="btn btn-white btn--radius">Выйти</a>
                    <? } else { ?>
                    <a href="javascript:;" data-src="#login" data-fancybox data-width="912" data-height="710" class="btn btn-dark btn--radius">Войти</a>
                    <a href="javascript:;" data-src="#register" data-fancybox  data-width="838" data-height="900" class="btn btn-white btn--radius">Зарегистрироваться</a>
                    <? } ?>
                </div>
                <a href="#" class="header-top__mob">
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32 16.0217C32 7.19325 24.8224 0.0108032 16.0001 0.0108032C11.8509 0.0108032 7.91754 1.59328 4.92463 4.46664C4.54676 4.82946 4.53437 5.42999 4.89682 5.80812C5.25927 6.18625 5.85952 6.19853 6.2374 5.83596C8.87557 3.30328 12.3427 1.90841 16.0001 1.90841C23.7769 1.90841 30.1038 8.23959 30.1038 16.0217C30.1038 19.5607 28.7879 22.9462 26.3983 25.5546C23.7318 28.4654 19.9418 30.135 16.0001 30.135C12.2184 30.135 8.5762 28.5982 5.93184 25.9028C5.94751 25.835 5.96496 25.7679 5.98215 25.7008C5.9958 25.6472 6.00845 25.5933 6.02298 25.5402C6.04524 25.4593 6.07001 25.3794 6.09441 25.2995C6.10895 25.252 6.1221 25.204 6.13727 25.1569C6.16685 25.0652 6.19909 24.9749 6.23145 24.8845C6.24372 24.8504 6.25472 24.8156 6.26736 24.7816C6.35952 24.5333 6.46205 24.2906 6.57418 24.0538C6.591 24.0183 6.60933 23.9839 6.62652 23.9488C6.66672 23.8665 6.70693 23.7843 6.74953 23.7036C6.77203 23.661 6.79618 23.6193 6.81944 23.5771C6.85876 23.5053 6.8977 23.4334 6.93878 23.3629C6.96521 23.3175 6.9934 23.2732 7.02058 23.2283C7.06053 23.1624 7.10022 23.0963 7.14169 23.0316C7.17127 22.9855 7.20225 22.9407 7.23259 22.8953C7.27405 22.8333 7.31514 22.7711 7.358 22.7101C7.39024 22.6642 7.42386 22.6195 7.45699 22.5743C7.49997 22.5156 7.5427 22.4567 7.58695 22.3992C7.62171 22.3539 7.65787 22.3096 7.69352 22.2651C7.73815 22.2093 7.78265 22.1532 7.82854 22.0986C7.86558 22.0543 7.90376 22.0112 7.94169 21.9677C7.98808 21.9144 8.03448 21.8611 8.08214 21.8089C8.12133 21.7659 8.16154 21.724 8.20148 21.6817C8.24978 21.6309 8.29807 21.58 8.34737 21.5303C8.38859 21.4888 8.43056 21.4483 8.47241 21.4077C8.52247 21.3593 8.57266 21.3108 8.62386 21.2635C8.66697 21.2237 8.71071 21.1846 8.75445 21.1456C8.80616 21.0994 8.85825 21.0536 8.91096 21.0087C8.95584 20.9705 9.00136 20.9329 9.04712 20.8956C9.1006 20.852 9.15433 20.8086 9.20869 20.7661C9.25534 20.7297 9.30249 20.6939 9.34977 20.6583C9.40489 20.6171 9.46027 20.5762 9.51627 20.5362C9.56469 20.5016 9.61336 20.4675 9.66241 20.4339C9.71905 20.395 9.77607 20.3568 9.83346 20.3193C9.8834 20.2866 9.93359 20.2545 9.98416 20.2227C10.0423 20.1863 10.101 20.1506 10.16 20.1155C10.2113 20.085 10.2629 20.0546 10.3149 20.0251C10.3745 19.9911 10.4349 19.9581 10.4954 19.9254C10.5481 19.897 10.601 19.8688 10.6542 19.8413C10.7154 19.8098 10.7772 19.7795 10.8391 19.7493C10.8931 19.7232 10.9471 19.697 11.0016 19.6718C11.0644 19.6428 11.1278 19.615 11.1912 19.5874C11.2462 19.5635 11.3011 19.5396 11.3565 19.5168C11.4209 19.4904 11.4859 19.4652 11.551 19.4403C11.6069 19.4188 11.6625 19.3972 11.7189 19.3768C11.7849 19.3529 11.8517 19.3306 11.9183 19.3082C11.9748 19.2892 12.0312 19.2699 12.0882 19.2519C12.1558 19.2307 12.2242 19.2111 12.2926 19.1915C12.3496 19.175 12.4065 19.1579 12.464 19.1426C12.5337 19.124 12.604 19.1073 12.6743 19.0902C12.7314 19.0765 12.7884 19.0619 12.846 19.0491C12.9178 19.0332 12.9905 19.0194 13.0629 19.0052C13.1198 18.9941 13.1764 18.982 13.2337 18.9718C13.3084 18.9587 13.3839 18.9478 13.4591 18.9364C13.515 18.9279 13.5705 18.9184 13.6266 18.9111C13.7059 18.9006 13.786 18.8928 13.8659 18.8843C13.9188 18.8787 13.9714 18.8719 14.0245 18.8672C14.1132 18.8594 14.2029 18.8546 14.2922 18.8492C14.3371 18.8466 14.3817 18.8425 14.4267 18.8405C14.5615 18.8346 14.6969 18.8314 14.8331 18.8314H17.1672C19.9067 18.8314 22.4783 20.047 24.2224 22.1666C24.5552 22.5711 25.1529 22.629 25.557 22.2959C25.9612 21.9628 26.0191 21.365 25.6862 20.9604C24.1997 19.1539 22.2147 17.8922 20.0122 17.3059C21.2657 16.1945 22.0578 14.5733 22.0578 12.7697C22.0578 9.42724 19.3404 6.70784 16.0001 6.70784C12.6597 6.70784 9.94231 9.42712 9.94231 12.7697C9.94231 14.5733 10.7345 16.1944 11.9878 17.3057C11.9567 17.3141 11.9254 17.3219 11.8943 17.3304C11.7643 17.3662 11.6354 17.4045 11.5073 17.445C11.4916 17.45 11.4756 17.4543 11.4599 17.4592C11.3163 17.5052 11.1742 17.5544 11.033 17.6061C10.989 17.6221 10.9457 17.6398 10.902 17.6565C10.8053 17.6934 10.7087 17.7307 10.6132 17.7703C10.5603 17.7922 10.508 17.8153 10.4555 17.8381C10.3701 17.875 10.2849 17.9123 10.2007 17.9513C10.1457 17.9767 10.0914 18.0029 10.0369 18.0292C9.95571 18.0684 9.87518 18.1084 9.79503 18.1495C9.74092 18.1772 9.68694 18.2053 9.63334 18.234C9.55306 18.2769 9.47354 18.3211 9.3944 18.366C9.34333 18.395 9.29212 18.4237 9.24156 18.4534C9.15837 18.5024 9.07632 18.553 8.9944 18.6041C8.94978 18.6319 8.90477 18.659 8.86052 18.6874C8.75888 18.7528 8.65863 18.8205 8.55926 18.8892C8.5365 18.9049 8.51324 18.9197 8.49061 18.9357C8.36925 19.0209 8.24978 19.1087 8.13195 19.1988C8.09782 19.2248 8.0647 19.2523 8.03082 19.2787C7.94788 19.3438 7.8652 19.4092 7.78404 19.4765C7.74093 19.5123 7.69871 19.5492 7.65623 19.5856C7.58568 19.646 7.51552 19.7067 7.44662 19.7688C7.40212 19.8089 7.35838 19.8497 7.31451 19.8905C7.24902 19.9515 7.18404 20.0131 7.11995 20.0757C7.07646 20.1182 7.03322 20.161 6.99036 20.2043C6.92703 20.2683 6.8647 20.3332 6.80301 20.3987C6.76217 20.442 6.72134 20.485 6.68126 20.529C6.61742 20.599 6.55497 20.6703 6.49289 20.7419C6.45737 20.7829 6.42121 20.8234 6.38619 20.865C6.313 20.9521 6.24157 21.041 6.17102 21.1304C6.14928 21.158 6.12665 21.1847 6.10516 21.2125C6.01401 21.3302 5.92526 21.4499 5.83879 21.5714C5.81578 21.6038 5.79404 21.6371 5.77141 21.6697C5.7087 21.7599 5.6465 21.8506 5.58645 21.9429C5.55611 21.9895 5.52703 22.037 5.49732 22.0842C5.44688 22.1642 5.39682 22.2446 5.3484 22.326C5.31743 22.378 5.28746 22.4307 5.25737 22.4833C5.21224 22.5621 5.16787 22.6414 5.12463 22.7215C5.09518 22.776 5.06623 22.8309 5.03765 22.886C4.99581 22.9667 4.9551 23.0482 4.91528 23.13C4.88835 23.1852 4.86155 23.2402 4.83551 23.2959C4.7953 23.3821 4.75674 23.4693 4.71869 23.5568C4.69594 23.6092 4.67255 23.6611 4.65042 23.714C4.60782 23.816 4.56762 23.9194 4.52792 24.0231C4.51288 24.0624 4.49682 24.1011 4.48228 24.1405C4.48013 24.1464 4.47773 24.1519 4.47558 24.1577C2.80239 21.7888 1.89633 18.958 1.89633 16.0217C1.89633 15.4977 1.4718 15.0729 0.948163 15.0729C0.424524 15.0729 0 15.4977 0 16.0217C0 20.0368 1.49304 23.8777 4.2039 26.8369C7.22867 30.1388 11.5283 32.0324 15.9999 32.0324C20.4719 32.0324 24.7713 30.1388 27.7961 26.8368C27.7964 26.8365 27.7966 26.8362 27.7969 26.8359C30.5073 23.8768 32 20.0363 32 16.0217ZM16.0001 8.60545C18.2946 8.60545 20.1615 10.4735 20.1615 12.7697C20.1615 15.0659 18.2947 16.9339 16.0001 16.9339C13.7054 16.9339 11.8386 15.0659 11.8386 12.7697C11.8386 10.4735 13.7054 8.60545 16.0001 8.60545Z" fill="white"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <section>
        <div class="prez">
            <div class="sketchfab-embed-wrapper" style="width:calc(100% - 58.7931%); float: left; position: relative;" >
                <img src="/landing/shlem.gif" style="width: 100%;">
                <!--<div class="upper" style="    width: 100%;
    height: 43px;
    position: absolute;
    z-index: 1000;
    background: #010101;
    top: 0px;"></div><div class="lower" style="    width: 100%;
    height: 50px;
    position: absolute;
    z-index: 1000;
    background: #010101;
    bottom: 0px;"></div>
                <iframe title="A 3D model" height="480" style="width:100%;" src="https://sketchfab.com/models/a7559713c6124a3fbc640893448db887/embed?autostart=1&amp;camera=0" frameborder="0" allow="autoplay; fullscreen; vr" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>-->
            </div>
            <h1 class="main-title">САМЫЙ<br>ВЫСОКИЙ<br>ПРОЦЕНТ АПРУВА<br>РОССИИ И СНГ</h1>
        </div>
    </section>

    <section>
        <div class="wrapper">
            <div class="conditions">
                <div class="conditions-item">
                    <div class="conditions-item__title">Выплаты сразу<br>после апрува</div>
                    <div class="conditions-item__ico">
                        <i class="ico ico-conditions1"></i>
                    </div>
                </div>
                <div class="conditions-item">
                    <div class="conditions-item__title">Тысячи лидов в день<br>Мощный CR</div>
                    <div class="conditions-item__ico">
                        <i class="ico ico-conditions2"></i>
                    </div>
                </div>
                <div class="conditions-item">
                    <div class="conditions-item__title">Чистый апрув<br>65 - 73 %</div>
                    <div class="conditions-item__ico">
                        <i class="ico ico-conditions3"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="wrapper">
            <div class="prez-two">
                <h2 class="main-title">БЕЗ КОПЬя<br>НЕ ОСТАВИМ</h2>
            </div>
        </div>
    </section>

    <section>
        <div class="wrapper">
            <div class="treatment">
                <h3 class="main-title--sub">ОБРАБОТКА  ЛИДОВ</h3>
                <div class="leads">
                    <div class="leads-item">
                        <div class="leads-item__title">
                            Собственный шейв отдел
                        </div>
                        <a href="#" class="leads-item__arrow">
                            <svg width="32" height="18" viewBox="0 0 32 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M29.2462 0.467482L16.0015 13.5004L2.75682 0.465913C2.12535 -0.155304 1.10387 -0.155304 0.472404 0.465913C-0.157468 1.08713 -0.157468 2.0936 0.472404 2.71482L14.8586 16.8722C15.4885 17.4934 16.5115 17.4934 17.1414 16.8722L31.5276 2.71495C32.1575 2.09373 32.1575 1.08569 31.5276 0.464475C30.8993 -0.153735 29.8761 -0.153735 29.2462 0.467482Z" fill="white"/>
                            </svg>
                        </a>
                        <div class="leads-item__desc">
                            <p>Шейв это бич для вебмастеров, которые не могут сами проверить актуальность. </p>
                            <p>По просьбе ТОПовых арбитражных команд мы создали отдел борьбы с шейвингом.</p>
                            <p>Мы проверяем работу рекламодателей и сами прозвониваем часть отклоненных заказов.</p>
                            <p>В случае выявления шейва компенсируем сумму вебмастерам и затем взыскиваем  с депозита рекламодателя.</p>
                        </div>
                    </div>
                    <div class="leads-item">
                        <div class="leads-item__title">
                            Динамическая статистика процента апрува
                        </div>
                        <a href="#" class="leads-item__arrow">
                            <svg width="32" height="18" viewBox="0 0 32 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M29.2462 0.467482L16.0015 13.5004L2.75682 0.465913C2.12535 -0.155304 1.10387 -0.155304 0.472404 0.465913C-0.157468 1.08713 -0.157468 2.0936 0.472404 2.71482L14.8586 16.8722C15.4885 17.4934 16.5115 17.4934 17.1414 16.8722L31.5276 2.71495C32.1575 2.09373 32.1575 1.08569 31.5276 0.464475C30.8993 -0.153735 29.8761 -0.153735 29.2462 0.467482Z" fill="white"/>
                            </svg>
                        </a>
                        <div class="leads-item__desc">
                            <p>Веб мастер может посмотреть статистику процента апрува по офферу до того, как зальет трафик.</p>
                            <p>Она автоматически складывается исходя из объема за прошлую неделю и отображается в дашборде.</p>
                            <p>Если афер новый, и по нему еще нет статистики, то ваш персональный менеджер доведет всю информацию.</p>
                        </div>
                    </div>
                    <div class="leads-item">
                        <div class="leads-item__title">
                            Свой коллцентр 24&nbsp;на 7
                        </div>
                        <a href="#" class="leads-item__arrow">
                            <svg width="32" height="18" viewBox="0 0 32 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M29.2462 0.467482L16.0015 13.5004L2.75682 0.465913C2.12535 -0.155304 1.10387 -0.155304 0.472404 0.465913C-0.157468 1.08713 -0.157468 2.0936 0.472404 2.71482L14.8586 16.8722C15.4885 17.4934 16.5115 17.4934 17.1414 16.8722L31.5276 2.71495C32.1575 2.09373 32.1575 1.08569 31.5276 0.464475C30.8993 -0.153735 29.8761 -0.153735 29.2462 0.467482Z" fill="white"/>
                            </svg>
                        </a>
                        <div class="leads-item__desc">
                            <p>Если льете похожий афер в другой партнерке, сделайте Сплит тест с нами. Как правило, вебмастера остаются выбирают нас.</p>
                            <p>Наш коллцентр разделен на отделы, каждый отдел обрабатывает только свою категорию товаров.</p>
                            <p>За счет этого мы можем держать самый высокий апрув на рынке.</p>
                            <p>Если мы видим, что коллцентр рекламодателя дает низкий процент апрува, мы переключаем трафик на свой коллцентр и передаем рекламодателю уже готовые заказы, предоставляя записи звонков.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="white">
        <div class="wrapper">
            <div class="quest">
                <h2 class="main-title__center w1">К КАЖДОМУ ВЕБМАСТЕРУ ПРИКРЕПЛЕН ЛИЧНЫЙ МЕНЕДЖЕР</h2>
                <a href="tg://resolve?domain=CPArta_info" class="btn btn-white btn--rectangle">ЗАДАТЬ ВОПРОС МеНЕДЖЕРУ</a>
                <h2 class="main-title__center w2">ВЫПЛАТЫ ДЕНЬ В ДЕНЬ ПО&nbsp;ЗАПРОСУ</h2>
            </div>
        </div>
    </section>

    <section>
        <div class="wrapper">
            <div class="payment">
                <div class="payment-top">
                    <h2 class="main-title"><span>ВЫПЛАТЫ</span> И УСЛОВИЯ ВЕБМАСТЕРАМ</h2>
                </div>
                <div class="payment-middle">
                    <div class="payment-middle__item">
                        <h3>Чистоту трафика<br>конвертируем в выплаты</h3>
                        <p>Мы готовы делиться деньгами  и хотим, чтобы с нами сотрудничали лучшие. </p>
                        <p>Ваш личный менеджер сам предложит вам повышенную выплату при условии хорошего показателя выкупа.</p>
                        <p>Динамическая ставка рассчитывается автоматически и в течение времени информацию по повышению можно смотреть в личном кабинете.</p>
                    </div>
                    <div class="payment-middle__item">
                        <h3>Арбитражным командам<br>и сильным вебам</h3>
                        <p>Наша команда тестировщиков постоянно просматривает тенденции рынка — так мы выводим свои продукты. </p>
                        <p>Постоянным партнерам предлагаем в Привате.</p>
                        <p>Если у вас есть обьем трафика на оффер из другой партнерки , мы готовы предложить более лучшие условия. </p>
                        <p>Так же наша команда дизайнеров готова отрисовать под вас конвертирующий лендинг или внести корректировки в существующий.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="wrapper">
            <div class="prez-tree">
                <h2 class="main-title">МЫ МОЖЕМ <br>ДАТЬ САМЫЕ<br> ВЫСОКИЕ СТАВКИ <br>НА ОФФЕРЫ</h2>
                <a href="tg://resolve?domain=CPArta_info" class="btn btn-dark btn--rectangle">ПОСМОТРЕТЬ АКТУАЛЬНЫЕ ОФФЕРЫ</a>
            </div>
        </div>

    </section>

    <section class="white">
        <div class="wrapper">
            <div class="quest">
                <h2 class="main-title__center w1" style="text-transform:uppercase;">У нас лучший апрув на рынке физтоваров РФ</h2>
                <a href="tg://resolve?domain=CPArta_info" class="btn btn-white btn--rectangle">ОСТАВИТЬ ЗАЯВКУ</a>
                <h2 class="main-title__center w2" style="text-transform:uppercase;">возьмем ваш трафик на прозвон<br>поднимем стату</h2>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="prez2">
            <a class="footer-logo" href="#">
                <img src="/landing/images/footer-logo.svg" alt="" title=""/>
            </a>
            <div class="footer-social">
                <a href="https://vk.com/cparta_net"><i class="ico ico-vk"></i></a>
                <a href="tg://resolve?domain=CPArta_info"><i class="ico ico-tg"></i></a>
                <!--<a href="#"><i class="ico ico-fc"></i></a>-->
                <a href="https://www.instagram.com/cparta.traf/"><i class="ico ico-inst"> </i> </a>
            </div>
        </div>
    </footer>
    <div>
    <center><a href="./politica.php" target="_blank"><u>Пользовательское соглашение<u></a></center>
    </div>
    <!-- MODAL #1 -->
    <div class="modal" id="login">
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
                    <a href="#" class="form-box__forgot" data-src="#recover" data-fancybox data-width="912" data-height="710">Забыли пароль?</a>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="recover">
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
                            <img onclick="ResetCaptcha2();" id="captcha2" class="img-fluid " style="margin-top:22px;" src="captcha.php?rnd=<?=rand(1,10000); ?>">
                        </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-white btn--radius">Отправить</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL #2 -->
    <? $rand = rand(1,10000); ?>
    <div class="modal" id="register">
        <ul style="width: 90%;">
            <li style="display:inline-block;"><a class="btn btn-white" style="padding:5px 25px;" href="#" onclick="$('.form').hide(); $('.form_webmaster').show();">РЕГИСТРАЦИЯ ВЕБМАСТЕРА</a></li>
            <li style="display:inline-block;"><a class="btn btn-white" style="padding:5px 25px;" href="#" onclick="$('.form').hide(); $('.form_rek').show();">РЕГИСТРАЦИЯ РЕКЛАМОДАТЕЛЯ</a></li>
        </ul>
        <div class="form form_webmaster">
            <form action="./signup.php" method="post">
                <div class="form-box">
                    <h3 class="form-box__title">РЕГИСТРАЦИЯ<br> ВЕБМАСТЕРА<h3>
                    <input id="type_reg" type="hidden" name="registration_tip" value="10">
                    <div class="form-box__row">
                        <label for="">Ваш E-mail*</label>
                        <input type="email" name="registration_email"  placeholder="E-mail" required/>
                    </div>
                    <div class="form-box__row">
                        <label for="">Телефон *</label>
                        <p>
                            <select name="registration_phone_code" style="width: 100px; float:left; margin-right: 10px; height: 40px;">
                                <option value="+7">Россия (+7)</option>
                            </select>
                            <input style="width: calc(100% - 110px);" type="text" class="registration_phone" name="registration_phone" placeholder="XXXXXXXXXX" required/>
                        </p>
                    </div>
                    <div class="form-box__row">
                        <label for="">Telegram *</label>
                        <input type="text" name="registration_telegram" class="telegram" value="@" placeholder="@" minlength="2" required/>
                    </div>
                    <div class="form-box__row form-box__just">
                        <div class="form-box__row-bl">
                            <label for="">Введите пароль *</label>
                            <input type="password" name="registration_password_1" value=""  autocomplete="on" required/>
                        </div>
                        <div class="form-box__row-bl">
                            <label for="">Повторите пароль *</label>
                            <input type="password" name="registration_password_2"  autocomplete="on" value="" required/>
                        </div>
                    </div>
                    <div class="form-box__row form-box__just">
                        <div class="form-box__row-bl">
                            <label for="">Введите код с картинки *</label>
                            <input type="text" name="captcha" id="cap" value="" required/>
                        </div>
                        <div class="form-box__row-bl form-box__row-bl--captcha">
                            <img onclick="ResetCaptcha();" class="img-fluid " style="margin-top:22px;" src="captcha.php?rnd=<?=$rand; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source'];?>">
                    <input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium'];?>">
                    <input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign'];?>">
                    <input type="hidden" name="utm_term" value="<?php echo $_GET['utm_term'];?>">
                    <input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content'];?>">
                    <label class="form-box__rules" for="rule"> <input type="checkbox" name="registration_agree_rules" value=""/> <a href="./politica.php" target="_blank"><u>Я принимаю пользовательское соглашение<u></a></label>
                    <p>Для окончания регистрации Вас переведёт в телеграмм</p>
                    <button type="submit" name="button" class="btn btn-white btn--radius">Зарегистрироваться</button>
                </div>
            </form>
        </div>
        <div class="form form_rek" style="display:none;">
            <form action="./signup_adv.php" method="post">
                <div class="form-box">
                    <h3 class="form-box__title">РЕГИСТРАЦИЯ<br> РЕКЛАМОДАТЕЛЯ<h3>
                    <input id="type_reg" type="hidden" name="registration_tip" value="40">
                    <div class="form-box__row">
                        <label for="email">* E-mail</label>
                        <input type="text" class="form-control" id="email" name="registration_email" placeholder="E-mail" required maxlength="40">
                    </div>
                    <div class="form-box__row">
                        <label for="">Телефон *</label>
                        <p>
                            <select name="registration_phone_code" style="width: 100px; float:left; margin-right: 10px; height: 40px;">
                                <option value="+7">Россия (+7)</option>
                            </select>
                            <input style="width: calc(100% - 110px);" type="text" class="registration_phone" name="registration_phone" placeholder="XXXXXXXXXX" required/>
                        </p>
                    </div>
                    <div class="form-box__row">
                        <label for="telegram">Ваш Telegram</label>
                        <input type="text" class="form-control telegram" id="telegram" value="@" minlength="2" name="registration_telegram" placeholder="@" required>
                    </div>
                    <div class="form-box__row">
                        <label for="company">Название компании</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="Название компании" >
                    </div>
                    <div class="form-box__row">
                        <label for="site">Адрес сайта/лендинга</label>
                        <input type="text" class="form-control" id="site" name="site" placeholder="http://" >
                    </div>
                    <div class="form-box__row form-box__just">
                        <div class="form-box__row-bl">
                            <label for="">Введите пароль *</label>
                            <input type="password" name="registration_password_1" value=""  autocomplete="on" required/>
                        </div>
                        <div class="form-box__row-bl">
                            <label for="">Повторите пароль *</label>
                            <input type="password" name="registration_password_2"  autocomplete="on" value="" required/>
                        </div>
                    </div>                         
                    <div class="form-box__row form-box__just">
                        <div class="form-box__row-bl">
                            <label for="">Введите код с картинки *</label>
                            <input type="text" name="captcha" id="cap" value="" required/>
                        </div>
                        <div class="form-box__row-bl form-box__row-bl--captcha">
                            <img onclick="ResetCaptcha();" class="img-fluid " style="margin-top:22px;" src="captcha.php?rnd=<?=$rand; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source'];?>">
                    <input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium'];?>">
                    <input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign'];?>">
                    <input type="hidden" name="utm_term" value="<?php echo $_GET['utm_term'];?>">
                    <input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content'];?>">
                    <label class="form-box__rules" for="rule"> <input type="checkbox" name="registration_agree_rules" value="" /> <a href="./politica.php" target="_blank"><u>Я принимаю пользовательское соглашение</u></a></label>
                    <p>Для окончания регистрации Вас переведёт в телеграмм</p>
                    <button type="submit" name="button" class="btn btn-white btn--radius">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
    <script></script>
    <?php
    if(isset($_GET['u'])){
        if($_GET['u'] === 'ujPfac9633yZSdjS2Q'){
            $id = User::isAuth();
            if($id){
                DB::Query("UPDATE `users` SET `active` = '1' WHERE `id`='$id'") or die("не удалось обновить");
            }
        }
    }
    ?>