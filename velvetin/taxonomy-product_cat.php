<? 
get_header();
$childrens = get_term_children(get_queried_object()->term_id, 'product_cat');

$attributes = wc_get_attribute_taxonomies();
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1><?=get_queried_object()->name;?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-xl-2"></div>
            <div class="col-lg-10 col-xl-8">
                <div class="row toolbar">   
                    <div class="col-lg-12 text-center">
                        <ul class="subcats">
                            <? foreach ($childrens as $children) { ?>
                            <li><a href="<?=get_term_link($children);?>"><?=get_term($children)->name;?></a></li>
                            <? } ?>
                        </ul>
                    </div>
                    <!--<div class="filters">
                        <a class="filters-close"><img src="<?=get_template_directory_uri();?>/images/close.svg"></a>
                        <? foreach ($attributes as $attribute) { 
                            $tax = wc_attribute_taxonomy_name($attribute->attribute_label);
                            $terms = get_terms(['taxonomy' => $tax, 'hide_empty' => false]); ?>
                        <p class="attr_swipe active" data="<?=$attribute->attribute_id?>"><a href="#"><?=$attribute->attribute_label; ?> <i class="fas fa-chevron-up"></i><i class="fas fa-chevron-down"></i></a></p>
                        <div class="filter_item_box active item<?=$attribute->attribute_id?>">
                            <div class="row">
                        <? foreach ($terms as $term) { ?>
                                <div class="col-md-6 col-lg-3">
                                    <p><input type="checkbox" value="<?=$term->term_id;?>">&nbsp;<?=$term->name;?></p>
                                </div>
                        <? } ?>
                            </div>
                        </div>
                        <? } ?>
                        <div class="actionbtns">
                            <a href="#" class="reset">Очистить</a>
                            <a href="#" class="accept">Применить</a>
                        </div>
                    </div>-->
                </div>
                <div class="row">
                    <? while (have_posts()) { the_post(); ?>
                    <div class="col-lg-4 col-6">
                        <div class="product-item <? if (in_array(get_the_ID(), explode(",", $_COOKIE['fav']))) { ?>is-favorite<? }?>">
                            <a href="<?=get_permalink();?>" style="display:block;">
                                <figure>
                                    <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium-large');?>">
                                </figure>
                            </a>
                            <a href="javascript:void(0)" class="fav-out pract" data-id="<?=get_the_ID(); ?>"><i class="far fa-heart"></i> В избранное</a>
                            <a href="javascript:void(0)" class="fav-in pract" data-id="<?=get_the_ID(); ?>"><i class="fas fa-heart"></i> В избранном</a>
                            <a href="<?=get_permalink();?>"><h2><?=get_field('kratkoe_nazvanie', get_the_ID()); ?></h2></a>
                        </div>
                    </div>
                    <? } ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?=get_the_posts_pagination(['prev_text' => '<', 'next_text' => '>']);?>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>