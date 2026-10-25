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
class Team_V3 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_team_v3';
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
        return esc_html__('Moko Team V3', 'moko');
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
        return 'eicon-user-circle-o';
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
            'team_v3',
            [
                'label' => esc_html__('Team V3', 'moko'),
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__('Number of Post', 'moko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
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
                'options' => get_categories_list('team_cat')
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
            'post_type'      => 'team',
            'posts_per_page' => moko_set($settings, 'query_number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
            'paged'         => $paged
        );

        if( moko_set($settings, 'query_category') ) $args['team_cat'] = moko_set($settings, 'query_category');
        $query = new \WP_Query($args);

        if($query->have_posts()) { ?>

		<!-- Team Page Section -->
		<section class="team-page-section">
			<div class="auto-container">
				<div class="row clearfix">
					<?php while($query->have_posts()) : $query->the_post(); ?>
					<!-- Team Block -->
					<div class="team-block style-two col-lg-4 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="image">
								<?php the_post_thumbnail('moko_350x470'); ?>
								
								<?php $icons = get_post_meta( get_the_id(), 'social_profile', true );
									if(!empty($icons)) :
								?>
								<!-- Social Box -->
								<ul class="social-box">
									<?php foreach ($icons as $h_icon ) :
									$header_social_icons = json_decode( urldecode( moko_set($h_icon, 'data') ) );
									if( moko_set($header_social_icons, 'enable') == '') {
										continue;
									}
									$icon_class = explode('-', moko_set($header_social_icons, 'icon') ); ?>
									<li><a href="<?php echo esc_url(moko_set($header_social_icons, 'url')); ?>" style="background-color:<?php echo esc_attr(moko_set($header_social_icons, 'background')); ?>; color: <?php echo esc_attr(moko_set($header_social_icons, 'color')); ?>" class="fab <?php echo esc_attr( moko_set($header_social_icons, 'icon')); ?>" target="_blank"></a></li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>
							</div>
							<div class="lower-content">
								<div class="content">
									<h4><a href="<?php echo esc_url(the_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h4>
									<div class="designation"><?php echo wp_kses(get_post_meta( get_the_id(), 'designation', true ), $allowed_html); ?></div>
								</div>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<!-- End Team Page Section -->

        <?php }

        wp_reset_postdata();
    }
}
