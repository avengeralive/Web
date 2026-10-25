$(document).ready(function(){
	var i = 0;

	function yved() {
		i = 1;
		$('.yved:nth-child(' + i + ')').fadeIn(500).delay(5000).fadeOut(500);
	}

	setTimeout(function () {
		setInterval(
			function () {
				i = i + 1;
				$('.yved:nth-child(' + i + ')').fadeIn(500).delay(6000).fadeOut(500);
			}, 17000);
		yved();
	}, 12000);
});