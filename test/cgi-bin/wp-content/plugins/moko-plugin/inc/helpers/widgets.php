<?php
///----Blog widgets---
//Recent Post
class Moko_Recent_Post extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Recent_Post', /* Name */esc_html__('Moko Recent Post','moko'), array( 'description' => esc_html__('Show the Recent Post blog sidebar', 'moko' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<!-- Categories Widget -->
		<div class="popular-posts">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			<div class="widget-content">
				<?php $query_string = 'posts_per_page='.$instance['number'];
					if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
					 
					$this->posts($query_string);
				?>
			</div>
		</div>

		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Posts', 'moko');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Category', 'moko'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'moko'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('categories')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($query_string)
	{
		
	$query = new WP_Query($query_string);
	if( $query->have_posts() ):?>

		<?php  global $post;
		while( $query->have_posts() ): $query->the_post(); ?>

		<article class="post">
			<figure class="post-thumb"><?php the_post_thumbnail('moko_100x100'); ?><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>" class="overlay-box"><span class="icon fa fa-link"></span></a></figure>
			<div class="text"><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><?php the_title(); ?></a></div>
			<div class="post-info"><?php echo get_the_date(); ?></div>
		</article>

		<?php endwhile; ?>

	<?php endif;
	wp_reset_postdata();
    }
}

//Blog Author
class Moko_Blog_Author extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Blog_Author', /* Name */esc_html__('Moko Blog Author', 'moko'), array( 'description' => esc_html__('Show the Blog Author in blog sidebar.', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		echo wp_kses_post($before_widget); ?>
		
		<!-- Author Widget -->
		<div class="author-widget">
			<div class="widget-content" style="background-image: url(<?php echo get_template_directory_uri().'/assets/images/background/author-bg.jpg'; ?>)">
				<div class="image">
					<img src="<?php echo esc_url($instance['author_image']); ?>" alt="<?php esc_attr_e('Author Image', 'moko'); ?>" />
				</div>
				<div class="name"><?php echo wp_kses_post($instance['author_name']); ?></div>
				<div class="text"><?php echo wp_kses_post($instance['content']); ?></div>
				<!-- Social Box -->
				<ul class="social-box">
					<?php if($instance['facebook']) { ?>
					<li><a href="<?php echo esc_url($instance['facebook']); ?>" class="fab fa-facebook-f"></a></li>
					<?php } ?>
					
					<?php if($instance['twitter']) { ?>
					<li><a href="<?php echo esc_url($instance['twitter']); ?>" class="fab fa-twitter"></a></li>
					<?php } ?>
					
					<?php if($instance['linkedin']) { ?>
					<li><a href="<?php echo esc_url($instance['linkedin']); ?>" class="fab fa-linkedin-in"></a></li>
					<?php } ?>
					
					<?php if($instance['instagram']) { ?>
					<li><a href="<?php echo esc_url($instance['instagram']); ?>" class="fab fa-instagram"></a></li>
					<?php } ?>
					
					<?php if($instance['pinterest']) { ?>
					<li><a href="<?php echo esc_url($instance['pinterest']); ?>" class="fab fa-pinterest-p"></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['author_image'] = $new_instance['author_image'];
		$instance['author_name'] = $new_instance['author_name'];
		$instance['content'] = $new_instance['content'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['pinterest'] = $new_instance['pinterest'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$author_image = ($instance) ? esc_attr($instance['author_image']) : get_template_directory_uri(). '/assets/images/resource/author-7.jpg';
		$author_name = ($instance) ? esc_attr($instance['author_name']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$facebook = ($instance) ? esc_attr($instance['facebook']) : '';
		$twitter = ($instance) ? esc_attr($instance['twitter']) : '';
		$linkedin = ($instance) ? esc_attr($instance['linkedin']) : '';
		$instagram = ($instance) ? esc_attr($instance['instagram']) : '';
		$pinterest = ($instance) ? esc_attr($instance['pinterest']) : ''; ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('author_image')); ?>"><?php esc_html_e('Author Image URL:', 'moko'); ?></label>
            <input placeholder="<?php esc_attr_e('Image URL', 'moko');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('author_image')); ?>" name="<?php echo esc_attr($this->get_field_name('author_image')); ?>" type="text" value="<?php echo esc_attr($author_image); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('author_name')); ?>"><?php esc_html_e('Author Name:', 'moko'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('author_name')); ?>" name="<?php echo esc_attr($this->get_field_name('author_name')); ?>" value="<?php echo esc_attr($author_name); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'moko'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook URL:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter URL:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('Linkedin URL:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Instagram URL:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest URL:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
        </p>

		<?php 
	}
}

//Gallery V2
class Moko_Gallery_V2 extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Gallery_V2', /* Name */esc_html__('Moko Gallery V2', 'moko'), array( 'description' => esc_html__('Show the Gallery in blog sidebar.', 'moko' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<!-- Instagram Widget -->
		<div class="instagram-widget">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			<div class="widget-content">
				<div class="clearfix">
					<?php $args = array('post_type' => 'project', 'showposts'=>$instance['number']);
						if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'project_cat', 'field' => 'id','terms' => (array)$instance['cat']));
						$this->posts($args);
					?>
				</div>
			</div>
		</div>

        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : 'Gallery';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : ''; ?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'moko'); ?></label>
            <input placeholder="<?php esc_attr_e('Popular Gallery', 'moko');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts: ', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'moko'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'moko'), 'selected'=>$cat, 'taxonomy' => 'project_cat', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($args)
	{
		
	$query = new WP_Query($args);
	if( $query->have_posts() ): ?>

		<?php global $post;
		while( $query->have_posts() ): $query->the_post(); ?>
		<figure class="post-thumb"><?php the_post_thumbnail('moko_110x110'); ?><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>" class="overlay-box"><span class="icon fa fa-link"></span></a></figure>
		<?php endwhile; ?>

	<?php endif;
	wp_reset_postdata();
    }
}

///----Services Widgets---
//Download Our Brochures
class Moko_Download_Brochures extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Download_Brochures', /* Name */esc_html__('Moko Download Brochures', 'moko'), array( 'description' => esc_html__('Show the Download Our Brochures in Services Sidebar.', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
      		
		<!-- Broucher Widget -->
		<div class="broucher-widget">
			<div class="widget-content" style="background-image: url(<?php echo get_template_directory_uri().'/assets/images/background/pattern-19.jpg'; ?>)">
				<h3><?php echo wp_kses_post($instance['title']); ?></h3>
				<div class="icon <?php echo esc_attr($instance['icon']); ?>"></div>
				<div class="text"><?php echo wp_kses_post($instance['content']); ?></div>
				
				<?php if($instance['button_link'] and $instance['button_title']) { ?>
				<a href="<?php echo esc_url($instance['button_link']); ?>" class="download"><?php echo wp_kses_post($instance['button_title']); ?></a>
				<?php } ?>
			</div>
		</div>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['icon'] = $new_instance['icon'];
		$instance['content'] = $new_instance['content'];
		$instance['button_title'] = $new_instance['button_title'];
		$instance['button_link'] = $new_instance['button_link'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$icon = ($instance) ? esc_attr($instance['icon']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$button_title = ($instance) ? esc_attr($instance['button_title']) : '';
		$button_link = ($instance) ? esc_attr($instance['button_link']) : ''; ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter Title:', 'moko'); ?></label>
			<input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php esc_html_e('Icon:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('icon')); ?>" placeholder="flaticon-pdf-1" class="widefat" id="<?php echo esc_attr($this->get_field_id('icon')); ?>" value="<?php echo esc_attr($icon); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'moko'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('button_title')); ?>"><?php esc_html_e('Button Title:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('button_title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('button_title')); ?>" value="<?php echo esc_attr($button_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('button_link')); ?>"><?php esc_html_e('Button Link:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('button_link')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('button_link')); ?>" value="<?php echo esc_attr($button_link); ?>" />
        </p>
               
		<?php 
	}
}

//Need Help
class Moko_Need_Help extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Need_Help', /* Name */esc_html__('Moko Need Help ?', 'moko'), array( 'description' => esc_html__('Show the Need Help in Services Sidebar.', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
      	
		<!-- Help Widget -->
		<div class="help-widget">
			<div class="widget-content">
				<h4><?php echo wp_kses_post($instance['title']); ?></h4>
				<div class="text"><?php echo wp_kses_post($instance['content']); ?></div>
				<ul class="help-list">
					<?php if($instance['phone_number']) { ?>
					<li><a href="tel:<?php echo phone_number($instance['phone_number']); ?>"><span class="icon fas fa-phone"></span><?php echo wp_kses_post($instance['phone_number']); ?></a></li>
					<?php } ?>
					
					<?php if($instance['email_address']) { ?>
					<li><a href="mailto:<?php echo wp_kses_post($instance['email_address']); ?>"><span class="icon fa fa-envelope"></span><?php echo wp_kses_post($instance['email_address']); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['content'] = $new_instance['content'];
		$instance['phone_number'] = $new_instance['phone_number'];
		$instance['email_address'] = $new_instance['email_address'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$phone_number = ($instance) ? esc_attr($instance['phone_number']) : '';
		$email_address = ($instance) ? esc_attr($instance['email_address']) : ''; ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter Title:', 'moko'); ?></label>
			<input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'moko'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone_number')); ?>"><?php esc_html_e('Phone Number:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('phone_number')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_number')); ?>" value="<?php echo esc_attr($phone_number); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email_address')); ?>"><?php esc_html_e('Email Addess:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email_address')); ?>" name="<?php echo esc_attr($this->get_field_name('email_address')); ?>" type="text" value="<?php echo esc_attr($email_address); ?>" />
        </p>
               
		<?php 
	}
}

///----Footer One Widgets---
//About Company V1
class Moko_About_Company_V1 extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_About_Company_V1', /* Name */esc_html__('Moko About Company V1','moko'), array( 'description' => esc_html__('Show the About Company V1 in Footer One.', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget); ?>
			
			<div class="logo-widget">
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($instance['logo_image']); ?>" alt="<?php esc_attr('Logo', 'moko'); ?>" /></a>
				</div>
				<div class="text"><?php echo wp_kses_post($instance['content']); ?></div>
				
				<?php if( $instance['show'] ): ?>
				<!-- Social Box -->
				<?php echo wp_kses_post(moko_get_social_icons3()); ?>
				<?php endif; ?>
			</div>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['logo_image'] = $new_instance['logo_image'];
		$instance['content'] = $new_instance['content'];
		$instance['show'] = $new_instance['show'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$logo_image = ($instance) ? esc_attr($instance['logo_image']) : get_template_directory_uri(). '/assets/images/logo.svg';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$show = ($instance) ? esc_attr($instance['show']) : ''; ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('logo_image')); ?>"><?php esc_html_e('Logo Image URL:', 'moko'); ?></label>
            <input placeholder="<?php esc_attr_e('Image URL', 'moko');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_image')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_image')); ?>" type="text" value="<?php echo esc_attr($logo_image); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'moko'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php esc_html_e('Show Social Icons:', 'moko'); ?></label>
			<?php $selected = ( $show ) ? ' checked="checked"' : ''; ?>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show')); ?>"<?php echo esc_attr($selected); ?> name="<?php echo esc_attr($this->get_field_name('show')); ?>" type="checkbox" value="true" />
        </p>
               
		<?php 
	}
	
}

//Gallery V1
class Moko_Gallery_V1 extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Gallery_V1', /* Name */esc_html__('Moko Gallery V1', 'moko'), array( 'description' => esc_html__('Show the Gallery in Footer', 'moko' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<!--Footer Column-->
		<div class="gallery-widget">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			<div class="widget-content">
				<div class="images-outer clearfix">
					<?php $args = array('post_type' => 'project', 'showposts'=>$instance['number']);
						if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'projects_cat', 'field' => 'id','terms' => (array)$instance['cat']));
						$this->posts($args);
					?>
				</div>
			</div>
		</div>

        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : 'Gallery';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : ''; ?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'moko'); ?></label>
            <input placeholder="<?php esc_attr_e('Popular Gallery', 'moko');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts: ', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'moko'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'moko'), 'selected'=>$cat, 'taxonomy' => 'project_cat', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($args)
	{
		
		$query = new WP_Query($args);
		if( $query->have_posts() ): ?>
            <?php 
				while( $query->have_posts() ): $query->the_post(); 
				global $post; 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
			?>
			<!--Image Box-->
			<figure class="image-box">
				<a href="<?php echo esc_url($post_thumbnail_url); ?>" data-fancybox="footer-gallery" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('moko_80x80'); ?></a>
			</figure>
            <?php endwhile; ?>
                
        <?php endif;
		wp_reset_postdata();
    }
}

//Contact Info
class Moko_Contact_Info_V1 extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Contact_Info_V1', /* Name */esc_html__('Moko Contact Info V1','moko'), array( 'description' => esc_html__('Show the Contact Info V1 in Footer One', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
      		
			<div class="links-widget">
				<?php echo wp_kses_post($before_title.$title.$after_title); ?>
				<ul class="list-style-two">
					<?php if($instance['working_hours']) { ?>
					<li><span class="icon flaticon-wall-clock"></span><?php echo wp_kses_post($instance['working_hours']); ?></li>
					<?php } ?>
					
					<?php if($instance['phone_number1'] or $instance['phone_number2']) { ?>
					<li><span class="icon flaticon-phone-call"></span><a href="tel:<?php echo phone_number($instance['phone_number1']); ?>"><?php echo wp_kses_post($instance['phone_number1']); ?></a> <?php esc_html_e('&', 'moko'); ?> <a href="tel:<?php echo phone_number($instance['phone_number2']); ?>"><?php echo wp_kses_post($instance['phone_number2']); ?></a></li>
					<?php } ?>
					
					<?php if($instance['email_address']) { ?>
					<li><span class="icon flaticon-email"></span><a href="mailto:<?php echo wp_kses_post($instance['email_address']); ?>"><?php echo wp_kses_post($instance['email_address']); ?></a></li>
					<?php } ?>
					
					<?php if($instance['address']) { ?>
					<li><span class="icon flaticon-maps-and-flags"></span><?php echo wp_kses_post($instance['address']); ?></li>
					<?php } ?>
				</ul>
			</div>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['working_hours'] = $new_instance['working_hours'];
		$instance['phone_number1'] = $new_instance['phone_number1'];
		$instance['phone_number2'] = $new_instance['phone_number2'];
		$instance['email_address'] = $new_instance['email_address'];
		$instance['address'] = $new_instance['address'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Contact Info', 'moko');
		$working_hours = ($instance) ? esc_attr($instance['working_hours']) : '';
		$phone_number1 = ($instance) ? esc_attr($instance['phone_number1']) : '';
		$phone_number2 = ($instance) ? esc_attr($instance['phone_number2']) : '';
		$email_address = ($instance) ? esc_attr($instance['email_address']) : '';
		$address = ($instance) ? esc_attr($instance['address']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter Title:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('working_hours')); ?>"><?php esc_html_e('Working Hours:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('working_hours')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('working_hours')); ?>" value="<?php echo esc_attr($working_hours); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone_number1')); ?>"><?php esc_html_e('Phone Number 1:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('phone_number1')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_number1')); ?>" value="<?php echo esc_attr($phone_number1); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone_number2')); ?>"><?php esc_html_e('Phone Number 2:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('phone_number2')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_number2')); ?>" value="<?php echo esc_attr($phone_number2); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email_address')); ?>"><?php esc_html_e('Email Addess:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email_address')); ?>" name="<?php echo esc_attr($this->get_field_name('email_address')); ?>" type="text" value="<?php echo esc_attr($email_address); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'moko'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" ><?php echo wp_kses_post($address); ?></textarea>
        </p>
               
		<?php 
	}
}

///----Footer Two Widgets---
//Contact Info
class Moko_About_Company_V2 extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_About_Company_V2', /* Name */esc_html__('Moko About Company V2', 'moko'), array( 'description' => esc_html__('Show the About Company V2 in Footer Two.', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		echo wp_kses_post($before_widget); ?>
			
			<!-- Footer Column -->
			<div class="logo-widget">
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($instance['logo_image']); ?>" alt="<?php esc_attr('Logo', 'moko'); ?>" /></a>
				</div>
				<div class="text"><?php echo wp_kses_post($instance['content']); ?></div>
			</div>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['logo_image'] = $new_instance['logo_image'];
		$instance['content'] = $new_instance['content'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$logo_image = ($instance) ? esc_attr($instance['logo_image']) : get_template_directory_uri(). '/assets/images/logo-2.svg';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('logo_image')); ?>"><?php esc_html_e('Logo Image URL:', 'moko'); ?></label>
            <input placeholder="<?php esc_attr_e('Image URL', 'moko');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_image')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_image')); ?>" type="text" value="<?php echo esc_attr($logo_image); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'moko'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
               
		<?php 
	}
}

//Contact Info V2
class Moko_Contact_Info_V2 extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Contact_Info_V2', /* Name */esc_html__('Moko Contact Info V2','moko'), array( 'description' => esc_html__('Show the Contact Info V2 in Footer Two', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
      		
			<div class="footer-widget contact-info-widget">
				<?php echo wp_kses_post($before_title.$title.$after_title); ?>
				<div class="widget-content">
					<ul>
						<?php if($instance['working_hours']) { ?>
						<li><?php echo wp_kses_post($instance['working_hours']); ?></li>
						<?php } ?>

						<?php if($instance['phone_number1'] or $instance['phone_number2']) { ?>
						<li><a href="tel:<?php echo phone_number($instance['phone_number1']); ?>"><?php echo wp_kses_post($instance['phone_number1']); ?></a> <?php esc_html_e('&', 'moko'); ?> <a href="tel:<?php echo phone_number($instance['phone_number2']); ?>"><?php echo wp_kses_post($instance['phone_number2']); ?></a></li>
						<?php } ?>

						<?php if($instance['email_address']) { ?>
						<li><a href="mailto:<?php echo wp_kses_post($instance['email_address']); ?>"><?php echo wp_kses_post($instance['email_address']); ?></a></li>
						<?php } ?>

						<?php if($instance['address']) { ?>
						<li><?php echo wp_kses_post($instance['address']); ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['working_hours'] = $new_instance['working_hours'];
		$instance['phone_number1'] = $new_instance['phone_number1'];
		$instance['phone_number2'] = $new_instance['phone_number2'];
		$instance['email_address'] = $new_instance['email_address'];
		$instance['address'] = $new_instance['address'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Contact Info', 'moko');
		$working_hours = ($instance) ? esc_attr($instance['working_hours']) : '';
		$phone_number1 = ($instance) ? esc_attr($instance['phone_number1']) : '';
		$phone_number2 = ($instance) ? esc_attr($instance['phone_number2']) : '';
		$email_address = ($instance) ? esc_attr($instance['email_address']) : '';
		$address = ($instance) ? esc_attr($instance['address']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter Title:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('working_hours')); ?>"><?php esc_html_e('Working Hours:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('working_hours')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('working_hours')); ?>" value="<?php echo esc_attr($working_hours); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone_number1')); ?>"><?php esc_html_e('Phone Number 1:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('phone_number1')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_number1')); ?>" value="<?php echo esc_attr($phone_number1); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone_number2')); ?>"><?php esc_html_e('Phone Number 2:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('phone_number2')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_number2')); ?>" value="<?php echo esc_attr($phone_number2); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email_address')); ?>"><?php esc_html_e('Email Addess:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email_address')); ?>" name="<?php echo esc_attr($this->get_field_name('email_address')); ?>" type="text" value="<?php echo esc_attr($email_address); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'moko'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" ><?php echo wp_kses_post($address); ?></textarea>
        </p>
               
		<?php 
	}
}

//Download The App
class Moko_Download_The_App extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Moko_Download_The_App', /* Name */esc_html__('Moko Download The App','moko'), array( 'description' => esc_html__('Show the Download The App Footer Two', 'moko' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
      		
			<div class="footer-widget app-widget">
				<?php echo wp_kses_post($before_title.$title.$after_title); ?>
				<div class="app-btns clearfix">
					<?php if($instance['app_store_link'] and $instance['app_store_img']) { ?>
					<a href="<?php echo esc_url($instance['app_store_link']); ?>"><img src="<?php echo esc_url($instance['app_store_img']); ?>" alt="<?php esc_attr('App Store', 'moko'); ?>" /></a>&ensp;
					<?php } ?>
					
					<?php if($instance['google_play_link'] and $instance['google_play_img']) { ?>
					<a href="<?php echo esc_url($instance['google_play_link']); ?>"><img src="<?php echo esc_url($instance['google_play_img']); ?>" alt="<?php esc_attr('Google Play', 'moko'); ?>" /></a>
					<?php } ?>
				</div>
				
				<?php if( $instance['show'] ): ?>
				<!-- Social Box -->
				<?php echo wp_kses_post(moko_get_social_icons2()); ?>
				<?php endif; ?>
			</div>
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['app_store_img'] = $new_instance['app_store_img'];
		$instance['app_store_link'] = $new_instance['app_store_link'];
		$instance['google_play_img'] = $new_instance['google_play_img'];
		$instance['google_play_link'] = $new_instance['google_play_link'];
		$instance['show'] = $new_instance['show'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Download the App', 'moko');
		$app_store_img = ($instance) ? esc_attr($instance['app_store_img']) : get_template_directory_uri(). '/assets/images/icons/app-btn.png';
		$app_store_link = ($instance) ? esc_attr($instance['app_store_link']) : '';
		$google_play_img = ($instance) ? esc_attr($instance['google_play_img']) : get_template_directory_uri(). '/assets/images/icons/google-btn.png';
		$google_play_link = ($instance) ? esc_attr($instance['google_play_link']) : '';
		$show = ($instance) ? esc_attr($instance['show']) : ''; ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter Title:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('app_store_img')); ?>"><?php esc_html_e('App Store Image URL:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('app_store_img')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('app_store_img')); ?>" value="<?php echo esc_attr($app_store_img); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('app_store_link')); ?>"><?php esc_html_e('App Store Link:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('app_store_link')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('app_store_link')); ?>" value="<?php echo esc_attr($app_store_link); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('google_play_img')); ?>"><?php esc_html_e('Google Play Image URL:', 'moko'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('google_play_img')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('google_play_img')); ?>" value="<?php echo esc_attr($google_play_img); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('google_play_link')); ?>"><?php esc_html_e('Google Play Link:', 'moko'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('google_play_link')); ?>" name="<?php echo esc_attr($this->get_field_name('google_play_link')); ?>" type="text" value="<?php echo esc_attr($google_play_link); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php esc_html_e('Show Social Icons:', 'moko'); ?></label>
			<?php $selected = ( $show ) ? ' checked="checked"' : ''; ?>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show')); ?>"<?php echo esc_attr($selected); ?> name="<?php echo esc_attr($this->get_field_name('show')); ?>" type="checkbox" value="true" />
        </p>
               
		<?php 
	}
}
