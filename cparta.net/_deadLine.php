<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	@session_start();
	if (isset($_SESSION['id']) && (int)$_SESSION['id']){

		$user_id = $_SESSION['id'];
		$sms = ($_POST['sms'] == 'true') ? 1 : 0;
		$email = ($_POST['email'] == 'true') ? 1 : 0;
		$kolvo_hour = htmlentities($_POST['kolvo_hour']);
		$kolvo_lids = htmlentities($_POST['kolvo_lids']);
		$offer = htmlentities($_POST['offer']);
		
		include $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/antiinject/index.php';	

		if(isset($_POST['phone'])){
			$phone = htmlentities($_POST['phone']);
			$sql = "UPDATE users SET `phone` = '$phone' WHERE `id` = '$user_id' LIMIT 1";
			$mysqli->query($sql);			
		}
		
		
		$sql = "SELECT * FROM dead_line_offers WHERE `offer_id`='$offer' AND `user_id` = '$user_id'";
		$result=$mysqli->query($sql);
		$res=mysqli_num_rows($result);
	
		if($res == 0){
			
			$sql = "INSERT INTO dead_line_offers (`user_id`, `offer_id`, `sms`, `email`, `kolvo_hour`, `kolvo_lids`) 
			VALUES ('$user_id', '$offer', '$sms', '$email','$kolvo_hour','$kolvo_lids')";
			$mysqli->query($sql);
			
		}else{
			
			$sql2 = "UPDATE dead_line_offers SET `sms` = '$sms', `email` = '$email', `kolvo_hour` = '$kolvo_hour', `kolvo_lids` = '$kolvo_lids', `status` = '0' WHERE `offer_id` = '$offer' AND `user_id` = '$user_id'";
			$mysqli->query($sql2);

		}
		echo $res;
	}else exit();
	
}else exit();