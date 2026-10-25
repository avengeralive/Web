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
class Faqs_V2 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_faqs_v2';
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
        return esc_html__('Moko Faqs V2', 'moko');
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
        return 'eicon-accordion';
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
            'faqs_v2',
            [
                'label' => esc_html__('Faqs V2', 'moko'),
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
            'text_limit',
            [
                'label'   => esc_html__('Text Limit', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 43,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__('Number of Post', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 10,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_orderby',
            [
                'label'   => esc_html__('Order By', 'moko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date'       => esc_html__('Date', 'moko'),
                    'title'      => esc_html__('Title', 'moko'),
                    'menu_order' => esc_html__('Menu Order', 'moko'),
                    'rand'       => esc_html__('Random', 'moko'),
                ),
            ]
        );
        $this->add_control(
            'query_order',
            [
                'label'   => esc_html__('Order', 'moko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'DESC' => esc_html__('DESC', 'moko'),
                    'ASC'  => esc_html__('ASC', 'moko'),
                ),
            ]
        );
        $this->add_control(
            'query_category',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'moko'),
                'options' => get_categories_list('faqs_cat')
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

        $paged = moko_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;

        $this->add_render_attribute('wrapper', 'class', 'themerange-moko');
        $args = array(
            'post_type'      => 'faqs',
            'posts_per_page' => moko_set($settings, 'query_number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
            'paged'          => $paged
        );

        if( moko_set($settings, 'query_category')) $args['faqs_cat'] = moko_set($settings, 'query_category');
        $query = new \WP_Query($args);

        if($query->have_posts()) {
            $count = 1;
            $left_arr = array();
            $right_arr = array(); ?>

            <?php while($query->have_posts()) : $query->the_post();

                if($count > 2) $count = 1;
                $active = ($query->current_post == 0) ? 'active' : '';
                $current = ($query->current_post == 0) ? 'current' : ''; ?>

                <?php if( ($count == 1)):
                    $left_arr[get_the_id()] = '<li class="accordion block active-block">
									<div class="acc-btn '.$active.'">'.get_the_title(get_the_id()).' <div class="icon flaticon-right-arrow-1"></div></div>
									<div class="acc-content '.$current.'">
										<div class="content">
											<div class="text">'.moko_trim(get_the_content(), $settings['text_limit']).'</div>
										</div>
									</div>
								</li>';
                    ?>
                <?php else:
                    $right_arr[get_the_id()] = '<li class="accordion block active-block">
									<div class="acc-btn '.$active.'">'.get_the_title(get_the_id()).' <div class="icon flaticon-right-arrow-1"></div></div>
									<div class="acc-content '.$current.'">
										<div class="content">
											<div class="text">'.moko_trim(get_the_content(), $settings['text_limit']).'</div>
										</div>
									</div>
								</li>';
                    ?>
                <?php endif; ?>
                <?php $count++; endwhile; ?>
                
            <!-- Faq Page Section -->
			<section class="faq-page-section">
				<div class="auto-container">
					<!-- Sec Title -->
					<div class="sec-title centered">
						<?php if($settings['subtitle']){ ?>
						<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
						<?php } ?>
						<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
						<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
					</div>
					<div class="row clearfix">
						<!-- Column -->
						<div class="column col-lg-6 col-md-12 col-sm-12">
							<ul class="accordion-box">
								<?php foreach($left_arr as $key => $left_content):
								echo wp_kses_post($left_content);
								endforeach; ?>
							</ul>
						</div>

						<!-- Column -->
						<div class="column col-lg-6 col-md-12 col-sm-12">
							<ul class="accordion-box">
								<?php foreach($right_arr as $key => $right_content) :
								echo wp_kses_post($right_content);
								endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!-- End Faq Page Section -->

        <?php }

        wp_reset_postdata();
    }
}
