<?php
/* Template name: Форма */
acf_form_head();
get_header(); ?>

<div id="page">
	<? 
	acf_form(array(
	'post_id'		=> 'new_post',
	'new_post'		=> array(
		'post_type' => 'participant',
		'post_status'	=> 'draft' 
	),					
	'post_title' 		 => false, 
	'post_content' 		 => false,
	'submit_value'		 => 'Отправить',
	'updated_message'    => 'Сохранено'
));
		?>

	
</div>
<style>.acf-hl li:nth-child(5) { display: none; }</style>


<?php get_footer(); ?>