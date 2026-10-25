var flag;

function doLoad(value) {
	var apath= new Array();
	
	apath[0]='/lib/form_legal.php';
    apath[1]='/lib/anketa.php';
    apath[2]='/lib/form_log.php';
    apath[3]='/lib/anketa_log.php';
    apath[5]='/lib/form_quest.php';

    flag=1;
	var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('output').innerHTML =
               req.responseJS;
               
               $('input').not('.default').iCheck({
            		checkboxClass: 'check',
            		radioClass: 'radio',
            		increaseArea: '20%' // optional
            	});
                smoothJumpUp();
        }
    }
    var path;
    path=apath[id_form];
    req.open(null, path, true);
    req.send( { q: value } );
}

function doLoad_ras(value) {
	var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('qf').innerHTML = req.responseJS;
        }
    }
    var path='/lib/form_subscribe.php';
    req.open(null, path, true);
    req.send( { q: value } );
}

function doLoad_ras_page(value) {
	var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('qfp').innerHTML =
               req.responseJS;
        }
    }
    var path='/lib/form_subscribe_page.php';
    req.open(null, path, true);
    req.send( { q: value } );
}

function smoothJumpUp() { 
   if (document.body.scrollTop>0 || document.documentElement.scrollTop>0) { 
      window.scrollBy(0,-50); 
      setTimeout(smoothJumpUp, 10); 
   } 
} 

window.onload=doLoad_ras('');
