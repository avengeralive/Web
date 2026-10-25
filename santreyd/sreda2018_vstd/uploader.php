<?php
foreach ($_FILES as $key => $value) {
	echo $value["name"];
	echo $value["tmp_name"];
	$target_dir = "./uploads/";
$target_file = $target_dir . basename($value["name"]);
move_uploaded_file($value["tmp_name"], $target_file);
}

?>