// EC Integration JS - core
!function($, root) {
	if (!root.EC) root.EC = {};
	var EC = root.EC;

	$.extend(EC, {
		// settings
		settings: {},
		initCallbacks: $.Callbacks('once'),
		init: function(callback) {
			EC.initCallbacks.add(callback);
		},
		executeInitialize: function() {
			EC.initCallbacks.fire();
			EC.Utils.loadJs.apply(EC.Utils, EC.Utils.jsList);
		},
		ready: function(callback) {
			var ecReady = $.Deferred();
			$(document).ready(function() {
				EC.executeInitialize();
				$.when.apply($, EC.Utils.jsHash.values()).done(function() {ecReady.resolve()});
			});
			if ($.isFunction(callback)) {
				ecReady.done(callback);
			}
			return ecReady;
		},
		Utils: {},
		View: {},
		Model: {},
		Api: {},
		version: '2.0.2_0'
	});

	// Define EC Utils
	$.extend(EC.Utils, {
		jsPathPrefix: 'etc/designs/panasonic/eclinkage-clientlibs/js/default.htm',
		jsHash: new Hashtable(),
		// prepared the target javascript?
		isPreparedJs: function(path) {
			return EC.Utils.jsHash.containsKey(path);
		},
		jsList: new Array(),
		// reserve the loading javascripts
		addJs: function() {
			EC.Utils.jsList = EC.Utils.jsList.concat($.makeArray(arguments));
		},
		// load the required scripts
		loadJs: function(path) {
			if (arguments.length > 1) {
				var args = $.makeArray(arguments);
				$.each(args, function(i, p) {
					if (!EC.Utils.isPreparedJs(p)) {
						EC.Utils.jsHash.put(p, $.Deferred());
					}
				});
				return EC.Utils.loadJs(args.shift()).done(function() {
					EC.Utils.loadJs.apply(EC.Utils, args);
				});
			}
			var srcPath = EC.Utils.jsPathPrefix + path + '.js@v=' + EC.version;
			if (!$('script[src="' + srcPath + '"]').size()) {
				var $loadScript = $('<script>').attr({
					type: 'text/javascript',
					src: srcPath
				}).on('load', function() {
					if (EC.Utils.isPreparedJs(path)) {
						EC.Utils.jsHash.get(path).resolve();
					}
				});
				if ('onreadystatechange' in $loadScript.get(0)) {
					$loadScript.get(0).onreadystatechange = function() {
						if (this.readyState == "complete" || this.readyState == "loaded") {
							$loadScript.trigger('load');
						}
					}
				}
				$('head')[0].appendChild($loadScript[0]);
			}
			return EC.Utils.jsHash.get(path);
		},
		/*
		 * alias the method.
		 * 1. save in with "Without" the method of original
		 * 2. save in with "With" and suffix the new method
		 * 3. swap the new method to original method name
		 */
		aliasMethodChain: function(context, methodName, suffix) {
			var capitalizedSuffix = suffix.replace(/^./,function(){return arguments[0].toUpperCase()});
			context[methodName + 'Without' + capitalizedSuffix] = context[methodName];
			context[methodName] = context[methodName + 'With' + capitalizedSuffix];
		},
		// parse boolean from hidden item
		parseBoolean: function(selector, context) {
			return $(selector, context).text() == 'true';
		},
		/*
		 * Gets the Formatted price string.
		 */
		formatPrice: function(price) {
			if (!this.isValidNumber(price)) return '';
			var result = EC.settings.price_prefix || '';
			// price format. default: '#,###.00'
			var priceFormat = EC.settings.price_format || '#,###.00';
			// Defaults: Number group separator: ',', Decimal separator: '.'
			var grpSep = ',', decSep = '.';
			var pricePattern = /^(.*)([^#\d])(#+)([^#\d])?(0+)?$/;
			var matches = priceFormat.match(pricePattern);
			var formattedPrice = price;
			if (!!matches) {
				var swapSep = function(i, swapVal) {
					var ret = matches[i] || '';
					if (!!matches[i]) matches[i] = swapVal;
					return ret;
				};
				grpSep = swapSep(2, ','), decSep = swapSep(4, '.');
				formattedPrice = $.formatNumber(price, {format: matches.slice(1).join(''), overrideGroupSep: grpSep, overrideDecSep: decSep});
			}
			result += formattedPrice;
			result += EC.settings.price_suffix || '';
			return result;
		},
		// validate number of string
		isValidNumber: function(num) {
			return !(num === null || num === undefined || isNaN(parseFloat(num)));
		},
		isEmptyArray: function(array) {
			return !(_.isArray(array) && !_.isEmpty(array));
		}
	});

	// Define EC Api methods of common.
	$.extend(EC.Api, {
		/* Call EC-API for each params. */
		eachApi: function(params, proc, isAll) {
			var apiDeferred = $.Deferred();
			var results = [];
			if (!$.isArray(params) || params.length == 0) {
				return apiDeferred.resolve(results);
			}
			var resultCnt = 0;
			var self = this;
			$.each(params, function(i, param) {
				$.when(proc.call(self, param)).done(function(response, textStatus, jqXHR) {
					results.push(response);

				}).fail(function(jqXHR, textStatus, errorThrown) {
					if (isAll) {
						apiDeferred.reject(jqXHR, textStatus, errorThrown);
					}

				}).always(function() {
					resultCnt++;
					if (resultCnt >= params.length) {
						apiDeferred.resolve(results);
					}
				});
			});
			return apiDeferred.promise();
		},
		/*
		 * Call EC-API for each params.
		 * when raise a error, break the process.
		 */
		eachApiAll: function(params, proc) {
			return this.eachApi(params, proc, true);
		},
		/*
		 * Call EC-API for each params.
		 * when raise a error, continue the process until all complete.
		 */
		eachApiAny: function(params, proc) {
			return this.eachApi(params, proc, false);
		}
	});

	// Define EC View methods of common.
	$.extend(EC.View, {
		// callbacks
		viewEventCallbacks: new Hashtable(),
		trigger: function(eventName) {
			var triggerArgs = arguments;
			_.defer(function() {
				var cb = EC.View.viewEventCallbacks.get(eventName);
				if (!!cb) {
					cb.fire.apply(cb, _.toArray(triggerArgs).slice(1));
				}
			});
		},
		on: function(eventName, callback) {
			if (!this.viewEventCallbacks.containsKey(eventName)) {
				this.viewEventCallbacks.put(eventName, $.Callbacks());
			}
			var cb = this.viewEventCallbacks.get(eventName);
			if (!!cb) {
				cb.add(callback);
			}
		}
	});

	EC.init(function() {
		// populate settings
		$.extend(EC.settings, {
			api_url_pattern: $("#ec-api-url-pattern").text(),
			price_prefix: $("#ec-price-prefix").text(),
			price_suffix: $("#ec-price-suffix").text(),
			price_format: $("#ec-price-format").text(),
			linkage_product: $("#ec-linkage-product").text(),
			product_price_title_i18n: $("#ec-product-price-titlei18n").text(),
			buy_button_label: $("#ec-buy-button-label").text(),
			buy_from_panasonic_label: $("#ec-buy-from-panasonic-label").text(),
			where_to_buy_label: $("#ec-where-to-buy-label").text()
		});
		// load js
		EC.Utils.addJs('api/api-libs-if', 'api/linkages/' + EC.settings.linkage_product + '/api-libs-impl');
	});

	$(document).ready(function() {EC.executeInitialize()});

// Root will be 'window' in browser or 'global' on the server:
}(jQuery, this);
