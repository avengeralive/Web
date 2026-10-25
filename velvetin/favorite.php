<? 
/* Template name: Favorite */
get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-xl-2"></div>
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="row">
                    <? if (get_fav_count()) { 
                    $favs = explode(',', $_COOKIE['fav']);
                    foreach ($favs as $fav) { ?>
                    <div class="col-lg-4 col-6">
                        <div class="product-item is-favorite">
                            <a href="<?=get_permalink($fav);?>" style="display:block;">
                                <figure>
                                    <img src="<?=get_the_post_thumbnail_url($fav, 'medium-large');?>">
                                </figure>
                            </a>
                            <a href="javascript:void(0)" class="fav-out pract" data-id="<?=$fav; ?>"><i class="far fa-heart"></i> В избранное</a>
                            <a href="javascript:void(0)" class="fav-in pract" data-id="<?=$fav; ?>"><i class="fas fa-heart"></i> В избранном</a>
                            <a href="<?=get_permalink($fav);?>"><h2><?=get_field('kratkoe_nazvanie', $fav); ?></h2></a>
                        </div>
                    </div>
                    <? } } ?>
                </div>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>