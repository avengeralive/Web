<? get_header(); ?>
<? while (have_posts()) { the_post(); ?>
<? for ($i = 1; $i <= 7; $i++) { 
if (get_field('постер_'.$i, get_the_ID()) != '') {
?>
<div class="image" style="<? if ($i == 1) echo 'padding-top: 100px;'; ?>"id="s<? echo $i; ?>"><img src="<? echo get_field('постер_'.$i, get_the_ID()); ?>" alt="project" style="width:100%"/></div>
<? } ?>
<? if (get_field('заголовок_'.$i, get_the_ID()) != '') { ?>
<div class="image txt" style="text-align: center; font-family: Muller; color: <? echo get_field('цвет_'.$i, get_the_ID()); ?>; background: <? echo get_field('фон_'.$i, get_the_ID()); ?>">
	<h2><? echo get_field('заголовок_'.$i, get_the_ID()); ?></h2>
	<? echo get_field('описание_'.$i, get_the_ID()); ?>
</div>
<? } } ?>

 <? } get_footer(); ?>