<?php
echo'
<!DOCTYPE html>
<html><head>
<title>Отписаться от рассылок</title>
<meta name=viewport content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="https://vocu.ru/js/style.css" /></head>
<script type="text/javascript" src="https://vocu.ru/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="https://vocu.ru/js/general.js"></script>
</head>
<body class="e404">


<div class="unsubscribe"><br><br><br><br><br>
	<h1 style="color: white;margin: 0 0 25px;font-size: 45px;">Отписаться от рассылок</h1>
	
	<p style="display: inline-block;"><a style="text-transform: none;" id="nosms">Отписаться от sms рассылок</a></p>
	<p style="display: inline-block;"><a style="text-transform: none;" id="nomail">Отписаться от e-mail рассылок</a></p><br>
	
	<a>Чтобы отписаться от SMS или E-mail рассылок, выберите процесс из списка.</a>
	<div id="unsubscribe">
		<label>Ваш e-mail:</label>
		<input id="input"type="text" placeholder="">
		<button id="button">Отписаться</button>
		<span id="err">Поле не может быть пустым</span>
		<span id="succes">Вы упешно отписаны</span>
	</div>
</div>


<style>
#succes{color: green;display: none;}
#err{color: red;display: none;}
.unsubscribe input[type="text"] {height: 36px;
    margin: 5px 0 10px;
    outline: none;
    padding: 7px;
    box-sizing: border-box;
    font-size: 14px;
    width: 100%;}

.unsubscribe button {border: 0;
    font-size: 14px;
    outline: none;
    border-radius: 3px;
    padding: 10px 20px;
    font-family: arial;
    text-transform: uppercase;
    display: table;
    background: #ffc81c;
    color: black;
    cursor: pointer;}

.unsubscribe span {padding-bottom: 20px;
    border-bottom: 1px #cacaca solid;
    display: block;
    margin-bottom: 20px;}

#unsubscribe {font-family: arial;
    text-align: left;
    margin: 20px auto;
    border: 1px #cacaca solid;
    display: none;
    padding: 20px;
    border-radius: 3px;
    width: 445px;
    background: white;
    height: 140px;
    box-sizing: border-box;}
</style>

<script>

$("#nosms").click(function(){
	$("#unsubscribe").show();
	$("#unsubscribe label").empty();
	$("#unsubscribe label").append("Номер телефона");
	$("#unsubscribe input").mask("+7(999)999-99-99");
	$("#unsubscribe input").attr("placeholder","Номер телефона");
});

$("#nomail").click(function(){
	$("#unsubscribe").show();
	$("#unsubscribe label").empty();
	$("#unsubscribe label").append("Ваш e-mail:");
	$("#unsubscribe input").attr("placeholder","Адрес электронной почты");
});
$("#button").click(function(){
if ($("#input").val() == "") $("#err").show();
else{
$("#err").hide();
	var json = {};
	json.func = "CUser",
	json.action = "unsubscribeIt",
	json.text = $("#input").val();
	$.ajax({
		url: "/json/",
		type: "POST",
		dataType: "json",
		data: json,
		success: function() {
			$("#succes").show();
		}
	});
	}
});

</script>
</body>
</html>';






