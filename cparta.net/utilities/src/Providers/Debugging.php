<?php

class Debugging {
    public function debug($text){
        if(is_array($text)) $text = implode(",",$text);
        $text = date('Y-m-d H:i:s').' - '.$text;
        $file = "debug.txt";

        if (!file_exists($file)) {
            $fp = fopen($file, "w"); 
            fwrite($fp, $text);
            fclose($fp);
        }else {
            $fh = fopen($file, "a+");
            $success = fwrite($fh, $text.PHP_EOL);
            fclose($fh);
        }
    }

    public function Leadtrade($text){
        if(is_array($text)) $text = implode(",",$text);
        $text = date('Y-m-d H:i:s').' - '.$text;
        $file = "Leadtrade.txt";

        if (!file_exists($file)) {
            $fp = fopen($file, "w");
            fwrite($fp, $text);
            fclose($fp);
        }else {
            $fh = fopen($file, "a+");
            $success = fwrite($fh, $text.PHP_EOL);
            fclose($fh);
        }
    }

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-336551814";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }
}