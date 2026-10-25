	<script>
		$(document).ready(function () {
			$('.landings').change(function(){
			var vals = $(this).val();
				if(!vals) 
					{
					$('#landings').val('0');
					}
				else
					{
					$('#landings').val(vals); 
					}
				
			});               
			
			$(".Postback_faq").on('click', function () {
				$('.helpPostback').toggle();
			});	
			$(".metrika_faq").on('click', function () {
				$('.helpmetrika').toggle();
			});	
			$(".vk_faq").on('click', function () {
				$('.helpvk').toggle();
			});	
			$(".facebook_faq").on('click', function () {
				$('.helpfacebook').toggle();
			});	
			$(".mail_faq").on('click', function () {
				$('.helpmail').toggle();
			});	
			$(".directadvert_faq").on('click', function () {
				$('.helpdirectadvert').toggle();
			});		
			$(".mytarget_macros_faq").on('click', function () {
				$('.help_mytarget_macros').toggle();
			});
                        
                        $(".tr_back_faq").hover(
                          function () {
                            $('.helpTrBack').show();
                          }, 
                          function () {
                            $('.helpTrBack').hide();
                          }
                        );                        
                        
		});	
			
		function partnerstroka_encode(text) 
			{
			var delimiter = ['-', ','];
			var delimiter_rep = ['n', 'z'];
			var table = ['a', 'B', 'p', 't', 'E', 'w', 'G', 'u', 'q', 'J'];
			var str = '';
			var ok = 0;
			for (var i = 0; i < delimiter.length; i++) 
				{
				if ((text.toLowerCase().indexOf(delimiter[i].toLowerCase()) > -1) && text.length >= 3) 
					{
					ok++;
					break;
					}
				}
			if (ok == 0)
			return false;
			var data = [];
			for (var i = 0; i < text.length; i++) 
				{
				if (text.charAt(i) != ' ' && text.charAt(i) != '')
				data.push(text.charAt(i));
				}
			data.forEach(function (value, key, arr) 
				{
				var ok_key = 0;
				for (var i = 0; i < delimiter.length; i++) 
					{
					if (value == delimiter[i])
					ok_key++;
					}
				if (ok_key == 0)
				data[key] = table[value];
				str += data[key];
				});
			for (var i = 0; i < delimiter.length; i++) 
				{
				str = str.replace(new RegExp(delimiter[i], 'g'), delimiter_rep[i])
				}
			return str;
			}
			
			

			
	
		function check_iframe()
			{
			$('.hidden_iframeform').toggle();
			$('.ifFrameHide').toggle();
			$('#iframecode').val('<sc'+'r'+'ipt type="text/javascript">document.write(\'<iframe src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/iframe/'+partnerstroka_encode('<?php echo $user_id; ?>-<?php echo $offer_id; ?>')+'/\' +  document.referrer + \'/" width="240" height="220" style="border:none" frameborder="0"></iframe>\');</sc'+'r'+'ipt>');
			$("#btn-copy-iframecode").attr("data-clipboard-text",$('#iframecode').val());
			}	
			
			
			
		$('#subid1').on("keyup", function() {if (this.value.search(/[^0-9a-zA-Z<>{}\[\]_]/g) != -1) {this.value = this.value.replace(/[^0-9a-zA-Z<>{}\[\]_]/g, '');}});			
		$('#subid2').on("keyup", function() {if (this.value.search(/[^0-9a-zA-Z<>{}\[\]_]/g) != -1) {this.value = this.value.replace(/[^0-9a-zA-Z<>{}\[\]_]/g, '');}});			
		$('#subid3').on("keyup", function() {if (this.value.search(/[^0-9a-zA-Z<>{}\[\]_]/g) != -1) {this.value = this.value.replace(/[^0-9a-zA-Z<>{}\[\]_]/g, '');}});	
                $('#subid4').on("keyup", function() {if (this.value.search(/[^0-9a-zA-Z<>{}\[\]_]/g) != -1) {this.value = this.value.replace(/[^0-9a-zA-Z<>{}\[\]_]/g, '');}});
                $('#subid5').on("keyup", function() {if (this.value.search(/[^0-9a-zA-Z<>{}\[\]_]/g) != -1) {this.value = this.value.replace(/[^0-9a-zA-Z<>{}\[\]_]/g, '');}});
                
            $('#teser_set').on("change", function () {
                var teaser = this.value;
                var subsSets = {};
                var subsSets = {
                    0:{"sub1":"","sub2":"","sub3":"","sub4":"","sub5":""},
                    1:{"sub1":"{{advertiser_id}}","sub2":"{{campaign_id}}","sub3":"{{banner_id}}","sub4":"{{gender}}","sub5":"{{age}}"},
                    2:{"sub1":"actionteaser","sub2":"[SID]","sub3":"[ID]","sub4":"","sub5":""},
                    3:{"sub1":"{ad_id}","sub2":"{click_id}","sub3":"{site_id}","sub4":"","sub5":""},
                    4:{"sub1":"[CID]","sub2":"[SID]","sub3":"[TID]","sub4":"","sub5":""},
                    5:{"sub1":"bodyclick","sub2":"[SID]","sub3":"[ID]","sub4":"","sub5":""},
                    6:{"sub1":"etarg","sub2":"{{site_id}}","sub3":"{{teaser_id}}","sub4":"","sub5":""},
                    7:{"sub1":"globaltizer","sub2":"{sid}","sub3":"{tid}","sub4":"","sub5":""},
                    8:{"sub1":"redtram","sub2":"{GOOD_ID}","sub3":"{SITE_NAME}","sub4":"","sub5":""},
                    9:{"sub1":"[CID]","sub2":"[SID]","sub3":"[ID]","sub4":"","sub5":""},
                    10:{"sub1":"marketgid","sub2":"{widget_id}","sub3":"{teaser_id}","sub4":"","sub5":""},
                    11:{"sub1":"[SID]","sub2":"[CID]","sub3":"[TID]","sub4":"","sub5":""},
                    12:{"sub1":"[CID]","sub2":"[SID]","sub3":"[ID]","sub4":"","sub5":""},
                    13:{"sub1":"[camp_id]","sub2":"[ad_id]","sub3":"[place_id]","sub4":"","sub5":""},
                    14:{"sub1":"novostimira","sub2":"{nm_g}","sub3":"{nm_inf_g}","sub4":"","sub5":""},
                    15:{"sub1":"Oblivki","sub2":"[TID]","sub3":"[CID]","sub4":"[SID]","sub5":""},
                    16:{"sub1":"octobird","sub2":"{OB_SITE_ID}","sub3":"","sub4":"","sub5":""},
                    17:{"sub1":"{SiteCategoryID}","sub2":"{SiteID}","sub3":"{OfferID}","sub4":"","sub5":""},
                    18:{"sub1":"{{catid}}","sub2":"{{domain}}","sub3":"{{tid}}","sub4":"","sub5":""},
                    19:{"sub1":"tizernet","sub2":"[SITE_ID]","sub3":"[TEASER_ID]","sub4":"","sub5":""},
                    20:{"sub1":"tovarro","sub2":"{teaser_id}","sub3":"{widget_id}","sub4":"","sub5":""},
                    21:{"sub1":"visitweb","sub2":"{SITE}","sub3":"{AD}","sub4":"","sub5":""},
                    22:{"sub1":"yottos","sub2":"{source}","sub3":"{content}","sub4":"","sub5":""}
                };                           
                $('#subid1').val(subsSets[teaser]['sub1']);
                $('#subid2').val(subsSets[teaser]['sub2']);
                $('#subid3').val(subsSets[teaser]['sub3']);
                $('#subid4').val(subsSets[teaser]['sub4']);
                $('#subid5').val(subsSets[teaser]['sub5']);
            });		
            
            $('#add_trafback_country').on("click", function () {
                var rowCount = $('#trafback_list tr').length; 
                var selectData;
                if(rowCount < 13){          

                    $.ajax({
                            type: "POST",
                            url: "<?php echo site_url(); ?>/templates/<?php echo $template; ?>/js/geo_spisok.php",
                            data: { action: 'showCountryWeb' },
                            cache: false,
                            success: function(responce){ 
                                var tr = $('<tr>'); 
                                var ceil1 = $('<td>');
                                var ceil2 = $('<td>');
                                var ceil3 = $('<td class="js-delete-country"><img style="cursor:pointer;width: 15px;" src="./templates/<?php echo $template; ?>/img/ico_delete.png" border="0"></td>');
                                ceil1.html(''+responce+'');
                                ceil2.html('<input type="text" name="url_trafback[]" value="http://">');
                                tr.prepend(ceil3);tr.prepend(ceil2);tr.prepend(ceil1); 
                                $('#trafback_list > tbody:last').append(tr);                                
                            }
                            });	                    
                    

                } 
            });	 
                    
            
            $(document).on('click', '.js-delete-country', function () {
                $(this).parent('tr').fadeOut(function () {
                    $(this).remove();
                })
                return false;
            });       

            $(document).on('click', '.setcountrys', function () {
                $(this).parent('ul').hide();
                var name_country =  $(this).attr('data-name'); 
                var iso_country =  $(this).attr('data-iso');
                $(this).parent().prev('.countries-name').val(name_country);
                $(this).parent().prev('.countries-name').css('border','none');
                $(this).parent().prev('.countries-name').css('width','auto');
                $(this).parent().prev('.countries-name').css("background-image","url('./modules/detectclient/SxGeo/img/"+iso_country.toLowerCase()+".png')");
                $(this).parent().prev('.countries-name').css('background-repeat','no-repeat');
                $(this).parent().prev('.countries-name').css('background-position','center left');
                $(this).parent().prev('.countries-name').css('padding-left','25px');
                $(this).parent().prev('.countries-name').attr('readonly','readonly');
                $(this).parent().next('input[name="countries_iso[]"]').val(iso_country);
            });   
	</script>
	
