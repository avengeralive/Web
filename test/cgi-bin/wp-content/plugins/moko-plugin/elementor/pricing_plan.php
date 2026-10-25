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
class Pricing_Plan extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_pricing_plan';
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
        return esc_html__('Moko Pricing Plan', 'moko');
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
        return 'eicon-price-table';
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
            'general',
            [
                'label' => esc_html__('General', 'moko'),
            ]
        );
		$this->add_control(
            'style',
            [
                'label'   => esc_html__('Style', 'moko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'one',
                'options' => array(
                    'one' => esc_html__('Style One', 'moko'),
                    'two' => esc_html__('Style Two', 'moko'),
                    'three' => esc_html__('Style Three', 'moko'),
                ),
            ]
        );
		$this->add_control(
            'circle_image',
            [
                'label' => esc_html__('Circle Image', 'moko'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
                    'style' => array('one', 'two'),
                ]
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
        $this->end_controls_section();
		
		//Monthly Plan
		$this->start_controls_section(
            'monthly_tab',
            [
                'label' => esc_html__('Monthly Plan', 'moko'),
            ]
        );
		$this->add_control(
            'monthly_title',
            [
                'label'       => esc_html__('Monthly Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'monthly_plan',
            [
                'label'   => esc_html__('Monthly', 'moko'),
                'type' => Controls_Manager::REPEATER,
                'default' =>
                    [
						['title' => esc_html__('Basic', 'moko')],
                		['title' => esc_html__('Standard', 'moko')],
                		['title' => esc_html__('Unlimited', 'moko')],
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
                            'name' => 'features_plan',
							'label' => esc_html__('Featured Plan', 'moko'),
							'type' => Controls_Manager::SWITCHER,
							'label_on' => esc_html__('Show', 'moko'),
							'label_off' => esc_html__('Hide', 'moko'),
							'return_value' => 'yes',
							'default' => 'yes',
						],
                        [
                            'name' => 'price',
                            'label' => esc_html__('Price', 'moko'),
                            'type' => Controls_Manager::TEXT,
							'label_block' => true,
                        ],
						[
                            'name' => 'features',
                            'label' => esc_html__('Features', 'moko'),
                            'type' => Controls_Manager::TEXTAREA,
                        ],
						[
                            'name' => 'btn_title',
							'label'       => esc_html__('Button Title', 'moko'),
							'type'        => Controls_Manager::TEXT,
							'label_block' => true,
							'dynamic'     => [
								'active' => true,
							],
						],
						[
                            'name' => 'btn_url',
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
							'name'   => 'btn_style',
							'label'   => esc_html__('Button Style', 'moko'),
							'type'    => Controls_Manager::SELECT2,
							'default' => 'one',
							'options' => moko_button_style(),
						],
						[
							'name' => 'bottom_shape_image',
							'label' => esc_html__('Bottom Shape Image', 'moko'),
							'type' => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
						],
                    ],
				'title_field' => '{{title}}',
            ]
        );
        $this->end_controls_section();
		
		//Yearly Plan
		$this->start_controls_section(
            'yearly_tab',
            [
                'label' => esc_html__('Yearly Plan', 'moko'),
            ]
        );
		$this->add_control(
            'yearly_title',
            [
                'label'       => esc_html__('Yearly Title', 'moko'),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'yearly_plan',
            [
                'label'   => esc_html__('Yearly', 'moko'),
                'type' => Controls_Manager::REPEATER,
                'default' =>
                    [
						['title' => esc_html__('Basic', 'moko')],
                		['title' => esc_html__('Standard', 'moko')],
                		['title' => esc_html__('Unlimited', 'moko')],
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
                            'name' => 'features_plan',
							'label' => esc_html__('Featured Plan', 'moko'),
							'type' => Controls_Manager::SWITCHER,
							'label_on' => esc_html__('Show', 'moko'),
							'label_off' => esc_html__('Hide', 'moko'),
							'return_value' => 'yes',
							'default' => 'yes',
						],
                        [
                            'name' => 'price',
                            'label' => esc_html__('Price', 'moko'),
                            'type' => Controls_Manager::TEXT,
							'label_block' => true,
                        ],
						[
                            'name' => 'features',
                            'label' => esc_html__('Features', 'moko'),
                            'type' => Controls_Manager::TEXTAREA,
                        ],
						[
                            'name' => 'btn_title',
							'label'       => esc_html__('Button Title', 'moko'),
							'type'        => Controls_Manager::TEXT,
							'label_block' => true,
							'dynamic'     => [
								'active' => true,
							],
						],
						[
                            'name' => 'btn_url',
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
							'name'   => 'btn_style',
							'label'   => esc_html__('Button Style', 'moko'),
							'type'    => Controls_Manager::SELECT2,
							'default' => 'one',
							'options' => moko_button_style(),
						],
						[
							'name' => 'bottom_shape_image',
							'label' => esc_html__('Bottom Shape Image', 'moko'),
							'type' => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
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
        
		<!-- Pricing Section -->
		<section class="pricing-section <?php if($settings['style'] == 'one') echo 'style-three'; elseif($settings['style'] == 'three') echo 'style-two'; ?>">
			
			<?php if($settings['style'] != 'three') { ?>
			<div class="pattern-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-1.png'); ?>)"></div>
			<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['circle_image']['id'])); ?>)"></div>
			<?php } ?>
			
			<div class="auto-container">
				<!-- Sec Title -->
				<div class="sec-title centered">
					<?php if($settings['subtitle']){ ?>
					<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
					<?php } ?>
					<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
					<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
				</div>

				<div class="pricing-tabs tabs-box">
					<!--Tabs Container-->
					<div class="tabs-content">
						<!--Tab-->
						<div class="tab active-tab" id="prod-monthly">
							<div class="content">
								<div class="row clearfix">
									<?php foreach($settings['monthly_plan'] as $key => $item) { ?>
									<!-- Price Block -->
									<div class="price-block <?php if($item['features_plan'] == 'yes') echo 'active'; ?> col-lg-4 col-md-6 col-sm-12">
										<div class="inner-box">
											<div class="title"><?php echo wp_kses($item['title'], $allowed_html); ?></div>
											<div class="price"><?php echo wp_kses($item['price'], $allowed_html); ?></div>
											
											<?php $features_list = $item['features'];
											if(!empty($features_list)){
											$features_list = explode("\n", ($features_list)); ?>
											<ul class="price-list">
												<?php foreach($features_list as $features): ?>
												<li><?php echo wp_kses($features, $allowed_html); ?></li>
												<?php endforeach; ?>
											</ul>
											<?php } ?>
											
											<?php if($item['btn_url']['url'] and $item['btn_title']){ ?>
											<a href="<?php echo esc_url($item['btn_url']['url']); ?>" class="theme-btn btn-style-<?php echo esc_attr($item['btn_style']); ?>"><span class="txt"><?php echo wp_kses($item['btn_title'], $allowed_html); ?></span></a>
											<?php } ?>
											<div class="price-pattern-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($item['bottom_shape_image']['id'])); ?>)"></div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>

						<!--Tab-->
						<div class="tab" id="prod-yearly">
							<div class="content">
								<div class="row clearfix">
									<?php foreach($settings['yearly_plan'] as $key => $item) { ?>
									<!-- Price Block -->
									<div class="price-block <?php if($item['features_plan'] == 'yes') echo 'active'; ?> col-lg-4 col-md-6 col-sm-12">
										<div class="inner-box">
											<div class="title"><?php echo wp_kses($item['title'], $allowed_html); ?></div>
											<div class="price"><?php echo wp_kses($item['price'], $allowed_html); ?></div>
											
											<?php $features_list = $item['features'];
											if(!empty($features_list)){
											$features_list = explode("\n", ($features_list)); ?>
											<ul class="price-list">
												<?php foreach($features_list as $features): ?>
												<li><?php echo wp_kses($features, $allowed_html); ?></li>
												<?php endforeach; ?>
											</ul>
											<?php } ?>
											
											<?php if($item['btn_url']['url'] and $item['btn_title']){ ?>
											<a href="<?php echo esc_url($item['btn_url']['url']); ?>" class="theme-btn btn-style-<?php echo esc_attr($item['btn_style']); ?>"><span class="txt"><?php echo wp_kses($item['btn_title'], $allowed_html); ?></span></a>
											<?php } ?>
											<div class="price-pattern-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($item['bottom_shape_image']['id'])); ?>)"></div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					
					<?php if($settings['monthly_title'] or $settings['yearly_title']){ ?>
					<!--Tab Btns-->
					<div class="buttons-outer">
						<ul class="tab-buttons clearfix">
							<li data-tab="#prod-monthly" class="tab-btn active-btn"><?php echo wp_kses($settings['monthly_title'], $allowed_html); ?></li>
							<li data-tab="#prod-yearly" class="tab-btn"><?php echo wp_kses($settings['yearly_title'], $allowed_html); ?></li>
						</ul>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<!-- End Pricing Section -->
        
        <?php
    }
}
