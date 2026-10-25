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
class Projects_With_Sidebar extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_projects_with_sidebar';
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
        return esc_html__('Moko Project With Sidebar', 'moko');
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
        return 'eicon-sidebar';
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
            'projects_with_sidebar',
            [
                'label' => esc_html__('Projects With Sidebar', 'moko'),
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__('Number of Post', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 12,
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
                'options' => get_categories_list('project_cat')
            ]
        );
        $this->end_controls_section();
		
		//Sidebar
		$this->start_controls_section(
            'sidebar_tab',
            [
                'label' => esc_html__('Sidebar', 'moko'),
            ]
        );
		$this->add_control(
            'left_right_sidebar',
            [
                'label'   => esc_html__('Sidebar', 'moko'),
                'type'    => Controls_Manager::SELECT2,
                'default' => 'right',
                'options' => array(
                    'left' => esc_html__('Left Sidebar', 'moko'),
                    'right' => esc_html__('Right Sidebar', 'moko'),
                ),
            ]
        );
		$this->add_control(
			'sidebar',
			[
				'label'   => esc_html__('Choose Sidebar', 'moko'),
				'separate' => 'before',
				'type'    => Controls_Manager::SELECT,
				'default' => 'Choose Sidebar',
				'options'  => moko_get_sidebars(),
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

        $paged = get_query_var('paged');
		$paged = moko_set($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;

        $this->add_render_attribute('wrapper', 'class', 'themerange-moko');
        $args = array(
            'post_type'      => 'project',
            'posts_per_page' => moko_set($settings, 'query_number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
            'paged'          => $paged
        );

        if( moko_set($settings, 'query_category') ) $args['project_cat'] = moko_set($settings, 'query_category');
        $query = new \WP_Query($args);

        if($query->have_posts()) { ?>
        
		<!-- Sidebar Page Container -->
		<div class="sidebar-page-container">
			<div class="auto-container">
				<div class="row clearfix">
					
					<?php if($settings['left_right_sidebar'] == 'left') { ?>
					<!-- Sidebar Side -->
					<div class="sidebar-side left-sidebar col-lg-4 col-md-12 col-sm-12">
						<aside class="sidebar sticky-top">
							<?php dynamic_sidebar($settings['sidebar']); ?>
						</aside>
					</div>
					<?php } ?>

					<!-- Content Side -->
					<div class="content-side right-sidebar col-lg-8 col-md-12 col-sm-12">
						<div class="row clearfix">
							<?php global $post;
							while ($query->have_posts() ) : $query->the_post();
							$post_thumbnail_id = get_post_thumbnail_id($post->ID);
							$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
							$term_list = wp_get_post_terms(get_the_id(), 'project_cat', array("fields" => "names")); ?>
							<!-- Gallery Block -->
							<div class="gallery-block col-lg-6 col-md-6 col-sm-12">
								<div class="inner-box">
									<figure class="image-box">
										<?php the_post_thumbnail('moko_370x300'); ?>
										<!-- Overlay Box -->
										<div class="overlay-box">
											<div class="overlay-inner">
												<div class="content">
													<a href="<?php echo esc_url($post_thumbnail_url); ?>" data-caption="<?php the_title_attribute(); ?>" class="icon flaticon-plus"></a>
												</div>
											</div>
										</div>
									</figure>
									<div class="lower-content">
										<div class="title"><?php echo implode(', ', (array)$term_list ); ?></div>
										<h5><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h5>
									</div>
								</div>
							</div>
							<?php endwhile; ?>
							
							<!-- Post Share Options -->
							<div class="styled-pagination text-center">
								<?php moko_the_pagination2(array('total'=>$query->max_num_pages, 'next_text' => '<span class="fa fa-angle-right"></span>', 'prev_text' => '<span class="fa fa-angle-left"></span>')); ?>
							</div>
						</div>
					</div>
					
					<?php if($settings['left_right_sidebar'] == 'right') { ?>
					<!-- Sidebar Side -->
					<div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
						<aside class="sidebar sticky-top">
							<?php dynamic_sidebar($settings['sidebar'] ); ?>
						</aside>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>

        <?php }

        wp_reset_postdata();
    }
}
