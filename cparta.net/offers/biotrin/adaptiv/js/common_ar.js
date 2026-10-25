$(document).ready(function() {
	$('.call-form').magnificPopup({
	  fixedContentPos: true,
	  callbacks: {
		beforeOpen: function() { $('html').addClass('mfp-helper'); },
		close: function() { $('html').removeClass('mfp-helper'); }
		}
	});
    $(".reviews_block").owlCarousel({
        navigation: true,
        loop: true,
        nav: true,
        items: 1,
        margin: 0
    });
    $(".reviews_form").submit(function() {
		$.ajax({
			type: "POST",
			data: $(this).serialize()
		}).success(function() {
			event.stopPropagation();
			$(this).find("input").val("");
			$(this).find("textarea").val("");
			alert("Спасибо за Ваш отзыв!");
			$(".reviews_form").trigger("reset");
		});
		return false;
	});
	$(".attention-form button").click(function () {
		var $code = $(".attention-form input"),
		$message = $(".js-message");
		var $codeLenght = $(".attention-form input").val().length;
		var codeValue = $code.val();
		var reg1 = new RegExp("[^0-9]*", "g"), // создаем регулярку, чтобы она выбрала все цифры
		codeValue = codeValue.replace(reg1, ''); // берем все цифры из некой переменной
		if (codeValue.length == 15) { // Если кол-во цифр = 15
			return $message.text("Ձեր պատվիրած ապրանքը իսկական է, հաճույքով օգտագործեք։");
		}
		else if ($code.val() !== '' && $code.val() !== ' ' && $code.val() !== '  ') {
			return $message.text("Դժբախտաբար, այս ծածկագիրը չգտնվեց: Ամենայն հավանականությամբ, դուք կեղծ ապրանք եք գնել:");
		} else {
			return $message.text("Խնդրում ենք մուտքագրել ծածկագիրը։");
		}
	})
});