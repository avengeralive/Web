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

if(isset($post->mode) && $post->mode == 'write'){

    $text = htmlentities($post->message);
    $chat = intval($post->chat);
    $user_to = intval($post->user_to);
    
    if(!$chat || $chat == 0 || $chat == null){
        
        $Messanger = new Messanger();
        $Messanger->user_1 = $user_to;
        $Messanger->user_2 = $user_id;
        $Messanger->status_us1 = 1;
        $Messanger->create();
        
        $Messanger_id = $Messanger->id;
        
        $Message = new Messanger_Messages();
        $Message->chat_id = $Messanger_id;
        $Message->user_id = $user_id;
        $Message->message = $text;
        $Message->create();
        
    }else{
        $Messanger = Messanger::getById($chat);
        
        if($Messanger->user_1 == $user_id){
            $Messanger->update(['status_us2' => 1]);
        }else{
            $Messanger->update(['status_us1' => 1]);
        }
        
        $Message = new Messanger_Messages();
        $Message->chat_id = $chat;
        $Message->user_id = $user_id;
        $Message->message = $text;
        $Message->create();
    }
    $chatId = $Message->chat_id;
    
        $response = array(
            "status" => 'success',
            "message" => '',
            "chatId" => $chatId,
        );

    print json_encode($response);
}elseif(isset($post->mode) && $post->mode == 'send'){
    
    $text = htmlentities($post->mess);

    $Chat = new Chat();
    $Chat->user_id = $user_id;
    $Chat->login = $user->login;
    $Chat->ava = $user->avatar;
    $Chat->mess = $text;
    $Chat->create();
    
}
