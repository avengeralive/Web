<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	</ul>
	<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="blog-content <?php echo $class; ?>"><?php echo $content_top; ?>

			<h1><?php echo $heading_title; ?></h1>

			<div class="entry-meta">
				<?php if($date_modified) { ?> 
				<span class="entry-date published">
					<i class="fa fa-calendar"></i>
					<?php echo $date_modified;?>
				</span>
				<?php } ?>
				<?php if($author) { ?> 
				<span class="entry-author">
					<i class="fa fa-user"></i>
					<a href="<?php echo $author['href'];?>"><?php echo $author['name'];?></a>
				</span>
				<?php } ?>
				<?php if($viewed) { ?> 
				<span class="entry-views">
					<i class="fa fa-eye"></i>
					<?php echo $viewed;?>
				</span>
				<?php } ?>
				<?php if($total_comments) { ?>
				<span class="entry-comments-link">
				<i class="fa fa-comment-o"></i>
					<?php echo $total_comments;?>
				</span>
				<?php } ?>
			</div>


			<div class="clearfix">
				<div class="aticle-body">
					<div class="article-description">
						<?php echo $description; ?>
					</div>

					<?php if (isset($images)) { ?>
					<?php if (!empty($gallery_heading)) { ?>
					<h3><?php echo $gallery_heading; ?></h3>
					<?php } ?>
					<div class="popup-gallery">
						<?php foreach ($images as $img) { ?>
						<a href="<?php echo $img['image']; ?>"><img src="<?php echo $img['thumb']; ?>" alt="" class="img-thumbnail"></a>
						<?php } ?>
					</div>
					<?php } ?>					
				</div>

				<?php if (!empty($comments_block)) { ?>
				<?php echo $comments_block; ?>
				<?php } ?>

				<?php if (!empty($related_articles)) { ?>
				<div id="related_articles" class="blog-content">
					<h3><?php echo $text_related_articles; ?></h3>
					<div class="row article-block ab-info">
						<?php foreach ($related_articles as $article) { ?>
						<div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="product-thumb">

								<div class="image">
									<a href="<?php echo $article['href']; ?>">
										<img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive" />
									</a>
								</div>

								<div class="caption">

									<h4><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></h4>

									<div class="entry-meta">
										<?php if($article['date_modified']) { ?> 
										<span class="entry-date published">
											<i class="fa fa-calendar"></i>
											<?php echo $article['date_modified'];?>
										</span>
										<?php } ?>
										<?php if($article['author']) { ?> 
										<span class="entry-author">
											<i class="fa fa-user"></i>
											<a href="<?php echo $article['author']['href'];?>"><?php echo $article['author']['name'];?></a>
										</span>
										<?php } ?>
										<?php if($article['viewed']) { ?> 
										<span class="entry-views">
											<i class="fa fa-eye"></i>
											<?php echo $article['viewed'];?>
										</span>
										<?php } ?>
										<?php if($article['total_comments']) { ?>
										<span class="entry-comments-link">
										<i class="fa fa-comment-o"></i>
											<?php echo $article['total_comments'];?>
										</span>
										<?php } ?>
									</div>

							<p><?php echo $article['description']; ?></p>

						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>

		<?php if (!empty($related_products)) { ?>
		<h3><?php echo $text_related_products; ?></h3>
		<div class="row product-block">
			<?php foreach ($related_products as $product) { ?>
			<div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="product-thumb transition">
					<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
					<div class="caption">
						<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>

						<?php if ($product['rating']) { ?>
						<div class="rating">
							<?php for ($i = 1; $i <= 5; $i++) { ?>
							<?php if ($product['rating'] < $i) { ?>
							<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
							<?php } else { ?>
							<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
							<?php } ?>
							<?php } ?>
						</div>
						<?php } ?>
						<?php if ($product['price']) { ?>
						<p class="price">
							<?php if (!$product['special']) { ?>
							<?php echo $product['price']; ?>
							<?php } else { ?>
							<span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
							<?php } ?>
							<?php if ($product['tax']) { ?>
							<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
							<?php } ?>
						</p>
						<?php } ?>
					</div>
					<div class="button-group">
						<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
						<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
						<button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
					</div>
					<div class="description"><?php echo $product['description']; ?></div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>

	</div>
	<?php echo $content_bottom; ?>
</div>
<?php echo $column_right; ?>
</div>
</div>
	<script type="text/javascript"><!--
$(document).ready(function() {
		$('.article-image a').magnificPopup({
		type:'image',
			callbacks: {
			resize: changeImgSize,
				imageLoadComplete:changeImgSize,
				change:changeImgSize
			}
		});
		$('.popup-gallery').magnificPopup({
		delegate: 'a',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
			enabled: true,
				navigateByImgClick: true
			},
			image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
			},
			callbacks: {
			resize: changeImgSize,
				imageLoadComplete:changeImgSize,
				change:changeImgSize
			}
		});
		});
		function changeImgSize(){
		var img = this.content.find('img');
		img.css('max-height', window.innerHeight);
		img.css('width', 'auto');
		img.css('max-width', 'auto');
		}
//--></script>
<?php echo $footer; ?>