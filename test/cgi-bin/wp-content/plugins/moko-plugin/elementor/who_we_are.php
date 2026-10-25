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
class Who_We_Are extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_who_we_are';
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
        return esc_html__('Moko Who We Are', 'moko');
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
            'who_we_are',
            [
                'label' => esc_html__('Who We Are', 'moko'),
            ]
        );
		$this->add_control(
            'top_padding',
            [
                'label'   => esc_html__('Top Padding', 'moko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'moko'),
                    'yes' => esc_html__('Yes', 'moko'),
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
            'features_tab',
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
                            'name' => 'icon',
                            'label' => esc_html__('Upload Icon', 'moko'),
                            'type' => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
                        ],
                        [
                            'name' => 'text',
                            'label' => esc_html__('Text', 'moko'),
                            'type' => Controls_Manager::TEXTAREA,
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
        
        <!-- Mission Section -->
		<section class="mission-section <?php if($settings['top_padding'] == 'yes') echo 'style-two'; ?>">
			<div class="auto-container">
				<div class="row clearfix">
					<!-- Image Column -->
					<div class="image-column col-lg-6 col-md-12 col-sm-12">
						<?php if($settings['image']['id']) { ?>
						<div class="inner-column">
							<div class="image wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
								<img src="<?php echo esc_url(wp_get_attachment_url($settings['image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
							</div>
						</div>
						<?php } ?>
					</div>

					<!-- Content Column -->
					<div class="content-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<!-- Sec Title -->
							<div class="sec-title">
								<?php if($settings['subtitle']) { ?>
								<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
								<?php } ?>
								<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
							</div>
							<div class="bold-text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
							
							<?php if($settings['features_tab']) { ?>
							<ul class="mission-list">
								<?php foreach($settings['features_tab'] as $key => $item) { ?>
								<li>
									<?php if($item['icon']['id']) { ?>
									<span class="icon"><img src="<?php echo esc_url(wp_get_attachment_url($item['icon']['id'])); ?>" alt="<?php esc_attr_e('Icon', 'moko'); ?>" /></span>
									<?php } ?>
									<?php echo wp_kses($item['text'], $allowed_html); ?>
								</li>
								<?php } ?>
							</ul>
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
