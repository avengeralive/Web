<?php 
   $offer = 78;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">

	<title>Philips</title>
	<meta name="description" content="Philips">

	<meta name="viewport" content="width=device-width">

	<link rel="icon" href="img/favicon.png">
	<meta property="og:image" content="img/@1x/logo.svg">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css">
	<link rel="stylesheet" href="css/styles.min.css">

	<link rel="stylesheet" type="text/css" href="http://giis.co.in/jsfiles/jquery.countdown.css">

</head>

<body>

	<!-- <header>
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<div class="logo">
						<img src="img/_src/logo.png" class="img-responsive" alt="logo">
					</div>
				</div>
				<div class="col-md-5">
					<h1>Электробритва S9000 Prestige</h1>
				</div>
			</div>
		</div>
	</header> -->
	<main>
		<section class="first-section">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div class="logo">
							<img src="img/_src/logo.svg" class="img-responsive" alt="logo">
						</div>
					</div>
					<div class="col-md-10">
						<h1 class="header-title">Электробритва S9000 Prestige</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5 col-md-7">
						<p class="descr-logo">Лучшее от <span>Philips:</span></p>
						<h1>Максимально чисто.</h1>
						<h1>Невероятно комфортно.</h1>
						
						<div class="form">
							<div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
								<p class="title-form"><span>Заказать</span>Бритву</p>
								<p class="price">3490<img src="img/_src/rub.svg" alt="rub"><span>6980<img src="img/_src/rub.svg" alt="rub"></span></p>
							</div>
							
							<div class="timer">
								<p>Акция закончится через:</p>
								
								<div class="clock">
									<!-- <div class="column days">
										<div class="timer" id="days"></div>
										<div class="text">DAYS</div>
									</div>
									<div class="timer days">:</div> -->
									<div class="column">
										<div class="timer" id="hours"></div>
										<!-- <div class="text">HOURS</div> -->
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="minutes"></div>
										<!-- <div class="text">MINUTES</div> -->
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="seconds"></div>
										<!-- <div class="text">SECONDS</div> -->
									</div>
								</div>
								<h2><span class="sub-message"></span></h2>
							</div>
							<p class="descr">Заполните форму, чтобы оформить заказ</p>
							<form action="./_success_/" method="post">
								<div>
									<input type="text" name="name" placeholder="Ваше имя" required>
								</div>
								<div>
									<input type="text" name="phone" placeholder="Ваш телефон" required>
								</div>
								<button type="submit">Оформить заказ</button> 
								<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
								<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
								<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
								<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
								<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
								<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="second-section">
			<div class="container">
				<div class="row">
					<div class="col-md-3 offset-md-2 d-none d-md-block"> <!-- d-none d-md-block-->
						<img src="img/@2x/razor-2-1.png" alt="razor" class="img-responsive">
					</div>
					<div class="col-md-6 offset-md-1">
						<p class="title">Чистое бритье</p>
						<p class="title">Невероятная деликатность</p>
						<img src="img/@2x/razor-2-1.png" alt="razor" class="img-responsive d-block d-md-none small-razor">
						<img src="img/@2x/rating-2-2.png" class="img-responsive" alt="rating">
						<a href="">Читать все отзывы</a>
						<p class="descr">С новой бритвой Philips S9000 Prestige больше никаких компромиссов. Она обеспечивает максимально гладкое бритье и непревзойденный комфорт для кожи.</p>
						<div class="row">
							<div class="col-md-8">
								<a href="#form_buy" class="btn order-btn">Заказать</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="third-section" id="3-section">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-lg-5"> <!-- 5-->
						<p class="title">Высокоточные лезвия<span> NanoTech Precision</span></p>
						<p class="descr">Лезвия покрыты наночастицами углерода, повышающими их износостойкость. Благодаря этому они остаются острыми гораздо дольше, обеспечивая максимально чистое и быстрое бритье.</p>
					</div>
				</div>
			</div>
		</section>
		<section class="fourth-section">
			<div class="container">
				<div class="row">
					<div class="col-md-5 offset-md-7">
						<p class="title">Кольца<span> Superb SkinComfort</span></p>
						<p class="descr">Благодаря специальному покрытию кольца SkinComfort уменьшаютплощадь контакта с кожей,обеспечивая максимально гладкое скольжение без раздражения.</p>
					</div>
					</div>
				</div>
			</div>	
		</section>
		<section class="fifth-section">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<p class="title">Инновационная система<span> BeardAdapt</span></p>
						<p class="descr">Встроенный микропроцессор считывает параметры щетины 15 раз в секунду для поддержания высокой эффективности бритья независимо от жесткости и густоты волос.</p>
					</div>
				</div>
			</div>
		</section>
		<section class="sixth-section">
			<div class="container">
				<div class="row">
					<div class="col-md-5 offset-md-7">
						<p class="title">Панель индукционной зарядки<span> Qi</span></p>
						<p class="descr">Заряжайте бритву без проводов. Просто положите ее на панель беспроводной зарядки.</p>
						<p class="sub-descr">Подходит для других совместимых устройств.</p>
					</div>
				</div>
			</div>
			<div class="container-fluid" style="padding: 0;">
				<div class="consult">
					<div class="container-fluid">
						<div class="row d-flex align-items-center">
							<div class="col-md-4 d-flex align-items-center">
								<h1>Заказать консультацию</h1>
							</div>
							<div class="col-md-8">
								<form action="./_success_/" method="post">
									<div>
										<input type="text" name="name" placeholder="Ваше имя" required>
									</div>
									<div>
										<input type="text" name="phone" placeholder="Ваш телефон" required>
									</div>
									<button type="submit">Консультация</button> 
									<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
									<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
									<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
									<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
									<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
									<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="seventh-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="title">Награды</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<img src="img/_src/adv-7-1.png" alt="adv" class="img-responsive">
					</div>
					<div class="col-md-5 offset-md-1">
						<p class="subtitle">Philips – бренд № 1 в мире по продажам электрических бритв*</p>
						<p class="subdescr">*Источник: Euromonitor International Limited. Исследование электрических бытовых приборов 2018 года, согласно определению категории электрических бритв. Розничные продажи в натуральном выражении по данным 2017 года</p>
					</div>
				</div>
			</div>
		</section>
		<section class="eighth-section" id="8-section">
			<div class="container-fluid" style="padding: 0">
				<div class="swiper-container thumbs">
					<div class="swiper-wrapper">
						
						<div class="swiper-slide">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<p class="title">Обзоры продуктов :<span> о нас пишут</span></p>
									</div>
								</div>

								<div class="row d-flex align-items-center">
									<div class="col-md-5"><img src="img/@2x/review/review-1.png" alt="review"></div>
									<div class="col-md-6 offset-md-1">
										<p class="subtitle">Тестируем гаджеты и компьютерную технику более 25 лет<span> Руслан Шебуков</span></p>
										<p class="subdescr">“Хочу отметить, что весь процесс прошел <span> настолько гладко, будто я не брился, </span> а потерся лицом о кошечку”.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<p class="title">Обзоры продуктов :<span> о нас пишут</span></p>
									</div>
								</div>

								<div class="row d-flex align-items-center">
									<div class="col-md-5"><img src="img/@2x/review/review-2.png" alt="review"></div>
									<div class="col-md-6 offset-md-1">
										<p class="subtitle">Русскоязычное интернет-издание о компьютерной технике, IT и программных продуктах<span> iXBT.com</span></p>
										<p class="subdescr">“В электробритве все-таки самое главное - как она бреет.<span> А бреет новый флагман Philips отлично - ни по качеству, ни по скорости у нас нет ни одной претензии”</span>.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<p class="title">Обзоры продуктов :<span> о нас пишут</span></p>
									</div>
								</div>

								<div class="row d-flex align-items-center">
									<div class="col-md-5"><img src="img/@2x/review/review-3.png" alt="review"></div>
									<div class="col-md-6 offset-md-1">
										<p class="subtitle">Медиахолдинг<span> ”РосБизнесКонсалтинг”</span></p>
										<p class="subdescr">“Сегодня венцом инженерной мысли Philips стала электробритва<span> S900 Prestige </span> - возможно, <span>самая высокотехнологичная электрическая бритва в мире”.</span></p>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<p class="title">Обзоры продуктов :<span> о нас пишут</span></p>
									</div>
								</div>

								<div class="row d-flex align-items-center">
									<div class="col-md-5"><img src="img/@2x/review/review-4.png" alt="review"></div>
									<div class="col-md-6 offset-md-1">
										<p class="subtitle">Деловая газета<span> ”Ведомости”</span></p>
										<p class="subdescr">“Этот девайс, пожалуй, -<span> вершина развития бритвенных технологий. </span> Как тебе такое, <span>Элон Маск?”.</span></p>
									</div>
								</div>
							</div>
						</div>

						<div class="swiper-slide">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<p class="title">Обзоры продуктов :<span> о нас пишут</span></p>
									</div>
								</div>

								<div class="row d-flex align-items-center">
									<div class="col-md-5"><img src="img/@2x/review/review-5.png" alt="review"></div>
									<div class="col-md-6 offset-md-1">
										<p class="subtitle">Мужской журнал<span> GQ</span></p>
										<p class="subdescr">“33 ГЛАВНЫХ ГАДЖЕТА 2018 ГОДА. Эта бритва -<span> Mercedes S-Class среди бритв. </span> Заряжайте той же зарядкой, что и ваш iPhone”.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-pagination"></div>
				</div>

			</div>
		</section>
		<section class="ninth-section" id="9-section">
			<div class="container">
				<div class="row">
					<div class="col-md-10 ml-auto mr-auto">
						<p class="title">Все о бритве S9000 Prestige</p>
						<img src="img/@2x/razor-9-1.png" alt="razor" class="img-responsive">
					</div>
				</div>
				<div class="row d-flex justify-content-around">
					<div class="item">
						<p class="subtitle">150 000</p>
						<span class="subdescr">срезов в минуту</span>
					</div>
					<div class="item">
						<p class="subtitle">72</p>
						<span class="subdescr">сверхточных лезвия</span>
					</div>
					<div class="item">
						<p class="subtitle">7</p>
						<span class="subdescr">Подходит даже для 7-дневной щетины</span>
					</div>
					<div class="item">
						<p class="subtitle">3</p>
						<span class="subdescr">Персональные настройки бритья</span>
					</div>
				</div>
			</div>
		</section>
		<section class="tenth-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="title">Отзывы</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 d-flex flex-row flex-wrap justify-content-center">
						<div class="item">
							<img src="img/@2x/review/man-3-1.png" class="img-responsive" alt="review">
							<div class="descr">
								<p class="subtitle">Игорь</p>
								<p class="subdescr">Пробовал много электробритв, не мог подобрать, но эту электробритва оправдала мои ожидания.</p>
							</div>
							
						</div>
						<div class="item">
							<img src="img/@2x/review/man-3-2.png" class="img-responsive" alt="review">
							<div class="descr">
								<p class="subtitle">Максим</p>
								<p class="subdescr">Буду краток, лучшая электробритва которой я пользоваться.</p>
							</div>
						</div>
						<div class="item">
							<img src="img/@2x/review/man-3-3.png" class="img-responsive" alt="review">
							<div class="descr">
								<p class="subtitle">Егор</p>
								<p class="subdescr">Теперь я знаю какую бритву буду советовать своим друзьям и коллегам.</p>
							</div>
						</div>
						<div class="item">
							<img src="img/@2x/review/man-3-4.png" class="img-responsive" alt="review">
							<div class="descr">
								<p class="subtitle">Василий</p>
								<p class="subdescr">Подарила жена, поначалу думал что бесполезная вещь, но спасибо жене за такой подарок, забыл о раздражении.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="eleventh-section" id="11-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="title">Что входит в комплект бритвы S9000 Prestige?</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 offset-md-1">
						<img src="img/@2x/razor-kit/razor-kit-1.png" alt="razor-kit" class="img-responsive top-img">
					</div>
					<div class="col-md-5 d-flex align-items-center">
						<p class="descr">В комплект бритвы Philips S9000 Prestige (SP9862) входит беспроводная зарядная панель Qi, насадка-стайлер для бороды, щеточка для пилинга лица, а также премиальный жесткий чехол</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 ml-auto mr-auto d-flex flex-row flex-wrap justify-content-between pt-3">
						<div class="item">
							<img src="img/@1x/razor-kit/razor-kit-2.png" alt="razor-kit" class="img-responsive">
							<p class="subtitle">Зарядная панель Qi</p>
							<p class="subdescr">Простота процесса зарядки одним движением</p>
						</div>
						<div class="item">
							<img src="img/@1x/razor-kit/razor-kit-3.png" alt="razor-kit" class="img-responsive">
							<p class="subtitle">Стайлер SmartClick</p>
							<p class="subdescr">Насадка-стайлер помогает подравнивать щетину и делать четкие контуры бороды</p>
						</div>
						<div class="item">
							<img src="img/@1x/razor-kit/razor-kit-4.png" alt="razor-kit" class="img-responsive">
							<p class="subtitle">Премиальный чехол</p>
							<p class="subdescr">Жесткий чехол позволяет брать бритву с собой в поездки, не опасаясь ее повредить</p>
						</div>
						<div class="item">
							<img src="img/@1x/razor-kit/razor-kit-5.png" alt="razor-kit" class="img-responsive">
							<p class="subtitle">Щеточка для пилинга</p>
							<p class="subdescr">Позволяет проводить процедуру очищения кожи для отшелушивания омертвевших клеток и снижает вероятность появление вросших волос</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="twelfth-section" id="form_buy">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 offset-md-2 offset-xl-3 d-none d-md-block">
						<img src="img/@2x/razor-2-1.png" class="img-responsive" alt="razor">
					</div>

					<div class="col-md-6 col-lg-5">
						<div class="form">
							<div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
								<p class="title-form"><span>Заказать</span>Бритву</p>
								<p class="price">3490<img src="img/_src/rub-blue.svg" alt="rub"><span>6980<img src="img/_src/rub-blue.svg" alt="rub"></span></p>
							</div>
							
							<div class="timer timer-top">
								<p>Акция закончится через:</p>
								<h2><span class="sub-message"></span></h2>
								<div class="clock">
									<div class="column">
										<div class="timer" id="hours2"></div>
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="minutes2"></div>
									</div>
									<div class="timer">:</div>
									<div class="column">
										<div class="timer" id="seconds2"></div>
									</div>
								</div>
								<h2><span class="sub-message2"></span></h2>
							</div>
							<p class="descr">Заполните форму, чтобы оформить заказ</p>
							<form action="./_success_/" method="post">
								<div>
									<input type="text" name="name" placeholder="Ваше имя" required>
								</div>
								<div>
									<input type="text" name="phone" placeholder="Ваш телефон" required>
								</div>
								<button type="submit">Оформить заказ</button> 
								<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
								<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
								<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
								<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
								<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
								<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</main>

	<div id="timer"> </div>

	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-2 ml-auto mr-auto">
					<img src="img/@2x/footer-logo.png" alt="footer-logo" class="img-responsive">
				</div>
			</div>
		</div>
		<p>ООО "Лайт-Торг" 344011, Ростовская область, город Ростов-на-Дону, Братский переулок, дом 91/229 ИНН 6165151637 ОГРН 1086165007004</p>
		<a href="docs/politika.pdf" download>политика конфиденциальности</a>
	</footer>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.4/moment-timezone-with-data.js"></script>



	<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://unpkg.com/page-scroll-to-id@1.5.9/jquery.malihu.PageScroll2id.js"></script>
	<!-- <script src="js/jquery.malihu.PageScroll2id.min.js"></script> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.1.2/js/swiper.jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script src="js/scripts.min.js"></script>

</body>
</html>
