<? require "db.php"; ?>
<html>
	<head>
		<title>Right Sidebar - Helios by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="right-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
					<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="index.html" id="logo">Личный кабинет

								</a></h1>
							</header>
						</div>


					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.html">Главная</a></li>
								<li>
									<a href="#">Создать задание</a>
									<ul>
										<li><a href="#">Курьерские услуги</a>
<ul>
												<li><a href="#">Услуги курьера на автомобиле</a></li>
												<li><a href="#">Услуги пешего курьера</a></li>
												<li><a href="#">Купить и доставить</a></li>
												<li><a href="#">Что-то другое</a></li>
											</ul>
										</li>
										<li><a href="#">Ремонт и строительство</a>
										<ul>
												<li><a href="#">Ремонт под ключ</a></li>
												<li><a href="#">Мастер на час</a></li>
												<li><a href="#">Отделочные работы</a></li>
												<li><a href="#">Что-то другое</a></li>
											</ul>
										</li>
										<li><a href="#">Компьютерная помощь</a>
										<ul>
												<li><a href="#">Ремонт ПК и ноутбуков</a></li>
												<li><a href="#">Установка и удаление программ и вирусов</a></li>
												<li><a href="#">Консультация</a></li>
												<li><a href="#">Что-то другое</a></li>
											</ul>
										</li>
										<li>
											<a href="#">Красота и здоровье</a>
											<ul>
												<li><a href="#">Парикмахерские услуги</a></li>
												<li><a href="#">Массаж</a></li>
												<li><a href="#">Косметология</a></li>
												<li><a href="#">Персональный тренер</a></li>
											</ul>
										</li>
										<li><a href="#">Юридическая помощь</a>
											<ul>
												<li><a href="#">Юридическая консультация</a></li>
												<li><a href="#">Составление договоров и пр.</a></li>
												<li><a href="#">Оформление документов</a></li>
												<li><a href="#">Что-то другое</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li><a href="left-sidebar.html">Все задания</a></li>
								<li><a href="blog.html">Блог</a></li>
								<li><a href="no-sidebar.html">Отзывы пользователей</a></li>
								<li><a href="kontacts.html">Контакты</a></li>
									<li><a href="lich.html">Личный Кабинет</a></li>
							</ul>
						</nav>

				</div>
				<body>
<center>
<?php 

$data = $_POST;
if( isset($data['do_login']) )
{
	$errors = array();
	$user = R::findOne('users', "login = ?", $array = array($data['login']));
	if( $user )
	{
		if( password_verify($data['password'], $user->password) )
		{
			$_SESSION['logged_user'] = $user;
			

			
			echo '<div style="color: green;">Вы успешно авторизованы.<br>Можете перейти на <a href="lich.php"> cтраницу </a> личного кабинета </div><hr>';
		} else
		{
			$errors[] = 'Невернй введён пароль!';
		}
	} else
	{
		$errors[] = 'Пользователь с таким логином не найден!';
	}
	if( ! empty($errors) )
	{
		echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}
}
?>

<form action="login.php" method="POST">

<p>
 <p><strong>Ваш логин</strong>:</p>
 <input type="text" id="name" class="txt" placeholder="Введите ваш логин" name="login" value="<?php echo @$data['login']; ?>">
</p>

<p>
 <p><strong>Ваш пароль</strong>:</p>
 <input type="password" id="password" class="txt" placeholder="Введите ваш пароль" name="password" value="<?php echo @$data['password']; ?>">
</p>

<p>
 <button type="submit" name="do_login">Войти</button>
</p>

</form>
		<!-- Footer -->
					<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">

							<!-- Tweets -->
							<h2>Что заказывают на << Do and Earn >> прямо сейчас</h2>
								<section class="4u 12u(mobile)">
									
									<ul class="divided">
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Цена на замену труб - до 20000 Р
</a></h3>
												</header>
												<span class="timestamp">1 мин. назад</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Плотник с перфоратором - 4000 Р</a></h3>
												</header>
												<span class="timestamp">2 мин. назад</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Нужна газель или портер - 1500 Р</a></h3>
												</header>
												<span class="timestamp">2 мин. назад</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Малярные работа - до 100000 Р</a></h3>
												</header>
												<span class="timestamp">3 мин. назад</span>
											</article>
										</li>
									</ul>
								</section>

							<!-- Posts -->
								<section class="4u 12u(mobile)">
									
									<ul class="divided">
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Нужен менеджер продаж - 500 Р
</a></h3>
												</header>
												<span class="timestamp">4 мин. назад</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Уборка в квартире - 2000 Р</a></h3>
												</header>
												<span class="timestamp">4 мин. назад</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Нужен курьер срочно  - 500 Р</a></h3>
												</header>
												<span class="timestamp">5 мин. назад</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Ремонт швейной машины - 1000 Р</a></h3>
												</header>
												<span class="timestamp">5 мин. назад</span>
											</article>
										</li>
									</ul>
								</section>

							<!-- Photos -->
								<section class="4u 12u(mobile)">
									
										<div class="6u$">
											<a href="#" class="image fit"><img src="images/a1.png" alt="" /></a>
										</div>
										
										<div class="6u$">
											<a href="#" class="image fit"><img src="images/a2.png" alt="" /></a>
										</div>
										
										<div class="6u$">
											<a href="#" class="image fit"><img src="images/a3.png" alt="" /></a>
										</div>
									</div>
								</section>

						</div>
						<hr />
						<div class="row">
							<div class="12u">

								<!-- Contact -->
									<section class="contact">
										<header>
											<h3>ГРАФИК РАБОТЫ</h3>
										</header>
										<p>Call-центр — с 06:00 до 24:00 без выходных.<br> Оформление заявок на сайте и их исполнение происходит круглосуточно.</p>
										<ul class="icons">
											<p> Присоединяйтесь к нам!</p>
											<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
											<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
											<li><a href="#" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
											<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
											<li><a href="#" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
										</ul>
									</section>

								<!-- Copyright -->
									<div class="copyright">
										<ul class="menu">
											<li>&copy; D$E Corp 2018. All rights reserved.</li><li>Делай и зарабатывай корпорация 2018.Все права защищены</li>
										</ul>
									</div>

							</div>

						</div>
					</div>
				</div>

		</div>
</center>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.onvisible.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>