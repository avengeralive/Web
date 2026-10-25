var portal_url = '<?php echo Backstage::gi()->TEMPLATE_URL; ?>';
        var backstage_portal_url = '<?php echo Backstage::gi()->portal_url; ?>';
		$(function() { 
			$('.fancybox').fancybox(); 
			var mobile_phone = '';
			var home_phone = '';
			$("#mobile").on('keyup', function(){
				for (i = 0; i < $("#mobile").val().length; i++)
				{
					if (($("#mobile").val()[i] >= 0 && $("#mobile").val()[i] <= 9) || $("#mobile").val()[i] == '+' || $("#mobile").val()[i] == ' ' || $("#mobile").val()[i] == '-') continue;
					else $("#mobile").val(mobile_phone);
				}
				mobile_phone = $("#mobile").val();
			});
			$("#home").on('keyup', function(){
				for (i = 0; i < $("#mobile").val().length; i++)
				{
					if (($("#home").val()[i] >= 0 && $("#home").val()[i] <= 9) || $("#home").val()[i] == '+' || $("#home").val()[i] == ' ' || $("#home").val()[i] == '-') continue;
					else $("#home").val(home_phone);
				}
				home_phone = $("#home").val();
			});
			$("#company_mobile").on('keyup', function(){
				for (i = 0; i < $("#mobile").val().length; i++)
				{
					if (($("#company_mobile").val()[i] >= 0 && $("#company_mobile").val()[i] <= 9) || $("#company_mobile").val()[i] == '+' || $("#company_mobile").val()[i] == ' ' || $("#company_mobile").val()[i] == '-') continue;
					else $("#company_mobile").val(mobile_phone);
				}
				mobile_phone = $("#company_mobile").val();
			});
			$("#company_home").on('keyup', function(){
				for (i = 0; i < $("#company_mobile").val().length; i++)
				{
					if (($("#company_home").val()[i] >= 0 && $("#company_home").val()[i] <= 9) || $("#company_home").val()[i] == '+' || $("#company_home").val()[i] == ' ' || $("#company_home").val()[i] == '-') continue;
					else $("#company_home").val(home_phone);
				}
				home_phone = $("#company_home").val();
			});
			
			$(".nav-link").on('click', function(){
				id = $(this).attr('data-id');
				$(".nav-link").removeClass('active');
				$(this).addClass('active');
				$(".tab-pane").removeClass('active');
				$("#" + id).addClass('active');
			});
		});