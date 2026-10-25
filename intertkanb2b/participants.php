<?
/*
Template name: Участники
*/
?>
<? get_header(); ?>
		<? the_post(); ?>
        <!-- Breadcrumb Area -->
        <div class="cr-breadcrumb-area" style="background-image: url(<? echo get_field('обложка', get_the_ID()); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
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
			
            <!-- Team Area -->
            <section class="cr-section team-area bg-white section-padding-sm">
                <div class="container">
                    <div class="row team-member-wrapper">

                        <!-- Team Member -->
                        <?
                            $parts = get_posts(array('post_type' => 'participants'));
                            foreach ($parts as $part) {
                        ?>
                        <div class="col-12 col-md-4">
                            <a href="<? echo $part->guid; ?>" class="portfolio1">
                                <div class="portfolio-thumb">
                                    <img src="<? echo get_the_post_thumbnail_url($part->ID); ?>" alt="portfolio thumb 1" style="height: 250px;">
                                </div>
                                <div class="portfolio-content">
                                    <h5 class="text-center" style="font-size: 14px;"><? echo $part->post_title; ?></h5>
                                </div>
                            </a>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </section>
            <!--// Team Area -->

        </main>
<? get_footer(); ?>