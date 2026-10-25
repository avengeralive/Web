<? 
get_header(); ?>

<div class="" id="wrapper" style="opacity: 1;">
	<div class="content-holder elem transition3">                    
		<div class="content">
            <div class="bg-animate" style="opacity: 0.6;">
            	<img src="/wp-content/themes/domik/images/body-bg.png" width="1053" height="1053" class="respimg" alt="rotate background">
           	</div>
    		<div class="wrapper-inner" style="opacity: 1;">
                <section class="no-padding no-border">
    				<div class="domik_container">
    					<? the_post(); ?>
        				<div class="page-title">
		            		<h1 class="title"><? the_title(); ?></h1>  
		        		</div>
    				</div>
				</section>
				<div class="clearfix"></div>
				<div class="domik_container domik-blog-single">
					<section>
	    				<div class="row">
	    					<div class="col-md-12 nosidebar post-content-column">
								<article class="cth-single sinnle-post post-782 post type-post status-publish format-gallery has-post-thumbnail hentry category-lllustrator category-marketing tag-seo tag-video tag-web post_format-post-format-gallery">
						            <div class="blog-media">
										<div class="gallery-itemss three-coulms grid-small-pad popup-gallery" style="position: relative; height: 176.797px;">
											<div class="grid-sizers"></div>
					    					<?
                                                    $gallery = get_post_gallery(get_the_ID(), false)["ids"];
                                                    $gallery = explode(',', $gallery);
                                                    foreach ($gallery as $img) {
                                                        $img_full = wp_get_attachment_image_src($img, 'full')[0];
                                                        $img_thumb = wp_get_attachment_image_src($img, 'medium')[0];
                                                ?>
                                                <div class="gallery-item " style="position: absolute; left: 0%; top: 0px;">
                                                    <div class="grid-item-holder">
                                                        <div class="box-item">
                                                            <a href="<? echo $img_full; ?>" title="1">
                                                            <span class="overlay"></span> 
                                                            <img width="1000" height="605" src="<? echo $img_thumb; ?>" class="respimg" alt="" srcset="<? echo $img_thumb; ?> 1000w, <? echo $img_thumb; ?> 300w, <? echo $img_thumb; ?> 768w" sizes="(max-width: 1000px) 100vw, 1000px">                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <? } ?>
					    				</div>
					    			</div>
													        		            <div class="blog-text">
		                <? the_content(); ?>
		                		            </div>
		        </article>


		    </div>
		    
	    </div><!-- end .row -->
        
    </section>

    		        <!-- post end -->
	    

	    <? comments_template(); ?>



</div>

  
      </div><!-- end .wrapper-inner-->
    <!-- parallax column  - global  -->
    <div class="img-wrap hide_with_full">
        <div class="bg skrollable skrollable-between" style="background-image: url(&quot;http://demowp.cththemes.com/domik/wp-content/themes/domik/images/bg/long/7.jpg&quot;); transform: translateY(-0.153767px);" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
    <div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div></div>
        <div class="to-top">
        <i class="fa fa-long-arrow-up"></i>    </div>
    <div class="height-emulator" style="height: 266px;"></div>
    <footer class="domik-footer" style="opacity: 1;">
        <div class="footer-inner">
            <div class="row">
    <div class="col-md-5">
        <a class="footer-logo ajax" href="http://demowp.cththemes.com/domik/"><img width="99" height="30" src="http://demowp.cththemes.com/domik/wp-content/themes/domik/images/footer-logo.png" alt="domik"></a>
    </div>
    <div class="col-md-3">
        <div class="footer-adress">
            <span>USA 27TH BROOKLYN NY</span>
            <a href="#" target="_blank">View on map</a>
        </div>
    </div>
    <div class="col-md-4">
        <ul class="footer-contact">
            <li>+7(111)123456789</li>
            <li><a href="#">yourmail@domain.com</a></li>
        </ul>
    </div>
</div>            <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-7">
        <p>© Domik 2017. All rights reserved.</p>
    </div>
</div>        </div>
        <span class="footer-decor"></span>
    </footer>

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