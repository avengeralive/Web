<?php

// Если была передана форма регистрации
// If the registration form has been transferred
if (isset($_POST['registration_email']))
	{
    
    $error_message = '';
    $error_type = 'error';
    $error_message= 'error';
    
    if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
	unset($_SESSION["captcha"]);
    
	if (isset($_POST['registration_email']) && $_POST['registration_email']!='')
		{
		if (preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $_POST['registration_email']))
			{
			if (isset($_POST['registration_password_1']) && $_POST['registration_password_1']!='')
				{
				if (isset($_POST['registration_password_2']) && $_POST['registration_password_2']!='')
					{
					if (isset($_POST['registration_tip']) && $_POST['registration_tip']!='')
						{
						if ($_POST['registration_password_1'] == $_POST['registration_password_2'])
							{
							if (isset($_POST['registration_agree_rules']) && $_POST['registration_agree_rules']!='true')
								{
                                                          
								$email = $mysqli -> real_escape_string(htmlspecialchars($_POST['registration_email']));
                                                                $skype = $mysqli -> real_escape_string(htmlspecialchars($_POST['registration_skype']));
                                                                $telegram = $mysqli -> real_escape_string(htmlspecialchars($_POST['registration_telegram']));
                                                                $phone = $mysqli -> real_escape_string(htmlspecialchars($_POST['registration_phone']));
								// $tip = $mysqli -> real_escape_string(htmlentities($_POST['registration_tip']));
								$tip = 10;
								$password = $mysqli -> real_escape_string(htmlspecialchars(md5(md5($_POST['registration_password_1']))));
								$activation_code = md5($email.'SECRET CODE');
                                                                $apikey=md5(microtime(1));    
								// Проверяем наличие в базе пользователя с таким e-mail
								// Check the existence of the database user with this e-mail
								$sql = "SELECT email FROM users WHERE `email`='$email'";
								$result = $mysqli->query($sql);
								if (mysqli_num_rows($result)==0) 
									{
									// Проверяем, есть ли в базе пользователи
									// Check whether there is a base of users
									$sql = "SELECT id FROM users";
									$result = $mysqli->query($sql);
									if (mysqli_num_rows($result)==0) 
										{
										// Если никого не найдено, то добавляем первого пользователя в качестве администратора
										// If no one is found, add the first user as the administrato
										$sql = "INSERT INTO users (`email`, `password`, `active`, `tip`) VALUES ('$email', '$password', '1', '70')";
										$result = $mysqli->query($sql);
										}
									else
										{
                                                                            
                                                                                $comment = '';
                                                                            
                                                                                if($tip == 40){
                                                                                    $comment = $mysqli -> real_escape_string(htmlspecialchars($_POST['company'])) . '|' . $mysqli -> real_escape_string(htmlspecialchars($_POST['site']));
                                                                                }
                                                                            
                                                                                if (isset($_COOKIE['utm_source']) && $_COOKIE['utm_source'] != ''){$utm_source = htmlentities($_COOKIE['utm_source']);}else{$utm_source = '';}
                                                                                if (isset($_COOKIE['utm_medium']) && $_COOKIE['utm_medium'] != ''){$utm_medium = htmlentities($_COOKIE['utm_medium']);}else{$utm_medium = '';}
                                                                                if (isset($_COOKIE['utm_campaign']) && $_COOKIE['utm_campaign'] != ''){$utm_campaign = htmlentities($_COOKIE['utm_campaign']);}else{$utm_campaign = '';}
                                                                                if (isset($_COOKIE['utm_term']) && $_COOKIE['utm_term'] != ''){$utm_term = htmlentities($_COOKIE['utm_term']);}else{$utm_term = '';}
                                                                                if (isset($_COOKIE['utm_content']) && $_COOKIE['utm_content'] != ''){$utm_content = htmlentities($_COOKIE['utm_content']);}else{$utm_content = '';}
                                                                                
										// Проверка, что передан ID рефовода и что реферал регистрируется как вебмастер
										// Check if the transmitted ID referrer and referral that registers as a webmaster
										if (isset($_COOKIE['referer']) && $_COOKIE['referer'] != 0 && $tip=='10')
											{
											$refovod=htmlentities((int)$_COOKIE['referer']);
											
											// Проверяем, есть ли в базе пользователь с ID рефовода
											// Check whether there is a basis of a user ID with the referrer
											$sql_check_refovod = "SELECT id FROM users WHERE `id`='$refovod'";
											$result_check_refovod = $mysqli->query($sql_check_refovod);
											if (mysqli_num_rows($result_check_refovod)>0) 
												{
												$sql = "INSERT INTO users (`email`, `password`, `tip`, `activation_code`, `skype`, `phone`,`date_registration`, `myrefovod`, `ref_program`,`comment`, `apikey`, `utm_source`, `utm_medium`, `utm_campaign`, `utm_term`, `utm_content`, `telegram_login`) VALUES ('$email', '$password', '$tip', '$activation_code' , '$skype', '$phone', NOW() , '$refovod', '1', '$comment', '$apikey', '$utm_source', '$utm_medium', '$utm_campaign', '$utm_term', '$utm_content', '$telegram')";
												}
											else
												{
												$sql = "INSERT INTO users (`email`, `password`, `tip`, `activation_code`, `skype`, `phone`,`date_registration`, `ref_program`,`comment`, `apikey`, `utm_source`, `utm_medium`, `utm_campaign`, `utm_term`, `utm_content`, `telegram_login`) VALUES ('$email', '$password', '$tip', '$activation_code', '$skype', '$phone', NOW(), '1', '$comment', '$apikey', '$utm_source', '$utm_medium', '$utm_campaign', '$utm_term', '$utm_content', '$telegram')";
												}
											}
										else
											{
											$sql = "INSERT INTO users (`email`, `password`, `tip`, `activation_code`, `skype`,`phone`, `date_registration`, `ref_program`,`comment`, `apikey`, `utm_source`, `utm_medium`, `utm_campaign`, `utm_term`, `utm_content`, `telegram_login`) VALUES ('$email', '$password', '$tip', '$activation_code', '$skype', '$phone', NOW(), '1', '$comment', '$apikey', '$utm_source', '$utm_medium', '$utm_campaign', '$utm_term', '$utm_content', '$telegram')";
											}
										$result = $mysqli->query($sql);
										$email=htmlentities($email);
	
										// На почту указанную пользователем при регистрации, отсылается письмо с кодом активации
										// On the specified user's mail in the registration, sent a letter with an activation code
										$userdata='<br /><br />'.$loc['reg']['t24'].'&nbsp;<b>'.$activation_code.'</b><br />'.$loc['reg']['t25'];
										$mail_subj = $loc['reg']['t31'];
										$mail_body = $loc['reg']['t26'].'<br /><br />'.$loc['reg']['t27'].'&nbsp;'.domain().'.&nbsp;'.$loc['reg']['t28'].'<br />'.$loc['reg']['t29'].$userdata.'<br /><br />'.$loc['reg']['t30'].'&nbsp;'.domain().'<br /><a href="'.site_url().'">'.site_url().'</a>';
										//SendEMail($email, $mail_subj, $mail_body);
                            

                                                                                $sender = Mailing_Sender::getDefaultSender();
                                                                                $letter = new Mailing_Letter;
                                                                                $letter->setSubject($mail_subj);
                                                                                $letter->setTo($email);
                                                                                $letter->setHtml($mail_body);
                                                                                $sender->send($letter);                     
										$mail_sended = true;
										}
	
									// Проверяем корректность добавления информации о новом пользователе в базу и находим его
									// Check the correctness of adding information about the new user to the database and find him
									$sql = "SELECT id FROM users WHERE `email` = '$email' AND `password` = '$password'";
									$res = $mysqli -> query($sql);
									$result = $res -> fetch_assoc();
									if ((int)$result['id'])
										{
										$_SESSION['id'] = (int)$result['id'];
										$user_id = $_SESSION['id'];
                                                                                User::setAuth($user_id);
										// Пишем в базу данные о посетителе и его успешной регистрации
										// Список действий ($deystvie):
										// 1 - Посещение страницы
										// 2 - Регистрация
										// 3 - Авторизация
										// 4 - Неудачная авторизация
										// 5 - Смена реквизитов
										// 6 - Смена пароля доступа									
										
										// Write into the database data about the visitor and his successful registration
										// Action List ($ deystvie):
										// 1 - Visiting the page
										// 2 - Registration
										// 3 - Authorization
										// 4 - Authorization Failed
										// 5 - Change details
										// 6 - Change the access password										
										$deystvie='2';
										include_once './includes/userslog/index.php';
										Header('Location: ./cabinet.php');
										exit;
                                                                                }else{$error_message=$loc['reg']['t32'];}
                                                                        }else{$error_message=$loc['reg']['t32'];}

                                                                }else{$error_message=$loc['reg']['t34'];}
							}else{$error_message=$loc['reg']['t35'];}
						}else{$error_message=$loc['reg']['t36'];}							
					}else{$error_message=$loc['reg']['t37'];}
                                }else{$error_message=$loc['reg']['t38'];}
			}else{$error_message=$loc['reg']['t39'];}
		}else{$error_message=$loc['reg']['t40'];}
        }else{$error_message=$loc['recover.php']['t28'];}
	}

?>