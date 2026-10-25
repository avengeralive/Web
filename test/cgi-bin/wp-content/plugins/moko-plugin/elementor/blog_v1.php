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
class Blog_V1 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_blog_v1';
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
        return esc_html__('Moko Blog V1', 'moko');
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
        return 'eicon-form-vertical';
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
            'blog_v1',
            [
                'label' => esc_html__('Blog V1', 'moko'),
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
                ),
            ]
        );
		$this->add_control(
            'bg_image',
            [
                'label' => esc_html__('Circle Image', 'moko'),
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
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com/', 'moko'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
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
                'default' => 'eight',
                'options' => moko_button_style(),
				'condition' => [
                    'show_more' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__('Number of Post', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
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
                'label' => esc_html__('Category', 'moko'),
                'type' => Controls_Manager::SELECT,
                'options' => get_categories_list(),
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

        $this->add_render_attribute('wrapper', 'class', 'themerange-moko');
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => moko_set($settings, 'query_number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
        );

        if( moko_set($settings, 'query_category') ) $args['category_name'] = moko_set($settings, 'query_category');
        $query = new \WP_Query($args);
		
        if($query->have_posts()) { ?>
        
		<!-- News Section -->
		<section class="news-section">
			<div class="pattern-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['bg_image']['id'])); ?>)"></div>
			<div class="auto-container">
				<!-- Sec Title -->
				<div class="sec-title">
					<div class="clearfix">
						<div class="pull-left">
							<?php if($settings['subtitle']){ ?>
							<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
							<?php } ?>
							<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
							<div class="text"><?php echo wp_kses($settings['text'], $allowed_html); ?></div>
						</div>
						<?php if($settings['btn_link']['url'] and $settings['btn_title']){ ?>
						<div class="pull-right">
							<a href="<?php echo esc_url($settings['btn_link']['url'] ); ?>" class="theme-btn btn-style-<?php echo esc_attr($settings['btn_style']); ?>"><span class="txt"><?php echo wp_kses($settings['btn_title'], $allowed_html); ?></span></a>
						</div>
						<?php } ?>
					</div>
				</div>

				<div class="row clearfix">
					<?php while ($query->have_posts() ) : $query->the_post(); ?>
					<!-- News Block / Style Two -->
					<div class="news-block <?php if($settings['style'] == 'one') echo 'style-two'; ?> col-lg-4 col-md-6 col-sm-12">
						<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
							<?php if(has_post_thumbnail()) { ?>
							<div class="image">
								<?php the_post_thumbnail('moko_370x250'); ?>
								<!-- Overlay Box -->
								<div class="overlay-box">
									<div class="overlay-inner">
										<div class="content">
											<a href="<?php echo esc_url(get_permalink(get_the_id())); ?>" class="icon flaticon-unlink"></a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="lower-content">
								<ul class="post-meta">
									<li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><span class="icon fa fa-user"></span> <?php the_author(); ?></a></li>
									<li><a href="<?php echo esc_url(get_month_link(get_the_date('Y'), get_the_date('m'))); ?>"><span class="icon fa fa-calendar"></span> <?php echo get_the_date(); ?></a></li>
								</ul>
								<h5><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h5>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<!-- End News Section -->

        <?php }

        wp_reset_postdata();
    }
}
