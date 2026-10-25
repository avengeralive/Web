<?php
use lib\CTemplates;

$html = '<!DOCTYPE html><html>
	<head>
	    <title>Авторизация</title>
	    <meta name=viewport content="width=device-width, initial-scale=1">
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <link rel="icon" href="/cdn/lib/london.png"  type="image/x-icon">
	    <link rel="stylesheet" href="/css/cabinet.css">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
	    <script type="text/javascript" src="/js/general.js"></script>
	    <script>if (typeof alerts !== "undefined") { setTimeout(alerts, 100)}</script>
	    <script>
			setTimeout(function() {
				if(typeof Alert !== "undefined" && Alert.texts) alert(Alert.texts);
				if(typeof Alert !== "undefined" && Alert.times) {
					setTimeout(function() {
						location.href = "/panel"
					}, Alert.times)
				}
			}, 100);
		</script>
	</head>
	<body>';
	
$type = ( $auth_type === 'true' );
$generate_form_token = CTemplates::generate_form_token();
if ( $type ) {

	$html .= '<div id="adminlogin">
		<input type="radio" name="login" id="login1" checked="checked"/><label for="login1">Авторизация</label>
		<input type="radio" name="login" id="login2"/><label for="login2">Регистрация</label>
		<input type="radio" name="login" id="login3"/><label for="login3">Забыли пароль?</label>
	    <form name="login-form" action="" method="post">
	        <h1>Авторизация</h1>
	        <input type="hidden" name="Auth" value="true">
	        <input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
	        <input name="Username" type="text" placeholder="E-mail" />
	        <input name="Password" placeholder="Пароль" type="password" />
	        <input type="submit" name="submit" value="ВОЙТИ" />
	    </form>
		<form name="reg-form" action="" method="post">
	        <h1>Регистрация</h1>
            <p>Регистрируясь, вы принимаете условия<br><a target="_blank" rel="noopener noreferrer nofollow" href="/privacypolicy">Политики конфиденциальности</a></p>
	        <input type="hidden" name="Register" value="true">
	        <input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
			<input name="Username" required type="text" placeholder="E-mail" maxlength="50">
			<input type="submit" name="submit" value="Региcтрация" />
		</form>
		<form name="forgot-form" action="" method="post">
	        <h1>Восстановление пароля</h1>
			<p>Введите cвой E-mail и мы вышлем Вам<br>инcтрукцию по воccтановлению пароля</p>
	        <input type="hidden" name="Forgot" value="true">
	        <input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
			<input name="Username" required type="text" placeholder="E-mail" maxlength="50">
			<input type="submit" name="submit" value="Воccтановить пароль" />
		</form>
	</div>';

} else {

	$html .= '<div id="adminlogin">
		<input type="radio" name="login" id="login1" checked="checked"/><label for="login1">Авторизация</label>
		<input type="radio" name="login" id="login2"/><label for="login2">Забыли пароль?</label>
	    <form name="login-form" action="" method="post">
	        <h1>Авторизация</h1>
	        <input type="hidden" name="Auth" value="true">
	        <input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
	        <input name="Username" type="text" placeholder="E-mail" />
	        <input name="Password" placeholder="Пароль" type="password" />
	        <input type="submit" name="submit" value="ВОЙТИ" />
	    </form>
		<form name="forgot-form" action="" method="post">
	        <h1>Восстановление пароля</h1>
			<p>Введите cвой E-mail и мы вышлем Вам<br>инcтрукцию по воccтановлению пароля</p>
	        <input type="hidden" name="Forgot" value="true">
	        <input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
			<input name="Username" required type="text" placeholder="E-mail" maxlength="50">
			<input type="submit" name="submit" value="Воccтановить пароль" />
		</form>
	</div>';

}

$html .= '</body></html>';
echo $html;

