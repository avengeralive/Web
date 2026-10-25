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
class Newsletter extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_newsletter';
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
        return esc_html__('Moko Newsletter', 'moko');
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
        return 'eicon-email-field';
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
            'newsletter',
            [
                'label' => esc_html__('Newsletter', 'moko'),
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
            'mailchimp_shortcode',
            [
                'label'       => esc_html__('Mailchimp Shortcode', 'moko'),
                'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'img_position',
            [
                'label'   => esc_html__('Image Position', 'moko'),
                'type'    => Controls_Manager::SELECT,
				'label_block' => true,
                'default' => 'right',
                'options' => array(
                    'left' => esc_html__('Left', 'moko'),
                    'right' => esc_html__('Right', 'moko'),
                ),
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
        
        <!-- Newsleter Section -->
		<section class="newsletter-section">
			<div class="auto-container">
				<div class="row clearfix">
					
					<?php if($settings['img_position'] == 'left') { ?>
					<!-- Image Column -->
					<div class="image-column col-lg-6 col-md-12 col-sm-12">
						<?php if($settings['image']['id']) { ?>
						<div class="inner-column">
							<div class="image titlt" data-tilt data-tilt-max="3">
								<img src="<?php echo esc_url(wp_get_attachment_url($settings['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
					
					<!-- Form Column -->
					<div class="form-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<div class="sec-title">
								<?php if($settings['subtitle']){ ?>
								<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
								<?php } ?>
								<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
							</div>
							<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
							<div class="newsletter-form">
								<?php echo do_shortcode($settings['mailchimp_shortcode']); ?>
							</div>
						</div>
					</div>
					
					<?php if($settings['img_position'] == 'right') { ?>
					<!-- Image Column -->
					<div class="image-column col-lg-6 col-md-12 col-sm-12">
						<?php if($settings['image']['id']) { ?>
						<div class="inner-column">
							<div class="image titlt" data-tilt data-tilt-max="3">
								<img src="<?php echo esc_url(wp_get_attachment_url($settings['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<!-- End Newsleter Section -->

        <?php
    }
}
