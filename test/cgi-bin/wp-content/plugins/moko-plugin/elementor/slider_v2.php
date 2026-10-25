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
class Slider_V2 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_slider_v2';
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
        return esc_html__('Moko Slider V2', 'moko');
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
              'slides', 
			  	[
					'label' => esc_html__('Slides', 'moko'),
            		'type' => Controls_Manager::REPEATER,
            		'separator' => 'before',
            		'default' => 
						[
                			
            			],
            		'fields' => 
						[
                			[
								'name' => 'subtitle',
								'label' => esc_html__('Sub Title', 'moko'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'title',
								'label' => esc_html__('Title', 'moko'),
								'type' => Controls_Manager::TEXTAREA,
							],
							[
								'name' => 'text',
								'label' => esc_html__('Text', 'moko'),
								'type' => Controls_Manager::TEXTAREA,
							],
							[
								'name' => 'btn_title',
								'label' => esc_html__('Button Title', 'moko'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'btn_link',
								'label' => esc_html__('Button URL', 'moko'),
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
								'name' => 'btn_style',
								'label' => esc_html__('Button Style', 'moko'),
								'type' => Controls_Manager::SELECT2,
								'default' => 'seven',
								'options' => moko_button_style(),
							],
							[
								'name' => 'phone_number',
								'label' => esc_html__('Phone Number', 'moko'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'image',
								'label' => esc_html__('Image', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
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
        
		<!-- Banner Section Five -->
		<section class="banner-section-five">
			<?php if($settings['social_media']){ ?>
			<!-- Social Box -->
			<ul class="social-box">
				<?php foreach($settings['social_media'] as $key => $item) { ?>
				<li><a href="<?php echo esc_url($item['social_link']['url']); ?>" title="<?php echo esc_attr($item['social_name']); ?>" class="fab <?php echo esc_attr($item['social_icon']); ?>"></a></li>
				<?php } ?>
			</ul>
			<?php } ?>

			<div class="single-item-carousel owl-carousel owl-theme">
				<?php foreach($settings['slides'] as $key => $item): ?>
				<!-- Slide -->
				<div class="slide">
					<div class="auto-container">
						<div class="row clearfix">
							<!-- Content Column -->
							<div class="content-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<div class="title"><?php echo wp_kses($item['subtitle'], $allowed_html); ?></div>
									<h1><?php echo wp_kses($item['title'], $allowed_html); ?></h1>
									<div class="text"><?php echo wp_kses($item['text'], $allowed_html); ?></div>
									<div class="clearfix">
										<?php if($item['btn_link']['url'] and $item['btn_title']){ ?>
										<a href="<?php echo esc_url($item['btn_link']['url']); ?>" class="theme-btn btn-style-<?php echo esc_attr($item['btn_style']); ?>"><span class="txt"><?php echo wp_kses($item['btn_title'], $allowed_html); ?></span></a>
										<?php } ?>
										
										<?php if($item['phone_number']){ ?>
										<div class="phone-box">
											<span class="phone-icon fas fa-phone"></span>
											<a class="phone" href="tel:<?php echo esc_attr(phone_number($item['phone_number'])); ?>"><?php echo wp_kses($item['phone_number'], $allowed_html); ?></a>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>

							<!-- Image Column -->
							<div class="image-column col-lg-6 col-md-12 col-sm-12">
								<?php if($item['image']['id']) { ?>
								<div class="inner-column">
									<div class="image">
										<img src="<?php echo esc_url(wp_get_attachment_url($item['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</section>
		<!-- End Banner Section -->

        <?php
    }
}
