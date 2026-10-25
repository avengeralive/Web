//Print All Specs
var printStyle;
jQuery(function($){
	if($('body').css('direction')=='rtl'){
		printStyle = 
		'body { direction:rtl}'+
		'body * { margin:0; padding:0 }'+
		'.spech_img { position:absolute; top:0; right:0; width:145px; height:109px;}'+
		'.printbut,.specall_buttons {display : none}'+
		'.spech_title {height:89px; margin-right:145px; padding-top:20px;}'+
		'.spech_title h2 { font-family: "Open Sans Condensed", sans-serif; font-size:20px; font-weight:bold; line-height:24px;}'+
		'.breadcrumbs {margin-bottom:5px; overflow:hidden; zoom:1;}'+
		'.breadcrumbs li { float:right; margin-left:10px; list-style:none;}'+
		'.breadcrumbs li a { display:inline-block; padding-right:14px; background-position:100% 50%; background-repeat:no-repeat; font-size:11px;}'+
		'.breadcrumbs li a { color:#9b9b9b; background-image:url(/etc/designs/panasonic/productpage-clientlibs/images/icn-arrow-lightgrey-left.gif);}'+
		'table { width:98%; border-collapse:collapse; border-spacing:0; border:1px solid #ccc;}'+
		'td { border:1px solid #ccc; background-color:#f5f5f5; padding:10px; vertical-align:top; font-size:12px; line-height:17px; }'+
		'td.tb-blk { background-color:#fff;}'+
		'.spech_lightbox.jspScrollable {overflow:visible!important; height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspContainer {height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspPane {position:static!important; width:auto!important;}'+
		'.spech_lightbox .jspVerticalBar {display:none;}'+
		'.print_copyright {margin-top:20px; text-align:center; font-size:12px;}';
	}else{
		printStyle = 
		'body * { margin:0; padding:0 }'+
		'.spech_img { position:absolute; top:0; left:0; width:145px; height:109px;}'+
		'.printbut,.specall_buttons {display : none}'+
		'.spech_title {height:89px; margin-left:145px; padding-top:20px;}'+
		'.spech_title h2 { font-family: "Open Sans Condensed", sans-serif; font-size:20px; font-weight:bold; line-height:24px;}'+
		'.breadcrumbs {margin-bottom:5px; overflow:hidden; zoom:1;}'+
		'.breadcrumbs li { float:left; margin-right:10px; list-style:none;}'+
		'.breadcrumbs li a { display:inline-block; padding-left:14px; background-position:0 50%; background-repeat:no-repeat; font-size:11px;}'+
		'.breadcrumbs li a { color:#9b9b9b; background-image:url(/etc/designs/panasonic/productpage-clientlibs/images/icn-arrow-lightgrey-right.gif);}'+
		'table { width:98%; border-collapse:collapse; border-spacing:0; border:1px solid #ccc;}'+
		'td { border:1px solid #ccc; background-color:#f5f5f5; padding:10px; vertical-align:top; font-size:12px; line-height:17px; }'+
		'td.tb-blk { background-color:#fff;}'+
		'.spech_lightbox.jspScrollable {overflow:visible!important; height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspContainer {height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspPane {position:static!important; width:auto!important;}'+
		'.spech_lightbox .jspVerticalBar {display:none;}'+
		'.print_copyright {margin-top:20px; text-align:center; font-size:12px;}';
	}
});
var win=null;
function printIt(printThis, printStyle){
	win = window.open();
	self.focus();
	win.document.open();
	win.document.write('<'+'html'+'><'+'head'+'><'+'style'+'>');
	win.document.write(printStyle);
	win.document.write('<'+'/'+'style'+'><'+'/'+'head'+'><'+'body'+'>');
	win.document.write(printThis);
	win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
	win.document.close();
	win.print();
	win.close();
}

function copyUrl(_target){
	var loc = document.location.href ;
	jQuery(function($){
		$('#copyurlbox').remove();
		$(_target).parent().parent().append('<div id="copyurlbox"><a href="#" class="btn_close"><img src="etc/designs/panasonic/common-clientlibs/images/btn-tooltip-close.gif" width="7" height="7" alt="close"></a><span><input type="text" value="'+loc+'" id="specallURL"></span></div>');
		$('#specallURL').select().focus();
		$('#specallURL').on('click', function(e){
			$(this).select().focus();
		});
		$('#specallURL').on('blur', function(e){
			$(this).val(loc);
		});
		$('#copyurlbox .btn_close').on('click',function(e){
			$('#copyurlbox').remove();
			return false;
		});
	});
}
