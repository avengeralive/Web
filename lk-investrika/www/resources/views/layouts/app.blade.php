 <!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" type="image/png" href="{{asset('image/favicon.jpg')}}" />
  <link rel="stylesheet" href="{{asset('css/style.bundle.css')}}">
  
  <link rel="stylesheet" href="/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="/assets/owl.theme.default.min.css">

  <link rel="stylesheet" href="/css/custom.css">
  <link rel="icon" type="image/png" href="/img/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="/img/favicon-16x16.png" sizes="16x16" />


  <title>Investrika</title>
  
  	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter49721332 = new Ya.Metrika2({
						id:49721332,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/tag.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks2");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/49721332" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
	
</head>
<body>
<header class="header-bg">

  <div class="container-fluid container-lg">
    <div class="row">
      <div class="col-md-12">
          
          <a class="logo" href="/">
              <img src="/img/logo.svg" alt="logo">
            </a>

          <nav role="navigation" class="xs-menu">
          <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul id="menu">
              <li>
                <!--<a href="/#presentation">Презентация</a>-->
              </li>
              <li>
                <!--<a href="/#faq">FAQ</a>-->
              </li>
              <li>
                <!--<a href="/#about-us">Отзывы</a>-->
              </li>
              @if (Auth::check())
                <li>
                  <!--<a href="{{route('catalog')}}">Каталог</a>-->
                </li>
                @else
                <li>
                  <!--<a href="{{route('/')}}#signup">Подать заявку</a>-->
                </li>
                @endif
               @if (Auth::check())
              <ul class="xs-profile-target">
                <li>
                  <a href="{{ route('account') }}">Настройки профиля</a>
                </li>
                <li>
                  <a href="{{ route('logout') }}" class="exit-target">Выйти</a>
                </li>
              </ul>
              @else
              <ul class="xs-profile-target">
                <li>
                  <a href="/#registration">Регистрация</a>
                </li>
                <li>
                  <a href="{{ route('login') }}">Личный кабинет</a>
                </li>
              </ul>
              @endif
            </ul>
          </div>
        </nav>
        
        <nav class="header-menu">
          <ul class="nav-menu">
            <li>
              <!--<a href="/#presentation">Презентация</a>-->
            </li>
            <li>
              <!--<a href="/#faq">FAQ</a>-->
            </li>
            <li>
              <!--<a href="/#about-us">Отзывы</a>-->
            </li>
            @if (Auth::check())
            <li>
              <!--<a href="{{route('catalog')}}">Каталог</a>-->
            </li>
            @else
            <li>
              <!--<a href="{{route('/')}}#signup">Подать заявку</a>-->
            </li>
            @endif
          </ul>
          
           @if (Auth::check())
          <div class="dropdown ">
            <div class="dropbtn" onclick="dropdownMenuHeader()">
              <span class="user-name">{{Auth::user()->name}}</span>
              <div class="user-avatar">
                <img src="{{Auth::user()->gravatar()}}" alt="">
              </div>
            </div>
            <div id="dropdown-menu" class="dropdown-content">
              <div class="dropdown-content__user">
                {{Auth::user()->name}}<br>
                <span>Инвестор</span>
              </div>
              <div class="target-container">
                <a href="{{ route('account') }}">Настройки профиля</a>
                <a href="/account/change">Сменить пароль</a>
                <a href="{{ route('logout') }}" class="exit-target">Выйти</a>
              </div>
            </div>
          </div>
          @else
          <ul class="nav-menu__authorization">
            <li class="login">
              <a href="{{ route('login') }}">Личный кабинет</a>
            </li>
          </ul>
          @endif
        </nav>
      </div>
    </div>
  </div>

  @yield('content')

  <section id="footer">
    <div class="container-fluid container-lg">
      <div class="row">
        <div class="col-md-6">
          <div class="footer-social">
            <ul>
                <li><a class="social-icon telegram" href="https://t.me/investrika" rel="nofollow" target="_blank"></a></li>
                <li><a class="social-icon facebook" href="http://facebook.com/investrika" rel="nofollow" target="_blank"></a></li>
                <li><a class="social-icon instagram" href="http://instagram.com/investrika" rel="nofollow" target="_blank"></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="footer-copyright">
            Copyright © ООО "ИНВЕСТРИКА"  2018 - 2019
          </div>
        </div>
      </div>
    </div>
  </section>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{asset('js/bundle.js')}}"></script>
    <script src="{{asset('js/main.js')}}?v=10"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52185469, "init", {
        id:52185469,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52185469" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>