<?php 
   $offer = 14;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 

<!DOCTYPE html>
<html lang='ru'>
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
 
<title>UNIGATE – маленькое устройство с огромным потенциалом!</title>
<meta charset='utf-8'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
 
<link rel="stylesheet" href="files/style.css"/>
<link rel="shortcut icon" href="files/favicon.ico"type="image/x-icon">
<!-- Declare Variables -->
</head>
<body>
<header class='bg_header text__color-inversion'>
<!-- / HEADER -->
<div class='mw'>
<figure class='logo'>
<img alt='' src='files/img/logo.svg'>
<div class='sticker'>
<p>
Универсальный пульт-сканер для шлагбаумов и ворот
</p>
</div>
</figure>
<figure class='product'>
<img alt='' src='files/img/product.png'>
<figure class='label'>
<img alt='' src='files/img/label.svg'>
</figure>
</figure>
<div class='title'>
<h1>
Теперь у вас будет
<br>
<strong>
бесплатная парковка везде!
</strong>
</h1>
</div>
<ul class='list marked'>
<li>
Удобное использование на расстоянии
<strong>
до 100 метров
</strong>
</li>
<li>
<strong>
25 ячеек памяти
</strong>
для записи сигналов
</li>
<li class='other'>
Поддерживает все
<strong>
известные модели
</strong>
шлагбаумов и ворот
</li>
<li>
<strong>
Экономия на парковке
<br>
</strong>
до 3000 руб. в месяц!
</li>
</ul>
<div class='form'>



<form  action="./_success_/" method="post" >
	<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

<h5>
<strong>
Хит продаж <br>со скидкой -50%
</strong>
</h5>
<span class='price w_700'>
<span class='old'><x-oldprice>5980</x-oldprice></span>
<span class='new'><x-newprice><?php echo $price['real_price']; ?></x-newprice></span>
</span>
    
    
   <input name="name" type="text" required placeholder="Введите Ваше имя">

<input  name="phone" type="text" required placeholder="Введите Ваш телефон">


<input type='submit' value='ЗАКАЗАТЬ ПО АКЦИИ'>
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
</form>



</div>
</div>

</header>
<main class='main-content'>
<!-- / SECTION 1 -->
<section id='art1'>
<div class='mw is-grid'>
<div class='col c-6'>
<div class='content'>
<h2 class='section_title'>
А вы хотите
<span class='color_alt'>
бесплатно
</span>
парковаться на закрытых стоянках?
</h2>
<p>
<strong>
Универсальный пульт-сканер
</strong>
– уникальное устройство, которое позволяет копировать сигнал для автоматических ворот и шлагбаумов и впоследствии его воспроизводить (в том числе динамический сигнал).
</p>
<p class='other'>
Это даст вам возможность открывать любые автоматические ворота и шлагбаумы с одного пульта.
</p>
</div>
</div>
<div class='col c-6'>
<figure>
<img alt='' src='files/img/a1.png'>
</figure>
</div>
</div>
</section>

<!-- / SECTION 2 -->
<section class='bg_2' id='art2'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
UNIGATE
</strong>
– маленькое устройство с огромным
<br>
потенциалом!
</br>
</h2>
</div>
<div class='mw is-grid'>
<div class='col c-6'>
<figure class='solo'>
<img alt='' src='files/img/a2-1.png'>
<figcaption class='sticker'>
<h5>
Без UNIGATE
</h5>
</figcaption>
</figure>
<ul class='cards is-grid type_1'>
<li>
<figure>
<img alt='' src='files/img/a2-icon-1.svg'>
<figcaption>
<p>
<strong>
Приходится
</strong>
приезжать на работу (или домой) раньше, пока есть свободные места
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img alt='' src='files/img/a2-icon-2.svg'>
<figcaption>
<p>
<strong>
Платить за парковку,
</strong>
когда свободные места заняты
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img alt='' src='files/img/a2-icon-3.svg'>
<figcaption>
<p>
<strong>
Долго ездить
</strong>
в поисках свободного места
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
<div class='col c-6'>
<figure class='solo'>
<img alt='' src='files/img/a2-2.png'>
<figcaption class='sticker'>
<h5>
C UNIGATE
</h5>
</figcaption>
</figure>
<ul class='cards is-grid type_11'>
<li>
<figure>
<img alt='' src='files/img/a2-icon-4.svg'>
<figcaption>
<p>
<strong>
Паркуйтесь на закрытых территориях,
</strong>
где всегда есть свободные места!
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img alt='' src='files/img/a2-icon-5.svg'>
<figcaption>
<p>
<strong>
Экономьте
</strong>
свои нервы, время и деньги!
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img alt='' src='files/img/a2-icon-6.svg'>
<figcaption>
<p>
Удобное использование на расстоянии
<strong>
до 100 метров
</strong>
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</div>
</section>

<!-- / SECTION 3 -->
<section id='art3'>
<div class='mw dc'>
<div class='section-title__box'>
<h2 class='section_title'>
Описание<span>
UNIGATE
</span></h2>
<a class='btn type_0 modal' href='#'>
Заказать за <x-newprice><?php echo $price['real_price']; ?></x-newprice></a>
</div>
</div>
<div class='mw is-grid'>
<div class='col c-6'>
<div class='content'>
<p class='other'>
Универсальный брелок
<span class='color_alt'>
для удаленного управления
</span>
автоматическими шлагбаумами и воротами выглядит как обычный брелок от автосигнализации, но имеет другое назначение.
</p>
<p>
<strong>
• Брелок оснащен памятью
<span class='color_alt'>
на 25 ячеек,
</span>
</strong>
в каждую из которых может быть записан сигнал от автоматических ворот или шлагбаумов.
</p>
<p>
<strong>
• Выбор нужной ячейки
</strong>
для поднятия шлагбаума осуществляется 2-мя кнопками, расположенными на торце брелка. Там же находятся кнопки записи в память и активации открытия.
</p>
<p>
<strong>
• Брелок имеет ЖК-дисплей,
</strong>
на котором показана вся необходимая информация.
</p>
</div>
</div>
<div class='col c-6'>
<figure>
<img alt='' src='files/img/a3.png'>
</figure>
</div>
</div>
</section>

<!-- / SECTION 4 -->
<section class='bg_4' id='art4'>
<div class='mw dc'>
<h2 class='section_title'>
Какие ворота и шлагбаумы
<strong>
вы сможете открыть
</strong>
с помощью UNIGATE?
</h2>
<h3 class='after_title'>
<strong>
Универсальный брелок подходит для открытия всех моделей,
</strong>
устанавливаемых в
<br>
России автоматических ворот и шлагбаумов:
</br>
</h3>
</div>
<div class='mw'>
<ul class='cards is-grid type_2'>
<li>
<figure>
<img src='files/img/a4-1.png'>
<figcaption>
<p>
CAME
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a4-2.png'>
<figcaption>
<p>
NICE
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a4-3.png'>
<figcaption>
<p>
DOORHAN
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a4-4.png'>
<figcaption>
<p>
Genius
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a4-5.png'>
<figcaption>
<p>
DEA
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a4-6.png'>
<figcaption>
<p>
AN Motors
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a4-7.png'>
<figcaption>
<p>
O&O
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a4-8.png'>
<figcaption>
<p>
FAAC
</p>
</figcaption>
</figure>
</li>
</ul>
<h5>
И многих других…
</h5>
</div>
</section>

<!-- / SECTION 5 -->
<section class='bg_5 text__color-inversion' id='art5'>
<div class='mw is-grid'>
<div class='col c-6'>
<div class='content'>
<h2 class='section_title'>
С UNIGATE вы сможете
<br>
<strong>
парковаться где угодно!
</strong>
</h2>
<p>
Универсальный пульт-сканер оснащен самой современной технологией захвата динамического сигнала
<strong>
«Dynamic Capture 3»
</strong>
, что позволяет открывать современные модели автоматических систем с  защитой от копирования.
</p>
<a class='btn type_0 modal' href='#'>
ЗАКАЗАТЬ UNIGATE
</a>
</div>
</div>
<div class='col c-6'>
<figure class='solo'>
<img src='files/img/a5.png'>
</figure>
</div>
</div>
</section>

<!-- / SECTION 6 -->
<section id='art6'>
<div class='mw dc'>
<h2 class='section_title'>
Как пользоваться универсальным брелком-сканером?
</h2>
<h3 class='after_title'>
Для тех, кто не имеет опыта использования данных устройств
</h3>
</div>
<div class='mw'>
<ul class='cards is-grid type_31'>
<li>
<figure>
<img src='files/img/a6-1.svg'>
<figcaption>
<h5>
Разместите брелок-сканер
</h5>
<p>
на расстоянии до 100 метров от шлагбаума или ворот
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a6-2.svg'>
<figcaption>
<h5>
Подождите
</h5>
<p>
пока кто-нибудь подъедет к шлагбауму с оригинальным ключом
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a6-3.svg'>
<figcaption>
<h5>
Запустите
</h5>
<p>
режим сканирования
<br>
на брелке UNIGATE
</br>
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>

<!-- / SECTION 7 -->
<section class='bg_7' id='art7'>
<div class='mw'>
<ul class='cards is-grid type_3'>
<li>
<figure>
<img src='files/img/gif1.gif'>
<figcaption>
<p>
Как только владелец оригинального ключа нажмет на кнопку открытия ворот,
<strong>
брелок поймает сигнал и сохранит его в памяти
</strong>
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/gif2.gif'>
<figcaption>
<p>
Сохраненным в памяти сигналом
<strong>
вы сможете впоследствии открыть
</strong>
шлагбаум
<br>
или ворота сами
</br>
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/gif3.gif'>
<figcaption>
<p>
Теперь вы сможете
<strong>
бесплатно
</strong>
<br>
парковаться и экономить
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>

<!-- / SECTION 8 Expert -->
<section class='bg_8 text__color-inversion' id='art8'>
<div class='mw dc'>
<h2 class='section_title'>
Возможности, которые даст вам универсальный
<br>
брелок-сканер
<span>
UNIGATE
</span>
</br>
</h2>
</div>
<div class='mw'>
<ul class='cards is-grid type_32'>
<li class='other'>
<figure>
<img src='files/img/a8-1.svg'>
<figcaption>
<h5>
Бесплатная парковка
</h5>
<p>
в цетре города, вокзалах и аэропортах, в торговых центрах
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a8-2.svg'>
<figcaption>
<h5>
Беспрепятственный въезд
</h5>
<p>
На любую закрытую территорию
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a8-3.svg'>
<figcaption>
<h5>
Меньше носить с собой
</h5>
<p>
Перенос нескольких пультов от разных систем в один универсальный
</p>
</figcaption>
</figure>
</li>
</ul>
<a class='btn type_0 modal' href='#'>
ЗАКАЗАТЬ UNIGATE
</a>
</div>
</section>

<!-- / SECTION 9 -->
<section class='bg_9' id='art9'>
<div class='mw dc'>
<h2 class='section_title'>
<strong>
Чем отличается UNIGATE
</strong>
от других подобных устройств?
</h2>
<div class='mw'>
<ul class='cards is-grid type_4'>
<li>
<figure>
<img src='files/img/a9-1.png'>
<figcaption>
<p>
<strong>
Возможность открытия
</strong>
современных автоматических систем с
<span class='color_alt'>
динамическим
</span>
сигналом
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a9-2.png'>
<figcaption>
<p>
Большой радиус действия
<br>
<strong>
– до
<span class='color_alt'>
100
</span>
метров!
</strong>
</br>
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a9-3.png'>
<figcaption>
<p>
Возможность
<strong>
записать до
<span class='color_alt'>
25 сигналов
</span>
</strong>
<br>
(а не 4, как в других устройствах!)
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a9-4.png'>
<figcaption>
<p>
<strong>
Брелок многочастотный:
</strong>
поддерживаются все распространенные
<span class='color_alt'>
частоты
</span>
– 418, 433,92, 868,30, 868,35 МГц
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a9-5.png'>
<figcaption>
<p>
<strong>
Сканер работает
</strong>
полностью в
<span class='color_alt'>
автоматическом
</span>
режиме
</p>
</figcaption>
</figure>
</li>
<li>
<figure>
<img src='files/img/a9-6.png'>
<figcaption>
<p>
<strong>
Питание брелка
</strong>
осуществляется
<br>
от обычной батарейки
<span class='color_alt'>
ААА
</span>
</p>
</figcaption>
</figure>
</li>
</ul>
</div>
</div>
</section>

<!-- / SECTION 10 -->
<section id='art10'>
<div class='mw dc'>
<h2 class='section_title'>
Характеристики
<span>
UNIGATE
</span>
</h2>
</div>
<div class='mw is-grid'>
<div class='col c-6'>
<figure>
<img alt='' src='files/img/a10.png'>
</figure>
</div>
<div class='col c-6'>
<div class='content'>
<ul class='list-simple type_2'>
<li>
Размеры: 35х80 мм
</li>
<li>
Мультичастотный диапазон работы
</li>
<li>
25 ячеек для записи сигналов
</li>
<li>
Радиус действия: 100 метров
</li>
<li>
Поддержка динамических сигналов, моделирование сигнала по: частоте, количеству импульсов, скважности, количеству проверочных битов в коде.
</li>
<li>
Звуковое и виброоповещение при записи кода в ячейку памяти
</li>
<li>
ЖК-дисплей
</li>
<li>
Гарантия 1 год
</li>
</ul>
</div>
</div>
</div>
</section>

<!-- / SECTION 11 -->
<section class='bg_11 text__color-inversion' id='art11'>
<div class='mw is-grid'>
<div class='col c-6'>
<div class='content'>
<h2 class='section_title'>
Производитель, которому
<br>
<strong>
можно доверять!
</strong>
</br>
</h2>
<p>
<strong>
Универсальный брелок-сканер производится российской компанией «ПРОМАВТОМАТИКА».
</strong>
</p>
<p>
Именно эта компания разрабатывала электронную начинку и программное обеспечение для автоматических ворот и шлагбаумов DOORHAN. Впоследствии контракт DOORHAN и ПРОАВТОМАТИКОЙ был расторгнут из-за разногласий в ценовой политике. После этого компания стала выпускать универсальные брелки-сканеры, которые помогают открывать любые автоматизированные ворота и шлагбаумы.
</p>
</div>
</div>
<div class='col c-6'>
<figure>
<img alt='' src='files/img/a11.png'>
</figure>
</div>
</div>
</section>

<!-- / SECTION 12 -->
<section class='bg_12' id='art12'>
<div class='mw dc'>
<h2>
Что о
<strong>
UNIGATE
</strong>
говорят покупатели?
</h2>
</div>
<div class='mw dc'>
<div class='scw rew'>
<ul id='reviews'>
<li>
<figure>
<img class='photo' src='files/img/r1.png'>
<figcaption>
<p>
<strong>
Станислав,
<br>
</strong>
31 год, Казань
</p>
</figcaption>
</figure>
<article>
<p>
«Отличный брелок! Работает без проблем, считывает все сигналы. Пользуюсь уже год, за это время каких-либо проблем в работе выявлено не было. Паркуюсь на закрытых парковках. Работаю в центре – раньше проблема парковки была актуальна. Чуть опоздал, и бесплатные места заняли. Сейчас можно не торопиться. Паркуюсь во дворе жилого дома, открывая шлагбаум. Рекомендую!»
</p>
</article>
</li>
<li>
<figure>
<img class='photo' src='files/img/r2.png'>
<figcaption>
<p>
<strong>
Владимир,
<br>
</strong>
26 лет, Курск
</p>
</figcaption>
</figure>
<article>
<p>
«Понравился брелок-сканер UNIPRO II. Полностью оправдал мои ожидания. Раньше уже пользовался подобным, но он открывал лишь 50% ворот и шлагбаумов. Этот открывает все – по крайней мере, мне еще не попадались те, которые он не смог бы открыть. Сам брелок такой же по форме, как от сигнализации. Доставили в Курск за 3 дня обычной почтой. В целом за такие деньги отличное приобретение. Опять же экономия на стоянках и всегда свободные места)»
</p>
</article>
</li>
<li>
<figure>
<img class='photo' src='files/img/r3.png'>
<figcaption>
<p>
<strong>
Михаил,
<br>
</strong>
34 года, Санкт-Петербург
</p>
</figcaption>
</figure>
<article>
<p>
«Это действительно что-то с чем-то! Брелок супер. Не верил до конца, когда друг о таких рассказывал. Но потом, когда увидел в действии, поверил. Купил себе такой и ни разу не пожалел. Готов даже отдать за него большую цену. Очень удобно. Появилась возможность парковаться за шлагбаумами. За все время никто ничего не говорил. Ставлю машину у соседнего дома (там за шлагбаумом), если в нашем дворе все места заняты, а также около работы на охраняемой территории. Ставил также у автовокзала нашего. Советую брелок всем».
</p>
</article>
</li>
</ul>
<div class='scc'>
<button style="cursor: pointer;" class='prev'></button>
<button style="cursor: pointer;" class='next'></button>
</div>
</div>
</div>
</section>

<!-- / SECTION 13 -->
<section id='art13'>
<div class='mw dc'>
<h2 class='section_title'>
Как заказать
<strong>
UNIGATE?
</strong>
</h2>
<div class='mw dc'>
<ul class='cards is-grid type_5'>
<li>
<figure>
<img src='files/img/step-1.svg'>
<figcaption>
<h5>
Ваша заявка
</h5>
<p>Оставьте заявку на этом сайте, указав номер телефона</p>
</figcaption>
</figure>
</li>
<li class='two'>
<figure>
<img src='files/img/step-2.svg'>
<figcaption>
<h5>
Звонок менеджера
</h5>
<p>Мы перезвоним вам для уточнения адреса доставки</p>
</figcaption>
</figure>
</li>
<li class='three'>
<figure>
<img src='files/img/step-3.svg'>
<figcaption>
<h5>
Ожидаете доставку
</h5>
<p>Доставим товар в ближайшее к вам почтовое отделение</p>
</figcaption>
</figure>
</li>
<li class='four'>
<figure>
<img src='files/img/step-4.svg'>
<figcaption>
<h5>
Получаете посылку
</h5>
<p>Вам останется прийти на почту и получить посылку</p>
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
<img alt='' src='files/img/logo.svg'>
<div class='sticker'>
<p>
Универсальный пульт-сканер для шлагбаумов и ворот
</p>
</div>
</figure>
<figure class='product'>
<img alt='' src='files/img/product.png'>
<figure class='label'>
<img alt='' src='files/img/label.svg'>
</figure>
</figure>
<div class='title'>
<h1>
Теперь у вас будет
<br>
<strong>
бесплатная парковка везде!
</strong>
</h1>
</div>
<ul class='list marked'>
<li>
Удобное использование на расстоянии
<strong>
до 100 метров
</strong>
</li>
<li>
<strong>
25 ячеек памяти
</strong>
для записи сигналов
</li>
<li class='other'>
Поддерживает все
<strong>
известные модели
</strong>
шлагбаумов и ворот
</li>
<li>
<strong>
Экономия на парковке
<br>
</strong>
до 3000 руб. в месяц!
</li>
</ul>
<div class='form'>
<form action="./_success_/" method="post"  >
	<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
<h5>
<strong>
Хит продаж <br> со скидкой -50%
</strong>
</h5>
<span class='price w_700'>
<span class='old'><x-oldprice>5980</x-oldprice></span>
<span class='new'><x-newprice><?php echo $price['real_price']; ?></x-newprice></span>
</span>
    
 
<input name="name" type="text" required placeholder="Введите Ваше имя">
<input  name="phone" type="text"  required placeholder="Введите Ваш телефон" >
<input type='submit' value='ЗАКАЗАТЬ ПО АКЦИИ'>
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
</form>
</div>
</div>

</footer>
<div><center><p>Абрамова Оксана Сергеевна ИНН:790153581503</p> 

  
 
    
    
            <p class="conf-link doclinks">
        <a class="nav-link"  href="polit.html"  target="_blank" >Политика конфиденциальности </a>
      </p>
      
 
    
</center></div>
<div class='popup popup-form'>
<div class='popup-container'>
<div class='fw'>

<form action="./_success_/" method="post" >
	<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
<h5 style='font-size:18px;font-weight:bold;color:#0a294d;text-align:center;margin-bottom:16px;'>
Хит продаж <br>со скидкой -50%
</h5>
<span class='price'>
<span class='old'><x-oldprice>5980</x-oldprice></span>
<span class='new'><x-newprice><?php echo $price['real_price']; ?></x-newprice></span>
</span>
    
<input  name="name" type="text" required placeholder="Введите Ваше имя">

<input  name="phone" type="text" required placeholder="Введите Ваш телефон">
<input type='submit' value='ЗАКАЗАТЬ ПО АКЦИИ'>
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
</form>


</div>
<a class='popup-close img-replace' href='0'>Закрыть</a>
</div>
</div>
<!-- /%link{:rel => :stylesheet, :type => :"text/css", :href => "style.css"} -->
 
<script src='files/jquery.js'></script>
<script src='files/siema.min.js'></script>
<script>
  $(document).ready(function (){
  
    $("head").append("<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700,900&amp;subset=cyrillic-ext' rel='stylesheet' type='text/css'>");
  
  
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
	border-radius: 4px;
	outline: 0;
	padding: .89rem .89rem;
	-webkit-appearance: none;
	outline-offset: 0;
	width: 100%;
	text-align: center;
	font-size: 16px;
	background-size: 4%;

background-image: url(open.png);
background-position: right;
background-repeat: no-repeat;
}
</style>
</body>
</html>

