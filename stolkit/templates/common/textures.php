<section class="b-karusel2">
         <div class="wrapper">
            <h2 style="margin-bottom: 50px;">ПОПУЛЯРНЫЕ ТЕКСТУРЫ</h2>
            <div class="container" style="position:relative;">
               <div class="door_104">
                  <div style="margin:0px 60px 0 70px;">
                     <ul class="container1">
                        <? $posts = get_posts(array('post_type' => 'textrure', 'posts_per_page' => 15, 'orderby' => 'rand', 'meta_query'  => array(
        array(
            'key'   => 'избранное',
            'value'   => true,
            'compare' => '='
          )
    ))); 
                   foreach ($posts as $post) {
                  ?>
                   <li class="door_0">
                           <a href="#">
                              <img class="roundabout_image" src="<? echo get_the_post_thumbnail_url($post->ID); ?>" /> 
                              <p><? echo $post->post_title; ?></p>
                           </a>
                        </li>
                   <?
                   }
                   ?>
                     </ul>
                  </div>
                  <p class="door_101">
                     <a href="#" id="previous11" style="float:left;"><img class="roundabout_image" src="<? echo get_template_directory_uri(); ?>/img/sale/slider_prev.png" /></a>
                     <a href="#" id="next11" style="float:right;"><img class="roundabout_image" src="<? echo get_template_directory_uri(); ?>/img/sale/slider_next.png" /></a>
                  </p>
               </div>
               <div style="margin: 20px auto 50px; text-align: center;">
                  <button data-toggle="modal" data-target="#kupitDeshevle-katalog" class="red-button js-fancy door-call_want-cheaper-link">ПЕРЕЙТИ В КАТАЛОГ</button>
               </div>
            </div>
            <script type="text/javascript">
               jQuery(document).ready(function($) {
               
                   $('.container1').roundabout({
                       minScale: 0.1,
                       btnNext: '#next11',
                       btnPrev: '#previous11',
                   });
               
                   $('.container2').roundabout({
                       minScale: 0.1,
                       btnNext: '#next22',
                       btnPrev: '#previous22',
                   });
               
                   $('.container3').roundabout({
                       minScale: 0.1,
                       btnNext: '#next33',
                       btnPrev: '#previous33',
                   });
               
               });
            </script>
         </div>
      </section>