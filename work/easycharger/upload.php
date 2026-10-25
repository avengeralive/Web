<?php
session_start();
$sid = session_id();
if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
	$ext_arr = explode('.', $_FILES['file']['name']);
	$ext = rand().".".$ext_arr[count($ext_arr) - 1];
    mkdir('./uploads/'.$sid, 0777);
    move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' .$sid.'/'.$ext);
    echo './uploads/' .$sid.'/'.$ext;
}
?>