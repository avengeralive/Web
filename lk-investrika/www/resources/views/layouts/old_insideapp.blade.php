<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	
	
	<link rel="icon" type="image/png" href="{{asset('image/favicon.jpg')}}" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.5.1/snap.svg-min.js" integrity="sha256-oI+elz+sIm+jpn8F/qEspKoKveTc5uKeFHNNVexe6d8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js" integrity="sha256-+bwq8Vn1b2Nz1mF35GyYCR3WP1zNBq6AX9P+rIR/vg8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vivus/0.4.4/vivus.min.js" integrity="sha256-u/d/ZywUFyU/VmJ/TjCml5Hvl0GbgEvr3BvOvBGp5P8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js" integrity="sha256-FtWfRI+thWlNz2sB3SJbwKx5PgMyKIVgwHCTwa3biXc=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
	<script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
	
	<script src="https://unpkg.com/accounting-js"></script>
	<script src="https://unpkg.com/vue-numeric"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.4.4/cleave.min.js" integrity="sha256-bdsE7OfVf7KHL+kLZ4qWLjQs+/gBQ8e2MX02zqTRN+A=" crossorigin="anonymous"></script>
	
	<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
	<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
	
	

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js" integrity="sha256-EGs9T1xMHdvM1geM8jPpoo8EZ1V1VRsmcJz8OByENLA=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha256-VsEqElsCHSGmnmHXGQzvoWjWwoznFSZc6hs7ARLRacQ=" crossorigin="anonymous"></script>
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
	
	
    <title>Investrika</title>
  </head>
  <body style="overflow: auto;">
  
  	<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white py-3">
		<div class="container">
			<a class="navbar-brand mr-0" href="{{route('/')}}"><img src="/image/logo.svg" class="logo-icon"><!--<strong style="color: #34374a; font-family: sans-serif; font-size: 1.4rem;">Inves<span style="color: #03849f;">tika</span></strong>--></a>
			<button class="navbar-toggler navbar-brand float-left" onclick="$('.navbar').removeClass('bg-transparent'); $('.navbar').addClass('bg-white');" style="border: none; outline: none;" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<div class="ml-auto">
					<div class="row mx-0">
						<ul class="navbar-nav mx-auto">
						  <li class="nav-item active text-center">
							<a class="nav-link" href="{{route('/')}}">Главная <span class="sr-only">(current)</span></a>
						  </li>
						  <!--<li class="nav-item text-center" onclick="scrollToFactory();">
							<a class="nav-link">Промышленность</a>
						  </li>-->
						  <li class="nav-item text-center">
							<a class="nav-link" href="{{route('/')}}#industry">Презентация</a>
						  </li>
						  <!--<li class="nav-item text-center" onclick="scrollToIT();">
							<a class="nav-link">IT Компания</a>
						  </li>-->
						  <li class="nav-item text-center">
							<a class="nav-link" href="{{route('/')}}#about_us">О нас</a>
						  </li>
						  
						  <li class="nav-item text-center">
							<a class="nav-link" href="{{route('/')}}#contacts">Контакты</a>
						  </li>
						  
						  @if (Auth::check())
						  <li class="nav-item text-center">
							<a class="nav-link" href="{{route('catalog')}}">Каталог</a>
						  </li>
						  @else
						  <li class="nav-item text-center">
							<a class="nav-link" href="{{route('/')}}#mail">Подать заявку</a>
						  </li>
						  @endif
						  
						  <li class="d-sm-none p-3">
							<a href="#" class="social" style="background-image: url(image/fb.svg);"></a>
							<a href="#" class="social" style="background-image: url(image/twitter.svg);"></a>
							<a href="#" class="social" style="background-image: url(image/instagram.svg);"></a>
							<a href="#" class="social" style="background-image: url(image/telegram.svg);"></a>
						  </li>

						  
						</ul>
						
						

						
						
					</div>
					<div class="row mx-0" id="presentationStage" style="height:.125rem; margin-top: -.125rem; width: 100%; background-color: #03849f; display: none;"></div>
				</div>
				
				<div class="">				
					<ul class="navbar-nav mx-auto">
					@if (Auth::check())
						<li class="nav-item text-center w-auto">
							<div class="text-nowrap">
								<a class="nav-link account-link d-inline-block" style="padding-left: 1rem!important;" href="{{route('account')}}">{{Auth::user()->name}}</a>
								<a class="nav-link account-link d-inline-block pr-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="padding-right: 0!important;"><i class="fas fa-sign-out-alt"></i></a>
								<form id="logout-form" action="{{ route('logout') }}" method="post">@csrf</form>
							</div>
						</li>
					@else
						<li class="nav-item text-center w-auto">
							<a class="nav-link account-link" style="padding-left: 1rem!important; padding-right: 1rem!important;" href="{{route('login')}}">Войти</a>
						</li>
					@endif
					</ul>
				</div>
			</div>
		</div>
	</nav>
	
	
	<div id="containerstub">
		@yield('content')
	</div>
	<div id="stub">
		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<div class="col-12">
					<h2><i class="fas fa-exclamation-triangle"></i> Альбомный режим не поддерживается, поверните устройство</h2>
				</div>
			</div>
		</div>
	</div>

  </body>
</html>