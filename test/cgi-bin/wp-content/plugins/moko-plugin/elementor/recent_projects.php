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
class Recent_Projects extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'moko_recent_projects';
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
        return esc_html__('Moko Recent Projects', 'moko');
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
        return 'eicon-gallery-grid';
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
            'recent_projects',
            [
                'label' => esc_html__('Recent Projects', 'moko'),
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
            'number',
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
            'cat_include',
            [
                'label'       => esc_html__( 'Category Include IDs', 'moko' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Include categories, etc. by ID with comma separated.', 'moko' ),
            ]
        );
		$this->add_control(
            'cat_operator',
            [
                'label' => esc_html__('Category Operator', 'moko'),
                'type' => Controls_Manager::SELECT,
                'default' => 'IN',
                'options' => array(
					'IN' => esc_html__('IN', 'moko'),
					'NOT IN' => esc_html__('NOT IN', 'moko'),
				),
                'condition' => [
                    'cat_include!' => ''
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
            'posts_per_page' => moko_set($settings, 'number'),
            'orderby'        => moko_set($settings, 'query_orderby'),
            'order'          => moko_set($settings, 'query_order'),
            'paged'          => $paged
        );
		
		//Terms
		$cat_operator = moko_set( $settings, 'cat_operator' );
        $terms_array = explode(",", moko_set( $settings, 'cat_include' ));
        if(moko_set( $settings, 'cat_include' ))
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'project_cat',
					'field' => 'id',
					'terms' => $terms_array,
					'operator' => $cat_operator
				)
			);
		
		
        $allowed_html = wp_kses_allowed_html('post');
        $query = new \WP_Query($args);
        $t = '';
        $data_filtration = '';
        $data_posts = '';
        if($query->have_posts())
        {
            ob_start(); ?>

            <?php $count = 0;
            $fliteration = array();
            while($query->have_posts() ): $query->the_post();
                global $post;
                $meta = '';
                $meta1 = '';
                $post_terms = get_the_terms( get_the_id(), 'project_cat', array( 'order' => 'ASC'));
                foreach( (array)$post_terms as $pos_term )
					$fliteration[$pos_term->term_id] = $pos_term;
					$temp_category = get_the_term_list(get_the_id(), 'project_cat', '', ', ');

					$post_terms = wp_get_post_terms( get_the_id(), 'project_cat');
					$term_slug = '';
					if($post_terms)
						foreach($post_terms as $p_term)
							$term_slug .= $p_term->slug.' ';
							$post_thumbnail_id = get_post_thumbnail_id($post->ID);
							$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
							$term_list = wp_get_post_terms(get_the_id(), 'project_cat', array("fields" => "names")); ?>
                
							<!-- Gallery Block -->
							<div class="gallery-block all mix col-lg-4 col-md-6 col-sm-12 <?php echo esc_attr($term_slug); ?>">
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

			<?php wp_reset_postdata();
			$data_posts = ob_get_contents();
			ob_end_clean();
			ob_start(); ?>

			<!-- Gallery Section -->
			<section class="gallery-section">
				<div class="pattern-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['circle_image']['id'])); ?>)"></div>
				<div class="auto-container">
					<!-- MixitUp Galery -->
					<div class="mixitup-gallery">
						<div class="sec-title">
							<div class="clearfix">
								<div class="pull-left">
									<?php if($settings['subtitle']){ ?>
									<div class="title"><?php echo wp_kses($settings['subtitle'], $allowed_html); ?></div>
									<?php } ?>
									<h2><?php echo wp_kses($settings['title'], $allowed_html); ?></h2>
								</div>

								<div class="pull-right">
									<!--Filter-->
									<div class="filters clearfix">
										<ul class="filter-tabs filter-btns clearfix">
											<li class="filter active" data-role="button" data-filter="all"><?php esc_html_e('All', 'moko'); ?></li>
											<?php foreach($fliteration as $t): ?>
											<li class="filter" data-role="button" data-filter=".<?php echo esc_attr(moko_set($t, 'slug')); ?>"><?php echo wp_kses(moko_set($t, 'name'), $allowed_html); ?></li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="filter-list row clearfix">
							<?php echo wp_kses($data_posts, $allowed_html); ?>
						</div>
						
						<?php if($settings['btn_link']['url'] and $settings['btn_title']){ ?>
						<div class="btn-box text-center">
							<a href="<?php echo esc_url($settings['btn_link']['url'] ); ?>" class="theme-btn btn-style-<?php echo esc_attr($settings['btn_style']); ?>"><span class="txt"><?php echo wp_kses($settings['btn_title'], $allowed_html); ?></span></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</section>
			<!-- End Gallery Section -->

        <?php }
    }

}
