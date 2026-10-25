<?php
$to = 'aliveliyev93@gmail.com';

$subject = 'test';

$headers = "From: " . strip_tags('office@aliveliyev.com') . "\r\n";
$headers .= "Reply-To: ". strip_tags('office@aliveliyev.com') . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8";
$message = '<html>
<head>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:600" rel="stylesheet">
<style>
	div { box-sizing: border-box; display: block; float: left;}
	.smail_body { max-width: 800px; background: #fff6d7; padding: 50px 30px; font-family: "Cormorant Garamond", serif; }
	h1, h2 { color: #0075c3; }
	.smail_preview {
		border-top: 3px solid #fff;
		border-right: 3px solid #fff;
		border-bottom: 3px solid #fff;
		position: relative;
		padding-top: 50px;
		padding-bottom: 0px;
		margin-bottom: 50px;
	}
	.smail_heading {
		position: absolute;
		top: -50px;
		width: 80%;
		left: 10%;
		background: #fff6d7;
	}
	.smail_name {
		position: absolute;
		right: 0;
	    width: 240px;
	    top: 150px;
	    text-align: center;
	    z-index: 3;
	}
	.smail_slide:before {
		content: "";
		width: 90%;
    	height: 337px;
		position: absolute;
		background: rgba(255,255,255,.5);
	}
	.smail_heading_ft {
		position: absolute;
		bottom: -25px;
		width: 90%;
		background: #fff6d7;
		height: 50px;
	}
	.smail_heading_rt {
		position: absolute;
		right: -10px;
		top: 150px;
		width: 30px;
		background: #fff6d7;
		height: 130px;
	}
	.smail_descr {
		width: 90%;
		text-align: justify;
	} 
	.prtf_hd {
		background: #cdc5ac;
		width: 100%;
		text-align: center;
		padding: 5px;
		letter-spacing: 4px;
	}
	.hlf {
		width: 50%;
		float: left;
		margin: 50px 0px;
		border-radius: 15px;
		margin-bottom: 0px;
	}
	.hlf p {
		background: #fff;
		margin: 0px;
		padding: 15px;
		min-height: 70px;
	}
	.hlf img {
		width: 100%;
	}
	.hlf:nth-child(2n) {
		padding-left: 25px;
	}
	.hlf:nth-child(2n+1) {
		padding-right: 25px;
	}
	.infop {
		text-align: center;
	}
	.grad1 {
		margin-bottom: 20px !important;
		background: linear-gradient(45deg, rgba(46, 49, 146, .5), rgba(27, 255, 255, .5)) !important;
	}
	.grad2 {
		background: linear-gradient(45deg, rgba(142, 120, 255, .5), rgba(252, 125, 123, .5)) !important;
	}
	.grad3 {
		margin-bottom: 20px !important;
		background: linear-gradient(45deg, rgba(251, 135, 43, .5), rgba(217, 224, 33, .5)) !important;
	}
	.grad4 {
		background: linear-gradient(45deg, rgba(0, 146, 69, .5), rgba(181, 255, 255, .5)) !important;
	}
	.mob { display: none; }
	@media (max-width: 768px) {
		.hlf {
			width: 100% !important;
			padding: 0px !important;
		}
		.smail_slide:before {
    		height: 248px;
    	}
    	.smail_heading {
    		width: 103% !important;
    		left: 0 !important;
    	}
    	h1 {
    		font-size: 18px;
    	}
    	.smail_preview {
    		padding-top: 30px;
    	}
    	.mob { display: block !important }
    	.pc { display: none; }
    	.smail_name {
		    right: -40px;
		    top: 100px;
		}
		.smail_heading_rt {
		    right: -10px;
		    top: 100px;
		}
		.smail_heading_ft {
    		bottom: -30px;
    	}
	}
</style>
</head>
<body>
	<div class="smail_body">
	<div class="smail_preview">
		<div class="smail_heading">
			<h1 style="line-height: 40px; letter-spacing: 5px; text-align: center;"><img src="https://uborka-domov-msk.ru/userfiles/mail/artboard---1.png" style="height: 40px; width: auto;"> КРИСТАЛЛ СЕРВИС</h1>
		</div>
		<div class="smail_name">
			<h2 style="letter-spacing: 5px; text-align: center;">ПАМЯТКА О ПРАВИЛЬНОЙ ХИМЧИСТКЕ</h2>
		</div>
		<div class="smail_slide">
			<img src="https://uborka-domov-msk.ru/userfiles/mail/path-150.png" class="pc" style="width: 90%;">
			<img src="https://uborka-domov-msk.ru/userfiles/mail/path-150-1.png" class="mob" style="width: 90%;">
		</div>
		<div class="smail_descr">
			<p>Наша компания "Кристалл Сервис" профессионально занимается чисткой мягкой мебели. За несколько лет работы был приобретен большой опыт по чистке мягкой мебели из самых различных материалов, начиная с простых мебельных тканей и заканчивая дорогими материалами, такими как алькантара и кожа.</p>
		</div>
		<div class="smail_heading_ft">
		</div>
		<div class="smail_heading_rt">
		</div>
	</div>
	<div class="prtf_hd">
		<p>На фото ниже несколько примеров наших работ</p>
	</div>
	<div class="hlf">
		<img src="https://uborka-domov-msk.ru/userfiles/mail/20180713-110349.png">
		<p>Диван был испачкан кровью, наиболее сложноудаляемый тип пятен (по практике).</p>
	</div>
	<div class="hlf">
		<img src="https://uborka-domov-msk.ru/userfiles/mail/20180713-141016.png">
		<p>Диван после чистки и специализированного удаления пятен. Общее время на чистку и пятноудаление около 3 часов.</p>
	</div>
	<div class="hlf">
		<img src="https://uborka-domov-msk.ru/userfiles/mail/20180524-205917.png">
		<p>Диван с пятном от коктейля виски с колой, общее загрязнение дивана.</p>
	</div>
	<div class="hlf">
		<img src="https://uborka-domov-msk.ru/userfiles/mail/20180524-215549.png">
		<p>Диван после чистки.</p>
	</div>
	<div class="infop">
		<p>Наши специалисты имеют не только большой практический опыт химчистки, а также периодически проходят курсы повышения квалификации (специализированные семинары) по данной тематике, участвуют в специализированных выставках, где знакомятся с последними технологиями в сфере клининга.</p>
		<p>В последнее время участились звонки в компанию с заявками на чистку мебели после ранее выполненных чисток, в связи с их низким качеством, выполненных сторонними специалистами. Например, Клиентка жаловалась на неприятный запах во время и после химчистки, а также на остатки моющих средств на обивке. Другой Клиент жаловался, что в течение нескольких дней не было возможности отдыхать на мебели, в связи с ее долгим высыханием после чистки.</p>
		<p>Учитывая большое предложение на рынке услуг химчистки мебели, мы решили подготовить для Вас на основе полученного опыта практических работ и теоретических знаний, чек лист по правильной химчистке. Данный чек лист сформирован для того, чтобы на этапе выбора клининговой компании или частного специалиста, Вы могли оценить их возможности по качественному выполнению химчистки Вашей мебели и помочь сделать Вам правильный выбор.</p>
	</div>
	<div class="prtf_hd">
		<p>Чек лист по правильной химчистке</p>
	</div>
	<div class="hlf">
		<p>Какое оборудование должно быть у специалиста по химчистке?</p>
		<p class="grad1">• Пылесос<br>
• Экстрактор (моющий пылесос)<br>• Комплект моющих средств<br>
• Воздуходувка (желательно)</p>
		<p>Какие обязательные проверки до начала процедуры чистки должен выполнить специалист по химчистке?</p>
		<p class="grad2">• Перед выполнением чистки необходимо уточнить материал обивки. В большинстве случаев все данные по материалу обивки как правило утеряны. В таких случаях будет необходим тест материала обивки. Данная процедура необходима для определения возможности чистки обивки влажным методом, т.к. много современных тканей не терпят большое количество воды и могут дать усадку при высыхании.<br><br>
• Перед выполнением чистки обязательно должен делаться тест воздействия моющего средства на материал обивки. Данная процедура необходима для определения стойкости окраски обивки во избежание линьки, потери цвета материала при химчистке.<br><br>
• Выбор способа чистки делается только в результате оценки по п.3. Способы чистки могут быть разными: сухая, влажная, с пре- спреем.</p>
	</div>
	<div class="hlf">
		<p>Что входит в комплект моющих средств и какой инвентарь у специалиста должны быть с собой?</p>
		<p class="grad3">• Комплект моющих средств. Комплект включает в себя, как минимум 2 вида шампуня (нейтрального и щелочного типа). А также моющее средство для пре-спрея.<br>
• Нейтрализующее средство, для устранения остаточной щелочности после моющего раствора<br>
• Несколько видов пятновыводителей (для различных видов пятен)<br>
• Щетки с мягким и жестким ворсом или портативная орбитальная машинка (для больших объемов работ)<br>
• Стек для очистки твердых загрязнений<br>
• Помповый распылитель
</p>
		<p>Какая методика выполнения химчистки?</p>
		<p class="grad4">• Сначала выполняется тщательная вакуумная чистка пылесосом обивки мебели<br>
			• Пятновыведение<br>
• Выполнение основной чистки обивки выбранным методом<br>
• Обязательная нейтрализация моющего средства на обивке и промывка обивки от моющего раствора<br>
• Принудительная сушка обивки с помощью воздуходувки</p>
	</div>
	<div class="infop">
		<p>Обычно чистка 3 местного дивана средней загрязненности без сложных пятен, с соблюдением вышеуказанной технологии длится около 2-2,5 часов и не может быть выполнена за меньшее время. Время на сушку мебели закладывается дополнительно. Хотя мы часто пользуемся технологией, которая позволяет значительно сократить общее время готовности изделия вместе с сушкой.</p>
		<p>Таковы кратко, основные моменты по выполнению химчистки. Если у Вас появились вопросы или Вам необходимо обсудить некоторые моменты Вы всегда можете задавать вопросы на <a href="https://uborka-domov-msk.ru/himchistka-myagkoj-mebeli-na-&#10;domu/divana/">странице</a> в нашем блоге, посвященном качеству химчистки. Мы рады будем оказать Вам помощь в решении Ваших проблем. Вскоре мы планируем выпуск дополнительных материалов по тому как должна выполняться качественная химчистка.</p>
		<p>Мы подробно раскроем основные моменты из чек листа, такие как:</p>
		<p>• Какое оборудование и почему должно быть у специалиста по химчистке? Как оборудование может влиять на качество чистки?</p>
		<p>• Какие моющие средства и инвентарь должны быть у специалиста по химчистке и почему? В чем основные отличия различных моющих средств?</p>
		<p>Задавайте вопросы, комментируйте в нашем блоге посвященному качеству химчистки на <a href="https://uborka-domov-msk.ru/himchistka-myagkoj-mebeli-na-&#10;domu/divana/">странице</a>. Спасибо, что уделили внимание нашей информации по качеству химчистки мебели.</p>
		<p><a href="{{unsubscribe_url}}">Отписаться от рассылки</a></p>
	</div>
</div></body></html>';

mail($to, $subject, $message, $headers);
?>