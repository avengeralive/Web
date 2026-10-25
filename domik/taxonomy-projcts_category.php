<? get_header(); ?>
<div class="" id="wrapper" style="opacity: 1;">
    <div class="content-holder elem transition3">
        <div class="content mm" style="padding-top: 71px;">
            <div class="wrapper-inner no-padding full-width-wrap" style="opacity: 1;">
                <section class="no-padding no-border folio-grid-folios-wrap"> 
                    <div class="gallery-items three-coulms hid-port-info grid-none-pad">
                        <div class="grid-sizer"></div>
                        <? 
                        global $wp;
                        $category_id = get_term_by('slug', $wp->query_vars['projcts_category'], 'projcts_category');
                        $loop = new WP_Query( array(
                            'post_type' => 'projcts',
                            'orderby'=> 'date',
                            'order'=> 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'projcts_category',
                                        'field'    => 'id',
                                        'terms'    => $category_id->term_id,
                                    ),
                                )
                            ) );
                        $key = 0;
                        while ($loop->have_posts()) : $loop->the_post();
                            $img_full = get_the_post_thumbnail_url();
                            $img_large = get_the_post_thumbnail_url('large');
                            $img_thumb = get_the_post_thumbnail_url('post-thumbnail');
                        ?>
                        <div class="gallery-item gallery-item-<? if ($key %12 == 0 || $key % 12 == 7) echo "two"; else echo "one"; ?> portfolio type-portfolio has-post-thumbnail">
                            <div class="grid-item-holder">
                                <div class="box-item bi2">
                                    <a href="<? echo get_the_permalink(); ?>" class="ajax">
                                        <span class="overlay"></span> 
                                        <img width="1000" height="605" src="<? echo $img_thumb; ?>" class="attachment-folio-size-one size-folio-size-one wp-post-image" alt="" srcset="<? echo $img_full; ?> 1000w, <? echo $img_thumb; ?> 300w, <? echo $img_large; ?> 768w" sizes="(max-width: 1000px) 100vw, 1000px">            </a>
                                </div>
                                <div class="grid-item ">
                                    <h3><a href="<? echo get_the_permalink(); ?>" class="ajax portfolio-link"><?php the_title(); ?></a></h3>
                                    <span class="folio-cats"><a class="folio-cat-link ajax" href="<? get_term_link($category_id->term_id); ?>"><? echo $category_id->name; ?></a></span>
                                </div>
                            </div>
                        </div>
                        <? $key++; endwhile; ?>
                    </div>
                </section>
            </div>
        </div>
    </div><!-- end .content-holder.elem.scale-bg2.transition3 -->
</div>


<!-- FOOTER -->

</div> <!-- End #main -->
        <script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}}};
/* ]]> */
</script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.7'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-includes/js/comment-reply.min.js?ver=4.7.10'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/themes/domik/js/plugins.js'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/themes/domik/js/core.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var domik_obj = {"rtl":"","disable_ajax":"0","nf_tit":"<h2>404<\/h2><br>page not found","nf_msg":"Sorry, but the page you are looking for has not been found.","nf_linktext":"Back to the last page","nf_bg":"http:\/\/demowp.cththemes.com\/domik\/wp-content\/themes\/domik\/images\/bg\/long\/7.jpg"};
/* ]]> */
</script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/themes/domik/js/scripts.js'></script>
<script type='text/javascript' src='https://maps.google.com/maps/api/js?key=AIzaSyChCXNJOoVajjJ1KvF3g0kq63yb5KQLPMA'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/themes/domik/js/domik_gmap.js'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=5.1'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/plugins/js_composer/assets/lib/vc_accordion/vc-accordion.min.js'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/plugins/js_composer/assets/lib/vc-tta-autoplay/vc-tta-autoplay.min.js'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/plugins/js_composer/assets/lib/vc_tabs/vc-tabs.min.js'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-content/plugins/js_composer/assets/lib/prettyphoto/js/jquery.prettyPhoto.min.js?ver=5.1'></script>
<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-includes/js/wp-embed.min.js?ver=4.7.10'></script>
    </body>
</html>