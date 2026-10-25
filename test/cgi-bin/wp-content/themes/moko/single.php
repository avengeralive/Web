<?php
/**
 * Blog Post Main File.
 *
 * @package MOKO
 * @author  Noor Tech
 * @version 1.0
 */

get_header();
$data    = \MOKO\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-lg-8 col-md-12 col-sm-12';
$options = moko_WSH()->option();

if ( class_exists( '\Elementor\Plugin' ) && $data->get( 'tpl-type' ) == 'e') {
	
	while(have_posts()) {
	   the_post();
	   the_content();
    }

} else { ?>

<?php if ( class_exists( '\Elementor\Plugin' )): ?>
	<?php do_action( 'moko_banner', $data ); ?>
<?php else: ?>

<!-- Page Title Section -->
<section class="page-title" style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>)">
	<?php if($data->get( 'banner' )) { ?>
	<div class="pattern-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/main-slider/pattern-1.png'); ?>)"></div>
	<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-17.png'); ?>)"></div>
	<div class="pattern-layer-three" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-18.png'); ?>)"></div>
	<div class="pattern-layer-four" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/cross-icon.png'); ?>)"></div>
	<?php } ?>
	<div class="auto-container">
		<h2><?php if( $data->get( 'title' ) ) echo wp_kses( $data->get( 'title' ), true ); else wp_title( '' ); ?></h2>
		<ul class="page-breadcrumb">
			<?php echo moko_the_breadcrumb(); ?>
		</ul>
	</div>
</section>
<!-- End Page Title Section -->

<?php endif; ?>

<!-- Sidebar Page Container -->
<div class="sidebar-page-container">
	<div class="auto-container">
		<div class="row clearfix">
        	<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'moko_sidebar', $data );
				}
			?>
			
            <div class="content-side <?php echo esc_attr( $class ); ?>">
				<?php while ( have_posts() ) : the_post(); ?>
                <div class="news-detail">
                    <div class="thm-unit-test">
						
						<div class="inner-box">
							<div class="image">
								<?php the_post_thumbnail('full'); ?>
							</div>
							<div class="lower-content">
								<?php if( $options->get( 'single_post_meta' ) ): ?>
								<ul class="post-meta">
									<li><span class="icon fa fa-user"></span> <?php the_author(); ?></li>
									<li><span class="icon fa fa-calendar"></span> <?php the_date(); ?></li>
								</ul>
								<?php endif; ?>
								
								<div class="text">
									<?php the_content(); ?>
									<div class="clearfix"></div>
									<?php wp_link_pages(array('before'=>'<div class="paginate-links m-b30">'.esc_html__('Pages: ', 'moko'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
								</div>
								
								<!-- Post Share Options-->
								<div class="post-share-options">
									<div class="post-share-inner clearfix">
										<?php if( $options->get( 'single_post_tag' ) ): ?>
										<div class="pull-left">
											<div class="post-title"><?php esc_html_e('Tags:', 'moko'); ?></div>
											<ul class="tags">
												<?php the_tags( '<li>', ',</li><li> ', '</li>' ); ?>
											</ul>                               
										</div>
										<?php endif; ?>
										
										<!--Social Media-->
										<?php if(function_exists('moko_share_us')):
											echo wp_kses(moko_share_us(get_the_id(), $post->post_name ), true);
										endif; ?>
									</div>
								</div>
							</div>
						</div>
						
						<?php if( $options->get( 'single_post_author' ) ): ?>
						<!-- Author Box -->
						<div class="authors-box">
							<div class="author-inner">
								<?php if($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE): ?>
								<div class="thumb"><?php echo get_avatar(get_the_author_meta('ID'), 200); ?></div>
								<?php endif; ?>
								<div class="author"><?php esc_html_e('Author', 'moko'); ?></div>
								<h4 class="name"><?php the_author(); ?></h4>
								<div class="text"><?php the_author_meta( 'description', get_the_author_meta('ID') ); ?></div>
							</div>
						</div>
						<?php endif; ?>
						
                        <!--End Single blog Post-->
                        <?php comments_template(); ?>
                	</div>
                </div>
				<?php endwhile; ?>
            </div>
			
        	<?php
				if ( $data->get( 'layout' ) == 'right' ) {
					do_action( 'moko_sidebar', $data );
				}
			?>
        </div>
    </div>
</div>
<!--End blog area--> 

<?php
}
get_footer();
