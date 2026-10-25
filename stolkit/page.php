<?
get_header(); ?>
<? the_post(); ?>
<div class="es1_rassr_bg">
        <div class="container">     
           <div class="row">
            <div class="col-sm-12">
                 <h1 class="text-center b-rassr__zag"><? the_title(); ?></h1>
              </div>
              <div class="col-sm-12">
                 <? the_content(); ?>
              </div>
           </div>

         </div>
         
     </div>  
     <style>
        .es1_rassr_bg img { width: 95%; margin-right: 2%; margin-left: 2%; height: auto !important; }
        .b-rassr__zag {
             text-align: center;
             font-size: 4.9em;
             font-family: 'ALSSchlangesans-Black';
             text-transform: uppercase;
             margin-bottom: 50px;
             color: #000;
         }
     </style>     
<? get_template_part('templates/common/calculator'); ?>
<? get_template_part('templates/common/timer'); ?>
<? get_template_part('templates/common/textures'); ?>
<? get_template_part('templates/common/claim'); ?>
<? get_template_part('templates/common/reviews'); ?>
<? get_template_part('templates/common/portfolio'); ?>
<? get_template_part('templates/common/free_consultation'); ?>
<? get_template_part('templates/common/contacts'); ?>
<? get_footer(); ?>