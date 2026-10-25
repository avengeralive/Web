<? get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1>Звёздные клиенты</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10">
                <? $i = -1; while (have_posts()) : the_post(); $i++; ?>
                <? if ($i%3 == 0) { ?><div class="row client-row"><? } ?>
                    <div class="col-lg-4">
                        <div class="client-element">
                            <img src="<?=get_field('foto_pryamougolnoe', get_the_ID()); ?>">
                            <a href="https://instagram.com/<?=get_field('instagram', get_the_ID()); ?>" class="instagram" target="_blank" rel="nofollow"><i class="fab fa-instagram"></i> <?=get_field('instagram', get_the_ID()); ?></a>
                            <? the_content(); ?>
                            <p class="name"><? the_title(); ?></p>
                        </div>
                    </div>
                    <? if ($i%3 == 2) { ?></div><? } ?>
                <? endwhile; ?>
                <? if ($i%3 != 2) { ?></div><? } ?>
            </div>
            <div class="col-xl-1"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>