var flag;

function doLoad(value) {
	var apath= new Array();
	
	apath[0]='/lib/form_legal.php';
    apath[1]='/lib/anketa.php';
    apath[2]='/lib/form_log.php';
    apath[3]='/lib/anketa_log.php';
    apath[4]='/lib/form_dp.php';

    flag=1;
	var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('output').innerHTML =
               req.responseJS;
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
            document.getElementById('qf').innerHTML =
               req.responseJS;
        }
    }
    var path='/lib/form_subscribe_en.php';
    req.open(null, path, true);
    req.send( { q: value } );
}


window.onload=doLoad_ras('');

