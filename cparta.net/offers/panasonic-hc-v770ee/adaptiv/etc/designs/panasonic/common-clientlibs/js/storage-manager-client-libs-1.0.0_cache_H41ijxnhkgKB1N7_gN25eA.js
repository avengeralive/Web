(function($) {
	if (!('GwcCommon' in window)) {
		GwcCommon = {};
	}

	// Local Storage usable ready
	var $d_storageFrameReady = $.Deferred();
	var storageManagerDomain = '';
	$(function() {
		storageManagerDomain = ($('#storage-manager-client').attr('data-localstorage-save-https') === 'true' ? '../https@' : 'http://') + location.host;
		if (!$('iframe#storage-manager-frame').length) {
			var $storageFrame = $('<iframe id="storage-manager-frame"></iframe>').hide().on('load', function() {
				$d_storageFrameReady.resolve();
			});
			$('body').append($storageFrame.attr('src', storageManagerDomain + '/servlet/storage-manager.html'));
		} else {
			$d_storageFrameReady.resolve();
		}
	});

	var postmsgIndex = 0;
	var postmsgDeffers = {};

	$.extend(GwcCommon, {

		storageData: function(key, value) {
			var msgId = generateMsgId();
			postmsgDeffers[msgId] = $.Deferred();

			var postData = {
				msg_id: msgId,
				gwc_storage: {
					key: key
				}
			};

			if (typeof value !== 'undefined' && value !== null) {
				$.extend(postData.gwc_storage, {value: value});
			}

			$d_storageFrameReady.done(function() {
				// postMessage to iframe(always https)
				$('#storage-manager-frame')[0].contentWindow.postMessage(JSON.stringify(postData), storageManagerDomain);
			});

			return postmsgDeffers[msgId].promise();
		}
	});

	function generateMsgId() {
		return 'gwc_storage_msg_' + (postmsgIndex++);
	}

	$(window).on('message', function(event) {
		var orgEvent = event.originalEvent;
		// check origin domain
		if (!(new RegExp('https?:\/\/' + document.domain).test(orgEvent.origin)) ||
				!('data' in orgEvent && _.isString(orgEvent.data))) {
			return;
		}

		var receiveData = JSON.parse(orgEvent.data);
		if ('msg_id' in receiveData &&
				receiveData.msg_id in postmsgDeffers &&
				'status' in receiveData) {
			if (receiveData.status === 'success') {
				postmsgDeffers[receiveData.msg_id].resolve(receiveData.storage_value);
			} else {
				postmsgDeffers[receiveData.msg_id].reject(receiveData.message);
			}

		}
	});
})(jQuery);
