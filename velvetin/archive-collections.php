<? get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1>Звёздные коллекции</h1>
            </div>
        </div>
        <div class="row">
        <? while (have_posts()) : the_post(); ?>
            <div class="col-lg-4">
                <a href="<?=get_permalink(get_the_ID());?>" class="block-link">
                    <div class="collection-element">
                        <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                        <p>Звездная коллекция</br><b><?=get_field('фио_в_рп', get_the_ID());?></b></p>
                    </div>
                </a>
            </div>
        <? endwhile; ?>
        </div>
    </div>
</section>
<? get_footer(); ?>