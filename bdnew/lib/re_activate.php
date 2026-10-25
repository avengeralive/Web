<?php

// Если был передан запрос на получение повторного письма активации аккаунта, то выполняем
// If the request had been referred to a letter re-activate your account, then perform
if (isset($_GET['re_activate']) && isset($user_id) && $_GET['re_activate']==$user_id)
	{
	$re_activate=htmlentities($_GET['re_activate']);
	// Читаем данные пользователя из базы
	// Read the user's data from the database
	$sql_userdata = "SELECT * FROM users WHERE `id`='$re_activate' AND `active`='0'";
	$result_userdata=$mysqli->query($sql_userdata);
	if (mysqli_num_rows($result_userdata) > 0) 
		{
		$res_userdata=mysqli_fetch_array($result_userdata);
		$activation_code=htmlentities($res_userdata['activation_code']);
		// На почту указанную пользователем при регистрации, отсылается письмо с кодом активации
		// On the specified user's mail in the registration, sent a letter with an activation code		
		$userdata='<br /><br />'.$loc['reg']['t24'].'&nbsp;<b>'.$activation_code.'</b><br />'.$loc['reg']['t25'];
		$mail_subj = domain().': '.$loc['reg']['t24'];
		$mail_body = $loc['reg']['t26'].'<br /><br />'.$loc['reg']['t27'].'&nbsp;'.domain().'.&nbsp;'.$loc['reg']['t28'].'<br />'.$loc['reg']['t29'].$userdata.'<br /><br />'.$loc['reg']['t30'].'&nbsp;'.domain().'<br /><a href="'.site_url().'">'.site_url().'</a>';
		SendEMail($user_email, $mail_subj, $mail_body);
		$mail_sended = true;
		Header ('Location: ./profile.php?reactivate');
		exit;
		}
	}
	
?>