<?php 
   $offer = 1;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
   $name = "name";
?> 

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Содержимое HEAD индексного файла -->
 <meta charset="utf-8"><link rel="shortcut icon" href="files/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width">
	<title>Медиаплеер Apple TV 4K</title>
	<meta name="description" content="">
 
  <link rel="stylesheet" href="files/css/reset.css">
  <link rel="stylesheet" href="files/css/settings.css">
  <link rel="stylesheet" href="files/css/slick.css">
  <link rel="stylesheet" href="files/css/style.css">
  <link rel="stylesheet" href="files/css/timer.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- Содержимое, помещаемое в HEAD -->


<!-- /Yandex.Metrika counter -->
  
</head>
<body> 
<!-- Контент индексного файла -->
<section class="block1">
    <div class="wrap">
        <div><h1 class="i">Медиаплеер  <span style="font-weight: 700; color: #fc4944">Apple TV 4K</span></h1>
        <ul class="topul">
            <li>Поддержка 4К с HDR</li>
            <li>Большой магазин приложений</li>
            <li>Простота эксплуатации</li>
            <li>Убедительное распознавание речи</li>
        </ul></div>
        <div class="formbox shadow"> 
                <div class="price clearfix">
                    <div class="cost_sale">
                        <div class="sale">-75%</div>
                        <div class="old-cost"><span>13990</span><small>р</small></div>
                    </div>
                    <div class="new-cost">
                        <span>Цена сегодня:</span>
                        <p><?php echo $price['real_price']; ?></p>
                    </div>
                </div> 
          	<form action="./_success_/" method="post" alias="apple_tv, Dostavka_500_" class="m1-form form clearfix" validationByAlert="1">
              <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

                   
					<input name="<?php echo $name; ?>" class="field input form-control form_field_text_input form-input txt-m" type="text" required placeholder="Введите Ваше имя">
                
					<input name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" type="mask" required=" " required validator="+7(999)999-99-99" placeholder="Введите Ваш телефон" >
                    <button class="button-m" style="color: #fff">Оформить заказ</button>
                </form>
            </div>
    </div> 
</section>  
<section class="block2">
    <div class="wrap">
        <h2 class="title" style="font-size: 1.85rem;">ИСПОЛЬЗУЙТЕ   <span>APPLE TV 4K </span>С ФИРМЕННЫМ ПУЛЬТОМ ДУ</h2>
        <p class="text-center mb-3" style="font-size: 1.3rem">Это пятое поколение Apple TV с поддержкой воспроизведения 4K-видео, объемным звуком, огромным каталогом фильмов, сериалов, музыки и игр, а пульт Apple TV Remote с технологией Bluetooth позволяет быстро найти именно то, что вам нужно из любого места в доме, достаточно провести по поверхности Touch.</p>
        <div class="container clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <img src="files/img/photo-2.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <p class="subt">Самое удобное удаленное управление</p>
                                <p style="font-size: 1.1rem">Вы можете производить управление через входящий в комплект поставки фирменный пульт ДУ с помощью чувствительного сенсора или голосовых команд, чтобы запустить необходимую программу или найти информацию. Теперь управлять устройством стало в разы проще!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <img src="files/img/photo-3.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section> 

<section class="block3">
        <div class="wrapper" style="max-width: 97%; margin: 0 auto">
          <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <img src="files/img/photo-4.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
          </div>
        </div>
</section> 

<section class="">
    <div class="wrap">
        <h2 class="title">НАСТОЯЩИЙ <span>КИНОТЕАТР В ВАШЕМ ДОМЕ</span> С МЕДИАПЛЕЕРОМ ОТ APPLE</h2>
        <p class="text-center mb-2" style="font-size: 1.15rem">Apple TV 4K – это настоящий маленький ПК с мощным процессором A10X Fusion и 32 Гб встроенной памяти, который изменит ваше представление о возможностях современного телевидения.</p>
        <p class="text-center mb-4" style="font-size: 1.15rem">Вас ждет потрясающее качество 4K HDR, а также объемный звук Dolby Atmos – почувствуйте себя в настоящем кинотеатре! От горячих премьер до любимых телешоу – теперь изображение будет выглядеть еще более естественно, сочно и эффектно.</p>
        <div class="row">
          <div class="col-md-4">
            <div class="row">
              <div class="col-12">
                <p class="subt">Максимальная детализация</p>
                <p style="font-size:1.2em">Не 4К единым примечательна приставка — ей также завезли поддержку стандартов HDR 10 и Dolby Vision. Картинка вместе со всем этим набором прогрессивных технологий будет блистать детализацией и богатством передачи цветов в светлых и темных участках изображения. </p>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-12">
                <img src="files/img/photo-5.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
    </div>
</section>

<section class="block4">
    <div class="wrap nopad">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <p class="subt">Максимальное удобство </p>
                        <p style="font-size:1.2em">У вас есть возможность «подружить» приставку с различными устройствами под iOS, например, превратить ваш iPhone в пульт ДУ. Соединение происходит быстро и не требует лишних усилий: просто поднесите к Apple TV смартфон или планшет и введите код.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <img src="files/img/photo-6.png" alt="">
                    </div>
                </div>
            </div>
        </div>            
    </div>
</section>    
    
<section class="block5">
    <div class="wrap nopad">
       <div class="row">
           <div class="col-md-4">
               <div class="row">
                   <div class="col-12 text-center">
                    <img src="files/img/photo-7.png" alt="" class="img-fluid">
                    <p class="subt mt-3">Прирост производительности</p>
                    <p>Для отображения картинки в высоком разрешении требуется больше производительности. Ее прирост призван обеспечить чип Apple A10X, наряду с 3 ГБ оперативной памяти, чип также обеспечивает бесперебойную трансляцию 4К-контента с частотой 60 к/с.</p>
                </div>
               </div>
           </div>
           <div class="col-md-4">
               <div class="row">
                   <div class="col-12 text-center">
                    <img src="files/img/photo-8.png" alt="" class="img-fluid">
                    <p class="subt mt-3">Набор интерфейсов</p>
                    <p>В арсенале модели имеется набор интерфейсов для подключения внешних устройств HDMI и Ethernet, а транслировать звук вы сможете беспроводным способом, например, на колонку Apple HomePod. </p>
                </div>
               </div>
           </div>
           <div class="col-md-4">
               <div class="row">
                   <div class="col-12 text-center">
                    <img src="files/img/photo-9.png" alt="" class="img-fluid">
                    <p class="subt mt-3">Dolby Atmos</p>
                    <p>Эта функция позволяет получить потрясающе реалистичную звуковую картину. Она окружит вас со всех сторон, и каждый звук будет слышен именно так, как задумано в фильме, и вы невольно почувствуете себя в центре событий. </p>
                </div>
               </div>
           </div>
       </div>
        <h2 class="title mt-4" style="font-size: 1.85rem;"><span>APPLE TV </span> И <span>  APP STORE</span> –  ГЛАВНАЯ НАЧИНКА НОВОЙ ВЕРСИИ</h2>
        <p class="text-center mb-5" style="font-size: 1.3rem">Другими словами, эти сервисы — это все, что нужно для отличного досуга.</p>
       <div class="row mb-4">
           <div class="col-md-6">
               <div class="row">
                   <div class="col-12 text-center">
                    <img src="files/img/photo-10.png" alt="" class="img-fluid">
                    <p class="mt-2"><b>Apple TV</b>предложит вам тысячи фильмов, которые можно купить или взять напрокат, а также эксклюзивные фильмы и сериалы из сервиса Apple TV+. Все в одной видеотеке, на всех ваших устройствах. </p>
                </div>
               </div>
           </div>
           <div class="col-md-6">
               <div class="row">
                   <div class="col-12 text-center">
                    <img src="files/img/photo-11.png" alt="" class="img-fluid">
                    <p class="mt-2">В <b>App Store </b>найдется контент для каждого: развлекательные приложения, такие как Amediateka, ivi, Megogo и Netflix или тысячи приложений для спорта, фитнеса и повседневных дел, а также различные игры.</p>
                </div>
               </div>
           </div>
       </div>
       <div class="orderbox clearfix">
           <a href="#order_form" class="button-m" style="text-decoration: none; color: #fff;">Заказать сейчас</a>
    </div>
</section>                

<section class="block6">
    <div class="wrap">
        <h2 class="title">ВЗГЛЯНИТЕ НА <span>APPLE TV 4K</span> ПОДРОБНЕЕ</h2>
        <div class="video-container shadow">
        	<div class="youtube" id="orurPimKJII"></div>
        </div>
    </div>
</section> 

<section class="block7">
    <div class="wrap">
        <h3 class="title mt-4 mb-5" style="font-size: 1.85rem; text-align: center;">ХАРАКТЕРИСТИКИ И КОМПЛЕКТАЦИЯ</h3>
        <div class="row">
          <div class="col-md-4">
            <div class="row">
              <div class="col-12">
                <img src="files/img/photo-12.png" alt="">
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-12">
                <ul style="text-align: center">
                 <li><b>Основное</b></li>
                 <li><b>Форм-фактор:</b> компактный</li>
                 <li><b>Поддержка Ultra HD 4K:</b> да </li>
                 <li><b>Поддержка HDR:</b> да </li>
                 <li><b>Тип процессора:</b> A10X Fusion (64-bit)</li>
                 <li><b>Объем накопителя:</b> 32 ГБ</li>
                 <li><b>Объем оперативной памяти:</b> 3 ГБ</li>
                 <li><b>Функции</b></li>
                 <li><b>Функции и возможности:</b> Online ТВ, Online радио, видео-сервисы, фото-сервисы, социальные сети</li>
                 <li><b>Мультимедиа:</b> Bluetooth (версия 5.0), Wi-Fi (с технологией MIMO) AirPlay</li>
                 <li><b>Разъемы</b></li>
                 <li><b>HDMI:</b> 1 шт (версия 2.0)</li>
                 <li><b>Входы:</b> LAN</li>
                 <li><b>Поддержка стандартов</b></li>
                 <li><b>Форматы видео файлов:</b> M4V, MP4, MOV</li>
                 <li><b>Форматы аудио файлов:</b> HE-AAC, AAC, MP3, FLAC, AIFF, WAV, AC-3</li>
                 <li><b>Форматы графических файлов:</b> HEIF, JPEG, GIF, TIFF</li>
                 <li><b>Общее</b></li>
                 <li><b>Пульт ДУ:</b> сенсорный</li>
                 <li><b>Система охлаждения:</b> с вентилятором</li>
                 <li><b>Габариты:</b> 98x35x98 мм</li>
                 <li><b>Вес:</b> 0.43 кг</li>
                 <li><b>Комплектация</b></li>
                 <li>Приставка Apple TV 4K, сетевой кабель, руководства пользователя, фирменный пульт ДУ, кабель Lightning</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>

<section class="block8">
    <div class="wrap nopad">
        <h2 class="title"><span>Отзывы</span> покупателей</h2>
        <div class="reviews">
            <div>
                <div class="rev">
                    <div>
                        <img src="files/img/photo-13.png" alt="">
                        <span>Алена Кипелова, 29 лет</span>
                    </div>
                    <p>Жалею, что долго раздумывал о покупке! В итоге была приятно удивлена картинкой и отзывчивым и красивым интерфейсом, новая приставка 4K порадовала меня разнообразием приложений. iTunes - пока единственный в России онлайн кинотеатр с блюрей дублированными фильмами, поэтому пользуюсь им. Спасибо за быструю доставку!</p>
                </div>
            </div>
            
            <div>
                <div class="rev">
                    <div>
                        <img src="files/img/photo-14.png" alt="">
                        <span>Андрей Белгородов, 36 лет</span>
                    </div>
                    <p>Качественная вещь, картинка отличная, возможность установить приложения от провайдеров телевидения и смотреть обычный телевизор) Управление происходит через Bluetooth и прямая видимость на устройство не нужна, можно спрятать за ТВ. Отдельное спасибо за пульт! Чуть не прослезился от счастья, что он умеет управлять громкостью усилителя и можно обходиться без десятка пультов.</p>
                </div>
            </div>
            
            <div>
                <div class="rev">
                    <div>
                        <img src="files/img/photo-15.png" alt="">
                        <span>Виктор Тихонов, 41 год</span>
                    </div>
                    <p>На этом сайте заказывал себе приставку Apple TV 4K, пришла целая, работает замечательно. Отдельно купил провод HDMI и проблем с подключением и показом не было. Включил, скачал пару приложений и смотрим абсолютно что угодно. Приставка у нас заменила телевизор, это средство доставки новых сериалов, прослушивания музыки, также смотрим фотографии, иногда даже играем. Рекомендую всем!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="block9 text-center">
        <div class="wrapper" style="max-width: 97%; margin: 0 auto">
          <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <img src="files/img/photo-16.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
          </div>
</section>

<section class="block10">
    <div class="wrap nopad">
        <h2 class="title"><span>Как заказать</span> МЕДИАПЛЕЕР?</h2>
        <ul class="ship">
            <li>
                <div><img src="files/img/photo-17.png" alt=""></div>
                <p>Оформляете заказ на&nbsp;нашем&nbsp;сайте</p>
            </li>
            <li>
                <div><img src="files/img/photo-18.png" alt=""></div>
                <p>Менеджер перезванивает для оформления заказа</p>
            </li>
            <li>
                <div><img src="files/img/photo-19.png" alt=""></div>
                <p>Мы отправляем Ваш заказ почтой в любой регион</p>
            </li>
            <li>
                <div><img src="files/img/photo-20.png" alt=""></div>
                <p>Вы оплачиваете заказ при&nbsp;получении</p>
            </li>
        </ul>
    </div>
</section>

<section class="block11">
    <div class="wrap"><h3>ЗАКАЖИТЕ СЕЙЧАС APPLE TV 4K <span>со скидкой 75%</span></h3></div>
</section>

<section class="block1 end block-2">
    <div class="wrap">
        <h1 class="i">Медиаплеер <span style="font-weight: 700; color: #fc4944">Apple TV 4K</span></h1>
        
        <div class="formbox shadow"> 
                <div class="price clearfix">
                    <div class="cost_sale">
                        <div class="sale">-75%</div>
                        <div class="old-cost"><span>13990</span><small>р</small></div>
                    </div>
                    <div class="new-cost" id="order_form">
                        <span>Цена сегодня:</span>
                        <p><?php echo $price['real_price']; ?></p>
                    </div>
                </div> 
           
				<form action="./_success_/" method="post" alias="apple_tv, Dostavka_500_" class="m1-form form clearfix" validationByAlert="1">
                	<div class="countbox" style="margin-bottom: 20px; font-weight: 700; transform: translateX(-2%);"></div>
                <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />   
					<input name="<?php echo $name; ?>" class="field input form-control form_field_text_input form-input txt-m" type="text" required placeholder="Введите Ваше имя">
                
					<input name="phone"  class="field form-control input textField form_field_text_input form_phone form-input txt-m" type="mask" required=" " required validator="+7(999)999-99-99" placeholder="Введите Ваш телефон" >
                    <button class="button-m" style="color: #fff">Оформить заказ</button>
             </form>
            </div>
            </div>
</section> 


<footer class="footer">
    <div class="wrap">  
        <p style="text-align: center">Громов Роман Максимович ИНН: 760413155109<br> 
            <a href="polit.html" style="text-decoration: none; font-size: 1rem">Политика&nbsp;конфиденциальности</a> 
        </p>
    </div>
</footer>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    <script >var i, c, y, v, s, n;
v = document.getElementsByClassName("youtube");
if (v.length > 0) {
    s = document.createElement("style");
    s.type = "text/css";
    s.innerHTML = '.youtube{background-color:#000;max-width:100%;height:inherit;overflow:hidden;position:relative;cursor:hand;cursor:pointer}.youtube .thumb{bottom:0;display:block;left:0;margin:auto;max-width:100%;position:absolute;right:0;top:0;width:100%;height:auto}.youtube .play{filter:alpha(opacity=80);opacity:.8;height:77px;left:50%;margin-left:-38px;margin-top:-38px;position:absolute;top:50%;width:77px;background:url("files/img/youtube-play-icon.png?ver=123") no-repeat}';
    document.body.appendChild(s)
}
for (n = 0; n < v.length; n++) {
    y = v[n];
    i = document.createElement("img");
    i.setAttribute("src", "https://i.ytimg.com/vi/" + y.id + "/hqdefault.jpg");
    i.setAttribute("class", "thumb");
    c = document.createElement("div");
    c.setAttribute("class", "play");
    y.appendChild(i);
    y.appendChild(c);
    y.onclick = function() {
        var a = document.createElement("iframe");
        a.setAttribute("src", "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1&border=0&wmode=opaque&enablejsapi=1&rel=0&showinfo=0");
        a.setAttribute("allowfullscreen","");
        a.style.width = this.style.width;
        a.style.height = this.style.height;
        this.parentNode.replaceChild(a, this)
    }
};</script>
    <script src="files/js/slick.min.js"></script>
    <script src="files/js/main.js"></script>
    <script src="files/js/count.js"></script>

<link rel="stylesheet" href="files/yved/style.css" type="text/css" /> 
  <script>
    function randomInteger(min, max) {
      var rand = min + Math.random() * (max + 1 - min);
      rand = Math.floor(rand);
      return rand;
    }
  </script>
  <script src="files/yved/script.js"></script>
  <div class="yvedw">
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Герман Вешеньков, г.Красноярск, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_1"><script type="text/javascript">$(document).ready(function () {$('.online_1').text(randomInteger(5, 8));});</script></span> человек</div>
    </div>
    <div class="yved yvedf2">
      <div class="yvedvt">
        <div class="yvedt">Карина Романченко, г.Москва, сделала заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_2"><script type="text/javascript">$(document).ready(function () {$('.online_2').text(randomInteger(7, 14));});</script></span> человек</div>
    </div>
    <div class="yved yvedf1 ">
      <div class="yvedvt">
        <div class="yvedt">Дмитрий Матвеев, г.Воронеж, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_3"><script type="text/javascript">$(document).ready(function () {$('.online_3').text(randomInteger(2, 6));});</script>></script></span> человек</div>
    </div>
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Вениамин Курапатов, г.Екатеринбург, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_4"><script type="text/javascript">$(document).ready(function () {$('.online_4').text(randomInteger(13, 18));});</script>></span> человек</div>
    </div>
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Вадим Изанковский, г.Москва, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_5"><script type="text/javascript">$(document).ready(function () {$('.online_5').text(randomInteger(5, 9));});</script></span> человек</div>
    </div>
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Марат Беляков, г.Ярославль, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_6"><script type="text/javascript">$(document).ready(function () {$('.online_6').text(randomInteger(9, 13));});</script>></span> человек</div>
    </div>
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Герман Вешеньков, г.Красноярск, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_1"><script type="text/javascript">$(document).ready(function () {$('.online_1').text(randomInteger(5, 8));});</script></span> человек</div>
    </div>
    <div class="yved yvedf2">
      <div class="yvedvt">
        <div class="yvedt">Карина Романченко, г.Москва, сделала заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_2"><script type="text/javascript">$(document).ready(function () {$('.online_2').text(randomInteger(7, 14));});</script></span> человек</div>
    </div>
    <div class="yved yvedf1 ">
      <div class="yvedvt">
        <div class="yvedt">Дмитрий Матвеев, г.Воронеж, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_3"><script type="text/javascript">$(document).ready(function () {$('.online_3').text(randomInteger(2, 6));});</script>></script></span> человек</div>
    </div>
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Вениамин Курапатов, г.Екатеринбург, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_4"><script type="text/javascript">$(document).ready(function () {$('.online_4').text(randomInteger(13, 18));});</script>></span> человек</div>
    </div>
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Вадим Изанковский, г.Москва, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_5"><script type="text/javascript">$(document).ready(function () {$('.online_5').text(randomInteger(5, 9));});</script></span> человек</div>
    </div>
    <div class="yved yvedf1">
      <div class="yvedvt">
        <div class="yvedt">Марат Беляков, г.Ярославль, сделал заказ на сумму <?php echo $price['real_price']; ?>, число 1 шт</div>
      </div>
      <div class="online">Сейчас на сайте: <span class="online_6"><script type="text/javascript">$(document).ready(function () {$('.online_6').text(randomInteger(9, 13));});</script>></span> человек</div>
    </div>
  </div>
 </body>
</html>
