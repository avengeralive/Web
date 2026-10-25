<?php
class sendNotification{
	
	function __construct($mysqli){
		$this->mysqli = $mysqli;
	}	
	
	function countSendUsers($offer){

		$sql = "SELECT * FROM dead_line_offers WHERE `offer_id` = '$offer'";
		$result = $this->mysqli->query($sql);
		$row = mysqli_num_rows($result);
		return $row;
		
	}
	
	
}