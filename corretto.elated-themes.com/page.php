<? 
get_header();

while (have_posts()) {
	the_post();
?>
<div class="eltdf-content" style="margin-top: -100px">
	<div class="eltdf-content-inner">
		<div class="eltdf-title-holder eltdf-centered-type eltdf-title-va-window-top eltdf-title-content-va-middle eltdf-preload-background eltdf-has-bg-image eltdf-bg-parallax" style="height: 480px;background-image:url(http://corretto.elated-themes.com/wp-content/uploads/2018/04/p3-title-img-1.jpg) !important;" data-height="480">
			<div class="eltdf-title-image">
				<img itemprop="image" src="http://corretto.elated-themes.com/wp-content/uploads/2018/04/p3-title-img-1.jpg" alt="a" />
			</div>
			<div class="eltdf-title-wrapper" >
				<div class="eltdf-title-inner">
					<div class="eltdf-grid" >
						<h1 class="eltdf-page-title entry-title" ><? the_title(); ?></h1>
					</div>
	    		</div>
			</div>
		</div>
		<div class="eltdf-full-width">
    		<div class="eltdf-full-width-inner" style="padding-bottom: 0px; padding-top: 50px;">
        		<div class="eltdf-grid-row">
					<div class="eltdf-page-content-holder eltdf-grid-col-12">
						<div class="eltdf-row-grid-section-wrapper "  >
							<div class="eltdf-row-grid-section">
<?
	the_content();
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?
}
get_footer(); 
?>