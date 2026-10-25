<?php

/**
 * Category Block Two Section Two  & Three
 *
 * This is the template for the content of Category Block Two Section Two  & Three. 
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if ( ! function_exists( 'daily_insight_add_category_block_two_section_two_three' ) ) :
    /**
     * Add Category Block Two Section Two & three
     *
     * @since Daily Insight 0.1
     */
    function daily_insight_add_category_block_two_section_two_three() { 
            // Check if Category Block Two Section Two & three is enabled on frontpage
            $options = daily_insight_get_theme_options(); 

            $category_block_two_enable = (bool)( $options['enable_category_block_two'] );
            if ( true !== $category_block_two_enable ) {
                return false;
            }
            // Get Category Block Two Section Two & three section details
            $section_two_details = array();
            $section_three_details = array();
            $section_two_details = apply_filters( 'daily_insight_filter_category_block_two_section_two_details', $section_two_details );
            $section_three_details = apply_filters( 'daily_insight_filter_category_block_two_section_three_details', $section_three_details );

            if ( empty( $section_two_details ) && empty( $section_three_details ) ) {
                return;
            }
            ?> 
        
            <section id="health-world-category" class="page-section row two-columns">
                <?php
                // Render Category Block Two Section Two & three section .
                daily_insight_render_category_block_two_section_two( $section_two_details );
                daily_insight_render_category_block_two_section_three( $section_three_details ); 
                ?>              
            </section><!-- #health-world-category -->
    <?php }
endif;
add_action( 'daily_insight_front_page_container_action', 'daily_insight_add_category_block_two_section_two_three', 40 );

if ( ! function_exists( 'daily_insight_get_category_block_two_section_two_details' ) ) :
    /**
     * Category Block Two Section Two & three section details.
     *
     * @since Daily Insight 0.1
     *
     * @param array $input Category Block Two Section Two & three section details.
     */
    function daily_insight_get_category_block_two_section_two_details( $input ) {
        $options = daily_insight_get_theme_options(); 

        // Category Block Two type
        $category_block_two_content_type = $options['category_block_two_type'];

        $content = array();

        switch ( $category_block_two_content_type ) {

            case 'category':
                           
                $category = !empty( $options['category_block_two_section_two_category_type'] ) ? absint( $options['category_block_two_section_two_category_type'] ) : '';

                if ( ! empty( $category ) ) {

                    $args = array(
                        'cat'                 => $category,
                        'posts_per_page'      => 3,
                    );
                }
                if( !empty( $args ) ) :

                    $custom_posts = get_posts( $args );

                    $index = 0;
                    foreach ( $custom_posts as $key => $custom_post ) {

                        if ( has_post_thumbnail( $custom_post->ID ) ) {
                            if( 0 === $index ) {
                                $img_array            = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'daily-insight-category' );
                                $content[$index]['img_array'] = $img_array;
                            } 
                            else {
                                $img_array            = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'thumbnail' );
                                $content[$index]['img_array'] = $img_array;
                            }
                        }

                        $year  = get_the_time('Y', $custom_post->ID );
                        $month = get_the_time('m', $custom_post->ID );
                        $day   = get_the_time('d', $custom_post->ID );

                        $content[$index]['date_link'] = get_day_link( $year, $month, $day ); 
                        $content[$index]['date']     = get_the_date( '' , $custom_post );
                        $content[$index]['title']    = get_the_title( $custom_post->ID );
                        $content[$index]['url']      = get_the_permalink( $custom_post->ID );
                        $content[$index]['terms']    = get_the_category( $custom_post->ID ); 
                        $content[$index]['excerpt']  = daily_insight_trim_content( 25, $custom_post );
                        $index++;
                    }
                endif;
            break;

            default:
            break;
        }
        if ( ! empty( $content ) ) {
            $input = $content;
        }
    return $input; 
    }
endif;
// Category Block Two Section Two & three section content details.
add_filter( 'daily_insight_filter_category_block_two_section_two_details', 'daily_insight_get_category_block_two_section_two_details' );

if ( ! function_exists( 'daily_insight_render_category_block_two_section_two' ) ) :
    /**
     * Start section Category Block Two Section Two & three
     *
     * @return string Category Block Two Section Two & three content
     * @since Daily Insight 0.1
     *      
     */
    function daily_insight_render_category_block_two_section_two( $content_details = array() ) {

        $options = daily_insight_get_theme_options();
        $content_type = $options['category_block_two_type'];
        $section_link = get_category_link( $options['category_block_two_section_two_category_type'] );
        $section_title = get_cat_name( $options['category_block_two_section_two_category_type'] );
        $index = 0;
        $count = count( $content_details );

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div class="column-wrapper">
        <?php 

            $section_icon =  $options['category_block_two_section_two_icon'];
            if( ! empty ( $section_title ) ) : ?>
            <header class="entry-header">
                <h2 class="entry-title category-title"><i class="fa <?php echo esc_attr( $section_icon ); ?>"></i><?php echo esc_html( $section_title ); ?></h2>  
                <a href="<?php echo esc_url( $section_link ); ?>" class="view-more"><?php esc_html_e( 'View more','daily-insight' ); ?></a>
            </header><!-- .entry-header -->
            <?php endif; ?>

            <div class="entry-content bg-white">
            <?php foreach( $content_details as $content ) : 
                if( $index == 0 ) { ?>
                <ul>
                    <li> 
                        <?php if( !empty( $content['img_array'][0] ) ) : ?>
                        <div class="image-wrapper">
                            <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" class="full-width-image" alt="<?php echo esc_attr( $content['title'] ); ?>"><div class="overlay"></div></a>
                        </div><!-- end .image-wrapper -->
                        <?php endif; ?>
                <?php } 
                else { ?>
                <?php if( $index == 1 ) { echo '<ul class="recent-posts">'; } 
                    if( empty( $content['img_array'][0] ) ) { $class = 'no-post-thumbnail'; } 
                    else { $class = '';}?>
                    <li class="<?php echo $class; ?>"> 
                        <?php if( !empty( $content['img_array'][0] ) ) : ?> 
                        <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" class="full-width-image" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                        <?php endif; ?>
                <?php } ?> 
                  
                        <div class="post-wrapper">
                            <div class="post-title">
                                <h5><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h5>
                            </div><!-- .post-title -->
                            <?php if( $index == 0 ) { 
                                $post_categories = $content['terms'];
                                if( !empty ( $post_categories ) ) : ?>
                                    <div class="category-wrap">
                                                              
                                        <?php 
                                       
                                            foreach ( $post_categories as $post_category ) {
                                                $category_id   = $post_category->term_id;
                                                $category_name = $post_category->name;
                                                $category_url  = get_category_link( $category_id );
                                            ?>
                                            <a class="category" href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category_name ); ?></a>
                                        <?php }  ?>
                                    </div><!-- .category-wrap -->
                                <?php endif; 
                                if( !empty ( $content['excerpt'] ) ) : ?>
                                    <div class="post-desc">
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    </div><!-- end .post-desc -->
                                <?php endif;
                                 $readmore_text = !empty( $options['readmore_text'] ) ? $options['readmore_text'] : '';
                                if( !empty( $readmore_text ) ) : ?>
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="view-more"><?php echo esc_html( $readmore_text ); ?></a>
                            <?php endif; }
                            else { ?>
                            <a href="<?php echo esc_url( $content['date_link'] ); ?>"><time><?php echo esc_html( $content['date'] ); ?></time></a>
                            <?php } ?>
                        </div><!-- .post-wrapper -->
                    </li>
                <?php if( $index == 0 ) { echo '</ul>'; } 
                if( ( $count - 1) == $index ) { echo '</ul><!-- .recent-posts -->'; } 
                $index++;  endforeach; ?>
            </div>
        </div><!-- end .column-wrapper -->  
<?php
    }
endif;



if ( ! function_exists( 'daily_insight_get_category_block_two_section_three_details' ) ) :
    /**
     * Category Block Two Section Two & three section details.
     *
     * @since Daily Insight 0.1
     *
     * @param array $input Category Block Two Section Two & three section details.
     */
    function daily_insight_get_category_block_two_section_three_details( $input ) {
        $options = daily_insight_get_theme_options(); 

        // Category Block Two type
        $category_block_two_content_type = $options['category_block_two_type'];

        $content = array();

        switch ( $category_block_two_content_type ) {

            case 'category':
            
                $category = !empty( $options['category_block_two_section_three_category_type'] ) ? absint( $options['category_block_two_section_three_category_type'] ) : '';

                if ( ! empty( $category ) ) {

                    $args = array(
                        'cat'                 => $category,
                        'posts_per_page'      => 3,
                    );
                }
                if( !empty( $args ) ) :

                    $custom_posts = get_posts( $args );

                    $index = 0;
                    foreach ( $custom_posts as $key => $custom_post ) {

                        if ( has_post_thumbnail( $custom_post->ID ) ) {
                            if( 0 === $index ) {
                                $img_array            = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'daily-insight-category' );
                                $content[$index]['img_array'] = $img_array;
                            } 
                            else {
                                $img_array            = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'thumbnail' );
                                $content[$index]['img_array'] = $img_array;
                            }
                        }

                        $year  = get_the_time('Y', $custom_post->ID );
                        $month = get_the_time('m', $custom_post->ID );
                        $day   = get_the_time('d', $custom_post->ID );

                        $content[$index]['date_link'] = get_day_link( $year, $month, $day ); 
                        $content[$index]['date']      = get_the_date( '' , $custom_post );
                        $content[$index]['title']     = get_the_title( $custom_post->ID );
                        $content[$index]['url']       = get_the_permalink( $custom_post->ID );
                        $content[$index]['terms']     = get_the_category( $custom_post->ID ); 
                        $content[$index]['excerpt']   = daily_insight_trim_content( 25, $custom_post );( $custom_post->ID );
                        $index++;
                    }
                endif;

            default:
            break;
        }
        if ( ! empty( $content ) ) {
            $input = $content;
        }
    return $input; 
    }
endif;
// Category Block Two Section Two & three section content details.
add_filter( 'daily_insight_filter_category_block_two_section_three_details', 'daily_insight_get_category_block_two_section_three_details' );


if ( ! function_exists( 'daily_insight_render_category_block_two_section_three' ) ) :
    /**
     * Start section Category Block Two Section Two & three
     *
     * @return string Category Block Two Section Two & three content
     * @since Daily Insight 0.1
     *      
     */
    function daily_insight_render_category_block_two_section_three( $content_details = array() ) {

        $options = daily_insight_get_theme_options();
        $content_type = $options['category_block_two_type'];
        $section_link = get_category_link( $options['category_block_two_section_three_category_type'] );
        $section_title = get_cat_name( $options['category_block_two_section_three_category_type'] );
        $index = 0;
        $count = count( $content_details );

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div class="column-wrapper">
        <?php 
        $section_icon = $options['category_block_two_section_three_icon'];

            if( ! empty ( $section_title ) ) : ?>
            <header class="entry-header clear">
                <h2 class="entry-title category-title"><i class="fa <?php echo esc_attr( $section_icon ); ?>"></i><?php echo esc_html( $section_title ); ?></h2>  
                <a href="<?php echo esc_url( $section_link ); ?>" class="view-more"><?php esc_html_e( 'View more','daily-insight' ); ?></a>
            </header><!-- .entry-header -->
            <?php endif; ?>

            <div class="entry-content bg-white">
            <?php foreach( $content_details as $content ) : 
                if( $index == 0 ) { ?>
                <ul>
                    <li>
                        <?php if( !empty( $content['img_array'][0] ) ) : ?> 
                        <div class="image-wrapper">
                            <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" class="full-width-image" alt="<?php echo esc_attr( $content['title'] ); ?>"><div class="overlay"></div></a>
                        </div><!-- end .image-wrapper -->
                        <?php endif; ?>  
                <?php } 
                else { ?>
                <?php if( $index == 1 ) { echo '<ul class="recent-posts">'; } 
                    if( empty( $content['img_array'][0] ) ) { $class = 'no-post-thumbnail'; }
                    else { $class = '';}?>
                    <li class="<?php echo $class; ?>"> 
                        <?php if( !empty( $content['img_array'][0] ) ) : ?>  
                        <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" class="full-width-image" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                        <?php endif; ?>
                <?php } ?> 
                  
                        <div class="post-wrapper">
                            <div class="post-title">
                                <h5><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h5>
                            </div><!-- .post-title -->
                            <?php if( $index == 0 ) { 
                                $post_categories = $content['terms'];
                                if( !empty ( $post_categories ) ) : ?>
                                    <div class="category-wrap">                        
                                        <?php
                                            foreach ( $post_categories as $post_category ) {
                                                $category_id   = $post_category->term_id;
                                                $category_name = $post_category->name;
                                                $category_url  = get_category_link( $category_id );
                                            ?>
                                            <a class="category" href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category_name ); ?></a>
                                        <?php }  ?>
                                    </div><!-- .category-wrap -->
                                <?php endif; 
                                if( !empty ( $content['excerpt'] ) ) : ?>
                                    <div class="post-desc">
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    </div><!-- end .post-desc -->
                                <?php endif;
                                 $readmore_text = !empty( $options['readmore_text'] ) ? $options['readmore_text'] : '';
                                if( !empty( $readmore_text ) ) : ?>
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="view-more"><?php echo esc_html( $readmore_text ); ?></a>
                                <?php endif;
                            } 
                            else { ?>
                            <a href="<?php echo esc_url( $content['date_link'] ); ?>"><time><?php echo esc_html( $content['date'] ); ?></time></a>
                            <?php } ?>
                        </div><!-- .post-wrapper -->
                    </li>
                <?php if( $index == 0 ) { echo '</ul>'; } 
                if( ( $count - 1) == $index ) { echo '</ul><!-- .recent-posts -->'; } 
                $index++; endforeach; ?>
            </div>
        </div><!-- end .column-wrapper -->    
<?php
    }
endif;