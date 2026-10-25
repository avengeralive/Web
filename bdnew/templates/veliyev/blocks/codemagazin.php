
<div style="width: 880px; height: 400px; overflow-x: hidden; overflow-y: auto; text-align: left;">
<p>
	<?php echo $loc['offers.php']['t63']; ?>
</p>

<p align=center>
	<b><?php echo $loc['offers.php']['t64']; ?></b>
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
// Determine the domain that is used for landings
$sql_domain = "SELECT domain FROM domains WHERE `active`='1' ORDER BY `id` DESC";
$result_domain = $mysqli->query($sql_domain);
$res_domain=mysqli_fetch_array($result_domain);
$domain=htmlentities($res_domain['domain']);
?>

<p align=center>
	<b><?php echo $loc['offers.php']['t65']; ?></b>
</p>

<p style="font-size: 12px;">
	<?php		
	highlight_string(str_replace('^',"'",'
	<?php 
	// '.$loc['offers.php']['t90'].'
	if (isset($_SESSION[^code^]))
		{
		$code=htmlentities($_SESSION[^code^]);
		$ch = curl_init("http://'.$domain.'");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		"code"	=>	$code, 
		"shop_key"	=>	^'.$loc['offers.php']['t66'].'^, // '.$loc['offers.php']['t67'].'
		"shop_zakaz_id"    =>    $zakaz_id,  // '.$loc['offers.php']['t68'].'
		"cena"	=>	$summa, // '.$loc['offers.php']['t69'].'
		"name"	=>	$name, // '.$loc['offers.php']['t70'].'
		"phone"	=>	$phone, // '.$loc['offers.php']['t71'].'
		"email"	=>	$email // '.$loc['offers.php']['t72'].'
		));
		$body = curl_exec($ch);
		curl_close($ch);
		} 
	// '.$loc['offers.php']['t91'].'
	?>
	'));
	?>
</p>

<p align=center>
	<b><?php echo $loc['offers.php']['t74']; ?></b>
</p>

<p style="font-size: 12px;">
	<?php		
	highlight_string(str_replace('^',"'",'
	<?php
	// (int)$data[^order_status_id^] - '.$loc['offers.php']['t110'].'
	// $shop_zakaz_status - '.$loc['offers.php']['t111'].'
	if ((int)$data[^order_status_id^]==^1^) {$shop_zakaz_status=^1^;} // '.$loc['offers.php']['t76'].'
	if ((int)$data[^order_status_id^]==^2^) {$shop_zakaz_status=^2^;} // '.$loc['offers.php']['t77'].'
	if ((int)$data[^order_status_id^]==^4^) {$shop_zakaz_status=^3^;} // '.$loc['offers.php']['t78'].'
	if ((int)$data[^order_status_id^]==^6^) {$shop_zakaz_status=^0^;} // '.$loc['offers.php']['t79'].'
	$code=htmlentities($_SESSION[^code^]); 
	$ch = curl_init("'.$domain.'"); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, array( 
	"shop_key"    =>    ^'.$loc['offers.php']['t66'].'^, // '.$loc['offers.php']['t80'].'
	"shop_zakaz_id"    =>  (int)$order_id,  // '.$loc['offers.php']['t68'].'
	"shop_zakaz_status"    =>  $shop_zakaz_status  // '.$loc['offers.php']['t81'].'
	)); 
	$body = curl_exec($ch); 
	curl_close($ch); 
	?>	
	'));
	?>
</p>

<p>
	<hr>
</p>

<p align=center>
	<b><?php echo $loc['offers.php']['t82']; ?></b>
</p>
<p>
	<b><?php echo $loc['offers.php']['t83']; ?></b><br />
	<?php echo $loc['offers.php']['t84']; ?>
</p>

<p>
	<b><?php echo $loc['offers.php']['t85']; ?></b><br />
	<?php echo $loc['offers.php']['t86']; ?><br />
	<font color=blue><b>./catalog/model/checkout/order.php</b></font><br />
	<?php echo $loc['offers.php']['t87']; ?>&nbsp;<b>addOrder</b>,&nbsp;<?php echo $loc['offers.php']['t88']; ?>&nbsp;<b>return $order_id;</b><br /><br />

	<b><u><?php echo $loc['offers.php']['t89']; ?></u></b><br />
	
	<b>
	<?php		
	highlight_string(str_replace('^',"'",'
// '.$loc['offers.php']['t90'].'
if (isset($_SESSION[^code^]))
	{
	$code=htmlentities($_SESSION[^code^]);
	$ch = curl_init("http://'.$domain.'");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array(
	"code"    =>    $code, 
	"shop_key"    =>    ^'.$loc['offers.php']['t66'].'^, // '.$loc['offers.php']['t80'].'
	"shop_zakaz_id"    =>    (int)$order_id,  // '.$loc['offers.php']['t68'].'
	"cena"    =>    (int)$data[^total^], // '.$loc['offers.php']['t69'].' 
	"name"    =>    $data[^firstname^]." ".$data[^lastname^], // '.$loc['offers.php']['t70'].' 
	"phone"    =>    $data[^telephone^], // '.$loc['offers.php']['t71'].' 
	"email"    =>    $data[^email^] // '.$loc['offers.php']['t72'].'
	));
	$body = curl_exec($ch);
	curl_close($ch);
	} 
// '.$loc['offers.php']['t91'].'	
	'));
	?>
	</b>
	
	<br />
	<font color=red><b><?php echo $loc['offers.php']['t92']; ?></b>&nbsp;<?php echo $loc['offers.php']['t93']; ?></font>
</p>

<p>
	<b><?php echo $loc['offers.php']['t94']; ?></b><br />
	<?php echo $loc['offers.php']['t86']; ?><br />
	<font color=blue><b>./admin/model/sale/order.php</b></font><br />
	<?php echo $loc['offers.php']['t87']; ?>&nbsp;<b>editOrder</b><br /><br />
	
	<b><u><?php echo $loc['offers.php']['t89']; ?></u></b><br />

	<b>
	<?php		
	highlight_string(str_replace('^',"'",'
// '.$loc['offers.php']['t95'].'
if ((int)$data[^order_status_id^]==^1^) {$shop_zakaz_status=^1^;} // '.$loc['offers.php']['t96'].'
if ((int)$data[^order_status_id^]==^2^) {$shop_zakaz_status=^2^;} // '.$loc['offers.php']['t97'].'
if ((int)$data[^order_status_id^]==^4^) {$shop_zakaz_status=^3^;} // '.$loc['offers.php']['t98'].'
if ((int)$data[^order_status_id^]==^6^) {$shop_zakaz_status=^0^;} // '.$loc['offers.php']['t99'].'
$code=htmlentities($_SESSION[^code^]); 
$ch = curl_init("'.$domain.'"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
curl_setopt($ch, CURLOPT_POSTFIELDS, array( 
"shop_key"    =>    ^'.$loc['offers.php']['t66'].'^, // '.$loc['offers.php']['t80'].'
"shop_zakaz_id"    =>  (int)$order_id,  // '.$loc['offers.php']['t68'].'
"shop_zakaz_status"    =>  $shop_zakaz_status  // '.$loc['offers.php']['t81'].'
)); 
$body = curl_exec($ch); 
curl_close($ch); 
// '.$loc['offers.php']['t100'].'
	'));
	?>	
	</b>
	
	<br />
	<font color=red>
		<b><u><?php echo $loc['offers.php']['t92']; ?></u></b><br />
		<?php echo $loc['offers.php']['t101']; ?><br />
		<?php echo $loc['offers.php']['t102']; ?><br /><br />
	</font>

	<font color=blue><b>
	<?php echo $loc['offers.php']['t103']; ?>&nbsp;$data['order_status_id']&nbsp;<?php echo $loc['offers.php']['t104']; ?><br />
	$shop_zakaz_status=1&nbsp;<?php echo $loc['offers.php']['t105']; ?><br />
	$shop_zakaz_status=2&nbsp;<?php echo $loc['offers.php']['t106']; ?><br />
	$shop_zakaz_status=3&nbsp;<?php echo $loc['offers.php']['t107']; ?><br />
	$shop_zakaz_status=0&nbsp;<?php echo $loc['offers.php']['t108']; ?>
	</b></font>
</p>

<p>
	&nbsp;
</p>

<p align=center>
	<a class="link" href="#" onclick="document.getElementById('parent_popup_click2').style.display='none';"><?php echo $loc['offers.php']['t62']; ?></a>
</p>
</div>