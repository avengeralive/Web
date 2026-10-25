<? get_header(); ?>
		<? the_post(); ?>
		<div class="cr-breadcrumb-area" style="background-image: url(<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
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
								<h2><? the_title(); ?></h2>
							</div>
						</div>
					</div>
					<div class="row justify-content-center portfolios portfolio-popup-gallery-active">
						<?
							$gallery = get_post_gallery_images( $wp_query->queried_object->ID );
							foreach ($gallery as $key=>$img) {
						?>
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="<? echo $img; ?>" class="portfolio">
								<div class="portfolio-thumb">
									<img src="<? echo $img; ?>" alt="portfolio thumb 1">
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