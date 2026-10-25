<?
/*
Template name: Регистрация участника
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

			<!-- Contact Page Form -->
			<section class="contact-page-bottom-area bg-grey section-padding-sm">
				<div class="container">
					<form action="/wp-admin/admin-post.php" method="post" id="contact-form" class="contact-page-form">
						<div class="row">
							<input type="hidden" name="action" value="register_participant">
							<div class="col-lg-6 col-12 mt-30">
								<input type="text" name="company_name" placeholder="Название компании">
							</div>
							<div class="col-lg-6 col-12 mt-30">
								<select name="type_deal" style="width: 100%">
									<option value="0">Тип деятельности</option>
									<option value="производитель">Производитель</option>
									<option value="поставщик">Поставщик</option>
								</select>
							</div>
							<div class="col-lg-12 col-12 mt-30">
								<p>Виды продукции</p>
							</div>
							<div class="col-lg-12 col-12">
								<div class="row">
								<?
									$terms = get_terms( array(
									    'taxonomy' => 'participant_category',
									    'hide_empty' => false,
									) );
									foreach ($terms as $prod) {	
								?>
								<div class="col-lg-3 col-md-4 col-sm-6 col-12">
									<input type="checkbox" name="categ[<? echo $prod->term_id; ?>]">&nbsp;<? echo $prod->name; ?>
								</div>
								<? } ?>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-12 mt-30">
								<input type="text" name="contact_pers" placeholder="Контактное лицо">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-12 mt-30">
								<input type="text" name="dolzn" placeholder="Должность">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-12 mt-30">
								<input type="text" name="phone" placeholder="Телефон">
							</div>
							<div class="col-lg-6 col-12 mt-30">
								<input type="email" name="email" placeholder="E-mail">
							</div>
							<div class="col-lg-6 col-12 mt-30">
								<input type="text" name="site" placeholder="Сайт">
							</div>
							<div class="col-lg-12 col-12 mt-30">
								<textarea name="source" cols="30" rows="7" placeholder="Из какого источника получили информацию о мероприятии"></textarea>
							</div>
							<div class="col-lg-12 col-12 mt-30 text-center">
								<button type="submit" class="cr-btn mt-30">
									<span>Зарегистрироваться <i class="fa fa-angle-right"></i></span>
								</button>
							</div>
						</div>
					</form>
					<p class="form-message"></p>
				</div>
			</section>
			<!--// Contact Page Form -->

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>