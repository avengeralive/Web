<? 
/*
Template name: p03
*/
get_header(); ?>
<div class="" id="wrapper" style="opacity: 1;">
    <div id="ajax-page-inline-div-css" class="no-dis" type="text/css">.vc_custom_1456373264867{border-bottom-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1456456725837{border-bottom-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1456373093657{margin-top: 10px !important;}</div>                
    <div class="content-holder elem transition3">
        <? the_post();  $id = get_the_ID(); $content = get_the_content();  ?>
        <div class="content">
            <div class="bg-animate" style="opacity: 0.6;">
                <img src="/wp-content/themes/domik/images/body-bg.png" width="1053" height="1053" class="respimg" alt="rotate background">
            </div>
            <div class="wrapper-inner" style="opacity: 1;">
                <section class="domik_sec no-vc-margin vc_custom_1456373264867">  
                    <div class="domik_container">
                        <div class="row wpb_row">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <div class="page-title no-border">
                                                    <h2><? the_title(); ?></h2>
                                                    <h3><span class="no-rep"><? echo get_field('краткое_описание', get_the_ID()); ?></span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
                <div class="domik_container">
                    <section class="domik_sec no-vc-margin">
                        <div class="row vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="domik_images_gallery_wrap gallery-items-wrapper">
                                            <div class="gallery-items three-coulms grid-small-pad">
                                                <div class="grid-sizer"></div>
                                                <? 
                        global $wp;
                        $loop = new WP_Query( array(
                            'post_type' => 'projcts',
                            'orderby'=> 'date',
                            'order'=> 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'projcts_category',
                                        'field'    => 'id',
                                        'terms'    => 5,
                                    ),
                                )
                            ) );
                        
                        
                        while ($loop->have_posts()) : $loop->the_post();
                            $img_full = get_the_post_thumbnail_url(get_the_ID());
                            $img_large = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            $img_thumb = get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail'); 
                        ?>
                                                <div class="gallery-item " style="position: absolute; left: 0%; top: 0px;">
                                                    <div class="grid-item-holder">
                                                        <div class="box-item bi2">
                                                            <a href="<? echo get_the_permalink(); ?>" title="1" class="ajax">
                                                             
                                                            <img width="1000" height="605" src="<? echo $img_thumb; ?>" class="respimg" alt="" srcset="<? echo $img_thumb; ?> 1000w, <? echo $img_thumb; ?> 300w, <? echo $img_thumb; ?> 768w" sizes="(max-width: 1000px) 100vw, 1000px" style="margin-bottom: 15px;">                            </a>
                                                            <h3 style="margin-bottom: 15px;"><? echo the_title(); ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                    <? endwhile; ?>
                                                
                                            </div>
                                        </div>
                                        <div class="wpb_text_column wpb_content_element  vc_custom_1456373093657">
                                            <div class="wpb_wrapper">
                                                <div class="project-details" style="text-align: left;">
                                                    <? echo $content; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> 
                </div>
                <section class="domik_sec no-vc-margin vc_custom_1456456725837">
                    <div class="domik_container">
                        <div class="row wpb_row">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="clearfix"></div>
                                        <div class="portfolio_nav_wrap">
   
</div>
                                        <div class="comment-template-wrapper">

                                            <? comments_template(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
            </div>
            <div class="img-wrap hide_with_full">
                <div class="bg skrollable skrollable-between" style="background-image: url('<? echo get_the_post_thumbnail_url(1492, 'large'); ?>'); transform: translateY(-0.153767px);" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
                <div class="scale-callback scale-bg5"></div>
            </div>
<? get_footer(); ?> 