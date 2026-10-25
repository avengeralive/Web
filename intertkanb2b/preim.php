<?
/*
Template name: Преимущества участия
*/
?>
<? get_header(); ?>
		<? the_post(); ?>
        <!-- Breadcrumb Area -->
        <div class="cr-breadcrumb-area" style="background-image: url(<? echo get_field('обложка', get_the_ID()); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <div class="container">
                <div class="cr-breadcrumb text-center">
                    <h1><? the_title(); ?></h1>
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><? the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--// Breadcrumb Area -->

        <!-- Page Content -->
        <main id="page-content">
			
			<!-- Contact Page -->
			<section class="cr-section about-area bg-white section-padding-md">
                <div class="container">
                    <div class="about-text text-center row">
                        <? the_content(); ?>
                    </div>
                </div>
            </section>
			<!--// Contact Page -->

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>