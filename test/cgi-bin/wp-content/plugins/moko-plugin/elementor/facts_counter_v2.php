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
class Facts_Counter_V2 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_facts_counter_v2';
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
        return esc_html__('Moko Facts Counter V2', 'moko');
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
        return 'eicon-number-field';
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
            'facts_counter_v2',
            [
                'label' => esc_html__('Facts Counter V2', 'moko'),
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
            'facts_counter',
            [
                'label'   => esc_html__('Facts Counter', 'moko'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' =>
                    [
						['title' => esc_html__('Projects Done', 'moko')],
                		['title' => esc_html__('Happy Clients', 'moko')],
                		['title' => esc_html__('Ratings Customer', 'moko')],
                		['title' => esc_html__('Award Winner', 'moko')],
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
                            'name' => 'counter_start',
                            'label' => esc_html__('Counter Start', 'moko'),
                            'type' => Controls_Manager::NUMBER,
                            'default' => esc_html__('0', 'moko'),
                        ],
                        [
                            'name' => 'counter_stop',
                            'label' => esc_html__('Counter Stop', 'moko'),
                            'type' => Controls_Manager::NUMBER,
                        ],
						[
                            'name' => 'counter_sign',
                            'label' => esc_html__('Counter Sign', 'moko'),
                            'type' => Controls_Manager::TEXT,
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
        
		<!-- Counter Section Three -->
		<section class="counter-section-three">
			<div class="auto-container">
				<div class="row clearfix">
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
					<!-- Counter Column -->
					<div class="counter-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<div class="sec-title">
								<?php if($settings['subtitle']){ ?>
								<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
								<?php } ?>
								<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
							</div>
							<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>

							<!-- Fact Counter -->
							<div class="fact-counter-three">
								<div class="row clearfix">
									<?php foreach($settings['facts_counter'] as $key => $item) { ?>
									<div class="column col-lg-offset-2 counter-column col-lg-6 col-md-6 col-sm-12">
										<div class="inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
											<div class="content">
												<div class="count-outer count-box">
													<span class="count-text" data-speed="4000" data-stop="<?php echo esc_attr($item['counter_stop']); ?>"><?php echo wp_kses($item['counter_start'], $allowed_html); ?></span><?php echo wp_kses($item['counter_sign'], $allowed_html); ?>
												</div>
												<h4 class="counter-title"><?php echo wp_kses($item['title'], $allowed_html); ?></h4>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Counter Section Three -->

        <?php
    }
}
