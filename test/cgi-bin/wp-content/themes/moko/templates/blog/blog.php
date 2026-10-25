<?php

/**
 * Blog Content Template
 *
 * @package    WordPress
 * @subpackage MOKO
 * @author     Noor Tech
 * @version    1.0
 */

if ( class_exists( 'Moko_Resizer' ) ) {
	$img_obj = new Moko_Resizer();
} else {
	$img_obj = array();
}
$allowed_tags = wp_kses_allowed_html('post');
global $post;

?>

<?php $format = get_post_format(get_the_id()); ?>
<div <?php post_class(); ?>>
	
	<?php if ($format == 'link') {
	$link = get_post_meta(get_the_id(), 'link', true); ?>
	<!-- News Block Four -->
	<div class="news-block-four">
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<div class="inner-box" style="background-image:url(<?php echo esc_url($image[0]); ?>)">
			<div class="post-date"><?php echo get_the_date('d'); ?> <span><?php echo get_the_date('M'); ?></span></div>
			<ul class="post-info">
				<li><span class="author-image"><?php echo get_avatar(get_the_author_meta('ID'), 40); ?></span><?php esc_html_e('By:', 'moko'); ?> <?php the_author(); ?></li>
				<?php $term_list = wp_get_post_terms(get_the_id(), 'category', array("fields" => "names")); ?>
				<li><?php esc_html_e('Category:', 'moko'); ?> <span class="theme_color"><?php echo implode( ', ', (array)$term_list ); ?></span></li>
				<li><?php esc_html_e('Comments:', 'moko'); ?> <?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></li>
			</ul>
			<h3><a href="<?php echo esc_url( the_permalink( get_the_id() ) ); ?>"><?php the_title(); ?></a></h3>
		</div>
	</div>
	
	<?php } else { ?>
	
	<!-- News Block Two -->
	<div class="news-block-three">
		<div class="inner-box">
			
			<?php if ($format == 'gallery') { ?>
			
			<div class="single-item-carousel owl-carousel owl-theme">
				<?php $gall_images = (get_post_meta(get_the_id(), 'gallery_imgs', true));
        			$gall_images = explode(',', $gall_images);
        			if ($gall_images) :
        			foreach ($gall_images as $gall) :
        		?>
				<div class="slide-item">
					<?php echo (wp_get_attachment_image($gall, 'moko_1170x450'));  ?>
				</div>
				<?php endforeach; endif; ?>
			</div>
			
			<?php } else if ($format == 'audio') {
			$audio = get_post_meta(get_the_id(), 'audio', true); ?>
			
			<div class="image">
				<div class="media-player">
					<p><?php echo do_shortcode($audio); ?></p>
				</div>
			</div>
			
			<?php } else if ($format == 'quote') {
			$quote = get_post_meta(get_the_id(), 'quote', true); ?>
			
			<div class="image">
				<blockquote class="post-format-quote">
					<span class="icon fa fa-quote-left"></span>
					<?php echo wp_kses($quote, $allowed_tags); ?>
				</blockquote>
			</div>
			
			<?php } else if ($format == 'video') {
			$video = get_post_meta(get_the_id(), 'video', true); ?>
			
			<div class="image">
				<?php the_post_thumbnail('moko_770x400'); ?>
				<a href="<?php echo do_shortcode($video); ?>" class="lightbox-image overlay-box"><span class="icon flaticon-play-button"><i class="ripple"></i></span></a>
			</div>
			
			<?php } else { ?>
			
			<div class="image">
				<a href="<?php echo esc_url( the_permalink( get_the_id() ) ); ?>"><?php the_post_thumbnail('full'); ?></a>
			</div>
			
			<?php } ?>
			
			<div class="lower-content">
				<ul class="post-meta">
					<li><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><span class="icon fa fa-user"></span> <?php the_author(); ?></a></li>
					<li><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><span class="icon fa fa-calendar"></span> <?php echo get_the_date(); ?></a></li>
				</ul>
				<h4><a href="<?php echo esc_url( the_permalink( get_the_id() ) ); ?>"><?php the_title(); ?></a></h4>
				<div class="text"><?php the_excerpt(); ?></div>
				<div class="btn-box">
					<div class="btn-box-inner">
						<a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>" class="theme-btn btn-style-five"><span class="txt"><?php esc_html_e('Learn More', 'moko'); ?></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php } ?>
	
</div>