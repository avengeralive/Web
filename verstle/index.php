<? get_header(); ?>

<section class="about_section" id="header">
<div class=" m-auto">
<div class="row">
<div class="col-lg-8 col-md-push-4 col-md-12 ">
<div class="img_head">
<img src="/wp-content/themes/mobilecrew/img/baner.png" alt=""/>
</div>
</div>
<div class="col-lg-4 col-md-pull-8 col-md-12 " style="flex-direction: column; justify-content: center; display: flex;">
<p class="about_p">
Заказ разработки мобильных приложений для Android и IOS устройств в компании MobileCrew,
позволит Вам в кратчайшие сроки получить качественный и современный пордукт.
</p>
<div class="buy-responsive"><a href="#">Заказать продукт</a></div>
</div>
</div>
</div>
</section>
<div id="project0"></div>
<? while (have_posts()) { the_post(); ?>
<? if (get_field('тип', get_the_ID()) == 'Лево') { ?>
<section id="project<? the_ID(); ?>">
<div class=" m-auto padding_">
<div class="head_section_mobile">
<img src="<? echo get_field('иконка', get_the_ID()); ?>"><a href="<? the_permalink(); ?>"><h2><? the_title(); ?></h2></a>
</div>
<div class="row">
<div class="col-lg-6 col-md-push-6 col-md-12 ">
<div class="img_section">
<img src="<? echo get_field('изображение', get_the_ID()); ?>" alt=""/>
</div>
</div>
<div class="col-lg-6 col-md-pull-6 col-md-12 ">
<div class="vertical-middle">
<div class="head_section">
<a href="<? the_permalink(); ?>"><img src="<? echo get_field('иконка', get_the_ID()); ?>"><h2><? the_title(); ?></h2></a>
</div>
<div class="overflow-text">
<? the_content(); ?>
</div>
<div class="read"><a href="#">Читат весь текст</a></div>
<div class="view-project"><a href="<? the_permalink(); ?>">Смотреть проект</a></div>
<div class="op_sis">
<a href="<? echo get_field('ссылка_app_store', get_the_ID()); ?>" class="op">
<img src="/wp-content/themes/mobilecrew/img/app.svg">
</a>
<a href="<? echo get_field('сслыка_google_play', get_the_ID()); ?>" class="op">
<img src="/wp-content/themes/mobilecrew/img/google.svg">
</a>
</div>
<div class="project" data-content="project<? echo get_previous_post()->ID; ?>"><i class="fa_down fas fa-angle-down"></i><span>Смотрите другие работы</span></div>
</div>
</div>
 </div>
 </div>
</section>
<? } else { ?>
<section id="project<? the_ID(); ?>"> 
<div class=" m-auto ">
<div class="head_section_mobile text-rght">
<img src="<? echo get_field('иконка', get_the_ID()); ?>"><a href="<? the_permalink(); ?>"><h2><? the_title(); ?></h2></a>
</div>
<div class=" row">
<div class="col-lg-6 col-md-12">
<div class="img_section">
<img src="<? echo get_field('изображение', get_the_ID()); ?>" alt=""/>
</div>
</div>

<div class="col-lg-6 col-md-12">
<div class="vertical-middle right-text">
<div class="head_section text-rght">
<a href="<? the_permalink(); ?>"><h2><? the_title(); ?></h2></a><img src="<? echo get_field('иконка', get_the_ID()); ?>">
</div>
<div class="overflow-text">
<? the_content(); ?>
</div>

<div class="read"><a href="#">Читат весь текст</a></div>

<div class="view-project"><a href="<? the_permalink(); ?>">Смотреть проект</a></div>
<div class="op_sis">
<a href="<? echo get_field('ссылка_app_store', get_the_ID()); ?>" class="op">
<img src="/wp-content/themes/mobilecrew/img/app.svg">
</a>
<a href="<? echo get_field('сслыка_google_play', get_the_ID()); ?>" class="op">
<img src="/wp-content/themes/mobilecrew/img/google.svg">
</a>
</div>
</div>
</div>

 </div>
 </div>
</section>
<? } } ?>

<!--<section id="project2">
<div class=" m-auto">
<div class="app_section_mobile">
<img src="/wp-content/themes/mobilecrew/img/logo_prav.png"><h2>Открытое правительство</h2>
</div>
<div class=" row ">
<div class="col-lg-6 col-md-push-6 col-md-12">
<div class="img_section">
<img src="/wp-content/themes/mobilecrew/img/pravitelstvo.png" alt=""/>
</div>
</div>
<div class="col-lg-6 col-md-pull-6 col-md-12 ">
<div class="vertical-middle">
<div class="app_section">
<img src="/wp-content/themes/mobilecrew/img/logo_prav.png"><h2>Открытое правительство</h2>
</div>
<div class="overflow-text">
<p class="sec2_p">
"Открытое Правительство" - мобильное приложение Правительства Магаданской области,
позволяющее жителям Колымы в новом и удобном
формате принимать участие в развитии региона. Основные модули приложения: 
</p>
<div class="modul">
<span>Опросы</span>
<p>Участие в принятии решений</p>
</div>

<div class="modul">
<span>Новости и мероприятия</span>
<p>Актуальная информация о событиях региона, прямые трансляции</p>
</div>

<div class="modul">
<span>Вопросы и идеи</span>
<p>Возможность задать вопрос и предложить идею</p>
</div>
</div>
<div class="read"><a href="#">Читат весь текст</a></div>
<div class="view-project"><a href="#">Смотреть проект</a></div>


<div class="op_sis">
<a href="#" class="op">
<img src="/wp-content/themes/mobilecrew/img/app.svg">
</a>
<a href="#" class="op">
<img src="/wp-content/themes/mobilecrew/img/google.svg">
</a>
</div>
<div class="project" data-content="project3"><i class="fa_down fas fa-angle-down"></i><span>Смотрите другие работы</span></div>
</div>
</div>
 </div>
 </div>
</section>

<section id="project3">
<div class=" m-auto ">

<div class="head_section_mobile">
<img src="/wp-content/themes/mobilecrew/img/logo_doc.svg"><h2>Доктор рядом</h2>
</div>
<div class="row ">
<div class="col-lg-6 col-md-push-6 col-md-12">
<div class="img_section">
<img src="/wp-content/themes/mobilecrew/img/doc.png" alt=""/>
</div>
</div>
<div class="col-lg-6 col-md-pull-6 col-md-12">
<div class="vertical-middle">
<div class="head_section">
<img src="/wp-content/themes/mobilecrew/img/logo_doc.svg"><h2>Доктор рядом</h2>
</div>
<div class="overflow-text">
<p class="sec2_p">
Официальное приложение Государственной программы
развития безвозмездного донорства крови и ее компонентов.
</p>
<span class="sec2_span">
«Служба крови» - первое мобильное приложение в России, при помощи
которого можно планировать даты своих донаций, ознакомиться с результатами медицинского и лабораторного обследования, правилами подготовки к процедуре и перечнем противопоказаний,
а также получить онлайн-консультацию у специалистов Службы крови.
</span>
</div>
<div class="read"><a href="#">Читат весь текст</a></div>
<div class="view-project"><a href="#">Смотреть проект</a></div>
<div class="op_sis">
<a href="#" class="op">
<img src="/wp-content/themes/mobilecrew/img/app.svg">
</a>
<a href="#" class="op">
<img src="/wp-content/themes/mobilecrew/img/google.svg">
</a>
</div>
<div class="project" data-content="project4"><i class="fa_down fas fa-angle-down"></i><span>Смотрите другие работы</span></div>
</div>
</div>
 </div>
 </div>
</section>-->



<section id="team">
<div class=" team ">
<div class="team-size">
<p>
Команда нащих разработчиков состоит из 
узкоспециализированных профессионалов, обладающих
новейшим инструментарием и технологиями разработки
мобильных приложеный для устройств на базе платформ IOS(iPhone/iPad)  и Android.
</p>

<div class="carousel-wrap">
  <div class="owl-carousel">
  	<? $p = get_posts(array('post_type' => 'slider')); 
  	foreach ($p as $l) {
  	?>
  	<div class="item"><img src="<? echo get_the_post_thumbnail_url($l->ID); ?>" style="height: 100%;"><p><? echo $l->post_title; ?></p></div>
  	<? } ?>
  	<!--
    <div class="item"><img src="/wp-content/themes/mobilecrew/img/white.png"><p>Дизайнер</p></div>
    <div class="item"><img src="/wp-content/themes/mobilecrew/img/white.png"><p>Дизайнер</p></div>
    <div class="item"><img src="/wp-content/themes/mobilecrew/img/white.png"><p>Фронт</p></div>
    <div class="item"><img src="/wp-content/themes/mobilecrew/img/white.png"><p>Дизайнер</p></div>
    <div class="item"><img src="/wp-content/themes/mobilecrew/img/white.png"><p>Тайный агент</p></div>-->
  </div>
</div>
</div>
</div>
</section>

<? get_footer(); ?>