
/* check mobile */
var auto_carouFredSel =  false;//{timeoutDuration: 4000};
var no_stellar = false;

var wnd_width = $('body').width();
if( wnd_width <= 450 /*&&
    (
        navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)
    )*/
)
{
    auto_carouFredSel = false;
    no_stellar = true;
}

$('.hide').css('display', 'block');


    function is_touch(){
	var deviceAgent = navigator.userAgent.toLowerCase();
	var isTouchDevice = 
	deviceAgent.match(/(iphone|ipod|ipad)/) ||
	deviceAgent.match(/(android)/)  || 
	deviceAgent.match(/(iemobile)/) || 
	deviceAgent.match(/iphone/i) || 
	deviceAgent.match(/ipad/i) || 
	deviceAgent.match(/ipod/i) || 
	deviceAgent.match(/blackberry/i) || 
	deviceAgent.match(/bada/i);
	
	if (isTouchDevice) return true;
	else return false;
}
function createCounter(elementId,start,end,totalTime,callback){
	var jTarget=elementId;
	var interval=totalTime/(end-start);
	var intervalId;
	var current=start;
	var f=function(){
		jTarget.text(current+'%');
		if(current==end){
			clearInterval(intervalId);
			if(callback) {callback();}
		}
		++current;
	}
	intervalId=setInterval(f,interval);
	f();
}
function inView(element){
	var pos = $(window).scrollTop();
	var windowHeight = $(window).height();
	var $element = $(element);
	var height = $(element).outerHeight();
	var offset = $element.offset();
	var top = offset.top;
	var bottom = offset.top + height;
	if ( top + height < pos || top > pos + windowHeight ) {
		return false;
	}
	else {
		return true;
	}
}


function animateBlock(block, way){
	var element = $(block);
	element.each(function(index, element) {
		var element = $(this),
			dir = element.data('animDir'),
			start = element.data('animStart'),
			end = element.data('animEnd'),
			speed = element.data('animSpeed');
		if (!speed) speed = 0.1;
		if (way == "f" || !way){
			animStart = {opacity:0.1, transition: "all "+speed+"s linear"};
			animStart[dir] = start;
			animStop = {opacity:1};
			animStop[dir] = end;
		}
		else if (way == "b"){
			animStart = {opacity:1};
			animStart[dir] = end;
			animStop = {opacity:0};
			animStop[dir] = start;
		}
		element.css(animStart);		
		element.css(animStop);
	});
}

function mobile(){
	var wnd_width = $('body').width();
    /*console.log(wnd_width);*/
	if(wnd_width<=450 && 
		(
			navigator.userAgent.match(/Android/i)
		 || navigator.userAgent.match(/webOS/i)
		 || navigator.userAgent.match(/iPhone/i)
		 || navigator.userAgent.match(/BlackBerry/i)
		 || navigator.userAgent.match(/Windows Phone/i)
		)
	){
			
	//$(".do-links").carouFredSel();

		$(".hidden_ln").carouFredSel({
			responsive: true,
			width: "100%",
			height: "auto",
			scroll: 1,
			items: {
				visible: 1
			},
			auto: false,
			prev: ".portfolio-carousel-arrows .a-left",
			next: ".portfolio-carousel-arrows .a-right",
			swipe:true
		});

        console.log(wnd_width);
		$(".blog-carousel-list").carouFredSel({
			responsive: true,
			scroll: 1,
			items: {
				width: 320,
				visible: 1
			},
			auto: false,
			prev: ".blog-carousel-arrows .a-left",
			next: ".blog-carousel-arrows .a-right",
			swipe: true
		});
		
		
	}else{

		$(".blog-carousel-list").carouFredSel({
			responsive: true,
			scroll: 1,
			items: {
				width: 300,
				height: '155%',
				visible: {
					min: 1,
					max: 3
				}
			},
			auto: false,
			prev: ".blog-carousel-arrows .a-left",
			next: ".blog-carousel-arrows .a-right",
			swipe: true
		});
	
	}
	


}

$( window ).resize(function() {
	mobile();
});


function exists (item) {
   return $(item).length;
}

$(document).ready(function(){//DOM READEY

	mobile();

    $('[name=frm2]').find('[name=upload_file]').change(function(){
        var val = $(this).val();
        if(val) {
            $('[name=frm2]').find('.file-upload a.btn-yellow').addClass('success');
            $('[name=frm2]').find('.file-upload').addClass('success');
        }
    });



	//$("#sendquest").click(function(){
		//$('#sendquest').validate();
        /*if(
			document.forms['frm1'].name.value == ""
			|| document.forms['frm1'].email.value == ""
			|| document.forms['frm1'].message.value == ""
			|| document.forms['frm1'].name.value == "Ваше имя"
			|| document.forms['frm1'].email.value == "Ваш E-mail"
			|| document.forms['frm1'].message.value == "Сообщение"
		){	
			alert("Заполните все поля.");
			return false;
		}else{return true;} */
	//});

    $("#sendquest2").closest('form').validate({
        rules: {
            name: "required",
            phone: "required",
            message: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            }
        },
        submitHandler: function(form) {
            $(form).submit();
        }
    });
	/*$("#sendquest2").click(function(){
		if(
			document.forms['frm2'].name.value == ""
			|| document.forms['frm2'].email.value == ""
			|| document.forms['frm2'].message.value == ""
			|| document.forms['frm2'].name.value == "Имя"
			|| document.forms['frm2'].email.value == "Ваш E-mail"
			|| document.forms['frm2'].message.value == "Доп. информация"
			
			|| document.forms['frm2'].name.value == "Имя и фамилия"
			|| document.forms['frm2'].email.value == "E-mail"
			|| document.forms['frm2'].message.value == "Презентация проекта"
		){	
			alert("Заполните необходимые поля.");
			return false;
		}else{return true;}

	});*/
	
	
	

	$(".do-links .carousel-arrows a.a-right").click(function(){
		var item = $(".do-links .col-md-4 a.active").parent(".col-md-4").next(".col-md-4").children("a");
		if(exists(item)) {
			$(".do-links .col-md-4 a.active").removeClass("active").parent(".col-md-4").next(".col-md-4").children("a").addClass("active");
			$(".do-list").trigger('slideTo',$(".do-links .col-md-4 a.active").attr('href'));
		}

		return false;
	});
	
	$(".do-links .carousel-arrows a.a-left").click(function(){
	
		var item = $(".do-links .col-md-4 a.active").parent(".col-md-4").prev(".col-md-4").children("a");
		if(exists(item)) {
			$(".do-links .col-md-4 a.active").removeClass("active").parent(".col-md-4").prev(".col-md-4").children("a").addClass("active");
			$(".do-list").trigger('slideTo',$(".do-links .col-md-4 a.active").attr('href'));
		}
		return false;
	});

	if (!is_touch() ) {
	/*
	|| (
			navigator.userAgent.match(/iPod/i)
			|| navigator.userAgent.match(/iPad/i)
			|| navigator.userAgent.match(/safari/i))
	*/
        if(!no_stellar)
            $.stellar({
                horizontalScrolling: false,
                verticalOffset: 0,
                responsive: true,
                hideDistantElements: false
            });

        $(window).resize(function() {
            if(!no_stellar)
                $.stellar('refresh');
        });
	}
	else {
		$('.block-with-bg').addClass('nofixbg');
	}
	animateBlock('.anim-block', "b");
	if (window.PIE) {
        $('.pie').each(function() {
            PIE.attach(this);
        });
    }
	if ($('input[placeholder]').length || $('textarea[placeholder]').length)$('input[placeholder], textarea[placeholder]').placeholder();
	$('.fancybox').fancybox({'padding':5})
	$('form').on('submit',function(e){
		$(this).find('input').each(function(index, element) {
			if ($(this).hasClass('placeholder')) $(this).val("");
		});
		$(this).find('textarea').each(function(index, element) {
			if ($(this).hasClass('placeholder')) $(this).val("");
		});
	});
	$('.case-carousel').carouFredSel({
		responsive: true,
		width: "100%",
		height: 'variable',
		items: {
			visible:1,
			height: 'variable'
		},
		scroll: {
			items: 1,
		},
		pagination: ".case-carousel-pager",
		swipe:true,
		auto:false
	});

    //Новый слайдер в шапке
    $('.new_slider_header').each(function() {
        var me = $(this);

        me.find('.new_slider_block').carouFredSel({
            responsive: true,
            width: '100%',
            items: 1,
            scroll: {
                items: 1,
                fx: "crossfade",
                visible: {
                    min: 1,
                    max: 1
                },
                onAfter: function (data) {
                    animateBlock(data.items.old.find('.anim-block'), 'b');
                    animateBlock(data.items.visible.find('.anim-block'));
                }

            },
            next: me.find(".new_slider_header .a-right"),
            prev: me.find(".new_slider_header .a-left"),
            auto: auto_carouFredSel,
            pagination: me.find(".new_slider_pager"),
            swipe: true,
            onCreate: function (data) {
                $('.new_slider_item').addClass('new_slider_item_left');
                animateBlock(data.items.find('.anim-block'));
            }
        });
    });

	$("#header-carousel .carousel-block").carouFredSel({
		// responsive: true,
		width: "100%",
		height: 'variable',
		/*items: {
			height: 'variable'
		},*/
		scroll: {
			items: 1,
			fx: "crossfade",
            visible: {
                min: 1,
                max: 1
            },
			onAfter: function(data){
				animateBlock(data.items.old.find('.anim-block'), 'b');
				animateBlock(data.items.visible.find('.anim-block'));
			}

		},
		next: ".header-carousel-arrows .a-right",
		prev: ".header-carousel-arrows .a-left",
		auto:  auto_carouFredSel,
		pagination: ".main-banner-carousel-pager",
		swipe:true,
		onCreate:function(data){
			animateBlock(data.items.find('.anim-block'));
		}
	});

	$(".portfolio-carousel .carousel-block").carouFredSel({
		responsive: true,
		width: "100%",
		height: 'variable',
		items: {
			height: 'variable'
		},
		next: ".portfolio-carousel-arrows .a-right",
		prev: ".portfolio-carousel-arrows .a-left",
		scroll: {
            visible: {
                min: 1,
                max: 1
            },
			items: 1,
			fx: "crossfade",
			onAfter: function(data){
				animateBlock(data.items.old.find('.anim-block'), 'b');
				animateBlock(data.items.visible.find('.anim-block'));
			}
			/*pauseOnHover:true*/
			
		},
		auto: false,
		pagination: ".portfolio-carousel-pager",
		swipe:true,
		onCreate:function(data){
			animateBlock(data.items.find('.anim-block'));
		}
	});
	$("#portfolio-carousel .carousel-block").carouFredSel({
		responsive: true,
		width: "100%",
		height: "auto",
		items: 1,
		scroll: {
			items: 1
		},
		auto: false,
		next: ".portfolio-carousel-arrows .a-right",
		prev: ".portfolio-carousel-arrows .a-left",
		swipe:true
	});
	$("#solution-carousel .carousel-block").carouFredSel({
		responsive: true,
		width: "100%",
		height: "auto",
		items: 1,
		scroll: {
			items: 1
		},
		auto: false,
		next: "#solution-carousel .solution-carousel-arrows .a-right",
		prev: "#solution-carousel .solution-carousel-arrows .a-left",
		swipe:true
	});


	$("#solution-carousel2 .carousel-block").carouFredSel({
		responsive: true,
		width: "100%",
		height: "auto",
		items: 1,
		scroll: {
			items: 1
		},
		auto: false,
		next: "#solution-carousel2 .solution-carousel-arrows .a-right",
		prev: "#solution-carousel2 .solution-carousel-arrows .a-left",
		swipe:true
	});


	$(".do-list").carouFredSel({
		responsive:true,
		width: "100%",
		height: "auto",
		items: 1,
		scroll: {
			items: 1
		},
		auto: false
	});
	$('.js-do-link').on('click',function(e){
		e.preventDefault();
		$('.js-do-link').removeClass('active');
		$(this).addClass('active');
		$(".do-list").trigger('slideTo',$(this).attr('href'));
	});

    $('.js-do-link2').on('mouseout',function(e){
      //  e.preventDefault();
     //   $('.js-do-link').removeClass('active');
      //  $(this).addClass('active');
       // $(".do-list").trigger('slideTo',$(this).attr('href'));
    });

	$("#client-carousel .client-carousel-list").carouFredSel({
		responsive: true,
		scroll: 1,
		items: {
			width: 160,
			height: '69%',
			visible: {
				min: 2,
				max: 6
			}
		},
		auto: false,
		prev: ".client-carousel-arrows .a-left",
		next: ".client-carousel-arrows .a-right",
		swipe: true
	});

    $("#reviews-carousel .reviews-carousel-list").carouFredSel({
        responsive: true,
        scroll: 1,
        height: '171px',
        items: {
            //width: 200,
            //height: '171px',
            visible: {
                min: 2,
                max: 4
            }
        },
        auto: false,
        prev: ".reviews-carousel-arrows .a-left",
        next: ".reviews-carousel-arrows .a-right",
        swipe: true
    });

	$('.js-contacts-more').on('click',function(e){
		e.preventDefault();
		
		if ($(this).hasClass('opened')){
			$('.js-contacts-more.opened').removeClass('opened');
			$('.place-contacts-text').slideUp();
		}
		else{
			$('.js-contacts-more.opened').removeClass('opened');
			$(this).addClass('opened');
			$('.place-contacts-text').slideUp();
			$(this).parents('.place-contacts').find('.place-contacts-text').slideDown();
		}
	});
    try {
        $($('.js-contacts-more').get(2)).click();
    }catch(e)
    {

    }
	$('.js-load-more-portfolio').on('click',function(e){
		e.preventDefault();
		$('#portfolio-list .col-md-4:lt(3)').clone().appendTo('#portfolio-list')
	});
	$('.js-leave-review').on('click',function(e){
		e.preventDefault();
		$self =$(this);
		if ($self.hasClass('active')){
			$($self.attr('href')).find('form').slideUp(100,function(){
				
				
				$($self.attr('href')).hide();
				$('.form-success').hide();
				console.log('sss')
			});
			$self.removeClass('active');
		}
		else {
			$self.addClass('active');
			$($self.attr('href')).show();
			$($self.attr('href')).find('form').slideDown();
		}
		
		
		
	});
	/*Temp form message*/
	/*
	$('.review-form').on('submit',function(e){
		$('.form-success').show();
		e.preventDefault();
	});*/
	$('.js-dev-popup').on('click',function(e){
		e.preventDefault();
		if ($(this).hasClass('active')){
			$('.js-dev-popup.active').removeClass('active');
			$('.dev-step-popup').fadeOut();
		}
		else{
			$('.js-dev-popup.active').removeClass('active');
			$(this).addClass('active');
			$('.dev-step-popup').fadeOut();
			$(this).parents('.dev-step').find('.dev-step-popup').fadeIn()
		}
	});
	$(document).on('click', function (e) {
		if ( $( e.target ).closest('.js-dev-popup.active').length === 0) {
			$('.js-dev-popup.active').removeClass('active');
			$('.dev-step-popup').fadeOut();
		}
	});
	$('.js-review-show').on('click',function(e){
		e.preventDefault();
		$('.js-review-show.active').removeClass('active');
		//$(this).addClass('active');
		$('.reviewer-company i').fadeOut();
		$(this).find('i').fadeIn();
		$('.review-content').fadeOut();
		$($(this).attr('data-id')).fadeIn();
	});
	
	$(document).on('scroll',function(){
		/*Fix menu*/
		if ($(window).scrollTop()>48) $('.main-menu').addClass('top');
		else $('.main-menu').removeClass('top');
		/*Count in projects price*/
		if ($('.project-price').length){
			if (inView('.project-price')){
				$('.project-price-procent i').each(function(index, element) {
					if($(this).text() == "0%"){
						createCounter($(this),0,$(this).data('procent'),1100)
					}
				});
			}
			else {$('.project-price-procent i').text("0%")}
		}
	
		
		
	});

		//sidemenu
	$('#menu-toggle').on('click', function(event){
		event.preventDefault();
		$('body').toggleClass('side-menu-open');
	});

	
});