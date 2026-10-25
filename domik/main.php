<? 
/*
Template name: Main page
*/
get_header(); ?>
<div id="wrapper">
    <div id="ajax-page-inline-div-css" class="no-dis" type="text/css">.vc_custom_1491408332063{margin-right: 0px !important;margin-left: 0px !important;}.vc_custom_1448424139671{padding-right: 0px !important;padding-left: 0px !important;}</div>
    <div class="content-holder elem scale-bg2 transition3">
        <div class="content full-height">
            <div class='no-vc-margin home-full-height vc_custom_1491408332063'>    
                <div class="row wpb_row">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner vc_custom_1448424139671">
                            <div class="wpb_wrapper">
                                <div class="horizontal-slider-holder full-height">
                                    <div class="swiper-container  horizontal-slider" id="horizontal-slider" data-mws="1200"  data-mwd="horizontal" data-mwc="1" data-mwl="1">
                                        <div class="swiper-wrapper">
                                            <? 
                                            $terms = get_terms( array(
                                                'taxonomy' => 'projcts_category',
                                                'hide_empty'=> false,
                                                'orderby'=>'term_taxonomy_id',
                                                'order'=>'ASC'
                                            ) ); 
                                            foreach ($terms as $key => $term) { 
                                                $meta_image = get_wp_term_image($term->term_taxonomy_id);
                                                $x = get_all_wp_terms_meta($term->term_taxonomy_id);
                                            ?>
                                            <div class="swiper-slide ">
                                                <div class="bg" style="background-image:url(<? echo $meta_image; ?>);"></div>
                                                <div class="overlay" style="opacity:0.2;"></div>
                                                <div class="slide-title-holder">
                                                    <div class="slide-title">
                                                        <h3 class="transition">  
                                                            <a class="ajax transition2" href="<? echo $x["link"][0]; ?>">
                                                                <? echo $term->name; ?>
                                                            </a>
                                                        </h3>
                                                        <h4><? echo $term->description; ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <? } ?>
                                        </div>
                                        <div class="swiper-nav-holder hor">
                                            <a class="swiper-nav arrow-left transition" href="#"><i class="fa fa-long-arrow-left"></i></a>
                                            <a class="swiper-nav  arrow-right transition" href="#"><i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="clearfix"></div>
        </div>
    </div><!-- end .content-holder.elem.scale-bg2.transition3 -->
</div><!-- end #wrapper -->


<!-- FOOTER -->

</div> <!-- End #main -->
        <script type='text/javascript' src='/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}}};
/* ]]> */
</script>
<script type='text/javascript' src='/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.7'></script>
<script type='text/javascript' src='/wp-includes/js/comment-reply.min.js?ver=4.7.10'></script>
<script type='text/javascript' src='/wp-content/themes/domik/js/plugins.js'></script>
<script type='text/javascript' src='/wp-content/themes/domik/js/core.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var domik_obj = {"rtl":"","disable_ajax":"0","nf_tit":"<h2>404<\/h2><br>page not found","nf_msg":"Sorry, but the page you are looking for has not been found.","nf_linktext":"Back to the last page","nf_bg":"http:\/\/demowp.cththemes.com\/domik\/wp-content\/themes\/domik\/images\/bg\/long\/7.jpg"};
/* ]]> */
</script>
<script type='text/javascript' src='/wp-content/themes/domik/js/scripts.js'></script>
<script type='text/javascript' src='https://maps.google.com/maps/api/js?key=AIzaSyChCXNJOoVajjJ1KvF3g0kq63yb5KQLPMA'></script>
<script type='text/javascript' src='/wp-content/themes/domik/js/domik_gmap.js'></script>
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=5.1'></script>
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/vc_accordion/vc-accordion.min.js'></script>
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/vc-tta-autoplay/vc-tta-autoplay.min.js'></script>
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/vc_tabs/vc-tabs.min.js'></script>
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/prettyphoto/js/jquery.prettyPhoto.min.js?ver=5.1'></script>
<script type='text/javascript' src='/wp-includes/js/wp-embed.min.js?ver=4.7.10'></script>
    </body>
</html>