// EC Integration JS - for step2 - View productpage
!function($, root) {
	if (!root.EC) return false;
	var pathBase = 'view/2.0/';
	var EC = root.EC;
	// extend the EC View methods
	$.extend(EC.View, {
		/*
		 * create the ProductApiParam for gets the Product-information from API
		 * @param $productRoot Root node for information collection
		 */
		createPriceApiIds: function($productRoot) {
			return $.makeArray($('#ec-api-id, .specs-colors .ec-api-id', $productRoot).map(function() {
				var apiId = $(this).text();
				if (apiId) {
					return new EC.Model.ProductApiParam(apiId, $(this).data('ec-vari-num'));
				}
			}));
		}
	});

	// initialize EC settings information
	EC.init(function() {
		// update EC.settings
		$.extend(EC.settings, {
			view_name: 'productpage',
		});
		// load the required javascripts
		EC.Utils.addJs('view/ec-buymenu-common-libs');
		EC.Utils.addJs(pathBase + 'ec-common-libs');
	});

	// start the EC processing
	EC.ready(function() {
		var $productRoot = $('#page');
		// gets the sallable & price from api
		EC.Api.getProductPrice(EC.View.createPriceApiIds($productRoot)).always(function(productInfo) {
			// populate to the ProductInfo from Authoring Product data
			populateAuthProductSettings(productInfo, $productRoot);

			if (EC.View.isNeedToRenderBuyButton(productInfo, $productRoot)) {
				// render the buy button by result
				var $buyButton = renderBuyButton(productInfo, $productRoot);
				// fire the buy button rendering events
				EC.View.trigger('renderBuyButton', productInfo, $productRoot, $buyButton);
			}

			if (EC.View.isNeedToRenderProductPrice(productInfo)) {
				// render the product price by result
				renderProductPrice(productInfo);
				// fire the product price rendering events
				EC.View.trigger('renderProductPrice', productInfo, $productRoot);
			}
		});
	});

	/*
	 * render the buy button.
	 * @param productInfo ProductInfo
	 * @return buy button(jQuery object)
	 */
	function renderBuyButton(productInfo, $productRoot) {
		var $buyButton = $('<a href="javascript:void(0);" class="btn-blue"><span>' + EC.settings['buy_button_label'] + '</span></a>');
		EC.View.setBuyButtonAttrs(productInfo, $productRoot, $buyButton);
		if (productInfo.hasSellableProduct()) {
			if (EC.Api.isUsableBasket() || productInfo.buy_from_panasonic_link.isEnabled()) {
				$buyButton.addClass('cart-direct');
			}
		}
		if (!_.isEmpty($buyButton.attr('href'))) {
			var $browsebarBuy = $('#browsebar-buy');
			if ($browsebarBuy.size() <= 0) {
				$browsebarBuy = $('<div class="btn mobilefix" id="browsebar-buy"></div>').prependTo('#browsebar-utils');
			}
			$browsebarBuy.append($buyButton);
			if ($buyButton.attr('href').match(/javascript*|#/)) {
				$buyButton.on('click',function(e){
					e.preventDefault();
				});
			}
		}
		return $buyButton;
	}

	/*
	 * render the product price.
	 * @param productInfo ProductInfo
	 */
	function renderProductPrice(productInfo) {
		EC.View.formatPriceInformation(productInfo, function(isSellable, productPriceTitle, productPrice, productPriceAnnotation) {
			var $browsebarUtils = $('#browsebar-utils');
			if (isSellable && !!productPriceAnnotation) {
				var $priceAnnotation = $('.extra-txt', $browsebarUtils);
				if ( $priceAnnotation.size() <= 0) {
					$priceAnnotation = $('<div class="extra-txt"></div>').insertAfter($('.price', $browsebarUtils));
				}
				// Write <Product Price Annotation>
				$priceAnnotation.text(productPriceAnnotation);
			}
			// Write <Product Price Title>
			$('.price', $browsebarUtils).find('.prefix').text(productPriceTitle);
			// Write <Product Price>
			$('.price', $browsebarUtils).find('.price-nu').html(EC.Utils.formatPrice(productPrice));
		});
	}

	// populate to the ProductInfo from Authoring Product data
	function populateAuthProductSettings(productInfo, $productRoot) {
		productInfo.product_price_annotation = $('#ec-product-price-annotation', $productRoot).text();
		productInfo.product_price_title = $('#ec-product-price-title-author', $productRoot).text();
		productInfo.product_price = $('#ec-product-price', $productRoot).text();
		productInfo.hide_product_price = ($('#ec-hide-product-price', $productRoot).text() == 'true');
		productInfo.buy_from_panasonic_link = new EC.Model.LinkItem($('#ec-buy-from-panasonic-link', $productRoot).text(), EC.Utils.parseBoolean('#ec-buy-from-panasonic-link-open-new-win', $productRoot));
		productInfo.where_to_buy_link = new EC.Model.LinkItem($('#ec-where-to-buy-link', $productRoot).text(), EC.Utils.parseBoolean('#ec-where-to-buy-link-open-new-win', $productRoot));
	}

// Root will be 'window' in browser or 'global' on the server:
}(jQuery, this);
