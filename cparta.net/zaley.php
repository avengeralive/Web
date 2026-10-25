<?php
    require dirname(__FILE__) . '/utilities/bootstrap.php';

    if(false === ($uid = User::isAuth())){
        Header('Location: ./login.php');
        exit;
    } 

    $req = new Request($_REQUEST);
    
    $Zaley = new Zaley();
    $authZaley = $Zaley->authUser($req->email);
    
    if($authZaley){
        
        $user = User::getById($uid);

        if(!$user){
            Header('Location: ./login.php');	
            exit;
        }
        
        $user->update([
            'zaleycash_id' => $authZaley
        ]);
        
        Header('Location: https://zaleycash.com/transactions/in');
    }
    exit;