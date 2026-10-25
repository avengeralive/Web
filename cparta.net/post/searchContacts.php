<?php
@session_start();

include dirname(__FILE__) . '/../includes/config.php';
include dirname(__FILE__) . '/../includes/auth/index.php';

if (!isset($user_id)){
    Header ('Location: /');	
    exit;
}

$user = User::getById($user_id);

if(!$user){
    Header ('Location: /');	
    exit;
}

$post = new Request($_POST);

if(isset($post->search) && $post->search != ''){
    $search = $post->search;
    $users = User::findLogin($search, $user_id);
    if(count($users) > 0){
        $response = array(
            "status" => 'success',
            "message" => $users,
        );
    }else{
        $response = array(
            "status" => 'error',
            "message" => 'Совпадений не найдено!',
        );
    }
    print json_encode($response);
}
