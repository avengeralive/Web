<?php
include '../../vendor/autoload.php';

$integration = new \Leadrock\Layouts\PreLanding();
$integration
    ->findTrackIn('track_id')
    ->setWebmasterLinkFromParam('link')
    ->addFacebookPixel(new \Leadrock\Items\FacebookPixel('123321123321'))
    ->addFacebookPixel((new \Leadrock\Items\FacebookPixel())->findFrom('fbpixel'));
//http://domain.com/?track_id=123&link=URL-QWE12-RTY45&fbpixel=1111111111

include 'template.html';

$integration->end();