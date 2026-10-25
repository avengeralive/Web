<?
/*
Template name: Информационная поддержка
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

			<section class="cr-section brand-logos-area section-padding-md bg-white">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-9 col-md-10 col-12">
							<div class="section-title section-title-2 text-center">
								<? the_content(); ?>
							</div>
						</div>
					</div>
					<div class="brand-logos">
						<?
						    $info = get_posts(array('post_type' => 'info' ));
						   	foreach ($info as $inf) {
						?>
						<a href="#" class="brand-logo">
							<img src="<? echo get_the_post_thumbnail_url($inf->ID, 'full'); ?>" alt="brand logo" style="height: 80px; width: auto;">
						</a>
						<? } ?>
					</div>
				</div>
			</section>

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>