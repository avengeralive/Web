<?php
echo'
<!DOCTYPE html>
<html><head>
<script type="text/javascript" src="https://vocu.ru/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="https://vocu.ru/js/general.js"></script>
<script>
var json = {};
	json.func = "CVK",
	json.action = "vk_at",
	json.code = "'.$_GET['code'].'";
	$.ajax({
		url: "/json/",
		type: "GET",
		dataType: "json",
		data: json,
		success: function(d) {
			window.location = "https://" + d;
		}
	});
</script>
</head>
<body>
</body>
</html>';






