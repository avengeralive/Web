// EC Integration JS - for Cart core
!function($, root) {
	if (!root.EC) {
		return false;
	}
	var pathBase = 'ext/cart-libs/';

	var EC = root.EC;
	EC.init(function() {
		// extend settings
		$.extend(EC.settings, {
			basket_total_amount_label: $("#ec-basket-total-amount-label").text(),
			auto_basket_pageload: EC.Utils.parseBoolean("#ec-auto-basket-pageload"),
			auto_basket_close_buymenu: EC.Utils.parseBoolean("#ec-auto-basket-close-buymenu"),
			product_image_view_type: $("#ec-product-image-view-type").text()
		});
		// load js
		EC.Utils.addJs('ext/buymenu-libs/api/api-libs-if');
		if (EC.settings.linkage_product) {
			EC.Utils.addJs('ext/buymenu-libs/api/linkages/' + EC.settings.linkage_product + '/api-libs-impl');
		}
		EC.Utils.addJs(pathBase + 'api/api-libs-if');
		if (EC.settings.linkage_product) {
			EC.Utils.addJs(pathBase + 'api/linkages/' + EC.settings.linkage_product + '/api-libs-impl');
		}
		EC.Utils.addJs(pathBase + 'view/ec-common-libs');
	});

// Root will be 'window' in browser or 'global' on the server:
}(jQuery, this);
