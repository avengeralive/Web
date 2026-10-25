<?php

if(isset($_POST['addgift'])){
    $user = User::getById($user_id);
    if($user->tip != 70) {
        exit;
    }
    $post = new Request($_POST);
    $status = 'success';

    $files = [];
    $imagePath = './templates/default/img/store/';
    $allowedExts = array("image/jpeg","image/png");
    
    foreach( $_FILES as $file ){
        if ( in_array($file["type"], $allowedExts)){
            $filename = $file["tmp_name"];
            if( move_uploaded_file($filename, $imagePath . basename($file['name']) ) ){
                $files[] = realpath( $imagePath . $file['name'] );
                $filename = basename($file['name']);
            }
        }
    }
    
    $gift = new Store();
    $gift->name = $post->name;
    $gift->image = $filename;
    $gift->price = $post->price;
    $gift->count = $post->count;
    $gift->status = 1;
    $gift->create();
    
    header('Location: ./store.php?xtext=1');
}

if(isset($_POST['gift_id'])){
    $user = User::getById($user_id);
    if($user->tip != 70) {
        exit;
    }
    
    $post = new Request($_POST);
    $status = 'success';

    $giftId = $post->gift_id;
    $gift_name = $post->name;
    $gift_img = $post->gift_img;
    $gift_price = $post->price;
    $gift_count = $post->count;
    $gift_status = $post->status;
    
    $gift = Store::getById($giftId);

    $gift->update([
        'name' => $gift_name,
        'image' => $gift_img,
        'price' => $gift_price,
        'count' => $gift_count,
        'status' => $gift_status,
    ]);

    header('Location: ./store.php?xtext=1');
}

if(isset($_POST['idGift'])){
    $user = User::getById($user_id);
    if (!$user) {
        if (!headers_sent()) {
            header('Location: ./');
        }
        exit;
    }
    
    $post = new Request($_POST);
    
    $giftId = $post->idGift;
    $addres = $post->addres;
    
    $gift = Store::getById($giftId);
    
    if($gift->price > $user->coins){
        header('Location: ./store.php?xtext=2');
        exit;
    }
    
    $g = new Store_Request();
    $g->user_id = $user->id;
    $g->id_gift = $gift->id;
    $g->addres = $addres;
    $g->create();
    
    $newCoins = $user->coins - $gift->price;
    $newCount = $gift->count - 1;
    $newStatus = 1;
    if($newCount <= 0){
        $newStatus = 0;
    }
            
    $gift->update([
        'count' => $newCount,
        'status' => $newStatus
    ]);
    
    $user->update([
        'coins' => $newCoins,
    ]);
    
    header('Location: ./store.php?xtext=1');
    exit;
}