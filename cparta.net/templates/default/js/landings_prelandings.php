
<script>
    function check_prelandings()
    {
        var ch = $('.prelandings');
        var error = 1;
        for (var i = 0; i < ch.length; i++)
        {
            if (ch[i].checked) {
                error = 0;
                break;
            }
        }
        var vals = $('.prelandings:checkbox:checked').map(function (i, el)
        {
            return $(el).val();
        }).get().join(',');
        
        var land = '';     
        var preland = '';   
        var sub1stream = '';
        var sub2stream = '';
        var sub3stream = '';   
        var sub4stream = '';
        var sub5stream = '';
        if($('#landings').val() != '' && $('#landings').val() != 0){land = '&land='+$('#landings').val();}
        if($('.subid1').val() != '' && $('.subid1').val() != 0){sub1stream = '&subid1='+$('.subid1').val();}
        if($('.subid2').val() != '' && $('.subid2').val() != 0){sub2stream = '&subid2='+$('.subid2').val();}
        if($('.subid3').val() != '' && $('.subid3').val() != 0){sub3stream = '&subid3='+$('.subid3').val();}
        if($('.subid4').val() != '' && $('.subid4').val() != 0){sub4stream = '&subid4='+$('.subid4').val();}
        if($('.subid5').val() != '' && $('.subid5').val() != 0){sub5stream = '&subid5='+$('.subid5').val();}
                
        if (!vals)
        {
            $('#prelandings').val('0');
        } else
        {
            var preland = '&preland='+vals;          
            $('#prelandings').val(vals);
        }
        var streamhref = './streams.php?offer=<?=$offer_id; ?>'+land+preland+sub1stream+sub2stream+sub3stream+sub4stream+sub5stream; 
        $('#urlstream').attr('href', streamhref);
        $('#partnerlink').val('http://<?php echo $domain; ?>/?p=' + partnerstroka_encode('<?php echo $user_id; ?>-<?php echo $offer_id; ?>-' + $('#prelandings').val() + '-' + $('#landings').val()) + $('#subid1').val() + $('#subid2').val() + $('#subid3').val() + $('#subid4').val() + $('#subid5').val());
        $("#btn-copy").attr("data-clipboard-text", $('#partnerlink').val());
    }

    function check_iframe()
    {

        $('#iframecode').val('<sc' + 'r' + 'ipt type="text/javascript">document.write(\'<iframe src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/iframe/' + partnerstroka_encode('<?php echo $user_id; ?>-<?php echo $offer_id; ?>') + '/\' +  document.referrer + \'/" width="240" height="220" style="border:none" frameborder="0"></iframe>\');</sc' + 'r' + 'ipt>');
                $("#btn-copy-iframecode").attr("data-clipboard-text", $('#iframecode').val());
    }
            $(document).off('click').on('click', '#js-smartab', check_landings);
            function check_landings()
            {
                var ch = $('.landings');
                var error = 1;
                for (var i = 0; i < ch.length; i++)
                {
                    if (ch[i].checked) {
                        error = 0;
                        break;
                    }
                }
                if (error)
                {
                    $('.hidden_partnerlink').animate({height: 'hide'}, 500);
                    $('.hidden_deeplink').animate({height: 'hide'}, 500);
                    $('#selectSubId').animate({height: 'hide'}, 500);
                } else
                {
                    $('.hidden_partnerlink').animate({height: 'show'}, 500);
                    $('.hidden_deeplink').show();
                    $('#selectSubId').show();
                }
                var vals = $('.landings:checkbox:checked').map(function (i, el)
                {
                    return $(el).val();
                }).get().join(',');
                     
                var land = '';     
                var preland = '';   
                var sub1stream = '';
                var sub2stream = '';
                var sub3stream = '';  
                var sub4stream = ''; 
                var sub5stream = ''; 
                
                if($('#prelandings').val() != '' && $('#prelandings').val() != 0){preland = '&preland='+$('#prelandings').val();}
                if($('.subid1').val() != '' && $('.subid1').val() != 0){sub1stream = '&subid1='+$('.subid1').val();}
                if($('.subid2').val() != '' && $('.subid2').val() != 0){sub2stream = '&subid2='+$('.subid2').val();}
                if($('.subid3').val() != '' && $('.subid3').val() != 0){sub3stream = '&subid3='+$('.subid3').val();}
                if($('.subid4').val() != '' && $('.subid4').val() != 0){sub4stream = '&subid4='+$('.subid4').val();}
                if($('.subid5').val() != '' && $('.subid5').val() != 0){sub5stream = '&subid5='+$('.subid5').val();}
                
                if (!vals)
                {
                    $('#landings').val('0');
                } else
                {                  
                    land = '&land='+vals;              
                    $('#landings').val(vals);
                }
                var streamhref = './streams.php?offer=<?=$offer_id; ?>'+land+preland+sub1stream+sub2stream+sub3stream+sub4stream+sub5stream;
                $('#urlstream').attr('href', streamhref);
                $('#partnerlink').val('http://<?php echo $domain; ?>/?p=' + partnerstroka_encode('<?php echo $user_id; ?>-<?php echo $offer_id; ?>-' + $('#prelandings').val() + '-' + $('#landings').val()) + $('#subid1').val() + $('#subid2').val() + $('#subid3').val() + $('#subid4').val() + $('#subid5').val() + ($('#js-smartab').prop('checked') ? '&sab' : ''));
                $("#btn-copy").attr("data-clipboard-text", $('#partnerlink').val());
            }
            function check_subid()
            {
                var ch1 = $('.subid1');
                var ch2 = $('.subid2');
                var ch3 = $('.subid3');
                var ch4 = $('.subid4');
                var ch5 = $('.subid5');
                var error1 = 1;
                var error2 = 1;
                var error3 = 1;
                var error4 = 1;
                var error5 = 1;
                for (var i = 0; i < ch1.length; i++) {
                    if (ch1[i].checked) {
                        error1 = 0;
                        break;
                    }
                }
                for (var i = 0; i < ch2.length; i++) {
                    if (ch2[i].checked) {
                        error2 = 0;
                        break;
                    }
                }
                for (var i = 0; i < ch3.length; i++) {
                    if (ch3[i].checked) {
                        error3 = 0;
                        break;
                    }
                }
                for (var i = 0; i < ch4.length; i++) {
                    if (ch4[i].checked) {
                        error4 = 0;
                        break;
                    }
                }
                for (var i = 0; i < ch5.length; i++) {
                    if (ch5[i].checked) {
                        error5 = 0;
                        break;
                    }
                }                
                var vals1 = $('.subid1').map(function (i, el) {
                    return $(el).val();
                }).get().join(',');
                var vals2 = $('.subid2').map(function (i, el) {
                    return $(el).val();
                }).get().join(',');
                var vals3 = $('.subid3').map(function (i, el) {
                    return $(el).val();
                }).get().join(',');
                var vals4 = $('.subid4').map(function (i, el) {
                    return $(el).val();
                }).get().join(',');
                var vals5 = $('.subid5').map(function (i, el) {
                    return $(el).val();
                }).get().join(',');
                
                var sub1stream = '';
                var sub2stream = '';
                var sub3stream = '';
                var sub4stream = '';
                var sub5stream = '';
                
                if (!vals1) {
                    $('#subid1').val('');
                } else {
                    sub1stream = '&subid1='+ vals1;
                    $('#subid1').val('&subid1=' + vals1);
                }
                if (!vals2) {
                    $('#subid2').val('');
                } else {
                    sub2stream = '&subid2='+ vals2;
                    $('#subid2').val('&subid2=' + vals2);
                }
                if (!vals3) {
                    $('#subid3').val('');
                } else {
                    sub3stream = '&subid3='+ vals3;
                    $('#subid3').val('&subid3=' + vals3);
                }
                if (!vals4) {
                    $('#subid4').val('');
                } else {
                    sub4stream = '&subid4='+ vals4;
                    $('#subid4').val('&subid4=' + vals4);
                }
                if (!vals5) {
                    $('#subid5').val('');
                } else {
                    sub5stream = '&subid5='+ vals5;
                    $('#subid5').val('&subid5=' + vals5);
                }                
                
                if($('#landings').val() != '' && $('#landings').val() != 0){var land = '&land='+$('#landings').val();} else {var land = '';}
                if($('#prelandings').val() != '' && $('#prelandings').val() != 0){var preland = '&preland='+$('#prelandings').val();} else {var preland = '';}
                
                var streamhref = './streams.php?offer=<?=$offer_id; ?>'+land+preland+sub1stream+sub2stream+sub3stream+sub4stream+sub5stream;
                $('#urlstream').attr('href', streamhref);
                $('#partnerlink').val('http://<?php echo $domain; ?>/?p=' + partnerstroka_encode('<?php echo $user_id; ?>-<?php echo $offer_id; ?>-' + $('#prelandings').val() + '-' + $('#landings').val()) + $('#subid1').val() + $('#subid2').val() + $('#subid3').val() + $('#subid4').val() + $('#subid5').val());
                $("#btn-copy").attr("data-clipboard-text", $('#partnerlink').val());
            }

            $('#deeplinkurl').on("keyup", function () {
                if ($('#deeplinkurl').val() != '' && $('#deeplinkurl').val() != 0) {
                    $('#partnerlink').val('http://' + $('#deeplinkurl').val() + '/?stats=' + partnerstroka_encode('<?php echo $user_id; ?>-<?php echo $offer_id; ?>-' + $('#prelandings').val() + '-' + $('#landings').val()) + $('#subid1').val() + $('#subid2').val() + $('#subid3').val() + $('#subid4').val() + $('#subid5').val());
                    $("#btn-copy").attr("data-clipboard-text", $('#partnerlink').val());
                } else {
                    $('#partnerlink').val('http://<?php echo $domain; ?>/?p=' + partnerstroka_encode('<?php echo $user_id; ?>-<?php echo $offer_id; ?>-' + $('#prelandings').val() + '-' + $('#landings').val()) + $('#subid1').val() + $('#subid2').val() + $('#subid3').val() + $('#subid4').val() + $('#subid5').val());
                    $("#btn-copy").attr("data-clipboard-text", $('#partnerlink').val());
                }
            });


            $('.subid1').on("keyup", function () {
                if (this.value.search(/[^0-9a-zA-Z{}_]/g) != -1) {
                    this.value = this.value.replace(/[^0-9a-zA-Z{}]/g, '');
                }
            });
            $('.subid2').on("keyup", function () {
                if (this.value.search(/[^0-9a-zA-Z{}_]/g) != -1) {
                    this.value = this.value.replace(/[^0-9a-zA-Z{}]/g, '');
                }
            });
            $('.subid3').on("keyup", function () {
                if (this.value.search(/[^0-9a-zA-Z{}_]/g) != -1) {
                    this.value = this.value.replace(/[^0-9a-zA-Z{}]/g, '');
                }
            });
            $('.subid4').on("keyup", function () {
                if (this.value.search(/[^0-9a-zA-Z{}_]/g) != -1) {
                    this.value = this.value.replace(/[^0-9a-zA-Z{}]/g, '');
                }
            });
            $('.subid5').on("keyup", function () {
                if (this.value.search(/[^0-9a-zA-Z{}_]/g) != -1) {
                    this.value = this.value.replace(/[^0-9a-zA-Z{}]/g, '');
                }
            });
            $('#teser_set').on("change", function () {
                
                var teaser = this.value;
                console.log(teaser);
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
                if(subsSets[teaser]['sub1'] != ''){$('#subid1').val('&subid1='+subsSets[teaser]['sub1']);$('.subid1').val(subsSets[teaser]['sub1']);}
                if(subsSets[teaser]['sub2'] != ''){$('#subid2').val('&subid2='+subsSets[teaser]['sub2']);$('.subid2').val(subsSets[teaser]['sub2']);}
                if(subsSets[teaser]['sub3'] != ''){$('#subid3').val('&subid3='+subsSets[teaser]['sub3']); $('.subid3').val(subsSets[teaser]['sub3']);}
                if(subsSets[teaser]['sub4'] != ''){$('#subid4').val('&subid4='+subsSets[teaser]['sub4']);$('.subid4').val(subsSets[teaser]['sub4']);}
                if(subsSets[teaser]['sub5'] != ''){$('#subid5').val('&subid5='+subsSets[teaser]['sub5']);$('.subid5').val(subsSets[teaser]['sub5']);}
                check_landings();         
            });	
</script>
