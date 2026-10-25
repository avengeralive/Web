<? get_header(); ?>
<div id="content-wrapper" class="is-vc">

<article class="page-single page type-page status-publish hentry">
<div class="post-content">
<div  class="vc_row wpb_row vc_row-fluid vc_custom_1480690325180 wpb_section wpb_padding">
	<div class="container">
		<div class="row">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="vc_row wpb_row vc_inner vc_row-fluid">
							<div class="wpb_column vc_column_container vc_col-sm-12">
								<div class="vc_column-inner ">
									<div class="wpb_wrapper">
										<div class="wdc-heading style-1 text-center">
											<h3 class="box-title">Наши услуги</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="vc_row wpb_row vc_inner vc_row-fluid">
							<? $args = array( 'posts_per_page' => 999, 'post_type' => 'services', 'order' => 'ASC');
							$posts_array = get_posts( $args );
							foreach ($posts_array as $key=>$post)
							{
								$sign = get_field('иконка', $post->ID);
							?>
							<div class="wpb_column vc_column_container vc_col-sm-2 vc_col-xs-2">
								<div class="vc_column-inner vc_custom_1480689687153">
									<div class="wpb_wrapper">
										<div class="wdc-iconbox style-3">
											<div class="iconbox-container">
												<div class="box-icon" >
													<span><i class="<? echo $sign; ?>"></i></span>
												</div>
												<div class="box-content">
													<h4 class="box-title"><? echo $post->post_title; ?></h4>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div  class="vc_row wpb_row vc_row-fluid vc_custom_1477547929095 wpb_section wpb_padding">
	<div class="container">
		<div class="row">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1471340985552 vc_row-has-fill">
							<div class="wpb_column vc_column_container vc_col-sm-6">
								<div class="vc_column-inner vc_custom_1480936918536">
									<div class="wpb_wrapper">
										<div class="wdc-heading style-1 text-left">
											<h3 class="box-title">О нас</h3>
											<div class="box-content">Ostrya is an established New York based company, specialised in Computer Repairs and Services, We repair out of warranty laptops and Computer.</div>
										</div>
										<div class="vc_empty_space"   style="height: 15px" ><span class="vc_empty_space_inner"></span></div>
<a class="wdc-button style-1 size-medium" href="http://iwebdc.com/demo/ostrya/services/services-style-1/" target=""><span>View Services</span></a></div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner vc_custom_1471344135554"><div class="wpb_wrapper">
	<div  class="wpb_single_image wpb_content_element vc_align_left  vc_custom_1479135358445">
		
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1024" height="683" src="http://iwebdc.com/demo/ostrya/wp-content/uploads/2016/11/service-02.jpg" class="vc_single_image-img attachment-full" alt="" srcset="http://iwebdc.com/demo/ostrya/wp-content/uploads/2016/11/service-02.jpg 1024w, http://iwebdc.com/demo/ostrya/wp-content/uploads/2016/11/service-02-300x200.jpg 300w, http://iwebdc.com/demo/ostrya/wp-content/uploads/2016/11/service-02-768x512.jpg 768w, http://iwebdc.com/demo/ostrya/wp-content/uploads/2016/11/service-02-600x400.jpg 600w" sizes="(max-width: 1024px) 100vw, 1024px" /></div>
		</figure>
	</div>
</div></div></div></div></div></div></div></div></div></div>


<div  style="color:#ffffff;" class="vc_row wpb_row vc_row-fluid vc_custom_1480935847669 vc_row-has-fill wpb_section wpb_padding wpb_color"><div class="container"><div class="row"><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="wdc-counter style-icon icon-top"><div class="box-icon"><span><i class="fa fa-smile-o"></i></span></div><div class="box-inner"><div class="counter-number" data-to="2750">0</div><h4 class="box-title">Happy Customers</h4></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="wdc-counter style-icon icon-top"><div class="box-icon"><span><i class="fa fa-laptop"></i></span></div><div class="box-inner"><div class="counter-number" data-to="1250">0</div><h4 class="box-title">Laptop Repaired</h4></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="wdc-counter style-icon icon-top"><div class="box-icon"><span><i class="fa fa-desktop"></i></span></div><div class="box-inner"><div class="counter-number" data-to="950">0</div><h4 class="box-title">Computer Repaired</h4></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="wdc-counter style-icon icon-top"><div class="box-icon"><span><i class="fa fa-windows"></i></span></div><div class="box-inner"><div class="counter-number" data-to="450">0</div><h4 class="box-title">OS Installed</h4></div></div></div></div></div></div></div></div>

<div  class="vc_row wpb_row vc_row-fluid vc_custom_1471198040046 wpb_section wpb_padding">
	<div class="container">
		<div class="row">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="wdc-heading style-1 text-left">
							<h3 class="box-title">Последние статьи</h3>
						</div>
						<div class="wdc-blog">    
							<div class="row">
							<? $args = array( 'posts_per_page' => 3, 'post_type' => 'post', 'order' => 'ASC');
							$posts_array = get_posts( $args );
							foreach ($posts_array as $key=>$post)
							{
								$image = get_the_post_thumbnail_url($post->ID);
							?>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="blog-container">
										<div class="post-thumb">
											<a href="<? echo $image; ?>" title="<? echo $post->post_title; ?>">
												<img width="600" height="400" src="<? echo $image; ?>" class="attachment-ostrya-small size-ostrya-small wp-post-image" alt="" srcset="<? echo $image; ?> 600w, <? echo $image; ?> 300w, <? echo $image; ?> 768w, <? echo $image; ?> 1024w, <? echo $image; ?>" sizes="(max-width: 600px) 100vw, 600px" />
											</a>
										</div>
										<div class="blog-inner">
											<h4 class="post-title"><a href="<? echo $post->giud; ?>" title="<? echo $post->post_title; ?>"><? echo $post->post_title; ?></a></h4>
		                    			</div>
										<div class="post-excerpt">
											<p><? echo $post->post_excerpt; ?></p>
										</div>
									</div>
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
<div  class="vc_row wpb_row vc_row-fluid vc_custom_1480755966064 vc_row-has-fill vc_row-o-equal-height vc_row-o-content-middle vc_row-flex wpb_section wpb_padding">
	<div class="container">
		<div class="row">
			<div class="wpb_column vc_column_container vc_col-sm-8">
				<div class="vc_column-inner vc_custom_1480762080763">
					<div class="wpb_wrapper">
						<h3 style="font-size: 32px;color: #ffffff;text-align: center" class="vc_custom_heading" >Multi Brand</h3>
						<h3 style="font-size: 48px;color: #ffffff;text-align: center" class="vc_custom_heading vc_custom_1480676524074" >Repair &amp; Services</h3>
						<div class="wpb_text_column wpb_content_element " >
							<div class="wpb_wrapper">
								<p style="text-align: left;"><span style="color: #ffffff;">Life without our Pc’s, laptops &amp; printers is just unimaginable! So if these are ailing with hardware or software issues and you are wondering who will fix my PC instantly Our certified experts will resolve them all. From computer repair services, laptop repair services to printer repair services Our expert shall detect all concerns and accomplish everything from software installation to motherboard repair.</span></p>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wpb_column vc_column_container vc_col-sm-4 vc_col-has-fill">
				<div class="vc_column-inner vc_custom_1480677095808">
					<div class="wpb_wrapper">
						<h3 style="font-size: 18px;color: #ffffff;text-align: center;font-family:Roboto;font-weight:500;font-style:normal" class="vc_custom_heading vc_custom_1480672250665" >Get a FREE Quote</h3>
						<div role="form" class="wpcf7" id="wpcf7-f6-p173-o1" lang="en-US" dir="ltr">
							<div class="screen-reader-response"></div>
							<? echo do_shortcode('[contact-form-7 id="4" title="Контактная форма 1"]'); ?>

</div></div></div></div></div></div></div>
<div class="clearfix"></div>	</div>

</article>
<!-- end post entry -->		   
			

</div>
<? get_footer(); ?>