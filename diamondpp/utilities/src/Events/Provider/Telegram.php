<?php

use GuzzleHttp\Exception\ClientException;
use Telegram\Bot\Api;

class Events_Provider_Telegram extends Events_Provider {

    public function send(User $user, Events_Info $info) {
        $key = Registry::get('di')->telegram['KEY'];
        
        //$sendMessage = new SendMessage();
        //$sendMessage->chat_id = $user->telegram; //$tId;
        $msg = $info->title . PHP_EOL;
        
        if ($info->photo) {
            $msg .= $info->photo . PHP_EOL;
        }
        
        $msg .= PHP_EOL . $info->plain;
        
        if ($info->link) {
            $msg .= PHP_EOL . PHP_EOL . " Подробнее по ссылке: " . $info->link;
        }
        
        $msg = strip_tags( html_entity_decode( html_entity_decode($msg) ) );

        //$sendMessage->text = $msg;
        
        $api = new Api($key);
        
        try {

            //$api->performApiRequest($sendMessage);
            
            $response = $api->sendMessage([
                'chat_id' => $user->telegram, 
                'text' => $msg
            ]);
            
        } catch (ClientException $e) {
            echo $e->getMessage();
        }
        usleep(100000);
    }

}
