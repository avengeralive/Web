<? get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1>СМИ о нас</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10">
                <div class="row">
                <? while (have_posts()) : the_post(); ?>
                    <div class="col-lg-12">
                        <div class="smi-element pc">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2><? the_title(); ?></h2>
                                    <p><a href="<? the_permalink(); ?>">Подробнее</a></p>
                                </div>
                                <div class="col-md-6 smiobl">
                                    <img src="<?=get_the_post_thumbnail_url(); ?>">
                                </div>
                                <div class="col-md-6 smidate">
                                    <img src="<?=get_template_directory_uri();?>/images/vt.svg"><?=get_the_date(); ?>
                                </div>
                                <div class="col-md-6 zhurnal">
                                    <?=get_field('zhurnal', get_the_ID());?> <a href="#" class="share">Поделиться</a>
                                </div>
                            </div>
                        </div>
                        <div class="smi-element mob">
                            <div class="row">
                                <div class="col-12">
                                    <p><?=get_field('zhurnal', get_the_ID());?></p>
                                </div>
                                <div class="col-12 smiobl">
                                    <img src="<?=get_the_post_thumbnail_url(); ?>">
                                </div>
                                <div class="col-12">
                                    <p><img src="<?=get_template_directory_uri();?>/images/vt.svg"> <?=get_the_date(); ?> <a href="#" class="share">Поделиться</a></p>
                                    <a href="<? the_permalink(); ?>"><h2><? the_title(); ?></h2></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endwhile; ?>
                </div>
            </div>
            <div class="col-xl-1"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>