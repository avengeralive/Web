<?php
/*
Template Name: Пост в портфолио
 Template post type: post, page
*/
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <div class="relative" style="max-height: 400px">
        <div class="relative" data-stellar-ratio="0.5">
            <?php
            $image = get_field('top_bak');
            if( !empty($image) ){
                $img = $image['url'];
            }else{
                $img = get_template_directory_uri() ."/images/blog-post.jpg";
            }
            ?>
            <img src="<?php echo $img?>" class="img-full-width relative" width="1920" alt="<?=the_title()?>">
        </div>
    </div>

    <?php // include(locate_template('project_arrows.php')); ?>



    <section class="company-info white-block project_page" style="background-color:#fff;" itemscope itemtype="http://schema.org/MobileApplication">
            <div class="container game_wr" style="position: relative">
                <div class="project_top_img">
                    <div class="portfolio_top_img_slider_box">

                        <div class="carousel-arrows">
                            <a class="carousel-arrow a-left" href="#"><i></i></a>
                            <a class="carousel-arrow a-right" href="#"><i></i></a>
                        </div>

                        <ul class="portfolio_top_img_slider">
                        <?php

                        $no_platforms = true;

                        if( get_field('apple_type') ){
                            $image = get_field('apple_image');
                            $no_platforms = false;
                            ?><li data-icon="apple" data-text="iPhone"><img src="<?=$image['url']?>" alt="<?=$image['alt']?>" itemprop="image"/></li><?
                        }

                        if( get_field('ipad') ){
                            $image = get_field('ipad_image');
                            $no_platforms = false;
                            ?><li data-icon="apple" data-text="iPad"><img src="<?=$image['url']?>" alt="<?=$image['alt']?>" itemprop="image"/></li><?
                        }

                        if( get_field('android_type') ){
                            $image = get_field('android_image');
                            $no_platforms = false;
                            ?><li data-icon="android" data-text="Android"><img src="<?=$image['url']?>" alt="<?=$image['alt']?>" itemprop="image"/></li><?
                        }

                        if( get_field('android_pad') ){
                            $image = get_field('android_pad_image');
                            $no_platforms = false;
                            ?><li data-icon="android" data-text="Android-tablet"><img src="<?=$image['url']?>" alt="<?=$image['alt']?>" itemprop="image"/></li><?
                        }

                        if( get_field('tizen_type') ){
                            $image = get_field('tizen_image');
                            $no_platforms = false;
                            ?><li data-icon="tizen" data-text="Tizen"><img src="<?=$image['url']?>" alt="<?=$image['alt']?>" itemprop="image"/></li><?
                        }

                        if($no_platforms){
                            $image = get_field('main_image');
                            if (!empty($image)) {
                                ?><li data-icon="" data-text=""><img src="<?=$image['url']?>" alt="<?=$image['alt'] ? $image['alt'] : the_title()?>" itemprop="image"/><meta itemprop="operatingSystem" content="WEB"/></li><?
                            }

                        }

                        ?>
                        </ul>
                    </div>
                </div>

                <script>
                    $(document).ready(function(){
                        $(".portfolio_top_img_slider").carouFredSel({
                            responsive: true,
                            width: "100%",
                            height: 'variable',
                            items: {
                                height: 'variable'
                            },
                            scroll: {
                                items: 1,
                                fx: "crossfade",
                                visible: {
                                    min: 1,
                                    max: 1
                                }
                              /*  onAfter: function(data){
                                    animateBlock(data.items.old.find('.anim-block'), 'b');
                                    animateBlock(data.items.visible.find('.anim-block'));
                                } */
                                /*pauseOnHover:true*/

                            },
                            next: ".portfolio_top_img_slider_box .a-right",
                            prev: ".portfolio_top_img_slider_box .a-left",
                            auto:  auto_carouFredSel,
                            pagination: {
                                container: ".portfolio_top_img_slider_pager",
                                anchorBuilder: function (nr) {
                                    var item =  $($(".portfolio_top_img_slider li").get(nr -1));
                                    var icon = item.attr('data-icon');
                                    var text = item.attr('data-text');
                                    return '<a class="dev_icon icon_' +  icon + '"href="#' + nr + '"><span>' + text + '</span></a>';
                                },
                                conditions: false

                            },
                            swipe: true
                        });
                        $("#solution-carousel2 .carousel-block").carouFredSel({
                            responsive: true,
                            width: "100%",
                            height: "auto",
                            items: 1,
                            scroll: {
                                items: 1
                            },
                            auto: false,
                            next: "#solution-carousel2 .solution-carousel-arrows .a-right",
                            prev: "#solution-carousel2 .solution-carousel-arrows .a-left",
                            swipe:true
                        });
                        $("#solution-carousel .carousel-block").carouFredSel({
                            responsive: true,
                            width: "100%",
                            height: "auto",
                            items: 1,
                            scroll: {
                                items: 1
                            },
                            auto: false,
                            next: "#solution-carousel .solution-carousel-arrows .a-right",
                            prev: "#solution-carousel .solution-carousel-arrows .a-left",
                            swipe:true
                        });

                        var tmp = $('.portfolio_top_img_slider>li');
                        if(tmp.length < 2) $('.portfolio_top_img_slider_box .carousel-arrows').hide();
                    });
                </script>
                <div class="replace"></div>

                <div class="phone-icons  project portfolio_top_img_slider_pager">
                </div>

                <h1 class="nice_title" itemprop="name"><?php $title =  get_the_title(); echo $title; ?></h1>
                
                <meta itemprop="applicationCategory" content="Business"/>
                    <div itemscope itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating">
                        <meta itemprop="bestRating" content="5"/>
                        <meta itemprop="ratingValue" content="5"/>
                        <meta itemprop="reviewCount" content="199"/>
                    </div>
                    <link itemprop="url" href="<?php the_permalink(); ?>" content="<?php the_permalink(); ?>"/>
                    
                <div class="projectinfo">

                    <?php the_content(); ?> 

                    <ul class="store_icons">
                        <? if( (get_field('android_type') || get_field('android_pad')) && get_field('android_link')  ){?><li class="store_android"><a target='_blank' href="<?=get_field('android_link')?>" rel="nofollow"></a><meta itemprop="operatingSystem" content="Android"/></li><?}?>
                        <? if( (get_field('apple_type') || get_field('ipad')) && get_field('apple_link') ){?><li class="store_apple"><a target='_blank' href="<?=get_field('apple_link')?>" rel="nofollow"></a><meta itemprop="operatingSystem" content="iOS"/></li><?}?>
                        <? if( (get_field('ipad_type') || get_field('ipad')) && get_field('ipad_link') ){?><li class="store_apple"><a target='_blank' href="<?=get_field('ipad_link')?>" rel="nofollow"></a><meta itemprop="operatingSystem" content="iOS"/></li><?}?>
                        <? if( get_field('tizen') && get_field('tizen_link') ){?><li class="store_tizen"><a target='_blank' href="<?=get_field('tizen_link')?>" rel="nofollow"></a><meta itemprop="operatingSystem" content="Tizen"/></li><?}?>
                    </ul> 
                </div>

        </div>
    </section>

    <?php
    $tt=1;

    $images = do_shortcode( '[types field="img_hor" alt="" title="" size="blog_small"]' );

    if(!empty($images)){
        $tt=0;
        echo'
			<section class="color-block-info grey-block">
				<div class="container sm-gal bot90 someclasshere">'.$images.'</div>	
			</section>';
    }
    ?>

    <?php

    $string = do_shortcode( '[types field="lil_images" separator="<abahabra>"]' );
    $images = explode("<abahabra>", $string);

    $string = do_shortcode( '[types field="description_block" separator="<abahabra>"][/types]' );
    $descriptions = explode("<abahabra>", $string);

    if(count($descriptions)>0 && !empty($descriptions[0])){
        foreach($descriptions as $k => $v){
            $image='';

            if($tt==1){$colo="grey";$tt=0;}else{$colo="white";$tt=1;}

            foreach($images as $k1 => $v1){if($k1==$k){$image=$v1; break;}}


            $code = array("[left]", "[/left]", "[right]", "[/right]", "<br />", "<p>", "</p>");
            $value   = array("<div class='left_col'>", "</div>", "<div class='right_col'>", "</div>", "", "", "");

            $content = str_replace($code, $value, $v);

            echo"<section class='color-block-info ".$colo."-block '>
						<div class='container sm-gal bot90 project-block-text'>
							<div class='mid_img'>".$image."</div>".$content."

							<div class='clear'></div>
						</div>
				</section>";
        }
    }
    ?>


    <?php
    $string = do_shortcode( '[types field="project_video1" separator="<abahabra>"][/types]' );
    $videos = explode("<abahabra>", $string);

    if(count($videos)>0 && !empty($videos[0])){
        if($tt==1){$colo="grey";$tt=0;}else{$colo="white";$tt=1;}
        echo"<section class='presentaton color-block-info ".$colo."-block'>
			<div class='container bot90'>
				<div class='presentaton-carousel' id='solution-carousel'>
					<div class='solution-carousel-arrows dark carousel-arrows'>
						<a class='carousel-arrow a-left' href='#'><i></i></a>
						<a class='carousel-arrow a-right' href='#'><i></i></a>
					</div>
  					<ul class='no-list left-list carousel-block'>";

        foreach($videos as $k => $v){

            echo'
						<li class="carousel-item" >
							<div class="row clearfix no-margin">
								<div class="col-md-10 no-padding col-md-offset-1">
									<div class="presentation-block">
										<iframe src="'.$v.'" width="663" height="533" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="max-width: 100%;" allowfullscreen> </iframe>
									</div>
								</div>
							</div>
						</li>';
        }


        echo"			</ul>
				</div>
			</div>
		
		</section>";
    }
    ?>

    <?php
    $string = do_shortcode( '[types field="slide_image" separator="<abahabra>"][/types]' );
    $slide_image = explode("<abahabra>", $string);

    $string = do_shortcode( '[types field="slide_text" separator="<abahabra>"][/types]' );
    $slide_text = explode("<abahabra>", $string);

    if(count($slide_image)>0 && !empty($slide_image[0])){
        if($tt==1){$colo="grey";$tt=0;}else{$colo="white";$tt=1;}
        echo"<section class='presentaton color-block-info ".$colo."-block '>
		
			<div class='container bot90'>
				<div class='blog-item-title' style='margin-bottom:20px;font-size:26px;'>Реализация</div>

				<div class='presentaton-carousel' id='solution-carousel2'>
					<div class='solution-carousel-arrows dark carousel-arrows'>
						<a class='carousel-arrow a-left' href='#'><i></i></a>
						<a class='carousel-arrow a-right' href='#'><i></i></a>
					</div>
  					<ul class='no-list left-list carousel-block'>";


        foreach($slide_image as $k => $v){
            $descr='';
            foreach($slide_text as $k1 => $v1){if($k1==$k){$descr=$v1; break;}}


            echo'
						<li class="carousel-item">
							<div class="row no-margin">
								<div class="col-md-10 text-center">
									<div class="mid_img">'.str_replace('alt=""', 'alt="'.get_the_title().'"', $v).'</div>
									<div class="align_center">'.$descr.'</div>
								</div>
							</div>
						</li>';
        }



        echo"			</ul>
				</div>
			</div>
	
		</section>";
    }
    ?>

    <?php
    if($tt==1){$colo="grey";$tt=0;}else{$colo="white";$tt=1;}?>



    <?
    $rr1 = get_post_meta($post->ID, 'res1', true);
    $rr2 = get_post_meta($post->ID, 'res2', true);
    $rr3 = get_post_meta($post->ID, 'res3', true);
    $rr4 = get_post_meta($post->ID, 'res4', true);
    $rr5 = get_post_meta($post->ID, 'res5', true);

    if($rr1 || $rr2 || $rr3 || $rr4 || $rr5)
    {
        ?>
    <section 
        class="result-section"
        <?php
            $image = get_field('bot_bak');
            if( !empty($image) ){
                echo 'style="background-image: url('.$image['url'].')"';
            }else{
                echo 'style="background-image: url('.get_template_directory_uri.'/images/hand.jpg)"';
            }
        ?>
        style="background-image: url()"

    >
        <div class="container text-center">
            <h2>РЕЗУЛЬТАТ</h2>

            <div class="result-circles">

                <?php
                $rr = $rr1;
                if(!empty($rr)){
                    echo '
                        <div class="circle"><span>'. get_post_meta($post->ID, 'res1', true) .' '. get_post_meta($post->ID, 'res1_title', true) .'</span></div>';
                }
                $rr = $rr2;
                if(!empty($rr)){
                    echo '
                        <div class="circle"><span>'. get_post_meta($post->ID, 'res2', true) .' '. get_post_meta($post->ID, 'res2_title', true) .'</span></div>';
                }
                $rr = $rr3;
                if(!empty($rr)){
                    echo '
                        <div class="circle"><span>'. get_post_meta($post->ID, 'res3', true) .' '. get_post_meta($post->ID, 'res3_title', true) .'</span></div>';
                }
                $rr = $rr4;
                if(!empty($rr)){
                    echo '
                        <div class="circle"><span>'. get_post_meta($post->ID, 'res4', true) .' '. get_post_meta($post->ID, 'res4_title', true) .'</span></div>';
                }
                $rr = $rr5;
                if(!empty($rr)){
                    echo '
                        <div class="circle"><span>'. get_post_meta($post->ID, 'res5', true) .' '. get_post_meta($post->ID, 'res5_title', true) .'</span></div>';
                }
                ?>
            </div>
        </div>
    </section>
        <?}?>

<?php endwhile; ?>

        <?php
        // if(array_key_exists('asdf', $_GET))
        include(locate_template('moreprojects.php'));
        // else
        //    include(locate_template('project_arrows.php'));
        ?>

<script type="text/javascript">
$(function() {
     $('#emailForm').submit( function() {
         yaCounter934261.reachGoal('callback_portfolio_project');
         yaCounter934261.reachGoal('all_callbacks');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });

     $('#callForm').submit( function() {
         yaCounter934261.reachGoal('contact_form_portfolio');
         yaCounter934261.reachGoal('all_project_price_check');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });
});
</script>

<?php get_footer(); ?>