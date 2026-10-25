<?
/*
Template name: Участники вид
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
                    <?
                        $terms = get_terms( array(
                            'taxonomy' => 'participant_category',
                            'hide_empty' => false,
                        ) );
                        foreach ($terms as $prod) { 
                    ?>
                    <div class="row mb-30 mt-30">
                        <h3><? echo $prod->name; ?></h3>
                    </div>
                    <div class="row pt-30 pb-30">

                        <!-- Team Member -->
                        <?
                            $parts = get_posts(array('post_type' => 'participants', 'tax_query' => array(
                                array(
                                    'taxonomy' => 'participant_category',
                                    'field' => 'term_id',
                                    'terms' => array($prod->term_id),
                                    'operator' => 'IN',
                                )
                             )));
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
                    <? } ?>
                </div>
            </section>
            <!--// Team Area -->

        </main>
<? get_footer(); ?>