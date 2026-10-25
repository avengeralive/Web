<?php
include '../../vendor/autoload.php';

$integration = new \Leadrock\Layouts\Landing();
$integration
    ->setWebmasterLink('https://leadrock.com/URL-XY123-ZA456')
    ->addProvider(new \Leadrock\Providers\File('leads_log.txt'))
    ->addProvider(new \Leadrock\Providers\Leadrock('1278g3', 'so4ircshboiuerbvs'))
    ->setFormField('user_name', 'name')
    ->setFormField('user_phone', 'phone')
    ->setFormField('other', 'other')
    ->addFacebookPixel((new \Leadrock\Items\FacebookPixel())->findFrom('fbpixel'));

include 'template.html';

$integration->end();