<?

get_header(); ?>
<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 breadcrumbs">
<? bcn_display(); ?>
</div>
<?
$banner = get_field('баннер_страницы', 7);
		$banner_title = get_field('запись_на_баннере', 7);
?>
		<script>
			$('.parallax-window').parallax({imageSrc: '<? echo $banner['url']; ?>'});
			$('#banner_title').html('<? echo $banner_title; ?>');
		</script>
<section id="main-content">
<? do_action('left_sidebar'); ?>
	<div class="col col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9" id="content">
	    <h1>Услуги</h1>
<?

	$args = array( 'posts_per_page'   => 999, 'post_type' => 'services', 'order' => 'ASC');
	$posts_array = get_posts( $args );

  //оставляем только корневые посты
	foreach ($posts_array as $key => $posts_item) {
    if (/* empty($posts_item->post_content) || */ !empty($posts_item->post_parent)) {
      unset($posts_array[$key]);
    }
    if ($posts_item->ID == 3390) unset($posts_array[$key]);
  }

	foreach ($posts_array as $key=>$post)
	{
		$icon = get_field('иконка', $post->ID);
?>
		<div class="col col-12 col-sm-12" style="min-height: 95px;">
			<table>
				<tr>
					<td style="width: 100px; text-align: center; vertical-align:top; padding-top: 15px;"><img src="<? echo $icon['url']; ?>" alt="<? echo $icon['alt']; ?>" style="max-height: 70px; max-width: 70px;"></td>
					<td style="padding: 10px;">
						<a href="<? echo get_post_permalink($post->ID); ?>" class="serv_link" style="margin-bottom:10px; display:inline-block;"><? echo $post->post_title; ?></a>
						<p style="font-size:14px;margin-bottom:0px;"><? echo get_field('краткое_описание', $post->ID); ?></p>
					</td>
				</tr>
			</table>
		</div>
<?  } ?>
	</div>
<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>