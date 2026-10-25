<?php echo $header; ?>
<div class="container">
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <?php require_once(dirname(__FILE__) . '/../common/breadcrumbs.tpl'); ?>
    <div class="row">
        <?php echo $column_left; ?>
    <div id="content" class="<?php echo $class; ?>" itemscope itemtype="http://schema.org/Product"><?php echo $content_top; ?>
        <h1 class="product-title"  itemprop="name"><?php echo $heading_title; ?></h1>
        <div class="product-top box-shadow box-corner clearfix">
            <?php if ($column_left || $column_right) { ?>
            <?php $class = 'col-lg-9 product-pic'; ?>
            <?php } else { ?>
            <?php $class = 'col-lg-9 product-pic'; ?>
            <?php } ?>
            <div class="<?php echo $class; ?>">

                <?php if ($column_left || $column_right) { ?>
                <?php $class = 'col-sm-6'; ?>
                <?php $class1 = 'col-sm-6'; ?>
                <?php } else { ?>
                <?php $class = 'product-list '; ?>
                <?php $class1 = 'col-sm-6'; ?>
                <?php } ?>

                <!-- product-img-block -->
                <div class="<?php echo $class; ?> col-xs-12 col-sm-12 col-md-7 product-img-block">
                    <div class="product-model-block">
                        <?php if($model) { ?>
                        <p class="text-left model-block" itemprop="model"><strong><?php echo $text_model; ?></strong> <span class=""><?php echo $model; ?></span></p>
                        <?php } ?>

                        
                    
                    </div>

                    <?php if ( isset($images_360) && $images_360) { ?>
                    <?php echo $images_360; ?>
                    <?php } ?>
                    <?php if ($thumb || $images) { ?>
                    <ul class="thumbnails<?php if (!$images) echo ' no-img' ?>">
                        <?php if ($thumb) { ?>
                        <li class="big_image" <?php if ( isset($images_360) && $images_360) { ?>style="display: none;"<?php } ?>>
                        <div class="big_image-slide-nav">
                            <div class="slide-nav_prev">
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <div class="slide-nav_next">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </div>
                            <a class="thumbnail thin-0" href="<?php echo $popup; ?>">
                            <img src="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"/>
                        </a>
                        </li>
                        <?php } ?>
                    
                        <?php if ($thumb || $images) { $imgcnt=0; ?>
                        <li id='zgalery'>
                            <ul class="more-image">
                                <?php if ( isset($images_360) && $images_360) { ?>
                                <li class="image-additional">
                                    <a class="thumbnail active thumb_360">
                                        <img id='img-add-org-360' src="/image/360.png" alt="<?php echo $heading_title; ?>"/>
                                    </a>
                                </li>
                                <?php } ?>

                                <li class="image-additional">
                                    <a class="thumbnail <?php if ( !isset($images_360) || !$images_360) { ?>active<?php } ?>" href="<?php echo $thumb; ?>" data-image="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>">
                                        <img id='img-add-org' src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>"/>
                                    </a>
                                </li>

                                <?php foreach ($images as $image) { $imgcnt++; ?>
                                <li class="image-additional">
                                    <a class="thumbnail" href="<?php echo $image['mouseover_thumb']; ?>" data-image="<?php echo $image['popup']; ?>" data-zoom-image="<?php echo $image['popup']; ?>">
                                        <img id='img-add-<?php echo $imgcnt; ?>' src="<?php echo $image['thumb']; ?>" data-zoom-image="<?php echo $popup; ?>" alt="<?php echo $heading_title; ?>"/>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                <script>
                    $('.more-image').readmore({
                        maxHeight: 90,
                        moreLink: '<a class="moreLink" href="#"><span><?php echo $text_see_all; ?><i class="fa fa-caret-down"></i></span></a>',
                        lessLink: '<a class="moreLink" style=" background: none;" href="#"><span><?php echo $text_collapse_all; ?><i class="fa fa-caret-up"></i></span></a>'
                    });

                </script>
                

                </div>
                <!-- product-img-block end -->


                <!-- product-info-block -->
                <div class="<?php echo $class; ?> col-xs-12 col-sm-12 col-md-5 product-info-block">

                    <div class="product-list_top">

                        <?php if ($special && $date_special ) { ?>
                        <div class="product-info-block_action">
                            <?php echo $text_product_action; ?>
                        </div>
                        <script src="catalog/view/theme/neoseo_unistor/javascript/flipclock.min.js"></script>
                        <div id="first_countdown" ></div>
                        <script>
                            var clock = $('#first_countdown').FlipClock(<?php echo $date_special; ?>, {
                                clockFace: 'DailyCounter',
                                countdown: true,
                                langauge: 'ru'
                            });
                        </script>

                        <?php } ?>

                        <?php if ($price) { ?>
                        <meta itemprop="price" content="<?php echo rtrim(preg_replace("/[^0-9\.]/", "", ($special ? $special : $price)), '.'); ?>" />
                        <meta itemprop="priceCurrency" content="<?php echo $md_currency; ?>" />
                        <link itemprop="availability" href="http://schema.org/<?php echo ($md_availability ?'InStock':'OutOfStock') ?>" />


                        <!-- stock-status-block -->
                        <div class="status-block stock-status-block-<?php echo $stock_status_id; ?>" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <div class="col-xs-8 col-sm-8 price-block clearfix" style="margin-bottom: 1em;">
                                <div class="clearfix" style="font-size: 2em;">
                                    <div class="price-block_price"><?php echo $text_price; ?></div>
                                </div>
                                <?php if (!$special) { ?>
                                <div class="price-area product-price" style=""><?php echo $price; ?></div>
                                <?php } else { ?>
                                <div class="text-danger price-area"><?php echo $price; ?></div>
                                <div class="product-price" ><?php echo $special; ?></div>
                                <?php } ?>

                                <?php if (!$special) { ?>
                                <div class="stock-status-text-<?php echo $stock_status_id; ?> status-text" style="color:<?php echo $stock_status_color ?>;"><?php echo $stock_status; ?></div>
                                <?php } else { ?>
                                <div class="stock-status-text-<?php echo $stock_status_id; ?> status-text" style=" color:<?php echo $stock_status_color ?>;"><?php echo $stock_status; ?></div>
                                <?php } ?>
                            </div>

                            <div class="col-xs-4 rating-wrap">
                                <!-- rating -->
                                <?php if ($review_status) { ?>
                                    <?php if ($short_reviews_status) { ?>
                                <div class="rating text-left" <?php if($rating) { ?> itemprop = "aggregateRating" itemscope itemtype = "http://schema.org/AggregateRating" <?php } ?> >
                                    <p>
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($rating < $i) { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <?php } else { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <?php } ?>
                                    <?php } ?>
                                </p>
                                </div>
                                    <?php } ?>
                                <?php } ?>
                                <!-- rating end -->
                                
                                <?php if ($short_reviews_status) { ?>
                                <a href="javascript:void(0)" id='show_comments' ><i class="fa fa-commenting" aria-hidden="true"></i><?php echo $reviews; ?></a>
                                <?php } ?>
                            </div>
                            
                        </div>
                        <?php } ?>

                    </div>

                    <div class="product-list_middle">
                                <div class="middle-options-box">
                                    <!-- begin if -->
                                    <!-- product begin -->
                                    <div id="product" class="product-options-block">
                                    <?php if ($options) { ?>
                                    <script src="catalog/view/theme/neoseo_unistor/javascript/jquery.formstyler.js"></script>
                                    <script>
                                        (function($) {
                                            $(function() {
                                                $('.product-options-block select').styler({
                                                    selectSearch: true
                                                });
                                            });
                                        })(jQuery);
                                    </script>

                                        <div class="options-container  options-block">
                                            <?php foreach ($options as $option) { ?>
                                            <?php if ($option['type'] == 'select') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                                <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                                                    <option value=""><?php echo $text_select; ?></option>
                                                    <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                                    <option value="<?php echo $option_value['product_option_value_id']; ?>" data-price="<?php echo trim(preg_replace('/[^\d\.]/i', '', $option_value['price']),"."); ?>" data-prefix="<?php echo $option_value['price_prefix']; ?>"><?php echo $option_value['name']; ?>
                                                        <?php if ($option_value['price']) { ?>
                                                        (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                        <?php } ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'radio') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label"><?php echo $option['name']; ?></label>
                                                <a class="table-size_link" href="#"><?php echo $text_table_size; ?></a>
                                                <div id="input-option<?php echo $option['product_option_id']; ?>">
                                                    <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                                    <div class="radio radio-square">
                                                        <?php $r=rand(1,1000); ?>
                                                        <label for='r-<?php echo $option['product_option_id'].$r; ?>'>
                                                        <input type="radio" id='r-<?php echo $option['product_option_id'].$r; ?>' name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" data-price="<?php echo trim(preg_replace('/[^\d\.]/i', '', $option_value['price']),"."); ?>" data-prefix="<?php echo $option_value['price_prefix']; ?>" />
                                                        <div class="square"><?php echo $option_value['name']; ?></div>
                                                        </label>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'checkbox') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label"><?php echo $option['name']; ?></label>
                                                <div id="input-option<?php echo $option['product_option_id']; ?>">
                                                    <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                                    <div class="checkbox checkbox-primary">
                                                        <?php $r=rand(1,1000); ?>
                                                        <input class="checkbox" type="checkbox" id='ch-<?php echo $r; ?>' name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" data-price="<?php echo trim(preg_replace('/[^\d\.]/i', '', $option_value['price']),"."); ?>" data-prefix="<?php echo $option_value['price_prefix']; ?>" />
                                                        <label for='ch-<?php echo $r; ?>'>
                                                            <?php echo $option_value['name']; ?> <?php if ($option_value['price']) { ?> ( <?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?> ) <?php } ?>
                                                        </label>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'image') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label"><?php echo $option['name']; ?></label>
                                                <div id="input-option<?php echo $option['product_option_id']; ?>">
                                                    <?php if (count($option['product_option_value']) >= 5 ) { ?>
                                                    <div class="product-carousel-box">
                                                        <div id="carousel-radio-wrapper" class="radio-wrapper">
                                                            <div class="radio-image-wrapper">
                                                                <?php } ?>
                                                                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                                                <div class="<?php if (count($option['product_option_value']) >= 5 ) { ?>radio-carousel-image <?php } else { ?>radio-product-image <?php } ?>">
                                                                    <?php $r=rand(1,1000); ?>
                                                                    <label for='r-<?php echo $option['product_option_id'].$r; ?>'>
                                                                    <input type="radio" id='r-<?php echo $option['product_option_id'].$r; ?>' name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" data-price="<?php echo trim(preg_replace('/[^\d\.]/i', '', $option_value['price']),"."); ?>" data-prefix="<?php echo $option_value['price_prefix']; ?>"/>
                                                                    <span class="radio-image-box"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>"/></span>
                                                                    <!-- <span class="color-name"><?php echo $option_value['name']; ?></span> -->
                                                                    </label>
                                                                </div>
                                                                <?php } ?>
                                                                <?php if (count($option['product_option_value']) >= 5 ) { ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'text') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" data-price="<?php echo trim(preg_replace('/[^\d\.]/i', '', $option_value['price']),"."); ?>" data-prefix="<?php echo $option_value['price_prefix']; ?>" />
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'textarea') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                                <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" data-price="<?php echo trim(preg_replace('/[^\d\.]/i', '', $option_value['price']),"."); ?>" data-prefix="<?php echo $option_value['price_prefix']; ?>"><?php echo $option['value']; ?></textarea>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'file') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label"><?php echo $option['name']; ?></label>
                                                <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block">
                                                    <i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                                                <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>"/>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'date') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                                <div class="input-group date">
                                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"/>
                                                    <span class="input-group-btn">
                                 <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                 </span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'datetime') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                                <div class="input-group datetime">
                                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"/>
                                                    <span class="input-group-btn">
                                 <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                 </span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if ($option['type'] == 'time') { ?>
                                            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                                <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                                <div class="input-group time">
                                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"/>
                                                    <span class="input-group-btn">
                                 <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                 </span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                        </div>

                                    <!-- options-block end -->
                                    <?php } ?>
                                    </div>
                                </div>

                    </div>
                    <div class="product-list_bottom">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <div class="bot-prod clearfix">
                            <?php if( $product_to_email ) { ?>
                            <a href="javascript:void(0);" class="wis-com-post" onclick="showProductToEmail('<?php echo $product_id; ?>')"><i class="icon-new-email-interface-symbol-of-black-closed-envelope"></i><span>Отправить на почту</span></a>
                            <?php } ?>
                            <?php if(isset($neoseo_notify_price_change_status) && $neoseo_notify_price_change_status){ ?>
                            <a data-toggle="tooltip" class="wis-com-post" onclick="compare.add('<?php echo $product_id; ?>');"><i class="fa fa-bar-chart"></i><?php echo $text_follow_price; ?></a>
                            <?php } ?>
                            <a data-toggle="tooltip" class="wis-com-post" onclick="wishlist.add('<?php echo $product_id; ?>');"><i class="fa fa-heart-o"></i><?php echo $button_wishlist; ?></a>
                            <a data-toggle="tooltip" class="wis-com-post" onclick="compare.add('<?php echo $product_id; ?>');"><i class="fa fa-clone"></i><?php echo $button_compare; ?></a>
                        </div>
                        <div class="col-sm-6 col-md-12 button-pcs-box">
                            
                            <div class="pcs-box">
                                <div class="input-group" data-min-quantity="<?php echo $minimum; ?>">
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-type="minus" data-field="input-quantity">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                  </span>
                                    <input type="text" name="quantity" value="<?php echo $minimum; ?>" id="input-quantity" size="2" class="form-control quantity">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-type="plus" data-field="input-quantity">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </div>
                            </div>
                            <button type="button" id="button-cart" class="button-cart btn btn-primary">
                                <i class="fa fa-shopping-cart"></i>
                                <span><?php echo $button_cart; ?></span>
                            </button>
                        </div>

                    </div>
                    <div class="share-and-stock-box">
                        <?php echo $sharing_code; ?>
                    </div>
                    <div class="product-list_manufacturer">

                            <?php if ($manufacturer) { ?>
                        <div class="manufacturer-item">
                            <div class="manufacturer_left">
                                <b><?php echo $text_manufacturer; ?></b>
                            </div>
                            <div class="manufacturer_right">
                                <a href="<?php echo $manufacturers; ?>" itemprop="manufacturer"><?php echo $manufacturer; ?></a>
                            </div>
                        </div>
                            <?php } ?>
                            <?php if ($attribute_groups) { ?>

                            <?php foreach ($attribute_groups as $attribute_group) { ?>
                            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                            <?php if(in_array($attribute['attribute_id'],$attributes_title)) { ?>
                        <div class="manufacturer-item">
                            <div class="manufacturer_left">
                                <b><?php echo $attribute['name']; ?></b>
                            </div>
                            <div class="manufacturer_right">
                                <span><?php echo $attribute['text']; ?></span>
                            </div>
                        </div>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>

                            <?php if ($dimension) { ?>
                        <div class="manufacturer-item">
                            <div class="manufacturer_left">
                                <b><?php echo $text_dimension; ?></b>
                            </div>
                            <div class="manufacturer_right">
                                <span><?php echo $dimension; ?></span>
                            </div>
                        </div>
                            <?php } ?>

                            <?php if ($reward) { ?>
                        <div class="manufacturer-item">
                            <div class="manufacturer_left">
                                <b><?php echo $text_reward; ?></b>
                            </div>
                            <div class="manufacturer_right">
                                <span><?php echo $reward; ?></span>
                            </div>
                        </div>
                            <?php } ?>

                            <?php if ($tax) { ?>
                        <div class="manufacturer-item">
                            <div class="manufacturer_left">
                                <b><?php echo $text_tax; ?></b>
                            </div>
                            <div class="manufacturer_right">
                                <span><?php echo $tax; ?></span>
                            </div>
                        </div>
                            <?php } ?>

                            <?php if ($points) { ?>
                        <div class="manufacturer-item">
                            <div class="manufacturer_left">
                                <b><?php echo $text_points; ?></b>
                            </div>
                            <div class="manufacturer_right">
                                <span><?php echo $points; ?></span>
                            </div>
                        </div>
                            <?php } ?>
                        </div>
                    <?php if ($attribute_groups) { ?>
                    <a href="#characteristics" class="see-all-characteristics">
                        <?php echo $text_all_characteristics; ?>
                    </a>
                    <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="product-delivery-block hidden-lg">
                        <div class="product-delivery_left">
                            <?php if( trim(strip_tags($shipping_info) ) ) { ?>
                            <div class="panel panel-default">
                                <div class="panel-body shipping_info">
                                    <div class="shipping_info-title">
                                        <i class="fa fa-truck"></i>
                                        <span><?php echo $text_shipping; ?></span>
                                    </div>
                                    <?php echo $shipping_info; ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="product-delivery_right">
                            <?php if( trim(strip_tags($payment_info) ) ) { ?>
                            <div class="panel panel-default">
                                <div class="panel-body payment_info">
                                    <div class="payment_info-title">
                                        <i class="fa fa-credit-card"></i>
                                        <span><?php echo $text_payment; ?></span>
                                    </div>
                                    <?php echo $payment_info; ?>
                                </div>
                            </div>
                            <?php } ?>

                            
                        </div>

                        <div class="product-delivery_right">
                            <?php if( trim(strip_tags($guarantee_info) ) ) { ?>
                            <div class="panel panel-default">
                                <div class="panel-body guarantee_info">
                                    <div class="guarantee_info-title">
                                        <i class="fa fa-file-o"></i>
                                        <span><?php echo $text_guarantee; ?></span>
                                    </div>
                                    <?php echo $guarantee_info; ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div> 

            </div>


            <!-- delivery begin -->

            <?php if ($column_left || $column_right) { ?>
            <?php $class = 'col-lg-3 product-deliv'; ?>
            <?php } else { ?>
            <?php $class = 'col-lg-3 product-deliv'; ?>
            <?php } ?>    

            <div class="<?php echo $class; ?>">
                <div class="product-delivery-block hidden-xs hidden-sm hidden-md">
                    <div class="">
                        <?php if( trim(strip_tags($shipping_info) ) ) { ?>
                        <div class="panel panel-default">
                            <div class="panel-body shipping_info">
                                <div class="shipping_info-title">
                                    <i class="fa fa-truck"></i>
                                    <span><?php echo $text_shipping; ?></span>
                                </div>
                                <?php echo $shipping_info; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="">
                        <?php if( trim(strip_tags($payment_info) ) ) { ?>
                        <div class="panel panel-default">
                            <div class="panel-body payment_info">
                                <div class="payment_info-title">
                                    <i class="fa fa-credit-card"></i>
                                    <span><?php echo $text_payment; ?></span>
                                </div>
                                <?php echo $payment_info; ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( trim(strip_tags($guarantee_info) ) ) { ?>
                        <div class="panel panel-default">
                            <div class="panel-body guarantee_info">
                                <div class="guarantee_info-title">
                                    <i class="fa fa-file-o"></i>
                                    <span><?php echo $text_guarantee; ?></span>
                                </div>
                                <?php echo $guarantee_info; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div> 
            <!-- delivery end-->
        </div>
        <div class="product-middle box-shadow box-corner">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-description" data-toggle="tab"><span><?php echo $tab_description; ?></span></a></li>

                <?php if ($review_status) { ?>
                <li><a href="#tab-review" data-toggle="tab"><span><?php echo $tab_review; ?></span></a></li>
                <?php } ?>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-description" itemprop="description">
                    <div class="row">
                        <div class="tab-description_left col-md-7">
                            <article class="product-description">
                                <?php echo $description; ?>
                            </article>

                            <script>
                                $('article').readmore({
                                    maxHeight: 130,
                                    moreLink: '<a class="moreLink" href="#"><span><?php echo $text_more; ?></span></a>',
                                    lessLink: '<a class="moreLink" style=" background: none;" href="#"><span><?php echo $text_collapse_all; ?></span></a>'
                                });
                            </script>

                            <?php if ($attribute_groups) { ?>
                            <div class="characteristics-title"><?php echo $text_characteristics_title; ?></div>
                            <table id="characteristics" itemprop="propertiesList" itemscope itemtype="http://schema.org/ItemList" class="table table-bordered">
                                <?php foreach ($attribute_groups as $attribute_group) { ?>

                                <thead>
                                <tr>
                                    <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                <tr itemprop="itemListElement" itemscope itemtype="http://schema.org/NameValueStructure">
                                    <td itemprop="name"><?php echo $attribute['name']; ?></td>
                                    <td itemprop="value"><?php echo $attribute['text']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                <?php } ?>
                            </table>
                            <?php } ?>
                        </div>

                        <div class="tab-description_right col-md-5">
                            <div class="tab-description_right-top">
                                <?php if ($review_status) { ?>
                                <div class="top_total-comments"><span><?php echo $text_all_reviews; ?></span></div>
                                <?php if ($review_guest) { ?>
                                <div class="top_write-comment">
                                    <button href="#tab-review" data-toggle="tab"  type="button" id="button-review2" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary">
                                        <?php echo $text_give_feedback; ?>
                                    </button>
                                </div>
                                <?php } else { ?>
                                <span class="col-xs-6">
                          <?php echo $text_login; ?>
                    </span>
                                <?php } ?>
                            </div>
                            <form class="form-horizontal" id="form-review-2">
                                <div class="review-box"><?php echo $short_reviews;?> </div>
                            </form>
                            <?php } ?>
                            <?php if ($short_reviews_status) { ?>
                            <a href="#tab-review" data-toggle="tab" class="see-all-reviews">
                                <?php echo $text_see_all_reviews; ?>
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                            <?php } ?>
                        </div>
                    </div>


                </div>


                <?php if ($review_status) { ?>
                <div class="tab-pane" id="tab-review">
                    <form class="form-horizontal" id="form-review">
                        <div class="tab-review-container">
                            <div class="tab-review_left col-md-8">
                                <div id="review"><?php echo $static_reviews;?> </div>
                            </div>
                            <div class="tab-review_right col-md-4">
                                <h4><?php echo $text_write; ?></h4>
                                <?php if ($review_guest) { ?>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                                        <input type="text" name="name" value="" id="input-name" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                                        <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                        <?php if(0) { ?>
                                        <div class="help-block"><?php echo $text_note; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="reviews-nav">
                                    <div class="rating-fl">
                                        <div class="star-rating">
                                            <span class="fa fa-star-o" data-rating="1"></span>
                                            <span class="fa fa-star-o" data-rating="2"></span>
                                            <span class="fa fa-star-o" data-rating="3"></span>
                                            <span class="fa fa-star-o" data-rating="4"></span>
                                            <span class="fa fa-star-o" data-rating="5"></span>
                                            <input type="hidden" name="rating" class="rating-value" value="3">
                                        </div>
                                    </div>
                                    <?php echo $captcha; ?>
                                    <div class="reviews-button">
                                        <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_write; ?></button>
                                    </div>
                                    <?php } else { ?>
                                    <?php echo $text_login; ?>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php if ($products) { ?>
        <div class="module">
            <h3><?php echo $text_related; ?></h3>
            <div class="row">
                <?php $i = 0; ?>
                <?php foreach ($products as $product) { ?>
                <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div itemscore="" class="product-thumb box-shadow box-corner clearfix">
                        <div class="product-thumb_top">
                            <div class="image">
                                <a href="<?php echo $product['href']; ?>">
                                    <?php if ($product['thumb']) { ?>
                                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="hoverable img-responsive" itemprop="image" data-over="<?php echo $product['thumb1']; ?>" data-out="<?php echo $product['thumb']; ?>" />
                                    <?php } else { ?>
                                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" itemprop="image" class="img-responsive" />
                                    <?php } ?>
                                </a>
                            </div>
                            <meta itemprop="url" content="<?php echo $product['href']; ?>" >
                        </div>
                        <div class="product-thumb_middle">
                            <div class="rating-container">
                                <div class="caption">
                                    <h4 itemprop="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                                </div>
                                <span class="rating"  <?php if($product['rating']){ ?> itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"<?php }?> >
                                <?php if($product['rating']){ ?>
                                <meta itemprop="reviewCount" content="<?php echo $product['md_review_count']; ?>">
                                <meta itemprop="ratingValue" content="<?php echo $product['rating']; ?>">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <?php if ($product['rating'] < $i) { ?>
                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                <?php } else { ?>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                <?php }?>
                                <?php } ?>
                                <?php } ?>
                                </span>
                            </div>
                            <div class="caption">
                                <h4 itemprop="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                                <?php if (isset($product['additional_attributes']) && $product['additional_attributes']) { ?>
                                <div class="attributes-top">
                                    <?php $counter = 1; ?>
                                    <?php foreach ($product['additional_attributes'] as $key => $attribute) { ?>
                                    <span><b><?php echo $attribute['name']; ?></b> <?php echo $attribute['text']; ?></span><?php if ($counter < $product['total_attributes']) { echo $divider ? $divider : ''; } ?>
                                    <?php $counter++;
									} ?>
                                </div>
                                <?php } ?>
                            </div>
                            <?php if ($product['price']) { ?>
                            <div class="price-and-cart-add">
                                <div class="price-wrapper">
                                    <p class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <meta itemprop="price" content="<?php echo rtrim(preg_replace("/[^0-9\.]/", "", ($product['special'] ? $product['special'] : $product['price'])), '.'); ?>" />
                                        <meta itemprop="priceCurrency" content="<?php echo $md_currency ?>"/>
                                        <link itemprop="availability" href="http://schema.org/<?php echo ($product['md_availability'] ?'InStock' : 'OutOfStock') ?>" />
                                        <?php if (!$product['special']) { ?>
                                        <?php echo $product['price']; ?>
                                        <?php } else { ?>
                                        <span class="price-old"><?php echo $product['price']; ?></span><span class="price-new"><?php echo $product['special']; ?></span>
                                        <?php } ?>
                                        <?php if ($product['tax']) { ?>
                                        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                                        <?php } ?>
                                    </p>
                                </div>
                                <?php } ?>
                                <div class="input-group input-quantity-group" data-min-quantity="<?php echo $product['minimum']; ?>">
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-type="minus" data-field="input-quantity">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                  </span>
                                    <input type="text" name="quantity" value="<?php echo $product['minimum']; ?>" size="2" class="form-control quantity">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-type="plus" data-field="input-quantity">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </div>

                                <div class="button-group-cart">
                                    <span class="text-right stock-status-text-<?php echo $product['stock_status_id']; ?>" style="color:<?php echo $product['stock_status_color'] ?>;"><?php echo $product['stock_status']; ?></span>
                                    <button class="cart-add-button" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"><?php echo $button_cart; ?></span></button>
                                </div>
                            </div>
                        </div>

                        <div class="description" itemprop="description">
                            <div class="description-top">
                                <?php echo $product['short_description']; ?>
                            </div>
                            <div class="description-bottom">
                                <div class="button-group">
                                    <a class="wishlist-button" onclick="wishlist.add('<?php echo $product['product_id']; ?>');">
                                        <i class="fa fa-heart"></i>
                                        <span><?php echo $text_wishlist; ?></span>
                                    </a>
                                    <a class="compare-button"  onclick="compare.add('<?php echo $product['product_id']; ?>');">
                                        <i class="fa fa-exchange"></i>
                                        <span><?php echo $text_compare; ?></span>
                                    </a>
                                    <?php if( $neoseo_quick_order_status ) { ?>
                                    <a type="button" class="buy-one-click" onclick="showQuickOrder('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');">
                                        <i class="ns-mouse" aria-hidden="true"></i>
                                        <span><?php echo $text_one_click_buy; ?></span>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php if ($tags) { ?>
        <p><?php echo $text_tags; ?>
            <?php for ($i = 0; $i < count($tags); $i++) { ?>
            <?php if ($i < (count($tags) - 1)) { ?>
            <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
            <?php } else { ?>
            <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
            <?php } ?>
            <?php } ?>
        </p>
    </div>
    <?php } ?>
    <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
</div>

<?php //echo $column_right; ?></div>
</div>
<script >
    $(document).ready(function() {
       $('.flip-clock-divider.days .flip-clock-label').text('Дней'); 
       $('.flip-clock-divider.hours .flip-clock-label').text('Часов'); 
       $('.flip-clock-divider.minutes .flip-clock-label').text('Минут'); 
       $('.flip-clock-divider.seconds .flip-clock-label').text('Секунд'); 

    });
    var $star_rating = $('.star-rating .fa');

    var SetRatingStar = function() {
        return $star_rating.each(function() {
            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                return $(this).removeClass('fa-star-o ').addClass('fa-star');
            } else {
                return $(this).removeClass('fa-star').addClass('fa-star-o');
            }
        });
    };

    $star_rating.hover(function() {
        $star_rating.siblings('input.rating-value').val($(this).data('rating'));
        return SetRatingStar();
    });

    SetRatingStar();
</script>

<script>
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function () {
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType: 'json',
            beforeSend: function () {
                $('#recurring-description').html('');
            },
            success: function (json) {
                $('.alert, .text-danger').remove();

                if (json['success']) {
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });

    $('.input-group-btn button').on('click', function () {
        var field = $(this).attr('data-field');
        if( !field )
            return;

        var type = $(this).attr('data-type');
        if( !type )
            return;

        var value = Number($("#"+field).val());
        var v = $("#"+field).attr('value');
        if( type == "minus") {
            value -= 1;
        } else {
            value += 1;
        }
        if( value < v ) {
            value = v;
            setInvalid($("#"+field));
        }
        $("#"+field).val(value);
    });

    // input-quantity
    $('#input-quantity').keydown(function(e) {
        if(e.which == 38){ // plus
            var value = Number($(this).val());
            value++;
            if(value > 100) value = 100;
            $(this).val(value);
        }
        if(e.which == 40){ // minus
            var value = Number($(this).val());
            var v = $(this).attr('value');
            value--;
            if(value < v) { value = v; setInvalid($(this)) }
            $(this).val(value);
        }
    });

    function setInvalid(o){
        o.addClass('invalid');
        setTimeout(function(){
            o.removeClass('invalid');
        },100);
    }

    $('#button-cart').on('click', function () {
        console.log($('#product input[type=\'text\'], .product-list_bottom input[type=\'text\'] ,#product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'));
        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: $('#product input[type=\'text\'], .product-list_bottom input[type=\'text\'] , .product-list_bottom input[type=\'hidden\'] ,#product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
            dataType: 'json',
            success: function (json) {
                $('.alert, .text-danger').remove();
                $('.form-group').removeClass('has-error');

                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            var element = $('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')) {
                                element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            } else {
                                element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            }
                        }
                    }

                    if (json['error']['recurring']) {
                        $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                    }

                    // Highlight any found errors
                    $('.text-danger').parent().addClass('has-error');
                }

                if (json['success']) {
                    $('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('.cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

                    $('html, body').animate({scrollTop: 0}, 'slow');

                    $('.cart > ul').load('index.php?route=common/cart/info ul li');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('.date').datetimepicker({
        pickTime: false
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });

    $('.time').datetimepicker({
        pickDate: false
    });

    $('button[id^=\'button-upload\']').on('click', function () {
        var node = this;

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function () {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: 'index.php?route=tool/upload',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $(node).button('loading');
                    },
                    complete: function () {
                        $(node).button('reset');
                    },
                    success: function (json) {
                        $('.text-danger').remove();

                        if (json['error']) {
                            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                        }

                        if (json['success']) {
                            alert(json['success']);

                            $(node).parent().find('input').attr('value', json['code']);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });

    $('#button-review').on('click', function () {
        $.ajax({
            url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
            type: 'post',
            dataType: 'json',
            data: $("#form-review").serialize(),
            beforeSend: function () {
                $('#button-review').button('loading');
            },
            complete: function () {
                $('#button-review').button('reset');
            },
            success: function (json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    $('.reviews-nav').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $('.reviews-nav').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
            }
        });
    });

    $(document).ready(function () {

        $('.thumbnails .thumbnail').magnificPopup({
            items: [
                <?php if ($thumb) { ?>{src: '<?php echo $popup; ?>'},<?php } ?>
                <?php if ($images) { ?><?php foreach ($images as $image) { ?>{src: '<?php echo $image['popup']; ?>'},<?php } ?><?php } ?>
            ],
            gallery: { enabled: true },
            type: 'image',

<?php if ($images) { ?>

            callbacks: {
                open: function() {
                    var activeIndex = parseInt($('#zgalery .image-additional a.active').parent('.image-additional').index());
                    var magnificPopup = $.magnificPopup.instance;

                <?php if( isset($images_360) && $images_360 ) { ?>

                        if( activeIndex > 0 ) {
                            magnificPopup.goTo(activeIndex - 1);
                        } else {
                            magnificPopup.goTo(0);
                        }

                    <?php } else { ?>

                        magnificPopup.goTo(activeIndex);

                    <?php } ?>

                }

            }

        <?php } ?>
        });

    });
</script>

<script src="catalog/view/theme/neoseo_unistor/javascript/elevateZoom.min.js"></script>

<script>
    // ZYSH
    function initZoom(){
        if( $(document).width() < 751 ) return;
        // Zoom Big Thumb
        $(".thin-0 img").elevateZoom({
            <?php if ($zoom == 1) { ?> zoomType: "inner",
            <?php }  else { ?>
            scrollZoom: true,
            gallery:'zgalery',
            galleryActiveClass:'active',
            tint: true, tintColour:'#f90', tintOpacity:0.2, // Mask
            easing: false,
            //lensShape : "round",
            lensSize: 100,
            imageCrossfade: false,
            <?php } ?>
            cursor: "crosshair",
            zoomWindowWidth:400,
            zoomWindowHeight:400,
            zoomWindowFadeIn:300,
            zoomWindowFadeOut:200
        });
        // disable LightBox
        /*$(".thin-0__ img").bind("click", function(e) {
         var ez = $('.thin-0 img').data('elevateZoom');
         $.fancybox(ez.getGalleryList());
         return true;
         });*/
        // set width to main Img
        var iw = $('.thumbnails li:first img').width();
        $('.thumbnails li:first img:first').css('width',iw+'px');
    }
    <?php if ($zoom) { ?>
    $(document).ready(function () {
        setTimeout(function(){
            initZoom();
        },1500);
    });

    // Zoom Win Resize fixes
    $(window).resize(function(e) {
        if( $(document).width() < 754 ) { $('.zoomContainer').remove(); }
    });
    <?php } ?>
        /// - - - -
    $('.image-additional a').mouseenter(function(e) {
        if($(this).hasClass('active'))
            return;
        if($(this).hasClass('thumb_360')) {
            $('.threesixty-block').show();
            $('.thumbnails .big_image').hide();
        } else {
            $('.big_image img').prop('style','');
            $('.thumbnails .big_image').show();
            $('.threesixty-block').hide();
        }
        $('.image-additional a.active').removeClass('active');
        var sr = $(this).attr('data-zoom-image');
        var hr = $(this).attr('href');
        $('.thumbnails li:first img:first').attr('src',hr).attr('data-zoom-image',sr);
        $('.thumbnails li:first a').attr('href',sr);
        $(this).addClass('active');
        console.log(sr,hr);
        $('.zoomContainer .zoomLens img').attr('src',sr);
        $('.zoomContainer .zoomWindowContainer > div:first').css('background-image','url('+sr+')');
    });
    //
    // STARs
    $('.z_stars span').mouseenter(function(e) {
        var n = $(this).index();
        $(this).siblings('span').each(function(index, element) {
            if( $(this).index() < n ) $(this).addClass('active');
            else $(this).removeClass('active');
        });
    });
    $('.z_stars span').mouseleave(function(e) {
        var n = $(this).index();
        var p = $(this).parent('.z_stars');
        var s = p.data('value');
        if( s ) {
            if( n == s - 1 ) { $(this).addClass('active');}
            else {
                p.find('span').each(function(index, element) {
                    if( $(this).index() < s ) $(this).addClass('active');
                    else $(this).removeClass('active');
                });
            }
        } else {
            $(this).siblings('span').each(function(index, element) {
                $(this).removeClass('active');
            });
        }
    });
    $('.z_stars span').click(function(e) {
        var i = $(this).index();
        $(this).parent('.z_stars').data('value', i + 1);
        $(this).parent('.z_stars').find('input.inp-rating').val(i+1);
        $(this).addClass('active');
        $('input[name="rating"]').val($('#zs_rate span.active').length);
    });
    $('.z_stars').mouseleave(function(e) {
        var s = $(this).data('value');
        if(s){
            $(this).find('span').each(function(index, element) {
                if( $(this).index() < s ) $(this).addClass('active');
            });
        }
    });
    $('.z_stars').data('value',3);
    $('.z_stars .inp-rating').val(3);
    $('.z_stars span:lt(3)').addClass('active');
</script>

<script>
	$(document).ready(function() {
		$('#product select, #product input').bind('change', function (e) {
			onChangeOption();
		});
	});

    $(function () {

        $('.see-all-characteristics').click(function(e){
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $( $(this).attr('href') ).offset().top - 50
            }, 1200);
            return false;
        });

        $('.see-all-reviews, #button-review2').click(function (e) {

            e.preventDefault();
            $('.nav-tabs > li').removeClass('active');
            $('.nav-tabs > li:last-child').addClass('active');

        });

        var mainContainer = $('.more-image');
        var mainContainerWidth = $(mainContainer).width();
        var widthChild = 0;
        $(mainContainer).children().each(function () {
            widthChild+=$(this).width();
        });
        if (widthChild > mainContainerWidth) {
            $('.big_image-slide-nav').css('display','flex');
        }

        $('.slide-nav_next').click(function () {
            var lenghtItem = $('.image-additional').length;
            var activeImage = $('.image-additional').find('.active');
            var indexImage = $(activeImage).parent().index();
            if (indexImage != lenghtItem - 1) {
                var activeImageNext = $(activeImage).parent().next().children().addClass('active');
                $(activeImage).removeClass('active');
                var imageSrc = $(activeImageNext).attr('href');
                var imageData = $(activeImageNext).attr('data-zoom-image');
                var imageShow = $('.big_image').find('img').attr('src', imageSrc).attr('data-zoom-image',imageData);
            } else if (indexImage == lenghtItem - 1) {
                $(activeImage).removeClass('active');
                var firstImage = $('.image-additional').eq(0).children().addClass('active');
                var imageSrc = $(firstImage).attr('href');
                var imageData = $(firstImage).attr('data-zoom-image');
                var imageShow = $('.big_image').find('img').attr('src', imageSrc).attr('data-zoom-image',imageData);
            }
        });

        $('.slide-nav_prev').click(function () {
            var activeImage = $('.image-additional').find('.active');
            var indexImage = $(activeImage).parent().index();
            if (indexImage != 0) {
                var activeImageNext = $(activeImage).parent().prev().children().addClass('active');
                $(activeImage).removeClass('active');
                var imageSrc = $(activeImageNext).attr('href');
                var imageData = $(activeImageNext).attr('data-zoom-image');
                var imageShow = $('.big_image').find('img').attr('src', imageSrc).attr('data-zoom-image',imageData);
            } else if (indexImage == 0) {
                $(activeImage).removeClass('active');
                var lastImage = $('.image-additional').eq(-1).children().addClass('active');
                var imageSrc = $(lastImage).attr('href');
                var imageData = $(lastImage).attr('data-zoom-image');
                var imageShow = $('.big_image').find('img').attr('src', imageSrc).attr('data-zoom-image',imageData);
            }


        });

    });

</script>
<?php echo $footer; ?>