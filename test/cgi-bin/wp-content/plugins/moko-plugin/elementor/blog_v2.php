<?php namespace MOKOPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Blog_V2 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_blog_v2';
    }

    /**
     * Get widget title.
     * Retrieve button widget title.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Moko Blog V2', 'moko');
    }

    /**
     * Get widget icon.
     * Retrieve button widget icon.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-form-vertical';
    }

    /**
     * Get widget categories.
     * Retrieve the list of categories the button widget belongs to.
     * Used to determine where to display the widget in the editor.
     *
     * @since  2.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'moko' ];
    }

    /**
     * Register button widget controls.
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'blog_v2',
            [
                'label' => esc_html__('Blog V2', 'moko'),
            ]
        );
		$this->add_control(
            'subtitle',
            [
                'label'       => esc_html__('Sub Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'text',
            [
                'label'       => esc_html__('Text', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__('Number of Post', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_orderby',
            [
                'label'   => esc_html__('Order By', 'moko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date'       => esc_html__('Date', 'moko'),
                    'title'      => esc_html__('Title', 'moko'),
                    'menu_order' => esc_html__('Menu Order', 'moko'),
                    'rand'       => esc_html__('Random', 'moko'),
                ),
            ]
        );
        $this->add_control(
            'query_order',
            [
                'label'   => esc_html__('Order', 'moko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'DESC' => esc_html__('DESC', 'moko'),
                    'ASC'  => esc_html__('ASC', 'moko'),
                ),
            ]
        );
        $this->add_control(
            'query_category',
            [
                'label' => esc_html__('Category', 'moko'),
                'type' => Controls_Manager::SELECT,
                'options' => get_categories_list(),
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render button widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed_html = wp_kses_allowed_html('post');

        $this->add_render_attribute('wrapper', 'class', 'themerange-moko');
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => moko_set($settings, 'query_number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
        );

        if( moko_set($settings, 'query_category') ) $args['category_name'] = moko_set($settings, 'query_category');
        $query = new \WP_Query($args);
		
        if($query->have_posts() ) { ?>
        
		<!-- News Section Two -->
		<section class="news-section-two style-two">
			<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-24.png'); ?>)"></div>
			<div class="auto-container">
				<!-- Sec Title -->
				<div class="sec-title centered">
					<?php if($settings['subtitle']){ ?>
					<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
					<?php } ?>
					<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
					<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
				</div>

				<div class="row clearfix">
					<?php global $post;
					while ($query->have_posts() ) : $query->the_post(); ?>
					<!-- News Block Two / Style Two -->
					<div class="news-block-two style-two col-lg-4 col-md-6 col-sm-12">
						<div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
							<?php if( has_post_thumbnail() ) { ?>
							<div class="image">
								<?php the_post_thumbnail('moko_370x270'); ?>
								<!-- Overlay Box -->
								<div class="overlay-box">
									<div class="overlay-inner">
										<div class="content">
											<a href="<?php echo esc_url(get_permalink(get_the_id())); ?>" class="icon flaticon-unlink"></a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="lower-content">
								<ul class="post-meta">
									<li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><span class="icon fa fa-user"></span> <?php the_author(); ?></a></li>
									<li><a href="<?php echo esc_url(get_month_link(get_the_date('Y'), get_the_date('m'))); ?>"><span class="icon fa fa-calendar"></span> <?php echo get_the_date(); ?></a></li>
								</ul>
								<h5><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h5>
								
								<?php if(function_exists('moko_share_us_two')): ?>
								<!-- Social Boxed -->
								<div class="social-boxed">
									<div class="social-inner">
										<span class="share-now fa fa-share-alt"></span>
										<?php echo wp_kses(moko_share_us_two(get_the_id(), $post->post_name), $allowed_html); ?>
									</div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<!-- End News Section Two -->

        <?php }

        wp_reset_postdata();
    }
}
