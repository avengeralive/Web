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
class Video extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_video';
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
        return esc_html__('Moko Video', 'moko');
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
        return 'eicon-video-playlist';
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
            'video',
            [
                'label' => esc_html__('Video', 'moko'),
            ]
        );
		$this->add_control(
            'bg_image',
            [
                'label' => esc_html__('Background Image', 'moko'),
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
                'type' => Controls_Manager::TEXT,
				'label_block' => true,
                'placeholder' => esc_html__('https://your-link.com/', 'moko'),
                'dynamic'     => [
                    'active' => true,
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
            'video_image',
            [
                'label' => esc_html__('Video Image', 'moko'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );
        $this->add_control(
            'video_url',
            [
                'label' => esc_html__('Video URL', 'moko'),
                'type' => Controls_Manager::TEXT,
				'label_block' => true,
                'placeholder' => esc_html__('https://youtube.com/', 'moko'),
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
        
		<!-- Demo Section -->
		<section class="demo-section" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['bg_image']['id'])); ?>)">
			<div class="auto-container">
				<div class="row clearfix">
					<!-- Counter Column -->
					<div class="counter-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
							<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
							
							<?php if($settings['btn_link'] and $settings['btn_title']){ ?>
							<a href="<?php echo esc_url($settings['btn_link'] ); ?>" class="lightbox-image theme-btn btn-style-<?php echo esc_attr($settings['btn_style']); ?>"><span class="txt"><?php echo wp_kses($settings['btn_title'], $allowed_html); ?></span></a>
							<?php } ?>
						</div>
					</div>

					<!-- Image Column -->
					<div class="image-column col-lg-6 col-md-12 col-sm-12">
						<?php if($settings['video_image']['id'] and $settings['video_url']) { ?>
						<div class="inner-column">
							<div class="image titlt" data-tilt data-tilt-max="3">
								<img src="<?php echo esc_url(wp_get_attachment_url($settings['video_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'moko'); ?>" />
								<a href="<?php echo esc_url($settings['video_url'] ); ?>" class="lightbox-image video-box"><span class="fa fa-play"><i class="ripple"></i></span></a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
		<!-- End Demo Section -->

        <?php
    }
}
