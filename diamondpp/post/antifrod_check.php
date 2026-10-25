<?php
include '../includes/config.php';

@session_start();
$user_id = htmlentities($_POST['user']);	
$check = htmlentities($_POST['check']);
$user = User::getById($user_id);
if($check == 'true'){
    $user->update([
        'frod_check' => 1        
        ]);
    return 'false';
}elseif($check == 'false'){ 
    $user->update([
        'frod_check' => 0        
        ]);    
    return 'false';
}
