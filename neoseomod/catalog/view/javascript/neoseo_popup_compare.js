function popupCompareShow(json) {

	if (json["products_count"] == 0) {
		$("#popup-compare > div").modal('hide');
		if ($("#unistor-compare-total > span").length) {
			$("#unistor-compare-total > span").remove();
		}
	} else if (json["popup-compare"]) {
		if ($("#unistor-compare-total > span").length) {
			$("#unistor-compare-total > span").html(json["products_count"]);
		} else {
			$("#unistor-compare-total i").after("<span>" + json["products_count"] + "</span>");
		}
		if ($("#popup-compare").length == 0) {
			$("body").append("<div id=\"popup-compare\"></div>");
			$("#popup-compare").html(json["popup-compare"]);
			$("#popup-compare .modal-body").html(json["popup-compare-body"]);
			$('#popup-compare > div').modal();
		} else {
			$("#popup-compare .modal-body").html(json["popup-compare-body"]);
			$('#popup-compare > div').modal();
		}
	}
}

function popupCompareTrash(product_id) {
	var language = "";
	if (window.current_language) {
		language = window.current_language;
	}
	$.ajax({
		url: language + 'index.php?route=product/compare/remove',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function (json) {
			popupCompareShow(json);
		}
	});
}

var compare = {
	'add': function (product_id) {
		var language = "";
		if (window.current_language) {
			language = window.current_language;
		}
		$.ajax({
			url: language + 'index.php?route=product/compare/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function (json) {
				$('.alert').remove();

				if (json['success']) {
					popupCompareShow(json);

					$('#compare-total').html(json['total']);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function () {

	}
}