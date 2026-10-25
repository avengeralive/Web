<?
/*
Template name: Отзывы
*/
?>
<? get_header(); ?>
		<? the_post(); ?>
        <!-- Breadcrumb Area -->
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

			<!-- Events Area -->
			<section class="cr-section events-area bg-white section-padding-md" data-black-overlay="2">
				<div class="container">
					<div class="row mt-3">
						<div class="col-lg-12">
							<div class="tab-content" id="upcoming-events-ontent">
								<div class="events-wrap tab-pane fade show active" id="upcoming-eventlist-1" role="tabpanel" aria-labelledby="upcoming-eventlist-1-tab">
									<div class="event-single mb-30">
										<div class="event-thumb">
										</div>
										<div class="event-content">
											<p><? the_content(); ?></p>
										</div>
									</div>
								</div>

								<div class="events-wrap tab-pane fade show active" id="upcoming-eventlist-1" role="tabpanel" aria-labelledby="upcoming-eventlist-1-tab">
									<?
						        		$reviews = get_posts(array('post_type' => 'reviews', 'lang' => pll_current_language()));
						        		foreach ($reviews as $review) {
						        	?>
									<a href="#" class="event-single">
										<div class="event-thumb">
											
										</div>
										<div class="event-content">
											<h4><? echo $review->post_title; ?></h4>
											<? echo $review->post_content; ?>
										</div>
									</a>
									<? } ?>
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>
			<!--// Events Area -->

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>