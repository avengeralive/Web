
<div style="width: 880px; height: 400px; overflow-x: hidden; overflow-y: auto; text-align: left;">
	<p>
		<?php echo $loc['prelandings.php']['t33']; ?>
	</p>

	<p align=center>
		<b><?php echo $loc['prelandings.php']['t34']; ?></b>
	</p>

	<p style="font-size: 12px;">
		<?php 
		highlight_string(str_replace('"',"'",'
		<?php
		if (isset($_GET["land"]) && $_GET["land"]!="") {$url=htmlentities($_GET["land"]);} else {$url="#";}
		if (isset($_GET["subid1"]) && $_GET["subid1"]!="") {$url.="&subid1=".$_GET["subid1"];}
		if (isset($_GET["subid2"]) && $_GET["subid2"]!="") {$url.="&subid2=".$_GET["subid2"];}
		if (isset($_GET["subid3"]) && $_GET["subid3"]!="") {$url.="&subid3=".$_GET["subid3"];}
		?>
		')); 
		?>	
	</p>
	
	<p align=center>
		<b><?php echo $loc['prelandings.php']['t35']; ?></b>
	</p>
	
	<p style="font-size: 12px;">
		<center><b><?php highlight_string('<?php echo $url; ?>'); ?></b></center><br /><b><?php echo $loc['prelandings.php']['t36']; ?>&nbsp;</b><?php highlight_string('<a href="<?php echo $url; ?>">'); echo $loc['prelandings.php']['t37']; highlight_string('</a>'); ?>
	</p>
	
	<p align=center>
		<a class="link" href="#" onclick="document.getElementById('parent_popup_click3').style.display='none';"><?php echo $loc['offers.php']['t62']; ?></a>
	</p>
</div>
