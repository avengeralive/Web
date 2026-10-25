<?
/*
Template name: Место проведения
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
			
			<div class="cr-section mb-30 mt-30">
				<div class="container">
					<div class="row">
						<div class="col-12 text-center">
							<h2 >Место проведения</h2>
							<p>Место проведения мероприятия: ЦВК «Экспоцентр», павильон2, «Синий зал» (г. Москва,
	Краснопресненская набережная, д.14)</p>
	<p>Центральный выставочный комплекс «Экспоцентр» находится в центре столицы, рядом с
	деловым центром Москва-Сити, в шаговой доступности от метро «Выставочная» и
	«Деловой центр».</p>
	<p>Удобное расположение дает возможность всем участникам мероприятия быстро и
	комфортно добраться до места.</p>
							<div class="button-group">
								<a href="/посетителям/получить-электронный-билет/" class="cr-btn cr-btn-blue">
									<span>Получить электронный билет</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="banner-area banner-slider-active" style="max-height: 600px;">

	            <!-- Single Banner -->
	            <div class="banner justify-content-center align-items-center bg-parallax" style="background-image: url(<? echo get_field('фотка_места', 7); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
	                <div class="container">
	                    
	                </div>
	            </div>
        	</div>

			<div class="cr-section">
				<div class="row">
					<div class="col-12">
						<iframe src="https://yandex.ru/map-widget/v1/-/CBuZEIa1XD" width="100%" height="400" frameborder="1" allowfullscreen="true"></iframe>
					</div>
				</div>
			</div>

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>