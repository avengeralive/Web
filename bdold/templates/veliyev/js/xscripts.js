$(function() {
    
    $(".offer-item").hover(
      function () {
        $(this).find('.offer-item__img img').css('border-color', '#cf0');
        $(this).find('.offer-item__title').css('color', '#044061');
      }, 
      function () {
        $('.offer-item__img img').css('border-color', '#c5de62');
        $('.offer-item__title').css('color', '#1475a8');
      }
    );  
    
    $(".offer-item").on("click", function(e) {
        $('#js-modal-registr').fadeIn(500);
        $("body").append("<div class='overlay' id='js-overlay'></div>").addClass("open-modal");
    });
    
    $(".js-login").on("click", function(e) {
//        e.preventDefault();
        var currentModal = $(this).attr("href");
        $(currentModal).fadeIn(500);
        $("body").append("<div class='overlay' id='js-overlay'></div>").addClass("open-modal");
    });
    
    $(".js-reg").on("click", function(e) {
//        e.preventDefault();
        var currentModal = $(this).attr("href");
        $(currentModal).fadeIn(500);
        $("body").append("<div class='overlay' id='js-overlay'></div>").addClass("open-modal");
    });
    
    $(".js-privacy").on("click", function(e) {
//        e.preventDefault();
        var currentModal = $(this).attr("href");
        $(currentModal).fadeIn(500);
        $("body").append("<div class='overlay' id='js-overlay'></div>").addClass("open-modal");
    });
    
    $(".js-login-btn").on("click", function(e) {
//        e.preventDefault();
        $(this).parent().parent().parent(".modal--login").fadeOut(500);
        $("#js-overlay").remove();
        var currentModal = $(this).attr("href");
        $(currentModal).fadeIn(500);
        $("body").append("<div class='overlay' id='js-overlay'></div>").addClass("open-modal");
    });
    
    $(".js-rules-btn").on("click", function(e) {
//        e.preventDefault();
        $(this).parent().parent().parent().parent(".modal--registr").fadeOut(500);
        $("#js-overlay").remove();
        var currentModal = $(this).attr("href");
        $(currentModal).fadeIn(500);
        $("body").append("<div class='overlay' id='js-overlay'></div>").addClass("open-modal");
    });
    
    $(".js-modal-close").on("click", function(e) {
        e.preventDefault();
        $(".js-modal").fadeOut(100);
        $("body").removeClass("open-modal");
        $("#js-overlay").remove();
    });
    
    $("body").on("click", "#js-overlay", function() {
        $(".js-modal").fadeOut(100);
        $("body").removeClass("open-modal");
        $("#js-overlay").remove();
    }); 
    
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            pass: {
                required: true,
                maxlength: 15
            }
        },
        submitHandler: function(form) {
            $(".errormsgLogin").hide();
            $(".errormsgLogin").css('color', 'red');
            var login_email = form.login_email.value;
            var login_password = form.login_password.value;
            
            $.ajax({
                    type: "POST",
                    url: "/post/_checkauth.php",
                    data: "check_login=1&login_email="+login_email+"&login_password="+login_password,
                    success:function(response){
                        var data = jQuery.parseJSON(response);
                        if(data.status == 0){
                            $(".errormsgLogin").hide(); 
                            form.submit();
                        }else{
                            $(".errormsgLogin").html(data.message);
                            $(".errormsgLogin").show();                           
                        }
                    }                   
            });         
        }        
    });
    
    $(registration_form).validate({
        rules: {
			registration_email:
				{
				email: true,
				required: true,
				minlength: 6,
				maxlength: 40
				},
			registration_skype:
				{
				required: true,
				minlength: 3,
				maxlength: 20
				},                                
			registration_password_1:
				{
				required: true,
				minlength: 6,
				maxlength: 40
				},
			registration_password_2:
				{
				required: true,
				minlength: 6,
				maxlength: 40,
				equalTo: "#registration_password_1"
				},	
			registration_tip:
				{
				required: true
				},				
			registration_agree_rules:
				{
				required: true
				}					
        },
        submitHandler: function(form) {
            $(".errormsgLogin").hide();
            $(".errormsgLogin").css('color', 'red');
            var registration_email = form.registration_email.value;
            
            $.ajax({
                    type: "POST",
                    url: "/post/_checkauth.php",
                    data: "check_signup=1&registration_email="+registration_email,
                    success:function(response){
                        var data = jQuery.parseJSON(response);
                        if(data.status == 0){
                            $(".errormsgLogin").hide(); 
                            form.submit();
                        }else{
                            $(".errormsgLogin").html(data.message);
                            $(".errormsgLogin").show();                           
                        }
                    }                   
            });         
        }        
    });
    
    $("#accessForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        submitHandler: function(form) {
            $(".errormsgLogin").hide();
            $(".errormsgLogin").css('color', 'red');
            var recover_email = form.recover_email.value;
        
            $.ajax({
                    type: "POST",
                    url: "/post/_checkauth.php",
                    data: "check_access=1&recover_email="+recover_email,
                    success:function(response){
                        var data = jQuery.parseJSON(response);
                        if(data.status == 0){
                            $(".errormsgLogin").hide();
                            form.submit();
                        }else{
                            $(".errormsgLogin").html(data.message);
                            $(".errormsgLogin").show();                           
                        }
                    }                   
            });         
        }          
    });
    
    $(".js-scroll").niceScroll({
        cursorcolor: "#495d68",
        cursorwidth: "15px",
        cursorborder: "none",
        cursorborderradius: "0",
        autohidemode: false,
        background: "#798c96",
        cursorminheight: 32,
        horizrailenabled: false,
        touchbehavior: true
    });
    
});