<?
/*
Template name: Blog
*/
?>
<? get_header(); ?>
<section>
	<div class="container">
		<div class="row">
			<h1 class="page-title">Статьи</h1>
			<? $args = array( 'posts_per_page' => 999, 'post_type' => 'post', 'order' => 'ASC');
			$posts_array = get_posts( $args );
			foreach ($posts_array as $key=>$post)
			{
			?>
			<div class="col-12">
				<h4 class="box-title"><? echo $post->post_title; ?></h4>
				<p><? echo $post->post_content; ?></p>
			</div>
			<? } ?>
		</div>
	</div>
</section>
<? get_footer(); ?>