document.addEventListener("DOMContentLoaded", function() {

	$(function(){

		var d = new Date();
		var time_zone = d.getTimezoneOffset();
		var year_user = d.getFullYear();
		var month_user = d.getMonth()+1;
		var day_user = d.getDate();
		var hrs_user = 24+(time_zone / 60);//d.getHours() + 1;
		var min_user = d.getMinutes();
		var sec_user = d.getSeconds();
		var str_user = year_user + "-" + month_user + "-" + day_user + " " + hrs_user + ":" + "00";
		console.log(str_user);
    function timer(settings){
        var config = {
            endDate: str_user,
            // timeZone: 'Europe/Kiev',
            hours: $('#hours'),
            minutes: $('#minutes'),
						seconds: $('#seconds'),
						
						hours2: $('#hours2'),
            minutes2: $('#minutes2'),
						seconds2: $('#seconds2'),

            newSubMessage: 'and should be back online in a few minutes...'
        };
        function prependZero(number){
            return number < 10 ? '0' + number : number;
        }
        $.extend(true, config, settings || {});
        var currentTime = moment();
        var endDate = moment.tz(config.endDate, config.timeZone);
        var diffTime = endDate.valueOf() - currentTime.valueOf();
        var duration = moment.duration(diffTime, 'milliseconds');
        var days = duration.days();
        var interval = 1000;
        var subMessage = $('.sub-message');
        var clock = $('.clock');
        if(diffTime < 0){
            endEvent(subMessage, config.newSubMessage, clock);
            return;
        }
        if(days > 0){
            $('#days').text(prependZero(days));
            $('.days').css('display', 'inline-block');
        }
        var intervalID = setInterval(function(){
            duration = moment.duration(duration - interval, 'milliseconds');
            var hours = duration.hours(),
                minutes = duration.minutes(),
                seconds = duration.seconds();
            days = duration.days();
            if(hours  <= 0 && minutes <= 0 && seconds  <= 0 && days <= 0){
                clearInterval(intervalID);
                endEvent(subMessage, config.newSubMessage, clock);
                window.location.reload();
            }
            if(days === 0){
                $('.days').hide();
            }
            $('#days').text(prependZero(days));
						
						config.hours.text(prependZero(hours));
            config.minutes.text(prependZero(minutes));
						config.seconds.text(prependZero(seconds));
						
						config.hours2.text(prependZero(hours));
            config.minutes2.text(prependZero(minutes));
						config.seconds2.text(prependZero(seconds));
        }, interval);
			}

			timer();
	
			

			var swiper = new Swiper('.swiper-container', {
				nextButton: '.swiper-button-next',
				prevButton: '.swiper-button-prev',
				spaceBetween: 30,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			});

			$(".swiper-button-next").click(function(e){
				e.preventDefault();
				swiper.slideNext();
			});

			$(".swiper-button-prev").click(function(e){
				e.preventDefault();
				swiper.slidePrev();
			});

			var names = ['Дмитрий',
				'Георгий',
				'Ольга',
				'Яна',
				'Арина',
				'Мария',
				'Геннадий',
				'Алиса',
				'Алина',
				'Надежда',
				'Любовь',
				'Матвей',
				'Александр',
				'Вадим',
				'Никита',
				'Константин'];
			var cities = ['Томска',
				'Тюмени',
				'Барнаула',
				'Москвы',
				'Нижнего Новгорода',
				'Екатеринбурга',
				'Ярославля',
				'Краснодара',
				'Калининграда',
				'Кемерово',
				'Тулы',
				'Грозного',
				'Махачкалы',
				'Алушты',
				'Ачинска',
				'Новосибирска'];
			var str; // = "<span>" + names[i] + "</span> из " + cities[i] + " заказала комплект";
			var t = 2000;
			var interval = 15000;
			var wait_time = 5000;

			names.forEach(function(element, i){
				setTimeout(function(){
					if (names[i] === 'undefined')
						names[i] = names[1];
					if (cities[i] === 'undefined')
						cities[i] = cities[1];
					str = "<span>" + names[i] + "</span> из " + cities[i] + " заказал(а) комплект";
					$(".new-order p").html(str);
					$(".new-order").css("visibility", "visible");

					setTimeout(function(){
						$(".new-order").css("visibility", "hidden");
					}, wait_time * ++i)

				}, interval * ++i)
				
				
			 });
			 $(".order-block-btn a").mPageScroll2id({ offset: 70, autoScrollSpeed: true })

	
	});


});
