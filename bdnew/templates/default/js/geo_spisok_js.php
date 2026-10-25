
<script>
$(document).ready(function(){
	
	$.ajax(
		{
		type: "POST",
		url: "<?php echo site_url(); ?>/templates/<?php echo $template; ?>/js/geo_spisok.php",
		data: { action: 'showCountry' },
		cache: false,
		success: function(responce){ $('#countryBlock').html(responce);
       
    }
		});
		
		
	$("body").on("click", "#addCountry", function () {	
		//var count = $('#geosp').attr('data-nextcount');
		//var prevCount = count-1;

		//var lastCountry = $('#geotraf').filter(":last").find('select').val();
		
		//if(lastCountry != 0){
			//count++;
			//$('#geosp').attr('data-nextcount', count);
			var body = $('#geotraf');
			var tr =  $('<tr height="50px">');
			var td1 =  $('<td class="text-center align-middle">');var td2 =  $('<td class="text-center align-middle">');var td3 =  $('<td class="text-center align-middle">');

			$.ajax(
				{
				type: "POST",
				url: "<?php echo site_url(); ?>/templates/<?php echo $template; ?>/js/geo_spisok.php",
				data: { action: 'showCountry' },
				cache: false,
				success: function(responce){ td1.html(responce); }
				});			
			
			td2.html('<select name="region[]" class="regions width-200"><option value="0"><?php echo $loc['offers.php']['t154'] ?></option></select>');
			td3.html('<table style="width:100%;"><tr><td style="border:none;width:50%;"><input type="text" name="cena[]" style="width: 50px; text-align: center;" maxlength="10" value="">&nbsp;<span class="curr"><?php echo $loc['offers.php']['t17']; ?></span>&nbsp;</td><td style="border:none;width:50%;"><input type="text" name="comission[]" style="width: 50px; text-align: center;" maxlength="10" value="">&nbsp;<select class="width-100" name="tip_comission[]"><option value="1">&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;</option><option value="2">&nbsp;<?php echo $loc['offers.php']['t18']; ?>&nbsp;</option></select></td></tr></table>');
			tr.append(td1);tr.append(td2);tr.append(td3);
			body.append(tr);
                       
		//}else{
		//	alert('Укажите предыдущую страну.');
		//}
	});
	$("body").on("click", "#addCountryAdmin", function () {	
		//var count = $('#geosp').attr('data-nextcount');
		//var prevCount = count-1;

		//var lastCountry = $('#geotraf').filter(":last").find('select').val();
		
		//if(lastCountry != 0){
			//count++;
			//$('#geosp').attr('data-nextcount', count);
			var body = $('#geotraf');
			var tr =  $('<tr height="70px">');
			var td1 =  $('<td class="align-middle">');var td2 =  $('<td class="text-center align-middle">');var td3 =  $('<td class="text-center align-middle">');

			$.ajax(
				{
				type: "POST",
				url: "<?php echo site_url(); ?>/templates/<?php echo $template; ?>/js/geo_spisok.php",
				data: { action: 'showCountry' },
				cache: false,
				success: function(responce){ td1.html(responce); 
                      
    }
				});			
			
			td2.html('<select name="region[]" class="regions width-200"><option value="0"><?php echo $loc['offers.php']['t154'] ?></option></select>');
			td3.html('<table style="width:100%;"><tr><td style="border:none;width:184px;padding: 0;"><input type="text" name="cena[]" style="vertical-align: middle;width: 50px; text-align: center;" maxlength="10" value="">&nbsp;<span class="curr"><?php echo $loc['offers.php']['t17']; ?></span>&nbsp;</td><td style="border:none;width:184px;padding: 0;"><input type="text" name="comission[]" style="vertical-align: middle;width: 50px; text-align: center;" maxlength="10" value="">&nbsp;<select class="width-100" name="tip_comission[]"><option value="1">&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;</option><option value="2">&nbsp;<?php echo $loc['offers.php']['t18']; ?>&nbsp;</option></select></td><td style="border:none;width:184px;padding: 0;"><input type="text" name="comission_cpa[]" style="vertical-align: middle;width: 50px; text-align: center;" maxlength="10" value=""> <select class="width-100" name="tip_comission_cpa[]"><option value="1">&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;</option><option value="2">&nbsp;<?php echo $loc['offers.php']['t18']; ?>&nbsp;</option></select></td></tr></table>');
			tr.append(td1);tr.append(td2);tr.append(td3);
                        tr.append('<td class="js-delete-country text-center align-middle">x</td>');
			body.append(tr);
                       
		//}else{
		//	alert('Укажите предыдущую страну.');
		//}
	});	
});
	function setRegion(block) {
             
		var nextTD = $(block).closest('td').next('td');
		var nextTD2 = nextTD.next('td');
		var country = $(block).val();
		if(!country)
			{
			nextTD.html('<select name="region[]" class="width-200"><option value="0">Не указано</option></select>');
                       
			}
		else
			{
            $.ajax(
				{
				type: "POST",
				url: "<?php echo site_url(); ?>/templates/<?php echo $template; ?>/js/geo_spisok.php",
				data: { action: 'showRegionForInsert', country: country},
				cache: false,
				success: function(responce){
					var message = jQuery.parseJSON(responce);
					nextTD.html(message.content); 
					nextTD2.find('.curr').html(message.currency);                                       
				}
				});
			};
                       
	};
        
    $(document).on('click', '.js-delete-country', function () {
        if (!confirm("Удалить страну?"))
            return false;
        $(this).parent('tr').fadeOut(function () {
            $(this).remove();
        })
        return false;
    })
		
</script>