<? 
/*
Template name: Awards
*/
get_header(); the_post(); ?>
		<!--<div class="moto-widget chess3 moto-widget-block moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" style="background-color:;background-image:url(/wp-content/uploads/2017/06/mt-1007-header-bg2.jpg);background-position:center;background-repeat:no-repeat;background-size:cover;" data-bg-image="2017/06/mt-1007-header-bg.jpg" data-spacing="aaaa" data-widget="block" data-draggable-disabled="">
			<div class="container-fluid">
				<div class="row">
					<div class="moto-cell col-sm-12" data-container="container">
						<div data-widget-id="wid__spacer__5b0293cd3c911" class="moto-widget moto-widget-spacer moto-preset-default moto-spacing-top-medium moto-spacing-right-auto moto-spacing-bottom-large moto-spacing-left-auto " data-widget="spacer" data-preset="default" data-spacing="mala" data-visible-on="mobile-v">
		    				<div class="moto-widget-spacer-block" style="height:40px"></div>
						</div>
						<div class="moto-widget moto-widget-row row-fixed moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" data-grid-type="xs" data-widget="row" data-spacing="aaaa" data-draggable-disabled="">
							<div class="container-fluid">
								<div class="row" data-container="container">
									<div class="moto-widget moto-widget-row__column moto-cell col-xs-7" data-widget="row.column" data-bgcolor-class="" data-container="container"></div>
									<div class="moto-widget moto-widget-row__column moto-cell col-xs-5" data-widget="row.column" data-bgcolor-class="" data-container="container">
										<div class="moto-widget moto-widget-text moto-preset-default moto-spacing-top-auto moto-spacing-right-large moto-spacing-bottom-auto moto-spacing-left-auto" data-widget="text" data-preset="default" data-spacing="alaa" data-animation="">
		    								<div class="moto-widget-text-content moto-widget-text-editable"><p class="moto-text_system_1" style="color: #fff;"><b><? the_title(); ?></b></p></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div data-widget-id="wid__spacer__5b0293cd42f6a" class="moto-widget moto-widget-spacer moto-preset-default moto-spacing-top-medium moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto " data-widget="spacer" data-preset="default" data-spacing="maaa" data-visible-on="mobile-v">
		    				<div class="moto-widget-spacer-block" style="height:30px"></div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<div class="chess moto-widget moto-widget-block moto-bg-color5_3 moto-spacing-top-large moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" data-widget="block" data-spacing="laaa" style="padding-top: 200px;">
	    	<div class="container-fluid">
	        	<div class="row">
	            	<div class="moto-cell col-sm-12" data-container="container">
	            		<div class="moto-widget moto-widget-row row-fixed moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" data-grid-type="sm" data-widget="row" data-spacing="aaaa">
	    					<div class="container-fluid">
	        					<div class="row" data-container="container">
	            					<div class="moto-widget moto-widget-row__column moto-cell col-sm-12" data-widget="row.column" data-bgcolor-class="" data-container="container">
									<? $awards = get_field('awards', 2); ?>
									<? foreach ($awards as $award) { ?>
	                                	<h2 style="text-align: center;" class="moto-text_system_7"><? echo $award['title']; ?></h2>
	                                    <p class="moto-text_system_9" style="text-align: center;"><? echo $award['where']; ?></p>
	                                    <p class="moto-text_system_10" style="text-align: center;"><? echo $award['date']; ?></p>
	                                    <p class="moto-text_system_9" style="text-align: center;"><? echo $award['category']; ?></p>
	                                    <p class="moto-text_system_8" style="text-align: center;"><? echo $award['result']; ?></p>
	                                    <p class="moto-text_system_8" style="text-align: center;"><? echo $award['place']; ?></p>
	                               	 	<div data-widget-id="wid__divider_horizontal__5ad82710b3481" class="moto-widget moto-widget-divider moto-preset-default moto-align-center moto-spacing-top-small moto-spacing-right-auto moto-spacing-bottom-medium moto-spacing-left-auto  " data-widget="divider_horizontal" data-preset="default">
    										<hr class="moto-widget-divider-line" style="max-width:100%;width:7%;">
										</div>
									<? } ?>
	    							</div>
								</div>
	    					</div>
						</div>
					</div>
	        	</div>
	    	</div>
		</div>
	</section>
</div>
	<? get_footer(); ?>