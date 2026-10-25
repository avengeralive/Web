<!DOCTYPE HTML>
<!--[if IE 9 ]><html id="ie9" class="no-js"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js"><!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    
    <title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
/*  bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
*/
    ?></title>
    <base href="<?=get_bloginfo('url')?>/">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900,500,400italic,700italic&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'  data-noprefix>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="<?php echo get_template_directory_uri(); ?>/css/reset.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css" rel="stylesheet">
   
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css?v=5" rel="stylesheet">
    
    <script src="<?php echo get_template_directory_uri(); ?>/js/library.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/lib/helper-plugins/jquery.touchSwipe.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/parallax.js"></script>
    <script>var root ="<?php echo get_template_directory_uri(); ?>";</script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/mobile.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/form.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate/jquery.validate.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate/localization/messages_ru.min.js"></script>
     <script src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery.fancybox.pack.js"></script>
    
    <script type="text/javascript">
        function equalHeight(group) {
            var tallest = 0;
            group.each(function() {
                thisHeight = $(this).height();
                if(thisHeight > tallest) {
                    tallest = thisHeight;
                }
            });
            group.height(tallest);
        }    
    </script>

    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1, width=device-width">

    
<?php
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    wp_head();
?>
    
    
</head>


<div class="page">


