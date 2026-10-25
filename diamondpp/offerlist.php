<?php

$CONNECT = mysqli_connect('localhost','root','5JTLc75A5JTLc75A','cpa') or die('Не удалось подключиться к базе');
$offers = mysqli_query($CONNECT,"SELECT * FROM offers WHERE active = 1 and uroven_dostupa = 1");

$res = [];
$res['status'] = 200;
$res['error'] = "";
$res['data'] = [];

while ($ofr = mysqli_fetch_assoc($offers)) {
    $ofr_arr = [];
    $ofr_arr['id'] = $ofr['id'];
    $ofr_arr['title'] = htmlspecialchars($ofr['name']);
    $ofr_arr['url'] = $ofr['url'];
    $ofr_arr['description'] = htmlspecialchars($ofr['descr']);
    $ofr_arr['fullDescription'] = htmlspecialchars($ofr['descr']);
    $ofr_arr['hold'] = 0;
    $ofr_arr['postclick'] = '';
    $ofr_arr['percent_value'] = '';
    $countries_bl = explode('|', $ofr['geo'])[0];
    $tip_comission = explode('|', $ofr['tip_comission']);
    $comission = explode('|', $ofr['comission']);
    $countries = explode(':', $countries_bl);
    $cnt_arr = [];
    $ofr_arr['goals'] = [];
    foreach ($countries as $key => $country) {
        $cr = mysqli_query($CONNECT,'SELECT * FROM sxgeo_country WHERE iso = "'.$country.'"');
        $crres = mysqli_fetch_assoc($cr);
        $cnt_arr[] = [
            'code' => $crres['iso'],
            'name' => $crres['name_ru']
        ];
        $isPercent = false;
        if ($tip_comission[$key] == 2) $isPercent = true;
        
        $ofr_arr['goals'][] = [
            "title" => "Подтвержденный заказ",
            "cps" => false,
            "profit" => $comission[$key],
            "currency" => $crres['currency_iso'],
            "isPercent" => $isPercent,
            "geo" => $crres['iso'],
            "pay_landing" => $ofr['cena'],
            "landing_currency" => "RUB"	
        ];
    }
    $ofr_arr['geo'] = [];
    $ofr_arr['geo']['country'] = $cnt_arr;
    $ofr_arr['landings'] = [];
    $cr = mysqli_query($CONNECT,'SELECT * FROM landings WHERE offer_id = '.$ofr['id']);
    while ($crres = mysqli_fetch_assoc($cr)) {
        $ofr_arr['landings'][] = [
            'title' => htmlspecialchars($crres['name']),
            'url' => $crres['url']
        ];
    }
    $ofr_arr['sources'] = [];
    $cr = mysqli_query($CONNECT,'SELECT * FROM tip_traffic_tpl');
    $traf = explode('|', $ofr['tip_traffic']); $i = 0;
    while ($crres = mysqli_fetch_assoc($cr)) {
        $ofr_arr['sources'][] = [
            'id' => $crres['id'],
            'title' => htmlspecialchars($crres['tip']),
            'legal' => $traf[$i]
        ];
        $i++;
    }

    $ofr_arr['transits'] = $ofr_arr['landings'];
    $res['data'][] = $ofr_arr;
}
//var_dump($res);
echo json_encode($res);

/*
{
    "status": 200,
    "error": "",
    "data": [
        {
            "id": 28,
            "title": "AliExpress",
            "url": "http://aliexpress.com",
            "description": "AliExpress - это",
	    "fullDescription" : "Полное описание AliExpress - это ", 
            "hold": 0,
            "postclick": 25,
            "percent_value": 85,
            "geo": {
                "country": [
                    {
                        "code": "RU",
                        "name": "Россия"
                    },
                    {
                        "code": "UA",
                        "name": "Украина"
                    }
                ]
            },
            "sources": [
                {
                    "id": 0,
                    "title": "веб-сайты",
                    "legal": 1
                },
                {
                    "id": 1,
                    "title": "дорвеи",
                    "legal": 1
                },
                {
                    "id": 2,
                    "title": "контекстная реклама",
                    "legal": 1
                },
                {
                    "id": 3,
                    "title": "контекстная реклама на бренд",
                    "legal": 0
                },
                {
                    "id": 4,
                    "title": "тизерная/баннерная реклама",
                    "legal": 1
                },
                {
                    "id": 5,
                    "title": "соцсети: таргетированная реклама",
                    "legal": 0
                },
                {
                    "id": 6,
                    "title": "соцсети: паблики, игры, приложения",
                    "legal": 0
                },
                {
                    "id": 7,
                    "title": "email-рассылка",
                    "legal": 1
                },
                {
                    "id": 8,
                    "title": "CashBack",
                    "legal": 0
                }
            ],
            "goals": [
                {
                    "title": "Доставленный заказ",
                    "cps": false,
                    "profit": 2.04,
                    "currency": "USD",
                    "isPercent": false,
                    "geo": "RU",
                    "pay_landing":"5800",
                    "landing_currency": "RUB"					
                },
                {
                    "title": "Доставленный заказ",
                    "cps": false,
                    "profit": 60.59,
                    "currency": "UAH",
                    "isPercent": false,
                    "geo": "UA",
                    "pay_landing":"5800",
                    "landing_currency": "RUB"						
                }
            ],
            "landings": [
			{
                    "title": "Имя лендинга",
                    "url": "www.landing.ru",
			}
			],
            "transits": [
			{
                    "title": "Имя транзита",
                    "url": "www.transit.ru",
			}
			
			],
            ]
        },
        ...
    ],
}