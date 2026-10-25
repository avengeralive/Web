var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.findInternal=function(a,n,f){a instanceof String&&(a=String(a));for(var p=a.length,k=0;k<p;k++){var b=a[k];if(n.call(f,b,k,a))return{i:k,v:b}}return{i:-1,v:void 0}};$jscomp.ASSUME_ES5=!1;$jscomp.ASSUME_NO_NATIVE_MAP=!1;$jscomp.ASSUME_NO_NATIVE_SET=!1;$jscomp.SIMPLE_FROUND_POLYFILL=!1;
$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(a,n,f){a!=Array.prototype&&a!=Object.prototype&&(a[n]=f.value)};$jscomp.getGlobal=function(a){return"undefined"!=typeof window&&window===a?a:"undefined"!=typeof global&&null!=global?global:a};$jscomp.global=$jscomp.getGlobal(this);
$jscomp.polyfill=function(a,n,f,p){if(n){f=$jscomp.global;a=a.split(".");for(p=0;p<a.length-1;p++){var k=a[p];k in f||(f[k]={});f=f[k]}a=a[a.length-1];p=f[a];n=n(p);n!=p&&null!=n&&$jscomp.defineProperty(f,a,{configurable:!0,writable:!0,value:n})}};$jscomp.polyfill("Array.prototype.find",function(a){return a?a:function(a,f){return $jscomp.findInternal(this,a,f).v}},"es6","es3");
(function(a,n,f){"function"===typeof define&&define.amd?define(["jquery"],a):"object"===typeof exports&&"undefined"===typeof Meteor?module.exports=a(require("jquery")):a(n||f)})(function(a){var n=function(b,d,e){var c={invalid:[],getCaret:function(){try{var a=0,r=b.get(0),h=document.selection,d=r.selectionStart;if(h&&-1===navigator.appVersion.indexOf("MSIE 10")){var e=h.createRange();e.moveStart("character",-c.val().length);a=e.text.length}else if(d||"0"===d)a=d;return a}catch(C){}},setCaret:function(a){try{if(b.is(":focus")){var c=
b.get(0);if(c.setSelectionRange)c.setSelectionRange(a,a);else{var g=c.createTextRange();g.collapse(!0);g.moveEnd("character",a);g.moveStart("character",a);g.select()}}}catch(B){}},events:function(){b.on("keydown.mask",function(a){b.data("mask-keycode",a.keyCode||a.which);b.data("mask-previus-value",b.val());b.data("mask-previus-caret-pos",c.getCaret());c.maskDigitPosMapOld=c.maskDigitPosMap}).on(a.jMaskGlobals.useInput?"input.mask":"keyup.mask",c.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){b.keydown().keyup()},
100)}).on("change.mask",function(){b.data("changed",!0)}).on("blur.mask",function(){f===c.val()||b.data("changed")||b.trigger("change");b.data("changed",!1)}).on("blur.mask",function(){f=c.val()}).on("focus.mask",function(b){!0===e.selectOnFocus&&a(b.target).select()}).on("focusout.mask",function(){e.clearIfNotMatch&&!k.test(c.val())&&c.val("")})},getRegexMask:function(){for(var a=[],b,c,e,t,f=0;f<d.length;f++)(b=l.translation[d.charAt(f)])?(c=b.pattern.toString().replace(/.{1}$|^.{1}/g,""),e=b.optional,
(b=b.recursive)?(a.push(d.charAt(f)),t={digit:d.charAt(f),pattern:c}):a.push(e||b?c+"?":c)):a.push(d.charAt(f).replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"));a=a.join("");t&&(a=a.replace(new RegExp("("+t.digit+"(.*"+t.digit+")?)"),"($1)?").replace(new RegExp(t.digit,"g"),t.pattern));return new RegExp(a)},destroyEvents:function(){b.off("input keydown keyup paste drop blur focusout ".split(" ").join(".mask "))},val:function(a){var c=b.is("input")?"val":"text";if(0<arguments.length){if(b[c]()!==a)b[c](a);
c=b}else c=b[c]();return c},calculateCaretPosition:function(a){var d=c.getMasked(),h=c.getCaret();if(a!==d){var e=b.data("mask-previus-caret-pos")||0;d=d.length;var g=a.length,f=a=0,l=0,k=0,m;for(m=h;m<d&&c.maskDigitPosMap[m];m++)f++;for(m=h-1;0<=m&&c.maskDigitPosMap[m];m--)a++;for(m=h-1;0<=m;m--)c.maskDigitPosMap[m]&&l++;for(m=e-1;0<=m;m--)c.maskDigitPosMapOld[m]&&k++;h>g?h=10*d:e>=h&&e!==g?c.maskDigitPosMapOld[h]||(e=h,h=h-(k-l)-a,c.maskDigitPosMap[h]&&(h=e)):h>e&&(h=h+(l-k)+f)}return h},behaviour:function(d){d=
d||window.event;c.invalid=[];var e=b.data("mask-keycode");if(-1===a.inArray(e,l.byPassKeys)){e=c.getMasked();var h=c.getCaret(),g=b.data("mask-previus-value")||"";setTimeout(function(){c.setCaret(c.calculateCaretPosition(g))},a.jMaskGlobals.keyStrokeCompensation);c.val(e);c.setCaret(h);return c.callbacks(d)}},getMasked:function(a,b){var h=[],f=void 0===b?c.val():b+"",g=0,k=d.length,n=0,p=f.length,m=1,r="push",u=-1,w=0;b=[];if(e.reverse){r="unshift";m=-1;var x=0;g=k-1;n=p-1;var A=function(){return-1<
g&&-1<n}}else x=k-1,A=function(){return g<k&&n<p};for(var z;A();){var y=d.charAt(g),v=f.charAt(n),q=l.translation[y];if(q)v.match(q.pattern)?(h[r](v),q.recursive&&(-1===u?u=g:g===x&&g!==u&&(g=u-m),x===u&&(g-=m)),g+=m):v===z?(w--,z=void 0):q.optional?(g+=m,n-=m):q.fallback?(h[r](q.fallback),g+=m,n-=m):c.invalid.push({p:n,v:v,e:q.pattern}),n+=m;else{if(!a)h[r](y);v===y?(b.push(n),n+=m):(z=y,b.push(n+w),w++);g+=m}}a=d.charAt(x);k!==p+1||l.translation[a]||h.push(a);h=h.join("");c.mapMaskdigitPositions(h,
b,p);return h},mapMaskdigitPositions:function(a,b,d){a=e.reverse?a.length-d:0;c.maskDigitPosMap={};for(d=0;d<b.length;d++)c.maskDigitPosMap[b[d]+a]=1},callbacks:function(a){var g=c.val(),h=g!==f,k=[g,a,b,e],l=function(a,b,c){"function"===typeof e[a]&&b&&e[a].apply(this,c)};l("onChange",!0===h,k);l("onKeyPress",!0===h,k);l("onComplete",g.length===d.length,k);l("onInvalid",0<c.invalid.length,[g,a,b,c.invalid,e])}};b=a(b);var l=this,f=c.val(),k;d="function"===typeof d?d(c.val(),void 0,b,e):d;l.mask=
d;l.options=e;l.remove=function(){var a=c.getCaret();l.options.placeholder&&b.removeAttr("placeholder");b.data("mask-maxlength")&&b.removeAttr("maxlength");c.destroyEvents();c.val(l.getCleanVal());c.setCaret(a);return b};l.getCleanVal=function(){return c.getMasked(!0)};l.getMaskedVal=function(a){return c.getMasked(!1,a)};l.init=function(g){g=g||!1;e=e||{};l.clearIfNotMatch=a.jMaskGlobals.clearIfNotMatch;l.byPassKeys=a.jMaskGlobals.byPassKeys;l.translation=a.extend({},a.jMaskGlobals.translation,e.translation);
l=a.extend(!0,{},l,e);k=c.getRegexMask();if(g)c.events(),c.val(c.getMasked());else{e.placeholder&&b.attr("placeholder",e.placeholder);b.data("mask")&&b.attr("autocomplete","off");g=0;for(var f=!0;g<d.length;g++){var h=l.translation[d.charAt(g)];if(h&&h.recursive){f=!1;break}}f&&b.attr("maxlength",d.length).data("mask-maxlength",!0);c.destroyEvents();c.events();g=c.getCaret();c.val(c.getMasked());c.setCaret(g)}};l.init(!b.is("input"))};a.maskWatchers={};var f=function(){var b=a(this),d={},e=b.attr("data-mask");
b.attr("data-mask-reverse")&&(d.reverse=!0);b.attr("data-mask-clearifnotmatch")&&(d.clearIfNotMatch=!0);"true"===b.attr("data-mask-selectonfocus")&&(d.selectOnFocus=!0);if(p(b,e,d))return b.data("mask",new n(this,e,d))},p=function(b,d,e){e=e||{};var c=a(b).data("mask"),f=JSON.stringify;b=a(b).val()||a(b).text();try{return"function"===typeof d&&(d=d(b)),"object"!==typeof c||f(c.options)!==f(e)||c.mask!==d}catch(w){}},k=function(a){var b=document.createElement("div");a="on"+a;var e=a in b;e||(b.setAttribute(a,
"return;"),e="function"===typeof b[a]);return e};a.fn.mask=function(b,d){d=d||{};var e=this.selector,c=a.jMaskGlobals,f=c.watchInterval;c=d.watchInputs||c.watchInputs;var k=function(){if(p(this,b,d))return a(this).data("mask",new n(this,b,d))};a(this).each(k);e&&""!==e&&c&&(clearInterval(a.maskWatchers[e]),a.maskWatchers[e]=setInterval(function(){a(document).find(e).each(k)},f));return this};a.fn.masked=function(a){return this.data("mask").getMaskedVal(a)};a.fn.unmask=function(){clearInterval(a.maskWatchers[this.selector]);
delete a.maskWatchers[this.selector];return this.each(function(){var b=a(this).data("mask");b&&b.remove().removeData("mask")})};a.fn.cleanVal=function(){return this.data("mask").getCleanVal()};a.applyDataMask=function(b){b=b||a.jMaskGlobals.maskElements;(b instanceof a?b:a(b)).filter(a.jMaskGlobals.dataMaskAttr).each(f)};k={maskElements:"input,td,span,div",dataMaskAttr:"*[data-mask]",dataMask:!0,watchInterval:300,watchInputs:!0,keyStrokeCompensation:10,useInput:!/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent)&&
k("input"),watchDataMask:!1,byPassKeys:[9,16,17,18,36,37,38,39,40,91],translation:{0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}}};a.jMaskGlobals=a.jMaskGlobals||{};k=a.jMaskGlobals=a.extend(!0,{},k,a.jMaskGlobals);k.dataMask&&a.applyDataMask();setInterval(function(){a.jMaskGlobals.watchDataMask&&a.applyDataMask()},k.watchInterval)},window.jQuery,window.Zepto);
$(document).ready(function () {

    $('.ym_inp').mask('410000000000000');
    $('.wm_inp').mask('R000000000000');
    $('.vm_inp').mask('0000 0000 0000 0000');
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

    $(document).on('click', '#email-verify', function () {
        $.ajax({
            url: './post/verifyemail.php',
            type: 'POST',
            data: 'mode=1',
        });
    })

    $(document).on('click', '.verify_paysys', function () {
        var purse = $(this).parent().parent().children('.purse').children('.form-control');
        purse.css('border', '1px solid #ced4da');
        if(purse.val() != null && purse.val().length > 9){
            $(this).removeClass('verify_paysys');
            $(this).addClass('paysys_code');
            $(this).html('Подтвердить');
            $(this).parent().parent().children('.cdd').children('.code-input').show();
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
        var purse = $(this).parent().parent().children('.purse').children('.form-control');
        var code = $(this).parent().parent().children('.cdd').children('.code-input').children('.form-control').val();
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