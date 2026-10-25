$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', '#sms-verify', function () {
        var $modal = $('#modal-sms');
        $modal.modal('show');
        $.ajax({
            url: './post/verifysms.php',
            type: 'POST',
            data: 'mode=1',
        });
    })

    $(document).on('click', '.verify_paysys', function () {
        var purse = $(this).parent('.form-group').parent('.row').prev('.purse').children('.form-control');
        purse.css('border', '1px solid #ced4da');
        if(purse.val() != null && purse.val().length > 9){
            $(this).removeClass('verify_paysys');
            $(this).addClass('paysys_code');
            $(this).parent('.form-group').next('.code-input').show();
            $.ajax({
                url: './post/verifysms.php',
                type: 'POST',
                data: 'mode=1',
                success: function (response) {
                    data = jQuery.parseJSON(response);
                    new Noty({
                      text: data.message,
                      type: data.status,
                      theme: 'nest',
                      timeout: 3000,
                      closeWith: ['click', 'button'],
                      layout: 'topRight'
                    }).show();
                }
            });
        }else{
            purse.css('border', '2px solid red');
        }
    })
    
    $(document).on('click', '.paysys_code', function () {
        var purse = $(this).parent('.form-group').parent('.row').prev('.purse').children('.form-control');
        var code = $(this).parent('.form-group').next('.code-input').children('.form-control').val();
        var paysys = $(this).attr('data-paysys');
        purse.css('border', '1px solid #ced4da');
        if(purse.val() != null && purse.val().length > 9){
            if(code != null && code.length > 3){
                $.ajax({
                    url: './post/verifysms.php',
                    type: 'POST',
                    data: 'mode=4&code='+code+'&purse='+purse.val()+'&paysys='+paysys,
                    success: function (response) {
                        data = jQuery.parseJSON(response);
                        new Noty({
                          text: data.message,
                          type: data.status,
                          theme: 'nest',
                          timeout: 3000,
                          closeWith: ['click', 'button'],
                          layout: 'topRight'
                        }).show();
                    }
                });
            }
        }else{
            purse.css('border', '2px solid red');
        }
    })

    $(document).on('click', '#smscodecheck', function () {
        var code = $('#sms-check').val();
        $.ajax({
            url: './post/verifysms.php',
            type: 'POST',
            data: 'code=' + code + '&mode=2',
            success: function (response) {
                data = jQuery.parseJSON(response);
                status = data.status;
                if(status == 'error'){
                    new Noty({
                      text: data.message,
                      type: 'error',
                      theme: 'nest',
                      timeout: 3000,
                      closeWith: ['click', 'button'],
                      layout: 'topRight'
                    }).show();
                }else{
                    window.location = './profile.php?verifysms';
                }
            }
        });
    })
    
    
    $(document).on('click', '.js-download', function () {
        var was = $(this).text();
        var id = $(this).attr('data-id');

        $.ajax({
            url: './post/getland.php',
            type: "POST",
            data: 'getGeo=1&land=' + $(this).data('id'),
            success: function (response) {
                data = jQuery.parseJSON(response);
                $('#countrySelect').html(data.options);
                $('#js-download-final').attr('data-offer', data.offer);
                $('#js-download-final').attr('data-land', data.landing);
                $('#downloadLanding').modal('show');
            }
        });
    });
    
    $(document).on('click', '#js-download-final', function () {
        var geo = $('#countrySelect').val();
        var offer = $(this).attr('data-offer');
        var land = $(this).attr('data-land');
        var stream = $(this).attr('data-stream');
        $.ajax({
            url: './post/getland.php',
            type: "POST",
            data: 'getLand&land=' +land+ '&offer='+offer+'&geo='+geo+'&stream='+stream,
            
            success: function (response) {

                var $a = $('<a />', {
                    'href': response,
                    'download': offer + '-' + land +'.zip',
                    'text': "click"
                    }).hide().appendTo("body")[0].click();
                    
            }
            
        });


        console.log(geo);
    });
    
    

    
    $(document).on('click', '.js-telegram', function () {
        var was = $(this).css('color');
        $(this).css({
            color: '#ccc',
        });
        $.post('?', {
            action: 'telegram',
            msg: $(this).data('message')
        }, 'json');
        var that = this;
        setTimeout(function () {
            $(that).css('color', was);
        }, 1000);
    })

    $(".deeplink_faq").hover(
            function () {
                $('.helpDeeplink').show();
            },
            function () {
                $('.helpDeeplink').hide();
            }
    );

    $(".promo").hover(
        function () {
            var textBlock = $(this).find('.promo-title');
            var descrBlock = $(this).find('.promo-descr');
            textBlock.css('top', 0);
            textBlock.css('padding-top', '50px');
            descrBlock.show();
        },
        function () {
            var textBlock = $(this).find('.promo-title');
            var descrBlock = $(this).find('.promo-descr');
            textBlock.css('top', '');
            textBlock.css('padding-top', '15px');
            descrBlock.hide();
            
        }
    );


    $(".lendings_faq").hover(
            function () {
                $('.helpLendings').show();
            },
            function () {
                $('.helpLendings').hide();
            }
    );
    $("#faqHold").hover(
            function () {
                $('.faqHold').show();
            },
            function () {
                $('.faqHold').hide();
            }
    );
    $("#faqPostclick").hover(
            function () {
                $('.faqPostclick').show();
            },
            function () {
                $('.faqPostclick').hide();
            }
    );
    $("#faqdate_end").hover(
            function () {
                $('.faqdate_end').show();
            },
            function () {
                $('.faqdate_end').hide();
            }
    );
    $("#faqkolvo_lids").hover(
            function () {
                $('.faqkolvo_lids').show();
            },
            function () {
                $('.faqkolvo_lids').hide();
            }
    );

});


function loadTable(req) {
    loader('start');
    $('#js-ajax-content').load(req + ' #js-ajax-content', function () {
        loader('stop');
    });
}

$(document).on('submit', '.js-ajax-filter', function () {
    var req = $(this).serialize();
    loadTable('?' + req);
    return false;
})
$(document).on('submit', '.js-ajax-filter2', function () {
    var land = $('#landchange').val();
    var preland = $('#prelandchange').val();
    $('#landings').val(land);
    $('#prelandings').val(preland);
    var req = $(this).serialize();
    loadTable('?' + req);
    return false;
})
var timer = false;
$(document).on('click', 'a.sortslink , a.viewstats', function () {


    loadTable('' + $(this).attr('href'));
    return false;
})
$(document).on('click', 'a.viewstats', function () {

    $('#types').val($(this).attr('data-type'));
    loadTable('' + $(this).attr('href'));
    return false;
})
$(document).on('click', 'a.viewstatsSub', function () {
    $('#subidS').val($(this).attr('data-sub'));
    loadTable('' + $(this).attr('href'));
    return false;
})
$(document).on('change', '#datepicker', function () {
    if (timer) {
        clearTimeout(timer);
    }
    timer = setTimeout(function () {
        $('.js-ajax-filter').submit();
    }, 300);
})
$(document).on('change', '.js-ajax-filter input[type="text"]', function () {
    if (timer) {
        clearTimeout(timer);
    }
    timer = setTimeout(function () {
        $('.js-ajax-filter').submit();
    }, 300);
})
$(document).on('change', '.js-ajax-filter select', function () {
    $('#landings').val(0);
    $('#prelandings').val(0);
    $('.js-ajax-filter').submit();
})
$(document).on('change', '.js-ajax-filter2 select', function () {
    $('.js-ajax-filter2').submit();
})

function loader(type) {
    if (type == 'start') {
        $('#loader').show();
    } else {
        $('#loader').hide();
    }
}
function autocomplet(type) {
    var min_length = 1;
    var keyword = $('#namesubid' + type).val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: './post/checkSubsId.php',
            type: 'POST',
            data: 'keyword=' + keyword + '&mode=' + type,
            success: function (data) {
                $('#namesubid' + type + '_list').show();
                $('#namesubid' + type + '_list').html(data);
            }
        });
    } else {
        $('#namesubid' + type + '_list').hide();
    }
}
function autocompletOffer() {
    var min_length = 0;
    var keyword = $('#offer_name').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: './post/checkSubsId.php',
            type: 'POST',
            data: 'keyword=' + keyword + '&mode=6',
            success: function (data) {
                $('#offer_id_list').show();
                $('#offer_id_list').html(data);
                if (keyword == '') {
                    $('#offer_id').val(0);
                }
            }
        });
    } else {
        $('#offer_id_list').hide();
        $('#offer_id').val(0);
    }
}

function set_item(item, type) {
    $('#namesubid' + type).val(item);
    $('#namesubid' + type + '_list').hide();
}
function set_offer(item, name) {
    $('#offer_name').val(name);
    $('#offer_id').val(item);
    $('#offer_id_list').hide();
    $('.js-ajax-filter').submit();
}
$(function () {
    $(document).click(function (event) {
        if ($(event.target).closest(".listAutoComplete").length)
            return;
        $('.listAutoComplete').hide();
        event.stopPropagation();
    });
});

function changeDateEnd(offer_url, offer) {
    $('#dateEnd').html('<form method="post" action="./offers.php?' + offer_url + '"><input name="offers_end_date" id="offers_end_date" value="" style="width: 70px; text-align: center;"> <input name="offers_end_time" id="offers_end_time" value="" style="width: 50px; text-align: center;"><input type="hidden" name="changeDateR" value="1"><input type="hidden" name="offer_id" value="' + offer + '"> <button class="btn1" onclick="">ok</button></form>');
    $("#offers_end_date").mask("99.99.9999", {placeholder: "дд.мм.гггг"});
    $("#offers_end_time").mask("99:99", {placeholder: "чч:мм"});
}
function changeDateEndAdmin() {
    $('#dateEnd').html('<input name="offers_end_date" id="offers_end_date" value="" style="width: 70px; text-align: center;"> <input name="offers_end_time" id="offers_end_time" value="" style="width: 50px; text-align: center;">');
    $("#offers_end_date").mask("99.99.9999", {placeholder: "дд.мм.гггг"});
    $("#offers_end_time").mask("99:99", {placeholder: "чч:мм"});
}
function changeKolvoLids(offer_url, offer, kolvo) {
    $('#KolvoLids').html('<form method="post" action="./offers.php?' + offer_url + '"><input name="offers_kolvo_lids" value="' + kolvo + '" style="width: 30px; text-align: center;"><input type="hidden" name="offer_id" value="' + offer + '"> <button class="btn1">ok</button></form>');
}
function changeKolvoLidsAdmin(kolvo) {
    $('#KolvoLids').html('<input name="offers_kolvo_lids" value="' + kolvo + '" style="width: 30px; text-align: center;">');
}
function showRows(rows) {
    $('.' + rows).toggle();
}


function checkphone(phone) {
    var sms = $('#sms_deadline').prop('checked');
    if (sms == true) {
        if (phone == 0 || phone == '') {
            $('#phone_set').show();
            $('#phone_set').html('Укажите номер телефона: <input id="phonesets" style="text-align: center;">');
            console.log(sms);

        }
    } else {
        $('#phone_set').hide();
        console.log(sms);
    }

}

function setDeadLineNotific(offer) {

    var sms = $('#sms_deadline').prop('checked');
    var phonesets = $('#phonesets').val();
    var email = $('#mail_deadline').prop('checked');
    var kolvo_hour = $('#kolvo_hour').val();
    var kolvo_lids = $('#kolvo_lids').val();

    if (sms === true) {
        if (phonesets == undefined) {
            $.ajax({
                type: "POST",
                url: "/_deadLine.php",
                data: "sms=" + sms + "&email=" + email + "&kolvo_hour=" + kolvo_hour + "&kolvo_lids=" + kolvo_lids + "&offer=" + offer
            });
            alert('Уведомления сохранены!');
        } else {
            $('#phonesets').css('border', '1px solid #ccc');
            if (phonesets != '') {
                $.ajax({
                    type: "POST",
                    url: "/_deadLine.php",
                    data: "sms=" + sms + "&email=" + email + "&kolvo_hour=" + kolvo_hour + "&kolvo_lids=" + kolvo_lids + "&offer=" + offer + "&phone=" + phonesets
                });
                alert('Уведомления сохранены!');
            } else {
                $('#phonesets').css('border', '1px solid red');
            }
        }
    } else {
        $.ajax({
            type: "POST",
            url: "/_deadLine.php",
            data: "sms=" + sms + "&email=" + email + "&kolvo_hour=" + kolvo_hour + "&kolvo_lids=" + kolvo_lids + "&offer=" + offer
        });
        alert('Уведомления сохранены!');
    }




}

function setTrafickBackUrl(offer) {
    var url = $('#urla1').val();
    msg = {
        type: 'add',
        offer: offer,
        url: url
    };
    $('#urla1').css('border', '1px solid #ccc');
    if (url != '' && url != 'http://') {

        $.ajax({
            type: "POST",
            url: "/_trafback.php",
            data: msg,
            success: function (response) {
                data = jQuery.parseJSON(response);
                status = data.status;
                msg = data.message;
                if (status == 'success') {
                    alert('Ссылка для трафикбека сохранена!');
                } else {
                    alert(msg);
                }

            }
        });


    } else {
        $('#urla1').css('border', '1px solid red');
    }
}

function delTraficBackUrl(offer) {
    msg = {
        type: 'del',
        offer: offer
    };
    $.ajax({
        type: "POST",
        url: "/_trafback.php",
        data: msg
    });
    $('#urla1').val('');
    alert('Ссылка для трафикбека удалена!');

}
function handleError(message) {
    alert("Ошибка: " + message)
}

function getXmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function ResetCaptcha() {
    image = 'captcha.php?rnd='+ Math.random();
    $('#captcha').attr('src', image);
}

function validate_form(form){

    var email = $(form).find('#email').val();
    var phone = $(form).find('#phone').val();

    if (email != null && email.length < 3)
    {
        new Noty({
          text: 'Пожалуйста укажите Ваш E-mail.',
          type: 'error',
          theme: 'nest',
          timeout: 3000,
          closeWith: ['click', 'button'],
          layout: 'topRight'
        }).show();
        return false;
    }
    
    phone.replace(/\+/g, '');
    
    if (phone.length < 6) {
        new Noty({
          text: 'Пожалуйста укажите правильно Ваш номер телефона.',
          type: 'error',
          theme: 'nest',
          timeout: 3000,
          closeWith: ['click', 'button'],
          layout: 'topRight'
        }).show();
        return false;
    }

    return true;
}

$(document).on('click', '.typePage', function () {
    $('.typePage').removeClass('active');
    $(this).addClass('active');
    var type = $(this).attr('data-type');
    if(type == 10){
        $('#title_type_page').html('РЕГИСТРАЦИЯ ВЕБМАСТЕРА');
    }else{
        $('#title_type_page').html('РЕГИСТРАЦИЯ  РЕЛАМОДАТЕЛЯ');
    }
    $('#type_reg').val(type);
});