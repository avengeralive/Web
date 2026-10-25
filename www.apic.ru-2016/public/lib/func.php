<?php

function email($to, $subject, $body_text, $body_html, $from, $fromName, $attachments)
{
    $res = "";

    $data = "username=".urlencode("climatexpo@apic.ru");
    $data .= "&api_key=".urlencode("dc23a982-44aa-48ac-a70d-f2ca13f3c077");
    $data .= "&charset=".urlencode("utf-8");
    $data .= "&from=".urlencode($from);
    $data .= "&from_name=".urlencode($fromName);
    $data .= "&to=".urlencode($to);
    $data .= "&subject=".urlencode($subject);
    if($body_html)
      $data .= "&body_html=".urlencode($body_html);
    if($body_text)
      $data .= "&body_text=".urlencode($body_text);
    if($attachments)
      $data .= "&attachments=".urlencode($attachments);  

    $header = "POST /mailer/send HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($data) . "\r\n\r\n";
 //    $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 10);
     $fp = fsockopen('api.elasticemail.com', 80, $errno, $errstr, 10);


    if(!$fp)
      return "ERROR. Could not open connection";
    else {
      fputs ($fp, $header.$data);
      while (!feof($fp)) {
        $res .= fread ($fp, 1024);
      }
      fclose($fp);
    }
    return $res;                  
}

function uploadAttachment($filepath, $filename) {
    $data = http_build_query(array('username' => "climatexpo@apic.ru",'api_key' => "dc23a982-44aa-48ac-a70d-f2ca13f3c077",'file' => $filename));
    $file = file_get_contents($filepath);
    $result = ''; 

    $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30);   

    if ($fp){
        fputs($fp, "PUT /attachments/upload?".$data." HTTP/1.1\r\n");
        fputs($fp, "Host: api.elasticemail.com\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ". strlen($file) ."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $file);
        while(!feof($fp)) {
            $result .= fgets($fp, 128);
        }
    } else { 
        return array(
            'status'=>false,
            'error'=>$errstr.'('.$errno.')',
            'result'=>$result);
    }
    fclose($fp);
    $result = explode("\r\n\r\n", $result, 2); 
    return array(
        'status' => true,
        'attachId' => isset($result[1]) ? $result[1] : ''
    );
}

$approve_text='<html><head><title>Рассылка АПИК</title>
<meta http-equiv="content-Type" content="text/html; charset=utf8" />
</head>
<body>
<p>Здравствуйте! 

<p>От Вашего имени получена заявка на рассылку новостей АПИК.</p> 

<p>Если Вы подтверждаете получение новостной рассылки -  нажмите «Подтвердить участие в рассылке»</p>

<p>Если Вы хотите отписаться от новостной рассылки - нажмите «Отказаться от рассылки»</p> 

<p>Приносим извинения за возможное беспокойство.</p>

<p>С уважением,
Администрация Интернет-ресурсов  www.apic.ru , www.climatexpo.ru , www.mir-klimata.info ,  www.hvac-school.ru</p>';
?>