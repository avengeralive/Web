/*!Infoshell Calc*/
// SETTINGS
var id = "#calculator",
  oneChoiceStepsArray = [
    "#web_calc_type_service",
    "#calc_design",
    "#web_calc_design",
    "#calc_rotate",
    "#web_calc_layout",
    "#calc_level",
    "#web_calc_level"
  ],
  btnNext = $(id + " .btnNext"),
  btnPrev = $(id + " .btnPrev"),
  btnSend = $(id + " .btnSend"),
  btnIos = $(id + " #platform_apple"),
  btnAndr = $(id + " #platform_android"),
  btnWeb = $(id + " #platform_web"),
  btnModal = $(id + " #btnModal"),
  priceHour = 2000,
  hours = 0,
  selected_level,
  selected_web_platform_type,
  sum = 0,
  stepsBack = 0,
  selectedCheckboxes = [],
  prevClickedElementId = null,
  calcHours = {
    default: 0,
    platform_apple: 0,
    platform_android: 0,
    platform_web: 0,

    device_mobile: 0,
    device_tablet: 15,
    device_watch: 30,
    device_tv: 40,

    level_S7: 56 + 40,
    level_M15: 120 + 90,
    level_L25: 200 + 160,


    design_native: { level_S7: -14, level_M15: 0, level_L25: 21 },
    design_middle: { level_S7: -30, level_M15: 0, level_L25: 45 },
    design_top: { level_S7: -50, level_M15: 0, level_L25: 75 },

    rotate_book: 0,
    rotate_album: 0,
    rotate_book_album: 40,

    auth_email: 6 + 5,
    auth_tel: 6 + 5,
    auth_social: 5 + 10,

    content_news: 12 + 15,
    content_profile: 20 + 15,
    content_search: 15 + 10,
    content_catalog: 14 + 10,
    content_upload: 30 + 25,
    content_editfoto: 40 + 0,
    content_calendar: 20 + 0,
    content_map: 15 + 15,

    society_chat: 60 + 60,
    society_comment: 20 + 20,
    society_push: 4 + 8,
    society_sms: 5 + 5,
    society_email: 5 + 8,
    society_social: 4 + 0,

    payment_cart: 16 + 10,
    payment_shop: 16 + 10,
    payment_map: 20 + 20,
    payment_subscribe: 16 + 5,

    extra_vr: 80 + 0,
    extra_ar: 50 + 0,
    extra_touch: 6 + 8,
    extra_giro: 16 + 0,
    extra_camera: 8 + 0,
    extra_smartwatch: 24 + 0,
    extra_qr: 16 + 4,
    extra_cloud: 24 + 0,
    extra_integration: 16 + 16,
    extra_security: 15 + 30,

    admin_payment: 40 + 30,
    admin_analityc: 55 + 70,
    admin_content: 150 + 50,
    admin_users: 35 + 15,
    admin_moderation: 30 + 15 + 5,
    admin_feedback: 20 + 15 + 5,
    admin_crash: 0 + 0 + 10,

    test: 0.2,
    manage: 0.2,
    risks: 1.2,

    //WEB
    type_corp_site: 20,
    type_shop: 30,
    type_landing: 15,
    type_corp_portal: 60,
    type_admin_panel: 0,
    type_crm_system: 120,

    web_level_S7: 56,
    web_level_M15: 120,
    web_level_L25: 200,

    web_design_native: {
      web_level_S7: 50,
      web_level_M15: 60,
      web_level_L25: 70,
      type_landing: 0
    },
    web_design_middle: {
      web_level_S7: 70,
      web_level_M15: 132,
      web_level_L25: 210,
      type_landing: 10
    },
    web_design_top: {
      web_level_S7: 94,
      web_level_M15: 210,
      web_level_L25: 280,
      type_landing: 30
    },

    layout_fixed: 0,
    layout_flex: 0,
    layout_adaptive: {
      web_level_S7: 14,
      web_level_M15: 30,
      web_level_L25: 50,
      type_landing: 2
    },

    web_auth_email: 6,
    web_auth_tel: 8,
    web_auth_social: 8,

    web_content_main: 0,
    web_content_news: 12,
    web_content_search: 16,
    web_content_catalog: 18,
    web_content_blog: 12,
    web_content_infoblog: 9,
    web_content_upload: 26,
    web_content_editfoto: 38,
    web_content_calendar: 3,
    web_content_map: 9,
    web_content_gallery: 12,
    web_content_profile: 14,
    web_content_exchange_1c: 32,

    web_society_chat: 26,
    web_society_comment: 24,
    web_society_push: 11,
    web_society_back: 2,
    web_society_sms: 12,
    web_society_email: 12,
    web_society_social: 2,
    web_society_forum: 24,

    web_payment_cart: 22,
    payment_make_order: 10,
    web_payment_how_buy: 1,
    web_payment_delivery_simple: 5,
    web_payment_delivery_autocomplete: 12,
    web_payment_payment: 2,
    web_payment_separately: 2,
    web_payment_add_payment_system: 32,

    web_extra_site_map: 4,
    web_extra_not_found_page: 4,
    web_extra_online_teaching: 10,

    web_admin_payment: 28,
    web_admin_analityc: 8,
    web_admin_content: 160,
    web_admin_users: 52,
    web_admin_moderation: 30,
    web_admin_feedback: 36,
    web_admin_crash: 24
  };



// DEFAULT ACTIONS
$(id+' .nav-tabs > li').each(function() {
    $(this).prepend('<b>'+($(this).index()+1)+'</b>');
});


btnNext.click(function(e){
 if(!btnNext.attr('disabled')){ 
    loadPlatform();
    $(id+' .nav-tabs > li > .active').parent().next('li').find('a').trigger('click');
    btnNext.attr("disabled", true);
  }
});

btnPrev.click(function(){
    btnNext.removeAttr("disabled");
    stepsBack++;


    let activeTabHref = $('#tablist')
    .find('li a.active')
    .attr('href');

    $(activeTabHref).find('input:checked').each(function(){
      $(this).attr('checked', false).parent('label').removeClass('active');
      $(this).next('i').find('img').removeClass('filter_black').addClass('filter_white');
    })

    calc();

    $(id+' .nav-tabs > li > .active').parent().prev('li').find('a').trigger('click');

    enableOneChoice($(this));

  });

btnSend.hide();
btnSend.click(function(){
    $(id+' .tel').focus();
});

btnWeb.change(function(){
    uncheckBtn(this, btnIos);
    uncheckBtn(this, btnAndr);
    // $('#calcSend').modal('show'); //TODO: Web calculation
});

btnIos.change(function(){
    uncheckBtn(this, btnWeb);
});

btnAndr.change(function(){
    uncheckBtn(this, btnWeb);
});

function calc(){
  let activeTabHref = $('#tablist')
    .find('li a.active')
    .attr('href');
    calculateSum(activeTabHref);

    stepsBack = 0;
}

function uncheckBtn(th,hide) {
    if(th.checked) {
        hide.prop( 'checked', false).parent('label').removeClass('active');
    }
}

function listenEventsWhenSwitchTabs(){
    // RULES FOR TABS & CALCULATION
    $(id+' a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        var target  = $(e.target).attr('href'),
            tabLast = $(id+' .tab-content .tab-pane:last');
        prevClickedElementId = null;

        if (target.substring(1) == tabLast.attr('id')) {
            btnNext.hide();
        } else {
            btnNext.show();
        }

        if (btnAndr.is(':checked') && btnIos.is(':checked')) {
            sum *= 2;
        }
        hideTabs();
    });
}

function loadPlatform(){
  let platform_id = $("#calc_platform input[name=platform]:checked").attr("id");
  let service_type = $('#web_calc_type_service input[name=type_site]:checked').attr('id');

  let activeTabHref = $('#tablist')
    .find('li a.active')
    .attr('href');

    if (platform_id == "platform_web" && activeTabHref == "#calc_platform") {
      loadWebPlatform();
    } else if (
      service_type == "type_landing" &&
      activeTabHref == "#web_calc_type_service"
    ) {
      loadLandingTypeSite();
    } else if (
      activeTabHref == "#calc_platform" &&
      (platform_id == "platform_android" ||
      platform_id == "platform_apple")
    ) {
      loadIosAndroidPlatform();
      if(platform_id == 'platform_apple') fillCheckboxes("#platform_apple");
      if(platform_id == 'platform_android') fillCheckboxes("#platform_android");
    } else if (
        service_type == "type_corp_site" &&
        activeTabHref == "#web_calc_type_service"
    ) {
      loadCorpSiteType();
    } else if (
        service_type == "type_shop" &&
        activeTabHref == "#web_calc_type_service"
    ) {
      loadShopType();
    } else if (
        service_type == "type_corp_portal" &&
        activeTabHref == "#web_calc_type_service"
    ) {
      loadCorpPortlaType();
    } else if (
        service_type == "type_admin_panel" &&
        activeTabHref == "#web_calc_type_service"
    ) {
      loadAdminPanelType();
    }
}

function calculateSum(activeTabHref){
    sum = 0;
    $('#checkbox').find('input:checked').each(function(){
        let checkbox_dublicate = [];
        let id = $(this).attr('id');
        selectedCheckboxes.push(id);        
      
            if(
              id == 'type_corp_site' ||
              id == 'type_landing' ||
              id == 'type_corp_portal' ||
              id == 'type_admin_panel' ||
              id == 'type_crm_system' 
            ) {
              selected_web_platform_type = id;
              hours = calcHours[id];
            } else if (
              id == "web_level_S7" ||
              id == "web_level_M15" ||
              id == "web_level_L25" ||
              id == "level_S7" ||
              id == "level_M15" ||
              id == "level_L25"
            ){
              hours = calcHours[id];
              selected_level = id;
            } else if(
              selected_web_platform_type == 'type_landing' && 
              (id == 'web_design_native' ||
              id =='web_design_top'||
              id == 'web_design_middle')
            ){
                hours = calcHours[id][selected_web_platform_type];   
            } else if ( id == 'layout_adaptive' && selected_web_platform_type == "type_landing"){
              hours = calcHours[id][selected_web_platform_type];
            } else if (
              id == 'web_design_native' ||
              id == 'web_design_middle'|| 
              id =='web_design_top'||
              id == 'design_native' ||
              id == 'design_middle'||
              id =='design_top'||
              id == "layout_adaptive"
            ) {
              hours = calcHours[id][selected_level];
            } else {
                 hours = calcHours[id];
              }

            checkbox_dublicate = selectedCheckboxes.filter(function(checkbox_id) {
              return (
                selectedCheckboxes.indexOf(checkbox_id) !==
                selectedCheckboxes.lastIndexOf(checkbox_id)
              );
            });

            if (
              checkbox_dublicate.length == 0 &&
              $('#calc_platform').find("input:checked").attr('id') == 'platform_web' &&
              hours
            ) {
              sum += hours * priceHour;
            } else if (checkbox_dublicate.length == 0 && hours) {
                     sum +=
                       hours *
                       priceHour *
                       calcHours["risks"] *
                       (1 + calcHours["test"] + calcHours["manage"]);
            }

            selectedCheckboxes = selectedCheckboxes.filter(
              checkbox_id => checkbox_id !== id
            );
        });
            $("#price").html(addSpaces(Math.round(sum)));
            $("#sum").html(addSpaces(Math.round(sum)));
            $(id + " #calc_price").val(addSpaces(Math.round(sum)));

}

function skipTab(){
    $(id+' .nav-tabs > li > .active').parent().next('li').next('li').find('a').trigger('click');
}

function checkAndEnableNextBtn($this){
   let activeTabHref = $("#tablist")
     .find("li a.active")
     .attr("href");

  btnNext.attr("disabled", true);

  $(activeTabHref).find('input:checked').each(function(){
        btnNext.removeAttr("disabled");
  })
}

function enableOneChoice($this){
  let activeTabHref = $('#tablist')
          .find('li a.active')
          .attr('href');

  if(oneChoiceStepsArray.includes(activeTabHref)){
    let clickedCheckbox = $this.find('.chekbox_input');
      if (clickedCheckbox.is(':checked')){

      $(activeTabHref).find('input:checked').each(function(){

          if( clickedCheckbox.attr('id') != $(this).attr('id')){
            $(this).attr('checked', false).change();
            $(this).closest('label').removeClass('active');
            let image = $(this)
              .closest('.checkbox-label')
              .find('img');
  
            image.removeClass('filter_black');
            image.addClass('filter_white');
          }
        });
    }
  }
}

function hideTabs() {
    $(id+' .nav-tabs > li').each(function(i,v){
        var
            tabActiv = $(id+' .nav-tabs > li >.active').parent().index(),
            th = $(this),
            viewTabs = 5;

        if(
            (tabActiv<=1 && (i<viewTabs)) ||
            (tabActiv>1  && (i>(tabActiv-(viewTabs-2)) && i<(tabActiv+(viewTabs-2))))
        ) {
            th.show();
        } else {
            th.hide(99);
        }
    });
}
hideTabs();

$('#calcSend').on('shown.bs.modal', function () {
    $('#calc_address').removeAttr('required');
    $('#calcSend').append('<input type="hidden" name="test" value="-1" />');
})


// AJAXFORM
$(id+'_form').submit(function(e) {
    $.ajax({
        type: "POST",
        url: $(id+'_form').attr('action')+'?verify=1',//'calc_form.php',
        data: $(id+'_form').serialize(),
        success: function(data){
            $(id+' #calcRequest').html(data);
            $(id+' #calcSend').modal('hide');
            ga('send','event',{eventCategory:'Calculator',eventAction:'Calculator'});
            ga('send','event','calculator','calculator');
        }
    });
    e.preventDefault();
});


function dump(obj) {
    var out = '';
    for (var i in obj) { out += i+": "+obj[i]+"\n"; }
    alert(out);
    var pre = document.createElement('pre');
    pre.innerHTML = out;
    document.body.appendChild(pre);
}

function addSpaces(str){
    str+='';
    x=str.split('.');
    x1=x[0];
    x2=(x.length>1)?('.'+x[1]):('');
    var rgx=/(\d+)(\d{3})/;
    while(rgx.test(x1)){x1=x1.replace(rgx,"$1"+" "+"$2");}
    return x1+x2;
}



// jQuery Masked Input 1.4.1 (c) 2015 Josh Bush (digitalbush.com) MIT license http://digitalbush.com/projects/masked-input-plugin/#license
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});
$(id+' .tel').mask('+7 (999) 999-99-99');
