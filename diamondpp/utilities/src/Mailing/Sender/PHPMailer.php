<?php

class Mailing_Sender_PHPMailer extends Mailing_Sender {

    public function send(Mailing_Letter $letter = null) {
        if (!$letter) {
            $letter = $this->letter;
        }
        if (!$letter) {
            throw new Exception("Unable to send. Letter is null");
        }
        $m = new PHPMailer;

//        $m->isSendmail();
//        $m->isMail();
//        $m->isQmail();
        $m->isSMTP();

        $m->DKIM_domain = '';
        $m->DKIM_identity = $this->_config['from_email'];
        $m->DKIM_selector = $this->_config['dkim_selector'];
        $m->DKIM_passphrase = '';
        $m->DKIM_private = $this->_config['dkim_path'];
        $m->SMTPDebug = 4;

        $letter->ready();
        foreach ($letter->getHeaders() as $name => $value) {
            $m->addCustomHeader($name . ': ' . $value);
        }
        $m->CharSet = 'UTF-8';
        $m->addAddress($letter->getToEmail(), $letter->getToName());
        $m->Subject = $letter->getSubject();
        $m->isHTML();
        $m->Body = $letter->getHtml();
        $m->setFrom($this->_config['from_email'], $this->_config['from_name']);

        $result = false;

        try {
            $result =  $m->send();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
//        exit;

        return $result;
    }

}
