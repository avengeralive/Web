<? get_header(); ?>
		<? the_post(); ?>
		<div class="cr-breadcrumb-area" style="background-image: url(<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <div class="container">
                <div class="cr-breadcrumb text-center">
                    <h1><? the_title(); ?></h1>
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><? the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!--// Breadcrumb Area -->

        <!-- Page Content -->
        <main id="page-content">
            
            <!-- Blog Page Area -->
            <div class="cr-section blog-page-area bg-white section-padding-sm">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 col-12 sticky-sidebar-active">

                            <div class="pg-blog-item blog-details text-center">
                                <? the_content(); ?>
                            </div>


                            
                        </div>
                        <div class="col-xl-3 col-12 sticky-sidebar-active">
                            <div class="widgets right-sidebar">

                                <!-- Single Widget -->
                                <div class="single-widget widget-popular-post">
                                    <h5 class="widget-title"><? pll_e('popular'); ?></h5>
                                    <ul>
                                        <?
                                            $posts = get_posts(array('post_type' => 'post', 'lang' => pll_current_language()));
                                            foreach ($posts as $post) {
                                        ?>
                                        <li>
                                            <a href="blog-details.html" class="widget-popular-thumb">
                                                <img src="<? echo get_the_post_thumbnail_url($post->ID); ?>">
                                            </a>
                                            <h6><a href="#"><? the_title(); ?></a></h6>
                                            <span><? echo $post->post_date; ?></span>
                                        </li>
                                        <? } ?>
                                        
                                    </ul>
                                </div>
                                

                                </div>
                                <!--// Single Wiget -->

                                <!-- Single Wiget -->
                                
                                <!--// Single Wiget -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--// Blog Page Area -->

        </main>
<? get_footer(); ?>