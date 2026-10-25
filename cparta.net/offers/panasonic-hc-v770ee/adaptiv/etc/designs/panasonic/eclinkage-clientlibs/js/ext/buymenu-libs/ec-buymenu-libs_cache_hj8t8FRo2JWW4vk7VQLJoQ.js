// EC Integration JS - for Buymenu core
!function($, root) {
	if (!root.EC) {
		return false;
	}
	var pathBase = 'ext/buymenu-libs/';
	var EC = root.EC;
	$.extend(EC, {
		StockState: {
			IN_STOCK: 'InStock',
			OUT_OF_STOCK: 'OutOfStock',
			AVAILABLE_SOON: 'AvailableSoon'
		}
	});

	EC.init(function() {
		// extend settings
		$.extend(EC.settings, {
			stock_availability_label_in_stock: $("#ec-stock-availability-label-in-stock").text(),
			stock_availability_icon_in_stock: $("#ec-stock-availability-icon-in-stock").text(),
			stock_availability_icon_alt_in_stock: $("#ec-stock-availability-icon-alt-in-stock").text(),
			stock_availability_label_out_of_stock: $("#ec-stock-availability-label-out-of-stock").text(),
			stock_availability_icon_out_of_stock: $("#ec-stock-availability-icon-out-of-stock").text(),
			stock_availability_icon_alt_out_of_stock: $("#ec-stock-availability-icon-alt-out-of-stock").text(),
			stock_availability_label_available_soon: $("#ec-stock-availability-label-available-soon").text(),
			stock_availability_icon_available_soon: $("#ec-stock-availability-icon-available-soon").text(),
			stock_availability_icon_alt_available_soon: $("#ec-stock-availability-icon-alt-available-soon").text(),
			product_maker_label: $("#ec-product-maker-label").text(),
			back_orderable: EC.Utils.parseBoolean("#ec-back-orderable"),
			cookie_policy_acceptance_message: $("#ec-cookie-policy-acceptance-message").html(),
			cookie_policy_opt_in_message: $("#ec-cookie-policy-opt-in-message").html(),
			visit_online_shop_label: $("#ec-visit-online-shop-label").text(),
			display_stock_warning: EC.Utils.parseBoolean("#ec-display-stock-warning"),
			product_img_alt_message: $("#ec-product-img-alt-message").text()
		});
		// load js
		EC.Utils.addJs(pathBase + 'api/api-libs-if');
		if (EC.settings.linkage_product) {
			EC.Utils.addJs(pathBase + 'api/linkages/' + EC.settings.linkage_product + '/api-libs-impl');
		}
		EC.Utils.addJs(pathBase + 'view/ec-common-libs');
		if (EC.settings.view_name) {
			EC.Utils.addJs(pathBase + 'view/ec-' + EC.settings.view_name + '-libs');
		}
	});

// Root will be 'window' in browser or 'global' on the server:
}(jQuery, this);
