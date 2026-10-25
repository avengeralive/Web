<?
/*
Template name: Регистрация билета
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
					<? if (pll_current_language() == 'ru') { ?>
					<form action="/wp-admin/admin-post.php" method="post" id="contact-form2" class="contact-page-form">
						<div class="row">
							<input type="hidden" name="action" value="getticket">
							<input type="hidden" name="lang" value="<? echo pll_current_language(); ?>">
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="surname" placeholder="Фамилия">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="name" placeholder="Имя">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="patro" placeholder="Отчество">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="phone" placeholder="Телефон мобильный">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="email" name="email" placeholder="E-mail">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="company_name" placeholder="Название компании">
							</div>
							<div class="col-lg-6 col-12 mt-30">
								<input type="text" name="site" placeholder="Сайт">
							</div>
							<div class="col-lg-6 col-12 mt-30">
								<select name="type_deal" style="width: 100%">
									<option value="0">Вид деятельности компании</option>
									<option value="Производство одежды">Производство одежды</option>
									<option value="Предприятие оптовой торговли">Предприятие оптовой торговли</option>
									<option value="Предприятие розничной торговли">Предприятие розничной торговли</option>
									<option value="СМИ">СМИ</option>
									<option value="Другое">Другое</option>
								</select>
							</div>
							<div class="col-lg-12 col-12 mt-30">
								<p>Какая продукция Вас интересует</p>
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
							<div class="col-lg-12 col-12 mt-30">
								<input name="source" placeholder="Из какого источника получили информацию о мероприятии">
							</div>
							<div class="col-lg-12 col-12 mt-30 text-center">
								<button type="submit" class="cr-btn mt-30">
									<span>Получить электронный билет <i class="fa fa-angle-right"></i></span>
								</button>
							</div>
						</div>
					</form>
					<? } else { ?>
					<form action="/wp-admin/admin-post.php" method="post" id="contact-form2" class="contact-page-form">
						<div class="row">
							<input type="hidden" name="action" value="getticket">
							<input type="hidden" name="lang" value="<? echo pll_current_language(); ?>">
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="surname" placeholder="Surname">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="name" placeholder="Name">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="patro" placeholder="Patronymic">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="phone" placeholder="Phone">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="email" name="email" placeholder="E-mail">
							</div>
							<div class="col-lg-4 col-12 mt-30">
								<input type="text" name="company_name" placeholder="Company name">
							</div>
							<div class="col-lg-6 col-12 mt-30">
								<input type="text" name="site" placeholder="Site">
							</div>
							<div class="col-lg-6 col-12 mt-30">
								<select name="type_deal" style="width: 100%">
									<option value="0">Type of activity</option>
									<option value="Производство одежды">Manufacture of wearing apparel</option>
									<option value="Предприятие оптовой торговли">Wholesale enterprise</option>
									<option value="Предприятие розничной торговли">Retail enterprise</option>
									<option value="СМИ">Mass media</option>
									<option value="Другое">Other</option>
								</select>
							</div>
							<div class="col-lg-12 col-12 mt-30">
								<p>What products are you interested in</p>
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
							<div class="col-lg-12 col-12 mt-30">
								<input name="source" placeholder="From what source did you receive information about the event">
							</div>
							<div class="col-lg-12 col-12 mt-30 text-center">
								<button type="submit" class="cr-btn mt-30">
									<span>Get e-ticket <i class="fa fa-angle-right"></i></span>
								</button>
							</div>
						</div>
					</form>
					<? } ?>
					<p class="form-message"></p>
				</div>
			</section>
			<!--// Contact Page Form -->

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>