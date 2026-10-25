<div class="footer">

			<!-- Footer Top Area -->
			<!--<div class="footer-top-area bg-dark-light">	
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-5">
							<ul class="footer-social-icons">
								<li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://vimeo.com/"><i class="fa fa-vimeo-square"></i></a></li>
								<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
								<li><a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a></li>
							</ul>
						</div>
						<div class="col-lg-7">
							<form action="#" class="footer-newsletter-form">
								<h4>newsletter</h4>
								<input type="email" placeholder="Email address...">
								<input type="submit" value="Subscribe">
							</form>
						</div>
					</div>
				</div>
			</div>-->
			<!--// Footer Top Area -->

			<!-- Footer Bottom Area -->
			<div class="footer-bottom-area bg-dark section-padding-xs">
				<div class="container">
					<div class="row widgets footer-widgets">

						<div class="col-lg-4">
							<div class="single-widget widget-about text-center">
								<a href="/">
									<img src="<? echo get_field('лого2', 7); ?>" alt="footer logo" style="height: 140px; margin: 0 auto;">
								</a>
							</div>
							<div class="about-text text-center">
	        					<!--<h3 style="color: #fff;">Организатор</h3>-->
	        					
	        					<!--<img src="http://minpromtorg.gov.ru/common/img/logo_share.png" style="height: 100px">-->
	        				</div>
						</div>

						<div class="col-lg-4">
							<div class="single-widget widget-events">
								<div class="about-text text-center">
		        					<!--<h3 style="color: #fff;">Поддержка</h3>-->
		        					<!--<img src="http://intertkan.ru/wp-content/themes/intertkan2/images/souzlegprom.png" style="margin-top: 20px; height: 80px">
		        					<img src="https://tpprf.ru/local/templates/tpprf_main/images/logo.png" style="margin-top: 20px; height: 80px">-->
		        				</div>
								<!--<h6 class="widget-title">Our Upcoming Events</h6>
								<ul>
									<li>
										<a href="event-details.html" class="widget-event-thumb">
											<img src="/wp-content/themes/intertkanb2b/images/events/small-events/small-event-thumb-1.png" alt="footer events">
										</a>
										<h6><a href="event-details.html">When Metro Rail was flooded with.</a></h6>
										<span>October 18, 2018</span>
									</li>
									<li>
										<a href="event-details.html" class="widget-event-thumb">
											<img src="/wp-content/themes/intertkanb2b/images/events/small-events/small-event-thumb-2.png" alt="footer events">
										</a>
										<h6><a href="event-details.html">When Metro Rail was flooded with.</a></h6>
										<span>October 28, 2018</span>
									</li>
								</ul>-->
							</div>
						</div>

						<div class="col-lg-4">
							<div class="single-widget widget-contact">
								<? if (pll_current_language() == 'ru') { ?>
								<ul>
									<li>
										<span class="icon"><i class="fa fa-map-marker"></i></span>
										<p>Адрес : <? echo get_field('адрес', 7); ?></p>
									</li>
									<li>
										<span class="icon"><i class="fa fa-phone"></i></span>
										<p><a href="#"><? echo get_field('телефон', 7); ?></a></p>
									</li>
									<li>
										<span class="icon"><i class="fa fa-fax"></i></span>
										<p><a href="#"><? echo get_field('факс', 7); ?></a></p>
									</li>
									<li>
										<span class="icon"><i class="fa fa-envelope-o"></i></span>
										<p><a href="#"><? echo get_field('почта', 7); ?></a></p>
									</li>
								</ul>
								<? } else { ?>
								<ul>
									<li>
										<span class="icon"><i class="fa fa-map-marker"></i></span>
										<p>Address : <? echo get_field('адрес', 121); ?></p>
									</li>
									<li>
										<span class="icon"><i class="fa fa-phone"></i></span>
										<p><a href="#"><? echo get_field('телефон', 121); ?></a></p>
									</li>
									<li>
										<span class="icon"><i class="fa fa-fax"></i></span>
										<p><a href="#"><? echo get_field('факс', 121); ?></a></p>
									</li>
									<li>
										<span class="icon"><i class="fa fa-envelope-o"></i></span>
										<p><a href="#"><? echo get_field('почта', 121); ?></a></p>
									</li>
								</ul>
								<? } ?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!--// Footer Bottom Area -->

			<!-- Footer Copyright Area -->
			<div class="footer-copyright-area bg-dark">
				<div class="container">
					<div class="footer-copyright text-center">
						<? if (pll_current_language() == 'ru') { ?>
						<p>2018 © <a href="#">Интерткань B2B</a>. Все права защищены</p> 
						<? } else { ?>
						<p>2018 © <a href="#">Interfabric B2B</a>. All rights reserved.</p>
						<? } ?>
					</div>
				</div>
			</div>
			<!--// Footer Copyright Area -->

        </div>
        <!--// Footer -->

    </div>
    <!--// Wrapper -->


    <!-- JS Files -->
    <script src="/wp-content/themes/intertkanb2b/js/vendor/jquery-3.2.1.min.js"></script>
    <script src="/wp-content/themes/intertkanb2b/js/popper.min.js"></script>
    <script src="/wp-content/themes/intertkanb2b/js/bootstrap.min.js"></script>
    <script src="/wp-content/themes/intertkanb2b/js/plugins.js"></script>
    <script src="/wp-content/themes/intertkanb2b/js/active.js"></script>
    <script src="/wp-content/themes/intertkanb2b/js/scripts.js"></script>
</body>

</html>