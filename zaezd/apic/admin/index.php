<?php
require("header.php");
?>

<body>
<div id="a">
<div id="aa">
<a href="/admin/"><img src="/admin/files/ilogo.gif" alt="" /></a>
<p><a href="/" title="Intype" target="_blank"><?php echo $config["url"]; ?></a></p>
</div><!--aa-->

<div id="ab">
<?php
include($inc_path."/admin/service/login.php");
?>
<ul id="nava">
<?php
include($inc_path."/admin/output/menu_top.php");
?>
</ul>
</div><!--ab-->
</div><!--a-->
<div id="b">
<ul id="navb">
	<li>Вы здесь: </li>
<?php
echo $navigation;
?>
</ul>
<p><a href="/admin/">Главная</a></p>
</div><!--b-->

<div id="c">
<div id="ca">

<ul id="navc">
<?php
include($inc_path."/admin/output/menu_left.php");
?>
</ul>

<div class="cabot">&nbsp;</div>

</div><!--ca-->
<div id="cb">
<div id="cba">
<?php
if(empty($err_mess)) include($inc_path."/admin/output/select.php");
else echo $err_mess;
?>
</div><!--cba-->
</div><!--cb-->
<div class="clr">&nbsp;</div>
</div><!--c-->


</body>
</html>