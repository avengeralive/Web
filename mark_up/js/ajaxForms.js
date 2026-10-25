$(function(){

	//$(document).on('submit', '.contactForm', function(e) {
	$('body').on('click', '.contactFormSubmit', function(e) {
		e.preventDefault();

		//var form = $(this);
    	var form = $(this).closest('.contactForm');
    	var formData = new FormData();
    	var sendButton = $(this);
    	var sendButtonValue = sendButton.text();
        
        sendButton.hide();
        form.append('<span class="btn btn-yellow text-center contactFormSubmitTemposrary" style="display:inline-block">Отправка...</span>');

    	var formName = form.find("input[name=name]");
    	var formTel = form.find("input[name=phone]");
    	var formEmail = form.find("input[name=email]");
    	var formDescription = form.find("textarea[name=message]");
    	var formFile = form.find("input[name=upload_file]");

    	formData.append('name', formName.val());
    	formData.append('email', formEmail.val());

        if (formTel.length) {
            formData.append('phone', formTel.val());
        }

    	if (formDescription.length) {
    		formData.append('message', formDescription.val());
    	}

    	if (formFile.length) {
    		formData.append('upload_file', formFile[0].files[0]);
    	}

    	sendButton.text('Отправка...');

    	// reach goals

    	var formGoals = form.data('goals');

        if (formGoals) {

        	var array = formGoals.split(",");

        	if (typeof yaCounter934261 !== 'undefined') {
            	counter = yaCounter934261;

    			for (var key in array) {
    			    counter.reachGoal(array[key]);
    			}
            }

        }

    	// reach goals

	    $.ajax({
	        url         : '/wp-content/themes/mark_up/mail/send.php',
	        data        : formData,
	        cache       : false,
	        contentType : false,
	        processData : false,
	        type        : 'POST',
	        success     : function(data, textStatus, jqXHR){
	            sendButton.text(sendButtonValue);
                sendButton.show();
                $('.contactFormSubmitTemposrary').hide();
                $("input[name=name]").val('');
                $("input[name=phone]").val('');
                $("input[name=email]").val('');
                $("textarea[name=message]").val('');
                $("input[name=upload_file]").val('');
	            alert('Спасибо! Мы свяжемся с Вами в ближайшее время.');
                $('#modal-1').modal('hide');
	        },
	        error: function(jqXHR, textStatus, errorThrown){
	        	sendButton.text(sendButtonValue);
	        	alert('Произошла ошибка. Попробуйте отправить форму еще раз.');
	        }
	    });

	});

});