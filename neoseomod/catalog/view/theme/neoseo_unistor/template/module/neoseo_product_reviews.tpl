<div class="module">
<h3><?php echo $header_title; ?></h3>
<div id="neoseo_product_reviews<?php echo $module; ?>" class="row">
    <?php foreach ($reviews as $review) { ?>
    <div class="product-layout text-center col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="product-reviews-container box-shadow box-corner">
            <h6><a href="<?php echo $review['href']; ?>"><?php echo $review['name']; ?></a></h6>
        <a href="<?php echo $review['href']; ?>"><img class="img-responsive" src="<?php echo $review['image']; ?>" alt="<?php echo $review['name']; ?>"/></a>
            <?php if ($review['rating']) { ?>
            <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($review['rating'] < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } ?>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="autor">
                <h5><b><?php echo $review['author']; ?></b></h5>
                <p><?php echo $review['text']; ?></p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
</div>