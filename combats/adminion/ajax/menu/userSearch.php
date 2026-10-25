<?php
if(isset($_GET['action']) && $_GET['action']!='')
{
	if($_GET['action']=='load' && $_GET['UserLogin']!='')
	{
		$qq = (is_numeric($_GET['UserLogin']) ? '`id`="'.$_GET['UserLogin'].'"' : '`login` LIKE "%'.mysql_real_escape_string($_GET['UserLogin']).'%"');
		$sp = mysql_query('SELECT `id`,`login`,`level` FROM `users` WHERE '.$qq.' ORDER BY `id` LIMIT 1000');

		while($pl= mysql_fetch_array($sp))
		{ 
			$login = $u->microLogin($pl['id'],1);
			if(substr_count($login, 'Невидимка'))
			{
				$login = str_replace('<i>Невидимка</i>',$pl['login'], $login);
                $login = str_replace('[??]','['.$pl['level'].']', $login);
			}
			echo "<div class='new_br'><div><hr>".$login." [ID:".$pl['id']."]</div>";
		}
	}
	die();
}

?>
<style>
.new_br
{
	margin-bottom:20px;
}
</style>
<script>
function userSearch()
{
	var UserLogin = $("#UserLogin").val();
	$.ajax({
		url: "?mod=context&menu=userSearch&action=load&UserLogin="+UserLogin,
		type: "GET",
		success: function(data)
		{
            $('#usersList').html("");
			$('#usersList').append(data);
		}
	});
}
</script>
<div style="display:flex; text-align: center; margin: 10px auto;">
	<div style="margin: auto;">
		Поиск персонажа по логину или id<br>
		<input name="UserLogin" id="UserLogin"  style="width: 300px;" placeholder="логин или id персонажа">
		&nbsp;<button onclick="userSearch();">Найти</button>
	</div>
</div><br>
<div id="usersList" style="width:100%;"></div>