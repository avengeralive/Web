<?
/*
Template name: Галерея
*/
?>
<? get_header(); ?>
		<? the_post(); ?>
		<div class="cr-breadcrumb-area" style="background-image: url(<? echo get_field('обложка', get_the_ID()); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <div class="container">
                <div class="cr-breadcrumb text-center">
                    <h1><? the_title(); ?></h1>
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><? the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--// Breadcrumb Area -->

        <!-- Page Content -->
        <main id="page-content">
			<section class="cr-section portfolio-area bg-white section-padding-md">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10 col-12">
							<div class="section-title text-center">
								<h2>Фотогалерея</h2>
							</div>
						</div>
					</div>
					<div class="row justify-content-center portfolios portfolio-popup-gallery-active">
						<?
			        		$galleries = get_posts(array('post_type' => 'gallery', 'limit' => 8 ));
			        		foreach ($galleries as $album) {
			        	?>
			        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="<? echo $album->guid; ?>" class="portfolio1">
								<div class="portfolio-thumb">
									<img src="<? echo get_the_post_thumbnail_url($album->ID, 'full'); ?>" alt="portfolio thumb 1">
								</div>
								<div class="portfolio-content">
									<h6><? echo $album->post_title; ?></h6>
								</div>
							</a>
						</div>
						<? } ?>
					</div>
				</div>
			</section>
		 </main>
<? get_footer(); ?>