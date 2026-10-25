		<div id="stickyHelper"></div>
		<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="sticky">
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
				<div id="fotphones">
					<div style="display: block; float: left; padding-top: 10px;"><i class="fa fa-phone"></i></div>
					<div style="display: block; float: left; padding-left: 15px;">
						<span> <a href="tel:+74999788481">+7 (499) 978 84 81</a></span><br>
						<span><a href="tel:+74951145000">+7 (495) 114 50 00</a></span>
					</div>
				</div>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" style="padding-top: 10px;">
				<span><i class="fa fa-reply-all"></i> <a href="#" data-toggle="modal" data-target="#otziv">Оставить отзыв</a></span>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" style="padding-top: 10px;">
				<span><i class="fa fa-calendar"></i> <a href="#" data-toggle="modal" data-target="#priem">Записаться на приём</a></span>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" id="socials" style="padding-top: 10px;">
				<div style="float: right;" id="soci"><a href="a href="https://www.facebook.com/kstdentalclinic/"><i class="fa fa-facebook-square"></i></a> <a href="https://vk.com/kstdental"><i class="fa fa-vk"></i></a> <a href="https://www.instagram.com/kst.dental/"><i class="fa fa-instagram"></i></a>&nbsp;&nbsp;&nbsp;<span>Дружите с нами</span></div>
			</div>
		</div>
		<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="sticky_mobile">
			<div class="col doc col-6" style="padding: 0;">
				<a href="tel:+74999788481"><i class="fa fa-phone"></i></a>
				<a href="tel:+74951145000"><i class="fa fa-phone"></i></a>
				<a href="#" data-toggle="modal" data-target="#otziv"><i class="fa fa-reply-all"></i></a>
				<a href="#" data-toggle="modal" data-target="#priem"><i class="fa fa-calendar"></i></a>
			</div>
			<div class="col doc col-6" style="padding: 0;">
				<div style="float: right;" id="soci"><a href="#"><i class="fa fa-facebook-square"></i></a> <a href="#"><i class="fa fa-vk"></i></a> <a href="#"><i class="fa fa-instagram"></i></a></div>
			</div>
		</div>
		<footer>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
				<ul id="menu-futer1" class="menu">
					<?
						$menu = wp_get_nav_menu_items('Футер меню');
						global $post;
						foreach ($menu as $item) {				
					?>
						<li><a href="<? echo $item->url; ?>"><? echo $item->title; ?></a></li>
					<? } ?>
					<li><a href="#" data-toggle="modal" data-target="#otziv">Задать вопрос</a></li>
				</ul>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
				<ul id="menu-header" class="menu">
					<?
						$menu = wp_get_nav_menu_items('Главное меню');
						global $post;
						foreach ($menu as $item) {				
					?>
						<li><a href="<? echo $item->url; ?>"><? echo $item->title; ?></a></li>
					<? } ?>
				</ul>
			</div>
			<div class="col doc col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 20px;">
					<form id="footer-search" action="/search" method="get">
						<input type="text" name="q" placeholder="Поиск по клинике" class="form-control">
						<button type="submit" class="btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="textwidget">
						<div class="contact-footer-bottom">
						<p class="r-b fff f-adr">АДРЕС:</p>
						<p class="r-Sb">г. Москва, ул. Лесная д. 8А</p>
						</div>
						<p class="r-b fff f-clock">ЧАСЫ РАБОТЫ:</p>
						<p class="r-b">ежедневно:&nbsp;<span class="futura">9:00 — 21:00</span><br>
						воскресенье:&nbsp;<span class="futura">по записи</span></p>
					</div>
				</div>
				<div class="col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="textwidget">
						<div class="contact-footer-bottom tel-and-mail">
						<p class="r-b fff f-tel">ТЕЛЕФОН:</p>
						<p class="futura"><a class="href" href="tel:+74999788481">+7 (499) 978 84 81</a><br>
						<a class="href" href="tel:+74951145000">+7 (495) 114 50 00</a></p>
						</div>
						<div class="tel-and-mail">
						<p class="r-b fff f-email">E-MAIL:</p>
						<p class="r-Sb"><a class="href" href="mailto:info@kst-dental.ru">info@kst-dental.ru</a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="copyright">
				<p>&copy 2005-2017 Клиника современных технологий</p>
			</div>
		</footer>
		<div class="modal fade" id="priem" tabindex="-1" role="dialog" aria-labelledby="priemLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="priemLabel">Записаться на приём</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="zapis_form">
						<input type="hidden" name="action" value="priem">
						<div class="modal-body">
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="name" placeholder="Вас зовут">
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="phone" placeholder="Контактный телефон">
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="email" placeholder="E-mail">
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<select name="doc" class="form-control">
									<option value="0">Любимый доктор</option>
<? $args = array( 'posts_per_page'   => 999, 'category_name' => 'doctors', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$name = get_field('имя', $post->ID);
		$last = get_field('фамилия', $post->ID);
		$father = get_field('отчество', $post->ID);
		?>
									<option value="<? echo $last; ?> <? echo $name; ?> <? echo $father; ?>"><? echo $last; ?> <? echo $name; ?> <? echo $father; ?></option>
	<? } ?>
								</select>
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<textarea class="form-control" rows="7" name="comment" placeholder="Комментарий"></textarea>
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label class="form-check-label" style="padding-left: 0px;">
									<input type="checkbox" value="1" class="form-check-input" id="zapis_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="#">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="zapis_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Записаться</button>
						</div>
					</form>
					<div class="modal-body" id="zapis_form_success_body" style="display: none;">
						<h3>Спасибо! Мы Вам скоро перезвоним!</h3>
					</div>
					<div class="modal-footer" id="zapis_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script type="text/javascript">
						$(function(){
							$("#zapis_form").submit(function(){
								if ($('#zapis_form_check').prop('checked') == true)
								{
									$.ajax({
										url: '/wp-admin/admin-post.php',
										method: 'POST',
										data: {
											action: $("#zapis_form input[name='action']").val(),
											name: $("#zapis_form input[name='name']").val(),
											phone: $("#zapis_form input[name='phone']").val(),
											email: $("#zapis_form input[name='email']").val(),
											doc: $("#zapis_form select[name='doc']").val(),
											comment: $("#zapis_form textarea[name='comment']").val()
										},
										success: function(data)
										{
											$("#zapis_form").hide();
											$("#zapis_form_success_body").show();
											$("#zapis_form_success_footer").show();
										}
									});
								}
								else $("#zapis_form_danger").show();
								return false;
							});
						});
					</script>
				</div>
			</div>
		</div>
		<div class="modal fade" id="zvonok" tabindex="-1" role="dialog" aria-labelledby="zvonokLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="zvonokLabel">Заказать звонок</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="zvonok_form">
						<input type="hidden" name="action" value="ring">
						<div class="modal-body">
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="name" placeholder="Ваше имя">
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="phone" placeholder="Контактный телефон">
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<textarea class="form-control" rows="7" name="comment" placeholder="Комментарий"></textarea>
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label class="form-check-label" style="padding-left: 0px;">
									<input type="checkbox" value="1" class="form-check-input" id="zvonok_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="#">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="zvonok_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Жду звонка</button>
						</div>
					</form>
					<div class="modal-body" id="zvonok_form_success_body" style="display: none;">
						<h3>Спасибо! Мы Вам скоро перезвоним!</h3>
					</div>
					<div class="modal-footer" id="zvonok_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script type="text/javascript">
						$(function(){
							$("#zvonok_form").submit(function(){
								if ($('#zvonok_form_check').prop('checked') == true)
								{
									$.ajax({
										url: '/wp-admin/admin-post.php',
										method: 'POST',
										data: {
											action: $("#zvonok_form input[name='action']").val(),
											name: $("#zvonok_form input[name='name']").val(),
											phone: $("#zvonok_form input[name='phone']").val(),
											comment: $("#zvonok_form textarea[name='comment']").val()
										},
										success: function(data)
										{
											$("#zvonok_form").hide();
											$("#zvonok_form_success_body").show();
											$("#zvonok_form_success_footer").show();
										}
									});
								}
								else $("#zvonok_form_danger").show();
								return false;
							});
						});
					</script>
				</div>
			</div>
		</div>
		<div class="modal fade" id="otziv" tabindex="-1" role="dialog" aria-labelledby="otzivLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="otzivLabel">Оставить отзыв</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="review_form">
						<input type="hidden" name="action" value="review">
						<div class="modal-body">
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="text" class="form-control" name="name" placeholder="Ваше имя">
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="phone" placeholder="Контактный телефон">
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<textarea class="form-control" rows="7" name="comment" placeholder="Отзыв"></textarea>
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<input type="text" class="form-control" name="service" placeholder="Оказанная услуга">
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label class="form-check-label" style="padding-left: 0px;">
									<input type="checkbox" value="1" class="form-check-input" id="review_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="#">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="review_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Оставить отзыв</button>
						</div>
					</form>
					<div class="modal-body" id="review_form_success_body" style="display: none;">
						<h3>Ваш отзыв успешно отправлен!</h3>
					</div>
					<div class="modal-footer" id="review_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script type="text/javascript">
						$(function(){
							$("#review_form").submit(function(){
								if ($('#review_form_check').prop('checked') == true)
								{
									$.ajax({
										url: '/wp-admin/admin-post.php',
										method: 'POST',
										data: {
											action: $("#review_form input[name='action']").val(),
											name: $("#review_form input[name='name']").val(),
											phone: $("#review_form input[name='phone']").val(),
											comment: $("#review_form textarea[name='comment']").val(),
											service: $("#review_form input[name='service']").val()
										},
										success: function(data)
										{
											$("#review_form").hide();
											$("#review_form_success_body").show();
											$("#review_form_success_footer").show();
										}
									});
								}
								else $("#review_form_danger").show();
								return false;
							});
						});
					</script>
				</div>
			</div>
		</div>
		<div class="modal fade" id="question" tabindex="-1" role="dialog" aria-labelledby="questionLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="questionLabel">Задать вопрос</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="question_form">
						<input type="hidden" name="action" value="ask">
						<div class="modal-body">
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="text" class="form-control" name="name" placeholder="Ваше имя">
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="phone" placeholder="Контактный телефон">
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<textarea class="form-control" rows="7" name="comment" placeholder="Вопрос"></textarea>
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label class="form-check-label" style="padding-left: 0px;">
									<input type="checkbox" value="1" class="form-check-input" id="question_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="#">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="question_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Задать вопрос</button>
						</div>
					</form>
					<div class="modal-body" id="question_form_success_body" style="display: none;">
						<h3>Ваш вопрос успешно отправлен!</h3>
					</div>
					<div class="modal-footer" id="question_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script type="text/javascript">
						$(function(){
							$("#question_form").submit(function(){
								if ($('#question_form_check').prop('checked') == true)
								{
									$.ajax({
										url: '/wp-admin/admin-post.php',
										method: 'POST',
										data: {
											action: $("#question_form input[name='action']").val(),
											name: $("#question_form input[name='name']").val(),
											phone: $("#question_form input[name='phone']").val(),
											comment: $("#question_form textarea[name='comment']").val()
										},
										success: function(data)
										{
											$("#question_form").hide();
											$("#question_form_success_body").show();
											$("#question_form_success_footer").show();
										}
									});
								}
								else $("#question_form_danger").show();
								return false;
							});
						});
					</script>
				</div>
			</div>
		</div>
		<? wp_footer(); ?>
	</body>
</html>