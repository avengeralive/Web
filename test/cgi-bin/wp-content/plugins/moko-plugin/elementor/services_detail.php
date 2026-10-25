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
class Services_Detail extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_services_detail';
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
        return esc_html__('Moko Services Detail', 'moko');
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
        return 'eicon-sidebar';
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
            'services_detail',
            [
                'label' => esc_html__('Services Detail', 'moko'),
            ]
        );
		$this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'moko'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
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
		
		//Features
        $this->add_control(
            'f_title',
            [
                'label'       => esc_html__('Features Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'f_text',
            [
                'label'       => esc_html__('Features Text', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		
		//Cost
        $this->add_control(
            'cost_title',
            [
                'label'       => esc_html__('Cost Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'cost_image',
            [
                'label' => esc_html__('Cost Image', 'moko'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );
        $this->add_control(
            'cost_text',
            [
                'label'       => esc_html__('Cost Text', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		
		//SEO
        $this->add_control(
            'seo_title',
            [
                'label'       => esc_html__('SEO Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'seo_text',
            [
                'label'       => esc_html__('SEO Text', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'seo_bottom_text',
            [
                'label'       => esc_html__('SEO Bottom Text', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'seo_image',
            [
                'label' => esc_html__('SEO Image', 'moko'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );
        $this->end_controls_section();
		
		//Sidebar
		$this->start_controls_section(
            'sidebar_tab',
            [
                'label' => esc_html__('Sidebar', 'moko'),
            ]
        );
		$this->add_control(
			'sidebar',
			[
				'label'   => esc_html__('Choose Sidebar', 'moko'),
				'separate' => 'before',
				'type'    => Controls_Manager::SELECT2,
				'default' => 'Choose Sidebar',
				'options'  => moko_get_sidebars(),
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
        $allowed_html = wp_kses_allowed_html('post'); ?>
        
		<!-- Sidebar Page Container -->
		<div class="sidebar-page-container">
			<div class="auto-container">
				<div class="row clearfix">
					
					<!-- Sidebar Side -->
					<div class="sidebar-side left-sidebar col-lg-4 col-md-12 col-sm-12">
						<aside class="sidebar sticky-top">
							<?php dynamic_sidebar($settings['sidebar'] ); ?>
						</aside>
					</div>

					<!-- Content Side -->
					<div class="content-side right-sidebar col-lg-8 col-md-12 col-sm-12">
						<div class="service-detail">
							<div class="inner-box">
								<?php if($settings['image']['id']) { ?>
								<div class="image">
									<img src="<?php echo esc_url(wp_get_attachment_url($settings['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
								</div>
								<?php } ?>
								<div class="lower-content">
									<h3><?php echo wp_kses($settings['title'], $allowed_html); ?></h3>
									<?php echo wp_kses($settings['text'], $allowed_html); ?>
									<h4><?php echo wp_kses($settings['f_title'], $allowed_html); ?></h4>
									<?php echo wp_kses($settings['f_text'], $allowed_html); ?>
									<div class="two-columns">
										<div class="row clearfix">
											<div class="column col-lg-6 col-md-6 col-sm-12">
												<?php if($settings['cost_image']['id']) { ?>
												<div class="image">
													<img src="<?php echo esc_url(wp_get_attachment_url($settings['cost_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
												</div>
												<?php } ?>
											</div>
											<div class="column col-lg-6 col-md-6 col-sm-12">
												<h4><?php echo wp_kses($settings['cost_title'], $allowed_html); ?></h4>
												<?php echo wp_kses($settings['cost_text'], $allowed_html); ?>
											</div>
										</div>
									</div>
									<h4><?php echo wp_kses($settings['seo_title'], $allowed_html); ?></h4>
									<?php echo wp_kses($settings['seo_text'], $allowed_html); ?>
									<div class="two-columns">
										<div class="row clearfix">
											<div class="column col-lg-6 col-md-6 col-sm-12">
												<?php echo wp_kses($settings['seo_bottom_text'], $allowed_html); ?>
											</div>
											<div class="column col-lg-6 col-md-6 col-sm-12">
												<?php if($settings['seo_image']['id']) { ?>
												<div class="image">
													<img src="<?php echo esc_url(wp_get_attachment_url($settings['seo_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- End Sidebar Page Container -->

        <?php
    }
}
