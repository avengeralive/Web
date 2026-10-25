<? 
get_header(); 
the_post();
$product = new WC_Product(get_the_ID());
$product_id = get_the_ID();
$product_variable = new WC_Product_Variable(get_the_ID());
$price = $product->get_price();
$variations = $product_variable->get_available_variations();
$gallery = $product->get_gallery_image_ids();
$cart = WC()->cart->get_cart();
function is_variation_cart($variation_id) {
    $cart = WC()->cart->get_cart();
    foreach ($cart as $item) if ($item["variation_id"] == $variation_id) return 1;
    return 0;
}

?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-lg-5 imageblock">
                        <div class="zoom">
                            <img class="main-image" src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full');?>" alt="<?=get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);?>">
                        </div>
                        <div class="owl-carousel img-carousel">
                            <!--<div class="imgitem"><img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" data-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?=get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);?>"></div>-->
                        <? foreach ($gallery as $img) { ?>
                            <div class="imgitem">
                                <img src="<?=wp_get_attachment_image_url($img); ?>" data-src="<?=wp_get_attachment_image_url($img, 'full'); ?>" alt="<?=get_post_meta($img, '_wp_attachment_image_alt', TRUE);?>">
                            </div>
                        <? } ?>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-12 o1 <? if (in_array(get_the_ID(), explode(",", $_COOKIE['fav']))) { ?>is-favorite<? }?>">
                                <h1><? the_title(); ?></h1>
                                <p class="favs"><a href="javascript:void(0)" class="fav-out" data-id="<?=get_the_ID();?>"><i class="far fa-heart"></i> В избранное</a><a href="javascript:void(0)" class="fav-in" data-id="<?=get_the_ID();?>"><i class="fas fa-heart"></i> В избранном</a></p>
                            </div>
                            <div class="col-12 o2 imageblock mob">
                                <img class="main-image" src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full');?>" alt="<?=get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);?>">
                                <div class="owl-carousel img-carousel">
                                    <!--<div class="imgitem"><img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" data-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full');?>" alt="<?=get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);?>"></div>-->
                                <? foreach ($gallery as $img) { ?>
                                    <div class="imgitem">
                                        <img src="<?=wp_get_attachment_image_url($img); ?>" data-src="<?=wp_get_attachment_image_url($img, 'full'); ?>" alt="<?=get_post_meta($img, '_wp_attachment_image_alt', TRUE);?>">
                                    </div>
                                <? } ?>
                                <? foreach (get_field('videogalereya', get_the_ID()) as $vid) { ?>
                                    <div class="viditem">
                                        <?=$vid['video']; ?>
                                    </div>
                                <? } ?>
                                </div>
                            </div>
                            <div class="col-12 o4">
                                <form class="variations_form" action="" method="post" enctype="multipart/form-data">
                                    <table class="variations">
                                        <tr>
                                            <th>Цена</th>
                                            <th>Металл и камни</th>
                                        </tr>
                                        <? foreach ($variations as $key => $variation) { ?>
                                        <tr>
                                            <td><input type="radio" name="variation_id" data-id="<?=$key+1;?>" data-cart="<?=is_variation_cart($variation['variation_id']); ?>" value="<?=$variation['variation_id'];?>" <? if ($key == 0) { ?>checked<? } ?>> <? if ($variation['display_price'] == 0) echo "По запросу"; else echo $variation['display_price']."&nbsp;<span class=\"woocommerce-Price-currencySymbol\">₽</span>"; ?></td>
                                            <td><?=str_replace('+', ' + ', get_term_by('slug', $variation['attributes']['attribute_pa_ispolnenie'], 'pa_ispolnenie')->name); ?></td>
                                        </tr>
                                        <? } ?>
                                    </table>
                                    <p class="action_buttons">
                                        <input type="hidden" class="input-text qty text" value="1" title="Кол-во" size="4" placeholder="" inputmode="numeric">
                                        <input type="hidden" name="add-to-cart" value="<?=get_the_ID();?>">
                                        <input type="hidden" name="product_id" value="<?=get_the_ID();?>">
                                        <button type="submit" name="add-to-cart" value="<?=get_the_ID();?>" class="cartbtn cart<?=is_variation_cart($variations[0]['variation_id'])?>"><span class="cart0">Купить</span><span class="cart1">В корзине</span></button>
                                        <button type="button" data-toggle="modal" data-target="#svaz">Связаться с продавцом</button>
                                        <a href="https://api.whatsapp.com/send?phone=79252420540&text=&source=&data=&app_absent=" class="whatsappcall">Написать в WhatsApp</a>
                                    </p>
                                </form>
                                <h3>Характеристики <img src="<?=get_template_directory_uri();?>/images/chevron_right.svg" class="trns90"></h3>
                                <? foreach ($variations as $key => $variation) { ?>
                                <table class="attributes attr<?=$key+1;?> <? if ($key == 0) { ?>active<? } ?>">
                                    <tr>
                                        <td>Артикул</td>
                                        <td><?=$variation['sku'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Металл</td>
                                        <td><?=get_term_by('slug', $variation['attributes']['attribute_pa_metall'], 'pa_metall')->name;?></td>
                                    </tr>
                                    <tr>
                                        <td>Вставки</td>
                                        <td><?=str_replace(';', ',', get_term_by('slug', $variation['attributes']['attribute_pa_vstavki'], 'pa_vstavki')->name);?></td>
                                    </tr>
                                </table>
                                <? } ?>
                                <ul class="socials">
                                    <li><a target="_blank" href="https://www.instagram.com/velvetin/"><img src="<?=get_template_directory_uri();?>/images/s1.svg"></a></li>
                                    <li><a target="_blank" href="https://www.facebook.com/VelvetinJewellery/"><img src="<?=get_template_directory_uri();?>/images/s2.svg"></a></li>
                                    <li><a target="_blank" href="https://vk.com/velvetin"><img src="<?=get_template_directory_uri();?>/images/s3.svg"></a></li>
                                    <li><a target="_blank" href="https://api.whatsapp.com/send?phone=79252420540&text=&source=&data=&app_absent="><img src="<?=get_template_directory_uri();?>/images/s4.svg"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row general-info">
                    <? $infos = get_field('informacziya_o_produktah', 225); ?>
                    <? foreach ($infos as $info) { ?>
                    <div class="col-lg-4">
                        <h3><?=$info['zagolovok']?> <img src="http://velvetin.veliyev.ru/wp-content/themes/velvetin/images/chevron_right.svg" class="trns90"></h3>
                        <article>
                            <?=$info['tekst']?>
                        </article>
                        <figure>
                            <img src="<?=$info['kartinka']?>" style="width:100%;">
                        </figure>
                    </div>
                    <? } ?>
                </div>
                <div class="row photoreview" data-col="<?=get_the_terms($product_id, 'product_col')[0]->term_id;?>" data-cat="<?=get_the_terms($product_id, 'product_cat')[0]->term_id;?>">
                    <div class="col-12 text-center">
                        <h2>Фото и видео отзывы наших клиентов</h2>
                    </div>
                    <? $posts = get_posts(['post_type' => 'reviews', 'numberposts' => 12, 'order' => 'asc', 'meta_query'	=> array(
            'relation'		=> 'OR',
            array(
                'key'	 	=> 'kategoriya',
                'value'	  	=> get_the_terms($product_id, 'product_cat')[0]->term_id,
                'compare' 	=> '=',
            ),
            array(
                'key'	  	=> 'kollekcziya',
                'value'	  	=> get_the_terms($product_id, 'product_col')[0]->term_id,
                'compare' 	=> '=',
            ),
        )]); 
		            foreach ($posts as $post) {?>
                    <div class="col-4">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#card<?=$post->ID;?>">
                            <? if (!get_the_post_thumbnail_url($post->ID, 'full')) { ?>
                            <figure>
                                <img src="/wp-content/uploads/woocommerce-placeholder.png">
                            </figure>    
                            <? } else { ?>
                            <figure>
                                <img src="<?=get_the_post_thumbnail_url($post->ID, 'full');?>">
                            </figure>
                            <? } ?>
                        </a>
                        <div class="modal fade" id="card<?=$post->ID;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <img src="<?=get_template_directory_uri();?>/images/close.svg">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="product">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <? if (get_field('video', $post->ID) == "") { ?>
                                                    <figure>
                                                        <img src="<?=get_the_post_thumbnail_url($post->ID, 'full');?>">
                                                    </figure>
                                                    <a href="<?=get_field('ssylka_na_tovar', $post->ID); ?>" style="display:inline-block;"><h2 style="text-decoration: underline;">Подробнее об этом изделии</h2></a>
                                                    <? } else { ?>
                                                    <figure>
                                                        <iframe src="<?=explode('/view', get_field('video', $post->ID))[0]; ?>/preview" width="640" height="480"></iframe>
                                                    </figure>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="#" class="more" data="12">Показать ещё</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-1"></div>
        </div>
    </div>
</section>
<? if (isset($_POST['add-to-cart'])) { ?>
<div class="modal fade" id="incart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Изделие добавлено в корзину</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?=get_template_directory_uri();?>/images/close.svg">
                </button>
            </div>
            <div class="modal-body">
                <div class="product">
                    <div class="row">
                        <div class="col-md-6">
                            <figure>
                                <img src="<?=get_the_post_thumbnail_url($product_id, 'medium-large');?>">
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <h2><?=get_field('kratkoe_nazvanie', $product_id); ?></h2>
                            <? foreach ($variations as $key => $variation) {y ?>
                            <? if ($variation['variation_id'] == $_POST['variation_id']) { ?>
                            <p><?=wc_get_product_category_list($product_id); ?></p>
                            <p>Арт. <?=$variation['sku'];?></p>
                            <p><? if ($variation['display_price'] == 0) echo "По запросу"; else echo $variation['display_price']."&nbsp;<span class=\"woocommerce-Price-currencySymbol\">₽</span>"; ?></p>
                            <? } ?>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Продолжить покупки</button>
                <a href="/cart" class="btn btn-primary">Перейти в корзину</a>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#incart").modal("show");
});
</script>
<? } ?>
<div class="modal fade" id="svaz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Связаться с продавцом</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?=get_template_directory_uri();?>/images/close.svg">
                </button>
            </div>
            <div class="modal-body">
                <div class="product">
                    <div class="row">
                        <div class="col-md-6">
                            <?=do_shortcode('[contact-form-7 id="118" title="Связаться с продавцом"]');?>
                        </div>
                        <div class="col-md-6 text-center">
                            <figure>
                                <img src="<?=get_the_post_thumbnail_url($product_id, 'medium-large');?>">
                            </figure>
                            <h2><?=get_field('kratkoe_nazvanie', get_the_ID()); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? get_footer(); ?>