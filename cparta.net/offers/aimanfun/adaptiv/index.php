<?php 
   $offer = 3;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
     $name = "name";
?> 

<!DOCTYPE html>
<html lang='ru'>

<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<title>Aimanfun - ЛАЗЕРНАЯ ЭПИЛЯЦИЯ В ДОМАШНИХ УСЛОВИЯХ!</title>
<meta charset='utf-8'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<link href='http://creativecommons.org/licenses/by/3.0/' rel='license' title='Creative Commons Attribution 3.0 Unported License'>
<link href='/feed' rel='alternate' title='Atom' type='application/atom+xml'>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="style.css">
<!-- Declare Variables -->
</head>
<body>
<header class='bg_header text__color-inversion'>
<!-- / HEADER -->
<div class='mw'>
<figure class='logo'>
<img alt='' src='img/logo.svg'>
<div class='label'>
<h3>
Домашний лазерный эпилятор
</h3>
</div>
</figure>
<figure class='product'>
<img alt='' src='img/product.png'>
<div class='sticker'>
<h3>
Не сказка, не вымысел, а настоящее проверенное средство!
</h3>
</div>
</figure>
<div class='title'>
<h1>
ЛАЗЕРНАЯ ЭПИЛЯЦИЯ В ДОМАШНИХ УСЛОВИЯХ
</h1>
</div>
<ul class='list marked'>
<li>
Проводите эффективную косметологическую процедуру у себя дома!
</li>
<li>
Избавьтесь навсегда от нежелательных волос без лишних трат!
</br>
</li>
<li>
Подходит для всех типов волос. Можно использовать на всех оттенках кожи!
</li>
<li>
Не требуется отращивания, длительный результат
</li>
<li>
Никакого раздражения и последствий
</li>
</ul>
<div class='form'>
<form action="./_success_/" method="post">
<h5>
<strong>
Хит продаж 2020
</strong>
</h5>
<span class='price w_700'>
<span class='old'>4380</span>
<span class='new'><?php echo $price['real_price']; ?></span>
</span>

     
<input placeholder='Введите ваше имя' name="<?php echo $name; ?>" required type='text'>
<input placeholder='Введите телефон' name="phone"  required type='text'>
<input type='submit' value='Получить 53% скидку'>
<div class='timer_container'>
<div class='timer'>
<div class='item-timer ih'>
<div class='hr'></div>
<div class='dots'>:</div>
</div>
<div class='item-timer im'>
<div class='min'></div>
<div class='dots'>:</div>
</div>
<div class='item-timer is'>
<div class='sec'></div>
</div>
</div>
</div>
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
</form>
</div>
</div>

</header>
<main class='main-content'>
<!-- / SECTION 1 -->
<section class='section_padding' id='art2'>
<div class='mw is-grid'>
<div class='col c-6 order1'>
<figure class='solo'>
<img src='img/a2.png'>
</figure>
</div>
<div class='col c-6 order2'>
<div class='content'>
<h2 class='section_title'>
<strong>
Самый безопасный способ эпиляции
<br>
– лазерный
</strong>
</h2>
<p>
Во время процедуры под воздействием точечного света происходит нагрев меланина в корне волоса. Под действием тепла кровь, питающая фолликулу, сворачивается и закупоривает сосуд. Без поступления необходимых веществ волос выпадает.
</p>
<h4 class='color_alt'>
Такое происходит со всеми волосами, которые подверглись воздействию лазером.
</h4>
</div>
</div>
</div>
</section>

<!-- / SECTION 2 -->
<section class='bg_1 section_padding' id='art1'>
<div class='mw is-grid'>
<div class='col c-6'>
<div class='content'>
<h2 class='section_title'>
<strong>
Чем эпиляция лучше депиляции?
</strong>
</h2>
<h5 class='color_alt left_border'>
Эпиляция позволяет не просто срезать волосы,
<br>
а удалить их луковицы.
</h5>
<p>
Эпиляция позволяет не просто срезать волосы, а удалить их луковицы. В результате достигается более продолжительный эффект гладкой и чистой кожи. Если при депиляции (срезании волоса) нежелательная растительность начинает снова появляться уже через несколько дней (кожа становится шершавой на ощупь), то
<strong>
эффект от эпиляции держится в течение 9-15 месяцев.
</strong>
</p>
</div>
</div>
<div class='col c-6'>
<figure class='solo'>
<img src='img/a1.png'>
</figure>
</div>
</div>
</section>


<!-- / SECTION 3 -->
<section class='bg_3 text__color-inversion' id='art3'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Преимущества
</strong>
лазерной эпиляции
</h2>
</div>
<div class='mw dc'>
<ul class='type_1 cards is-grid'>
<li>
<figure>
<img src='img/a3-1.png'>
<figcaption>
<p>
Удаление волос без боли
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a3-2.png'>
<figcaption>
<p>
Безвредно для кожи
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a3-3.png'>
<figcaption>
<p>
Возможность избавиться от растительности на долгое время
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a3-4.png'>
<figcaption>
<p>
Удаление волос на любом
<br>
участке тела
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>

<!-- / SECTION 4 -->
<section class='bg_4 section_padding' id='art4'>
<div class='mw is-grid'>
<div class='col c-6'>
<div class='content'>
<h2 class='section_title'>
Однако у лазерной эпиляции есть и
<strong>
существенный недостаток
</strong>
</h2>
<h5 class='left_border color_alt'>
– это дорогая косметологическая процедура, которая включает в себя несколько посещений кабинета косметолога.
</h5>
<p>
Именно поэтому домашний лазерный эпилятор стал популярным сразу как появился. Он позволяет проводить процедуру по удалению нежелательной растительности
<strong>
дома самим без лишних затрат финансов,
</strong>
времени и сил.
</p>
</div>
</div>
<div class='col c-6'>
<div class='video'>
<iframe frameborder='0' src='https://www.youtube.com/embed/rOav9KX64JM' title='YouTube video player'></iframe>
</div>
</div>

</div>
</section>


<!-- / SECTION 5 -->
<section class='section_padding' id='art5'>
<div class='mw is-grid'>

<div class='col c-6 other'>
<div class='col c-6'>
<figure class='left'>
<img src='img/gif.gif'>
</figure>
</div>
<div class='col c-6'>
<figure class='right'>
<img src='img/a5.png'>
</figure>
</div>
</div>

<div class='col c-6'>
<div class='content'>
<h2 class='section_title'>
<strong>
Инновация в косметологии –
<br>
</strong>
лазерный эпилятор «Aimanfun»
</h2>
<p>
Компактный лазерный эпилятор «Aimanfun» позволяет удалять нежелательные волосы дома. Aimanfun имеет
<strong>
5 уровней интенсивности
</strong>
светового импульса, что позволяет подобрать оптимальный режим для любого типа волос.
</p>
<a class='btn type_0 modal' href='#'>
Заказать со скидкой
</a>
</div>
</div>
</div>
</section>

<!-- / SECTION 6 -->
<section class='bg_6 text__color-inversion' id='art6'>
<div class='mw dc'>
<h2 class='section_title'>
При создании Aimanfun применены несколько
<br>
<strong>
запатентованных технологий:
</strong>
</h2>
</div>
<div class='mw'>
<ul class='cards is-grid type_2'>
<li class='other'>
<figure>
<img src='img/a6-1.png'>
<figcaption>
<h4>
Ultra Hair Removal
</h4>
<p>
Специальная длина волны лазера и выверенная длительность импульса разрушают волосяные фолликулы в 3-4 раза эффективнее.
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a6-2.png'>
<figcaption>
<h4>
Easy Cool
</h4>
<p>
Технология охлаждения лазера предупреждает нагрев устройства и обжигание кожи.
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a6-3.png'>
<figcaption>
<h4>
Speed Removal
</h4>
<p>
В сочетании с увеличенным размером светового пятна позволяет обрабатывать необходимые зоны в 2-3 раза быстрее.
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>


<!-- / SECTION 7 Expert -->
<section class='bg_8' id='art8'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Где можно бороться
</strong>
с нежелательной
<br>
растительностью?
</br>
</h2>
</div>
<div class='mw dc'>
<ul class='type_3 cards is-grid'>
<li>
<figure>
<img src='img/a8-1.png'>
<figcaption>
<p>
Ноги
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-2.png'>
<figcaption>
<p>
Ягодицы
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-3.png'>
<figcaption>
<p>
Зона бикини
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-4.png'>
<figcaption>
<p>
Подмышечные впадины
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-5.png'>
<figcaption>
<p>
Область живота
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-6.png'>
<figcaption>
<p>
Область сосков
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-7.png'>
<figcaption>
<p>
Декольте
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-8.png'>
<figcaption>
<p>
Спина
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-9.png'>
<figcaption>
<p>
Плечи
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-10.png'>
<figcaption>
<p>
Поясница
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-11.png'>
<figcaption>
<p>
Руки
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-12.png'>
<figcaption>
<p>
Шея
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-13.png'>
<figcaption>
<p>
Верхняя губа
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a8-14.png'>
<figcaption>
<p>
Ушные раковины
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>


<!-- / SECTION 8 -->
<section class='bg_7' id='art7'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Схема работы
</strong>
Aimanfun
</h2>
</div>
<div class='mw dc'>
<ul class='type_1 cards is-grid'>
<li>
<figure>
<img src='img/a7-1.png'>
<figcaption>
<p>
Импульс воздействует на волосяную луковицу
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a7-2.png'>
<figcaption>
<p>
«Отключается»
<br>
рост волос
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a7-3.png'>
<figcaption>
<p>
«Выключенные» волосы
<br>
выпадают сами
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a7-4.png'>
<figcaption>
<p>
Волосяной покров постепенно пропадает
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>

<!-- / SECTION 9 -->
<section class='bg_9 text__color-inversion' id='art9'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Как хорошо эпилятор удаляет волосы?
<br>
</strong>
Посмотрите сами!
</h2>
</div>
<div class='mw'>
<ul class='cards is-grid type_2'>
<li>
<figure>
<img src='img/a9-1.png'>
</figure>
</li>
<li>
<figure>
<img src='img/a9-2.png'>
</figure>
</li>
<li>
<figure>
<img src='img/a9-3.png'>
</figure>
</li>
</ul>
<h5>
<strong>
Aimanfun – самый продаваемый эпилятор в США в 2020 году.
</strong>
Вы тоже можете
<br>
использовать его для борьбы с излишней растительностью.
</h5>
<a class='btn type_0 modal' href='#'>
Заказать Aimanfun со скидкой
</a>
</div>
</section>

<!-- / SECTION 10 -->
<section id='art10'>
<div class='mw dc'>
<h2 class='section_title'>
Объективные
<strong>
преимущества
</strong>
Aimanfun
</h2>
<h3 class='after_title'>
Одобрен Американской Ассоциацией Дерматологов
</h3>
</div>
<div class='mw'>
<ul class='cards is-grid type_4'>


<li>
<figure>
<img src='img/a10-3.png'>
<figcaption>
<p>
Полностью безболезненная процедура
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a10-2.png'>
<figcaption>
<p>
Можно использовать на всех участках тела
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a10-4.png'>
<figcaption>
<p>
Не вредит кожи, не вызывает раздражений
</p>
</figcaption>
</figure>
</li>

<li>
<figure>
<img src='img/a10-6.png'>
<figcaption>
<p>
Подходит и для мужчин,
<br>
и для женщин
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a10-1.png'>
<figcaption>
<p>
Возможность настройки прибора для эффективного удаления любого типа волос
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a10-7.png'>
<figcaption>
<p>
Компактный и удобный, можно брать с собой
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a10-5.png'>
<figcaption>
<p>
Сама процедура по удалению волос занимает несколько минут
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a10-8.png'>
<figcaption>
<p>
Стильный современный
<br>
дизайн
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>

<!-- / SECTION 11 -->
<section class='bg_11 section_padding' id='art11'>
<div class='mw is-grid'>
<div class='col c-8'>
<div class='content'>
<h2 class='section_title'>
<strong>
Дерматологи рекомендуют
<br>
</strong>
именно лазерную эпиляцию!
</h2>
<p>
«На сегодняшний день существует несколько способов удаления нежелательных волос. Однако большая часть из них травмирует кожу. Так, например, бритва или обычный электрический эпилятор срезают ее верхний защитный слой, в результате чего кожа часто воспаляется и пересыхает. Шугаринг и воск, являясь самыми травмирующими, нарушают кровообращение не только в верхних, но и в глубоких слоях дермы. Фотоэпиляция же вызывает быстрое старение кожи.
</p>
<p>
Таким образом, из всех распространенных способов удаления нежелательной растительности лазерная эпиляция является самой безопасной. Она не имеет ни одного негативного воздействия на кожу. Именно поэтому всем своим пациентам я рекомендую отдавать предпочтение именно ей. С Aimanfun делать лазерную эпиляция стало возможным дома, что, безусловно, облегчает эту задачу. Aimanfun – лучший эпилятор на сегодняшний день».
</p>
</div>
</div>
<div class='col c-4'>
<div class='who'>
<figure>
<img src='img/88928.162x162.jpg'>
<figcaption>
<h5 class='left_border color_alt'>
Хмелева Т. В., дерматолог, врач высшей категории, стаж практики – 28 лет
</h5>
</figcaption>
</figure>
</div>
</div>
</div>
</section>

<!-- / SECTION 12 -->
<section class='bg_12 text__color-inversion' id='art12'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Сравнение Aimanfun
</strong>
с другими способами
<br>
удаления нежелательных волос
</h2>
</div>
<div class='mw'>
<div class='table type_1'>
<div class='features'>
<div class='empty'></div>
<div class='param'>
<h6>Удаление волос надолго</h6>
</div>
<div class='param'>
<h6>Безболезненность процедуры</h6>
</div>
<div class='param'>
<h6>Отсутствие вреда для кожи</h6>
</div>
<div class='param'>
<h6>Быстрое удаление волос</h6>
</div>
<div class='param'>
<h6>Можно обрабатывать даже чувствительную кожу</h6>
</div>
<div class='param'>
<h6>Для любых волос</h6>
</div>
</div>
<div class='cols'>
<div class='col'>
<div>
<h5>Электромеханические депиляторы и бритвы</h5>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
</div>
<div class='col'>
<div>
<h5>Воск и шугаринг</h5>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
</div>
<div class='col'>
<div>
<h5>
Домашние
<br>
фотоэпиляторы
</br>
</h5>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
<div>
<img src='img/minus.svg'>
</div>
</div>
<div class='col other'>
<div>
<h5>
Первый в мире домашний лазерный эпилятор
<br>
«Aimanfun»
</h5>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
<div>
<img src='img/plus.svg'>
</div>
</div>
</div>
</div>
<a class='btn type_0 modal' href='#'>
Заказать Aimanfun со скидкой
</a>
</div>
</section>

<!-- / SECTION 13 TABLE -->
<section class='bg_13' id='art13'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Рекомендации
</strong>
по применению
</h2>
<h4 class='after_title'>
Чем чаще вы будете использовать Aimanfun, тем меньше у вас будут расти волосы. Можно
<br>
добиться полной остановки роста волос.
</h4>
</div>
<div class='mw dc'>
<ul class='type_1 cards is-grid'>
<li>
<figure>
<img src='img/a13-1.png'>
<figcaption>
<p>
Очистите и высушите кожу
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a13-2.png'>
<figcaption>
<p>
Медленно проведите эпилятором по коже в местах удаления волос
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a13-3.png'>
<figcaption>
<p>
На следующий день стряхните волосы с кожи
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/a13-4.png'>
<figcaption>
<p>
При необходимости процедуру можно повторить
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>

<!-- / SECTION 14 REWIEW's -->
<section class='bg_14' id='art14'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Отзывы
</strong>
покупателей
</h2>
</div>
<div class='mw dc'>
<div class='scw rew'>
<ul id='reviews'>
<li>
<figure>
<img class='photo' src='img/1555.jpg'>
</figure>
<article>
<p>
Проблема волос беспокоила меня с самого их появления, бритва была моим первым другом и первым врагом. Я чувствовала жуткое раздражение, все чесалось, волосы врастали. Потом я попробовала шугаринг, процедура понравилась, но раздражение после сходит неделю, а через две растет уже новая партия. Меня это категорически не устраивало, но я ходила мучить свою кожу стабильно, так как наличие волос меня не устраивало вдвойне. Пару месяцев назад подруга посоветовала Aimanfun, она сама им пользуется уже пол года, результат у нее шикарный. Сначала я воспользовалась ее прибором, результат меня шокировал в прямом смысле! Никакого раздражения! Совсем! Волосы ушли быстро, я даже не заметила этого! И вот уже как неделю, у меня есть свой собственный Aimanfun, заказала по акции и очень этим довольна!
</p>
<strong class='color_alt'>
Адлер, Ксюша, 26 лет.
</strong>
</article>
</li>
<li>
<figure>
<img class='photo' src='img/1222.jpg'>
</figure>
<article>
<p>
Долгое время ходила на фотоэпиляцию в салон, к слову выходили мне зоны ног, бикини и подмышек за одну процедуру в 4500 рублей! А приходить нужно раз в три недели! Представьте, сколько я потратила и сколько бы пришлось еще потратить денег... Если бы не наткнулась я на это чудо... Девочки, нас дурят в салонах, можно столько сэкономить же! И процедуру эпиляции проводить у себя дома, в любое время суток, отставить все эти записи в салон!
</p>
<strong class='color_alt'>
Усть-Лабинск, Мария, 32 года.
</strong>
</article>
</li>
<li>
<figure>
<img class='photo' src='img/r2.png'>
</figure>
<article>
<p>
Привет, хочу оставить отзыв о лазерном эпиляторе. Подарил его своей девушке на день рождения. Многие скажут, что такие вещи не дарят... Но скажу так, лучше бы дарили, очень полезная вещь, о которой многие дамы и не догадываются. Моя девушка была очень рада такому подарку, теперь свои деньги она может потратить на что-то более интересное для себя, нежели на походы на депиляцию. А освободившееся время уделяет мне. В общем, это идеальный подарок, эпилятор должен быть у каждой девушки.
</p>
<strong class='color_alt'>
Москва, Женя, 28 лет.
</strong>
</article>
</li>
</ul>
<div class='scc'>
<button class='prev'></button>
<button class='next'></button>
</div>
</div>
</div>
</section>

<!-- / SECTION 15 -->
<section class='bg_15' id='art15'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Как заказать
</strong>
лазерный эпилятор «Aimanfun»?
</h2>
<div class='mw dc'>
<ul class='cards is-grid type_5'>
<li>
<figure>
<img src='img/step-1.svg'>
<figcaption>
<p>
<strong>
Оставьте
</strong>
заявку в форме
<br>
на этом сайте
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/step-2.svg'>
<figcaption>
<p>
<strong>
Мы перезвоним
</strong>
вам для уточнения адреса доставки
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/step-3.svg'>
<figcaption>
<p>
<strong>
Доставим
</strong>
вам товар
<br>
курьером или почтой
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='img/step-4.svg'>
<figcaption>
<p>
<strong>
Оплата
</strong>
при получении
<br>
– вы ничем не рискуете!
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</div>
</section>

</main>
<footer class='bg_header text__color-inversion'>
<!-- / HEADER -->
<div class='mw'>
<figure class='logo'>
<img alt='' src='img/logo.svg'>
<div class='label'>
<h3>
Домашний лазерный эпилятор
</h3>
</div>
</figure>
<figure class='product'>
<img alt='' src='img/product.png'>
<div class='sticker'>
<h3>
Не сказка, не вымысел, а настоящее проверенное средство!
</h3>
</div>
</figure>
<div class='title'>
<h1>
ЛАЗЕРНАЯ ЭПИЛЯЦИЯ В ДОМАШНИХ УСЛОВИЯХ
</h1>
</div>
<ul class='list marked'>
<li>
Проводите эффективную косметологическую процедуру у себя дома!
</li>
<li>
Избавьтесь навсегда от нежелательных волос без лишних трат!
</br>
</li>
<li>
Подходит для всех типов волос. Можно использовать на всех оттенках кожи!
</li>
<li>
Не требуется отращивания, длительный результат
</li>
<li>
Никакого раздражения и последствий
</li>
</ul>
<div class='form'>
<form action="./_success_/" method="post">
<h5>
<strong>
Хит продаж 2020
</strong>
</h5>
<span class='price w_700'>
<span class='old'>4380</span>
<span class='new'><?php echo $price['real_price']; ?></span>
</span>

     
<input placeholder='Введите ваше имя' name="<?php echo $name; ?>" required type='text'>
<input placeholder='Введите телефон' name="phone"  required type='text'>
<input type='submit' value='Получить 53% скидку'>
<div class='timer_container'>
<div class='timer'>
<div class='item-timer ih'>
<div class='hr'></div>
<div class='dots'>:</div>
</div>
<div class='item-timer im'>
<div class='min'></div>
<div class='dots'>:</div>
</div>
<div class='item-timer is'>
<div class='sec'></div>
</div>
</div>
</div>
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
</form>
</div>
</div>

</footer>
<div><center><p>ООО «Белый Клык», ИНН 5908035536 ОГРН 1065908029670
</p>
<p>Юридический адрес: 614077, Пермский край, город Пермь, бульвар Гагарина, 70 Б</p> 

 
            <p class="conf-link doclinks">
      </p>
      


    
</center></div>
<div class='popup popup-form'>
<div class='popup-container'>
<div class='fw'>
<form action="./_success_/" method="post">
<h5>
Хит продаж 2020
</h5>
<span class='price'>
<span class='old'>4380</span>
<span class='new'><?php echo $price['real_price']; ?></span>
</span>
    
 
     
<input placeholder='Введите ваше имя' name="<?php echo $name; ?>" required type='text'>
<input placeholder='Введите телефон' name="phone"  required type='text'>
<input type='submit' value='Получить 53% скидку'>
<div class='timer_container'>
<div class='timer'>
<div class='item-timer ih'>
<div class='hr'></div>
<div class='dots'>:</div>
</div>
<div class='item-timer im'>
<div class='min'></div>
<div class='dots'>:</div>
</div>
<div class='item-timer is'>
<div class='sec'></div>
</div>
</div>
</div>
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
</form>
</div>
<a class='popup-close img-replace' href='0'>Закрыть</a>
</div>
</div>
 
<script src='jquery.js'></script>
<script src='siema.min.js'></script>
<script>
  $(document).ready(function (){
  
    $("head").append("<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700,900&amp;subset=cyrillic-ext' rel='stylesheet' type='text/css'>");
  
    const table = new Siema({
      selector: '.table .cols',
      duration: 200,
      easing: 'ease-out',
      perPage: {
        320: 1,
        760: 2,
        1020: 4
      },
      startIndex: 0,
      draggable: true,
      multipleDrag: true,
      threshold: 20,
      loop:false,
      rtl: false,
      onInit: () => {},
      onChange: () => {},}
  
    );
  
  
    const mySiemar = new Siema({
      selector: '#reviews',
      duration: 200,
      easing: 'ease-out',
      perPage: {
        320: 1,
        760: 1,
        1020: 1
      },
      startIndex: 0,
      draggable: true,
      multipleDrag: true,
      threshold: 20,
      loop: true,
      rtl: false,
      onInit: () => {},
      onChange: () => {},}
  
    );
  
    document.querySelector('.scc .prev').addEventListener('click', () => mySiemar.prev());
    document.querySelector('.scc .next').addEventListener('click', () => mySiemar.next());
  

    var duration = { d: 1, h: 1, m: 59, s: 59 },
      sf = 120,
      maxD = 2,
      maxH = 24,
      maxM = 60,
      maxS = 60;
  
    setInterval(function() {
      $('.d').html(duration.d);
      $('.hr').html(duration.h);
      $('.min').html(duration.m)
        .attr('data-t', duration.m - 1);
      $('.sec').html(duration.s)
        .attr('data-t', duration.s - 1);
      duration.s--;
      $('.sec').addClass('flip');
      $('.min').removeClass('flip');
      $('.id .circle').css('stroke-dashoffset', sf-(duration.d*(sf/maxD)));
      $('.ih .circle').css('stroke-dashoffset', sf-(duration.h*(sf/maxH)));
      $('.im .circle').css('stroke-dashoffset', sf-(duration.m*(sf/maxM)));
      $('.is .circle').css('stroke-dashoffset', sf-(duration.s*(sf/maxS)));
      if (duration.s === 58) {
        $('.m').addClass('flip');
      }
      if (duration.s === 0) {
        duration.m--;
        duration.s = 59;
        if (duration.m === 0) {
          duration.h--;
          duration.m = 59
        }
      }
    }, 1000);
  
    // Select all links with hashes
    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function(event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
          &&
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000, function() {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });
      //open popup
    $('a.modal, .button').on('click', function(event){
      event.preventDefault();
      $('.popup-form').addClass('is-visible');
    });
  
    $('a.cop').on('click', function(event){
      event.preventDefault();
      $('.popup-text').addClass('is-visible');
    });
  
      //close popup
    $('.popup').on('click', function(event){
      if( $(event.target).is('.popup-close') || $(event.target).is('.popup') ) {
        event.preventDefault();
        $(this).removeClass('is-visible');
      }
    });
  
    $('.popup-text').on('click', function(event){
      if( $(event.target).is('.popup-close') || $(event.target).is('.popup') ) {
        event.preventDefault();
        $(this).removeClass('is-visible');
      }
    });
      //close popup when clicking the esc keyboard button
    $(document).keyup(function(event){
      if(event.which=='27'){
        $('.popup').removeClass('is-visible');
      }
    });});
</script>
<style>
.form-control {
	-webkit-backface-visibility: hidden;
	background: #fff;
	border: solid 1px #bfc3c4;
	box-sizing: border-box;
	border-radius: 5em;
	outline: 0;
	padding: .89rem .89rem;
	-webkit-appearance: none;
	outline-offset: 0;
	width: 100%;
	text-align: center;
	font-size: 14px;
}
</style>

</body>

</html>