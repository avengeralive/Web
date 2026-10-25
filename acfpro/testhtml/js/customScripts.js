/*Создание HTML 5 тегов для ранних Internet Explorer*/
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');




$(function(){
	//!------Минимальная высота контента------------------------------------------
	if($('body').outerHeight(true)<$(window).height()){
		var height = $(window).height();
		
		$('body>*:visible').not('#main').each(function(){
			height -= $(this).outerHeight(true);
		});
		
		$('#main').css('min-height', height);
	}
	//----------------------------------------------------------------------------
	
	
	
	
	//!------Главное меню---------------------------------------------------------
	$('#mainMenu li').hover(function(){
		$(this).find('ul').stop().slideDown();
	},function(){
		$(this).find('ul').hide();
	})
	//----------------------------------------------------------------------------
	
	
	
	
	//!------Карусель-------------------------------------------------------------
	$('.carousel').each(function(){
	    
		var data = $(this).data();
		
		//Значения по умолчанию
		if(!data['items']) data['items'] = 3;
		if(data['navigationText']!=true) data['navigationText'] = false;
		if(data['pagination']!=false) data['pagination'] = true;
		data['navigationText'] = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
		
		//Преобразование регистров
		if(data['singleitem']) data['singleItem'] = data['singleitem'];
		if(data['transitionstyle']) data['transitionStyle'] = data['transitionstyle'];
		if(data['autoplay']) data['autoPlay'] = data['autoplay'];
		if(data['scrollperpage']) data['scrollPerPage'] = data['scrollperpage'];
		
		$(this).owlCarousel(data);
		
	});
	//----------------------------------------------------------------------------
	
	
	
	
	//!------Вкладки--------------------------------------------------------------
	$(".ionTabs").each(function(){
		//Передача опций через атрибут "data"		
		var data = $(this).data();
		
		//Значения по умолчанию
		if(!data['type']) data['type'] = "none";
		
		$.ionTabs(this, data);
	});
	//----------------------------------------------------------------------------
	
	
	
	
	//!------Аккордеон------------------------------------------------------------
	$(".acordeon .title").click(function(e){
		e.preventDefault();
		
		$('.acordeon .description').not($(this).parent().find('.description')).slideUp();
		$('.acordeon .title').not($(this)).removeClass('active');
		
		$(this).addClass('active');
		$(this).parent().find('.description').slideDown();
	});
	//----------------------------------------------------------------------------
	
	
	
	
	//!------Модальные окна-------------------------------------------------------
	$('.fancyBox').fancybox({
		tpl:{
			closeBtn	: '<a title="Закрыть" class="fancybox-item fancybox-close" href="javascript:;"><i class="fa fa-times"></i></a>'
			,next		: '<a title="Далее" class="fancybox-nav fancybox-next" href="javascript:;"><span><i class="fa fa-angle-right"></i></span></a>'
			,prev		: '<a title="Назад" class="fancybox-nav fancybox-prev" href="javascript:;"><span><i class="fa fa-angle-left"></i></span></a>'
		}
	});
	//----------------------------------------------------------------------------
	
	
	
	
	//!------Обработка форм-------------------------------------------------------
 	//Шаблон телефона
	$('input[name=phone]').mask('8 (999) 999-99-99', {placeholder:'_'});
	
	
	//Отключенные поля
	$('form .disabled').find('input, textarea, select, button').prop('disabled', true);
	
	
	//Валидация
	$('.formValidate').each(function(){
		var formId = $(this);
		
		$(formId).validate({
			errorPlacement:function(error,element){error.insertBefore(element.parent())}
			,submitHandler:function(form){
			    var $form = $(form);
			    
			    $form.ajaxSubmit({
    				url: document.location.href
    				,type: 'POST'
    				,dataType: 'json'
    				,beforeSubmit: function(arr, $form, options){
    					$form.append('<div class="loader"><img src="images/style/loading.gif"></div>');
    				}
    				,success: function(response){
    					$form.find('.loader').remove();
    						
    					if(response.message)
    						$.jGrowl(response.message, {theme:'message success'});
    						
    					//Цели
    					if(response.form=='contactsForm'){
							yaCounter26404614.reachGoal('contactsFormSend');
							ga('send','event','Формы','Связаться с нами');
							console.log('contactsFormSend');
						}
						if(response.form=='calculateForm'){
							yaCounter26404614.reachGoal('calculateFormSend');
							ga('send','event','Формы','Расчет стоимости');
							console.log('calculateFormSend');
						}
						if(response.form=='orderForm'){
							yaCounter26404614.reachGoal('orderFormSend');
							ga('send','event','Формы','Сделать заказ');
							console.log('orderFormSend');
						}
    					
    					$form.clearForm();
    					if($.fn.fancybox) $.fancybox.close();
    				}
    				,error: function(xhr, status, error){
    					var response = xhr.responseJSON;
    					console.log(response);
    					
    					$form.find('.loader').remove();
    					console.log('Ошибка обработки формы: '+error);
    					
    					if(response && response.errors.validate){
    						var validate = response.errors.validate;
    						for(var i in validate){
    							if(!validate.hasOwnProperty(i))
    								continue;
    							validate[i] = $.validator.messages[validate[i]];
    						}
    						$form.validate().showErrors(validate);
    					}
    					
    					if(response && response.message)
    						$.jGrowl(response.message, {theme:'message error'});
    					else
    						$.jGrowl('Ошибка обработки формы. Попробуйте еще раз', {theme:'message error'});
    				}
    			});
				/*$.ajax({
					url:document.location.href, 
					type:'POST',          
					dataType:'json',  
					data:$(formId).serialize(),
					success:function(responce){
						//Закрытие модального окна
						$.fancybox.close();
					
						//Сообщение с результатом
						if(responce.success==1){
							$.jGrowl(responce.message, {theme:'success'});
							var type = $(formId).find('input[name="formId"]').val();
							
							if(type=='contactsForm'){
								yaCounter26404614.reachGoal('contactsFormSend');
								ga('send','event','Формы','Связаться с нами');
								console.log('contactsFormSend');
							}
							if(type=='calculateForm'){
								yaCounter26404614.reachGoal('calculateFormSend');
								ga('send','event','Формы','Расчет стоимости');
								console.log('calculateFormSend');
							}
							if(type=='orderForm'){
								yaCounter26404614.reachGoal('orderFormSend');
								ga('send','event','Формы','Сделать заказ');
								console.log('orderFormSend');
							}

						}else{
							$.jGrowl(responce.message, {theme:'error'});
						}
							
						//Возврат к исходному состоянию
						$(formId).find('input[type=text], input[type=number], input[type=password], input[type=email],	textarea, select').val('');
						$(formId).find('.loader').remove();
					},
					beforeSend:function(){
						$(formId).append('<div class="loader"><img src="images/style/loading.gif"></div>');
					}
				})*/
			}
		});
	});
	//----------------------------------------------------------------------------
	
	
	
	
	//!------Подсказки------------------------------------------------------------
	$('.tooltip').each(function(){
		$(this).miniTip({
			anchor:'w'
			,content:$(this).parent().find('.tooltip_text').html() 
			,maxW:'408px'
		});
	})
	//----------------------------------------------------------------------------


	//!---------------------Цели---------------------------------------------

	$('a[href="#calculateForm"]').click(function(){
		ga('send','event','Кнопки','Расчет стоимости');
		yaCounter26404614.reachGoal('calculateFormClick');
		console.log('calculateFormClick');
	});

	$('a[href="#contactsForm"]').click(function(){
		ga('send','event','Кнопки','Связаться с нами');
		yaCounter26404614.reachGoal('contactsFormClick');
		console.log('contactsFormClick');
	});

	$('a[href="#orderForm"]').click(function(){
		ga('send','event','Кнопки','Сделать заказ');
		yaCounter26404614.reachGoal('orderFormClick');
		console.log('orderFormClick');
	});

    //объявление в хлебных крошках
  	/*$('#notice i').click(function(){
    	$('#notice').css('display','none');
    	localStorage.setItem('showNotice', 'none');
  	}) 

  	if(localStorage.getItem('showNotice')) {
    	document.getElementById('notice').style.display='none';
  	}
	else{
		document.getElementById('notice').style.display='block';
	}*/
	
	
    $("#my-menu").mmenu({
         // options
      }, {
         // configuration
         offCanvas: {
            pageSelector: "#container"
         },
         clone: true
     });
    
    //выравнивание табов по высоте (для мобильных)
    $('.ionTabs__head').each(function(){
        var ul = $(this);
        var max_h = 0;
        ul.find('li').each(function(){
            if ($(this).height() > max_h){max_h = $(this).height()}
        });
        ul.find('li').height(max_h)
    });
    
    
    //объявление сверху страницы
    /*
    function showAnounce(){
        if(!localStorage.getItem('popup1')&&(!localStorage.getItem('slide'))){
            $("#anounce").slideDown("slow");
            localStorage.setItem('slide', 'no');
        }
    }
    setTimeout(showAnounce, 2000);

    function showAnounceTwo(){
        if(!localStorage.getItem('popup1')&&(localStorage.getItem('slide'))){
            $("#anounce").css('display','block');
        }
    }
    showAnounceTwo();
    
    
    $(".anounceClose").click(function(event){
        event.preventDefault();
        $("#anounce").slideUp("slow");
        localStorage.setItem('popup1', 'none');
    })*/

	

})




