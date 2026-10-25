<?php
$show_breadcrumbs = !(($this->module == 'default') && ($this->action == 'index'));

if(isset($this->params['showmode'])){
	setcookie('cat_showmode', $this->params['showmode'], 0, '/');
}

$config = json_decode(base64_decode($this->template_cfg['tpl_config_hidden']), true);
$header = $config['header'];
$footer = $config['footer'];
$corner = $this->ShowBlock('fixedcorner');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<?php echo $this->MyHeadTitle();?>
		<?php echo $this->MyHeadMeta();?>
    <?php echo $this->MyHeadLink();?>
    <?php echo $this->MyHeadScript();?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=1020, maximum-scale=1.5, initial-scale=0.8, user-scalable=yes" />
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter47033223 = new Ya.Metrika({
                    id:47033223,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/47033223" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	</head>
  
	<body>
		<?php if($corner != ''):?>
			<div class="fixed_block_wrap fixed_block-fixedcorner">
				<div class="fixed_block">
					<?php echo $corner;?>
				</div>
			</div>
		<?php endif;?>
		<div class="header">
			<?php foreach($header as $section => $blocks):?>
				<div class="h_<?php echo $section;?>">
					<div class="h_wrap">
						<?php foreach($blocks as $block):?>
							<?php foreach($block as $key => $val):?>
								<div class="h_<?php echo $key;?>_wrap h_<?php echo $key;?>-<?php echo $val;?>">
									<div class="h_<?php echo $key;?>">
										<?php
											if($key == 'menu'){
												echo $this->ShowMenu($val, 'h_menu-ul');
											} elseif($key == 'block'){
												echo $this->ShowBlock($val);
											} elseif($key == 'system'){
												echo $this->ShowSysBlock($val);
											}
										?>
									</div>
								</div>
							<?php endforeach;?>
						<?php endforeach;?>
						<div class="clearfix"></div>
					</div>
				</div>
			<?php endforeach;?>
      <?php //include ROOT_PATH.'/templates/'.USER_TEMPLATE.'/catalog_main_menu.tpl'; ?>
		</div>
		
		<div class="wrapper">
			<div class="push-h"></div>
			<div class="c_prewrap">
				<div class="c_wrap c_page-<?php echo $this->module;?>-<?php echo $this->action;?>">
					<?php if($show_breadcrumbs):?>
						<div class="c_breadcrumbs">
							<div class="c_page-wrap">
								<?php echo $this->ShowBreadcrumbs('<span class="c_breadcrumbs-separator"></span>');?>
							</div>
						</div>
					<?php endif;?>
					<div class="c_content">
						<?php
							echo $this->layout()->content;
						?>
					</div>
				</div>
			</div>
			<div class="push-f"></div>
		</div>
		
		<div class="footer">
			<?php foreach($footer as $section => $blocks):?>
				<div class="f_<?php echo $section;?>">
					<div class="f_wrap">
						<?php foreach($blocks as $block):?>
							<?php foreach($block as $key => $val):?>
								<div class="f_<?php echo $key;?>_wrap f_<?php echo $key;?>-<?php echo $val;?>">
									<div class="f_<?php echo $key;?>">
										<?php
											if($key == 'menu'){
												echo $this->ShowMenu($val, 'f_menu-ul');
											} elseif($key == 'block'){
												echo $this->ShowBlock($val);
											} elseif($key == 'system'){
												echo $this->ShowSysBlock($val);
											}
										?>
									</div>
								</div>
							<?php endforeach;?>
						<?php endforeach;?>
						<div class="clearfix"></div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<?php echo $this->ShowBlock('counter'); ?>
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
<script>
$(function(){
  var p = 0;
  if (localStorage.getItem('modal') == 1) p = 1;
  setTimeout(function() {
    if (p == 0) {
      $(".marquiz__container__holder").css('display', 'flex');
      $(".marquiz__container").show();
      localStorage.setItem('modal', 1);
      p=2;
    }
  }, 20000);
  setTimeout(function() {
    if (p==2) {
    $(".marquiz__container__holder").css('display', 'none');
    $(".marquiz__container").hide();
    localStorage.setItem('modal', 1);
    }
  }, 32000);
  var k = 0;
  setInterval(function() {
    if (k%2==1) { $(".callback").html('<img src="/phone.png" style="width: 80%;">'); k++; }
    else { $(".callback").html('Получить консультацию специалиста'); k++; }
    localStorage.setItem('modal', 1);
  }, 3000);
  $(".callback").on('click', function(){
    $(".marquiz__container__holder").css('display', 'flex');
    $(".marquiz__container").show();
    localStorage.setItem('modal', 1);
    p=1;
  });
  $(".close").on('click', function(){
    $(".marquiz__container__holder").css('display', 'none');
    $(".marquiz__container").hide();
    $(".marquiz__container2").hide();
    $(".marquiz__container3").hide();
    $(".marquiz__container4").hide();
    $(".marquiz__container5").hide();
  });
  $("#sb1").on('click', function() {
    $.ajax({
      url: '/mail1.php',
      method: 'post',
      data: {
        name: $("#n1").val(),
        phone: $("#p1").val(),
        address: $("#a1").val(),
        email: $("#e1").val(),
        tp: $("#tp1").val()
      },
      dataType: 'json',
      success: function(data) {
        $(".marquiz__container2").hide();
        $(".marquiz__container3").show();
      }
    });
    return false;
  });
  $("#sb2").on('click', function() {
    $.ajax({
      url: '/mail2.php',
      method: 'post',
      data: {
        name: $("#n2").val(),
        phone: $("#p2").val(),
        email: $("#e2").val(),
        info: $("#i2").val(),
        tp: $("#tp2").val()
      },
      dataType: 'json',
      success: function(data) {
        $(".marquiz__container4").hide();
        $(".marquiz__container3").show();
      }
    });
    return false;
  });
  $("#sb3").on('click', function() {
    $.ajax({
      url: '/mail3.php',
      method: 'post',
      data: {
        name: $("#n3").val(),
        phone: $("#p3").val(),
        time: $("#t3").val(),
        tp: $("#tp3").val()
      },
      dataType: 'json',
      success: function(data) {
        $(".marquiz__container5").hide();
        $(".marquiz__container3").show();
      }
    });
    return false;
  });
});
</script>

<div class="marquiz__container__holder">
  <div class="marquiz__container" style="font-family: Oswald;">
    <a class="close">Закрыть</a>
    <h3 style="text-align: center;">Хотите получить скидку - закажите обратный звонок</h3>
    <ul>
      <li onclick="$('.marquiz__container').hide(); $('.marquiz__container2').show();">Заказать бесплатный осмотр объекта</li>
      <li onclick="$('.marquiz__container').hide(); $('.marquiz__container4').show();">Оставить заявку на подбор оборудования</li>
      <li onclick="$('.marquiz__container').hide(); $('.marquiz__container5').show();">Обратный звонок</li>
    </ul>
    <h3 style="text-align: center; color: #000;">Поможем в выборе кондиционера</h3>
  </div>
  <div class="marquiz__container2" style="font-family: Oswald;">
    <a class="close">Закрыть</a>
    <h3 style="text-align: center; color: #000;">Заказать бесплатный осмотр объекта</h3>
    <form>
      <input type="hidden" id="tp1" value="Заказать бесплатный осмотр объекта">
      <input type="text" name="name1" placeholder="Имя" id="n1">
      <input type="text" name="phone1" placeholder="Телефон" id="p1">
      <input type="text" name="mail2" placeholder="E-mail" id="e1">
      <input type="text" name="address1" placeholder="Адрес" id="a1">
      <input type="submit" value="Оставить заявку" id="sb1">
    </form>
  </div>
  <div class="marquiz__container4" style="font-family: Oswald;">
    <a class="close">Закрыть</a>
    <h3 style="text-align: center; color: #000;">Оставьте заявку и мы подготовим самое выгодное предложение</h3>
    <form>
      <input type="hidden" id="tp2" value="Оставить заявку на подбор оборудования">
      <input type="text" name="name2" placeholder="Имя" id="n2">
      <input type="text" name="phone2" placeholder="Телефон" id="p2">
      <input type="text" name="mail2" placeholder="E-mail" id="e2">
      <textarea name="info2" id="i2" placeholder="Информация"></textarea>
      <input type="submit" value="Оставить заявку" id="sb2">
    </form>
  </div>
  <div class="marquiz__container5" style="font-family: Oswald;">
    <a class="close">Закрыть</a>
    <h3 style="text-align: center; color: #000;">Обратный звонок</h3>
    <form>
      <input type="hidden" id="tp3" value="Обратный звонок">
      <input type="text" name="name3" placeholder="Имя" id="n3">
      <input type="text" name="phone3" placeholder="Телефон" id="p3">
      <input type="text" name="time3" placeholder="Удобное время" id="t3">
      <input type="submit" value="Оставить заявку" id="sb3">
    </form>
  </div>
  <div class="marquiz__container3" style="font-family: Oswald;">
    <h3 style="text-align: center; color: #000;">Большое спасибо, Ваш запрос принят. Мы свяжемся с Вами в ближайшее время.</h3>
    <a href="#" onclick="$('.marquiz__container__holder').css('display', 'none');;
    $('.marquiz__container3').hide();" style="width: 100%; margin: 0 auto; display: block; text-align: center; height: 35px; color: red; border:  none; padding: 5px;">Закрыть</a>
  </div>

</div>

<style>
  .marquiz__container__holder {
    position: fixed;
      width: 100%;
      height: 100vh;
      display: flex;
      top: 0;
      left: 0;
      justify-content: center;
      flex-direction: column;
      display: none;
      z-index: 1000;
  }
  .marquiz__container__holder h3 {
    font-size: 30px;
    color: red;
  }
  .marquiz__container__holder li {
    font-size: 15px;
  }
  .marquiz__container {
    background: #f1f1f1;
    background-size: cover;
      width: 480px;
      height: auto;
      margin: 0 auto;
      padding: 50px 20px;
      box-shadow: 0px 0px 5px 2px #333;
      display: none;
      position: relative;
  }
  .close {
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
  }
  .marquiz__container2 {
    background: #f1f1f1;
    background-size: cover;
      width: 350px;
      height: auto;
      margin: 0 auto;
      padding: 50px;
      box-shadow: 0px 0px 5px 2px #333;
      display: none;
      position: relative;
  }
  .marquiz__container3 {
    background: #f1f1f1;
    background-size: cover;
      width: 350px;
      height: auto;
      margin: 0 auto;
      padding: 50px;
      box-shadow: 0px 0px 5px 2px #333;
      display: none;
      position: relative;
  }
  .marquiz__container4 {
    background: #f1f1f1;
    background-size: cover;
      width: 350px;
      height: auto;
      margin: 0 auto;
      padding: 50px;
      box-shadow: 0px 0px 5px 2px #333;
      display: none;
      position: relative;
  }
  .marquiz__container5 {
    background: #f1f1f1;
    background-size: cover;
      width: 350px;
      height: auto;
      margin: 0 auto;
      padding: 50px;
      box-shadow: 0px 0px 5px 2px #333;
      display: none;
      position: relative;
  }
  .marquiz__button {
      color: #00a2e6 !important;
      background: none !important;
      border: 3px solid #00a2e6 !important;
      font-size: 11px !important;
      border-radius: 0px !important;
      box-shadow: 0 0 1px 2px #00a2e6 !important;
      text-transform: uppercase !important;
      padding: 15px !important;
      float: right;
  }
  .marquiz__button:hover {
      color: #00a2e6 !important;
  }
  .marquiz__container ul li {
    width: 80px;
    list-style:  none;
    display: flex;
    float: left;
    border: 6px solid red;
    height: 80px;
    border-radius: 80px;
    text-align: center;
    flex-direction:  column;
    align-items:  center;
    justify-content:  center;
    margin: 10px;
    padding: 20px;
    cursor: pointer;
  }
  .marquiz__container ul li:hover {
    background: red;
    color:#fff;
  }
  .marquiz__container ul {
    width: 100%;
    display: flex;
    box-sizing: border-box;
    flex-direction: row;
    align-items: center;
    justify-content: center;
  }
  .marquiz__container2 input[type='text'] {
    width: 240px;
    height: 30px;
    padding: 5px;
    font-size:  18px;
    margin: 10px;
  }
  .marquiz__container2 form {
    width: 275px;
    margin: 0 auto;
  }
  .marquiz__container2 input[type='submit'] {
    width: 250px;
    margin: 10px;
    height: 35px;
    background: red;
    color: #fff;
    border:  none;
    padding: 5px;
  }
  .marquiz__container4 input[type='text'] {
    width: 240px;
    height: 30px;
    padding: 5px;
    font-size:  18px;
    margin: 10px;
  }
  .marquiz__container4 textarea  {
    width: 240px;
    height: 80px;
    padding: 5px;
    font-size:  18px;
    margin: 10px;
  }
  .marquiz__container4 form {
    width: 275px;
    margin: 0 auto;
  }
  .marquiz__container4 input[type='submit'] {
    width: 250px;
    margin: 10px;
    height: 35px;
    background: red;
    color: #fff;
    border:  none;
    padding: 5px;
  }
  .marquiz__container5 input[type='text'] {
    width: 240px;
    height: 30px;
    padding: 5px;
    font-size:  18px;
    margin: 10px;
  }
  .marquiz__container5 form {
    width: 275px;
    margin: 0 auto;
  }
  .marquiz__container5 input[type='submit'] {
    width: 250px;
    margin: 10px;
    height: 35px;
    background: red;
    color: #fff;
    border:  none;
    padding: 5px;
  }
  .h_block-getcallback {
    width: 200px;
    margin-left: 350px;
  }
  .callback {
    width: 110px;
    height: 110px;
    border: 3px solid red;
    display: flex;
    border-radius: 80px;
    padding: 10px;
    text-align: center;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    font-size: 20px;
    margin: 0 auto;
    color: #fff;
    text-shadow: 1px 1px 4px red;
    cursor: pointer;
  }
</style>
	</body>
</html>
