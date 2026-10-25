<?php if (!empty($heading_title_raw)) { ?>
<div class="title">
	<div class="title-inner">
		<i class="icon-newspaper-folded"></i><span class="title-text"><?php echo $heading_title_raw; ?></span>
		<div class="customNavigation" style=" width:80px"></div>
	</div>
</div>
<?php } ?>
<div class="row article-block arbful" style="margin-bottom:25px;">
	<?php foreach ($articles as $article) { ?>
	<div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="news">

			<div class="image">
				<a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive"/></a>
			</div>

			<div class="caption">

				<h4><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></h4>

				<div class="entry-meta">
									<span class="entry-date published">
									<i class="fa fa-calendar"></i> 15.01.2017
									</span>
									</span><span class="entry-views">
									<i class="fa fa-eye"></i> Просмотров: 65
									<a href="https://demo.neoseo.com.ua/sovety-expertov-po-vyboru-laminata#comments"></a>
									</span>
									<span class="entry-author">
									<i class="fa fa-user"></i>
									<a href="https://demo.neoseo.com.ua/index.php?route=blog/neoseo_blog_author&amp;author_id=1">neoseo</a>
									</span><span class="entry-comments-link">
									<i class="fa fa-comment-o"></i> Комментариев: 5
									<a href="https://demo.neoseo.com.ua/sovety-expertov-po-vyboru-laminata#comments"></a>
									</span><span class="entry-category-link"><i class="fa fa-folder-open-o"></i>
									<a href="https://demo.neoseo.com.ua/o-laminate" rel="category tag">Итак.. О ламинате!</a>
									</span>
				</div>

				<p><?php echo $article['description']; ?></p>

			</div>
		</div>
	</div>
	<?php } ?>
</div>
