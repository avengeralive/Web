 <div class="sec_footer">
 <div class="">
 <div class=" col-md-12 row margin-bottom" style="margin-top: 25px;">
 <div class="col-md-4 social">Мы в соцсетях:  <a href="#">Vk/</a>   <a href="#">Facebook/</a></div>
 <div class="col-md-4 page"><span>Cкроль ниже</span><div class="circle">
    <? if (is_home()) { ?>
    <p  class="active" data-content="#header"></p>
    <? $posts = get_posts(); ?>
    <? foreach ($posts as $post) { ?>
    <p data-content="#project<? echo $post->ID; ?>"></p>
    <? } ?>
    <p data-content="#team"></p>
    <? } else { global $wp_query; ?>
    <p data-content="#s1" class="active"></p>
    <? for ($i = 2; $i <= 7; $i++) { 
if (get_field('постер_'.$i, $wp_query->post->ID) != '') {
?>
<p data-content="#s<? echo $i; ?>"></p>
<? } } ?>
    <? } ?>
    <p data-content="#contact"></p></div></div>
 <div class="col-md-4 text-right style-text">2018.MobileCrew</div>
 </div>
 </div>
 </div>

<footer id="contact">
<div class="">
<div class="contact">
<h2>MobileCrew</h2>
<p>Напиши нам, мы будем рады </p>
<span>MobileCrew@questions.ru</span>
<h2>Номер телефона</h2>
<p>+7 905 019-33-45</p>

<!--<form class="form">
<input type="text" placeholder="Ваше имя">
<input type="email" placeholder="Ваше эл.почта">
<textarea placeholder="Ваше сообщение"></textarea>
<input type="submit" placeholder="Отправить">
</form>-->
<? echo do_shortcode('[contact-form-7 id="57" title="Отзыв" html_class="form"]'); ?>

</div>
</div>
</footer>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='/wp-content/themes/mobilecrew/OwlCarousel2-2.2.1/owl.carousel.js'></script>
<script src='https://use.fontawesome.com/826a7e3dce.js'></script>
<script src="/wp-content/themes/mobilecrew/js/main.js"></script>
<script >
      $('.owl-carousel').owlCarousel({
    loop:false,
  stagePadding: 15,
    margin:10,
    nav:true,
  navText : ['<span class="arrow-back flaticon-back" ></span>','<span class="arrow-next flaticon-next"></span>'],
    responsive:{
        0:{
            items:2
        },
        640:{
            items:2
        },
      960:{
            items:3
        },
        1200:{
            items:5
        }
    }
})
</script>
<? wp_footer(); ?>
</body>
</html>
