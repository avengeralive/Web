<?
/*
Template name: Где купить
*/
get_header();
?>
<main class="site-main">
  <div class="content nearest-store">
    <header class="page-masthead">
      <h1 class="page-title">Где купить</h1>
    </header>  
    <div class="boutique_section bgcolor--cream small-12 column">
      <h2 class="boutique__title">ОФИЦИАЛЬНЫЕ ДИЛЕРЫ ЧАСОВ BALL</h2>
		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=rJ59m0EELqFIkcg5k2iP9nyBj7n22i5T&amp;width=1170&amp;height=450&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
      <ul class="small-up-1 medium-up-3 large-up-5 small-12 row listing__items__boutique">
        <? $mag = get_field('магазины', get_the_ID()); foreach ($mag as $item) { ?>
        <li class="listing__item__boutique column align--center">
          <a href="/pages/nearest-stores-bremont-boutiques-mayfair">
            <img alt="Bremont London Shop" src="<? echo $item['картинка']; ?>">
          </a>
          <h2><? echo $item['город']; ?></h2>
          <h3><? echo $item['название']; ?></h3>
          <p><? echo $item['адрес']; ?></p>
          <? if ($item['телефон'] != '') { ?><p>Тел.: <? echo $item['телефон']; ?></p><? } ?>
          <? if ($item['почта'] != '') { ?><p>E-mail: <a href="mailto:<? echo $item['почта']; ?>"><? echo $item['почта']; ?></a></p><? } ?>
          <? if ($item['сайт'] != '') { ?><p><a href="http://<? echo $item['сайт']; ?>"><? echo $item['сайт']; ?></a></p><? } ?>
        </li>
        <? } ?>
      </ul>
    </div>
  </div>
  <nav class="breadcrumbs-container" aria-label="Breadcrumbs">
    <a href="/">Главная</a>
    <span class="breadcrumbs-delimiter" aria-hidden="true">
      <i class="icon icon--rightarrow"></i>
    </span>
    <span>Где купить</span>
  </nav>
</main>
<? get_footer(); ?>