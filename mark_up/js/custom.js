function setCookie(name, value, options) {
  options = options || {};
  var expires = options.expires;
  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }
  value = encodeURIComponent(value);
  var updatedCookie = name + "=" + value;
  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }
  document.cookie = updatedCookie;
}
function likeCookies(name, value) {
  var elem = document.getElementById('cookies');
  elem.remove();
  setCookie(name, value);
}
$(document).ready(function () {
  var cookies = document.cookie.split(/;/);
  for (var i = 0, len = cookies.length; i < len; i++) {
    var cookie = cookies[i].split(/=/);
    if (cookie[0] == ' like_cookies') {
      if (cookie[1] == 1) {
        $('#cookies').remove();
      }
    } else {
      $('#cookies').css('display', 'block');
    }
  }

  $('#accordion > div.active').slideDown(400);
  $('#accordion > h3').on('click',function () {
    if(!$(this).next().hasClass('active')) {
      $('#accordion > h3.active').removeClass('active');
      $(this).addClass('active');
      $('#accordion > div.active').slideUp(400);
      $('#accordion > div.active').removeClass('active');
      $(this).next().addClass('active');
      $(this).next().slideDown(400);
    } else {
      $(this).removeClass('active');
      $(this).next().removeClass('active');
      $(this).next().slideUp(400);
    }
  });

  $('.js-contacts-more').on('click',function(e){
    e.preventDefault();

    if ($(this).hasClass('opened')){
      $('.js-contacts-more.opened').removeClass('opened');
      $('.place-contacts-text').slideUp();
    }
    else{
      $('.js-contacts-more.opened').removeClass('opened');
      $(this).addClass('opened');
      $('.place-contacts-text').slideUp();
      $(this).parents('.place-contacts').find('.place-contacts-text').slideDown();
    }
  });
});
