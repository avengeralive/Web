<?php

require_once dirname(__FILE__) . '/../bootstrap.php';

$router = new \Bramus\Router\Router();

$router->get('/export/(\w+)/(\w+)/', 'ExportController@export');
$router->get('/testrename/', 'Test@renamer');
$router->get('/testscreens/', 'Test@screens');

$router->post('/testrename/', 'Test@renamer');
$router->get('/temp/tlight/', 'SpiderController@tlight');



$router->get('/testmy/', 'Test@testmy');
$router->get('/test/', 'Test@resend');

$router->get('/zc/zcauth/', 'Zaley@auth');
$router->post('/zc/getbalance/', 'Zaley@getUserBalance');
$router->post('/zc/moneysend/', 'Zaley@moneySend');

//http://api./mailing/unsubscribe/?email=me%40anton.in.ua&hash=d755ce174fb999615d7c5a486454b123
$router->get('/mailing/unsubscribe/', 'MailingController@Unsubscribe');
$router->get('/mailing/track/', 'MailingController@opened');
$router->get('/mailing/link/', 'MailingController@click');



// api route
$router->before('GET|POST', '/v1/.*', 'ApiController@checkKey');
$router->mount('/v1', function() use ($router) {

    $router->get('/news', 'ApiController@getNews');

    $router->get('/offers', 'ApiController@getOffers');
    $router->get('/offer/(\d+)/landings', 'ApiController@getOfferLandings');
    $router->get('/offer/(\d+)/sources', 'ApiController@getOfferSources');
    $router->get('/offer/(\d+)/transits', 'ApiController@getOfferTransits');

    $router->get('/order/(\d+)/status', 'ApiController@getOrderStatus');
    $router->get('/orders/statuses', 'ApiController@getOrdersStatuses');
    $router->post('/order', 'ApiController@createOrder');
    $router->post('/login', 'ApiController@login');
    $router->post('/forgot', 'ApiController@forgot');

    $router->post('/users', 'ApiController@createUser');
    $router->get('/user/stat', 'ApiController@getUserStat');
});
$router->set404(function() {
    header("Content-Type:application/json;charset=utf-8");
    echo json_encode(['status' => 404, 'error' => 'endpoint not found'], JSON_PRETTY_PRINT);
});
$router->run();
