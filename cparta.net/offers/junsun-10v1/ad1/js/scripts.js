$(document).ready(function() {
	
	/* scroll */
	
	$("a[href^='#']").click(function(){
		var target = $(this).attr("href");
		$("html, body").animate({scrollTop: $(target).offset().top+"px"});
		return false;
	});

	/* timer */

	function update() {
		var Now = new Date(), Finish = new Date();
		Finish.setHours( 23);
		Finish.setMinutes( 59);
		Finish.setSeconds( 59);
		if( Now.getHours() === 23  &&  Now.getMinutes() === 59  &&  Now.getSeconds === 59) {
			Finish.setDate( Finish.getDate() + 1);
		}
		var sec = Math.floor( ( Finish.getTime() - Now.getTime()) / 1000);
		var hrs = Math.floor( sec / 3600);
		sec -= hrs * 3600;
		var min = Math.floor( sec / 60);
		sec -= min * 60;
		$(".timer .hours").text( pad(hrs));
		$(".timer .minutes").text( pad(min));
		$(".timer .seconds").text( pad(sec));
		setTimeout( update, 200);
	}
	function pad(s) { return ('00'+s).substr(-2) }
	update();

	/* validate form */

	$(".order_form").submit(function(){
		if ($(this).find("input[name='name']").val() == "" && $(this).find("input[name='phone']").val() == "") {
			alert("Введите Ваши имя и телефон");
			$(this).find("input[name='name']").focus();
			return false;
		}
		else if ($(this).find("input[name='name']").val() == "") {
			alert("Введите Ваше имя");
			$(this).find("input[name='name']").focus();
			return false;
		}
		else if ($(this).find("input[name='phone']").val() == "") {
			alert("Введите Ваш телефон");
			$(this).find("input[name='phone']").focus();
			return false;
		}
		return true;
	});

});