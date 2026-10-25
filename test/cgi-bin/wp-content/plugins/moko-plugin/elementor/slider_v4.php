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
class Slider_V4 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_slider_v4';
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
        return esc_html__('Moko Slider V4', 'moko');
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
        return 'eicon-slider-device';
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
            'social_media_tab',
            [
                'label' => esc_html__('Social Media', 'moko'),
            ]
        );
		$this->add_control(
              'social_media', 
			  	[
					'label' => esc_html__('Social Media', 'moko'),
            		'type' => Controls_Manager::REPEATER,
            		'default' => 
						[
                			
            			],
            		'fields' => 
						[
							[
								'name' => 'social_name',
								'label' => esc_html__('Title', 'moko'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'social_icon',
								'label' => esc_html__('Select Icon', 'aundri'),
								'type' => Controls_Manager::SELECT2,
								'label_block' => true,
								'options' => get_fontawesome_icons(),
							],
							[
								'name' => 'social_link',
								'label' => esc_html__('Social Link', 'moko'),
								'type' => Controls_Manager::URL,
								'placeholder' => esc_html__('https://your-link.com/', 'moko'),
								'show_external' => true,
								'default' => [
									'url' => '',
									'is_external' => true,
									'nofollow' => true,
								],
							],
            			],
                 ]
        );
        $this->end_controls_section();
		
		//Slider
        $this->start_controls_section(
            'slider_v2',
            [
                'label' => esc_html__('Slider', 'moko'),
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
            'video_title',
            [
                'label'       => esc_html__('Video Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'video_url',
            [
                'label'       => esc_html__('Video URL', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
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
                'default' => 'three',
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
        
		<!-- Banner Section Three -->
		<section class="banner-section-three">
			<div class="icon-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-16.png'); ?>)"></div>
			<div class="icon-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/icon-17.png'); ?>)"></div>
			<div class="icon-layer-three" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-12.png'); ?>)"></div>
			
			<?php if($settings['social_media']) { ?>
			<!-- Social Box -->
			<ul class="social-box">
				<?php foreach($settings['social_media'] as $key => $item) { ?>
				<li><a href="<?php echo esc_url($item['social_link']['url']); ?>" title="<?php echo esc_attr($item['social_title']); ?>" class="fab <?php echo esc_attr($item['social_icon']); ?>"></a></li>
				<?php } ?>
			</ul>
			<?php } ?>

			<div class="auto-container">
				<div class="row clearfix">
					<!-- Content Column -->
					<div class="content-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<h1><?php echo wp_kses($settings['title'], $allowed_html); ?></h1>
							<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
							<div class="clearfix">
								<?php if($settings['video_url'] and $settings['video_title']){ ?>
								<a href="<?php echo esc_url($settings['video_url']); ?>" class="lightbox-image video-box"><span class="fa fa-play"><i class="ripple"></i></span> <?php echo wp_kses($settings['video_title'], $allowed_html); ?></a>
								<?php } ?>
								
								<?php if($settings['btn_link']['url'] and $settings['btn_title']){ ?>
								<a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="theme-btn btn-style-<?php echo esc_attr($settings['btn_style']); ?>"><span class="txt"><?php echo wp_kses($settings['btn_title'], $allowed_html); ?></span></a>
								<?php } ?>
							</div>
						</div>
					</div>

					<!-- Image Column -->
					<div class="image-column col-lg-6 col-md-12 col-sm-12">
						<?php if($settings['image']['id']) { ?>
						<div class="inner-column">
							<div class="image">
								<img src="<?php echo esc_url(wp_get_attachment_url($settings['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<!--Waves Container-->
			<div>
			  <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			  viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
			  <defs>
			  <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
			  </defs>
			  <g class="parallax">
			  <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
			  <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
			  <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
			  <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
			  </g>
			  </svg>
			</div>
			<!--Waves end-->
		</section>
		<!-- End Banner Section Three -->

        <?php
    }
}
