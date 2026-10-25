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
class Slider_V3 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_slider_v3';
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
        return esc_html__('Moko Slider V3', 'moko');
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
            'slider_v3',
            [
                'label' => esc_html__('Slider V3', 'moko'),
            ]
        );
		$this->add_control(
              'slides', 
			  	[
					'label' => esc_html__('Sliders', 'moko'),
            		'type' => Controls_Manager::REPEATER,
            		'separator' => 'before',
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
								'label' => esc_html__('Button Style', 'moko'),
								'type' => Controls_Manager::SELECT2,
								'default' => 'three',
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
								'default' => 'four',
								'options' => moko_button_style(),
							],
							[
								'name' => 'image',
								'label' => esc_html__('Image', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'icon_1',
								'label' => esc_html__('Icon 1', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'icon_2',
								'label' => esc_html__('Icon 2', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'icon_3',
								'label' => esc_html__('Icon 3', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'icon_4',
								'label' => esc_html__('Icon 4', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'icon_5',
								'label' => esc_html__('Icon 5', 'moko'),
								'type' => Controls_Manager::MEDIA,
								'default' => [
									'url' => Utils::get_placeholder_image_src(),
								],
							],
							[
								'name' => 'icon_6',
								'label' => esc_html__('Icon 6', 'moko'),
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
        
		<!-- Banner Section -->
		<section class="banner-section">
			<div class="main-slider-carousel owl-carousel owl-theme">
				<?php foreach($settings['slides'] as $key => $item): ?>
				<!-- Slide -->
				<div class="slide" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($item['bg_image']['id'])); ?>)">
					<div class="patern-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/main-slider/pattern-1.png'); ?>)"></div>
					<div class="patern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/main-slider/pattern-2.png'); ?>)"></div>
					<div class="dotted-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/main-slider/dotted-layer.png'); ?>)"></div>
					<div class="auto-container">
						<div class="row clearfix">
							<!-- Content Column -->
							<div class="content-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<div class="title"><?php echo wp_kses($item['subtitle'], $allowed_html); ?></div>
									<h1><?php echo wp_kses($item['title'], $allowed_html); ?></h1>
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
									<?php if($item['image']['id']) { ?>
									<div class="image">
										<img src="<?php echo esc_url(wp_get_attachment_url($item['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
									</div>
									<?php } ?>
									<div class="images-icons parallax-scene-2">
										<?php if($item['icon_1']['id']) { ?>
										<div class="image-1" data-depth="0.30">
											<img src="<?php echo esc_url(wp_get_attachment_url($item['icon_1']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
										</div>
										<?php } ?>
										
										<?php if($item['icon_2']['id']) { ?>
										<div class="image-2" data-depth="0.30">
											<img src="<?php echo esc_url(wp_get_attachment_url($item['icon_2']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
										</div>
										<?php } ?>
										
										<?php if($item['icon_3']['id']) { ?>
										<div class="image-3" data-depth="0.90">
											<img src="<?php echo esc_url(wp_get_attachment_url($item['icon_3']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
										</div>
										<?php } ?>
										
										<?php if($item['icon_4']['id']) { ?>
										<div class="image-4" data-depth="0.50">
											<img src="<?php echo esc_url(wp_get_attachment_url($item['icon_4']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
										</div>
										<?php } ?>
										
										<?php if($item['icon_5']['id']) { ?>
										<div class="image-5" data-depth="0.50">
											<img src="<?php echo esc_url(wp_get_attachment_url($item['icon_5']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
										</div>
										<?php } ?>
										
										<?php if($item['icon_6']['id']) { ?>
										<div class="image-6" data-depth="0.50">
											<img src="<?php echo esc_url(wp_get_attachment_url($item['icon_6']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
										</div>
										<?php } ?>
									</div>
								</div>
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
