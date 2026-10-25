// JavaScript Document

var timerId = setInterval(function() {


Date.now = function() { return new Date().getTime(); }
 dateHead = Math.floor(Date.now() / 1000)

 g=new Date()
 gmtHours = -g.getTimezoneOffset()/60;
 yesTime = (gmtHours-3)*3600;
 yesTime=dateHead+yesTime;


 okTime = yesTime+':'+gmtHours;
var elems = document.getElementsByName('client_time');
for(var i = 0; i < elems.length; i++){ elems[i].value=okTime; }
//$('input[name="client_time"]').val(okTime);

}, 3000);