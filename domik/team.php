<? 
/*
Template name: Team
*/
get_header(); ?>
<div class="" id="wrapper" style="opacity: 1;">

                                
                <div class="content-holder elem transition3">



                    
<div class="content">
            <div class="bg-animate" style="opacity: 0.6;"><img src="http://demowp.cththemes.com/domik/wp-content/themes/domik/images/body-bg.png" width="1053" height="1053" class="respimg" alt="rotate background"></div>
    
    
    <div class="wrapper-inner" style="opacity: 1;">
                     
    





         
    

         
    

        <section id="about_sec2" class="no-vc-margin domik_container no-border no-padding-bottom">    
            <div class="row vc_row wpb_row vc_row-fluid">
                <div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
    <div class="wpb_text_column wpb_content_element  section-title">
        <div class="wpb_wrapper">
            <h3>Наша команда</h3>

        </div>
    </div>
</div></div></div>            </div>
    </section> 
    <div class="clearfix"></div>

        <section class="no-vc-margin domik_container no-padding-top">    
            <div class="row vc_row wpb_row vc_row-fluid">
                <?
global $wp;
                       
                        $loop = new WP_Query( array(
                            'post_type' => 'team',
                            'orderby'=> 'date',
                            'order'=> 'ASC'
                            ) );
                        $key = 0;
                        while ($loop->have_posts()) : $loop->the_post();
                            $img_full = get_field('фото', get_the_ID());
                ?>
                <div class="team-box-holder wpb_column vc_column_container vc_col-sm-6 vc_col-md-4"><div class="vc_column-inner "><div class="wpb_wrapper">
                    <div class="team-box">
    <div class="team-photo">
        <div class="overlay"></div>
<!--<ul class="team-social" style="margin-top: -15.5px;">
    <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
    <li><a href="#" target="_blank"><i class="fa fa-tumblr"></i></a></li>
    <li><a href="#" target="_blank"><i class="fa fa-behance"></i></a></li>
</ul> -->       <img width="570" height="820" src="<? echo $img_full; ?>" class="respimg" alt="" srcset="<? echo $img_full; ?> 570w, <? echo $img_full; ?> 209w" sizes="(max-width: 570px) 100vw, 570px">
    </div>
 
        <div class="team-info">
            <h3><? the_title(); ?></h3>
                <h4><? the_content(); ?></h4>
        </div>
    </div>
</div></div></div>
<? endwhile; ?>
      </div>
    </section> 
    <div class="clearfix"></div>

         
    

         
    

         
    

         
    <div class="clearfix"></div>
  
      </div><!-- end .wrapper-inner-->
    <!-- parallax column  skill + singular -->
    <div class="img-wrap hide_with_full">
        <div class="bg skrollable skrollable-between" style="background-image: url(<? echo get_the_post_thumbnail_url(1573, 'full');?>); transform: translateY(-54.2799px);" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
    
    <div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div></div>
        
    
 
<? get_footer(); ?>