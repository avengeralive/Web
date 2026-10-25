<?php

// Функция работы с электроной почтой
// Function to work with e-mail
function SendEMail($to, $subj, $msg) {
    $letter = new Mailing_Letter;
    $letter->setSubject($subj);
    $letter->setHtml($msg);
    $letter->setTo($to);
    $sender = Mailing_Sender::getDefaultSender();
    $sender->send($letter);
    return;
    $from_email = "info@" . $_SERVER['SERVER_NAME'];
    $mail_headers = '';
    $mail_headers .= "MIME-Version: 1.0\r\n";
    $mail_headers .= "Content-type: text/html; charset=utf-8\r\n";
    $mail_headers .= "From: $from_email\r\n";
    $mail_headers .= "Reply-To: $from_email\r\n";
    $mail_headers .= "Return-Path: $from_email\r\n";
    $mail_headers .= "Subject: {$subj}\r\n";
    $mail_headers .= "X-Mailer: PHP/" . phpversion();
    $sobiraem_text_pisma = generatestring(50) . "<br />--------------------------------------------------<br /><br />" . $msg . "<br /><br />--------------------------------------------------<br />" . generatestring(50);
    $msg = $sobiraem_text_pisma;
    mail($to, $subj, $msg, $mail_headers);
}

?>