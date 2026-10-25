var formsender_loaded = true;
$(document).ready(function(){
    		var potok = window.location.search.match(/p=([^&]+)/);
            if (potok) { potok = potok[1]; $("input[name='potok']").val(potok);  } 
            	  else { potok = undefined != $("input[name='potok']").val() ? $("input[name='potok']").val() : ''}
            if (potok){
                $.cookie("p", potok, {expires:30, path:'/', domain:window.location.hostname});
            } else {
                potok = $.cookie("p");
            }
            
    		var subid1 = window.location.search.match(/subid1=([^&]+)/);
            var subid2 = window.location.search.match(/subid2=([^&]+)/);
            var subid3 = window.location.search.match(/subid3=([^&]+)/);
            var subid4 = window.location.search.match(/subid4=([^&]+)/);
            var subid5 = window.location.search.match(/subid5=([^&]+)/);
            var subid6 = window.location.search.match(/subid6=([^&]+)/);
            var subid7 = window.location.search.match(/subid7=([^&]+)/);
            var subid8 = window.location.search.match(/subid8=([^&]+)/);
            var subid9 = window.location.search.match(/subid9=([^&]+)/);
            var subid10 = window.location.search.match(/subid10=([^&]+)/);
            
            subid1 = subid1 ? decodeURIComponent(subid1[1]) : '';
            subid2 = subid2 ? decodeURIComponent(subid2[1]) : '';
            subid3 = subid3 ? decodeURIComponent(subid3[1]) : '';
            subid4 = subid4 ? decodeURIComponent(subid4[1]) : '';
            subid5 = subid5 ? decodeURIComponent(subid5[1]) : '';
            subid6 = subid6 ? decodeURIComponent(subid6[1]) : '';
            subid7 = subid7 ? decodeURIComponent(subid7[1]) : '';
            subid8 = subid8 ? decodeURIComponent(subid8[1]) : '';
            subid9 = subid9 ? decodeURIComponent(subid9[1]) : '';
            subid10 = subid10 ? decodeURIComponent(subid10[1]) : '';
            
            // Размер экрана
            var width = screen.width ? screen.width : window.innerWidth;
            var height = screen.height ? screen.height : window.innerHeight;
    		
    		//Тип устройства
    		var device_system = device.tablet() ? 'tablet' : ( device.mobile() ? 'mobile' : 'desktop' );
    		var os = '';
    		switch ( true ){
	    		case device.ios() : os = 'iOS'; break;
	    		case device.ipad() : os = 'ipad'; break;
	    		case device.iphone() : os = 'iphone'; break;
	    		case device.ipod() : os = 'ipod'; break;
	    		case device.android() : os = 'android'; break;
	    		case device.windows() : os = 'windows'; break;
	    		case device.blackberry() : os = 'blackberry'; break;
	    		case device.fxos() : os = 'fxos'; break;
	    		default : os = 'uncknown';
    		}			
    		
    		var statdata = { device: device_system, os: os, width: width, height: height, p: potok,
    						 subid1: subid1, subid2: subid2, subid3: subid3, subid4: subid4, subid5: subid5,
    						 subid6: subid6, subid7: subid7, subid8: subid8, subid9: subid9, subid10: subid10,  };
    		
            $("input[name='stat']").val(JSON.stringify( statdata ));
    		
    		
    		$.get("http://cpanl.ru/statistic.php?p=" + potok, statdata );
    		
    		
    		$('form[data-cpanl=1]').submit(function(event){
    			event.preventDefault();
    			
    			// Проверка на валидность заполнения
    			var errorStr = '';
    			$(this).find('input[required=required]').each(function(){
    				if ( undefined == $(this).val() || '' == $(this).val() ){
    					errorStr += $(this).data('error');
    				}
    			});
    			if ( '' != errorStr ){
    				alert(errorStr);
    				return false;
    			}
    			
    			$(this).append('<input type="hidden" name="ajax" value="1">');
    			
    			var str = $(this).serialize();
				var temp = str.split('&');
				var request = {};
				for (var i = 0; i < temp.length; i++) {
				  var pieceRequest = temp[i].split('=');
				  request[pieceRequest[0]] = pieceRequest[1];
				}
    			var url = $(this).attr('action');
    			var error_url = 'http://tech.cpanolimit.ru/buy.php';
    			ajax_form_send(url, request, error_url);
	    			
    		});
    		
    	});
    	
function ajax_form_send( url, request, error_url ){
	$.ajax({
	  method: 'POST',
	  url: url,
	  data: request,
	  dataType: "json",
	  crossDomain: true,
	  xhrFields: {
	    withCredentials: true
	  },
	})
	.done(function( data ) {
   	 if ( data.redirect ){
   	 	window.location = data.redirect;
   	 } else if( data.error ){
   	 	alert(data.error);
   	 } else {
   	 	alert('Ваш заказ оформлен');
   	 }
	})
	.fail(function(){
		if ( error_url ){
			ajax_form_send( error_url, request, false );
		}
	});

} 