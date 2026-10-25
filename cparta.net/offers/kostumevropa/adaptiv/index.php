<?php 
   $offer = 22;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>

<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<meta charset="utf-8">
	<title>Спортивные костюмы</title>
	<meta name="description" content="">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/bootstrap-grid.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/media.css">
	<script src="libs/modernizr/modernizr.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

	<div id="wrapper">
		
		<header>
			<div class="container clearfix">
				<div class="row">
					<div class="col-lg-8">
						<ul class="left_mnu">
							<li><a class="scroll" href="#sec_3">Каталог</a></li>
							<li><a class="scroll" href="#size">Размер</a></li>
							<li><a class="scroll" href="#sec_5">Отзывы</a></li>
							<li><a class="scroll" href="#sec_9">Как сделать заказ</a></li>
						</ul>
					</div>
					<div class="col-lg-4">
						<div class="right_block">
							<div class="left">
							 
							</div>
							<a href="#sec_10" class="scroll top_btn">Заказать</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="header-mobile">
			<div class="container clearfix">
				<nav id="nav-wrap">
					<ul id="nav">
						<li><a class="scroll" href="#sec_3">Каталог</a></li>
						<hr class="nav-hr">
						<li><a class="scroll" href="#size">Размер</a></li>
						<hr class="nav-hr">
						<li><a class="scroll" href="#sec_5">Отзывы</a></li>
						<hr class="nav-hr">
						<li><a class="scroll" href="#sec_9">Как сделать заказ</a></li>
					</ul>
				</nav>
				<a href="#sec_10" class="top_btn scroll right">заказать</a>
			</div>
		</div>




		<div id="sec_1">
			<div class="container clearfix">
				<img src="img/sales.png" alt="">
				<h1>Спортивные костюмы <span>футбольных клубов Европы</span></h1>
				<div class="priced_head clearfix">
					<a href="#sec_10" class="buy_now scroll">Купить прямо сейчас</a>
					<p class="h_price"><span>5980</span> <?php echo $price['real_price']; ?></p>
				</div>
				<img src="img/clubs.png" class="clubs" alt="">
			</div>
		</div>

		<div id="sec_2">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="pre_item">
							<div class="squared"><img src="img/icons/ic_11.png" alt=""></div>
							<p>Доставка по всей России</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="pre_item">
							<div class="squared"><img src="img/icons/ic_12.png" alt=""></div>
							<p>Приятные цены</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="pre_item">
							<div class="squared"><img src="img/icons/ic_13.png" alt=""></div>
							<p>Премиальное качество</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="sec_3">
			<div class="container">
				<h2>Каталог</h2>

				<div class="catalog">
					<div class="row">
						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-1" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК Бавария');document.getElementById('comments').value = 'Спортивный костюм ФК Бавария';"><img src="img/catalog/1/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК Бавария</p>
										<p class="suit_color">Синий/белые полоски</p>
										<p class="sale_text">Скидка сегодня 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-2" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК Милан');document.getElementById('comments').value = 'Спортивный костюм ФК Милан';"><img src="img/catalog/2/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК Милан</p>
										<p class="suit_color">Белый</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-3" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК Милан');document.getElementById('comments').value = 'Спортивный костюм ФК Милан';"><img src="img/catalog/3/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК Милан</p>
										<p class="suit_color">Красный/черные полоски</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-4" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК ПСЖ');document.getElementById('comments').value = 'Спортивный костюм ФК ПСЖ';"><img src="img/catalog/4/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК ПСЖ</p>
										<p class="suit_color">Белый</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-5" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК Барселона');document.getElementById('comments').value = 'Спортивный костюм ФК Барселона';"><img src="img/catalog/5/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК Барселона</p>
										<p class="suit_color">Черный/красная полоска</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-6" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК Реал');document.getElementById('comments').value = 'Спортивный костюм ФК Реал';"><img src="img/catalog/6/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК Реал</p>
										<p class="suit_color">Черный</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-7" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК Арсенал');document.getElementById('comments').value = 'Спортивный костюм ФК Арсенал';"><img src="img/catalog/7/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК Арсенал</p>
										<p class="suit_color">Черный</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-8" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК МЮ');document.getElementById('comments').value = 'Спортивный костюм ФК МЮ';"><img src="img/catalog/8/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК МЮ</p>
										<p class="suit_color">Синий</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-9" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК МЮ');document.getElementById('comments').value = 'Спортивный костюм ФК МЮ';"><img src="img/catalog/9/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК МЮ</p>
										<p class="suit_color">Оранжевый</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="cat_item">
								<a href="#modal-item-10" class="modal_open" onclick="$('.firt_name_cat').text('Спортивный костюм ФК Ювентус');document.getElementById('comments').value = 'Спортивный костюм ФК Ювентус';"><img src="img/catalog/10/1.jpg"></a>
								<div class="cat_text">
									<div class="col-lg-7">
										<p class="sportsuite">Спортивный костюм</p>
										<p class="club_name">ФК Ювентус</p>
										<p class="suit_color">Белый/синие полоски</p>
										<p class="sale_text">Скидка 50%</p>
									</div>
									<div class="col-lg-5">
										<p class="old_pr">5980 Руб</p>
										<p class="new_pr"><?php echo $price['real_price']; ?></p>
										<a href="#sec_10" class="scroll buyed">Купить</a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<a class="overlay" id="modal-item-1"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/1/1.jpg" alt=""></div>
						<div><img src="img/catalog/1/2.jpg" alt=""></div>
						<div><img src="img/catalog/1/3.jpg" alt=""></div>
						<div><img src="img/catalog/1/4.jpg" alt=""></div>
						<div><img src="img/catalog/1/5.jpg" alt=""></div>
						<div><img src="img/catalog/1/6.jpg" alt=""></div>
						<div><img src="img/catalog/1/7.jpg" alt=""></div>
						<div><img src="img/catalog/1/8.jpg" alt=""></div>
						<div><img src="img/catalog/1/9.jpg" alt=""></div>
						<div><img src="img/catalog/1/10.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/1/1.jpg" alt=""></div>
						<div><img src="img/catalog/1/2.jpg" alt=""></div>
						<div><img src="img/catalog/1/3.jpg" alt=""></div>
						<div><img src="img/catalog/1/4.jpg" alt=""></div>
						<div><img src="img/catalog/1/5.jpg" alt=""></div>
						<div><img src="img/catalog/1/6.jpg" alt=""></div>
						<div><img src="img/catalog/1/7.jpg" alt=""></div>
						<div><img src="img/catalog/1/8.jpg" alt=""></div>
						<div><img src="img/catalog/1/9.jpg" alt=""></div>
						<div><img src="img/catalog/1/10.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Синий</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post">
<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						<p class="right_now">Закажи прямо сейчас</p>
						    

     
						<input type="text" name="name" placeholder="Ваше имя" required >
						<input type="text" name="phone" placeholder="Ваш телефон" required>
							  

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-2"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/2/1.jpg" alt=""></div>
						<div><img src="img/catalog/2/2.jpg" alt=""></div>
						<div><img src="img/catalog/2/3.jpg" alt=""></div>
						<div><img src="img/catalog/2/4.jpg" alt=""></div>
						<div><img src="img/catalog/2/5.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/2/1.jpg" alt=""></div>
						<div><img src="img/catalog/2/2.jpg" alt=""></div>
						<div><img src="img/catalog/2/3.jpg" alt=""></div>
						<div><img src="img/catalog/2/4.jpg" alt=""></div>
						<div><img src="img/catalog/2/5.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Белый</p>
					</div>

					<form method="post"  class="modal_form clearfix" action="./_success_/" method="post">
						<p class="right_now">Закажи прямо сейчас</p>
						    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

     
						<input type="text" name="name" placeholder="Ваше имя" required >
						<input type="text" name="phone" placeholder="Ваш телефон" required >

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-3"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/3/1.jpg" alt=""></div>
						<div><img src="img/catalog/3/2.jpg" alt=""></div>
						<div><img src="img/catalog/3/3.jpg" alt=""></div>
						<div><img src="img/catalog/3/4.jpg" alt=""></div>
						<div><img src="img/catalog/3/5.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/3/1.jpg" alt=""></div>
						<div><img src="img/catalog/3/2.jpg" alt=""></div>
						<div><img src="img/catalog/3/3.jpg" alt=""></div>
						<div><img src="img/catalog/3/4.jpg" alt=""></div>
						<div><img src="img/catalog/3/5.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Красный</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post">
						<p class="right_now">Закажи прямо сейчас</p>
						    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
  
    						<input type="text" name="name" placeholder="Ваше имя" required >
						<input type="text" name="phone" placeholder="Ваш телефон" required>
						    
						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-4"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for-1 compressed">
						<div><img src="img/catalog/4/11.jpg" alt=""></div>
						<div><img src="img/catalog/4/2.jpg" alt=""></div>
						<div><img src="img/catalog/4/3.jpg" alt=""></div>
					</div>

					<div class="slider-nav-1">
						<div><img src="img/catalog/4/11.jpg" alt=""></div>
						<div><img src="img/catalog/4/2.jpg" alt=""></div>
						<div><img src="img/catalog/4/3.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Белый</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post">
						<p class="right_now">Закажи прямо сейчас</p>
						    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

    						<input type="text" name="name" placeholder="Ваше имя" required >
						<input type="text" name="phone" placeholder="Ваш телефон" required>

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-5"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for-1 compressed">
						<div><img src="img/catalog/5/11.jpg" alt=""></div>
						<div><img src="img/catalog/5/2.jpg" alt=""></div>
						<div><img src="img/catalog/5/3.jpg" alt=""></div>
					</div>

					<div class="slider-nav-1">
						<div><img src="img/catalog/5/11.jpg" alt=""></div>
						<div><img src="img/catalog/5/2.jpg" alt=""></div>
						<div><img src="img/catalog/5/3.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Черный</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post">
						<p class="right_now">Закажи прямо сейчас</p>
						   <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" /> 
    
    						<input type="text" name="name" placeholder="Ваше имя" required>
						<input type="text" name="phone" placeholder="Ваш телефон" required>

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-6"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/6/1.jpg" alt=""></div>
						<div><img src="img/catalog/6/2.jpg" alt=""></div>
						<div><img src="img/catalog/6/3.jpg" alt=""></div>
						<div><img src="img/catalog/6/4.jpg" alt=""></div>
						<div><img src="img/catalog/6/5.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/6/1.jpg" alt=""></div>
						<div><img src="img/catalog/6/2.jpg" alt=""></div>
						<div><img src="img/catalog/6/3.jpg" alt=""></div>
						<div><img src="img/catalog/6/4.jpg" alt=""></div>
						<div><img src="img/catalog/6/5.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Черный</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post">
						<p class="right_now">Закажи прямо сейчас</p>
						   <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" /> 

    						<input type="text" name="name" placeholder="Ваше имя" required>
						<input type="text" name="phone" placeholder="Ваш телефон" required>

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-7"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/7/1.jpg" alt=""></div>
						<div><img src="img/catalog/7/2.jpg" alt=""></div>
						<div><img src="img/catalog/7/3.jpg" alt=""></div>
						<div><img src="img/catalog/7/4.jpg" alt=""></div>
						<div><img src="img/catalog/7/5.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/7/1.jpg" alt=""></div>
						<div><img src="img/catalog/7/2.jpg" alt=""></div>
						<div><img src="img/catalog/7/3.jpg" alt=""></div>
						<div><img src="img/catalog/7/4.jpg" alt=""></div>
						<div><img src="img/catalog/7/5.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Черный</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post">
						<p class="right_now">Закажи прямо сейчас</p>
						    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
 
    						<input type="text" name="name" placeholder="Ваше имя" required>
						<input type="text" name="phone" placeholder="Ваш телефон" required>

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-8"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/8/1.jpg" alt=""></div>
						<div><img src="img/catalog/8/2.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/8/1.jpg" alt=""></div>
						<div><img src="img/catalog/8/2.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Синий</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post">
						<p class="right_now">Закажи прямо сейчас</p>
						    <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />

    						<input type="text" name="name" placeholder="Ваше имя" required>
						<input type="text" name="phone" placeholder="Ваш телефон" required>

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-9"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/9/1.jpg" alt=""></div>
						<div><img src="img/catalog/9/2.jpg" alt=""></div>
						<div><img src="img/catalog/9/3.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/9/1.jpg" alt=""></div>
						<div><img src="img/catalog/9/2.jpg" alt=""></div>
						<div><img src="img/catalog/9/3.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Оранжевый</p>
					</div>

					<form  method="post" class="modal_form clearfix" action="./_success_/" method="post">
						<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						<p class="right_now">Закажи прямо сейчас</p>
						    
   
    						<input type="text" name="name" placeholder="Ваше имя" required>
						<input type="text" name="phone" placeholder="Ваш телефон" required>

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		<a class="overlay" id="modal-item-10"></a>
		<div class="popup">
			<div id="form_1" class="clearfix">
				<div class="slider_item clearfix">
					<div class="slider-for">
						<div><img src="img/catalog/10/1.jpg" alt=""></div>
						<div><img src="img/catalog/10/2.jpg" alt=""></div>
						<div><img src="img/catalog/10/3.jpg" alt=""></div>
						<div><img src="img/catalog/10/4.jpg" alt=""></div>
						<div><img src="img/catalog/10/5.jpg" alt=""></div>
						<div><img src="img/catalog/10/6.jpg" alt=""></div>
						<div><img src="img/catalog/10/7.jpg" alt=""></div>
						<div><img src="img/catalog/10/8.jpg" alt=""></div>
						<div><img src="img/catalog/10/9.jpg" alt=""></div>
					</div>

					<div class="slider-nav">
						<div><img src="img/catalog/10/1.jpg" alt=""></div>
						<div><img src="img/catalog/10/2.jpg" alt=""></div>
						<div><img src="img/catalog/10/3.jpg" alt=""></div>
						<div><img src="img/catalog/10/4.jpg" alt=""></div>
						<div><img src="img/catalog/10/5.jpg" alt=""></div>
						<div><img src="img/catalog/10/6.jpg" alt=""></div>
						<div><img src="img/catalog/10/7.jpg" alt=""></div>
						<div><img src="img/catalog/10/8.jpg" alt=""></div>
						<div><img src="img/catalog/10/9.jpg" alt=""></div>
					</div>
				</div>
				
				<div class="card_right">
					<p class="firt_name_cat">
					<div class="date">
						<p><span>Материал:</span> 90% хлопок, 10% эластан</p>
						<p><span>Уход:</span> машинная стирка</p>
						<p><span>Производитель:</span> Россия</p>
						<p><span>Цвет:</span> Белый</p>
					</div>

					<form method="post" class="modal_form clearfix" action="./_success_/" method="post"><input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
						<p class="right_now">Закажи прямо сейчас</p>
						    
   
    						<input type="text" name="name" placeholder="Ваше имя" required>
						<input type="text" name="phone" placeholder="Ваш телефон" required>

						<div class="form_price"><p class="price_cat"><span>5980 Руб</span> <?php echo $price['real_price']; ?></p> <button type="submit">купить</button></div>
					</form>
				</div>
			</div>
			<a class="close" title="Закрыть" href="#close"></a>
		</div>

		

		<div id="sec_5">
			<div class="container">
				<h2>Отзывы</h2>
				<div class="feed_wrap">
					<div class="row">
						<div class="col-lg-4">
							<div class="feed_container">
								<div class="centered"><img src="img/o_1.png" alt="img"></div>
								<p class="feed_text">
									Качество на высоте. Костюм смотрится просто здорово!!! Советую всем своим друзьям к покупке))
								</p>
								<p class="name_feed">Николай <span>Чита</span></p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="feed_container">
								<div class="centered"><img src="img/o_2.png" alt="img"></div>
								<p class="feed_text">
									Отличная вещь! Просто бомба! Качество на высоте. Даже не к чему придраться. На рост 175, вес 84 брал L. Сел, как по мне шит. Спасибо! 
								</p>
								<p class="name_feed">Евгений <span>Нижний Новгород</span></p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="feed_container">
								<div class="centered"><img src="img/o_3.png" alt="img"></div>
								<p class="feed_text">
									Качество костюма хорошее, размер взял XL, чуть свободный и удобный.
								</p>
								<p class="name_feed">Сергей <span>Омск</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="size">
			<div class="container">
				<h2>Размеры</h2>
				<p>Измерьте саниметром объем груди, объем талии и объем бедер.<br> Запишите результаты, сравните и выберите в таблице свой размер</p>
				<img src="img/size.jpg" alt="Размер">
			</div>
		</div>

		<div id="sec_6">
			<div class="container">
				<h2>Ответы на вопросы</h2>
				<div class="section vertical">
					<ul class="tabs clearfix">
						<li class="current">Могу ли я померить костюм перед покупкой?</li>
						<li>Где производят данные костюмы?</li>
						<li>Почему у костюмов такая низкая цена?</li>
						<li>Сколько по времени будет идти мой заказ?</li>
					</ul>

					<div class="box visible">
						<p>Посмотреть и примерить костюм перед оплатой в отделениях почты России нельзя. К сожалению, это условия самой Почты России.</p>
					</div>

					<div class="box">
						<p>Костюмы производятся на фабрике в Италии. В Россию костюмы поставляются напрямую от производителя. Наша компания является официальным поставщиком. Поэтому покупая у нас, Вы получите оригинальный товар.
						</p>
					</div>

					<div class="box">
						<p>Цена на костюмы ниже рыночной, так как мы сейчас распродаем модели прошлогодних коллекций. В прошлом году цена была в несколько раз выше. Сейчас мы активно работаем над новой коллекцией, и прошлогодние модели распродаем по себестоимости.</p>
					</div>

					<div class="box">
						<p>Заказ можно будет получить   до 7  дней.Заказы отправляются почтой России. Мы доставляем товар в любой уголок России, даже самые отдаленный!</p>
					</div>

				</div>
			</div>
		</div>

		<div id="sec_7">
			<div class="container">
				<h2>что вы получите?</h2>
				<div class="circle">
					<p>СОСТАВ:<br>Хлопок, эластан,<br>(спортивная сетка)</p>
					<p>СТИЛЬ<br>Комфорт и удобство таких костюмов выгодно сочетается со стильным и привлекательным видом.</p>
					<p>ТЕХНОЛОГИИ<br>материалы, отводящие влагу, и в зависимости от погодных условий, позволяет телу не переохлаждаться зимой и не перегреваться летом.</p>
					<p>ЛЕГКОСТЬ<br>Также материалы одежды обладают прочностью и легкостью, что для спортсменов очень важно.</p>
				</div>
			</div>
		</div>

		<div id="sec_8">
			<div class="container">
				<div class="insta_req">
					<p class="insta_head">Спортивные костюмы</p>
					<p class="insta_profile"> </p>
				</div>
 	
			</div>
		</div>

		<div id="sec_9">
			<div class="container clearfix">
				<h2>как мы работаем</h2>
				<div class="row">
					<div class="col-lg-4">
						<div class="how_item clearfix">
							<p class="num_one"><span class="number non">1</span>ЗАКАЗ И ОФОРМЛЕНИЕ</p>
							<p class="num_two">Вы оставляете бесплатную заявку на сайте, наш менеджер связывается с Вами для подтверждения заказа.</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="how_item clearfix">
							<p class="num_one"><span class="number">2</span>Упаковка и отправка</p>
							<p class="num_two">Мы тщательно проверяем, надежно упаковываем и отправляем Ваш заказ.</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="how_item clearfix">
							<p class="num_one"><span class="number">3</span>ПОЛУЧЕНИЕ ЗАКАЗА</p>
							<p class="num_two">Вы оплачиваете заказ при получении</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="sec_10">
			<div class="container">
				<form class="form_bot" method="post" action="./_success_/" method="post">
					<p>оставить заявку</p>
	<input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
    					<input type="text" name="name" placeholder="Ф.И.О." required>
					<input type="text" name="phone" placeholder="Телефон" required>

					<div class="tobot"><button type="submit">Заказать</button></div>
				</form>
			</div>
		</div>

		<footer>
			<div class="container clearfix">
				<div class="row">
				<center><p>ООО ООО «Белый Клык», ИНН 5908035536 ОГРН 1065908029670</p>
<p>
Юридический адрес: 614077, Пермский край, город Пермь, бульвар Гагарина, 70 Б</p> 

    
            <p class="conf-link doclinks">
     
      </p>
 

    
</center>				
			</div>
			</div>
		</footer>












	</div>





    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700|Open+Sans+Condensed:300|Russo+One&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="libs/slick_slider/slick.css">
	<link rel="stylesheet" href="libs/fancybox/jquery.fancybox.min.css">

	<script src="libs/jquery/jquery-2.1.3.min.js"></script>
	<script src="libs/fancybox/jquery.fancybox.min.js"></script>
	<script src="libs/waypoints/waypoints.min.js"></script>
 
	<script src="libs/slick_slider/slick.min.js"></script>
	<script src="js/common.js"></script>
	 

<style>
.form-control {
	display: block;
	max-width: 440px;
	width: 100%;
	height: 72px;
	padding-left: 30px;
	outline: none;
	font-size: 24px;
	font-weight: 600;
	border: none;
	display: block;
	margin:0 auto 20px;
}
</style>

</body>

</html>
