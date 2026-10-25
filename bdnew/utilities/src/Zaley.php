<?php

class Zaley {
    
    protected $secret = '';
    protected $token;
    
    const CIPHER_KEY = '728334qe';
    const YES_KEY = 'd92ba2833da1d214c2064e5adc9a433b';
    const URL_API = 'https://zaleycash.com';

    public function __construct() {
        $di = Registry::get('di');
        $zaley = $di->zaley;
        $this->secret = $zaley['secret'];
    }
    
    public function authUser($email) {

        $key = self::CIPHER_KEY;
 
        $c = base64_decode($email);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $email = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        if (hash_equals($hmac, $calcmac))// с PHP 5.6+ сравнение, не подверженное атаке по времени
        {
            $zaley_user_id = self::getUserId($email);
            if($zaley_user_id){
                return self::AuthUserZaley($zaley_user_id);
            }
        }
        
        return false;
    }
    
    public function getUserId($email) {
        $url = self::URL_API . '/api/v1/user?email='.$email;
        $token = self::getToken();
        if($token){
            $req = self::request('GET', $token, $url);
            
            if($req->code == 200 && $req->message == 'OK'){
                return $req->response->user->id;
            }
        }
        
        return false;
    }

    
    
    public function getUserBalance() {

        $req = new Request($_REQUEST);
        $uid = $req->user_id;
        
        if($req->apikey !== self::YES_KEY){
            header("Content-Type:application/json;charset=utf-8");
            echo json_encode(['status' => 401, 'error' => 'Bad key'], JSON_PRETTY_PRINT);
            exit();
        }
        
        $user = User::getByZC($uid);
        if(!$user || !$user->zaleycash_id || $user->zaleycash_id == ''){
            header("Content-Type:application/json;charset=utf-8");
            echo json_encode(['status' => 401, 'error' => 'User not found'], JSON_PRETTY_PRINT);
            exit();
        }
        
        $arr = [
            'user_id' => $uid,
            'balance' => $user->balance,
        ];
                
        echo json_encode($arr);
        exit();
    }
    
    
    public function moneySend() {

        $req = new Request($_REQUEST);
        $uid = $req->user_id;
        $sum = $req->sum;
        
            $logger = Registry::get('di')->logger;
            $logger->custom('ZALEY', serialize($req));
        
        if($req->apikey !== self::YES_KEY){
            header("Content-Type:application/json;charset=utf-8");
            echo json_encode(['status' => 401, 'error' => 'Bad key'], JSON_PRETTY_PRINT);
            exit();
        }
        
        $user = User::getByZC($uid);
        if(!$user || !$user->zaleycash_id || $user->zaleycash_id == ''){
            header("Content-Type:application/json;charset=utf-8");
            echo json_encode(['status' => 401, 'error' => 'User not found'], JSON_PRETTY_PRINT);
            exit();
        }
        
        $balance = $user->balance;
        
        if($balance >= $sum){
            $new_balance = $balance - $sum;
            $user->update([
                'balance' => $new_balance
            ]);
            
            $log_finances = new FinancesLog;
            $log_finances->user_id = $user->id;
            $log_finances->operation = 2;
            $log_finances->summ = $sum;
            $log_finances->description = 19;
            $log_finances->balance = $new_balance;
            $log_finances->status = 2;
            $log_finances->create();
            
            $operation_id = $log_finances->id;
            
            $op = self::moneyTransfer($user->zaleycash_id, $sum, $operation_id);
            if($op){
                self::TransOk($operation_id);
                return $op;
            }else{
                $new_balance = $balance + $sum;
                $user->update([
                    'balance' => $new_balance
                ]);
                $fl = FinancesLog::getById($operation_id);
                $fl->update([
                    'status' => 3
                ]);
            }
        }else{
            header("Content-Type:application/json;charset=utf-8");
            echo json_encode(['status' => 401, 'error' => 'Not enough money'], JSON_PRETTY_PRINT);
            exit();
        }
        return false;
    }
    
    public function TransOk($operation_id) {
        $url = self::URL_API . '/api/v1/money/transaction';
        $token = self::getToken();
        
       $request = [
           'transactions' => [
               'operation_id' => 'approved',
           ]
       ];
        
        if($token){
            $req = self::request('PUT', $token, $url, json_encode($request));
            if($req->code == 200 && $req->message == 'OK'){
                return $req->response->transactions;
            }
        }
        
        return false;
    }
    
    public function moneyTransfer($userid, $sum, $operation_id) {
        $url = self::URL_API . '/api/v1/money/transfer';
        $token = self::getToken();
        
       $request = [
           'internal' => [
               'user_id' => $userid,
               'amount' => (int)$sum,
               'operation_id' => $operation_id
           ]
       ];
        
        if($token){
            $req = self::request('POST', $token, $url, json_encode($request));
            if($req->code == 200 && $req->message == 'OK'){
                return $req->response->operation_id;
            }
        }
        
        return false;
    }
    
    public function AuthUserZaley($id) {
        $url = self::URL_API . '/api/v1/user/children';
        $token = self::getToken();
        
       $request = [
           'user' => $id
       ];
        
        if($token){
            $req = self::request('POST', $token, $url, json_encode($request));
            if($req->code == 200 && $req->message == 'OK'){
                return $req->response->user->id;
            }
        }
        
        return false;
    }
    
    private function getToken(){
        $key = $this->secret;
        $url = self::URL_API . '/api/v1/token';
        
        $req = self::request('POST', $key, $url);

        if($req->code == 200 && $req->message == 'OK'){
            return $req->response->access_token;
        }
        return false;
        
    }

    
    
    protected static function request($method, $token, $url, $request) {
        
        $headers = [
            'Authorization: Bearer '.$token
        ];
        
            $logger = Registry::get('di')->logger;
            $logger->custom('ZALEY', $request);
        
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_URL,$url);
        if($method == 'POST'){
            curl_setopt($curl,CURLOPT_POST,true);
            curl_setopt($curl,CURLOPT_POSTFIELDS, $request);            
        }   
        if($method == 'PUT'){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);          
        }
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data=curl_exec($curl);
        curl_close($curl);
        
            $logger = Registry::get('di')->logger;
            $logger->custom('ZALEY', $data);
        
        return json_decode($data);
    }
    
}
