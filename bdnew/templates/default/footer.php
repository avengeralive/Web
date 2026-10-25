		<!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

	    <script type="text/javascript" src="/landing/libs/jquery/jquery.js"></script>
	    <script type="text/javascript" src="/landing/libs/modernizr/modernizr.js"></script>
	    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	    <script type="text/javascript" src="/landing/js/global.js"></script>
		<script>
			function getRandomInt(max) {
			  return Math.floor(Math.random() * Math.floor(max));
			}
			function ResetCaptcha() {
			    image = 'captcha.php?rnd='+ getRandomInt(10000);
			    $('#captcha').attr('src', image);
			}
			function ResetCaptcha2() {
			    image = 'captcha.php?rnd='+ getRandomInt(10000);
			    $('#captcha2').attr('src', image);
			}
		</script>
	</body>
</html>