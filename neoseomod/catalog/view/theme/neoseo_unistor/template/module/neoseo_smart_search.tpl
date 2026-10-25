<div id="search_header">
    <div id="search_close">&times;</div>
</div>

<div id="search_content">
    <?php foreach ($products as $product) { ?>
        <div class="search-item clearfix">
            <a class="name" href="<?php echo $product['href']; ?>">
                <?php if (isset($product['image'])) { ?>
                	<img src="<?php echo $product['image']; ?>"/>
                <?php } ?>
                <div class="search-column">
                    <?php if (isset($product['rating'])) { ?>
                    	<span class="rating-<?php echo $product['rating']; ?>"></span>
                    <?php } ?>

                    <span class="product-title"><?php echo $product['name']; ?></span>

                    <?php if (isset($product['model'])) { ?>
                    	<span class="model"><?php echo $result['model']; ?></span>
                    <?php } ?>

                    <?php if (isset($product['sku'])) { ?>
                    	<span class="sku"><?php echo $product['sku']; ?></span>
                    <?php } ?>

                    <?php if (isset($product['description'])) { ?>
                    	<span class="description"><?php echo $product['description']; ?></span>
                    <?php } ?>

                    <?php if (isset($product['price'])) { ?>
                        <?php if (!$product['special']) { ?>
                            <span class="price"><?php echo $product['price']; ?></span>
                        <?php } else { ?>
                            <span class="price-old"><?php echo $product['price']; ?></span>
                            <span class="price"><?php echo $product['special']; ?></span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </a>

    </div>
    <?php } ?>
    <div id="search_footer">
        <a href="#" onclick="searchgoto(); return false;" id='goto_search'><?php echo $text_look_results; ?></a>
    </div>
</div>


<script>
	$('body, #search_close').on('click', () => {
		$('#search_main').hide();
	});

    var searchgoto = () => {
		let url = $('base').attr('href') + 'index.php?route=product/search';

        if (value = $('<?php echo $selector; ?>').val()) {
            url += '&search=' + encodeURIComponent(value);

            if (filter_category = $('.category-list-title').data('categoryid')) {
                url += '&category_id=' + filter_category + '&sub_category=true';
            }
        }

        location = url;
    };
</script>