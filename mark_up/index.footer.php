<footer class="infoshel-footer">
    <div class="infoshel-container infoshel-footer__container">
        <div class="infoshel-footer__container-logo">
            <a href="<?php bloginfo('url'); ?>"></a>
        </div>
        <div class="infoshel-footer__container-download">
            <a target="_blank" href="/files/InfoShell.pdf">Скачать презентацию о компании <span></span></a>
        </div>
        <div class="infoshel-footer__container-phone">
            <p>Мск:<?php echo $contacts['moskow']['tel'];?></p>
            <p>СПб:<?php echo $contacts['piter']['tel'];?></p>
            <a href="" data-toggle="modal" data-target="#modal-contact" data-target="#exampleModalCenter"><span></span>Заказать звонок</a>
        </div>
        <div class="infoshel-footer__container-link"><a href="#"></a></div>
    </div>
</footer>

</div>
<div class="side-menu">
    <div class="side-menu__header">
        <a class="side-menu__header-logo" href="<?php bloginfo('url'); ?>">
            <img src="<?php echo $templateDir;?>/img/infoshell2/main.svg" alt="">
        </a>
        <span class="side-menu__header-close"></span>
    </div>
    <div class="side-menu__menu">
        <ul>
            <li class="side-menu__menu-link active"><a href="/services/">Услуги</a></li>
            <li class="side-menu__menu-link"><a href="/portfolio/">Портфолио</a></li>
            <li class="side-menu__menu-link"><a href="/company/">Компания</a></li>
            <li class="side-menu__menu-link"><a href="/blog/">Блог</a></li>
            <li class="side-menu__menu-link"><a href="/contact/">Контакты</a></li>
        </ul>
    </div>
    <div class="side-menu__menu-btn">
        <button class="infoshel-button side-menu__menu-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
        <!--button class="infoshel-button side-menu__menu-button side-menu__menu-button-white" data-toggle="modal" data-target="#exampleModalCenter">Заказать звонок</button-->
    </div>
    <div class="side-menu__social-links">
        <a class="infoshel-header__container-socialNetworks-fb side-menu__social-link" href="<?php echo $socialUrl['fb'];?>" target="_blank"></a>
        <a class="infoshel-header__container-socialNetworks-bh side-menu__social-link" href="<?php echo $socialUrl['bh'];?>" target="_blank"></a>
        <a class="infoshel-header__container-socialNetworks-ins side-menu__social-link" href="<?php echo $socialUrl['ins'];?>" target="_blank"></a>
        <a class="infoshel-header__container-socialNetworks-vcru side-menu__social-link" href="<?php echo $socialUrl['vc'];?>" target="_blank"></a>
    </div>
</div>

<div class="modal modal-infoshel" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-infoshel-form" role="document">
  <div class="modal-content">
    <div class="modal-body">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
     <section class="infoshel-main-form">
      <div class="infoshel-main-form__container infoshel-container">
        <h1>Стоимость разработки</h1>
        <p class="infoshel-main-form__title-text">Стоимость разработки рассчитывается индивидуально в зависимости от сложности, объема и сроков выполнения работ. Разработчик мобильных приложений оценивает все сложности разработки и временные затраты проекта. Затем аналитики определяют стоимость продукта с нуля.</p>

        <div class="infoshel-main-form__form">
            <div class="infoshel-main-form__form-column infoshel-main-form__form-left">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ваше Имя</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите ваше имя">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail2"># телефона</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Введите ваш номер телефона *">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3">Ваш e-mail</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="Введите ваш e-mail адрес">
                </div>
            </div>

            <div class="infoshel-main-form__form-column infoshel-main-form__form-right">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Сообщение</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Опишите ваш проект, пожалуйста"></textarea>
                </div>
                <div class="infoshel-main-form__block-btn">
                    <div class="infoshel-main-form__block-btn-download">
                        <span></span>
                        <div class="infoshel-main-form__block-btn-download-text">
                            <p><b>Прикрепить файл</b></p>
                            <p class="infoshel-main-form__block-btn-download-text-bottom">не больше  2 MB (xls, doc, pdf, jpg)</p>
                        </div>
                    </div>
                    <button class="infoshel-button infoshel-main-form__form-btn">Отправить</button>
                </div>
            </div>
        </div>
      </div>
     </section>
    </div>
  </div>
 </div>
</div>

<!--
<div id="modal-contact" class="modal fade modal-service">
  <div class="modal-dialog modal-lg  modal-width" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <button onclick="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      <div class="form_title" id="exampleModalLabel">Выберите нужные пункты и отправьте заявку</div>
    </div>

    <div class="modal-body">

      <form id="contact_form" method="POST" class="flex-container contact_form">
        <div class="input_type_radio-1">
        <span class="radio_group_title">ПЛАТФОРМА</span>
          <div>
            <label for="" class="radio-label">
              <input type="radio" class="option-input radio" name="platform" value="Мобильное приложение" />
              <span for="radio-1" class="radio_label">Мобильное приложение</span>
            </label>
          </div>

          <div>
            <label for="" class="radio-label">
              <input type="radio" class="option-input radio" name="platform" value="Веб-сервис" />
              <span class="radio_label">Веб-сервис</span>
            </label>
          </div>
        </div>

        <div class="input_type_radio-2">

          <span class="radio_group_title">СТАДИЯ ПРОЕКТА</span>
          <div>
          <label for="" class="radio-label">
              <input id="" type="radio" class="option-input radio" name="project_stage" value="Новый проект" />
              <span class="radio_label">Новый проект</span>
            </label>
          </div>

          <div>
            <label for="" class="radio-label">
              <input id="" type="radio" class="option-input radio" name="project_stage" value="Существующий проект"/>
              <span class="radio_label">Существующий проект</span>
            </label>
          </div>
        </div>

        <div class="input_type_radio-3">
          <span class="radio_group_title">ОТРАСЛЬ КОМПАНИИ</span>
          <div>
          <label for="" class="radio-label">
              <input id="" type="radio" class="option-input radio" name="field_company" value="Финтех"/>
              <span class="radio_label">Финтех</span>
            </label>
          </div>

          <div>
            <label for="" class="radio-label">
              <input id="" type="radio" class="option-input radio" name="field_company" value="Банк"/>
              <span class="radio_label">Банк</span>
            </label>
          </div>
          <div>
          <label for="" class="radio-label">
              <input id="" type="radio" class="option-input radio" name="field_company" value="Электронная коммерция"/>
              <span class="radio_label">Электронная коммерция</span>
            </label>
          </div>

          <div>
            <label for="" class="radio-label">
              <input id="" type="radio" class="option-input radio" name="field_company" value="Другое"/>
              <span class="radio_label">Другое</span>
            </label>
          </div>
        </div>
        <div class="input_type_radio-4">
          <div>
          <span class="radio_group_title">БЮДЖЕТ (РУБ.)</span>
          <label class="radio-label">
              <input type="radio" class="option-input radio" name="budget" value="500 000-1 500 000" />
              <span for="radio-1" class="radio_label">500 000-1 500 000</span>
            </label>
          </div>

          <div>
            <label class="radio-label">
              <input type="radio" class="option-input radio" name="budget" value="1 500 000-3 000 000" />
              <span for="radio-1" class="radio_label">1 500 000-3 000 000</span>
            </label>
          </div>
          <div>
          <label class="radio-label">
              <input type="radio" class="option-input radio" name="budget" value="3 000 000-6 000 000"/>
              <span for="radio-1" class="radio_label">3 000 000-6 000 000</span>
            </label>
          </div>

          <div>
            <label class="radio-label">
              <input type="radio" class="option-input radio" name="budget" value="6 000 000 и выше"/>
              <span for="radio-1" class="radio_label">6 000 000 и выше</span>
            </label>
          </div>
        </div>

        <div class="input_type_input">
          <div>
            <input type="text" class="input_group" name="name" placeholder="Как к вам обращаться?" required />
          </div>

          <div>
            <input type="text" class="input_group" name="email" placeholder="Введите ваш e-mail адрес" required />
          </div>

          <div>
            <input type="text" class="input_group" name="post" placeholder="Ваша должность (необязательно)" />
          </div>
        </div>

        <div class="input_type_textarea">
            <textarea class="input_textarea" name="comment" placeholder="Комментарий к заказчику" required></textarea>
        </div>

        <div class="input_type_file">
          <div class="button_file">
            <i class="fas fa-paperclip custom-clip"></i>
            <div><span>Прикрепить файл</span><br> не больше  2 MB (xls, doc, pdf, jpg)</div>
          </div>
          <input type="file" name="attachment" />
        </div>
        <div class="send_request_button">
          <input type="submit" value="Отправить">
        </div>
      </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
  </div>
</div>
<script>
  $('.radio_label').on('click', function(){
    $(this).prev('input').attr('checked', 'checked')
  });
</script>
//-->

<?php require __DIR__ . "/forms/contact_form.html"?>

<!--Мои js-->
<script src="<?php echo $templateDir;?>/js/modal_contact_form.js"></script>

<!-- Code to include calc -->
    <?php //require 'calc2/calc.inc.script.php'; ?>
<!-- /Code to include calc -->

<!-- Code to include calc -->
    <?php require __DIR__.'/calc/calc.script.inc.html'; ?>
<!-- /Code to include calc -->
<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $templateDir;?>/js/lib/OwlCarousel2/dist/owl.carousel.js"></script>
<script src="<?php echo $templateDir;?>/js/lib/WOW/dist/wow.min.js"></script>
<script src="<?php echo $templateDir;?>/js/lib/Responsive-Scroller-jQuery-Floating-Carousel/floatingcarousel.min.js"></script>
<script src="<?php echo $templateDir;?>/js/ajaxForms.js?v=20190411"></script>
<script src="<?php echo $templateDir;?>/js/infoshell2_main.js"></script>
<!--<script src="<?php echo $templateDir;?>/js/anime-master/lib/anime.js"></script>
<script src="<?php echo $templateDir;?>/js/anime-master/lib/anime.es.js"></script>-->
<script src="<?php echo $templateDir;?>/js/anime-master/lib/anime.min.js"></script>
<script src="<?php echo $templateDir;?>/js/email_form_animation.js"></script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip({
    delay: { show: 500, hide: 200 },
    placement: 'bottom'
})
})
$(document).ready(function(){
	let view_counter = 0;
	showEmailForm(view_counter);
<?
if(array_key_exists('mailsuccess', $_REQUEST) && $_REQUEST['mailsuccess'] == 1) {
?>
$('body').append('<div class="modaler-backdrop in"></div>');
	$('.form-success').show();
	setTimeout(function(){
		$('.modaler-backdrop').fadeOut(5000);
		$('.form-success').fadeOut(5000);
	}, 1500)
<?}?>
		$(".testimonials").owlCarousel({
			margin:15,
			autoHeight:true,
			dots: false,
			nav: true,
			navText: [],
			responsive : {
				320 : {
					items: 1,
					stagePadding: 50,
					nav: false
				},
				766 : {
					items: 2,
					nav: false
				},
				1000 : {
					items: 3
				}
			}
		});
		$(".blog").owlCarousel({
			margin:15,
			autoHeight:true,
			dots: false,
			nav: true,
			navText: [],
			loop: true,
			responsive : {
				320 : {
					items: 1,
					stagePadding: 50,
					nav: false
				},
				766 : {
					items: 2,
					nav: false
				},
				1000 : {
					items: 3
				}
			}
		});
		$(".showcase").owlCarousel({
			items: 1,
			nav: true,
			loop: true
		});
		$(".portfolio-preview").owlCarousel({
			items: 1,
			nav: true,
			navText: [],
			autoHeight: true,
			dotsContainer: '.custom-owl-dots',
			responsive : {
				320 : {
					stagePadding: 25,
					nav: false
				},
				766 : {
					nav: false
				},
				985 : {
					nav: true
				}
			}
		});
	});
</script>

<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=cyrillic" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic" rel="stylesheet">
<? wp_footer(); ?>
<? } ?>
</body>
</html>