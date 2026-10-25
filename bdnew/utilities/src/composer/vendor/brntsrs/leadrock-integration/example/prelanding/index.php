<?php
include '../../vendor/autoload.php';

$integration = new \Leadrock\Layouts\PreLanding();
$integration
    ->findTrackIn('track_id')
    ->setWebmasterLink('https://leadrock.com/URL-QW123-ER4567')
    ->addFacebookPixel(new \Leadrock\Items\FacebookPixel('123321123321'))
    ->addFacebookPixel((new \Leadrock\Items\FacebookPixel())->findFrom('fbpixel'));

include 'template.html';

$integration->end();