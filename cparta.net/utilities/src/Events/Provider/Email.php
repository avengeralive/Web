<?php

class Events_Provider_Email extends Events_Provider {

    public function send(User $user, Events_Info $info){
        $sender = Mailing_Sender::getDefaultSender();
        $letter = new Mailing_Letter;
        $letter->setSubject($info->title);
        $letter->setTo($user->email);
        $html = '<table width=100%><tr>';
        if ($info->photo) {
            $html .= '<td> <img src="' . $info->photo . '" width=150> </td>';
        }
        $html .= '<td valign=top><h4>' . $info->title . '</h4>' . nl2br($info->plain);
        if ($info->link) {
            $html .= '<br><Br><a href="' . $info->link . '">Подробнее &rarr;</a>';
        }
        $html .= '</td></tr></table>';
        $letter->setHtml($html);
        $sender->send($letter);
    }

}
