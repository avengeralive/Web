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
class Slider_V1 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_slider_v1';
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
        return esc_html__('Moko Slider V1', 'moko');
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
            'slider_v1',
            [
                'label' => esc_html__('Slider V1', 'moko'),
            ]
        );
		$this->add_control(
              'slides', 
			  	[
					'label' => esc_html__('Sliders', 'moko'),
            		'type' => Controls_Manager::REPEATER,
            		'default' => 
						[
                			
            			],
            		'fields' => 
						[
                			[
								'name' => 'bg_image',
								'label' => esc_html__('Background Image', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'title',
								'label' => esc_html__('Title', 'moko'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'text',
								'label' => esc_html__('Text', 'moko'),
								'type' => Controls_Manager::TEXTAREA,
							],
							[
								'name' => 'left_image',
								'label' => esc_html__('Left Image', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'middle_image',
								'label' => esc_html__('Middle Image', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'right_image',
								'label' => esc_html__('Right Image', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'btn_title1',
								'label' => esc_html__('Button Title 1', 'moko'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'btn_link1',
								'label' => esc_html__('Button URL 1', 'moko'),
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
								'name' => 'btn_style1',
								'label' => esc_html__('Button Style 1', 'moko'),
								'type' => Controls_Manager::SELECT2,
								'default' => 'eight',
								'options' => moko_button_style(),
							],
							[
								'name' => 'btn_title2',
								'label' => esc_html__('Button Title 2', 'moko'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'btn_link2',
								'label' => esc_html__('Button URL 2', 'moko'),
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
								'name' => 'btn_style2',
								'label' => esc_html__('Button Style 2', 'moko'),
								'type' => Controls_Manager::SELECT2,
								'default' => 'nine',
								'options' => moko_button_style(),
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
        $allowed_html = wp_kses_allowed_html('post');
		?>
        
        <!-- Banner Section Four -->
        <section class="banner-section-four">
            <div class="main-slider-carousel owl-carousel owl-theme">
                <?php foreach($settings['slides'] as $key => $item): ?>
                <div class="slide" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($item['bg_image']['id'])); ?>)">
                    <div class="dotted-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/main-slider/dotted-layer-1.png'); ?>)"></div>
                    <div class="auto-container">
                        <div class="row clearfix">
                        
                            <!-- Content Column -->
                            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <div class="title"><?php echo wp_kses($item['title'], $allowed_html); ?></div>
                                    <h1><?php echo wp_kses($item['text'], $allowed_html); ?></h1>
                                    <div class="btns-box">
										<?php if($item['btn_link1']['url'] and $item['btn_title1']){ ?>
                                        <a href="<?php echo esc_url($item['btn_link1']['url']); ?>" class="theme-btn btn-style-<?php echo esc_attr($item['btn_style1']); ?>"><span class="txt"><?php echo wp_kses($item['btn_title1'], $allowed_html); ?></span></a>
										<?php } ?>
										
										<?php if($item['btn_link2']['url'] and $item['btn_title2']){ ?>
                                        <a href="<?php echo esc_url($item['btn_link2']['url']); ?>" class="theme-btn btn-style-<?php echo esc_attr($item['btn_style2']); ?>"><span class="txt"><?php echo wp_kses($item['btn_title2'], $allowed_html); ?></span></a>
										<?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Image Column -->
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <div class="image">
                                        <img src="<?php echo esc_url(wp_get_attachment_url($item['middle_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
                                    </div>
                                    <div class="images-icons parallax-scene-1">
                                        <div class="image-1" data-depth="0.50">
                                            <img src="<?php echo esc_url(wp_get_attachment_url($item['left_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
                                        </div>
                                        <div class="image-2" data-depth="0.50">
                                            <img src="<?php echo esc_url(wp_get_attachment_url($item['right_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- Waves Container -->
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
            <!-- Waves End -->
        </section>
        <!-- End Banner Section -->
        
        <?php
    }
}
