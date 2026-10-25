<div style="width: 880px; height: 400px; overflow-x: hidden; overflow-y: auto; text-align: left;">
<p>
	<?php echo $loc['offers.php']['t56']; ?>
</p>

<p align=center>
	<b><?php echo $loc['offers.php']['t57']; ?></b>
</p>

<p style="font-size: 12px;">
<?php 

// Определяем постклик
// Define postclick
$offer_id=htmlentities($_GET['offer']);
$sql_postclick = "SELECT postclick FROM offers WHERE `id`='$offer_id'";
$result_postclick = $mysqli->query($sql_postclick);
$res_postclick=mysqli_fetch_array($result_postclick);
$offer_postclick=htmlentities($res_postclick['postclick']);

highlight_string(str_replace('"',"'",'
	<?php
	// '.$loc['offers.php']['t73'].'
	session_set_cookie_params(60*60*24*'.$offer_postclick.');
	session_start();
	if (isset($_GET["stats"]) && $_GET["stats"]!="" && $_GET["stats"]!="0")
		{
		$_SESSION["code"]=htmlentities($_GET["stats"]);
		}
	?>
')); 
?>	
</p>

<?php 
// Определяем домен который используется для лендингов
// Determine the domain that is used for landing
$sql_domain = "SELECT domain FROM domains WHERE `active`='1' ORDER BY `id` DESC";
$result_domain = $mysqli->query($sql_domain);
$res_domain=mysqli_fetch_array($result_domain);
$domain=htmlentities($res_domain['domain']);

if ($offer_deystvie=='5')
	{
	?>
	<p align=center>
		<b><?php echo $loc['offers.php']['t58']; ?>&nbsp;<font color=red>action=""</font>.<br /><?php echo $loc['offers.php']['t59']; ?></b>
	</p>

	<p style="font-size: 12px;">
		<?php
		highlight_string(str_replace('^',"'",'http://'.$domain.'/buy.php?pay=<?php if (isset($_SESSION[^code^])) {echo $_SESSION[^code^];} ?>'));
		?>
	</p>
	<?php
	}
else
	{
	?>
	<p align=center>
		<b><?php echo $loc['offers.php']['t60']; ?></b>
	</p>

	<p style="font-size: 12px;">
		<?php		
		highlight_string(str_replace('^',"'",'
		<?php 
		session_start();
		// '.$loc['offers.php']['t109'].' 
		if (isset($_SESSION[^code^])) 
			{ 
			if (isset($_POST[^name^])) {$name=htmlentities($_POST[^name^]);} else {$name=^^;}
			if (isset($_POST[^phone^])) {$phone=htmlentities($_POST[^phone^]);} else {$phone=^^;}
			if (isset($_POST[^email^])) {$email=htmlentities($_POST[^email^]);} else {$email=^^;}
			if (isset($_POST[^address^])) {$address=htmlentities($_POST[^address^]);} else {$address=^^;}
			if (isset($_POST[^kolvo^])) {$kolvo=htmlentities($_POST[^kolvo^]);} else {$kolvo=^^;}
			if (isset($_POST[^cena^])) {$cena=htmlentities($_POST[^cena^]);} else {$cena=^^;}
			if (isset($_POST[^artikul^])) {$artikul=htmlentities($_POST[^artikul^]);} else {$artikul=^^;}
			$url = ^http://'.$domain.'^; 
			$data = array 
				( 
				^code^ => htmlentities($_SESSION[^code^]), 
				^name^ => $name, 
				^phone^ => $phone, 
				^email^ => $email,
				^address^ => $address,
				^kolvo^ => $kolvo,
				^cena^ => $cena,
				^artikul^ => $artikul,
				); 
			$options = array (^http^ => array (^header^ => "Content-type: application/x-www-form-urlencoded\r\n", ^method^  => ^POST^, ^content^ => http_build_query($data))); 
			$context  = stream_context_create($options); 
			$result = file_get_contents($url, false, $context); 
			if ($result === FALSE) {echo ^'.$loc['offers.php']['t61'].'^;} 
			} 
		?>
		'));
		?>
	</p>
	<?php
	}
?>	
</p>

<p>
	&nbsp;
</p>

<p align=center>
	<a class="link" href="#" onclick="document.getElementById('parent_popup_click').style.display='none';"><?php echo $loc['offers.php']['t62']; ?></a>
</p>
</div>