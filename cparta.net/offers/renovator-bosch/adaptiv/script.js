var deadline = new Date();
deadline.setHours(24, 0, 0, 0);

function getTimeRemaining(endtime){
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor( (t/1000) % 60 );
  var minutes = Math.floor( (t/1000/60) % 60 );
  var hours = Math.floor( (t/(1000*60*60)) % 24 );
  return {
   'total': t,
   'hours': hours,
   'minutes': minutes,
   'seconds': seconds
  };
}

var hours1Span = document.getElementById('clockdiv').querySelector('.hours1');
var hours2Span = document.getElementById('clockdiv').querySelector('.hours2');
var minutes1Span = document.getElementById('clockdiv').querySelector('.minutes1');
var minutes2Span = document.getElementById('clockdiv').querySelector('.minutes2');
var seconds1Span = document.getElementById('clockdiv').querySelector('.seconds1');
var seconds2Span = document.getElementById('clockdiv').querySelector('.seconds2');

function initializeClock(endtime){
  var timeinterval = setInterval(function(){
   var t = getTimeRemaining(endtime);
   
    hours1Span.innerHTML = ('0' + t.hours).slice(-2, -1);
    hours2Span.innerHTML = ('0' + t.hours).slice(-1);
    
    minutes1Span.innerHTML = ('0' + t.minutes).slice(-2, -1);
    minutes2Span.innerHTML = ('0' + t.minutes).slice(-1);
    
    seconds1Span.innerHTML = ('0' + t.seconds).slice(-2, -1);
    seconds2Span.innerHTML = ('0' + t.seconds).slice(-1);

   if(t.total<=0){
    clearInterval(timeinterval);
   }
  },1000);
}

initializeClock(deadline);

$(document).ready(function(){
  $('.tes-slider').slick({
    appendArrows: $('.tes-arrows'),
    prevArrow: '<img src="img/green-left.png" alt="" class="arrow-left2">',
    nextArrow: '<img src="img/green-right.png" alt="" class="arrow-right2">'
  });
});

function getTimeRemaining(endtime){
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor( (t/1000) % 60 );
  var minutes = Math.floor( (t/1000/60) % 60 );
  var hours = Math.floor( (t/(1000*60*60)) % 24 );
  return {
   'total': t,
   'hours': hours,
   'minutes': minutes,
   'seconds': seconds
  };
}

var hours3Span = document.getElementById('clockdiv2').querySelector('.hours1');
var hours4Span = document.getElementById('clockdiv2').querySelector('.hours2');
var minutes3Span = document.getElementById('clockdiv2').querySelector('.minutes1');
var minutes4Span = document.getElementById('clockdiv2').querySelector('.minutes2');
var seconds3Span = document.getElementById('clockdiv2').querySelector('.seconds1');
var seconds4Span = document.getElementById('clockdiv2').querySelector('.seconds2');

function initializeClock2(endtime){
  var timeinterval = setInterval(function(){
   var t = getTimeRemaining(endtime);
   
    hours3Span.innerHTML = ('0' + t.hours).slice(-2, -1);
    hours4Span.innerHTML = ('0' + t.hours).slice(-1);
    
    minutes3Span.innerHTML = ('0' + t.minutes).slice(-2, -1);
    minutes4Span.innerHTML = ('0' + t.minutes).slice(-1);
    
    seconds3Span.innerHTML = ('0' + t.seconds).slice(-2, -1);
    seconds4Span.innerHTML = ('0' + t.seconds).slice(-1);

   if(t.total<=0){
    clearInterval(timeinterval);
   }
  },1000);
}

initializeClock2(deadline);