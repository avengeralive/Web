<!-- Marquiz script start -->
<script src="//script.marquiz.ru/v1.js" type="application/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
<script>
document.addEventListener("DOMContentLoaded", function() {
Marquiz.init({ id: '5b2a15fc4f07ad00427ac891' });
});
$(function(){
	setTimeout(function() {
		$(".marquiz__container__holder").css('display', 'flex');;
		$(".marquiz__container").show();
	}, 5000);
	$(".marquiz__button").on('click', function(){
		$(".marquiz__container__holder").css('display', 'none');;
		$(".marquiz__container").hide();
	});
});
</script>
<!-- Marquiz script end -->

<div class="marquiz__container__holder">
<div class="marquiz__container">
	<div style="width: 50%;">
	<h3 style="color: #00a2e6; text-align: right; text-transform: uppercase; font-family: 'Oswald', sans-serif; font-size: 18px;">Пройдите тест и<br>выберете ваш корпоративный<br>подарок</h3>
<a class="marquiz__button marquiz__button_blicked marquiz__button_rounded
marquiz__button_shadow" href="#popup:marquiz_5b2a15fc4f07ad00427ac891" data-fixed-side=""
data-alpha-color="rgba(61, 59, 238, 0.5)" data-color="#3d3bee" data-text-color="#ffffff">Выбрать корпоративный подарок</a>
	</div>
</div>
</div>

<style>
	.marquiz__container__holder {
		position: absolute;
	    width: 100%;
	    height: 100vh;
	    display: flex;
	    background: rgba(0,0,0,.8);
	    top: 0;
	    left: 0;
	    justify-content: center;
	    flex-direction: column;
	    display: none;
	}
	.marquiz__container {
		background: url('./bg.png');
		background-size: cover;
	    width: 640px;
	    height: 200px;
	    margin: 0 auto;
	    padding: 50px;
	    box-shadow: 2px 2px 2px #000;
	    display: none;
	}
	.marquiz__button {
	    color: #00a2e6 !important;
	    background: none !important;
	    border: 3px solid #00a2e6 !important;
	    font-size: 11px !important;
	    border-radius: 0px !important;
	    box-shadow: 0 0 1px 2px #00a2e6 !important;
	    text-transform: uppercase !important;
	    padding: 15px !important;
	    float: right;
	}
	.marquiz__button:hover {
	    color: #00a2e6 !important;
	}
</style>
