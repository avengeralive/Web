<?php 
   $offer = 105;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Капли для иммунитета «Immunity»</title>
<!-- Favicon -->
<link rel="icon" href="img/719.png" type="image/png">
<link rel="shortcut icon" href="img/719.png" type="image/png">

<!-- OG -->
<meta property="og:url" content="." />
<meta property="og:type" content="website" />
<meta property="og:title" content="Капли для иммунитета «Immunity»" />
<meta property="og:image" content="img/719.png" />
<meta property="og:image:width" content="150" />
<meta property="og:image:height" content="150" />
<meta property="og:site_name" content="Капли для иммунитета «Immunity»" />
<meta property="og:description" content="С «Immunity» Вам не нужны капли для носа, таблетки и микстуры, потому что он убивает вирусы и устраняет вторичные признаки гриппа и ОРВИ за 2 дня.
За 5 дней выводит все токсины из организма, сокращая период реабилитации после болезни
благодаря высокой концентрации кордицепса и мускуса бобра. А также 24 часа защиты иммунитета в инфекционный период и при эпидемиях" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript" src="https://promo2020.ru/static/js/lt_landing_valid_form.js"></script>
<script type="text/javascript" src="https://promo2020.ru/static/js/lt_landing_script.js"></script>

<!-- LT code insertion -->
<!-- /LT code insertion -->
</head>
<body>
<script type="text/javascript">
    var landing_notifiers = new Object(),
            price, currency, delivery_price;
</script> 
<script type="text/javascript" src="js/func.js?11"></script> 
<script>
	var formIsSubmitted = false;
</script> 
<script type="text/javascript" src="js/unload_submit.js?7"></script>
<div class="section1">
  <div class="body-center">
    <header>
      <div class="logo"><img src="img/logo.png" alt=""></div>
      <div class="call"><a href="index.html#" class="header__button">Закажите обратный звонок</a></div>
      <div class="header__block header__block--first">100%<br>
        натуральный<br>
        продукт</div>
      <div class="header__block header__block--second">Более 3500<br>
        отзывов</div>
    </header>
    <h2 class="content1__title">Запаситесь супер иммунитетом на весь год!</h2>
    <p class="content1__small-title"> 25  целебных трав и 6 витаминов  обеспечат защиту от вирусов</p>
    <div class="content1"> 
      <!--content1__left-->
      <div class="content1__left">
        <div class="akcia-wrap akcia-wrap--top">
          <p class="akcia-wrap__title">Акция!</p>
          <p class="akcia-wrap__sale">Скидка<br>
            <span class="akcia-wrap__procent">-50<span>%</span></span></p>
        </div>
        <div class="about-product">
          <p class="about-product__text about-product__text--1"> За 2 дня убивает вирусы и устраняет вторичные признаки гриппа и ОРВИ <span>С Immunity Вам не нужны капли для носа, таблетки и микстуры</span> </p>
          <p class="about-product__text about-product__text--2"> 24 часа защиты иммунитета в инфекционный период и при эпидемиях <span>за счет Galleria melonella, прополиса и пчелиной перги</span> </p>
          <p class="about-product__text about-product__text--3"> За 5 дней выводит токсины из организма, сокращая период реабилитации после болезни <span>благодаря высокой концентрации кордицепса и мускуса бобра</span> </p>
        </div>
      </div>
      <!--form-wrapper-->
      <div class="form-wrapper form-wrapper__content1">
        <p class="form-wrapper__title">Количество акционных товаров ограничено: <br>
          <span>18 <span>шт.</span></span></p>
        <div class="form-wrapper__br">
          <div class="price-wrap">
            <div class="akcia-wrap akcia-wrap--700">
              <p class="akcia-wrap__title">Акция!</p>
              <p class="akcia-wrap__sale">Скидка<br>
                <span class="akcia-wrap__procent">-50<span>%</span></span></p>
            </div>
            <div class="old-price"> Полная цена
              <p><span class="x_price_previous"><span class="price_land_s4 oldproductsum">798</span></span> <span class="old-price__curent x_currency"></span></p>
            </div>
            <div class="new-price"> Цена со скидкой
              <p><span class="x_price_current"><span class="price_land_s1 productsum"><?php echo $price['real_price']; ?></span></span> <span class="new-price__curent x_currency"></span></p>
            </div>
          </div>
          <p class="form-wrapper__text">Введите <span class="not-480-form">Ваши </span>данные в форму ниже:</p>
          <form method="POST" class="forma x_order_form orderformcdn" action="./_success_/">
            <select name="country" class="countryselect forma__input"><option selected value='RU'>Россия</option></select>
            <input type="text" name="name" value="" class="forma__input forma--name" placeholder="Введите Имя" required>
            <input type="text" name="phone" value="" class="forma__input forma--phone" placeholder="Введите номер телефона" required>
            <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
			<div class="reolader">
				<button type="submit" class="mm_button forma__submit" onclick="checkFields(event, this);"> Заказать IMMUNITY для иммунитета</button>
				<div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
			</div>
          </form>
        </div>
      </div>
    </div>
    <!--content2-->
    <div class="problem">
      <p class="title">Immunity эффективно решает 5 главных проблем:</p>
      <div class="problem__block problem__block--1"><span>Скорая помощь</span> При попадании в организм вирусов гриппа и других инфекций позволяет в течение 2 дней устранить инфекционный процесс и предупредить осложнения.</div>
      <div class="problem__block problem__block--2"><span>Действие на очаг воспаления</span> Убивает гнилостные бактерии в ЖКТ. Нормализует состав микрофлоры кишечника, которая является первым защитным барьером организма при попадании инфекции. </div>
      <div class="problem__block problem__block--3"><span>Защита для всей семьи</span> Не вызывают аллергических реакций и привыкания. Можно применять в любом возрасте. Рекомендован людям с хроническими заболеваниями для укрепления иммунитета в периоды обострения.</div>
      <div class="problem__block problem__block--4"><span>Предотвращение осложнений</span> Повышает подвижность лейкоцитов, которые при попадании инфекции способны быстро ликвидировать вирус и предотвратить его активизацию в организме. Уже через 5 дней Вы здоровы и не подвержены угрозе осложнений.</div>
      <div class="problem__block problem__block--5"><span>Бережная защита</span> Immunity не стимулирует иммунитет (стимуляция иммунных клеток – нарушает все биохимические реакции в организме, снижая иммунитет). Мягко способствует повышению активности иммунных клеток, не нарушая иммунные реакции.</div>
    </div>
  </div>
</div>
<div class="section2">
  <div class="body-center"> 
    <!--expert-->
    <div class="expert ">
      <p class="title">Мнение эксперта о Immunity:</p>
      <p class="expert__text expert__text--480">Каждый год заболеванию гриппом, ОРВИ и другими опасными вирусами подвергается огромное количество людей в нашей стране, и этому свидетельствуют частые всплески эпидемии. Причём это случается даже не один раз за осенне-зимний период. Особенно опасно начало осени и конец зимы. </p>
      <p class="expert__text">Зачастую болезнь затягивается, появляются осложнения из-за неправильного лечения.</p>
      <p class="expert__text">Immunity многократно проверенное средство для профилактики и лечения вирусных заболеваний. Я рекомендую Immunity всем своим пациентам и лично Вам.</p>
      <p class="expert__name">Анатолий Марков</p>
      <p class="expert__prof">Врач иммунолог, к.м.н. Стаж 13 года</p>
    </div>
    <!--form-big-->
    <div class="form-big"> 
      <!--form-big__left-->
      <div class="form-big__left">
        <div class="akcia-wrap">
          <p class="akcia-wrap__title">Акция!</p>
          <p class="akcia-wrap__sale">Скидка<br>
            <span class="akcia-wrap__procent">-50<span>%</span></span></p>
        </div>
        <div class="price-wrap">
          <div class="old-price"> Полная цена
            <p><span class="x_price_previous"><span class="price_land_s4 oldproductsum">798</span></span> <span class="old-price__curent x_currency"></span></p>
          </div>
          <div class="new-price"> Цена со скидкой
            <p><span class="x_price_current"><span class="price_land_s1 productsum"><?php echo $price['real_price']; ?></span></span> <span class="new-price__curent x_currency"></span></p>
          </div>
        </div>
        <div class="form-big__text">
          <p class="form-big__text1">Количество акционных товаров ограничено:</p>
          <p class="form-big__text2">18 шт.</p>
        </div>
      </div>
      <!--form-big__center-->
      <div class="form-big__center"><img src="img/product-img-form.png"></div>
      <!--form-big__right-->
      <div class="form-big__right">
        <p class="form-wrapper__text">Введите <span class="not-480-form">Ваши </span>данные в форму ниже:</p>
        <form method="POST" class="forma x_order_form orderformcdn" action="./_success_/">
          <select name="country" class="countryselect forma__input"><option selected value='RU'>Россия</option></select>
          <input type="text" name="name" value="" class="forma__input forma--name" placeholder="Введите Имя" required>
          <input type="text" name="phone" value="" class="forma__input forma--phone" placeholder="Введите номер телефона" required>
          <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
			<div class="reolader">
				<button type="submit" class="mm_button forma__submit" onclick="checkFields(event, this);"> Заказать IMMUNITY для иммунитета</button>
				<div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
			</div>
        </form>
      </div>
    </div>
    <!--effect-->
    <div class="effect">
      <p class="title">Клинически доказанная эффективность!</p>
      <img class="effect__wiki" src="img/wiki.png" alt="">
      <p class="effect__text effect__text--not480">Иммунитет (лат. immunitas — освобождение, избавление от чего-либо) — нечувствительность, сопротивляемость организма к инфекциям.</p>
      <p class="effect__text">Эффективность синтеза 25 целебных трав и витаминов в составе подтверждается результатами лабораторных исследований Сибирского федерального университета, Российского НИИ лекарственных растений РАМН и ряда клинических центров.</p>
      <div class="effect__table"> <img class="effect__img" src="img/effect-img.png" alt=""> <img class="effect__img--480" src="img/effect-img-480.png" alt="">
        <p class="effect__table-text">Освободитесь от болезней за 5 дней<br>
          с помощью Immunity</p>
        <p class="effect__text-procent">Защита организма от вирусов (%)</p>
        <p class="effect__when"> <span>До применения</span> <span>Через 6 часов</span> <span>Через 2 дня</span> <span>Через 5 дней</span> <span class="effect__when--480">Время</span> </p>
      </div>
    </div>
  </div>
</div>
<div class="section3">
  <div class="body-center"> 
    <!--action-->
    <div class="action">
      <p class="title">Как действует Immunity?</p>
      <p class="action__small-title">Уникальный синтез из густых, жидких субстанций и лечебных трав мягко способствует повышению активности иммунных клеток, не нарушая биохимические реакции организма.</p>
      <div class="action__block-wrap">
        <p class="action__block action__block--1">Барсучий жир<br>
          <span>очищает лимфу, которая связана с нормальными иммунными реакциями.</span></p>
        <p class="action__block action__block--2">Кардицепс<br>
          <span>уникальный гриб, используемый в китайской традиционной медицине обладает лечебными свойствами, убивает гнилостные бактерии в ЖКТ, которые являются вирусными носителями.</span></p>
        <p class="action__block action__block--3">Шиповник, корень одуванчика, имбирь, бадан и  бузина<br>
          <span>предупреждают осложнения при инфекции.</span></p>
        <p class="action__block action__block--4">Каррагана гривастая<br>
          <span>особенно полезна женщинам, предупреждает недуги интимного характера и нарушение гормонального фона при инфекции.</span></p>
        <p class="action__block action__block--5">Мускус бобра, каменное масло и черный тмин<br>
          <span>в комплексе повышают подвижность лейкоцитов, которые при попадании инфекции способны быстро ликвидировать вирус и предотвратить его активизацию в организме.</span></p>
        <p class="action__block action__block--6">Galleria melonella (огнёвка пчелиная), прополис, пчелиная перга<br>
          <span>нормализуют иммунитет при хронических процессах и нарушении работы эндокринной системы, обменных реакций.</span></p>
        <p class="action__block action__block--7">Чабрец, девясил и альгинат бурых водорослей<br>
          <span>предупреждает вирус герпеса и способствует быстрому устранению герпетических высыпаний</span></p>
        <p class="action__block action__block--8">Анис, чага, клевер, облепиха, амарант, лофант анисовый, листья дикой земляники<br>
          <span>очищают кровь, повышают защитные функции организма, кожи и слизистых.</span></p>
        <p class="action__block action__block--9">Живица кедровая<br>
          <span><span class="text-not-980">очищенная смола, разведенная в кедровом масле, является эффективным природным антиоксидантом, </span>снижает синдром хронической усталости, повышает умственную и физическую работоспособность.</span></p>
      </div>
    </div>
  </div>
</div>
<div class="section4">
  <div class="body-center"> 
    <!--comments-->
    <div class="comments">
      <p class="title">Отзывы людей, оценивших эффект на себе:</p>
      <div class="slider">
        <ul class="bxslider">
          <li class="slide"> <img class="slide__img" src="img/slider-img-1.png">
            <p class="slide__text"> Мой сын с прошлой зимы как пошел в ГКП непрерывно болел.....и зимой..и весной и даже летом.......я устала((((((((((((((. Начали пить Immunity с той весны (2 недели попили, потом вообще не болели полгода!!! Сейчас снова начинается сезон болезней. В обязательном порядке пьем всей семьей! Ходим в сад уже 3,5 недели - все замечательно! Тьфу -тьфу! <span class="slide__name">Полина Самойлова</span> </p>
          </li>
          <li class="slide"> <img class="slide__img" src="img/slider-img-2.png">
            <p class="slide__text"> Дружу с Immunity с 2012-го года. Т.е. в этом году у нас с ним 3-летие со дня знакомства. Думаю, этот стаж о чем-то говорит. Порекомендовал мне его врач-пульмонолог, когда я загремела в больницу со вторым воспалением легких. С тех пор, начиная с середины сентября и до апреля-мая я пью его. Летом делаю перерывчик. За три года даже гриппом не болела! <span class="slide__name">Ольга Петроева</span> </p>
          </li>
          <li class="slide"> <img class="slide__img" src="img/slider-img-3.png">
            <p class="slide__text"> Старость не радость, говорят. Я не согласен. Мне 53. Бодрый благодаря любимой внучке и Иммьюнити, конечно. Без него осенью и зимой все хронические болячки обострялись. Сейчас наоборот, как будто ничем не болею! Благодарен. <span class="slide__name">Иван Говорухин</span> </p>
          </li>
          <li class="slide"> <img class="slide__img" src="img/slider-img-4.png">
            <p class="slide__text"> Когда перестала болеть, была очень рада, а все коллеги по работе мне только завидовали. В итоге, получилось наоборот: каждый хоть раз на больничный уходил, а я нет! Получила повышение  и прибавку к зарплате благодаря крепкому иммунитету. Теперь у нас все Immunity пьют. Даже сильно сопливые, с кашлем и хрипами встают на ноги за 5 дней! <span class="slide__name">Бероева Екатерина</span> </p>
          </li>
        </ul>
      </div>
    </div>
    <!--form-big-->
    <div class="form-big"> 
      <!--form-big__left-->
      <div class="form-big__left">
        <div class="akcia-wrap">
          <p class="akcia-wrap__title">Акция!</p>
          <p class="akcia-wrap__sale">Скидка<br>
            <span class="akcia-wrap__procent">-50<span>%</span></span></p>
        </div>
        <div class="price-wrap">
          <div class="old-price"> Полная цена
            <p><span class="x_price_previous"><span class="price_land_s4 oldproductsum">798</span></span> <span class="old-price__curent x_currency"></span></p>
          </div>
          <div class="new-price"> Цена со скидкой
            <p><span class="x_price_current"><span class="price_land_s1 productsum"><?php echo $price['real_price']; ?></span></span> <span class="new-price__curent x_currency"></span></p>
          </div>
        </div>
        <div class="form-big__text">
          <p class="form-big__text1">Количество акционных товаров ограничено:</p>
          <p class="form-big__text2">18 шт.</p>
        </div>
      </div>
      <!--form-big__center-->
      <div class="form-big__center"><img src="img/product-img-form.png"></div>
      <!--form-big__right-->
      <div class="form-big__right">
        <p class="form-wrapper__text">Введите <span class="not-480-form">Ваши </span>данные в форму ниже:</p>
        <form method="POST" class="forma x_order_form orderformcdn" action="./_success_/">
          <select name="country" class="countryselect forma__input"><option selected value='RU'>Россия</option></select>
          <input type="text" name="name" value="" class="forma__input forma--name" placeholder="Введите Имя" required>
          <input type="text" name="phone" value="" class="forma__input forma--phone" placeholder="Введите номер телефона" required>
          <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
			<div class="reolader">
				<button type="submit" class="mm_button forma__submit" onclick="checkFields(event, this);"> Заказать IMMUNITY для иммунитета</button>
				<div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
			</div>
        </form>
      </div>
    </div>
    <!--use-->
    <div class="use">
      <p class="title">Способ применения Immunity:</p>
      <div class="use__wrap">
        <div class="use__left">
          <p class="use__left-title">Для профилактики</p>
          <p class="use__left-text">2 раза в день</p>
          <p class="use__left-how use__left-how--2"><span>2</span> раза</p>
        </div>
        <div class="use__right">
          <div class="use__right-wrap">
            <p class="use__right-title">При инфицировании</p>
            <p class="use__right-text">4 раза в день<br>
              Курс - 5 дней</p>
            <p class="use__right-how use__right-how--2"><span>4</span> раза</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section5">
  <div class="body-center">
    <p class="title">Что Вы получите, сделав заказ у нас?</p>
    <!--you-get-->
    <div class="you-get">
      <p class="you-get__block you-get__block--1">Безупречный сервис<span>Подтверждение нашей компетенции - Более 3-х лет работы на рынке и более 3500 отзывов от наших клиентов</span></p>
      <p class="you-get__block you-get__block--2">Экономию времени<span>Вы можете сделать покупку в любое время суток и из любого места. Call-центр работает для Вас круглосуточно.</span></p>
      <p class="you-get__block you-get__block--3">Гарантию качества<span>Вся наша продукция сертифицирована и проходит строгую проверку, перед отправкой. Вы можете быть уверены на 100%, что товар, который Вы приобретаете у нас - не подделка.</span></p>
      <p class="you-get__block you-get__block--4">Моментальное оформление<span>Оставьте Ваш номер телефона в форме ниже. Оператор Call-центра свяжется с Вами в течение 3-ех минут.</span></p>
    </div>
    <p class="title not-240">Доставка по всей <span class="country_name">России</span> и СНГ!</p>
    <div class="map"><img id="map" src="img/map.png" alt=""></div>
  </div>
</div>
<div class="section6">
  <div class="body-center"> 
    <!--form-big-->
    <div class="form-big"> 
      <!--form-big__left-->
      <div class="form-big__left">
        <div class="akcia-wrap">
          <p class="akcia-wrap__title">Акция!</p>
          <p class="akcia-wrap__sale">Скидка<br>
            <span class="akcia-wrap__procent">-50<span>%</span></span></p>
        </div>
        <div class="price-wrap">
          <div class="old-price"> Полная цена
            <p><span class="x_price_previous"><span class="price_land_s4 oldproductsum">798</span></span> <span class="old-price__curent x_currency"></span></p>
          </div>
          <div class="new-price"> Цена со скидкой
            <p><span class="x_price_current"><span class="price_land_s1 productsum"><?php echo $price['real_price']; ?></span></span> <span class="new-price__curent x_currency"></span></p>
          </div>
        </div>
        <div class="form-big__text">
          <p class="form-big__text1">Количество акционных товаров ограничено:</p>
          <p class="form-big__text2">18 шт.</p>
        </div>
      </div>
      <!--form-big__center-->
      <div class="form-big__center"><img src="img/product-img-form.png"></div>
      <!--form-big__right-->
      <div class="form-big__right">
        <p class="form-wrapper__text">Введите <span class="not-480-form">Ваши </span>данные в форму ниже:</p>
        <form method="POST" class="forma x_order_form orderformcdn" action="./_success_/">
          <select name="country" class="countryselect forma__input"><option selected value='RU'>Россия</option></select>
          <input type="text" name="name" value="" class="forma__input forma--name" placeholder="Введите Имя" required>
          <input type="text" name="phone" value="" class="forma__input forma--phone" placeholder="Введите номер телефона" required>
          <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
			<div class="reolader">
				<button type="submit" class="mm_button forma__submit" onclick="checkFields(event, this);"> Заказать IMMUNITY для иммунитета</button>
				<div class="ajax_loader_block"><img class="ajax_loader" src="img/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
			</div>
        </form>
      </div>
    </div>
    <div class="footer">
      <div class="footer__center">
		<p style="padding-bottom: 10px;">ООО "Кредо Торг" ОГРН 1146733000171 ИНН 6732067526 214031 г. Смоленск, ул. Индустриальная, д. 9, каб. 15</p>
		<!--<p><img src="img/leadtrade.png"></p>-->
		<p style="padding-top: 10px;"><a href="politika.html" target="_blank">Политика конфиденциальности</a> <br><a href="agreement.html" target="_blank">Пользовательское соглашение</a></p>
      </div>
    </div>
  </div>
</div>
</body>
</html>