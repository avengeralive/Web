/*
* pagetracker.js
* Recently viewed pages are stored as first in first out
*/
if(PageTracker == null){
	var PageTracker = {};
}

(function($){
	/*
	 * @param (int) registering number of the recently viewed items.
	 */
	PageTracker.updateRecentPages = function(maxItemCount){
		if (!GwcCommon.isCookieUsable()) {
			return;
		}
		var recentpages = PageTracker.getRecentPages(),
				countryInfo = PageTracker.getCurrentCountryLang(),
				currPath    = document.location.pathname.replace(/\.html.*?/, '');

		// Only add the current page if it doesn't exist
		var existingItemIndex = $.inArray(currPath, recentpages);
		if (existingItemIndex >= 0) {
			recentpages.splice(existingItemIndex, 1);
		}
		while(recentpages.length >= (maxItemCount)){
			recentpages.pop();
		}

		recentpages.unshift(currPath);

		PageTracker.saveCookie(recentpages);
	};

	/*
	 * @param (int) number of the recently viewed items.
	 */
	PageTracker.loadRecentPages = function(maxItemCount, options){
		if (!GwcCommon.isCookieUsable()) {
			$('#recentlyviewed .subheader1').hide();
			return;
		}
		var opts = $.extend({
			root: "#recentlyviewed .cols-row",
			wrapper: '<div class="col">'
		}, options);
		var ownPath = document.location.pathname.replace(/(\/|\.html)$/, '');
		var recentpages = _.filter(PageTracker.getRecentPages(), function(path) {
			return path != ownPath;
		});
		var $recentViewedColsRow = $(opts.root);
		if(!_.isEmpty(recentpages)){

			var processCnt = 0;
			PageTracker.recentlyViewedReady.progress(function() {
				processCnt++;
				if (recentpages.length <= processCnt) {
					PageTracker.recentlyViewedReady.resolve($recentViewedColsRow);
				}
			});

			$.each(recentpages, function(i, recentpage){
				if (maxItemCount <= i) {
					PageTracker.recentlyViewedReady.notify();
					return true;
				}

				var $div = $(opts.wrapper);
				$recentViewedColsRow.append($div);
				$.ajax(recentpage + ".productinfo.html").done(function(productinfo) {
					if (productinfo != null) {
						var productinfoJson = _.reduce($(productinfo), function(memo, val){
							var $target = $(val);
							if ($target.is('span')) {
								memo[$target.attr('id')] = $target.text();
							}
							return memo;
						}, {});

						if (_.all(['product_image', 'short_description', 'description', 'model_number'], function(key){return _.has(productinfoJson, key);})) {
							$div.append(_.template($('#template-recentlyviewed-col').html(), $.extend({product_path: recentpage + '.html'}, productinfoJson)));
						}
					}
				}).fail(function() {
					$div.remove();
				}).always(PageTracker.recentlyViewedReady.notify);
			});
		} else {
			PageTracker.recentlyViewedReady.resolve($recentViewedColsRow);
		}
	};
	PageTracker.recentlyViewedReady = $.Deferred();

	PageTracker.getCurrentCountryLang = function() {
		return {
			curr_country: $('#language-data').attr('cnty'),
			curr_lang: $('#language-data').find('tr[data-selected="true"]').attr('path')
		};
	};

	PageTracker.getCookieKey = function() {
		var countryInfo = PageTracker.getCurrentCountryLang();
		return "product_recently_viewed_" + countryInfo.curr_country + "_" + countryInfo.curr_lang;
	};

	PageTracker.getRecentPages = function() {
		return JSON.parse($.cookie(PageTracker.getCookieKey()) || '[]');
	};

	PageTracker.saveCookie = function(recentpages) {
		$.cookie(PageTracker.getCookieKey(), JSON.stringify(recentpages), {expires: 365, path: "default.htm", secure: GwcCommon.isAlwaysOnSsl});
	};
})(jQuery, this);
