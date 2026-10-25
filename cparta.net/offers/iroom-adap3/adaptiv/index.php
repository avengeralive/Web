<?php 
   $offer = 131;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Купить робот-пылесос iRoom</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <style>
        .wrapper-all{ opacity: 0; }
    </style>
    <meta name="viewport" content="width=device-width,initial-scale=1">
 <!-- itg-top_metrika -->
	
<!-- itg-top_metrika -->
 <!-- itg-top_metrika --> 
<!-- itg-top_metrika -->
</head>

<body> 
	<!-- itg-calltracking -->
	

 
<!-- itg-calltracking -->
    <div id="app">
        <div class="wrapper-all" :class="{loading: !componentLoading}">
            <header class="header">
                <div class="wrapper">
                    <div class="container"><button class="menu-btn" v-on:click.prevent="modalOpen('menu')"><span></span> <span></span> <span></span></button>
                        <ul class="nav">
                            <li class="nav-link"><a href="index.php" v-on:click.prevent="scrollTo('.s1')">Главная</a></li>
                            <li class="nav-link"><a href="index.php" v-on:click.prevent="scrollTo('.s3')">Характеристики</a></li>
                            <li class="nav-link"><a href="index.php" v-on:click.prevent="scrollTo('.s4')">Преимущества</a></li>
                            <li class="nav-link"><a href="index.php" v-on:click.prevent="scrollTo('.s5')">Отзывы</a></li>
                            <li class="nav-link"><a href="index.php" v-on:click.prevent="scrollTo('.s7')">Как мы работаем?</a></li>
                            <li class="nav-link"><a href="index.php" v-on:click.prevent="scrollTo('.s8')">Ваш бонус</a></li>
                        </ul>
                        <div class="header-contacts"><a href="index.php" class="phone" ><span></span></a> <button class="btn" href="" v-on:click.prevent="scrollTo ('#form')"> <span>Заказать со скидкой</span></button></div>
                    </div>
                </div>
            </header>
            <section id="s1" class="s1" :class="{animated: !componentLoading}">
                <div class="wrapper">
                    <div class="container">
                        <div class="left"><img src="image/section1/robot.png" alt="pic" class="pic">
                            <div class="sale">
                                <p class="sale-text">Закажите сейчас, по акционной цене :</p> <span class="old">7980 руб</span> <span class="new">3990 руб</span> </div>
                            <div class="count">
                                <p class="count-text">Осталось на складе:</p>
                                <p class="count-val">23<span> шт</span></p>
                            </div>
                        </div>
                        <div class="right">
                            <h1 class="heading">Мощный робот-пылесос <span> iRoom</span><br>по мощной скидке 50%!</h1>
                            <ul class="list">
                                <li>Планирование уборки в удобное для Вас время</li>
                                <li>Низкий уровень шума</li>
                            </ul>
                            <div class="pic_md"><img src="image/section1/robot.png" alt="pic" class="pic">
                                <div class="sale">
                                    <p class="sale-text">Закажите сейчас, по акционной цене :</p><span class="old">7980 руб</span> <span class="new">3990 руб</span> </div>
                                <div class="count">
                                    <p class="count-text">Осталось на складе:</p>
                                    <p class="count-val">23<span> шт</span></p>
                                </div>
                            </div>
                            <div class="timer-sm">
                                <p class="timer-text">До конца акции осталось:</p>
                                <div class="countbox" id="timer">
            <div class="countbox-num">
                <div class="countbox-case hours">00</div> 
                <div class="countbox-text">Часов</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case minutes">00</div>
                <div class="countbox-text">Минут</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case seconds">00</div>
                <div class="countbox-text">Секунд</div>
            </div>
        </div>
                            </div>
                            <form action="./_success_/" class="form" method="post">
                            <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
                                                                                                                                                    <input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
                                                                                                                                                    <input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" /> 
                                 <input class="input" type="text" name="name" placeholder="ФИО" required="">
                                 <input class="input" type="text" name="phone" placeholder="Ваш телефон"  required="">
                                 <button class="btn" type="submit"><span>Заказать со скидкой</span></button>
<!-- itg-form-code -->
<!-- itg-form-code -->

                                  </form>
                            <div class="timer">
                                <p class="timer-text">До конца акции осталось:</p>
                                <div class="countbox" id="timer">
            <div class="countbox-num">
                <div class="countbox-case hours">00</div> 
                <div class="countbox-text">Часов</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case minutes">00</div>
                <div class="countbox-text">Минут</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case seconds">00</div>
                <div class="countbox-text">Секунд</div>
            </div>
        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="s2" class="s2">
                <div class="wrapper">
                    <h2 class="title" v-animate="2"><span>Почему</span> робот-пылесос?</h2>
                    <div class="items" v-animate="2">
                        <div class="item"><img src="image/section2/1.png" alt="pic" class="item-pic">
                            <p class="item-heading">ПОРТАТИВНОСТЬ</p>
                            <p class="item-text">Носить и возить громоздкий аналоговый пылесос теперь нет необходимости.</p>
                        </div>
                        <div class="item"><img src="image/section2/2.png" alt="pic" class="item-pic">
                            <p class="item-heading">АВТОНОМНОСТЬ</p>
                            <p class="item-text"> Больше не нужно заниматься уборкой, робот самостоятельно будет делать генеральную уборку, пока Вас нет дома.</p>
                        </div>
                        <div class="item"><img src="image/section2/3.png" alt="pic" class="item-pic">
                            <p class="item-heading">РЕГУЛЯРНОСТЬ</p>
                            <p class="item-text">Робот ежедневно в запланированное время будет ухаживать за чистотой в Вашем доме и никогда не подведет Вас. Уборка теперь станет регулярной и автоматической.</p>
                        </div>
                        <div class="item"><img src="image/section2/5.png" alt="pic" class="item-pic">
                            <p class="item-heading">ВЛАЖНАЯ УБОРКА</p>
                            <p class="item-text">Не оставляет пыли и разводов на паркете с помощью всегда влажного полотера установленного на основании пылесоса.</p>
                        </div>
                        <div class="item"><img src="image/section2/6.png" alt="pic" class="item-pic">
                            <p class="item-heading">БЕСШУМНОСТЬ</p>
                            <p class="item-text">Уборка может происходить во время сна или во время просмотра телевизора.</p>
                        </div>
                        <div class="item"><img src="image/section2/7.png" alt="pic" class="item-pic">
                            <p class="item-heading">ТЕХНОЛОГИЧНОСТЬ</p>
                            <p class="item-text">Сканирует помищение и помнит маршрут уборки . Имеет самый большой контейнер для сухой уборки из всех роботов-пылесосов - 700 мл.</p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="s3" class="s3">
                <div class="wrapper">
                    <h2 class="title show-sm" v-animate="2"><span>характеристики</span><br>робота-пылесоса</h2>
                    <div class="container" v-animate="2">
                        <div class="left">
                            <slick class="slider" ref="slider" :options="slider" id="slider">
                                <div class="slide"><img src="image/section3/1.png" alt="pic"></div>
                                <div class="slide"><img src="image/section3/2.png" alt="pic"></div>
                                <div class="slide"><img src="image/section3/3.png" alt="pic"></div>
                            </slick>
                            <slick class="slider-nav" ref="sliderNav" :options="sliderNav" id="sliderNav">
                                <div class="slide"><img src="image/section3/1.png" alt="pic"></div>
                                <div class="slide"><img src="image/section3/2.png" alt="pic"></div>
                                <div class="slide"><img src="image/section3/3.png" alt="pic"></div>
                            </slick>
                        </div>
                        <div class="right">
                            <h2 class="title hidden-sm" v-animate="2"><span>характеристики</span><br>робота-пылесоса</h2>
                            <ul class="list">
                                <li class="list-item"><span>Модель:</span> 3D16001</li>
                                <li class="list-item"><span>Стиль пылесоса:</span> беспроводной</li>
                                <li class="list-item"><span>Размер:</span> 26см х 24см х 7см</li>
                                <li class="list-item"><span>Функция пылесоса:</span> влажная и сухая уборка</li>
                                <li class="list-item"><span>Тип:</span> Домашний, офисный, гостиничный</li>
                                <li class="list-item"><span>Материал корпуса:</span> Высокопрочный ABS пластик</li>
                                <li class="list-item"><span>Емкость пылесборника:</span> 0.7 л</li>
                                <li class="list-item"><span>Источник питания:</span> Литиевый аккумулятор</li>
                                <li class="list-item"><span>Номинальное напряжение:</span> 110-220 В</li>
                                <li class="list-item"><span>Номинальная частота:</span> 50 Гц</li>
                                <li class="list-item"><span>Номинальная мощность:</span> 8 Вт</li>
                                <li class="list-item"><span>Рабочее время:</span> 90-150 мин</li>
                                <li class="list-item"><span>Время полной зарядки:</span> 3-4 ч</li>
                                <li class="list-item"><span>Уровень шума:</span> 55 дБ</li>
                                <li class="list-item"><span>Цвет корпуса:</span> Черно-белый, черный</li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn"><a href="index.php" class="phone" ><span></span></a> <button class="btn" href="" v-on:click.prevent="scrollTo ('#form')"> <span>Заказать со скидкой</span></button></div>
                </div>
            </section>
            <section id="s4" class="s4">
                <div class="wrapper">
                    <h2 class="title" v-animate="2"><span>преимущества</span> робота-пылесоса</h2>
                </div>
                <div class="items" v-animate="2">
                    <div class="item">
                        <div class="item-pic" style="background-image: url('image/section4/1.png')"></div>
                        <div class="item-container">
                            <p class="item-heading">Не нужен старый пылесос</p>
                            <p class="item-text">Робот исключит аналоговый пылесос из Вашей жизни</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-pic" style="background-image: url('image/section4/2.png')"></div>
                        <div class="item-container">
                            <p class="item-heading">Интеллектуальная уборка</p>
                            <p class="item-text">Робот пылесос работает по оптимальным алгоритмам, для осуществления максимально эффективной уборки не убирая в одной и той же области несколько раз.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-pic" style="background-image: url('image/section4/3.png')"></div>
                        <div class="item-container">
                            <p class="item-heading">Не боится лестниц</p>
                            <p class="item-text">Благодаря встроенным датчикам, не упадет с высоты.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-pic" style="background-image: url('image/section4/5.png')"></div>
                        <div class="item-container">
                            <p class="item-heading">скрупулезный в каждой детали</p>
                            <p class="item-text">Система предотвращения столкновений и серия датчиков на бампере защищает мебель. Идеальный помощник в Вашем доме.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-pic" style="background-image: url('image/section4/6.png')"></div>
                        <div class="item-container">
                            <p class="item-heading">Чистит даже в самых труднодоступных местах</p>
                            <p class="item-text">С помощью специальных кисточек может заметать грязь в труднодоступных местах.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-pic" style="background-image: url('image/section4/8.png')"></div>
                        <div class="item-container">
                            <p class="item-heading">Влажная уборка</p>
                            <p class="item-text">Для влажной уборки робот-пылесос использует насос с электронным управлением и резервуаром объемом 300мл. С помощью датчиков пылесос распределяет влагу равномерно по всей площади микрофибры (швабры на основании пылесоса).</p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="s5" class="s5">
                <div class="wrapper">
                    <h2 class="title" v-animate="2">отзывы <span>наших</span> клиентов</h2>
                    <slick class="slider" ref="s5slider" :options="s5slider" v-animate="2">
                        <div class="slide"><img src="image/section5/1.png" alt="pic"></div>
                        <div class="slide"><img src="image/section5/2.png" alt="pic"></div>
                        <div class="slide"><img src="image/section5/3.png" alt="pic"></div>
                        <div class="slide"><img src="image/section5/4.png" alt="pic"></div>
                    </slick>
                </div>
            </section>
            <section id="s7" class="s7">
                <div class="wrapper">
                    <h2 class="title" v-animate="2"><span>преимущества</span> покупки у нас</h2>
                    <div class="items" v-animate="2">
                        <div class="item" data-number="1">
                            <div class="item-pic"><img src="image/section7/1.png" alt="pic"></div>
                            <p class="item-heading">Корейское качество</p>
                            <p class="item-text">iRoom - Это техника за которую не стыдно, изготовлено по последним нано-технологиям </p>
                        </div>
                        <div class="item" data-number="2">
                            <div class="item-pic"><img src="image/section7/3.png" alt="pic"></div>
                            <p class="item-heading">Доставка по СНГ осуществляется почтой от 7 рабочих дней</p>
                            <p class="item-text">Мы работаем без предоплаты. Вы заказываете на сайте, получаете Ваш заказ и после этого оплачиваете</p>
                        </div>
                        <div class="item" data-number="3">
                            <div class="item-pic"><img src="image/section7/5.png" alt="pic"></div>
                            <p class="item-heading">Помощь в подключении</p>
                            <p class="item-text">По любым вопросам Вы можете обратиться на входящую линию и наши специалисты помогут Вам в подключении</p>
                        </div>
                        <div class="item" data-number="4">
                            <div class="item-pic"><img src="image/section7/6.png" alt="pic"></div>
                            <p class="item-heading">Более 2000 клиентов</p>
                            <p class="item-text">22% клиентов покупают повторно. 78% рекомендуют нас друзьям!</p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="s8" class="s8"><img src="image/section8/pic_2.png" alt="pic" class="pic_2">
                <div class="wrapper"><img src="image/section8/pic_1.png" alt="pic" class="pic_1"> <img src="image/section8/pic_3.png" alt="pic" class="pic_3">
                    <div class="container" v-animate="2">
                        <div class="left">
                            <h2 class="heading">Бонус</h2>
                            <p class="subheading">для самых быстрых</p>
                            <div class="block">
                                <p class="text">Заказывай сегодня и получи дополнительную скидку</p>
                            <div class="btn"><a href="index.php" class="phone" ><span></span></a> <button class="btn" href="" v-on:click.prevent="scrollTo ('#form')"> <span>Заказать со скидкой 50%</span></button></div>
                        </div>
                    </div>
                </div>
            </section>
            <section  class="s9">
                <div class="wrapper">
                    <div class="container" v-animate="2">
                        <div class="left"><img src="image/section1/robot.png" alt="pic" class="pic">
                            <div class="sale">
                                <p class="sale-text">Закажите сейчас, по акционной цене :</p><span class="old">7980 руб</span> <span class="new">3990 руб</span> </div>
                            <div class="count">
                                <p class="count-text">Осталось на складе:</p>
                                <p class="count-val">23<span> шт</span></p>
                            </div>
                        </div>
                        <div class="right">
                            <h1 class="heading">Мощный робот-пылесос<span> iRoom</span><br>по мощной скидке 50%!</h1>
                            <ul class="list">
                                <li>Планирование уборки в удобное для Вас время</li>
                                <li>Низкий уровень шума</li>
                            </ul>
                            <div class="pic_md"><img src="image/section1/robot.png" alt="pic" class="pic">
                                <div class="sale">
                                    <p class="sale-text">Закажите сейчас, по акционной цене :</p><span class="old">7980 руб</span> <span class="new">3990 руб</span> </div>
                                <div class="count">
                                    <p class="count-text">Осталось на складе:</p>
                                    <p class="count-val">23<span> шт</span></p>
                                </div>
                            </div>
                            <div class="timer-sm">
                                <p class="timer-text">До конца акции осталось:</p>
                                <div class="countbox" id="timer">
            <div class="countbox-num">
                <div class="countbox-case hours">00</div> 
                <div class="countbox-text">Часов</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case minutes">00</div>
                <div class="countbox-text">Минут</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case seconds">00</div>
                <div class="countbox-text">Секунд</div>
            </div>
        </div>
                            </div>
                           <form action="./_success_/" id="form" class="form" method="post">
                           <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
                                                                                                                                                    <input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
                                                                                                                                                    <input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" /> 
                                 <input class="input" type="text" name="name" placeholder="ФИО" required="">
                                 <input class="input" type="text" name="phone" placeholder="Ваш телефон"  required="">
                                 <button class="btn" type="submit"><span>Заказать со скидкой</span></button>
<!-- itg-form-code -->
<!-- itg-form-code -->

                                  </form>
                            <div class="timer">
                                <p class="timer-text">До конца акции осталось:</p>
                                <div class="countbox" id="timer">
            <div class="countbox-num">
                <div class="countbox-case hours">00</div> 
                <div class="countbox-text">Часов</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case minutes">00</div>
                <div class="countbox-text">Минут</div>
            </div>
            <div class="countbox-num">
                <div class="countbox-case seconds">00</div>
                <div class="countbox-text">Секунд</div>
            </div>
        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="footer_section"> 
                <center>
                    <img src="../need_files/corp_img/1_black.png">
<p style="text-align: center"><a href="../politics/politic.html" target="_blank">Политика конфиденциальности</a></p>
                </center>
            </footer>
        </div>
    </div>
    <script src="script/main.js"></script>
    <script type="text/javascript">
        function update() {
        var Now = new Date(), Finish = new Date();
        Finish.setHours( 23);
        Finish.setMinutes( 59);
        Finish.setSeconds( 59);
        if( Now.getHours() === 23  &&  Now.getMinutes() === 59  &&  Now.getSeconds === 59) {
            Finish.setDate( Finish.getDate() + 1);
        }
        var sec = Math.floor( ( Finish.getTime() - Now.getTime()) / 1000);
        var hrs = Math.floor( sec / 3600);
        sec -= hrs * 3600;
        var min = Math.floor( sec / 60);
        sec -= min * 60;
        $(".countbox .hours").text( pad(hrs));
        $(".countbox .minutes").text( pad(min));
        $(".countbox .seconds").text( pad(sec));
        setTimeout( update, 200);
    }
    function pad(s) { return ('00'+s).substr(-2) }
    update();

    $('.menu-btn').on('click', function() {
    	$('.header .nav').slideToggle();
    });
    </script>

<!-- itg-consult-body -->
	<!-- itg-consult-head -->
    <link href="../css/custom-styless.min.css" type="text/css" rel="stylesheet">
    <script src="../js/custom-functionss.min.js" type="text/javascript"></script>
<!-- itg-consult-head -->
<div id="kmacb" class="kmacb__manager kmacb__manager-man3" style="display: block;">
    <a href="index.php#" modal="kmacb-form">
        <div class="kmacb__manager-circle"></div>
        <div class="kmacb__manager-fill"></div>
        <div class="kmacb__manager-border"></div>
        <div class="kmacb__manager-img"></div>
    </a>
</div>
<div id="kmacb-form" class="modal kmacb-form kmacb-form2" style="display: none;">
    <div class="modal-block margin-t-b modal-left" style="margin-left: -230px;">
        <div class="title">Понравилось это предложение?<div class="kmacb-form-rectangle"></div></div>
        <div class="content">
            <div class="padding">
                <p>Мы расскажем Вам все об этом товаре, предложим наилучшие условия и ознакомим с подходящими акционными предложениями!</p>
                <form method="post" action="./_success_/">
                <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
                                                                                                                                                    <input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
                                                                                                                                                    <input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
                                                                                                                                                    <input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" /> 
                    <input type="text" name="name" value="" placeholder="Ваше имя" oldvalue="" required>
                    <input type="text" name="phone" value="" placeholder="Ваш номер телефона" oldvalue="" required>
					<p class="kmacb-form-text"></p>
                    <input type="submit" value="ПЕРЕЗВОНИТЬ МНЕ">
                                                                                                                    </form>
                <p class="kmacb-form-clock">Оператор перезвонит Вам через 15-30 минут</p>
            </div>
        </div>
    </div>
</div> 
<!-- itg-consult-body -->

<!-- itg-validation_and_bmetrika -->
	<script type="text/javascript">
  var phone_masks = JSON.parse('{"RU":"+7(xxx)xxx-xx-xx","BY":"(+375 xx)xxx-xx-xx","KZ":"+7(xxx)xxx-xx-xx","UA":"(+380 xx) xxx-xx-xx","KG":"+996(xxx) xx-xx-xx","AZ":"+994(xx) xxx-xx-xx","AM":"(+374 xx) xxx-xxx","UZ":"(+998 xx) xxx-xx-xx","RO":"+40(xx)xxx-xx-xx","IT":"+39(xxx)xxx-xx-xx"}');    
  var phone_numbers = JSON.parse('{"RU":"7","BY":"375","KZ":"7","UA":"380","KG":"996","AZ":"994","AM":"374","UZ":"998","RO":"40","IT":"39"}');        
  var country_code_server = '';               

  $(document).ready(function () {        
    $( 'form' ).prepend( '<input type="hidden" value="1784" name="product_id">' );

    $("input[name='Order[phone]']").val( phone_numbers[country_code_server] );
  });
</script>
  
  <link rel="stylesheet" href="../js/vendors/intlTelInput/css/intlTelInput.css">
  <link rel="stylesheet" href="input_style.css">
    <script type="text/javascript" src="../js/vendors/inputmask/jquery.mask.js"></script>
    <script type="text/javascript" src="../js/vendors/intlTelInput/js/intlTelInput.js"></script>
    <script type="text/javascript" src="../js/vendors/validinputs.js%3Fversion=28"></script>

    
<!-- itg-bottom_metrika -->
  <!-- itg-bottom_metrika --> 
<!-- itg-validation_and_bmetrika -->

</body>

</html>