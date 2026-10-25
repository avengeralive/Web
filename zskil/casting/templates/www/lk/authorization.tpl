<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="{$uri}/assets/css/styles.www.lk.css" media="all" />
	<title>Личный кабинет</title>
</head>

<body>
<div id="wrapper">
	<table id="wrapper">
		<tr>
			<td align="center">
				<h1>Личный кабинет</h1><br /><br />

				<form method="POST">
					<input type="hidden" name="try_auth" value="1" />

					<table border="1" rules="all" cellspasing="5" cellpadding="5">
						<tr>
							<td>Логин:</td>
							<td><input type="text" name="login" value='{$login}' /></td>
						</tr>
						<tr>
							<td>Пароль:</td>
							<td><input type="password" name="password" value='' /></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Вход" />
							</td>
						</tr>
						{if !empty($notification)}
						<tr>
							<td colspan="2">
								<font color="red">{$notification}</font>
							</td>
						</tr>
						{/if}
					</table>
				</form>
			</td>
		</tr>
	</table>
</div>
</body>
</html>
