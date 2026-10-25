<?php
/*ini_set('display_errors', 'On');
error_reporting(-1);*/

require("../config/head.php");
require($inc_path."config/config.php");

//ini_set('session.save_path', $s_path);
ini_set('session.gc_maxlifetime', 14400);
ini_set('session.cookie_lifetime', 14400);

session_name($session_name);
session_start();

include($inc_path."admin/service/clog.php");

include($inc_path."service/start.php");

include($inc_path."admin/service/navy.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title><?php echo $meta["title"]; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="ru-RU" />
<meta name="robots" content="index, follow" />
<style type="text/css" media="screen">@import "/admin/files/css.css";</style>
<style type="text/css" media="screen">@import "/admin/files/style.css";</style>
<style type="text/css" media="screen">@import "/admin/files/cal/cal.css";</style>
<script type="text/javascript" src="/admin/files/js.js"></script>
<script type="text/javascript" src="/admin/files/trans.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/admin/files/script.js"></script>
<script type="text/javascript" src="/admin/files/jquery.tablesorter.min.js"></script>
<style type="text/css" media="screen">@import "/admin/files/sorter/style.css";</style>
<script type="text/javascript" src="/admin/files/jquery.datetimepicker.js"></script>
<style type="text/css" media="screen">@import "/admin/files/jquery.datetimepicker.css";</style>
</head>

<script language="JavaScript">
$(document).ready(function()
{
    $('#cba').css('height', $(window).height()-150);
    
    $('#firstpane').find('span.menu_head').click(function(){
        $(this).next().stop().slideToggle();
    }).next().stop().hide();
    
    var result = '';
    setInterval(pinger, 300000);
});

function pinger() {
$.post("/admin/pinger.php",
function(result) { });
}

</script>