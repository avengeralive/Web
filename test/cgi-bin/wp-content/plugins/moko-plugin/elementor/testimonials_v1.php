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
class Testimonials_V1 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_testimonials_v1';
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
        return esc_html__('Moko Testimonials V1', 'moko');
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
        return 'eicon-testimonial';
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
            'testimonials_v1',
            [
                'label' => esc_html__('Testimonials V1', 'moko'),
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
            'text_limit',
            [
                'label'   => esc_html__('Text Limit', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 20,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__('Number of Post', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
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
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'moko'),
                'options' => get_categories_list('testimonials_cat')
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
            'post_type'      => 'testimonials',
            'posts_per_page' => moko_set($settings, 'query_number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
        );

        if( moko_set($settings, 'query_category') ) $args['testimonials_cat'] = moko_set($settings, 'query_category');
        $query = new \WP_Query($args);

        if($query->have_posts()) { ?>

		<!-- Testimonial Section -->
		<section class="testimonial-section">
			<div class="icon-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-3.png'); ?>)"></div>
			<div class="icon-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-7.png'); ?>)"></div>
			<div class="icon-layer-three" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-8.png'); ?>)"></div>
			<div class="icon-layer-four" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-9.png'); ?>)"></div>
			<div class="icon-layer-five" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-10.png'); ?>)"></div>
			<div class="auto-container">
				<!-- Sec Title -->
				<div class="sec-title centered">
					<?php if($settings['subtitle']){ ?>
					<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
					<?php } ?>
					<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
					<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
				</div>

				<div class="testimonial-carousel owl-carousel owl-theme">
					<?php while ($query->have_posts() ) : $query->the_post(); ?>
					<!-- Testimonial Block -->
					<div class="testimonial-block">
						<div class="inner-box">
							<div class="pattern-layer"></div>
							<div class="author-image-outer">
								<?php if( has_post_thumbnail() ) { ?>
								<div class="author-image">
									<?php the_post_thumbnail('moko_112x112'); ?>
								</div>
								<?php } ?>
								<?php $rating = get_post_meta( get_the_id(), 'testimonial_rating', true );
								if(!empty($rating)){ ?>
									<div class="rating">
										<?php for ($x = 1; $x <= 5; $x++) {
											if($x <= $rating) echo '<span class="fa fa-star"></span>'; else echo '<span class="fa fa-star dark"></span>';
										} ?>
									</div>
								<?php } ?>
								
								<div class="text"><?php echo wp_kses(moko_trim(get_the_content(), $settings['text_limit']), $allowed_html); ?></div>
								<div class="lower-box">
									<div class="quote-icon fa fa-quote-left"></div>
									<h6><?php the_title(); ?></h6>
									<div class="designation"><?php echo wp_kses(get_post_meta( get_the_id(), 'designation', true ), $allowed_html); ?></div>
								</div>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<!-- End Testimonial Section -->

        <?php }

        wp_reset_postdata();
    }
}
