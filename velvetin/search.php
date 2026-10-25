<? get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1>Результаты поиска по запросу: "<?=$_GET['s'];?>"</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-xl-2"></div>
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="row">
                    <? while (have_posts()) { the_post(); ?>
                    <div class="col-lg-4 col-6">
                        <div class="product-item <? if (in_array(get_the_ID(), explode(",", $_COOKIE['fav']))) { ?>is-favorite<? }?>">
                            <a href="<?=get_permalink();?>" style="display:block;">
                                <figure>
                                    <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium');?>">
                                </figure>
                            </a>
                            <a href="javascript:void(0)" class="fav-out pract" data-id="<?=get_the_ID(); ?>" onclick="$(this).parent().parent().toggleClass('is-favorite');"><i class="fas fa-heart"></i> В избранное</a>
                            <a href="javascript:void(0)" class="fav-in pract" data-id="<?=get_the_ID(); ?>" onclick="$(this).parent().parent().toggleClass('is-favorite');"><i class="fas fa-heart"></i> В избранном</a>
                            <a href="<?=get_permalink();?>"><h2><?=get_field('kratkoe_nazvanie', get_the_ID()); ?></h2></a>
                        </div>
                    </div>
                    <? } ?>
                </div>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <?=get_the_posts_pagination(['prev_text' => '<', 'next_text' => '>']);?>
            </div>
        </div>
    </div>
</section>
<? get_footer(); ?>