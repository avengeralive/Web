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
class Contact_Info extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_contact_info';
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
        return esc_html__('Moko Contact Info', 'moko');
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
        return 'eicon-info-circle-o';
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
            'contact_info',
            [
                'label' => esc_html__('Contact Info', 'moko'),
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
            'opening_hours',
            [
                'label'       => esc_html__('Opening Hours', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'address',
            [
                'label'       => esc_html__('Address', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'phone_number',
            [
                'label'       => esc_html__('Phone Number', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'email_address',
            [
                'label'       => esc_html__('Email Address', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->end_controls_section();
		
		//Social Media
		$this->start_controls_section(
            'social_media_tab',
            [
                'label' => esc_html__('Social Media', 'moko'),
            ]
        );
		$this->add_control(
            'social_title',
            [
                'label'       => esc_html__('Social Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'social_text',
            [
                'label'       => esc_html__('Social Text', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'social_media',
            [
                'label'   => esc_html__('Social Media', 'moko'),
                'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
                'default' =>
                    [

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
                            'label' => esc_html__('Select Icon', 'moko'),
                            'type' => Controls_Manager::SELECT2,
							'label_block' => true,
                            'options' => get_fontawesome_icons(),
                        ],
						[
                            'name' => 'social_link',
							'label' => esc_html__('Social Link', 'moko'),
							'type' => Controls_Manager::TEXT,
							'placeholder' => esc_html__('https://your-link.com/', 'moko'),
							'label_block' => true,
						]
                    ],
            ]
        );
        $this->end_controls_section();
		
		//Google Map
		$this->start_controls_section(
            'google_map',
            [
                'label' => esc_html__('Google Map', 'moko'),
            ]
        );
		$this->add_control(
			'google_map_iframe',
			[
				'label'       => esc_html__('Google Map Iframe', 'moko'),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
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
        
        <!-- Contact Info Section -->
		<section class="contact-info-section">
			<div class="auto-container">
				<!-- Sec Title -->
				<div class="sec-title centered">
					<?php if($settings['subtitle']){ ?>
					<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
					<?php } ?>
					<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
					<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
				</div>
				<div class="inner-container">
					<div class="row clearfix">
						<?php if($settings['opening_hours']){ ?>
						<!-- Column -->
						<div class="column col-lg-6 col-md-6 col-sm-12">
							<div class="info-box">
								<div class="box-inner">
									<div class="icon flaticon-clock"></div>
									<?php echo wp_kses($settings['opening_hours'], $allowed_html); ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if($settings['address']){ ?>
						<!-- Column -->
						<div class="column col-lg-6 col-md-6 col-sm-12">
							<div class="info-box">
								<div class="box-inner">
									<div class="icon flaticon-pin"></div>
									<?php echo wp_kses($settings['address'], $allowed_html); ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if($settings['phone_number'] or $settings['email_address']){ ?>
						<!-- Column -->
						<div class="column col-lg-6 col-md-6 col-sm-12">
							<div class="info-box">
								<div class="box-inner">
									<div class="icon flaticon-phone-call"></div>
									<a href="tel:<?php echo esc_attr(phone_number($settings['phone_number'])); ?>"><?php echo wp_kses($settings['phone_number'], $allowed_html); ?></a><br>
									<a href="mailto:<?php echo sanitize_email($settings['email_address']); ?>"><?php echo sanitize_email($settings['email_address']); ?></a>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<!-- Column -->
						<div class="column col-lg-6 col-md-6 col-sm-12">
							<span class="social-icon-text"><?php echo wp_kses($settings['social_title'], $allowed_html); ?> <i><?php echo wp_kses($settings['social_text'], $allowed_html); ?></i></span>
							<ul class="social-box">
								<?php if($settings['social_media']){
								foreach($settings['social_media'] as $key => $item) { ?>
								<li><a href="<?php echo esc_url($item['social_link']); ?>" title="<?php echo esc_attr($item['title']); ?>" class="fab <?php echo esc_attr($item['icon']); ?>" target="_blank"></a></li>
								<?php }
								} ?>
							</ul>
						</div>
					</div>
				</div>
				
				<!-- Map Boxed -->
				<div class="map-boxed">
					<!-- Map Outer -->
					<div class="map-outer">
						<?php echo do_shortcode($settings['google_map_iframe']); ?>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact Info Section -->

        <?php
    }
}
