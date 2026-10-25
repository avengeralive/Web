<? get_header(); ?>
<div class="" id="wrapper" style="opacity: 1;">
    <div id="ajax-page-inline-div-css" class="no-dis" type="text/css">.vc_custom_1456373264867{border-bottom-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1456456725837{border-bottom-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1456373093657{margin-top: 10px !important;}</div>                
    <div class="content-holder elem transition3">
        <? the_post(); ?>
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
                                            <div class="gallery-items popup-gallery three-coulms grid-small-pad">
                                                <div class="grid-sizer"></div>
                                                <?
                                                    $gallery = get_post_gallery(get_the_ID(), false)["ids"];
                                                    $gallery = explode(',', $gallery);
                                                    foreach ($gallery as $img) {
                                                        $img_full = wp_get_attachment_image_src($img, 'full')[0];
                                                        $img_thumb = wp_get_attachment_image_src($img, 'medium')[0];
                                                ?>
                                                <div class="gallery-item " style="position: absolute; left: 0%; top: 0px;">
                                                    <div class="grid-item-holder">
                                                        <div class="box-item">
                                                            <a href="<? echo $img_full; ?>" title="1">
                                                            <span class="overlay"></span> 
                                                            <img width="1000" height="605" src="<? echo $img_thumb; ?>" class="respimg" alt="" srcset="<? echo $img_thumb; ?> 1000w, <? echo $img_thumb; ?> 300w, <? echo $img_thumb; ?> 768w" sizes="(max-width: 1000px) 100vw, 1000px">                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                        <div class="wpb_text_column wpb_content_element  vc_custom_1456373093657">
                                            <div class="wpb_wrapper">
                                                <div class="project-details">
                                                    <? echo get_field('описание', get_the_ID()); ?>
                                                    <ul class="descr">
                                                        <li><span class="no-rep">Дата :</span> <? echo get_field('дата', get_the_ID()); ?></li>
                                                        <li><span class="no-rep">Клиент :</span> <? echo get_field('клиент', get_the_ID()); ?></li>
                                                        <li><span class="no-rep">Статус :</span> <? echo get_field('статус', get_the_ID()); ?></li>
                                                        <li><span class="no-rep">Локация : </span> <? echo get_field('локация', get_the_ID()); ?></li>
                                                    </ul>
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
    <div class="content-nav domik-folio-single-nav">
        <ul class="pager mgt20 clearfix">
            <? if (get_previous_post()) { ?>
                    <li class="previous"><a href="<? echo get_previous_post()->guid; ?>" class="arrow-nav lef-ar-nav ajax" title="Maecenas lacinia"><i class="fa fa-long-arrow-left"></i></a></li>
                <? } ?>
                <li class="remove-if-first"><span>/</span></li>
                <? if (get_next_post()) { ?>
                    <li class="next"><a href="<? echo get_next_post()->guid; ?>" class="arrow-nav rig-ar-nav ajax" title="Maecenas lacinia"><i class="fa fa-long-arrow-right"></i></a></li>
                <? } ?>
                    
                </ul> 

                <div class="p-all">
                    <a href="/projects" class="ajax"><i class="fa fa-th-large"></i></a>
                </div>
            </div>
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
                <div class="bg skrollable skrollable-between" style="background-image: url('<? echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>'); transform: translateY(-0.153767px);" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
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