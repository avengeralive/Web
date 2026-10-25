<? get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1>Акции</h1>
            </div>
        </div>
        <? while (have_posts()) : the_post(); ?>
        <div class="row promotion-element">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>">
                    </div>
                    <div class="col-md-8">
                        <span class="date"><?=get_field('дата', get_the_ID());?></span>
                        <h2><? the_title(); ?></h2>
                        <?=get_field('описание', get_the_ID());?>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
        <? endwhile; ?>
    </div>
</section>
<? get_footer(); ?>