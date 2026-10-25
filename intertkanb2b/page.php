<?
/*
Template name: Контакты
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
			
			<!-- Contact Page -->
			<section class="contact-page-top-area bg-white section-padding-sm">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10 col-12">
							<div class="section-title section-title-3 text-center">
								<p><? the_content(); ?></p>
							</div>
						</div>
					</div>

				</div>
			</section>
			<!--// Contact Page -->

			<!-- Contact Page Form -->
			<!--<section class="contact-page-bottom-area bg-grey section-padding-sm">
				<div class="container">
					<? if (pll_current_language() == 'ru') { ?>
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10 col-12">
							<div class="section-title section-title-3 text-center">
								<h2>ОСТАВИТЬ ОТЗЫВ</h2>
							</div>
						</div>
					</div>
					<form action="/wp-admin/admin-post.php" method="post" id="contact-form" class="contact-page-form">
						<div class="row">
							<input type="hidden" action="saverev">
							<div class="col-lg-6 col-md-6 col-12 mt-30">
								<input type="text" name="name" placeholder="Имя">
							</div>
							<div class="col-lg-6 col-md-6 col-12 mt-30">
								<input type="email" name="email" placeholder="E-mail">
							</div>
							<div class="col-12 mt-30">
								<input type="text" name="subject" placeholder="Тема">
							</div>
							<div class="col-lg-12 col-12 mt-30">
								<textarea name="message" cols="30" rows="7" placeholder="Письмо"></textarea>
							</div>
							<div class="col-lg-12 col-12 mt-30 text-center">
								<button type="submit" class="cr-btn mt-30">
									<span>Отправить сообщение <i class="fa fa-angle-right"></i></span>
								</button>
							</div>
						</div>
					</form>
					<? } else { ?>
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10 col-12">
							<div class="section-title section-title-3 text-center">
								<h2>Leave Review</h2>
							</div>
						</div>
					</div>
					<form action="/wp-admin/admin-post.php" method="post" id="contact-form" class="contact-page-form">
						<div class="row">
							<input type="hidden" action="saverev">
							<div class="col-lg-6 col-md-6 col-12 mt-30">
								<input type="text" name="name" placeholder="Name">
							</div>
							<div class="col-lg-6 col-md-6 col-12 mt-30">
								<input type="email" name="email" placeholder="E-mail">
							</div>
							<div class="col-12 mt-30">
								<input type="text" name="subject" placeholder="Subject">
							</div>
							<div class="col-lg-12 col-12 mt-30">
								<textarea name="message" cols="30" rows="7" placeholder="Message"></textarea>
							</div>
							<div class="col-lg-12 col-12 mt-30 text-center">
								<button type="submit" class="cr-btn mt-30">
									<span>Leave message <i class="fa fa-angle-right"></i></span>
								</button>
							</div>
						</div>
					</form>
					<? } ?>
					<p class="form-message"></p>
				</div>
			</section>-->
			<!--// Contact Page Form -->

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>