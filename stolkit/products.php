<?
/*
Template name: Products
*/
get_header(); 
the_post();
$POST_ID = get_the_ID();
?>
<style>
  <? echo get_field('стили', $POST_ID); ?>
</style>
<div class="es1_bg _man _mezh">
    <div class="container">
      <div class="row">
        <div class="es1_oknoman col-md-8">
          <img src="<? echo get_field('обложка', $POST_ID); ?>" width="100%" alt="">
        </div>
        <div class="es1_bg__right_col col-md-4">
          <h3><span><? echo get_field('заголовок_1', $POST_ID); ?></span></h3>
          <h1><span><? echo get_field('заголовок_2', $POST_ID); ?></span></h1>
          <h4 style="font-size: 26px;font-style: italic;text-shadow: -3px -3px 0 #fff, 3px -3px 0 #fff, -3px 3px 0 #fff, 3px 3px 0 #fff, 0.03em 0.04em 0.08em rgba(0, 0, 0, 0.6);font-family: 'pfdindisplaypro';"><? echo get_field('заголовок_3', $POST_ID); ?></h4>
          <div class="es1_bg__right_col__zag70">всего ОТ</div>
          <div class="es1_bg__right_col__stoim"><? echo get_field('цена', $POST_ID); ?><span> руб.</span></div>
          <div class="es1_bg__right_col__primech">за п/м</div>
          <div data-toggle="modal" data-target="#kupitDeshevle" class="rasschitat">Рассчитать
            <div>по самой низкой цене</div>
          </div>
          <div class="clear"></div>

            <div class="b-top__zamer" data-toggle="modal" data-target="#want_zamer">
                <div class="b-top__zamer_ruler "></div>
                <div class="b-top__zamer_txt"><span>БЕСПЛАТНЫЙ</span><br>
                    выезд замерщика</div>
            </div>

        </div><!-- /.es1_bg__right_col -->
      </div>
    </div>
</div>
<div class="es13_bg" style="height: auto !important; padding-bottom: 50px; margin-top: 0px !important;">
            <div class="es13_bg__text">
               наши сроки от 1 до 7 дней под ключ<br>
               <!--<img width="120px" height="120px" src="css/img/badg_op.png">-->
               <br>
               <small style="font-size: 50%;">замер&nbsp;&nbsp;&nbsp;&nbsp;<span>•</span>&nbsp;&nbsp;&nbsp;&nbsp;производство&nbsp;&nbsp;&nbsp;&nbsp;<span>•</span>&nbsp;&nbsp;&nbsp;&nbsp;монтаж</small>
            </div>
         </div>

<div class="es13_14">
         <div class="container">
            <h3>КОМПАНИЯ “СТОЛКИТ”</h3>
            <h2>100% качество по цене от производителя!</h2>
            <div class="es13_14__desc">Компания “Столкит” производит и устанавливает изделия из искусственного камня по лучшей цене в Москве и области! Благодаря собственному производственному цеху, оснащенному по всем передовым технологиям уже более 10 лет компания является самой надежной и стабильной. Наши цены обусловлены тем, что мы имеем специальные условия среди поставщиков камня благодаря большим оборотам и отлаженные производственные и логистические процессы, которые позволяют экономить ресурсы.</div>
         </div>
      </div>

<div class="katalog _mezhkomn _sale">

        <? get_template_part('templates/common/calculator'); ?>
        
    <div class="mdv-ajax-container">
        <div id="comp_244c21676a27c8db0911434991aecff4">






<div class="katalog__block"">
  <div class="container">
    <? $prods = get_posts(array('post_type' => get_field('слаг_товара', $POST_ID), 'posts_per_page' => 1000, 'order' => 'ASC'));
    foreach ($prods as $prod) { ?>     
      <div class="b-catalog__item">
        <div class="dvnazv"><? echo $prod->post_title; ?></div>
        <div class="dvpodnazv"><? echo get_field('подзаголовок', $prod->ID); ?></div>
        <div class="mainkaruselbgdvrazd">
          <div class="swiper___wrp swiper-container_<? echo $prod->ID; ?>">
            <div class="swiper-wrapper">
              <? $imgs = get_field('галерея', $prod->ID); 
                foreach ($imgs as $img) {
              ?>
              <div class="swiper-slide ">
                <div class="topsell"></div>
                <img src="<? echo $img['изображение']; ?>" alt="" style="height: 380px; width: auto;">
              </div>
              <?   
                }
              ?>
            </div>
          </div>
          <div class="swiperBtn___next swiper-button-next_<? echo $prod->ID; ?>"></div>
          <div class="swiperBtn___prev swiper-button-prev_<? echo $prod->ID; ?>"></div>
        </div>
        <div class="tdtop">
          <div class="razmdvvn" style="width: 335px; padding: 15px 10px 17px 10px; height: 310px; display: flex; flex-direction: column; justify-content: flex-end; float: left;">
            <div class="vntext"><? echo get_field('получаете', $prod->ID); ?></div>
            <p><? echo get_field('подописание', $prod->ID); ?> </p>
              <? $pr = get_field('преимущества', $prod->ID); ?>
              <ul style="    text-align: left;
    padding-left: 30px;
    font-size: 16px;
    height: 163px;
    overflow-y: scroll;
    border-right: 4px solid #ffe710; <? if (count($pr) == 0) { ?>display: none;<? } ?>">
                <? foreach ($pr as $p) {
              ?>
              <li><? echo $p['название']; ?></li>
              <?   
                } ?>
              </ul>
              <button class="red-button" id="template_zafixtsenu_but2" style="margin-top: 15px;" data-toggle="modal" data-target="#tseny">Смотреть каталог</button>
          </div>
            <div class="razmdvvn color" style="height: 310px;">
              <div class="vntext">Любой цвет (более 1000 текстур)</div>
              <div class="swiper-pagination_84 swiper-pagination-custom">
                <span class="swiper-pagination-style swiper-pagination_84_switcher" data-num="0">
                  <img src="<? echo get_template_directory_uri(); ?>/upload/iblock/a42/cat-texture-1.png" style="width:63px" alt="">
                  <div>Однотонные поверхности</div>
                </span>
                <span class="swiper-pagination-style swiper-pagination_84_switcher" data-num="0">
                  <img src="<? echo get_template_directory_uri(); ?>/upload/iblock/a42/cat-texture-2.png" style="width:63px" alt="">
                  <div>Мелкие вкрапления</div>
                </span>
                <span class="swiper-pagination-style swiper-pagination_84_switcher" data-num="0">
                  <img src="<? echo get_template_directory_uri(); ?>/upload/iblock/a42/cat-texture-3.png" style="width:63px" alt="">
                  <div>Средние вкрапления</div>
                </span>
                <span class="swiper-pagination-style swiper-pagination_84_switcher" data-num="0">
                  <img src="<? echo get_template_directory_uri(); ?>/upload/iblock/a42/cat-texture-4.png" style="width:63px" alt="">
                  <div>Крупные вкрапления</div>
                </span>
                <span class="swiper-pagination-style swiper-pagination_84_switcher" data-num="0">
                  <img src="<? echo get_template_directory_uri(); ?>/upload/iblock/a42/cat-texture-5.png" style="width:63px" alt="">
                  <div>Мраморная текстура</div>
                </span>
                <span class="swiper-pagination-style swiper-pagination_84_switcher" data-num="0">
                  <img src="<? echo get_template_directory_uri(); ?>/upload/iblock/a42/milan.png" alt="">
                  <div>Другое</div>
                </span>
              </div>
            </div>
            <script>
            $(function () {
              var swiper_<? echo $prod->ID; ?> = new Swiper('.swiper-container_<? echo $prod->ID; ?>', {
                simulateTouch: true,
                width: 400,
                slidesPerView:1,
                loop: true
              });
              $(".swiper-button-next_<? echo $prod->ID; ?>").click(function () {
                swiper_<? echo $prod->ID; ?>.slideNext();
              });
              $(".swiper-button-prev_<? echo $prod->ID; ?>").click(function () {
                swiper_<? echo $prod->ID; ?>.slidePrev();
              });
            })
            </script>
            <div class="katalog_copmplekt">
              <strong><? echo get_field('рекомендации_заголовок', $prod->ID); ?>:</strong>
              <span><? echo get_field('рекомендации_текст', $prod->ID); ?></span>
            </div>
            <div class="katalog__price">
              <div class="katalog__price_block">
                <div class="katalog__price_item">
                  <div class="katalog__price_new">ВСЕГО ОТ:</div>
                  <div class="katalog__price_newprice"><? echo get_field('цена', $prod->ID); ?><span>Р.</span></div>
                  <div class="katalog__price_old" style="text-align: right; margin: 0 auto;">за п/м</div>
                </div>
                <div class="katalog__price_item" data-toggle="modal" data-target="#kupitDeshevle-katalog">
                  <button class="red-button">Рассчитать</button>
                </div>
              </div>
            </div>
          </div>
          <div class="dvrazdtchk"></div>
      
      
    </div>
    <? } ?><div class="mdv-pagination"></div>
</div>
</div>    
</div>
    
    </div>

    <script>
$(function(){
  $('.mdv-filter-form').on('submit',function(){
    $.ajax({
      url: '/mezhkomnatnye-dveri/',
      method: "GET",
      data: $(this).serialize()+"&mdvAjax=Y",
      success: function(result){
        $('.mdv-ajax-container').html(result);
        $('#loader-wrapper').hide();
      }
    });
    return false;
  })
})
</script>
<div class="b-text">
    <div class="container">
      <h2 style="padding-bottom: 0px;"><? echo get_field('сопутствующий_заголовок', $POST_ID); ?></h2>
      <div class="b-text-content" style="margin-top: 0px; margin-bottom: 30px;"><? echo get_field('сопутствующий_текст', $POST_ID); ?></div>
      <? get_template_part('templates/common/blocker_'.get_field('слаг_товара', $POST_ID)); ?>   
    </div>
    <div class="container">
      <div class="dvrazdtchk"></div>
    </div>
</div>
<? get_template_part('templates/common/elems_'.get_field('слаг_товара', $POST_ID)); ?>
<? get_template_part('templates/common/panel_'.get_field('слаг_товара', $POST_ID)); ?>

<? get_template_part('templates/common/gaves_'.get_field('слаг_товара', $POST_ID)); ?>
<? get_template_part('templates/common/free'); ?>
<? get_template_part('templates/common/recalc_'.get_field('слаг_товара', $POST_ID)); ?>
<? get_template_part('templates/common/best'); ?>
<? get_template_part('templates/common/claimer'); ?>
<? get_template_part('templates/common/timer_'.get_field('слаг_товара', $POST_ID)); ?>
<? get_template_part('templates/common/textures'); ?>
<? get_template_part('templates/common/claim'); ?>
<? get_template_part('templates/common/reviews'); ?>
<? get_template_part('templates/common/portfolio_'.get_field('слаг_товара', $POST_ID)); ?>
<? get_template_part('templates/common/free_consultation'); ?>
<? get_template_part('templates/common/contacts'); ?>
<? get_template_part('templates/modals/doski'); ?>
<? get_template_part('templates/modals/inkrustaciya'); ?>
<? get_template_part('templates/modals/napr'); ?>
<? get_template_part('templates/modals/kromki'); ?>
<? get_template_part('templates/modals/bortiki'); ?>
<? get_footer(); ?>