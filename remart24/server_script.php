<?php
	if(isset($_POST['last_commit']) && !empty($_POST['last_commit']) && isset($_POST['new_commit']) && !empty($_POST['new_commit'])){
		
		$last_commit = $_POST['last_commit']; //4b06af5
		$new_commit = $_POST['new_commit']; //82a02c9
		
		$page = shell_exec("sh download.sh ".$new_commit." ".$last_commit);
		// echo $page;
		echo json_encode(array("0"=>"1"));
	}

?>