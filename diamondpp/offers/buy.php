<?php

// Если был переход с лендинга подключенного к онлайн-оплате на форму оплаты по партнеской ссылке, то выполняем
// If there was a transition from the landing connected to online - payment on the form of payment for partneskoy link, then execute
if (isset($_GET['pay']) && $_GET['pay']!='' && $_GET['pay']!='0')
	{
	// Подключаем файл конфигурации
	// Connect configuration file
	include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/config.php';
	
	// Подключаем файл защиты от инжекта для передаваемых переменных
	// Connect the protection of injection file transmitted variables
	include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/antiinject/index.php';

	// Подключаем файл с настройками системы
	// Connect the file system settings
	include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/settings/index.php';	
	
	// Подключаем файл с определением того, какую версию дизайна выводить
	// Connect file with the definition of what type of design output version
	include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/otladka/index.php';	

	// Подключаем функции кодирования и раскодирования партнерской строки
	// Connect the encoding and decoding functions affiliate line
	include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/partnerstroka/index.php';
	
	// Помещаем полученную строку в переменную
	// Put the resulting string into a variable
	$paystroka=htmlentities($_GET['pay']);
	$partnerlink=partnerstroka_decode($paystroka,true);
	$user_id=htmlentities($partnerlink[0]);
	$offer_id=htmlentities($partnerlink[1]);
	$landingid=htmlentities($partnerlink[2]);
	
	// Проверяем, есть ли в наличии такой оффер и включен ли он
	// Check whether there is a presence of such offer and whether it is turned on
	$sql_check_offer = "SELECT id,name,owner_id,cena FROM offers WHERE `id`='$offer_id' AND `active`='1' AND `deystvie`='5'";
	$result_check_offer=$mysqli->query($sql_check_offer);
	if (mysqli_num_rows($result_check_offer) > 0) 
		{
		$res_check_offer=mysqli_fetch_array($result_check_offer);
		$offer_name=htmlentities($res_check_offer['name']);
		$offer_cena=htmlentities($res_check_offer['cena']);
		$offer_owner_id=htmlentities($res_check_offer['owner_id']);
		
		// Узнаем реквизиты владельца оффера
		// Learn details offera owner
		$sql_check_owner = "SELECT id,email,name FROM users WHERE `id`='$offer_owner_id'";
		$result_check_owner=$mysqli->query($sql_check_owner);
		if (mysqli_num_rows($result_check_owner) > 0) 
			{
			$res_check_owner=mysqli_fetch_array($result_check_owner);
			$owner_email=htmlentities($res_check_owner['email']);	
			$owner_name=htmlentities($res_check_owner['name']);
	
			?>
			<html>
				<head>
				<style>
				html, body {background: #e1e2e3; font-family: sans-serif, Arial; font-size: 16px; font-weight: normal; color: black;}
				.pay_mainwindow {margin: 20px auto; width: 90%; background: white;}
				.pay_mainwindow td {padding: 25px; vertical-align: top;}
				.pay_mainzagolovok {position: relative; margin: 0px 0px 15px 0px; font-family: sans-serif, Arial; font-size: 30px; font-weight: bold;}
				.pay_contactzagolovok {position: relative; margin: 0px 0px 5px 0px; font-family: sans-serif, Arial; font-size: 24px; font-weight: bold;}
				.pay_offername {position: relative; margin: 0px 0px 15px 0px; font-family: sans-serif, Arial; font-size: 24px; font-weight: bold; color: #13c165;}
				.pay_rekvizit {position: relative; margin: 10px 0px 0px 0px; font-family: sans-serif, Arial; font-size: 16px; font-weight: normal; color: #1f2122;}
				.pay_sposobzagolovok {position: relative; margin: 15px 0px 10px 0px; font-family: sans-serif, Arial; font-size: 24px; font-weight: bold;}
				.pay_input {position: relative; margin: 4px 0px 0px 0px; width: 300px; height: 46px; padding: 5px 8px; border: 2px solid #d6dfe9; font-size: 18px; box-shadow: none!important; border-radius: 0!important; font-family: sans-serif, Arial; font-weight: normal; color: #1f2122;}
				.pay_warning {width: 575px; border: 1px solid red; text-align: center; padding: 10px 0px 10px 0px; display: none;}
				
				.pay_card {width: 135px; height: 80px; background: url(<?php echo $settings_url.'/templates/'.$template.'/img/pay_card.png'; ?>); border: 2px solid #d6dfe9; box-shadow: none!important; border-radius: 0!important; }
				.pay_webmoney {width: 135px; height: 80px; background: url(<?php echo $settings_url.'/templates/'.$template.'/img/pay_webmoney.png'; ?>); border: 2px solid #d6dfe9; box-shadow: none!important; border-radius: 0!important; }
				.pay_yandex {width: 135px; height: 80px; background: url(<?php echo $settings_url.'/templates/'.$template.'/img/pay_yandex.png'; ?>); border: 2px solid #d6dfe9; box-shadow: none!important; border-radius: 0!important; }
				.pay_nal {width: 135px; height: 80px; background: url(<?php echo $settings_url.'/templates/'.$template.'/img/pay_nal.png'; ?>); border: 2px solid #d6dfe9; box-shadow: none!important; border-radius: 0!important; }
				.pay_sberbank {width: 135px; height: 80px; background: url(<?php echo $settings_url.'/templates/'.$template.'/img/pay_sberbank.png'; ?>); border: 2px solid #d6dfe9; box-shadow: none!important; border-radius: 0!important; }
				.pay_alfa {width: 135px; height: 80px; background: url(<?php echo $settings_url.'/templates/'.$template.'/img/pay_alfa.png'; ?>); border: 2px solid #d6dfe9; box-shadow: none!important; border-radius: 0!important; }
				.pay_psbank {width: 135px; height: 80px; background: url(<?php echo $settings_url.'/templates/'.$template.'/img/pay_psbank.png'; ?>); border: 2px solid #d6dfe9; box-shadow: none!important; border-radius: 0!important; }
				
				.pay_card:hover, .pay_webmoney:hover, .pay_yandex:hover, .pay_nal:hover, .pay_sberbank:hover, .pay_alfa:hover, .pay_psbank:hover {border: 2px solid #13c165; box-shadow: none!important; border-radius: 0!important; cursor: pointer; }
				
				.pay_sposob_pay_link {margin: 0px 0px 30px 0px; width: 145px; height: 90px; display: inline-block; font-size: 14px; text-align: center; line-height: 25px;}
				
				.pay_button {position: relative; margin-top: 15px; color: #2c2e2d; font-size: 18px; padding: 10px 12px; background: #fff; border: 2px solid #13c165; margin-right: 15px; text-align: center; cursor: pointer; display: block;}
				.pay_button:hover {background: #13c165; color: white;}
				.pay_agree_text {margin: 29px 0px 0px 0px;}
				.pay_agree_text a {color: #1f2122; text-decoration: none; border-bottom: 1px dashed #1f2122;}
				.pay_agree_text a:hover {color: #1f2122; text-decoration: none; border-bottom: 1px solid #1f2122;}
				.right_block {width: 250px; background: #f2f3f4;}
				
				.pay_check_zagolovok {position: relative; margin: 0px 0px 5px 0px; font-family: sans-serif, Arial; font-size: 24px; font-weight: bold;}
				.pay_seller {position: relative; margin: 10px 0px 0px 0px; font-family: sans-serif, Arial; font-size: 16px; font-weight: bold; color: #1f2122;}
				.pay_seller_name {position: relative; margin: 10px 0px 15px 0px; font-family: sans-serif, Arial; font-size: 16px; font-weight: normal; color: #1f2122;}
				.pay_tovar_zagolovok {position: relative; margin: 10px 0px 15px 0px; font-family: sans-serif, Arial; font-size: 16px; font-weight: bold; color: #1f2122;}
				.pay_tovar_name {position: relative; margin: 10px 0px 15px 0px; font-family: sans-serif, Arial; font-size: 16px; font-weight: normal; color: #1f2122;}
				.pay_itogo {position: relative; margin: 10px 0px 5px 0px; font-family: sans-serif, Arial; font-size: 16px; font-weight: bold; color: #1f2122;}
				.pay_cena {position: relative; margin: 10px 0px 15px 0px; font-family: sans-serif, Arial; font-size: 24px; font-weight: bold; color: #1f2122;}
				.pay_comment {position: relative; margin: 10px 0px 15px 0px; font-family: sans-serif, Arial; font-size: 16px; font-weight: normal; color: gray;}
				.pay_footer_text {margin: 20px auto; width: 90%; font-family: sans-serif, Arial; font-size: 16px; font-weight: normal; color: #1f2122; text-align: center;}

				.link {color: #1f2122; text-decoration: none; border-bottom: 1px dashed #1f2122;}
				.link:hover {color: #1f2122; text-decoration: none; border-bottom: 1px solid #1f2122;}

				#parent_popup, #parent_popup_click {background-color: rgba(0, 0, 0, 0.8); display: none; position: fixed; z-index: 99999; top: 0; right: 0; bottom: 0; left: 0;}
				#popup, #popup_click {background: #fff; max-width: 600px; width: 600px; margin: 150px auto; padding: 10px 0px 10px 0px; border: 10px solid #ddd; position: relative; -webkit-box-shadow: 0px 0px 20px #000; -moz-box-shadow: 0px 0px 20px #000; box-shadow: 0px 0px 20px #000;}
				.closebutton {background-color: #fecc0f; border: 2px solid #ccc; height: 24px; line-height: 23px; position: absolute; right: -24px; cursor: pointer; text-align: center; text-decoration: none; color: black; font-size: 14px; font-family: helvetica, arial; text-shadow: 0 -1px rgba(0, 0, 0, 0.9); top: -24px; width: 24px; -moz-box-shadow: 1px 1px 3px #000; -webkit-box-shadow: 1px 1px 3px #000; box-shadow: 1px 1px 3px #000;}
				.close:hover {background-color: rgba(255, 69, 0, 1);}				
				</style>
				</head>
				<body>
				
					<div id="parent_popup_click">
						<div id="popup_click">
							<div style="overflow-y: auto; height: 350px; padding: 0px 20px 0px 20px; margin: 0px 0px 0px 0px;">

								<p><b>ОФЕРТА НА ОКАЗАНИЕ УСЛУГ ПОКУПАТЕЛЯМ <?php echo $settings_zagolovok; ?></b></p>
								<p>Дата вступления в силу: «10» мая 2015 г.</p>
								<p>Настоящий документ (далее – Оферта) определяет порядок предоставления информационных услуг, а также взаимные права, обязанности и порядок взаимоотношений между Торговой Площадкой <?php echo $settings_zagolovok; ?>, именуемым в дальнейшем «Исполнитель», и дееспособным совершеннолетним потребителем информационных услуг, приобретающим или приобретшим товар с использованием сайта <?php echo $settings_zagolovok; ?>, принявшим Оферту и именуемым в дальнейшем «Покупатель».</p>
								<p>
								<b>1. ТЕРМИНЫ</b><br />
								В рамках Оферты применимы следующие термины:<br />
								1.1. Сайт – совокупность результатов интеллектуальной деятельности (программа для ЭВМ, фото, видео и пр.), при помощи которых Исполнитель оказывает информационные услуги в рамках Оферты.<br /> 
								1.2. Сервисы Сайта – функциональные возможности, службы, услуги, инструменты, обеспечиваемые программным обеспечением Сайта и доступные для Пользователей. Исполнитель вправе самостоятельно и без уведомления Пользователей изменять Сервисы Сайта и их функциональные особенности.<br />
								1.3. Товар – услуги и/или товары, предлагаемые к продаже на Сайте. Товары разделяются на типы: цифровой товар, физический товар, услуга, подписка (доступ), пин-код (лицензия). <br />
								1.4. Администратор – физическое лицо, представитель Исполнителя, имеющий полномочия принимать решения по жалобам Покупателей. Администратор руководствуется в своей деятельности внутренним убеждением и не несет ответственности за действия пользователей Сайта. Связь с Администратором осуществляется через тикеты техподдержки или используя контактную информацию на сайте <?php echo $settings_zagolovok; ?>.<br />
								1.5. Контент – результаты интеллектуальной деятельности, составляющие информационное наполнение Сайта.<br />
								1.6. Пользователь – зарегистрированное на Сайте дееспособное совершеннолетнее физическое лицо.<br />
								1.7. Рекламодатель – Пользователь Сайта, разместивший информацию о Товаре на Сайте, и ответственный за исполнение сделки купли-продажи Товара (оказания услуг) с Покупателем.<br />
								1.8. Аккаунт – личный кабинет (раздел на Сайте) Пользователя, посредством которого осуществляется управление продажами Товаров.
								</p>
								<p>
								<b>2. ОБЩИЕ ПОЛОЖЕНИЯ</b><br />
								2.1. Оферта является документом в понимании статьи 435 Гражданского кодекса РФ.<br />
								2.2. Действия Покупателя, направленные на приобретение Товара (заполнение формы на Сайте, оплата Товара), свидетельствует об акцепте, то есть полном согласии Покупателя с Офертой.<br />
								2.3. Положения Пользовательского соглашения применимы в рамках Оферты.<br />
								2.4. На Сайте заключаются сделки между Рекламодателем, разместившим Товар, и Покупателем. Сайт, а равно и Исполнитель, не являются ни платежной системой, ни оператором электронных денежных средств в понимании Федерального закона РФ от 27.06.2011 № 161-ФЗ (ред. от 29.12.2014) «О национальной платежной системе».<br />
								2.5. Исполнитель имеет право в любое время изменять условия Оферты в одностороннем порядке. Покупатель обязуется самостоятельно ознакомиться с действующей редакцией Оферты, доступной любому Покупателю при выражении его намерения приобрести Товар.<br />
								2.6. Покупатель соглашается на получение от Исполнителя рекламной и иной информации по электронной почте, указанной на Сайте. 
								</p>
								<p>
								<b>3. ПРЕДМЕТ ОФЕРТЫ</b><br />
								3.1. Исполнитель оказывает Покупателю информационные услуги по предоставлению доступа к информации о Товарах и возможности их оплатить, а Покупатель обязуется принять услуги. Услуги оказываются бесплатно, если Сервисами Сайта не предусмотрено иное.<br />
								3.2. Исполнитель вправе без согласования с Покупателем привлекать третьих лиц для оказания услуг по Оферте, оставаясь ответственным за их действия перед Покупателем. Указанное в настоящем пункте не относится к взаимоотношениям Покупателей и Рекламодателей по факту исполнения последними обязательств по реализации Товаров.
								</p>
								<p>
								<b>4. ОПЛАТА</b><br />
								4.1. Покупатель перечисляет Рекламодателю денежные средства через системы приема платежей «Яндекс Касса» (https://kassa.yandex.ru/). Акцепт Оферты означает полное и безоговорочное принятие Покупателем условий перевода платежей выбранной им системы.<br />
								4.2. При возникновении на вышеуказанных сайтах технических проблем и/или конфликтных ситуаций при оплате Товара Покупатель обязуется самостоятельно урегулировать такие конфликты с администрацией соответствующего сайта.<br />
								4.3. Исполнитель не отвечает за последствия отклонения платежа вышеуказанными системами и за своевременность перечисления ими оплаты Товара. Товар считается оплаченным с момента поступления денежных средств в распоряжение Исполнителя.<br />
								4.4. Цены на Товары устанавливаются Рекдамодателями.
								</p>
								<p>
								<b>5. ОГРАНИЧЕНИЕ ОТВЕТСТВЕННОСТИ</b><br />
								5.1. Исполнитель не несет ответственности за качество размещаемых Рекламодателями Товаров. Модерация Товаров является правом, но не обязанностью Исполнителя.<br />
								5.2. Покупатель обязуется самостоятельно разрешать непосредственно с Рекламодателем споры, связанные с исполнением сделки, заключенной с использованием Сайта.<br />
								5.3. Покупатель вправе направить Администратору жалобу (отрицательный отзыв) на недобросовестные действия Рекламодателя. При этом, Покупатель соглашается с тем, что Администратор предпринимает все возможные меры к урегулированию спорной ситуации на правах посредника, однако, за качество Товаров, добросовестность Рекламодателя, Администратор ответственности не несет.<br />
								5.4. Исполнитель отвечает за своевременный перевод Рекламодателю суммы, уплаченной за Товар, за исключением случаев действия непреодолимой силы (в том числе технических неисправностей в работе Сайта), а также противоправных и/или недобросовестных действий третьих лиц. С момента передачи Рекламодателю суммы, уплаченной за Товар, услуги считаются оказанными Исполнителем и принятыми Покупателем.<br />
								5.5. Если к моменту получения Исполнителем денежных средств в счет оплаты Товара Аккаунт Рекламодателя окажется заблокированным, Исполнитель возвращает Покупателю уплаченную им сумму в течение 14 (четырнадцати) банковских дней.<br />
								5.6. Покупатель отвечает за достоверность и актуальность сообщаемых Исполнителю данных и несет все риски, связанные с указанием неточной информации. Персональные данные Покупателя обрабатываются исключительно в целях выполнения Исполнителем своих обязательств по Оферте и в соответствии с Политикой использования данных.<br />
								5.7. Покупатель понимает и безоговорочно соглашается с тем, что пользуется услугами исключительно на свой страх и риск и что услуги предоставляются Покупателю на условиях «как есть» и «как доступно», а именно: Исполнитель не заявляет и не гарантирует, что<br />
								- услуги будут соответствовать требованиям Покупателя;<br />
								- услуги будут предоставляться непрерывно, своевременно, безопасно и без ошибок;<br />
								- любая информация, полученная Покупателем в результате использования услуг, будет точной и надежной;<br />
								- дефекты в работе или функциональных возможностях какого-либо программного обеспечения в составе Сайта, будут исправлены в ожидаемый Покупателем срок;<br />
								- загрузка любых материалов и их получение иным способом с помощью Сайта выполняется по собственному усмотрению Покупателя на его страх и риск;<br />
								- советы или информация в устной или письменной форме, полученные Покупателем от Пользователей или с помощью услуг, не предоставляют каких-либо гарантий, не выраженных явно в данных условиях.<br />
								5.8. Принимая положения Оферты, Покупатель осознает и безоговорочно соглашается с тем, что Исполнитель не несет перед Покупателем ответственности за:<br />
								какие-либо прямые, косвенные, случайные, специальные, опосредованные и штрафные убытки, понесенные Покупателем, в процессе использования Сайта. К таким убыткам относится, помимо прочего, упущенная выгода (как прямая, так и косвенная), ущерб деловой репутации и прочие виды нематериального ущерба, потеря данных, затраты на приобретение заменяющих товаров или услуг;<br />
								какие-либо убытки или причиненный Покупателю ущерб, в том числе убытки и ущерб в результате расчета Покупателя на полноту, точность или достоверность какой-либо рекламной информации или же в результате сотрудничества или сделки между Покупателем и Рекламодателем или каким-либо рекламодателем/спонсором, рекламные материалы которого Покупатель получил в результате использования Сайта.<br />
								5.9. Ограничение ответственности Исполнителя действует вне зависимости от того, было ли Исполнителю известно о возможном ущербе Покупателя.<br />
								5.10. Размещая на Сайте Контент, оставляя отзывы, Покупатель обязуется придерживаться законодательства РФ. При нарушении условий настоящего пункта Покупателем, Исполнитель сохраняет за собой право удалить любую информацию, размещенную Покупателем, без предварительного уведомления последнего.<br />
								5.11. В любом случае ответственность Исполнителя в соответствии со статьей 15 Гражданского кодекса Российской Федерации ограничена суммой, эквивалентной стоимости приобретенного Товара/Товаров, но не более 10 000 (Десяти тысячи) рублей и возлагается на Исполнителя при наличии в его действиях вины.
								</p>
								<p>
								<b>6. ПОРЯДОК РАССМОТРЕНИЯ ПРЕТЕНЗИЙ И СПОРОВ</b><br />
								6.1. Все разногласия или споры, которые могут возникнуть между сторонами Оферты должны разрешаться в досудебном порядке путем переговоров, направления претензионных писем. Срок ответа на претензию – 10 (Десять) рабочих дней. Претензии Покупателя по Оферте принимаются и рассматриваются Исполнителем только в письменном виде.<br />
								6.2. К отношениям сторон по Оферте применяется законодательство РФ.<br />
								6.3. Если согласие по каким-либо причинам не будет достигнуто в ходе досудебного урегулирования, спор, вытекающий из Оферты, подлежит рассмотрению в суде РФ.
								</p>
								<p align=center><a class="link" href="#" onclick="document.getElementById('parent_popup_click').style.display='none';">Закрыть окно</a></p>							
							
								<a class="closebutton" title="Закрыть" onclick="document.getElementById('parent_popup_click').style.display='none';">X</a>
							</div>
						</div>
					</div>				
				
					<table class="pay_mainwindow">
						<tr>
							<td>
								<div class="pay_mainzagolovok">Оформление заказа</div>
								<div class="pay_offername"><?php echo $offer_name; ?></div>
								<form action="<?php echo $settings_url.'/finances.php'; ?>" method="post">
									<?php 
									if (isset($_POST['name']) || isset($_POST['phone']) || isset($_POST['email'])) {echo '<div class="pay_contactzagolovok">Контактная информация:</div>';}
									if (isset($_POST['name']) && $_POST['name']!='') {?><div class="pay_rekvizit">Ваше имя</div><input type="text" name="name" class="pay_input" value="<?php echo htmlentities($_POST['name']); ?>"><br /><?php }
									if (isset($_POST['phone']) && $_POST['phone']!='') {?><div class="pay_rekvizit">Телефон</div><input type="text" name="phone" class="pay_input" value="<?php echo htmlentities($_POST['phone']); ?>"><br /><?php }
									if (isset($_POST['email']) && $_POST['email']!='') {?><div class="pay_rekvizit">Электронная почта</div><input type="text" name="email" class="pay_input" value="<?php echo htmlentities($_POST['email']); ?>"><br /><?php }
									?>
									
									<script>
									function uncheck()
										{
										document.getElementById('pay_card').style.border='2px solid #d6dfe9';
										document.getElementById('pay_webmoney').style.border='2px solid #d6dfe9';
										document.getElementById('pay_yandex').style.border='2px solid #d6dfe9';
										document.getElementById('pay_nal').style.border='2px solid #d6dfe9';
										document.getElementById('pay_sberbank').style.border='2px solid #d6dfe9';
										document.getElementById('pay_alfa').style.border='2px solid #d6dfe9';
										document.getElementById('pay_psbank').style.border='2px solid #d6dfe9';
										document.getElementById('pay_warning').style.display='none';
										}
									</script>
									
									<div class="pay_sposobzagolovok">Выберите способ оплаты:</div>
									<div class="pay_sposob_pay_link"><div class="pay_card" id="pay_card" onclick="document.getElementById('paymentType').value='AC'; uncheck(); document.getElementById('pay_card').style.border='2px solid black';"></div>Пластиковые карты</div>
									<div class="pay_sposob_pay_link"><div class="pay_webmoney" id="pay_webmoney" onclick="document.getElementById('paymentType').value='WM'; uncheck(); document.getElementById('pay_webmoney').style.border='2px solid black';"></div>WebMoney</div>
									<div class="pay_sposob_pay_link"><div class="pay_yandex" id="pay_yandex" onclick="document.getElementById('paymentType').value='PC'; uncheck(); document.getElementById('pay_yandex').style.border='2px solid black';"></div>Яндекс.Деньги</div>
									<div class="pay_sposob_pay_link"><div class="pay_nal" id="pay_nal" onclick="document.getElementById('paymentType').value='GP'; uncheck(); document.getElementById('pay_nal').style.border='2px solid black';"></div>Наличные</div>
									<div class="pay_sposob_pay_link"><div class="pay_sberbank" id="pay_sberbank" onclick="document.getElementById('paymentType').value='SB'; uncheck(); document.getElementById('pay_sberbank').style.border='2px solid black';"></div>Сбербанк Онлайн</div>
									<div class="pay_sposob_pay_link"><div class="pay_alfa" id="pay_alfa" onclick="document.getElementById('paymentType').value='AB'; uncheck(); document.getElementById('pay_alfa').style.border='2px solid black';"></div>Альфаклик</div>
									<div class="pay_sposob_pay_link"><div class="pay_psbank" id="pay_psbank" onclick="document.getElementById('paymentType').value='PB'; uncheck(); document.getElementById('pay_psbank').style.border='2px solid black';"></div>Промсвязьбанк</div>
									<div class="pay_warning" id="pay_warning">Выберите способ оплаты, кликнув по названию подходящей вам системы</div>
									<input type="hidden" name="amount" value="<?php echo $offer_cena; ?>">
									<input type="hidden" name="paysys" value="<?php if ($settings_paysystem_landings=='1') {echo 'yk';} ?>">
									<input type="hidden" name="paymentType" id="paymentType" value="">
									<input type="hidden" name="partnerlink" value="<?php echo $paystroka; ?>">
									<input type="button" name="submit_paylanding" class="pay_button" id="submit_payform" value="Перейти к оплате" onclick="if (document.getElementById('paymentType').value=='') {document.getElementById('pay_warning').style.display='block';} else {document.getElementById('submit_payform').type='submit';}">
									<?php					
									if (isset($_POST['address']) && $_POST['address']!='') {?><input type="hidden" name="address" value="<?php echo htmlentities($_POST['address']); ?>"><?php }
									if (isset($_POST['kolvo']) && $_POST['kolvo']!='') {?><input type="hidden" name="kolvo" value="<?php echo htmlentities($_POST['kolvo']); ?>"><?php }
									if (isset($_POST['artikul']) && $_POST['artikul']!='') {?><input type="hidden" name="artikul" value="<?php echo htmlentities($_POST['artikul']); ?>"><?php }
									if (isset($_POST['comments']) && $_POST['comments']!='') {?><input type="hidden" name="comments" value="<?php echo htmlentities($_POST['comments']); ?>"><?php }
									?>
									<div class="pay_agree_text">Нажимая кнопку «Перейти к оплате», Вы принимаете <a href="javascript:void(0)" onclick="document.getElementById('parent_popup_click').style.display='block';">условия сервиса</a>.</div>
								</form>
							</td>
							<td class="right_block">
								<div class="pay_check_zagolovok">Виртуальный чек</div>
								<div class="pay_seller">Продавец:</div>
								<div class="pay_seller_name"><?php if ($owner_name!='') {echo $owner_name;} else {echo $owner_email;} ?></div>
								<div class="pay_tovar_zagolovok">Товар:</div>
								<?php
								if (file_exists('../tmp/offer'.$offer_id.'.jpg')) 
									{?><img style="width: 200px; height: 200px; margin: 0; padding: 0; border: 0; text-decoration: none;" src="<?php echo $settings_url.'/tmp/offer'.$offer_id.'.jpg'; ?>"><?php }
								else 
									{?><div style="width: 200px; height: 200px; margin: 0px; padding: 0; border: 1px solid gray; text-decoration: none;"></div><?php }
								?>
								<div class="pay_tovar_name"><?php echo $offer_name; ?></div>
								<div class="pay_itogo">Итого:</div>
								<div class="pay_cena"><?php echo $offer_cena; ?> руб.</div>
								<div class="pay_comment">Данный чек не надо печатать или сохранять - Вам придет копия на электронную почту.<br /><br />В зависимости от выбранного вами способа оплаты, может взиматься дополнительная комиссия платежной системы.</div>
							</td>
						</tr>
					</table>
					<div class="pay_footer_text">Рекламная сеть <?php echo $settings_zagolovok; ?></div>
				</body>
			</html>
			<?php
			}
		} else {echo 'Вы не завершили подключение к торговой площадке. Возможно, Ваша площадка все еще на модерации.';}
	} else {echo 'Вы не завершили подключение к торговой площадке. Возможно, Ваша площадка все еще на модерации.';}
	
?>