<?php

return [
    'type' => 'phpmailer',
    'config' => [
        'from_email' => 'send@', // . getenv("HTTP_HOST"),
        'from_name' => 'BD CPA',
        'dkim_selector' => '1531867261.cpa',
        'dkim_path' => '/utilities/resources/dkim.txt'
    ],
];
