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
class Why_Choose_Us_V1 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_why_choose_us_v1';
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
        return esc_html__('Moko Why Choose Us V1', 'moko');
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
            'why_choose_us_v1',
            [
                'label' => esc_html__('Why Choose Us V1', 'moko'),
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
                'default' => 'eight',
                'options' => moko_button_style(),
				'condition' => [
                    'show_more' => 'yes'
                ]
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
            'why_choose_us_tab',
            [
                'label'   => esc_html__('Why Us Choose', 'moko'),
                'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
                'default' =>
                    [
						['title' => esc_html__('Best Security', 'moko')],
                		['title' => esc_html__('Risk Manage', 'moko')],
                		['title' => esc_html__('Growth Revenue', 'moko')],
                		['title' => esc_html__('Great Support', 'moko')],
                		['title' => esc_html__('Expert Team Work ', 'moko')],
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
							'name' => 'icon',
							'label' => esc_html__('Select Icon', 'aundri'),
							'type' => Controls_Manager::SELECT2,
							'options' => get_fontawesome_icons(),
							'label_block' => true,
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

		<!-- Business Section -->
		<section class="business-section">
			<div class="pattern-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-23.png'); ?>)"></div>
			<div class="auto-container">
				<!-- Sec Title -->
				<div class="sec-title light">
					<?php if($settings['subtitle']){ ?>
					<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
					<?php } ?>
					<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
					<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
				</div>
				
				<?php if($settings['btn_link']['url'] and $settings['btn_title']) { ?>
				<a href="<?php echo esc_url($settings['btn_link']['url'] ); ?>" class="theme-btn btn-style-<?php echo esc_attr($settings['btn_style']); ?>"><span class="txt"><?php echo wp_kses($settings['btn_title'], $allowed_html); ?></span></a>
				<?php } ?>
				<div class="inner-container">
					<div class="row clearfix">
						<!-- Image Column -->
						<div class="image-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column">
								<?php if($settings['image']['id']) { ?>
								<div class="image wow slideInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
									<img src="<?php echo esc_url(wp_get_attachment_url($settings['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
								</div>
								<?php } ?>
								<div class="arrow-image wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
									<img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/resource/business-arrow.png'); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
								</div>
							</div>
						</div>

						<!-- Content Column -->
						<div class="content-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column">
								<?php $i = 1; foreach($settings['why_choose_us_tab'] as $key => $item) { ?>
								<!-- Business Block -->
								<div class="business-block">
									<div class="inner-box">
										<div class="box-number"><?php echo wp_kses(sprintf('%02d', $i), $allowed_html); ?></div>
										<div class="icon-box">
											<span class="icon <?php echo esc_attr($item['icon']); ?>"></span>
										</div>
										<div class="content">
											<h4><?php echo wp_kses($item['title'], $allowed_html); ?></h4>
											<div class="text"><?php echo wp_kses($item['text'], $allowed_html); ?></div>
										</div>
									</div>
								</div>
								<?php $i++; } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Business Section -->

        <?php
    }
}
