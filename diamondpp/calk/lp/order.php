<?php
if ($_POST['fio'] && $_POST['phone']) {
        $curl = curl_init(); //инициализация сеанса
        curl_setopt($curl, CURLOPT_URL, 'https://tel-2.leadvertex.ru/api/admin/addOrder.html?token=1234567'); //урл сайта к которому обращаемся
        //curl_setopt($curl, CURLOPT_HEADER, 1); //выводим заголовки
        curl_setopt($curl, CURLOPT_POST, 1); //передача данных методом POST
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //теперь curl вернет нам ответ, а не выведет
        $postData = array (
            'fio'=>$_POST['fio'], //ФИО
			'utm_source' => $_POST['source'], //первая метка
            'utm_term' => $_POST['term'], //вторая метка
            'utm_medium' => $_POST['medium'], //третья метка
            'utm_content' => $_POST['content'], //Четвертая метка
            'utm_campaign' => $_POST['campaign'], //Пятая метка
            'phone'=>$_POST['phone'], //Телефон
            'quantity '=>'1', //Количество
            'domain'=> $_SERVER['HTTP_REFERER'], //Домен откуда поступил заказ
	        'ip' => $_SERVER[REMOTE_ADDR], //IP адресс
	        'referer' => $_POST['referer'],//Рефер (откуда пришел посетитель)
			'price'=> $_POST['price'], //Цена товара
	        'goods' => [ //Детали товара
                       0 => [
                           'goodID' => $_POST['goodID'], //ID
                           'quantity' => 1, //Количество
                           'price' => $_POST['price'] //Цена
                            ]
                        ],
			'searchButton'=>'get' //это на случай если на сайте, к которому обращаемся проверяется была ли нажата кнопка submit, а не была ли оправлена форма			
            );
        curl_setopt($curl, CURLOPT_POSTFIELDS,    http_build_query($postData));
        curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 5'); //эта строчка как-бы говорит: "я не скрипт, я IE5" :)
        curl_setopt ($curl, CURLOPT_REFERER, $_SERVER["HTTP_REFERER"]); //а вдруг там проверяют наличие рефера
        $res = curl_exec($curl);
        //echo $res;
       /*
        //если ошибка то печатаем номер и сообщение
        if($res)
            echo 'Спасибо! Т.е. мы понимаем, что все ок'; //перед этим его конечно можно обработать всякими str_replace и т.д.
        */
    }
    curl_close($curl);
?> 
<html class="no-js">
  
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
     
      
      <title>Спасибо за покупку! Интернет-магазин уникальных товаров</title>
      
      <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '360863204601787');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=360863204601787&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
     
 

 <script>
  fbq('track', 'Lead');
</script>
    
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144342584-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-144342584-1');
</script>   
    
      
   </head>
   <body>
    
      <canvas id="pixie" width="1366" height="242"></canvas>
      <div class="container">
         <div class="layout">
            <div class="header">
               <div class="limit">
                  <h1 class="uppercase">Благодарим Вас за заказ!<br><br>
                     <span class="yellow">Ваш заказ успешно принят<br> и поставлен в обработку!<br></span>
                  </h1>
                  <p style="color: #fff;">В ближайшее время с вами свяжется оператор для подтверждения заказа. Пожалуйста, включите ваш
                     контактный телефон.
                  </p>
               </div>
            </div>
         </div>
      </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
   <style>
         * {          margin: 0;          padding: 0;          border: 0;          outline: 0;          }          html, body {          height: 100%;          width: 100%;          margin: 0px;          padding: 0px;          }          body {          font-size: 14px;          font-family: Exo2Regular, Arial, Helvetica, sans-serif;          color: #000;          width: 100%;          min-width: 960px;          height: 100%;          margin: 0;          padding: 0;          -webkit-font-smoothing: antialiased;          -ms-text-size-adjust: 100%;          -webkit-text-size-adjust: 100%;          }          .header {          -webkit-background-size: cover;          -o-background-size: cover;          -moz-background-size: cover;          background-size: cover;          min-height: 407px;          padding: 2px 0 5px;          }          h1, h2, h3, h4, h5, h6 {          color: #fff;          font-family: Exo2Regular, Arial, Helvetica, sans-serif;          font-weight: normal;          text-rendering: optimizeLegibility;          }          h1 {          font-size: 40px;          }          .header h1 {          margin: 155px auto 15px;          }          .yellow {          color: #ffaf00;          }          .limit {          width: 960px;          margin: 0 auto;          overflow: hidden;          text-align: center;          }          #pixie          {          position:fixed;          background-color: #164979;          filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#040429', endColorstr='#257EB7',GradientType=0 ); /* IE6-9 */          background: -ms-linear-gradient(top,  #0E2A55 40%,#0E2A55 40%,#1D6196 60%); /* IE10+ */          background: -webkit-gradient(linear, center top, center bottom, from(#040429), to(#257EB7)); /* Chrome, Safari 4+ */          background: -webkit-linear-gradient(center top , #040429, #257EB7) repeat scroll 0 0 rgba(0, 0, 0, 0); /* Chrome 10-25, iOS 5+, Safari 5.1+ */          background:    -moz-linear-gradient(center top , #040429, #257EB7) repeat scroll 0 0 rgba(0, 0, 0, 0); /* Firefox 3.6-15 */          background:      -o-linear-gradient(center top , #040429, #257EB7) repeat scroll 0 0 rgba(0, 0, 0, 0); /* Opera 11.10-12.00 */          background:         linear-gradient(center top , #040429, #257EB7) repeat scroll 0 0 rgba(0, 0, 0, 0); /* Chrome 26, Firefox 16+, IE 10+, Opera 12.10+ */          margin:0;          padding:0;          background-size: 100% 100%;          }          .container{          position: relative;          z-index: 11111;          }
      </style>
	  
	  
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script src="../../docs-assets/js/respond.min.js"></script>
      <![endif]-->
      <script type="text/javascript">
         if (document.location.protocol != 'index.html')
         document.write('\x3Cscript src="http://musecdn2.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
      </script>
	  
	  
      <script>
         function draw() { con.clearRect(0, 0, WIDTH, HEIGHT); for (var e = 0; e < pxs.length; e++) { pxs[e].fade(); pxs[e].move(); pxs[e].draw() } } function Circle() { WIDTH = window.innerWidth; HEIGHT = window.innerHeight; this.s = { ttl: 8e3, xmax: 5, ymax: 2, rmax: 10, rt: 1, xdef: 960, ydef: 540, xdrift: 4, ydrift: 4, random: true, blink: true }; this.reset = function () { this.x = this.s.random ? WIDTH * Math.random() : this.s.xdef; this.y = this.s.random ? HEIGHT * Math.random() : this.s.ydef; this.r = (this.s.rmax - 1) * Math.random() + 1; this.dx = Math.random() * this.s.xmax * (Math.random() < .5 ? - 1 : 1); this.dy = Math.random() * this.s.ymax * (Math.random() < .5 ? - 1 : 1); this.hl = this.s.ttl / rint * (this.r / this.s.rmax); this.rt = Math.random() * this.hl; this.s.rt = Math.random() + 1; this.stop = Math.random() * .2 + .4; this.s.xdrift *= Math.random() * (Math.random() < .5 ? - 1 : 1); this.s.ydrift *= Math.random() * (Math.random() < .5 ? - 1 : 1) }; this.fade = function () { this.rt += this.s.rt }; this.draw = function () { if (this.s.blink && (this.rt <= 0 || this.rt >= this.hl)) this.s.rt = this.s.rt * - 1; else if (this.rt >= this.hl) this.reset(); var e = 1 - this.rt / this.hl; con.beginPath(); con.arc(this.x, this.y, this.r, 0, Math.PI * 2, true); con.closePath(); var t = this.r * e; g = con.createRadialGradient(this.x, this.y, 0, this.x, this.y, t <= 0 ? 1 : t); g.addColorStop(0, "rgba(255,255,255," + e + ")"); g.addColorStop(this.stop, "rgba(77,101,181," + e * .6 + ")"); g.addColorStop(1, "rgba(77,101,181,0)"); con.fillStyle = g; con.fill() }; this.move = function () { WIDTH = window.innerWidth; HEIGHT = window.innerHeight; this.x += this.rt / this.hl * this.dx; this.y += this.rt / this.hl * this.dy; if (this.x > WIDTH || this.x < 0) this.dx *= - 1; if (this.y > HEIGHT || this.y < 0) this.dy *= - 1 }; this.getX = function () { return this.x }; this.getY = function () { return this.y } } var WIDTH; var HEIGHT; var canvas; var con; var g; var pxs = new Array; var rint = 60; $(document).ready(function () { WIDTH = "100%"; HEIGHT = "100%"; $("#container").width(WIDTH).height(HEIGHT); WIDTH = window.innerWidth; HEIGHT = window.innerHeight; canvas = document.getElementById("pixie"); $(canvas).attr("width", WIDTH).attr("height", HEIGHT); con = canvas.getContext("2d"); for (var e = 0; e < 100; e++) { pxs[e] = new Circle; pxs[e].reset() } setInterval(draw, rint) }); $(".services .header2 .service-header").hover(function () { var e = $(this); e.find("h3").hide(); $(this).parent().find(".header-bg").stop(true, true).animate({ width: "100%" }, "fast", function () { e.find("h3").addClass("active").fadeIn("fast") }) }, function () { var e = $(this); e.find("h3").hide(); e.parent().find(".header-bg").stop(true, true).animate({ width: 70 }, "fast", function () { e.find("h3").removeClass("active").fadeIn("fast") }) })
      </script>
 
      
	  
	  
	  
	  
   </body>
</html>
