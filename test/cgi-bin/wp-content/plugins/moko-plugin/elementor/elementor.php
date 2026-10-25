<?php namespace MOKOPLUGIN\Element;

class Elementor {
	static $widgets = array(
		//Slider
		'slider_v1',
		'slider_v2',
		'slider_v3',
		'slider_v4',
		
		//HomePage One
		'featured_services',
		'about_us_v1',
		'services_v1',
		'facts_counter_v1',
		'call_to_action_v1',
		'team_v1',
		'testimonials_v1',
		'pricing_plan',
		'partners',
		'blog_v1',
		
		//HomePage Two
		'services_v2',
		'website_seo_v1',
		'call_to_action_v2',
		'recent_projects',
		'why_choose_us_v1',
		'testimonials_v2',
		'faqs_v1',
		'blog_v2',
		
		//HomePage Three
		'who_we_are',
		'services_v3',
		'market_analysis',
		'team_v2',
		'facts_counter_v2',
		'how_we_do_it',
		'why_choose_us_v2',
		'video',
		'testimonials_v3',
		'newsletter',
		
		//HomePage Five
		'services_v5',
		'blog_v3',
		'website_seo_v2',
		
		//Inner Pages
		'why_choose_us_v3',
		'facts_counter_v3',
		'faqs_v2',
		'faqs_form',
		'team_v3',
		'testimonials_v4',
		'services_v4',
		'services_detail',
		'projects_with_sidebar',
		'blog_with_sidebar',
		'contact_info',
		'google_map',
		'contact_us',
	);

	static function init() {
		add_action( 'elementor/init', array( __CLASS__, 'loader' ) );
		add_action( 'elementor/elements/categories_registered', array( __CLASS__, 'register_cats' ) );
	}

	static function loader() {

		foreach ( self::$widgets as $widget ) {

			$file = MOKOPLUGIN_PLUGIN_PATH . '/elementor/' . $widget . '.php';
			if ( file_exists( $file ) ) {
				require_once $file;
			}

			add_action( 'elementor/widgets/widgets_registered', array( __CLASS__, 'register' ) );
		}
	}

	static function register( $elemntor ) {
		foreach ( self::$widgets as $widget ) {
			$class = '\\MOKOPLUGIN\\Element\\' . ucwords( $widget );

			if ( class_exists( $class ) ) {
				$elemntor->register_widget_type( new $class );
			}
		}
	}

	static function register_cats( $elements_manager ) {

		$elements_manager->add_category(
			'moko',
			[
				'title' => esc_html__( 'Moko', 'moko' ),
				'icon'  => 'fa fa-plug',
			]
		);
		$elements_manager->add_category(
			'templatepath',
			[
				'title' => esc_html__( 'Template Path', 'moko' ),
				'icon'  => 'fa fa-plug',
			]
		);

	}
}

Elementor::init();