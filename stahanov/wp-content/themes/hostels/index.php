<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

      <?php the_content('Read more...'); ?>

<?php endwhile; ?>
<?php else : ?>
     <p>Извините, ничего не найдено.</p>
<?php endif; ?>

<?php get_footer(); ?>