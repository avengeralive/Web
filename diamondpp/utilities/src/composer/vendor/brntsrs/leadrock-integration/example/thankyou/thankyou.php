<?php
include '../../vendor/autoload.php';

$integration = new \Leadrock\Layouts\ThankYou();
$integration
    ->addFacebookPixel(
            (new \Leadrock\Items\FacebookPixel('123321123321'))
                ->setEvent('Purchase')
    )
    ->addFacebookPixel(
            (new \Leadrock\Items\FacebookPixel())
                ->findFrom('fbpixel')
                ->setEvent('Purchase')
    );

include 'template.html';

$integration->end();