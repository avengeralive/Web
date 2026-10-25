$(function(){

		/*
		Везде. Подсвечиваем оранжевым измененные поля форм на страничке.
		*/
		$("input").change( function() {
				$(this).parent().addClass("imchanged");
				$("form: input[class='submit']").parent().addClass("imchanged");
			//	$("form: input[class='submit']").val("Нажмите сюда чтобы Сохранить изменения на странице");
		});
		$("radio").change( function() {
				$(this).parent().addClass("imchanged");
				$("form: input[class='submit']").parent().addClass("imchanged");
			//	$("form: input[class='submit']").val("Нажмите сюда чтобы Сохранить изменения на странице");
		});
		$("textarea").change( function() {
				$(this).parent().addClass("imchanged");
				$("form: input[class='submit']").parent().addClass("imchanged");
			//	$("form: input[class='submit']").val("Нажмите сюда чтобы Сохранить изменения на странице");
		});



});
