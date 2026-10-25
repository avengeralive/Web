
<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
	IncludeTemplateLangFile(__FILE__);
?>
	</div>
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		Array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "inc-bottom",
			"EDIT_TEMPLATE" => ""
		),
		Array(
		"ACTIVE_COMPONENT" => "Y",
		"HIDE_ICONS" => "Y"
		)
	);?>
    <!--=== End Content ===-->

    <!--=== Footer Version 1 ===-->
    <div class="footer-v1">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-3 md-margin-bottom-40 wow fadeIn">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/logo-footer.php",
							Array(),
							Array("MODE"=>"html")
						);?>
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/about.php",
							Array(),
							Array("MODE"=>"html")
						);?>
                    </div><!--/col-md-3-->
                    <!-- End About -->

                    <!-- Latest -->
                    <div class="col-md-3 md-margin-bottom-40 wow fadeIn">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", 
							"", 
							array(
								"AREA_FILE_SHOW" => "file", 
								"PATH" => SITE_DIR."include/menu-footer.php"
							), 
							false
						);?>                        
                    </div><!--/col-md-3-->  
                    <!-- End Latest --> 
                    
                    <!-- Link List -->
                    <div class="col-md-3 md-margin-bottom-40 wow fadeIn">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", 
							"", 
							array(
								"AREA_FILE_SHOW" => "file", 
								"PATH" => SITE_DIR."include/news-footer.php"
							), 
							false
						);?>
                    </div><!--/col-md-3-->
                    <!-- End Link List -->                    

                    <!-- Address -->
                    <div class="col-md-3 map-img md-margin-bottom-40 wow fadeIn">
					
                        <div class="headline"><h2>
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/address_head.php",
							Array(),
							Array("MODE"=>"text")
						);?>
						</h2></div>
						<address class="md-margin-bottom-40">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/address.php",
							Array(),
							Array("MODE"=>"html")
						);?>
                        </address>
                    </div><!--/col-md-3-->
                    <!-- End Address -->
                </div>
            </div> 
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">                     
                        <p>
							<?$APPLICATION->IncludeFile(
								SITE_DIR."include/copyright.php",
								Array(),
								Array("MODE"=>"text")
							);?>							
                           <?/*<a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>*/?>
                        </p>
                    </div>

                    <!-- Social Links -->
                    <div class="col-sm-6">
						<div id="bx-composite-banner" class="pull-left visible-md-inline visible-lg-inline" style="margin-top: 9px;"></div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/social.php",
								"EDIT_TEMPLATE" => ""
							),
							false,
							Array("HIDE_ICONS" => "Y")
						);?>

                    </div>
                    <!-- End Social Links -->
                </div>
            </div> 
        </div><!--/copyright-->
    </div>
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/jquery/jquery.min.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/jquery/jquery-migrate.min.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/bootstrap/js/bootstrap.min.js', true)?>"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/back-to-top.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/smoothScroll.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/jquery.parallax.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/fancybox/source/jquery.fancybox.pack.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js', true)?>"></script>
<!-- JS Customization -->
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/js/custom.js', true)?>"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/js/app.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/js/plugins/revolution-slider.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/js/plugins/cube-portfolio/cube-portfolio-2.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/js/plugins/owl-carousel.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/js/plugins/fancy-box.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/image-hover/js/modernizr.js', true)?>"></script>
<script type="text/javascript" src="<?//=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/image-hover/js/touch.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/js/plugins/style-switcher.js', true)?>"></script>   


<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/jquery.sticky-kit.min.js', true)?>"></script>
<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/script.js', true)?>"></script>


<script type="text/javascript">
	jQuery(document).ready(function() {
		App.init();
		OwlCarousel.initOwlCarousel();
		FancyBox.initFancybox();
		RevolutionSlider.initRSfullWidth();
		StyleSwitcher.initStyleSwitcher();
			
			$(".various").fancybox({
				maxWidth	: 700,
				maxHeight	: 650,
				autoSize	: true,
				/*maxWidth	: 600,
				maxHeight	: 450,
				minWidth	: 260,
				minHeight	: 450,
				fitToView	: false,
				width		: '100%',
				height		: '100%',
				autoSize	: true,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'*/
			});
	});
	$(window).on('load', function () {
		var $preloader = $('#page-preloader'),
			$spinner   = $preloader.find('.spinner0');
		$spinner.fadeOut(50).fadeOut(100);
		$preloader.delay(100).fadeOut(300);
	});
</script>
<!--[if lt IE 9]>
	<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/respond.js', true)?>"></script>
	<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/html5shiv.js', true)?>"></script>
	<script type="text/javascript" src="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH . '/assets/plugins/placeholder-IE-fixes.js', true)?>"></script>
<![endif]-->
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+79231102112", // WhatsApp number
            call_to_action: "Евгений", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<style type="text/css">
	#wh-widget-send-button { bottom: 25px !important; }
</style>
<!-- /WhatsHelp.io widget -->
</body>
</html>