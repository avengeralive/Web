<?
/*
Template name: Reviews
*/ 
get_header(); ?>
         <!-- top_menu -->
         <? the_post(); ?>
<div class="es1_otzivy_bg">
    <div class="container">

        <div class="es1_otzivy_zag">ДВЕРИ ЦЕНЫ ОТЗЫВЫ</div>
               <? $reviews = get_posts(array('post_type' => 'reviews', 'posts_per_page' => 1000));
    foreach ($reviews as $review) { ?>
                    <div class="es1_otzivy_item">

                <div class="es1_otzivy_item__img">
                    <img src="<? echo get_the_post_thumbnail_url($review->ID); ?>" alt="<? echo $review->post_title; ?> - фото" style="width:100%;">
                </div>

                <div class="es1_otzivy_item__otzleft"></div>

                <div class="es1_otzivy_item__right">
                    <div class="es1_otzivy_item__otztext">
                        <div class="es1_otzivy_item__otztext__name"><? echo $review->post_title; ?><div class="es1_otzivy_item__otztext__city">г. Москва</div>
                        </div>

                        <div class="es1_otzivy_item__otztext__text"><? echo $review->post_content; ?></div>
                    </div>
                                        <div class="es1_otzivy_item__star">
                        Оценка работы компании:<span></span>
                        <nobr>
                            
                                                            <img src="<? echo get_template_directory_uri(); ?>/img/star.png" alt="">
                                                            <img src="<? echo get_template_directory_uri(); ?>/img/star.png" alt="">
                                                            <img src="<? echo get_template_directory_uri(); ?>/img/star.png" alt="">
                                                            <img src="<? echo get_template_directory_uri(); ?>/img/star.png" alt="">
                                                            <img src="<? echo get_template_directory_uri(); ?>/img/star.png" alt="">
                                                    </nobr>
                    </div>

                                            <div class="es1_otzivy_item__rek">
                            Буду рекомендовать
                            <img src="<? echo get_template_directory_uri(); ?>/img/rek_act.png" alt="">
                        </div>
                    
                    <div class="clearfix"></div>

                </div>
            </div>

            <div class="clearfix"></div>

            <? } ?>
        
    </div>
</div>

<div class="d-otziv-form">
    <div class="container">
        <h2>Оставить отзыв</h2>
        <br>

                
                

        

            <div class="es1_otzivy__form_bg">
                <form name="send_review" action="/dveri-otzyvy/" method="POST" enctype="multipart/form-data"><input type="hidden" name="sessid" id="sessid" value="7d5121903bd4fd32c2e323b1396087dd"><input type="hidden" name="WEB_FORM_ID" value="13">
                    <div class="es1_otzivy__form_bg__form_photo inpfilephoto" title="Прикрепить файл" style="overflow: hidden;">
                        <img id="blphoto" src="" alt="">
                         <input name="form_image_47" onchange="readURL(this);" size="0" type="file"><span class="bx-input-file-desc"></span>                    </div>

                    <div class="es1_otzivy__form_bg__form_right">

                        <div class="es1_otzivy__form_bg__form_name">
                            <input type="text" placeholder="Ваше имя" id="reviewName" data-validation="required" name="form_text_48" value="" size="0">                                                    </div>

                        <div class="es1_otzivy__form_bg__form_city">
                            <input type="text" placeholder="Город" name="form_text_49" value="" size="0">                                                    </div>

                        <div class="es1_otzivy__form_bg__form_text">
                            <textarea name="form_textarea_50" cols="40" rows="5" placeholder="Ваш отзыв" id="reviewText" data-validation="required"></textarea>                                                   </div>

                        <div class="es1_otzivy__form_bg__star">
                            Оценка работы компании:<span></span>
                            <nobr>
                                <img src="<? echo get_template_directory_uri(); ?>/img/form_star_act.png" alt="" class="es1_otzivy__form_star_1 ratingStar current" data-raiting="1">
                                <img src="<? echo get_template_directory_uri(); ?>/img/form_star.png" alt="" class="es1_otzivy__form_star_2 ratingStar" data-raiting="2">
                                <img src="<? echo get_template_directory_uri(); ?>/img/form_star.png" alt="" class="es1_otzivy__form_star_3 ratingStar" data-raiting="3">
                                <img src="<? echo get_template_directory_uri(); ?>/img/form_star.png" alt="" class="es1_otzivy__form_star_4 ratingStar" data-raiting="4">
                                <img src="<? echo get_template_directory_uri(); ?>/img/form_star.png" alt="" class="es1_otzivy__form_star_5 ratingStar" data-raiting="5"></nobr>
                        </div>
                        <input type="hidden" id="reviewRaiting" name="form_hidden_51" value="1">
                        <div class="es1_otzivy__form_bg__rek">
                            Буду рекомендовать
                            <img src="<? echo get_template_directory_uri(); ?>/img/rek.png" alt="">
                        </div>
                        <input type="hidden" id="reviewRecomendate" name="form_hidden_52" value="0">
                        

                        <input type="submit" name="web_form_submit" value="Оставить отзыв">



                    </div>


                </form>            </div>

<div class="prav-info dark mb30 center">Оставляя свои контактные данные, вы подтверждаете свое
                  совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
                  <a href="#legal-info" data-toggle="modal" class="b-link" data-target="#legal-info">Правовой
                     информацией</a></div>

    </div>
</div>
      <? get_template_part('templates/common/recalc'); ?>
      <? get_template_part('templates/common/free'); ?>
      <? get_template_part('templates/common/claimer'); ?>
      <? get_template_part('templates/common/timer'); ?>
      <? get_template_part('templates/common/textures'); ?>
      <? get_template_part('templates/common/claim'); ?>
      <? get_template_part('templates/common/portfolio'); ?>
      <? get_template_part('templates/common/free_consultation'); ?>
      <? get_template_part('templates/common/contacts'); ?>
      <? get_footer(); ?>