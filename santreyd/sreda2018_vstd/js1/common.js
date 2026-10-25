
$('#openMenu').on('click', function() {
    $('.layer').fadeIn();
})

$.fn.hoverSubMenu = function() {
	var windowWidth, documentWidth;
	$(this).hover(
		function() {
			var menu = $(this).find('.sub-menu');
			var menuHeight = '-' + (menu.innerHeight() + 35) + 'px';
			//$(this).find('.top-nav-btn').addClass('top-nav-btn-active')
			menu.css('bottom', menuHeight)
			menu.fadeIn(100);
			windowWidth = $(window).width();
			documentWidth = $(document).width();
			if (windowWidth < documentWidth) {
				var leftPos = (windowWidth - documentWidth) - 35 + 'px';
				menu.css('left', leftPos)
			}
		},
		function() {
			//$(this).find('.top-nav-btn').removeClass('top-nav-btn-active')
			$(this).find('.sub-menu').fadeOut(100);
		}
	)
}
var layerOpenClose = function() {
	$('body').toggleClass('overflow-hidden')
	$('.layer').fadeToggle(200);
}
var headerSearch = function() {
	$('header .main_bad-form').animate({
		width: '255px'
	}, 200);
	$('header .main_bad-input').fadeIn(100);
	$('header').addClass('search-open')
}
var headerSearchClose = function() {
	$('header .main_bad-input').animate({
		opacity: 0
	}, 500);
	$('header .main_bad-form').animate({
		width: '45px'
	}, 200);
	setTimeout(function() {
		$('header .main_bad-input').css('display', 'none');
		$('header .main_bad-input').css('opacity', '1');
		$('header .main_bad-input').val('')
	}, 700)
	$('header').removeClass('search-open')
}
var openFilterMore = function() {
	//$('body').toggleClass('overflow-hidden')
	$('.catalog-nav-filter').slideToggle(200);
}
var closeFilterMore = function() {
	$('.catalog-nav-more').removeClass('catalog-nav-more-open');
	$('.catalog-nav-filter').slideUp(200);
}
var countSlidesActive = function() {
	if ($('.slider-counter-number').length > 0) {
		$('.slider-counter-number').empty()
	}
	var active = $('.swiper-container-catalog-item .swiper-slide-active').attr('id');
	$('.slider-counter-number').text(active);
}
var countSlides = function() {
	if ($('.swiper-container-catalog-item').length > 0) {
		var i = 0;
		$('.swiper-container-catalog-item .swiper-slide').each(function() {
			i++;
			$(this).attr('id', i)
		})
		countSlidesActive()
		var last = $('.swiper-container-catalog-item .swiper-slide').last().attr('id');
		$('<span class="slider-counter-many-number">' + last + '</span>').appendTo('.slider-counter-many');
	}
}
var countHolders = function() {
	if ($('.catalog-item-firm-nav-a').length > 0) {
		var i = 0;
		$('.catalog-item-firm-nav-a').each(function() {
			i++;
			$(this).attr('id', i);
		})
		clickHolders()
	}
}
var clickHolders = function(thisItem) {
	var id = $('.catalog-item-firm-nav-a-active').attr('id');
	var whatFind = '.catalog-item-firm-holder-' + id;
	$('.catalog-item-firm-holder-this').hide();
	$('.catalog-item-firm-holder').find(whatFind).fadeIn(200);
}
var openCheme = function(thisItem) {
	var src = thisItem.find('img').attr('src');
	var id = '.' + thisItem.attr('id');
	src = src.substring(0, src.length - 4) + '-big.jpg';
	thisItem.find('img').clone().appendTo(id)
	$(id).find('img').attr('src', src);
	$(id).parent().fadeToggle();
	$('body').toggleClass('overflow-hidden')
}
var closeCheme = function(thisItem) {
	thisItem.parent().parent().fadeToggle();
	$('body').toggleClass('overflow-hidden');
	thisItem.next().remove();
}

$(document).ready(function() {
	countSlides()
	countHolders()
//if resize
	$( window ).on('resize load', function() {
		//var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	});

//input and textarea
   $('input,textarea').focus(function(){
       $(this).data('placeholder',$(this).attr('placeholder'))
       $(this).attr('placeholder','');
    });
    $('input,textarea').blur(function(){
       $(this).attr('placeholder',$(this).data('placeholder'));
    });

//open sub menu
	$('.with-sub-menu').hoverSubMenu()

//layer open and close
	$(document).on('click', '.butter', function() {
		layerOpenClose()
	})
	$(document).on('click', '.close', function() {
		layerOpenClose()
	})

//header search
	$(document).on('click', 'header .search', function() {
		headerSearch()
	})
	$(document).on('click', 'header.search-open .search', function() {
		headerSearchClose()
	})

//catalog nav
	$(document).on('click', '.catalog-nav-inner-href', function() {
		$(this).toggleClass('catalog-nav-inner-href-choosed');

	})
	$(document).on('click', '.catalog-nav-sort', function() {
		$(this).toggleClass('catalog-nav-sort-changed');

	})
	$(document).on('click', '.catalog-nav-filter-block h2', function() {
		$(this).parent().toggleClass('catalog-nav-filter-block-open');
		$(this).next().slideToggle();
	})
	$(document).on('click', '.catalog-nav-more', function() {
		$(this).toggleClass('catalog-nav-more-open');
		openFilterMore()
	})
	$(document).click(function(event) {
		var target = $(event.target);
		if (!(target.hasClass('catalog-nav-more') || target.hasClass('catalog-nav-filter') || target.hasClass('catalog-nav-sub') || $(".catalog-nav-sub").find(target).length > 0 || $(".catalog-nav-more").find(target).length > 0 || $(".catalog-nav-filter").find(target).length > 0)) {
			closeFilterMore()
		} else {
			return
		}
	})
	$(document).on('click', '.catalog-item-firm-nav-a', function() {
		$('.catalog-item-firm-nav-a-active').removeClass('catalog-item-firm-nav-a-active');
		$(this).addClass('catalog-item-firm-nav-a-active');
		clickHolders();
	})
	$(document).on('click', '.for-cheme', function() {
		var thisItem = $(this);
		openCheme(thisItem);
	})
	$(document).on('click', '.close-round', function() {
		var thisItem = $(this);
		closeCheme(thisItem);
	})

//end of ready function
});

$(window).load(function() {

//end of load function
});
