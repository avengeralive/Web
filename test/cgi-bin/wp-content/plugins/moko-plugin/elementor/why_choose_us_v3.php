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
class Why_Choose_Us_V3 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_why_choose_us_v3';
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
        return esc_html__('Moko Why Choose Us V3', 'moko');
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
        return 'eicon-image-before-after';
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
            'why_choose_us_v3',
            [
                'label' => esc_html__('Why Choose Us V3', 'moko'),
            ]
        );
		$this->add_control(
            'why_choose_us',
            [
                'label'   => esc_html__('Why Choose Us', 'moko'),
                'type' => Controls_Manager::REPEATER,
                'default' =>
                    [
						['title' => esc_html__('Best Security', 'moko')],
                		['title' => esc_html__('Risk Manage', 'moko')],
                		['title' => esc_html__('Growth Revenue', 'moko')],
                		['title' => esc_html__('Great Support', 'moko')],
                    ],
                'fields' =>
                    [
						[
                            'name' => 'title',
                            'label' => esc_html__('Title', 'moko'),
                            'type' => Controls_Manager::TEXT,
							'label_block' => true,
                        ],
						[
                            'name' => 'link',
							'label' => esc_html__('Link', 'moko'),
							'type' => Controls_Manager::URL,
							'placeholder' => esc_html__('https://your-link.com/', 'moko'),
							'show_external' => true,
							'default' => [
								'url' => '',
								'is_external' => true,
								'nofollow' => true,
							],
						],
						[
							'name' => 'icon',
							'label' => esc_html__('Select Icon', 'aundri'),
							'type' => Controls_Manager::SELECT2,
							'label_block' => true,
							'options' => get_fontawesome_icons(),
						],
						[
                            'name' => 'text',
                            'label' => esc_html__('Text', 'moko'),
                            'type' => Controls_Manager::TEXTAREA,
                        ],
                    ],
				'title_field' => '{{title}}',
            ]
        );
		$this->add_control(
            'subtitle',
            [
                'label'       => esc_html__('Sub Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
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
            'features',
            [
                'label'   => esc_html__('Features', 'moko'),
                'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
                'default' =>
                    [
						
                    ],
                'fields' =>
                    [
						[
                            'name' => 'text',
                            'label' => esc_html__('Text', 'moko'),
                            'type' => Controls_Manager::TEXTAREA,
                        ],
                    ],
            ]
        );
		$this->add_control(
            'show_more',
            [
                'label'     => esc_html__('Show / Hide Button', 'moko'),
                'type'      => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
		$this->add_control(
            'btn_title',
            [
                'label'       => esc_html__('Button Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'separator' => 'before',
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
				'condition' => [
                    'show_more' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button URL', 'moko'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com/', 'moko'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
				'condition' => [
                    'show_more' => 'yes'
                ]
            ]
        );
		$this->add_control(
            'btn_style',
            [
                'label'   => esc_html__('Button Style', 'moko'),
                'type'    => Controls_Manager::SELECT2,
                'default' => 'five',
                'options' => moko_button_style(),
				'condition' => [
                    'show_more' => 'yes'
                ]
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

		<!-- Services Section Three -->
		<section class="services-section-three">
			<div class="pattern-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-8.png'); ?>)"></div>
			<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-9.png'); ?>)"></div>
			<div class="pattern-layer-three" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-10.png'); ?>)"></div>
			<div class="auto-container">
				<div class="row clearfix">
					<!-- Blocks Column -->
					<div class="blocks-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<div class="row clearfix">
								<?php foreach($settings['why_choose_us'] as $key => $item) { ?>
								<!-- Service Block Three -->
								<div class="service-block-three col-lg-6 col-md-6 col-sm-12">
									<div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
										<div class="icon-box">
											<span class="icon <?php echo esc_attr($item['icon']); ?>"></span>
										</div>
										<h5><a href="<?php echo esc_url($item['link']['url']); ?>"><?php echo wp_kses($item['title'], $allowed_html); ?></a></h5>
										<div class="text"><?php echo wp_kses($item['text'], $allowed_html); ?></div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<!-- Content Column -->
					<div class="content-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<!-- Sec Title -->
							<div class="sec-title">
								<?php if($settings['subtitle']){ ?>
								<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
								<?php } ?>
								<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
							</div>
							<div class="bold-text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
							
							<?php if($settings['features']) { ?>
							<ul class="list-style-three">
								<?php foreach($settings['features'] as $key => $item) { ?>
								<li><?php echo wp_kses($item['text'], $allowed_html); ?></li>
								<?php } ?>
							</ul>
							<?php } ?>
							
							<?php if($settings['btn_link']['url'] and $settings['btn_title']){ ?>
							<a href="<?php echo esc_url($settings['btn_link']['url'] ); ?>" class="theme-btn btn-style-<?php echo esc_attr($settings['btn_style']); ?>"><span class="txt"><?php echo wp_kses($settings['btn_title'], $allowed_html); ?></span></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Services Section Three -->

        <?php
    }
}
