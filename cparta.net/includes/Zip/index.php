<?php
function telegram($text){
    // if(is_array($text)) $text = implode(",",$text);
    $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
    $chat_id = "-336551814";

    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
}

function zip($source, $destination)
{
    // if (!extension_loaded('zip') || !file_exists($source)) {
    //         return false;
    // }
 
    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }
 
    $source = str_replace('\\', DIRECTORY_SEPARATOR, realpath($source));
    $source = str_replace('/', DIRECTORY_SEPARATOR, $source);
 
    if (is_dir($source) === true) {

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source),
            RecursiveIteratorIterator::SELF_FIRST);
 
        foreach ($files as $file) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
            $file = str_replace('/', DIRECTORY_SEPARATOR, $file);
 
            if ($file == '.' || $file == '..' || empty($file) || $file == DIRECTORY_SEPARATOR) {
                continue;
            }
            /*
            if(!isset($d) or $d != 'send'){
                if (in_array(substr($file, strrpos($file, DIRECTORY_SEPARATOR) + 1), array('.', '..', 'index.php', '_success_'))) {
                    continue;
                }
            }
 */
            $file = realpath($file);
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
            $file = str_replace('/', DIRECTORY_SEPARATOR, $file);
 
            if (is_dir($file) === true) {
                $d = str_replace($source . DIRECTORY_SEPARATOR, '', $file);
                if (empty($d)) {
                    continue;
                }
                $zip->addEmptyDir($d);
            } elseif (is_file($file) === true) {
                $zip->addFromString(str_replace($source . DIRECTORY_SEPARATOR, '', $file),
                    file_get_contents($file));
            } else {
                // do nothing
            }
        }
    } elseif (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }
 
    return $zip->close();
}
?>