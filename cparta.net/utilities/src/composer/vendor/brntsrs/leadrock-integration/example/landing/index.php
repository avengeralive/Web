<?php
include '../../vendor/autoload.php';

$integration = new \Leadrock\Layouts\Landing();
$integration
    ->findTrackIn('track_id')
    ->addProvider(new \Leadrock\Providers\File('leads_log.txt'))
    ->addProvider(new \Leadrock\Providers\Leadrock('1278g3', 'so4ircshboiuerbvs'))
    ->setFormField('user_name', 'name')
    ->setFormField('user_phone', 'phone')
    ->setFormField('other', 'other')
    ->addFacebookPixel(new \Leadrock\Items\FacebookPixel('123321123321'))
    ->addFacebookPixel((new \Leadrock\Items\FacebookPixel())->findFrom('fbpixel'));

include 'template.html';

$integration->end();