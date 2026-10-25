<?
/*
Template name: Вопросы

*/
get_header(); ?>
<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 breadcrumbs">
<? bcn_display(); ?>
</div>
<section id="main-content">
<? do_action('left_sidebar'); ?>
	<div class="col col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9" id="content">
<?
	while ( have_posts() ) : the_post();
		$banner = get_field('баннер_страницы', get_the_ID());
		$banner_title = get_field('запись_на_баннере', get_the_ID());
?>
		<script>
			$('.parallax-window').parallax({imageSrc: '<? echo $banner['url']; ?>'});
			$('#banner_title').html('<? echo $banner_title; ?>');
		</script>
<?
		the_content();
	endwhile;
?>
		<div class="col col-12 col-sm-8 col-md-9 col-lg-9 col-xl-9" style="padding: 0px;">
			<h1 style="text-align: left;">Ответы на вопросы</h1>
		</div>
		<div class="col col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3" style="padding: 0px;">
			<button class="btn btn-primary action" data-toggle="modal" data-target="#question" style="width: 100%; padding: 10px;" onclick="ym(42761559, 'reachGoal', 'voprospatients'); return true;">Задать вопрос</button>
		</div>
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'questions', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	$i = 1;
	foreach ($posts_array as $key=>$post)
	{
		$question = get_field('вопрос', $post->ID);
		
		$answer = get_field('ответ', $post->ID);
?>	
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 20px; margin-bottom: 20px;">
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;">
				<a style="text-decoration: none; cursor: pointer; color: #004F6F;" onclick="if ($('#q_<? echo $i; ?>').hasClass('active')) { $('#q_<? echo $i; ?>').removeClass('active'); $('#q_<? echo $i; ?>').hide(300); } else { $('#q_<? echo $i; ?>').addClass('active'); $('#q_<? echo $i; ?>').show(300); }"><? echo $i; ?>. <? echo $question; ?><br><br><button class="btn btn-primary action" data-toggle="" data-target="" style="width: 10%; padding: 5px;">Ответ</button></a>
				<br>
				<script>
				jQuery(document).ready(function($){
					$("#question_form").submit(function () {
						ym(42761559, 'reachGoal', 'otpravkavoprospatients'); return true;
					});
				});
				</script>
			</div>
			<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 answer" id="q_<? echo $i; ?>" style="display: none;">
				<? echo $answer; ?>
			</div>
		</div>
<?  $i++; } ?>	
	
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>