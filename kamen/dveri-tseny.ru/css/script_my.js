//Маска телефона

$(function () {
  $("#phone").mask("+7(999) 999-9999");
  $("#phone_modal").mask("+7(999) 999-9999");
  $("#phone_moda22l").mask("+7(999) 999-9999");
  $("#phone_modal23").mask("+7(999) 999-9999");
  $("#phone_modal24").mask("+7(999) 999-9999");
  $("#phone_modal25").mask("+7(999) 999-9999");
  $("#phone_modal26").mask("+7(999) 999-9999");


});


//Форма в футере
$("#foot_btn, #foot_btn1").click(function (e) {
  e.preventDefault();
  $("#foot_f").addClass('ff_in');
  $(".form_fon").addClass('form_fon_active');
  $(".ff_btn").addClass('ff_btn_h');


})

$(".footer_close, .form_fon").click(function (e) {
  e.preventDefault();

  $("#foot_f").removeClass('ff_in');
  $(".form_fon").removeClass('form_fon_active');
  $(".ff_btn").removeClass('ff_btn_h');

})

$("#mat_btn").click(function (e) {
  e.preventDefault();
  $("#form_plast").addClass('ff_in');
  $(".form_fon_mat").addClass('form_fon_mat_active');
  $(".mat_btn").addClass('mat_btn_h');


})

$(".footer_close, .form_fon_mat").click(function (e) {
  e.preventDefault();

  $("#form_plast").removeClass('ff_in');
  $(".form_fon_mat").removeClass('form_fon_mat_active');
  $(".mat_btn").removeClass('mat_btn_h');

})

$("#sil_btn").click(function (e) {
  e.preventDefault();
  $("#form_sil").addClass('ff_in');
  $(".form_fon_mat").addClass('form_fon_mat_active');
  $(".mat_btn").addClass('mat_btn_h');


})

$(".footer_close, .form_fon_mat").click(function (e) {
  e.preventDefault();

  $("#form_sil").removeClass('ff_in');
  $(".form_fon_mat").removeClass('form_fon_mat_active');
  $(".mat_btn").removeClass('mat_btn_h');

})

$("#odn_btn").click(function (e) {
  e.preventDefault();
  $("#form_odnot").addClass('ff_in');
  $(".form_fon_mat").addClass('form_fon_mat_active');
  $(".mat_btn").addClass('mat_btn_h');


})

$(".footer_close, .form_fon_mat").click(function (e) {
  e.preventDefault();

  $("#form_odnot").removeClass('ff_in');
  $(".form_fon_mat").removeClass('form_fon_mat_active');
  $(".mat_btn").removeClass('mat_btn_h');

})

$("#soft_btn").click(function (e) {
  e.preventDefault();
  $("#form_Soft-touch").addClass('ff_in');
  $(".form_fon_mat").addClass('form_fon_mat_active');
  $(".mat_btn").addClass('mat_btn_h');


})

$(".footer_close, .form_fon_mat").click(function (e) {
  e.preventDefault();

  $("#form_Soft-touch").removeClass('ff_in');
  $(".form_fon_mat").removeClass('form_fon_mat_active');
  $(".mat_btn").removeClass('mat_btn_h');

})

$("#polim_btn").click(function (e) {
  e.preventDefault();
  $("#form_polimer").addClass('ff_in');
  $(".form_fon_mat").addClass('form_fon_mat_active');
  $(".mat_btn").addClass('mat_btn_h');


})

$(".footer_close, .form_fon_mat").click(function (e) {
  e.preventDefault();

  $("#form_polimer").removeClass('ff_in');
  $(".form_fon_mat").removeClass('form_fon_mat_active');
  $(".mat_btn").removeClass('mat_btn_h');

})

$("#soft_btn").click(function (e) {
  e.preventDefault();
  $("#form_Soft-touch").addClass('ff_in');
  $(".form_fon_mat").addClass('form_fon_mat_active');
  $(".mat_btn").addClass('mat_btn_h');


})

$(".footer_close, .form_fon_mat").click(function (e) {
  e.preventDefault();

  $("#form_Soft-touch").removeClass('ff_in');
  $(".form_fon_mat").removeClass('form_fon_mat_active');
  $(".mat_btn").removeClass('mat_btn_h');

})

$("#tkan_btn").click(function (e) {
  e.preventDefault();
  $("#form_tkan").addClass('ff_in');
  $(".form_fon_mat").addClass('form_fon_mat_active');
  $(".mat_btn").addClass('mat_btn_h');


})

$(".footer_close, .form_fon_mat").click(function (e) {
  e.preventDefault();

  $("#form_tkan").removeClass('ff_in');
  $(".form_fon_mat").removeClass('form_fon_mat_active');
  $(".mat_btn").removeClass('mat_btn_h');

})


//бренды
$(function () {
  $('.brands').bxSlider({
    captions: true,
    pager: false
  });
});

$('.brands .item').hover(function () {
  var id = $(this).attr('data-id');
  $('#cover_0').stop(true, true).fadeOut('fast');
  $('#cover_' + id).stop(true, true).fadeIn('fast');

}, function () {
  var id = $(this).attr('data-id');
  $('#cover_' + id).stop(true, true).fadeOut('fast');
  $('#cover_0').stop(true, true).fadeIn('fast');

});


$('.br_mobi_btn').click(function () {

  $('.item:visible').hide().siblings().eq(Math.floor(Math.random() * 60)).fadeIn('fast');
});


//Отправка формы

$(document).ready(function () {
  $('form:not(#mob_search_form)').submit(function () {
    var formID = $(this).attr('id'); // Получение ID формы
    var formNm = $('#' + formID);
    $.ajax({
      type: 'POST',
      url: '/cases/send.php', // Обработчик формы отправки
      data: formNm.serialize(),
      success: function (data) {
        // Вывод текста результата отправки в текущей форме
        $(formNm).html(data);
      }
    });
    return false;
  });
});

//мобильные формы    
$("#plast_f").click(function (e) {
  e.preventDefault();
  $("#modal_plast").addClass('mp_active');
  $(".mat_img img").not('#plast_f img').addClass('opas');
  $(".mob_mod_fon").addClass('mob_mod_fon_active');

})
$(".close, .mob_mod_fon").click(function (e) {
  e.preventDefault();
  $("#modal_plast, .mob_mod_fon").removeClass('mp_active');
  $(".mat_img img").not('#plast_f img').removeClass('opas');
  $(".mob_mod_fon").removeClass('mob_mod_fon_active');
})


$("#sil_f").click(function (e) {
  e.preventDefault();
  $("#modal_selic").addClass('mp_active');
  $(".mat_img img").not("#sil_f img").addClass('opas');
  $(".mob_mod_fon").addClass('mob_mod_fon_active');

})
$(".close, .mob_mod_fon").click(function (e) {
  e.preventDefault();
  $("#modal_selic").removeClass('mp_active');
  $(".mat_img img").not("#sil_f img").removeClass('opas');
  $(".mob_mod_fon").removeClass('mob_mod_fon_active');
})


$("#odns_f").click(function (e) {
  e.preventDefault();
  $("#modal_odns").addClass('mp_active');
  $(".mat_img img").not("#odns_f img").addClass('opas');
  $(".mob_mod_fon").addClass('mob_mod_fon_active');

})
$(".close, .mob_mod_fon").click(function (e) {
  e.preventDefault();
  $("#modal_odns").removeClass('mp_active');
  $(".mat_img img").not("#odns_f img").removeClass('opas');
})
$(".mob_mod_fon").removeClass('mob_mod_fon_active');


$("#s3d_f").click(function (e) {
  e.preventDefault();
  $("#modal_s3d").addClass('mp_active');
  $(".mat_img img").not("#s3d_f img").addClass('opas');
  $(".mob_mod_fon").addClass('mob_mod_fon_active');

})
$(".close, .mob_mod_fon").click(function (e) {
  e.preventDefault();
  $("#modal_s3d").removeClass('mp_active');
  $(".mat_img img").not("#s3d_f img").removeClass('opas');
  $(".mob_mod_fon").removeClass('mob_mod_fon_active');
})

$("#polv_f").click(function (e) {
  e.preventDefault();
  $("#modal_polv").addClass('mp_active');
  $(".mat_img img").not("#polv_f img").addClass('opas');
  $(".mob_mod_fon").addClass('mob_mod_fon_active');

})
$(".close, .mob_mod_fon").click(function (e) {
  e.preventDefault();
  $("#modal_polv").removeClass('mp_active');
  $(".mat_img img").not("#polv_f img").removeClass('opas');
  $(".mob_mod_fon").removeClass('mob_mod_fon_active');
})

$("#tkv_f").click(function (e) {
  e.preventDefault();
  $("#modal_tkv").addClass('mp_active');
  $(".mat_img img").not("#tkv_f img").addClass('opas');
  $(".mob_mod_fon").addClass('mob_mod_fon_active');

})
$(".close, .mob_mod_fon").click(function (e) {
  e.preventDefault();
  $("#modal_tkv").removeClass('mp_active');
  $(".mat_img img").not("#tkv_f img").removeClass('opas');
  $(".mob_mod_fon").removeClass('mob_mod_fon_active');
});

