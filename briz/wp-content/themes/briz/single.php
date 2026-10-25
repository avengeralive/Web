<? get_header(); the_post(); 
$next = explode('"', explode('href="', get_next_post_link())[1])[0];
$prev = explode('"', explode('href="', get_previous_post_link())[1])[0];
?>
<main class="main main_style2">
    <div class="projects">
      	<div class="container">
        	<div class="projects__container">
          		<div class="projects__section projects__section_top">
            		<div class="projects__head projects__left">
              			<h2 class="title title_style2 projects__title">
                			<svg class="icon"><use xlink:href="img/icons/icons-sprite.svg#ico2"></use></svg><? the_title(); ?>
                		</h2>
                		<span class="projects__subtitle"><? echo get_field('slogan', get_the_ID()); ?></span>
            		</div>
            		<div class="projects__text projects__right">
             	 		<? the_content(); ?>
            		</div>
          		</div>
          		<div class="projects__section projects__section_bottom">
            		<div class="projects__controls projects__left">
              			<ul class="projects__numbers-list">
                      <? $singles = get_posts(array('post_type' => 'post', 'numberposts' => -1, 'order' => 'ASC')); 
                      foreach ($singles as $key => $single) if ($single->ID == get_the_ID()) break;
                      ?>
                			<li class="projects__numbers-item"><a class="projects__numbers-link projects__numbers-link_active" href="<? echo get_the_permalink($singles[$key]->ID); ?>">0<? echo $key + 1; ?></a></li>
                			<li class="projects__numbers-item"><a class="projects__numbers-link" href="<? if ($key != count($singles) - 1) { echo get_the_permalink($singles[$key + 1]->ID); } else { echo get_the_permalink($singles[0]->ID); } ?>"><? if ($key != count($singles) - 1)  echo '0'.($key + 2);  else { ?>01<? } ?></a></li>
              			</ul>
              			<ul class="projects__controls-list">
                			<li class="projects__controls-item">
                				<a class="projects__controls-link" href="<? if ($singles[count($singles)-1]->ID == get_the_ID()) echo get_the_permalink($singles[0]->ID); else echo $next; ?>">
                    				<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico13"></use></svg>
                    			</a>
                    		</li>
                			<li class="projects__controls-item">
                				<a class="projects__controls-link projects__controls-link_prev" href="<? if ($singles[0]->ID == get_the_ID()) echo get_the_permalink($singles[count($singles)-1]); else echo $prev; ?>">
                    				<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico13"></use></svg>
                    			</a>
                    		</li>
             		 	</ul>
            		</div>
            		<ul class="projects__tabs-list projects__right">
                  <?
                  foreach ($singles as $key => $single) {
                  ?>
              			<li class="projects__tabs-item"><a class="projects__tabs-link <? if ($single->ID == get_the_ID()) { ?>projects__tabs-link_active<? } ?>" href="<? echo get_the_permalink($single->ID); ?>"><? echo $single->post_title; ?></a></li>
                  <? } ?>
            		</ul>
          		</div>
        	</div>
      	</div>
    </div>
    <? $blocks = get_field('blocks', get_the_ID()); 
    foreach ($blocks as $block) echo $block['block']; ?>
</main>
<? get_footer(); ?>