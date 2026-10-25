 <!-- footer part start -->
    <a href="#" class="back-top-btn"><span class="fa fa-arrow-up"></span></a>
    <footer id="footer_part">
        <div class="container">
            <div class="row">
                <div class="footer">
                    <div class="col-md-6 col-sm-6">
                        <div class="contact_part">
                            <h5 style="margin-left:25px;">Свяжитесь с нами</h5>
                            <p><i class="fa fa-map-marker"><span>Россия Москва, Проспект Мира, дом 102, строение 12, комната 36</span></i></p>
                            <p><i class="fa fa-envelope"><span><a href="mailto:coffe-trend@mail.ru">coffe-trend@mail.ru</a></span></i></p>
                            <p><i class="fa fa-globe"><span><a href="http://coffe-trend.ru">coffe-trend.ru</a></span></i></p>
                            <p><i class="fa fa-fax"><span><a href="tel:+7 (495) 509-68-48">+7 (495) 509-68-48</a></span></i></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6">
                       <div class="col-12 col-sm-6">
					<? echo do_shortcode('[contact-form-7 id="31" title="Контактная форма 1"]'); ?>
				</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer part end -->
<!-- Footer-bottom -->
    <section id="footer-btm">
        <div class="container">
            <div class="row">
                <div class="footer-btm text-center">
                    <p>&copy; Coffe-trend. 2018. Все права защищены</p>
					
                </div>
            </div>
        </div>
    </section>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/slick.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/waypoints.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/counterup.min.js"></script>
    <script src="<?php bloginfo('template_directory') ?>/js/venobox.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/custom.js"></script>
<? wp_footer(); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Заказ звонка</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><? echo do_shortcode('[contact-form-7 id="31" title="Контактная форма 1"]'); ?>
      </div>
      
    </div>
  </div>
</div>
</body>

</html>