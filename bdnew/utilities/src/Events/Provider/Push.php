<?php

class Events_Provider_Push extends Events_Provider {

    public function send(User $user, Events_Info $info) {

        $url = 'https://fcm.googleapis.com/fcm/send';
        $YOUR_API_KEY = 'AAAA9_KgA7k:APA91bH7uanCMeKlp3DtsE4uOUcuysxachYSTQLVs0vSl36RsUT7ECgXGg3r04h39o0TxtBijIkVkZGdPkP8Xij2Lt5nHgdR9PnnuBz6Uzp_4lZBlCEwP0_4e9RDOpTxBJ1_HI31R7Dx0490epxziOqeBtmY3SDIjQ'; // Server key
        $YOUR_TOKEN_ID = $user->push; // Client token id

        $msg = strip_tags( html_entity_decode( html_entity_decode($info->plain) ) );
        
        $request_body = [
            'to' => $YOUR_TOKEN_ID,
            'notification' => [
                'title' => $info->title,
                'body' => $msg,
                'icon' => ($info->photo ? $info->photo : 'https:///templates/default/img/logo_3.png'),
                'click_action' => ($info->link ? $info->link : 'https:///'),
            ],
        ];
        $fields = json_encode($request_body);

        $request_headers = [
            'Content-Type: application/json',
            'Authorization: key=' . $YOUR_API_KEY,
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);
        var_dump($response);
    }

}
