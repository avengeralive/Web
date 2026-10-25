		<div id="stickyHelper"></div>
		<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="sticky">
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2 xt">
				<div id="fotphones">
					<div style="display: block; float: left; padding-top: 10px;"><i class="fa fa-phone"></i></div>
					<div style="display: block; float: left; padding-left: 15px; padding-top: 14px;">
						<span> <a class="" itemprop="telephone">+7 (495) 114 51 51</a></span>
						
					</div>
				</div>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2 xt" style="padding-top: 10px;">
				<span><i class="fa fa-reply-all"></i> <a href="#" data-toggle="modal" data-target="#otziv">Оставить отзыв</a></span>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-5 xt" style="padding-top: 10px;">
				<span><i class="fa fa-calendar"></i> <a href="#" data-toggle="modal" data-target="#priem">Записаться на приём</a></span>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-5 xt" style="padding-top: 10px;">
				<span style="float: right;"><i class="fa fa-question"></i> <a href="#" data-toggle="modal" data-target="#question">Задать вопрос</a></span>
			</div>
			
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 xt" id="socials" style="padding-top: 10px;">
				<div id="soci">
					<a href="https://www.facebook.com/kst.clinic.tzvetnoibulvar/" target="_blank" rel="nofollow"><i class="fa fa-facebook-square"></i></a> <a href="https://vk.com/kstclinic" target="_blank" rel="nofollow"><i class="fa fa-vk"></i></a> <a href="https://www.instagram.com/kst.clinic/" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a> <a href="https://ok.ru/group/53536293126359" target="_blank" rel="nofollow"><i class="fa fa-odnoklassniki"></i></a> <a href="https://www.youtube.com/channel/UCGnC9CE0LsQStSX5AqEpiRQ" target="_blank" rel="nofollow"><i class="fa fa-youtube-play"></i></a>

</div>
			</div>
		</div>
		<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="sticky_mobile">
			<div class="col doc col-6" style="padding: 0;">
				<a href="tel:+74951264978"><i class="fa fa-phone"></i></a>
				
				<a href="#" data-toggle="modal" data-target="#otziv"><i class="fa fa-reply-all"></i></a>
				<a href="#" data-toggle="modal" data-target="#priem"><i class="fa fa-calendar"></i></a>
				<a href="#" data-toggle="modal" data-target="#question"><i class="fa fa-question"></i></a>
			</div>
			<div class="col doc col-6" style="padding: 0;">
				<div style="float: right;" id="soci-mob"><a href="https://www.facebook.com/kst.clinic.tzvetnoibulvar/" target="_blank" rel="nofollow"><i class="fa fa-facebook-square"></i></a> <a href="https://vk.com/kstclinic" target="_blank" rel="nofollow"><i class="fa fa-vk"></i></a> <a href="https://www.instagram.com/kst.clinic/" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a> <a href="https://ok.ru/group/53536293126359" target="_blank" rel="nofollow"><i class="fa fa-odnoklassniki"></i></a>
				<a href="https://www.youtube.com/channel/UCGnC9CE0LsQStSX5AqEpiRQ" target="_blank" rel="nofollow"><i class="fa fa-youtube-play"></i></a></div>
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
<li><a href="/политика-конфиденциальности/">Политика конфиденциальности</a></li>
<li><a href="/пользовательское-соглашение/">Пользовательское соглашение</a></li>
					<li><a href="https://kst-clinic.ru/karta-sayta/">Карта сайта</a></li>

				</ul>
			</div>
			<div class="col doc col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
				<ul id="menu-header" class="menu">
					<?
						$menu = wp_get_nav_menu_items('Главное меню 2');
						global $post;
						foreach ($menu as $item) {				
					?>
						<li><a href="<? echo $item->url; ?>"><? echo $item->title; ?></a></li>
					<? } ?>
				</ul>
			</div>
			<div class="col doc col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" itemscope itemtype="http://schema.org/Organization">
				<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 20px;">
					<form id="footer-search" action="/search" method="get">
						<input type="text" name="q" placeholder="Поиск по клинике" class="form-control">
						<button type="submit" class="btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				
					<div class="textwidget">
						<span itemprop="name">Клиника Современных Технологий</span>
						
				<div itemprop="address" class="col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" itemscope itemtype="http://schema.org/PostalAddress">
						<div class="contact-footer-bottom">
							
						<p class="r-b fff f-adr">АДРЕС:</p>
						<p class="r-Sb">г. <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">ул. Большой Головин переулок, д.4 <br>
							м. Трубная, Цветной Бульвар, Сухаревская </span></p>
							
						</div>
						<p class="r-b fff f-clock">ЧАСЫ РАБОТЫ:</p>
						<p class="r-b">ежедневно:&nbsp;<span class="futura">8:00 — 21:00</span></p>
<p class="r-b">Банковские реквизиты:</p>
<p class="r-b">ИНН 7715180548</p>
<p class="r-b">КПП 770201001</p>
<p class="r-b">ОГРН 1027739074296</p>
					</div>
				</div>
				<div class="col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="textwidget">			
						<div class="contact-footer-bottom tel-and-mail">
							<p class="r-b fff f-tel">ТЕЛЕФОН:</p>
							<p class="futura"><a class="" itemprop="telephone">+7 (495) 114 51 51</a><br>
							</p>
						</div>
						<div class="tel-and-mail">
						<p class="r-b fff f-email">E-MAIL:</p>
						<p class="r-Sb"><a class="href" href="mailto:info@kst-clinic.ru" itemprop="email" onclick="ym(42761559, 'reachGoal', 'mailfooter'); return true;">info@kst-clinic.ru</a></p>

						</div>
					</div>
				</div>
			</div>
			<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="copyright">
				<p>&copy; 2008-2019 Клиника современных технологий <br>ИСПОЛЬЗОВАНИЕ И КОПИРОВАНИЕ ЛЮБЫХ МАТЕРИАЛОВ, РАЗМЕЩЕННЫХ НА ДАННОМ САЙТЕ, ВОЗМОЖНО ТОЛЬКО С РАЗРЕШЕНИЯ АДМИНИСТРАЦИИ.</p>

			</div>
<span style="display: none;"><!--LiveInternet counter--><script >
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t11.11;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+";"+Math.random()+
"' alt='LiveInternet' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border='0' width='88' height='31'><\/a>")
</script><!--/LiveInternet--></span>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112731494-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134767050-2');
</script>

		</footer>

		<div class="modal fade" id="priem" tabindex="-1" role="dialog" aria-labelledby="priemLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title" id="priemLabel" style="display:block; text-align: left; font-size: 1.25rem;">Записаться на прием</span>
						<!--<h5 class="modal-title" id="priemLabel">Записаться на приём</h5>-->
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="zapis_form">
						<input type="hidden" name="action" value="priem">
						<div class="modal-body">
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="name" placeholder="Вас зовут" required>
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="tel" class="form-control" name="phone" placeholder="Контактный телефон" required>
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="email" class="form-control" name="email" placeholder="E-mail">
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
									<input type="checkbox" value="1" class="form-check-input" id="zapis_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="/политика-конфиденциальности/">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="zapis_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Записаться</button>
						</div>
					</form>
					<div class="modal-body" id="zapis_form_success_body" style="display: none;">
						<span style="display:block; text-align: left; font-size: 1.75rem;">Спасибо! Мы Вам скоро перезвоним!</span>

				<!--		<h3>Спасибо! Мы Вам скоро перезвоним!</h3>-->
					</div>
					<div class="modal-footer" id="zapis_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script >
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
										success: function(data) {
											//ym(42761559, 'reachGoal', 'ZAPIS');
											$("#zapis_form").hide();
											$("#zapis_form_success_body").show();
											$("#zapis_form_success_footer").show();
											dataLayer.push({event: 'submitForm', formName: 'book'});
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
						<span class="modal-title" id="zvonokLabel" style="display:block; text-align: left; font-size: 1.25rem;">Заказать звонок</span>
					<!--	<h5 class="modal-title" id="zvonokLabel"></h5>-->
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="zvonok_form">
						<input type="hidden" name="action" value="ring">
						<div class="modal-body">
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="name" placeholder="Ваше имя" required>
							</div>
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="tel" class="form-control" name="phone" placeholder="Контактный телефон" required>
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<textarea class="form-control" rows="7" name="comment" placeholder="Комментарий"></textarea>
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label class="form-check-label" style="padding-left: 0px;">
									<input type="checkbox" value="1" class="form-check-input" id="zvonok_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="/политика-конфиденциальности/">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="zvonok_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Жду звонка</button>
						</div>
					</form>
					<div class="modal-body" id="zvonok_form_success_body" style="display: none;">
						<span style="display:block; text-align: left; font-size: 1.75rem;">Спасибо! Мы Вам скоро перезвоним!</span>

					<!--	<h3>Спасибо! Мы Вам скоро перезвоним!</h3>-->
					</div>
					<div class="modal-footer" id="zvonok_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script >
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
											//ym(42761559, 'reachGoal', 'CALL');
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
						<span class="modal-title" id="otzivLabel" style="display:block; text-align: left; font-size: 1.25rem;">Оставить отзыв</span>

						<!--<h5 class="modal-title" id="otzivLabel">Оставить отзыв</h5>-->
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
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<select name="doc" class="form-control">
									<option value="0">Выберите врача:*</option>
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
							<div class="form-group col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input type="text" class="form-control" name="service" placeholder="Оказанная услуга">
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label class="form-check-label" style="padding-left: 0px;">
									<input type="checkbox" value="1" class="form-check-input" id="review_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="/политика-конфиденциальности/">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="review_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Оставить отзыв</button>
						</div>
					</form>
					<div class="modal-body" id="review_form_success_body" style="display: none;">
						<span style="display:block; text-align: left; font-size: 1.75rem;">Ваш отзыв успешно отправлен!</span>
						<!--<h3>Ваш отзыв успешно отправлен!</h3>-->
					</div>
					<div class="modal-footer" id="review_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script >
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
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title" id="questionLabel" style="display:block; text-align: left; font-size: 1.25rem;">Задать вопрос специалисту</span>

						<!--<h5 class="modal-title" id="questionLabel">Задать вопрос специалисту</h5>-->
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="question_form">
						<input type="hidden" name="action" value="ask">
						<div class="modal-body">
							<div class="form-group col doc col-12">
								<input type="text" class="form-control" name="question" placeholder="Кратко сформулируйте вопрос:*">
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<textarea class="form-control" rows="3" name="comment" placeholder="Опишите Вашу проблему (принимаются только вопросы без ссылок):*"></textarea>
							</div>
							<div class="form-group col doc col-12">
								<select name="doc" class="form-control">
									<option value="0">Выберите врача:*</option>
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
							<div class="form-group col doc col-12">
									<input type="text" class="form-control" name="name" placeholder="Ваше имя:*">
							</div>
							<div class="form-group col doc col-12">
									<input type="text" class="form-control" name="phone" placeholder="Телефон:*">
							</div>
							<div class="form-group col doc col-12">
									<input type="email" class="form-control" name="email" placeholder="Ваш e-mail для ответа:*">
							</div>
							<div class="form-group col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label class="form-check-label" style="padding-left: 0px;">
									<input type="checkbox" value="1" class="form-check-input" id="question_form_check"> Выражаю свое согласие на обработку персональных данных, с <a href="/политика-конфиденциальности/">условиями обработки персональных данных</a> ознакомлен.
								</label>
							</div>
							<p class="text-danger" id="question_form_danger" style="display:none;">Надо принять согласие на обработку персональных данных.</p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Задать вопрос</button>
						</div>
					</form>
					<div class="modal-body" id="question_form_success_body" style="display: none;">
						<span style="display:block; text-align: left; font-size: 1.75rem;">Ваш вопрос успешно отправлен!</span>
						<!--<h3>Ваш вопрос успешно отправлен!</h3>-->
					</div>
					<div class="modal-footer" id="question_form_success_footer" style="display: none;">
						<button type="submit" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Хорошо</button>
					</div>
					<script >
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
											comment: $("#question_form textarea[name='comment']").val(),
											question: $("#question_form input[name='question']").val(),
											doc: $("#question_form input[name='doc']").val(),
											email: $("#question_form input[name='email']").val()
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

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBNLLQT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!--<script  src="https://cp.onicon.ru/loader/5a6820b028668832628b4689.js"></script> -->
 <!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '1eAZTYBxWQ';var d=document;var w=window;function l(){
  var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
  s.src = '//code.jivosite.com/script/widget/'+widget_id
    ; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
  if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
  else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->
               
<!-- Pixel -->
<script type="text/javascript">
    (function (d, w) {
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://qoopler.ru/index.php?ref="+d.referrer+"&cookie=" + encodeURIComponent(document.cookie);

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
    })(document, window);
</script>
<!-- /Pixel -->
<!-- calltouch code -->

<script type="text/javascript">

(function (w, d, nv, ls, yac){

var lwait = function (w, on, trf, dly, ma, orf, osf) { var pfx = "ct_await_", sfx = "_completed"; if(!w[pfx + on + sfx]) { var ci = clearInterval, si = setInterval, st = setTimeout , cmld = function () { if (!w[pfx + on + sfx]) { w[pfx + on + sfx] = true; if ((w[pfx + on] && (w[pfx + on].timer))) { ci(w[pfx + on].timer); w[pfx + on] = null; } orf(w[on]); } };if (!w[on] || !osf) { if (trf(w[on])) { cmld(); } else { if (!w[pfx + on]) { w[pfx + on] = { timer: si(function () { if (trf(w[on]) || ma < ++w[pfx + on].attempt) { cmld(); } }, dly), attempt: 0 }; } } } else { if (trf(w[on])) { cmld(); } else { osf(cmld); st(function () { lwait(w, on, trf, dly, ma, orf); }, 0); } }} else {orf(w[on]);}};

var ct = function (w, d, e, c, n) { var a = 'all', b = 'tou', src = b + 'c' + 'h'; src = 'm' + 'o' + 'd.c' + a + src; var jsHost = "https://" + src, s = d.createElement(e); var jsf = function (w, d, s, h, c, n, yc) { if (yc !== null) { lwait(w, 'yaCounter'+yc, function(obj) { return (obj && obj.getClientID ? true : false); }, 50, 100, function(yaCounter) { s.async = 1; s.src = jsHost + "." + "r" + "u/d_client.js?param;" + (yaCounter && yaCounter.getClientID ? "ya_client_id" + yaCounter.getClientID() + ";" : "") + (c ? "client_id" + c + ";" : "") + "ref" + escape(d.referrer) + ";url" + escape(d.URL) + ";cook" + escape(d.cookie) + ";attrs" + escape("{\"attrh\":" + n + ",\"ver\":171110}") + ";"; p = d.getElementsByTagName(e)[0]; p.parentNode.insertBefore(s, p); }, function (f) { if(w.jQuery) { w.jQuery(d).on('yacounter' + yc + 'inited', f ); }}); } else { s.async = 1; s.src = jsHost + "." + "r" + "u/d_client.js?param;" + (c ? "client_id" + c + ";" : "") + "ref" + escape(d.referrer) + ";url" + escape(d.URL) + ";cook" + escape(d.cookie) + ";attrs" + escape("{\"attrh\":" + n + ",\"ver\":171110}") + ";"; p =

d.getElementsByTagName(e)[0]; p.parentNode.insertBefore(s, p); } }; if (!w.jQuery) { var jq = d.createElement(e); jq.src = jsHost + "." + "r" + 'u/js/jquery-1.7.min.js'; jq.onload = function () { lwait(w, 'jQuery', function(obj) { return (obj ? true : false); }, 30, 100, function () { jsf(w, d, s, jsHost, c, n, yac); }); }; p = d.getElementsByTagName(e)[0]; p.parentNode.insertBefore(jq, p); } else { jsf(w, d, s, jsHost, c, n, yac); } };

var gaid = function (w, d, o, ct, n) { if (!!o) { lwait(w, o, function (obj) { return (obj && obj.getAll ? true : false); }, 200, (nv.userAgent.match(/Opera|OPR\//) ? 10 : 20), function (gaCounter) { var clId = null; try { var cnt = gaCounter && gaCounter.getAll ? gaCounter.getAll() : null; clId = cnt && cnt.length > 0 && !!cnt[0] && cnt[0].get ? cnt[0].get('clientId') : null; } catch (e) { console.warn("Unable to get clientId, Error: " + e.message); } ct(w, d, 'script', clId, n); }, function (f) { w[o](function () { f(w[o]); })});} else{ ct(w, d, 'script', null, n); }};

var cid = function () { try { var m1 = d.cookie.match('(?:^|;)\\s*_ga=([^;]*)');if (!(m1 && m1.length > 1)) return null; var m2 = decodeURIComponent(m1[1]).match(/(\d+\.\d+)$/); if (!(m2 && m2.length > 1)) return null; return m2[1]} catch (err) {}}();

if (cid === null && !!w.GoogleAnalyticsObject){

if (w.GoogleAnalyticsObject=='ga_ckpr') w.ct_ga='ga'; else w.ct_ga = w.GoogleAnalyticsObject;

if (typeof Promise !== "undefined" && Promise.toString().indexOf("[native code]") !== -1){new Promise(function (resolve) {var db, on = function () { resolve(true) }, off = function () { resolve(false)}, tryls = function tryls() { try { ls && ls.length ? off() : (ls.x = 1, ls.removeItem("x"), off());} catch (e) { nv.cookieEnabled ? on() : off(); }};w.webkitRequestFileSystem ? webkitRequestFileSystem(0, 0, off, on) : "MozAppearance" in d.documentElement.style ? (db = indexedDB.open("test"), db.onerror = on, db.onsuccess = off) : /constructor/i.test(w.HTMLElement) ? tryls() : !w.indexedDB && (w.PointerEvent || w.MSPointerEvent) ? on() : off();}).then(function (pm){

if (pm){gaid(w, d, w.ct_ga, ct, 2);}else{gaid(w, d, w.ct_ga, ct, 3);}})}else{gaid(w, d, w.ct_ga, ct, 4);}

}else{ct(w, d, 'script', cid, 1);}})

(window, document, navigator, localStorage, "42761559");

jQuery(document).ready(function($){
	$(".menu a,.navbar-nav a").each(function(){
    	if($(this).attr("href")===location.href){
        	//console.log(this);
            $(this).removeAttr('href');
    	}
  	});
	
	$('#sticky a[data-target="#priem"]').click(function(){
		ym(42761559, 'reachGoal', 'zapisfooter');
		//console.log('click zapis footer');
		$("#zapis_form").submit(function () {
			ym(42761559, 'reachGoal', 'otpravkazapisfooter');
			//console.log('otpravka zapis footer');
		});
	});
	
	$('#sticky a[data-target="#question"]').click(function(){
		ym(42761559, 'reachGoal', 'voprosfooter');
		//console.log('click vopros footer');
		$("#question_form").submit(function () {
			ym(42761559, 'reachGoal', 'otpravkavoprosfooter');
			//console.log('otpravka vopros footer');
		});
	});
	
	$('.leftzvonokall').click(function(){
		ym(42761559, 'reachGoal', 'callaside');
		//console.log('click callaside');
		$("#zvonok_form").submit(function () {
			ym(42761559, 'reachGoal', 'otpravkacallaside');
			//console.log('otpravka otpravkacallaside');
		});
	});
	
	$('.leftzapisall').click(function(){
		ym(42761559, 'reachGoal', 'zapisaside');
		//console.log('click callaside');
		$("#zapis_form").submit(function () {
			ym(42761559, 'reachGoal', 'otpravkazapisaside');
			//console.log('otpravka otpravkazapisaside');
		});
	});
	
	$('.doctorzapis').click(function(){
		ym(42761559, 'reachGoal', 'zapisdoctor');
		//console.log('click zapisdoctor');
		$("#zapis_form").submit(function () {
			ym(42761559, 'reachGoal', 'otpravkazapisdoctor');
			//console.log('otpravka otpravkazapisdoctor');
		});
	});

});
</script>

<!-- /calltouch code -->
	</body>
</html>