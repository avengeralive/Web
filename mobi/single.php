<?php
get_header('standart');
the_post();
?>
<section class="section section-lg bg-default">
	<div class="container container-bigger product-single">
		<div class="row row-fix justify-content-sm-center justify-content-lg-between row-30 align-items-lg-center">
			<div class="col-lg-5 col-xl-6 col-xxl-5">
				<div class="product-single-preview">
					<div class="unit flex-column flex-md-row align-items-md-center unit-spacing-md-midle unit--inverse unit-sm">
						<div class="unit-body">
		                    <ul class="product-thumbnails">
		                      	<li class="active" data-large-image="<? echo get_field('день_фотка', get_the_ID()); ?>"><img src="http://www.ballwatch.com/global/images/sun.png" alt="" width="50" height="50"></li>
		                      	<li data-large-image="<? echo get_field('ночь_фотка', get_the_ID()); ?>"><img src="http://www.ballwatch.com/global/images/moon.png" alt="" width="50" height="50"></li>
		                    </ul>
						</div>
						<div class="unit-right product-single-image">
							<div class="product-single-image-element"><img class="product-image-area animateImageIn" src="<? echo get_field('день_фотка', get_the_ID()); ?>" style="width:100%;" alt=""></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-7 col-xl-6 col-xxl-6 text-center text-lg-left">
				<div class="heading-5"><? echo get_field('коллекция', get_the_ID()); ?></div>
              	<h3><? the_title(); ?></h3>
				<div class="divider divider-default"></div>
				<? the_content(); ?>
				<h4 style="margin-top: 30px;">Механизм</h4>
				<ul>
					<? foreach (get_field('механизм', get_the_ID()) as $elem) { ?>
					<li><p class="text-spacing-sm offset-0"><? echo $elem['элемент']; ?></p></li>
					<? } ?>
				</ul>
				<h4 style="margin-top: 30px;">Функции</h4>
				<ul>
					<? foreach (get_field('функции', get_the_ID()) as $elem) { ?>
					<li><p class="text-spacing-sm offset-0"><? echo $elem['элемент']; ?></p></li>
					<? } ?>
				</ul>
				<h4 style="margin-top: 30px;">Ударостойкость</h4>
				<ul>
					<? foreach (get_field('ударостойкость', get_the_ID()) as $elem) { ?>
					<li><p class="text-spacing-sm offset-0"><? echo $elem['элемент']; ?></p></li>
					<? } ?>
				</ul>
				<h4 style="margin-top: 30px;">Водонепроницаемость</h4>
				<ul>
					<? foreach (get_field('водонепроницаемость', get_the_ID()) as $elem) { ?>
					<li><p class="text-spacing-sm offset-0"><? echo $elem['элемент']; ?></p></li>
					<? } ?>
				</ul>
				<h4 style="margin-top: 30px;">Корпус</h4>
				<ul>
					<? foreach (get_field('корпус', get_the_ID()) as $elem) { ?>
					<li><p class="text-spacing-sm offset-0"><? echo $elem['элемент']; ?></p></li>
					<? } ?>
				</ul>
				<h4 style="margin-top: 30px;">Ремешок/браслет</h4>
				<ul>
					<? foreach (get_field('ремешок_браслет', get_the_ID()) as $elem) { ?>
					<li><p class="text-spacing-sm offset-0"><? echo $elem['элемент']; ?></p></li>
					<? } ?>
				</ul>
				<h4 style="margin-top: 30px;">Циферблат</h4>
				<ul>
					<? foreach (get_field('циферблат', get_the_ID()) as $elem) { ?>
					<li><p class="text-spacing-sm offset-0"><? echo $elem['элемент']; ?></p></li>
					<? } ?>
				</ul>
			</div>
		</div>
	</div>
</section>
<?
get_footer();
?>