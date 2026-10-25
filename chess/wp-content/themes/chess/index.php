<? get_header(); ?>
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
		    								<div class="moto-widget-text-content moto-widget-text-editable"><p class="moto-text_system_1" style="color: #fff;"><b>Новости</b></p></div>
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
                		<div class="moto-widget moto-widget-row row-fixed" data-widget="row">
    						<div class="container-fluid">
        						<div class="row" data-container="container">
            						<div class="moto-cell col-sm-12 moto-widget moto-widget-row__column" data-container="container" data-widget="row.column">
                						<div data-widget-id="wid__blog_post_list__5c9e26e213163" class="moto-widget moto-widget-blog-post_list moto-preset-default moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-auto moto-spacing-left-auto" data-widget="blog.post_list">
                							<ul class="moto-blog-posts-list">
                							<? while (have_posts()) : the_post(); ?>
                            					<li class="moto-blog-posts-list-item">
                    								<article>
                        								<div class="moto-widget moto-widget-row" data-widget="row">
								                            <div class="container-fluid">
								                                <div class="row">
								                                    <div class="moto-cell col-sm-12" data-container="container">
								                                        <div class="moto-widget moto-widget-text moto-preset-default moto-spacing-top-small moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto moto-align-left" data-preset="default" data-widget="text">
								                                            <div class="moto-widget-text-content moto-widget-text-editable">
								                                                <h2 class="moto-text_system_7">
								                                                    <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
								                                                </h2>
								                                            </div>
								                                        </div>
								                                        <div class="moto-widget moto-widget-row" data-widget="row">
								                                            <div class="container-fluid">
								                                                <div class="row">
								                                                    <div class="moto-cell col-sm-12" data-container="container">
                                                        								<div data-widget-id="wid__blog_post_published_on__5c9e26e214d18" class="moto-widget moto-widget-blog-post_published_on moto-preset-default moto-align-left moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto " data-preset="default" data-widget="blog.post_published_on" data-spacing="aasa">
    																						<div class="moto-text_system_11">
        																						<span class="fa fa-calendar moto-widget-blog-post_published_on-icon"></span>
        																						<span class="moto-widget-blog-post_published_on-date"><? the_date(); ?>7</span>
    																						</div>
																						</div>
                                                    								</div>
								                                                </div>
								                                            </div>
								                                        </div>
                                                                        <div data-widget-id="wid__image__5c9e26e214f95" class="moto-widget moto-widget-image moto-preset-default  moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto  " data-widget="image">
                        													<a class="moto-widget-image-link moto-link" href="<? the_permalink(); ?>" data-action="blog.post">
                																<img data-src="<? echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" class="moto-widget-image-picture newslayer lazyloaded" data-id="" title="" alt="" src="<? echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
            																</a>
           	 															</div>
                                                                        <div class="moto-blog-post-content moto-widget-text moto-preset-default moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto">
                                                                            <p class="moto-text_system_10"><? the_excerpt(); ?></p>
                                                                        </div>
                                        								<div data-widget-id="wid__button__5c9e26e215bfd" class="moto-widget moto-widget-button moto-preset-default moto-align-left moto-spacing-top-auto moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto " data-widget="button">
            																<a href="<? the_permalink(); ?>" data-action="blog.post" class="moto-widget-button-link moto-size-medium moto-link">
            																	<span class="fa moto-widget-theme-icon"></span> 
            																	<span class="moto-widget-button-label">Читать далее</span>
            																</a>
    																	</div>
								                                        <div class="moto-widget moto-widget-divider moto-preset-2 moto-spacing-top-small moto-spacing-right-auto moto-spacing-bottom-small moto-spacing-left-auto moto-align-center" data-widget="divider_horizontal" data-divider-type="horizontal" data-preset="2">
								                                            <hr class="moto-widget-divider-line">
								                                        </div>
								                                    </div>
								                                </div>
								                            </div>
								                        </div>
								                    </article>
                								</li>
                							<? endwhile; ?>
                    						</ul>
                            			</div>
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