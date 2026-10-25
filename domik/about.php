<? 
/*
Template name: About
*/
get_header(); ?>
<div class="" id="wrapper" style="opacity: 1;">
    <div class="content-holder elem transition3">
        <div class="content">
            <? the_post(); ?>
            <div class="bg-animate" style="opacity: 0.6;"><img src="/wp-content/themes/domik/images/body-bg.png" width="1053" height="1053" class="respimg" alt="rotate background"></div>
            <div class="wrapper-inner" style="opacity: 1;">
                <section id="aboutme_sec1" class="domik_sec no-vc-margin no-padding no-border">
                    <div class="domik_container">
                        <div class="row wpb_row">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element  page-title no-border">
                                            <div class="wpb_wrapper">
                                                <h2><? the_title(); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
                <section class="no-vc-margin domik_container">    
                    <div class="row vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-9">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <? the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> 
                <div class="clearfix"></div>
                <section class="no-vc-margin domik_container">    
                    <div class="row vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-4">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"></div>
                            </div>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-8">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper">
                                    <div class="vc_row wpb_row vc_inner vc_row-fluid inline-facts-holder">
                                        <div class="inline-facts vc_col-md-4 wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="milestone-counter ">
                                                        <div class="stats animaper">
                                                            <div class="num" data-content="<? echo wp_count_posts('projcts')->publish; ?>" data-num="<? echo wp_count_posts('projcts')->publish; ?>"><? echo wp_count_posts('projcts')->publish; ?></div>
                                                        </div>
                                                    </div>
                                                    <h6>Проектов</h6>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-facts vc_col-md-4 wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="milestone-counter ">
                                                        <div class="stats animaper">
                                                            <div class="num" data-content="40" data-num="40">40</div>
                                                        </div>
                                                    </div>
                                                    <h6>Локации проекто</h6>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-facts vc_col-md-4 wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="milestone-counter ">
                                                        <div class="stats animaper">
                                                            <div class="num" data-content="12" data-num="12">12</div>
                                                        </div>
                                                    </div>
                                                    <h6>Лет на рынке</h6>
                                                    <p></p>
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
            </div>
            <div class="img-wrap hide_with_full">
                <div class="bg skrollable skrollable-between" style="background-image: url(<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>); transform: translateY(-0.153767px);" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
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