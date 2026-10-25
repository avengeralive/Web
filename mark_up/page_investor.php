<?php
/*
Template Name: Страница "Инвестору"
*/
get_header(); ?>

<style>
@media screen and (max-width: 450px) {
	.header-img{margin-top: 99px; padding-bottom: 34px;}
	.header-img img{top: 0px!important;}
}
</style>

    <div class="investor-slider">
        <?
        //слайдер в шапке
        $posts = get_posts(array(
            'category_name'=>'investor_slider',
            'orderby'=>'date',
            'order'=>'DESC',
        ));

        $showSlyderTitles = true;

        include(locate_template('new_slider_header.php'));
        ?>
    </div>


	<section id="section_0">
		<div class="color_next-block color-block-info yellow2-block">
			<div class="container">
				<h2>Инвестиции в IT-сектор</h2>
				<div style="" class=" text-center">Для тех, кто рассматривает ИТ-рынок как объект венчурного инвестирования, ищет возможность вложения своих денег в высокотехнологичный бизнес.
</div>
			</div>
		</div>
	</section>

    <section id="section_2">
        <div class="white-block investor">

            <div class="container ">
                <h2>Мы предлагаем:</h2>
                <div class="row clearfix">

                    <div class="col-md-2 col-sm-4 text-center">
                        <div class="round-arrow-item no-arrow">
                            <i class="win-step-text">1</i>
                            <span>Подборку ИТ- проектов согласно вашим критериям из нашей базы</span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4 text-center">
                        <div class="round-arrow-item no-arrow">
                            <i class="win-step-text">2</i>
                            <span>Партнеров по со-инвестированию в проект, если требуется</span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4 text-center">
                        <div class="round-arrow-item no-arrow">
                            <i class="win-step-text">3</i>
                            <span>Аналитику выбранной ниши</span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4 text-center">
                        <div class="round-arrow-item no-arrow">
                            <i class="win-step-text">4</i>
                            <span>Экспертную оценку проекта </span>
                        </div>
                    </div>


                    <div class="col-md-2 col-sm-4 text-center">
                        <div class="round-arrow-item no-arrow">
                            <i class="win-step-text">5</i>
                            <span>Техническую реализацию</span>
                        </div>
                    </div>


                    <div class="col-md-2 col-sm-4 text-center">
                        <div class="round-arrow-item no-arrow">
                            <i class="win-step-text " >6</i>
                            <span>Рекомендации по выводу на рынок</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="merge">
                <div class="arrow"></div>
            </div>

            <div class="yellow_box" style="margin-bottom: 130px">
                Готовый к инвестированию проект и профессиональную команду
            </div>
        </div>
    </section>

    <section id="section_0">
        <div class=" color-block-info yellow-block">
            <div class="container">
                <h2>Преимущества вложения средств в ИТ:</h2>
                <div  class=" text-center">ИТ - рынок на сегодняшний день является  самым перспективным и быстро растущим. Он позволяет реализовывать проекты с высоким показателем окупаемости в максимально короткие сроки.
                    <b>Только в ИТ- сфере</b> есть возможность получить  за первый год после запуска проекта <b>прибыль в сотни раз больше</b>, чем первоначальная сумма инвестирования.

                </div>
            </div>
        </div>
    </section>

    <section id="section_1">
        <div class="help-in-dev block-with-bg parallax"  data-stellar-background-ratio="0.5">
            <div class="container startup">
                <h2>Ваши шаги по инвестированию:</h2>
                <div class="row clearfix">
                    <div class="col-md-3 text-center">
                        <div class="round-arrow-item">
                            <i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon1.png" alt=""></i>
                            <span>Привлечем деньги для <br>финансирования проекта</span>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="round-arrow-item no">
                            <i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon2.png" alt=""></i>
                            <span>Доработаем<br>бизнес-модель</span>
                        </div>
                    </div>
                    <div class="m_clear"><!--//--></div>
                    <div class="col-md-3 text-center">
                        <div class="round-arrow-item">
                            <i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon3.png" alt=""></i>
                            <span>Разработаем<br>проект</span>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="round-arrow-item no-arrow">
                            <i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon4.png" alt=""></i>
                            <span style="font-size:18px;line-height:24px;padding-top:3px;">Дадим рекомендации<br>по продвижению</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



	<section id="section_6">
		<div class="color-block-info yellow-block">
			<div class="container">
				<div class=" text-center"><a href="#leave-review" class="btn-white2 js-leave-review">Отправить заявку</a></div>
			</div>
		</div>
		<div class="color-block-info white-block-container content none" id="leave-review">
			<div class="container">
				<form name="frm2" id="invform1" class="review-form none" method='post' action='<?php echo get_template_directory_uri(); ?>/mail/send.php' enctype='multipart/form-data'>
					<div class="form-success none">Спасибо за заявку! Наши менеджеры свяжутся с вами<br> в ближайшее время!</div>
					<div class="row clearfix">
						<div class="col-md-4"><input type="text" value="" name="name" placeholder="Имя"></div>
						<div class="col-md-4"><input type="text" value="" name="email" placeholder="E-mail"></div>
						<div class="col-md-4"><input type="text" value="" name="phone" placeholder="Телефон"></div>
					</div>
					<div class="row clearfix">
						<div class="col-md-12"><textarea cols="3" name="message" placeholder="Доп. информация"></textarea></div>
					</div>
					<div class="row clearfix mbupl">
						<div class="col-md-7"></div>
						<div class="col-md-5" >
							<div class="file-upload left">
								<input type="file" name="upload_file" />
								<a href="#" class="btn-yellow upload-icon"><i></i>загрузить тз</a>
							</div>
							<input type="submit" class="btn-yellow" value="отправить" id="sendquest2" />
						</div>
					</div>
				</form>
			</div>
            <script>
                $(document).ready(function(){
                    $('#invform1').submit(function(){

                        yaCounter934261.reachGoal('INVESTOR_1');
                        //console.log('investor');
                    });

                });
            </script>
			<div class="white-block-bottom"></div>
		</div>
	</section>


<?php get_footer(); ?>