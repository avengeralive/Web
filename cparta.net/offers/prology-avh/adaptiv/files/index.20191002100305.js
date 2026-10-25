(function(d){var h=[];d.loadImages=function(a,e){"string"==typeof a&&(a=[a]);for(var f=a.length,g=0,b=0;b<f;b++){var c=document.createElement("img");c.onload=function(){g++;g==f&&d.isFunction(e)&&e()};c.src=a[b];h.push(c)}}})(window.jQuery);
$.fn.hasAttr = function(name) { var attr = $(this).attr(name); return typeof attr !== typeof undefined && attr !== false; };

var lwi=-1;function thresholdPassed(){var w=$(window).width();var p=false;var cw=0;if(w>=480){cw++;}if(w>=768){cw++;}if(w>=960){cw++;}if(lwi!=cw){p=true;}lwi=cw;return p;}

$(document).ready(function() {
r=function(){if(thresholdPassed()){dpi=window.devicePixelRatio;if($(window).width()>=960){$('.js').attr('src', (dpi>1) ? 'images/price-606.png' : 'images/price-303.png');
$('.js-2').attr('src', (dpi>1) ? 'images/prology-894.png' : 'images/prology-447.png');
$('.js-3').attr('src', 'images/pasted-image-540.jpg');
$('.js-4').attr('src', 'images/pasted-image-470.jpg');
$('.js-5').attr('src', (dpi>1) ? 'images/prology-732.png' : 'images/prology-366.png');
$('.js-6').attr('src', (dpi>1) ? 'images/pasted-image-920.jpg' : 'images/pasted-image-460.jpg');
$('.js-7').attr('src', (dpi>1) ? 'images/price-606.png' : 'images/price-303.png');
$('.js-8').attr('src', (dpi>1) ? 'images/prology-894.png' : 'images/prology-447.png');}else if($(window).width()>=768){$('.js').attr('src', (dpi>1) ? 'images/price-486.png' : 'images/price-243.png');
$('.js-2').attr('src', (dpi>1) ? 'images/prology-716.png' : 'images/prology-358.png');
$('.js-3').attr('src', (dpi>1) ? 'images/pasted-image-864.jpg' : 'images/pasted-image-432.jpg');
$('.js-4').attr('src', (dpi>1) ? 'images/pasted-image-752.jpg' : 'images/pasted-image-376.jpg');
$('.js-5').attr('src', (dpi>1) ? 'images/prology-586.png' : 'images/prology-293.png');
$('.js-6').attr('src', (dpi>1) ? 'images/pasted-image-736.jpg' : 'images/pasted-image-368.jpg');
$('.js-7').attr('src', (dpi>1) ? 'images/price-484.png' : 'images/price-242.png');
$('.js-8').attr('src', (dpi>1) ? 'images/prology-716.png' : 'images/prology-358.png');}else if($(window).width()>=480){$('.js').attr('src', (dpi>1) ? 'images/price-838.png' : 'images/price-419.png');
$('.js-2').attr('src', (dpi>1) ? 'images/prology-916.png' : 'images/prology-458.png');
$('.js-3').attr('src', (dpi>1) ? 'images/pasted-image-942.jpg' : 'images/pasted-image-471.jpg');
$('.js-4').attr('src', 'images/pasted-image-470.jpg');
$('.js-5').attr('src', (dpi>1) ? 'images/prology-916.png' : 'images/prology-458.png');
$('.js-6').attr('src', (dpi>1) ? 'images/pasted-image-936.jpg' : 'images/pasted-image-468.jpg');
$('.js-7').attr('src', (dpi>1) ? 'images/price-836.png' : 'images/price-418.png');
$('.js-8').attr('src', (dpi>1) ? 'images/prology-918.png' : 'images/prology-459.png');}else{$('.js').attr('src', (dpi>1) ? 'images/price-558.png' : 'images/price-279.png');
$('.js-2').attr('src', (dpi>1) ? 'images/prology-612.png' : 'images/prology-306.png');
$('.js-3').attr('src', (dpi>1) ? 'images/pasted-image-628.jpg' : 'images/pasted-image-314.jpg');
$('.js-4').attr('src', (dpi>1) ? 'images/pasted-image-626.jpg' : 'images/pasted-image-313.jpg');
$('.js-5').attr('src', (dpi>1) ? 'images/prology-612.png' : 'images/prology-306.png');
$('.js-6').attr('src', (dpi>1) ? 'images/pasted-image-624.jpg' : 'images/pasted-image-312.jpg');
$('.js-7').attr('src', (dpi>1) ? 'images/price-558.png' : 'images/price-279.png');
$('.js-8').attr('src', (dpi>1) ? 'images/prology-612.png' : 'images/prology-306.png');}}};
if(!window.HTMLPictureElement){$(window).resize(r);r();}

});