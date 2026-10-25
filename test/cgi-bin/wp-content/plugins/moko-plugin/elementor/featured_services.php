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
class Featured_Services extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_featured_services';
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
        return esc_html__('Moko Featured Services', 'moko');
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
        return 'eicon-navigation-horizontal';
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
            'featured_services',
            [
                'label' => esc_html__('Featured Services', 'moko'),
            ]
        );
		$this->add_control(
            'style',
            [
                'label'   => esc_html__('Style', 'moko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'one',
                'options' => array(
                    'one'       => esc_html__('Style One', 'moko'),
                    'two'      => esc_html__('Style Two', 'moko'),
                ),
            ]
        );
        $this->add_control(
            'text_limit',
            [
                'label'   => esc_html__('Text Limit', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 8,
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
                'label' => esc_html__('Category', 'moko'),
                'type' => Controls_Manager::SELECT,
                'options' => get_categories_list('service_cat')
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
            'post_type'      => 'service',
            'posts_per_page' => moko_set($settings, 'query_number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
        );

        if( moko_set($settings, 'query_category')) $args['service_cat'] = moko_set($settings, 'query_category');
        $query = new \WP_Query($args);

        if($query->have_posts()) { ?>

		<?php if($settings['style'] == 'one') { ?>
		<!-- Services Section -->
		<section class="services-section style-two">
			<div class="auto-container">
				<div class="row clearfix">
					<?php while($query->have_posts()) : $query->the_post(); ?>
					<!-- Service Block / Style Two -->
					<div class="service-block style-two col-lg-3 col-md-6 col-sm-12">
						<div class="inner-box wow fadeInRight" data-wow-delay="150ms" data-wow-duration="1500ms">
							<div class="color-layer"></div>
							<div class="pattern-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/service-pattern.png'); ?>)"></div>
							<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/service-pattern-2.png'); ?>)"></div>
							<div class="icon-box">
								<span class="<?php echo esc_attr(get_post_meta( get_the_id(), 'service_icon', true )); ?>"></span>
							</div>
							<h5><a href="<?php echo esc_url(get_post_meta(get_the_id(), 'ext_url', true)); ?>"><?php the_title(); ?></a></h5>
							<div class="text"><?php echo wp_kses(moko_trim(get_the_content(), $settings['text_limit']), $allowed_html); ?></div>
							<a href="<?php echo esc_url(get_post_meta(get_the_id(), 'ext_url', true)); ?>" class="arrow-icon flaticon-arrow-pointing-to-right"></a>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<!-- End Services Section -->

		<?php } else if($settings['style'] == 'two') { ?>

		<!-- Services Section -->
		<section class="services-section margin-top">
			<div class="auto-container">
			<div class="color-layer"></div>
				<div class="row clearfix">
					<?php while($query->have_posts()) : $query->the_post(); ?>
					<!-- Service Block -->
					<div class="service-block col-lg-3 col-md-6 col-sm-12">
						<div class="inner-box wow fadeInRight" data-wow-delay="150ms" data-wow-duration="1500ms">
							<div class="color-layer"></div>
							<div class="pattern-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/service-pattern.png'); ?>)"></div>
							<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/service-pattern-2.png'); ?>)"></div>
							<div class="icon-box">
								<span class="<?php echo esc_attr(get_post_meta( get_the_id(), 'service_icon', true )); ?>"></span>
							</div>
							<h5><a href="<?php echo esc_url(get_post_meta(get_the_id(), 'ext_url', true)); ?>"><?php the_title(); ?></a></h5>
							<div class="text"><?php echo wp_kses(moko_trim(get_the_content(), $settings['text_limit']), $allowed_html); ?></div>
							<a href="<?php echo esc_url(get_post_meta(get_the_id(), 'ext_url', true)); ?>" class="arrow-icon flaticon-arrow-pointing-to-right"></a>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<!-- End Services Section -->
		<?php } ?>
        
        <?php }

        wp_reset_postdata();
    }
}
